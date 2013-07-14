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

//Wird immer geladen
$lang['all'] = array(
'HEADLINE' => 'Benutzersystem',
'VISITORS' => 'Letzte Besucher',
'REPORTTHIS' => 'Versto� melden',
'USERNAME' => 'Benutzername',
'PASSWORD' => 'Passwort',
'SUBMIT_LOGIN' => 'Anmelden',
'MSG_REGONLY' => 'Benutzerprofile k�nnen nur von registrierten Benutzern eingesehen werden!',
'MSG_FRIENDSONLY' => 'Das Profil kann nur von den Freunden des Benutzers eingesehen werden!'
);


//Icon-Beschriftung
$lang['icons'] = array(
'ICON_PROFILE' => 'Profil ansehen',
'ICON_SENDMAIL' => 'eMail senden',
'ICON_SENDPM' => 'Nachricht senden',
'ICON_ADDBUDDY' => 'Zur Freundesliste',
'ICON_DELBUDDY' => 'Freund l�schen',
'ICON_DELBOOKMARK' => 'Bookmark l�schen',
'ICON_ONLINE' => 'Online',
'ICON_OFFLINE' => 'Offline',
'ICON_ASC' => 'Aufsteigend',
'ICON_DESC' => 'Absteigend'
);


//Profil-Felder: Registrieren, Profil zeigen, Profil bearbeiten
$lang['profile_field'] = array(
'MINLENGTH' => 'Mindestl�nge',
'CHARS' => 'Zeichen',
'REQ' => 'Ben�tigte Angaben',
'ADDNL' => 'Optionale Angaben',
'PERSONAL' => 'Pers�nliche Angaben',
'CONTACT' => 'Kontaktm�glichkeiten',
'OPTIONS' => 'Einstellungen',
'CAPTCHA' => 'Visuelle Best�tigung',
'USERID' => 'Benutzer-ID',
'USERNAME' => 'Benutzername',
'PWD' => 'Passwort',
'REPEAT' => 'Wiederholung',
'EMAIL' => 'eMail',
'GROUP' => 'Benutzergruppe',
'LASTACTIVE' => 'Zuletzt aktiv',
'COMMENTS' => 'Kommentare',
'FORUM' => 'Forum',
'POSTINGS' => 'Beitr�ge',
'FINDPOSTS' => 'Beitr�ge finden',
'STATUS' => 'Status',
'SENDEMAIL' => 'eMail senden',
'SENDPM' => 'Nachricht senden',
'ADDBUDDY' => 'Zur Freundesliste hinzuf�gen',
'ADDIGNORE' => 'Zur Ignorier-Liste hinzuf�gen',
'HOMEPAGE' => 'Website',
'REALNAME' => 'Echter Name',
'GENDER' => 'Geschlecht',
'SECRET' => 'geheim',
'MALE' => 'm�nnlich',
'FEMALE' => 'weiblich',
'BDAY' => 'Geburtstag',
'COUNTRY' => 'Land',
'CITY' => 'Ort',
'INTERESTS' => 'Interessen',
'WORK' => 'Beruf',
'INVISIBLE' => 'Unsichtbar sein',
'HIDEMAIL' => 'eMail-Adresse verstecken',
'POPPM' => 'Popup bei neuer Nachricht',
'MAILPM' => 'eMail-Benachrichtigung bei neuer Nachricht',
'SHOWBUDDIES' => 'Freundesliste im Profil anzeigen',
'USEGB' => 'G�stebuch-Modus',
'GBENABLED' => 'aktiviert',
'GBDISABLED' => 'deaktiviert',
'GBFRIENDS' => 'nur f�r meine Freunde',
'GBMAIL' => 'eMail-Benachrichtigung bei neuem G�stebuch-Eintrag',
'PROFILEFORFRIENDS' => 'Profil nur meinen Freunden zeigen',
'AUTOSUBSCRIBE' => 'Themen im Forum automatisch abonnieren',
'LANG' => 'Sprache',
'THEME' => 'Website-Stil',
'USEDEFAULT' => 'Standard verwenden'
);


//Benutzer-Funktionen
$lang['profile_global'] = array(
'USER_PROFILE' => 'Profil',
'USER_BLOG' => 'Blog',
'USER_GUESTBOOK' => 'G�stebuch',
'USER_GALLERY' => 'Galerien',
'USER_COLLECTION' => 'Sammlung'
);



////////////////////////////////////////////////////////////////////////////////////////// -> AKTIONEN

