<?php
	require_once("../templates/connexion.php");

	//On créer un objet connexion:
	$c = new Connexion();
	$connexion = $c->getConnexion();

	$login = $_GET['login'];
	$mdp = $_GET['mdp'];

	$resultats=$connexion->prepare("INSERT INTO `logs` (login, mdp, jury)
		 VALUES (:login, :mdp, :jury)");

		$resultats->execute(array(
			'login' => $login,
			'mdp' => $mdp,
			'jury' => 1
			));
	header("Location: ../pages/gestionJury.php?msg=1");
	
?>