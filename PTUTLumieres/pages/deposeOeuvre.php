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
						<label for="nomOeuvre"> Nom de votre Oeuvre : </label> <br/>
						<input class="inputText" type="text" name="nomOeuvre" required put-placeholder="test"; /> <br/>

						<label for="nomArtiste"> Votre nom d'artiste : </label> <br/>
						<input class="inputText" type="text" name="nomArtiste" required/> <br/>
						
                        <label for="mail"> Votre e-mail : </label> <br/>
                        <input class="inputText" type="email" name="mail"  required/> <br/>
                        
                        <label for="budget"> Le budget estimé : </label> <br/>
                        <input class="inputText" min="0" type="number" name="budget" required/> <br/>
                        
                        <label for="societeChoix"> Appartenez-vous à une société ? </label> <br/>
                        <input type="radio" name="societeChoix"> Oui </input>
                        <input type="radio" name="societeChoix" checked> Non </input> <br/>
                        
                        <label for="societe"> Le nom de votre société : </label> <br/>
                        <input class="inputText" id="societe" type="text" name="societe" required disabled /> <br/>
                        
                        <label for="superficie"> La superficie estimée : </label> <br/> 
                        <input class="inputText" min="0" type="number" name="superficie" required/> <br/> 
                        
                        <label for="poidsChoix"> Avez-vous le poids de votre oeuvre ? </label> <br/>
                        <input type="radio" name="poidsChoix"> Oui </input>
                        <input type="radio" name="poidsChoix" checked> Non </input> <br/>
        
                        <label for="poids"> Entrez le poids : </label> <br/>
                        <input class="inputText" id="poids" type="number" min="0"  name="poids" required disabled/> <br/>
                    
						<label for="lieu"> Le lieu de votre Oeuvre : </label> <br/>
						<select class="liste" name="lieu" size="1" required>
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
						
						<label for="photoOeuvre"> Envoyez nous une photo de l'oeuvre : </label><br/>
						<input class="parcourir" type="file" accept="image/*" name="photoOeuvre" required/><br/>

						<input class="valider" type="submit" value="VALIDER" /> <br/>
                    </form>

					<?php
						//On affiche le message si c'est bon ou non
						if(isset($_GET['msg'])){
							if($_GET['msg'] == 1){
								echo '<p class="messageReussite"> Votre oeuvre à bien été ajouté, elle sera soumise au jury ! </p>';
							}
						}
					?>
				</div>
			</div>

            <script src="../vue/javascript.js"></script>


		</body>
	</html>