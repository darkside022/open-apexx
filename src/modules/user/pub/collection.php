<?php

//Produkt-Modul wird ben�tigt
if ( !$apx->is_module('products') ) {
	filenotfound();
	return;
}

//Include von Produkt-Modul
require(BASEDIR.getmodulepath('products').'pub/collection.php');

?>