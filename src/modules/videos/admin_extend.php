<?php 

/***************************************************************\
|                                                               |
|                   apexx CMS & Portalsystem                    |
|                 ============================                  |
|           (c) Copyright 2005-2009, Christian Scheb            |
|                  http://www.stylemotion.de                    |
|                                                               |
|---------------------------------------------------------------|
| THIS SOFTWARE IS NOT FREE! MAKE SURE YOU OWN A VALID LICENSE! |
| DO NOT REMOVE ANY COPYRIGHTS WITHOUT PERMISSION!              |
| SOFTWARE BELONGS TO ITS AUTHORS!                              |
\***************************************************************/


//Security-Check
if ( !defined('APXRUN') ) die('You are not allowed to execute this file directly!');


class videos_functions {

var $filepath;
var $tempfile;



//Pfad zu einem Konverter-Programm testen
function validateExecPath($prog, $path) {
	if ( !$path ) return false;
	list($output, $return) = exec_shell($path.' 2>&1');
	
	if ( $prog=='ffmpeg' ) {
		return $return!=127 && preg_match('#FFmpeg#i', $output);
	}
	elseif ( $prog=='flvtool2' ) {
		return $return!=127 && preg_match('#FLVTool2#i', $output);
	}
	elseif ( $prog=='mencoder' ) {
		return $return!=127 && ( preg_match('#MEncoder#i', $output) || preg_match('#MPlayer#i', $output) );
	}
	else {
		return false;
	}
}



//Konverter erzeugen
function createConverter($id) {
	global $set,$db,$apx;
	require_once(BASEDIR.getmodulepath('videos').'class.videoconverter.php');
	$conv = new VideoConverter($id, $set['videos']);
	return $conv;
}



//Screenshots erzeugen
function makeScreenshots($flvFile, $id) {
	global $set,$db,$apx;
	
	$conv = $this->createConverter($id);
	$movieInfo = $conv->getMovieInfo(BASEDIR.getpath('uploads').$flvFile);
	$screenshots = $conv->makeScreenshots(BASEDIR.getpath('uploads').$flvFile, $movieInfo['duration'], $id);
	$conv->close();
	
	if ( $screenshots ) {
		foreach ( $screenshots AS $screen ) {
			$db->query("
				INSERT INTO ".PRE."_videos_screens (videoid,thumbnail,picture) VALUES
				('".$id."', '".addslashes($screen['thumbnail'])."', '".addslashes($screen['picture'])."')
			");
		}
		return true;
	}
	else {
		return false;
	}
}



//Konverter starten
function runConverter($id, $source, $flv, $mkScreens) {
	global $set,$db,$apx;
	
	//Konvertieren
	$conv = $this->createConverter($id);
	$movieInfo = $conv->getMovieInfo($source);
	$success = $conv->convert($source, $flv, $movieInfo);
	
	//MySQL wieder starten
	$db = new database($set['mysql_server'], $set['mysql_user'], $set['mysql_pwd'], $set['mysql_db'], $set['mysql_utf8']);
	
	//Screenshots machen
	if ( $success && $mkScreens ) {
		$screenshots = $conv->makeScreenshots($flv, $movieInfo['duration'], $id);
		if ( $screenshots ) {
			foreach ( $screenshots AS $screen ) {
				$db->query("
					INSERT INTO ".PRE."_videos_screens (videoid,thumbnail,picture) VALUES
					('".$id."', '".addslashes($screen['thumbnail'])."', '".addslashes($screen['picture'])."')
				");
			}
		}
	}
	
	$conv->close();
	
	return $success;
}



//Darf der Benutzer Bilder eines Videos bearbeiten?
function access_pics($id,$action) {
	global $set,$db,$apx;
	$id=(int)$id;
	if ( !$id ) die('page access: missing dlid!');
	
	if ( $apx->user->has_spright($action) ) return true;
	
	list($userid)=$db->first("SELECT userid FROM ".PRE."_videos WHERE id='".$id."' LIMIT 1");
	if ( $userid==$apx->user->info['userid'] ) return true;
	
	return false;
}



//Informationen zu externem Video auslesen
function getEmbedVideo($link) {
	require(BASEDIR.getmodulepath('videos').'plattforms.php');
	
	$url = @parse_url($link);
	if ( $url===false ) return false;
	
	foreach ( $plattforms AS $pid => $format ) {
		
		//Plattform bestimmen
		if ( preg_match('#'.$format[0].'#', $url['host']) ) {
			
			//ID aus URL
			if ( $format[1]=='url' && preg_match('#'.$format[2].'#', $link, $matches) ) {
				$identifier = $matches[1];
				return array(
					'source' => $pid,
					'identifier' => $identifier
				);
			}
			
			//ID aus Website-Code
			elseif ( $format[1]=='website' ) {
				
				$reader = @fopen($link, 'r');
				if ( !$reader ) return false;
				$website = '';
				while ( $data = fread($reader, 10240) ) {
					$website .= $data;
				}
				fclose($reader);
				
				if ( preg_match('#'.$format[2].'#', $website, $matches) ) {
					$identifier = $matches[1];
					return array(
						'source' => $pid,
						'identifier' => $identifier
					);
				}
			}
		}
	}
}



//Pr�fen ob ein User in einer Kategorie posten darf
function category_is_open($catid) {
	global $set,$db,$apx;
	$catid=(int)$catid;
	
	list($groups)=$db->first("SELECT forgroup FROM ".PRE."_videos_cat WHERE id='".$catid."' LIMIT 1");
	$ingroups=unserialize($groups);
	
	if ( $groups=='all' ) return true;
	if ( is_array($ingroups) && in_array($apx->user->info['groupid'],$ingroups) ) return true; 
	
	return false;
}



//Kategorien auflisten + Liste ausgeben
function get_catlist($selected=null) {
	global $set,$db,$apx;
	
	if ( is_null($selected) ) {
		$selected = $_POST['catid'];
	}
	
	//Neue Kategorie erstellen
	if ( $apx->user->has_right('videos.catadd') ) {
		$catlist='<option value=""></option>';
	}
	
	$data = $this->cat->getTree(array('title', 'open', 'forgroup'));
	foreach ( $data AS $res ) {
		$allowed=unserialize($res['forgroup']);
		
		if ( $res['open'] && ( $res['forgroup']=='all' || ( is_array($allowed) && in_array($apx->user->info['groupid'],$allowed) ) ) ) {
			$catlist.='<option value="'.$res['id'].'" '.iif($selected==$res['id'],' selected="selected"').' style="color:green;">'.str_repeat('&nbsp;&nbsp;',($res['level']-1)).replace($res['title']).'</option>';
		}
		else {
			$catlist.='<option value="" disabled="disabled">'.str_repeat('&nbsp;&nbsp;',($res['level']-1)).replace($res['title']).'</option>';
		}
	}
	
	return $catlist;
}



//Autoren-Liste holen
function get_userlist() {
	global $set,$db,$apx;
	
	//Get Info
	$info=$db->first("SELECT a.userid,b.username FROM ".PRE."_videos AS a LEFT JOIN ".PRE."_user AS b USING(userid) WHERE id='".$_REQUEST['id']."' LIMIT 1");
	
	//Benutzergruppen mit Videorechten filtern
	$data=$db->fetch("SELECT groupid FROM ".PRE."_user_groups WHERE ( gtype='admin' OR rights LIKE '%videos.add%' )");
	foreach ( $data AS $res ) {
		$groups[]=$res['groupid'];
	}
	
	$data=$db->fetch("SELECT userid,username FROM ".PRE."_user WHERE ( groupid IN (".implode(',',$groups).") ".iif($info['userid'],"OR userid='".$info['userid']."'")." ) ORDER BY username ASC");
	foreach ( $data AS $res ) {
		$userlist.='<option value="'.$res['userid'].'"'.iif( $_POST['userid']!='send' && $_POST['userid']==$res['userid'],' selected="selected"').'>'.replace($res['username']).'</option>';
	}
	
	return $userlist;
}



//Klicks pro Tag
function stats_dlsperday() {
	global $set,$db,$apx;
	$datestamp=date('Ymd',time()-TIMEDIFF);
	
	$data=$db->fetch("SELECT sum(hits) AS count FROM ".PRE."_videos_stats WHERE daystamp<'".$datestamp."' GROUP BY daystamp");
	if ( !count($data) ) return '0';
	
	foreach ( $data AS $res ) $sum+=$res['count'];
	return round($sum/count($data));
}



//Dateivolumen pro Tag
function stats_sizeperday() {
	global $set,$db,$apx;
	$datestamp=date('Ymd',time()-TIMEDIFF);
	
	$data=$db->fetch("SELECT sum(bytes*hits) AS count FROM ".PRE."_videos_stats WHERE daystamp!='".$datestamp."' GROUP BY daystamp");
	if ( !count($data) ) return '0 Bytes';
	
	foreach ( $data AS $res ) $sum+=$res['count'];
	return $this->format_size(round($sum/count($data)));
}



//Dateigr��e formatieren
function format_size($fsize,$digits=1) {
	$fsize=(float)$fsize;
	if ( $digits ) $format='%01.'.$digits.'f';
	else $format='%01d';
	
	if ( $fsize<1024 ) return $fsize.' Byte';
	if ( $fsize>=1024 && $fsize<1024*1024 ) return  number_format($fsize/(1024),$digits,',','').' KB';
	if ( $fsize>=1024*1024 && $fsize<1024*1024*1024 ) return number_format($fsize/(1024*1024),$digits,',','').' MB';
	if ( $fsize>=1024*1024*1024 && $fsize<1024*1024*1024*1024 ) return number_format($fsize/(1024*1024*1024),$digits,',','').' GB';
	return number_format($fsize/(1024*1024*1024*1024),$digits,',','').' TB';
}



//Teaserpic aktualisieren
function update_teaserpic() {
	global $set,$db,$apx;
	
	if ( $_REQUEST['id'] ) {
		list($current_teaserpic)=$db->first("SELECT teaserpic FROM ".PRE."_videos WHERE id='".$_REQUEST['id']."' LIMIT 1");
		$this->teaserpicid=$_REQUEST['id'];
		$this->teaserpicpath=$current_teaserpic;
	}
	else {
		$tblinfo=$db->first("SHOW TABLE STATUS LIKE '".PRE."_videos'");
		$this->teaserpicid=$tblinfo['Auto_increment'];
		$this->teaserpicpath='';
	}
	
	//Mediamanager
	require_once(BASEDIR.'lib/class.mediamanager.php');
	$this->mm=new mediamanager;
	
	if ( $_POST['delpic'] ) $this->del_teaserpic();
	if ( $_FILES['pic_upload']['tmp_name'] ) return $this->upload_pic();
	if ( $_POST['pic_copy'] ) return $this->copy_pic();
	
	return true;
}



//Teaser-Bild hochladen
function upload_pic() {
	global $set,$db,$apx;
	if ( !is_uploaded_file($_FILES['pic_upload']['tmp_name']) ) die('teaserpic has not been uploaded!');
	
	//Darf das Bild bochgeladen werden?
	$ext=$this->mm->getext($_FILES['pic_upload']['name']);
	list($special)=$db->first("SELECT special FROM ".PRE."_mediarules WHERE extension='".$ext."' LIMIT 1");
	if ( $special=='block' ) { info($apx->lang->get('INFO_NOTALLOWED')); return false; }
	if ( !in_array($ext,array('GIF','JPG','JPEG','JPE','PNG')) ) { info($apx->lang->get('INFO_NOIMAGE')); return false; }
	
	//Datei hochladen
	$filename='videos/pics/teaserpic-'.$this->teaserpicid;
	$tempfile='videos/pics/temp-'.time().strtolower(random_string(10)).'.'.strtolower($ext);
	$this->mm->uploadfile($_FILES['pic_upload'],'',$tempfile);
	
	//Bild verarbeiten
	$feedback=$this->process_pic($tempfile,$filename);
	$this->mm->deletefile($tempfile);
	
	return $feedback;
}



//Teaser-Bild kopieren
function copy_pic() {
	global $set,$db,$apx;
	if ( !file_exists(BASEDIR.getpath('uploads').$_POST['pic_copy']) ) die('source-file does not exist!');
	
	$ext=$this->mm->getext($_POST['pic_copy']);
	/*list($special)=$db->first("SELECT special FROM ".PRE."_mediarules WHERE extension='".$ext."' LIMIT 1");
	if ( $special=="block" ) { info($apx->lang->get('INFO_NOTALLOWED')); return false; }*/
	if ( !in_array($ext,array('GIF','JPG','JPEG','JPE','PNG')) ) { info($apx->lang->get('INFO_NOIMAGE')); return false; }
	
	//Datei duplizieren
	$filename='videos/pics/teaserpic-'.$this->teaserpicid;
	$tempfile='videos/pics/temp-'.time().strtolower(random_string(10)).'.'.strtolower($ext);
	$this->mm->copyfile($_POST['pic_copy'],$tempfile);
	
	//Bild verarbeiten
	$feedback=$this->process_pic($tempfile,$filename);
	$this->mm->deletefile($tempfile);
	
	return $feedback;
}



//Bild verarbeiten
function process_pic($tempfile,$filename) {
	global $set,$db,$apx;
	
	require_once(BASEDIR.'lib/class.image.php');
	$this->img=new image;

	//Dateinamen
	$ext=strtolower($this->mm->getext($tempfile));
	if ( $ext=='gif' ) $ext='jpg';
	$picfile=$filename.'.'.$ext;
	$thumbfile=$filename.'-thumb.'.$ext;
	
	list($source,$sourcetype)=$this->img->getimage($tempfile);
	
	//Bild skalieren
	if ( $set['videos']['teaserpic_popup'] && $set['videos']['teaserpic_popup_width'] && $set['videos']['teaserpic_popup_height'] ) {
		$width=$set['videos']['teaserpic_popup_width'];
		$height=$set['videos']['teaserpic_popup_height'];
	}
	else {
		$width=$set['videos']['teaserpic_width'];
		$height=$set['videos']['teaserpic_height'];
	}
	
	if ( $width && $height ) $pic=$this->img->resize($source,$width,$height,$set['videos']['teaserpic_quality'],0);
	else $pic=$source;
	$this->img->saveimage($pic,$sourcetype,$picfile);
	
	//Wenn kein Popup hier ENDE
	if ( !$set['videos']['teaserpic_popup'] || !$set['videos']['teaserpic_width'] || !$set['videos']['teaserpic_height'] ) {
		if ( $picfile!=$this->teaserpicpath ) $this->del_teaserpic();
		$this->teaserpicpath=$picfile;
		return true;
	}
	
	//Thumbnail skalieren
	$thumb=$this->img->resize($source,$set['videos']['teaserpic_width'],$set['videos']['teaserpic_height'],$set['videos']['teaserpic_quality'],0);
	$this->img->saveimage($thumb,$sourcetype,$thumbfile);
	
	if ( $thumbfile!=$this->teaserpicpath ) $this->del_teaserpic();
	$this->teaserpicpath=$thumbfile;
	return true;
}



//Aktuelles Teaser-Bild l�schen
function del_teaserpic() {
	global $set,$db,$apx;
	if ( !$_REQUEST['id'] ) return;
	
	$oldpic = $this->teaserpicpath;
	if ( !$oldpic ) return;
	
	//MM-Klasse laden
	if ( !isset($this->mm) ) {
		require_once(BASEDIR.'lib/class.mediamanager.php');
		$this->mm=new mediamanager;
	}
	
	//Teaser-Bild l�schen
	if ( file_exists(BASEDIR.getpath('uploads').$oldpic) ) {
		$this->mm->deletefile($oldpic);
	}
	
	//Thumbnail l�schen
	if ( file_exists(BASEDIR.getpath('uploads').str_replace('-thumb.','.',$oldpic)) ) {
		$this->mm->deletefile(str_replace('-thumb.','.',$oldpic));
	}
	
	$this->teaserpicpath='';
}


} //END CLASS

?>