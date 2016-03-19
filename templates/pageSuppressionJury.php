<?php
	require_once("connexion.php");

	//On créer un objet connexion:
	$c = new Connexion();
	$connexion = $c->getConnexion();

	$login = $_GET['login'];

	$resultats=$connexion->exec("DELETE FROM `logs` WHERE login='".$login."'");
	header("Location: ../pages/gestionJury.php?msg=2");
	
?>