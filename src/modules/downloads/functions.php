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


//Download-Gr��e
function downloads_getsize($fsize,$digits=1) {
	$fsize=(float)$fsize;
	if ( $digits ) $format='%01.'.$digits.'f';
	else $format='%01d';
	
	if ( $fsize<1024 ) return $fsize.' Byte';
	if ( $fsize>=1024 && $fsize<1024*1024 ) return  number_format($fsize/(1024),$digits,',','').' KB';
	if ( $fsize>=1024*1024 && $fsize<1024*1024*1024 ) return number_format($fsize/(1024*1024),$digits,',','').' MB';
	if ( $fsize>=1024*1024*1024 && $fsize<1024*1024*1024*1024 ) return number_format($fsize/(1024*1024*1024),$digits,',','').' GB';
	return number_format($fsize/(1024*1024*1024*1024),$digits,',','').' TB';
}



//Download-Gr��e
function downloads_getformat($res) {
	if ( $res['format'] ) {
		return $res['format'];
	}
	else {
		$info = pathinfo($res['file']);
		$ext = strtolower($info['extension']);
		
		//Query-String entfernen
		if ( ($queryStart = strpos($ext, '?'))!==false ) {
			$ext = substr($ext, 0, $queryStart);
		}
		
		return $ext;
	}
}



//Dateigr��e auslesen
function downloads_filesize($info) {
	if ( $info['local'] && file_exists(BASEDIR.getpath('uploads').$info['file']) ) return filesize(BASEDIR.getpath('uploads').$info['file']);
	return $info['filesize'];
}



//Download-Zeit berechnen
function downloads_gettime($size,$speed) {
	$sec=round($size/($speed*1000/8));
	if ( $sec==0 ) return '&lt; 00:00:01';
	
	$min=floor($sec/60);
	$hours=floor($min/60);
	
	$sec=$sec%60;
	$min=$min%60;
	
	return sprintf('%02d',$hours).':'.sprintf('%02d',$min).':'.sprintf('%02d',$sec);
}



//Teaserpic generieren
function downloads_teaserpic($teaserpic) {
	global $set,$db,$apx,$user;
	if ( !$teaserpic ) return array();
	
	$picture=getpath('uploads').$teaserpic;
	$poppic=str_replace('-thumb.','.',$teaserpic);
	
	if ( $set['videos']['teaserpic_popup'] && strpos($teaserpic,'-thumb.')!==false && file_exists(BASEDIR.getpath('uploads').$poppic) ) {
		$size=getimagesize(BASEDIR.getpath('uploads').$poppic);
		$picture_popup="javascript:popupwin('misc.php?action=picture&amp;pic=".$poppic."','".$size[0]."','".$size[1]."')";
	}
	else {
		$poppic = '';
	}
	
	return array($picture,$picture_popup,iif($poppic, HTTPDIR.getpath('uploads').$poppic));
}



//Kategorien-Informationen
function downloads_catinfo($id=false) {
	global $set,$db,$apx,$user;
	
	//Eine Kategorie
	if ( is_int($id) || is_string($id) ) {
		$id=(int)$id;
		if ( isset($catinfo[$id]) ) return $catinfo[$id];
		$res=$db->first("SELECT id,title,icon,open FROM ".PRE."_downloads_cat WHERE ( id='".$id."' ) LIMIT 1",1);
		$catinfo[$id]=$res;
		$catinfo[$id]['link']=mklink(
			'downloads.php?catid='.$res['id'],
			'downloads,'.$res['id'].',1.html'
		);
		return $catinfo[$id];
	}
	
	//Mehrere Kategorien
	elseif ( is_array($id) ) {
		if ( !count($id) ) return array();
		$data=$db->fetch("SELECT id,title,icon,open FROM ".PRE."_downloads_cat WHERE id IN (".implode(',',$id).")");
		if ( !count($data) ) return array();
		foreach ( $data AS $res ) {
			$catinfo[$res['id']]=$res;
			$catinfo[$res['id']]['link']=mklink(
				'downloads.php?catid='.$res['id'],
				'downloads,'.$res['id'].',1.html'
			);
		}
		return $catinfo;
	}
	
	//Alle Kategorien;
	else {
		if ( $set['downloads']['subcats'] ) {
			require_once(BASEDIR.'lib/class.recursivetree.php');
			$tree=new RecursiveTree(PRE.'_downloads_cat', 'id');
			$data = $tree->getTree(array('*'));
		}
		else $data=$db->fetch("SELECT * FROM ".PRE."_downloads_cat ORDER BY title ASC");
		if ( !count($data) ) return array();
		foreach ( $data AS $res ) {
			$catinfo[$res['id']]=$res;
			$catinfo[$res['id']]['link']=mklink(
				'downloads.php?catid='.$res['id'],
				'downloads,'.$res['id'].',1.html'
			);
		}
		return $catinfo;
	}
}