//Login
$lang['login'] = array(
'HEADLINE_LOGIN' => 'Anmeldung',
'USER' => 'Benutzername',
'PWD' => 'Passwort',
'SUBMIT' => 'Anmelden',
'REGISTER' => 'Registrieren',
'GETPWD' => 'Passwort vergessen?',
'GETKEY' => 'Aktivierungs-Key anfordern',
'MSG_ADMINACTIVATION' => 'Ihr Account muss erst von einem Administrator freigeschaltet werden!',
'MSG_FAIL' => 'Anmeldung fehlgeschlagen! Benutzername und Passwort stimmen nicht �berein!',
'MSG_BLOCK' => 'Sie haben sich f�nf mal falsch angemeldet! Ihr Account ist f�r 15 Minuten gesperrt.',
'MSG_BANNED' => 'Anmeldung fehlgeschlagen! Ihr Account wurde von einem Administrator gesperrt.',
'MSG_NOTACTIVE' => 'Anmeldung fehlgeschlagen! Sie m�ssen Ihren Account erst mit dem Aktivierungs-Code freischalten.',
'MSG_OK' => 'Anmeldung erfolgreich! Sie werden nun weitergeleitet...'
);


//Logout
$lang['logout'] = array(
'MSG_OK' => 'Abmeldung erfolgreich! Sie werden nun weitergeleitet...'
);


//Registrieren
$lang['register'] = array_merge($lang['profile_field'],array(
'HEADLINE_REGISTER' => 'Registrieren',
'RULES' => '[Keine Regeln]',
'ACCEPT' => 'Akzeptieren',
'DECLINE' => 'Ablehnen',
'SUBMIT' => 'Registrieren',
'MSG_USERLENGTH' => 'Der Benutzername muss mindestens {LENGTH} Zeichen lang sein!',
'MSG_PWDLENGTH' => 'Das Passwort muss mindestens {LENGTH} Zeichen lang sein!',
'MSG_PWNOMATCH' => 'Passwort und Passwort-Wiederholung stimmen nicht �berein!',
'MSG_EMAILNOMATCH' => 'eMail und eMail-Wiederholung stimmen nicht �berein!',
'MSG_USEREXISTS' => 'Unter diesem Benutzernamen existiert bereits ein Account!',
'MSG_USERNOTALLOWED' => 'Ihr Benutzername enth�lt die verbotene Zeichenfolge "{STRING}"!',
'MSG_MAILEXISTS' => 'Unter dieser eMail-Adresse existiert bereits ein Account!',
'MSG_NOMAIL' => 'Die angegebene eMail-Adresse ist nicht g�ltig!',
'MSG_WRONGCODE' => 'Der angegebene Best�tigungscode ist nicht korrekt!',
'MSG_OK' => 'Registrierung erfolgreich! Sie werden nun zur Anmeldung weitergeleitet...',
'MSG_OK_ADMINACTIVATE' => 'Registrierung erfolgreich! Bevor Sie Ihren Account nutzen k�nnen, muss er erst von einen Administrator freigeschaltet werden.',
'MSG_OK_ACTIVATE' => 'Registrierung erfolgreich! Bevor Sie Ihren Account nutzen k�nnen, m�ssen Sie ihn erst mit dem Code aktivieren, der Ihnen per eMail zugeschickt wurde.',
'MAIL_NEWREG_TITLE' => 'Benutzer registriert',
'MAIL_NEWREG_TEXT' => "Hallo,\nsoeben hat sich auf der Seite {URL} ein neuer Benutzer mit Namen \"{USERNAME}\" registriert.\n\napexx Mailbot",
'MAIL_REG_TITLE' => 'Registrierung',
'MAIL_REG_TEXT' => "Hallo {USERNAME},\nSie haben sich soeben auf der Website {WEBSITE} registriert, hier sind Ihre Benutzerdaten:\n\nBenutzername: {USERNAME}\nPasswort:     {PASSWORD}\n\nGr��e, das Team von {WEBSITE}",
'MAIL_REGACTIVATION_TITLE' => 'Registrierung',
'MAIL_REGACTIVATION_TEXT' => "Hallo {USERNAME},\nSie haben sich soeben auf der Website {WEBSITE} registriert, hier sind Ihre Benutzerdaten:\n\nBenutzername: {USERNAME}\nPasswort:     {PASSWORD}\n\nUm den Account nutzen zu k�nnen, m�ssen Sie ihn zun�chst aktivieren. Klicken Sie dazu auf diese URL: {URL}\n\nGr��e, Team von {WEBSITE}",
'MAIL_REGADMINACTIVATION_TITLE' => 'Registrierung',
'MAIL_REGADMINACTIVATION_TEXT' => "Hallo {USERNAME},\nSie haben sich soeben auf der Website {WEBSITE} registriert, hier sind Ihre Benutzerdaten:\n\nBenutzername: {USERNAME}\nPasswort:     {PASSWORD}\n\nIhr Account muss erst von einem Administrator freigeschaltet werden, damit Sie ihn nutzen k�nnen.\n\nGr��e, Team von {WEBSITE}"
));


