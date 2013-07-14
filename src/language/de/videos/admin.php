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
$lang['modulename']['MODULENAME_VIDEOS'] = 'Videos';


/************** HEADLINES **************/
$lang['titles'] = array (
'TITLE_VIDEOS_SHOW' => 'Videos',
'TITLE_VIDEOS_ADD' => 'Video hinzuf�gen',
'TITLE_VIDEOS_EDIT' => 'Video bearbeiten',
'TITLE_VIDEOS_DEL' => 'Video l�schen',
'TITLE_VIDEOS_ENABLE' => 'Video freischalten',
'TITLE_VIDEOS_DISABLE' => 'Video widerrufen',

'TITLE_VIDEOS_PSHOW' => 'Video-Screenshots',
'TITLE_VIDEOS_PADD' => 'Video-Screenshots anf�gen',
'TITLE_VIDEOS_PDEL' => 'Video-Screenshots l�schen',

'TITLE_VIDEOS_CATSHOW' => 'Kategorien',
'TITLE_VIDEOS_CATADD' => 'Kategorie erstellen',
'TITLE_VIDEOS_CATEDIT' => 'Kategorie bearbeiten',
'TITLE_VIDEOS_CATDEL' => 'Kategorie l�schen',
'TITLE_VIDEOS_CATCLEAN' => 'Kategorie leeren',
'TITLE_VIDEOS_CATMOVE' => 'Kategorie verschieben',

'TITLE_VIDEOS_STATS' => 'Statistik',
'TITLE_VIDEOS_CFG' => 'Konverter-Konfiguration'
);


/************** NAVIGATION **************/
$lang['navi'] = array (
'NAVI_VIDEOS_SHOW' => 'Videos zeigen',
'NAVI_VIDEOS_ADD' => 'Neues Video',
'NAVI_VIDEOS_CATSHOW' => 'Kategorien',
'NAVI_VIDEOS_STATS' => 'Statistik',
'NAVI_VIDEOS_CFG' => 'Konverter'
);


/************** ACTION EXPLICATION **************/
$lang['expl'] = array (
'EXPL_VIDEOS_EDIT' => 'Sonderrechte geben auch Zugriff auf fremde Videos',
'EXPL_VIDEOS_DEL' => 'Sonderrechte geben auch Zugriff auf fremde Videos',
'EXPL_VIDEOS_ENABLE' => 'Sonderrechte geben auch Zugriff auf fremde Videos',
'EXPL_VIDEOS_DISABLE' => 'Sonderrechte geben auch Zugriff auf fremde Videos',
'EXPL_VIDEOS_PADD' => 'Sonderrechte geben auch Zugriff auf die Bilder fremder Videos',
'EXPL_VIDEOS_PDEL' => 'Sonderrechte geben auch Zugriff auf die Bilder fremder Videos'
);


/************** LOG MESSAGES **************/
$lang['log'] = array (
'LOG_VIDEOS_ADD' => 'Video hinzugef�gt',
'LOG_VIDEOS_EDIT' => 'Video bearbeitet',
'LOG_VIDEOS_DEL' => 'Video gel�scht',
'LOG_VIDEOS_ENABLE' => 'Video freigeschaltet',
'LOG_VIDEOS_DISABLE' => 'Video widerrufen',

'LOG_VIDEOS_PADD' => 'Video-Screenshot angef�gt',
'LOG_VIDEOS_PDEL' => 'Video-Screenshot gel�scht',

'LOG_VIDEOS_CATADD' => 'Video-Kategorie erstellt',
'LOG_VIDEOS_CATEDIT' => 'Video-Kategorie bearbeitet',
'LOG_VIDEOS_CATDEL' => 'Video-Kategorie gel�scht',
'LOG_VIDEOS_CATCLEAN' => 'Video-Kategorie geleert',

'LOG_VIDEOS_CFG' => 'Video-Konverter konfiguriert'
);


