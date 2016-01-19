<?php

	require_once("connexion.php");

	//On créer un objet connexion:
	$c = new Connexion();
	$connexion = $c->getConnexion();

	//On récupère les variables du formulaire
	$nomOeuvre = $_POST['nomOeuvre'];
	$nomArtiste = $_POST['nomArtiste'];
	$lieu = $_POST['lieu'];
	$partenaire = $_POST['partenaire'];
	
	//On récupère le chemin et le nom de la photo
	$photoChemin = $_FILES['photoOeuvre']['tmp_name'];
	$photoNom = $_FILES['photoOeuvre']['name'];

	//On test que tout les champs obligatoires soient la
	if(!empty($nomOeuvre) and !empty($nomArtiste) and !empty($lieu) and !empty($partenaire) and !empty($photoNom)){
		//on transfert le fichier photo dans le dossier uploads
		
		move_uploaded_file($photoChemin, '../vue/uploads/' . basename($photoNom));

		$resultats=$connexion->prepare("INSERT INTO `oeuvre_attente` (nomOeuvre, nomArtiste, lieu, partenaire, nomPhoto)
		 VALUES (:nomOeuvre, :nomArtiste, :lieu, :partenaire, :nomPhoto)");

		$resultats->execute(array(
			'nomOeuvre' => $nomOeuvre,
			'nomArtiste' => $nomArtiste,
			'lieu' => $lieu,
			'partenaire' => $partenaire,
			'nomPhoto' => $photoNom
			));
		header('Location: ../pages/deposeOeuvre.php?msg=1');
	}
	else{	
		header('Location: ../pages/deposeOeuvre.php?msg=-1');

	}
	
?>