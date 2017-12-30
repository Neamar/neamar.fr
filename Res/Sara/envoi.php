<?php
session_start();
$Titre='Envoi du mail';
$Box = array("Auteur" => "Neamar","Date" => "2009");
include('../header.php');
include('../../ConnectBDD.php');
include('../Typo/Typo.php');

//define("FIN_MAIL",'');
define("FIN_MAIL",'
<p>
<small>Ce message a été envoyé par <a href="http://neamar.fr/Res/Mail">http://neamar.fr/Res/Mail</a> : piégez vos amis en leur envoyant de faux emails !<br />
Ce mail ne vous a pas fait sourire du tout ? Son contenu était insultant, diffamatoire, ou simplement hors propos ? Faites le moi savoir en me contactant via http://neamar.fr/Mail.php.
Adresse IP de l\'expéditeur : ' . $_SERVER['REMOTE_ADDR'] . '</small>
</p>');

if(count($_POST)!=0)
{
	if(!preg_match('#^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$#Ui',$_POST['Exp_mail']) || !preg_match('#^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$#Ui',$_POST['Dest_mail']) || strlen($_POST['Message'])>1000 || strlen($_POST['Sujet'])>100)
	{
		echo '<h1>Abandon de l\'envoi</h1>';
		echo "<p>Votre mail n'a pas été envoyé. Causes possibles : adresse email incorrecte, message trop long...";
		exit();
	}

	//On va envoyer le mail.
	//On commence par l'enregistrer en BDD :
	mysql_query('INSERT INTO TYPO_Textes VALUES
	(
	\'\',
	\'' . $_POST['Sujet'] . '\',
	\'' . $_POST['Message'] . '\',
	\'' . $_SERVER['REMOTE_ADDR'] . '\',
	\'Le ' . date('l jS \of F Y h:i:s A') . ' de ' . $_POST['Exp_mail'] . '(' . $_POST['Exp_nom'] . ') à ' . $_POST['Dest_mail'] . '\'
	)');

	//Puis on vérifie qu'il ne spamme pas
	if(!isset($_SESSION['MailSent']))
		$_SESSION['MailSent']=1;
	else
		$_SESSION['MailSent']++;
	if($_SESSION['MailSent']>10)
	{
		echo '<h1>Vous avez utilisé tous vos mails.</h1>';
		exit();
	}

	$to  = $_POST['Dest_mail'];

	// Sujet
	$subject = htmlentities(stripslashes($_POST['Sujet']));

	// message
	Typo::setTexte(stripslashes($_POST['Message']));
	$message = Typo::Parse() . '

	<hr />' . FIN_MAIL;

	// Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// En-têtes additionnels
	$headers .= 'From: ' . $_POST['Exp_nom'] . ' <' . $_POST['Exp_mail'] . "\r\n";
	// Envoi
	if(mail($to, $subject, $message, $headers))
		echo '<h1>E-mail envoyé  !</h1><p>Votre email a bien été envoyé à <strong>' . $_POST['Dest_mail'] .'</strong></p>';
	else
		echo '<h1>ERREUR  !</h1><p>Le message n\'est pas parti.<br />' . $_POST['Message'] . '</p>';

	echo '<p>Votre message est publiquement accessible depuis <a href="/Res/Typo/show.php?ID=' . mysql_insert_id() . '"> cette page</a>.<br />

	Le message suivant a été automatiquement rajouté à la fin de votre mail :</p>';
	echo FIN_MAIL;
}

include('../footer.php');
?>
