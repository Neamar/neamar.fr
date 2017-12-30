<?php
$Titre='SpammySMS : envoyer des spams SMS via Android';
$Box = array("Auteur" => "Neamar","Date" => "Nov. 2009");
$codeAreUTF8=true;

include('../header.php');
//include('../Typo/Typo.php');
?>
<h1><?php echo $Titre; ?></h1>
<p class="auteur"><?php echo $Box['Auteur']; ?></p>
<p class="erreur">SpammySMS est une application ProofOfConcept pour m'entraîner au développement sur Android. Il est fort probable que l'application contiennent des <em>memory leaks</em> ou autres, et je m'en excuse.</p>

<h2>Présentation</h2>
<p>L'application pour téléphones Android <tt>SpammySMS</tt> permet d'envoyer en boucle des SMS à un destinataire.<br />
Elle se veut drôle et n'est pas destinée à une attaque par <abrev title="Denial Of Service">DoS</abrev> sur un mobile ;)</p>
<p>L'utilisateur configure la victime, le message spam, et le nombre de répétitions, puis clique sur OK... et vole, petit spam ! Bienvenue dans le monde merveilleux des spammeurs, même s'il ne tient qu'à vous de ne pas vendre de v1agrA ou de ne pas proposer "un changmeent dans l'expériance PayPale". Innovez, amusez-vous... mais restez raisonnable : souvenez-vous que ce n'est qu'un jeu, et que l'humour est un plat qui se sert froid... et peu souvent !</p>

<h2>Téléchargement</h2>
<p><img src="Images/icon.png"><p class="erreur">Pour télécharger l'application, <a href="SpammySMS.apk">cliquez sur ce lien</a>.</p>
<p>L'installation hors market Android nécessite de modifer les paramètres du téléphone pour l'installation d'applications de sources inconnues : dans <tt>Paramètres</tt>, cliquez sur <tt>Paramètres des applications</tt> puis cochez <tt>Sources inconnues</tt>.</p>

<h3>Astuce</h3>
<p>Dans le champ message, vous pouvez utiliser les valeurs joker <tt>%i</tt> et <tt>%l</tt> qui seront respectivement remplacés par le nombre de SMS envoyés / le nombre de SMS restants.</p>

<h2>Captures d'écran</h2>
<p>Ces captures d'écran proviennent de l'émulateur Android sur PC.<br />
L'application a été testée sur un téléphone Samsung Galaxy, Android 1.5.</p>

<?php
$Scenes=array('Lancement de l\'application SpammySMS','Écran d\'accueil','Choix de la victime qui recevra le spam SMS Android','Entrée du message spam','Choix du nombre de SMS à envoyer','Envoi des SMS','De l\'autre côté du miroir : réception des SMS');
for($i=0;$i<count($Scenes);$i++)
{
	echo '<h3>' . $Scenes[$i] . '</h3>
	<p><img src="Images/SpammySMS' . ($i+1) . '.png" alt="' . $Scenes[$i] . '" /></p>
	';
}
?>

<h2>Codes sources</h2>
<h3>Manifest</h3>
<p>Déclare l'icone et les permissions nécessaires à l'éxécution de SpammySMS.</p>
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
<p>Déclare la structure de l'interface.</p>
<?php
InclureCode('main.xml','xml');
?>

<?php
include('../footer.php');
?>
