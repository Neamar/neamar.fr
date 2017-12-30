<?php
$oldTitre=$Titre;
$Titre .=" | Andrésia";
define('PREFIXE','ANDRESIA_');
include('../../ConnectBDD.php');

$Box = array("Auteur" => "Malphas","Date" => "2010");

$AddLine='<link rel="stylesheet" type="text/css" href="http://neamar.fr/Res/Typo/Typo.css" />';
include('../header.php');

include('../Typo/Typo.php');
$Texte='';
$Titre = $oldTitre;
?>
<h1><?php echo $Titre; ?></h1>