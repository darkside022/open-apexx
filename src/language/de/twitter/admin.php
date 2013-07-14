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
$lang['modulename']['MODULENAME_TWITTER'] = 'Twitter';


/************** CONFIG **************/
$lang['config'] = array (
'ACCOUNT' => 'Account',
'CONTENT' => 'Inhalte',
'FORMAT' => 'Nachrichtenformat',
'OAUTH_TOKEN' => 'OAuth Token:<br /><a href="'.HTTP_HOST.HTTPDIR.'admin/action.php?action=twitter.connect" target="_blank">Jetzt konfigurieren</a>',
'OAUTH_SECRET' => 'OAuth Secret Token:<br /><a href="'.HTTP_HOST.HTTPDIR.'admin/action.php?action=twitter.connect" target="_blank">Jetzt konfigurieren</a>',
'NEWS' => 'News twittern?',
'ARTICLES' => 'Artikel twittern?',
'DOWNLOADS' => 'Downloads twittern?',
'EVENTS' => 'Termine twittern?',
'GALLERY' => 'Galerien twittern?',
'FORUM' => 'Neue Foren-Themen twittern?',
'GLOSSAR' => 'Glossar-Eintr�ge twittern?',
'LINKS' => 'Links twittern?',
'POLL' => 'Umfragen twittern?',
'VIDEOS' => 'Videos twittern?',
'USER_BLOG' => 'Benutzer-Blogs twittern?',
'USER_GALLERY' => 'Benutzer-Galerien twittern?',
'TPL_NEWS' => 'News, verf�gbare Platzhalter: {TITLE}, {SUBTITLE}, {CATTITLE}, {LINK}, {SECTION}',
'TPL_ARTICLES' => 'Artikel, verf�gbare Platzhalter: {TYPE}, {TITLE}, {SUBTITLE}, {CATTITLE}, {LINK}, {SECTION}',
'TPL_DOWNLOADS' => 'Downloads, verf�gbare Platzhalter: {TITLE}, {CATTITLE}, {LINK}, {SECTION}',
'TPL_EVENTS' => 'Termine, verf�gbare Platzhalter: {TITLE}, {CATTITLE}, {LINK}, {SECTION}',
'TPL_GALLERY' => 'Galerien, verf�gbare Platzhalter: {TITLE}, {LINK}, {SECTION}',
'TPL_FORUM' => 'Forum, verf�gbare Platzhalter: {TITLE}, {LINK}',
'TPL_GLOSSAR' => 'Glossar, verf�gbare Platzhalter: {TITLE}, {CATTITLE}, {LINK}',
'TPL_LINKS' => 'Links, verf�gbare Platzhalter: {TITLE}, {CATTITLE}, {LINK}, {SECTION}',
'TPL_POLL' => 'Umfragen, verf�gbare Platzhalter: {TITLE}, {LINK}, {SECTION}',
'TPL_VIDEOS' => 'Videos, verf�gbare Platzhalter: {TITLE}, {CATTITLE}, {LINK}, {SECTION}',
'TPL_USER_BLOG' => 'Benutzer-Blogs, verf�gbare Platzhalter: {TITLE}, {LINK}',
'TPL_USER_GALLERY' => 'Benutzer-Galerien, verf�gbare Platzhalter: {TITLE}, {LINK}',
);


$lang['actions']['connect'] = array (
'MSG_PHP5ONLY' => 'Das Twitter-Modul funktioniert nur unter PHP5!',
'MSG_DONE' => 'Das Twitter-Modul wurde mit dem Account <strong>{ACCOUNT}</strong> verbunden.'
);

?>