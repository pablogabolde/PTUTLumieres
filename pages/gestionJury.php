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
			<title> Gestion des jurys </title>
			<link href="../vue/style.css" rel="stylesheet" type="text/css" />
		</head>
		<body>
			
			<div class="general">
				<?php include("../templates/navAdmin.html"); ?>
				
				<!--Le formulaire pour changer de lieu -->
				<form action="../templates/pageGestionJury.php" method="get">
					

					<table>

						<caption> Gestion des juges </caption>
						<!-- ligne 1 -->
						<tr>
							<th> Login </th>
							<th> Mot de passe </th>
													
						</tr>

						<!-- Pour chaque ligne on récupère dans la base de donnée -->
							<?php
								$resultats=$connexion->query('SELECT * FROM `logs` WHERE jury=1');
								$resultats->setFetchMode(PDO::FETCH_OBJ);
								while($resultat = $resultats->fetch() )
								{						
									echo '<tr> <td> '. $resultat->login. '</td>';
									echo '<td> '. $resultat->mdp. '</td>';
									echo '<td> <a onclick="return(confirm(\'Voulez-vous vraiment supprimer?\'));" 
									href="../templates/pageSuppressionJury.php?login='.$resultat->login.'">
									 Supprimer </a> </td>';
								}

								$resultats->closeCursor();
							?>

							<tr> <td> <input type="text" name="login" /> </td>
								<td> <input type="text" name="mdp" /> </td>
								<td> <input class="valider" type="submit" value="AJOUTER" /> </td> </tr>
						</tr>
					</table>
					<input class="valider" type="submit" value="VALIDER"/>
				</form>
				
				<?php
					if(isset($_GET['msg'])){
						if($_GET['msg'] == 1){
							echo "<p class=\"messageReussite\"> Le juge à bien été ajouté. </p>";
						}
						if($_GET['msg'] == 2){
							echo "<p class=\"messageReussite\"> Le juge à bien été supprimé </p>";
						}
					}

				?>
			</div>
		</body>
	</html>