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
$lang['modulename']['MODULENAME_CALENDAR'] = 'Kalender';


/************** HEADLINES **************/
$lang['titles'] = array (
'TITLE_CALENDAR_SHOW' => 'Termin-�bersicht',
'TITLE_CALENDAR_ADD' => 'Termin eintragen',
'TITLE_CALENDAR_EDIT' => 'Termin bearbeiten',
'TITLE_CALENDAR_COPY' => 'Termin kopieren',
'TITLE_CALENDAR_DEL' => 'Termin l�schen',
'TITLE_CALENDAR_ENABLE' => 'Termin freischalten',
'TITLE_CALENDAR_DISABLE' => 'Termin widerrufen',
'TITLE_CALENDAR_CATSHOW' => 'Kategorien',
'TITLE_CALENDAR_CATADD' => 'Kategorie erstellen',
'TITLE_CALENDAR_CATEDIT' => 'Kategorie bearbeiten',
'TITLE_CALENDAR_CATCLEAN' => 'Kategorie leeren',
'TITLE_CALENDAR_CATDEL' => 'Kategorie l�schen',
'TITLE_CALENDAR_CATMOVE' => 'Kategorien anordnen'
);


/************** NAVIGATION **************/
$lang['navi'] = array (
'NAVI_CALENDAR_ADD' => 'Neuer Termin',
'NAVI_CALENDAR_SHOW' => 'Termine zeigen',
'NAVI_CALENDAR_CATSHOW' => 'Kategorien'
);


/************** ACTION EXPLICATION **************/
$lang['expl'] = array (

);


/************** LOG MESSAGES **************/
$lang['log'] = array (
'LOG_CALENDAR_ADD' => 'Termin eingetragen',
'LOG_CALENDAR_EDIT' => 'Termin bearbeitet',
'LOG_CALENDAR_COPY' => 'Termin kopiert',
'LOG_CALENDAR_DEL' => 'Termin gel�scht',
'LOG_CALENDAR_ENABLE' => 'Termin freigeschaltet',
'LOG_CALENDAR_DISABLE' => 'Termin widerrufen',
'LOG_CALENDAR_CATADD' => 'Termin-Kategorie erstellt',
'LOG_CALENDAR_CATEDIT' => 'Termin-Kategorie bearbeitet',
'LOG_CALENDAR_CATCLEAN' => 'Termin-Kategorie geleert',
'LOG_CALENDAR_CATDEL' => 'Termin-Kategorie gel�scht',
);


/************** CONFIG **************/
$lang['config'] = array (
'VIEW' => 'Darstellung',
'OPTIONS' => 'Einstellungen',
'IMAGES' => 'Bilder',
'SUBCATS' => 'Unter-Kategorien verwenden?',
'SEARCHABLE' => 'Soll das Modul in die Suchfunktion einbezogen werden?',
'SEARCHEPP' => 'Anzahl Termine pro Seite in den Suchergebnissen:',
'EVENTDAYS' => 'Anzahl der Tage in der Termin�bersicht:',
'START' => 'Standard-Ansicht der calendar.php:',
'START_DAY' => 'Tages-Ansicht',
'START_WEEK' => 'Wochen-Ansicht',
'START_MONTH' => 'Monats-Ansicht',
'SORTBY' => 'Termine sortieren nach:',
'SORTBY_TITLE' => 'Titel',
'SORTBY_TIME' => 'Termin-Beginn',
'PIC_WIDTH' => 'Maximale Breite des Aufmacher-Bilds:',
'PIC_HEIGHT' => 'Maximale H�he des Aufmacher-Bilds:',
'PIC_POPUP' => 'Aufmacher-Bild mit Popup in Originalgr��e?',
'PIC_POPUP_WIDTH' => 'Maximale Breite des Popup-Bilds:',
'PIC_POPUP_HEIGHT' => 'Maximale H�he des Popup-Bilds:',
'PIC_QUALITY' => 'Qualit�tiv hochwertigere Verkleinerung (rechenaufwendig!)?',
'USEREVENTS' => 'Benutzer d�rfen eigene Termine eintragen?',
'MAILONNEW' => 'eMail an diese Adressen, wenn ein �ffentlicher Termin eingesendet wurde (mehrere Adressen durch Kommas trennen):',
'CAPTCHA' => 'Einsenden eines Termins muss visuell best�tigt werden (Captcha)?',
'COMS' => 'Kommentare aktivieren?',
'NOTE' => 'Teilnahmevermerk f�r Termine aktivieren?'
);


/************** MEDIAMANAGER **************/
$lang['media'] = array (
'MM_INSERTPIC' => 'Als Aufmacher-Bild einf�gen',
'MM_INSERTTEXT' => 'In den Text einf�gen'
);


/************** ACTIONS **************/

