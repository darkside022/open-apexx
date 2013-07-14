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
$lang['modulename']['MODULENAME_NEWS'] = 'News';


/************** HEADLINES **************/
$lang['titles'] = array (
'TITLE_NEWS_SHOW' => 'News-�bersicht',
'TITLE_NEWS_ADD' => 'News erstellen',
'TITLE_NEWS_EDIT' => 'News bearbeiten',
'TITLE_NEWS_COPY' => 'News kopieren',
'TITLE_NEWS_DEL' => 'News l�schen',
'TITLE_NEWS_ENABLE' => 'News ver�ffentlichen',
'TITLE_NEWS_DISABLE' => 'News widerrufen',

'TITLE_NEWS_CATSHOW' => 'Kategorien',
'TITLE_NEWS_CATADD' => 'Kategorie erstellen',
'TITLE_NEWS_CATEDIT' => 'Kategorie bearbeiten',
'TITLE_NEWS_CATDEL' => 'Kategorie l�schen',
'TITLE_NEWS_CATCLEAN' => 'Kategorie leeren',
'TITLE_NEWS_CATMOVE' => 'Kategorie verschieben',

'TITLE_NEWS_SSHOW' => 'News-Quellen',
'TITLE_NEWS_SADD' => 'News-Quelle hinzuf�gen',
'TITLE_NEWS_SEDIT' => 'News-Quelle bearbeiten',
'TITLE_NEWS_SDEL' => 'News-Quelle l�schen'
);


/************** NAVIGATION **************/
$lang['navi'] = array (
'NAVI_NEWS_SHOW' => 'News zeigen',
'NAVI_NEWS_ADD' => 'Neue News',
'NAVI_NEWS_CATSHOW' => 'Kategorien',
'NAVI_NEWS_SSHOW' => 'Quellen'
);


/************** ACTION EXPLICATION **************/
$lang['expl'] = array (
'EXPL_NEWS_EDIT' => 'Sonderrechte geben auch Zugriff auf fremde Artikel',
'EXPL_NEWS_COPY' => 'Sonderrechte geben auch Zugriff auf fremde Artikel',
'EXPL_NEWS_DEL' =>'Sonderrechte geben auch Zugriff auf fremde Artikel',
'EXPL_NEWS_ENABLE' => 'Sonderrechte geben auch Zugriff auf fremde Artikel',
'EXPL_NEWS_DISABLE' => 'Sonderrechte geben auch Zugriff auf fremde Artikel'
);


/************** LOG MESSAGES **************/
$lang['log'] = array (
'LOG_NEWS_ADD' => 'News erstellt',
'LOG_NEWS_EDIT' => 'News bearbeitet',
'LOG_NEWS_COPY' => 'News kopiert',
'LOG_NEWS_DEL' => 'News gel�scht',
'LOG_NEWS_ENABLE' => 'News ver�ffentlicht',
'LOG_NEWS_DISABLE' => 'News widerrufen',

'LOG_NEWS_CATADD' => 'News-Kategorie erstellt',
'LOG_NEWS_CATEDIT' => 'News-Kategorie bearbeitet',
'LOG_NEWS_CATDEL' => 'News-Kategorie gel�scht',
'LOG_NEWS_CATCLEAN' => 'News-Kategorie geleert',

'LOG_NEWS_SADD' => 'News-Quelle hingef�gt',
'LOG_NEWS_SEDIT' => 'News-Quelle bearbeitet',
'LOG_NEWS_SDEL' => 'News-Quelle gel�scht'
);


/************** MEDIAMANAGER **************/
$lang['media'] = array (
'MM_INSERTNEWSPIC' => 'Als Aufmacher-Bild einf�gen',
'MM_INSERTTEASER' => 'In den Teaser-Text einf�gen',
'MM_INSERTTEXT' => 'In den Haupttext einf�gen'
);


