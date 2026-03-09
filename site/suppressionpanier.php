<?php
	session_start();
	require_once('traitement.php');

	if(isset($_SESSION['type'])){
		if($_SESSION['type'] != 'Customer'){
			header('Location: profil.php');
			exit();
		}
	}else{
		header('Location: login.php');
		exit();
	}
	if(!empty($_GET['numProd'])){
		$response = mysqli_query(connection(), "DELETE FROM Basket WHERE id=".$_GET['numProd'].";");
		if($response){
			$_SESSION['msg'] = 'Produit supprimer du panier avec succès';
		}else{
			$_SESSION['msg'] = "Le produit n'a pas réussi à être supprimer";
		}
	}header('Location: panier.php');
	exit();
?>