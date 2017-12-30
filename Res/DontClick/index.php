<?php
$Titre='Don\'t Click : c\'est quoi la r�gle ?';
$Box = array("Auteur" => "Neamar","Date" => "D�cembre 2009", "But" =>"Finir le niveau","Voir aussi"=>'<a href="../Compiler_AS3">Compiler l\'AS3</a>');
include('../header.php');
?>
<h1>Don't Click</h1>

<h2>Le r�sultat</h2>
<h3>Fichier Flash :</h3>
<div style="border:1px solid black; width:640px; height:480px; margin:auto;">
	<object type="application/x-shockwave-flash" data="DontClick.swf" width="640" height="480" >
	<param name="movie" value="DontClick.swf" />
		<param name="quality" value="high" />
		<param name="wmode" value="transparent" />
		<p>Installez le plugin Flash pour voir l'animation : <a href="http://www.adobe.com/go/gntray_dl_getflashplayer_fr" >Cliquez ici pour le t�l�charger</a></p>
	</object>
</div>

<h4>Captures d'�cran</h4>
<p>
	<img src="Images/DontClick1.png" class="miniatureFlash" alt="DontClick : Labyrinthe" />
	<img src="Images/DontClick2.png" class="miniatureFlash" alt="DontClick : Anneaux concentriques" />
	<img src="Images/DontClick3.png" class="miniatureFlash" alt="DontClick : Curseur masqu�" />
	<img src="Images/DontClick4.png" class="miniatureFlash" alt="DontClick : Bubble Work" />
</p>

<h2>Explications</h2>
<h3>R�gle du jeu</h3>
<p>Chaque niveau est diff�rent... deux constantes cependant :</p>
<ul>
	<li>votre souris suffit, pas besoin de cliquer ;</li>
	<li>placez votre curseur sur le rond pour terminer le niveau.</li>
</ul>

<h3>Score</h3>
<p>Le score est calcul� � partir du temps.</p>

<h3>Historique</h3>
<ul>
<li>D�marrage du codage : 20/12/09</li>
<li>Version Alpha : 29/12/09 (Testeurs : Lagile, Morgan)</li>
<li>Version B�ta : 30/12/09  (Testeurs : Morgan, Mathieu, Fatalis)</li>
</ul>

<h2>T�l�chargement</h2>
<h3>Derni�re version</h3>
<p>Voir le fichier SWF, et le code.</p>

<h2>Statistiques...</h2>
<p>Nombre de joueurs : <?php echo count(file('StatsJeu.txt'));?></p>
<h2>Le code</h2>
<h3>� propos du code</h3>
<p>L'ensemble des fichiers repr�sente moins de 10ko !</p>
<p><a href="Code.php">Afin d'�viter l'engorgement du serveur, le code a �t� d�centralis� sur une page externe.</a></p>
<?php
include('../footer.php');
?>
