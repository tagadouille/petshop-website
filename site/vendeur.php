<?php
	session_start();
	require_once('annexe.php');
	require_once('creation.php');
	if(isset($_SESSION['id'])){
		header('Location: profil.php');
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style2.css">
    <title>Compte pour Vendeur</title>
</head>
<body>

<?php
        navbar("none");
?>
	<form id="connx" method = "post" action='finish.php'>
<?php
	if(isset($_SESSION['msg'])){
		$err = $_SESSION['msg'];
	}else{
		$err = 0;
	}
		adr();
		creat($err,"Seller");
?>
	</form>
    
</body>
</html>