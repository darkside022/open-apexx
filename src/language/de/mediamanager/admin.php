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
$lang['modulename']['MODULENAME_MEDIAMANAGER'] = 'Medien-Manager';


/************** HEADLINES **************/
$lang['titles'] = array (
'TITLE_MEDIAMANAGER_INDEX' => 'Medien-Index',
'TITLE_MEDIAMANAGER_SEARCH' => 'Medien durchsuchen',
'TITLE_MEDIAMANAGER_INLINE' => 'Inline-Bilder hochladen',

'TITLE_MEDIAMANAGER_RULES' => 'Dateiregeln zeigen',
'TITLE_MEDIAMANAGER_RADD' => 'Dateiregel erstellen',
'TITLE_MEDIAMANAGER_REDIT' => 'Dateiregel bearbeiten',
'TITLE_MEDIAMANAGER_RDEL' => 'Dateiregeln l�schen',

'TITLE_MEDIAMANAGER_DIRADD' => 'Verzeichnis erstellen',
'TITLE_MEDIAMANAGER_DIRDEL' => 'Verzeichnis l�schen',
'TITLE_MEDIAMANAGER_DIRRENAME' => 'Verzeichnis umbenennen',

'TITLE_MEDIAMANAGER_UPLOAD' => 'Dateien hochladen',
'TITLE_MEDIAMANAGER_STS' => 'Datei von einem Server herunterladen',
'TITLE_MEDIAMANAGER_RENAME' => 'Datei umbenennen',
'TITLE_MEDIAMANAGER_COPY' => 'Datei kopieren',
'TITLE_MEDIAMANAGER_MOVE' => 'Datei verschieben',
'TITLE_MEDIAMANAGER_DEL' => 'Datei l�schen',
'TITLE_MEDIAMANAGER_DETAILS' => 'Details zeigen',
'TITLE_MEDIAMANAGER_THUMB' => 'Thumbnail erstellen'
);


/************** NAVIGATION **************/
$lang['navi'] = array (
'NAVI_MEDIAMANAGER_INDEX' => 'Medien-Index',
'NAVI_MEDIAMANAGER_RULES' => 'Dateiregeln',
'NAVI_MEDIAMANAGER_SEARCH' => 'Suchen'
);


/************** ACTION EXPLICATION **************/
$lang['expl'] = array (

);


/************** LOG MESSAGES **************/
$lang['log'] = array (
'LOG_MEDIAMANAGER_INLINE' => 'Inline-Bild hochgeladen',
'LOG_MEDIAMANAGER_RADD' => 'Dateiregel erstellt',
'LOG_MEDIAMANAGER_REDIT' => 'Dateiregel bearbeitet',
'LOG_MEDIAMANAGER_RDEL' => 'Dateiregeln gel�scht',
'LOG_MEDIAMANAGER_DIRADD' => 'Verzeichnis erstellt',
'LOG_MEDIAMANAGER_DIRDEL' => 'Verzeichnis gel�scht',
'LOG_MEDIAMANAGER_DIRRENAME' => 'Verzeichnis umbenannt',
'LOG_MEDIAMANAGER_UPLOAD' => 'Datei hochgeladen',
'LOG_MEDIAMANAGER_STS' => 'Datei heruntergeladen',
'LOG_MEDIAMANAGER_RENAME' => 'Datei umbenannt',
'LOG_MEDIAMANAGER_COPY' => 'Datei kopiert',
'LOG_MEDIAMANAGER_MOVE' => 'Datei verschoben',
'LOG_MEDIAMANAGER_DEL' => 'Datei gel�scht',
'LOG_MEDIAMANAGER_THUMB' => 'Thumbnail erstellt'
);


/************** MEDIAMANAGER **************/
$lang['media'] = array (
'MM_USEIMAGE' => 'Bild verwenden',
'MM_USESWF' => 'Flash verwenden'
);


