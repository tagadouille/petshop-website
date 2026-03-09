<?php
	//vérifie si le client ou le vendeur a bien rempli le formulaire
	function verificationCS(){
		if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['date']) && isset($_POST['psw']) && isset($_POST['psw2']) && isset($_POST['pseudo']) && isset($_POST['adresse']) && isset($_POST['pays'])){
			if($_POST['nom'] != '' && $_POST['prenom'] != '' && $_POST['date'] != '' && $_POST['psw'] != '' && $_POST['psw2'] != '' && $_POST['pays'] != '' && $_POST['adresse'] != '' && $_POST['pseudo'] != ''){
				if($_POST['psw'] != $_POST['psw2']){
					return 1;
				}return 0;
			}else{
				if($_POST['psw'] != '' && $_POST['psw2'] != ''){
					if($_POST['psw'] != $_POST['psw2']){
						return 3;
					}
				}return 2;
			}
		}
	}
	//vérifie si l'administrateur a bien rempli le formulaire
	function verificationA(){
		if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['date']) && isset($_POST['psw']) && isset($_POST['psw2']) && isset($_POST['pseudo'])){
			if($_POST['nom'] != '' && $_POST['prenom'] != '' && $_POST['date'] != '' && $_POST['psw'] != '' && $_POST['psw2'] != '' && $_POST['pseudo'] != ''){
				if($_POST['psw'] != $_POST['psw2']){
					return 1;
				}return 0;
			}else{
				if($_POST['psw'] != '' && $_POST['psw2'] != ''){
					if($_POST['psw'] != $_POST['psw2']){
						return 3;
					}
				}return 2;
			}
		}
	}
	//Fonction qui fait la connexion à la base de donnée
	function connection(){
		$connex = mysqli_connect('localhost', 'root', '', 'projet');
		if(!$connex){
			header('Location: ERROR.php');
			exit();
		}
		mysqli_set_charset($connex, 'utf8');
		return $connex;
	}

	//Fonction qui vérifie si un utilisateur est bien présent dans la base de donnée
	function isHere($connex,$id,$type){
		$req = "SELECT name FROM $type WHERE id=$id;";
		$response = mysqli_query($connex, $req);
		if($response){
			if(mysqli_num_rows($response) == 1) return true;
			else return false;
		}
	}
	function notHere($connex, $id,$type){
		if(!isHere($connex, $id,$type)){
			header('Location: delete.php');
			exit();
		}return false;
	}
	//Fonction qui vérifie si un produit existe encore dans la base de donnée
	function isProduct($connex, $id){
		$req = "SELECT name FROM Product WHERE id = $id;";
		$response = mysqli_query($connex, $req);
		if($response){
			if(mysqli_num_rows($response) == 1) return true;
			else return false;
		}
	}
	function productExist($connex, $id){
		if(!isProduct($connex, $id)){
			header('Location: delete2.php');
			exit();
		}return false;
	}
	//insertion les données du vendeur/acheteur dans sa table respective
	function insertCS($connex,$table){
		//Préparation des données
		if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['date']) && isset($_POST['psw']) && isset($_POST['psw2']) && isset($_POST['pseudo']) && isset($_POST['adresse']) && isset($_POST['pays']) && $_POST['pseudo'] != ''){
			$surname = mysqli_real_escape_string($connex, $_POST['nom']); 
			$name = mysqli_real_escape_string($connex, $_POST['prenom']); 
			$birthdate = mysqli_real_escape_string($connex, $_POST['date']);
			$adresse = mysqli_real_escape_string($connex, $_POST['adresse']); 
			$pays = mysqli_real_escape_string($connex, $_POST['pays']);
			$psw = password_hash($_POST['psw'], PASSWORD_DEFAULT);
			$pseudo = mysqli_real_escape_string($connex, $_POST['pseudo']);
			$sexe = mysqli_real_escape_string($connex, $_POST['sexe']);

			//Vérification de si le pseudo est dans la table:
			$req = "SELECT id FROM Customer WHERE pseudo='$pseudo';";
			$response = mysqli_query($connex, $req);
			if(mysqli_num_rows($response) == 1){
				return FALSE;
			}
			//Insertion
			$req = "INSERT INTO $table(surname,name,pseudo,psw,birthdate,sex,country,address) VALUES('$surname','$name','$pseudo','$psw','$birthdate','$sexe','$pays','$adresse');";
			$response = mysqli_query($connex, $req);
			if(!$response){
				return FALSE;
			}else{
				return TRUE;
			}
		}
	}
	//insertion les données de l'administrateur dans sa table respective
	function insertA($connex,$table){
		//préparation des données
		if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['date']) && isset($_POST['psw']) && isset($_POST['psw2']) && isset($_POST['pseudo']) && $_POST['pseudo'] != ''){
			$surname = mysqli_real_escape_string($connex, $_POST['nom']); 
			$name = mysqli_real_escape_string($connex, $_POST['prenom']); 
			$birthdate = mysqli_real_escape_string($connex, $_POST['date']);
			$psw = password_hash($_POST['psw'], PASSWORD_DEFAULT);
			$pseudo = mysqli_real_escape_string($connex, $_POST['pseudo']);
			$sexe = mysqli_real_escape_string($connex, $_POST['sexe']);

			//Vérification de si le pseudo est dans la table:
			$req = "SELECT id FROM Admin WHERE pseudo='$pseudo';";
			$response = mysqli_query($connex, $req);
			if(mysqli_num_rows ($response) == 1){
				return FALSE;
			}
			//Insertion
			$req = "INSERT INTO $table(surname,name,pseudo,psw,birthdate,sex) VALUES('$surname','$name','$pseudo','$psw','$birthdate','$sexe');";
			$response = mysqli_query($connex, $req); return TRUE;
			if(!$response){
				return FALSE;
			}else{
				return TRUE;
			}
		}	
	}
	//Vérifie si les donnée rentrée dans le formulaire d'inscription sont correctes et créer le compte sinon affiche des messages d'erreurs
	function switcher($accounttype){
		if($accounttype != "Admin") $response = verificationCS();
		else $response = verificationA();
		if($response == 0){
			$connex = mysqli_connect('localhost', 'root', '', 'projet');
			if(!$connex){
				header('Location: ERROR.php');
				exit();
			}
			mysqli_set_charset($connex, 'utf8');
			if($accounttype != "Admin") $response2 = insertCS($connex,$accounttype);
			else $response2 = insertA($connex,$accounttype);
			
			if($response2){
				//Initialisation de la session
				$_SESSION['type'] = $accounttype;
				$_SESSION['surname'] = htmlspecialchars(mysqli_real_escape_string($connex, $_POST['nom'])); 
				$_SESSION['name'] = htmlspecialchars(mysqli_real_escape_string($connex, $_POST['prenom'])); 
				$_SESSION['birthdate'] = htmlspecialchars(mysqli_real_escape_string($connex, $_POST['date']));
				$_SESSION['pseudo'] = htmlspecialchars(mysqli_real_escape_string($connex, $_POST['pseudo']));
				$_SESSION['sex'] = htmlspecialchars(mysqli_real_escape_string($connex, $_POST['sexe']));
				$_SESSION['id'] = idRecuperation($connex,$accounttype,$_SESSION['pseudo']);
				if($accounttype != "Admin"){
					$_SESSION['country'] = htmlspecialchars(mysqli_real_escape_string($connex, $_POST['pays']));
					$_SESSION['address'] = htmlspecialchars(mysqli_real_escape_string($connex, $_POST['adresse']));
				}
			}else{
				$_SESSION['msgg'] = 4;
			}
		}else{
			$_SESSION['msgg'] = $response;
		}return $response;
	}

	//Récupère l'identifiant d'un utilisateur à partir de son pseudo
	function idRecuperation($connex,$accounttype, $pseudo){
		$pseud = mysqli_real_escape_string($connex, $pseudo);
		$req = "SELECT id FROM $accounttype WHERE pseudo = '$pseudo'";
		$response = mysqli_query($connex,$req);
		if(mysqli_num_rows($response) == 1) return mysqli_fetch_assoc($response)['id'];
		else return FALSE;
	}
	//Récupère les données d'un utilisateur à partir de son id
	function recuperation($connex,$accounttype,$id){
		$req = "SELECT * FROM $accounttype WHERE id = $id;";
		$response = mysqli_query($connex,$req);
		if($response){
			$ligne = mysqli_fetch_assoc($response);
			foreach ($ligne as $key => $value) {
				$_SESSION[$key] = $value;
			}unset($_SESSION['psw']);
			mysqli_free_result($response);
		}else{
			echo "ERREUR";
		}
	}

	//connecte un utilisateur à son compte si les données rentrée dans le formulaire son correcte
	function connect($connex, $accounttype){
		$pseudo = mysqli_real_escape_string($connex, $_POST['pseudo']);
		$req = "SELECT id,psw FROM $accounttype WHERE pseudo = '$pseudo'";
		$response = mysqli_query($connex, $req);
		if($response){
			if(mysqli_num_rows($response) == 1){
				$ligne = mysqli_fetch_assoc($response);
				if(password_verify($_POST['psw'], $ligne['psw'])){
					$_SESSION['type'] = $accounttype;
					recuperation($connex,$accounttype,$ligne['id']);
					return 0;
				}	
			}return 1;
		}else{
			echo "ERREUR";
		}	
	}
	function dateTransfo($date){
		$tmp = explode('-', $date);
		return $tmp[2].'/'.$tmp[1].'/'.$tmp[0];
	}
	function dateTransfo2($date){
		$d = '';
		$flag = false;
		$t = '';
		for ($i=0; $i < strlen($date); $i++) { 
			if($date[$i] != ' ' && !$flag){
				$d.=$date[$i];
			}if($date[$i] == ' '){
				$flag = true;
			}
			if($flag){
				$t.= $date[$i];
			}
		}$tmp = explode('-', $d);
		return $tmp[2].'/'.$tmp[1].'/'.$tmp[0].' à'.$t;
	}

