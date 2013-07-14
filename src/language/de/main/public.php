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


//Index-Seite
$lang['index'] = array (
'HEADLINE' => 'Startseite',
'LASTGALLERY' => 'Neueste Galerien',
'LASTNEWS' => 'Aktuelle News',
'LASTARTICLES' => 'Aktuelle Artikel',
'LASTDOWNLOADS' => 'Neueste Downloads'
);


//Suche Basisplatzhalter
$lang['search_basic'] = array(
'SEARCHWEBSITE' => 'Website durchsuchen',
'SEARCHIT' => 'Suchen',
'TERM' => 'Begriff(e)',
'CONN' => 'Verkn�pfung',
'CONNAND' => 'UND-Verkn�pfung',
'CONNOR' => 'ODER-Verkn�pfung'
);


//Suche
$lang['search'] = array_merge($lang['search_basic'],array (
'HEADLINE' => 'Suchen',
'SEARCHIN' => 'Suchen in',
'SUBMIT' => 'Suchen',
'LAST_SEARCHES' => 'Zuletzt gesucht',
'NONE' => 'Keine passenden Eintr�ge gefunden!'
));


//Seite empfehlen
$lang['tell'] = array (
'HEADLINE' => 'Seite empfehlen',
'USERNAME' => 'Ihr Name',
'EMAIL' => 'Ihre eMail-Adresse',
'TOEMAIL' => 'Empf�nger eMail-Adresse',
'SUBJECT' => 'Betreff',
'TEXT' => 'Text',
'CAPTCHA' => 'Visuelle Best�tigung',
'SUBMIT' => 'eMail senden',
'MSG_WRONGCODE' => 'Der angegebene Best�tigungscode ist nicht korrekt!',
'MSG_OK' => 'Ihre Empfehlung wurde verschickt! Sie werden nun weitergeleitet...',
'MSG_MAILNOTVALID' => 'Eine der eMail-Adressen ist nicht g�ltig!',
'MAIL_TELL_TITLE' => 'Interessante Seite',
'MAIL_TELL_TEXT' => "Hallo\nich habe gerade eine Seite gefunden, die dich interessieren k�nnte:\n{URL}"
);


//Altersabfrage
$lang['checkage'] = array(
'MSG_CHECKAGE' => 'Dieser Inhalt ist erst ab 18 Jahren freigegeben. Bitte geben Sie Ihr Geburtsdatum ein:',
'MSG_TOOYOUNG' => 'Sie sind nicht alt genug, um diesen Inhalt anzusehen!'
);


////////////////////////////////////////////////////////////////////////////////////// FUNKTIONEN

//Smilies anzeigen
$lang['showsmilies'] = array (
'SMILIES' => 'Smilie-Liste',
'CLOSE' => 'Fenster schlie�en'
);


//Codes anzeigen
$lang['showcodes'] = array (
'CODES' => 'Code-Liste',
'FORUM' => 'Nur im Forum',
'SIGALLOWED' => 'Code ist auch in der Signatur erlaubt',
'CLOSE' => 'Fenster schlie�en'
);

?>