/************** MEDIAMANAGER **************/
$lang['media'] = array (
'MM_INSERTPIC' => 'Als Aufmacher-Bild einf�gen',
'MM_INSERTFILE' => 'Als Video-Quelldatei einf�gen',
'MM_INSERTTEXT' => 'In die Beschreibung einf�gen',
'MM_INSERTFLV' => 'Als FLV-Datei einf�gen'
);


/************** CONFIG **************/
$lang['config'] = array (
'VIEW' => 'Darstellung',
'OPTIONS' => 'Einstellungen',
'CONVERTER' => 'Konverter',
'SCREENSHOTS' => 'Screenshots',
'TEASERPIC' => 'Teaserbild',
'SEARCHABLE' => 'Soll das Modul in die Suchfunktion einbezogen werden?',
'EPP' => 'Videos pro Seite: (0 = alle zeigen)',
'SEARCHEPP' => 'Videos pro Seite in den Suchergebnissen: (0 = alle zeigen)',
'SORTBY' => 'Videos sortieren nach:',
'TITLE' => 'Titel',
'DATE' => 'Ver�ffentlichung',
'CATONLY' => 'Nur Videos aus der gew�hlten Kategorie anzeigen?',
'REGONLY' => 'Videos nur f�r registrierte Benutzer zum Download?',
'NEW' => 'Anzahl der Tage, die ein Video &quot;neu&quot; ist:',
'EMBED_WIDTH' => 'Breite der eingebundenen Player',
'EMBED_HEIGHT' => 'H�he der eingebundenen Player',
'ADDPICS' => 'Anzahl der Screenshots, die gleichzeitig hinzugef�gt werden k�nnen:<br />(auf Serverleistung achten!)',
'PICHEIGHT' => 'Maximale H�he der Screenshots:',
'PICWIDTH' => 'Maximale Breite der Screenshots:',
'WATERMARK' => 'Pfad zum Wasserzeichen-Quellbild (relativ zum apexx-Ordner). G�ltige Formate sind GIF, JPG und PNG.',
'WATERMARK_TRANSP' => 'Transparenz des Wasserzeichens in Prozent (0-100). Gilt nur f�r Wasserzeichen im GIF- oder JPG-Format, bei PNG wird die Transparenz durch den Alpha-Channel bestimmt.',
'WATERMARK_POSITION' => 'Position des Wasserzeichens:',
'POSTOP' => 'oben',
'POSMIDDLE' => 'mitte',
'POSBOTTOM' => 'unten',
'POSLEFT' => 'links',
'POSCENTER' => 'zentriert',
'POSRIGHT' => 'rechts',
'THUMBWIDTH' => 'Maximale Breite des Vorschau-Bilds:',
'THUMBHEIGHT' => 'Maximale H�he des Vorschau-Bilds:',
'QUALITY_RESIZE' => 'Qualit�tiv hochwertigere Verkleinerung (rechenaufwendig!)?',
'ABITRATE' => 'Audio-Bitrate (in kBits/Sek):',
'VBITRATE' => 'Video-Bitrate (in kBits/Sek):',
'FLVWIDTH' => 'Maximale Breite des Flash-Videos:',
'FLVHEIGHT' => 'Maximale H�he des Flash-Videos:',
'TEASERPIC_WIDTH' => 'Maximale Breite des Aufmacher-Bilds:',
'TEASERPIC_HEIGHT' => 'Maximale H�he des Aufmacher-Bilds:',
'TEASERPIC_POPUP' => 'Aufmacher-Bild mit Popup in Originalgr��e?',
'TEASERPIC_POPUP_WIDTH' => 'Maximale Breite des Popup-Bilds:',
'TEASERPIC_POPUP_HEIGHT' => 'Maximale H�he des Popup-Bilds:',
'TEASERPIC_QUALITY' => 'Qualit�tiv hochwertigere Verkleinerung (rechenaufwendig!)?',
'COMS' => 'Kommentare aktivieren?',
'RATINGS' => 'Bewertungen aktivieren?',
'MAXTRAFFIC' => 'Maximaler t�glicher Datentraffic (in Bytes):',
'EXTTRAFFIC' => 'Traffic von externen Downloads in die Statistik einberechnen?',
'MAILONBROKEN' => 'eMail an diese Adressen, wenn ein Video als defekt gemeldet wird (mehrere Adressen durch Kommas trennen):'
);


