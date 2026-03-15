<?php
	require_once('traitement.php');
	//Fonctions qui trouve l'id d'une catégorie
	function findCat($connex,$category){
		$req = "SELECT id FROM Category WHERE name = '$category';";
		$response = mysqli_query($connex, $req);
		if($response){
			if(mysqli_num_rows($response) == 0) return FALSE;
			return mysqli_fetch_assoc($response)['id'];
		}else{
			return FALSE;
		}
	}
	//Fonction qui trouve l'id d'une sous-catégorie
	function findSubcat($connex, $subcategory,$idCat){
		$req = "SELECT id FROM Subcategory WHERE name = '$subcategory' AND idCat = $idCat;";
		$response = mysqli_query($connex, $req);
		if($response){
			if(mysqli_num_rows($response) == 0) return FALSE;
			return mysqli_fetch_assoc($response)['id'];
		}else{
			return FALSE;
		}
	}
	//Fonction qui affiche les éléments sur la page d'acceuil
	function display($connex,$param,$category,$subcategory,$order){
		if($category == "none" && $subcategory == "none"){
			if($param == 'default'){
				$req = "SELECT * FROM Product;";
			}if($param == 'sell'){
				$req = "SELECT P.id as id,name,image,price FROM Product P ORDER BY sellnumber $order;";
			}if($param == 'score'){
				$req = "SELECT P.id as id,name,image,price,AVG(S.score) as score FROM Product P, Score S WHERE P.id = S.idProduct GROUP BY P.id ORDER BY score $order;";
			}if($param == 'date'){
				$req = "SELECT P.id as id,name,image,price FROM Product P ORDER BY P.id $order;";
			}
		}else{
			$cat = findCat($connex,$category);
			if(!$cat){
				echo "<h2 style= 'margin-top: 200px;'>Catégorie inexistante</h2>";
				return 1;
			}
			$subcat = findSubcat($connex,$subcategory,$cat);
			if(!$subcat){
				echo "<h2 style= 'margin-top: 200px;'>Catégorie inexistante</h2>";
				return 1;
			}
			if($param == 'default'){
				$req = "SELECT P.id as id,name,image,price FROM Product P WHERE P.category = $cat AND P.subcategory = $subcat;";
			}if($param == 'sell'){
				$req = "SELECT P.id as id,name,image,price FROM Product P WHERE P.category = $cat AND P.subcategory = $subcat ORDER BY sellnumber $order;";
			}if($param == 'score'){
				$req = "SELECT P.id as id,name,image,price,AVG(S.score) as score FROM Product P, Score S WHERE P.id = S.idProduct AND P.category = $cat AND P.subcategory = $subcat GROUP BY P.id ORDER BY score $order;";
			}if($param = 'date'){
				$req = "SELECT P.id as id,name,image,price FROM Product P WHERE P.category = $cat AND P.subcategory = $subcat ORDER BY P.id $order;";
			}
		}

		$response = mysqli_query($connex, $req);
		if($response){
			if(mysqli_num_rows($response) == 0){
				echo "<h2 style= 'margin-top: 200px;'>Aucun article existe encore</h2>";
			}
			while($ligne = mysqli_fetch_assoc($response)){
				$id = $ligne['id'];
				$name = htmlspecialchars($ligne['name']);
				$price = $ligne['price'].'€';
				if($param == 'score') $score = round($ligne['score'],2).'/5';
				else{
					$score = calculScore($connex,$id);
					if($score == 0) $score = 'N/A';
					else $score.='/5';
				} 
				$image = 'produit-image/'.$ligne['image'];

				echo "<div class='article'>";
				echo "<a href='product.php?id=$id' id = 'noblue'>";
				echo "<img src=$image style= 'max-width: 200px; max-height: 200px'>";
				echo "<div id='titre'><h3>$name</h3></div>";
				echo "<h4>$price</h4>";
				echo "<span>Note: $score</span>";
				echo "</a>";
			    echo "</div>";
			}
		}else{
			echo "<h1>Erreur</h1>";
		}
	}
	//Fonction qui affiche les résultats de la recherche
	function research($connex, $search,$type){
    	if($search == ''){
    		display($connex,'default',"none","none","DESC");
    	}else{
    		$research = '%'.mysqli_real_escape_string($connex,$search).'%';
    		if($type == 'Product') $req = "SELECT * FROM $type WHERE name LIKE '$research';";
    		else $req = "SELECT * FROM $type WHERE pseudo LIKE '$research';";

    		$response = mysqli_query($connex, $req);
    		if($response){
				if(mysqli_num_rows($response) == 0 && $type == 'Product'){
					echo "<h2 style= 'margin-top: 200px;'>Aucun article de ce nom existe encore</h2>";
				}if(mysqli_num_rows($response) == 0 && $type != 'Product'){
					echo "<h2 style= 'margin-top: 200px;'>Aucun profil de ce nom existe encore</h2>";
				}if($type == 'Product'){

					while($ligne = mysqli_fetch_assoc($response)){
						$id = $ligne['id'];
						$name = htmlspecialchars($ligne['name']);
						$price = $ligne['price'].'€';
						$score = calculScore($connex,$id).'/5';
						$image = 'produit-image/'.$ligne['image'];
						echo "<div class='article'>";
						echo "<a href='product.php?id=$id' id = 'noblue'>";
						echo "<img src=$image style= 'max-width: 200px; max-height: 200px'>";
						echo "<div id='titre'><h3>$name</h3></div>";
						echo "<h4>$price</h4>";
						echo "<span>Note: $score</span>";
						echo "</a>";
					    echo "</div>";
					}
				}else{
					echo "<h1>Les profils vendeurs: </h1>";
					while($ligne = mysqli_fetch_assoc($response)){
						$id = $ligne['id'];
						$name = htmlspecialchars($ligne['pseudo']);
						echo "<div class='panier'>";
						echo "<a href='historiquevente.php?id=$id' id = 'noblue'>";
						echo "<span>$name</span>";
						echo "</a>";
					    echo "</div>";
					}
				}
			}else{
				echo "<h1>Erreur</h1>";
			}
	    }
    }
    //Fonction de recherche de la deathbar
