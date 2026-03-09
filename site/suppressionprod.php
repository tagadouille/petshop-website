<?php
session_start();
require_once('traitement.php');

if(isset($_SESSION['type'])){
    if($_SESSION['type'] == 'Customer'){
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
    }if($_SESSION['type'] == 'Admin') $arg = '?id='.$_GET['idSeller'];
    else $arg='';
    header('Location: historiquevente.php'.$arg);
exit();

?>