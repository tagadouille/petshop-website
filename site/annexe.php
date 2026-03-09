<?php	
	require_once('affichage.php');
//fonction qui génère la barre de navigation
function navbar($connected){
	$connex = mysqli_connect('localhost', 'root', '', 'projet');
	if(!$connex){
		header('Location: ERROR.php');
		exit();
	}
	?>
	<header class='header'>
        <div class="Logo"><a href="index.php"><img id='logo' src='logo.png' alt='Accueil' height='75'></a></div>
	    <div id='nav'>
		 	<nav>
		 		<form method="get" action='index.php' id="Resbar">
				 	<label>produit</label><input type='radio' name = 'type' value='Product' checked>
        			<label>profil vendeur</label><input type='radio' name = 'type' value='Seller'>&nbsp;
        			<input type='text' name='search' maxlength="50">
        			<!--<label>profil client</label><input type='radio' name = 'type' value='client'>-->
        			<input type='submit' value='Recherche'>
          		</form>
		 	</nav>
		<div class="button">
	       <div class="minibox">
				<div class ='dropdown'>
					<h3 id='Catégories'><a href="index.php?cat=Chien" id='noblue' style='color:white;'> Chien </a></h3>
					<div class='dropdown-content'>
						<?php 
							category($connex,'Chien');
						?>
		        	</div>
		        </div>
		    </div><!--
		     --><div class="minibox">
		            <div class ='dropdown'>
						<h3 id='Catégories'><a href="index.php?cat=Chat" id='noblue' style='color:white;'> Chat </a></h3>
						<div class='dropdown-content'>
							<?php 
								category($connex,'Chat');
							?>
		        		</div>
		            </div>
		        </div><!--
		     --><div class="minibox">
		            <div class ='dropdown'>
						<h3 id='Catégories'><a href="index.php?cat=Oiseau" id='noblue' style='color:white;'> Oiseau </a></h3>
						<div class='dropdown-content'>
							<?php 
								category($connex,'Oiseau');
							?>
		        		</div>
		            </div>
		        </div>
	    </div>
		<div class="button2">
		<?php if($connected == 0){?>
	        <div class="minibox2">
		         <h3><a href='create.php' id="noblue2">S'inscrire </a></h3>
		    </div><!--
		 --><div class="minibox2">
		         <h3><a href='login.php' id="noblue2">Se connecter </a></h3>
		   </div><!--
		    <?php }else if($connected == "none"){echo "<!--";}
		    	else{
		    		echo "<div class='minibox2'><h3><a href='deconnect.php' id='noblue2'>Se déconnecter </a></h3></div><!--";
		    		echo "--><div class='minibox2'><h3><a href='profil.php' id='noblue2'>Profil </a></h3></div><!--";
		    }?>
		 -->
		</div>
		</div>
    </header>
    <?php 
}
?>


<?php function footers(){
?>

	<style>
		.footer{
			margin-top: 100px;
			background-color: #24262b;
	   		padding: 100px 0px;
	   		margin-bottom: 0px;
		}

		.contenue{
			max-width: 2000px;
			margin:auto;
		}

		.ligne{
			display: flex;
			flex-wrap: wrap;
		}

		.footer-colonne{
			width: 25%;
	   		padding: 0 15px;
			margin-left: 100px;
		}

		.ul{
			list-style: none;
		}

		.footer-colonne{
			width: 25%;
	   		padding: 0 15px;
		}

		.footer-colonne h4{
		font-size: 18px;
		color: #ffffff;
		text-transform: capitalize;
		margin-bottom: 35px;
		font-weight: 500;
		position: relative;
	}

	.footer-colonne h4:before{
		content: '';
		position: absolute;
		left:0;
		bottom: -10px;
		background-color: #e91e63;
		height: 2px;
		box-sizing: border-box;
		width: 50px;
	}

	.footer-colonne ul li:not(:last-child){
		margin-bottom: 10px;
	}

	.footer-colonne ul li a{
		font-size: 16px;
		color: #ffffff;
		text-decoration: none;
		font-weight: 500;
		color: #bbbbbb;
		display: inline;
		transition: all 0.3s ease;
	}
</style>

<footer class="footer">
  	 <div class="contenu">
  	 	<div class="ligne">
  	 		<div class="footer-colonne">
  	 			<h4>Notre équipe</h4>
  	 			<ul>
  	 				<li><a href="#">à propos de nous</a></li>
  	 				<li><a href="#">Nos services</a></li>
  	 				<li><a href="politique.php">politique privée</a></li>
  	 			</ul>
  	 		</div>
  	 		<div class="footer-colonne">
  	 			<h4>Besoin d'aide ?</h4>
  	 			<ul>
  	 				<li><a href="contacte.php">Contact</a></li>
  	 			</ul>
  	 		</div>
  	 		<div class="footer-colonne">
  	 			<h4>Magasin</h4>
  	 			<ul>
  	 				<li><a href="index.php?cat=Chien">Chien</a></li>
  	 				<li><a href="index.php?cat=Chat">Chat</a></li>
  	 				<li><a href="index.php?cat=Oiseau">Oiseau</a></li>
  	 			</ul>
  	 		</div>
  	 	</div>
  	 </div>
  </footer>
<?php
}
?>	
    


