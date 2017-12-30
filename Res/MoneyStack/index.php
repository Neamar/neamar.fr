<?php
$Titre='MoneyStack : pièces et billets';
$Box = array("Auteur" => "Neamar","Date" => "Aout 2008", "But" =>"Ramasser les billets !","Voir aussi"=>'<a href="../Compiler_AS3">Compiler l\'AS3</a>',"Voir aussi "=>'<a href="../CoinStack">CoinStack</a>',"Voir aussi  "=>'<a href="../BankNoteStack">BankNoteStack</a>');
include('../header.php');
?>
<h1><img src="Images/MoneyStack.jpg" class="nonflottant" alt="Aide au jeu MoneyStack"/></h1>

<div class="erreur">
<p>Ce jeu fait partie de la série des piles.</p>
<ul>
<li><a href="../CoinStack">CoinStack</a> : le premier de la série. Seulement des pièces  (<em>score max. : 23 280</em>) ;</li>
<li><a href="../BankNoteStack">BankNoteStack</a> : seulement des billets (<em>score max. : 53 100</em>) ;</li>
<li><a href="../MoneyStack">MoneyStack</a> : pièces et billets (<em>score max. : 29 333</em>) ;</li>
</ul>
</div>

<h2>Le résultat</h2>
<h3>Fichier Flash :</h3>
<div style="border:1px solid black; width:640px; height:480px; margin:auto;">
	<object type="application/x-shockwave-flash" data="MoneyStack.swf" width="640" height="480" >
		<param name="movie" value="MoneyStack.swf" />
		<param name="quality" value="high" />
		<param name="wmode" value="transparent" />
		<p>Installez le plugin Flash pour voir l'animation : <a href="http://www.adobe.com/go/gntray_dl_getflashplayer_fr" >Cliquez ici pour le télécharger</a></p>
	</object>
</div>
<h3>Images</h3>
<p>Les images sont extraites de BankNoteStack et de CoinStack.</p>
<h4>Pièces</h4>
<h5>Les centimes cuivrés</h5>
<p>
	<img src="../CoinStack/Images/1Centime.png" alt="1 centime" />
	<img src="../CoinStack/Images/2Centimes.png" alt="2 centimes" />
	<img src="../CoinStack/Images/5Centimes.png" alt="5 centimes" />
</p>
<h5 style="clear:both;">Les centimes dorés</h5>
<p>
	<img src="../CoinStack/Images/10Centime.png" alt="10 centimes" />
	<img src="../CoinStack/Images/20Centimes.png" alt="20 centimes" />
	<img src="../CoinStack/Images/50Centimes.png" alt="50 centimes" />
</p>
<h5 style="clear:both;">Les euros</h5>
<p>
	<img src="../CoinStack/Images/1Euro.png" alt="1 euro" />
	<img src="../CoinStack/Images/2Euros.png" alt="2 euros" />
</p>

<h4>Billets</h4>
<p>
	<img src="../BankNoteStack/Images/5.jpg" alt="5 euros" />
	<img src="../BankNoteStack/Images/10.jpg" alt="10 euros" />
	<img src="../BankNoteStack/Images/20.jpg" alt="20 euros" />
	<img src="../BankNoteStack/Images/50.jpg" alt="50 euros" />
	<img src="../BankNoteStack/Images/100.jpg" alt="100 euros" />
	<img src="../BankNoteStack/Images/200.jpg" alt="200 euros" />
	<img src="../BankNoteStack/Images/500.jpg" alt="500 euros" />
</p>

<h4>Captures d'écran</h4>
<p>
	<img src="Images/Thumb.png" alt="MoneyStack miniature" />
	<img src="Images/MoneyStack_1.png" class="miniatureFlash" alt="MoneyStack jeu" />
	<img src="Images/MoneyStack_2.png" class="miniatureFlash" alt="MoneyStack Developpement" />
	<img src="Images/MoneyStack_3.png" class="miniatureFlash" alt="MoneyStack Developpement 2" />
	<img src="Images/MoneyStack_4.png" class="miniatureFlash" alt="Règle du jeu" />
	<img src="Images/MoneyStack_5.png" class="miniatureFlash" alt="Chargement" />
</p>

<h2>Explications</h2>
<h3>Règle du jeu</h3>
<p>La règle est extrêmement simple (c'est la même que <a href="/Res/CoinStack">CoinStack</a> et  <a href="/Res/BankNoteStack">BankNoteStack</a>) : vous avez une minute pour ramasser un maximum d'argent. La seule contrainte ? Vous ne pouvez ramasser que les éléments en haut du tas (ceux qui ne sont pas recouverts). Depêchez-vous, la fortune sourit aux audacieux...</p>

<h3>Score</h3>
<p>Chaque élément rapporte sa valeur en euros : 50 euros représentent donc 50 points, 50 centimes 0,5 point. Cliquer sur un objet recouvert fait perdre la valeur du billet.</p>

<p>Un peu de mathématiques :</p>
<ul>
	<li>Les 8 pièces sont équiréparties (il y en a autant de chaque type)&nbsp;; </li>
	<li><span class="TexTexte">0.01 + 0.02 + 0.05 + 0.1 + 0.2 + 0.5 + 1 + 2 + 5 + 10 + 20 + 50 + 100 + 200 + 500 = 888.88</span>&nbsp;; </li>
	<li>il y a 500 éléments en jeu soit <img src="http://neamar.fr/Latex/TEX.php?m=%5C%2C%5Clfloor%5C%2C%5Cfrac%7B500%7D%7B15%7D%5C%2C%5C%2C%5Crfloor%5C%2C%3D%5C%2C60" alt="\left \lfloor \frac{500}{15} \right \rfloor = 33" class="TexPic" /> fois l'ensemble des objets. </li>
</ul>
<p>On en déduit donc que le score maximal théorique est de <span class="TexTexte">888.88 &times; 33 = 29 333</span>. Comme une partie dure une minute, cela impliquerait de ramasser <img src="http://neamar.fr/Latex/TEX.php?m=%5Cfrac%7B500%7D%7B60%7D%5C%2C%5C%2C%5Csimeq%5C%2C%5C%2C%5C%2C8.3" alt="\frac{500}{60}\, \simeq \, 8.3" class="TexPic" /> objets à la seconde&nbsp;! </p>


<h3>Historique</h3>
<ul>
<li>Démarrage du codage : 28/05/09, 14h</li>
<li>Version RC1 : 28/05/09 (Testeurs : Patrick, Morgan, Melimelo)</li>
</ul>

<h2>Téléchargement</h2>
<h3>Dernière version</h3>
<p>Voir le fichier SWF, et le code.</p>

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
<h2>Le code</h2>
<h3>À propos du code</h3>
<p>L'ensemble des fichiers représente moins de 10ko !</p>
<p><a href="Code.php">Afin d'éviter l'engorgement du serveur, le code a été décentralisé sur une page externe.</a></p>
<?php
include('../footer.php');
?>
