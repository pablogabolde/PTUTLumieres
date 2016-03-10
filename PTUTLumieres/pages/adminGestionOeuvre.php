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
				
				<!-- Tableau des oeuvres à valider par l'admin-->
				<table>
					<caption> Liste des Oeuvres à Valider</caption>
					<!-- ligne 1 -->
					<tr>
						<th> Nom de l'oeuvre </th>
						<th> Lieu </th>
						<th> Détails </th>
						<th> Action </th>
					</tr>

					<!-- Pour chaque ligne on récupère dans la base de donnée -->
						<?php
							$resultats=$connexion->query('SELECT idOeuvre, nomOeuvre, lieu FROM `oeuvre_admin` ORDER by idOeuvre');
							$resultats->setFetchMode(PDO::FETCH_OBJ);
							while($resultat = $resultats->fetch() )
							{
								
								echo '<tr> <td> '. $resultat->nomOeuvre. '</td>';
								echo '<td> '. $resultat->lieu. '</td>';
					
								echo '<td> <a href="pageDetailsOeuvreAdmin.php?idOeuvreAdmin='.$resultat->idOeuvre.'"> Détails </a> </td>';
								echo '<td> <a onclick="return(confirm(\'Voulez-vous vraiment supprimer cette oeuvre?\'));"
								 href="../templates/pageSuppressionOeuvreAdmin.php?idOeuvreAdmin='.$resultat->idOeuvre.'">
								  Supprimer </a> </td> </tr>';
							}
							$resultats->closeCursor();
						?>
					</tr>
				</table>

				<?php
					//Message en cas d'ajout dans la table validée
					if(isset($_GET['msg'])){
						if($_GET['msg'] == 2){
							echo "<p class=\"messageReussite\"> Les mails ont bien été envoyés </p>";
						}
					}
				?>
                
                <a href="../templates/envoiMail.php"> <button> Envoi des mails </button> </a>
         

				<?php
					//Message en cas de suppression
					if(isset($_GET['msg'])){
						if($_GET['msg'] == 1){
							echo "<p class=\"messageReussite\"> L'oeuvre a bien été supprimée de la base de données </p>";
						}
					}
				?>
			</div>
		</body>
	</html>