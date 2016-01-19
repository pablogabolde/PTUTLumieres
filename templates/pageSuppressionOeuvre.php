<?php
	require_once("connexion.php");

	//On créer un objet connexion:
	$c = new Connexion();
	$connexion = $c->getConnexion();

	$idOeuvre = $_GET['idOeuvreAttente'];

	$resultats=$connexion->exec("DELETE FROM `oeuvre_attente` WHERE idOeuvre='".$idOeuvre."'");
	header("Location: ../pages/jury.php?msg=-1");
	
?>