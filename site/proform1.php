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
<title>proform</title>
</head>

<body>

<?php navbar(1); 
    echo "<h1 id='cnx_h'>Choisissez la catégorie de votre produit</h1><br>";
    Ajoutprod();
    echo "<br><br><br><br><br><br><br><br>"; 
    footers();

?> 
</body>

</html>

