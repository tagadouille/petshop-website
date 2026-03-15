<?php
	session_start();
	require_once('annexe.php');
	require_once('affichage.php');
	require_once('traitement.php');

	if(isset($_SESSION['type'])){
		if($_SESSION['type'] != "Customer"){
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
	<title>Panier</title>
</head>
<body>
	<?php
		navbar(-1);
		$connex = connection();
		if(isset($_SESSION['msg'])){
			echo "<span style='color:red;text-align:center;font-size:26pt;'>".$_SESSION['msg']."</span><br>";
			unset($_SESSION['msg']);
		}
		//Affichage des articles du panier
		panier($connex, $_SESSION['id']);
	?>

</body>
</html>