//Passwort anfordern + Aktivierungs-Key anfordern
$lang['getpwd'] = $lang['getregkey'] = array(
'HEADLINE_GETPWD' => 'Passwort anfordern',
'HEADLINE_GETREGKEY' => 'Aktivierungs-Code anfordern',
'USERNAME' => 'Benutzername',
'EMAIL' => 'eMail',
'SUBMIT_PWD' => 'Neues Passwort anfordern',
'SUBMIT_REGKEY' => 'Code anfordern',
'MSG_NOMATCH' => 'Benutzername nicht gefunden!',
'MSG_NOTALLOWED' => 'Der Best�tigungscode ist nicht korrekt!',
'MSG_ISACTIVE' => 'Ihr Benutzer-Account ist bereits aktiviert!',
'MSG_OK_PWD' => 'Ein neues Passwort wurde Ihnen soeben zugeschickt! Sie werden nun weitergeleitet...',
'MSG_OK_PWDREQ' => 'Es wurde ein Best�tigungslink an {EMAIL} geschickt. Sie werden nun weitergeleitet...',
'MSG_OK_REGKEY' => 'Ihr Aktivierungs-Code wurde Ihnen soeben zugeschickt! Sie werden nun weitergeleitet...',
'MAIL_GETPWD_TITLE' => 'Neues Passwort erstellt',
'MAIL_GETPWD_TEXT' => "Hallo {USERNAME},\nein neues Passwort wurde f�r Sie erzeugt.\n\nPasswort: {PWD}\n\nGr��e, das Team von {WEBSITE}",
'MAIL_GETPWDREQ_TITLE' => 'Neues Passwort angefordert',
'MAIL_GETPWDREQ_TEXT' => "Hallo {USERNAME},\nSie haben soeben auf {WEBSITE} ein neues Passwort angefordert. Bitte best�tigen Sie mit dem folgenden Link: {URL}\nFalls Sie das Passwort nicht angefordert haben, ignorieren Sie diese eMail einfach.\n\nGr��e, das Team von {WEBSITE}",
'MAIL_GETKEY_TITLE' => 'Ihr Aktivierungs-Code',
'MAIL_GETKEY_TEXT' => "Hallo {USERNAME},\nSie haben soeben auf {WEBSITE} ihren Aktivierungskey erneut angefordert. Klicken Sie dazu auf diese URL: {URL}\n\nGr��e, das Team von {WEBSITE}"
);


//Account aktivieren
$lang['activate'] = array(
'MSG_ISACTIVE' => 'Dieser Benutzer-Account ist bereits aktiviert!',
'MSG_WRONGKEY' => 'Der Aktivierung-Code ist falsch, wenden Sie sich an einen Administrator!',
'MSG_OK' => 'Der Benutzer-Account wurde aktiviert! Sie werden nun weitergeleitet...',
);


//Userliste
$lang['userlist'] = array_merge($lang['icons'],array(
'HEADLINE_USERLIST' => 'Registrierte Benutzer',
'SEARCHUSER' => 'Benutzer suchen',
'USERCOUNT' => 'Registrierte Benutzer gesamt',
'TODAYNEW' => 'Neue Registrierungen heute',
'USERNAME' => 'Benutzername',
'FORUMPOSTS' => 'Forumbeitr�ge',
'REGSINCE' => 'Registriert seit...',
'OPTIONS' => 'Optionen',
'DAYS' => 'Tage',
'SORTBY' => 'Sortieren nach',
'NONE' => 'Keine Benutzer gefunden!',
'SORT_USERNAME' => 'Benutzername',
'SORT_REGDATE' => 'Registrierung'
));


//Suche
$lang['search'] = array(
'HEADLINE_SEARCH' => 'Benutzersuche',
'ITEM' => 'Stichwort/Name',
'AGE' => 'Alter',
'YEARS' => 'Jahre',
'GENDER' => 'Geschlecht',
'NOGENDER' => 'egal',
'MALE' => 'm�nnlich',
'FEMALE' => 'weiblich',
'CITY' => 'Wohnort',
'ONLINE' => 'Nur Online-User?',
'DISTANCE' => 'Entfernung',
'STARTSEARCH' => 'Suche starten',
'SELECT' => 'Ausw�hlen',
'MSG_CHOOSECITY' => 'Die Ortsangabe ist nicht eindeutig! Bitte w�hlen Sie:',
'MSG_NOCITY' => 'Kein Ort mit diesen Angaben gefunden!',
'MSG_NORESULT' => 'Die Suche lieferte kein Ergebnis!'
);


//Online-Liste
$lang['onlinelist'] = array_merge($lang['icons'],array(
'HEADLINE_ONLINELIST' => 'Wer ist online?',
'USERNAME' => 'Benutzer',
'LASTACTIVE' => 'Zuletzt aktiv',
'NONE' => 'Kein registrierter Benutzer online',
'TOTAL' => 'Benutzer online',
'USERS' => 'Registrierte',
'GUESTS' => 'G�ste',
'INV' => 'Geister'
));


//Teamseite
$lang['team'] = array_merge($lang['icons'],array(
'HEADLINE' => 'Team',
'USERNAME' => 'Benutzer',
'LASTACTIVE' => 'Zuletzt aktiv',
'FORUM_MOD' => 'Forum-Moderatoren'
));


//Online-Liste
$lang['usermap'] = array(
'HEADLINE_USERMAP' => 'Mitgliederkarte'
);


