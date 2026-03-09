<?php
	//Affiche le formulaire de création de compte et les messages d'erreurs associé
    function creat($err,$accounttype){
?>
		<input type="hidden" name="accounttype" value = <?php echo $accounttype ?>>
		<label for="nom"> Entrez votre Nom:</label><br>
		<input type="text" name="nom" size = "20" placeholder="Nom" maxlength="50"><br><br>

		<label for="prenom"> Entrez votre Prénom:</label><br>
		<input type="text" name="prenom" size = "20" placeholder="Prénom" maxlength="50"><br><br>

		<label for="date"> Entrez votre Date de naissance:</label><br>
		<input type="date" name="date" ><br>

		<p> Veuillez selectionner votre Sexe.</p>
		<input type="radio" id="Homme" name="sexe" value="homme" checked>
		<label for="homme">Homme</label>
		<input type="radio" id="Femme" name="sexe" value="femme">
		<label for="Femme">Femme</label>
		<input type="radio" id="Intersexe" name="sexe" value="intersexe">
		<label for="Intersexe">Intersexe</label><br><br>

		<label for="pseudo">Entrez votre Pseudo :</lable><br>
		<input type="text" name="pseudo" size = "20" placeholder="Pseudo" maxlength="50"><br>
		<?php if($err == 4){
			echo " &nbsp; <span style='color: red;'>Ce pseudo existe déjà</span><br><br>";
		} ?>
		<label for="mdp">Entrez votre mot de passe :</lable><br>
		<input type="password" name="psw" size = "20" placeholder="Mot de passe" maxlength="50"><br>
		<?php if($err == 1 || $err == 3){
			echo " &nbsp; <span style='color: red;'>Les mots de passes ne correspondent pas</span>";
		} ?><br>

		<label for="mdp2">Réentrez votre mot de passe :</lable><br>
		<input type="password" name="psw2" size = "27" placeholder="Mot de passe" maxlength="50"><br>
		<?php if($err == 2 || $err==3){
			echo "<span style='color : red;'>Des champs du formulaire ne sont pas remplis! Veuillez le faire.</span><br>";
		}
		?>
		<input type="submit" value="Envoyer">&nbsp;
		<input type="reset" value="Renitialiser"><br>

	<a href="index.php">Revenir à l'acceuil</a>
	<a href="login.php">Déjà un compte ?</a>

    <?php
    }
?>


<?php
	//affiche le formulaire pour l'adresse et le pays
    function adr(){
        ?>
    <label for="adresse"> Entrez votre Adresse:</label><br>
        <input type="text" name="adresse" size = "20" placeholder="Adresse" maxlength="50"><br><br>

    <label for="pays">Entrez votre Pays :</labled><br>
        <input type="text" name="pays" size = "20" placeholder="Pays" maxlength="30"><br><br>
    
        <?php
    }
?>


<?php
	//affiche en fonction de la catégorie, l'ajout du produit
    function productForm($error,$error2, $animal){
        ?>
	<form action="finish3.php" method="POST" id="connx" enctype="multipart/form-data">
		<?php
			if($error == 1){
				echo "<span style='color:red;'>Veuillez bien remplir l'ensemble des champs</span><br>";	
			}
		?>
		<label for="product"> Nom du Produit:</label>
		<input type="text" name="name" maxlength="50" size="30"><br><br>
		<label for="price">Prix:</label>
        <input type="number" step="0.01" name="price" max="10000000" size="8"><label for="price">€</label><br><br>

        <label for="subcategory">Sous-catégorie:</label>

        <?php optioncat($animal);?><br><br>

		<label for>Description</label><br>
		<textarea name="description" rows="10" cols="70" maxlength="3000"></textarea><br><br>
		<?php if($error2 == 2){
			echo "<span style='color:red;'>Le fichier importer n'est pas une image</span><br>";	
		}?>
		<input type="file" name="file"><br>
		<?php if($error2 == 3){
			echo "<span style='color:red;'>Aucun fichier a été importer</span><br>";
		}?>
		<br>
        <input type="submit" value="Ajouter">
		<input type="reset" value="Renitialiser">
    </form>
        <?php
    }
?>

<?php function Ajoutprod(){
	?>

	<form action="proform2.php" method="post" id="connx">

	<input type="radio" name="animal" value="1" checked>
	<label for="Chats">Chats</label>

	<input type="radio" name="animal" value="2">
	<label for="Chiens">Chiens</label>  

	<input type="radio" name="animal" value="3">
	<label for="Oiseaux">Oiseaux</label><br><br> 

	<input type="submit" value = "Envoyez">
	<input type="reset" value="Renitialisez">

</form>

<?php
}
function optioncat($category){
	$connex = mysqli_connect('localhost', 'root', '', 'projet');
	if(!$connex){
		header('Location: ERROR.php');
		exit();
	}
	mysqli_set_charset($connex, 'utf8');
	$req = "SELECT name,id FROM Subcategory WHERE idCat = $category;";
	$response = mysqli_query($connex, $req);
	if($response){
		echo "<select name='subcategory'>";
		while($ligne = mysqli_fetch_assoc($response)){
			$id = $ligne["id"];
			$name = $ligne["name"];
			echo "<option value='$id'>$name</option>";
		}echo "</select>";
	}
}
?>

<?php function formcomment($error2, $fileerror){
	?>

	<form action="commentaire2.php" id="connx" method="post" enctype="multipart/form-data">
	<?php

	if($error2 == 1 && $fileerror !=1){
		echo "<span style='color:red;'><strong>Vérifier que vous aviez bien remplis le champ commentaire</strong></span><br><br>";
	}
	if($error2 == 1 && $fileerror == 1){
		echo "<span style='color:red;'><strong>Vérifier que vous aviez bien remplis le champ commentaire</strong></span><br>";
		echo "<span style='color:red;'><strong>Vérifier que le fichier importé a la bonne extension</strong></span><br><br>";
	}
	if($error2 !=1 && $fileerror ==1){
		echo "<span style='color:red;'><strong>Vérifier que le fichier importé a la bonne extension</strong></span><br><br>";
	}
	?>
	<label for="com">Entrez le commentaire</label><br>
	<textarea name="commentaire" rows="10" cols="70" maxlength="1000"></textarea><br><br>
	
	<label for="importer"><strong>Facultatif:</strong> Importer un fichier (PNG, WEBP, JPEG, GIF.)</label><br>
	<input type="file" name="file2"><br><br>

	<input type="submit" name="Ajouter">
	<input type="reset" name="Rénitialiser">

	</form>
	<?php
}
?>
