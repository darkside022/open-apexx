<?php 

/***************************************************************\
|                                                               |
|                   apexx CMS & Portalsystem                    |
|                 ============================                  |
|           (c) Copyright 2005-2006, Christian Scheb            |
|                  http://www.stylemotion.de                    |
|                                                               |
|---------------------------------------------------------------|
| THIS SOFTWARE IS NOT FREE! MAKE SURE YOU OWN A VALID LICENSE! |
| DO NOT REMOVE ANY COPYRIGHTS WITHOUT PERMISSION!              |
| SOFTWARE BELONGS TO ITS AUTHORS!                              |
\***************************************************************/



//Security-Check
if ( !defined('APXRUN') ) die('You are not allowed to execute this file directly!');


//Diese Klasse dient zur Initialisierung des Benutzersystems!

class user {

var $forumconn = null;
var $info=array();

//////////////////////////////////////////////////////////////////////////////////////////// STARTUP

function init() {
	global $set,$db,$apx;
	
	//Login �ber Cookies
	if ( $_COOKIE[$set['forum_cookiename_userid']] && $_COOKIE[$set['forum_cookiename_password']] ) {
		$forumdb = $this->getForumConn();
		$userid = $_COOKIE[$set['forum_cookiename_userid']];
		$password = $_COOKIE[$set['forum_cookiename_password']];
		$this->info = $forumdb->first("
			SELECT 
			userid,username,email,2 AS groupid, 'Benutzer' AS name, 'public' AS gtype, 'all' AS section_access
			FROM ".VBPRE."user
			WHERE userid='".intval($userid)."' AND MD5(CONCAT(password,'".addslashes($set['forum_cookie_salt'])."'))='".addslashes($password)."' AND usergroupid!=3
			LIMIT 1
		",1);
		
		//Invalide Benutzerdaten => Logout erzwingen
		if ( !$set['forum_invalidlogin_ignore'] && ( !$this->info['userid'] || !$this->info['active'] ) && $apx->module()!='user' && $_REQUEST['action']!='logout' ) {
			$link=mklink(
				'user.php?action=logout',
				'user,logout.html'
			);
			header('location:'.$link);
			exit;
		}
		
		//Autologin im Forum
		if ( $set['forum_autologin'] && !$_COOKIE[$set['forum_cookiename_session']] ) {
			$this->createForumSession($userid);
		}
		
		$this->info['buddies']=$this->get_buddies();
		$this->update_lastonline();
	}
	
	//Login �ber Session
	elseif ( $_COOKIE[$set['forum_cookiename_session']] ) {
		$forumdb = $this->getForumConn();
		$session = $_COOKIE[$set['forum_cookiename_session']];
		$idhash = $this->getIdHash();
		list($userid) = $forumdb->first("SELECT userid FROM ".VBPRE."session WHERE sessionhash='".addslashes($session)."' AND idhash='".$idhash."'");
		
		//Invalide Benutzerdaten => Logout erzwingen
		if ( !$userid && !$set['forum_invalidlogin_ignore'] ) {
			$link=mklink(
				'user.php?action=logout',
				'user,logout.html'
			);
			header('location:'.$link);
			exit;
		}
		
		//Benutzerinfo auslesen
		$this->info = $forumdb->first("
			SELECT 
			userid,username,email,2 AS groupid, 'Benutzer' AS name, 'public' AS gtype, 'all' AS section_access
			FROM ".VBPRE."user
			WHERE userid='".intval($userid)."' AND usergroupid!=3
			LIMIT 1
		",1);
		
		//Invalide Benutzerdaten => Logout erzwingen
		if ( !$set['forum_invalidlogin_ignore'] && ( !$this->info['userid'] || !$this->info['active'] ) && $apx->module()!='user' && $_REQUEST['action']!='logout' ) {
			$link=mklink(
				'user.php?action=logout',
				'user,logout.html'
			);
			header('location:'.$link);
			exit;
		}
	}
	
	//Nicht angemeldet
	else {
		$this->info=$db->first("SELECT * FROM ".PRE."_user_groups WHERE groupid='3' LIMIT 1",1);
		$this->info['buddies']=array();
	}
	
	$apx->lang->langid($this->info['pub_lang']);
	$this->update_onlinelist();
}



//Buddie-Liste holen
function get_buddies($buddies=false) {
	global $db;
	return array();
}



//Zuletzt online aktualisieren
function update_lastonline() {
	
}



//Onlineliste
function update_onlinelist() {
	
}



//IDHash erzeugen
function getIdHash() {
	return md5($_SERVER['HTTP_USER_AGENT'].$this->fetch_substr_ip($this->fetch_alt_ip()));
}



//vBulletin-Funktion fetch_substr_ip()
function fetch_substr_ip($ip) {
	global $set;
	$length = $set['forum_ipcheck'];
	return implode('.', array_slice(explode('.', $ip), 0, 4 - $length));
}



//vBulletin-Funktion fetch_alt_ip()
function fetch_alt_ip() {
	$alt_ip = $_SERVER['REMOTE_ADDR'];

	if (isset($_SERVER['HTTP_CLIENT_IP']))
	{
		$alt_ip = $_SERVER['HTTP_CLIENT_IP'];
	}
	else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) AND preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches))
	{
		// make sure we dont pick up an internal IP defined by RFC1918
		foreach ($matches[0] AS $ip)
		{
			if (!preg_match('#^(10|172\.16|192\.168)\.#', $ip))
			{
				$alt_ip = $ip;
				break;
			}
		}
	}
	else if (isset($_SERVER['HTTP_FROM']))
	{
		$alt_ip = $_SERVER['HTTP_FROM'];
	}

