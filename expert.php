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
	if (isset($_SESSION['role']) and $_SESSION['role'] == 'Expert'){
		include 'database.php';
		global $bdd;
		echo "Bonjour ".$_SESSION['prenom'];
		include 'deconnection.php';
		include 'demandesEnvoyees.php';
	}

	else{
		echo 'Vous n etes pas connectes en tant qu expert';
	}
	?>

</body>
</html>
