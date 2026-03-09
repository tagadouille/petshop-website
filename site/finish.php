<?php
	session_start();
	require_once('traitement.php');
	if(isset($_POST['accounttype'])){
		$res = switcher($_POST['accounttype']);
		if($res != 0){
			if($_POST['accounttype'] == "Admin") $loc = "administrateur.php";
			else if($_POST['accounttype'] == "Seller") $loc = "vendeur.php";
			else $loc = "acheteur.php";
			header('Location: '.$loc);
			exit();
		}
	}else if(!isset($_SESSION['id'])){
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
	<link rel="icon" type="image/png" href="icon.png" />
	<title>ChunChunMaru</title>
</head>
<body>
	<?php
		navbar("none");
		$_SESSION = array();
		session_destroy();
	?>
	<div class='empty'>
		<h1>Compte crée avec succès</h1>
		<a href="login.php">Se connecter</a>
	</div>
	<?php
		footers();
	?>
</body>
</html>