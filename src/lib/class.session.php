<?php 


global $set;


//API-Version w�hlen
if ( $set['session_api']=='db' ) {
	require(BASEDIR.'lib/class.dbsession.php');
}
else {
	require(BASEDIR.'lib/class.phpsession.php');
}


?>