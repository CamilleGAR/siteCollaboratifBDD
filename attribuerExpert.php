<form method="post"> 
	<select name="domaine" multiple>
  		<optgroup label="domaine">
  			<?php
	  			$selectExpert = $bdd->prepare("SELECT * FROM utilisateurs WHERE role = :role AND domaine = :domaine");
				$selectExpert->execute([':role' => "Expert", 'domaine' => $demande['domaine']]);
				while($exp = $selectExpert->fetch()){
			?>
		    		<option value=<?php $exp['nom'] ?>><?php echo $exp['nom'] ?></option>
				<?php } ?>
  		</optgroup>
  	</select><br/>	
	<input type="submit" name="envoye" value="Envoyer"><br/>
</form>
