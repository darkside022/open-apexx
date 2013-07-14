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
$lang['modulename']['MODULENAME_ARTICLES'] = 'Artikel';


/************** HEADLINES **************/
$lang['titles'] = array (
'TITLE_ARTICLES_SHOW' => 'Artikel',
'TITLE_ARTICLES_ADD' => 'Artikel erstellen',
'TITLE_ARTICLES_EDIT' => 'Artikel bearbeiten',
'TITLE_ARTICLES_COPY' => 'Artikel kopieren',
'TITLE_ARTICLES_DEL' => 'Artikel l�schen',
'TITLE_ARTICLES_ENABLE' => 'Artikel ver�ffentlichen',
'TITLE_ARTICLES_DISABLE' => 'Artikel widerrufen',

'TITLE_ARTICLES_CATSHOW' => 'Kategorien',
'TITLE_ARTICLES_CATADD' => 'Kategorie erstellen',
'TITLE_ARTICLES_CATEDIT' => 'Kategorie bearbeiten',
'TITLE_ARTICLES_CATDEL' => 'Kategorie l�schen',
'TITLE_ARTICLES_CATCLEAN' => 'Kategorie leeren',
'TITLE_ARTICLES_CATMOVE' => 'Kategorie verschieben'
);


/************** NAVIGATION **************/
$lang['navi'] = array (
'NAVI_ARTICLES_SHOW' => 'Artikel zeigen',
'NAVI_ARTICLES_ADD' => 'Neuer Artikel',
'NAVI_ARTICLES_CATSHOW' => 'Kategorien'
);


/************** ACTION EXPLICATION **************/
$lang['expl'] = array (
'EXPL_ARTICLES_EDIT' => 'Sonderrechte geben auch Zugriff auf fremde Artikel',
'EXPL_ARTICLES_COPY' => 'Sonderrechte geben auch Zugriff auf fremde Artikel',
'EXPL_ARTICLES_DEL' =>'Sonderrechte geben auch Zugriff auf fremde Artikel',
'EXPL_ARTICLES_ENABLE' => 'Sonderrechte geben auch Zugriff auf fremde Artikel',
'EXPL_ARTICLES_DISABLE' => 'Sonderrechte geben auch Zugriff auf fremde Artikel'
);


/************** LOG MESSAGES **************/
$lang['log'] = array (
'LOG_ARTICLES_ADD' => 'Artikel erstellt',
'LOG_ARTICLES_EDIT' => 'Artikel bearbeitet',
'LOG_ARTICLES_COPY' => 'Artikel kopiert',
'LOG_ARTICLES_DEL' => 'Artikel gel�scht',
'LOG_ARTICLES_ENABLE' => 'Artikel ver�ffentlicht',
'LOG_ARTICLES_DISABLE' => 'Artikel widerrufen',

'LOG_ARTICLES_CATADD' => 'Artikel-Kategorie erstellt',
'LOG_ARTICLES_CATEDIT' => 'Artikel-Kategorie bearbeitet',
'LOG_ARTICLES_CATDEL' => 'Artikel-Kategorie gel�scht',
'LOG_ARTICLES_CATCLEAN' => 'Artikel-Kategorie geleert'
);


/************** MEDIAMANAGER **************/
$lang['media'] = array (
'MM_INSERTARTPIC' => 'Als Aufmacher-Bild einf�gen',
'MM_INSERTTEXT' => 'In den Text einf�gen'
);


