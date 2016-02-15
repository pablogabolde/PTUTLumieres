<?php
	require_once("connexion.php");

	//On créer un objet connexion:
	$c = new Connexion();
	$connexion = $c->getConnexion();

	//On récupère les variables du formulaire
	$login = $_POST['login'];
	$mdp = $_POST['mdp'];
	$retour = false;
	

	//on test si un login et un mdp ont été rentrés
	if(!empty($login) && !empty($mdp)){	
		//On recherche dans la base de donnée
		$resultats=$connexion->query("SELECT * FROM `logs`");
		$resultats->setFetchMode(PDO::FETCH_OBJ);

		while($resultat = $resultats->fetch() )
		{
			//Si c'est bon 
			$comparaison1 = strcmp($resultat->login, $login);
			$comparaison2 = strcmp($resultat->mdp, $mdp);

			if (($comparaison1 == 0) && ($comparaison2 == 0)){
				//Si c'est un jury
				if ($resultat->jury == 1){
					header('Location: ../pages/jury.php');
				}
				//si ce n'est pas un admin c'est un gérant
				else{
					header('Location: ../pages/admin.php');		
				}
			}
			else{
				//Ca bug si on met un header
				echo "<script type='text/javascript'>document.location.replace('../pages/index.php?msg=-1');</script>";
			}
		}
		$resultats->closeCursor();
	}
	else{
		
		//On redirige vers la page d'accueil
		header('Location: ../pages/index.php?msg=-1');
		
	}
?>