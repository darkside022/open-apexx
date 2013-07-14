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



//Security-Checkf
if ( !defined('APXRUN') ) die('You are not allowed to execute this file directly!');


/////////////////////////////////////////////////////////////////////////////// RECHTE

//Rechte-Felder
$forum_rightfields=array(
	'right_visible',
	'right_read',
	'right_open',
	'right_announce',
	'right_post',
	'right_editpost',
	'right_delpost',
	'right_delthread',
	'right_addattachment',
	'right_readattachment'
);

//Vererbbare Felder
$forum_inheritfields=array_merge($forum_rightfields,array(
	'password'
));



//Forum-Passwort pr�fen
function check_forum_password($forum) {
	global $set;
	$forumid = $forum['password_fromid'] ? $forum['password_fromid'] : $forum['forumid'];
	if ( !$forum['password'] ) return true;
	if ( $_COOKIE[$set['main']['cookie_pre'].'_forum_password_'.$forumid]==$forum['password'] ) return true;
	
	if ( isset($_POST['password']) && $_POST['password']==$forum['password'] ) {
		setcookie($set['main']['cookie_pre'].'_forum_password_'.$forumid,$_POST['password'],time()+100*24*3600);
		return true;
	}
	else tmessage('forumpwd');
}



//Forum-Passwort ist korrekt?
function correct_forum_password($forum) {
	global $set;
	$forumid = $forum['password_fromid'] ? $forum['password_fromid'] : $forum['forumid'];
	if ( !$forum['password'] ) return true;
	if ( $_COOKIE[$set['main']['cookie_pre'].'_forum_password_'.$forumid]==$forum['password'] ) return true;
	return false;
}



//Forum sichtbar
function forum_access_visible($forum,$userinfo=false) {
	global $user;
	if ( $userinfo==false ) $userinfo=$user->info;
	if ( $userinfo['gtype']=='admin' ) return true; //Admins d�rfen immer
	if ( is_array($forum['moderator']) && in_array($userinfo['userid'],$forum['moderator']) ) return true; //Moderatoren d�rfen immer
	if ( $forum['right_visible']=='none' ) return false; //Sichtbar f�r Niemanden
	if ( $forum['right_visible']=='all' ) return true; //Sichtbar f�r Alle
	if ( in_array($userinfo['groupid'],dash_unserialize($forum['right_visible'])) ) return true; //Benutzergruppe hat Rechte
	return false;
}



//Leserechte
function forum_access_read($forum,$userinfo=false) {
	global $user;
	if ( $userinfo==false ) $userinfo=$user->info;
	if ( $userinfo['gtype']=='admin' ) return true; //Admins d�rfen immer
	if ( is_array($forum['moderator']) && in_array($userinfo['userid'],$forum['moderator']) ) return true; //Moderatoren d�rfen immer
	if ( $forum['right_read']=='none' ) return false; //Leserechte f�r Niemanden
	if ( $forum['right_read']=='all' ) return true; //Leserechte f�r alle
	if ( in_array($userinfo['groupid'],dash_unserialize($forum['right_read'])) ) return true; //Benutzergruppe hat Rechte
	return false;
}



//Themen er�ffnen
function forum_access_open($forum,$userinfo=false) {
	global $user;
	if ( $userinfo==false ) $userinfo=$user->info;
	if ( $userinfo['gtype']=='admin' ) return true; //Admins d�rfen immer
	if ( is_array($forum['moderator']) && in_array($userinfo['userid'],$forum['moderator']) ) return true; //Moderatoren d�rfen immer
	if ( !$forum['open'] ) return false; //Forum ist nicht offen
	if ( $forum['right_open']=='none' ) return false; //Themen erstellen f�r Niemanden
	if ( $forum['right_open']=='all' ) return true; //Themen erstellen f�r Alle
	if ( in_array($userinfo['groupid'],dash_unserialize($forum['right_open'])) ) return true; //Benutzergruppe hat Rechte
	return false;
}



