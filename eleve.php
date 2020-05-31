<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Page eleve</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css" />
</head>
<body>
<div class="topbar">
	<p>Gestion d'intervenants experts dans la formation</p>
</div>
</br>

<div class="centeredblock">
		<form action="index.php">
    		<input type="submit" value="Retour" />
		</form>

	<?php
	if (isset($_SESSION['role']) and $_SESSION['role'] == 'Eleve'){
			include 'database.php';
			global $bdd;
			?><p id="greatings"><?php
			echo "Bonjour ".$_SESSION['prenom'];
			?></p><?php
			include 'deconnection.php';

		?>



		<form method="post"> 
			<input type="submit" name="demande" value="Demander de l'aide"><br/>
		</form>


		<?php
			if(isset($_POST['demande'])){
		?>
				<form method="post"> 
					<select name="domaine" multiple>
	  					<optgroup label="domaine">
			    			<option value="Mathematiques" selected>mathématiques</option>
			    			<option value="Physique">physique</option>
			    			<option value="Informatique">informatique</option>
			    			<option value="Anglais">anglais</option>
	  					</optgroup>
	  				</select><br/>	
					<textarea name="message" rows="8" cols="45" placeholder="Expliquez votre problème"></textarea><br/>
					<input type="submit" name="envoye" value="Envoyer"><br/>
				</form>
		<?php
			}


			if(isset($_POST['envoye'])){
				extract($_POST);

				if (!empty($domaine) && !empty($message)){

					$requete = $bdd->prepare("INSERT INTO aide(domaine, eleve, etat, texte) VALUES(:domaine, :eleve, :etat, :texte)");
					$requete->execute(['domaine' => $domaine, 'eleve' => $_SESSION['pseudo'], 'etat' => "Demande envoyee", 'texte' => $message]);
					echo "Demande envoyée";
				}
			}
		?>


	<?php
	include 'demandesEnvoyees.php';
	}

	else{
		?><p id="errortext"><?php
		echo 'Vous n etes pas connectes en tant qu eleve';
		?></p><?php
	}
?>
</div>


</body>
</html>