//Fonction qui vérifie si les données entré dans le formulaire de proform sont toutes là
function finish3(){
	if (isset($_POST["price"]) && isset($_POST["description"]) && isset($_POST["subcategory"]) && isset($_POST['name'])) {   
		if (!empty($_POST["price"]) && !empty($_POST["description"] && !empty($_POST['name']))) {   
			return 0;
		} else {
			return 1;
		}    
	} else {
		return 1;
	}
}
 
function finish3img(){
    if(isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK){
        $file = $_FILES['file'];
        if(verifierImage($file)){
            return 0; // L'image est valide
        } else {
            return 2; // Le fichier importé n'est pas une image
        }
    } else {
        return 3; // Aucun fichier importé
    }
}

//Fonction qui vérifie  la validité d'une image
function verifierImage($file) {
    if ($file['error'] !== UPLOAD_ERR_OK) { 
        return false;
    }
    $file_type = exif_imagetype($file['tmp_name']);
    if (!$file_type || !in_array($file_type, [IMAGETYPE_WEBP, IMAGETYPE_JPEG, IMAGETYPE_PNG])) {
        return false;
    }
    return true;
}

//Fonction qui insère un produit dans la table product. Elle prend en paramètre l'adresse de l'image et la catégorie
 function insertionProd($connex,$animal,$img){
	$price = $_POST['price'];
	$category= $animal;
	$subcategory= $_POST['subcategory'];
	$description= mysqli_real_escape_string($connex,$_POST['description']);
	$name = mysqli_real_escape_string($connex, $_POST['name']);
	$image = $img;
	$id =  $_SESSION['id'];

	if(notHere($connex, $id, "Seller")) return false;

	$req = "INSERT INTO Product(name,description, price, image, category, subcategory, idSeller) VALUES('$name','$description', $price, '$image', $category, $subcategory,$id)";
	$response = mysqli_query($connex,$req);
	if($response){
		return true;
	}return false;
	
}
//Fonction qui ajoute un fichier dans le server
function addImage($file, $clé){
    if(isset($_FILES[$clé])){
        $temps = time();
        $nom_image = $_FILES[$clé]['name'];
        $temp = $_FILES[$clé]['tmp_name'];
        $extension = pathinfo($nom_image, PATHINFO_EXTENSION);
        $newimg = $temps.'_'.mysqli_real_escape_string(connection(),str_replace(' ','_' ,$nom_image)); // Utilisation du temps actuel pour rendre le nom unique
        $placeimg = move_uploaded_file($temp, $file."/".$newimg); //déplacement du fichier dans le dossier file
        if($placeimg){
            return $newimg;
        } else {
            return false; // Retourner false en cas d'échec du déplacement du fichier
        }
    }
}
//Vérification du formulaire pour les commentaires