	return $alt_ip;
}



//Hat der User Admin-Rechte?
function is_team_member($userid=false) {
	global $set;
	if ( $_COOKIE[$set['main']['cookie_pre'].'_admin_userid'] ) return true;
	return false;
}



//Verbindung zum Forum herstellen
function getForumConn() {
	global $set;
	if ( is_null($this->forumconn) ) {
		$this->forumconn = new database(
			$set['forum_server'],
			$set['forum_user'],
			$set['forum_pwd'],
			$set['forum_db']
		);
		if ( $set['forum_pre'] ) define('VBPRE',$set['forum_pre']);
		else define('VBPRE','');
	}
	return $this->forumconn;
}



//Session im Forum erzeugen
function createForumSession($userid) {
	global $set,$db;
	$sessionhash = md5('vbsession_'.microtime().'_'.random_string(10));
	$idhash = $this->getIdHash();
	
	$host = substr($_SERVER['REMOTE_ADDR'], 0, 15);
	
	$insert = array(
		'sessionhash' => $sessionhash,
		'userid' => $userid,
		'host' => $host,
		'idhash' => $idhash,
		'lastactivity' => time(),
		'useragent' => addslashes($_SERVER['HTTP_USER_AGENT'])
	);
	
	$forumdb = $this->getForumConn();
	$forumdb->query("
		INSERT IGNORE INTO ".VBPRE."session
		(".implode(',',array_keys($insert)).")
		VALUES
		('".implode("','",$insert)."')
	");
	
	setcookie($set['forum_cookiename_session'],$sessionhash,time()+100*24*3600,$set['forum_cookie_path'],$set['forum_cookie_domain']);
	$_COOKIE[$set['forum_cookiename_session']] = $sessionhash;
}



//////////////////////////////////////////////////////////////////////////////////////////// AUSGABE GENERIEREN


//Signatur
function mksig($info,$nospacer=false) {
	return '';
}



//Profil-Link erzeugen
function mkprofile($userid,$username='') {
	global $set;
	$userid=(int)$userid;
	if ( !$userid ) return '#';
	return $set['forum_url'].'member.php?u='.$userid;
}



//Avatar
function mkavatar($info) {
	return '';
}



//Avatar-Titel
function mkavtitle($info) {
	return '';
}



//////////////////////////////////////////////////////////////////////////////////////////// BENUTZERVERWALTUNG

//User Info
function get_info($userid=false,$fields='*') {
	global $db;
	if ( $userid===false ) return $this->info;
	$userid=(int)$userid;
	$ff = explode(',',$fields);
	$ff = array_intersect($ff,array('userid','username'));
	$fields = implode(',',$ff);
	
	$forumdb = $this->getForumConn();
	$res=$forumdb->first("SELECT userid,".$fields." FROM ".VBPRE."user WHERE userid='".$userid."' LIMIT 1");
	$res['buddies']=array();
	
	return $res;
}



//Username checken
function block_username($username) {
	global $set,$apx;
	if ( !count($set['user']['blockusername']) ) return false;
	
	foreach ( $set['user']['blockusername'] AS $string ) {
		$strpos=strpos(strtolower($username),strtolower($string));
		if ( $strpos===false ) continue;
		return substr($username,$strpos,strlen($string));
	}
	
	return false;
}



//Pr�fen ob Benutzer ein Buddy ist
function is_buddy($id) {
	return false;
}

} //END CLASS

//Klasse sofort initialisieren f�r Sprachpaket und Userinfos
$user=new user;
$user->init();


?>