//Index
$lang['index'] = array(
'WELCOME' => 'Willkommen im Benutzer-Center, ',
'PROFILE' => 'Profil bearbeiten',
'SHOWPROFILE' => 'Profil betrachten',
'SIGNATURE' => 'Signatur bearbeiten',
'AVATAR' => 'Avatar hochladen',
'MESSAGES' => 'Pers�nliche Nachrichten',
'IGNORELIST' => 'Ignorier-Liste verwalten',
'FRIENDS' => 'Freundesliste anzeigen',
'NEWMESSAGE' => 'Neue Nachricht',
'NEWMAIL' => 'Neue eMail',
'SUBSCRIPTIONS' => 'Forum-Abonnements',
'BLOG' => 'Blog verwalten',
'GALLERY' => 'Galerien verwalten',
'SHOWBLOG' => 'Blog ansehen',
'SHOWGALLERY' => 'Galerien ansehen',
'SHOWGUESTBOOK' => 'G�stebuch ansehen',
'SHOWCOLLECTION' => 'Meine Sammlung ansehen',
'LOGOUT' => 'Abmelden'
);


//Eigenes Profil
$lang['myprofile'] = array_merge($lang['profile_field'],array (
'HEADLINE_MYPROFILE' => 'Profil bearbeiten',
'SUBMIT' => 'Profil aktualisieren',
'CONFIRMAGE' => 'Alter best�tigen',
'MSG_IDENT_INCOMPLETE' => 'Die Personalausweis-Nummer ist nicht vollst�ndig!',
'MSG_IDENT_INVALIDCHARS' => 'Die Personalausweis-Nummer darf nur aus Ziffern bestehen!',
'MSG_IDENT_INVALID' => 'Die Personalausweis-Nummer ist ung�ltig!',
'MSG_IDENT_EXPIRED' => 'Der Personalausweis ist nicht mehr g�ltig!',
'MSG_IDENT_TOOYOUNG' => 'Sie sind {AGE} Jahre alt und somit nicht berechtigt f�r Inhalte ab 18 Jahren!',
'MSG_PWDLENGTH' => 'Das Passwort muss mindestens {LENGTH} Zeichen lang sein!',
'MSG_PWNOMATCH' => 'Passwort und Passwort-Wiederholung stimmen nicht �berein!',
'MSG_USEREXISTS' => 'Unter diesem Benutzernamen existiert bereits ein Account!',
'MSG_NOMAIL' => 'Die angegebene eMail-Adresse ist nicht g�ltig!',
'MSG_OK' => 'Ihr Profil wurde aktualisiert! Sie werden nun weitergeleitet...',
'MSG_OK_NEWPWD' => 'Ihr Profil wurde aktualisiert! Sie werden nun automatisch abgemeldet, weil Sie ihr Passwort ge�ndert haben...',
'MSG_OK_NEWEMAIL' => 'Ihr Profil wurde aktualisiert! Sie m�ssen Ihren Account erst reaktivieren, da Sie Ihre eMail-Adresse ge�ndert haben.',
'MAIL_GETKEY_TITLE' => 'Ihr Aktivierungs-Code',
'MAIL_GETKEY_TEXT' => "Hallo {USERNAME},\nSie haben soeben auf {WEBSITE} Ihre eMail-Adresse ge�ndert, daher m�ssen Sie Ihren Account erst reaktivieren. Klicken Sie dazu auf diese URL: {URL}\n\nGr��e,das Team von {WEBSITE}"
));


//Profil zeigen
$lang['profile'] = array_merge($lang['profile_global'],$lang['profile_field'],array(
'HEADLINE_PROFILE' => 'Benutzerprofil',
'ACCOUNT' => 'Account',
'IDENT' => 'Erkennungsmerkmale',
'REGSINCE' => 'Registriert seit',
'DAYS' => 'Tage',
'SIGNATURE' => 'Signatur',
'AVATAR' => 'Avatar',
'BUDDIES' => 'Freunde'
));


//G�stebuch
$lang['guestbook'] = array_merge($lang['profile_global'],array(
'HEADLINE_GUESTBOOK' => 'Benutzer-G�stebuch',
'COL_NAME' => 'Name',
'COL_TEXT' => 'Kommentar',
'ICON_EMAIL' => 'eMail senden',
'ICON_HOMEPAGE' => 'Homepage besuchen',
'NONE' => 'Keine Eintr�ge vorhanden!',
'SIGNGB' => 'Eintragen',
'NAME' => 'Name',
'TITLE' => 'Titel',
'TEXT' => 'Text',
'SUBMIT' => 'Eintragen',
'DELENTRY' => 'L�schen',
'MAIL_SENDENTRY_TITLE' => 'Neuer G�stebuch-Eintrag',
'MAIL_SENDENTRY_TEXT' => "Hallo,\nsoeben wurde in Ihrem Benutzer-G�stebuch ein neuer Eintrag von {USERNAME} erstellt:\n{GOTO}\n\napexx Mailbot",
'MSG_IGNORED' => 'Eintragen nicht m�glich! Der Benutzer ignoriert Sie.',
'MSG_IGNORED_REASON' => 'Eintragen nicht m�glich! Der Benutzer ignoriert Sie mit dem Grund: {REASON}',
'MSG_DISABLED' => 'Der Benutzer hat sein G�stebuch deaktiviert!',
'MSG_FRIENDSONLY' => 'Der Benutzer hat sein G�stebuch nur f�r Freunde zug�nglich gemacht!',
'MSG_TOOLONG' => 'Ihr Text ist zu lang! Bitte fassen Sie sich k�rzer.',
'MSG_BLOCKSPAM' => 'Die Spamsperre ist noch {SEC} Sekunden aktiv!',
'MSG_TEXT' => 'Wollen Sie diesen Eintrag wirklich l�schen?',
'MSG_DEL_OK' => 'Der Eintrag wurde gel�scht! Sie werden nun weitergeleitet...',
'MSG_OK' => 'Danke f�r Ihren Eintrag im G�stebuch! Sie werden nun weitergeleitet...'
));


