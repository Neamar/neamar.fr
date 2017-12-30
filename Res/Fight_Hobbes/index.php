<?php
$Titre='Je suis la jeunesse volée de Jack : relations entre Fight Club et Calvin &amp; Hobbes';
$Box = array("Auteur" => "18th Candidate","Date" => "2010","Traducteur"=>'Neamar');
$AddLine='<link rel="stylesheet" type="text/css" href="http://neamar.fr/Res/Typo/Typo.css" />';
include('../header.php');
include('../Typo/Typo.php');
?>
<div style="background:white url('Images/Ouroboros_light.jpg') no-repeat fixed bottom;">
<h1>Relations entre Fight Club et Calvin &amp; Hobbes</h1>
<p class="auteur">Neamar</p>

<?php
Typo::setTexteFromFile('Texte.txt');
// Typo::addOption(P_UNGREEDY);
echo Typo::Parse();
?>
</div>
<p class="petitTexte centre">Mis en forme avec <a href="../Typo">le Typographe</a></p>
<?php
include('../footer.php');
?>