/************** CONFIG **************/
$lang['config'] = array (
'VIEW' => 'Darstellung',
'OPTIONS' => 'Einstellung',
'IMAGES' => 'Bilder',
'SEARCHABLE' => 'Soll das Modul in die Suchfunktion einbezogen werden?',
'EPP' => 'News pro Seite: (0 = alle zeigen)',
'ARCHIVEEPP' => 'News pro Seite im Archiv: (0 = alle zeigen)',
'SEARCHEPP' => 'News pro Seite in den Suchergebnissen: (0 = alle zeigen)',
'ARCHIVEALL' => 'Alle News im Archiv zeigen?',
'ARCHIVESORT' => 'Archiv-Monate sortieren nach:',
'ARCHIVEENTRYSORT' => 'News im Archiv sortieren nach:',
'NEWFIRST' => 'Neue zuerst',
'OLDFIRST' => 'Alte zuerst',
'SPAMPROT' => 'Dauer in Minuten bis erneut eine News eingesendet werden kann:',
'NEWSPIC_WIDTH' => 'Maximale Breite des Aufmacher-Bilds:',
'NEWSPIC_HEIGHT' => 'Maximale H�he des Aufmacher-Bilds:',
'NEWSPIC_POPUP' => 'Aufmacher-Bild mit Popup in Originalgr��e?',
'NEWSPIC_POPUP_WIDTH' => 'Maximale Breite des Popup-Bilds:',
'NEWSPIC_POPUP_HEIGHT' => 'Maximale H�he des Popup-Bilds:',
'NEWSPIC_QUALITY' => 'Qualit�tiv hochwertigere Verkleinerung (rechenaufwendig!)?',
'COMS' => 'Kommentare aktivieren?',
'ARCHCOMS' => 'Kommentieren von archivierten News erlauben?',
'RATINGS' => 'Bewertungen aktivieren?',
'ARCHRATINGS' => 'Bewerten von archivierten News erlauben?',
'TEASER' => 'Teaser-Text verwenden?',
'SUBCATS' => 'Unter-Kategorien verwenden?',
'CAPTCHA' => 'Einsenden einer News muss visuell best�tigt werden (Captcha)?',
'MAILONNEW' => 'eMail an diese Adressen, wenn eine News eingesendet wurde (mehrere Adressen durch Kommas trennen):'
);


/************** ACTIONS **************/

//SHOW
$lang['actions']['show'] = array (
'LAYER_ALL' => 'Alle',
'LAYER_SELF' => 'Eigene',
'LAYER_SEND' => 'Eingesendete',
'COL_TITLE' => 'Titel',
'COL_USER' => 'Autor',
'COL_CATEGORY' => 'Kategorie',
'COL_PUBDATE' => 'Datum',
'COL_HITS' => 'Klicks',
'SORT_ADDTIME' => 'Erstellungsdatum',
'SORT_STARTTIME' => 'Ver�ffentlichung',
'SEARCHTEXT' => 'Stichwort',
'SEARCH' => 'Suchen',
'USERNAME' => 'Benutzer',
'STITLE' => 'Titel',
'SSUBTITLE' => 'Untertitel',
'STEASER' => 'Teaser-Text',
'STEXT' => 'Text',
'SECTION' => 'Sektion',
'CATEGORY' => 'Kategorie',
'ALL' => 'Alle',
'GUEST' => 'Gast',
'BY' => 'von', 
'NONE' => 'Keine News gefunden!',
'COPY' => 'Kopieren',
'COMMENTS' => 'Kommentare zeigen',
'RATINGS' => 'Bewertungen zeigen'
);