//Ank�ndigungen erstellen
function forum_access_announce($forum,$userinfo=false) {
	global $user;
	if ( $userinfo==false ) $userinfo=$user->info;
	if ( $userinfo['gtype']=='admin' ) return true; //Admins d�rfen immer
	if ( is_array($forum['moderator']) && in_array($userinfo['userid'],$forum['moderator']) ) return true; //Moderatoren d�rfen immer
	if ( !$forum['open'] ) return false; //Forum ist nicht offen
	if ( $forum['right_announce']=='none' ) return false; //Ank�ndigungen erstellen f�r Niemanden
	if ( $forum['right_announce']=='all' ) return true; //Ank�ndigungen erstellen f�r Alle
	if ( in_array($userinfo['groupid'],dash_unserialize($forum['right_announce'])) ) return true; //Benutzergruppe hat Rechte
	return false;
}



//Beitr�ge schreiben
function forum_access_post($forum,$thread,$userinfo=false) {
	global $user;
	if ( $userinfo==false ) $userinfo=$user->info;
	if ( $userinfo['gtype']=='admin' ) return true; //Admins d�rfen immer
	if ( is_array($forum['moderator']) && in_array($userinfo['userid'],$forum['moderator']) ) return true; //Moderatoren d�rfen immer
	if ( !$forum['open'] ) return false; //Forum ist nicht offen
	if ( !$thread['open'] ) return false; //Thema ist nicht offen
	if ( $forum['right_post']=='none' ) return false; //Beitr�ge schreiben f�r Niemanden
	if ( $forum['right_post']=='all' ) return true; //Beitr�ge schreiben f�r Alle
	if ( in_array($userinfo['groupid'],dash_unserialize($forum['right_post'])) ) return true; //Benutzergruppe hat Rechte
	return false;
}



//Beitr�ge bearbeiten 
function forum_access_editpost($forum,$thread,$post,$userinfo=false) {
	global $user,$set;
	if ( $userinfo==false ) $userinfo=$user->info;
	if ( $userinfo['gtype']=='admin' ) return true; //Admins d�rfen immer
	if ( !$userinfo['userid'] ) return false; //G�ste d�rfen nie
	if ( is_array($forum['moderator']) && in_array($userinfo['userid'],$forum['moderator']) ) return true; //Moderatoren d�rfen immer
	if ( !$forum['open'] ) return false; //Forum ist nicht offen
	if ( !$thread['open'] ) return false; //Thema ist nicht offen
	if ( !$post['userid'] ) return false; //Beitrag von einem Gast
	if ( $forum['right_editpost']=='none' ) return false; //Beitr�ge bearbeiten f�r Niemanden
	
	//Beitr�ge bearbeiten f�r Alle oder Benutzergruppe hat Rechte
	if ( $forum['right_editpost']=='all' || in_array($userinfo['groupid'],dash_unserialize($forum['right_editpost'])) ) {
		if ( $post['userid']!=$userinfo['userid'] ) return false; //Nur eigene Beitr�ge bearbeiten
		if ( $set['forum']['edittime']>0 && $post['time']<time()-$set['forum']['edittime']*60 ) return false; //Nur 15 Min. lang bearbeiten
		return true;
	}
	
	return false;
}



//Beitr�ge l�schen
function forum_access_delpost($forum,$thread,$post,$userinfo=false) {
	global $user,$set;
	if ( $userinfo==false ) $userinfo=$user->info;
	if ( $userinfo['gtype']=='admin' ) return true; //Admins d�rfen immer
	if ( !$userinfo['userid'] ) return false; //G�ste d�rfen nie
	if ( is_array($forum['moderator']) && in_array($userinfo['userid'],$forum['moderator']) ) return true; //Moderatoren d�rfen immer
	if ( !$forum['open'] ) return false; //Forum ist nicht offen
	if ( !$thread['open'] ) return false; //Thema ist nicht offen
	if ( !$post['userid'] ) return false; //Beitrag von einem Gast
	if ( $forum['right_delpost']=='none' ) return false; //Beitr�ge l�schen f�r Niemanden
	
	//Beitr�ge l�schen f�r Alle oder Benutzergruppe hat Rechte
	if ( $forum['right_delpost']=='all' || in_array($userinfo['groupid'],dash_unserialize($forum['right_delpost'])) ) {
		if ( $post['userid']!=$userinfo['userid'] ) return false; //Nur eigene Beitr�ge l�schen
		if ( $set['forum']['edittime']>0 && $post['time']<time()-$set['forum']['edittime']*60 ) return false; //Nur 15 Min. lang l�schen
		return true;
	}
	
	return false;
}