/************** ACTIONS **************/

//SHOW
$lang['actions']['show'] = array (
'LAYER_ALL' => 'Alle',
'LAYER_SEND' => 'Eingesendete',
'LAYER_BROKEN' => 'Defekt',
'LAYER_FAILED' => 'Konvertierung fehlgeschlagen',
'COL_TITLE' => 'Titel',
'COL_AUTHOR' => 'Autor',
'COL_CATEGORY' => 'Kategorie',
'COL_ADDTIME' => 'Datum',
'COL_DOWNLOADS' => 'Downloads',
'COL_HITS' => 'Klicks',
'SORT_ADDTIME' => 'Erstellungsdatum',
'SORT_STARTTIME' => 'Ver�ffentlichung',
'BROKEN' => 'Defekt',
'PROCESSING' => 'Konvertierung',
'PROCESSING' => 'Konvertierung fehlgeschlagen',
'BY' => 'von',
'SEARCHTEXT' => 'Stichwort',
'SEARCH' => 'Suchen',
'USERNAME' => 'Uploader',
'STITLE' => 'Titel',
'STEXT' => 'Text',
'SECTION' => 'Sektion',
'CATEGORY' => 'Kategorie',
'ALL' => 'Alle', 
'NONE' => 'Keine Videos gefunden!',
'COMMENTS' => 'Kommentare zeigen',
'RATINGS' => 'Bewertungen zeigen',
'SCREENSHOTS' => 'Screenshots'
);


