<?php
$Titre='Un pathfinder efficace avec A*';
$Box = array("Auteur" => "Neamar","Date" => "Juin 2008", "But" =>"Trouver un chemin","Voir aussi"=>'<a href="../Compiler_AS3">Compiler l\'AS3</a>',"Voir aussi " =>'<a href="../Recursivite">La r�cursivit�</a>');
include('../header.php');
?>
	<h1>Un pathfinder efficace avec A*</h1>
	<p class="erreur">Ce code est une illustration du <a href="../Recursivite">tutorial sur la r�cursivit�</a></p>
	<h2>Le r�sultat</h2>
	<h3>Fichier Flash :</h3>
	<div style="border:1px solid black; width:640px; height:480px; margin:auto;">
		<object type="application/x-shockwave-flash" data="BC.swf" width="640" height="480" >
			<param name="movie" value="BC.swf" />
			<param name="quality" value="high" />
			<param name="wmode" value="transparent" />
			<p>Installez le plugin Flash pour voir l'animation : <a href="http://www.adobe.com/go/gntray_dl_getflashplayer_fr" >Cliquez ici pour le t�l�charger</a></p>
		</object>
	</div>
	<h4>Comment �a s'utilise ?</h4>
	<ul>
		<li>Cliquez avec la souris sur le quadrillage pour positionner votre curseur</li>
		<li>D�placer votre curseur avec les touches du clavier (haut, bas, gauche, droite)</li>
		<li>Appuyer sur Espace en d�placant le curseur et poser un mur</li>
		<li>D�placer la souris pour trouver un chemin de fa�on automatique !</li>
	</ul>

	<h3>Image</h3>
	<p class="centre"><img class="nonflottant" src="Images/Pathfinder.png" alt="Pathfinder en flash (AS3)" /></p>
	<h2>L'algorithme</h2>
	<p>De nombreux algorithmes d�crivent A* de fa�on bien plus p�dagogue que je ne saurais le faire...<br />
	Je conseille fortement la lecture de <a rel="nofollow" href="http://www.policyalmanac.org/games/aStarTutorial.htm">aStarTutorial (EN)</a></p>

	<h2>Le code</h2>
	<h3>La fonction PathFinding :</h3>
	<?php InclureCode('PathFinding.as','actionscript3'); ?>

	<h3>Les classes associ�es</h3>
	<?php InclureCode('t_map.as','actionscript3'); ?>
	<?php InclureCode('t_Ligne.as','actionscript3'); ?>
	<?php InclureCode('t_node.as','actionscript3'); ?>
 	<?php InclureCode('t_OpenList.as','actionscript3'); ?>

	<h3>Fonctions</h3>
	<?php InclureCode('Misc.as','actionscript3'); ?>
<?php
include('../footer.php');
?>
