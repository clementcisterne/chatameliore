<!--  Inserer le msg dans la bdd  -->
<?php


// Connexion à la base de données
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=chat;charset=utf8','root','tdlepd2803', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}
	catch(Exception $e1){
		die('Erreur : '.$e1->getMessage());
	}

	if(  ($_POST['pseudo']) != NULL AND ($_POST['message']) != NULL )
	{	




// Insertion du message (requete préparée)
		$req=$bdd->prepare(' INSERT INTO messages (pseudo,texte) VALUES(?,?) ');
		$req->execute(array($_POST['pseudo'] , $_POST['message']));

// Redicretion
		#$t=$_POST['nbMaxMess'];
		header('Location: chat.php');

	}
	else
	{
		#$t=$_POST['nbMaxMess'];
		header('Location: chat.php');
	}



?>
