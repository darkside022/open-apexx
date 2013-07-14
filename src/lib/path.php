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

////////////////////////////////////////////////////////////////////////////////////////////

//Variable sch�tzen
$pathcfg=array();

//PFAD-KONFIGURATION - NICHT �NDERN!
$pathcfg['moduledir']           = 'modules/';
$pathcfg['module']              = 'modules/{MODULE}/';

$pathcfg['tmpldir']             = 'templates/';
$pathcfg['tmpl_base_public']    = 'templates/{THEME}/';
$pathcfg['tmpl_base_admin']     = 'admin/templates/';
$pathcfg['tmpl_modules_public'] = 'templates/{THEME}/{MODULE}/';
$pathcfg['tmpl_modules_admin']  = 'modules/{MODULE}/admin/';

$pathcfg['lang_base']           = 'language/{LANGID}/';
$pathcfg['lang_modules']        = 'language/{LANGID}/{MODULE}/';

$pathcfg['uploads']             = 'uploads/';
$pathcfg['content']             = 'content/';
$pathcfg['cache']               = 'cache/';


//Pfad holen
function getpath($id,$input=array()) {
	global $pathcfg;
	$path=$pathcfg[$id];
	
	foreach ( $input AS $find => $replace ) {
		$path=str_replace('{'.$find.'}',$replace,$path);
	}
	
	return $path;
}



//Pfad zum Modul
function getmodulepath($modulename) {
	return getpath('module',array('MODULE'=>$modulename));
}


?>