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
$lang['modulename']['MODULENAME_GALLERY'] = 'Galerie';


/************** HEADLINES **************/
$lang['titles'] = array (
'TITLE_GALLERY_SHOW' => 'Galerien',
'TITLE_GALLERY_ADD' => 'Galerie erstellen',
'TITLE_GALLERY_EDIT' => 'Galerie bearbeiten',
'TITLE_GALLERY_DEL' => 'Galerie l�schen',
'TITLE_GALLERY_ENABLE' => 'Galerie aktivieren',
'TITLE_GALLERY_DISABLE' => 'Galerie deaktivieren',
'TITLE_GALLERY_MOVE' => 'Galerien anordnen',

'TITLE_GALLERY_PSHOW' => 'Galerie-Bilder',
'TITLE_GALLERY_PADD' => 'Bilder hinzuf�gen',
'TITLE_GALLERY_PEDIT' => 'Bild bearbeiten',
'TITLE_GALLERY_PMOVE' => 'Bild verschieben',
'TITLE_GALLERY_PDEL' => 'Bild l�schen',
'TITLE_GALLERY_PENABLE' => 'Bild aktivieren',
'TITLE_GALLERY_PDISABLE' => 'Bild deaktivieren',
'TITLE_GALLERY_POTW' => 'Bild der Woche definieren',
'TITLE_GALLERY_PREVIEW' => 'Vorschau-Bild definieren'
);


/************** NAVIGATION **************/
$lang['navi'] = array (
'NAVI_GALLERY_SHOW' => 'Galerien zeigen',
'NAVI_GALLERY_ADD' => 'Neue Galerie',
);


/************** ACTION EXPLICATION **************/
$lang['expl'] = array (

);


/************** LOG MESSAGES **************/
$lang['log'] = array (
'LOG_GALLERY_ADD' => 'Galerie erstellt',
'LOG_GALLERY_EDIT' => 'Galerie bearbeitet',
'LOG_GALLERY_DEL' => 'Galerie gel�scht',
'LOG_GALLERY_ENABLE' => 'Galerie aktiviert',
'LOG_GALLERY_DISABLE' => 'Galerie deaktiviert',

'LOG_GALLERY_PADD' => 'Galerie-Bild hinzugef�gt',
'LOG_GALLERY_PEDIT' => 'Galerie-Bild bearbeitet',
'LOG_GALLERY_PMOVE' => 'Galerie-Bild verschoben',
'LOG_GALLERY_PDEL' => 'Galerie-Bild gel�scht',
'LOG_GALLERY_PENABLE' => 'Galerie-Bild aktiviert',
'LOG_GALLERY_PDISABLE' => 'Galerie-Bild deaktiviert',
'LOG_GALLERY_POTW' => 'Bild der Woche definiert',
'LOG_GALLERY_PREVIEW' => 'Vorschau-Bild definiert'
);


