<?php
$Titre='Two months with the bees';
$Box = array("Author" => "Benoît-Joseph Pascal","Date" => "2009",'PDF Version'=>'<a href="Beekeeping.pdf">PDF</a>');

$AddLine='<link rel="stylesheet" type="text/css" href="https://neamar.fr/lib/Typo/Typo.css" />';
include('../header.php');
include('../../lib/Typo.php');
?>
<h1><?php echo $Titre; ?></h1>
<p class="auteur"><?php echo $Box['Auteur']; ?></p>

<?php

Typo::setTexteFromFile('Texte.tex');
Typo::switchLanguage('en');
// Typo::addOption(P_UNGREEDY);
echo Typo::Parse();
?>

<?php
include('../footer.php');
?>
