<?php
$Titre='SpammySMS : envoyer des spams SMS via Android';
$Box = array("Auteur" => "Neamar","Date" => "Nov. 2009");
$codeAreUTF8=true;

include('../header.php');
//include('../Typo/Typo.php');
?>
<h1><?php echo $Titre; ?></h1>
<p class="auteur"><?php echo $Box['Auteur']; ?></p>
<p class="erreur">SpammySMS est une application ProofOfConcept pour m'entra�ner au d�veloppement sur Android. Il est fort probable que l'application contiennent des <em>memory leaks</em> ou autres, et je m'en excuse.</p>

<h2>Pr�sentation</h2>
<p>L'application pour t�l�phones Android <tt>SpammySMS</tt> permet d'envoyer en boucle des SMS � un destinataire.<br />
Elle se veut dr�le et n'est pas destin�e � une attaque par <abrev title="Denial Of Service">DoS</abrev> sur un mobile ;)</p>
<p>L'utilisateur configure la victime, le message spam, et le nombre de r�p�titions, puis clique sur OK... et vole, petit spam ! Bienvenue dans le monde merveilleux des spammeurs, m�me s'il ne tient qu'� vous de ne pas vendre de v1agrA ou de ne pas proposer "un changmeent dans l'exp�riance PayPale". Innovez, amusez-vous... mais restez raisonnable : souvenez-vous que ce n'est qu'un jeu, et que l'humour est un plat qui se sert froid... et peu souvent !</p>

<h2>T�l�chargement</h2>
<p><img src="Images/icon.png"><p class="erreur">Pour t�l�charger l'application, <a href="SpammySMS.apk">cliquez sur ce lien</a>.</p>
<p>L'installation hors market Android n�cessite de modifer les param�tres du t�l�phone pour l'installation d'applications de sources inconnues : dans <tt>Param�tres</tt>, cliquez sur <tt>Param�tres des applications</tt> puis cochez <tt>Sources inconnues</tt>.</p>

<h3>Astuce</h3>
<p>Dans le champ message, vous pouvez utiliser les valeurs joker <tt>%i</tt> et <tt>%l</tt> qui seront respectivement remplac�s par le nombre de SMS envoy�s / le nombre de SMS restants.</p>

<h2>Captures d'�cran</h2>
<p>Ces captures d'�cran proviennent de l'�mulateur Android sur PC.<br />
L'application a �t� test�e sur un t�l�phone Samsung Galaxy, Android 1.5.</p>

<?php
$Scenes=array('Lancement de l\'application SpammySMS','�cran d\'accueil','Choix de la victime qui recevra le spam SMS Android','Entr�e du message spam','Choix du nombre de SMS � envoyer','Envoi des SMS','De l\'autre c�t� du miroir : r�ception des SMS');
for($i=0;$i<count($Scenes);$i++)
{
	echo '<h3>' . $Scenes[$i] . '</h3>
	<p><img src="Images/SpammySMS' . ($i+1) . '.png" alt="' . $Scenes[$i] . '" /></p>
	';
}
?>

<h2>Codes sources</h2>
<h3>Manifest</h3>
<p>D�clare l'icone et les permissions n�cessaires � l'�x�cution de SpammySMS.</p>
<?php
InclureCode('AndroidManifest.xml','xml');
?>

<h3>MainScreen</h3>
<p>L'interface de l'application, gestion des clics et autres.</p>
<?php
InclureCode('MainScreen.java','java',false,true);
?>

<h3>SMSHandler</h3>
<p>Gestion de l'envoi des SMS.</p>
<?php
InclureCode('SMSHandler.java','java',false,true);
?>

<h3>Layout</h3>
<p>D�clare la structure de l'interface.</p>
<?php
InclureCode('main.xml','xml');
?>

<?php
include('../footer.php');
?>
