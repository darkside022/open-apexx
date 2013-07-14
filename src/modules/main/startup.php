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

//Seite sperren
if ( $set['main']['closed'] ) {
	
	//Pr�fen ob Admin
	if ( isset($user) && $user->info['groupid'] ) {
		list($gtype)=$db->first("SELECT gtype FROM ".PRE."_user_groups WHERE groupid='".$user->info['groupid']."' LIMIT 1");
	}
	
	//Kein Admin!
	if ( $gtype!='admin' && $gtype!='indiv' && !$_COOKIE[$set['main']['cookie_pre'].'_admin_userid'] ) {
		message($set['main']['close_message']);
		require(BASEDIR.'lib/_end.php');
	}
	
	$apx->tmpl->assign_static('CLOSE_MESSAGE',$set['main']['close_message']);
}



//Parameter aus URL filtern
function main_filter_url($params=array()) {
	$url=$_SERVER['REQUEST_URI'];
	
	foreach ( $params AS $param ) {
		$url=preg_replace('#\?'.$param.'=(.*)(&|$)#siUe',"'\\2'=='&' ? '?' : ''",$url);
		$url=preg_replace('#\&'.$param.'=(.*)(&|$)#siU','\\2',$url);
	}
	
	return HTTP_HOST.str_replace('&','&amp;',$url);
}



//Druckversion
if ( $_REQUEST['print']=='1' ) {
	$currenturl=main_filter_url(array('print'));
	
	$apx->tmpl->assign_static('WEBSITE_NAME',$set['main']['websitename']);
	$apx->tmpl->assign_static('WEBSITE_URL',HTTP);
	$apx->tmpl->assign_static('CURRENT_URL',$currenturl);
	
	$apx->tmpl->loaddesign('print');
}



//Seite empfehlen
if ( $_REQUEST['tell']=='1' && $set['main']['tell'] ) {
	$apx->module('main');
	$apx->lang->drop('tell');
	
	headline($apx->lang->get('HEADLINE'),str_replace('&','&amp;',$_SERVER['REQUEST_URI']));
	titlebar($apx->lang->get('HEADLINE'));
	
	if ( $_POST['send'] ) {
		
		//Captcha pr�fen
		if ( $set['main']['tellcaptcha'] && !$user->info['userid'] ) {
			require(BASEDIR.'lib/class.captcha.php');
			$captcha=new captcha;
			$captchafailed=$captcha->check();
		}
	
		if ( $captchafailed  ) message($apx->lang->get('MSG_WRONGCODE'),'javascript:history.back()');
		elseif ( !$_POST['username'] || !$_POST['email'] || !$_POST['toemail'] || !$_POST['subject'] || !$_POST['text'] ) message('back');
		elseif ( !checkmail($_POST['email']) || !checkmail($_POST['toemail']) ) message($apx->lang->get('MSG_MAILNOTVALID'),'back');
		else {
			
			//Captcha l�schen
			if ( $set['main']['tellcaptcha'] && !$user->info['userid'] ) {
				$captcha->remove();
			}
			
			mail($_POST['toemail'],$_POST['subject'],$_POST['text'],'From: '.$_POST['username'].'<'.$_POST['email'].'>');
			message($apx->lang->get('MSG_OK'),main_filter_url(array('tell')));
		}
		
		//SCRIPT BEENDEN
		require(BASEDIR.'lib/_end.php');
	}
	
	//Captcha erstellen
	if ( $set['main']['tellcaptcha'] && !$user->info['userid'] ) {
		require(BASEDIR.'lib/class.captcha.php');
		$captcha=new captcha;
		$captchacode=$captcha->generate();
	}
	
	$url=main_filter_url(array('tell'));
	$apx->tmpl->assign('POSTTO',$postto);
	$apx->tmpl->assign('TITLE',compatible_hsc($apx->lang->get('MAIL_TELL_TITLE')));
	$apx->tmpl->assign('TEXT',compatible_hsc($apx->lang->get('MAIL_TELL_TEXT',array('URL'=>$url))));
	$apx->tmpl->assign('CAPTCHA',$captchacode);
	
	$apx->tmpl->parse('tell');
	
	require(BASEDIR.'lib/_end.php');
}


?>