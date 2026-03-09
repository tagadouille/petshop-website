<?php
    session_start();
    require_once('annexe.php');
    require_once('creation.php');
    require_once('traitement.php');
    require_once('affichage.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style2.css">
    <link rel="icon" type="image/png" href="icon.png" />
    <title>Historique de vente</title>
</head>
<body>

<?php

$connex=connection();

    navbar(-1);

    if(isset($_GET['id'])){
        if(!isHere($connex,$_GET['id'],'Seller')){
            echo "<h1>Cet utilisateur n'existe pas</h1>";
        }else{
            $id = $_GET['id'];
            $name = mysqli_fetch_assoc(mysqli_query(connection(), "SELECT pseudo FROM Seller WHERE id=$id;"))['pseudo'];
            echo "<h1>Les produits qu'a vendu $name</h1>";
            if(isset($_SESSION['msg'])){
                echo "<span style='color: red; font-size:26pt; text-align:center;'>".$_SESSION['msg']."</span><br>";
                unset($_SESSION['msg']);
            }
            echo "<a class='link' href='index.php'>Retourner à l'acceuil</a>";
            if(isset($_SESSION['type']) && $_SESSION['type'] == 'Admin') echo "&nbsp&nbsp<a href='deathbar.php' class='link'>Retourner à la Death Bar</a>";
            Affichevente($connex, $_GET['id']);
        }
    }else{
        if(isset($_SESSION['id'])){
            echo "<h1>Les produits que vous avez vendu</h1>";
            if(isset($_SESSION['msg'])){
                echo "<span style='color: red; font-size:26pt; text-align:center;'>".$_SESSION['msg']."</span><br>";
                unset($_SESSION['msg']);
            }
            echo "<a class='link' href='profil.php'>Retourner sur votre profil</a>&nbsp;";
            echo "<a class='link' href='#down'>Aller en bas</a>";
             Affichevente($connex, $_SESSION['id']);
        }else{
            header('Location: login.php');
            exit();
        }
    }echo "<div id='down'>";
    footers();
?>

</body>
</html>