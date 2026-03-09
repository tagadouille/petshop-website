<?php
	session_start();
	require_once('annexe.php');
	require_once('traitement.php');

	if(isset($_SESSION['id'])){
		if($_SESSION['type'] != 'Customer' && isset($_POST['idPr'])){
			header('Location: index.php');
			exit();
		}
	}else{
		header('Location: login.php');
		exit();
	}
	$id = $_POST['idPr'];
	if(empty($_POST['qte'])) $_POST['qte'] = 1;
	$r = buy(connection(), $id,$_POST['qte']);
	if(!$r){//Si le produit a été supprimer lors de l'achat
		header('Location: index.php');
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style2.css">
	<link rel="icon" type="image/png" href="icon.png" />
	<title>Produit ajouté au panier avec succès</title>
</head>
<body>
		<?php
			navbar(-1);
			echo "<div class='empty'><h1>Produit ajouter au panier avec succès</h1>
			<a href='product.php?id=$id'>Revenir au produit</a>&nbsp;";
		?>
		<a href="panier.php">Aller au panier</a>&nbsp;
		<a href="index.php">Aller à l'acceuil</a>&nbsp;
	</div>
	<?php
		footers();
	?>
</body>
</html>