<?php
	require_once("../templates/connexion.php");

	//On créer un objet connexion:
	$c = new Connexion();
	$connexion = $c->getConnexion();

	//Si on veut voir les détails d'une oeuvre en attente
	if(!empty($_GET['idOeuvreAttente'])){
		$idOeuvreAttente = $_GET['idOeuvreAttente'];
	}
	
	//Si on veut voir les détails d'une oeuvre validée
	if(!empty($_GET['idOeuvreValidee'])){
		$idOeuvreValidee = $_GET['idOeuvreValidee'];
	}


	//Si c'est une oeuvre validée
	if(!empty($idOeuvreValidee)){
		$resultats=$connexion->query("SELECT * FROM `oeuvre_validee` WHERE idOeuvre='".$idOeuvreValidee."'");
	}

	//Si c'est une oeuvre en attente
	if(!empty($idOeuvreAttente)){
		$resultats=$connexion->query("SELECT * FROM `oeuvre_attente` WHERE idOeuvre='".$idOeuvreAttente."'");
	}

	

	$resultats->setFetchMode(PDO::FETCH_OBJ);
	$resultat = $resultats->fetch();
	?>
	<DOCTYPE! html>
	<html>
		<head>
			<meta charset="UTF-8" />
			<title> Détail des oeuvres</title>
			<link href="../vue/style.css" rel="stylesheet" type="text/css" />
		</head>
		<body>
			
		<div class="general">
			<div class="divDetail">
				<?php
					echo '<p> Nom de l\'oeuvre : '.$resultat->nomOeuvre.'</p> <br/>';
					echo '<p> Nom de l\'artiste : '.$resultat->nomArtiste.'</p> <br/>';
					echo '<p> Lieu d\'exposition : '.$resultat->lieu.'</p> <br/>';
				?>
			</div>
			<div class="divImageDetail">
				<?php
					echo '<img src="../vue/uploads/'.$resultat->nomPhoto.'" />';
				?>
				<a class="lienRetour" href="admin.php"> Revenir en arrière </a>
			</div>


		</div>
		</body>
	</html>
<?php
	$resultats->closeCursor();
?>