//Beitr�ge wiederherstellen
function forum_access_recoverpost($forum,$thread,$post,$userinfo=false) {
	global $user,$set;
	if ( $userinfo==false ) $userinfo=$user->info;
	if ( !$post['del'] ) return false; //Beitrag ist nicht gel�scht
	if ( $userinfo['gtype']=='admin' ) return true; //Admins d�rfen immer
	if ( !$userinfo['userid'] ) return false; //G�ste d�rfen nie
	if ( is_array($forum['moderator']) && in_array($userinfo['userid'],$forum['moderator']) ) return true; //Moderatoren d�rfen immer
	
	return false;
}



//Themen l�schen
function forum_access_delthread($forum,$thread,$userinfo=false) {
	global $user,$set;
	if ( $userinfo==false ) $userinfo=$user->info;
	if ( $userinfo['gtype']=='admin' ) return true; //Admins d�rfen immer
	if ( !$userinfo['userid'] ) return false; //G�ste d�rfen nie
	if ( is_array($forum['moderator']) && in_array($userinfo['userid'],$forum['moderator']) ) return true; //Moderatoren d�rfen immer
	if ( !$forum['open'] ) return false; //Forum ist nicht offen
	if ( !$thread['open'] ) return false; //Thema ist nicht offen
	if ( !$thread['opener_userid'] ) return false; //Thema von einem Gast
	if ( $forum['right_delthread']=='none' ) return false; //Themen l�schen f�r Niemanden
	
	//Themen l�schen f�r Alle oder Benutzergruppe hat Rechte
	if ( $forum['right_delthread']=='all' || in_array($userinfo['groupid'],dash_unserialize($forum['right_delthread'])) ) {
		if ( $thread['opener_userid']!=$userinfo['userid'] ) return false; //Nur eigene Themen l�schen
		if ( $set['forum']['edittime']>0 && $thread['opentime']<time()-$set['forum']['edittime']*60 ) return false; //Nur 15 Min. lang l�schen
		return true;
	}
	
	return false;
}



//Themen wiederherstellen
function forum_access_recoverthread($forum,$thread,$userinfo=false) {
	global $user,$set;
	if ( $userinfo==false ) $userinfo=$user->info;
	if ( !$thread['del'] ) return false; //Beitrag ist nicht gel�scht
	if ( $userinfo['gtype']=='admin' ) return true; //Admins d�rfen immer
	if ( !$userinfo['userid'] ) return false; //G�ste d�rfen nie
	if ( is_array($forum['moderator']) && in_array($userinfo['userid'],$forum['moderator']) ) return true; //Moderatoren d�rfen immer
	
	return false;
}



//Anh�nge hochladen
function forum_access_addattachment($forum,$userinfo=false) {
	global $user;
	if ( $userinfo==false ) $userinfo=$user->info;
	if ( $userinfo['gtype']=='admin' ) return true; //Admins d�rfen immer
	if ( is_array($forum['moderator']) && in_array($userinfo['userid'],$forum['moderator']) ) return true; //Moderatoren d�rfen immer
	if ( !$forum['open'] ) return false; //Forum ist nicht offen
	if ( $forum['right_addattachment']=='none' ) return false; //Anh�nge hochladen f�r Niemanden
	if ( $forum['right_addattachment']=='all' ) return true; //Anh�nge hochladen f�r Alle
	if ( in_array($userinfo['groupid'],dash_unserialize($forum['right_addattachment'])) ) return true; //Benutzergruppe hat Rechte
	return false;
}



//Anh�nge lesen
function forum_access_readattachment($forum,$userinfo=false) {
	global $user;
	if ( $userinfo==false ) $userinfo=$user->info;
	if ( $userinfo['gtype']=='admin' ) return true; //Admins d�rfen immer
	if ( is_array($forum['moderator']) && in_array($userinfo['userid'],$forum['moderator']) ) return true; //Moderatoren d�rfen immer
	if ( $forum['right_readattachment']=='none' ) return false; //Leserechte f�r Niemanden
	if ( $forum['right_readattachment']=='all' ) return true; //Leserechte f�r alle
	if ( in_array($userinfo['groupid'],dash_unserialize($forum['right_readattachment'])) ) return true; //Benutzergruppe hat Rechte
	return false;
}



