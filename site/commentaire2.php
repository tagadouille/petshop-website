<?php
    session_start();
    require_once('annexe.php');
    require_once('creation.php');
    require_once('traitement.php');
if(isset($_POST['commentaire'])){//Juste le commentaire
    $error2=verifierformcom();
    $_SESSION['error'] = $error2;
}
if(isset($_POST['commentaire']) && isset($_FILES['file2'])){//commentaire + image
    $error2= verifierformcom();
    $fileerror= Imagecom();
    $_SESSION['error'] = $error2;
    $_SESSION['fileerror']= $fileerror;
}if($error2 ==0 && $fileerror ==0){

    $idCustomer = $_SESSION['id']; 
    $idProduct = $_SESSION['idProd']; 
    $text = $_POST['commentaire'];

    if($_FILES['file2']['tmp_name'] ==""){
        $img = 'NULL';
    }else{
        $clé="file2";
        $img = addImage('image-commentaire/', $clé);
        //$img = "";
    }
    $connex = connection();
    insertionComment($connex, $idCustomer, $idProduct, $text, $img);
}
    header("Location: commentaire.php");
    exit();

?>