function verifierImagecom($file) {  //comme la fonction verifierImage mais avec un nouveau type de fichier, GIF
    if ($file['error'] !== UPLOAD_ERR_OK) { 
        return false;
    }
    $file_type = exif_imagetype($file['tmp_name']);
    if (!$file_type || !in_array($file_type, [IMAGETYPE_WEBP, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF])) {
        return false;
    }
    return true;
}

function Imagecom(){
    if(isset($_FILES['file2']) && $_FILES['file2']['error'] === UPLOAD_ERR_OK){
        $file = $_FILES['file2'];
        if(verifierImagecom($file)){
           return 0; //Image correcte
        } else {
            return 1; //Mauvaise extension
        }
	}
    return 0; //même si il n'y pas d'image importé on souhaite qu'il y a un commentaire avec une image ou sans.
}

function verifierformcom(){
	if (isset($_POST["commentaire"])){   
		if (!empty($_POST["commentaire"])) {   
			return 0;
		} 
	}
	return 1;
}

//Fonction qui insère les commentaires
function insertionComment($connex, $idCustomer, $idProduct, $text, $image) {
	notHere($connex, $idCustomer, 'Customer');
	productExist($connex, $idProduct);
    // Échapper les caractères spéciaux dans le texte du commentaire
    $text = mysqli_real_escape_string($connex, $text);

    // Requête d'insertion
    $req = "INSERT INTO Comment(idCustomer, idProduct, text, image) VALUES ($idCustomer, $idProduct, '$text', '$image')";

    // Ajouter un echo ou un var_dump pour afficher la requête SQL
    echo $req;

    // Exécution de la requête
    $response = mysqli_query($connex, $req);

    // Vérification si l'insertion a réussi
    if ($response) {
        return true;
    }
    return false;
}