//ADD + EDIT
$lang['actions']['add'] = $lang['actions']['edit'] = array (
'UPLOADFILE' => 'Dateien/Bilder hochladen',
'FILE' => 'Datei',
'OPTIONS' => 'Optionen',
'AUTHOR' => 'Autor',
'LINKPRODUCT' => 'Produkt verkn�pfen',
'SECTION' => 'In dieser Sektion anzeigen',
'ALLSEC' => 'Alle Sektionen',
'CATEGORY' => 'Kategorie',
'NEWCAT' => 'Kategorie erstellen',
'TITLE' => 'Titel',
'TEASERPIC' => 'Aufmacher-Bild',
'TEASERPIC_UPLOAD' => 'Hochladen',
'TEASERPIC_PATH' => 'Bild verwenden',
'SHOWPIC' => 'Bild anzeigen',
'DELPIC' => 'L�schen',
'INLINESCREENS' => 'Inline-Bilder',
'TEXT' => 'Beschreibung',
'TAGS' => 'Tags',
'TAGSINFO' => 'einzelne Tags durch Kommas trennen',
'META_DESCRIPTION' => 'Meta Description',
'LINKGALLERY' => 'Galerie verkn�pfen',
'LOCALSOURCE' => 'Lokales Video',
'EXTERNALSOURCE' => 'Externes Video',
'EMBEDSOURCE' => 'Eingebundenes Video',
'CURRENTVIDEO' => 'Aktuelles Video',
'EMBEDVIDEO' => 'Video einbinden',
'EMBED_INFO' => 'Hiermit k�nnen Sie ein Video eines externen Services einbinden. Geben Sie hierzu die URL zu dem Video an. (Unterst�tzte Plattformen: YouTube, Sevenload, MyVideo, Clipfish, Dailymotion, Vimeo, MySpace, Gametrailers, Machinima.com)',
'EMBED_EXAMPLE' => 'Beispiel: http://www.youtube.com/watch?v=zEtfiADwJho',
'NEWURL' => 'Neue URL',
'SELECTFLV' => 'Lokales FLV w�hlen',
'SELECT_INFO' => 'W�hlen Sie die FLV-Datei aus. Zus�tzlich k�nnen Sie den Pfad des Original-Videos angeben, um dieses zum Download bereitzustellen.',
'EXTERNALFLV' => 'Externes FLV w�hlen',
'EXTERNAL_INFO' => 'Geben Sie die URL zur FLV-Datei an. Zus�tzlich k�nnen Sie die URL zum Original-Videos angeben, um dieses zum Download bereitzustellen.',
'FLVFILE' => 'FLV-Datei',
'ORIGINALFILE' => 'Original-Video',
'FLVFILE_URL' => 'URL zur FLV-Datei',
'ORIGINALFILE_URL' => 'URL zum Original-Video',
'PRODUCE_SCREENS' => 'Screenshots erzeugen',
'FILESIZE' => 'Dateigr��e',
'DOWNLOAD' => 'Download',
'ORIGINALDOWNLOAD' => 'Original-Video zum Download bereitstellen',
'CONVERT' => 'Video konvertieren',
'CONVERT_INFO' => 'Geben Sie den Pfad zum Original-Video an. Eine FLV-Datei wird automatisch erzeugt.',
'PASSWORD' => 'Passwortschutz',
'LIMIT' => 'Download-Limit pro Tag',
'ALLOWCOMS' => 'Kommentare erlauben',
'ALLOWRATING' => 'Bewertung erlauben',
'RESTRICTED' => 'Altersabfrage aktivieren (ab 18 Jahren)',
'TOPVIDEO' => 'Dies ist ein Top-Video',
'REGONLY' => 'Download nur f�r registrierte Benutzer',
'PUBNOW' => 'Sofort freischalten?',
'SEARCHABLE' => 'In die Suche einbeziehen',
'PUBLICATION' => 'Ver�ffentlichung',
'STARTTIME' => 'Ver�ffentlichen ab',
'ENDTIME' => 'Automatisch widerrufen',
'SUBMIT_ADD' => 'Video hinzuf�gen',
'SUBMIT_EDIT' => 'Aktualisieren',
'INFO_EMBED_NOTFOUND' => 'Die URL zum externen Video ist ung�ltig oder die Plattform wird nicht unterst�tzt!',
'INFO_NOTEXISTS' => 'Die Datei &quot;{FILE}&quot; existiert nicht!'
);


//DEL
$lang['actions']['del'] = array (
'DELFILE' => 'Datei l�schen',
'MSG_TEXT' => 'Wollen Sie das Video &quot;{TITLE}&quot; wirklich l�schen?'
);


//ENABLE
$lang['actions']['enable'] = array (
'TITLE' => 'Video',
'STARTTIME' => 'Freischalten ab',
'ENDTIME' => 'Automatisch widerrufen',
'SUBMIT' => 'Freischalten'
);


//DISABLE
$lang['actions']['disable'] = array (
'MSG_TEXT' => 'Wollen Sie das Video &quot;{TITLE}&quot; wirklich widerrufen?',
'DISABLE' => 'Widerrufen'
);


//PSHOW
$lang['actions']['pshow'] = array (
'VIDEO' => 'Video',
'COL_THUMBNAIL' => 'Thumbnail',
'NONE' => 'Noch keine Bilder angef�gt!',
'MULTI_PDEL' => 'L�schen'
);

//PADD
$lang['actions']['padd'] = array (
'CHOOSEPICS' => 'Bilder ausw�hlen',
'INFOTEXT' => '<b>ACHTUNG:</b> GIF-Bilder werden in das Format JPG kovertiert!',
'GLOBALOPTIONS' => 'Optionen f�r Alle',
'PIC' => 'Bild',
'OPTIONS' => 'Optionen',
'WATERMARK' => 'Wasserzeichen',
'NORESIZE' => 'Nicht verkleinern',
'SUBMIT' => 'Bilder anf�gen',
'MSG_NOIMAGE' => 'Die Datei &quot;{NAME}&quot; ist kein g�ltiges Bild!'
);

