<?php
$Titre='Modification des subtilit�s';

include('../header.php');

if(!isset($_POST['Modif']))
{
?>
<h1>Proposer une modification !</h1>
<form method="post" action="">
<input type="hidden" value="1" name="Modif" />
<input type="hidden" value="<?php echo stripslashes(implode(' ',$_POST)); ?>" name="Origine" />
<p>Texte � modifier :</p><p class="erreur"><?php echo stripslashes(str_replace('|','"',implode(" ",$_POST))); ?></p>
<p><textarea cols="80" rows="30" name="Proposition">Quelle subtilit� ajouter ? Marquez vos id�es ici...</textarea><br />
Votre mail (facultatif, permet de vous tenir inform� si votre modification est accept�e) : <input type="text" value="Votre mail" name="Expediteur" /><br />
<input type="submit" value="Proposer ma modification" /></p>
<?php
}
else
{
	$to  = 'neamar@neamar.fr';

	if(!preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#',$_POST['Expediteur']))
		$Expediteur='neamar@neamar.fr';
	else
		$Expediteur=$_POST['Expediteur'];

	// Sujet
	$subject = 'Modifications Saga';

	// message
	$message = '<strong>Exp�diteur</strong> : ' . $_POST['Expediteur'] . "\n" .
	'<br />Concerne : ' . $_POST['Origine'] . "\n" .
	'<br /><br /><br />Proposition :' . stripslashes($_POST['Proposition']);

	// Pour envoyer un mail HTML, l'en-t�te Content-type doit �tre d�fini
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// En-t�tes additionnels
	$headers .= 'From:' . $Expediteur . "\r\n";
	// Envoi
	if(mail($to, $subject, $message, $headers))
		echo '<h1>E-mail envoy�  !</h1><p><strong>En th�orie</strong>, je r�ponds rapidement pour ces modifications...comptez un maximum de 48 heures, sauf en p�riodes de vacances, WE ou sortie d\'�pisode ;)</p>';
	else
		echo '<h1>ERREUR  !</h1><p>Le message n\'est pas parti.<br />' . $_POST['Proposition'] . '</p><p>Merci de r�essayer dans quelques minutes.</p>';
}

include('../footer.php');
?>
