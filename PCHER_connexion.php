<!DOCTYPE html>
<?php
session_start();	
	$bdd = new PDO('mysql:host=localhost;dbname=pcher;charset=utf8', 'root', ''); //connexion base de donnée
	
	if(isset($_POST['inscription_co'])) { //test du bouton inscription + traitement du bouton
		$login = htmlspecialchars($_POST['login_email']); //empêche de mettre du code html dans les champs texte
		$mdp = sha1($_POST['mdp_co']); //hachage du mot de passe en nombre haxadecimal dans la base de donnée pour la sécurité
		
		if(!empty($_POST['login_email']) && !empty($_POST['mdp_co'])) { //vérification des champs complétés
			$existUser1 = $bdd->prepare('SELECT * FROM users WHERE login = ? AND password = ?'); //test existance de l'utilisateur dans la base de donnée
			$existUser1->execute(array($login, $mdp)); //exécute requête 
			$existUser2 = $bdd->prepare('SELECT * FROM users WHERE email = ? AND password = ?'); //test existance de l'email dans la base de donnée
			$existUser2->execute(array($login, $mdp)); //exécute requête
			
			if($existUser1->rowCount() == 1) { //si l'utilisateur existe dans la base de donnée, alors connexion
				$userInfo1 = $existUser1->fetch(); //récupère les entrées de la requête
				$_SESSION['login'] = $userInfo1['login']; // création de session avec les données de l'utilisateur récupérés par la base de donnée
				$_SESSION['email'] = $userInfo1['email'];
				header("Location: contents/PCHER_accueil.php"); //renvoie vers page d'accueil avec les information de l'utilisateur
			} else if($existUser2->rowCount() == 1) { //si l'email existe dans la base de donnée, alors connexion
				$userInfo2 = $existUser2->fetch();
				$_SESSION['login'] = $userInfo2['login']; // création de session avec les données de l'utilisateur récupérés par la base de donnée
				$_SESSION['email'] = $userInfo2['email'];
				header("Location: contents/PCHER_accueil.php");
			} else
				$message = "<font color=\"yellow\">Erreur : Le nom d'utilisateur ou le mot de passe sont incorrects !</font><br /><br />";
		} else
			$message = "<font color=\"yellow\">Erreur : Tous Les champs doivent être compléter !</font><br /><br />";
	
	} 
?>

<html>
	<head>
		<title>Connexion PCHER</title>
		<link rel="stylesheet" href="style1.css" />
		<meta charset="utf-8">
	</head>
	
	<body>
		<div align="center">
			<h1> Connexion à PCHER</h1><br /><br />
			<form action="" method="post">
				<table align="center">
					<tr>
						<td align="right">
							<label for="login">Nom d'utilisateur/Adresse e-mail &nbsp;:&nbsp;&nbsp;</label>
						</td>
						<td>
							<input type="text" name="login_email" placeholder="Votre nom d'utlisateur" value="<?php if(isset($login)) echo $login; ?>" /> <br />
						<td>
					<tr/>
					<tr>
						<td align="right">
							<label for="login">Mot de passe &nbsp;:&nbsp;&nbsp;</label>
						</td>
						<td>
							<input type="password" name="mdp_co"  placeholder="Votre mot de passe" /> <br />
						<td>
					<tr/>
				</table>
					
				<input type="submit" name="inscription_co" value="Se connecter"/>
			</form>
			<font color="yellow">Vous n'avez pas encore de compte ? <a href="PCHER_inscription.php">Inscrivez-vous içi</a></font> <br /><br />
			<?php
				if(isset($message))
					echo $message;
			?>
		</div>
	</body>
</html>