//Blog
$lang['blog'] = array_merge($lang['profile_global'],array(
'HEADLINE_BLOG' => 'Benutzer-Blog',
'COMMENTS' => 'Kommentare'
));


//Galerie
$lang['gallery'] = array_merge($lang['profile_global'],array(
'HEADLINE_GALLERY' => 'Benutzer-Galerien',
'PICTURES' => 'Bilder',
'HITS' => 'Klicks',
'COMMENTS' => 'Kommentare',
'MSG_PWDREQUIRED' => 'Diese Galerie ist durch ein Passwort gesch�tzt!',
'SUBMITPWD' => 'Passwort senden'
));


//Signatur
$lang['report'] = array(
'HEADLINE_REPORT' => 'Versto� melden',
'REASON' => 'Grund',
'SUBMIT' => 'Absenden',
'MAIL_REPORT_TITLE' => 'Versto� gemeldet',
'MAIL_REPORT_TEXT' => "Hallo,\nder folgenden Beitrag wurde gemeldet:\n{URL}\n\nBegr�ndung:\n{REASON}\n\napexx Mailbot",
'MSG_OK' => 'Danke f�r diesen Hinweis!'
);


//Signatur
$lang['signature'] = array(
'HEADLINE_SIGNATURE' => 'Signatur bearbeiten',
'SIGPREVIEW' => 'Vorschau',
'SIGNATURE' => 'Signatur',
'CHARSLEFT' => 'Verbleibende Zeichen',
'SUBMIT' => 'Aktualisieren',
'PREVIEW' => 'Vorschau zeigen',
'MSG_SIGTOOLONG' => 'Ihre Signatur ist zu lang!',
'MSG_OK' => 'Ihre Signatur wurde aktualisiert! Sie werden nun weitergeleitet...'
);


//Avatar hochladen
$lang['avatar'] = array(
'HEADLINE_AVATAR' => 'Avatar hochladen',
'CURRENT' => 'Aktueller Avatar',
'AVATAR' => 'Avatar',
'EDITAVATAR' => 'Avatar bearbeiten',
'DELAVATAR' => 'Avatar L�schen',
'CHOOSEFILE' => 'Neuen Avatar hochladen',
'AVTITLE' => 'Avatar-Titel',
'MAX_FILESIZE' => 'Maximale Dateigr��e',
'MAX_DIMENSIONS' => 'Maximale H�he/Breite',
'MSG_MAXSIZE' => 'Der Avatar ist gr��er als die erlaubte Datenmenge!',
'MSG_MAXDIM' => 'Der Avatar ist breiter oder h�her als die erlaubte Gr��e!',
'MSG_NOTALLOWED' => 'Dieser Dateityp ist f�r einen Avatar ung�ltig!',
'MSG_OK' => 'Ihr Avatar wurde aktualisiert! Sie werden nun weitergeleitet...',
'SUBMIT' => 'Aktualisieren'
);


//PNs zeigen
$lang['pms'] = array(
'HEADLINE_PMS' => 'Pers�nliche Nachrichten',
'NEWPM' => 'Neue Nachricht',
'PMSPACE' => 'Speicher',
'FREE' => 'frei',
'INBOX' => 'Posteingang',
'OUTBOX' => 'Postausgang',
'SUBJECT' => 'Betreff',
'SENDER' => 'Absender',
'RECIEVER' => 'Empf�nger',
'DATE' => 'Datum/Zeit',
'NONE' => 'Keine Nachrichten gefunden!',
'DELPMS' => 'Nachrichten l�schen',
'SORTBY' => 'Sortieren nach',
'SORT_SUBJECT' => 'Betreff',
'SORT_USERNAME' => 'Benutzer',
'SORT_TIME' => 'Datum/Zeit'
);


