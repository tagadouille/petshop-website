<?php 
    session_start();
    if(isset($_SESSION['type'])){
        if($_SESSION['type'] != 'Seller'){
            header('Location: profil.php');
            exit();
        }
    }else{
        header('Location: login.php');
        exit();
    }
	require_once('annexe.php');
    require_once('creation.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style2.css">
    <link rel="icon" type="image/png" href="icon.png" />
    <title>Produit ajouté avec succès</title>
</head>
<body>

    <?php navbar(1); ?>
    <div class='empty'>
        <h1>Le produit a été ajouté avec succès</h1>
        <a href='profil.php'>Revenir sur le profil</a>&nbsp;
        <a href='index.php'>Revenir à l'acceuil</a>&nbsp;
        <a href='proform1.php'>Ajouter un autre produit</a>
    </div>
    <?php
        footers();
    ?>
</body>
</html>