<?php
	session_start();
	require_once('annexe.php');
	if(isset($_SESSION['id'])){
		header('Location: index.php');
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel= "stylesheet" type = "text/css" href="style2.css">
	<link rel="icon" type="image/png" href="icon.png" />
	<title>ChunChunMaru</title>
</head>
<body>
	<?php 
		navbar(0);
	?>
	<h1 id='cnx_h'>Entrez le code secret</h1>
	<form id='connx' action="administrateur.php" method= 'post'>
		<?php  
			if(isset($_SESSION['mssg'])){
				echo "<span style='color:red;'>".$_SESSION['mssg']."</span><br>";
			}
		?>
		<label>Code secret: </label><input type="text" name="secret" size="20"><br>
		<input type="submit" value="Valider">
	</form>
</body>
</html>