<?php
$Titre='Code de A-Graphe';
$Box = array("Auteur" => "Neamar","Date" => "Aout 2008", "But" =>"Finir le jeu","Voir aussi"=>'<a href="../Compiler_AS3">Compiler l\'AS3</a>',"Retour"=>'<a href="../AGraphe">Retour à AGraphe</a>');
include('../header.php');
?>
<h1>Un jeu de logique en Flash</h1>
<h3>Licence</h3>
<p class="erreur">Ce code est fourni sous une licence CC-By (cf. fin de page).<br />
De plus, il est interdit de recompiler le jeu "tel quel" en supprimant le lien «Plus de jeux», la mention «tel quel» restant à l'appréciation de l'auteur original du code source (copie, plagiat...).</p>
<h3>À propos du code</h3>
<p>Le code est réparti en classes claires et nettes.<br />L'ensemble du fichier représente moins de 10ko !</p>
<p>La position de chaque noeud est calculée à la volée, à l'aide d'une méthode récursive plutôt performante.</p>
<h3>Classe principale A-Graphe</h3>
<h4>Fichiers de bases :</h4>
<?php
InclureCode('Agraphe.as','actionscript3');
InclureCode('ChangementsNiveaux.as','actionscript3');
InclureCode('ChargementNiveaux.as','actionscript3');
InclureCode('Message.as','actionscript3');
?>
<h4>Fichiers de mod</h4>
<?php
InclureCode('2Joueurs.as','actionscript3');
InclureCode('Persos.as','actionscript3');
?>
<h3>Classes</h3>
<?php
InclureCode('Niveau.as','actionscript3');
InclureCode('Noeud.as','actionscript3');
InclureCode('Arc.as','actionscript3');
?>
<h3>Bonus</h3>
<p>En bonus, le fichier de résolution qui donne le nombre minimal de jetons à utiliser pour un niveau.<br />
Attention, il n'est pas optimisé, et est particulièrement long à l'éxécution...nécessitera une fonction trace.</p>
<?php
InclureCode('Resolution.as','actionscript3');
?>
<?php
include('../footer.php');
?>