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
		require_once('annexe.php');
		navbar(1);
	?>
	<div class='empty'>
		<h1>Ce produit n'existe pas</h1>
		<p>Nous avons le regret de vous annoncer que ce produit n'existe pas.</p>
		<a href='index.php'>Retourner à l'acceuil</a>
	</div>
	<?php
		footers();
	?>
</body>
</html>