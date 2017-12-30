<?php
$Titre='Wallnumber';
$Box = array("Auteur" => "Neamar","Date" => "Octobre 2011", "But" =>"Meilleur score","Voir aussi"=>'<a href="../Icosien">Icosien</a>',"Voir aussi"=>'<a href="../Graphe">Jeux de graphe</a>');
include('../header.php');
?>

<h1 style="text-align:center;">Wallnumber</h1>
<h2>Le r�sultat</h2>
<h3>Fichier Flash :</h3>
<div style="border:1px solid black; width:800px; height:600px; margin:auto;">
	<object type="application/x-shockwave-flash" data="http://games.mochiads.com/c/g/wallnumber/Wallnumber.swf" width="800" height="600" >
		<param name="movie" value="http://games.mochiads.com/c/g/wallnumber/Wallnumber.swf" />
		<param name="quality" value="high" />
		<param name="wmode" value="transparent" />
		<p>Installez le plugin Flash pour voir l'animation : <a href="http://www.adobe.com/go/gntray_dl_getflashplayer_fr" >Cliquez ici pour le t�l�charger</a></p>
	</object>
</div>

<h3>R�gle du jeu</h3>
<p>Le jeu est extr�mement intuitif. Des chariots d�portent des nombres vers la droite : vous devez appuyez sur la touche de votre clavier correspondant au nombre le plus haut plac� avant qu'il ne touche l'extr�mit� du rail. Lorsque tous les chariots sont sortis de l'�cran, le jeu se termine.</p>

<p>Dur�e moyenne d'une partie : 1 minute.</p>

<h3>Score</h3>
<p>Pour chaque num�ro correctement tap�, la vitesse du jeu augmente d'une unit� jusqu'� atteindre 50.<br />
Toutes les frames (soit trente fois par seconde), on ajoute au score la vitesse divis�e par 10.<br />
Lorsqu'une voie se ferme, la vitesse est ralentie de 75% (sans jamais descendre en dessous de 1).</p>

<h3>Historique et code source</h3>
<p><a href="https://github.com/Neamar/Wallnumber/">Consultez le code-source de Wallnumber</a>.</p>

<h3>Remerciements</h3>
<p>Merci � Licoti pour ses graphismes magnifiques comme � son habitude !</p>

<h2>Statistiques...</h2>
<p>Nombre de joueurs : <?php
function getLineCount($file)
{
	$lines = 0;

	$fh = fopen($file, 'r');
	while (!feof($fh))
	{
		fgets($fh);
		$lines++;
	}
	return $lines; // line count
}
echo number_format(getLineCount('StatsJeu.txt'), 0, ',', ' ');?></p>

<?php
include('../footer.php');
?>