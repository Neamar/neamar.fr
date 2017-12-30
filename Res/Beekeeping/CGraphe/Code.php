<?php
$Titre='Code de C-Graphe';
$Box = array("Auteur" => "Neamar","Date" => "Février 2009", "But" =>"Finir le jeu","Voir aussi"=>'<a href="../Compiler_AS3">Compiler l\'AS3</a>',"Retour"=>'<a href="../CGraphe">Retour à CGraphe</a>');
include('../header.php');
?>
<h1>Un troisième jeu de graphe</h1>
<p class="centre"><img src="Images/CGraphe.png" alt="Code de CGraphe en développement" class="nonflottant" style="width:95%;"/></p>
<h3>Licence</h3>
<p class="erreur">Ce code est fourni sous une licence CC-By (cf. fin de page).<br />
De plus, il est interdit de recompiler le jeu directement en supprimant simplement le lien «Plus de jeux», la mention «directement» restant à l'appréciation de l'auteur original du code source.</p>
<h3>À propos du code</h3>
<p>Le code est réparti en classes claires et nettes.<br />L'ensemble du fichier représente moins de 10ko !</p>
<h2>Classe principale C-Graphe</h2>
<h3>Fichiers de bases :</h3>
<p>Ces fichiers définissent l'architecture de base : la boite qui affiche un apercu des niveaux, la boite de dialogue, les données des niveaux...</p>
<?php
InclureCode('Cgraphe.as','actionscript3');
InclureCode('ChangementsNiveaux.as','actionscript3');
InclureCode('ChargementNiveaux.as','actionscript3');
InclureCode('Message.as','actionscript3');
?>
<h3>Fichiers de mod</h3>
<p>Permet de jouer à plusieurs sur un terrain personnalisé.</p>
<?php
InclureCode('Persos.as','actionscript3');
?>
<h2>Classes</h2>
<p>Un jeu est une instance de Game. Cette instance se décompose en un BackGround (le fond qui bouge), et un terrain (Land) qui contient les noeuds et les aretes.<br />
Le Game contient aussi les références vers les deux joueurs, (Human ou AI, tous deux héritant de Player).</p>
<h3>Affichage et jeux</h3>
<?php
InclureCode('Game.as','actionscript3');
InclureCode('BackGround.as','actionscript3');
InclureCode('Land.as','actionscript3');
InclureCode('Noeud.as','actionscript3');
InclureCode('Arc.as','actionscript3');
?>
<h3>Les joueurs</h3>
<?php
InclureCode('Player.as','actionscript3');
InclureCode('AI.as','actionscript3');
InclureCode('Human.as','actionscript3');
InclureCode('OnlinePlayer.as','actionscript3');
?>

<h3>Utilitaires</h3>
<?php
InclureCode('Const.as','actionscript3');
InclureCode('Trace.as','actionscript3');
InclureCode('ArrayPlus.as','actionscript3');
InclureCode('DictionaryPlus.as','actionscript3');
?>
<?php
include('../footer.php');
?>