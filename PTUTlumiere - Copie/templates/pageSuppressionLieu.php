<?php
	require_once("connexion.php");

	//On créer un objet connexion:
	$c = new Connexion();
	$connexion = $c->getConnexion();

	$idLieu = $_GET['idLieu'];

	$resultats=$connexion->exec("DELETE FROM `lieu` WHERE idLieu='".$idLieu."'");
	header("Location: ../pages/admin.php?msg=-1");
	
?>