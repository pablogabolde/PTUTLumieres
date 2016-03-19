<DOCTYPE! html>
	<html>
		<head>
			<meta charset="UTF-8" />
			<title> Fête des lumières </title>
			<link href="../vue/style.css" rel="stylesheet" type="text/css" />
		</head>

		<body>
			
			<div class="general">
				<div class="bloc">
                    
                    <?php include("../templates/nav.html"); ?>
					<h1> CONNEXION </h1>

					<form method="POST" action="../templates/verif.php" >	
						<label for="login"> Login : </label> <br/>
						<input class="inputText" type="text" name="login" value="Login..." onFocus="javascript:this.value=''" /> <br/>

						<label for="mdp"> Mot de passe : </label> <br/>
						<input class="inputText" type="password" name="mdp" value= "password" onFocus="javascript:this.value=''" /> <br/>
						<input class="valider" type="submit" value="VALIDER" /> <br/>
					</form>
					<?php
						//On affiche le message si c'est bon ou non
						if(isset($_GET['msg'])){
							if($_GET['msg'] == -1){
								echo '<p class="messageErreur"> Login ou mot de passe incorrect </p>';
							}
						}
					?>
					<a class="lienDeposeOeuvre" href="deposeOeuvre.php"> Si vous voulez déposer une oeuvre, cliquez ici </a>
				</div>
			</div>


		</body>
	</html>