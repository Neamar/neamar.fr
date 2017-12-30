<?php
$Titre='Solutions des niveaux de B-Graphe';
$Box = array("Auteur" => "Neamar","Date" => "Aout 2008", "But" =>"Finir le jeu","Voir aussi"=>'<a href="../Compiler_AS3">Compiler l\'AS3</a>',"Retour"=>'<a href="../BGraphe">Retour à BGraphe</a>');
include('../header.php');
?>
<h1>Solutions des niveaux de B-Graphe</h1>
<h2>Avertissement</h2>
<p>Ces images ne sont fournies qu'à titre indicatif : en effet, il est fort probable que vous ne réussissiez pas à les reproduire telles quelles, les niveaux étant mélangés à chaque fois.<br />De plus, il n'y a pas d'interet à consulter cette page...sauf si vous êtes vraiment bloqués : cela peut vous donner une idée de la forme globale de la solution.</p>
<h2>Solutions</h2>
<p>La liste commence au niveau 5, les autres niveaux étant d'une facilité frisant le ridicule.<br />Passez sur une image pour l'agrandir.</p>
<?php
for($i=5;$i<=11;$i++)
	echo '<h3>Niveau n°' . $i . '</h3>' . "\n" . '<p><img src="Images/Solutions/Solution' . $i . '.png" class="miniatureFlash" alt="Solution du niveau ' . $i . '" /></p>';
?>
<p>Ce niveau est le plus grand graphe planaire à 42 noeuds possibles. Très franchement, réussir à finir ce niveau sans avoir l'idée du triangle de Sierpinski est infaisable...</p>
<?php
include('../footer.php');
?>