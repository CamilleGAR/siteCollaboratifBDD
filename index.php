<?php
	$nom = "Camille";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Titre</title>
</head>
<body>


	<a href="administrateur.php"> Page Admin </a>



<!-- 
	<p>Nom : <?= $nom; ?></p>

	<?php
		include 'database.php';
		global $db;
	?>

	<form method="post">
		<input type="text" name="pseudo" id="pseudo" placeholder="pseudo" required>
		<input type="submit" name="envoye" id="envoye">
	</form>

	<?php
		if(isset($_POST['envoye'])){
			echo "Votre Pseudo : ".$_POST['pseudo']."<br/>";
			$requete = $bdd->query("SELECT password FROM utilisateurs WHERE pseudo = ".$_POST['pseudo']);

		while($utilisateur = $requete->fetch()){
			echo "pseudo : ".$utilisateur['password'];
		}
		}
	?>
 -->

</body>
</html>
