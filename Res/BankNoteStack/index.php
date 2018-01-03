<?php
$Titre='BankNoteStack : la pile de billets';
$Box = array("Auteur" => "Neamar","Date" => "Aout 2008", "But" =>"Ramasser les billets !","Voir aussi"=>'<a href="../Compiler_AS3/">Compiler l\'AS3</a>',"Voir aussi "=>'<a href="../CoinStack/">CoinStack</a>',"Voir aussi  "=>'<a href="../MoneyStack/">MoneyStack</a>');
$AddLine=<<<EOF
  <script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      tex2jax: {inlineMath: [['$','$']]}
    });
    </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=TeX-MML-AM_CHTML"></script>
EOF;
include('../header.php');
?>
<h1><img src="Images/BankNoteStack.png" class="nonflottant" alt="Aide au jeu BankNoteStack"/></h1>

<div class="erreur">
<p>Ce jeu fait partie de la s�rie des piles.</p>
<ul>
<li><a href="../CoinStack">CoinStack</a> : le premier de la s�rie. Seulement des pi�ces  (<em>score max. : 23 280</em>) ;</li>
<li><a href="../BankNoteStack">BankNoteStack</a> : seulement des billets (<em>score max. : 53 100</em>) ;</li>
<li><a href="../MoneyStack">MoneyStack</a> : pi�ces et billets (<em>score max. : 29 333</em>) ;</li>
</ul>
</div>


<h2>Le r�sultat</h2>
<h3>Fichier Flash :</h3>
<div style="border:1px solid black; width:640px; height:480px; margin:auto;">
	<object type="application/x-shockwave-flash" data="BanknoteStack.swf" width="640" height="480" >
		<param name="movie" value="BanknoteStack.swf" />
		<param name="quality" value="high" />
		<param name="wmode" value="transparent" />
		<p>Installez le plugin Flash pour voir l'animation : <a href="http://www.adobe.com/go/gntray_dl_getflashplayer_fr" >Cliquez ici pour le t�l�charger</a></p>
	</object>
</div>
<h3>Images</h3>
<p>Les images de billets utilis�s :</p>
<p>
	<img src="Images/5.jpg" alt="5 euros" />
	<img src="Images/10.jpg" alt="10 euros" />
	<img src="Images/20.jpg" alt="20 euros" />
	<img src="Images/50.jpg" alt="50 euros" />
	<img src="Images/100.jpg" alt="100 euros" />
	<img src="Images/200.jpg" alt="200 euros" />
	<img src="Images/500.jpg" alt="500 euros" />
</p>

<h4>Captures d'�cran</h4>
<p>
	<img src="Images/Thumb.png" alt="BankNoteStack miniature" />
	<img src="Images/BankNoteStack_1.jpg" class="miniatureFlash" alt="BankNoteStack Developpement" />
	<img src="Images/BankNoteStack_2.jpg" class="miniatureFlash" alt="BankNoteStack Developpement" />
	<img src="Images/BankNoteStack_3.jpg" class="miniatureFlash" alt="R�gle du jeu" />
</p>

<h2>Explications</h2>
<h3>R�gle du jeu</h3>
<p>La r�gle est extr�mement simple (c'est la m�me que <a href="../CoinStack">CoinStack</a>) : vous avez une minute pour ramasser un maximum de billets. La seule contrainte ? Vous ne pouvez ramasser que les billets en haut du tas (ceux qui ne sont pas recouverts). Dep�chez-vous, la fortune sourit aux audacieux...</p>

<h3>Score</h3>
<p>Chaque billet rapporte sa valeur en euros : 50 euros repr�sentent donc 50 points, 500 euros 500 points. Cliquer sur un billet recouvert fait perdre la valeur du billet.</p>

<p>Un peu de math�matiques :</p>
<ul>
	<li>Les 7 billets sont �quir�parties (il y en a autant de chaque type)&nbsp;; </li>
	<li>\(5+10+20+50+100+200+500 = 885\)&nbsp;; </li>
	<li>il y a 500 billets en jeu soit \(\left \lfloor \frac{500}{8} \right \rfloor = 60\) fois l'ensemble des billets. </li>
</ul>
<p>On en d�duit donc que le score maximal th�orique est de \(885 &times; 60 = 53 100\). Comme une partie dure une minute, cela impliquerait de ramasser \(\frac{500}{60}\, \simeq \, 8.3\) billets � la seconde&nbsp;! </p>


<h3>Historique</h3>
<ul>
<li>D�marrage du codage : 24/05/09, 14h</li>
<li>Version RC1 : 24/05/09 , 18h (putain de <em>separating axis theorem</em> !) (Testeurs : Patrick, Anthony, Morgan)</li>
<li>Version finale : 19/08/09 Le jeu est termin� depuis longtemps, mais les logos se sont faits d�sirer :(</li>
</ul>

<h2>T�l�chargement</h2>
<h3>Derni�re version</h3>
<p>Voir le fichier SWF, et le code.</p>

<h2>Statistiques...</h2>
<p>Player count : <?php flashPlayerStats() ?></p>
<h2>Le code</h2>
<h3>� propos du code</h3>
<p>L'ensemble des fichiers repr�sente moins de 10ko !</p>
<p><a href="Code.php">Afin d'�viter l'engorgement du serveur, le code a �t� d�centralis� sur une page externe.</a></p>
<?php
include('../footer.php');
?>
