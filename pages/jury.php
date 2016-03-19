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
			<title> Jury </title>
			<link href="../vue/style.css" rel="stylesheet" type="text/css" />
		</head>
		<body>
			
			<div class="general">
				<?php include("../templates/nav.html"); ?>
				
				<!-- Tableau des oeuvres à valider par le jury -->
				<table>
					<caption> Liste des Oeuvres à Valider</caption>
					<!-- ligne 1 -->
					<tr>
						<th> Nom de l'oeuvre </th>
						<th> Lieu </th>
						<th> Détails </th>
						<th> Ajouter </th>
					</tr>

					<!-- Pour chaque ligne on récupère dans la base de donnée -->
						<?php
							$resultats=$connexion->query('SELECT idOeuvre, nomOeuvre, lieu FROM `oeuvre_attente` ORDER by idOeuvre');
							$resultats->setFetchMode(PDO::FETCH_OBJ);
							while($resultat = $resultats->fetch() )
							{
								
								echo '<tr> <td> '. $resultat->nomOeuvre. '</td>';
								echo '<td> '. $resultat->lieu. '</td>';
					
								echo '<td> <a href="pageDetailsOeuvreJury.php?idOeuvreAttente='.$resultat->idOeuvre.'"> Détails </a> </td>';
								echo '<td> <a onclick="return(confirm(\'Voulez-vous vraiment valider cette oeuvre?\'));"
								 href="pageGestionOeuvre.php?idOeuvreAttente='.$resultat->idOeuvre.'">
								  Ajouter </a> </td>';
								echo '<td> <a onclick="return(confirm(\'Voulez-vous vraiment supprimer cette oeuvre?\'));"
								 href="../templates/pageSuppressionOeuvre.php?idOeuvreAttente='.$resultat->idOeuvre.'">
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
							echo "<p class=\"messageReussite\"> L'oeuvre a bien été validée </p>";
						}
						if($_GET['msg'] == -1){
							echo "<p class=\"messageReussite\"> L'oeuvre a bien été supprimée </p>";
						}
					}
				?>

				<!-- Tableau des oeuvres conseillées au manager -->
				<table>
					<caption> Liste des Oeuvres à conseiller</caption>
					<!-- ligne 1 -->
					<tr>
						<th> Nom de l'oeuvre </th>
						<th> Lieu </th>
						<th> Détails </th>
						<th> Supprimer </th>
					</tr>

					<!-- Pour chaque ligne on récupère dans la base de donnée -->
						<?php
							$resultats=$connexion->query('SELECT idOeuvre, nomOeuvre, lieu FROM `oeuvre_validee` ORDER by idOeuvre');
							$resultats->setFetchMode(PDO::FETCH_OBJ);
							while($resultat = $resultats->fetch() )
							{
								
								echo '<tr> <td> '. $resultat->nomOeuvre. '</td>';
								echo '<td> '. $resultat->lieu. '</td>';
					
								echo '<td> <a href="pageDetailsOeuvreJury.php?idOeuvreValidee='.$resultat->idOeuvre.'"> Détails </a> </td>';
								echo '<td> <a onclick="return(confirm(\'Voulez-vous vraiment supprimer?\'));"
								 href="pageGestionOeuvre.php?idOeuvreValidee='.$resultat->idOeuvre.'">
								  Supprimer </a> </td> </tr>';
							}
							$resultats->closeCursor();
						?>
					</tr>
				</table>
                
<!--                Le bouton pour insérer la table oeuve_validée à oeuvre_admin-->
                <a href="../templates/transfertOeuvreJuryToAdmin.php"> <button> Conseiller l'Admin </button></a>
         

				<?php
					//Message en cas de suppression
					if(isset($_GET['msg'])){
						if($_GET['msg'] == 1){
							echo "<p class=\"messageReussite\"> L'oeuvre a bien été supprimée de la base de données </p>";
						}
                        if($_GET['msg'] == 3){
                            echo "<p class=\"messageReussite\"> Les oeuvres ont bien été conseillées à l'admin </p>";
                        }
					}
                ?>
			</div>
		</body>
	</html>