//Neue Nachricht
$lang['newpm'] = array(
'HEADLINE_NEWPM' => 'Neue Nachricht',
'RECIEVER' => 'An Benutzer',
'SEARCH' => 'Benutzer suchen',
'SUBJECT' => 'Betreff',
'TEXT' => 'Text',
'ADDSIG' => 'Signatur anf�gen',
'PREVIEW' => 'Vorschau',
'MSG_NOTEXISTS' => 'Unter diesem Namen existiert kein Benutzeraccount!',
'MSG_SELF' => 'Sie k�nnen sich selbst keine Nachrichten schicken!',
'MSG_OWNFULL' => 'Sie k�nnen derzeit keine Nachrichten verschicken! Ihr Postfach ist voll.',
'MSG_FULL' => 'Die Nachricht konnte nicht verschickt werden! Das Postfach des Empf�gers ist voll.',
'MSG_OK' => 'Die Nachricht wurde verschickt! Sie werden nun weitergeleitet...',
'MSG_IGNORED' => 'Nachricht kann nicht verschickt werden! Der Benutzer ignoriert Sie.',
'MSG_IGNORED_REASON' => 'Nachricht kann nicht verschickt werden! Der Benutzer ignoriert Sie mit dem Grund: {REASON}',
'MAIL_FULL_TITLE' => 'Postfach voll!',
'MAIL_FULL_TEXT' => "Ihr Postfach auf der Website {WEBSITE} ist voll, {USERNAME} wollte Ihnen gerade eine Nachricht zusenden! L�schen Sie alte Nachrichten damit Sie wieder neue empfangen k�nnen!\n\nGru�\nDas Team von {WEBSITE}",
'MAIL_NEWPM_TITLE' => 'Neue Nachricht!',
'MAIL_NEWPM_TEXT' => "Sie haben auf der Website {WEBSITE} soeben eine Nachricht von {USERNAME} erhalten. Klicken Sie hier um zu Ihrem Posteingang zu gelangen: {INBOX}\n\n------\n\nBetreff: {SUBJECT}\n\n{TEXT}\n\n------\n\nGru�\nDas Team von {WEBSITE}",
'SUBMIT' => 'Abschicken'
);


//Neue eMail
$lang['newmail'] = array(
'HEADLINE_NEWMAIL' => 'Neue eMail',
'NAME' => 'Ihr Name',
'EMAIL' => 'Ihre eMail-Adresse',
'RECIEVER' => 'An Benutzer',
'SEARCH' => 'Benutzer suchen',
'SUBJECT' => 'Betreff',
'TEXT' => 'Text',
'CAPTCHA' => 'Visuelle Best�tigung',
'SUBMIT' => 'Abschicken',
'MSG_WRONGCODE' => 'Der angegebene Best�tigungscode ist nicht korrekt!',
'MSG_NOEMAIL' => 'Die angegebene Adresse ist keine g�ltige eMail-Adresse!',
'MSG_IGNORED' => 'eMail kann nicht verschickt werden! Der Benutzer ignoriert Sie.',
'MSG_IGNORED_REASON' => 'eMail kann nicht verschickt werden! Der Benutzer ignoriert Sie mit dem Grund: {REASON}',
'MSG_NOTEXISTS' => 'Unter diesem Namen existiert kein Benutzeraccount!',
'MSG_SELF' => 'Sie k�nnen sich selbst keine eMail schicken!',
'MSG_OK' => 'Die eMail wurde verschickt! Sie werden nun weitergeleitet...'
);


//PN lesen
$lang['readpm'] = array(
'HEADLINE_READPM' => 'Nachricht lesen',
'DELETE' => 'L�schen',
'ANSWER' => 'Antworten',
'IGNORE' => 'Benutzer ignorieren',
);


//PN l�schen
$lang['delpm'] = array(
'MSG_TEXT' => 'Wollen Sie diese Nachricht wirklich l�schen?',
'DELPM' => 'L�schen',
'MSG_OK' => 'Die Nachricht wurde gel�scht! Sie werden nun weitergeleitet...'
);


//Freundesliste
$lang['friends'] = array(
'HEADLINE_FRIENDS' => 'Freundesliste',
'NONE' => 'Keine Freunde'
);


//Ignorier-Liste
$lang['ignorelist'] = array(
'HEADLINE_IGNORELIST' => 'Ignorier-Liste',
'ADDUSER' => 'Benutzer hinzuf�gen',
'USERNAME' => 'Benutzername',
'REASON' => 'Begr�ndung',
'OPTIONAL' => 'optional',
'DELETE' => 'Von der Liste entfernen',
'NONE' => 'Keine Benutzer ignoriert!',
'MSG_TEXT' => 'Wollen Sie diesen Benutzer von der Ignorier-Liste entfernen?',
'MSG_NOMATCH' => 'Es wurde kein Benutzer mit diesem Namen gefunden!',
'MSG_NOTSELF' => 'Sie k�nnen sich selbst nicht auf die Ignorier-Liste setzen!',
'MSG_EXISTS' => 'Dieser Benutzer befindet sich bereits auf der Ignorier-Liste!',
'MSG_ADD_OK' => 'Der Benutzer wurde hinzugef�gt! Sie werden nun weitergeleitet...',
'MSG_DEL_OK' => 'Der Benutzer wurde von der Liste entfernt! Sie werden nun weitergeleitet...'
);


