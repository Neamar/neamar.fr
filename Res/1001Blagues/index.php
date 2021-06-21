<?php
$Titre='1001 blagues de tous horizons';
$Box = array("Auteur" => "Neamar","Date" => "2007-2008", "But" =>"Un peu d'humour");
include('../header.php');
?>
<h1>1001 blagues</h1>
<p class="erreur">Retrouvez toutes ces blagues et bien d'autres encore dans une présentation plus claire sur le site <a href="https://jairi.fr">J'ai ri !</a>.</p>
<ol>

<?php
echo file_get_contents('Contenu.php');
?>

</ol>

<?php
include('../footer.php');
?>
