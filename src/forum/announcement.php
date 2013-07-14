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


define('APXRUN',true);
define('INFORUM',true);
define('BASEREL','../');

////////////////////////////////////////////////////////////////////////////////////////////////////////
require('../lib/_start.php');  ///////////////////////////////////////////////////////// SYSTEMSTART ///
require('lib/_start.php');     /////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////

$apx->lang->drop('thread');

$_REQUEST['id']=(int)$_REQUEST['id'];
if ( !$_REQUEST['id'] ) die('missing post-ID!');


//Ank�ndigung auslesen
$anninfo = $db->first("
	SELECT * FROM ".PRE."_forum_announcements
	WHERE id='".$_REQUEST['id']."'
	LIMIT 1
");
if ( !$anninfo ) filenotfound();


//Pr�fen, ob der Nutzer Zugang hat
$data = $db->fetch("SELECT forumid FROM ".PRE."_forum_anndisplay WHERE id='".$_REQUEST['id']."'");
$forumids = get_ids($data, 'forumid');

//Keine Foren-Ids vorhanden
if ( !count($forumids) ) {
	filenotfound();
}

//Zugang pr�fen
elseif ( !in_array(0, $forumids) ) {
	$access = false;
	foreach ( $forumids AS $fid ) {
		$foruminfo=forum_info($fid);
		if ( !$foruminfo['forumid'] ) continue;
		
		//Zugang erlaubt, alles ok
		if ( forum_access_read($foruminfo) && correct_forum_password($foruminfo) ) {
			$access = true;
			break;
		}
	}
	
	//Kein Zugang
	if ( !$access ) {
		tmessage('noright',array(),false,false);
	}
}


//Lastvisit f�r dieses Thema bestimmen
$lastvisit = max(array(
	$user->info['forum_lastonline'],
	announcement_readtime($anninfo['id'])
));
announcement_isread($anninfo['id']);



///////////////////////////////////////////////////////////////////////////////////////// BEITRAG

//Userinfo auslesen
if ( $anninfo['userid'] ) $userdat=$db->first("SELECT a.userid,a.username,a.groupid,a.reg_time,a.forum_posts,a.avatar,a.avatar_title,a.signature,a.homepage,a.city,a.icq,a.aim,a.yim,a.msn,a.skype,a.forum_lastactive,a.pub_invisible,a.custom1,a.custom2,a.custom3,a.custom4,a.custom5,a.custom6,a.custom7,a.custom8,a.custom9,a.custom10,b.gtype FROM ".PRE."_user AS a LEFT JOIN ".PRE."_user_groups AS b USING(groupid) WHERE a.userid='".$anninfo['userid']."' LIMIT 1");
else $userdat=array();

$mods=dash_unserialize($foruminfo['moderator']);

//Text
$text=forum_replace($anninfo['text'],true,true);

//Benutzerkennzeichen
$siganture=$avatar=$avatar_title='';
if ( $anninfo['userid'] ) {
	if ( $anninfo['allowsig'] ) $signature=$user->mksig($userdat);
	if ( $userdat['avatar'] ) {
		$avatar=$user->mkavatar($userdat);
		$avatar_title=$user->mkavtitle($userdat);
	}
}

//Rang
$rankinfo = get_rank($userdat);

$apx->tmpl->assign('ID',$anninfo['postid']);
$apx->tmpl->assign('TITLE',replace($anninfo['title']));
$apx->tmpl->assign('TEXT',$text);
$apx->tmpl->assign('TIME',$anninfo['starttime']);
$apx->tmpl->assign('USERNAME',replace($userdat['username']));
$apx->tmpl->assign('USERID',$anninfo['userid']);
$apx->tmpl->assign('USER_POSTS',$userdat['forum_posts']);
$apx->tmpl->assign('USER_REGTIME',$userdat['reg_time']);
$apx->tmpl->assign('IP',$anninfo['ip']);
$apx->tmpl->assign('HOMEPAGE',replace($userdat['homepage']));
$apx->tmpl->assign('AVATAR',$avatar);
$apx->tmpl->assign('AVATAR_TITLE',$avatar_title);
$apx->tmpl->assign('SIGNATURE',$signature);
$apx->tmpl->assign('CITY',replace($userdat['city']));
$apx->tmpl->assign('NEW',iif($anninfo['starttime']>$lastvisit,1,0));
$apx->tmpl->assign('ONLINE',iif(!$userdat['pub_invisible'] && $userdat['forum_lastactive']>time()-$set['user']['timeout']*60,1,0));
$apx->tmpl->assign('RANK',$rankinfo['title']);
$apx->tmpl->assign('RANK_IMAGE',$rankinfo['image']);
$apx->tmpl->assign('RANK_COLOR','#'.$rankinfo['color']);

//Custom-Felder
for ( $i=1; $i<=10; $i++ ) {
	$apx->tmpl->assign('CUSTOM'.$i.'_NAME',replace($set['user']['cusfield_names'][($i-1)]));
	$apx->tmpl->assign('CUSTOM'.$i,replace($userdat['custom'.$i]));
}

//Benutzertypen
if ( !$anninfo['userid'] ) $apx->tmpl->assign('IS_GUEST',1);
elseif ( $userdat['gtype']=='admin' ) $apx->tmpl->assign('IS_ADMIN',1);
elseif ( $userdat['gtype']=='indiv' ) $apx->tmpl->assign('IS_TEAM',1);
elseif ( in_array($anninfo['userid'],$mods) ) $apx->tmpl->assign('IS_MODERATOR',1);

//Kontakt
if ( $res['userid'] && $res['userid']!=$user->info['userid'] ) {
	$apx->tmpl->assign('LINK_SENDMAIL', mklink(
		'user.php?action=newmail&amp;touser='.$res['userid'],
		'user,newmail,'.$res['userid'].'.html'
	));
	$apx->tmpl->assign('LINK_SENDPM', mklink(
		'user.php?action=newpm&amp;touser='.$res['userid'],
		'user,newpm,'.$res['userid'].'.html'
	));
}
$apx->tmpl->assign('CONTACT_ICQ',replace($userdat['icq']));
$apx->tmpl->assign('CONTACT_MSN',replace($userdat['msn']));
$apx->tmpl->assign('CONTACT_AIM',replace($userdat['aim']));
$apx->tmpl->assign('CONTACT_YIM',replace($userdat['yim']));
$apx->tmpl->assign('CONTACT_SKYPE',replace($userdat['skype']));

//Optionen
if ( $res['userid'] ) {
	$apx->tmpl->assign('LINK_USERPOSTS', HTTPDIR.$set['forum']['directory'].'/search.php?send=1&author='.urlencode($res['username']));
	if ( !$user->is_buddy($res['userid']) ) {
		$apx->tmpl->assign('LINK_ADDBUDDY', mklink(
			'user.php?action=addbuddy&amp;id='.$res['userid'],
			'user,addbuddy,'.$res['userid'].'.html'
		));
	}
}

$apx->tmpl->parse('announcement');

////////////////////////////////////////////////////////////////////////////////////////////////////////

$path = array(array(
	'TITLE' => $apx->lang->get('ANNOUNCEMENTS'),
	'LINK' => compatible_hsc($_SERVER['REQUEST_URI'])
));

$apx->tmpl->assign_static('STYLESHEET',compatible_hsc($foruminfo['stylesheet']));
$apx->tmpl->assign('PATH',$path);
$apx->tmpl->assign('PATHEND',replace($anninfo['title']));
titlebar($apx->lang->get('ANNOUNCEMENT').': '.$anninfo['title']);


////////////////////////////////////////////////////////////////////////////////////////////////////////
require('lib/_end.php');     ///////////////////////////////////////////////////////////////////////////
require('../lib/_end.php');  //////////////////////////////////////////////////////// SCRIPT BEENDEN ///
////////////////////////////////////////////////////////////////////////////////////////////////////////

?>