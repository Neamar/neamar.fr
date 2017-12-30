<?php
$Titre='Code de C-Graphe';
$Box = array("Auteur" => "Neamar","Date" => "F�vrier 2009", "But" =>"Finir le jeu","Voir aussi"=>'<a href="../Compiler_AS3">Compiler l\'AS3</a>',"Retour"=>'<a href="../CGraphe">Retour � CGraphe</a>');
include('../header.php');
?>
<h1>Un troisi�me jeu de graphe</h1>
<p class="centre"><img src="Images/CGraphe.png" alt="Code de CGraphe en d�veloppement" class="nonflottant" style="width:95%;"/></p>
<h3>Licence</h3>
<p class="erreur">Ce code est fourni sous une licence CC-By (cf. fin de page).<br />
De plus, il est interdit de recompiler le jeu directement en supprimant simplement le lien �Plus de jeux�, la mention �directement� restant � l'appr�ciation de l'auteur original du code source.</p>
<h3>� propos du code</h3>
<p>Le code est r�parti en classes claires et nettes.<br />L'ensemble du fichier repr�sente moins de 10ko !</p>
<h2>Classe principale C-Graphe</h2>
<h3>Fichiers de bases :</h3>
<p>Ces fichiers d�finissent l'architecture de base : la boite qui affiche un apercu des niveaux, la boite de dialogue, les donn�es des niveaux...</p>
<?php
InclureCode('Cgraphe.as','actionscript3');
InclureCode('ChangementsNiveaux.as','actionscript3');
InclureCode('ChargementNiveaux.as','actionscript3');
InclureCode('Message.as','actionscript3');
?>
<h3>Fichiers de mod</h3>
<p>Permet de jouer � plusieurs sur un terrain personnalis�.</p>
<?php
InclureCode('Persos.as','actionscript3');
?>
<h2>Classes</h2>
<p>Un jeu est une instance de Game. Cette instance se d�compose en un BackGround (le fond qui bouge), et un terrain (Land) qui contient les noeuds et les aretes.<br />
Le Game contient aussi les r�f�rences vers les deux joueurs, (Human ou AI, tous deux h�ritant de Player).</p>
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