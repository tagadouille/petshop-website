<?php
	session_start();
	require_once('annexe.php');
	require_once('traitement.php');
	if(isset($_SESSION['id'])){
		header('Location: profil.php');
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style2.css">
	<title>Connexion</title>
</head>
<body>
	<?php
		navbar("none");
	?>
	<h1 id="cnx_h">Connexion</h1>
	<br>
	<?php function login($err){ ?>
		<form id=connx method="post">
			<span>Sélectionnez votre type de compte</span>
				<input type="radio" id="Admin" name="type" value="Admin" checked>
		        <label for="Admin">Administrateur</label>

		        <input type="radio" id="Vendeur" name="type" value="Seller">
		        <label for="Vendeur">Vendeur</label>

		        <input type="radio" id="Acheteur" name="type" value="Customer">
		        <label for="Acheteur">Client</label><br><br>
		    <?php 
		    	if($err == 1){
		    		echo "<span style='color:red;'>L'identifiant ou le mot de passe sont incorrects</span><br>";
		    	}
		     ?>
			<label for="pseudo">Entrez votre identifiant : </label><input type="text" name="pseudo" placeholder="Entrez votre pseudo"><br><br>
			<label for="psw">Entrez votre mot de passe : </label><input type="password" name="psw" size = "20" placeholder="Entrez votre mot de passe">
			<br><br>

			<input type="submit" value="Envoyer">&nbsp;
			<input type="reset" value="Renitialiser"><br>

			<a href="index.php">Revenir en arrière</a>&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="create.php">Vous n'avez pas de compte?</a>
		</form>
		
	<?php
		}
		if(isset($_SESSION['msg'])){
			$err = $_SESSION['msg'];
		}else{
			$err = 0;
		}
		login($err);
		
		if(isset($_POST['type'])){
			 $connex = mysqli_connect('localhost', 'root', '', 'projet');
			 if(!$connex){
				header('Location: ERROR.php');
				exit();
			}
			 mysqli_set_charset($connex, 'utf8');
			 $result = connect($connex, $_POST['type']);
			 if($result == 0){
			 	header('Location: finish2.php');
			 	exit();
			 }else{
			 	$_SESSION['msg'] = $result;
			 	header('Location: login.php');
			 	exit();
			 }
	    }
	?>

</body>
</html>