//Buddy hinzuf�gen
$lang['addbuddy'] = array(
'ADDBUDDY' => 'Hinzuf�gen',
'MAIL_NEWPM_TITLE' => 'Neue Kontaktanfrage!',
'MAIL_NEWPM_TEXT' => "Hallo {USERNAME},\nSie haben auf der Website {WEBSITE} soeben eine Kontaktanfrage von {SENDER} erhalten. Klicken Sie hier um zu Ihrem Posteingang zu gelangen: {INBOX}\n\nGru�\nDas Team von {WEBSITE}",
'PM_TITLE' => 'Kontaktanfrage',
'PM_TEXT' => "Hallo {USERNAME},\n{SENDER} m�chte Sie auf {WEBSITE} in seine Freundesliste aufnehmen. Um zu best�tigen [url={URL}]klicken Sie einfach hier[/url]. {SENDER} wird dann auch automatisch in Ihre Freundesliste aufgenommen.",
'MAIL_FINISHED_TITLE' => 'Kontaktanfrage best�tigt',
'MAIL_FINISHED_TEXT' => "Hallo {USERNAME},\n{SENDER} hat Ihre Kontaktanfrage best�tigt und befindet sich nun in Ihrer Freundesliste.",
'MSG_INVALIDKEY' => 'Der Best�tigungscode ist nicht korrekt!',
'MSG_IGNORED' => 'Hinzuf�gen nicht m�glich! Der Benutzer ignoriert Sie.',
'MSG_IGNORED_REASON' => 'Hinzuf�gen nicht m�glich! Der Benutzer ignoriert Sie mit dem Grund: {REASON}',
'MSG_EXISTS' => 'Dieser Benutzer befindet sich bereits auf Ihrer Freundesliste!',
'MSG_NOTEXISTS' => 'Dieser Benutzer existiert nicht!',
'MSG_NOTSELF' => 'Sie k�nnen sich nicht selbst Ihrer Freundesliste hinzuf�gen!',
'MSG_NOTSELFCONFIRM' => 'Sie k�nnen Ihre Freundschaftsanfrage nicht selbst best�tigen!',
'MSG_TEXT' => 'Wollen Sie diesen Benutzer Ihrer Freundesliste hinzuf�gen?',
'MSG_REQ_OK' => 'Die Kontaktanfrage wurde verschickt! Der Benutzer muss die Anfrage nun best�tigen.',
'MSG_OK' => 'Der Freund wurde hinzugef�gt! Sie werden nun weitergeleitet...'
);


//Buddy l�schen
$lang['delbuddy'] = array(
'DELBUDDY' => 'L�schen',
'MSG_TEXT' => 'Wollen Sie diesen Benutzer von Ihrer Freundesliste l�schen?',
'MSG_OK' => 'Der Freund wurde gel�scht! Sie werden nun weitergeleitet...'
);


//Bookmarks
$lang['bookmarks'] = array(
'ADDBOOKMARK' => 'Bookmark erstellen',
'DELBOOKMARK' => 'L�schen',
'TITLE' => 'Bezeichnung',
'MSG_TEXT' => 'Wollen Sie dieses Bookmark wirklich l�schen?',
'MSG_OK_ADD' => 'Das Bookmark wurde erstellt! Sie werden nun weitergeleitet...',
'MSG_OK_DEL' => 'Das Bookmark wurde gel�scht! Sie werden nun weitergeleitet...'
);


//Blog verwalten
$lang['myblog'] = array(
'HEADLINE_MYBLOG' => 'Blog verwalten',
'TITLE' => 'Titel',
'DATE' => 'Ver�ffentlichung',
'TEXT' => 'Text',
'ALLOWCOMS' => 'Kommentare erlauben?',
'NONE' => 'Noch keine Blog-Eintr�ge erstellt!',
'NEWENTRY' => 'Eintrag erstellen',
'EDITENTRY' => 'Eintrag bearbeiten',
'DELBLOGENTRY' => 'Eintrag l�schen',
'PREVIEW' => 'Vorschau',
'MSG_TEXT' => 'Soll dieser Blog-Eintrag wirklich gel�scht werden?',
'MSG_ADD_OK' => 'Der Blog-Eintrag wurde erstellt! Sie werden nun weitergeleitet...',
'MSG_EDIT_OK' => 'Der Blog-Eintrag wurde bearbeitet! Sie werden nun weitergeleitet...',
'MSG_DEL_OK' => 'Der Blog-Eintrag wurde gel�scht! Sie werden nun weitergeleitet...'
);


