<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Page administrateur</title>
	<link rel="stylesheet" type="text/css" href="administrateur.css">
</head>
<body>


	<?php
		include 'deconnection.php';
		include 'database.php';
		global $bdd;
	?>

	<form method="post">
		<input type="text" name="pseudo" placeholder="pseudo" required><br/>
		<input type="text" name="password" placeholder="mot de passe" required><br/>
		<input type="text" name="nom" placeholder="nom" required><br/>
		<input type="text" name="prenom" placeholder="prenom" required><br/>
		<select name="role" multiple>
  			<optgroup label="role">
    			<option value="Eleve" selected>eleve</option>
    			<option value="Professeur">professeur</option>
    			<option value="Expert">expert</option>
    			<option value="Administrateur">administrateur</option>
  			</optgroup>
		</select><br/>	
		<select name="domaine" multiple>
  			<optgroup label="domaine">
  				<option value="Aucun" selected>aucun</option>
    			<option value="Mathematiques">mathématiques</option>
    			<option value="Physique">physique</option>
    			<option value="Informatique">informatique</option>
    			<option value="Anglais">anglais</option>
  			</optgroup>
		</select><br/>	
		<input type="email" name="email" placeholder="email" required><br/>
		<input type="submit" name="envoye"><br/>
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
					$requete = $bdd->prepare("INSERT INTO utilisateurs(pseudo, password, nom, prenom, role, email, domaine) VALUES(:pseudo, :password, :nom, :prenom, :role, :email, :domaine)");
					$requete->execute(['pseudo' => $pseudo, 'password' => $passwordCode, 'nom' => $nom, 'prenom' => $prenom, 'role' => $role, 'email' => $email, 'domaine' => $domaine]);
					echo $nom." ".$prenom." a été ajouté à la base de donnée";
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
