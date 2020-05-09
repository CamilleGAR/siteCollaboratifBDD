<form method="post"> 
	<select name="expert" multiple>
  		<optgroup label="expert">
  			<?php
	  			$selectExpert = $bdd->prepare("SELECT * FROM utilisateurs WHERE role = :role AND domaine = :domaine");
				$selectExpert->execute([':role' => "Expert", 'domaine' => $demande['domaine']]);
				while($exp = $selectExpert->fetch()){
			?>
		    		<option value=<?php echo $exp['pseudo'] ?>><?php echo $exp['nom']." ".$exp['prenom'] ?></option>
				<?php } ?>
  		</optgroup>
  	</select><br/>	
	<input type="submit" name=<?php echo "Valeur".$demande['id'] ?> value="Attribuer expert"><br/>
</form>

<?php
if(isset($_POST["Valeur".$demande['id']])){
	if (!empty($_POST['expert'])){
		$modif = $bdd->prepare("UPDATE aide SET expert = :expert, professeur = :professeur, etat = 'En attente' WHERE id = :id");
		$modif->execute([':expert' => $_POST['expert'],':professeur' => $_SESSION['pseudo'], ':id' => $demande['id']]);
		header("Refresh:0");
	}
}
?>