//Admin-Tools
function forum_access_admin($forum,$userinfo=false) {
	global $user;
	if ( $userinfo==false ) $userinfo=$user->info;
	if ( $userinfo['gtype']=='admin' ) return true; //Admins d�rfen immer
	if ( is_array($forum['moderator']) && in_array($userinfo['userid'],$forum['moderator']) ) return true; //Moderatoren d�rfen immer
	return false; //Alle anderen d�rfen nie
}



/////////////////////////////////////////////////////////////////////////////// FOREN-INFO

$forumcache=array();

//Foren-Struktur auslesen
function forum_readout($forum=false) {
	global $set,$db,$apx,$forum_inheritfields;
	
	require_once(BASEDIR.'lib/class.recursivetree.php');
	$tree = new RecursiveTree(PRE.'_forums', 'forumid');
	$data = $tree->getTree(array('*'), $forum ? $forum : null);
	
	$lastlevel = 0;
	$handdown=array();
	
	//Parent-Forum auslesen
	if ( $forum ) {
		$parentinfo = forum_info($forum);
		$inheritData = array();
		foreach ( $forum_inheritfields AS $fieldname ) {
			$inheritData[$fieldname]=$parentinfo[$fieldname];
		}
		$handdown[] = $inheritData;
	}
	
	foreach ( $data AS $key => $res ) {
		
		//Moderatoren
		$res['moderator']=dash_unserialize($res['moderator']);
		
		//Vererbbare Daten entfernen, wenn vorheriges = aktuelles Level
		if ( $lastlevel==$res['level'] ) {
			array_pop($handdown);
		}
		
		//Rechte vererben
		if ( $res['inherit'] ) {
			$res = array_merge($res, $handdown[count($handdown)-1]);
		}
		
		//Vererbbare Rechte
		$inheritData = array();
		foreach ( $forum_inheritfields AS $fieldname ) {
			$inheritData[$fieldname]=$res[$fieldname];
		}
		$inheritData['password_fromid'] = $res['password_fromid'] ? $res['password_fromid'] : $res['forumid'];
		$handdown[] = $inheritData;
		
		//Daten speichern
		$data[$key] = $res;
		
		$lastlevel = $res['level'];
	}
	
	return $data;
}



//Forum-Info auslesen
function forum_info($forumid,$norights=false) {
	global $set,$db,$apx,$forum_rightfields,$forumcache;
	$forumid=(int)$forumid;
	if ( !$forumid ) return array();
	
	//Cache
	if ( isset($forumcache[$forumid]) ) return $forumcache[$forumid];
	
	//Foren-Infos auslesen
	$info=$db->first("SELECT *,forumid AS password_fromid FROM ".PRE."_forums WHERE forumid='".$forumid."' LIMIT 1");
	if ( !$info['forumid'] ) return array();
	$info['moderator']=dash_unserialize($info['moderator']);
	
	//Info zur�ckgeben, wenn keine Rechte vererbt werden
	if ( !$info['inherit'] || $norights ) return $info;
	
	//Vererbte Eigenschaften auslesen
	$parentlist=dash_unserialize($info['parents']);
	if ( !count($parentlist) ) return $info;
	$data=$db->fetch("SELECT ".implode(',',$forum_rightfields).",forumid AS password_fromid,stylesheet,inherit FROM ".PRE."_forums WHERE forumid IN (".implode(',',$parentlist).") ORDER BY parents DESC",1);
	if ( count($data) ) {
		foreach ( $data AS $res ) {
			if ( !$res['inherit'] ) {
				$info=array_merge($info,$res); //Rechte einf�gen
				break;
			}
		}
	}
	
	$forumcache[$info['forumid']]=$info;
	return $info; //Info zur�ckgeben
}



/////////////////////////////////////////////////////////////////////////////// PR�FIXE

//Pr�fixe auslesen
function forum_prefixes($forumid=0) {
	global $set,$db,$apx,$user;
	$data = $db->fetch_index("
		SELECT prefixid, title, code
		FROM ".PRE."_forum_prefixes
		".($forumid ? "WHERE forumid='".$forumid."'" : '')."
		ORDER BY title ASC
	", 'prefixid');
	return $data;
}



//Bestimmtes Pr�fix auslesen
function forum_get_prefix($prefixId) {
	global $set,$db,$apx,$user;
	static $prefixes;
	if ( !isset($prefixes) ) {
		$prefixes = forum_prefixes();
	}
	return $prefixes[$prefixId]['code'];
}

?>