function deathbar($connex, $search,$type){
    	$research = '%'.mysqli_real_escape_string($connex,$search).'%';
   		if($type == 'Product') $req = "SELECT * FROM $type WHERE name LIKE '$research';";
   		else $req = "SELECT * FROM $type WHERE pseudo LIKE '$research';";

   		$response = mysqli_query($connex, $req);
   		if($response){
			if(mysqli_num_rows($response) == 0 && $type == 'Product'){
				echo "<h2>Aucun article de ce nom existe encore</h2>";
				return;
			}if(mysqli_num_rows($response) == 0 && $type != 'Product'){
				echo "<h2>Aucun profil de ce nom existe encore</h2>";
				return;
			}if($type == 'Product'){
				echo "<h2 class='t'>Les produits: </h2>";
				while($ligne = mysqli_fetch_assoc($response)){
					$id = $ligne['id'];
					$name = htmlspecialchars($ligne['name']);
					$image = 'produit-image/'.$ligne['image'];

					echo "<div class='panier'>";
					echo "<a href='product.php?id=$id' id = 'noblue'>";
					echo "<img src=$image>";
					echo "<span>$name</span>";
					echo "</a>";
					echo "<abbr title='supprimer le produit'><a href='suppressionprod2.php?numProd=".$ligne['id']."' style='float: right;'><img src='supr.png' alt='Supprimer'></a></abbr>";
				    echo "</div>";
				}
			}else{	
				if($type == 'Seller') echo "<h2 class='t'>Les profils vendeurs: </h2>";
				if($type == 'Customer') echo "<h2 class='t'>Les profils clients: </h2>";
				while($ligne = mysqli_fetch_assoc($response)){
					$id = $ligne['id'];
					$name = htmlspecialchars($ligne['pseudo']);

					echo "<div class='panier'>";
					if($type === 'Seller'){ 
						echo "<a href='historiquevente.php?id=$id' id = 'noblue'>";
						echo "<span>$name</span>";
						echo "</a>";
					}if($type == 'Customer') echo "<span>$name</span>";
					echo "<abbr title='le supprimer'><a href='suppressionuser.php?numUser=".$ligne['id']."&type=$type"."' style='float: right;'><img src='supr.png' alt='Supprimer'></a></abbr>";
					echo "</div>";
				}
			}
		}else{
			echo "<h1>Erreur</h1>";
		}
	}

	//Fonction qui affiche les catégories sous forme de lien
	function category($connex, $category){
		$req = "SELECT s.name FROM Subcategory s, Category c WHERE s.idCat = c.id AND c.name = '$category'";
		$response = mysqli_query($connex, $req);
		if($response){
			//$ligne = mysqli_fetch_assoc($response);
			while ($ligne = mysqli_fetch_assoc($response)){
				$name = urlencode($ligne['name']);
				$name2 = $ligne['name'];
				echo "<a href='index.php?cat=$category&sub=$name'>$name2</a>";
			}
		}
	}

	//Fonction qui supprime un élément d'une table selon son id
	function supression($connex,$table,$id){
		$req=  "DELETE FROM $table WHERE id = $id;";
		$response = mysqli_query($connex, $req);
		if($response){
			echo "supression réussie";
		}else{

		}
	}
	//Fonction qui calcule la note d'un produit
	function calculScore($connex, $id){
		$req = "SELECT AVG(score) as score FROM Score WHERE idProduct = $id;";
		$response = mysqli_query($connex,$req);
		if($response){
			if(mysqli_num_rows($response) == 0) return 0;
			return round(mysqli_fetch_assoc($response)['score'], 2);
		}else{
			header('ERROR.php');
			exit();
		}
	}
	//Fonction qui affiche toutes les informations d'un produit dans la page product
	function productDisplay($connex, $id){
		productExist($connex, $_GET['id']);
		$req = "SELECT P.name,description,price,image,S.pseudo as pseudo,S.id,P.date FROM Product P, Seller S WHERE P.id = $id AND idSeller = S.id;";
		$response = mysqli_query($connex, $req);
		if($response){
			$ligne = mysqli_fetch_assoc($response);
			$img = 'produit-image/'.$ligne['image'];
			$description = htmlentities($ligne['description']);
			$name = htmlspecialchars($ligne['name']);
			$date = datetransfo($ligne['date']);
			$note = calculScore($connex, $id).'/5';
			$pseudo = htmlspecialchars(($ligne["pseudo"]));
			$price = $ligne['price'].'€';
			$idP = $_GET['id'];
			$_SESSION['idProd'] = $_GET['id'];

			echo "<div id='product'>";
			echo "<h1 class='product'>$name</h1>";
			echo "<span id='seller'>Vendu par $pseudo</span>&nbsp;";
			echo "<span class='product'>le $date</span><br>";
			echo "<img src=$img class='product' style= 'max-width: 400px; max-height: 400px'><br>";
			echo "<h2>Prix : $price</h2>";
			echo "<a href='commentaire.php' class='product'>Commentaires</a><h4 class='product'>Note : $note</h4>";
			if(isbuy(connection(), $_GET['id'])) formRate();
			echo "<h3 class='product'>Description</h4>";
			echo "<div id='description'><p class='product'>$description</p></div>";
			if(isset($_SESSION['id'])){
				if($_SESSION['type'] == "Customer"){
					echo "<form method='post' action='achat.php'>";
					echo "<input type='hidden' value = '$idP' name='idPr'>";
					echo "<br><input type='submit' value='Ajouter au panier' id='buy'>";
					echo "<label>Qté: </label><input type='number' name='qte' step=1 min='1' value='1' max='100' size='3'>";
					echo "</form>";
				}
			}	
			echo "</div>";
		}else{
			header('ERROR.php');
			exit();
		}
	}
	function panier($connex, $id){
		notHere($connex, $id, 'Customer');
		$req = "SELECT B.id as Bid,B.idProduct,name,price,image,P.id as id FROM Basket B, Product P WHERE B.idCustomer = $id AND B.idProduct = P.id;";
		$response = mysqli_query($connex,$req);
		if($response){
			if(mysqli_num_rows($response) == 0){
				echo "<h1>Vous n'avez pour l'instant aucun article dans votre panier</h1>";
				echo "<a href='profil.php' class='link'>Retourner sur votre profil</a>";
			}else{
				echo "<a href='profil.php' class='link'>Retourner sur votre profil</a>";
				echo "<h1>Votre panier: </h1><a href='#total' class='link'>Aller en bas<a>";
				$total = 0;
				while($ligne = mysqli_fetch_assoc($response)){
					$img = 'produit-image/'.$ligne['image'];
					$name = htmlspecialchars($ligne['name']);
					$link = $ligne['id'];
					$price = $ligne['price'];

					echo "<a href='product.php?id=$id' id='name'>";
					echo "<div class = 'panier'>";
					echo "<img src=$img>";
					echo "<span>$name</span>&nbsp;";
					echo "<span>".$price.'€'."</span>";
					echo "<abbr title='supprimer le produit'><a href='suppressionpanier.php?numProd=".$ligne['Bid']."' style='float: right;'><img src='supr.png' alt='Supprimer'></a></abbr>";
					echo "</div></a>";
					$total += $price;
				}$total = $total.'€';
				echo "<div id='total'>";
				echo "<h3>Total : $total</h3>";
				echo "</div>";
				echo "<form method = 'post' action = buy.php>";
				echo "<input type='hidden' value = 'ok' name = 'accept'>";
				echo "<input type='submit' value='acheter les articles' id='buy'>";
				echo "</form>";
			}
		}else{
			echo "<h1>Erreur</h1>";
		}
	}
	function historic($connex, $id){
		notHere($connex, $id, 'Customer');

		$req = "SELECT H.id,H.idProduct,name,price,image,P.id,H.date as date FROM Historic H, Product P WHERE H.idCustomer = $id AND H.idProduct = P.id ORDER BY H.id DESC;";
		$response = mysqli_query($connex,$req);
		if($response){
			if(mysqli_num_rows($response) == 0){
				echo "<a href='profil.php' class='link'>Retourner sur votre profil</a>";
				echo "<h1>Vous n'avez pour l'instant rien acheté</h1>";
			}else{
				echo "<a href='profil.php' class='link'>Retourner sur votre profil</a>";
				echo "<h1>Votre historique d'achat: </h1>";
				while($ligne = mysqli_fetch_assoc($response)){
					$img = 'produit-image/'.$ligne['image'];
					$name = htmlspecialchars($ligne['name']);
					$link = $ligne['id'];
					$price = $ligne['price'];
					$date = datetransfo($ligne['date']);

					echo "<a href='product.php?id=$link' id='name'>";
					echo "<div class = 'panier'>";
					echo "<img src=$img>";
					echo "<span>$name</span>&nbsp;";
					echo "<span>".$price.'€'."</span>";
					echo "<span id='date'>acheté le $date</span>";
					echo "</div></a>";
				}
			}
		}else{
			echo "<h1>Erreur</h1>";
		}
	}
	function afficherCommentaires($connex, $idProduit) {
		echo "<div id='connx'>";
		productExist($connex, $idProduit);

		$req = "SELECT co.id, text, image, date, pseudo FROM Comment co, Customer C WHERE co.idProduct = $idProduit AND co.idCustomer = C.id ORDER BY co.id DESC;";    
		$resultat = mysqli_query($connex, $req);
		// Vérifier s'il y a des commentaires à afficher
		echo "<a href='product.php?id=$idProduit' class='link'>Retourner au produit</a>";
		if (mysqli_num_rows($resultat) > 0) {
			while ($row = mysqli_fetch_assoc($resultat)) {
				$idCom = $row['id'];
				$pseudo = htmlspecialchars($row['pseudo']);
				$text = htmlspecialchars($row['text']);
				$image = 'image-commentaire/'.$row['image'];
				
				$date = dateTransfo2($row['date']);
				
				
				echo "<p>Commentaire de l'utilisateur <strong>$pseudo</strong> le $date :</p>";
				echo "<p>$text</p>";

				if(isCustomerOfComment($connex, $idCom)){
				 // a réglé pour reussir la suppression
					echo "<a href='suppressioncom.php?numCom=".$row['id']."'><img src='supr.png' alt='Supprimer'></a>";
				}

				if ($row['image'] != "NULL") {
					echo "<img src=$image alt='Image du commentaire'>";
				}
			   
			}
		} else {
			echo "Aucun commentaire trouvé pour ce produit.";
		}
		echo "</div>";
		
	}
	function isCustomerOfComment($connex, $idCom){
		if(isset($_SESSION['type'])){
			if($_SESSION['type'] == 'Admin') return true;
			if($_SESSION['type'] != 'Customer'){
				return false;
			}
		}else return false;
		$response = mysqli_query($connex, "SELECT id FROM Comment WHERE idCustomer=".$_SESSION['id']);
		if($response){
			if(mysqli_num_rows($response) == 1) return true;
		}return false;
	}
