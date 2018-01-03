<?php
$Titre='Nouvelle : Vous les zombies &ndash; Texte intégral';
$Box = array("Auteur" => "Robert A. Heinlein","Date" => "1958","Versions"=>'<a href="Vous les Zombies.pdf">PDF</a>');
$AddLine='<link rel="stylesheet" type="text/css" href="https://neamar.fr/Res/Typo/Typo.css" />';
include('../header.php');
include('../Typo/Typo.php');
?>
<div style="background:white url('Images/Ouroboros_light.jpg') no-repeat fixed bottom;">
<h1>Vous les Zombies</h1>
<p class="auteur">Robert A. Heinlein</p>
<p class="erreur">&OElig;uvre écrite par Robert A. Heinlein.<br />
Titre original : <em>All You Zombies</em><br />
Traduction française intégrale : NEAMAR 2008</p>

<?php
Typo::setTexteFromFile('Texte.txt');
Typo::addOption(P_UNGREEDY);
echo Typo::Parse();
?>
</div>
<p class="petitTexte centre">Mis en forme avec <a href="../Typo">le Typographe</a></p>
<?php
include('../footer.php');
?>
