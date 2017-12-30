<?php
$Titre='Code de Don\'t Click';
$codeAreUTF8=true;
$Box = array("Auteur" => "Neamar","Date" => "Aout 2008","Voir aussi"=>'<a href="../Compiler_AS3">Compiler l\'AS3</a>',"Retour"=>'<a href="./">Retour au jeu</a>');
include('../header.php');
?>
<h1>Rapidit� et strat�gie : Don't Click</h1>
<p>Ce jeu flash a �t� d�velopp� � l'aide de FlashDevelop, un puissant IDE gratuit pour Flash, mais malheureusement non disponible sous Linux.<br />
Le jeu a donc �t� d�velopp� sous un Windows XP virtualis� par VirtualBox OSE (Wine ne fonctionnant pas pour FlashDevelop, ou plut�t : Wine ne supportant pas le framework .NET2.0 n�cessaire � l'utilisation de FlashDevelop).<br />
<h3>Licence</h3>
<p class="erreur">Ce code est fourni sous une licence CC-By (cf. fin de page).<br />
De plus, il est interdit de recompiler le jeu "tel quel" en supprimant le lien �Plus de jeux�, la mention �tel quel� restant � l'appr�ciation de l'auteur original du code source (copie, plagiat...).</p>
<h3>� propos du code</h3>
<p>Vous pouvez g�n�rer la documentation du code via l'outil asdoc distribu� par d�faut avec le Flex SDK.</p>
<h2>Ressources ench�ss�es</h2>
<ul>
	<li><a href="./Assets/Curseur.png">Curseur.png</a> ;</li>
	<li><a href="./Assets/Labyrinthe.svg">Labyrinthe.svg</a> ;</li>
	<li><a href="./Assets/Sun.svg">Sun.svg</a> ;</li>
</ul>

<p>J'utilise l'excellent <a href="http://blog.greensock.com/tweenmax/">TweenMax</a> de Greensock pour la gestion des animations.</p>
<h2>Classes de Don't Click</h2>
<h3>Fichiers de bases :</h3>
<h4>Main</h4>
<?php
InclureCode('Main.as','actionscript3');
?>
<h4>Anneaux</h4>
<?php
InclureCode('Niveaux/Ring.as','actionscript3');
?>
<h3>Niveaux</h3>
<h4>Niveaux sp�ciaux</h4>
<p>Il s'agit des niveaux "m�re" dont tous les autres peuvent h�riter.</p>
<?php
InclureCode('Niveaux/Level.as','actionscript3');
?>

<p>Tous les niveaux "� obstacle" h�ritent de HitLevel.</p>
<?php
InclureCode('Niveaux/HitLevel.as','actionscript3');
?>

<p>Tous les niveaux "sans curseur" h�ritent de HiddenLevel.</p>
<?php
InclureCode('Niveaux/HiddenLevel.as','actionscript3');
?>

<p>Tous les niveaux "� curseur sp�cial" h�ritent de SpecialCursor.</p>
<?php
InclureCode('Niveaux/SpecialCursor.as','actionscript3');
?>

<p>Les deux niveaux labyrinthe � la fin h�ritent de LabyLevel.</p>
<?php
InclureCode('Niveaux/LabyLevel.as','actionscript3');
?>

<p>Le niveau qui s'affiche quand on perd.</p>
<?php
InclureCode('Niveaux/LevelLost.as','actionscript3');
?>
<h4>Liste des niveaux</h4>
<?php
for($i=1;$i<21;$i++)
	InclureCode('Niveaux/Level_' . $i . '.as','actionscript3');
?>


<?php
include('../footer.php');
?>