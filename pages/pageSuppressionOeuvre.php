<?php
	require_once("../templates/connexion.php");

	//On créer un objet connexion:
	$c = new Connexion();
	$connexion = $c->getConnexion();

	$idOeuvre = $_GET['idOeuvre'];

	$resultats=$connexion->exec("DELETE FROM `oeuvre` WHERE idOeuvre='".$idOeuvre."'");
	header("Location: jury.php?msg=1");
	
?>