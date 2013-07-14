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


# PRODUCTS CLASS
# ==============

//Security-Check
if ( !defined('APXRUN') ) die('You are not allowed to execute this file directly!');


//Funktionen laden
include(BASEDIR.getmodulepath('products').'admin_extend.php');


class action extends products_functions {

//Produkttypen
var $types=array(
	'game',
	'software',
	'hardware',
	'music',
	'movie',
	'book'
);

var $genretypes=array(
	'game',
	'music',
	'movie',
	'book'
);

var $mediatypes=array(
	'game',
	'software',
	'music',
	'movie',
	'book'
);

var $alltypes=array(
	'normal',
	'game',
	'software',
	'hardware',
	'music',
	'movie',
	'book'
);


//***************************** Spiele zeigen *****************************
function show() {
	global $set,$db,$apx,$html;
	
	//Suche durchf�hren
	if ( $_REQUEST['item'] && ( $_REQUEST['title'] || $_REQUEST['text'] ) ) {
		$where = '';
		
		//Suche wird ausgef�hrt...
		if ( $_REQUEST['title'] ) $sc[]="title LIKE '%".addslashes_like($_REQUEST['item'])."%'";
		if ( $_REQUEST['text'] ) $sc[]="text LIKE '%".addslashes_like($_REQUEST['item'])."%'";
		if ( $_REQUEST['else'] ) {
			$sc[]="text LIKE '%".addslashes_like($_REQUEST['item'])."%'";
			$sc[]="website LIKE '%".addslashes_like($_REQUEST['item'])."%'";
			$sc[]="requirements LIKE '%".addslashes_like($_REQUEST['item'])."%'";
			$sc[]="equipment LIKE '%".addslashes_like($_REQUEST['item'])."%'";
			$sc[]="os LIKE '%".addslashes_like($_REQUEST['item'])."%'";
			$sc[]="languages LIKE '%".addslashes_like($_REQUEST['item'])."%'";
			$sc[]="version LIKE '%".addslashes_like($_REQUEST['item'])."%'";
			$sc[]="isbn LIKE '%".addslashes_like($_REQUEST['item'])."%'";
			$sc[]="custom1 LIKE '%".addslashes_like($_REQUEST['item'])."%'";
			$sc[]="custom2 LIKE '%".addslashes_like($_REQUEST['item'])."%'";
			$sc[]="custom3 LIKE '%".addslashes_like($_REQUEST['item'])."%'";
			$sc[]="custom4 LIKE '%".addslashes_like($_REQUEST['item'])."%'";
			$sc[]="custom5 LIKE '%".addslashes_like($_REQUEST['item'])."%'";
			$sc[]="custom6 LIKE '%".addslashes_like($_REQUEST['item'])."%'";
			$sc[]="custom7 LIKE '%".addslashes_like($_REQUEST['item'])."%'";
			$sc[]="custom8 LIKE '%".addslashes_like($_REQUEST['item'])."%'";
			$sc[]="custom9 LIKE '%".addslashes_like($_REQUEST['item'])."%'";
			$sc[]="custom10 LIKE '%".addslashes_like($_REQUEST['item'])."%'";
		}
		if ( is_array($sc) ) $where.=' AND ( '.implode(' OR ',$sc).' )';
		
		$data=$db->fetch("SELECT id FROM ".PRE."_products WHERE 1 ".$where);
		$ids = get_ids($data, 'id');
		$ids[] = -1;
		$searchid = saveSearchResult('admin_products', $ids, array(
			'title' => $_REQUEST['title'],
			'text' => $_REQUEST['text'],
			'else' => $_REQUEST['else'],
			'item' => $_REQUEST['item']
		));
		header("HTTP/1.1 301 Moved Permanently");
		header('Location: action.php?action=products.show&what='.$_REQUEST['what'].'&searchid='.$searchid);
		return;
	}
	
	
	//Vorgaben
	$_REQUEST['title'] = 1;
	$_REQUEST['text'] = 1;
	
	quicklink('products.add');
	
	$orderdef[0]='addtime';
	$orderdef['title']=array('title','ASC','COL_TITLE');
	$orderdef['addtime']=array('addtime','DESC','COL_ADDTIME');
	$orderdef['hits']=array('hits','DESC','COL_HITS');
	
	//Layer
	$layerdef[]=array('PRODTYPE_ALL','action.php?action=products.show',!$_REQUEST['what']);
	foreach ( $this->alltypes AS $type ) {
		$layerdef[]=array('PRODTYPE_'.strtoupper($type),'action.php?action=products.show&amp;what='.$type,$_REQUEST['what']==$type);
	}
	$html->layer_header($layerdef);
	$layerFilter = '';
	if ( in_array($_REQUEST['what'], $this->alltypes) ) {
		$layerFilter = " AND a.type='".addslashes($_REQUEST['what'])."' ";
	}
	
	
	//Suchergebnis?
	$resultFilter = '';
	if ( $_REQUEST['searchid'] ) {
		$searchRes = getSearchResult('admin_products', $_REQUEST['searchid']);
		if ( $searchRes ) {
			list($resultIds, $resultMeta) = $searchRes;
			$_REQUEST['item'] = $resultMeta['item'];
			$_REQUEST['title'] = $resultMeta['title'];
			$_REQUEST['text'] = $resultMeta['text'];
			$_REQUEST['else'] = $resultMeta['else'];
			$resultFilter = " AND a.id IN (".implode(', ', $resultIds).")";
		}
		else {
			$_REQUEST['searchid'] = '';
		}
	}
	
	$apx->tmpl->assign('ITEM',compatible_hsc($_REQUEST['item']));
	$apx->tmpl->assign('STITLE',(int)$_REQUEST['title']);
	$apx->tmpl->assign('STEXT',(int)$_REQUEST['text']);
	$apx->tmpl->assign('SELSE',(int)$_REQUEST['else']);
	$apx->tmpl->assign('WHAT',$_REQUEST['what']);
	$apx->tmpl->parse('search');
	
	
	//Letters
	letters('action.php?action=products.show&amp;what='.$_REQUEST['what'].'&amp;sortby=title.ASC'.iif($_REQUEST['searchid'], '&amp;searchid='.$_REQUEST['searchid']));
	if ( !$_REQUEST['letter'] ) $_REQUEST['letter']=0;
	$letterfilter='';
	if ( $_REQUEST['letter']==='spchar' ) $letterfilter=" AND title NOT REGEXP(\"^[a-zA-Z]\") ";
	elseif ( $_REQUEST['letter'] ) $letterfilter=" AND title LIKE '".addslashes($_REQUEST['letter'])."%' ";
	
	//Auflisten
	list($count)=$db->first("SELECT count(id) FROM ".PRE."_products AS a WHERE 1 ".$layerFilter.$resultFilter.$letterfilter);
	pages('action.php?action=products.show&amp;what='.$_REQUEST['what'].'&amp;sortby='.$_REQUEST['sortby'].iif($_REQUEST['searchid'], '&amp;searchid='.$_REQUEST['searchid']).'&amp;letter='.$_REQUEST['letter'],$count);
	$data=$db->fetch("SELECT * FROM ".PRE."_products AS a WHERE 1 ".$layerFilter.$resultFilter.$letterfilter.getorder($orderdef).getlimit());
	$this->show_print($data);
	orderstr($orderdef,'action.php?action=products.show&amp;what='.$_REQUEST['what'].iif($_REQUEST['searchid'], '&amp;searchid='.$_REQUEST['searchid']).'&amp;letter='.$_REQUEST['letter']);
	save_index($_SERVER['REQUEST_URI']);
	
	$html->layer_footer();
}


//AUSGABE
function show_print($data) {
	global $set,$db,$apx,$html;
	
	$col[]=array('&nbsp;',1,'');
	$col[]=array('&nbsp;',1,'');
	$col[]=array('COL_TITLE',70,'class="title"');
	$col[]=array('COL_HITS',10,'align="center"');
	$col[]=array('COL_ADDTIME',20,'align="center"');
	
	if ( count($data) ) {
		foreach ( $data AS $res ) {
			++$i;
			
			$link=mklink(
				'products.php?id='.$res['id'],
				'products,id'.$res['id'].urlformat($res['title']).'.html'
			);
			
			//Aktiv-Anzeige
			if ( $res['active'] ) $tabledata[$i]['COL1']='<img src="design/greendot.gif" alt="'.$apx->lang->get('CORE_ACTIVE').'" title="'.$apx->lang->get('CORE_ACTIVE').'" />';
			else $tabledata[$i]['COL1']='<img src="design/reddot.gif" alt="'.$apx->lang->get('CORE_INACTIVE').'" title="'.$apx->lang->get('CORE_INACTIVE').'" />';
			$tabledata[$i]['COL2']='<img src="design/type_'.$res['type'].'.gif" alt="'.$apx->lang->get('PRODTYPE_'.strtoupper($res['type'])).'" title="'.$apx->lang->get('PRODTYPE_'.strtoupper($res['type'])).'" />';
			$tabledata[$i]['COL3']='<a href="'.$link.'" target="_blank">'.$res['title'].'</a>';
			$tabledata[$i]['COL4']=number_format($res['hits'],0,'','.');
			$tabledata[$i]['COL5']=apxdate($res['addtime']);
			
			//Optionen
			if ( $apx->user->has_right('products.edit') ) $tabledata[$i]['OPTIONS'].=optionHTML('edit.gif', 'products.edit', 'id='.$res['id'], $apx->lang->get('CORE_EDIT'));
			else $tabledata[$i]['OPTIONS'].='<img src="design/ispace.gif" alt="" />';
			
			if ( $apx->user->has_right('products.del') ) $tabledata[$i]['OPTIONS'].=optionHTMLOverlay('del.gif', 'products.del', 'id='.$res['id'], $apx->lang->get('CORE_DEL'));
			else $tabledata[$i]['OPTIONS'].='<img src="design/ispace.gif" alt="" />';
			
			if ( $res['active'] && $apx->user->has_right('products.disable') ) $tabledata[$i]['OPTIONS'].=optionHTML('disable.gif', 'products.disable', 'id='.$res['id'].'&sectoken='.$apx->session->get('sectoken'), $apx->lang->get('CORE_DISABLE'));
			elseif ( !$res['active'] && $apx->user->has_right('products.enable') ) $tabledata[$i]['OPTIONS'].=optionHTML('enable.gif', 'products.enable', 'id='.$res['id'].'&sectoken='.$apx->session->get('sectoken'), $apx->lang->get('CORE_ENABLE'));
			else $tabledata[$i]['OPTIONS'].='<img src="design/ispace.gif" alt="" />';
			
			//Kommentare + Bewertungen
			if ( $apx->is_module('comments') || $apx->is_module('ratings') ) $tabledata[$i]['OPTIONS'].='&nbsp;';
			if ( $apx->is_module('comments') ) {
				list($comments)=$db->first("SELECT count(id) FROM ".PRE."_comments WHERE ( module='products' AND mid='".$res['id']."' )");
				if ( $comments && ( $apx->is_module('comments') && $set['products']['coms'] ) && $res['allowcoms'] && $apx->user->has_right('comments.show') ) $tabledata[$i]['OPTIONS'].=optionHTML('comments.gif', 'comments.show', 'module=products&mid='.$res['id'], $apx->lang->get('COMMENTS').' ('.$comments.')');
				else $tabledata[$i]['OPTIONS'].='<img src="design/ispace.gif" alt="" />';
			}
			if ( $apx->is_module('ratings') ) {
				list($ratings)=$db->first("SELECT count(id) FROM ".PRE."_ratings WHERE ( module='products' AND mid='".$res['id']."' )");
				if ( $ratings && ( $apx->is_module('ratings') && $set['products']['ratings'] ) && $res['allowrating'] && $apx->user->has_right('ratings.show') ) $tabledata[$i]['OPTIONS'].=optionHTML('ratings.gif', 'ratings.show', 'module=products&mid='.$res['id'], $apx->lang->get('RATINGS').' ('.$ratings.')');
				else $tabledata[$i]['OPTIONS'].='<img src="design/ispace.gif" alt="" />';
			}
		}
	}
	
	$apx->tmpl->assign('TABLE',$tabledata);
	$html->table($col);
}



//***************************** Produkt hinzuf�gen *****************************
function add() {
	global $set,$db,$apx;
	
	//Typ w�hlen
	if ( !$_REQUEST['type'] || !in_array($_REQUEST['type'],$this->alltypes) ) {
		
		//Typliste
		$typelist='';
		foreach ( $this->alltypes AS $type ) {
			$typelist.='<option value="'.$type.'"'.iif($type==$_POST['type'],' selected="selected"').'>'.$apx->lang->get('PRODTYPE_'.strtoupper($type)).'</option>';
		}
		
		tmessage('choosetype',array('TYPELIST'=>$typelist, 'UPDATEPARENT' => $_REQUEST['updateparent']));
		return;
	}
	
	//Aktion aufrufen
	else {
		$call='add_'.$_REQUEST['type'];
		$this->$call();
	}
}



//***************************** Produkt bearbeiten *****************************
function edit() {
	global $set,$db,$apx;
	$_REQUEST['id']=(int)$_REQUEST['id'];
	if ( !$_REQUEST['id'] ) die('missing ID!');
	
	$res=$db->first("SELECT * FROM ".PRE."_products WHERE id='".$_REQUEST['id']."' LIMIT 1");
	$call='edit_'.$res['type'];
	$this->$call($res);
}



//***************************** Produkt l�schen *****************************
function del() {
	global $set,$db,$apx;
	$_REQUEST['id']=(int)$_REQUEST['id'];
	if ( !$_REQUEST['id'] ) die('missing ID!');
	
	if ( $_POST['send']==1 ) {
		if ( !checkToken() ) printInvalidToken();
		else {
			
			//Bild l�schen
			list($picture, $teaserpic) = $db->first("SELECT picture, teaserpic FROM ".PRE."_products WHERE id='".$_REQUEST['id']."' LIMIT 1");
			require_once(BASEDIR.'lib/class.mediamanager.php');
			$mm = new mediamanager();
			
			$poppic=str_replace('-thumb.','.',$picture);
			if ( $picture && file_exists(BASEDIR.getpath('uploads').$picture) ) $mm->deletefile($picture);
			if ( $poppic && file_exists(BASEDIR.getpath('uploads').$poppic) ) $mm->deletefile($poppic);
			
			$poppic=str_replace('-thumb.','.',$teaserpic);
			if ( $teaserpic && file_exists(BASEDIR.getpath('uploads').$teaserpic) ) $mm->deletefile($teaserpic);
			if ( $poppic && file_exists(BASEDIR.getpath('uploads').$poppic) ) $mm->deletefile($poppic);
			
			//DB-Eintrag l�schen
			$db->query("DELETE FROM ".PRE."_products WHERE id='".$_REQUEST['id']."'");
			$db->query("DELETE FROM ".PRE."_products_releases WHERE prodid='".$_REQUEST['id']."'");
			
			//Tags l�schen
			$db->query("DELETE FROM ".PRE."_products_tags WHERE id='".$_REQUEST['id']."'");
			
			logit('PRODUCTS_DEL','ID #'.$_REQUEST['id']);
			printJSRedirect(get_index('products.show'));
		}
	}
	else {
		list($title) = $db->first("SELECT title FROM ".PRE."_products WHERE id='".$_REQUEST['id']."' LIMIT 1");
		$apx->tmpl->assign('MESSAGE', $apx->lang->get('MSG_TEXT', array('TITLE' => compatible_hsc($title))));
		tmessageOverlay('deltitle',array('ID'=>$_REQUEST['id']),'/');
	}
}



//***************************** Produkt aktivieren *****************************
function enable() {
	global $set,$db,$apx;
	$_REQUEST['id']=(int)$_REQUEST['id'];
	if ( !$_REQUEST['id'] ) die('missing ID!');
	
	if ( !checkToken() ) printInvalidToken();
	else {
		$db->query("UPDATE ".PRE."_products SET active='1' WHERE id='".$_REQUEST['id']."' LIMIT 1");
		logit('PRODUCT_ENABLE','ID #'.$_REQUEST['id']);
		header("HTTP/1.1 301 Moved Permanently");
		header('Location: '.get_index('products.show'));
	}
}



//***************************** Produkt deaktivieren *****************************
function disable() {
	global $set,$db,$apx;
	$_REQUEST['id']=(int)$_REQUEST['id'];
	if ( !$_REQUEST['id'] ) die('missing ID!');
	
	if ( !checkToken() ) printInvalidToken();
	else {
		$db->query("UPDATE ".PRE."_products SET active='0' WHERE id='".$_REQUEST['id']."' LIMIT 1");
		logit('PRODUCT_DISABLE','ID #'.$_REQUEST['id']);
		header("HTTP/1.1 301 Moved Permanently");
		header('Location: '.get_index('products.show'));
	}
}



/////////////////////////////////////////////////////////////////////////////////////////// ADD/EDIT TYP

//***************************** NORMAL *****************************
function add_normal() {
	global $set,$db,$apx;
	$thistype='normal';
	
	if ( $_POST['send']==2 ) {
		
		//Begriff bereits vorhanden?
		$duplicate = false;
		if ( $_POST['send']==2 && !$_POST['ignore'] ) {
			list($duplicate) = $db->first("SELECT id FROM ".PRE."_products WHERE title LIKE '".addslashes($_POST['title'])."' LIMIT 1");
		}
		
		if ( !checkToken() ) infoInvalidToken();
		elseif ( !$_POST['title'] || !$_POST['text'] ) infoNotComplete();
		elseif ( $duplicate ) {
			info($apx->lang->get('MSG_DUPLICATE'));
			echo '<script type="text/javascript"> parent.document.forms[0].ignore.value = 1; </script>';
		}
		elseif ( !$this->update_pic() ) { /*DO NOTHING*/ }
		elseif ( !$this->update_teaserpic() ) { /*DO NOTHING*/ }
		else {
			
			//Website-URLs clean
			if ( substr($_POST['website'],0,4)=='www.' ) $_POST['website']='http://'.$_POST['website'];
			
			$_POST['type']=$thistype;
			$_POST['addtime']=time();
			$_POST['picture']=$this->picpath;
			$_POST['teaserpic']=$this->teaserpicpath;
			
			//Freischalten
			if ( $apx->user->has_right('products.enable') && $_POST['pubnow'] ) $_POST['active'] = 1;
			else $_POST['active'] = 0;
			
			$db->dinsert(PRE.'_products','prodid,type,title,text,meta_description,picture,teaserpic,website,manufacturer,custom1,custom2,custom3,custom4,custom5,custom6,custom7,custom8,custom9,custom10,buylink,price,recprice,guarantee,addtime,allowcoms,allowrating,restricted,top,top,searchable,active');
			$nid=$db->insert_id();
			logit('PRODUCTS_ADD','ID #'.$nid);
			
			//Inlinescreens
			mediamanager_setinline($nid);
			
			//Release eintragen
			$element=$_POST['release'];
			if ( $element['year'] ) {
				list($reldata,$relstamp)=$this->generate_release($element);
				$db->query("INSERT INTO ".PRE."_products_releases (prodid,data,stamp) VALUES ('".$nid."','".addslashes(serialize($reldata))."','".$relstamp."')");
			}
			
			//Tags
			$tagids = produceTagIds($_POST['tags']);
			foreach ( $tagids AS $tagid ) {
				$db->query("INSERT IGNORE INTO ".PRE."_products_tags VALUES('".$nid."', '".$tagid."')");
			}
			
			if ( $_REQUEST['updateparent'] ) {
				printJSUpdateObject($_REQUEST['updateparent'], get_product_list($nid));
			}
			else {
				printJSRedirect('action.php?action=products.show&what='.$thistype);
			}
		}
	}
	else {
		$_POST['allowcoms']=1;
		$_POST['allowrating']=1;
		$_POST['searchable']=1;
		$_POST['pubnow']=1;
		
		//Benutzerdefinierte Felder
		for ( $i=1; $i<=10; $i++ ) {
			$fieldname = $set['products']['custom_'.$thistype][$i-1];
			$apx->tmpl->assign('CUSFIELD'.$i.'_NAME',replace($fieldname));
			$apx->tmpl->assign('CUSTOM'.$i,compatible_hsc($_POST['custom'.$i]));
		}
		
		$apx->tmpl->assign('ACTION','add');
		$apx->tmpl->assign('PRODID',intval($_POST['prodid']));
		$apx->tmpl->assign('TITLE',compatible_hsc($_POST['title']));
		$apx->tmpl->assign('TEXT',compatible_hsc($_POST['text']));
		$apx->tmpl->assign('META_DESCRIPTION',compatible_hsc($_POST['meta_description']));
		$apx->tmpl->assign('PIC_COPY',compatible_hsc($_POST['pic_copy']));
		$apx->tmpl->assign('TEASERPIC_COPY',compatible_hsc($_POST['teaserpic_copy']));
		$apx->tmpl->assign('WEBSITE',compatible_hsc($_POST['website']));
		$apx->tmpl->assign('TAGS',compatible_hsc($_POST['tags']));
		$apx->tmpl->assign('MANUFACTURER',$this->get_units($_POST['manufacturer']));
		$apx->tmpl->assign('RELEASE_QUATER',(int)$_POST['release']['quater']);
		$apx->tmpl->assign('RELEASE_DAY',(int)$_POST['release']['day']);
		$apx->tmpl->assign('RELEASE_MONTH',(int)$_POST['release']['month']);
		$apx->tmpl->assign('RELEASE_YEAR',(int)$_POST['release']['year']);
		$apx->tmpl->assign('BUYLINK',compatible_hsc($_POST['buylink']));
		$apx->tmpl->assign('PRICE',compatible_hsc($_POST['price']));
		$apx->tmpl->assign('RECPRICE',compatible_hsc($_POST['recprice']));
		$apx->tmpl->assign('GUARANTEE',compatible_hsc($_POST['guarantee']));
		$apx->tmpl->assign('ALLOWCOMS',(int)$_POST['allowcoms']);
		$apx->tmpl->assign('ALLOWRATING',(int)$_POST['allowrating']);
		$apx->tmpl->assign('RESTRICTED',(int)$_POST['restricted']);
		$apx->tmpl->assign('TOP',(int)$_POST['top']);
		$apx->tmpl->assign('SEARCHABLE',(int)$_POST['searchable']);
		$apx->tmpl->assign('PUBNOW',(int)$_POST['pubnow']);
		$apx->tmpl->assign('UPDATEPARENT',(int)$_POST['updateparent']);
		
		$apx->tmpl->parse('add_edit_'.$thistype);
	}
}



function edit_normal($info) {
	global $set,$db,$apx;
	$thistype='normal';
	
	//Aktualisieren
	if ( $_POST['send']==2 ) {
		if ( !checkToken() ) infoInvalidToken();
		elseif ( !$_POST['title'] || !$_POST['text'] ) infoNotComplete();
		elseif ( !$this->update_pic() ) { /*DO NOTHING*/ }
		elseif ( !$this->update_teaserpic() ) { /*DO NOTHING*/ }
		else {
			
			//Website-URLs clean
			if ( substr($_POST['website'],0,4)=='www.' ) $_POST['website']='http://'.$_POST['website'];
			
			$_POST['picture']=$this->picpath;
			$_POST['teaserpic']=$this->teaserpicpath;
			
			$db->dupdate(PRE.'_products','prodid,title,text,meta_description,picture,teaserpic,website,manufacturer,custom1,custom2,custom3,custom4,custom5,custom6,custom7,custom8,custom9,custom10,buylink,price,recprice,guarantee,allowcoms,allowrating,restricted,top,searchable',"WHERE id='".$_REQUEST['id']."' LIMIT 1");
			logit('PRODUCTS_EDIT','ID #'.$_REQUEST['id']);
			
			//Release eintragen
			$db->query("DELETE FROM ".PRE."_products_releases WHERE prodid='".$_REQUEST['id']."'");
			$element=$_POST['release'];
			if ( $element['year'] ) {
				list($reldata,$relstamp)=$this->generate_release($element);
				$db->query("INSERT INTO ".PRE."_products_releases (prodid,data,stamp) VALUES ('".$_REQUEST['id']."','".addslashes(serialize($reldata))."','".$relstamp."')");
			}
			
			//Tags
			$db->query("DELETE FROM ".PRE."_products_tags WHERE id='".$_REQUEST['id']."'");
			$tagids = produceTagIds($_POST['tags']);
			foreach ( $tagids AS $tagid ) {
				$db->query("INSERT IGNORE INTO ".PRE."_products_tags VALUES('".$_REQUEST['id']."', '".$tagid."')");
			}
			
			printJSRedirect(get_index('products.show'));
		}
	}
	else {
		//Variablen freigeben
		foreach ( $info AS $key => $value ) {
			$_POST[$key]=$value;
		}
		
		//Releases auslesen
		$_POST['release']=array();
		list($res)=$db->first("SELECT data FROM ".PRE."_products_releases WHERE prodid='".$_REQUEST['id']."' LIMIT 1");
		$res=unserialize($res);
		if ( is_array($res) ) {
			$_POST['release']=$res;
		}
		
		//Benutzerdefinierte Felder
		for ( $i=1; $i<=10; $i++ ) {
			$fieldname = $set['products']['custom_'.$thistype][$i-1];
			$apx->tmpl->assign('CUSFIELD'.$i.'_NAME',replace($fieldname));
			$apx->tmpl->assign('CUSTOM'.$i,compatible_hsc($_POST['custom'.$i]));
		}
		
		//Bild
		$picture = '';
		if ( $info['picture'] ) {
			$picturepath = $info['picture'];
			$poppicpath = str_replace('-thumb.', '.', $picturepath);
			if ( file_exists(BASEDIR.getpath('uploads').$poppicpath) ) {
				$picture = '../'.getpath('uploads').$poppicpath;
			}
			else {
				$picture = '../'.getpath('uploads').$picturepath;
			}
		}
		
		//Bild
		$teaserpic = '';
		if ( $info['teaserpic'] ) {
			$teaserpicpath = $info['teaserpic'];
			$poppicpath = str_replace('-thumb.', '.', $teaserpicpath);
			if ( file_exists(BASEDIR.getpath('uploads').$poppicpath) ) {
				$teaserpic = '../'.getpath('uploads').$poppicpath;
			}
			else {
				$teaserpic = '../'.getpath('uploads').$teaserpicpath;
			}
		}
		
		//Tags
		$tags = array();
		$tagdata = $db->fetch("
			SELECT t.tag
			FROM ".PRE."_products_tags AS n
			LEFT JOIN ".PRE."_tags AS t USING(tagid)
			WHERE n.id='".$_REQUEST['id']."'
			ORDER BY t.tag ASC
		");
		$tags = get_ids($tagdata, 'tag');
		$_POST['tags'] = implode(', ', $tags);
		
		$apx->tmpl->assign('ACTION','edit');
		$apx->tmpl->assign('ID',$_REQUEST['id']);
		$apx->tmpl->assign('PRODID',intval($_POST['prodid']));
		$apx->tmpl->assign('TITLE',compatible_hsc($_POST['title']));
		$apx->tmpl->assign('TEXT',compatible_hsc($_POST['text']));
		$apx->tmpl->assign('META_DESCRIPTION',compatible_hsc($_POST['meta_description']));
		$apx->tmpl->assign('PICTURE',$picture);
		$apx->tmpl->assign('TEASERPIC',$teaserpic);
		$apx->tmpl->assign('PIC_COPY',compatible_hsc($_POST['pic_copy']));
		$apx->tmpl->assign('TEASERPIC_COPY',compatible_hsc($_POST['teaserpic_copy']));
		$apx->tmpl->assign('WEBSITE',compatible_hsc($_POST['website']));
		$apx->tmpl->assign('TAGS',compatible_hsc($_POST['tags']));
		$apx->tmpl->assign('MANUFACTURER',$this->get_units($_POST['manufacturer']));
		$apx->tmpl->assign('RELEASE_QUATER',(int)$_POST['release']['quater']);
		$apx->tmpl->assign('RELEASE_DAY',(int)$_POST['release']['day']);
		$apx->tmpl->assign('RELEASE_MONTH',(int)$_POST['release']['month']);
		$apx->tmpl->assign('RELEASE_YEAR',(int)$_POST['release']['year']);
		$apx->tmpl->assign('BUYLINK',compatible_hsc($_POST['buylink']));
		$apx->tmpl->assign('PRICE',compatible_hsc($_POST['price']));
		$apx->tmpl->assign('RECPRICE',compatible_hsc($_POST['recprice']));
		$apx->tmpl->assign('GUARANTEE',compatible_hsc($_POST['guarantee']));
		$apx->tmpl->assign('ALLOWCOMS',(int)$_POST['allowcoms']);
		$apx->tmpl->assign('ALLOWRATING',(int)$_POST['allowrating']);
		$apx->tmpl->assign('RESTRICTED',(int)$_POST['restricted']);
		$apx->tmpl->assign('TOP',(int)$_POST['top']);
		$apx->tmpl->assign('SEARCHABLE',(int)$_POST['searchable']);
		
		$apx->tmpl->parse('add_edit_'.$thistype);
	}
}



//***************************** VIDEOSPIEL *****************************
function add_game() {
	global $set,$db,$apx;
	$thistype='game';
	
	if ( $_POST['send']==2 ) {
		
		//Begriff bereits vorhanden?
		$duplicate = false;
		if ( $_POST['send']==2 && !$_POST['ignore'] ) {
			list($duplicate) = $db->first("SELECT id FROM ".PRE."_products WHERE title LIKE '".addslashes($_POST['title'])."' LIMIT 1");
		}
		
		if ( !checkToken() ) infoInvalidToken();
		elseif ( !$_POST['title'] || !$_POST['text'] ) infoNotComplete();
		elseif ( $duplicate ) {
			info($apx->lang->get('MSG_DUPLICATE'));
			echo '<script type="text/javascript"> parent.document.forms[0].ignore.value = 1; </script>';
		}
		elseif ( !$this->update_pic() ) { /*DO NOTHING*/ }
		elseif ( !$this->update_teaserpic() ) { /*DO NOTHING*/ }
		else {
			
			//Website-URLs clean
			if ( substr($_POST['website'],0,4)=='www.' ) $_POST['website']='http://'.$_POST['website'];
			
			$_POST['type']=$thistype;
			$_POST['addtime']=time();
			$_POST['picture']=$this->picpath;
			$_POST['teaserpic']=$this->teaserpicpath;
			if ( !is_array($_POST['systems']) ) $_POST['systems']=array();
			$_POST['systems']=dash_serialize(array_map('intval', $_POST['systems']));
			$_POST['media']=dash_serialize(array_map('intval', $_POST['media']));
			
			//Freischalten
			if ( $apx->user->has_right('products.enable') && $_POST['pubnow'] ) $_POST['active'] = 1;
			else $_POST['active'] = 0;
			
			$db->dinsert(PRE.'_products','prodid,type,title,text,meta_description,picture,teaserpic,website,manufacturer,publisher,genre,systems,media,sk,requirements,custom1,custom2,custom3,custom4,custom5,custom6,custom7,custom8,custom9,custom10,buylink,price,recprice,guarantee,addtime,allowcoms,allowrating,restricted,top,searchable,active');
			$nid=$db->insert_id();
			logit('PRODUCTS_ADD','ID #'.$nid);
			
			//Inlinescreens
			mediamanager_setinline($nid);
			
			//Release eintragen
			for ( $i=1; $i<=10; $i++ ) {
				if ( !isset($_POST['release'][$i]) ) continue;
				$element=$_POST['release'][$i];
				if ( $element['year'] ) {
					list($reldata,$relstamp,$relsystem)=$this->generate_release($element);
					$db->query("INSERT INTO ".PRE."_products_releases (prodid,system,data,stamp) VALUES ('".$nid."','".$relsystem."','".addslashes(serialize($reldata))."','".$relstamp."')");
				}
			}
			
			//Tags
			$tagids = produceTagIds($_POST['tags']);
			foreach ( $tagids AS $tagid ) {
				$db->query("INSERT IGNORE INTO ".PRE."_products_tags VALUES('".$nid."', '".$tagid."')");
			}
			
			if ( $_REQUEST['updateparent'] ) {
				printJSUpdateObject($_REQUEST['updateparent'], get_product_list($nid));
			}
			else {
				printJSRedirect('action.php?action=products.show&what='.$thistype);
			}
		}
	}
	else {
		$_POST['allowcoms']=1;
		$_POST['allowrating']=1;
		$_POST['searchable']=1;
		$_POST['pubnow']=1;
		$_POST['media'] = array();
		
		//Benutzerdefinierte Felder
		for ( $i=1; $i<=10; $i++ ) {
			$fieldname = $set['products']['custom_'.$thistype][$i-1];
			$apx->tmpl->assign('CUSFIELD'.$i.'_NAME',replace($fieldname));
			$apx->tmpl->assign('CUSTOM'.$i,compatible_hsc($_POST['custom'.$i]));
		}
		
		$apx->tmpl->assign('ACTION','add');
		$apx->tmpl->assign('PRODID',intval($_POST['prodid']));
		$apx->tmpl->assign('TITLE',compatible_hsc($_POST['title']));
		$apx->tmpl->assign('TEXT',compatible_hsc($_POST['text']));
		$apx->tmpl->assign('META_DESCRIPTION',compatible_hsc($_POST['meta_description']));
		$apx->tmpl->assign('PIC_COPY',compatible_hsc($_POST['pic_copy']));
		$apx->tmpl->assign('TEASERPIC_COPY',compatible_hsc($_POST['teaserpic_copy']));
		$apx->tmpl->assign('WEBSITE',compatible_hsc($_POST['website']));
		$apx->tmpl->assign('TAGS',compatible_hsc($_POST['tags']));
		$apx->tmpl->assign('MANUFACTURER',$this->get_units($_POST['manufacturer'], iif($set['products']['filtermanu'], 'company')));
		$apx->tmpl->assign('PUBLISHER',$this->get_units($_POST['publisher'], iif($set['products']['filtermanu'], 'company')));
		$apx->tmpl->assign('GENRELIST',$this->get_genre($thistype,$_POST['genre']));
		$apx->tmpl->assign('MEDIALIST',$this->get_media($thistype,$_POST['media']));
		$apx->tmpl->assign('SYSTEMLIST',$this->get_systems($_POST['systems']));
		$apx->tmpl->assign('SK',$_POST['sk']);
		$apx->tmpl->assign('REQUIREMENTS',compatible_hsc($_POST['requirements']));
		$apx->tmpl->assign('RELEASE',$this->get_release($thistype));
		$apx->tmpl->assign('BUYLINK',compatible_hsc($_POST['buylink']));
		$apx->tmpl->assign('PRICE',compatible_hsc($_POST['price']));
		$apx->tmpl->assign('RECPRICE',compatible_hsc($_POST['recprice']));
		$apx->tmpl->assign('GUARANTEE',compatible_hsc($_POST['guarantee']));
		$apx->tmpl->assign('ALLOWCOMS',(int)$_POST['allowcoms']);
		$apx->tmpl->assign('ALLOWRATING',(int)$_POST['allowrating']);
		$apx->tmpl->assign('RESTRICTED',(int)$_POST['restricted']);
		$apx->tmpl->assign('TOP',(int)$_POST['top']);
		$apx->tmpl->assign('SEARCHABLE',(int)$_POST['searchable']);
		$apx->tmpl->assign('PUBNOW',(int)$_POST['pubnow']);
		$apx->tmpl->assign('UPDATEPARENT',(int)$_POST['updateparent']);
		
		$apx->tmpl->parse('add_edit_'.$thistype);
	}
}



function edit_game($info) {
	global $set,$db,$apx;
	$thistype='game';
	
	//Aktualisieren
	if ( $_POST['send']==2 ) {
		if ( !checkToken() ) infoInvalidToken();
		elseif ( !$_POST['title'] || !$_POST['text'] ) infoNotComplete();
		elseif ( !$this->update_pic() ) { /*DO NOTHING*/ }
		elseif ( !$this->update_teaserpic() ) { /*DO NOTHING*/ }
		else {
			
			//Website-URLs clean
			if ( substr($_POST['website'],0,4)=='www.' ) $_POST['website']='http://'.$_POST['website'];
			
			$_POST['picture']=$this->picpath;
			$_POST['teaserpic']=$this->teaserpicpath;
			if ( !is_array($_POST['systems']) ) $_POST['systems']=array();
			$_POST['systems']=dash_serialize(array_map('intval', $_POST['systems']));
			$_POST['media']=dash_serialize(array_map('intval', $_POST['media']));
			
			$db->dupdate(PRE.'_products','prodid,title,text,meta_description,picture,teaserpic,website,manufacturer,publisher,genre,systems,media,sk,requirements,custom1,custom2,custom3,custom4,custom5,custom6,custom7,custom8,custom9,custom10,buylink,price,recprice,guarantee,allowcoms,allowrating,restricted,top,searchable',"WHERE id='".$_REQUEST['id']."' LIMIT 1");
			logit('PRODUCTS_EDIT','ID #'.$_REQUEST['id']);
			
			//Release eintragen
			$db->query("DELETE FROM ".PRE."_products_releases WHERE prodid='".$_REQUEST['id']."'");
			for ( $i=1; $i<=10; $i++ ) {
				if ( !isset($_POST['release'][$i]) ) continue;
				$element=$_POST['release'][$i];
				if ( $element['year'] ) {
					list($reldata,$relstamp,$relsystem)=$this->generate_release($element);
					$db->query("INSERT INTO ".PRE."_products_releases (prodid,system,data,stamp) VALUES ('".$_REQUEST['id']."','".$relsystem."','".addslashes(serialize($reldata))."','".$relstamp."')");
				}
			}
			
			//Tags
			$db->query("DELETE FROM ".PRE."_products_tags WHERE id='".$_REQUEST['id']."'");
			$tagids = produceTagIds($_POST['tags']);
			foreach ( $tagids AS $tagid ) {
				$db->query("INSERT IGNORE INTO ".PRE."_products_tags VALUES('".$_REQUEST['id']."', '".$tagid."')");
			}
			
			printJSRedirect(get_index('products.show'));
		}
	}
	else {
		//Variablen freigeben
		foreach ( $info AS $key => $value ) {
			$_POST[$key]=$value;
		}
		
		//Systeme
		$_POST['systems']=dash_unserialize($info['systems']);
		if ( !is_array($_POST['systems']) ) $_POST['systems']=array();
		
		//Media
		$_POST['media']=dash_unserialize($info['media']);
		if ( !is_array($_POST['media']) ) $_POST['media']=array();
		
		//Releases auslesen
		$_POST['release']=array();
		$data=$db->fetch("SELECT system,data FROM ".PRE."_products_releases WHERE prodid='".$_REQUEST['id']."' ORDER BY ord ASC");
		if ( count($data) ) {
			$ri=1;
			foreach ( $data AS $res ) {
				$res['data']=unserialize($res['data']);
				if ( is_array($res['data']) ) {
					$_POST['release'][$ri]=$res['data'];
					$_POST['release'][$ri]['system']=$res['system'];
					++$ri;
				}
			}
		}
		
		
		//Benutzerdefinierte Felder
		for ( $i=1; $i<=10; $i++ ) {
			$fieldname = $set['products']['custom_'.$thistype][$i-1];
			$apx->tmpl->assign('CUSFIELD'.$i.'_NAME',replace($fieldname));
			$apx->tmpl->assign('CUSTOM'.$i,compatible_hsc($_POST['custom'.$i]));
		}
		
		//Bild
		$picture = '';
		if ( $info['picture'] ) {
			$picturepath = $info['picture'];
			$poppicpath = str_replace('-thumb.', '.', $picturepath);
			if ( file_exists(BASEDIR.getpath('uploads').$poppicpath) ) {
				$picture = '../'.getpath('uploads').$poppicpath;
			}
			else {
				$picture = '../'.getpath('uploads').$picturepath;
			}
		}
		
		//Bild
		$teaserpic = '';
		if ( $info['teaserpic'] ) {
			$teaserpicpath = $info['teaserpic'];
			$poppicpath = str_replace('-thumb.', '.', $teaserpicpath);
			if ( file_exists(BASEDIR.getpath('uploads').$poppicpath) ) {
				$teaserpic = '../'.getpath('uploads').$poppicpath;
			}
			else {
				$teaserpic = '../'.getpath('uploads').$teaserpicpath;
			}
		}
		
		//Tags
		$tags = array();
		$tagdata = $db->fetch("
			SELECT t.tag
			FROM ".PRE."_products_tags AS n
			LEFT JOIN ".PRE."_tags AS t USING(tagid)
			WHERE n.id='".$_REQUEST['id']."'
			ORDER BY t.tag ASC
		");
		$tags = get_ids($tagdata, 'tag');
		$_POST['tags'] = implode(', ', $tags);
		
		$apx->tmpl->assign('ACTION','edit');
		$apx->tmpl->assign('ID',$_REQUEST['id']);
		$apx->tmpl->assign('PRODID',intval($_POST['prodid']));
		$apx->tmpl->assign('TITLE',compatible_hsc($_POST['title']));
		$apx->tmpl->assign('TEXT',compatible_hsc($_POST['text']));
		$apx->tmpl->assign('META_DESCRIPTION',compatible_hsc($_POST['meta_description']));
		$apx->tmpl->assign('PICTURE',$picture);
		$apx->tmpl->assign('TEASERPIC',$teaserpic);
		$apx->tmpl->assign('PIC_COPY',compatible_hsc($_POST['pic_copy']));
		$apx->tmpl->assign('TEASERPIC_COPY',compatible_hsc($_POST['teaserpic_copy']));
		$apx->tmpl->assign('WEBSITE',compatible_hsc($_POST['website']));
		$apx->tmpl->assign('TAGS',compatible_hsc($_POST['tags']));
		$apx->tmpl->assign('MANUFACTURER',$this->get_units($_POST['manufacturer'], iif($set['products']['filtermanu'], 'company')));
		$apx->tmpl->assign('PUBLISHER',$this->get_units($_POST['publisher'], iif($set['products']['filtermanu'], 'company')));
		$apx->tmpl->assign('GENRELIST',$this->get_genre($thistype,$_POST['genre']));
		$apx->tmpl->assign('MEDIALIST',$this->get_media($thistype,$_POST['media']));
		$apx->tmpl->assign('SYSTEMLIST',$this->get_systems($_POST['systems']));
		$apx->tmpl->assign('SK',$_POST['sk']);
		$apx->tmpl->assign('REQUIREMENTS',compatible_hsc($_POST['requirements']));
		$apx->tmpl->assign('RELEASE',$this->get_release($thistype));
		$apx->tmpl->assign('BUYLINK',compatible_hsc($_POST['buylink']));
		$apx->tmpl->assign('PRICE',compatible_hsc($_POST['price']));
		$apx->tmpl->assign('RECPRICE',compatible_hsc($_POST['recprice']));
		$apx->tmpl->assign('GUARANTEE',compatible_hsc($_POST['guarantee']));
		$apx->tmpl->assign('ALLOWCOMS',(int)$_POST['allowcoms']);
		$apx->tmpl->assign('ALLOWRATING',(int)$_POST['allowrating']);
		$apx->tmpl->assign('RESTRICTED',(int)$_POST['restricted']);
		$apx->tmpl->assign('TOP',(int)$_POST['top']);
		$apx->tmpl->assign('SEARCHABLE',(int)$_POST['searchable']);
		
		$apx->tmpl->parse('add_edit_'.$thistype);
	}
}



//***************************** SOFTWARE *****************************
function add_software() {
	global $set,$db,$apx;
	$thistype='software';
	
	if ( $_POST['send']==2 ) {
		
		//Begriff bereits vorhanden?
		$duplicate = false;
		if ( $_POST['send']==2 && !$_POST['ignore'] ) {
			list($duplicate) = $db->first("SELECT id FROM ".PRE."_products WHERE title LIKE '".addslashes($_POST['title'])."' LIMIT 1");
		}
		
		if ( !checkToken() ) infoInvalidToken();
		elseif ( !$_POST['title'] || !$_POST['text'] ) infoNotComplete();
		elseif ( $duplicate ) {
			info($apx->lang->get('MSG_DUPLICATE'));
			echo '<script type="text/javascript"> parent.document.forms[0].ignore.value = 1; </script>';
		}
		elseif ( !$this->update_pic() ) { /*DO NOTHING*/ }
		elseif ( !$this->update_teaserpic() ) { /*DO NOTHING*/ }
		else {
			
			//Website-URLs clean
			if ( substr($_POST['website'],0,4)=='www.' ) $_POST['website']='http://'.$_POST['website'];
			
			$_POST['type']=$thistype;
			$_POST['addtime']=time();
			$_POST['picture']=$this->picpath;
			$_POST['teaserpic']=$this->teaserpicpath;
			$_POST['media']=dash_serialize(array_map('intval', $_POST['media']));
			
			//Freischalten
			if ( $apx->user->has_right('products.enable') && $_POST['pubnow'] ) $_POST['active'] = 1;
			else $_POST['active'] = 0;
			
			$db->dinsert(PRE.'_products','prodid,type,title,text,meta_description,picture,teaserpic,website,manufacturer,media,requirements,os,languages,license,version,custom1,custom2,custom3,custom4,custom5,custom6,custom7,custom8,custom9,custom10,buylink,price,recprice,guarantee,addtime,allowcoms,allowrating,restricted,top,searchable,active');
			$nid=$db->insert_id();
			logit('PRODUCTS_ADD','ID #'.$nid);
			
			//Inlinescreens
			mediamanager_setinline($nid);
			
			//Release eintragen
			for ( $i=1; $i<=10; $i++ ) {
				if ( !isset($_POST['release'][$i]) ) continue;
				$element=$_POST['release'][$i];
				if ( $element['year'] ) {
					list($reldata,$relstamp,$relsystem)=$this->generate_release($element);
					$db->query("INSERT INTO ".PRE."_products_releases (prodid,system,data,stamp) VALUES ('".$nid."','".$relsystem."','".addslashes(serialize($reldata))."','".$relstamp."')");
				}
			}
			
			//Tags
			$tagids = produceTagIds($_POST['tags']);
			foreach ( $tagids AS $tagid ) {
				$db->query("INSERT IGNORE INTO ".PRE."_products_tags VALUES('".$nid."', '".$tagid."')");
			}
			
			if ( $_REQUEST['updateparent'] ) {
				printJSUpdateObject($_REQUEST['updateparent'], get_product_list($nid));
			}
			else {
				printJSRedirect('action.php?action=products.show&what='.$thistype);
			}
		}
	}
	else {
		$_POST['allowcoms']=1;
		$_POST['allowrating']=1;
		$_POST['searchable']=1;
		$_POST['pubnow']=1;
		$_POST['license'] = 'freeware';
		$_POST['media'] = array();
		
		//Benutzerdefinierte Felder
		for ( $i=1; $i<=10; $i++ ) {
			$fieldname = $set['products']['custom_'.$thistype][$i-1];
			$apx->tmpl->assign('CUSFIELD'.$i.'_NAME',replace($fieldname));
			$apx->tmpl->assign('CUSTOM'.$i,compatible_hsc($_POST['custom'.$i]));
		}
		
		$apx->tmpl->assign('ACTION','add');
		$apx->tmpl->assign('PRODID',intval($_POST['prodid']));
		$apx->tmpl->assign('TITLE',compatible_hsc($_POST['title']));
		$apx->tmpl->assign('TEXT',compatible_hsc($_POST['text']));
		$apx->tmpl->assign('META_DESCRIPTION',compatible_hsc($_POST['meta_description']));
		$apx->tmpl->assign('PIC_COPY',compatible_hsc($_POST['pic_copy']));
		$apx->tmpl->assign('TEASERPIC_COPY',compatible_hsc($_POST['teaserpic_copy']));
		$apx->tmpl->assign('WEBSITE',compatible_hsc($_POST['website']));
		$apx->tmpl->assign('TAGS',compatible_hsc($_POST['tags']));
		$apx->tmpl->assign('MANUFACTURER',$this->get_units($_POST['manufacturer'], iif($set['products']['filtermanu'], 'company')));
		$apx->tmpl->assign('MEDIALIST',$this->get_media($thistype,$_POST['media']));
		$apx->tmpl->assign('REQUIREMENTS',compatible_hsc($_POST['requirements']));
		$apx->tmpl->assign('OS',compatible_hsc($_POST['os']));
		$apx->tmpl->assign('LANGUAGES',compatible_hsc($_POST['languages']));
		$apx->tmpl->assign('LICENSE',compatible_hsc($_POST['license']));
		$apx->tmpl->assign('VERSION',compatible_hsc($_POST['version']));
		$apx->tmpl->assign('RELEASE',$this->get_release($thistype));
		$apx->tmpl->assign('BUYLINK',compatible_hsc($_POST['buylink']));
		$apx->tmpl->assign('PRICE',compatible_hsc($_POST['price']));
		$apx->tmpl->assign('RECPRICE',compatible_hsc($_POST['recprice']));
		$apx->tmpl->assign('GUARANTEE',compatible_hsc($_POST['guarantee']));
		$apx->tmpl->assign('ALLOWCOMS',(int)$_POST['allowcoms']);
		$apx->tmpl->assign('ALLOWRATING',(int)$_POST['allowrating']);
		$apx->tmpl->assign('RESTRICTED',(int)$_POST['restricted']);
		$apx->tmpl->assign('TOP',(int)$_POST['top']);
		$apx->tmpl->assign('SEARCHABLE',(int)$_POST['searchable']);
		$apx->tmpl->assign('PUBNOW',(int)$_POST['pubnow']);
		$apx->tmpl->assign('UPDATEPARENT',(int)$_POST['updateparent']);
		
		$apx->tmpl->parse('add_edit_'.$thistype);
	}
}



function edit_software($info) {
	global $set,$db,$apx;
	$thistype='software';
	
	//Aktualisieren
	if ( $_POST['send']==2 ) {
		if ( !checkToken() ) infoInvalidToken();
		elseif ( !$_POST['title'] || !$_POST['text'] ) infoNotComplete();
		elseif ( !$this->update_pic() ) { /*DO NOTHING*/ }
		elseif ( !$this->update_teaserpic() ) { /*DO NOTHING*/ }
		else {
			
			//Website-URLs clean
			if ( substr($_POST['website'],0,4)=='www.' ) $_POST['website']='http://'.$_POST['website'];
			
			$_POST['picture']=$this->picpath;
			$_POST['teaserpic']=$this->teaserpicpath;
			$_POST['media']=dash_serialize(array_map('intval', $_POST['media']));
			
			$db->dupdate(PRE.'_products','prodid,title,text,meta_description,picture,teaserpic,website,manufacturer,media,requirements,os,languages,license,version,custom1,custom2,custom3,custom4,custom5,custom6,custom7,custom8,custom9,custom10,buylink,price,recprice,guarantee,allowcoms,allowrating,restricted,top,searchable',"WHERE id='".$_REQUEST['id']."' LIMIT 1");
			logit('PRODUCTS_EDIT','ID #'.$_REQUEST['id']);
			
			//Release eintragen
			$db->query("DELETE FROM ".PRE."_products_releases WHERE prodid='".$_REQUEST['id']."'");
			for ( $i=1; $i<=10; $i++ ) {
				if ( !isset($_POST['release'][$i]) ) continue;
				$element=$_POST['release'][$i];
				if ( $element['year'] ) {
					list($reldata,$relstamp,$relsystem)=$this->generate_release($element);
					$db->query("INSERT INTO ".PRE."_products_releases (prodid,system,data,stamp) VALUES ('".$_REQUEST['id']."','".$relsystem."','".addslashes(serialize($reldata))."','".$relstamp."')");
				}
			}
			
			//Tags
			$db->query("DELETE FROM ".PRE."_products_tags WHERE id='".$_REQUEST['id']."'");
			$tagids = produceTagIds($_POST['tags']);
			foreach ( $tagids AS $tagid ) {
				$db->query("INSERT IGNORE INTO ".PRE."_products_tags VALUES('".$_REQUEST['id']."', '".$tagid."')");
			}
			
			printJSRedirect(get_index('products.show'));
		}
	}
	else {
		//Variablen freigeben
		foreach ( $info AS $key => $value ) {
			$_POST[$key]=$value;
		}
		
		//Media
		$_POST['media']=dash_unserialize($info['media']);
		if ( !is_array($_POST['media']) ) $_POST['media']=array();
		
		//Releases auslesen
		$_POST['release']=array();
		$data=$db->fetch("SELECT system,data FROM ".PRE."_products_releases WHERE prodid='".$_REQUEST['id']."' ORDER BY ord ASC");
		if ( count($data) ) {
			$ri=1;
			foreach ( $data AS $res ) {
				$res['data']=unserialize($res['data']);
				if ( is_array($res['data']) ) {
					$_POST['release'][$ri]=$res['data'];
					$_POST['release'][$ri]['system']=$res['system'];
					++$ri;
				}
			}
		}
		
		
		//Benutzerdefinierte Felder
		for ( $i=1; $i<=10; $i++ ) {
			$fieldname = $set['products']['custom_'.$thistype][$i-1];
			$apx->tmpl->assign('CUSFIELD'.$i.'_NAME',replace($fieldname));
			$apx->tmpl->assign('CUSTOM'.$i,compatible_hsc($_POST['custom'.$i]));
		}
		
		//Bild
		$picture = '';
		if ( $info['picture'] ) {
			$picturepath = $info['picture'];
			$poppicpath = str_replace('-thumb.', '.', $picturepath);
			if ( file_exists(BASEDIR.getpath('uploads').$poppicpath) ) {
				$picture = '../'.getpath('uploads').$poppicpath;
			}
			else {
				$picture = '../'.getpath('uploads').$picturepath;
			}
		}
		
		//Bild
		$teaserpic = '';
		if ( $info['teaserpic'] ) {
			$teaserpicpath = $info['teaserpic'];
			$poppicpath = str_replace('-thumb.', '.', $teaserpicpath);
			if ( file_exists(BASEDIR.getpath('uploads').$poppicpath) ) {
				$teaserpic = '../'.getpath('uploads').$poppicpath;
			}
			else {
				$teaserpic = '../'.getpath('uploads').$teaserpicpath;
			}
		}
		
		//Tags
		$tags = array();
		$tagdata = $db->fetch("
			SELECT t.tag
			FROM ".PRE."_products_tags AS n
			LEFT JOIN ".PRE."_tags AS t USING(tagid)
			WHERE n.id='".$_REQUEST['id']."'
			ORDER BY t.tag ASC
		");
		$tags = get_ids($tagdata, 'tag');
		$_POST['tags'] = implode(', ', $tags);
		
		$apx->tmpl->assign('ACTION','edit');
		$apx->tmpl->assign('ID',$_REQUEST['id']);
		$apx->tmpl->assign('PRODID',intval($_POST['prodid']));
		$apx->tmpl->assign('TITLE',compatible_hsc($_POST['title']));
		$apx->tmpl->assign('TEXT',compatible_hsc($_POST['text']));
		$apx->tmpl->assign('META_DESCRIPTION',compatible_hsc($_POST['meta_description']));
		$apx->tmpl->assign('PICTURE',$picture);
		$apx->tmpl->assign('TEASERPIC',$teaserpic);
		$apx->tmpl->assign('PIC_COPY',compatible_hsc($_POST['pic_copy']));
		$apx->tmpl->assign('TEASERPIC_COPY',compatible_hsc($_POST['teaserpic_copy']));
		$apx->tmpl->assign('WEBSITE',compatible_hsc($_POST['website']));
		$apx->tmpl->assign('TAGS',compatible_hsc($_POST['tags']));
		$apx->tmpl->assign('MANUFACTURER',$this->get_units($_POST['manufacturer'], iif($set['products']['filtermanu'], 'company')));
		$apx->tmpl->assign('MEDIALIST',$this->get_media($thistype,$_POST['media']));
		$apx->tmpl->assign('REQUIREMENTS',compatible_hsc($_POST['requirements']));
		$apx->tmpl->assign('OS',compatible_hsc($_POST['os']));
		$apx->tmpl->assign('LANGUAGES',compatible_hsc($_POST['languages']));
		$apx->tmpl->assign('LICENSE',compatible_hsc($_POST['license']));
		$apx->tmpl->assign('VERSION',compatible_hsc($_POST['version']));
		$apx->tmpl->assign('RELEASE',$this->get_release($thistype));
		$apx->tmpl->assign('BUYLINK',compatible_hsc($_POST['buylink']));
		$apx->tmpl->assign('PRICE',compatible_hsc($_POST['price']));
		$apx->tmpl->assign('RECPRICE',compatible_hsc($_POST['recprice']));
		$apx->tmpl->assign('GUARANTEE',compatible_hsc($_POST['guarantee']));
		$apx->tmpl->assign('ALLOWCOMS',(int)$_POST['allowcoms']);
		$apx->tmpl->assign('ALLOWRATING',(int)$_POST['allowrating']);
		$apx->tmpl->assign('RESTRICTED',(int)$_POST['restricted']);
		$apx->tmpl->assign('TOP',(int)$_POST['top']);
		$apx->tmpl->assign('SEARCHABLE',(int)$_POST['searchable']);
		
		$apx->tmpl->parse('add_edit_'.$thistype);
	}
}



//***************************** HARDWARE *****************************
function add_hardware() {
	global $set,$db,$apx;
	$thistype='hardware';
	
	if ( $_POST['send']==2 ) {
		
		//Begriff bereits vorhanden?
		$duplicate = false;
		if ( $_POST['send']==2 && !$_POST['ignore'] ) {
			list($duplicate) = $db->first("SELECT id FROM ".PRE."_products WHERE title LIKE '".addslashes($_POST['title'])."' LIMIT 1");
		}
		
		if ( !checkToken() ) infoInvalidToken();
		elseif ( !$_POST['title'] || !$_POST['text'] ) infoNotComplete();
		elseif ( $duplicate ) {
			info($apx->lang->get('MSG_DUPLICATE'));
			echo '<script type="text/javascript"> parent.document.forms[0].ignore.value = 1; </script>';
		}
		elseif ( !$this->update_pic() ) { /*DO NOTHING*/ }
		elseif ( !$this->update_teaserpic() ) { /*DO NOTHING*/ }
		else {
			
			//Website-URLs clean
			if ( substr($_POST['website'],0,4)=='www.' ) $_POST['website']='http://'.$_POST['website'];
			
			$_POST['type']=$thistype;
			$_POST['addtime']=time();
			$_POST['picture']=$this->picpath;
			$_POST['teaserpic']=$this->teaserpicpath;
			
			//Freischalten
			if ( $apx->user->has_right('products.enable') && $_POST['pubnow'] ) $_POST['active'] = 1;
			else $_POST['active'] = 0;
			
			$db->dinsert(PRE.'_products','prodid,type,title,text,meta_description,picture,teaserpic,website,manufacturer,equipment,custom1,custom2,custom3,custom4,custom5,custom6,custom7,custom8,custom9,custom10,buylink,price,recprice,guarantee,addtime,allowcoms,allowrating,restricted,top,searchable,active');
			$nid=$db->insert_id();
			logit('PRODUCTS_ADD','ID #'.$nid);
			
			//Inlinescreens
			mediamanager_setinline($nid);
			
			//Release eintragen
			$element=$_POST['release'];
			if ( $element['year'] ) {
				list($reldata,$relstamp)=$this->generate_release($element);
				$db->query("INSERT INTO ".PRE."_products_releases (prodid,data,stamp) VALUES ('".$nid."','".addslashes(serialize($reldata))."','".$relstamp."')");
			}
			
			//Tags
			$tagids = produceTagIds($_POST['tags']);
			foreach ( $tagids AS $tagid ) {
				$db->query("INSERT IGNORE INTO ".PRE."_products_tags VALUES('".$nid."', '".$tagid."')");
			}
			
			if ( $_REQUEST['updateparent'] ) {
				printJSUpdateObject($_REQUEST['updateparent'], get_product_list($nid));
			}
			else {
				printJSRedirect('action.php?action=products.show&what='.$thistype);
			}
		}
	}
	else {
		$_POST['allowcoms']=1;
		$_POST['allowrating']=1;
		$_POST['searchable']=1;
		$_POST['pubnow']=1;
		
		
		//Benutzerdefinierte Felder
		for ( $i=1; $i<=10; $i++ ) {
			$fieldname = $set['products']['custom_'.$thistype][$i-1];
			$apx->tmpl->assign('CUSFIELD'.$i.'_NAME',replace($fieldname));
			$apx->tmpl->assign('CUSTOM'.$i,compatible_hsc($_POST['custom'.$i]));
		}
		
		$apx->tmpl->assign('ACTION','add');
		$apx->tmpl->assign('PRODID',intval($_POST['prodid']));
		$apx->tmpl->assign('TITLE',compatible_hsc($_POST['title']));
		$apx->tmpl->assign('TEXT',compatible_hsc($_POST['text']));
		$apx->tmpl->assign('META_DESCRIPTION',compatible_hsc($_POST['meta_description']));
		$apx->tmpl->assign('PIC_COPY',compatible_hsc($_POST['pic_copy']));
		$apx->tmpl->assign('TEASERPIC_COPY',compatible_hsc($_POST['teaserpic_copy']));
		$apx->tmpl->assign('WEBSITE',compatible_hsc($_POST['website']));
		$apx->tmpl->assign('TAGS',compatible_hsc($_POST['tags']));
		$apx->tmpl->assign('MANUFACTURER',$this->get_units($_POST['manufacturer'], iif($set['products']['filtermanu'], 'company')));
		$apx->tmpl->assign('EQUIPMENT',compatible_hsc($_POST['equipment']));
		$apx->tmpl->assign('RELEASE_QUATER',(int)$_POST['release']['quater']);
		$apx->tmpl->assign('RELEASE_DAY',(int)$_POST['release']['day']);
		$apx->tmpl->assign('RELEASE_MONTH',(int)$_POST['release']['month']);
		$apx->tmpl->assign('RELEASE_YEAR',(int)$_POST['release']['year']);
		$apx->tmpl->assign('BUYLINK',compatible_hsc($_POST['buylink']));
		$apx->tmpl->assign('PRICE',compatible_hsc($_POST['price']));
		$apx->tmpl->assign('RECPRICE',compatible_hsc($_POST['recprice']));
		$apx->tmpl->assign('GUARANTEE',compatible_hsc($_POST['guarantee']));
		$apx->tmpl->assign('ALLOWCOMS',(int)$_POST['allowcoms']);
		$apx->tmpl->assign('ALLOWRATING',(int)$_POST['allowrating']);
		$apx->tmpl->assign('RESTRICTED',(int)$_POST['restricted']);
		$apx->tmpl->assign('TOP',(int)$_POST['top']);
		$apx->tmpl->assign('SEARCHABLE',(int)$_POST['searchable']);
		$apx->tmpl->assign('PUBNOW',(int)$_POST['pubnow']);
		$apx->tmpl->assign('UPDATEPARENT',(int)$_POST['updateparent']);
		
		$apx->tmpl->parse('add_edit_'.$thistype);
	}
}



function edit_hardware($info) {
	global $set,$db,$apx;
	$thistype='hardware';
	
	//Aktualisieren
	if ( $_POST['send']==2 ) {
		if ( !checkToken() ) infoInvalidToken();
		elseif ( !$_POST['title'] || !$_POST['text'] ) infoNotComplete();
		elseif ( !$this->update_pic() ) { /*DO NOTHING*/ }
		elseif ( !$this->update_teaserpic() ) { /*DO NOTHING*/ }
		else {
			
			//Website-URLs clean
			if ( substr($_POST['website'],0,4)=='www.' ) $_POST['website']='http://'.$_POST['website'];
			
			$_POST['picture']=$this->picpath;
			$_POST['teaserpic']=$this->teaserpicpath;
			
			$db->dupdate(PRE.'_products','prodid,title,text,meta_description,picture,teaserpic,website,manufacturer,equipment,custom1,custom2,custom3,custom4,custom5,custom6,custom7,custom8,custom9,custom10,buylink,price,recprice,guarantee,allowcoms,allowrating,restricted,top,searchable',"WHERE id='".$_REQUEST['id']."' LIMIT 1");
			logit('PRODUCTS_EDIT','ID #'.$_REQUEST['id']);
			
			//Release eintragen
			$db->query("DELETE FROM ".PRE."_products_releases WHERE prodid='".$_REQUEST['id']."'");
			$element=$_POST['release'];
			if ( $element['year'] ) {
				list($reldata,$relstamp)=$this->generate_release($element);
				$db->query("INSERT INTO ".PRE."_products_releases (prodid,data,stamp) VALUES ('".$_REQUEST['id']."','".addslashes(serialize($reldata))."','".$relstamp."')");
			}
			
			//Tags
			$db->query("DELETE FROM ".PRE."_products_tags WHERE id='".$_REQUEST['id']."'");
			$tagids = produceTagIds($_POST['tags']);
			foreach ( $tagids AS $tagid ) {
				$db->query("INSERT IGNORE INTO ".PRE."_products_tags VALUES('".$_REQUEST['id']."', '".$tagid."')");
			}
			
			printJSRedirect(get_index('products.show'));
		}
	}
	else {
		//Variablen freigeben
		foreach ( $info AS $key => $value ) {
			$_POST[$key]=$value;
		}
		
		//Releases auslesen
		$_POST['release']=array();
		list($res)=$db->first("SELECT data FROM ".PRE."_products_releases WHERE prodid='".$_REQUEST['id']."' LIMIT 1");
		$res=unserialize($res);
		if ( is_array($res) ) {
			$_POST['release']=$res;
		}
		
		
		//Benutzerdefinierte Felder
		for ( $i=1; $i<=10; $i++ ) {
			$fieldname = $set['products']['custom_'.$thistype][$i-1];
			$apx->tmpl->assign('CUSFIELD'.$i.'_NAME',replace($fieldname));
			$apx->tmpl->assign('CUSTOM'.$i,compatible_hsc($_POST['custom'.$i]));
		}
		
		//Bild
		$picture = '';
		if ( $info['picture'] ) {
			$picturepath = $info['picture'];
			$poppicpath = str_replace('-thumb.', '.', $picturepath);
			if ( file_exists(BASEDIR.getpath('uploads').$poppicpath) ) {
				$picture = '../'.getpath('uploads').$poppicpath;
			}
			else {
				$picture = '../'.getpath('uploads').$picturepath;
			}
		}
		
		//Bild
		$teaserpic = '';
		if ( $info['teaserpic'] ) {
			$teaserpicpath = $info['teaserpic'];
			$poppicpath = str_replace('-thumb.', '.', $teaserpicpath);
			if ( file_exists(BASEDIR.getpath('uploads').$poppicpath) ) {
				$teaserpic = '../'.getpath('uploads').$poppicpath;
			}
			else {
				$teaserpic = '../'.getpath('uploads').$teaserpicpath;
			}
		}
		
		//Tags
		$tags = array();
		$tagdata = $db->fetch("
			SELECT t.tag
			FROM ".PRE."_products_tags AS n
			LEFT JOIN ".PRE."_tags AS t USING(tagid)
			WHERE n.id='".$_REQUEST['id']."'
			ORDER BY t.tag ASC
		");
		$tags = get_ids($tagdata, 'tag');
		$_POST['tags'] = implode(', ', $tags);
		
		$apx->tmpl->assign('ACTION','edit');
		$apx->tmpl->assign('ID',$_REQUEST['id']);
		$apx->tmpl->assign('PRODID',intval($_POST['prodid']));
		$apx->tmpl->assign('TITLE',compatible_hsc($_POST['title']));
		$apx->tmpl->assign('TEXT',compatible_hsc($_POST['text']));
		$apx->tmpl->assign('META_DESCRIPTION',compatible_hsc($_POST['meta_description']));
		$apx->tmpl->assign('PICTURE',$picture);
		$apx->tmpl->assign('TEASERPIC',$teaserpic);
		$apx->tmpl->assign('PIC_COPY',compatible_hsc($_POST['pic_copy']));
		$apx->tmpl->assign('TEASERPIC_COPY',compatible_hsc($_POST['teaserpic_copy']));
		$apx->tmpl->assign('WEBSITE',compatible_hsc($_POST['website']));
		$apx->tmpl->assign('TAGS',compatible_hsc($_POST['tags']));
		$apx->tmpl->assign('MANUFACTURER',$this->get_units($_POST['manufacturer'], iif($set['products']['filtermanu'], 'company')));
		$apx->tmpl->assign('EQUIPMENT',compatible_hsc($_POST['equipment']));
		$apx->tmpl->assign('RELEASE_QUATER',(int)$_POST['release']['quater']);
		$apx->tmpl->assign('RELEASE_DAY',(int)$_POST['release']['day']);
		$apx->tmpl->assign('RELEASE_MONTH',(int)$_POST['release']['month']);
		$apx->tmpl->assign('RELEASE_YEAR',(int)$_POST['release']['year']);
		$apx->tmpl->assign('BUYLINK',compatible_hsc($_POST['buylink']));
		$apx->tmpl->assign('PRICE',compatible_hsc($_POST['price']));
		$apx->tmpl->assign('RECPRICE',compatible_hsc($_POST['recprice']));
		$apx->tmpl->assign('GUARANTEE',compatible_hsc($_POST['guarantee']));
		$apx->tmpl->assign('ALLOWCOMS',(int)$_POST['allowcoms']);
		$apx->tmpl->assign('ALLOWRATING',(int)$_POST['allowrating']);
		$apx->tmpl->assign('RESTRICTED',(int)$_POST['restricted']);
		$apx->tmpl->assign('TOP',(int)$_POST['top']);
		$apx->tmpl->assign('SEARCHABLE',(int)$_POST['searchable']);
		
		$apx->tmpl->parse('add_edit_'.$thistype);
	}
}



//***************************** MUSIK *****************************
function add_music() {
	global $set,$db,$apx;
	$thistype='music';
	
	if ( $_POST['send']==2 ) {
		
		//Begriff bereits vorhanden?
		$duplicate = false;
		if ( $_POST['send']==2 && !$_POST['ignore'] ) {
			list($duplicate) = $db->first("SELECT id FROM ".PRE."_products WHERE title LIKE '".addslashes($_POST['title'])."' LIMIT 1");
		}
		
		if ( !checkToken() ) infoInvalidToken();
		elseif ( !$_POST['title'] || !$_POST['text'] ) infoNotComplete();
		elseif ( $duplicate ) {
			info($apx->lang->get('MSG_DUPLICATE'));
			echo '<script type="text/javascript"> parent.document.forms[0].ignore.value = 1; </script>';
		}
		elseif ( !$this->update_pic() ) { /*DO NOTHING*/ }
		elseif ( !$this->update_teaserpic() ) { /*DO NOTHING*/ }
		else {
			
			//Website-URLs clean
			if ( substr($_POST['website'],0,4)=='www.' ) $_POST['website']='http://'.$_POST['website'];
			
			$_POST['type']=$thistype;
			$_POST['addtime']=time();
			$_POST['picture']=$this->picpath;
			$_POST['teaserpic']=$this->teaserpicpath;
			$_POST['media']=dash_serialize(array_map('intval', $_POST['media']));
			
			//Freischalten
			if ( $apx->user->has_right('products.enable') && $_POST['pubnow'] ) $_POST['active'] = 1;
			else $_POST['active'] = 0;
			
			$db->dinsert(PRE.'_products','prodid,type,title,text,meta_description,picture,teaserpic,website,manufacturer,publisher,sk,genre,media,custom1,custom2,custom3,custom4,custom5,custom6,custom7,custom8,custom9,custom10,buylink,price,recprice,guarantee,addtime,allowcoms,allowrating,restricted,top,searchable,active');
			$nid=$db->insert_id();
			logit('PRODUCTS_ADD','ID #'.$nid);
			
			//Inlinescreens
			mediamanager_setinline($nid);
			
			//Release eintragen
			for ( $i=1; $i<=10; $i++ ) {
				if ( !isset($_POST['release'][$i]) ) continue;
				$element=$_POST['release'][$i];
				if ( $element['year'] ) {
					list($reldata,$relstamp,$relsystem)=$this->generate_release($element);
					$db->query("INSERT INTO ".PRE."_products_releases (prodid,system,data,stamp) VALUES ('".$nid."','".$relsystem."','".addslashes(serialize($reldata))."','".$relstamp."')");
				}
			}
			
			//Tags
			$tagids = produceTagIds($_POST['tags']);
			foreach ( $tagids AS $tagid ) {
				$db->query("INSERT IGNORE INTO ".PRE."_products_tags VALUES('".$nid."', '".$tagid."')");
			}
			
			if ( $_REQUEST['updateparent'] ) {
				printJSUpdateObject($_REQUEST['updateparent'], get_product_list($nid));
			}
			else {
				printJSRedirect('action.php?action=products.show&what='.$thistype);
			}
		}
	}
	else {
		$_POST['allowcoms']=1;
		$_POST['allowrating']=1;
		$_POST['searchable']=1;
		$_POST['pubnow']=1;
		$_POST['media'] = array();
		
		//Benutzerdefinierte Felder
		for ( $i=1; $i<=10; $i++ ) {
			$fieldname = $set['products']['custom_'.$thistype][$i-1];
			$apx->tmpl->assign('CUSFIELD'.$i.'_NAME',replace($fieldname));
			$apx->tmpl->assign('CUSTOM'.$i,compatible_hsc($_POST['custom'.$i]));
		}
		
		$apx->tmpl->assign('ACTION','add');
		$apx->tmpl->assign('PRODID',intval($_POST['prodid']));
		$apx->tmpl->assign('TITLE',compatible_hsc($_POST['title']));
		$apx->tmpl->assign('TEXT',compatible_hsc($_POST['text']));
		$apx->tmpl->assign('META_DESCRIPTION',compatible_hsc($_POST['meta_description']));
		$apx->tmpl->assign('PIC_COPY',compatible_hsc($_POST['pic_copy']));
		$apx->tmpl->assign('TEASERPIC_COPY',compatible_hsc($_POST['teaserpic_copy']));
		$apx->tmpl->assign('WEBSITE',compatible_hsc($_POST['website']));
		$apx->tmpl->assign('TAGS',compatible_hsc($_POST['tags']));
		$apx->tmpl->assign('MANUFACTURER',$this->get_units($_POST['manufacturer'], iif($set['products']['filtermanu'], 'person')));
		$apx->tmpl->assign('PUBLISHER',$this->get_units($_POST['publisher'], iif($set['products']['filtermanu'], 'company')));
		$apx->tmpl->assign('GENRELIST',$this->get_genre($thistype,$_POST['genre']));
		$apx->tmpl->assign('MEDIALIST',$this->get_media($thistype,$_POST['media']));
		$apx->tmpl->assign('SK',$_POST['sk']);
		$apx->tmpl->assign('RELEASE',$this->get_release($thistype));
		$apx->tmpl->assign('BUYLINK',compatible_hsc($_POST['buylink']));
		$apx->tmpl->assign('PRICE',compatible_hsc($_POST['price']));
		$apx->tmpl->assign('RECPRICE',compatible_hsc($_POST['recprice']));
		$apx->tmpl->assign('GUARANTEE',compatible_hsc($_POST['guarantee']));
		$apx->tmpl->assign('ALLOWCOMS',(int)$_POST['allowcoms']);
		$apx->tmpl->assign('ALLOWRATING',(int)$_POST['allowrating']);
		$apx->tmpl->assign('RESTRICTED',(int)$_POST['restricted']);
		$apx->tmpl->assign('TOP',(int)$_POST['top']);
		$apx->tmpl->assign('SEARCHABLE',(int)$_POST['searchable']);
		$apx->tmpl->assign('PUBNOW',(int)$_POST['pubnow']);
		$apx->tmpl->assign('UPDATEPARENT',(int)$_POST['updateparent']);
		
		$apx->tmpl->parse('add_edit_'.$thistype);
	}
}



function edit_music($info) {
	global $set,$db,$apx;
	$thistype='music';
	
	//Aktualisieren
	if ( $_POST['send']==2 ) {
		if ( !checkToken() ) infoInvalidToken();
		elseif ( !$_POST['title'] || !$_POST['text'] ) infoNotComplete();
		elseif ( !$this->update_pic() ) { /*DO NOTHING*/ }
		elseif ( !$this->update_teaserpic() ) { /*DO NOTHING*/ }
		else {
			
			//Website-URLs clean
			if ( substr($_POST['website'],0,4)=='www.' ) $_POST['website']='http://'.$_POST['website'];
			
			$_POST['picture']=$this->picpath;
			$_POST['teaserpic']=$this->teaserpicpath;
			$_POST['media']=dash_serialize(array_map('intval', $_POST['media']));
			
			$db->dupdate(PRE.'_products','prodid,title,text,meta_description,picture,teaserpic,website,manufacturer,publisher,sk,genre,media,custom1,custom2,custom3,custom4,custom5,custom6,custom7,custom8,custom9,custom10,buylink,price,recprice,guarantee,allowcoms,allowrating,restricted,top,searchable',"WHERE id='".$_REQUEST['id']."' LIMIT 1");
			logit('PRODUCTS_EDIT','ID #'.$_REQUEST['id']);
			
			//Release eintragen
			$db->query("DELETE FROM ".PRE."_products_releases WHERE prodid='".$_REQUEST['id']."'");
			for ( $i=1; $i<=10; $i++ ) {
				if ( !isset($_POST['release'][$i]) ) continue;
				$element=$_POST['release'][$i];
				if ( $element['year'] ) {
					list($reldata,$relstamp,$relsystem)=$this->generate_release($element);
					$db->query("INSERT INTO ".PRE."_products_releases (prodid,system,data,stamp) VALUES ('".$_REQUEST['id']."','".$relsystem."','".addslashes(serialize($reldata))."','".$relstamp."')");
				}
			}
			
			//Tags
			$db->query("DELETE FROM ".PRE."_products_tags WHERE id='".$_REQUEST['id']."'");
			$tagids = produceTagIds($_POST['tags']);
			foreach ( $tagids AS $tagid ) {
				$db->query("INSERT IGNORE INTO ".PRE."_products_tags VALUES('".$_REQUEST['id']."', '".$tagid."')");
			}
			
			printJSRedirect(get_index('products.show'));
		}
	}
	else {
		//Variablen freigeben
		foreach ( $info AS $key => $value ) {
			$_POST[$key]=$value;
		}
		
		//Media
		$_POST['media']=dash_unserialize($info['media']);
		if ( !is_array($_POST['media']) ) $_POST['media']=array();
		
		//Releases auslesen
		$_POST['release']=array();
		$data=$db->fetch("SELECT system,data FROM ".PRE."_products_releases WHERE prodid='".$_REQUEST['id']."' ORDER BY ord ASC");
		if ( count($data) ) {
			$ri=1;
			foreach ( $data AS $res ) {
				$res['data']=unserialize($res['data']);
				if ( is_array($res['data']) ) {
					$_POST['release'][$ri]=$res['data'];
					$_POST['release'][$ri]['system']=$res['system'];
					++$ri;
				}
			}
		}
		
		
		//Benutzerdefinierte Felder
		for ( $i=1; $i<=10; $i++ ) {
			$fieldname = $set['products']['custom_'.$thistype][$i-1];
			$apx->tmpl->assign('CUSFIELD'.$i.'_NAME',replace($fieldname));
			$apx->tmpl->assign('CUSTOM'.$i,compatible_hsc($_POST['custom'.$i]));
		}
		
		//Bild
		$picture = '';
		if ( $info['picture'] ) {
			$picturepath = $info['picture'];
			$poppicpath = str_replace('-thumb.', '.', $picturepath);
			if ( file_exists(BASEDIR.getpath('uploads').$poppicpath) ) {
				$picture = '../'.getpath('uploads').$poppicpath;
			}
			else {
				$picture = '../'.getpath('uploads').$picturepath;
			}
		}
		
		//Bild
		$teaserpic = '';
		if ( $info['teaserpic'] ) {
			$teaserpicpath = $info['teaserpic'];
			$poppicpath = str_replace('-thumb.', '.', $teaserpicpath);
			if ( file_exists(BASEDIR.getpath('uploads').$poppicpath) ) {
				$teaserpic = '../'.getpath('uploads').$poppicpath;
			}
			else {
				$teaserpic = '../'.getpath('uploads').$teaserpicpath;
			}
		}
		
		//Tags
		$tags = array();
		$tagdata = $db->fetch("
			SELECT t.tag
			FROM ".PRE."_products_tags AS n
			LEFT JOIN ".PRE."_tags AS t USING(tagid)
			WHERE n.id='".$_REQUEST['id']."'
			ORDER BY t.tag ASC
		");
		$tags = get_ids($tagdata, 'tag');
		$_POST['tags'] = implode(', ', $tags);
		
		$apx->tmpl->assign('ACTION','edit');
		$apx->tmpl->assign('ID',$_REQUEST['id']);
		$apx->tmpl->assign('PRODID',intval($_POST['prodid']));
		$apx->tmpl->assign('TITLE',compatible_hsc($_POST['title']));
		$apx->tmpl->assign('TEXT',compatible_hsc($_POST['text']));
		$apx->tmpl->assign('META_DESCRIPTION',compatible_hsc($_POST['meta_description']));
		$apx->tmpl->assign('PICTURE',$picture);
		$apx->tmpl->assign('TEASERPIC',$teaserpic);
		$apx->tmpl->assign('PIC_COPY',compatible_hsc($_POST['pic_copy']));
		$apx->tmpl->assign('TEASERPIC_COPY',compatible_hsc($_POST['teaserpic_copy']));
		$apx->tmpl->assign('WEBSITE',compatible_hsc($_POST['website']));
		$apx->tmpl->assign('TAGS',compatible_hsc($_POST['tags']));
		$apx->tmpl->assign('MANUFACTURER',$this->get_units($_POST['manufacturer'], iif($set['products']['filtermanu'], 'person')));
		$apx->tmpl->assign('PUBLISHER',$this->get_units($_POST['publisher'], iif($set['products']['filtermanu'], 'company')));
		$apx->tmpl->assign('ISBN',compatible_hsc($_POST['isbn']));
		$apx->tmpl->assign('GENRELIST',$this->get_genre($thistype,$_POST['genre']));
		$apx->tmpl->assign('MEDIALIST',$this->get_media($thistype,$_POST['media']));
		$apx->tmpl->assign('SK',$_POST['sk']);
		$apx->tmpl->assign('RELEASE',$this->get_release($thistype));
		$apx->tmpl->assign('BUYLINK',compatible_hsc($_POST['buylink']));
		$apx->tmpl->assign('PRICE',compatible_hsc($_POST['price']));
		$apx->tmpl->assign('RECPRICE',compatible_hsc($_POST['recprice']));
		$apx->tmpl->assign('GUARANTEE',compatible_hsc($_POST['guarantee']));
		$apx->tmpl->assign('ALLOWCOMS',(int)$_POST['allowcoms']);
		$apx->tmpl->assign('ALLOWRATING',(int)$_POST['allowrating']);
		$apx->tmpl->assign('RESTRICTED',(int)$_POST['restricted']);
		$apx->tmpl->assign('TOP',(int)$_POST['top']);
		$apx->tmpl->assign('SEARCHABLE',(int)$_POST['searchable']);
		
		$apx->tmpl->parse('add_edit_'.$thistype);
	}
}



//***************************** FILM *****************************
function add_movie() {
	global $set,$db,$apx;
	$thistype='movie';
	
	if ( $_POST['send']==2 ) {
		
		//Begriff bereits vorhanden?
		$duplicate = false;
		if ( $_POST['send']==2 && !$_POST['ignore'] ) {
			list($duplicate) = $db->first("SELECT id FROM ".PRE."_products WHERE title LIKE '".addslashes($_POST['title'])."' LIMIT 1");
		}
		
		if ( !checkToken() ) infoInvalidToken();
		elseif ( !$_POST['title'] || !$_POST['text'] ) infoNotComplete();
		elseif ( $duplicate ) {
			info($apx->lang->get('MSG_DUPLICATE'));
			echo '<script type="text/javascript"> parent.document.forms[0].ignore.value = 1; </script>';
		}
		elseif ( !$this->update_pic() ) { /*DO NOTHING*/ }
		elseif ( !$this->update_teaserpic() ) { /*DO NOTHING*/ }
		else {
			
			//Website-URLs clean
			if ( substr($_POST['website'],0,4)=='www.' ) $_POST['website']='http://'.$_POST['website'];
			
			$_POST['type']=$thistype;
			$_POST['addtime']=time();
			$_POST['picture']=$this->picpath;
			$_POST['teaserpic']=$this->teaserpicpath;
			$_POST['media']=dash_serialize(array_map('intval', $_POST['media']));
			
			//Freischalten
			if ( $apx->user->has_right('products.enable') && $_POST['pubnow'] ) $_POST['active'] = 1;
			else $_POST['active'] = 0;
			
			$db->dinsert(PRE.'_products','prodid,type,title,text,meta_description,picture,teaserpic,website,regisseur,actors,publisher,sk,genre,media,length,custom1,custom2,custom3,custom4,custom5,custom6,custom7,custom8,custom9,custom10,buylink,price,recprice,guarantee,addtime,allowcoms,allowrating,restricted,top,searchable,active');
			$nid=$db->insert_id();
			logit('PRODUCTS_ADD','ID #'.$nid);
			
			//Inlinescreens
			mediamanager_setinline($nid);
			
			//Release eintragen
			for ( $i=1; $i<=10; $i++ ) {
				if ( !isset($_POST['release'][$i]) ) continue;
				$element=$_POST['release'][$i];
				if ( $element['year'] ) {
					list($reldata,$relstamp,$relsystem)=$this->generate_release($element);
					$db->query("INSERT INTO ".PRE."_products_releases (prodid,system,data,stamp) VALUES ('".$nid."','".$relsystem."','".addslashes(serialize($reldata))."','".$relstamp."')");
				}
			}
			
			//Tags
			$tagids = produceTagIds($_POST['tags']);
			foreach ( $tagids AS $tagid ) {
				$db->query("INSERT IGNORE INTO ".PRE."_products_tags VALUES('".$nid."', '".$tagid."')");
			}
			
			if ( $_REQUEST['updateparent'] ) {
				printJSUpdateObject($_REQUEST['updateparent'], get_product_list($nid));
			}
			else {
				printJSRedirect('action.php?action=products.show&what='.$thistype);
			}
		}
	}
	else {
		$_POST['allowcoms']=1;
		$_POST['allowrating']=1;
		$_POST['searchable']=1;
		$_POST['pubnow']=1;
		$_POST['media'] = array();
		
		//Benutzerdefinierte Felder
		for ( $i=1; $i<=10; $i++ ) {
			$fieldname = $set['products']['custom_'.$thistype][$i-1];
			$apx->tmpl->assign('CUSFIELD'.$i.'_NAME',replace($fieldname));
			$apx->tmpl->assign('CUSTOM'.$i,compatible_hsc($_POST['custom'.$i]));
		}
		
		$apx->tmpl->assign('ACTION','add');
		$apx->tmpl->assign('PRODID',intval($_POST['prodid']));
		$apx->tmpl->assign('TITLE',compatible_hsc($_POST['title']));
		$apx->tmpl->assign('TEXT',compatible_hsc($_POST['text']));
		$apx->tmpl->assign('META_DESCRIPTION',compatible_hsc($_POST['meta_description']));
		$apx->tmpl->assign('PIC_COPY',compatible_hsc($_POST['pic_copy']));
		$apx->tmpl->assign('TEASERPIC_COPY',compatible_hsc($_POST['teaserpic_copy']));
		$apx->tmpl->assign('WEBSITE',compatible_hsc($_POST['website']));
		$apx->tmpl->assign('TAGS',compatible_hsc($_POST['tags']));
		$apx->tmpl->assign('REGISSEUR',compatible_hsc($_POST['regisseur']));
		$apx->tmpl->assign('MANUFACTURER',compatible_hsc($_POST['actors']));
		$apx->tmpl->assign('PUBLISHER',$this->get_units($_POST['publisher'], iif($set['products']['filtermanu'], 'company')));
		$apx->tmpl->assign('GENRELIST',$this->get_genre($thistype,$_POST['genre']));
		$apx->tmpl->assign('MEDIALIST',$this->get_media($thistype,$_POST['media']));
		$apx->tmpl->assign('SK',$_POST['sk']);
		$apx->tmpl->assign('LENGTH',compatible_hsc($_POST['length']));
		$apx->tmpl->assign('RELEASE',$this->get_release($thistype));
		$apx->tmpl->assign('BUYLINK',compatible_hsc($_POST['buylink']));
		$apx->tmpl->assign('PRICE',compatible_hsc($_POST['price']));
		$apx->tmpl->assign('RECPRICE',compatible_hsc($_POST['recprice']));
		$apx->tmpl->assign('GUARANTEE',compatible_hsc($_POST['guarantee']));
		$apx->tmpl->assign('ALLOWCOMS',(int)$_POST['allowcoms']);
		$apx->tmpl->assign('ALLOWRATING',(int)$_POST['allowrating']);
		$apx->tmpl->assign('RESTRICTED',(int)$_POST['restricted']);
		$apx->tmpl->assign('TOP',(int)$_POST['top']);
		$apx->tmpl->assign('SEARCHABLE',(int)$_POST['searchable']);
		$apx->tmpl->assign('PUBNOW',(int)$_POST['pubnow']);
		$apx->tmpl->assign('UPDATEPARENT',(int)$_POST['updateparent']);
		
		$apx->tmpl->parse('add_edit_'.$thistype);
	}
}



function edit_movie($info) {
	global $set,$db,$apx;
	$thistype='movie';
	
	//Aktualisieren
	if ( $_POST['send']==2 ) {
		if ( !checkToken() ) infoInvalidToken();
		elseif ( !$_POST['title'] || !$_POST['text'] ) infoNotComplete();
		elseif ( !$this->update_pic() ) { /*DO NOTHING*/ }
		elseif ( !$this->update_teaserpic() ) { /*DO NOTHING*/ }
		else {
			
			//Website-URLs clean
			if ( substr($_POST['website'],0,4)=='www.' ) $_POST['website']='http://'.$_POST['website'];
			
			$_POST['picture']=$this->picpath;
			$_POST['teaserpic']=$this->teaserpicpath;
			$_POST['media']=dash_serialize(array_map('intval', $_POST['media']));
			
			$db->dupdate(PRE.'_products','prodid,title,text,meta_description,picture,teaserpic,website,regisseur,actors,publisher,sk,genre,media,length,custom1,custom2,custom3,custom4,custom5,custom6,custom7,custom8,custom9,custom10,buylink,price,recprice,guarantee,allowcoms,allowrating,restricted,top,searchable',"WHERE id='".$_REQUEST['id']."' LIMIT 1");
			logit('PRODUCTS_EDIT','ID #'.$_REQUEST['id']);
			
			//Release eintragen
			$db->query("DELETE FROM ".PRE."_products_releases WHERE prodid='".$_REQUEST['id']."'");
			for ( $i=1; $i<=10; $i++ ) {
				if ( !isset($_POST['release'][$i]) ) continue;
				$element=$_POST['release'][$i];
				if ( $element['year'] ) {
					list($reldata,$relstamp,$relsystem)=$this->generate_release($element);
					$db->query("INSERT INTO ".PRE."_products_releases (prodid,system,data,stamp) VALUES ('".$_REQUEST['id']."','".$relsystem."','".addslashes(serialize($reldata))."','".$relstamp."')");
				}
			}
			
			//Tags
			$db->query("DELETE FROM ".PRE."_products_tags WHERE id='".$_REQUEST['id']."'");
			$tagids = produceTagIds($_POST['tags']);
			foreach ( $tagids AS $tagid ) {
				$db->query("INSERT IGNORE INTO ".PRE."_products_tags VALUES('".$_REQUEST['id']."', '".$tagid."')");
			}
			
			printJSRedirect(get_index('products.show'));
		}
	}
	else {
		//Variablen freigeben
		foreach ( $info AS $key => $value ) {
			$_POST[$key]=$value;
		}
		
		//Media
		$_POST['media']=dash_unserialize($info['media']);
		if ( !is_array($_POST['media']) ) $_POST['media']=array();
		
		//Releases auslesen
		$_POST['release']=array();
		$data=$db->fetch("SELECT system,data FROM ".PRE."_products_releases WHERE prodid='".$_REQUEST['id']."' ORDER BY ord ASC");
		if ( count($data) ) {
			$ri=1;
			foreach ( $data AS $res ) {
				$res['data']=unserialize($res['data']);
				if ( is_array($res['data']) ) {
					$_POST['release'][$ri]=$res['data'];
					$_POST['release'][$ri]['system']=$res['system'];
					++$ri;
				}
			}
		}
		
		
		//Benutzerdefinierte Felder
		for ( $i=1; $i<=10; $i++ ) {
			$fieldname = $set['products']['custom_'.$thistype][$i-1];
			$apx->tmpl->assign('CUSFIELD'.$i.'_NAME',replace($fieldname));
			$apx->tmpl->assign('CUSTOM'.$i,compatible_hsc($_POST['custom'.$i]));
		}
		
		//Bild
		$picture = '';
		if ( $info['picture'] ) {
			$picturepath = $info['picture'];
			$poppicpath = str_replace('-thumb.', '.', $picturepath);
			if ( file_exists(BASEDIR.getpath('uploads').$poppicpath) ) {
				$picture = '../'.getpath('uploads').$poppicpath;
			}
			else {
				$picture = '../'.getpath('uploads').$picturepath;
			}
		}
		
		//Bild
		$teaserpic = '';
		if ( $info['teaserpic'] ) {
			$teaserpicpath = $info['teaserpic'];
			$poppicpath = str_replace('-thumb.', '.', $teaserpicpath);
			if ( file_exists(BASEDIR.getpath('uploads').$poppicpath) ) {
				$teaserpic = '../'.getpath('uploads').$poppicpath;
			}
			else {
				$teaserpic = '../'.getpath('uploads').$teaserpicpath;
			}
		}
		
		//Tags
		$tags = array();
		$tagdata = $db->fetch("
			SELECT t.tag
			FROM ".PRE."_products_tags AS n
			LEFT JOIN ".PRE."_tags AS t USING(tagid)
			WHERE n.id='".$_REQUEST['id']."'
			ORDER BY t.tag ASC
		");
		$tags = get_ids($tagdata, 'tag');
		$_POST['tags'] = implode(', ', $tags);
		
		$apx->tmpl->assign('ACTION','edit');
		$apx->tmpl->assign('ID',$_REQUEST['id']);
		$apx->tmpl->assign('PRODID',intval($_POST['prodid']));
		$apx->tmpl->assign('TITLE',compatible_hsc($_POST['title']));
		$apx->tmpl->assign('TEXT',compatible_hsc($_POST['text']));
		$apx->tmpl->assign('META_DESCRIPTION',compatible_hsc($_POST['meta_description']));
		$apx->tmpl->assign('PICTURE',$picture);
		$apx->tmpl->assign('TEASERPIC',$teaserpic);
		$apx->tmpl->assign('PIC_COPY',compatible_hsc($_POST['pic_copy']));
		$apx->tmpl->assign('TEASERPIC_COPY',compatible_hsc($_POST['teaserpic_copy']));
		$apx->tmpl->assign('WEBSITE',compatible_hsc($_POST['website']));
		$apx->tmpl->assign('TAGS',compatible_hsc($_POST['tags']));
		$apx->tmpl->assign('REGISSEUR',compatible_hsc($_POST['regisseur']));
		$apx->tmpl->assign('ACTORS',compatible_hsc($_POST['actors']));
		$apx->tmpl->assign('PUBLISHER',$this->get_units($_POST['publisher'], iif($set['products']['filtermanu'], 'company')));
		$apx->tmpl->assign('ISBN',compatible_hsc($_POST['isbn']));
		$apx->tmpl->assign('GENRELIST',$this->get_genre($thistype,$_POST['genre']));
		$apx->tmpl->assign('MEDIALIST',$this->get_media($thistype,$_POST['media']));
		$apx->tmpl->assign('SK',$_POST['sk']);
		$apx->tmpl->assign('LENGTH',compatible_hsc($_POST['length']));
		$apx->tmpl->assign('RELEASE',$this->get_release($thistype));
		$apx->tmpl->assign('BUYLINK',compatible_hsc($_POST['buylink']));
		$apx->tmpl->assign('PRICE',compatible_hsc($_POST['price']));
		$apx->tmpl->assign('RECPRICE',compatible_hsc($_POST['recprice']));
		$apx->tmpl->assign('GUARANTEE',compatible_hsc($_POST['guarantee']));
		$apx->tmpl->assign('ALLOWCOMS',(int)$_POST['allowcoms']);
		$apx->tmpl->assign('ALLOWRATING',(int)$_POST['allowrating']);
		$apx->tmpl->assign('RESTRICTED',(int)$_POST['restricted']);
		$apx->tmpl->assign('TOP',(int)$_POST['top']);
		$apx->tmpl->assign('SEARCHABLE',(int)$_POST['searchable']);
		
		$apx->tmpl->parse('add_edit_'.$thistype);
	}
}



//***************************** LITERATUR *****************************
function add_book() {
	global $set,$db,$apx;
	$thistype='book';
	
	if ( $_POST['send']==2 ) {
		
		//Begriff bereits vorhanden?
		$duplicate = false;
		if ( $_POST['send']==2 && !$_POST['ignore'] ) {
			list($duplicate) = $db->first("SELECT id FROM ".PRE."_products WHERE title LIKE '".addslashes($_POST['title'])."' LIMIT 1");
		}
		
		if ( !checkToken() ) infoInvalidToken();
		elseif ( !$_POST['title'] || !$_POST['text'] ) infoNotComplete();
		elseif ( $duplicate ) {
			info($apx->lang->get('MSG_DUPLICATE'));
			echo '<script type="text/javascript"> parent.document.forms[0].ignore.value = 1; </script>';
		}
		elseif ( !$this->update_pic() ) { /*DO NOTHING*/ }
		elseif ( !$this->update_teaserpic() ) { /*DO NOTHING*/ }
		else {
			
			//Website-URLs clean
			if ( substr($_POST['website'],0,4)=='www.' ) $_POST['website']='http://'.$_POST['website'];
			
			$_POST['type']=$thistype;
			$_POST['addtime']=time();
			$_POST['picture']=$this->picpath;
			$_POST['teaserpic']=$this->teaserpicpath;
			$_POST['media']=dash_serialize(array_map('intval', $_POST['media']));
			
			//Freischalten
			if ( $apx->user->has_right('products.enable') && $_POST['pubnow'] ) $_POST['active'] = 1;
			else $_POST['active'] = 0;
			
			$db->dinsert(PRE.'_products','prodid,type,title,text,meta_description,picture,teaserpic,website,manufacturer,publisher,isbn,genre,media,custom1,custom2,custom3,custom4,custom5,custom6,custom7,custom8,custom9,custom10,buylink,price,recprice,guarantee,recprice,guarantee,addtime,allowcoms,allowrating,restricted,top,searchable,active');
			$nid=$db->insert_id();
			logit('PRODUCTS_ADD','ID #'.$nid);
			
			//Inlinescreens
			mediamanager_setinline($nid);
			
			//Release eintragen
			for ( $i=1; $i<=10; $i++ ) {
				if ( !isset($_POST['release'][$i]) ) continue;
				$element=$_POST['release'][$i];
				if ( $element['year'] ) {
					list($reldata,$relstamp,$relsystem)=$this->generate_release($element);
					$db->query("INSERT INTO ".PRE."_products_releases (prodid,system,data,stamp) VALUES ('".$nid."','".$relsystem."','".addslashes(serialize($reldata))."','".$relstamp."')");
				}
			}
			
			//Tags
			$tagids = produceTagIds($_POST['tags']);
			foreach ( $tagids AS $tagid ) {
				$db->query("INSERT IGNORE INTO ".PRE."_products_tags VALUES('".$nid."', '".$tagid."')");
			}
			
			if ( $_REQUEST['updateparent'] ) {
				printJSUpdateObject($_REQUEST['updateparent'], get_product_list($nid));
			}
			else {
				printJSRedirect('action.php?action=products.show&what='.$thistype);
			}
		}
	}
	else {
		$_POST['allowcoms']=1;
		$_POST['allowrating']=1;
		$_POST['searchable']=1;
		$_POST['pubnow']=1;
		$_POST['media'] = array();
		
		//Benutzerdefinierte Felder
		for ( $i=1; $i<=10; $i++ ) {
			$fieldname = $set['products']['custom_'.$thistype][$i-1];
			$apx->tmpl->assign('CUSFIELD'.$i.'_NAME',replace($fieldname));
			$apx->tmpl->assign('CUSTOM'.$i,compatible_hsc($_POST['custom'.$i]));
		}
		
		$apx->tmpl->assign('ACTION','add');
		$apx->tmpl->assign('PRODID',intval($_POST['prodid']));
		$apx->tmpl->assign('TITLE',compatible_hsc($_POST['title']));
		$apx->tmpl->assign('TEXT',compatible_hsc($_POST['text']));
		$apx->tmpl->assign('META_DESCRIPTION',compatible_hsc($_POST['meta_description']));
		$apx->tmpl->assign('PIC_COPY',compatible_hsc($_POST['pic_copy']));
		$apx->tmpl->assign('TEASERPIC_COPY',compatible_hsc($_POST['teaserpic_copy']));
		$apx->tmpl->assign('WEBSITE',compatible_hsc($_POST['website']));
		$apx->tmpl->assign('TAGS',compatible_hsc($_POST['tags']));
		$apx->tmpl->assign('MANUFACTURER',$this->get_units($_POST['manufacturer'], iif($set['products']['filtermanu'], 'person')));
		$apx->tmpl->assign('PUBLISHER',$this->get_units($_POST['publisher'], iif($set['products']['filtermanu'], 'company')));
		$apx->tmpl->assign('ISBN',compatible_hsc($_POST['isbn']));
		$apx->tmpl->assign('GENRELIST',$this->get_genre($thistype,$_POST['genre']));
		$apx->tmpl->assign('MEDIALIST',$this->get_media($thistype,$_POST['media']));
		$apx->tmpl->assign('RELEASE',$this->get_release($thistype));
		$apx->tmpl->assign('BUYLINK',compatible_hsc($_POST['buylink']));
		$apx->tmpl->assign('PRICE',compatible_hsc($_POST['price']));
		$apx->tmpl->assign('RECPRICE',compatible_hsc($_POST['recprice']));
		$apx->tmpl->assign('GUARANTEE',compatible_hsc($_POST['guarantee']));
		$apx->tmpl->assign('ALLOWCOMS',(int)$_POST['allowcoms']);
		$apx->tmpl->assign('ALLOWRATING',(int)$_POST['allowrating']);
		$apx->tmpl->assign('RESTRICTED',(int)$_POST['restricted']);
		$apx->tmpl->assign('TOP',(int)$_POST['top']);
		$apx->tmpl->assign('SEARCHABLE',(int)$_POST['searchable']);
		$apx->tmpl->assign('PUBNOW',(int)$_POST['pubnow']);
		$apx->tmpl->assign('UPDATEPARENT',(int)$_POST['updateparent']);
		
		$apx->tmpl->parse('add_edit_'.$thistype);
	}
}



function edit_book($info) {
	global $set,$db,$apx;
	$thistype='book';
	
	//Aktualisieren
	if ( $_POST['send']==2 ) {
		if ( !checkToken() ) infoInvalidToken();
		elseif ( !$_POST['title'] || !$_POST['text'] ) infoNotComplete();
		elseif ( !$this->update_pic() ) { /*DO NOTHING*/ }
		elseif ( !$this->update_teaserpic() ) { /*DO NOTHING*/ }
		else {
			
			//Website-URLs clean
			if ( substr($_POST['website'],0,4)=='www.' ) $_POST['website']='http://'.$_POST['website'];
			
			$_POST['picture']=$this->picpath;
			$_POST['teaserpic']=$this->teaserpicpath;
			$_POST['media']=dash_serialize(array_map('intval', $_POST['media']));
			
			$db->dupdate(PRE.'_products','prodid,title,text,meta_description,picture,teaserpic,website,manufacturer,publisher,isbn,genre,media,custom1,custom2,custom3,custom4,custom5,custom6,custom7,custom8,custom9,custom10,buylink,price,recprice,guarantee,allowcoms,allowrating,restricted,top,searchable',"WHERE id='".$_REQUEST['id']."' LIMIT 1");
			logit('PRODUCTS_EDIT','ID #'.$_REQUEST['id']);
			
			//Release eintragen
			$db->query("DELETE FROM ".PRE."_products_releases WHERE prodid='".$_REQUEST['id']."'");
			for ( $i=1; $i<=10; $i++ ) {
				if ( !isset($_POST['release'][$i]) ) continue;
				$element=$_POST['release'][$i];
				if ( $element['year'] ) {
					list($reldata,$relstamp,$relsystem)=$this->generate_release($element);
					$db->query("INSERT INTO ".PRE."_products_releases (prodid,system,data,stamp) VALUES ('".$_REQUEST['id']."','".$relsystem."','".addslashes(serialize($reldata))."','".$relstamp."')");
				}
			}
			
			//Tags
			$db->query("DELETE FROM ".PRE."_products_tags WHERE id='".$_REQUEST['id']."'");
			$tagids = produceTagIds($_POST['tags']);
			foreach ( $tagids AS $tagid ) {
				$db->query("INSERT IGNORE INTO ".PRE."_products_tags VALUES('".$_REQUEST['id']."', '".$tagid."')");
			}
			
			printJSRedirect(get_index('products.show'));
		}
	}
	else {
		//Variablen freigeben
		foreach ( $info AS $key => $value ) {
			$_POST[$key]=$value;
		}
		
		//Media
		$_POST['media']=dash_unserialize($info['media']);
		if ( !is_array($_POST['media']) ) $_POST['media']=array();
		
		//Releases auslesen
		$_POST['release']=array();
		$data=$db->fetch("SELECT system,data FROM ".PRE."_products_releases WHERE prodid='".$_REQUEST['id']."' ORDER BY ord ASC");
		if ( count($data) ) {
			$ri=1;
			foreach ( $data AS $res ) {
				$res['data']=unserialize($res['data']);
				if ( is_array($res['data']) ) {
					$_POST['release'][$ri]=$res['data'];
					$_POST['release'][$ri]['system']=$res['system'];
					++$ri;
				}
			}
		}
		
		
		//Benutzerdefinierte Felder
		for ( $i=1; $i<=10; $i++ ) {
			$fieldname = $set['products']['custom_'.$thistype][$i-1];
			$apx->tmpl->assign('CUSFIELD'.$i.'_NAME',replace($fieldname));
			$apx->tmpl->assign('CUSTOM'.$i,compatible_hsc($_POST['custom'.$i]));
		}
		
		//Bild
		$picture = '';
		if ( $info['picture'] ) {
			$picturepath = $info['picture'];
			$poppicpath = str_replace('-thumb.', '.', $picturepath);
			if ( file_exists(BASEDIR.getpath('uploads').$poppicpath) ) {
				$picture = '../'.getpath('uploads').$poppicpath;
			}
			else {
				$picture = '../'.getpath('uploads').$picturepath;
			}
		}
		
		//Bild
		$teaserpic = '';
		if ( $info['teaserpic'] ) {
			$teaserpicpath = $info['teaserpic'];
			$poppicpath = str_replace('-thumb.', '.', $teaserpicpath);
			if ( file_exists(BASEDIR.getpath('uploads').$poppicpath) ) {
				$teaserpic = '../'.getpath('uploads').$poppicpath;
			}
			else {
				$teaserpic = '../'.getpath('uploads').$teaserpicpath;
			}
		}
		
		//Tags
		$tags = array();
		$tagdata = $db->fetch("
			SELECT t.tag
			FROM ".PRE."_products_tags AS n
			LEFT JOIN ".PRE."_tags AS t USING(tagid)
			WHERE n.id='".$_REQUEST['id']."'
			ORDER BY t.tag ASC
		");
		$tags = get_ids($tagdata, 'tag');
		$_POST['tags'] = implode(', ', $tags);
		
		$apx->tmpl->assign('ACTION','edit');
		$apx->tmpl->assign('ID',$_REQUEST['id']);
		$apx->tmpl->assign('PRODID',intval($_POST['prodid']));
		$apx->tmpl->assign('TITLE',compatible_hsc($_POST['title']));
		$apx->tmpl->assign('TEXT',compatible_hsc($_POST['text']));
		$apx->tmpl->assign('META_DESCRIPTION',compatible_hsc($_POST['meta_description']));
		$apx->tmpl->assign('PICTURE',$picture);
		$apx->tmpl->assign('TEASERPIC',$teaserpic);
		$apx->tmpl->assign('PIC_COPY',compatible_hsc($_POST['pic_copy']));
		$apx->tmpl->assign('TEASERPIC_COPY',compatible_hsc($_POST['teaserpic_copy']));
		$apx->tmpl->assign('WEBSITE',compatible_hsc($_POST['website']));
		$apx->tmpl->assign('TAGS',compatible_hsc($_POST['tags']));
		$apx->tmpl->assign('MANUFACTURER',$this->get_units($_POST['manufacturer'], iif($set['products']['filtermanu'], 'person')));
		$apx->tmpl->assign('PUBLISHER',$this->get_units($_POST['publisher'], iif($set['products']['filtermanu'], 'company')));
		$apx->tmpl->assign('ISBN',compatible_hsc($_POST['isbn']));
		$apx->tmpl->assign('GENRELIST',$this->get_genre($thistype,$_POST['genre']));
		$apx->tmpl->assign('MEDIALIST',$this->get_media($thistype,$_POST['media']));
		$apx->tmpl->assign('RELEASE',$this->get_release($thistype));
		$apx->tmpl->assign('BUYLINK',compatible_hsc($_POST['buylink']));
		$apx->tmpl->assign('PRICE',compatible_hsc($_POST['price']));
		$apx->tmpl->assign('RECPRICE',compatible_hsc($_POST['recprice']));
		$apx->tmpl->assign('GUARANTEE',compatible_hsc($_POST['guarantee']));
		$apx->tmpl->assign('ALLOWCOMS',(int)$_POST['allowcoms']);
		$apx->tmpl->assign('ALLOWRATING',(int)$_POST['allowrating']);
		$apx->tmpl->assign('RESTRICTED',(int)$_POST['restricted']);
		$apx->tmpl->assign('TOP',(int)$_POST['top']);
		$apx->tmpl->assign('SEARCHABLE',(int)$_POST['searchable']);
		
		$apx->tmpl->parse('add_edit_'.$thistype);
	}
}



/////////////////////////////////////////////////////////////////////////////////////////// PERSONEN/FIRMEN

//***************************** Personen/Firmen zeigen *****************************
function ushow() {
	global $set,$db,$apx,$html;
	
	//Suche durchf�hren
	if ( $_REQUEST['item'] && ( $_REQUEST['title'] || $_REQUEST['text'] ) ) {
		$where = '';
		
		//Suche wird ausgef�hrt...
		if ( $_REQUEST['title'] ) {
			$sc[]="title LIKE '%".addslashes_like($_REQUEST['item'])."%'";
			$sc[]="fullname LIKE '%".addslashes_like($_REQUEST['item'])."%'";
		}
		if ( $_REQUEST['text'] ) $sc[]="text LIKE '%".addslashes_like($_REQUEST['item'])."%'";
		if ( $_REQUEST['else'] ) {
			$sc[]="address LIKE '%".addslashes_like($_REQUEST['item'])."%'";
			$sc[]="email LIKE '%".addslashes_like($_REQUEST['item'])."%'";
			$sc[]="phone LIKE '%".addslashes_like($_REQUEST['item'])."%'";
			$sc[]="website LIKE '%".addslashes_like($_REQUEST['item'])."%'";
			$sc[]="founder LIKE '%".addslashes_like($_REQUEST['item'])."%'";
			$sc[]="founding_year LIKE '%".addslashes_like($_REQUEST['item'])."%'";
			$sc[]="founding_country LIKE '%".addslashes_like($_REQUEST['item'])."%'";
			$sc[]="legalform LIKE '%".addslashes_like($_REQUEST['item'])."%'";
			$sc[]="headquaters LIKE '%".addslashes_like($_REQUEST['item'])."%'";
			$sc[]="executive LIKE '%".addslashes_like($_REQUEST['item'])."%'";
			$sc[]="sector LIKE '%".addslashes_like($_REQUEST['item'])."%'";
			$sc[]="products LIKE '%".addslashes_like($_REQUEST['item'])."%'";
		}
		if ( is_array($sc) ) $where.=' AND ( '.implode(' OR ',$sc).' )';
		
		$data=$db->fetch("SELECT id FROM ".PRE."_products_units WHERE 1 ".$where);
		$ids = get_ids($data, 'id');
		$ids[] = -1;
		$searchid = saveSearchResult('admin_products_units', $ids, array(
			'title' => $_REQUEST['title'],
			'text' => $_REQUEST['text'],
			'else' => $_REQUEST['else'],
			'item' => $_REQUEST['item']
		));
		header("HTTP/1.1 301 Moved Permanently");
		header('Location: action.php?action=products.ushow&what='.$_REQUEST['what'].'&searchid='.$searchid);
		return;
	}
	
	
	//Vorgaben
	$_REQUEST['title'] = 1;
	$_REQUEST['text'] = 1;
	
	quicklink('products.uadd');
	
	//Layer Header ausgeben
	$layerdef[]=array('UNITTYPE_ALL','action.php?action=products.ushow',!$_REQUEST['what']);
	$layerdef[]=array('UNITTYPE_PERSON','action.php?action=products.ushow&amp;what=person',$_REQUEST['what']=='person');
	$layerdef[]=array('UNITTYPE_COMPANY','action.php?action=products.ushow&amp;what=company',$_REQUEST['what']=='company');
	$html->layer_header($layerdef);
	$typeFilter = '';
	if ( in_array($_REQUEST['what'], array('company', 'person')) ) {
		$typeFilter = " AND type='".$_REQUEST['what']."' ";
	}
	
	$orderdef[0]='title';
	$orderdef['title']=array('title','ASC','COL_TITLE');
	
	
	//Suchergebnis?
	$resultFilter = '';
	if ( $_REQUEST['searchid'] ) {
		$searchRes = getSearchResult('admin_products_units', $_REQUEST['searchid']);
		if ( $searchRes ) {
			list($resultIds, $resultMeta) = $searchRes;
			$_REQUEST['item'] = $resultMeta['item'];
			$_REQUEST['title'] = $resultMeta['title'];
			$_REQUEST['text'] = $resultMeta['text'];
			$_REQUEST['else'] = $resultMeta['else'];
			$resultFilter = " AND id IN (".implode(', ', $resultIds).")";
		}
		else {
			$_REQUEST['searchid'] = '';
		}
	}
	
	$apx->tmpl->assign('ITEM',compatible_hsc($_REQUEST['item']));
	$apx->tmpl->assign('STITLE',(int)$_REQUEST['title']);
	$apx->tmpl->assign('STEXT',(int)$_REQUEST['text']);
	$apx->tmpl->assign('SELSE',(int)$_REQUEST['else']);
	$apx->tmpl->assign('WHAT',$_REQUEST['what']);
	$apx->tmpl->parse('usearch');
	
	
	//Letters
	letters('action.php?action=products.ushow&amp;what='.$_REQUEST['what'].iif($_REQUEST['searchid'], '&amp;searchid='.$_REQUEST['searchid']));
	if ( !$_REQUEST['letter'] ) $_REQUEST['letter']=0;
	$letterfilter='';
	if ( $_REQUEST['letter']==='spchar' ) $letterfilter=" AND title NOT REGEXP(\"^[a-zA-Z]\") ";
	elseif ( $_REQUEST['letter'] ) $letterfilter=" AND title LIKE '".addslashes($_REQUEST['letter'])."%' ";
	
	list($count)=$db->first("SELECT count(id) FROM ".PRE."_products_units WHERE 1 ".$typeFilter.$resultFilter.$letterfilter);
	pages('action.php?action=products.ushow&amp;what='.$_REQUEST['what'].iif($_REQUEST['searchid'], '&amp;searchid='.$_REQUEST['searchid']).'&amp;letter='.$_REQUEST['letter'].'&amp;sortby='.$_REQUEST['sortby'],$count);
	$data=$db->fetch("SELECT * FROM ".PRE."_products_units WHERE 1 ".$typeFilter.$resultFilter.$letterfilter.getorder($orderdef).getlimit());
	$this->ushow_print($data);
	orderstr($orderdef,'action.php?action=products.ushow&amp;what='.$_REQUEST['what'].iif($_REQUEST['searchid'], '&amp;searchid='.$_REQUEST['searchid']).'&amp;letter='.$_REQUEST['letter']);
	save_index($_SERVER['REQUEST_URI']);
	
	//Layer-Footer ausgeben
	$html->layer_footer();
}


//AUSGABE
function ushow_print($data) {
	global $set,$db,$apx,$html;
	
	$col[]=array('&nbsp;',1,'');
	$col[]=array('COL_TITLE',80,'class="title"');
	$col[]=array('COL_PRODUCTS',20,'align="center"');
	
	if ( count($data) ) {
		foreach ( $data AS $res ) {
			++$i;
			
			list($products) = $db->first("SELECT count(id) FROM ".PRE."_products WHERE manufacturer='".$res['id']."' OR publisher='".$res['id']."'");
			
			$link=mklink(
				'manufacturers.php?id='.$res['id'],
				'manufacturers,id'.$res['id'].urlformat($res['title']).'.html'
			);
			
			$tabledata[$i]['COL1']='<img src="design/type_'.$res['type'].'.gif" alt="'.$apx->lang->get('UNITTYPE_'.strtoupper($res['type'])).'" title="'.$apx->lang->get('UNITTYPE_'.strtoupper($res['type'])).'" />';
			$tabledata[$i]['COL2']='<a href="'.$link.'" target="_blank">'.$res['title'].'</a>';
			$tabledata[$i]['COL3']=number_format($products, 0, ',', '.');
			
			//Optionen
			if ( $apx->user->has_right('products.uedit') ) $tabledata[$i]['OPTIONS'].=optionHTML('edit.gif', 'products.uedit', 'id='.$res['id'], $apx->lang->get('CORE_EDIT'));
			else $tabledata[$i]['OPTIONS'].='<img src="design/ispace.gif" alt="" />';
			
			if ( $apx->user->has_right('products.udel') && !$cats && !$res['children'] ) $tabledata[$i]['OPTIONS'].=optionHTMLOverlay('del.gif', 'products.udel', 'id='.$res['id'], $apx->lang->get('CORE_DEL'));
			else $tabledata[$i]['OPTIONS'].='<img src="design/ispace.gif" alt="" />';
		}
	}
	
	$apx->tmpl->assign('TABLE',$tabledata);
	$html->table($col);
}



//***************************** Personen/Firmen hinzuf�gen *****************************
function uadd() {
	global $set,$db,$apx;
	
	//Absenden
	if ( $_POST['send'] ) {
		
		//Begriff bereits vorhanden?
		$duplicate = false;
		if ( $_POST['send']==1 && !$_POST['ignore'] ) {
			list($duplicate) = $db->first("SELECT id FROM ".PRE."_products_units WHERE title LIKE '".addslashes($_POST['title'])."' LIMIT 1");
		}
		
		if ( !checkToken() ) infoInvalidToken();
		elseif ( !$_POST['title'] || !$_POST['type'] ) info($apx->lang->get('CORE_BACK'),'back');
		elseif ( $duplicate ) {
			info($apx->lang->get('MSG_DUPLICATE'));
			echo '<script type="text/javascript"> parent.document.forms[0].ignore.value = 1; </script>';
		}
		elseif ( !$this->update_unitpic() ) { /*DO NOTHING*/ }
		else {
			
			//Website vervollst�ndigen
			if ( substr($_POST['website'],0,4)=='www.' ) $_POST['website']='http://'.$_POST['website'];
			
			//Felder
			if ( $_POST['type']=='company' ) {
				$fields = 'type,title,text,meta_description,fullname,picture,address,email,phone,website,founder,founding_year,founding_country,legalform,headquaters,executive,employees,turnover,sector,products';
			}
			else {
				$fields = 'type,title,text,fullname,picture,address,email,phone,website';
			}
			
			//Bild
			$_POST['picture']=$this->unitpicpath;
			
			$db->dinsert(PRE.'_products_units',$fields);
			$nid = $db->insert_id();
			logit('PRODUCTS_UNITS_ADD','ID #'.$nid);
			
			if ( $_REQUEST['updateparent'] ) {
				printJSUpdateObject($_REQUEST['updateparent'], $this->get_units($nid));
			}
			else {
				printJSRedirect('action.php?action=products.ushow');
			}
		}
	}
	else {
		
		//Type automatisch ausw�hlen
		if ( $_GET['type'] ) $_POST['type']=$_GET['type'];
		else $_POST['type'] = 'company';
		
		$apx->tmpl->assign('TYPE',$_POST['type']);
		$apx->tmpl->assign('TITLE',compatible_hsc($_POST['title']));
		$apx->tmpl->assign('TEXT',compatible_hsc($_POST['text']));
		$apx->tmpl->assign('META_DESCRIPTION',compatible_hsc($_POST['meta_description']));
		$apx->tmpl->assign('FULLNAME',compatible_hsc($_POST['fullname']));
		$apx->tmpl->assign('ADDRESS',compatible_hsc($_POST['address']));
		$apx->tmpl->assign('EMAIL',compatible_hsc($_POST['email']));
		$apx->tmpl->assign('PHONE',compatible_hsc($_POST['phone']));
		$apx->tmpl->assign('WEBSITE',compatible_hsc($_POST['website']));
		$apx->tmpl->assign('FOUNDER',compatible_hsc($_POST['founder']));
		$apx->tmpl->assign('FOUNDING_YEAR',compatible_hsc($_POST['founding_year']));
		$apx->tmpl->assign('FOUNDING_COUNTRY',compatible_hsc($_POST['founding_country']));
		$apx->tmpl->assign('LEGALFORM',compatible_hsc($_POST['legalform']));
		$apx->tmpl->assign('HEADQUATERS',compatible_hsc($_POST['headquaters']));
		$apx->tmpl->assign('EXECUTIVE',compatible_hsc($_POST['executive']));
		$apx->tmpl->assign('EMPLOYEES',compatible_hsc($_POST['employees']));
		$apx->tmpl->assign('TURNOVER',compatible_hsc($_POST['turnover']));
		$apx->tmpl->assign('SECTOR',compatible_hsc($_POST['sector']));
		$apx->tmpl->assign('PRODUCTS',compatible_hsc($_POST['products']));
		$apx->tmpl->assign('UPDATEPARENT',$_REQUEST['updateparent']);
		$apx->tmpl->assign('ACTION','add');
		
		$apx->tmpl->parse('unitsadd');
	}
}



//***************************** Personen/Firmen bearbeiten *****************************
function uedit() {
	global $set,$db,$apx;
	$_REQUEST['id']=(int)$_REQUEST['id'];
	if ( !$_REQUEST['id'] ) die('missing ID!');
	
	//Typ und Bild auslesen
	list($type, $picture) = $db->first("SELECT type, picture FROM ".PRE."_products_units WHERE id='".$_REQUEST['id']."' LIMIT 1");
	
	//Absenden
	if ( $_POST['send'] ) {
		if ( !checkToken() ) infoInvalidToken();
		elseif ( !$_POST['title'] ) info($apx->lang->get('CORE_BACK'),'back');
		elseif ( !$this->update_unitpic() ) { /*DO NOTHING*/ }
		else {
			
			//Website vervollst�ndigen
			if ( substr($_POST['website'],0,4)=='www.' ) $_POST['website']='http://'.$_POST['website'];
			
			//Felder
			if ( $type=='company' ) {
				$fields = 'title,text,meta_description,fullname,picture,address,email,phone,website,founder,founding_year,founding_country,legalform,headquaters,executive,employees,turnover,sector,products';
			}
			else {
				$fields = 'title,text,fullname,picture,address,email,phone,website';
			}
			
			//Bild
			$_POST['picture']=$this->unitpicpath;
			
			$db->dupdate(PRE.'_products_units',$fields,"WHERE id='".$_REQUEST['id']."' LIMIT 1");
			logit('PRODUCTS_UNITS_EDIT','ID #'.$_REQUEST['id']);
			printJSRedirect(get_index('products.ushow'));
		}
	}
	else {
		$_POST = $db->first("SELECT * FROM ".PRE."_products_units WHERE id='".$_REQUEST['id']."' LIMIT 1");
		
		//Bild auslesen
		$teaserpic = '';
		if ( $picture ) {
			$teaserpicpath = $picture;
			$poppicpath = str_replace('-thumb.', '.', $teaserpicpath);
			if ( file_exists(BASEDIR.getpath('uploads').$poppicpath) ) {
				$teaserpic = '../'.getpath('uploads').$poppicpath;
			}
			else {
				$teaserpic = '../'.getpath('uploads').$teaserpicpath;
			}
		}
		
		$apx->tmpl->assign('TYPE',$type);
		$apx->tmpl->assign('TITLE',compatible_hsc($_POST['title']));
		$apx->tmpl->assign('TEXT',compatible_hsc($_POST['text']));
		$apx->tmpl->assign('META_DESCRIPTION',compatible_hsc($_POST['meta_description']));
		$apx->tmpl->assign('PICTURE',$teaserpic);
		$apx->tmpl->assign('FULLNAME',compatible_hsc($_POST['fullname']));
		$apx->tmpl->assign('ADDRESS',compatible_hsc($_POST['address']));
		$apx->tmpl->assign('EMAIL',compatible_hsc($_POST['email']));
		$apx->tmpl->assign('PHONE',compatible_hsc($_POST['phone']));
		$apx->tmpl->assign('WEBSITE',compatible_hsc($_POST['website']));
		$apx->tmpl->assign('FOUNDER',compatible_hsc($_POST['founder']));
		$apx->tmpl->assign('FOUNDING_YEAR',compatible_hsc($_POST['founding_year']));
		$apx->tmpl->assign('FOUNDING_COUNTRY',compatible_hsc($_POST['founding_country']));
		$apx->tmpl->assign('LEGALFORM',compatible_hsc($_POST['legalform']));
		$apx->tmpl->assign('HEADQUATERS',compatible_hsc($_POST['headquaters']));
		$apx->tmpl->assign('EXECUTIVE',compatible_hsc($_POST['executive']));
		$apx->tmpl->assign('EMPLOYEES',compatible_hsc($_POST['employees']));
		$apx->tmpl->assign('TURNOVER',compatible_hsc($_POST['turnover']));
		$apx->tmpl->assign('SECTOR',compatible_hsc($_POST['sector']));
		$apx->tmpl->assign('PRODUCTS',compatible_hsc($_POST['products']));
		$apx->tmpl->assign('ID',$_REQUEST['id']);
		$apx->tmpl->assign('ACTION','edit');
		
		$apx->tmpl->parse('unitsedit');
	}
}



//***************************** Personen/Firmen l�schen *****************************
function udel() {
	global $set,$db,$apx;
	$_REQUEST['id']=(int)$_REQUEST['id'];
	if ( !$_REQUEST['id'] ) die('missing ID!');
	
	if ( $_POST['send']==1 ) {
		if ( !checkToken() ) printInvalidToken();
		else {
			//Bild l�schen
			list($picture) = $db->first("SELECT picture FROM ".PRE."_products_units WHERE id='".$_REQUEST['id']."' LIMIT 1");
			require_once(BASEDIR.'lib/class.mediamanager.php');
			$mm = new mediamanager();
			$poppic=str_replace('-thumb.','.',$picture);
			if ( $picture && file_exists(BASEDIR.getpath('uploads').$picture) ) $mm->deletefile($picture);
			if ( $poppic && file_exists(BASEDIR.getpath('uploads').$poppic) ) $mm->deletefile($poppic);
			
			//DB-Eintrag l�schen
			$db->query("DELETE FROM ".PRE."_products_units WHERE id='".$_REQUEST['id']."'");
			logit('PRODUCTS_UNITS_DEL','ID #'.$_REQUEST['id']);
			printJSRedirect(get_index('products.ushow'));
		}
	}
	else {
		list($title) = $db->first("SELECT title FROM ".PRE."_products_units WHERE id='".$_REQUEST['id']."' LIMIT 1");
		$apx->tmpl->assign('MESSAGE', $apx->lang->get('MSG_TEXT', array('TITLE' => compatible_hsc($title))));
		tmessageOverlay('deltitle',array('ID'=>$_REQUEST['id']), '/');
	}
}



/////////////////////////////////////////////////////////////////////////////////////////// MEDIEN

//***************************** Medien zeigen *****************************
function media() {
	global $set,$db,$apx,$html;
	
	//Funktionen
	if ( $_REQUEST['do']=='add' ) return $this->media_add();
	elseif ( $_REQUEST['do']=='edit' ) return $this->media_edit();
	elseif ( $_REQUEST['do']=='del' ) return $this->media_del();
	
	echo '<p class="slink">&raquo; <a href="action.php?action=products.media&amp;do=add&amp;type='.$_REQUEST['type'].'">'.$apx->lang->get('ADDMEDIUM').'</a></p>';
	
	//Layer Header ausgeben
	$layerdef[]=array('PRODTYPE_ALL','action.php?action=products.media',!$_REQUEST['type']);
	foreach ( $this->mediatypes AS $type ) {
		$layerdef[]=array('PRODTYPE_'.strtoupper($type),'action.php?action=products.media&amp;type='.$type,$_REQUEST['type']==$type);
	}
	$html->layer_header($layerdef);
	
	//Eintr�ge zu einem bestimmten Produkttyp
	if ( in_array($_REQUEST['type'],$this->types) ) {
		list($count)=$db->first("SELECT count(id) FROM ".PRE."_products_groups WHERE grouptype='medium' AND type='".$_REQUEST['type']."'");
		pages('action.php?action=products.media&amp;type='.$_REQUEST['type'],$count);
		$data=$db->fetch("SELECT * FROM ".PRE."_products_groups WHERE grouptype='medium' AND type='".$_REQUEST['type']."' ORDER BY title ASC".getlimit());
		$this->media_print($data);
		save_index($_SERVER['REQUEST_URI']);
	}
	
	//Alle Eintr�ge
	else {
		list($count)=$db->first("SELECT count(id) FROM ".PRE."_products_groups WHERE grouptype='medium'");
		pages('action.php?action=products.media',$count);
		$data=$db->fetch("SELECT * FROM ".PRE."_products_groups WHERE grouptype='medium' ORDER BY title ASC".getlimit());
		$this->media_print($data);
		save_index($_SERVER['REQUEST_URI']);
	}
	
	//Layer-Footer ausgeben
	$html->layer_footer();
}


//AUSGABE
function media_print($data) {
	global $set,$db,$apx,$html;
	
	$col[]=array('&nbsp;',1,'');
	$col[]=array('TITLE',100,'class="title"');
	
	if ( count($data) ) {
		foreach ( $data AS $res ) {
			++$i;
			
			$tabledata[$i]['COL1']='<img src="design/type_'.$res['type'].'.gif" alt="'.$apx->lang->get('PRODTYPE_'.strtoupper($res['type'])).'" title="'.$apx->lang->get('PRODTYPE_'.strtoupper($res['type'])).'" />';
			$tabledata[$i]['COL2']=$res['title'];
			
			//Optionen
			$tabledata[$i]['OPTIONS'].=optionHTML('edit.gif', 'products.media', 'do=edit&id='.$res['id'], $apx->lang->get('CORE_EDIT'));
			$tabledata[$i]['OPTIONS'].=optionHTMLOverlay('del.gif', 'products.media', 'do=del&id='.$res['id'], $apx->lang->get('CORE_DEL'));
		}
	}
	
	$apx->tmpl->assign('TABLE',$tabledata);
	$html->table($col);
}



//***************************** Medien hinzuf�gen *****************************
function media_add() {
	global $set,$db,$apx;
	
	//Type automatisch ausw�hlen
	if ( $_GET['type'] ) $_POST['type']=$_GET['type'];
	
	//Absenden
	if ( $_POST['send'] ) {
		if ( !checkToken() ) infoInvalidToken();
		elseif ( !$_POST['title'] || !$_POST['type'] ) info($apx->lang->get('CORE_BACK'),'back');
		else {
			$_POST['grouptype']='medium';
			$db->dinsert(PRE.'_products_groups','title,icon,type,grouptype');
			$nid = $db->insert_id();
			logit('PRODUCTS_MEDIA_ADD','ID #'.$nid);
			
			if ( $_REQUEST['updateparent'] ) {
				printJSUpdateObject($_REQUEST['updateparent'], $this->get_media($_POST['type'],$nid));
			}
			else {
				printJSRedirect('action.php?action=products.media&type='.$_POST['type']);
			}
		}
	}
	else {
		//Typliste
		$typelist='';
		foreach ( $this->mediatypes AS $type ) {
			$typelist.='<option value="'.$type.'"'.iif($type==$_POST['type'],' selected="selected"').'>'.$apx->lang->get('PRODTYPE_'.strtoupper($type)).'</option>';
		}
		
		$apx->tmpl->assign('TITLE',compatible_hsc($_POST['title']));
		$apx->tmpl->assign('ICON',compatible_hsc($_POST['icon']));
		$apx->tmpl->assign('TYPELIST',$typelist);
		$apx->tmpl->assign('UPDATEPARENT',$_REQUEST['updateparent']);
		$apx->tmpl->assign('TYPE',$_REQUEST['type']);
		$apx->tmpl->assign('ACTION','add');
		
		$apx->tmpl->parse('mediaadd_mediaedit');
	}
}



//***************************** Medien bearbeiten *****************************
function media_edit() {
	global $set,$db,$apx;
	$_REQUEST['id']=(int)$_REQUEST['id'];
	if ( !$_REQUEST['id'] ) die('missing ID!');
	
	//Absenden
	if ( $_POST['send'] ) {
		if ( !checkToken() ) infoInvalidToken();
		elseif ( !$_POST['title'] ) info($apx->lang->get('CORE_BACK'),'back');
		else {
			$db->dupdate(PRE.'_products_groups','title,icon',"WHERE grouptype='medium' AND id='".$_REQUEST['id']."' LIMIT 1");
			logit('PRODUCTS_MEDIA_EDIT','ID #'.$_REQUEST['id']);
			printJSRedirect(get_index('products.media'));
		}
	}
	else {
		list(
			$_POST['title'],
			$_POST['icon'],
		) = $db->first("SELECT title,icon FROM ".PRE."_products_groups WHERE grouptype='medium' AND id='".$_REQUEST['id']."' LIMIT 1");
		
		$apx->tmpl->assign('TITLE',compatible_hsc($_POST['title']));
		$apx->tmpl->assign('ICON',compatible_hsc($_POST['icon']));
		$apx->tmpl->assign('ID',$_REQUEST['id']);
		$apx->tmpl->assign('ACTION','edit');
		
		$apx->tmpl->parse('mediaadd_mediaedit');
	}
}



//***************************** Medien l�schen *****************************
function media_del() {
	global $set,$db,$apx;
	$_REQUEST['id']=(int)$_REQUEST['id'];
	if ( !$_REQUEST['id'] ) die('missing ID!');
	
	if ( $_POST['send']==1 ) {
		if ( !checkToken() ) printInvalidToken();
		else {
			$db->query("DELETE FROM ".PRE."_products_groups WHERE grouptype='medium' AND id='".$_REQUEST['id']."'");
			logit('PRODUCTS_MEDIA_DEL','ID #'.$_REQUEST['id']);
			printJSRedirect(get_index('products.media'));
		}
	}
	else {
		list($title) = $db->first("SELECT title FROM ".PRE."_products_groups WHERE id='".$_REQUEST['id']."' LIMIT 1");
		$apx->tmpl->assign('MESSAGE', $apx->lang->get('DEL_TEXT', array('TITLE' => compatible_hsc($title))));
		tmessageOverlay('mediadel',array('ID'=>$_REQUEST['id']));
	}
}



/////////////////////////////////////////////////////////////////////////////////////////// GENRES

//***************************** Genres zeigen *****************************
function genre() {
	global $set,$db,$apx,$html;
	
	//Funktionen
	if ( $_REQUEST['do']=='add' ) return $this->genre_add();
	elseif ( $_REQUEST['do']=='edit' ) return $this->genre_edit();
	elseif ( $_REQUEST['do']=='del' ) return $this->genre_del();
	
	echo '<p class="slink">&raquo; <a href="action.php?action=products.genre&amp;do=add&amp;type='.$_REQUEST['type'].'">'.$apx->lang->get('ADDGENRE').'</a></p>';
	
	//Layer Header ausgeben
	$layerdef[]=array('PRODTYPE_ALL','action.php?action=products.genre',!$_REQUEST['type']);
	foreach ( $this->genretypes AS $type ) {
		$layerdef[]=array('PRODTYPE_'.strtoupper($type),'action.php?action=products.genre&amp;type='.$type,$_REQUEST['type']==$type);
	}
	$html->layer_header($layerdef);
	
	//Eintr�ge zu einem bestimmten Produkttyp
	if ( in_array($_REQUEST['type'],$this->types) ) {
		list($count)=$db->first("SELECT count(id) FROM ".PRE."_products_groups WHERE grouptype='genre' AND type='".$_REQUEST['type']."'");
		pages('action.php?action=products.genre&amp;type='.$_REQUEST['type'],$count);
		$data=$db->fetch("SELECT * FROM ".PRE."_products_groups WHERE grouptype='genre' AND type='".$_REQUEST['type']."' ORDER BY title ASC".getlimit());
		$this->genre_print($data);
		save_index($_SERVER['REQUEST_URI']);
	}
	
	//Alle Eintr�ge
	else {
		list($count)=$db->first("SELECT count(id) FROM ".PRE."_products_groups WHERE grouptype='genre'");
		pages('action.php?action=products.genre',$count);
		$data=$db->fetch("SELECT * FROM ".PRE."_products_groups WHERE grouptype='genre' ORDER BY title ASC".getlimit());
		$this->genre_print($data);
		save_index($_SERVER['REQUEST_URI']);
	}
	
	//Layer-Footer ausgeben
	$html->layer_footer();
}


//AUSGABE
function genre_print($data) {
	global $set,$db,$apx,$html;
	
	$col[]=array('&nbsp;',1,'');
	$col[]=array('TITLE',100,'class="title"');
	
	if ( count($data) ) {
		foreach ( $data AS $res ) {
			++$i;
			
			$tabledata[$i]['COL1']='<img src="design/type_'.$res['type'].'.gif" alt="'.$apx->lang->get('PRODTYPE_'.strtoupper($res['type'])).'" title="'.$apx->lang->get('PRODTYPE_'.strtoupper($res['type'])).'" />';
			$tabledata[$i]['COL2']=$res['title'];
			
			//Optionen
			$tabledata[$i]['OPTIONS'].=optionHTML('edit.gif', 'products.genre', 'do=edit&id='.$res['id'], $apx->lang->get('CORE_EDIT'));
			$tabledata[$i]['OPTIONS'].=optionHTMLOverlay('del.gif', 'products.genre', 'do=del&id='.$res['id'], $apx->lang->get('CORE_DEL'));
		}
	}
	
	$apx->tmpl->assign('TABLE',$tabledata);
	$html->table($col);
}



//***************************** Genres hinzuf�gen *****************************
function genre_add() {
	global $set,$db,$apx;
	
	//Type automatisch ausw�hlen
	if ( $_GET['type'] ) $_POST['type']=$_GET['type'];
	
	//Absenden
	if ( $_POST['send'] ) {
		if ( !checkToken() ) infoInvalidToken();
		elseif ( !$_POST['title'] || !$_POST['type'] ) info($apx->lang->get('CORE_BACK'),'back');
		else {
			$_POST['grouptype']='genre';
			$db->dinsert(PRE.'_products_groups','title,type,grouptype');
			$nid = $db->insert_id();
			logit('PRODUCTS_GENRE_ADD','ID #'.$nid);
			
			if ( $_REQUEST['updateparent'] ) {
				printJSUpdateObject($_REQUEST['updateparent'], $this->get_genre($_POST['type'],$nid));
			}
			else {
				printJSRedirect('action.php?action=products.genre&type='.$_POST['type']);
			}
		}
	}
	else {
		
		//Typliste
		$typelist='';
		foreach ( $this->genretypes AS $type ) {
			$typelist.='<option value="'.$type.'"'.iif($type==$_POST['type'],' selected="selected"').'>'.$apx->lang->get('PRODTYPE_'.strtoupper($type)).'</option>';
		}
		
		$apx->tmpl->assign('TITLE',compatible_hsc($_POST['title']));
		$apx->tmpl->assign('TYPELIST',$typelist);
		$apx->tmpl->assign('UPDATEPARENT',$_REQUEST['updateparent']);
		$apx->tmpl->assign('TYPE',$_REQUEST['type']);
		$apx->tmpl->assign('ACTION','add');
		
		$apx->tmpl->parse('genreadd_genreedit');
	}
}



//***************************** Genres bearbeiten *****************************
function genre_edit() {
	global $set,$db,$apx;
	$_REQUEST['id']=(int)$_REQUEST['id'];
	if ( !$_REQUEST['id'] ) die('missing ID!');
	
	//Absenden
	if ( $_POST['send'] ) {
		if ( !checkToken() ) infoInvalidToken();
		elseif ( !$_POST['title'] ) info($apx->lang->get('CORE_BACK'),'back');
		else {
			$db->dupdate(PRE.'_products_groups','title',"WHERE grouptype='genre' AND id='".$_REQUEST['id']."' LIMIT 1");
			logit('PRODUCTS_GENRE_EDIT','ID #'.$_REQUEST['id']);
			printJSRedirect(get_index('products.genre'));
		}
	}
	else {
		list($_POST['title']) = $db->first("SELECT title FROM ".PRE."_products_groups WHERE grouptype='genre' AND id='".$_REQUEST['id']."' LIMIT 1");
		
		$apx->tmpl->assign('TITLE',compatible_hsc($_POST['title']));
		$apx->tmpl->assign('ID',$_REQUEST['id']);
		$apx->tmpl->assign('ACTION','edit');
		
		$apx->tmpl->parse('genreadd_genreedit');
	}
}



//***************************** Genres l�schen *****************************
function genre_del() {
	global $set,$db,$apx;
	$_REQUEST['id']=(int)$_REQUEST['id'];
	if ( !$_REQUEST['id'] ) die('missing ID!');
	
	if ( $_POST['send']==1 ) {
		if ( !checkToken() ) printInvalidToken();
		else {
			$db->query("DELETE FROM ".PRE."_products_groups WHERE grouptype='genre' AND id='".$_REQUEST['id']."'");
			logit('PRODUCTS_GENRE_DEL','ID #'.$_REQUEST['id']);
			printJSRedirect(get_index('products.genre'));
		}
	}
	else {
		list($title) = $db->first("SELECT title FROM ".PRE."_products_groups WHERE id='".$_REQUEST['id']."' LIMIT 1");
		$apx->tmpl->assign('MESSAGE', $apx->lang->get('DEL_TEXT', array('TITLE' => compatible_hsc($title))));
		tmessageOverlay('genredel',array('ID'=>$_REQUEST['id']));
	}
}



/////////////////////////////////////////////////////////////////////////////////////////// SYSTEME

//***************************** Systeme zeigen *****************************
function systems() {
	global $set,$db,$apx,$html;
	
	//Funktionen
	if ( $_REQUEST['do']=='add' ) return $this->systems_add();
	elseif ( $_REQUEST['do']=='edit' ) return $this->systems_edit();
	elseif ( $_REQUEST['do']=='del' ) return $this->systems_del();
	
	echo '<p class="slink">&raquo; <a href="action.php?action=products.systems&amp;do=add">'.$apx->lang->get('ADDSYSTEM').'</a></p>';
	$col[]=array('TITLE',100,'class="title"');
	echo '<p class="hint">'.$apx->lang->get('INFOTEXT').'</p>';
	
	$data=$db->fetch("SELECT * FROM ".PRE."_products_groups WHERE grouptype='system' ORDER BY title ASC");
	if ( count($data) ) {
		foreach ( $data AS $res ) {
			++$i;
			
			$tabledata[$i]['COL1']=$res['title'];
			
			//Optionen
			$tabledata[$i]['OPTIONS'].=optionHTML('edit.gif', 'products.systems', 'do=edit&id='.$res['id'], $apx->lang->get('CORE_EDIT'));
			$tabledata[$i]['OPTIONS'].=optionHTMLOverlay('del.gif', 'products.systems', 'do=del&id='.$res['id'], $apx->lang->get('CORE_DEL'));
		}
	}
	
	$apx->tmpl->assign('TABLE',$tabledata);
	$html->table($col);
}



//***************************** System hinzuf�gen *****************************
function systems_add() {
	global $set,$db,$apx;
	
	//Absenden
	if ( $_POST['send'] ) {
		if ( !checkToken() ) infoInvalidToken();
		elseif ( !$_POST['title'] ) info($apx->lang->get('CORE_BACK'),'back');
		else {
			
			//Standardbelegung
			$_POST['grouptype']='system';
			$_POST['type']='game';
			
			$db->dinsert(PRE.'_products_groups','title,icon,type,grouptype');
			$nid = $db->insert_id();
			logit('PRODUCTS_SYSTEMS_ADD','ID #'.$nid);
			if ( $_REQUEST['updateparent'] ) {
				printJSUpdateObject($_REQUEST['updateparent'], $this->get_systems(array($nid)));
			}
			else {
				printJSRedirect('action.php?action=products.systems');
			}
		}
	}
	else {
		$apx->tmpl->assign('TITLE',compatible_hsc($_POST['title']));
		$apx->tmpl->assign('ICON',compatible_hsc($_POST['icon']));
		$apx->tmpl->assign('UPDATEPARENT',$_REQUEST['updateparent']);
		$apx->tmpl->assign('ACTION','add');
		
		$apx->tmpl->parse('sysadd_sysedit');
	}
}



//***************************** System bearbeiten *****************************
function systems_edit() {
	global $set,$db,$apx;
	$_REQUEST['id']=(int)$_REQUEST['id'];
	if ( !$_REQUEST['id'] ) die('missing ID!');
	
	//Absenden
	if ( $_POST['send'] ) {
		if ( !checkToken() ) infoInvalidToken();
		elseif ( !$_POST['title'] ) info($apx->lang->get('CORE_BACK'),'back');
		else {
			$db->dupdate(PRE.'_products_groups','title,icon',"WHERE grouptype='system' AND id='".$_REQUEST['id']."' LIMIT 1");
			logit('PRODUCTS_SYSTEMS_EDIT','ID #'.$_REQUEST['id']);
			printJSRedirect(get_index('products.systems'));
		}
	}
	else {
		list($_POST['title'],$_POST['icon'])=$db->first("SELECT title,icon FROM ".PRE."_products_groups WHERE grouptype='system' AND id='".$_REQUEST['id']."' LIMIT 1");
		
		$apx->tmpl->assign('TITLE',compatible_hsc($_POST['title']));
		$apx->tmpl->assign('ICON',compatible_hsc($_POST['icon']));
		$apx->tmpl->assign('ID',$_REQUEST['id']);
		$apx->tmpl->assign('ACTION','edit');
		
		$apx->tmpl->parse('sysadd_sysedit');
	}
}



//***************************** System l�schen *****************************
function systems_del() {
	global $set,$db,$apx;
	$_REQUEST['id']=(int)$_REQUEST['id'];
	if ( !$_REQUEST['id'] ) die('missing ID!');
	
	if ( $_POST['send']==1 ) {
		if ( !checkToken() ) printInvalidToken();
		else {
			$db->query("DELETE FROM ".PRE."_products_groups WHERE grouptype='system' AND id='".$_REQUEST['id']."'");
			logit('PRODUCTS_SYSTEMS_DEL','ID #'.$_REQUEST['id']);
			printJSRedirect(get_index('products.systems'));
		}
	}
	else {
		list($title) = $db->first("SELECT title FROM ".PRE."_products_groups WHERE id='".$_REQUEST['id']."' LIMIT 1");
		$apx->tmpl->assign('MESSAGE', $apx->lang->get('DEL_TEXT', array('TITLE' => compatible_hsc($title))));
		tmessageOverlay('sysdel',array('ID'=>$_REQUEST['id']));
	}
}


} //END CLASS


?>