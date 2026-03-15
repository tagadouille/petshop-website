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
	if(isset($_GET['numUser']) && isset($_GET['type'])){
		if($_GET['type'] == 'Customer'){
			$connex = connection();
			$id = $_GET['numUser'];
			$response = mysqli_query($connex, "DELETE FROM Score WHERE idCustomer=$id;");
			$response2 = mysqli_query($connex,"DELETE FROM Comment WHERE idCustomer=$id;");
			$response3 = mysqli_query($connex, "DELETE FROM Historic WHERE idCustomer=$id;");
			$response4 = mysqli_query($connex, "DELETE FROM Basket WHERE idCustomer=$id;");
			$response5 = mysqli_query($connex, "DELETE FROM Customer WHERE id=$id;");

			if($response && $response2 && $response3 && $response4 && $response4){
				$_SESSION['msg'] = 'Client supprimé avec succès';
			}else $_SESSION['msg'] = 'Échec lors de la suppression';
		}else{
			$connex = connection();
			$id = $_GET['numUser'];
			//Récupération de l'id du produit
			$response = mysqli_query($connex, "SELECT id FROM Product WHERE idSeller = $id;");
			if($response){
				while($ligne = mysqli_fetch_assoc($response)){
					deleteProd($connex, $ligne['id']);
				}
				$response5 = mysqli_query($connex, "DELETE FROM Seller WHERE id=$id");
				if($response5) $_SESSION['msg'] = 'Vendeur supprimé avec succès';
				else $_SESSION['msg'] = 'Échec lors de la suppression';
			}
		}
	}
	header('Location: deathbar.php');
	exit();

?>