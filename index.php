<?php


/*	if( !empty($_GET['nbMaxMess']) ){
		setcookie('NbMaxMsg', $_GET["nbMaxMess"], time() + 365*24*3600);
	}
	else
	{
		setcookie('NbMaxMsg', 10, time() + 365*24*3600); 
	}

	elseif ( !empty($_GET['pseudo']) ){
		setcookie('pseudonyme', $_GET["pseudo"], time() + 365*24*3600);
	}
	*/
?>


<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="chat.css" />
		<meta charset="UTF-8"/>
		<title> Mon site | Chat </title>
	</head>
	
	<body>
		<p class='CHAT'> CHAT </p>


<!-- Formulaire -->
		<form method="post" action="cible_newMessage.php">
			<fieldset>
			<p> Message <label><input class="champSaisieTexte" type="text" name="message" /></label></p>
			<p> Pseudo <label><input type="text" name="pseudo" /></label></p>

			<p><label><input class='envoyer' type="submit" value="Envoyer"  /></label></p>	
			</fieldset>
		</form>



	<p class='barre'> </p>
		
<?php
		
		// connexion à la bd 
			try
			{
				$bdd = new PDO('mysql:host=localhost;dbname=chat','root','tdlepd2803', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
				}
				catch(Exception $e1)
				{
					die('Erreur : '.$e1->getMessage());
				}

// recuperer les derniers messages
	if(isset($_COOKIE['NbMaxMsg']))
	{
		// on recupère l'id MAX des messages
			$repIdMessMax=$bdd->query('SELECT MAX(id) FROM messages'); 
			$idMessMax= $repIdMessMax->fetch();	

		// on le soustrait par le nb de messages que l'on veut afficher						   
			$idMin=$idMessMax['MAX(id)'] - $_COOKIE['NbMaxMsg'];		  
				
		// on récupère les derniers messages (à partir de Max(id) - le nb que l'on veut)
			$query='SELECT dateMessage,pseudo,texte FROM messages WHERE id>"'.$idMin.'" ' ;		
			$repLastMess=$bdd->query($query);
	
		// on affiche chaque message
			while($donnees=$repLastMess->fetch())
			{
				echo '<p class="policeUbuntu" >'.$donnees['dateMessage'].' '.' <strong>' . htmlspecialchars($donnees['pseudo']) . '</strong> : ' .
				  	 htmlspecialchars($donnees['texte']) . '</p>';
			}
		
			$repLastMess->closeCursor();
	}
?>
				
		<p class='barre'> </p>

		<form class="setNbMsg" method="post" action="cible_newMessage.php">
			<p> Nombre de message visible <label><input class="nbMess" name="nbMaxMess" type="number" /></label></p>
			
			<p><label><input class='envoyer' type="submit" value="OK"  /></label></p>
			
		</form>



	</body>
</html>