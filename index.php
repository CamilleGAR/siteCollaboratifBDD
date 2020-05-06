<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Titre</title>
</head>
<body>

	<?php
		include 'database.php';
		global $bdd;
	?>

	<p>Indentification<p>
	<form method="post"> 
		<input type="text" name="pseudo" id="pseudo" placeholder="pseudo" required><br/>
		<input type="text" name="password" id="password" placeholder="mot de passe" required><br/>
		<input type="submit" name="envoye" id="envoye" value="S'identifier"><br/>
	</form>

	<a href="administrateur.php">Page Admin </a>

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

						if ($_SESSION['role'] == Administrateur){
							header('Location: administrateur.php');
  							exit();
						}
						if ($_SESSION['role'] == Expert){
							header('Location: expert.php');
  							exit();
						}
						if ($_SESSION['role'] == Professeur){
							header('Location: professeur.php');
  							exit();
						}
						if ($_SESSION['role'] == Eleve){
							header('Location: eleve.php');
  							exit();
						}
				}

				else{
					echo 'Mauvais identifiants';
				}

			}

			else{
				echo "champs vides";
			}

		}

	?>

</body>
</html>
