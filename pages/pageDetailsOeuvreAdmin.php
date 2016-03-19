<?php
	require_once("../templates/connexion.php");

	//On créer un objet connexion:
	$c = new Connexion();
	$connexion = $c->getConnexion();

	if(!empty($_GET['idOeuvreAdmin'])){
		$idOeuvreAdmin = $_GET['idOeuvreAdmin'];
	}
	

	if(!empty($idOeuvreAdmin)){
		$resultats=$connexion->query("SELECT * FROM `oeuvre_admin` WHERE idOeuvre='".$idOeuvreAdmin."'");
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
					echo '<p> Budget prévu : '.$resultat->budget.' €</p> <br/>';
					echo '<p> Superficie : '.$resultat->superficie.' m²</p> <br/>';
                    
				?>
			</div>
			<div class="divImageDetail">
				<?php
					echo '<img src="../vue/uploads/'.$resultat->nomPhoto.'" />';
				?>
				<a class="lienRetour" href="adminGestionOeuvre.php"> Revenir en arrière </a>
			</div>


		</div>
		</body>
	</html>
<?php
	$resultats->closeCursor();
?>
