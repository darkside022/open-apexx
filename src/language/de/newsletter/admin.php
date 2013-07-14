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
$lang['modulename']['MODULENAME_NEWSLETTER'] = 'Newsletter';


/************** HEADLINES **************/
$lang['titles'] = array (
'TITLE_NEWSLETTER_SHOW' => 'Newsletter',
'TITLE_NEWSLETTER_ADD' => 'Newsletter erstellen',
'TITLE_NEWSLETTER_ADDNEWS' => 'Newsletter aus News erstellen',
'TITLE_NEWSLETTER_EDIT' => 'Newsletter bearbeiten',
'TITLE_NEWSLETTER_DEL' => 'Newsletter l�schen',
'TITLE_NEWSLETTER_SEND' => 'Newsletter versenden',
'TITLE_NEWSLETTER_PREVIEW' => 'Vorschau versenden',
'TITLE_NEWSLETTER_ESHOW' => 'Newsletter-Empf�nger',
'TITLE_NEWSLETTER_EADD' => 'Newsletter-Empf�nger hinzuf�gen',
'TITLE_NEWSLETTER_EEDIT' => 'Newsletter-Empf�nger bearbeiten',
'TITLE_NEWSLETTER_EDEL' => 'Newsletter-Empf�nger l�schen',
'TITLE_NEWSLETTER_EENABLE' => 'Newsletter-Empf�nger aktivieren',
'TITLE_NEWSLETTER_EIMPORT' => 'Newsletter-Empf�nger importieren',
'TITLE_NEWSLETTER_CATSHOW' => 'Kategorien verwalten'
);


/************** NAVIGATION **************/
$lang['navi'] = array (
'NAVI_NEWSLETTER_SHOW' => 'Newsletter zeigen',
'NAVI_NEWSLETTER_ADD' => 'Neuer Newsletter',
'NAVI_NEWSLETTER_ESHOW' => 'Empf�nger zeigen',
'NAVI_NEWSLETTER_EIMPORT' => 'Empf�nger importieren',
'NAVI_NEWSLETTER_CATSHOW' => 'Kategorien'
);


/************** ACTION EXPLICATION **************/
$lang['expl'] = array (

);


/************** LOG MESSAGES **************/
$lang['log'] = array (
'LOG_NEWSLETTER_ADD' => 'Newsletter erstellt',
'LOG_NEWSLETTER_EDIT' => 'Newsletter bearbeitet',
'LOG_NEWSLETTER_DEL' => 'Newsletter gel�scht',
'LOG_NEWSLETTER_SEND' => 'Newsletter verschickt',
'LOG_NEWSLETTER_EADD' => 'Newsletter-Empf�nger hinzugef�gt',
'LOG_NEWSLETTER_EEDIT' => 'Newsletter-Empf�nger bearbeitet',
'LOG_NEWSLETTER_EDEL' => 'Newsletter-Empf�nger gel�scht',
'LOG_NEWSLETTER_EENABLE' => 'Newsletter-Empf�nger aktiviert',
'LOG_NEWSLETTER_EIMPORT' => 'Newsletter-Empf�nger importiert',
'LOG_NEWSLETTER_CATADD' => 'Newsletter-Kategorie erstellt',
'LOG_NEWSLETTER_CATEDIT' => 'Newsletter-Kategorie bearbeitet',
'LOG_NEWSLETTER_CATDEL' => 'Newsletter-Kategorie gel�scht'
);


/************** MEDIAMANAGER **************/
$lang['media'] = array (
'MM_USEIMAGE' => 'Bild verwenden',
'MM_USESWF' => 'Flash verwenden'
);


/************** CONFIG **************/
$lang['config'] = array (
'REGCODE' => 'Anmeldung/Abmeldung muss best�tigt werden?',
'SIG_TEXT' => 'Signatur f�r Text-Newsletter:',
'SIG_HTML' => 'Signatur f�r HTML-Newsletter (HTML-Codes erlaubt):'
);


/************** ACTIONS **************/

//SHOW
$lang['actions']['show'] = array (
'CURRENTREC' => 'Aktuelle Empf�ngerzahl',
'COL_SUBJECT' => 'Betreff',
'COL_CATEGORY' => 'Kategorie',
'COL_SENDTIME' => 'Verschickt am...',
'SORT_ADDTIME' => 'Erstellungsdatum',
'ISSEND' => 'Verschickt',
'SEND' => 'Verschicken',
'PREVIEW' => 'Vorschau senden',
'NONE' => 'Noch keine Newsletter erstellt!'
);


