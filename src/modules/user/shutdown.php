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


//PM-Popup
if ( $user->info['pmpopup'] ) {
	$apx->lang->drop('pmpopup','user');
	$db->query("UPDATE ".PRE."_user SET pmpopup='0' WHERE userid='".$user->info['userid']."' LIMIT 1");
	
	$msgtext=addslashes($apx->lang->get('MSG_PMPOPUP'));
	$msglink=mklink('user.php?action=pms','user,pms.html');
	
	echo <<<CODE
<script language="JavaScript" type="text/javascript">
<!--

var lang_pmpop='{$msgtext}';

window.onload = function() {
	getopen=confirm(lang_pmpop);
	if ( getopen==true ) {
		win = window.open('{$msglink}','pmwindow');
		win.focus();
	}
}

//-->
</script>

CODE;
}

?>