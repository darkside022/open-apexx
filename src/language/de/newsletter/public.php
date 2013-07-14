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

$lang['mails'] = array(
'MAIL_INSERT_TITLE' => 'Eintragung in den Newsletter',
'MAIL_INSERT_TEXT' => "Ihre eMail-Adresse {EMAIL} wurde auf der Website {WEBSITE} f�r den Newsletter eingetragen. Sie haben folgende Kategorien gew�hlt: {CATEGORIES}. Um die Anmeldung zu best�tigen klicken Sie hier: {URL}. Ansonsten ignorieren Sie diese eMail einfach.\n\nGr��e, das Team von {WEBSITE}",
'MAIL_DISCHARGE_TITLE' => 'Abmeldung vom Newsletter',
'MAIL_DISCHARGE_TEXT' => "Sie m�chten sich auf der Website {WEBSITE} vom Newsletter abmelden. Sie haben folgende Kategorien gew�hlt: {CATEGORIES}. Um die Abmeldung zu best�tigen klicken Sie hier: {URL}. Ansonsten ignorieren Sie diese eMail einfach.\n\nGr��e, das Team von {WEBSITE}"
);


$lang['form'] = array_merge($lang['mails'], array (
'HEADLINE' => 'Newsletter',
'NEWSLETTER' => 'Newsletter-Service',
'GETCODE' => 'Best�tigungs-Code nicht erhalten?',
'EMAIL' => 'eMail-Adresse',
'ACTION' => 'Aktion',
'SIGNIN' => 'Eintragen',
'SIGNOFF' => 'Austragen',
'HTML' => 'HTML-Newsletter',
'CATEGORIES' => 'Kategorien',
'ALL' => 'Alle',
'SUBMIT' => 'Ausf�hren',
'MSG_NOVALIDEMAIL' => 'Das ist keine g�ltige eMail-Adresse!',
'MSG_EXISTS' => 'Sie sind f�r diese Newsletter-Kategorien bereits eingetragen!',
'MSG_INSERT_OK' => 'Vielen Dank f�r Ihre Eintragung in den Newsletter! Sie werden nun weitergeleitet...',
'MSG_INSERT_OK_EMAIL' => 'Zur Best�tigung der Anmeldung wurde Ihnen soeben ein Link per eMail zugeschickt.',
'MSG_NOTFOUND' => 'Diese eMail-Adresse wurde in der Datenbank nicht gefunden!',
'MSG_DISCHARGE_OK' => 'Sie wurden von den ausgew�hlten Newsletter-Kategorien abgemeldet! Sie werden nun weitergeleitet...',
'MSG_DISCHARGE_OK_EMAIL' => 'Zur Best�tigung der Abmeldung wurde Ihnen soeben ein Link per eMail zugeschickt.'
));


$lang['activate'] = array (
'MSG_NOACC' => 'Dieser Account existiert nicht!',
'MSG_WRONGKEY' => 'Der Best�tigungs-Code ist falsch oder veraltet! Sie k�nnen sich einen neuen Best�tigungs-Code zuschicken lassen.',
'MSG_INSERT_OK' => 'Anmeldung f�r den Newsletter best�tigt! Sie werden nun weitergeleitet...',
'MSG_DISCHARGE_OK' => 'Abmeldung vom Newsletter best�tigt! Sie werden nun weitergeleitet...'
);


$lang['getcode'] = array_merge($lang['mails'], array (
'GETCODE' => 'Best�tigungs-Code anfordern',
'SUBMIT' => 'Code anfordern',
'MSG_NOTHING' => 'Derzeit stehen f�r diese eMail-Adresse keine Best�tigungen aus!',
'MSG_OK' => 'Ihr Best�tigungs-Code wurde Ihnen soeben zugeschickt! Sie werden nun weitergeleitet...'
));


$lang['function'] = array (
'FUNC_NEWSLETTER' => 'Newsletter-Service',
'FUNC_NEWSLETTER_HTML' => 'HTML-Newsletter',
'FUNC_NEWSLETTER_INSERT' => 'Eintragen',
'FUNC_NEWSLETTER_DISCHARGE' => 'Austragen',
'FUNC_NEWSLETTER_SUBMIT' => 'Ausf�hren'
);

?>