<!--Cette page permet d'ajouter l'artiste et l'oeuvre à validée à la base de donnée-->
<?php

	require_once("connexion.php");

	//On créer un objet connexion:
	$c = new Connexion();
	$connexion = $c->getConnexion();

	//On récupère les variables du formulaire
	$nomOeuvre = $_POST['nomOeuvre'];
	$nomArtiste = $_POST['nomArtiste'];
    $mailArtiste = $_POST['mail'];
	$lieu = $_POST['lieu'];
    $budget = $_POST['budget'];
    
    if(!empty($_POST['societe'])){
        $societe = $_POST['societe'];
    }
    $superficie = $_POST['superficie'];
    if(!empty($_POST['poids'])){
        $poids = $_POST['poids'];
    }
	
	//On récupère le chemin et le nom de la photo
	$photoChemin = $_FILES['photoOeuvre']['tmp_name'];
	$photoNom = $_FILES['photoOeuvre']['name'];

    //on transfert le fichier photo dans le dossier uploads
    move_uploaded_file($photoChemin, '../vue/uploads/' . basename($photoNom));


    //On insert l'artiste correspondant dans la base de donnée
    $resultat2=$connexion->prepare("INSERT INTO `artiste` (nomArtiste, mailArtiste)
     VALUES (:nomArtiste, :mailArtiste)");
    $resultat2->execute(array(
        'nomArtiste' => $nomArtiste,
        'mailArtiste' => $mailArtiste,
        ));
    

    //On récupère l'id qui vient d'être créé pour l'artiste :
    $idArtiste = 0;
    $resultats=$connexion->query('SELECT idArtiste FROM `artiste`');
    $resultats->setFetchMode(PDO::FETCH_OBJ);
    while($resultat = $resultats->fetch()){
        $id = $resultat->idArtiste;
        if($id>$idArtiste){
            $idArtiste = $id;
        }
    }
    $resultats->closeCursor();
    
    //Si tout est renseigné
    if(!empty($_POST['societe']) && !empty($_POST['poids'])){
        //On insert l'oeuvre à valider dans la base de donnée avec l'idArtiste correspondant
        $resultats=$connexion->prepare("INSERT INTO `oeuvre_attente` (idArtiste, nomOeuvre, nomArtiste, lieu, nomPhoto, budget, société, superficie, poids)
         VALUES (:idArtiste, :nomOeuvre, :nomArtiste, :lieu, :nomPhoto, :budget, :societe, :superficie, :poids)");
        $resultats->execute(array(
            'idArtiste' => $idArtiste,
            'nomOeuvre' => $nomOeuvre,
            'nomArtiste' => $nomArtiste,
            'lieu' => $lieu,
            'nomPhoto' => $photoNom,
            'budget' => $budget,
            'societe' => $societe,
            'superficie' => $superficie,
            'poids' => $poids
            ));
    }

    //Si tout est renseigné sauf la société
    if(empty($_POST['societe']) && !empty($_POST['poids'])){
        //On insert l'oeuvre à valider dans la base de donnée avec l'idArtiste correspondant
        $resultats=$connexion->prepare("INSERT INTO `oeuvre_attente` (idArtiste, nomOeuvre, nomArtiste, lieu, nomPhoto, budget, société, superficie, poids)
         VALUES (:idArtiste, :nomOeuvre, :nomArtiste, :lieu, :nomPhoto, :budget, :societe, :superficie, :poids)");
        $resultats->execute(array(
            'idArtiste' => $idArtiste,
            'nomOeuvre' => $nomOeuvre,
            'nomArtiste' => $nomArtiste,
            'lieu' => $lieu,
            'nomPhoto' => $photoNom,
            'budget' => $budget,
            'societe' => NULL,
            'superficie' => $superficie,
            'poids' => $poids
            ));
    }
    
    //Si tout est renseingé sauf le poids
    if(!empty($_POST['societe']) && empty($_POST['poids'])){
        //On insert l'oeuvre à valider dans la base de donnée avec l'idArtiste correspondant
        $resultats=$connexion->prepare("INSERT INTO `oeuvre_attente` (idArtiste, nomOeuvre, nomArtiste, lieu, nomPhoto, budget, société, superficie, poids)
         VALUES (:idArtiste, :nomOeuvre, :nomArtiste, :lieu, :nomPhoto, :budget, :societe, :superficie, :poids)");
        $resultats->execute(array(
            'idArtiste' => $idArtiste,
            'nomOeuvre' => $nomOeuvre,
            'nomArtiste' => $nomArtiste,
            'lieu' => $lieu,
            'nomPhoto' => $photoNom,
            'budget' => $budget,
            'societe' => $societe,
            'superficie' => $superficie,
            'poids' => NULL
            ));
    }

    //Si tout est renseingé sauf le poids et la societe
    if(empty($_POST['societe']) && empty($_POST['poids'])){
        //On insert l'oeuvre à valider dans la base de donnée avec l'idArtiste correspondant
        $resultats=$connexion->prepare("INSERT INTO `oeuvre_attente` (idArtiste, nomOeuvre, nomArtiste, lieu, nomPhoto, budget, société, superficie, poids)
         VALUES (:idArtiste, :nomOeuvre, :nomArtiste, :lieu, :nomPhoto, :budget, :societe, :superficie, :poids)");
        $resultats->execute(array(
            'idArtiste' => $idArtiste,
            'nomOeuvre' => $nomOeuvre,
            'nomArtiste' => $nomArtiste,
            'lieu' => $lieu,
            'nomPhoto' => $photoNom,
            'budget' => $budget,
            'societe' => NULL,
            'superficie' => $superficie,
            'poids' => NULL
            ));
    }

    

    //On redirige vers la page 
    header('Location: ../pages/deposeOeuvre.php?msg=1');
	
?>