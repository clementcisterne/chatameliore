
<?php

//connexion à la BDD
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=chat;charset=utf8','root','tdlepd2803', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}
	catch(Exception $e1){
		die('Erreur : '.$e1->getMessage());
	}

// Gestion des nouveaux messages
	if(  isset($_POST['pseudo']) AND isset($_POST['message']) )
	{	

	// Insertion du message (requete préparée)
		$sql=' INSERT INTO messages (pseudo,texte) VALUES(:pseudo , :message); ';
		$req=$bdd->prepare($sql);
		$req->bindParam(":pseudo",$_POST['pseudo'] );
		$req->bindParam(":message",$_POST['message'] );
		$req->execute();

	// Redicretion
		
		header('Location: index.php');

	}
	else { header('Location: index.php'); }


// Gestion du nombre de message visible
	if ( isset($_POST['nbMaxMess']) )
	{
		$t=$_POST['nbMaxMess'];
		setcookie('NbMaxMsg', $t, time() + 365*24*3600);
		header('Location: index.php');
		#header('Location: chat.php?nbMaxMess='.$t.' ');
	}
	else { echo 'ERROR'; }
?>