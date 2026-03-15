<?php
	session_start();
	session_destroy();
	require_once('annexe.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style2.css">
	<title>Se déconnecté</title>
</head>
<body>
	<?php  navbar("none"); ?>
	<h1>Vous vous êtes déconnecté</h1>
	<a href="index.php">Revenir en arrière</a>
</body>
</html>