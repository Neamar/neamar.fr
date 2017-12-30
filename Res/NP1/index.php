<?php
$Titre='CoinStack : la pile de pi�ces';
$Box = array("Auteur" => "Neamar","Date" => "Aout 2008", "But" =>"Ramasser les pi�ces !","Voir aussi"=>'<a href="../Compiler_AS3">Compiler l\'AS3</a>');
include('../header.php');
?>
<h1>CoinStack</h1>
<h2>Le r�sultat</h2>
<h3>Fichier Flash :</h3>
<div style="border:1px solid black; width:640px; height:480px; margin:auto;">
	<object type="application/x-shockwave-flash" data="NP1.swf" width="640" height="480" >
		<param name="movie" value="NP1.swf" />
		<param name="quality" value="high" />
		<param name="wmode" value="transparent" />
		<p>Installez le plugin Flash pour voir l'animation : <a href="http://www.adobe.com/go/gntray_dl_getflashplayer_fr" >Cliquez ici pour le t�l�charger</a></p>
	</object>
</div>
<h3>Images</h3>
<p>Les images de pi�ces utilis�es :</p>
<h4>Les centimes cuivr�s</h4>
<p>
	<img src="Images/1Centime.png" alt="1 centime" />
	<img src="Images/2Centimes.png" alt="2 centimes" />
	<img src="Images/5Centimes.png" alt="5 centimes" />
</p>
<h4>Les centimes dor�s</h4>
<p>
	<img src="Images/10Centime.png" alt="10 centimes" />
	<img src="Images/20Centimes.png" alt="20 centimes" />
	<img src="Images/50Centimes.png" alt="50 centimes" />
</p>

<h4>Les euros</h4>
<p>
	<img src="Images/1Euro.png" alt="1 euro" />
	<img src="Images/2Euros.png" alt="2 euros" />
</p>


<h4>Fond retenu</h4>
<p>
	<img src="Images/500.jpg" class="miniatureFlash" alt="Fond retenu pour l'application (CoinStack ArtWork)" />
</p>

<h2>Explications</h2>
<h3>R�gle du jeu</h3>
<p>LA r�gle est extr�mement simple : vous avez une minute pour ramasser un maximum de pi�ces. La seule contrainte ? Vous ne pouvez ramasser que les pi�ces en haut du tas (celles qui ne sont pas recouvertes). Dep�chez-vous, la fortune sourit aux audacieux...</p>

<h3>Historique</h3>
<ul>
<li>D�marrage du codage : 10/05/09</li>
<li>Version RC1 : 13/05/09  (Testeurs : )</li>
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
