<?php
$Titre='Code de Don\'t Click';
$codeAreUTF8=true;
$Box = array("Auteur" => "Neamar","Date" => "Aout 2008","Voir aussi"=>'<a href="../Compiler_AS3">Compiler l\'AS3</a>',"Retour"=>'<a href="./">Retour au jeu</a>');
include('../header.php');
?>
<h1>Rapidité et stratégie : Don't Click</h1>
<p>Ce jeu flash a été développé à l'aide de FlashDevelop, un puissant IDE gratuit pour Flash, mais malheureusement non disponible sous Linux.<br />
Le jeu a donc été développé sous un Windows XP virtualisé par VirtualBox OSE (Wine ne fonctionnant pas pour FlashDevelop, ou plutôt : Wine ne supportant pas le framework .NET2.0 nécessaire à l'utilisation de FlashDevelop).<br />
<h3>Licence</h3>
<p class="erreur">Ce code est fourni sous une licence CC-By (cf. fin de page).<br />
De plus, il est interdit de recompiler le jeu "tel quel" en supprimant le lien «Plus de jeux», la mention «tel quel» restant à l'appréciation de l'auteur original du code source (copie, plagiat...).</p>
<h3>À propos du code</h3>
<p>Vous pouvez générer la documentation du code via l'outil asdoc distribué par défaut avec le Flex SDK.</p>
<h2>Ressources enchâssées</h2>
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
<h4>Niveaux spéciaux</h4>
<p>Il s'agit des niveaux "mère" dont tous les autres peuvent hériter.</p>
<?php
InclureCode('Niveaux/Level.as','actionscript3');
?>

<p>Tous les niveaux "à obstacle" héritent de HitLevel.</p>
<?php
InclureCode('Niveaux/HitLevel.as','actionscript3');
?>

<p>Tous les niveaux "sans curseur" héritent de HiddenLevel.</p>
<?php
InclureCode('Niveaux/HiddenLevel.as','actionscript3');
?>

<p>Tous les niveaux "à curseur spécial" héritent de SpecialCursor.</p>
<?php
InclureCode('Niveaux/SpecialCursor.as','actionscript3');
?>

<p>Les deux niveaux labyrinthe à la fin héritent de LabyLevel.</p>
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