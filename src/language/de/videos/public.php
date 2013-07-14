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

$lang['global'] = array (
'HEADLINE' => 'Videos',
'HITS' => 'Klicks',
'COMMENTS' => 'Kommentare',
'TELL' => 'Empfehlen',
'BROKEN' => 'Defekt?',
'ICON_TOP' => 'Top!',
'ICON_NEW' => 'Neu!'
);


$lang['globalwohl'] = $lang['global'];
unset($lang['globalwohl']['HEADLINE']);


$lang['list'] = array(
'TOPVIDEOS_RATING' => 'Beste Bewertung',
'TOPVIDEOS_HITS' => 'Meiste Klicks',
'NEWVIDEOS' => 'Neueste Videos',
'COL_TITLE' => 'Titel',
'COL_SIZE' => 'Gr��e',
'COL_DATE' => 'Datum',
'COL_TEXT' => 'Beschreibung',
'SORTBY' => 'Sortieren nach',
'SORT_TITLE' => 'Titel',
'SORT_DATE' => 'Datum',
'SORT_HITS' => 'Klicks',
'SORT_UPLOADER' => 'Uploader',
'SORT_AUTHOR' => 'Autor',
'SORT_RATING' => 'Bewertung',
'ICON_ASC' => 'Aufsteigend',
'ICON_DESC' => 'Absteigend'
);


$lang['detail'] = array(
'PICTURES' => 'Bilder',
'NOPICS' => 'Keine Bilder',
'UPLOADER' => 'Uploader',
'DATE' => 'Datum',
'AUTHOR' => 'Autor',
'SIZE' => 'Dateigr��e',
'ESTTIME' => 'Gesch�tze Dauer',
'MODEM' => 'Modem',
'ISDN' => 'ISDN',
'DSL' => 'DSL',
'DOWNLOAD' => 'Download',
'DOWNLOADS' => 'Downloads',
'MIRRORS' => 'Mirrors',
'MSG_LIMITREACHED' => 'Das t�gliche Download-Limit wurde erreicht, bitte versuchen Sie es sp�ter noch einmal!',
'MSG_PWDREQUIRED' => 'Dieses Video ist durch ein Passwort gesch�tzt!',
'SUBMITPWD' => 'Passwort senden'
);


$lang['search'] = array (
'HEADLINE_SEARCH' => 'Suchergebnisse',
'SEARCH' => 'Videos suchen',
'ITEM' => 'Suchbegriffe',
'CONNAND' => 'UND-Verkn�pfung',
'CONNOR' => 'ODER-Verkn�pfung',
'CATEGORY' => 'Kategorie',
'ALL' => 'Alle',
'TIMEPERIOD' => 'Zeitraum',
'MSG_NORESULT' => 'Die Suchanfrage ergab keine Treffer!'
);


$lang['broken'] = array(
'MSG_TEXT' => 'Wollen Sie diesen Video wirklich als defekt melden?',
'MSG_BROKEN' => 'Danke f�r Ihren Hinweis! Sie werden nun weitergeleitet...',
'MAIL_BROKEN_TITLE' => 'Video defekt',
'MAIL_BROKEN_TEXT' => "Hallo,\nder folgende Video wurde soeben als defekt gemeldet: {URL}"
);


$lang['func_stats'] = array (
'CATEGORIES' => 'Kategorien',
'VIDEOS' => 'Videos',
'AVG_HITS' => 'Klicks durchschnittlich'
);


$lang['func_search'] = array (
'SEARCH_VIDEOS' => 'Videos'
);

?>