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


# TWITTER CLASS
# =============

//Security-Check
if ( !defined('APXRUN') ) die('You are not allowed to execute this file directly!');


class action {


//***************************** Suchbegriffe *****************************
function connect() {
	global $set,$db,$apx;
	
	//PHP5 ben�tigt
	if ( version_compare(phpversion(), '5', '<') ) {
		message($apx->lang->get('MSG_PHP5ONLY'));
		return;
	}
	
	require(BASEDIR.getmodulepath('twitter').'epitwitter/class.epicurl.php');
	require(BASEDIR.getmodulepath('twitter').'epitwitter/class.epioauth.php');
	require(BASEDIR.getmodulepath('twitter').'epitwitter/class.epitwitter.php');
	$consumer_key = 'nJFE6htU7i5Bf637pvdLBg';
	$consumer_secret = '7P4dgrc5OT6Ic0ePE6xz9u69weqNwpBQxkigRJhHk';
	
	if ( $_GET['oauth_token'] && $_GET['oauth_verifier'] ) {
		$twitterObj = new EpiTwitter($consumer_key, $consumer_secret);
		$twitterObj->setToken($_GET['oauth_token']);  
		$token = $twitterObj->getAccessToken(array('oauth_verifier' => $_GET['oauth_verifier']));
		
		$db->query("UPDATE ".PRE."_config SET value='".addslashes($token->oauth_token)."' WHERE module='twitter' AND varname='oauth_token' LIMIT 1");
		$db->query("UPDATE ".PRE."_config SET value='".addslashes($token->oauth_token_secret)."' WHERE module='twitter' AND varname='oauth_secret' LIMIT 1");
		
		$twitterObj->setToken($token->oauth_token, $token->oauth_token_secret);
		$twitterInfo = $twitterObj->get_accountVerify_credentials();
		message($apx->lang->get('MSG_DONE', array('ACCOUNT' => $twitterInfo->screen_name)), 'action.php?action=main.mconfig&module=twitter');
	}
	else {
		$twitterObj = new EpiTwitter($consumer_key, $consumer_secret);
		$redirect = $twitterObj->getAuthorizeUrl(null, array('oauth_callback' => HTTP_HOST.HTTPDIR.'admin/action.php?action=twitter.connect'));
		
		header('HTTP/1.1 301 Moved Permanently');
		header('Location: '.$redirect);
	}
}



} //END CLASS


?>