<?php
$Titre='Code d\'Icosien';
$Box = array("Auteur" => "Neamar","Date" => "Juin 2010", "But" =>"Finir le jeu","Voir aussi"=>'<a href="../Compiler_AS3">Compiler l\'AS3</a>',"Retour"=>'<a href="../Icosien/">Retour à Icosien</a>');
include('../header.php');

$codeAreUTF8=true;

function show(array $List, $Package='')
{
	foreach($List as $Item)
		InclureCode($Package . $Item . '.as','actionscript3');
}
?>
<h1>Code source d'Icosien</h1>
<h3>Licence</h3>
<p class="erreur">Ce code est fourni sous une licence CC-By (cf. fin de page).<br />
De plus, il est interdit de recompiler le jeu "tel quel" en supprimant le lien « Sponsorisé par », la mention « tel quel » restant à l'appréciation de l'auteur original du code source (copie, plagiat...).</p>

<p><a href="Codes/Icosien.zip">Télécharger tous les codes sources</a>.</p>

<h3>Package principal</h3>
<h4>Fichiers de bases :</h4>
<?php
show(array('Preloader','Main','DatasBank'));
?>
<h4>Fichiers annexes du package principal</h4>
<?php
show(array('Background','Rope','CustomEvent','Point'));
?>



<h3>Package Web</h3>
<p>Toute la gestion de la toile (décrit <a href="http://blog.neamar.fr/component/content/article/18-algorithmie-et-optimisation/119-mouvement-intuitif-graphe-souris">dans cet article</a>).</p>
<?php
show(array('HookManager','Eulris','Hook'),'Web/');
?>


<h3>Package Level</h3>
<p>Gestion des différents types de niveaux.</p>
<?php
show(array('Level','TextLevel','EulerPathLevel','HamiltonLevel','AdLevel','CreditsLevel','EndLevel'),'Levels/');
?>




<h3>Bonus</h3>
<p>En bonus, le fichier de résolution <a href="http://blog.neamar.fr/component/content/article/18-algorithmie-et-optimisation/129-algorithme-cycle-hamiltonien-graphe">décrit sur cet article</a>.</p>
<?php
InclureCode('Solver.as','actionscript3');
?>
<?php
include('../footer.php');
?>