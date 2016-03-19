<?php
	require_once("../templates/connexion.php");

	//On créer un objet connexion:
	$c = new Connexion();
	$connexion = $c->getConnexion();

	$lieu = $_GET['lieu'];

	$resultats=$connexion->prepare("INSERT INTO `lieu` (lieu)
		 VALUES (:lieu)");

		$resultats->execute(array(
			'lieu' => $lieu,
			));
	header("Location: ../pages/admin.php?msg=2");
	
?>