<!DOCTYPE html>
<?php
	
	$bdd = new PDO('mysql:host=localhost;dbname=pcher;charset=utf8', 'root', ''); //connexion base de donnée
	
	if(isset($_POST['inscription'])) { //test du bouton inscription + traitement du bouton
		$login = htmlspecialchars($_POST['login']); //empêche de mettre du code html dans les champs texte
		$email = htmlspecialchars($_POST['email']);
		$mdp1 = sha1($_POST['mdp1']); //hachage du mot de passe en nombre haxadecimal dans la base de donnée pour  la sécurité
		$mdp2 = sha1($_POST['mdp2']);
		
		if(!empty($_POST['login']) && !empty($_POST['mdp1']) && !empty($_POST['mdp2']) && !empty($_POST['email'])) { //vérification des champs complétés
			$login_taille = strlen($login); //récupère la taille de caractère du login
			$existLogin = $bdd->prepare('SELECT * FROM users WHERE login = ?'); //test existance login dans la base de donnée
			$existLogin->execute(array($login));
			
			if($existLogin->rowCount() == 0) { // si login n'est pas encore utilisé
				if($login_taille <= 25) { //test la taille du nom d'utlisateur
					if(preg_match("/(([a-z][0-9])|([0-9][a-z])|[A-Z][0-9]|([0-9][A-Z]))/", $_POST['mdp1'])) { //test 1 mot de passe 
						if($mdp1 == $mdp2) {  //test 2 mot de passe 
							if(filter_var($email, FILTER_VALIDATE_EMAIL)) { //test email
								$existEmail = $bdd->prepare('SELECT * FROM users WHERE email = ?'); //test existance email dans la base de donnée
								$existEmail->execute(array($email)); //exécute requête
								
								if($existEmail->rowCount() == 0) { //email n'est pas encore utilisé
									//paramètres d'encodage + envoi email
									$header = "MIME-Version: 1.0\r\n"; //version encodage du email
									$header.= 'From:"PCHER"<xxx@xxxx.fr>'."\n"; // adresse email expéditeur
									$header.= 'Content-Type:text/html; charset="utf-8"'."\n"; //type d'encodage texte
									$header.= 'Content-Transfer-Encoding: 8bit';
									//message à envoyer : port à changer 80 par défaut pour le lien cliquez içi
									$message =' 
									<html>
										<body>
												Bonjour, <br /><br />
												Nous vous confirmons que vous êtes bien inscrit sur notre site <b>PCHER</b>.
												<br /><br />
												Rappelle de vos informations enregistrées : <br />
												- Nom d\'utilisateur --> '.$_POST['login'].'
												<br />- Mot de passe --> '.$_POST['mdp1'].'
												<br />- Adresse e-mail --> '.$_POST['email'].'<br /><br />
												Pour vous connectez, <a href="http://localhost:82/projet2_PW/PCHER_connexion.php">cliquez içi</a>.
												<br /><br />
												Nous espérons vous revoir bientôt. <br />
												<b>PCHER</b>
										</body>
									</html>
									';
									mail($email,"Confirmation inscription PCHER !", $message, $header); //fonction envoie email
									
									$insertUsers = $bdd->prepare('INSERT INTO users (login, password, email) VALUES(?, ?, ?)'); //insérer membre dans la base de donnée
									$insertUsers->execute(array($login, $mdp1, $email)); //exécute requête
									echo "<script>alert(\"Votre compte a bien été créer. Un e-mail de confirmation vous a bien été envoyer\")</script>";
									$message = "<font color=\"yellow\">Votre compte a bien été créé ! <a href=\"PCHER_connexion.php\">Me connecter</a></font><br /><br />";
								} else
									$message = "<font color=\"yellow\">Erreur : L'adresse e-mail saisie est déjà utilisée !</font><br /><br />";
							} else
								$message = "<font color=\"yellow\">Erreur : Votre adresse e-mail n'est pas valide !</font><br /><br />";
						} else
							$message = "<font color=\"yellow\">Erreur : Vos mots de passe ne correspondent pas !</font><br /><br />";
					} else
						$message = "<font color=\"yellow\">Erreur : Votre mot de passe doit comporter au moins une lettre et un chiffre !</font><br /><br />";
				} else
					$message = "<font color=\"yellow\">Erreur : Votre nom d'utlisateur ne doit pas dépassser 25 caractères !</font><br /><br />";
			} else
				$message = "<font color=\"yellow\">Erreur : Le nom d'utlisateur saisi est déjà utilisé !</font><br /><br />";
		} else 
			$message = "<font color=\"yellow\">Erreur : Tous Les champs doivent être compléter !</font><br /><br />";
	}

?>

<html>
	<head>
		<title>Inscription PCHER</title>
		<link rel="stylesheet" href="style1.css" />
		<meta charset="utf-8">
	</head>
	
	<body>
		<div align="center">
			<h1> Inscription à PCHER</h1> <br /><br />
			
			<form action="" method="post">
				<table align="center">
					<tr>
						<td align="right">
							<label for="login">Nom d'utilisateur &nbsp;&nbsp;:&nbsp;&nbsp;</label>
						</td>
						<td>
							<input type="text" name="login" id="login" placeholder="Votre nom d'utlisateur" value="<?php if(isset($login)) echo $login; ?>" /> <br />	
						<td>
					<tr/>
					<tr>
						<td align="right">
							<label for="mdp1">Mot de passe &nbsp;&nbsp;:&nbsp;&nbsp;</label>
						</td>
						<td>
							<input type="password" name="mdp1" id="mdp1" placeholder="Votre mot de passe" /> <br />
						<td>
					<tr/>
					<tr>
						<td align="right">
							<label for="mdp2">Confirmation du mot de passe &nbsp;&nbsp;:&nbsp;&nbsp;</label>
						</td>
						<td>
							<input type="password" name="mdp2" id="mdp2" placeholder="Confirmer mot de passe" /> <br />
						<td>
					<tr/>
					<tr>
						<td align="right">
							<label for="email">Adresse e-mail &nbsp;&nbsp;:&nbsp;&nbsp;</label>
						</td>
						<td>
							<input type="text" name="email" id="email" placeholder="Votre adresse e-mail" value="<?php if(isset($email)) echo $email; ?>" /> <br />
						<td>
					<tr/>
				</table>
				<input type="submit" name="inscription" value="S'inscrire"/>
			</form>
			<?php
				if(isset($message))
					echo $message;
			?>
		</div>
						
		
	</body>
</html>