//PDEL
$lang['actions']['pdel'] = array (
'MSG_TEXT' => 'Wollen Sie dieses Bild wirklich l�schen?'
);


//CATSHOW
$lang['actions']['catshow'] = array (
'COL_CATNAME' => 'Titel',
'COL_VIDEOS' => 'Anzahl: Videos',
'CLEAN' => 'Leeren &amp; L�schen',
'ATTINFO' => 'Zusatz-Informationen',
'USEDND' => 'Sie k�nnen die Kategorien per Drag &amp; Drop anordnen',
'NONE' => 'Noch keine Kategorien erstellt!'
);


//CATADD + CATEDIT
$lang['actions']['catadd'] = $lang['actions']['catedit'] = array (
'TITLE' => 'Titel',
'TEXT' => 'Text',
'ICON' => 'Symbol-Pfad',
'CREATEIN' => 'Unterkategorie von',
'ROOT' => 'Dies ist eine Hauptkategorie',
'OPEN' => 'Kann Videos enthalten',
'FORGROUP' => 'Benutzergruppen, die Videos erstellen d�rfen',
'ALL' => 'Alle Benutzergruppen',
'SUBMIT_ADD' => 'Kategorie erstellen',
'SUBMIT_EDIT' => 'Aktualisieren',
'INFO_CONTAINSVIDEOS' => 'Diese Kategorie enth�lt bereits Videos! Bitte zuerst leeren oder Videos erlauben.'
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


//STATS
$lang['actions']['stats'] = array (
'TRAFFIC' => 'Traffic',
'DOWNLOADS' => 'Downloads',
'FILES' => 'Freigeschaltete Downloads',
'AVGDLSDAY' => 'Durschnittliche Downloadklicks',
'AVGSIZEDAY' => 'Durchschnittliche Datenmenge',
'DLSCOMPLETE' => 'Gesamte Downloadsklicks',
'DLSTHISWEEK' => 'Downloadklicks der letzten 7 Tage',
'DLSTODAY' => 'Downloadklicks heute',
'SIZECOMPLETE' => 'Gesamte Datenmenge',
'SIZETHISWEEK' => 'Datenmenge der letzten 7 Tage',
'SIZETODAY' => 'Datenmenge heute',
'PERDAY' => 'pro Tag',
'GRAPH' => 'im Diagramm',
'HITS' => 'Klicks',
'LAST50DAYS' => 'der letzten 50 Tage',
'POPULAR' => 'Beliebteste Downloads der letzten 7 Tage'
);



//CFG
$lang['actions']['cfg'] = array (
'INFOTEXT' => 'F�r eine automatisch FLV-Erzeugung werden die Programme FFmpeg, FLVTool2 und MEncoder ben�tigt. Wenn Sie diese Funktion nutzen m�chten, geben Sie die Pfade zu den Programmen an.',
'CALLFOR' => 'Aufruf von',
'FFMPEG_INFO' => 'FFmepg wird f�r die Erzeugung von FLV-Dateien ben�tigt. (Standardpfad: /usr/local/bin/ffmpeg)',
'FLVTOOL2_INFO' => 'Mit FLVTool2 werden einer FLV-Datei Metadaten hinzugef�gt. (Standardpfad: /usr/local/bin/flvtool2)',
'MENCODER_INFO' => 'MEncoder wird als Fallback verwendet, wenn die Konvertierung mit FFmpeg nicht m�glich ist. (Standardpfad: /usr/local/bin/mencoder)',

'INFO_INVALID' => 'Der Pfad der folgenden Programme ist nicht korrekt: ',
'MSG_EXEC_DISABLED' => 'Die PHP-Funktion exec() ist auf Ihrem Webserver deaktiviert. Ohne diese Funktion kann der FLV-Konverter nicht genutzt werden.',
'SUBMIT' => 'Pr�fen und �bernehmen'
);

?>