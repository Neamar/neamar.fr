<?php
$Titre='LightningMagnet : of springs, lightning and magnets.';
$Box = array("Author" => "Neamar","Release" => "May 2012", "Goal" =>"Reach level 15","See also"=>'<a href="../Icosien">Icosien</a>',"See also "=>'<a href="../Graphe">Graph games</a>');
include('../header.php');

$Flash ='http://games.mochiads.com/c/g/lightning-magnet/Dgraphe.swf';

?>
<h1 style="text-align:center;">LightningMagnet</h1>
<a href="frise.jpg"><img src="frise_small.jpg" alt="Background" style="max-width:100%; padding:0; float:none" /></a>

<h2>The game</h2>
<h3>Flash file:</h3>
<div style="border:1px solid black; width:800px; height:600px; margin:auto;">
	<object type="application/x-shockwave-flash" data="<?php echo $Flash ?>" width="800" height="600" >
		<param name="movie" value="<?php echo $Flash ?>" />
		<param name="quality" value="high" />
		<param name="wmode" value="transparent" />
		<p>Install flash to play the game: <a href="http://www.adobe.com/go/gntray_dl_getflashplayer_fr" >click to download</a></p>
	</object>
</div>

<h3>Rules</h3>
<p>The rules are explained along the game. You'll find here a real-world-physic-oriented explanation.

You are presented with a dynamic level, which is basically a spring-and-magnet system. Every node (the white circles) is a magnet trying to flee from his neighbours; every lightning is a spring constraining the magnets together.</p>

<p>You have the ability to remove some links between two nodes, therefore disturbing the system which will try to evolve into another state of equilibrium (minimizing energy contraint).</p>

<p>Every level has a different goal, most of the time revolving around one special node, the red one. Sometimes you'll have to make sure the red one falls over the edge of the system, sometimes you'll have to save only the red one while pushing all the others... watch the information on the bottom of the game for your assignment.</p>

<h3>History</h3>
<ul>
<li>First idea (using springs and repulsion): <a href="http://blog.neamar.fr/component/content/article/18-algorithmie-et-optimisation/107-affichage-graphe-optimise">2010-04-29</a></li>
<li>First code in repository: <a href="https://github.com/Neamar/DGraphe/commit/45bbaf673fb2e14207f3b4f590c6c83a279bdc4d">2010-12-26</a></li>
<li>&alpha; version: <a href="https://github.com/Neamar/DGraphe/commit/01a0b50c3cf3b2425ad2d1e51e5b7e53bd006e56">2011-04-03</a></li>
<li>RC version: <a href="https://github.com/Neamar/DGraphe/commit/ce99bf1f1e4e91d36c33fe33e79243e5b37cfa50">2012-10-01</a></li>
</ul>

<h3>Thanks</h3>
<p>Thanks to Licoti for the beautiful design.</p>

<h2>Stats...</h2>
<p>Player count : <?php
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