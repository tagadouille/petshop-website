<?php   
    session_start();
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
    <title>Commentaire</title>
</head>
<body>

<?php navbar(-1);


$idProduct = $_SESSION['idProd']; 
$connex = connection();

    if(isbuy(connection(), $idProduct)) {
        if(isset($_SESSION['error']) && isset($_SESSION['fileerror'])) formcomment($_SESSION['error'], $_SESSION['fileerror']);
        else if(isset($_SESSION['error'])) formcomment($_SESSION['error'],0);
        else formcomment(0,0);
    }afficherCommentaires($connex, $idProduct);
?>
    
</body>
</html>