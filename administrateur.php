<?php
session_start(); // On démarre la session AVANT toute chose
?>

<!DOCTYPE html>
<html>
<head>
	<title>Page administrateur</title>
</head>
<body>


	<?php
		include 'database.php';
		global $bdd;
	?>

	<form method="post">
		<input type="text" name="pseudo" id="pseudo" placeholder="pseudo" required><br/>
		<input type="text" name="password" id="password" placeholder="mot de passe" required><br/>
		<input type="text" name="nom" id="nom" placeholder="nom" required><br/>
		<input type="text" name="prenom" id="prenom" placeholder="prenom" required><br/>
		<input type="text" name="role" id="role" placeholder="role" required><br/>
		<input type="email" name="email" id="email" placeholder="email" required><br/>
		<input type="submit" name="envoye" id="envoye"><br/>
	</form>

	<?php

		if(isset($_POST['envoye'])){

			extract($_POST);

			if (!empty($pseudo) && !empty($password) && !empty($nom) && !empty($prenom) && !empty($role) && !empty($email)){

				$options = ['cost' => 12,];
				$passwordCode = password_hash($password, PASSWORD_BCRYPT, $options);

				$verifEmail = $bdd->prepare("SELECT email FROM utilisateurs WHERE email = :email");
				$verifEmail->execute(['email' => $email]);
				$emailExiste = $verifEmail->rowCount();

				$verifPseudo = $bdd->prepare("SELECT pseudo FROM utilisateurs WHERE pseudo = :pseudo");
				$verifPseudo->execute(['pseudo' => $pseudo]);
				$pseudoExiste = $verifPseudo->rowCount();

				if(($emailExiste == 0) and ($pseudoExiste == 0)){
					$requete = $bdd->prepare("INSERT INTO utilisateurs(pseudo, password, nom, prenom, role, email) VALUES(:pseudo, :password, :nom, :prenom, :role, :email)");
					$requete->execute(['pseudo' => $pseudo, 'password' => $passwordCode, 'nom' => $nom, 'prenom' => $prenom, 'role' => $role, 'email' => $email]);
				}
				else{
					if ($pseudoExiste != 0){
						echo "Ce Pseudo existe deja <br/>";
					}				
					if ($emailExiste != 0){
						echo "Cet email existe deja <br/>";
					}
				}
			}
		}
	?>

	<p> Cette page sert aux administrateur pour créer de nouveaux comptes utilisateurs </p>

</body>
</html>
