<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Page de connection</title>
	<link rel="stylesheet" href="style.css" />
</head>
<body>
	<div class="topbar">
		<p>Gestion d'intervenants experts dans la formation</p>
	</div>
	</br>
	<?php
		include 'database.php';
		global $bdd;
	?>
	<div class="centeredblock">
	<h1>Indentification</h1>
	<form method="post"> 
		<input type="text" name="pseudo" placeholder="pseudo" required><br/>
		<input type="password" name="password" placeholder="mot de passe" required><br/>
		<input type="submit" name="envoye" value="S'identifier"><br/>
	</form>
	<div>

	<?php
		if(isset($_POST['envoye'])){
			extract($_POST);

			if (!empty($pseudo) && !empty($password)){

				$selectCompte = $bdd->prepare("SELECT * FROM utilisateurs WHERE pseudo = :pseudo");
				$selectCompte->execute([':pseudo' => $pseudo]);
				$compte = $selectCompte->fetch();

				if(($compte == true) && (password_verify($password, $compte['password']))){
						$_SESSION['pseudo'] = $compte['pseudo'];
						$_SESSION['nom'] = $compte['nom'];	
						$_SESSION['prenom'] = $compte['prenom'];	
						$_SESSION['role'] = $compte['role'];	
						$_SESSION['email'] = $compte['email'];
						$_SESSION['domaine'] = $compte['domaine'];

						if ($_SESSION['role'] == 'Administrateur'){
							header('Location: administrateur.php');
  							exit();
						}
						if ($_SESSION['role'] == 'Expert'){
							header('Location: expert.php');
  							exit();
						}
						if ($_SESSION['role'] == 'Professeur'){
							header('Location: professeur.php');
  							exit();
						}
						if ($_SESSION['role'] == 'Eleve'){
							header('Location: eleve.php');
  							exit();
						}
				}

				else{
					?><p id="errortext"><?php
					echo 'Mauvais identifiants';
					?></p><?php
				}

			}

			else{
				?><p id="errortext"><?php
				echo "champs vides";
				?></p><?php
			}

		}

	?>

</body>
</html>
