<?php
$Titre='Code de B-Graphe';
$Box = array("Auteur" => "Neamar","Date" => "Aout 2008", "But" =>"Finir le jeu","Voir aussi"=>'<a href="../Compiler_AS3">Compiler l\'AS3</a>',"Retour"=>'<a href="../BGraphe">Retour à BGraphe</a>');
include('../header.php');
?>
<h1>Un (autre) jeu de graphe</h1>
<p class="centre"><img src="Images/Developpement.png" alt="Code de BGraphe" class="nonflottant" /></p>
<h3>Licence</h3>
<p class="erreur">Ce code est fourni sous une licence CC-By (cf. fin de page).<br />
De plus, il est interdit de recompiler le jeu directement en supprimant simplement le lien «Plus de jeux», la mention «directement» restant à l'appréciation de l'auteur original du code source.</p>
<h3>À propos du code</h3>
<p>Le code est réparti en classes claires et nettes.<br />L'ensemble du fichier représente moins de 10ko !</p>
<h3>Structure de l'application</h3>
<p class="centre"><img src="Images/BGrapheUML.png" alt="Diagramme de BGraphe" class="nonflottant" /></p>
<h2>Classe principale B-Graphe</h2>
<h3>Fichiers de bases :</h3>
<?php
InclureCode('Bgraphe.as','actionscript3');
InclureCode('ChangementsNiveaux.as','actionscript3');
InclureCode('ChargementNiveaux.as','actionscript3');
InclureCode('Message.as','actionscript3');
?>
<h3>Fichiers de mod</h3>
<?php
// InclureCode('2Joueurs.as','actionscript3');
InclureCode('Persos.as','actionscript3');
?>
<h2>Classes</h2>
<?php
InclureCode('Niveau.as','actionscript3');
InclureCode('Noeud.as','actionscript3');
InclureCode('Arc.as','actionscript3');
?>
<?php
include('../footer.php');
?>
