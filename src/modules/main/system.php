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


//Tag-IDs von String bekommen
function getTagIds($string) {
	$tagids = array();
	
	//Tags aus String auslesen
	$tags = explode(',', $string);
	$tags = array_map('trim', $tags);
	
	//Tags produzieren
	foreach ( $tags AS $tag ) {
		if ( !$tag ) continue;
		$id = getTagId($tag);
		if ( $id ) {
			$tagids[] = $id;
		}
	}
	return $tagids;
}


//Tag-IDs von String bekommen (unbekannte erzeugen)
function produceTagIds($string) {
	$tagids = array();
	
	//Tags aus String auslesen
	$tags = explode(',', $string);
	$tags = array_map('trim', $tags);
	
	//Tags produzieren
	foreach ( $tags AS $tag ) {
		if ( !$tag ) continue;
		$id = getTagId($tag);
		if ( !$id ) {
			$id = createTag($tag);
		}
		$tagids[] = $id;
	}
	return $tagids;
}



//Tag erzeugen und ID zur�ckgeben
function createTag($tagname) {
	global $db;
	$db->query("INSERT INTO ".PRE."_tags (tag) VALUES ('".addslashes($tagname)."')");
	return $db->insert_id();
}



//ID zu einem Tag auslesen
function getTagId($tagname) {
	global $db;
	list($id) = $db->first("SELECT tagid FROM ".PRE."_tags WHERE tag LIKE '".addslashes_like($tagname)."' LIMIT 1");
	return $id;
}


?>