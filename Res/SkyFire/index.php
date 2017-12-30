<?php
$Titre='SkyFire : hypnotiques feux d\'artifices.';
$Box = array("Auteur" => "Neamar","Date" => "Aout 2008", "But" =>"D�m�ler les n&oelig;uds","Voir aussi"=>'<a href="../Compiler_AS3">Compiler l\'AS3</a>',"Voir aussi"=>'<a href="../Graphe">Jeux de graphe</a>');
include('../header.php');
?>
<h1>Feux d'artifice</h1>
<p><strong>SkyFire</strong> est un mini projet sans aucun but. Il se contente de tirer des feux d'artifice � une cadence et une direction totalement al�atoire. Vous n'avez aucun contr�le dessus. Quel inter�t alors ? Aucun. Le plaisir des yeux, et c'est tout.</p>
<h2>Le r�sultat</h2>
<h3>Fichier Flash :</h3>
<div style="border:1px solid black; width:800px; height:600px; margin:auto;">
	<object type="application/x-shockwave-flash" data="SkyFire.swf" width="800" height="600" >
		<param name="movie" value="SkyFire.swf" />
		<param name="quality" value="high" />
		<param name="wmode" value="transparent" />
		<p>Installez le plugin Flash pour voir l'animation : <a href="http://www.adobe.com/go/gntray_dl_getflashplayer_fr" >Cliquez ici pour le t�l�charger</a></p>
	</object>
</div>
<h3>Images</h3>

<h4>Feux d'artifice "Fontaines"</h4>
<p>Les fontaines sont toutes blanches, ont peu d'�nergies et volent bas sans exploser ni projeter d'�tincelles</p>
<p><img src="Images/Fontaines.png" alt="Explosion de feux d'artifices de type fontaines" /></p>

<h4>Feux d'artifice "Rampant"</h4>
<p>Les rampant sont comme les fontaines, mais multicolores et plus �n�rg�tiques (ils volent plus haut, plus vite).</p>
<p><img src="Images/Rampant.png" alt="Explosion de feux d'artifices de type rampant" /></p>

<h4>Feux d'artifice "Pchitter"</h4>
<p>Les pchitters volent tr�s simplement, en projetant autour d'eux des gerbes d'�tincelles lors de leur parcours. � leur descente, ils n'ont plus aucune �nergie, et s'�teignent donc dans le noir de l'espace..</p>
<p><img src="Images/Pchitter.png" alt="Explosion de feux d'artifices de type pchitter" /></p>


<h4>Feux d'artifice "Boomer"</h4>
<p>Les boomers sont tous rouges...et explosent � leur apog�e en une trentaines de rampant qui retombent au sol..</p>
<p><img src="Images/Boomer.png" alt="Explosion de feux d'artifices de type boomer" /></p>
<p><img src="Images/Boomer2.png" alt="Explosion de feux d'artifices de type boomer" /></p>

<h4>Feux d'artifice "Bi-Boomer"</h4>
<p>Les Bi-boomers sont rouges. Ils explosent � leur apog�e comme les feux de type boomer, non pas en rampant, mais en boomer... et chaque boomer explosera � son tour. Bref, l'arriv�e d'un bi-boomer est l'occasion de remplir l'�cran de particules incandescentes.</p>
<p><img src="Images/BiBoomer.png" alt="Explosion de feux d'artifices de type bi-boomer" /></p>
<p><img src="Images/BiBoomer2.png" alt="Explosion de feux d'artifices de type bi-boomer" /></p>

<h4>Feux d'artifice "Boomer-Pchitter"</h4>
<p>Les Boomer-Pchitter explosent en une corolle d'�tincelles tr�s nombreuses mais paradoxalement peu �nerg�tiques. Leur cycle de vie ne d�passe pas quelques secondes, mais ces quelques secondes de vie sont superbes.</p>
<p><img src="Images/BoomerPchitter.png" alt="Explosion de feux d'artifices de type boomer pchitter" /></p>
<p><img src="Images/BoomerPchitter2.png" alt="Explosion de feux d'artifices de type boomer pchitter" /></p>

<h4>Pot Pourri</h4>
<p>En m�langeant tous les feux d'artifices, on obtient un spectacle digne d'un 14 juillet :).</p>
<p><img src="Images/Global.png" alt="Explosion de feux d'artifices" /></p>
<p><img src="Images/Global2.png" alt="Explosion de feux d'artifices" /></p>
<p><img src="Images/Global3.png" alt="Explosion de feux d'artifices" /></p>

<h2>T�l�chargement</h2>
<h3>Derni�re version :</h3>
<p>Voir le fichier SWF, et le code.</p>
<h3>Sauvegardes</h3>
<p>Les sauvegardes sont r�alis�es sur une base plus ou moins r�guli�re, lorsque le code a �t� am�lior� significativement depuis la sauvegarde pr�cedente.</p>
<ul>
<li><a href="Release/SkyFire3.zip">Sauvegarde du 20/12/08</a></li>
<li><a href="Release/SkyFire3.zip">Sauvegarde du 6/12/08</a></li>
<li><a href="Release/SkyFire2.zip">Sauvegarde du 03/12/08</a></li>
<li><a href="Release/SkyFire.zip">Sauvegarde du 30/11/08</a></li>
</ul>
<h3>Historique des versions</h3>
<p>Cette animation a �t� programm�e en quelques jours, voire m�me quelques heures... son historique est donc assez limit�e.</p>
<ul>
<li>D�marrage du codage : 29/11/08</li>
<li>Version &alpha; : &empty; (Am�lie, M.A)</li>
<li>Version &beta; : &empty; (Cl�m, Tony, KissCoool, BJ)</li>
<li>Version RC1 : 6/12/08</li>
</ul>
<h2>Le code</h2>
<h3>� propos du code</h3>
<p><a href="Code.php">Afin d'�viter l'engorgement du serveur, le code a �t� d�centralis� sur une page externe.</a></p>
<?php
include('../footer.php');
?>