//ADD + EDIT
$lang['actions']['add'] = $lang['actions']['edit'] = array (
'UPLOADFILE' => 'Dateien/Bilder hochladen',
'LINKS' => 'Angef�gte Links',
'OPTIONS' => 'Optionen',
'AUTHOR' => 'Autor',
'GUEST' => 'Gast',
'LINKPRODUCT' => 'Produkt verkn�pfen',
'SECTION' => 'In dieser Sektion anzeigen',
'ALLSEC' => 'Alle Sektionen',
'CATEGORY' => 'Kategorie',
'NEWCAT' => 'Kategorie erstellen',
'NEWSPIC' => 'Aufmacher-Bild',
'NEWSPIC_UPLOAD' => 'Hochladen',
'NEWSPIC_PATH' => 'Bild verwenden',
'LINKGALLERY' => 'Galerie verkn�pfen',
'SHOWPIC' => 'Bild anzeigen',
'DELPIC' => 'L�schen',
'TITLE' => 'Titel',
'SUBTITLE' => 'Untertitel',
'TEASER' => 'Teaser-Text',
'INLINESCREENS' => 'Inline-Bilder',
'TEXT' => 'Text',
'LTITLE' => 'Titel',
'LTEXT' => 'Linktext',
'LURL' => 'URL',
'LPOP' => 'Neues Fenster?',
'LLINK' => 'Link:',
'LSOURCE' => 'Quelle:',
'NEWLINE' => 'Neue Zeile',
'TAGS' => 'Tags',
'META_DESCRIPTION' => 'Meta Description',
'TAGSINFO' => 'einzelne Tags durch Kommas trennen',
'ALLOWCOMS' => 'Kommentare erlauben',
'RESTRICTED' => 'Altersabfrage aktivieren (ab 18 Jahren)',
'ALLOWRATING' => 'Bewertung erlauben',
'TOPNEWS' => 'Dies ist eine Top-News',
'STICKY' => 'Immer als erstes zeigen, optionales Ende',
'SEARCHABLE' => 'In die Suche einbeziehen',
'PUBNOW' => 'Sofort ver�ffentlichen',
'PUBLICATION' => 'Ver�ffentlichung',
'STARTTIME' => 'Ver�ffentlichen ab',
'ENDTIME' => 'Automatisch widerrufen',
'SUBMIT_ADD' => 'News erstellen',
'SUBMIT_EDIT' => 'Aktualisieren',
'INFO_NOTALLOWED' => 'Der Dateityp des Aufmacher-Bilds darf nicht hochgeladen werden!',
'INFO_NOIMAGE' => 'Der Dateityp des Aufmacher-Bilds ist keine g�ltige Bild-Datei!'
);


//DEL
$lang['actions']['del'] = array (
'MSG_TEXT' => 'Wollen Sie diese News &quot;{TITLE}&quot; wirklich l�schen?'
);


//COPY
$lang['actions']['copy'] = array (
'COPY' => 'Kopieren',
'MSG_TEXT' => 'Wollen Sie die News &quot;{TITLE}&quot; wirklich kopieren?',
'COPYOF' => 'Kopie von: '
);


//ENABLE
$lang['actions']['enable'] = array (
'TITLE' => 'News',
'STARTTIME' => 'Ver�ffentlichen ab',
'ENDTIME' => 'Automatisch widerrufen',
'SUBMIT' => 'Ver�ffentlichen'
);


//DISABLE
$lang['actions']['disable'] = array (
'MSG_TEXT' => 'Wollen Sie die News &quot;{TITLE}&quot; wirklich widerrufen?',
'DISABLE' => 'Widerrufen'
);


//CATSHOW
$lang['actions']['catshow'] = array (
'COL_CATNAME' => 'Titel',
'COL_NEWS' => 'Anzahl: News',
'CLEAN' => 'Leeren &amp; L�schen',
'USEDND' => 'Sie k�nnen die Kategorien per Drag &amp; Drop anordnen',
'NONE' => 'Noch keine Kategorien erstellt!'
);


//CATADD + CATEDIT
$lang['actions']['catadd'] = $lang['actions']['catedit'] = array (
'TITLE' => 'Titel',
'ICON' => 'Symbol-Pfad',
'CREATEIN' => 'Unterkategorie von',
'ROOT' => 'Dies ist eine Hauptkategorie',
'OPEN' => 'Kann News enthalten',
'FORGROUP' => 'Benutzergruppen, die News erstellen d�rfen',
'ALL' => 'Alle Benutzergruppen',
'SUBMIT_ADD' => 'Katgeorie erstellen',
'SUBMIT_EDIT' => 'Aktualisieren',
'INFO_CONTAINSNEWS' => 'Diese Kategorie enth�lt bereits einige News! Bitte zuerst leeren oder News erlauben.'
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


//SSHOW
$lang['actions']['sshow'] = array (
'COL_TITLE' => 'Titel',
'COL_LINK' => 'URL',
'SORT_TITLE' => 'Titel',
'NONE' => 'Noch keine News-Quellen gespeichert!'
);


//SADD + SEDIT
$lang['actions']['sadd'] = $lang['actions']['sedit'] = array (
'TITLE' => 'Titel',
'LINK' => 'URL',
'SUBMIT_ADD' => 'News-Quelle hinzuf�gen',
'SUBMIT_EDIT' => 'Aktualisieren'
);


//SDEL
$lang['actions']['sdel'] = array (
'MSG_TEXT' => 'Wollen Sie die News-Quelle &quot;{TITLE}&quot; wirklich l�schen?'
);

?>