//ADD + EDIT
$lang['actions']['add'] = $lang['actions']['edit'] = array (
'SUBJECT' => 'Betreff',
'TEXT' => 'Text-Newsletter',
'HTMLTEXT' => 'HTML-Newsletter',
'CATEGORY' => 'Kategorie',
'ADDSIG' => 'Signatur anf�gen?',
'SENDNOW' => 'Newsletter sofort verschicken',
'SUBMIT_ADD' => 'Newsletter erstellen',
'SUBMIT_EDIT' => 'Aktualisieren'
);


//ADDNEWS
$lang['actions']['addnews'] = array_merge($lang['actions']['add'],array(
'PERIOD' => 'Zeitraum',
'LAST' => 'Die letzten',
'DAYS' => 'Tage',
'WEEKS' => 'Wochen',
'MONTHS' => 'Monate',
'SECTION' => 'In dieser Sektion anzeigen',
'ALLSEC' => 'Alle Sektionen',
'LISTNEWS' => 'News-Meldungen auflisten',
'PREVIOUS' => 'Zur�ck',
'NEXT' => 'Weiter',
'FINISH' => 'Auswahl beenden &amp Newsletter erstellen'
));


//DEL
$lang['actions']['del'] = array (
'MSG_TEXT' => 'Wollen Sie den Newsletter &quot;{TITLE}&quot; wirklich l�schen?'
);


//SEND
$lang['actions']['send'] = array (
'MSG_SEND' => 'Soll der Newsletter &quot;{TITLE}&quot; jetzt verschickt werden?',
'SEND' => 'Verschicken',
'MSG_SENDING' => 'Die Newsletter werden gerade verschickt. Verlassen Sie diese Seite nicht, bis der Newsletter vollst�ndig verschickt wurde.',
'MSG_OK' => 'Der Newsletter wurde verschickt!'
);


//PREVIEW
$lang['actions']['preview'] = array (
'SENDTO' => 'Vorschau-eMails senden an',
'SEND' => 'Senden',
'MSG_OK' => 'Die Vorschau-eMails wurden verschickt!'
);


//ESHOW
$lang['actions']['eshow'] = array (
'LAYER_ALL' => 'Alle',
'LAYER_INACTIVE' => 'Nicht aktiviert',
'SEARCHTEXT' => 'Stichwort',
'SEARCH' => 'Suchen',
'COL_EMAIL' => 'eMail',
'COL_CATEGORIES' => 'Kategorien',
'NOT_ACTIVE' => 'nicht aktiviert',
'NONE' => 'Keine Empf�nger gefunden!',
'MULTI_EDEL' => 'L�schen',
'MULTI_EENABLE' => 'Aktivieren',
);


//EADD
$lang['actions']['eadd'] = $lang['actions']['eedit'] = array (
'EMAIL' => 'eMail-Adresse',
'HTML' => 'HTML-Newsletter?',
'CATEGORIES' => 'Kategorien',
'ALL' => 'Alle',
'SUBMIT' => 'Adresse hinzuf�gen',
'UPDATE' => 'Aktualisieren',
'INFO_WRONGSYNTAX' => 'Das ist keine g�ltige eMail-Adresse!',
'INFO_EXISTS' => 'Diese eMail-Adresse existiert bereits in der Datenbank!'
);


//EDEL
$lang['actions']['edel'] = array (
'MSG_TEXT' => 'Wollen Sie die Adresse &quot;{TITLE}&quot; wirklich l�schen?'
);


//EENABLE
$lang['actions']['eenable'] = array (
'MSG_TEXT' => 'Wollen Sie die Adresse &quot;{TITLE}&quot; wirklich aktivieren?'
);


//EIMPORT
$lang['actions']['eimport'] = array (
'EMAIL' => 'eMail-Adressen',
'EMAIL_INFO' => 'Jeweils eine Adresse pro Zeile',
'HTML' => 'HTML-Newsletter?',
'CATEGORIES' => 'Kategorien',
'ALL' => 'Alle',
'SUBMIT' => 'Adressen hinzuf�gen',
'INFO_WRONGSYNTAX' => 'Die folgenden sind keine g�ltigen eMail-Adressen: {EMAILS}'
);


//CATSHOW
$lang['actions']['catshow'] = array (
'COL_TITLE' => 'Bezeichnung',
'NONE' => 'Noch keine Kategorien erstellt!',
'CATADD' => 'Kategorie erstellen',
'CATEDIT' => 'Aktualisieren',
'MSG_TEXT' => 'Soll diese Kategorie wirklich gel�scht werden?'
);


?>