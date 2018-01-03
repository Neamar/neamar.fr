<?php
$Titre='Halloween';
$Box = array("Auteur" => "Neamar","Date" => "2009");

$AddLine='<link rel="stylesheet" type="text/css" href="https://neamar.fr/lib/Typo/Typo.css" />';
include('../header.php');
include('../Typo/Typo.php');
?>
<h1><?php echo $Titre; ?></h1>
<p class="auteur"><?php echo $Box['Auteur']; ?></p>
<p class="erreur">Attention, texte psychopathe.</p>

<?php
Typo::setTexteFromFile('Texte.tex');
Typo::addOption(P_UNGREEDY);
echo Typo::Parse();
?>

<?php
include('../footer.php');
?>
