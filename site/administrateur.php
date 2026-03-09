<?php
	session_start();
	require_once('annexe.php');
	require_once('creation.php');
	if(isset($_SESSION['id'])){
		header('Location: profil.php');
		exit();
	}
	if(!isset($_POST['secret'])){
		header('Location: index.php');
		exit();
	}
	if(!password_verify($_POST['secret'], "$2y$10$bFFJ5c9uq/KMZe0ZEQRQROULCIoPRuPSa0NVzrP3ocD3tnTeIWXP")){
		$_SESSION['mssg'] = "Le code secret est incorrect";
		header('Location: verify.php');
		exit();
	}unset($_SESSION['mssg']);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style2.css">
	<link rel="icon" type="image/png" href="icon.png" />
        <title>Compte pour Administrateur</title>
</head>
<body>
    
<?php
        navbar("none");
?>
	<form id="connx" method = "post" action='finish.php'>
<?php
	if(isset($_SESSION['msgg'])){
		$err = $_SESSION['msgg'];
	}else{
		$err = 0;
	}
		creat($err,"Admin");
?>
	</form>
</body>
</html>