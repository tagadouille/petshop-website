<?php
	session_start();
	require_once('annexe.php');
	require_once('traitement.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style2.css">
	<link rel="icon" type="image/png" href="icon.png" />
	<title>Profil</title>
</head>
<body id="bprof">
	<?php
		navbar(-1);
	?>
	<?php
		if(isset($_SESSION['id'])){
	?>
	<h1 id='h'>Informations du compte</h1>
	<?php
		if($_SESSION['type'] == 'Customer') $type = "Client";
		else if($_SESSION['type'] == 'Seller') $type = 'Vendeur';
		else $type = 'Administrateur';

		$name = $_SESSION['name'];
		$pseudo = $_SESSION['pseudo'];
		$surname = $_SESSION['surname'];
		$birthdate = dateTransfo($_SESSION['birthdate']);
		$sex = $_SESSION['sex'];
		echo "<div id='info' style='margin-left:30px;'>";
		echo "<span>Type de compte :  $type .</span><br>";
		echo "<span>Nom : $name.</span><br>";
		echo "<span>Prénom :  $surname.</span><br>";
		echo "<span> Pseudo:  $pseudo.</span><br>";
		echo "<span>Date de naissance : $birthdate. </span><br>";
		echo "<span>Sexe :  $sex.</span><br>";
		
		if($_SESSION['type'] != "Admin"){
			$country = $_SESSION['country'];
			$address = $_SESSION['address'];
			echo "<span>Pays : $country.</span><br>";
			echo "<span>Adresse : $address. </span><br>";
		}
		echo "</div><br><br>";
		if($_SESSION['type'] == 'Customer'){
			echo "<a href='panier.php' class='link'>Accéder au panier</a>&nbsp;&nbsp;";
			echo "<a href='historic.php' class='link'>Accéder à l'historique d'achat</a><br>";
		}else if($_SESSION['type'] == 'Seller'){
			echo "<a href='proform1.php' class='link' style = 'margin-left: 20px;'>Ajouter un produit</a>&nbsp;&nbsp;";
			echo "<a href='historiquevente.php' class='link'>Accéder à la liste des produits mis en vente</a><br>";
		}else{
			echo "<a href='deathbar.php' class='link'>Accéder à la Death Bar</a><br><br>";
		}
	?>
	<br>
	<a href="deconnect.php">Se déconnecter</a>
	<?php }else{ ?>
	<div class='empty'>
		<h1 id='h'>Veuillez vous connecter pour pouvoir accéder aux informations et aux fonctionnalités de cette page</h1>
		<a href="login.php" class='link'>Se connecter</a>
	</div>
	<?php }
		footers();
	?>
</body>
</html>