//Fonction qui affiche les ventes d'un vendeurs
function Affichevente($connex, $id){
	notHere($connex, $id, 'Seller');
	$req = "SELECT id, name, price, date, image, sellnumber, category, subcategory, idSeller,sellnumber FROM Product WHERE idSeller=$id;";
	$response = mysqli_query($connex, $req);
	if($response){
		while($row = mysqli_fetch_assoc($response)){
					$img = 'produit-image/'.$row['image'];
					$name = htmlspecialchars($row['name']);
					$link = $row['id'];
					$price = $row['price'];
					$date = datetransfo($row['date']); 
					$sell = $row['sellnumber'];

					echo "<a href='product.php?id=$link' id='name'>";
					echo "<div class = 'panier'>";
					echo "<img src=$img>";
					echo "<span>$name</span>&nbsp;";
					echo "<span>".$price.'€'."</span>";
					echo "<span> Mise en vente le $date</span>";
					echo "<span>Nombre de vente: $sell</span>";
					if(isSellerOfProduct(connection(), $link) || (isset($_SESSION['type']) && $_SESSION['type'] == "Admin")){ 
						echo "<abbr title='supprimer le produit'><a href='suppressionprod.php?numProd=".$row['id']."&idSeller=".$id."' style='float: right;'><img src='supr.png' alt='Supprimer'></a></abbr>";
					}
					echo "</div></a>";
		}
	}
}

?>

<?php function formRate(){
?>
<form action="rate.php" method="post">
		<label for="rate"><strong>Notez le produit</strong><br>
		
		<input type="radio" name="rating" value="1" checked>
		<label for="note"><img src="" alt="1"></label>

		<input type="radio" name="rating" value="2">
		<label for="note"><img src="" alt="2"></label>

		<input type="radio" name="rating" value="3">
		<label for="note"><img src="" alt="3"></label>

		<input type="radio" name="rating" value="4">
		<label for="note"><img src="" alt="4"></label>

		<input type="radio" name="rating" value="5">
		<label for="note"><img src="" alt="5"></label>

		<input type="submit" name="Envoyé et noté"><br>
</form>
<?php
}
?>