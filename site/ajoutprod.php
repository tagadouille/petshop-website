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
    require_once('creation.php');
    require_once('traitement.php');
    if(isset($_POST['file'])){
        $_SESSION['file'] = $_POST['file'];
    }else{
        $_SESSION['file'] = finish3img();
    }
    $msg = finish3();
    $msg2 = finish3img();
    if($msg != 0 || $msg2 != 0){
        $_SESSION['msg'] = $msg;
        $_SESSION['msg2'] = $msg2;
        header('Location: proform2.php');
        exit();
    }
    unset($_SESSION['msg']);
    //Faire l'insertion des données et l'enregistrement de l'image.
    $img = addImage("produit-image/",'file');
    insertionProd(connection(),$_SESSION['animal'], $img);
    header('Location: finish3.php');
    exit();
?>