/************** CONFIG **************/
$lang['config'] = array (
'VIEW' => 'Darstellung',
'OPTIONS' => 'Einstellungen',
'CUSTOM' => 'Benutzerdef. Felder',
'IMAGES' => 'Bilder',
'SEARCHABLE' => 'Soll das Modul in die Suchfunktion einbezogen werden?',
'EPP' => 'Artikel pro Seite: (0 = alle zeigen)',
'ARCHIVEEPP' => 'Artikel pro Seite im Archiv: (0 = alle zeigen)',
'SEARCHEPP' => 'Artikel pro Seite in den Suchergebnissen: (0 = alle zeigen)',
'ARCHIVEALL' => 'Alle Artikel im Archiv zeigen?',
'ARCHIVESORT' => 'Archiv-Monate sortieren nach:',
'ARCHIVEENTRYSORT' => 'Artikel im Archiv sortieren nach:',
'NEWFIRST' => 'Neue zuerst',
'OLDFIRST' => 'Alte zuerst',
'ARTPIC_WIDTH' => 'Maximale Breite des Aufmacher-Bilds:',
'ARTPIC_HEIGHT' => 'Maximale H�he des Aufmacher-Bilds:',
'ARTPIC_POPUP' => 'Aufmacher-Bild mit Popup in Originalgr��e?',
'ARTPIC_POPUP_WIDTH' => 'Maximale Breite des Aufmacher-Popups:',
'ARTPIC_POPUP_HEIGHT' => 'Maximale H�he des Aufmacher-Popups:',
'ARTPIC_QUALITY' => 'Qualit�tiv hochwertigere Verkleinerung (rechenaufwendig!)?',
'PICHEIGHT' => 'Bilderserie: Maximale H�he der Bilder:',
'PICWIDTH' => 'Bilderserie: Maximale Breite der Bilder:',
'WATERMARK' => 'Bilderserie: Pfad zum Wasserzeichen-Quellbild (relativ zum apexx-Ordner). G�ltige Formate sind GIF, JPG und PNG.',
'WATERMARK_TRANSP' => 'Bilderserie: Transparenz des Wasserzeichens in Prozent (0-100). Gilt nur f�r Wasserzeichen im GIF- oder JPG-Format, bei PNG wird die Transparenz durch den Alpha-Channel bestimmt.',
'WATERMARK_POSITION' => 'Bilderserie: Position des Wasserzeichens:',
'POPUP_RESIZEABLE' => 'Bilderserie: Gr��e des Popup-Fensters von Benutzer ver�nderbar?',
'POPUP_ADDWIDTH' => 'Bilderserie: Pixelzahl, die der Breite des Popup-Fensters hinzugef�gt wird:',
'POPUP_ADDHEIGHT' => 'Bilderserie: Pixelzahl, die der H�he des Popup-Fensters hinzugef�gt wird:',
'POSTOP' => 'oben',
'POSMIDDLE' => 'mitte',
'POSBOTTOM' => 'unten',
'POSLEFT' => 'links',
'POSCENTER' => 'zentriert',
'POSRIGHT' => 'rechts',
'THUMBWIDTH' => 'Bilderserie: Maximale Breite des Vorschau-Bilds:',
'THUMBHEIGHT' => 'Bilderserie: Maximale H�he des Vorschau-Bilds:',
'CUSTOM_PREVIEW' => 'Vorschauen: Bezeichnungen f�r zus�tzliche Eingabefelder (maximal 10):',
'CUSTOM_REVIEW' => 'Tests: Bezeichnungen f�r zus�tzliche Eingabefelder (maximal 10):',
'AWARDS' => 'Tests: Titel f�r verf�gbare Auszeichnungen:',
'RATEFIELDS' => 'Tests: Bezeichnungen f�r die Bewertungskriterien:',
'PREVIEWS_CONCLUSIONPAGE' => 'Vorschauen: Fazit auf einer eigenen Seite am Ende des Artikels anzeigen?',
'REVIEWS_CONCLUSIONPAGE' => 'Tests: Fazit auf einer eigenen Seite am Ende des Artikels anzeigen?',
'NORMALONLY' => 'In der articles.php keine Test und Vorschauen anzeigen?',
'COMS' => 'Kommentare aktivieren?',
'ARCHCOMS' => 'Kommentieren von archivierten Artikeln erlauben?',
'RATINGS' => 'Bewertungen aktivieren?',
'ARCHRATINGS' => 'Bewerten von archivierten Artikeln erlauben?',
'TEASER' => 'Teaser-Text verwenden?',
'SUBCATS' => 'Unter-Kategorien verwenden?'
);


/************** ACTIONS **************/

