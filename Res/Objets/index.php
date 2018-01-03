<?php
$Titre='Hommes et objets technologiques, quelles relations ?';
$Box = array("Auteur" => "Neamar","Date" => "2009");

$AddLine='<link rel="stylesheet" type="text/css" href="http://neamar.fr/lib/Typo/Typo.css" />';
include('../header.php');
include('../Typo/Typo.php');
?>
<h1><?php echo $Titre; ?></h1>
<p class="auteur">Neamar</p>

<?php
Typo::setTexteFromFile('Texte.tex');
// Typo::addOption(P_UNGREEDY);
echo Typo::Parse();

/*
http://techno-science.net/illustration/Multimedia/Robotique/robots-industriels-chaine-automobile.jpg
http://www.bouletcorp.com/blog/index.php?date=20090301
http://www.youtube.com/watch?v=jpEnFwiqdx8
*/
?>

<?php
include('../footer.php');
?>
