<?php
$Titre='1001 blagues de tous horizons';
$Box = array("Auteur" => "Neamar","Date" => "2007-2008", "But" =>"Un peu d'humour");
include('../header.php');
?>
<h1>1001 blagues</h1>
<p class="erreur">Attention. Certaines des blagues pr�sent�es ici peuvent choquer les plus jeunes visiteurs.</p>
<p class="erreur">La mise en forme, la qualit�, les fautes d'orthographe de ce texte ne sont pas en accord avec le reste du contenu de ce site. Cette page est pr�sent�e au titre d'archive, sans autre pr�tention.</p>
<p class="comment">Toutes les blagues pr�sent�es ici sont extraites de <a href="http://neamar.free.fr/Ephem/ephem.php">l'�ph�meride de blagues</a>.</p>
<ol>

<?php
echo file_get_contents('Contenu.php');
?>

</ol>

<?php
include('../footer.php');
?>