//Galerie verwalten
$lang['mygallery'] = array(
'HEADLINE_MYGALLERY' => 'Galerien verwalten',
'PICSPACE' => 'Speicher',
'FREE' => 'frei',
'ADDGALLERY' => 'Neue Galerie',
'EDITGALLERY' => 'Galerie bearbeiten',
'DELGALLERY' => 'Galerie l�schen',
'DELPICTURE' => 'Bild l�schen',
'UPLOADIMAGES' => 'Bilder hochladen',
'MAXPICS' => 'Verbleibende',
'TITLE' => 'Titel',
'DESCRIPTION' => 'Beschreibung',
'PASSWORD' => 'Passwort',
'OPTIONAL' => 'optional',
'ALLOWCOMS' => 'Kommentare erlauben?',
'CAPTION' => 'Bildunterschrift',
'PICTURE' => 'Bild',
'PICTURECOUNT' => 'Anzahl Bilder',
'NONE' => 'Noch keine Galerien erstellt!',
'NONE_PICS' => 'Noch keine Bilder hochgeladen!',
'EDITCAPTION' => 'Bildunterschrift bearbeiten',
'UPDATE' => 'Aktualisieren',
'MSG_PICLIMIT' => 'Upload nicht m�glich! Die Kapazit�t der Galerien ({LIMIT} Bilder gesamt) wird �berschritten.',
'MSG_PICLIMITREACHED' => 'Sie haben das Bild-Limit ({LIMIT} Bilder gesamt) erreicht!',
'MSG_DELPICTURE' => 'Soll dieses Bild wirklich gel�scht werden?',
'MSG_DELGALLERY' => 'Soll diese Galerie wirklich gel�scht werden?',
'MSG_ADD_OK' => 'Die Galerie wurde erstellt! Sie werden nun weitergeleitet...',
'MSG_EDIT_OK' => 'Die Galerie wurde bearbeitet! Sie werden nun weitergeleitet...',
'MSG_DEL_OK' => 'Die Galerie wurde gel�scht! Sie werden nun weitergeleitet...',
'MSG_ADDPICS_OK' => 'Die Bilder wurden hochgeladen! Sie werden nun weitergeleitet...',
'MSG_EDITPICS_OK' => 'Die Bildunterschrift wurde bearbeitet! Sie werden nun weitergeleitet...',
'MSG_DELPICS_OK' => 'Das Bild wurde gel�scht! Sie werden nun weitergeleitet...'
);



////////////////////////////////////////////////////////////////////////////////////////// -> FUNKTIONEN

//Online-Anzeige
$lang['func_online'] = array (
'USERONLINE' => 'Besucher online',
'ONLINERECORD' => 'Rekord'
);


//Online-Liste
$lang['func_onlinelist'] = array (
'ONLINELIST' => 'Wer ist online?',
'ONLINELIST_NOBODY' => 'Keine registrierten Benutzer online'
);


//Neue Nachrichten-Anzeige
$lang['func_newpms'] = array (
'NEWPMS' => 'neue Nachrichten'
);


//Neue G�stebucheintr�ge-Anzeige
$lang['func_newgbs'] = array (
'NEWGBS' => 'neue Eintr�ge im G�stebuch'
);


//Login-Box
$lang['func_loginbox'] = array (
);


//Status
$lang['func_status'] = array (
'SET_YOUR_STATUS' => 'Was tust du gerade?',
'SAVE_STATUS' => 'Status speichern'
);


//Geburtstage
$lang['func_birthdays'] = array (
'BIRTHDAYS' => 'Heutige Geburtstage',
'BIRTHDAYS_NOBODY' => 'Heute hat niemand Geburtstag'
);


//Geburtstage
$lang['func_birthdays_tomorrow'] = array (
'BIRTHDAYS_TOMORROW' => 'Morgige Geburtstage',
'BIRTHDAYS_TOMORROW_NOBODY' => 'Morgen hat niemand Geburtstag'
);


//Geburtstage
$lang['func_birthdays_nextdays'] = array (
'BIRTHDAYS_TOMORROW' => 'Geburtstage der n�chsten Tage',
'BIRTHDAYS_TOMORROW_NOBODY' => 'In den n�chsten Tagen hat niemand Geburtstag'
);


//Buddyliste
$lang['func_buddylist'] = array_merge($lang['icons'],array (
'BUDDYLIST' => 'Freunde',
'BUDDYLIST_NONE' => 'Keine Freunde'
));


//Bookmarks
$lang['func_bookmarks'] = array_merge($lang['icons'],array (
'BOOKMARKS' => 'Bookmarks',
'BOOKMARKS_NONE' => 'Keine Bookmarks'
));


//Neue User
$lang['func_newuser'] = array (
'WELCOMENEW' => 'Unsere neuesten Mitglieder'
);


//Statistik
$lang['func_stats'] = array (
'USERS' => 'Benutzer',
'USERS_MALE' => 'm�nnlich',
'USERS_FEMALE' => 'weiblich',
'BLOGS' => 'Blog-Eintr�ge',
'GALLERIES' => 'Galerien',
'PICTURES' => 'Bilder'
);


//Suche
$lang['func_search'] = array (
'SEARCH_USER' => 'Registrierte Benutzer'
);


//Benachrichtigung: Neue PN
$lang['pmpopup'] = array(
'MSG_PMPOPUP' => 'Sie haben neue Nachrichten! Klicken Sie auf OK um ein neues Fenster zu �ffnen.'
);



?>