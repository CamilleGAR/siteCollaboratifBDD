<?php
	
	define('ADRESSE','localhost');
	define('BASEDEDONNEE', 'sitebdd');
	define('UTILISATEUR', 'root');
	define('PASSWORD', '');

	try{
		$bdd = new PDO("mysql:host=".ADRESSE.";dbname=".BASEDEDONNEE, UTILISATEUR, PASSWORD);
		$bdd->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);
	} catch(PDOException $erreur){
		echo $erreur;
	}
