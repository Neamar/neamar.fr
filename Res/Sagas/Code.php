<?php
$NoPub=true;
$Box = array("Auteur"=>"Neamar", "Date" => "Aout 2008", "But" =>"Traitement donn�es","Voir aussi"=>'<a href="/Res/Reflets/">Accueil Reflets</a>');

$Titre="Code source de la classe Dialogue.";
include('../header.php');
?>
<h1>Code</h1>
<p>Voici la classe utilis�e pour g�n�rer toutes ces statistiques : (n'h�sitez pas � me contacter pour plus d'informations)</p>
<p>Le but de ce code �tait de <strong>ne pas utiliser de connexions � une base de donn�es</strong>, afin de limiter le trafic, d'o� l'utilisation d'une classe d�di�e.</p>
<?php
InclureCode('Dialogue.php',"PHP");
include('../footer.php');
?>