//SHOW
$lang['actions']['show'] = array (
'LAYER_ALL' => 'Alle',
'LAYER_SELF' => 'Eigene',
'NORMALS' => 'Normale Artikel',
'PREVIEWS' => 'Vorschauen',
'REVIEWS' => 'Tests',
'COL_TITLE' => 'Titel',
'COL_USER' => 'Autor',
'COL_CATEGORY' => 'Kategorie',
'COL_PUBDATE' => 'Datum',
'COL_HITS' => 'Klicks',
'SORT_ADDTIME' => 'Erstellungsdatum',
'SORT_STARTTIME' => 'Ver�ffentlichung',
'SEARCHTEXT' => 'Stichwort',
'SEARCH' => 'Suchen',
'STITLE' => 'Titel',
'SSUBTITLE' => 'Untertitel',
'STEASER' => 'Teaser-Text',
'SPAGES' => 'Artikel-Seiten',
'USERNAME' => 'Benutzer',
'TYPE' => 'Typ',
'SECTION' => 'Sektion',
'CATEGORY' => 'Kategorie',
'ALL' => 'Alle',
'ADDPAGE' => 'Artikel-Seiten',
'COPY' => 'Kopieren',
'COMMENTS' => 'Kommentare zeigen',
'RATINGS' => 'Bewertungen zeigen',
'GUEST' => 'Gast',
'BY' => 'von',
'NONE' => 'Keine Artikel gefunden!',
'NORMAL' => 'Normal',
'PREVIEW' => 'Vorschau',
'REVIEW' => 'Test'
);


//ADD + EDIT
$lang['actions']['add'] = $lang['actions']['edit'] = array (
'OPTIONS' => 'Optionen',
'LINKS' => 'Angef�gte Links',
'TYPE' => 'Artikel-Typ',
'NORMAL' => 'Normal',
'ARTICLE' => 'Artikel',
'PREVIEW' => 'Vorschau',
'REVIEW' => 'Test',
'AUTHOR' => 'Autor',
'LINKPRODUCT' => 'Produkt verkn�pfen',
'SECTION' => 'In dieser Sektion anzeigen',
'ALLSEC' => 'Alle Sektionen',
'CATEGORY' => 'Kategorie',
'NEWCAT' => 'Kategorie erstellen',
'TITLE' => 'Titel',
'SUBTITLE' => 'Untertitel',
'ARTPIC' => 'Aufmacher-Bild',
'ARTPIC_UPLOAD' => 'Hochladen',
'ARTPIC_PATH' => 'Bild verwenden',
'LINKGALLERY' => 'Galerie verkn�pfen',
'TAGS' => 'Tags',
'TAGSINFO' => 'einzelne Tags durch Kommas trennen',
'META_DESCRIPTION' => 'Meta Description',
'SHOWPIC' => 'Bild anzeigen',
'DELPIC' => 'L�schen',
'INLINESCREENS' => 'Inline-Bilder',
'TEASER' => 'Teaser-Text',
'TEXT' => 'Text',
'PUBLICATION' => 'Ver�ffentlichung',
'STARTTIME' => 'Ver�ffentlichen ab',
'ENDTIME' => 'Automatisch widerrufen',
'LTITLE' => 'Titel',
'LTEXT' => 'Linktext',
'LURL' => 'URL',
'LPOP' => 'Neues Fenster?',
'LLINK' => 'Link:',
'NEWLINE' => 'Neue Zeile',
'ALLOWCOMS' => 'Kommentare erlauben',
'ALLOWRATING' => 'Bewertung erlauben',
'RESTRICTED' => 'Altersabfrage aktivieren (ab 18 Jahren)',
'TOPARTICLE' => 'Dies ist ein Top-Artikel',
'STICKY' => 'Immer als erstes zeigen, optionales Ende',
'PUBNOW' => 'Sofort ver�ffentlichen',
'SEARCHABLE' => 'In die Suche einbeziehen',
'INFO_NOTALLOWED' => 'Der Dateityp des Aufmacher-Bilds darf nicht hochgeladen werden!',
'INFO_NOIMAGE' => 'Der Dateityp des Aufmacher-Bilds ist keine g�ltige Bild-Datei!',
'SUBMIT_PAGEADD' => 'Weiter: Artikelseiten erstellen',
'SUBMIT_PAGEEDIT' => 'Weiter: Artikelseiten bearbeiten',
'SUBMIT_PICS' => 'Weiter: Bilderserie',
'SUBMIT_CONCLUSION' => 'Weiter: Fazit',
'SUBMIT_FINISH' => 'Artikel fertigstellen'
);


//DEL
$lang['actions']['del'] = array (
'MSG_TEXT' => 'Wollen Sie den Artikel &quot;{TITLE}&quot; wirklich l�schen?'
);


