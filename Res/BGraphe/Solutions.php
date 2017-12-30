<?php
$Titre='Solutions des niveaux de B-Graphe';
$Box = array("Auteur" => "Neamar","Date" => "Aout 2008", "But" =>"Finir le jeu","Voir aussi"=>'<a href="../Compiler_AS3">Compiler l\'AS3</a>',"Retour"=>'<a href="../BGraphe">Retour � BGraphe</a>');
include('../header.php');
?>
<h1>Solutions des niveaux de B-Graphe</h1>
<h2>Avertissement</h2>
<p>Ces images ne sont fournies qu'� titre indicatif : en effet, il est fort probable que vous ne r�ussissiez pas � les reproduire telles quelles, les niveaux �tant m�lang�s � chaque fois.<br />De plus, il n'y a pas d'interet � consulter cette page...sauf si vous �tes vraiment bloqu�s : cela peut vous donner une id�e de la forme globale de la solution.</p>
<h2>Solutions</h2>
<p>La liste commence au niveau 5, les autres niveaux �tant d'une facilit� frisant le ridicule.<br />Passez sur une image pour l'agrandir.</p>
<?php
for($i=5;$i<=11;$i++)
	echo '<h3>Niveau n�' . $i . '</h3>' . "\n" . '<p><img src="Images/Solutions/Solution' . $i . '.png" class="miniatureFlash" alt="Solution du niveau ' . $i . '" /></p>';
?>
<p>Ce niveau est le plus grand graphe planaire � 42 noeuds possibles. Tr�s franchement, r�ussir � finir ce niveau sans avoir l'id�e du triangle de Sierpinski est infaisable...</p>
<?php
include('../footer.php');
?>