//SHOW
$lang['actions']['show'] = array (
'LAYER_RECENT' => 'Aktuell',
'LAYER_SEND' => 'Eingesendete',
'LAYER_ARCHIVE' => 'Archiv',
'COL_TITLE' => 'Titel',
'COL_USER' => 'Benutzer',
'COL_CATEGORY' => 'Kategorie',
'COL_STARTEND' => 'Von, Bis',
'COL_HITS' => 'Klicks',
'SORT_ADDTIME' => 'Erstellungsdatum',
'SORT_STARTDAY' => 'Termin-Beginn',
'SORT_ENDDAY' => 'Termin-Ende',
'GUEST' => 'Gast',
'COPY' => 'Kopieren',
'SEARCHTEXT' => 'Stichwort',
'CATEGORY' => 'Kategorie',
'STITLE' => 'Titel',
'STEXT' => 'Text',
'PERIOD' => 'Zeitraum',
'SECTION' => 'Sektion',
'CATEGORY' => 'Kategorie',
'USERNAME' => 'Benutzer',
'SEARCH' => 'Suchen',
'NONE' => 'Keine Termine gefunden!',
'COMMENTS' => 'Kommentare zeigen'
);


//ADD + EDIT
$lang['actions']['add'] = $lang['actions']['edit']=array(
'AUTHOR' => 'Autor',
'GUEST' => 'Gast',
'SECTION' => 'In dieser Sektion anzeigen',
'ALLSEC' => 'Alle Sektionen',
'TITLE' => 'Titel',
'CATEGORY' => 'Kategorie',
'INLINESCREENS' => 'Inline-Bilder',
'TEXT' => 'Informationen',
'STARTDAY' => 'Beginn',
'TIMEOPTIONAL' => 'Uhrzeit optional',
'ENDDAY' => 'Ende',
'PICTURE' => 'Aufmacher-Bild',
'PICTURE_UPLOAD' => 'Hochladen',
'PICTURE_PATH' => 'Bild verwenden',
'LOCATION' => 'Ort',
'LOCATION_LINK' => 'Link zum Ort',
'SHOWPIC' => 'Bild anzeigen',
'DELPIC' => 'L�schen',
'LINKGALLERY' => 'Galerie verkn�pfen',
'PRIORITY' => 'Priorit�t',
'PRIORITY_HIGH' => 'Hoch',
'PRIORITY_NORMAL' => 'Normal',
'PRIORITY_LOW' => 'Niedrig',
'TAGS' => 'Tags',
'TAGSINFO' => 'einzelne Tags durch Kommas trennen',
'META_DESCRIPTION' => 'Meta Description',
'LINKS' => 'Angef�gte Links',
'LTITLE' => 'Titel',
'LTEXT' => 'Linktext',
'LURL' => 'URL',
'LPOP' => 'Neues Fenster?',
'LLINK' => 'Link:',
'NEWLINE' => 'Neue Zeile',
'OPTIONS' => 'Optionen',
'SEARCHABLE' => 'In die Suche einbeziehen',
'ALLOWCOMS' => 'Kommentare erlauben',
'ALLOWNOTE' => 'Teilnahmevermerk erlauben',
'RESTRICTED' => 'Altersabfrage aktivieren (ab 18 Jahren)',
'PUBNOW' => 'Sofort freischalten',
'INFO_NOTALLOWED' => 'Der Dateityp des Aufmacher-Bilds darf nicht hochgeladen werden!',
'INFO_NOIMAGE' => 'Der Dateityp des Aufmacher-Bilds ist keine g�ltige Bild-Datei!',
'SUBMIT_ADD' => 'Termin eintragen',
'SUBMIT_EDIT' => 'Aktualisieren'
);


//COPY
$lang['actions']['copy'] = array (
'COPY' => 'Kopieren',
'MSG_TEXT' => 'Wollen Sie den Termin &quot;{TITLE}&quot; wirklich kopieren?',
'COPYOF' => 'Kopie von: '
);


//DEL
$lang['actions']['del'] = array (
'MSG_TEXT' => 'Wollen Sie den Termin &quot;{TITLE}&quot; wirklich l�schen?'
);


//ENABLE
$lang['actions']['enable'] = array (
'MSG_TEXT' => 'Wollen Sie den Termin &quot;{TITLE}&quot; wirklich freischalten?',
'ENABLE' => 'Freischalten'
);


//DISABLE
$lang['actions']['disable'] = array (
'MSG_TEXT' => 'Wollen Sie den Termin &quot;{TITLE}&quot; wirklich widerrufen?',
'DISABLE' => 'Widerrufen'
);


//CATSHOW
$lang['actions']['catshow'] = array (
'COL_CATNAME' => 'Titel',
'COL_EVENTS' => 'Anzahl: Termine',
'CLEAN' => 'Leeren &amp; L�schen',
'USEDND' => 'Sie k�nnen die Kategorien per Drag &amp; Drop anordnen',
'NONE' => 'Noch keine Kategorien erstellt!'
);


//CATADD + CATEDIT
$lang['actions']['catadd'] = $lang['actions']['catedit'] = array (
'CREATEIN' => 'Unterkategorie von',
'ROOT' => 'Dies ist eine Hauptkategorie',
'TITLE' => 'Titel',
'ICON' => 'Symbol-Pfad',
'SUBMIT_ADD' => 'Kategorie erstellen',
'SUBMIT_EDIT' => 'Aktualisieren'
);


//CATDEL
$lang['actions']['catdel'] = array (
'MSG_TEXT' => 'Wollen Sie die Kategorie &quot;{TITLE}&quot; wirklich l�schen?'
);


//CATCLEAN
$lang['actions']['catclean'] = array (
'TITLE' => 'Kategorie',
'MOVETO' => 'Inhalt verschieben nach',
'DELCAT' => 'Kategorie l�schen',
'SUBMIT' => 'Kategorie leeren'
);


?>