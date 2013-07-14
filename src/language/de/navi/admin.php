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
$lang['modulename']['MODULENAME_NAVI'] = 'Navigation';


/************** HEADLINES **************/
$lang['titles'] = array (
'TITLE_NAVI_SHOW' => 'Navigation-�bersicht',
'TITLE_NAVI_ADD' => 'Navigationspunkt erstellen',
'TITLE_NAVI_EDIT' => 'Navigationspunkt bearbeiten',
'TITLE_NAVI_DEL' => 'Navigationspunkt l�schen',
'TITLE_NAVI_MOVE' => 'Navigationspunkt verschieben',
'TITLE_NEVI_GROUP' => 'Navigationsleisten anlegen'
);


/************** NAVIGATION **************/
$lang['navi'] = array (
'NAVI_NAVI_SHOW' => 'Navigation zeigen',
'NAVI_NAVI_GROUP' => 'Navigationsleisten anlegen'
);


/************** ACTION EXPLICATION **************/
$lang['expl'] = array (

);


/************** LOG MESSAGES **************/
$lang['log'] = array (
'LOG_NAVI_ADD' => 'Navigationspunkt erstellt',
'LOG_NAVI_EDIT' => 'Navigationspunkt bearbeitet',
'LOG_NAVI_DEL' => 'Navigationspunkt gel�scht',
'LOG_NAVI_GROUPADD' => 'Bannergruppe hinzugef�gt',
'LOG_NAVI_GROUPDEL' => 'Bannergruppe gel�scht',
);


/************** MEDIAMANAGER **************/
$lang['media'] = array (

);


/************** CONFIG **************/
$lang['config'] = array (
'COUNT' => 'Anzahl der verwendeten Navigationsleisten:'
);


/************** ACTIONS **************/

//SHOW
$lang['actions']['show'] = array (
'CHOOSE' => 'Bitte w�hlen Sie eine Navigationsleiste',
'COL_TEXT' => 'Linktext/Bezeichnung',
'USEDND' => 'Sie k�nnen die Navigationspunkte per Drag &amp; Drop anordnen',
'NONE' => 'Noch keine Navigationspunkte erstellt!'
);


//ADD + EDIT
$lang['actions']['add'] = $lang['actions']['edit'] = array (
'CREATEIN' => 'Unterpunkt von',
'ROOT' => 'Dies ist ein Hauptnavigationspunkt',
'TEXT' => 'Linktext/Bezeichnung',
'LINK' => 'Link',
'NEWWINDOW' =>'Neues Fenster?',
'CODE' => 'HTML-CODE',
'NOTHING' => 'Nichts',
'STATICSUB' => 'Untermen� immer anzeigen?',
'SUBMIT_ADD' => 'Navigationspunkt erstellen',
'SUBMIT_ADDNEXT' => 'Weiteren Navigationspunkt erstellen',
'SUBMIT_EDIT' => 'Aktualisieren'
);


//DEL
$lang['actions']['del'] = array (
'MSG_TEXT' => 'Wollen Sie den Navigationspunkt &quot;{TITLE}&quot; wirklich l�schen?'
);


//GROUP
$lang['actions']['group']= array (
'COL_TITLE' => 'Bezeichnung',
'COL_ENTRIES' => 'Eintr�ge',
'NONE' => 'Noch keine Navigationsleisten erstellt!',
'CATADD' => 'Navigationsleiste erstellen',
'CATEDIT' => 'Aktualisieren',
'MSG_TEXT' => 'Soll die Navigationsleiste &quot;{TITLE}&quot; wirklich gel�scht werden?<br /><b>ACHTUNG:</b> Wenn diese Navigationsleiste Eintr�ge besitzt, werden diese ebenfalls gel�scht.'
);


?>