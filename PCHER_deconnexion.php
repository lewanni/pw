<?php
	session_start();
	$_SESSION = array(); //supprime toutes les variables de session
	session_destroy();
	header("Location: PCHER_connexion.php");
?>