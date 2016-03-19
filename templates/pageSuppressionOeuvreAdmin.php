<?php
	require_once("connexion.php");

	//On créer un objet connexion:
	$c = new Connexion();
	$connexion = $c->getConnexion();

	$idOeuvre = $_GET['idOeuvreAdmin'];

	$resultats=$connexion->exec("DELETE FROM `oeuvre_admin` WHERE idOeuvre='".$idOeuvre."'");
	header("Location: ../pages/adminGestionOeuvre.php?msg=1");
	
?>