/************** CONFIG **************/
$lang['config'] = array (
'VIEW' => 'Darstellung',
'OPTIONS' => 'Einstellungen',
'IMAGES' => 'Bilder',
'SEARCHABLE' => 'Soll das Modul in die Suchfunktion einbezogen werden?',
'ORDERGAL' => 'Galerien sortieren nach (Unter-Galerien deaktiviert):',
'ORDERTIME' => 'Ver�ffentlichung',
'ORDERTITLE' => 'Titel',
'ORDERADMIN' => 'Reihenfolge im Adminbereich festlegen',
'ORDERPICS' => 'Bilder sortieren nach:',
'NEWFIRST' => 'Neue zuerst',
'OLDFIRST' => 'Alte zuerst',
'LISTEPP' => 'Galerien pro Seite (0 = alle zeigen):',
'GALEPP' => 'Bilder pro Seite (0 = alle zeigen):',
'POPUP' => 'Bilder in einem Popup-Fenster zeigen?',
'POPUP_RESIZEABLE' => 'Gr��e des Popup-Fensters von Benutzer ver�nderbar?',
'POPUP_ADDWIDTH' => 'Pixelzahl, die der Breite des Popup-Fensters hinzugef�gt wird:',
'POPUP_ADDHEIGHT' => 'Pixelzahl, die der H�he des Popup-Fensters hinzugef�gt wird:',
'NEW' => 'Anzahl der Tage, die ein Bild &quot;neu&quot; ist:',
'ADDPICS' => 'Anzahl der Bilder, die gleichzeitig hinzugef�gt werden k�nnen:<br />(auf Serverleistung achten!)',
'PICHEIGHT' => 'Maximale H�he der Bilder:',
'PICWIDTH' => 'Maximale Breite der Bilder:',
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
'POTW_AUTO' => '&quot;Bild der Woche&quot; automatisch ausw�hlen lassen?',
'QUALITY_RESIZE' => 'Qualit�tiv hochwertigere Verkleinerung (rechenaufwendig!)?',
'COMS' => 'Kommentare zu Bildern aktivieren?',
'GALCOMS' => 'Kommentare zu Galerien aktivieren?',
'RATINGS' => 'Bewertungen aktivieren?',
'SUBGALS' => 'Unter-Galerien verwenden?'
);


/************** ACTIONS **************/

//SHOW
$lang['actions']['show'] = array (
'COL_TITLE' => 'Titel',
'COL_STARTTIME' => 'Ver�ffentlichung',
'COL_COUNT' => 'Bilder',
'SEARCHTEXT' => 'Stichwort',
'SEARCH' => 'Suchen',
'SORT_ADDTIME' => 'Erstellungsdatum',
'NONE' => 'Noch keine Galerie erstellt!',
'SHOWPICS' => 'Bilder zeigen',
'USEDND' => 'Sie k�nnen die Galerien per Drag &amp; Drop anordnen',
'ADDPICS' => 'Bilder hinzuf�gen'
);


//ADD + EDIT
$lang['actions']['add'] = $lang['actions']['edit'] = array (
'CREATEIN' => 'Untergalerie von',
'ROOT' => 'Dies ist eine Hauptgalerie',
'LINKPRODUCT' => 'Produkt verkn�pfen',
'SECTION' => 'In dieser Sektion anzeigen',
'ALLSEC' => 'Alle Sektionen',
'TITLE' => 'Titel',
'DESCRIPTION' => 'Beschreibung',
'PASSWORD' => 'Passwortschutz',
'TAGS' => 'Tags',
'TAGSINFO' => 'einzelne Tags durch Kommas trennen',
'META_DESCRIPTION' => 'Meta Description',
'OPTIONS' => 'Optionen',
'PUBNOW' => 'Sofort freischalten?',
'ALLOWCOMS' => 'Kommentare erlauben?',
'RESTRICTED' => 'Altersabfrage aktivieren (ab 18 Jahren)',
'SEARCHABLE' => 'In die Suche einbeziehen?',
'PUBLICATION' => 'Ver�ffentlichung',
'STARTTIME' => 'Ver�ffentlichen ab',
'ENDTIME' => 'Automatisch widerrufen',
'SUBMIT_ADD' => 'Galerie erstellen',
'SUBMIT_EDIT' => 'Aktualisieren',
'SUBMIT_ADDPICS' => 'Erstellen und Bilder anf�gen'
);


//DEL
$lang['actions']['del'] = array (
'MSG_TEXT' => 'Wollen Sie die Galerie &quot;{TITLE}&quot; wirklich l�schen?'
);


//ENABLE
$lang['actions']['enable'] = array (
'TITLE' => 'Galerie',
'STARTTIME' => 'Freischalten ab',
'ENDTIME' => 'Automatisch widerrufen',
'SUBMIT' => 'Freischalten'
);


//DISABLE
$lang['actions']['disable'] = array (
'MSG_TEXT' => 'Wollen Sie die Galerie &quot;{TITLE}&quot; wirklich widerrufen?',
'DISABLE' => 'Widerrufen'
);


