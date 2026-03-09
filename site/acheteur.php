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
    <link rel="icon" type="image/png" href="icon.png" />
    <title>Compte pour Acheteur</title>
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
		adr();
		creat($err,"Customer");
?>
	</form>

</body>
</html>