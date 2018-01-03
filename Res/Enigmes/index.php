<?php
session_start();
$UseMath=true;
$Titre='Les 10 plus belles énigmes';
$Box = array("Auteur" => "Neamar","Date" => "Nov. 2008", "But" =>"Divertissement");

$AddLine='<link rel="stylesheet" type="text/css" href="https://neamar.fr/lib/Typo/Typo.css" />';

include('../header.php');
include('../../lib/Typo.php');
?>

<h1>Les 10 plus belles énigmes</h1>
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
