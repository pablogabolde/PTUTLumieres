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
			<title> Admin </title>
			<link href="../vue/style.css" rel="stylesheet" type="text/css" />
		</head>
		<body>
			
			<div class="general">
				<?php include("../templates/navAdmin.html"); ?>
				
				<!--Le formulaire pour changer de lieu -->
				<form action="../templates/pageGestionLieu.php" method="get">
					

					<table>

						<caption> Gestion des lieux </caption>
						<!-- ligne 1 -->
						<tr>
							<th> Nom de l'oeuvre </th>
							<th> Lieu </th>
							<th> Changer lieu </th>
							<th> Détails </th>
							
						</tr>

						<!-- Pour chaque ligne on récupère dans la base de donnée -->
							<?php
								$resultats=$connexion->query('SELECT idOeuvre, nomOeuvre, lieu FROM `oeuvre_validee` ORDER by idOeuvre');
								$resultats->setFetchMode(PDO::FETCH_OBJ);
								while($resultat = $resultats->fetch() )
								{
																	
									echo '<tr> <td> '. $resultat->nomOeuvre. '</td>';
									echo '<td> '. $resultat->lieu. '</td>';
									echo '<td> <select name="lieu[]">';
							
												$resus=$connexion->query('SELECT * FROM `lieu` ORDER BY idLieu');
												$resus->setFetchMode(PDO::FETCH_OBJ);
												while($res = $resus->fetch())
												{
																					
													if(strcmp($resultat->lieu, $res->lieu) == 0){
														echo '<option value="'.$res->lieu.'" selected> '. $res->lieu. '</option>';
													}else{
														echo '<option value="'.$res->lieu.'"> '. $res->lieu. '</option>';
													}
												}

												$resus->closeCursor();
										

												echo'</select>
											</td>';
									echo '<td> <a href="pageDetailsOeuvreAdmin.php?idOeuvreValidee='.$resultat->idOeuvre.'"> Détails </a> </td> </tr>';
									echo '<input type="hidden" name="idOeuvre[]" value="'.$resultat->idOeuvre.'"/>';			
								}

								$resultats->closeCursor();
							?>
						</tr>
					</table>
					<input class="valider" type="submit" value="VALIDER"/>
				</form>
				<?php
					if(isset($_GET['msg'])){
						if($_GET['msg'] == 1){
							echo "<p class=\"messageReussite\"> Le lieu de ou des oeuvre(s) a bien été changé ! </p>";
						}
					}

				?>

				<form action="../templates/pageGestionLieu2.php" method="get">
					<table>

						<!-- ligne 1 -->
						<tr>
							<th> Lieu </th>												
						</tr>

						<!-- Pour chaque ligne on récupère dans la base de donnée -->
							<?php
								$resultats=$connexion->query('SELECT * FROM `lieu` ORDER BY idLieu');
								$resultats->setFetchMode(PDO::FETCH_OBJ);
								while($resultat = $resultats->fetch() )
								{						
									echo '<tr> <td> '. $resultat->lieu. '</td>';
									echo '<td> <a onclick="return(confirm(\'Voulez-vous vraiment supprimer?\'));" 
									href="../templates/pageSuppressionLieu.php?idLieu='.$resultat->idLieu.'">
									 Supprimer </a> </td>';
								}

								$resultats->closeCursor();
							?>

							<tr> <td> <input type="text" name="lieu" /> </td>
								<td> <input class="valider" type="submit" value="AJOUTER" /> </td> </tr>
						</tr>
					</table>
				</form>

				<?php
					if(isset($_GET['msg'])){
						if($_GET['msg'] == 2){
							echo "<p class=\"messageReussite\"> Le lieu à bien été ajouté. </p>";
						}
						if($_GET['msg'] == -1){
							echo "<p class=\"messageReussite\"> Le lieu à bien été supprimé. </p>";
						}
					}

				?>

				
			</div>
		</body>
	</html>