<?php

	require_once("connexion.php");
    require_once("../annexe//PHPMailer-master/PHPMailerAutoload.php");

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
        //On envoi les informations par mail
        //PHPMailer Object
        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = "smtp-mail.outlook.com";
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Username = "pablog666@hotmail.fr";
        $mail->Password = "pablo69580";
        
        //From email address and name
        $mail->From = "pablog666@hotmail.fr";
        $mail->FromName = "Artiste";

        //To address and name
        $mail->addAddress("pablo69580@gmail.com", "Admin");

        //Address to which recipient will reply
        $mail->addReplyTo("reply@yourdomain.com", "Reply");

        //Send HTML or Plain Text email
        $mail->isHTML(true);

        $mail->Subject = "Subject Text";
        $mail->Body = "<i>Mail body in HTML</i>";
        $mail->AltBody = "This is the plain text version of the email content";

        if(!$mail->send()) 
        {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } 
        else 
        {
            echo "Message has been sent successfully";
        }
        /*$to = "pablo69580@gmail.com";
        $sujet = "Dépos d'une oeuvre";
        $msg = "Monsieur, \n Une oeuvre vient d'être déposée. \n Voici les informations: \n 
        nom de l'oeuvre:".$nomOeuvre." \n nom de l'artiste:".$nomArtiste." \n lieu:".$lieu;
        //mail($to, $sujet, $msg);
        die(mail($to,$sujet,$msg));*/
        
        
		//header('Location: ../pages/deposeOeuvre.php?msg=1');
	}
	else{	
		header('Location: ../pages/deposeOeuvre.php?msg=-1');

	}
	
?>