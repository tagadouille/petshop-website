<?php
	session_start();
	require_once('annexe.php');
	require_once('affichage.php');
	require_once('traitement.php');
	if(!isset($_GET['id'])){
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
	<title>Nom de produit</title>
</head>
<body>
	<?php if(isset($_SESSION['id'])) navbar(-1);
	else navbar(0)?>
	<section id="pr">
		<?php
			productDisplay(connection(),$_GET['id']);
		?>
	</section>
</body>
</html>