//PSHOW
$lang['actions']['pshow'] = array (
'GALLERY' => 'Galerie',
'COL_THUMBNAIL' => 'Thumbnail',
'COL_CAPTION' => 'Bildunterschrift',
'COL_HITS' => 'Klicks',
'SORT_ADDTIME' => 'Erstellungsdatum',
'NONE' => 'Noch keine Bilder vorhanden!',
'MOVE' => 'Verschieben',
'COMMENTS' => 'Kommentare zeigen',
'RATINGS' => 'Bewertungen zeigen',
'POTW' => 'Zum Bild der Woche machen',
'PREVIEW' => 'Als Vorschau-Bild definieren',
'IS_PREVIEW' => 'Vorschau-Bild',
'IS_POTW' => 'Bild der Woche',
'MULTI_PMOVE' => 'Verschieben',
'MULTI_PDEL' => 'L�schen',
'MULTI_PENABLE' => 'Aktivieren',
'MULTI_PDISABLE' => 'Deaktivieren'
);


//PADD + PEDIT
$lang['actions']['padd'] = $lang['actions']['pedit'] = array (
'LAYER_UPLOAD' => 'Einzelne Bilder',
'LAYER_ZIP' => 'ZIP verarbeiten',
'LAYER_FTP' => 'FTP-Upload verarbeiten',
'SUBDIRS' => 'Enthaltene Unterordner',
'CHOOSEPICS' => 'Bilder ausw�hlen',
'PROCESSZIP' => 'ZIP verarbeiten',
'GLOBALOPTIONS' => 'Optionen f�r Alle',
'FTPINFO' => 'Hier k�nnen Sie Bilddateien aus dem Ordner uploads/gallery/uploads und dessen Unterordner verarbeiten lassen.',
'INFOTEXT' => '<b>ACHTUNG:</b> GIF-Bilder werden in das Format JPG kovertiert!',
'PIC' => 'Bild',
'ZIP' => 'Zip-Datei',
'CAPTION' => 'Bildunterschrift',
'OPTIONS' => 'Optionen',
'WATERMARK' => 'Wasserzeichen',
'NORESIZE' => 'Nicht verkleinern',
'COMMENTS' => 'Kommentare erlauben',
'RATINGS' => 'Bewertung erlauben',
'DELPICS' => 'Bilder nach dem Verarbeiten l�schen',
'NONE' => 'Keine Bilder gefunden!',
'INFO_UPLOAD' => '{COUNT} Datei(en) angef�gt',
'SUBMIT_ADD' => 'Bilder anf�gen',
'SUBMIT_ADDNEXT' => 'Weitere Bilder anf�gen',
'SUBMIT_EDIT' => 'Aktualisieren'
);


//PMOVE
$lang['actions']['pmove'] = array (
'DESTINATION' => 'Ziel-Galerie',
'SUBMIT' => 'Verschieben'
);


//PDEL
$lang['actions']['pdel'] = array (
'MSG_TEXT' => 'Wollen Sie dieses Bild wirklich l�schen?'
);


//PENABLE
$lang['actions']['penable'] = array (
);


//PDISABLE
$lang['actions']['pdisable'] = array (
);


//POTW
$lang['actions']['potw'] = array (
'MSG_TEXT' => 'Wollen Sie dieses Bild wirklich zum Bild der Woche machen?',
'MSG_NOTACTIVE' => 'Dieses Bild kann nicht als Bild der Woche definiert werden! Galerie oder Bild nicht aktiviert.'
);


//PREVIEW
$lang['actions']['preview'] = array (
'MSG_TEXT' => 'Wollen Sie dieses Bild wirklich zum Vorschau-Bild f�r diese Galerie machen?',
'MSG_NOTATIVE' => 'Dieses Bild kann nicht als Vorschau-Bild definiert werden, da es nicht aktiviert ist!'
);


?>