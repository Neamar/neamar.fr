<?php
$Titre='Code de SkyFire';
$Box = array("Auteur" => "Neamar","Date" => "Aout 2008", "But" =>"Finir le jeu","Voir aussi"=>'<a href="../Compiler_AS3">Compiler l\'AS3</a>',"Retour"=>'<a href="../SkyFire">Retour à SkyFire</a>');
include('../header.php');
?>
<h1>Code FireWorks</h1>
<p><a href="../SkyFire">Retour à l'application SkyFire</a></p>
<h3>Licence</h3>
<p class="erreur">Ce code est fourni sous une licence CC-By (cf. fin de page).<br />
<h3>À propos du code</h3>
<p>Le code est réparti en classes claires et nettes.<br />L'ensemble du fichier représente moins de 10ko !</p>
<h3>Structure de l'application</h3>
<p class="centre"><img src="Images/SkyFireUML.png" alt="Diagramme de SkyFire" class="nonflottant" /></p>
<h2>Classe principale SkyFire</h2>
<p>Dessine les feux, gère l'affichage global et l'artificier.</p>
<?php
InclureCode('SkyFire.as','actionscript3');
?>
<h2>Classes secondaires :</h2>
<h3>Artificier</h3>
<p>L'artificier est la classe qui gère la cadence des tirs, et les feux qui sont tirés.</p>
<?php
InclureCode('Artificier.as','actionscript3');
?>
<h3>Vecteur</h3>
<p>Un vecteur mathématique. De façon interne, il s'agit juste d'un type Point renommé en Vecteur pour une meilleure lisibilité du code général.</p>
<?php
InclureCode('Vecteur.as','actionscript3');
?>
<h3>Particules</h3>
<p>L'ensemble des feux existants sont des classes qui héritent de Particule.</p>
<?php
InclureCode('Particule.as','actionscript3');
?>
<h4>Toutes les particules</h4>
<p>Chaque feu d'artifice dans sa diversité.</p>
<?php
InclureCode('DistanceFader.as','actionscript3');
InclureCode('SpeedFader.as','actionscript3');
InclureCode('Pchitter.as','actionscript3');
InclureCode('Boomer.as','actionscript3');
InclureCode('BiBoomer.as','actionscript3');
InclureCode('BoomerPchitter.as','actionscript3');
?>
<?php
include('../footer.php');
?>