//Ajoute au panier et à l'historique d'achat un produit
function buy($connex, $id,$qte){
	$idCust = $_SESSION['id'];
	notHere($connex, $idCust, 'Customer');
	productExist($connex, $id);
	for ($i=0; $i < $qte; $i++) { 
		$req1 = "INSERT INTO Basket(idProduct,idCustomer) VALUES($id,$idCust);";
		$response = mysqli_query($connex,$req1);
		if(!$response){
			return false;
		}
	}return true;
}
//Fonction qui vide le panier
function vider($connex){
	$id = $_SESSION['id'];
	notHere($connex, $id, 'Customer');
	//Récupération des id
	$req = "SELECT idProduct as id FROM Basket WHERE idCustomer = $id;";

	$response = mysqli_query($connex, $req);
	if($response){
		$ret = array();
		$i = 0;
		while($ligne = mysqli_fetch_assoc($response)){
			$ret[$i] = $ligne['id'];
			$i++;
		}
	}
	$req = "DELETE FROM Basket WHERE idCustomer = $id;";
	$response = mysqli_query($connex,$req);
	if($response){
		return $ret;
	}else{
		header('Location: ERROR.php');
		exit();
	}
}
//Fonction qui met les produits acheté dans l'historique d'achat
function buy2($connex, $tid){
	$idCust = $_SESSION['id'];
	notHere($connex, $idCust, 'Customer');
	for ($i=0; $i < count($tid); $i++) { 
		if(isProduct($connex, $tid[$i])){
			$req = "INSERT INTO Historic(idProduct,idCustomer) VALUES($tid[$i],$idCust);";
			$response = mysqli_query($connex,$req);
			sell($connex, $tid[$i]);
		}
	}
}
//Fonction qui incrémente le nombre de vente d'un produit
function sell($connex, $id){	
	$req = $connex->prepare("UPDATE Product SET sellnumber = sellnumber + 1 WHERE id=$id;");
	$req->execute();
	$response = $req->get_result();
	if($response) return true;
	return false;
}
//Fonction qui indique si un produit a été acheté ou non, Donc si il est dans l'historique d'achat du client
function isbuy($connex, $idPr){
        if(isset($_SESSION['type'])){
            if($_SESSION['type'] != 'Customer'){
                return false;
            }$idCust = $_SESSION['id'];
            if(notHere($connex, $idCust, 'Customer')) return false;
            $req = "SELECT id FROM Historic WHERE idProduct=$idPr AND idCustomer = $idCust;";
            $response = mysqli_query($connex, $req);
            if(mysqli_num_rows($response) >= 1) return true;
            return false; 
        }else{
            return false;
        }
    }

	function isSellerOfProduct($connex, $idProduct) {
		// Récupération de l'id du produit
		$req = "SELECT idSeller FROM Product WHERE id = $idProduct";
		$response = mysqli_query($connex, $req);
	
		//vérificaton si la requête a été faite et qu'il y a une seul ligne de résulats
			if ($response && mysqli_num_rows($response) == 1) {
				$row = mysqli_fetch_assoc($response);
				$id_Seller_product = $row['idSeller'];
	
				// Récupération de l'id du vendeur qui est connecté
				if(isset($_SESSION['id']) && $_SESSION['type'] == 'Seller') {
					$id_Seller_connecté = $_SESSION['id'];
	
				// Vérifier si les deux ID correspondent
				if ($id_Seller_product == $id_Seller_connecté) {
					return true;
				}
			}
		}
		return false;
	}
	function deleteProd($connex, $idpro){
            $req1 = "DELETE FROM Basket WHERE idProduct = $idpro";
            $response1 = mysqli_query($connex, $req1);

            $req1 = "DELETE FROM Score WHERE idProduct = $idpro";
            $response2 = mysqli_query($connex, $req1);

            $req1 = "DELETE FROM Comment WHERE idProduct = $idpro";
            $response3 = mysqli_query($connex, $req1);

            $req2 = "DELETE FROM Historic WHERE idProduct = $idpro";
            $response4 = mysqli_query($connex, $req2);

            $response = mysqli_query($connex, "SELECT image FROM Product WHERE id = $idpro;");
        	if(mysqli_num_rows($response) == 1){
           		$img = mysqli_fetch_assoc($response)['image'];
            	if($img != 'NULL') unlink('produit-image/'.$img); //Supression
        	}

            $req3 = "DELETE FROM Product WHERE id=$idpro";
            $response5 = mysqli_query($connex, $req3);

            if($response1 && $response2 && $response3 && $response4 && $response5){
                return true;
            }return false;
        }

?>
