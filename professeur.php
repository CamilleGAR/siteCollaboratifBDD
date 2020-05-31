<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
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
		if (isset($_SESSION['role']) and $_SESSION['role'] == 'Professeur'){
				include 'database.php';
				global $bdd;
				?><p id="greatings"><?php
				echo "Bonjour ".$_SESSION['prenom'];
				?></p><?php
				include 'deconnection.php';

			$selectDemande = $bdd->prepare("SELECT * FROM utilisateurs, aide WHERE utilisateurs.pseudo = aide.eleve AND expert IS NULL AND professeur IS NULL AND aide.domaine = :domaineProf");
			$selectDemande->execute([':domaineProf' => $_SESSION['domaine']]);
			while ($demande = $selectDemande->fetch()){
				echo "demande de ".$demande['prenom']." ".$demande['nom']." en ".$demande['domaine']."<br/>";
				include 'attribuerExpert.php';
			}
		}
		else{
			?><p id="errortext"><?php
			echo 'Vous n etes pas connectes en tant que professeur';
			?></p><?php
		}
	?>
</div>
</body>
</html>
