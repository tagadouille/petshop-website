<?php
	session_start();
	if(!isset($_SESSION['id'])){
		header('Location: login.php');
		exit();
	}
	require_once('annexe.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style2.css">
	<title>Inscription réussie</title>
</head>
<body>
	<?php 
		navbar(-1);
	?>
	<h1>Connexion réussie</h1>
	<?php
		if(isset($_SESSION['name']) && isset($_SESSION['surname']) && isset($_SESSION['pseudo'])){
			$nom = $_SESSION['name'];
			$prenom = $_SESSION['surname'];
			$pseudo = $_SESSION['pseudo'];
			echo "<span>Bonjour $nom $prenom alias $pseudo </span><br>";
		}unset($_SESSION['msg']);
	?>
	<a href="index.php">Revenir à l'acceuil</a>
</body>
</html>