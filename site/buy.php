<?php
	session_start();
	require_once('traitement.php');
	require_once('annexe.php');

	if(isset($_POST['accept'])){
		if($_POST['accept'] == 'ok'){
			$ret = vider(connection());
			buy2(connection(),$ret);
		}
	}else{
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
	<link rel="icon" type="image/png" href="icon.png" />
	<title>Achat réussi</title>
</head>
<body>
	<?php
		navbar(-1);
	?>
	<div class='empty'>
		<h1>Vos articles ont été acheté avec succès</h1>
		<span>Ils arriveront sous peu!</span><br><br>
		<a href='index.php'>Retourner faire vos achats</a>&nbsp;
		<a href='deconnect.php'>Se déconnecter</a>
	</div>
	<?php
		footers();
	?>
</body>
</html>