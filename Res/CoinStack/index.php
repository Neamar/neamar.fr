<?php
$Titre='CoinStack : la pile de pièces';
$Box = array("Auteur" => "Neamar","Date" => "Aout 2008", "But" =>"Ramasser les pièces !","Voir aussi"=>'<a href="../Compiler_AS3">Compiler l\'AS3</a>',"Voir aussi "=>'<a href="../MoneyStack">MoneyStack</a>',"Voir aussi  "=>'<a href="../BankNoteStack">BankNoteStack</a>');
include('../header.php');

if(isset($_GET['en']))
	$Flash ='http://games.mochiads.com/c/g/coin-stack/CoinStack_en.swf';
else if(isset($_GET['cn']))
	$Flash ='http://games.mochiads.com/c/g/coin-stack-cn/CoinStack_cn.swf';
else
	$Flash = 'CoinStack.swf';
?>
<h1><img src="Images/CoinStack.png" class="nonflottant" alt="Aide au jeu CoinStack"/></h1>

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
	<object type="application/x-shockwave-flash" data="<?php echo $Flash ?>" width="640" height="480" >
		<param name="movie" value="<?php echo $Flash ?>" />
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

<h4>Captures d'écran</h4>
<p>
	<img src="Images/CoinStack_1.png" class="miniatureFlash" alt="Aide au jeu CoinStack" />
	<img src="Images/CoinStack_2.png" class="miniatureFlash" alt="Tas de pièces" />
	<img src="Images/CoinStack_3.png" class="miniatureFlash" alt="Enregistrement des scores de CoinStack" />
	<img src="Images/500.jpg" class="miniatureFlash" alt="Fond retenu pour l'application (CoinStack ArtWork)" />
</p>

<h2>Explications</h2>
<h3>Règle du jeu</h3>
<p>La règle est extrêmement simple : vous avez une minute pour ramasser un maximum de pièces. La seule contrainte ? Vous ne pouvez ramasser que les pièces en haut du tas (celles qui ne sont pas recouvertes). Depêchez-vous, la fortune sourit aux audacieux...</p>

<h3>Score</h3>
<p>Chaque pièce rapporte sa valeur en euros : 2 euros représentent donc 200 points, 5 centimes 5 points. Cliquer sur une pièce recouverte fait perdre la valeur de la pièce.</p>

<p>Un peu de mathématiques :</p>
<ul>
	<li>Les 8 pièces sont équiréparties (il y en a autant de chaque type)&nbsp;; </li>
	<li><span class="TexTexte">1+2+5+10+20+50+100+200 = 388</span>&nbsp;; </li>
	<li>il y a 500 pièces en jeu soit <img src="http://neamar.fr/Latex/TEX.php?m=%5C%2C%5Clfloor%5C%2C%5Cfrac%7B500%7D%7B8%7D%5C%2C%5C%2C%5Crfloor%5C%2C%3D%5C%2C60" alt="\lfloor \frac{500}{8} \rfloor = 60" class="TexPic" /> fois l'ensemble des pièces. </li>
</ul>
<p>On en déduit donc que le score maximal théorique est de <span class="TexTexte">388 &times; 60 = 23 280</span>. Comme une partie dure une minute, cela impliquerait de ramasser <img src="http://neamar.fr/Latex/TEX.php?m=%5Cfrac%7B500%7D%7B60%7D%5C%2C%5C%2C%5Csimeq%5C%2C%5C%2C%5C%2C8.3" alt="\frac{500}{60}\, \simeq \, 8.3" class="TexPic" /> pièces à la seconde&nbsp;! </p>

<h3>Remerciements</h3>
<p>Merci à Anthony ISTAR pour la composition du logo de ce jeu.</p>

<h3>Historique</h3>
<ul>
<li>Démarrage du codage : 10/05/09</li>
<li>Version RC1 et définitive : 13/05/09  (Testeurs : KissCoool, Louise, Damien, Agnès, Jolo2, Morgan, Seb, Raoul)</li>
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
