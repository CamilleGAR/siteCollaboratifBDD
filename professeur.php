<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>


	<a href="index.php">Retour </a><br/>

	<?php
		if (isset($_SESSION['role']) and $_SESSION['role'] == 'Professeur'){
				include 'database.php';
				global $bdd;
				echo "Bonjour ".$_SESSION['prenom'];
				include 'deconnection.php';

			$selectDemande = $bdd->prepare("SELECT * FROM utilisateurs, aide WHERE utilisateurs.pseudo = aide.eleve AND expert IS NULL AND professeur IS NULL AND aide.domaine = :domaineProf");
			$selectDemande->execute([':domaineProf' => $_SESSION['domaine']]);
			while ($demande = $selectDemande->fetch()){
				echo "demande de ".$demande['prenom']." ".$demande['nom']." en ".$demande['domaine']."<br/>";
				include 'attribuerExpert.php';
			}
		}
		else{
			echo 'Vous n etes pas connectes en tant que professeur';
		}
	?>

</body>
</html>
