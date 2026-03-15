<?php
	session_start();
	require_once('affichage.php');
	require_once('annexe.php');
	require_once('traitement.php');

	if(isset($_SESSION['type'])){
		if($_SESSION['type'] != 'Customer'){
			header('Location: profil.php');
			exit();
		}
	}else{
		header('Location: login.php');
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style2.css">
	<title>Historique d'achat</title>
</head>
<body>
	<?php
		navbar(-1);
		historic(connection(),$_SESSION['id']);
	?>
</body>
</html>