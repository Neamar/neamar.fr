<?php
session_start();
$titre='Envoi de mail à neamar';

$menus = array ("Sites Web","Programmes");

include('header.php');

if(!isset($_POST['Captcha']))
{
$_SESSION['Captcha']=rand(1,100);
?>
<h1>Contact</h1>
<p>Vous souhaitez me contacter ? Que ce soit pour m'abreuver d'insultes, ou pour me noyer sous les compliments, n'hésitez pas !</p>
<form method="post" action="">
<p>Combien vaut <?php echo (2*$_SESSION['Captcha']); ?> divisé par 2 ? : <input type="text" name="Captcha" size="3" maxlength="3" /><br />
Votre adresse mail : <input type="text" name="Expediteur" /><br />
Le site dont vous souhaitez parler :<br />
<input type="radio" name="Site" value="CCDS" id="CCDS"/> <label for="CCDS"><a href="http://ccds.neamar.fr">Ca coule de source</a></label><br />
<input type="radio" name="Site" value="FREE" id="FREE" /> <label for="FREE"><a href="http://neamar.free.fr/txt2jpg">TXT2JPG</a></label><br />
<input type="radio" name="Site" value="INSA" id="INSA"/> <label for="INSA"><a href="http://insa.neamar.fr">INSA</a></label><br />
<input type="radio" name="Site" value="LACHAL" id="LACHAL"/> <label for="LACHAL"><a href="http://lachal.neamar.fr">Dictionnaire lachalien</a></label><br />
<input type="radio" name="Site" value="RES" id="RES"/> <label for="RES"><a href="http://neamar.fr/res">Section ressources de neamar.fr</a></label><br />
<input type="radio" name="Site" value="REFLETS" id="REFLETS"/><label for="REFLETS">La liste des ressources concernant Reflets d'acide</label><br />
<input type="radio" name="Site" value="ADOPRIXTOXIS" id="ADOPRIXTOXIS"/><label for="ADOPRIXTOXIS">La liste des ressources concernant Adoprixtoxis</label><br />
<input type="radio" name="Site" value="JEU" id="JEU"/><label for="JEU">Les jeux flash sur le site</label><br />
<input type="radio" name="Site" value="AUTRE" id="AUTRE"/><label for="AUTRE">Un autre site // architecture générale des websites</label><br />

Votre message :<br />
<textarea name="Message" id="Message" rows="10" cols="50"></textarea>
<br />
<input type="submit" value="Envoyer" />
</p>
</form>
<?php
}
elseif($_SESSION['Captcha']!=$_POST['Captcha'])
	echo 'Vous n\'avez pas rentré le bon code de validation.';
elseif(isset($_SESSION['MailSent']))
	echo 'Un seul mail, merci !';
else
{
	$_SESSION['MailSent']=1;
	$to  = 'neamar@neamar.fr';

	// Sujet
	$subject = 'Mail || ' . $_POST['Site'];

	// message
	$message = '<strong>Expéditeur</strong> : ' . $_POST['Expediteur'] . "\n" .
	'<br />' . stripslashes($_POST['Message']);

	// Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// En-têtes additionnels
	$headers .= 'From: ' . $_POST['Expediteur'] . "\r\n";
	// Envoi
	if(mail($to, $subject, $message, $headers))
		echo '<h1>E-mail envoyé  !</h1><p><strong>En théorie</strong>, je réponds rapidement à mes mails...comptez un maximum de 48 heures, sauf en périodes de vacances et WE.</p>';
	else
		echo '<h1>ERREUR  !</h1><p>Le message n\'est pas parti.<br />' . $_POST['Message'] . '</p>';
}
?>
</div>
</body>
</html>
