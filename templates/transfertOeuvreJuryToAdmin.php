<!--Cette page permet d'ajouter l'artiste et l'oeuvre à validée à la base de donnée-->
<?php

	require_once("connexion.php");

	//On créer un objet connexion:
	$c = new Connexion();
	$connexion = $c->getConnexion();

    //On insert l'artiste correspondant dans la base de donnée
    $resultat2=$connexion->prepare("INSERT INTO `oeuvre_admin` SELECT * FROM `oeuvre_validee`");
    $resultat2->execute();

    //On redirige vers la page 
    header('Location: ../pages/jury.php?msg=3');
	
?>