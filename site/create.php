<?php
    require_once('annexe.php');
    require_once('creation.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style2.css">
    <title>ChunChunMaru</title>
</head>
<body>
    <?php
        navbar("none");
    ?>

    <p> Veuillez sélectionner quel est le type de votre compte.</p>

    <form method="post" id=connx>
        <input type="radio" id="Admin" name="type" value="administrateur" checked>
        <label for="Admin">Administrateur</label>

        <input type="radio" id="Vendeur" name="type" value="vendeur">
        <label for="Vendeur">Vendeur</label>

        <input type="radio" id="Acheteur" name="type" value="client">
        <label for="Acheteur">Client</label><br><br>

        <input type="submit" value="Créer le compte">
    </form>

<?php	function redirection() {
        if(isset($_POST['type'])) {
            $accounttype = $_POST['type'];
            if($accounttype == "vendeur") {
                header("Location: vendeur.php");
                exit();
            } elseif ($accounttype == "client") {
                header("Location: acheteur.php");
                exit();
            } elseif ($accounttype == "administrateur") {
                header("Location: verify.php");
                exit();
            }
        }
    }

	redirection();
?>
</body>
</html>
