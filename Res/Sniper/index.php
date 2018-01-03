<?php
$Titre='Le sniper';
$Box = array("Auteur" => "Neamar","Date" => "2009","Analyse du texte"=>'<a href="http://blog.neamar.fr/accueil/11-nouvelles-et-histoire/26-analyse-texte-sniper">Analyse</a>');

$AddLine='<link rel="stylesheet" type="text/css" href="//neamar.fr/lib/Typo/Typo.css" />';
include('../header.php');
include('../Typo/Typo.php');
?>
<h1>Le sniper</h1>
<!-- <p class="auteur">Neamar</p> -->

<?php
Typo::setTexteFromFile('Texte.txt');
echo Typo::Parse();
?>

<?php
include('../footer.php');
?>
