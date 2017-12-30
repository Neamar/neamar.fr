<?php
session_start();
$UseMath=true;
$Titre='Le langage corporel';
$Box = array("Auteur" => "Neamar","Date" => "Nov. 2008", "But" =>"Divertissement");

$AddLine='<link rel="stylesheet" type="text/css" href="http://neamar.fr/Res/Typo/Typo.css" />';

include('../header.php');
include('../Typo/Typo.php');
?>

<h1>Petit guide à l'intention de ceux qui souhaitent lire le langage corporel</h1>
<p class="auteur">Neamar</p>

<?php

Typo::setTexteFromFile('Texte.txt');
Typo::addOption(PARSE_MATH);
echo Typo::Parse();
?>

<p class="petitTexte centre">Mis en forme avec <a href="../Typo">le Typographe</a></p>
<?php
include('../footer.php');
?>
