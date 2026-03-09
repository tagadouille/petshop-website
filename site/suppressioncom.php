<?php
session_start();
require_once('annexe.php');
$connex = connection();
if(isset($_SESSION['type'])){
    if($_SESSION['type'] == 'Seller'){
        header('Location: index.php');
        exit();
    }
}else{
    header('Location: index.php');
    exit();
}
    if(!empty($_GET['numCom'])){
        $idcom = $_GET['numCom'];
        //Récupérer le lien de l'image du commentaire et la supprimer
        $response = mysqli_query($connex, "SELECT image FROM Comment WHERE id = $idcom;");
        if(mysqli_num_rows($response) == 1){
            $img = mysqli_fetch_assoc($response)['image'];
            if($img != 'NULL') unlink('image-commentaire/'.$img); //Supression
        }
        $req1 = "DELETE FROM Comment WHERE id = $idcom";
        $response1 = mysqli_query($connex, $req1);

        if($response1){
            $_SESSION['msg'] = "Supression réussie";
        }else{
            $_SESSION['msg'] = "La supression n'a pas réussie";
        }
    }header('Location: commentaire.php');
    exit();

?>

