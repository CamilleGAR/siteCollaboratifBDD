<?php

if ($_SESSION['role'] == 'Expert'){

	echo "Demandes en attentes <br/><br/>";
	$demandesEnvoyees = $bdd->prepare("SELECT aide.id, utilisateurs.nom, utilisateurs.prenom FROM aide, utilisateurs WHERE aide.expert = :expert AND aide.eleve = utilisateurs.pseudo AND etat = 'En attente'");
	$demandesEnvoyees ->execute([':expert' => $_SESSION['pseudo']]);
	while ($demande = $demandesEnvoyees->fetch()){
		?>
		<a href = <?php echo 'dossier.php?id='.$demande['id'] ?> > <?php echo 'demande de '.$demande['prenom'].' '.$demande['nom'].'<br/>'?> </a>
		<?php
	}
	echo "Reponses envoyées <br/><br/>";
	$demandesEnvoyees = $bdd->prepare("SELECT aide.domaine, aide.id FROM aide, utilisateurs WHERE aide.expert = :expert AND aide.eleve = utilisateurs.pseudo AND etat = 'Reponse recue'");
	$demandesEnvoyees ->execute([':expert' => $_SESSION['pseudo']]);
	while ($demande = $demandesEnvoyees->fetch()){
		?>
		<a href = <?php echo 'dossier.php?id='.$demande['id'] ?> > <?php echo 'demande en '.$demande['domaine'].'<br/>'?> </a>
		<?php
	}
}

?>


<?php

if ($_SESSION['role'] == 'Eleve'){

	echo "Reponses reçues <br/><br/>";
	$demandesEnvoyees = $bdd->prepare("SELECT aide.domaine, aide.id FROM aide, utilisateurs WHERE aide.eleve = :eleve AND aide.eleve = utilisateurs.pseudo AND etat = 'Reponse recue'");
	$demandesEnvoyees ->execute([':eleve' => $_SESSION['pseudo']]);
	while ($demande = $demandesEnvoyees->fetch()){
		?>
		<a href = <?php echo 'dossier.php?id='.$demande['id'] ?> > <?php echo 'demande en '.$demande['domaine'].'<br/>'?> </a>
		<?php
	}

	echo "Demandes assignées, en attente de réponse. <br/><br/>";
	$demandesEnvoyees = $bdd->prepare("SELECT aide.domaine, aide.id FROM aide, utilisateurs WHERE aide.eleve = :eleve AND aide.eleve = utilisateurs.pseudo AND etat = 'En attente'");
	$demandesEnvoyees ->execute([':eleve' => $_SESSION['pseudo']]);
	while ($demande = $demandesEnvoyees->fetch()){
		?>
		<a href = <?php echo 'dossier.php?id='.$demande['id'] ?> > <?php echo 'demande en '.$demande['domaine'].'<br/>'?> </a>
		<?php
	}

	echo "Demandes envoyées. En attente d'assignation d'un expert. <br/><br/>";
	$demandesEnvoyees = $bdd->prepare("SELECT aide.domaine, aide.id FROM aide, utilisateurs WHERE aide.eleve = :eleve AND aide.eleve = utilisateurs.pseudo AND etat = 'Demande envoyee'");
	$demandesEnvoyees ->execute([':eleve' => $_SESSION['pseudo']]);
	while ($demande = $demandesEnvoyees->fetch()){
		?>
		<a href = <?php echo 'dossier.php?id='.$demande['id'] ?> > <?php echo 'demande en '.$demande['domaine'].'<br/>'?> </a>
		<?php
	}

}

?>

