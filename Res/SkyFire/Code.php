<?php
$Titre='Code de SkyFire';
$Box = array("Auteur" => "Neamar","Date" => "Aout 2008", "But" =>"Finir le jeu","Voir aussi"=>'<a href="../Compiler_AS3">Compiler l\'AS3</a>',"Retour"=>'<a href="../SkyFire">Retour � SkyFire</a>');
include('../header.php');
?>
<h1>Code FireWorks</h1>
<p><a href="../SkyFire">Retour � l'application SkyFire</a></p>
<h3>Licence</h3>
<p class="erreur">Ce code est fourni sous une licence CC-By (cf. fin de page).<br />
<h3>� propos du code</h3>
<p>Le code est r�parti en classes claires et nettes.<br />L'ensemble du fichier repr�sente moins de 10ko !</p>
<h3>Structure de l'application</h3>
<p class="centre"><img src="Images/SkyFireUML.png" alt="Diagramme de SkyFire" class="nonflottant" /></p>
<h2>Classe principale SkyFire</h2>
<p>Dessine les feux, g�re l'affichage global et l'artificier.</p>
<?php
InclureCode('SkyFire.as','actionscript3');
?>
<h2>Classes secondaires :</h2>
<h3>Artificier</h3>
<p>L'artificier est la classe qui g�re la cadence des tirs, et les feux qui sont tir�s.</p>
<?php
InclureCode('Artificier.as','actionscript3');
?>
<h3>Vecteur</h3>
<p>Un vecteur math�matique. De fa�on interne, il s'agit juste d'un type Point renomm� en Vecteur pour une meilleure lisibilit� du code g�n�ral.</p>
<?php
InclureCode('Vecteur.as','actionscript3');
?>
<h3>Particules</h3>
<p>L'ensemble des feux existants sont des classes qui h�ritent de Particule.</p>
<?php
InclureCode('Particule.as','actionscript3');
?>
<h4>Toutes les particules</h4>
<p>Chaque feu d'artifice dans sa diversit�.</p>
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
