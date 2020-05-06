<form method="post"> 
	<input type="submit" name="deconnection" value="Deconnection"><br/>
</form>

<?php
		if(isset($_POST['deconnection'])){
			session_unset();
			session_destroy();
			header('Location: index.php');
  			exit();
  		}
?>
