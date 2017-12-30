<?php
$Titre='Envoi de mails';
$Box = array("Auteur" => "Neamar","Date" => "2009");

include('../header.php');
include('../Typo/Typo.php');

?>
<h1><?php echo $Titre; ?></h1>
<p class="auteur">Neamar</p>

<p class="erreur">Une application Android, sans limitation sur le nombre d'envoi et sans message de publicité final est disponible <a href="https://play.google.com/store/apps/details?id=fr.neamar.spoofmail">ici</a>.</p>

<form method="post" action="envoi.php">
<p>
<label for="Sujet">Sujet du mail :</label>
<input type="text" name="Sujet" id="Sujet" /><br />

<label for="Exp_nom">Nom de l'expéditeur :</label>
<input type="text" name="Exp_nom" id="Exp_nom" /><br />

<label for="Exp_mail">Mail de l'expéditeur :</label>
<input type="text" name="Exp_mail" id="Exp_mail" /><br />

<label for="Dest_mail">Mail du destinataire :</label>
<input type="text" name="Dest_mail" id="Dest_mail" /><br /></p>

<p>Vous pouvez utiliser plusieurs balises de mise en forme, mais pas de langage HTML. Les balises HTML seront transformées en texte.</p>
<?php
Typo::setTexte('');
Typo::renderIDE(array('Name'=>'Message','Rows'=>10));
?><br />

<input type="button" value="Envoyer le mail" onclick="document.getElementById('Disclaimer').style.display='block';"/>
<div id="Disclaimer" class="erreur" style="display:none;">
	<p>En envoyant ce mail, vous vous engagez :</p>
	<ul>
		<li>À ne pas envoyer d'informations compromettantes ;</li>
		<li>À ne pas envoyer de données pouvant nuire au destinataire de ce message, ou à l'expéditeur fictif ;</li>
		<li>À n'utiliser ce service que dans un but humoristique.</li>
	</ul>

	<p>Vous êtes conscients que :</p>
	<ul>
		<li>Le nombre d'envoi de mail via ce site est limité à 10 par adresse IP ;</li>
		<li>Votre message est <strong>stocké</strong> en base de données, ainsi que votre adresse IP (<?php echo $_SERVER['REMOTE_ADDR']; ?>). Ces informations seront fournies à toute personne compétente en cas d'abus lors de l'utilisation de ce service, et seront librement disponible depuis ce site pour tous les visiteurs ;</li>
		<li>Votre message se verra envoyé accompagné d'une petite note en fin de mail précisant qu'il s'agit d'un canular.</li>
	</ul>

	<p><em>Que dit la loi ?</em>
	Actuellement, l'usurpation d'identité en elle-même n'est pas un délit pénal, excepté s'il y a utilisation de fausse identité dans un acte authentique ou un document administratif destiné à l'autorité publique (art. 433-19 du Code pénal), ou si un faux nom a été utilisé pour se faire établir un extrait de casier judiciaire (art. 781 du Code pénal).</p>

	<p><input type="submit" value="J'ai lu et compris le texte ci dessus, procéder à l'envoi" /></p>

</div>
</form>

<?php

include('../footer.php');
?>
