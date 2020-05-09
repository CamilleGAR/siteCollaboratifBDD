
<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<?php
		include 'database.php';
		global $bdd;
		echo "Bonjour ".$_SESSION['prenom'];
		include 'deconnection.php';
	?>

<?php
	$selectDemande = $bdd->prepare("SELECT * FROM utilisateurs, aide WHERE utilisateurs.pseudo = aide.eleve AND expert IS NULL AND professeur IS NULL AND aide.domaine = :domaineProf");
	$selectDemande->execute([':domaineProf' => $_SESSION['domaine']]);
	while ($demande = $selectDemande->fetch()){
		echo "demande de ".$demande['prenom']." ".$demande['nom']." en ".$demande['domaine']."<br/>";
		include 'attribuerExpert.php';
	}
?>

</body>
</html>
