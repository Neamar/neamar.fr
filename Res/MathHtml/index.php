<?php
$Titre='Afficher des mathématiques dans du HTML avec TeX';
$Box = array("Auteur" => "Neamar","Date" => "2009");

$AddLine='<link rel="stylesheet" type="text/css" href="http://neamar.fr/Res/Typo/Typo.css" />';
$UseMath=true;
include('../header.php');
include('../Typo/Typo.php');
?>
<h1><?php echo $Titre; ?></h1>
<p class="auteur">Neamar</p>

<?php
Typo::setTexteFromFile('Texte.txt');
Typo::addOption(P_UNGREEDY);
Typo::addOption(PARSE_MATH);
echo Typo::Parse();
?>

<?php
include('../footer.php');
?>
