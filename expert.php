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
	if (isset($_SESSION['role']) and $_SESSION['role'] == 'Expert'){
		include 'database.php';
		global $bdd;
		?><p id="greatings"><?php
		echo "Bonjour ".$_SESSION['prenom'];
		?></p><?php
		include 'deconnection.php';
		include 'demandesEnvoyees.php';
	}

	else{
		?><p id="errortext"><?php
		echo 'Vous n etes pas connectes en tant qu expert';
		?></p><?php
	}
	?>
</div>
</body>
</html>
