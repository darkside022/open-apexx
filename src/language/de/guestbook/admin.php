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

#
# German Language Pack
# ====================
#


/************** MODULE NAME **************/
$lang['modulename']['MODULENAME_GUESTBOOK'] = 'G�stebuch';


/************** HEADLINES **************/
$lang['titles'] = array (
'TITLE_GUESTBOOK_SHOW' => 'G�stebuch-Eintr�ge',
'TITLE_GUESTBOOK_EDIT' => 'G�stebuch-Eintrag bearbeiten',
'TITLE_GUESTBOOK_DEL' => 'G�stebuch-Eintrag l�schen',
'TITLE_GUESTBOOK_ENABLE' => 'G�stebuch-Eintrag freischalten',
'TITLE_GUESTBOOK_DISABLE' => 'G�stebuch-Eintrag sperren',
'TITLE_GUESTBOOK_COM' => 'G�stebuch-Eintrag kommentieren',
'TITLE_GUESTBOOK_BLOCKIP' => 'Gesperrte IPs',
'TITLE_GUESTBOOK_BLOCKCONTENT' => 'Verbotene Inhalte'
);


/************** NAVIGATION **************/
$lang['navi'] = array (
'NAVI_GUESTBOOK_SHOW' => 'Eintr�ge zeigen'
);


/************** ACTION EXPLICATION **************/
$lang['expl'] = array (

);


/************** LOG MESSAGES **************/
$lang['log'] = array (
'LOG_GUESTBOOK_EDIT' => 'G�stebuch-Eintrag bearbeitet',
'LOG_GUESTBOOK_DEL' => 'G�stebuch-Eintrag gel�scht',
'LOG_GUESTBOOK_ENABLE' => 'G�stebuch-Eintrag freigeschaltet',
'LOG_GUESTBOOK_DISABLE' => 'G�stebuch-Eintrag gesperrt',
'LOG_GUESTBOOK_COM' => 'G�stebuch-Eintrag kommentiert'
);


/************** CONFIG **************/
$lang['config'] = array (
'VIEW' => 'Darstellung',
'OPTIONS' => 'Einstellungen',
'CAPTCHA' => 'Eintrag muss visuell best�tigt werden (Captcha)?',
'MAXLEN' => 'Maximale Zeichenzahl eines Eintrags:',
'BREAKLINE' => 'Erzwungener Zeilenumbruch nach X Zeichen:<br />(0 = aus)',
'SPAMPROT' => 'Dauer in Minuten bis erneut ein Eintrag abgegeben werden kann:',
'MOD' => 'Eintr�ge m�ssen erst von einem Administrator freigeschaltet werden?',
'ALLOWSMILIES' => 'Smilies in den Eintr�gen erlauben?',
'ALLOWCODE' => 'Codes in den Eintr�gen erlauben?',
'BADWORDS' => 'Badword-Filter auf den Text anwenden?',
'EPP' => 'Eintr�ge pro Seite:',
'REQ_EMAIL' => 'Feld "eMail" muss ausgef�llt werden?',
'REQ_HOMEPAGE' => 'Feld "Homepage" muss ausgef�llt werden?',
'REQ_TITLE' => 'Feld "Titel" muss ausgef�llt werden?',
'CUSFIELD_NAMES' => 'Bezeichnungen der benutzerdefinierten Eingabefelder:<br />(maximal 5 Felder!)',
'MAILONNEW' => 'eMail an diese Adressen, wenn ein Eintrag gemacht wurde (mehrere Adressen durch Kommas trennen):'
);


/************** ACTIONS **************/

//SHOW
$lang['actions']['show'] = array (
'COL_NAME' => 'Name',
'COL_TEXT' => 'Text',
'COL_IP' => 'IP-Adresse',
'SORT_TIME' => 'Datum/Zeit',
'BLOCK' => 'IP sperren',
'ADDCOM' => 'Eintrag kommentieren',
'NONE' => 'Bisher keine G�stebuch-Eintr�ge erstellt!',
'MULTI_DEL' => 'L�schen',
'MULTI_ENABLE' => 'Freischalten',
'MULTI_DISABLE' => 'Sperren'
);

//EDIT
$lang['actions']['edit'] = array (
'USERNAME' => 'Benutzername',
'EMAIL' => 'eMail',
'HOMEPAGE' => 'Homepage',
'TITLE' => 'Titel',
'TEXT' => 'Text',
'CHARSLEFT' => 'Verbleibende Zeichen',
'SUBMIT' => 'Aktualisieren',
'INFO_TOOLONG' => 'Der Text ist l�nger als die Zeichenbeschr�nkung erlaubt!'
);

//DEL
$lang['actions']['del'] = array (
'MSG_TEXT' => 'Wollen Sie den G�stebuch-Eintrag von &quot;{TITLE}&quot; wirklich l�schen?'
);

//ENABLE
$lang['actions']['enable'] = array (

);

//DISABLE
$lang['actions']['disable'] = array (

);

//COM
$lang['actions']['com'] = array (
'USERNAME' => 'Benutzername',
'TEXT' => 'Text',
'DELCOM' => 'Kommentar l�schen',
'SUBMIT' => 'Aktualisieren'
);

//BLOCKIP
$lang['actions']['blockip'] = array (
'COL_IPRANGE' => 'IP / IP-Bereich',
'NONE' => 'Keine gesperrten IPs!',
'BLOCKIP' => 'IPs sperren',
'ONEIP' => 'Einzelne IP',
'IPRANGE' => 'IP-Bereich',
'SUBMIT' => 'Hinzuf�gen',
'MSG_DEL' => 'Wollen Sie den Eintrag &quot;{TITLE}&quot; wirklich aus der Sperrliste entfernen?'
);


//BLOCKSTRING
$lang['actions']['blockcontent'] = array (
'COL_STRING' => 'Verbotene Inhalte',
'NONE' => 'Keine verbotenen Inhalte!',
'BLOCKSTRING' => 'Zeichenkette verbieten',
'STRING' => 'Zeichenkette',
'JOKER' => '* als Jockerzeichen verwenden',
'SUBMIT' => 'Hinzuf�gen',
'MSG_DEL' => 'Wollen Sie den Eintrag &quot;{TITLE}&quot; wirklich aus der Sperrliste entfernen?'
);

?>