//COPY
$lang['actions']['copy'] = array (
'COPY' => 'Kopieren',
'MSG_TEXT' => 'Wollen Sie den Artikel &quot;{TITLE}&quot; wirklich kopieren?',
'COPYOF' => 'Kopie von: '
);


//ENABLE
$lang['actions']['enable'] = array (
'TITLE' => 'Artikel',
'STARTTIME' => 'Ver�ffentlichen ab',
'ENDTIME' => 'Automatisch widerrufen',
'SUBMIT' => 'Ver�ffentlichen'
);


//DISABLE
$lang['actions']['disable'] = array (
'MSG_TEXT' => 'Wollen Sie den Artikel &quot;{TITLE}&quot; wirklich widerrufen?',
'DISABLE' => 'Widerrufen'
);


//PADD + PEDIT
$lang['actions']['padd'] = array (
'ARTPAGES' => 'Artikelseiten',
'COL_TITLE' => 'Titel',
'MOVEUP' => 'Nach oben',
'MOVEDOWN' => 'Nach unten',
'NONE' => 'Noch keine Seiten erstellt!',
'TITLE' => 'Titel',
'TEXT' => 'Text',
'SUBMIT_PREV' => 'Vorherige Seite',
'SUBMIT_NEXT' => 'N�chste Seite',
'SUBMIT_NEW' => 'Weitere Seite anlegen'
);


//PDEL
$lang['actions']['pdel'] = array (
'MSG_TEXT' => 'Wollen Sie die Artikel-Seite &quot;{TITLE}&quot; wirklich l�schen?'
);


//CONCLUSION
$lang['actions']['conclusion'] = array (
'ADDNL' => 'Zus�tzliche Angaben',
'RATING' => 'Bewertung',
'FINALRATING' => 'Gesamtwertung',
'AWARD' => 'Auszeichnung',
'NOAWARD' => 'Keine',
'POSITIVE' => 'Positives',
'NEGATIVE' => 'Negatives',
'IMPRESSION' => 'Ersteindruck',
'CONLUSION' => 'Ausf�hrliches Fazit',
'SUBMIT_FINISH' => 'Artikel fertigstellen'
);


//PICTURES
$lang['actions']['pictures'] = array (
'PICTURES' => 'Bilderserie',
'UPLOAD' => 'Bilder hochladen',
'NOPICS' => 'Noch keine Bilder hochgeladen!',
'DELPIC' => 'Dieses Bild wirklich l�schen?',
'GLOBALOPTIONS' => 'Optionen f�r Alle',
'PIC' => 'Bild',
'WATERMARK' => 'Wasserzeichen',
'NORESIZE' => 'Nicht verkleinern',
'UPLOADNEXT' => 'Weitere Bilder hochladen',
'MSG_TEXT' => 'Wollen Sie dieses Bild wirklich l�schen?',
'SUBMIT_FINISH' => 'Artikel fertigstellen'
);


//CATSHOW
$lang['actions']['catshow'] = array (
'COL_CATNAME' => 'Titel',
'COL_ARTICLES' => 'Anzahl: Artikel',
'CLEAN' => 'Leeren &amp; L�schen',
'ATTINFO' => 'Zusatz-Informationen',
'USEDND' => 'Sie k�nnen die Kategorien per Drag &amp; Drop anordnen',
'NONE' => 'Noch keine Kategorien erstellt!'
);


//CATADD + CATEDIT
$lang['actions']['catadd'] = $lang['actions']['catedit'] = array (
'TITLE' => 'Titel',
'ICON' => 'Symbol-Pfad',
'CREATEIN' => 'Unterkategorie von',
'ROOT' => 'Dies ist eine Hauptkategorie',
'OPEN' => 'Kann Artikel enthalten',
'FORGROUP' => 'Benutzergruppen, die Artikel erstellen d�rfen',
'ALL' => 'Alle Benutzergruppen',
'SUBMIT_ADD' => 'Katgeorie erstellen',
'SUBMIT_EDIT' => 'Aktualisieren',
'INFO_CONTAINSARTICLES' => 'Diese Kategorie enth�lt bereits Artikel! Bitte zuerst leeren oder Artikel erlauben.'
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