<?php
	require_once("connexion.php");

	//On créer un objet connexion:
	$c = new Connexion();
	$connexion = $c->getConnexion();

	$idsOeuvre = $_GET['idOeuvre'];
	$lieux = $_GET['lieu'];

	$taille = sizeof($lieux);
	//var_dump($lieux);die();

	if($taille == sizeof($idsOeuvre)){

		for($i = 0; $i < $taille; $i++){
			
			//On cherche s'il y a un apostrophe
			$pos = strpos($lieux[$i], '\'');
			if($pos)
			{
				//On se place à l'apostrophe et on rajoute \
				$lieu = mb_strimwidth($lieux[$i], 0, $pos +1 , "\\"). mb_strimwidth($lieux[$i], $pos, 100 , "\\");
				$resultats=$connexion->exec("UPDATE `oeuvre_validee` SET lieu ='".$lieu."' WHERE idOeuvre='".$idsOeuvre[$i]."'");
			}
			else{
				$resultats=$connexion->exec("UPDATE `oeuvre_validee` SET lieu ='".$lieux[$i]."' WHERE idOeuvre='".$idsOeuvre[$i]."'");
			}
		}

	}

	header("Location: ../pages/admin.php?msg=1");
	
?>