<?php
session_start();
require_once('traitement.php');

if(isset($_SESSION['type'])){
    if($_SESSION['type'] != 'Admin'){
        header('Location: profil.php');
        exit();
    }
}else{
    header('Location: login.php');
    exit();
}
$connex = connection();
    if(!empty($_GET['numProd'])){
        $idpro = $_GET['numProd'];

        if(deleteProd($connex, $idpro)){
            $_SESSION['msg'] = "Supression réussie";
        }else{
            $_SESSION['msg'] = "La supression n'a pas réussie";
        }
    }
header('Location: deathbar.php');
exit();

?>