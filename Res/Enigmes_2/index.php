<?php
session_start();
$UseMath=true;
$Titre='Les 10 plus belles énigmes &ndash; Tome 2';
$Box = array("Auteur" => "Neamar","Date" => "Nov. 2008", "But" =>"Divertissement",'Analyse'=>'<a href="http://blog.neamar.fr/component/content/article/5-looking-back/22-retour-sur-les-10-plus-belles-enigmes-deuxieme-saison">Notes de l\'auteur</a>');

$AddLine='<link rel="stylesheet" type="text/css" href="http://neamar.fr/lib/Typo/Typo.css" />';

include('../header.php');
include('../../lib/Typo.php');
?>

<h1>Lutin, une sinécure ?</h1>
<p class="auteur">Neamar</p>
<?php

Typo::setTexteFromFile('Enigmes_2.tex');
Typo::addOption(PARSE_MATH);
Typo::addOption(ALLOW_FOOTNOTE,FOOTNOTE_SCIENCE);//Pour que les notes de bas de page soient entourées de parenthèses, ce qui évite de les confondre avec des puissances mathématiques.
echo Typo::Parse();
?>
<p class="petitTexte centre">Mis en forme avec <a href="../Typo">le Typographe</a></p>
<?php
include('../footer.php');
?>
