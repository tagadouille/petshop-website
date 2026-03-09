<?php
    session_start();
    require_once('traitement.php');
    require_once('affichage.php');
    require_once('creation.php');
    require_once('annexe.php');
    function rate($connex,$note){
        $idProduct= $_SESSION['idProd'];
        $idCustomer = $_SESSION['id']; 
        $score= (int) $note;
        notHere($connex, $idCustomer, 'Customer');
        productExist($connex, $idProduct);
        //Verification de si l'utilisateur a déjà mis une note
        $req = "SELECT id FROM Score WHERE idProduct = $idProduct AND idCustomer = $idCustomer;";
        $response = mysqli_query($connex, $req);
        if(mysqli_num_rows($response) == 0){
            $req= "INSERT INTO Score(idProduct, idCustomer, score) VALUES ($idProduct, $idCustomer, $score)";
            $response = mysqli_query($connex, $req);
        }else{
            $req= "UPDATE Score SET score = $score WHERE  idProduct = $idProduct AND idCustomer = $idCustomer;";
            $response = mysqli_query($connex, $req);
        }
    }
    if(isset($_POST['rating'])){
        $note = $_POST['rating'];
    }
    $connex=connection();
    rate($connex,$note);

    header('Location: product.php?id='.$_SESSION['idProd']);
    exit();
?>