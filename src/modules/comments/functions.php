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


# Comment Class
# =============

//Security-Check
if ( !defined('APXRUN') ) die('You are not allowed to execute this file directly!');



//Kommentare z�hlen
function comments_count($userid=0) {
	global $apx,$db,$set;
	$userid=(int)$userid;
	if ( !$userid ) return 0;
	list($count)=$db->first("SELECT count(id) FROM ".PRE."_comments WHERE ( userid='".$userid."' AND active='1' )");
	return $count;
}


?>