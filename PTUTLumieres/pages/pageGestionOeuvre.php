<?php
	require_once("../templates/connexion.php");

	//On créer un objet connexion:
	$c = new Connexion();
	$connexion = $c->getConnexion();


	//Si on ajoute une oeuvre
	if(!empty($_GET['idOeuvreAttente'])){
		$idOeuvreAttente = $_GET['idOeuvreAttente'];
	}
	
	//Si on supprime une oeuvre
	if(!empty($_GET['idOeuvreValidee'])){
		$idOeuvreValidee = $_GET['idOeuvreValidee'];
	}

	//Pour supprimer l'oeuvre de la table des oeuvres validées
	if (!empty($idOeuvreValidee)){
		$connexion->exec("DELETE FROM `oeuvre_validee` WHERE idOeuvre='".$idOeuvreValidee."'");
		header("Location: jury.php?msg=1");
		exit();
	}

	//Pour ajouter l'oeuvre non validée dans les validées
	if (!empty($idOeuvreAttente)){
		
		//On récupère tous les attributs de la ligne
		$requete = $connexion->query("SELECT * FROM `oeuvre_attente` WHERE idOeuvre='".$idOeuvreAttente."'");
		$requete->setFetchMode(PDO::FETCH_OBJ);
		$resultat = $requete->fetch();
        
        $idArtiste = $resultat->idArtiste;
		$nomOeuvre = $resultat->nomOeuvre;
		$nomArtiste = $resultat->nomArtiste;
		$lieu = $resultat->lieu;
		$nomPhoto = $resultat->nomPhoto;

		//On les insère dans la table validée
		$resultats=$connexion->prepare("INSERT INTO `oeuvre_validee` (idArtiste, nomOeuvre, nomArtiste, lieu, nomPhoto)
		 VALUES (:idArtiste, :nomOeuvre, :nomArtiste, :lieu, :nomPhoto)");

		$resultats->execute(array(
            'idArtiste' => $idArtiste,
			'nomOeuvre' => $nomOeuvre,
			'nomArtiste' => $nomArtiste,
			'lieu' => $lieu,
			'nomPhoto' => $nomPhoto
			));

		//On les supprime de la table des non validées
		$connexion->exec("DELETE FROM `oeuvre_attente` WHERE idOeuvre='".$idOeuvreAttente."'");
		header("Location: jury.php?msg=2");
		exit();

	}
	
?>