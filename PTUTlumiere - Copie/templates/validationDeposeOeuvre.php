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
    
    
    //On insert l'oeuvre à valider dans la base de donnée avec l'idArtiste correspondant
    $resultats=$connexion->prepare("INSERT INTO `oeuvre_attente` (idArtiste, nomOeuvre, nomArtiste, lieu, nomPhoto)
     VALUES (:idArtiste, :nomOeuvre, :nomArtiste, :lieu, :nomPhoto)");
    $resultats->execute(array(
        'idArtiste' => $idArtiste,
        'nomOeuvre' => $nomOeuvre,
        'nomArtiste' => $nomArtiste,
        'lieu' => $lieu,
        'nomPhoto' => $photoNom
        ));

    

    //On redirige vers la page 
    header('Location: ../pages/deposeOeuvre.php?msg=1');
	
?>