/************** CONFIG **************/
$lang['config'] = array (
'POSTOP' => 'oben',
'POSMIDDLE' => 'mitte',
'POSBOTTOM' => 'unten',
'POSLEFT' => 'links',
'POSCENTER' => 'zentriert',
'POSRIGHT' => 'rechts',
'WATERMARK' => 'Pfad zum Wasserzeichen-Quellbild (relativ zum apexx-Ordner). G�ltige Formate sind GIF, JPG und PNG.',
'WATERMARK_TRANSP' => 'Transparenz des Wasserzeichens in Prozent (0-100). Gilt nur f�r Wasserzeichen im GIF- oder JPG-Format, bei PNG wird die Transparenz durch den Alpha-Channel bestimmt.',
'WATERMARK_POSITION' => 'Position des Wasserzeichens:',
'QUALITY_RESIZE' => 'Qualit�tiv hochwertigere Verkleinerung (rechenaufwendig!)?'
);


/************** ACTIONS **************/

//INDEX
$lang['actions']['index'] = array (
'COL_DIRFILE' => 'Dateiname',
'COL_TYPE' => 'Dateityp',
'SORT_FILE' => 'Dateiname',
'SORT_LASTCHANGE' => 'Letzte �nderung',
'MEDIADIR' => 'Mediendatenbank',
'TYPE_UNKNOWN' => 'Unbekannt',
'RENAME' => 'Umbenennen',
'COPY' => 'Kopieren',
'MOVE' => 'Verschieben',
'THUMB' => 'Thumbnail erstellen',
'NONE' => 'Dieser Ordner ist leer!',
'DIRDEL' => 'Ordner l�schen?',
'MULTI_DEL' => 'L�schen',
'MULTI_COPY' => 'Kopieren',
'MULTI_MOVE' => 'Verschieben'
);

//////////////////////////////////////////////////////////////////////////////////////////

//DIRADD
$lang['actions']['diradd'] = array (
'FOLDER' => 'Verzeichnis',
'NAME' => 'Titel',
'INFO_WRONGSYNTAX' => 'In Verzeichnis-Titels sind nur Buchstaben, Zahlen sowie Binde- und Unterstrich erlaubt!',
'INFO_EXISTS' => 'Es besteht bereits ein Verzeichnis mit diesem Namen!',
'SUBMIT' => 'Verzeichnis erstellen',
'MSG_OK' => 'Das Verzeichnis wurde erstellt! Sie werden nun weitergeleitet...'
);

//DIRDEL
$lang['actions']['dirdel'] = array (
'MSG_TEXT' => 'Wollen Sie das Verzeichnis &quot;{TITLE}&quot; wirklich l�schen?',
'MSG_OK' => 'Das Verzeichnis wurde gel�scht! Sie werden nun weitergeleitet...'
);


//RENAME
$lang['actions']['dirrename'] = array (
'NAME' => 'Neuer Verzeichnisname',
'SUBMIT' => 'Verzeichnis umbenennen',
'INFO_WRONGSYNTAX' => 'Ung�lter Verzeichnis-Name! Es sind nur Buchstaben, Zahlen sowie Binde- und Unterstrich erlaubt.',
'INFO_EXISTS' => 'Es besteht bereits ein Verzeichnis mit diesem Namen!',
'MSG_OK' => 'Das Verzeichnis wurde umbenannt! Sie werden nun weitergeleitet...'
);

//////////////////////////////////////////////////////////////////////////////////////////

//MESSAGES, MEHRMALS VERWENDET
$lang['actions']['messages'] = array(
'INFO_NOTALLOWED' => 'Dieser Dateityp ist verboten!',
'INFO_WRONGSYNTAX' => 'Ung�lter Dateiname! Es sind nur Buchstaben, Zahlen sowie Punkt, Binde- und Unterstrich erlaubt.',
'INFO_EXISTS' => 'Es besteht bereits eine Datei mit diesem Namen!'
);

