<?php 

/***************************************************************\
|                                                               |
|                   apexx CMS & Portalsystem                    |
|                 ============================                  |
|           (c) Copyright 2005-2007, Christian Scheb            |
|                  http://www.stylemotion.de                    |
|                                                               |
|---------------------------------------------------------------|
| THIS SOFTWARE IS NOT FREE! MAKE SURE YOU OWN A VALID LICENSE! |
| DO NOT REMOVE ANY COPYRIGHTS WITHOUT PERMISSION!              |
| SOFTWARE BELONGS TO ITS AUTHORS!                              |
\***************************************************************/


//Security-Check
if ( !defined('APXRUN') ) die('You are not allowed to execute this file directly!');


// MYSQL ///////////////////////////////////////////////////////////////////////////////////

// Mysql-API, zur Auswahl stehen "mysql" und "mysqli"
// In der Regel gen�gt "mysql", "mysqli" sollten Sie probieren, wenn Sie PHP5 oder PHP4.1+ verwenden
$set['mysql_api'] = 'mysql';

// IP oder Adresse des MySQL-Servers
$set['mysql_server'] = 'localhost';

// Benutzername f�r MySQL-Login
$set['mysql_user'] = 'root';

// Passwort f�r MySQL-Login
$set['mysql_pwd'] = '';

// Name der Datenbank
$set['mysql_db'] = '';

// Vorangestellte Tabellenbezeichnung
$set['mysql_pre'] = 'apx';

// Wird UTF8 als Zeichencodierung in der Datenbank verwenden?
// (Standardm��ig auf false lassen, au�er Sie wissen was Sie tun)
$set['mysql_utf8'] = false;



// MYSQL FORUM /////////////////////////////////////////////////////////////////////////////

// IP oder Adresse des MySQL-Servers
$set['forum_server'] = 'localhost';

// Benutzername f�r MySQL-Login
$set['forum_user'] = '';

// Passwort f�r MySQL-Login
$set['forum_pwd'] = '';

// Name der Datenbank
$set['forum_db'] = 'vb';

// Vorangestellte Tabellenbezeichnung
$set['forum_pre'] = '';

// URL zum Forum
$set['forum_url'] = 'http://www.domain.tld/forum/';

//Automatisch angemeldet sein, wenn im Forum angemeldet
$set['forum_autologin'] = true;

//Invalide Login-Daten ignorieren und nicht-angemeldet sein
$set['forum_invalidlogin_ignore'] = true;

//IP-Check ohne die letzten X Teile
$set['forum_ipcheck'] = 1;

//Cookie-Domain
$set['forum_cookie_domain'] = null;

//Cookie-Pfad
$set['forum_cookie_path'] = '/';

//Cookie-Salt (aus includes/functions.php �bernehmen)
$set['forum_cookie_salt'] = '55918f82';

//Cookie-Namen
$set['forum_cookiename_userid'] = 'bbuserid';
$set['forum_cookiename_password'] = 'bbpassword';
$set['forum_cookiename_session'] = 'bbsessionhash';



// SESSION ///////////////////////////////////////////////////////////////////////////////////

// Session-Management
// Standardm��ig werden die Sessions von PHP verwaltet ("php"), sollte dies nicht problemlos
// funktionieren, versuchen sie es mit der Einstellung "db"
$set['session_api'] = 'php';



// DEBUG ///////////////////////////////////////////////////////////////////////////////////

// Kritische Fehlermeldungen anzeigen (true/false)
$set['showerror'] = true;

// Fehler-Report am Ende zeigen (true/false)
$set['errorreport'] = false;

// Cache immer ausgeben (true/false)
$set['outputcache'] = false;

// Renderzeit anzeigen (true/false)
$set['rendertime'] = false;

// Anfang und Ende der Templates anzeigen
// 0 = aus
// 1 = durch HTML-Kommentare
// 2 = sichtbare Rahmen
$set['tmplwhois'] = 0;

?>