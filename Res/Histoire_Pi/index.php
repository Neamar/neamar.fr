<?php
$Titre='Le calcul de pi &pi; à travers l\'Histoire';
$UseMath=true;
$Box = array("Auteur" => "18th Candidate","Date" => "2010","Traducteur"=>'Neamar');
$AddLine='<link rel="stylesheet" type="text/css" href="http://neamar.fr/Res/Typo/Typo.css" />';
include('../header.php');
include('../Typo/Typo.php');
?>
<div style="background:white url('Images/Ouroboros_light.jpg') no-repeat fixed bottom;">
<h1>À la recherche de &pi;</h1>
<p class="auteur">Neamar, traduit de <a href="http://www-groups.dcs.st-and.ac.uk/~history/HistTopics/Pi_through_the_ages.html">J J O'Connor et E F Robertson</a></p>

<?php
Typo::addOption(PARSE_MATH);
Typo::setTexteFromFile('Pi.tex');
// Typo::addOption(P_UNGREEDY);
echo Typo::Parse();
?>
</div>
<p class="petitTexte centre">Mis en forme avec <a href="../Typo">le Typographe</a></p>
<?php
include('../footer.php');
?>
