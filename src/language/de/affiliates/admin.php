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
$lang['modulename']['MODULENAME_AFFILIATES'] = 'Affiliates';


/************** HEADLINES **************/
$lang['titles'] = array (
'TITLE_AFFILIATES_SHOW' => 'Affiliates',
'TITLE_AFFILIATES_ADD' => 'Affiliate hinzuf�gen',
'TITLE_AFFILIATES_EDIT' => 'Affiliate bearbeiten',
'TITLE_AFFILIATES_DEL' => 'Affiliate l�schen',
'TITLE_AFFILIATES_ENABLE' => 'Affiliate aktivieren',
'TITLE_AFFILIATES_DISABLE' => 'Affiliate deaktivieren',
'TITLE_AFFILIATES_MOVE' => 'Affiliates anordnen'
);


/************** NAVIGATION **************/
$lang['navi'] = array (
'NAVI_AFFILIATES_SHOW' => 'Affiliates zeigen',
'NAVI_AFFILIATES_ADD' => 'Neues Affiliate'
);


/************** ACTION EXPLICATION **************/
$lang['expl'] = array (

);


/************** LOG MESSAGES **************/
$lang['log'] = array (
'LOG_AFFILIATES_ADD' => 'Affiliate hinzugef�gt',
'LOG_AFFILIATES_EDIT' => 'Affiliate bearbeitet',
'LOG_AFFILIATES_DEL' => 'Affiliate gel�scht',
'LOG_AFFILIATES_ENABLE' => 'Affiliate aktiviert',
'LOG_AFFILIATES_DISABLE' => 'Affiliate deaktiviert'
);


/************** CONFIG **************/
$lang['config'] = array (
'ORDERBY' => 'Affiliates sortieren nach:',
'ORDERADMIN' => 'Reihenfolge im Adminbereich festlegen',
'ORDERHITS_DESC' => 'Nach Klicks (meiste zuerst)',
'ORDERHITS_ASC' => 'Nach Klicks (wenigste zuerst)',
'ORDERRANDOM' => 'Zuf�llige Reihenfolge'
);


/************** ACTIONS **************/

//SHOW
$lang['actions']['show'] = array (
'COL_TITLE' => 'Titel',
'COL_IMAGE' => 'Bild',
'COL_HITS' => 'Klicks',
'USEDND' => 'Sie k�nnen die Eintr�ge per Drag &amp; Drop anordnen',
'NONE' => 'Bisher keine Affiliates eingetragen!'
);

//ADD + EDIT
$lang['actions']['add'] = $lang['actions']['edit'] = array (
'TITLE' => 'Titel',
'IMAGE' => 'Bild/Button',
'CURRENT' => 'Aktuelles Bild/Button',
'DELIMAGE' => 'Bild l�schen',
'NEWIMAGE' => 'Neues Bild/Button',
'LINK' => 'Link',
'PUBNOW' => 'Sofort freischalten?',
'SUBMIT_ADD' => 'Affiliate hinzuf�gen',
'SUBMIT_EDIT' => 'Aktualisieren',
'INFO_NOIMAGE' => 'Diese Datei ist kein g�ltiges Bild! Erlaubte Formate: GIF, JPG und PNG.'
);

//DEL
$lang['actions']['del']= array (
'MSG_TEXT' => 'Wollen Sie das Affiliate &quot;{TITLE}&quot; wirklich l�schen?'
);

//ENABLE
$lang['actions']['enable']= array (

);

//DISABLE
$lang['actions']['disable']= array (

);




?>