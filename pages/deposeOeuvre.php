<?php
	require_once("../templates/connexion.php");

	//On créer un objet connexion:
	$c = new Connexion();
	$connexion = $c->getConnexion();
?>

<DOCTYPE! html>
	<html>
		<head>
			<meta charset="UTF-8" />
			<title> Déposer une oeuvre </title>
			<link href="../vue/style.css" rel="stylesheet" type="text/css" />
		</head>

		<body>
			
			<div class="general">
				<?php include("../templates/nav.html"); ?>
				<div class="bloc">
					<h1> POSTEZ VOTRE OEUVRE </h1>
					<p class="textIntro"> Vous voulez poster votre oeuvre? Vous n'avez qu'à remplir ce formulaire. 
						Votre oeuvre sera ou non ensuite validée par le jury. </p>

					<form method="POST" action="../templates/validationDeposeOeuvre.php" enctype="multipart/form-data">	
						<label for="nomOeuvre"> Nom de votre Oeuvre* : </label> <br/>
						<input class="inputText" type="text" name="nomOeuvre" /> <br/>

						<label for="nomArtiste"> Votre nom d'artiste* : </label> <br/>
						<input class="inputText" type="text" name="nomArtiste"/> <br/>
						
						<label for="lieu"> Le lieu de votre Oeuvre* : </label> <br/>
						<select class="liste" name="lieu" size="1">
							<?php
								//On récupère la liste de tous les lieux
								$resultats=$connexion->query('SELECT * FROM `lieu` ORDER by idLieu');
								$resultats->setFetchMode(PDO::FETCH_OBJ);
								while($resultat = $resultats->fetch())
								{
																	
									echo '<option value="'.$resultat->lieu.'"> '. $resultat->lieu. '</option>';	
								}

								$resultats->closeCursor();
							?>

						</select> <br/>
						

						<label for="partenaire"> Votre partenaire* : </label> <br/>
						<input class="inputText" type="text" name="partenaire" /> <br/>
						
						<label for="photoOeuvre"> Envoyez nous une photo de l'oeuvre* : </label><br/>
						<input class="parcourir" type="file" name="photoOeuvre"/><br/>

						<input class="valider" type="submit" value="VALIDER" /> <br/>
					</form>

					<p> (*) Ces champs sont obligatoires </p>

					<?php
						//On affiche le message si c'est bon ou non
						if(isset($_GET['msg'])){
							if($_GET['msg'] == -1){
								echo '<p class="messageErreur"> Un ou plusieurs champs ne sont pas remplis ! </p>';
							}
							else if($_GET['msg'] == 1){
								echo '<p class="messageReussite"> Votre oeuvre à bien été ajouté, elle sera soumise au jury ! </p>';
							}
						}
					?>
				</div>
			</div>


		</body>
	</html>