//UPLOAD
$lang['actions']['upload'] = array (
'FILES' => 'Dateien hochladen',
'PICS' => 'Bilder hochladen',
'FILE' => 'Datei',
'PIC' => 'Bild',
'PICINFO' => '<b>Achtung:</b> Es k�nnen nur Bilder vom Typ JPG und PNG bearbeitet werden!',
'GLOBALOPTIONS' => 'Optionen f�r alle setzen',
'WATERMARK' => 'Wasserzeichen',
'RESIZETO' => 'Bild verkleinern auf',
'THUMB' => 'Thumbnail erstellen',
'SUBMIT' => 'Dateien hochladen',
'INFO_NOTALLOWED' => 'Der Dateityp von "{NAME}" darf nicht hochgeladen werden!',
'INFO_EXISTS' => 'In diesem Ordner existiert bereits eine Datei mit dem Namen "{NAME}"!',
'INFO_FAILEDTHUMB' => 'Das Thumbnail kann nicht erstellt werden.',
'INFO_WRONGSYNTAX' => '"{NAME}" ist ein ung�ltiger Dateiname! Es sind nur Buchstaben, Zahlen sowie Punkt, Binde- und Unterstrich erlaubt.',
'INFO_NOPIC' => '"{NAME}" ist keine g�ltige Bilddatei!',
'MSG_OK' => 'Die Dateien wurde hochgeladen! Sie werden nun weitergeleitet...'
);

//STS
$lang['actions']['sts'] = array_merge($lang['actions']['messages'],array (
'SOURCE' => 'Quell-URL',
'FILENAME' => 'Neuer Dateiname',
'SUBMIT' => 'Datei herunterladen',
'INFO_EXISTS' => 'Im Zielverzeichnis besteht bereits eine Datei mit diesem Namen!',
'MSG_CONNFAILED' => 'Verbindung zum Server fehlgeschlagen!',
'MSG_WRITEFAILED' => 'Datei konnte nicht geschrieben werden!',
'MSG_OK' => 'Die Datei wurde heruntergeladen!<br />Transferdauer: {TIME} Sek.<br />Dateigr��e: {SIZE}'
));

//RENAME
$lang['actions']['rename'] = array_merge($lang['actions']['messages'],array (
'NAME' => 'Neuer Dateiname',
'SUBMIT' => 'Datei umbenennen',
'MSG_OK' => 'Die Datei wurde umbenannt! Sie werden nun weitergeleitet...'
));

//COPY
$lang['actions']['copy'] = array_merge($lang['actions']['messages'],array (
'FILENAME' => 'Datei',
'FILENAMES' => 'Datei(en)',
'DESTINATION' => 'Ziel-Verzeichnis',
'ROOT' => 'Mediendatenbank',
'SUBMIT' => 'Kopieren',
'INFO_EXISTS' => 'Im Zielverzeichnis besteht bereits eine Datei mit diesem Namen!',
'MSG_OK' => 'Die Datei wurde kopiert! Sie werden nun weitergeleitet...',
'MSG_OK_MULTI' => 'Die Dateien wurden kopiert! Sie werden nun weitergeleitet...'
));

//MOVE
$lang['actions']['move'] = array_merge($lang['actions']['messages'],array (
'FILENAME' => 'Datei',
'FILENAMES' => 'Datei(en)',
'DESTINATION' => 'Ziel-Verzeichnis',
'ROOT' => 'Mediendatenbank',
'SUBMIT' => 'Verschieben',
'INFO_EXISTS' => 'Im Zielverzeichnis besteht bereits eine Datei mit diesem Namen!',
'MSG_OK' => 'Die Datei wurde verschoben! Sie werden nun weitergeleitet...',
'MSG_OK_MULTI' => 'Die Dateien wurden verschoben! Sie werden nun weitergeleitet...'
));

//DEL
$lang['actions']['del'] = array (
'MSG_TEXT' => 'Wollen Sie die Datei &quot;{TITLE}&quot; wirklich l�schen?',
'MSG_OK' => 'Die Datei wurde gel�scht! Sie werden nun weitergeleitet...'
);

//THUMB
$lang['actions']['thumb'] = array_merge($lang['actions']['messages'],array (
'INFO' => '<b>Achtung:</b> Bilder vom Typ GIF werden zu JPG konvertiert!',
'NEWNAME' => 'Dateiname',
'WIDTH' => 'Breite',
'HEIGHT' => 'H�he',
'KEEPRATIO' => 'Proportionen beibehalten',
'SUBMIT' => 'Thumbnail erstellen',
'MSG_OK' => 'Thumbnail wurde erstellt! Sie werden nun weitergeleitet...'
));

