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

//Security-Check
if ( !defined('APXRUN') ) die('You are not allowed to execute this file directly!');


//Modul registrieren
$module = array(0,8900,
'id' => 'twitter',
'dependence' => array(),
'requirement' => array('main' => '1.2.0'),
'version' => '1.1.2',
'author' => 'Christian Scheb',
'contact' => 'http://www.stylemotion.de',
'mediainput' => array()
);


//Aktionen registrieren     S V O R
$action['connect']    =  array(0,0,1,0);


/*
S = Sonderrechte
V = Sichtbar (Visibility)
O = Anordnung (Order)
R = Rechte f�r Alle
*/


//Template-Funktionen     F           V
//$func['']=array('content_link',true);

/*
F = Funktions-Name
V = Variablen akzeptieren
*/


?>