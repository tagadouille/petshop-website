<?php
	session_start();
	require_once('affichage.php');
	require_once('annexe.php');

	if(isset($_SESSION['type'])){
		if($_SESSION['type'] != 'Admin'){
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
	<link rel="icon" type="image/png" href="icon.png" />
	<title>DeathBar</title>
</head>
<body id='deathbar'>
	<?php
		navbar(-1);
	?>
	<section id="db">
		<h1>The Death Bar</h1>
		<h3>Choisissez qui ou quoi doit disparaître</h3>
		<?php
			if(isset($_SESSION['msg'])){
				echo "<span style='color:red;text-align:center;font-size:26pt;'>".$_SESSION['msg']."</span>";
				unset($_SESSION['msg']);
			}
		?>
		<form method="post" action='deathbar.php'>
	        <input type='text' name='search'>
	        <label>produit</label><input type='radio' name = 'type' value='Product' checked>
	        <label>profil vendeur</label><input type='radio' name = 'type' value='Seller'>&nbsp;
	        <label>profil client</label><input type='radio' name = 'type' value='Customer'>
	        <input type='submit' value='Recherche'>
	    </form>
	<aside>
	    <?php
	    	if(isset($_POST['search']) && isset($_POST['type'])){
	    		deathbar(connection(),$_POST['search'],$_POST['type']);
	    	}
	    ?>
	</aside>
	</section>
</body>
</html>