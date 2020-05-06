
<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Page eleve</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="eleve.css">
</head>
<body>

	<?php
		include 'database.php';
		global $bdd;
		echo "Bonjour ".$_SESSION['prenom'];
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
				<textarea name="message" rows="8" cols="45">Expliquez votre problème</textarea><br/>
				<input type="submit" name="envoye" value="Envoyer"><br/>
			</form>
	<?php
		}


		if(isset($_POST['envoye'])){
			extract($_POST);

			if (!empty($domaine) && !empty($message)){
				$selectProf = $bdd->prepare("SELECT * FROM utilisateurs WHERE role = :role");
				$selectProf->execute([':role' => "Professeur"]);
				$prof = $selectProf->fetch();

				$requete = $bdd->prepare("INSERT INTO aide(domaine, eleve, professeur, etat, texte) VALUES(:domaine, :eleve, :professeur, :etat, :texte)");
				$requete->execute(['domaine' => $domaine, 'eleve' => $_SESSION['pseudo'], 'professeur' => $prof['pseudo'], 'etat' => "Demande envoyée", 'texte' => $message]);
				echo "Demande envoyée";
			}
		}
	?>






</body>
</html>
