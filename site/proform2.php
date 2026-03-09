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
    require_once('traitement.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style2.css">
    <link rel="icon" type="image/png" href="icon.png" />
    <title>proform2</title>

</head>
<body>

<?php navbar(1);?>
    <h1 id="cnx_h">Ajoutez un produit</h1>
    <form action="ajoutprod.php" method="post" id ="connx" enctype="multipart/form-data">

<?php 

    if(isset($_SESSION['msg']) && isset($_SESSION['msg2'])){
        $error = $_SESSION['msg'];
        $error2 = $_SESSION['msg2'];
    }else{ 
        $error = 0;
        $error2 = 0;
    }

    if(isset($_POST['animal'])){
        $_SESSION['animal'] = $_POST['animal'];
    }
    productForm($error, $error2, $_SESSION['animal']);
?>

    </form>
<?php
    footers();
?>
</body>
</html>



