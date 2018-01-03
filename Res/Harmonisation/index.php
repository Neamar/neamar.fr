<?php
$Titre='Le problème de l\'harmonisation des notes';
$Box = array("Auteur" => "Neamar","Date" => "2010");

$AddLine='<link rel="stylesheet" type="text/css" href="http://neamar.fr/lib/Typo/Typo.css" />';
$UseMath=true;
include('../header.php');
include('../Typo/Typo.php');
?>
<h1><?php echo $Titre; ?></h1>
<p class="auteur">Neamar</p>

<?php
Typo::setTexteFromFile('Texte.txt');
Typo::addOption(PARSE_MATH);
echo Typo::Parse();
?>

<?php
include('../footer.php');
?>
