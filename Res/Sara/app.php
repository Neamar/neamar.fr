<?php
session_start();
include('../../ConnectBDD.php');

if(count($_POST)!=0)
{
	//On va envoyer le mail.
	//On commence par l'enregistrer en BDD :
	if($_POST['use_log'])
	{
		mysql_query('INSERT INTO TYPO_Textes VALUES
		(
		\'\',
		\'' . $_POST['subject'] . '\',
		\'' . $_POST['message'] . '\',
		\'' . $_SERVER['REMOTE_ADDR'] . '\',
		\'Le ' . date('l jS \of F Y h:i:s A') . ' de ' . $_POST['from'] . ' à ' . $_POST['to'] . '\'
		)');
	}

	//Puis on vérifie qu'il ne spamme pas
	if(!isset($_SESSION['MailSent']))
		$_SESSION['MailSent']=1;
	else
		$_SESSION['MailSent']++;

	if($_SESSION['MailSent']>1000)
	{
		exit('fail');
	}

	$to = $_POST['to'];

	// Sujet
	$subject = htmlentities(stripslashes($_POST['subject']));

	// message
	$message = stripslashes($_POST['message']);

	// En-têtes additionnels
	$headers .= 'From: '  . $_POST['from'] . "\r\n";
	// Envoi
	if(mail($to, $subject, $message, $headers))
		exit('OK');
	else
		exit('fail');
}
?>
