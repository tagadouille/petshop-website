<?php
	session_start();
	$_SESSION = array();
	session_destroy();
	require_once('annexe.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style2.css">
	<link rel="icon" type="image/png" href="icon.png" />
	<title>Se déconnecté</title>
</head>
<body>
	<?php  navbar("none"); ?>
	<div class="empty">
		<h1>Vous vous êtes déconnecté</h1>
		<a href="index.php" class='link'>Revenir à l'acceuil</a>
	</div>
	<?php
		footers();
	?>
</body>
</html>