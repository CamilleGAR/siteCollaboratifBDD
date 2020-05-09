<?php
session_start();
include 'database.php';
global $bdd;
echo "Bonjour ".$_SESSION['prenom'];
include 'deconnection.php';



if ($_SESSION['role'] == 'Expert'){
	$demande = $bdd->prepare("SELECT * FROM aide, utilisateurs WHERE aide.eleve = utilisateurs.pseudo AND aide.id = :id AND expert = :expert");
	$demande ->execute([':id' => $_GET['id'], ':expert' => $_SESSION['pseudo']]);
	$nb = $demande->rowCount();

	if ($nb > 0){
		$getEmail = $demande->fetch();
		echo 'adresse mail de l eleve : '.$getEmail['email'];
		?>
	<form method="post"> 
		<textarea name="message" rows="8" cols="45">Réponse</textarea><br/>
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
				echo 'reponse de leleve ';
			}

			echo '('.$reponse['date'].') <br/>';
			echo $reponse['texte'].'<br/><br/>';

		}
	}

	else{
		echo 'Vous ny avez pas acces';
	}
}

if ($_SESSION['role'] == 'Eleve'){
	$demande = $bdd->prepare("SELECT * FROM aide, utilisateurs WHERE aide.expert = utilisateurs.pseudo AND aide.id = :id AND eleve = :eleve");
	$demande ->execute([':id' => $_GET['id'], ':eleve' => $_SESSION['pseudo']]);
	$nb = $demande->rowCount();

	if ($nb > 0){
		$getEmail = $demande->fetch();
		echo 'adresse mail de l expert : '.$getEmail['email'];
		?>
	<form method="post"> 
		<textarea name="message" rows="8" cols="45">Réponse</textarea><br/>
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
				echo 'reponse de lexpert ';
				}

			else {
				echo 'votre reponse ';
			}

			echo '('.$reponse['date'].') <br/>';
			echo $reponse['texte'].'<br/><br/>';

		}
	}

	else{
		echo 'Vous ny avez pas acces';
	}
}

?>
