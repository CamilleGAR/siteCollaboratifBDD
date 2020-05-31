<!DOCTYPE html>
<html>
<head>
	<title>Dossier</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css" />
</head>
<body>
<div class="topbar">
	<p>Gestion d'intervenants experts dans la formation</p>
</div>
</br>
<div class="centeredblock">

<?php
session_start();
include 'database.php';
global $bdd;
?><p id="greatings"><?php
echo "Bonjour ".$_SESSION['prenom'];
?></p><?php
include 'deconnection.php';



if ($_SESSION['role'] == 'Expert'){
	?>
	<form action="expert.php">
    	<input type="submit" value="Retour" />
	</form>
	<?php
	$demande = $bdd->prepare("SELECT * FROM aide, utilisateurs WHERE aide.eleve = utilisateurs.pseudo AND aide.id = :id AND expert = :expert");
	$demande ->execute([':id' => $_GET['id'], ':expert' => $_SESSION['pseudo']]);
	$nb = $demande->rowCount();

	if ($nb > 0){
		$getEmail = $demande->fetch();
		echo "adresse mail de l'eleve : ".$getEmail['email'];
		?>
	<form method="post"> 
		<textarea name="message" rows="8" cols="45" placeholder="Votre réponse"></textarea><br/>
		<input type="submit" name="envoye" value="Envoyer"><br/>
	</form>	
	<?php
	if(isset($_POST['envoye'])){
		extract($_POST);
		if (!empty($message)){
			$requete = $bdd->prepare("INSERT INTO reponse(id_demande, role, texte) VALUES(:id_demande, :role, :texte)");
			$requete->execute([':id_demande' => $_GET['id'], ':role' => 'Expert', ':texte' => $message]);
			$modif = $bdd->prepare("UPDATE aide SET etat = 'Reponse recue' WHERE id = :id");
			$modif->execute([':id' => $_GET['id']]);
		}
	}

		$reponses = $bdd->prepare("SELECT * FROM reponse WHERE id_demande = :id ORDER BY id DESC");
		$reponses ->execute([':id' => $_GET['id']]);

		while ($reponse = $reponses->fetch()){

			if ($reponse['role'] == 'Expert'){
				echo 'votre reponse ';
				}

			else {
				echo "reponse de l'eleve ";
			}

			echo '('.$reponse['date'].') <br/>';
			echo $reponse['texte'].'<br/><br/>';

		}
		$aides = $bdd->prepare("SELECT * FROM aide WHERE id = :id");
		$aides ->execute([':id' => $_GET['id']]);
		$aide = $aides->fetch();
		echo "Message d'origine : ".$aide['texte'];
	}

	else{
		echo 'Vous ny avez pas acces';
	}
	
}

if ($_SESSION['role'] == 'Eleve'){
	?>
	<form action="eleve.php">
    	<input type="submit" value="Retour" />
	</form>
	<?php
	$demande = $bdd->prepare("SELECT * FROM aide, utilisateurs WHERE aide.expert = utilisateurs.pseudo AND aide.id = :id AND eleve = :eleve");
	$demande ->execute([':id' => $_GET['id'], ':eleve' => $_SESSION['pseudo']]);
	$nb = $demande->rowCount();

	if ($nb > 0){
		$getEmail = $demande->fetch();
		echo "adresse mail de l'expert : ".$getEmail['email'];
		?>
	<form method="post"> 
		<textarea name="message" rows="8" cols="45" placeholder="Votre réponse"></textarea><br/>
		<input type="submit" name="envoye" value="Envoyer"><br/>
	</form>	
	<?php
	if(isset($_POST['envoye'])){
		extract($_POST);
		if (!empty($message)){
			$requete = $bdd->prepare("INSERT INTO reponse(id_demande, role, texte) VALUES(:id_demande, :role, :texte)");
			$requete->execute([':id_demande' => $_GET['id'], ':role' => 'Eleve', ':texte' => $message]);
		}
	}

		$reponses = $bdd->prepare("SELECT * FROM reponse WHERE id_demande = :id ORDER BY id DESC");
		$reponses ->execute([':id' => $_GET['id']]);
		$modif = $bdd->prepare("UPDATE aide SET etat = 'En attente' WHERE id = :id");
		$modif->execute([':id' => $_GET['id']]);

		while ($reponse = $reponses->fetch()){

			if ($reponse['role'] == 'Expert'){
				echo "reponse de l'expert ";
				}

			else {
				echo 'votre reponse ';
			}

			echo '('.$reponse['date'].') <br/>';
			echo $reponse['texte'].'<br/><br/>';

		}
		$aides = $bdd->prepare("SELECT * FROM aide WHERE id = :id");
		$aides ->execute([':id' => $_GET['id']]);
		$aide = $aides->fetch();
		echo "Message d'origine : ".$aide['texte'];
	}

	else{
		echo "Vous n'y avez pas acces";
	}
}
?>
</div>
</body>
</html>