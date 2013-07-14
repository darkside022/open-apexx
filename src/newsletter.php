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

////////////////////////////////////////////////////////////////////////////////////////////////////////
require('lib/_start.php');  //////////////////////////////////////////////////////////// SYSTEMSTART ///
////////////////////////////////////////////////////////////////////////////////////////////////////////

$apx->module('newsletter');
$apx->lang->drop('form');
headline($apx->lang->get('HEADLINE'),mklink('newsletter.php','newsletter.html'));
titlebar($apx->lang->get('HEADLINE'));

$_REQUEST['activate']=(int)$_REQUEST['activate'];

////////////////////////////////////////////////////////////////////////////////////////////////////////

//Aktivierungscode anfordern
if ( $_REQUEST['getcode'] ) {
	if ( !$set['newsletter']['regcode'] ) exit;
	$apx->lang->drop('getcode');
	
	if ( $_POST['send'] ) {
		list($aboId) = $db->first("SELECT id FROM ".PRE."_newsletter_emails WHERE email LIKE '".addslashes_like($_POST['email'])."' LIMIT 1");
		
		if ( !$_POST['email'] ) message('back');
		elseif ( !$aboId ) message($apx->lang->get('MSG_NOEMAIL'),'back');
		else {
			
			$insert = array();
			$remove = array();
			
			//Abonnements
			$data = $db->fetch("
				SELECT catid, incode, outcode, active
				FROM ".PRE."_newsletter_emails_cat
				WHERE eid='".$aboId."' AND ( ( incode!='' AND active=0 ) OR outcode!='' )
			");
			foreach ( $data AS $res ) {
				if ( $res['outcode'] ) {
					$remove[] = $res['catid'];
				}
				if ( $res['incode'] && !$res['active'] ) {
					$insert[] = $res['catid'];
				}
			}
			
			//Anmeldungen
			if ( $insert ) {
				$inCode = random_string();
				$db->query("
					UPDATE ".PRE."_newsletter_emails_cat
					SET incode='".$inCode."'
					WHERE eid='".$aboId."' AND catid IN (".implode(', ', $insert).")
				");
				
				$selCategories = array();
				foreach ( $insert AS $catid ) {
					$selCategories[] = $set['newsletter']['categories'][$catid];
				}
				
				//Email senden
				$input['CATEGORIES']=implode(', ', $selCategories);
				$input['EMAIL']=$_POST['email'];
				$input['WEBSITE']=$set['main']['websitename'];
				$input['URL']=HTTP_HOST.mklink(
					'newsletter.php?activate='.$aboId.'&code='.$inCode,
					'newsletter.html?activate='.$aboId.'&code='.$inCode
				);
				sendmail($_POST['email'],'INSERT',$input);
			}
			
			//Abmeldungen
			if ( $remove ) {
				$outCode = random_string();
				$db->query("
					UPDATE ".PRE."_newsletter_emails_cat
					SET outcode='".$outCode."'
					WHERE eid='".$aboId."' AND catid IN (".implode(', ', $remove).")
				");
				
				$selCategories = array();
				foreach ( $remove AS $catid ) {
					$selCategories[] = $set['newsletter']['categories'][$catid];
				}
				
				//Email senden
				$input['CATEGORIES']=implode(', ', $selCategories);
				$input['EMAIL']=$_POST['email'];
				$input['WEBSITE']=$set['main']['websitename'];
				$input['URL']=HTTP_HOST.mklink(
					'newsletter.php?activate='.$aboId.'&code='.$outCode,
					'newsletter.html?activate='.$aboId.'&code='.$outCode
				);
				sendmail($_POST['email'],'DISCHARGE',$input);
			}
			
			//Msg
			if ( $insert || $remove ) {
				message($apx->lang->get('MSG_OK'),mklink('index.php','index.html'));
			}
			else {
				message($apx->lang->get('MSG_NOTHING'),'back');
			}
		}
	}
	
	$apx->tmpl->assign('POSTTO',mklink('newsletter.php?getcode=1','newsletter.html?getcode=1'));
	$apx->tmpl->parse('getcode');
	require('lib/_end.php');
}



//Aktivieren
if ( $_REQUEST['activate'] && $_REQUEST['code'] ) {
	if ( !$set['newsletter']['regcode'] ) exit;
	$apx->lang->drop('activate');
	
	list($id)=$db->first("SELECT id FROM ".PRE."_newsletter_emails WHERE id='".$_REQUEST['activate']."' LIMIT 1");
	
	//Abonnements
	$data = $db->fetch("
		SELECT catid, incode, outcode
		FROM ".PRE."_newsletter_emails_cat
		WHERE eid='".$id."' AND ( ( incode='".addslashes($_REQUEST['code'])."' AND active=0 ) OR outcode='".addslashes($_REQUEST['code'])."' )
	");
	
	if ( $data ) {
		$insert = true;
		foreach ( $data AS $res ) {
			if ( $res['outcode']==$_REQUEST['code'] ) {
				$insert = false;
				$db->query("
					DELETE FROM ".PRE."_newsletter_emails_cat
					WHERE eid='".$id."' AND catid='".$res['catid']."'
					LIMIT 1
				");
			}
			else {
				$db->query("
					UPDATE ".PRE."_newsletter_emails_cat
					SET active='1', incode=''
					WHERE eid='".$id."' AND catid='".$res['catid']."'
					LIMIT 1
				");
			}
		}
		
		if ( $insert ) {
			message($apx->lang->get('MSG_INSERT_OK'), mklink('index.php', 'index.html'));
		}
		else {
			
			//Pr�fen, ob alle Abos entfernt wurden => Acc l�schen
			list($aboCount) = $db->first("
				SELECT count(eid)
				FROM ".PRE."_newsletter_emails_cat
				WHERE eid='".$id."'
			");
			if ( !$aboCount ) {
				$db->query("
					DELETE FROM
					".PRE."_newsletter_emails
					WHERE id='".$id."'
					LIMIT 1
				");
			}
			
			message($apx->lang->get('MSG_DISCHARGE_OK'), mklink('index.php', 'index.html'));
		}
	}
	else {
		message($apx->lang->get('MSG_WRONGKEY'));
	}
	
	//SCRIPT BEENDEN
	require('lib/_end.php');
}



//Newsletter eintragen/austragen
if ( $_POST['send'] ) {
	$apx->lang->drop('send');
	
	if ( !$_POST['email'] || ( $_POST['action']=='in' && !count($_POST['catid']) ) ) message('back');
	elseif ( !checkmail($_POST['email']) ) message($apx->lang->get('MSG_NOVALIDEMAIL'),'back');
	else {
		
		//Ausw�hlte IDs
		$catinfo=$set['newsletter']['categories'];
		if ( !is_array($catinfo) ) $catinfo=array();
		$allIds = array_keys($catinfo);
		if ( $_POST['catid'][0]=='all' ) {
			$selectedIds = $allIds;
		}
		else {
			$selectedIds = array_unique(array_map('intval', $_POST['catid']));
		}
		
		//EINTRAGEN
		if ( $_POST['action']=='in' ) {
			
			//Bestehende Abonnements
			$aboCats = array();
			list($aboId)=$db->first("SELECT id FROM ".PRE."_newsletter_emails WHERE email='".addslashes($_POST['email'])."' LIMIT 1");
			if ( $aboId ) {
				$abos = $db->fetch("SELECT catid FROM ".PRE."_newsletter_emails_cat WHERE eid='".$aboId."' AND active=1");
				foreach ( $abos AS $abo ) {
					$aboCats[] = $abo['catid'];
				}
			}
			
			//Kategorien zum Eintragen vorhanden?
			$insertIds = array_diff($selectedIds, $aboCats);
			if ( !$insertIds ) {
				message($apx->lang->get('MSG_INSERT_OK'),mklink('index.php','index.html'));
			}
			else {
				
				//Email eintragen, falls noch nicht vorhanden
				if ( !$aboId ) {
					$db->query("
						INSERT INTO ".PRE."_newsletter_emails
						(email) VALUES
						('".addslashes($_POST['email'])."')
					");
					$aboId = $db->insert_id();
				}
				
				//Mit Best�tigung
				$inCode = '';
				if ( $set['newsletter']['regcode'] ) {
					$inCode = random_string(10);
					foreach ( $insertIds AS $catid ) {
						$db->query("
							INSERT IGNORE INTO ".PRE."_newsletter_emails_cat
							(eid, catid, active, html, incode) VALUES
							('".$aboId."', '".$catid."', '0', '".($_POST['html'] ? 1 : 0)."', '".$inCode."')
						");
						
						//Bereits eingetragen aber nicht aktiviert
						if ( $db->affected_rows()==0 ) {
							$db->query("
								UPDATE ".PRE."_newsletter_emails_cat
								SET incode='".$inCode."'
								WHERE eid='".$aboId."' AND catid='".$catid."'
								LIMIT 1
							");
						}
					}
					
					$selCategories = array();
					foreach ( $selectedIds AS $catid ) {
						$selCategories[] = $set['newsletter']['categories'][$catid];
					}
					
					//Email senden
					$input['CATEGORIES']=implode(', ', $selCategories);
					$input['EMAIL']=$_POST['email'];
					$input['WEBSITE']=$set['main']['websitename'];
					$input['URL']=HTTP_HOST.mklink(
						'newsletter.php?activate='.$aboId.'&code='.$inCode,
						'newsletter.html?activate='.$aboId.'&code='.$inCode
					);
					sendmail($_POST['email'],'INSERT',$input);
					
					message($apx->lang->get('MSG_INSERT_OK_EMAIL'),mklink('index.php','index.html'));
				}
				
				//Ohne Best�tigung
				else {
					foreach ( $insertIds AS $catid ) {
						$db->query("
							INSERT IGNORE INTO ".PRE."_newsletter_emails_cat
							(eid, catid, active, html) VALUES
							('".$aboId."', '".$catid."', '1', '".($_POST['html'] ? 1 : 0)."')
						");
						
						//Bereits eingetragen aber nicht aktiviert
						if ( $db->affected_rows()==0 ) {
							$db->query("
								UPDATE ".PRE."_newsletter_emails_cat
								SET active=1, incode=''
								WHERE eid='".$aboId."' AND catid='".$catid."'
								LIMIT 1
							");
						}
					}
					
					
					message($apx->lang->get('MSG_INSERT_OK'),mklink('index.php','index.html'));
				}
			}
		}
		
		//AUSTRAGEN
		elseif ( $_POST['action']=='out' ) {
			list($aboId)=$db->first("SELECT id FROM ".PRE."_newsletter_emails WHERE email='".addslashes($_POST['email'])."' LIMIT 1");
			if ( !$aboId ) message($apx->lang->get('MSG_NOTFOUND'),'back');
			else {
				
				//Bestehende Abonnements
				$aboCats = array();
				$abos = $db->fetch("SELECT catid FROM ".PRE."_newsletter_emails_cat WHERE eid='".$aboId."'");
				foreach ( $abos AS $abo ) {
					$aboCats[] = $abo['catid'];
				}
				
				//Kategorien zum Eintragen vorhanden?
				$removeIds = array_intersect($selectedIds, $aboCats);
				if ( !$removeIds ) {
					message($apx->lang->get('MSG_DISCHARGE_OK'),mklink('index.php','index.html'));
				}
				else {
					
					//Mit Best�tigung
					$outCode = '';
					if ( $set['newsletter']['regcode'] ) {
						$outCode = random_string(10);
						foreach ( $removeIds AS $catid ) {
							$db->query("
								UPDATE ".PRE."_newsletter_emails_cat
								SET outcode='".$outCode."'
								WHERE eid='".$aboId."' AND catid='".$catid."'
								LIMIT 1
							");
						}
						
						$selCategories = array();
						foreach ( $selectedIds AS $catid ) {
							$selCategories[] = $set['newsletter']['categories'][$catid];
						}
						
						//Email senden
						$input['CATEGORIES']=implode(', ', $selCategories);
						$input['EMAIL']=$_POST['email'];
						$input['WEBSITE']=$set['main']['websitename'];
						$input['URL']=HTTP_HOST.mklink(
							'newsletter.php?activate='.$aboId.'&code='.$outCode,
							'newsletter.html?activate='.$aboId.'&code='.$outCode
						);
						sendmail($_POST['email'],'DISCHARGE',$input);
						
						message($apx->lang->get('MSG_DISCHARGE_OK_EMAIL'),mklink('index.php','index.html'));
					}
					
					//Ohne Best�tigung
					else {
						foreach ( $removeIds AS $catid ) {
							$db->query("
								DELETE FROM ".PRE."_newsletter_emails_cat
								WHERE eid='".$aboId."' AND catid='".$catid."'
								LIMIT 1
							");
						}
						
						//Abo komplett entfernen
						if ( count($aboCats)==count($removeIds) ) {
							$db->query("
								DELETE FROM
								".PRE."_newsletter_emails
								WHERE id='".$aboId."'
								LIMIT 1
							");
						}
						
						message($apx->lang->get('MSG_DISCHARGE_OK'),mklink('index.php','index.html'));
					}
				}
			}
		}
	
	}
	
	//SCRIPT BEENDEN
	require('lib/_end.php');
}



//Kategorien
$catinfo=$set['newsletter']['categories'];
if ( !is_array($catinfo) ) $catinfo=array();
asort($catinfo);

foreach ( $catinfo AS $id => $name ) {
	++$i;
	$catdata[$i]['ID']=$id;
	$catdata[$i]['TITLE']=$name;
}

$apx->tmpl->assign('POSTTO',mklink('newsletter.php','newsletter.html'));
$apx->tmpl->assign('LINK_GETCODE',mklink('newsletter.php?getcode=1','newsletter.html?getcode=1'));
$apx->tmpl->assign('CATEGORY',$catdata);
$apx->tmpl->parse('form');


////////////////////////////////////////////////////////////////////////////////////////////////////////
require('lib/_end.php');  /////////////////////////////////////////////////////////// SCRIPT BEENDEN ///
////////////////////////////////////////////////////////////////////////////////////////////////////////

?>