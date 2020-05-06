<form method="post"> 
	<select name="domaine" multiple>
  		<optgroup label="domaine">
  			<?php
	  			$selectExpert = $bdd->prepare("SELECT * FROM utilisateurs WHERE role = :role AND domaine = :domaine");
				$selectExpert->execute([':role' => "Expert", 'domaine' => $demande['domaine']]);
				while($exp = $selectExpert->fetch()){
			?>
		    		<option value=<?php echo $exp['nom'] ?>><?php echo $exp['nom'] ?></option>
				<?php } ?>
  		</optgroup>
  	</select><br/>	
	<input type="submit" name=<?php echo "Valeur".$demande['id'] ?> value="Valeur"><br/>
</form>

<?php
if(isset($_POST["Valeur".$demande['id']])){
	if (!empty($_POST['domaine'])){
		echo $_POST['domaine'];
	}
}
?>
