
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

		// Gestion du pseudo
		if(!isset($_COOKIE['pseudonyme'])) {
			if (!empty($_POST['pseudo'])) {
				setcookie('pseudonyme', $_POST['pseudo'], time() + 365 * 24 * 3600);
			}
		}

		// Rediretion
		header('Location: index.php');
	}

// Gestion du nombre de message visible
	else if (!empty($_POST['nbMaxMess']) ) {
		unset($_COOKIE['nbMaxMess']);
		setcookie('nbMaxMsg',$_POST['nbMaxMess'], time() + 365 * 24 * 3600);
	}
	else { if ( !empty($_COOKIE['nbMaxMsg'] )) 	{ setcookie('nbMaxMsg', 10 , time() + 365 * 24 * 3600); }}

 header('Location: index.php');

?>z