//DETAILS
$lang['actions']['details'] = array (
'LOCATION' => 'Ort',
'TYPE' => 'Dateityp',
'TYPE_UNKNOWN' => 'Unbekannt',
'SIZE' => 'Gr��e',
'LASTCHANGE' => 'Letzte �nderung',
'PREVIEW' => 'Vorschau',
'MSG_NOTEXISTS' => 'Diese Datei existiert nicht!'
);

//////////////////////////////////////////////////////////////////////////////////////////

//RULES
$lang['actions']['rules'] = array (
'COL_EXTENSION' => 'Endung',
'COL_NAME' => 'Datei-Bezeichnung',
'SORT_EXTENSION' => 'Endung',
'SORT_NAME' => 'Datei-Bezeichnung',
'NONE' => 'Noch keine Dateiregeln definiert!'
);

//RADD
$lang['actions']['radd'] = $lang['actions']['redit'] = array (
'EXTENSION' => 'Endung',
'NAME' => 'Bezeichnung',
'NOTHING' => 'Keine Sonderoption',
'UNDEL' => 'Darf nicht gel�scht/umbenannt/verschoben werden',
'BLOCK' => 'Darf nicht hochgeladen werden',
'SPECIAL' => 'Sonderoption',
'SUBMIT_ADD' => 'Regel erstellen',
'SUBMIT_EDIT' => 'Aktualisieren',
'INFO_WRONGEXT' => 'In Dateiendungen sind nur Buchstaben und Zahlen erlaubt!',
'INFO_EXISTS' => 'F�r diese Dateiendung besteht bereits eine Regel!',
'MSG_OK_ADD' => 'Die Regel wurde erstellt! Sie werden nun weitergeleitet...',
'MSG_OK_EDIT' => 'Die Regel wurde aktualisiert! Sie werden nun weitergeleitet...'
);

//RDEL
$lang['actions']['rdel'] = array (
'MSG_TEXT' => 'Wollen Sie diese Regel f�r &quot;{TITLE}&quot; wirklich l�schen?',
'MSG_OK' => 'Die Regel wurde gel�scht! Sie werden nun weitergeleitet...'
);

//////////////////////////////////////////////////////////////////////////////////////////

//SERACH
$lang['actions']['search'] = array (
'ITEMS' => 'Suchbegriffe',
'WILDCARD' => '* = beliebige Zeichen',
'SEARCHFOR' => 'Suchen nach',
'DIR' => 'Verzeichnis',
'ROOT' => 'Mediendatenbank',
'COL_FILE' => 'Datei',
'COL_DIR' => 'Verzeichnis',
'SUBMIT' => 'Suchen',
'RENAME' => 'Umbenennen',
'COPY' => 'Kopieren',
'MOVE' => 'Verschieben',
'THUMB' => 'Thumbnail erstellen',
'NONE' => 'Zu dieser Suchanfrage wurden keine Medien gefunden!'
);

//////////////////////////////////////////////////////////////////////////////////////////

//INLINESCREENS
$lang['actions']['inline'] = array (
'INLINE_OPEN' => 'Arbeitsfl�che �ffnen',
'INLINE_CLOSE' => 'Arbeitsfl�che schlie�en',
'INLINE_COL_CODE' => 'Code',
'INLINE_COL_IMAGE' => 'Bild',
'INLINE_DELTEXT' => 'Dieses Bild wirklich l�schen?',
'INLINE_UPLOAD' => 'Bild hochladen',
'INLINE_PIC' => 'Bilddatei',
'INLINE_OPTIONS' => 'Optionen',
'INLINE_RESIZE' => 'Bild verkleinern',
'INLINE_ALIGN' => 'Ausrichtung',
'INLINE_NOALIGN' => 'Keine',
'INLINE_LEFT' => 'Links',
'INLINE_RIGHT' => 'Rechts',
'INLINE_POPUP' => 'Popup mit Gro�ansicht',
'INLINE_WATERMARK' => 'Wasserzeichen',
'INLINE_TEXT' => 'Bildtext'
);

?>