//Pfad holen
function downloads_path($id) {
	global $set,$db,$apx,$user;
	$id=(int)$id;
	if ( !$id ) return array();
	
	require_once(BASEDIR.'lib/class.recursivetree.php');
	$tree = new RecursiveTree(PRE.'_downloads_cat', 'id');
	$data = $tree->getPathTo(array('title'), $id);
	if ( !count($data) ) return array();
	
	foreach ( $data AS $res ) {
		++$i;
		
		$pathdata[$i]['ID']=$res['id'];
		$pathdata[$i]['TITLE']=$res['title'];
		$pathdata[$i]['LINK']=mklink(
			'downloads.php?catid='.$res['id'],
			'downloads,'.$res['id'].',1'.urlformat($res['title']).'.html'
		);
	}
	
	return $pathdata;
}



//Kategorie-Baum holen
function downloads_tree($catid) {
	global $set,$db,$apx,$user;
	static $saved;
	$catid=(int)$catid;
	
	$catid=(int)$catid;
	if ( !$catid ) return array();
	if ( isset($saved[$catid]) ) return $saved[$catid];
	
	$cattree=array();
	require_once(BASEDIR.'lib/class.recursivetree.php');
	$tree = new RecursiveTree(PRE.'_downloads_cat', 'id');
	$cattree = $tree->getChildrenIds($catid);
	$cattree[] = $catid;
	
	$saved[$catid]=$cattree;
	return $cattree;
}



//Mirrors auflisten
function downloads_mirrors($id,$mirrors) {
	global $set,$db,$apx,$user;
	$mirrors=unserialize($mirrors);
	if ( !is_array($mirrors) || !count($mirrors) ) return array();
	
	foreach ( $mirrors AS $key => $mirror ) {
		++$i;
		
		$mirrordata[$i]['TITLE']=$mirror['title'];
		$mirrordata[$i]['LINK']='misc.php?action=downloadmirror&amp;id='.$id.'&amp;mirror='.$key;
	}
	
	return $mirrordata;
}



