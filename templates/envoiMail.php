<!--Cette page permet d'envoyer des mails aux artistes dont les oeuvrs sont validés-->
<?php

	require_once("connexion.php");

	//On créer un objet connexion:
	$c = new Connexion();
	$connexion = $c->getConnexion();
    
    //on séléctionne tous les numéros artiste dans la table oeuvre_admin
    $resultats=$connexion->query('SELECT idArtiste, nomOeuvre FROM `oeuvre_admin` ORDER BY idOeuvre');
    $resultats->setFetchMode(PDO::FETCH_OBJ);
    while($resultat = $resultats->fetch() )
    {
        $idArtiste = $resultat->idArtiste;
        $nomOeuvre = $resultat->nomOeuvre;
        
        //Pour chaque artiste on récupère son mail
        $resultats2=$connexion->query('SELECT mailArtiste FROM `artiste` WHERE idArtiste ='.$idArtiste);
        $resultats2->setFetchMode(PDO::FETCH_OBJ);
        while($resultat2 = $resultats2->fetch() )
        {
            $mail = $resultat2->mailArtiste;
            //On envoi le même message pour chaque mail
            
            $message = 'Bonjour, votre oeuvre '.$nomOeuvre.' a été selectionnée pour participer à la fête des Lumières.';
            // Dans le cas où nos lignes comportent plus de 70 caractères, nous les coupons en utilisant wordwrap()
            
            $message = wordwrap($message, 70, "\r\n");

            // Envoi du mail
            mail($mail, 'Validation oeuvre fête des lumières', $message);
        }
    }

    //On redirige vers la page 
    header('Location: ../pages/adminGestionOeuvre.php?msg=2');
    
?>