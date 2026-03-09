<?php
	session_start();
	require_once('annexe.php');
	require_once('affichage.php');
	$connex = mysqli_connect('localhost', 'root', '', 'projet');
	if(!$connex){
		header('Location: ERROR.php');
		exit();
	}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="style2.css">
		<link rel="icon" type="image/png" href="icon.png" />
	<title>ChunChunMaru</title>
</head>

<body>
	<?php
		if(isset($_SESSION['id'])){
			navbar(1);
		}else{
			navbar(0);
		}
	?>
	<section id="mainsection">
		<?php
			if(!isset($_GET['type']) || $_GET['type'] != 'Seller'){
		?>
		<form method='post' id='connx'>
			<span>Trié par: </span>
			<input type="radio" name = 'tri' value="sell">
			<label>Ventes</label>&nbsp;
			<input type="radio" name = 'tri' value="score">
			<label>Score</label>&nbsp;
			<input type="radio" name = 'tri' value="date" checked>
			<label>Date</label>&nbsp;

			<input type="radio" name = 'order' value="ASC" checked>
			<label>Croissant</label>&nbsp;
			<input type="radio" name = 'order' value="DESC">
			<label>Décroissant</label>&nbsp;
			<input type="submit" value="Valider">
		</form>
		<?php
			}
			if(!isset($_POST['order'])) $order = 'DESC';
			else $order = $_POST['order'];

			//Affichage selon les catégories des produits
			if(isset($_GET['cat'])){
				if(isset($_GET['sub'])) $sub = urldecode($_GET['sub']);
				else $sub = "none";
				$cat = $_GET['cat'];
				if(isset($_GET['sub'])) echo "<h1>$sub pour $cat</h1>";
				else echo "<h1>Produits pour $cat</h1>";
				if(isset($_POST['tri'])){
					if(isset($_GET['sub'])) display($connex,$_POST['tri'],$_GET['cat'],$_GET['sub'], $order);
					else display($connex,$_POST['tri'],$_GET['cat'],"none", $order);
				}else{
					if(isset($_GET['sub'])) display($connex,"default",$_GET['cat'],$_GET['sub'], $order);
					else display($connex,"default",$_GET['cat'],"none", $order);
				}
			}else if(isset($_GET['search'])){
				if($_GET['type'] == 'Seller' || $_GET['type'] == 'Product'){
					research($connex, $_GET['search'],$_GET['type'],$order);
				}else display($connex,"default","none","none",$order);
			}
			else{
		?>
		
		<h1>Les produits : </h1>
		<?php
			//Affichage sans les catégories
			if(isset($_POST['tri'])){
				display($connex,$_POST['tri'],"none","none",$order);
			}else{
				display($connex,"default","none","none",$order);
			}
		}
		?>
	</section>
	
	<?php
	footers();
	?>

</body>
</html>