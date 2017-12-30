<?php
$Titre='CoinStack : la pile de pièces';
$Box = array("Auteur" => "Neamar","Date" => "Aout 2008", "But" =>"Ramasser les pièces !","Voir aussi"=>'<a href="../Compiler_AS3">Compiler l\'AS3</a>');
include('../header.php');
?>
<h1>CoinStack</h1>
<h2>Le résultat</h2>
<h3>Fichier Flash :</h3>
<div style="border:1px solid black; width:640px; height:480px; margin:auto;">
	<object type="application/x-shockwave-flash" data="NP1.swf" width="640" height="480" >
		<param name="movie" value="NP1.swf" />
		<param name="quality" value="high" />
		<param name="wmode" value="transparent" />
		<p>Installez le plugin Flash pour voir l'animation : <a href="http://www.adobe.com/go/gntray_dl_getflashplayer_fr" >Cliquez ici pour le télécharger</a></p>
	</object>
</div>
<h3>Images</h3>
<p>Les images de pièces utilisées :</p>
<h4>Les centimes cuivrés</h4>
<p>
	<img src="Images/1Centime.png" alt="1 centime" />
	<img src="Images/2Centimes.png" alt="2 centimes" />
	<img src="Images/5Centimes.png" alt="5 centimes" />
</p>
<h4>Les centimes dorés</h4>
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
<h3>Règle du jeu</h3>
<p>LA règle est extrêmement simple : vous avez une minute pour ramasser un maximum de pièces. La seule contrainte ? Vous ne pouvez ramasser que les pièces en haut du tas (celles qui ne sont pas recouvertes). Depêchez-vous, la fortune sourit aux audacieux...</p>

<h3>Historique</h3>
<ul>
<li>Démarrage du codage : 10/05/09</li>
<li>Version RC1 : 13/05/09  (Testeurs : )</li>
</ul>

<h2>Téléchargement</h2>
<h3>Dernière version</h3>
<p>Voir le fichier SWF, et le code.</p>

<h2>Statistiques...</h2>
<p>Nombre de joueurs : <?php echo count(file('StatsJeu.txt'));?></p>
<h2>Le code</h2>
<h3>À propos du code</h3>
<p>L'ensemble des fichiers représente moins de 10ko !</p>
<p><a href="Code.php">Afin d'éviter l'engorgement du serveur, le code a été décentralisé sur une page externe.</a></p>
<?php
include('../footer.php');
?>