//Downloads zu Tags suchen
function downloads_search_tags($tagids, $conn='or') {
	global $set,$db,$apx,$user;
	if ( !is_array($tagids) ) return array();
	$tagids = array_map('intval', $tagids);
	if ( !$tagids ) return array();
	if ( $conn=='or' ) {
		$data = $db->fetch("
			SELECT DISTINCT id
			FROM ".PRE."_downloads_tags
			WHERE tagid IN (".implode(', ', $tagids).")
		");
		$ids = get_ids($data, 'id');
	}
	else {
		$data = $db->fetch("
			SELECT id, tagid, count(id) AS hits
			FROM ".PRE."_downloads_tags
			WHERE tagid IN (".implode(', ', $tagids).")
			GROUP BY id
			HAVING hits=".count($tagids)."
		");
		$ids = get_ids($data, 'id');
	}
	return $ids;
}



//Nach �bereinstimmungen in den Tags suchen
function downloads_match_tags($items) {
	global $set,$db,$apx,$user;
	if ( !is_array($items) ) return array();
	$result = array();
	foreach ( $items AS $item ) {
		$data = $db->fetch("
			SELECT DISTINCT at.id
			FROM ".PRE."_downloads_tags AS at
			LEFT JOIN ".PRE."_tags AS t USING(tagid)
			WHERE t.tag LIKE '%".addslashes_like($item)."%'
		");
		$result[$item] = get_ids($data, 'id');
	}
	return $result;
}



//Tags zu einem Download auslesen
function downloads_tags($id) {
	global $set,$db,$apx,$user;
	$tagdata = array();
	$tagids = array();
	$tags = array();
	$data = $db->fetch("
		SELECT t.tagid, t.tag, count(nt.id) AS weight
		FROM ".PRE."_downloads_tags AS nt
		LEFT JOIN ".PRE."_tags AS t ON nt.tagid=t.tagid
		LEFT JOIN ".PRE."_downloads_tags AS nt2 ON nt.tagid=nt2.tagid
		WHERE nt.id=".intval($id)."
		GROUP BY nt.tagid
		ORDER BY t.tag ASC
	");
	if ( count($data) ) {
		$maxweight = 1;
		foreach ( $data AS $res ) {
			if ( $res['weight']>$maxweight ) {
				$maxweight = $res['weight'];
			}
		}
		foreach ( $data AS $res ) {
			$tags[] = $res['tag'];
			$tagids[] = $res['tagid'];
			$tagdata[] = array(
				'ID' => $res['tagid'],
				'NAME' => replace($res['tag']),
				'WEIGHT' => $res['weight']/$maxweight
			);
		}
	}
	
	return array($tagdata, $tagids, implode(', ', $tags));
}



//Bilder auflisten
function downloads_pictures($pictures) {
	global $set,$db,$apx,$user;
	$pictures=unserialize($pictures);
	if ( !is_array($pictures) || !count($pictures) ) return array();
	
	foreach ( $pictures AS $key => $pic ) {
		++$i;
		
		$size=getimagesize(BASEDIR.getpath('uploads').$pic['picture']);
		
		$mirrordata[$i]['IMAGE']=getpath('uploads').$pic['thumbnail'];
		$mirrordata[$i]['FULLSIZE']=getpath('uploads').$pic['picture'];
		$mirrordata[$i]['LINK']="javascript:popuppic('misc.php?action=picture&amp;pic=".$pic['picture']."','".$size[0]."','".$size[1]."');";
	}
	
	return $mirrordata;
}



//Weekstamp
function downloads_weekstamp($time) {
	//Wenn Kalenderwoche >= 52 und wir uns im Januar befinden
	//-> Kalenderwoche geh�rt zum vorherigen Jahr!
	if ( intval(date('W',$time-TIMEDIFF))>=52 && intval(date('n',$time-TIMEDIFF))==1 ) {
		return (date('Y',$time-TIMEDIFF)-1).sprintf('%02d',date('W',$time-TIMEDIFF));
	}
	
	return date('Y',$time-TIMEDIFF).sprintf('%02d',date('W',$time-TIMEDIFF));
}



//Statistik
function downloads_insert_stats($id,$filesize=0,$local=true) {
	global $set,$db,$apx,$user;
	$id=(int)$id;
	if ( !$set['downloads']['exttraffic'] && !$local ) $filesize=0;
	
	$statsnow=time();
	$datestamp=date('Ymd',$statsnow-TIMEDIFF);
	
	list($stats_exists)=$db->first("SELECT daystamp FROM ".PRE."_downloads_stats WHERE ( daystamp='".$datestamp."' AND dlid='".$id."' )");
	if ( $stats_exists ) $db->query("UPDATE ".PRE."_downloads_stats SET hits=hits+1 WHERE ( daystamp='".$datestamp."' AND dlid='".$id."' )");
	else {
		$db->quieterror=true;
		$db->query("INSERT INTO ".PRE."_downloads_stats VALUES ('".$datestamp."','".time()."','".$id."','".$filesize."',1)");
		$db->quieterror=false;
	}
	$db->query("UPDATE ".PRE."_downloads SET hits=hits+1 WHERE id='".$id."' LIMIT 1");
}



//Download-Limit erreicht?
function downloads_limit_is_reached($id=false,$limit=false) {
	global $set,$db;
	$id=(int)$id;
	$limit=(int)$limit;
	
	//Maximaler Traffic
	if ( $set['downloads']['maxtraffic'] ) {
		list($traffic)=$db->first("SELECT sum(hits*bytes) FROM ".PRE."_downloads_stats WHERE daystamp='".date('Ymd',time()-TIMEDIFF)."'");
		if ( $traffic>=$set['downloads']['maxtraffic'] ) return true;
	}
	
	//Maximale Downloadzahl
	if ( $id && $limit ) {
		list($hits)=$db->first("SELECT hits FROM ".PRE."_downloads_stats WHERE ( dlid='".$id."' AND daystamp='".date('Ymd',time()-TIMEDIFF)."' ) LIMIT 1");
		if ( $hits>=$limit ) return true;
	}
	
	return false;
}



//Kommentarseite
function downloads_showcomments($id) {
	global $db,$tmpl,$user,$set,$apx;
	
	$res=$db->first("SELECT id,allowcoms FROM ".PRE."_downloads WHERE id='".intval($id)."' LIMIT 1");
	if ( !$set['downloads']['coms'] || !$res['allowcoms'] || !$apx->is_module('comments') ) return;
	
	require_once(BASEDIR.getmodulepath('comments').'class.comments.php');
	$coms=new comments('downloads',$res['id']);
	$coms->assign_comments();
	
	$apx->tmpl->parse('comments','comments');
	require('lib/_end.php');
}

?>