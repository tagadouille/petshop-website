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
	<title>ChunChunMaru</title>
</head>
<body>
	<?php
		navbar("none");
	?>
	<div class='empty'>
		<h1>Votre compte a été supprimer</h1>
		<p>Nous avons le regret de vous annoncer que votre compte a été supprimer par un administrateur. Nous et vous ne savons pas la raison. Mais lui oui. Vous avez sûrement enfreint nos règles. Nous sommes désolé pour le désagrément mais que cela vous serves de leçon :)</p>
		<a href='index.php'>Revenir à l'acceuil</a>
	</div>
	<?php
		footers();
	?>
</body>
</html>