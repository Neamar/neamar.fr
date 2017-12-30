<?php
$Titre='EasySQL pour l\'administration facile de tables de données relationnelles';
$Box = array("Auteur" => "Neamar","Date" => "2010");

//$AddLine='<link rel="stylesheet" type="text/css" href="http://neamar.fr/Res/Typo/Typo.css" />';
include('../header.php');
//include('../../lib/Typo.php');
?>
<h1><?php echo $Titre; ?></h1>
<p class="auteur"><?php echo $Box['Auteur']; ?></p>
<p class="erreur"></p>

<?php
// Typo::setTexteFromFile('Texte.tex');
// Typo::addOption(P_UNGREEDY);
// echo Typo::Parse();
?>

<?php
include('../footer.php');
?>
