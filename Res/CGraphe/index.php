<?php
$Titre='Un troisi�me jeu de graphe';
$Box = array("Auteur" => "Neamar","Date" => "Novembre 2008", "But" =>"Gagner !","Voir aussi"=>'<a href="../Compiler_AS3">Compiler l\'AS3</a>',"Voir aussi"=>'<a href="../Graphe">Jeux de graphe</a>');
include('../header.php');
?>
<h1>Un jeu en tour par tour en Flash</h1>
<p class="erreur">Ce jeu fait partie de la saga des Graphes. Voir les liens dans le menu � droite pour plus de d�tails</p>
<h2>Le r�sultat</h2>
<h3>Fichier Flash :</h3>
<div style="border:1px solid black; width:640px; height:480px; margin:auto;">
	<object type="application/x-shockwave-flash" data="Cgraphe.swf" width="640" height="480" >
		<param name="movie" value="Cgraphe.swf" />
		<param name="quality" value="high" />
		<param name="wmode" value="transparent" />
		<p>Installez le plugin Flash pour voir l'animation : <a href="http://www.adobe.com/go/gntray_dl_getflashplayer_fr" >Cliquez ici pour le t�l�charger</a></p>
	</object>
</div>
<h3>Images</h3>
<p>Passez votre souris par dessus une image pour l'afficher.</p>
<h4>Version &alpha;</h4>
<p>
	<img src="Images/Alpha-1.png" class="miniatureFlash" alt="Capture de C-Graphe" />
	<img src="Images/Alpha-2.png" class="miniatureFlash" alt="Capture de C-Graphe" />
</p><hr /><p>
	<img src="Images/Alpha-3.png" class="miniatureFlash" alt="Capture de C-Graphe" />
	<img src="Images/Alpha-4.png" class="miniatureFlash" alt="Capture de C-Graphe" />
</p><hr /><p>
	<img src="Images/Alpha-5.png" class="miniatureFlash" alt="Capture de C-Graphe" />
</p>
<h4>Version &beta;</h4>
<p>
<img src="Images/Beta-1.png" class="miniatureFlash" alt="Capture de C-Graphe" />
<img src="Images/Beta-2.png" class="miniatureFlash" alt="Capture de C-Graphe" />
</p><hr /><p>
<img src="Images/Beta-3.png" class="miniatureFlash" alt="Capture de C-Graphe" />
<img src="Images/Beta-4.png" class="miniatureFlash" alt="Capture de C-Graphe" />
</p>
<h4>Fond retenu</h4>
<p>Le fond de l'application est g�n�r� dynamiquement � l'aide de bruit de Perlin. Il n'y a donc pas de fichiers image comme pour les autres jeux.</p>
<h2>Explications</h2>
<h3>R�gle du jeu</h3>
<p>C-Graphe est un jeu :</p>
<ol>
<li>Opposant deux joueurs ou deux �quipes (ou seul contre un ordinateur � intelligent �)</li>
<li>Dans lequel les joueurs ou �quipes jouent � tour de r�le</li>
<li>Dont tous les �l�ments sont connus (jeu � information compl�te)</li>
<li>O� le hasard n'intervient pas pendant le d�roulement du jeu</li>
</ol>
<p>Il s'agit en cons�quence d'un jeu de strat�gie combinatoire abstrait, qui se joue sur un graphe avec deux noeuds sp�ciaux (les extremit�s) et qui oppose deux joueurs (d�nomm�s <strong>Coupheur</strong> et <strong>Paintre</strong>).<br />
Pendant son tour, <strong>Paintre</strong> colore un trait existant.<br />
Pendant son tour, <strong>Coupheur</strong> supprime un trait existant.</p>
<p>Si Coupheur r�ussit � s�parer le graphe en deux graphes distincts (chacun contenant une extremit�), alors Coupheur gagne.</p>
<p>Si Paintre r�ussit � connecter les deux extremit�s par des ar�tes color�es, il remporte le jeu.</p>

<h3>A propos du concept</h3>
<p><img src="https://upload.wikimedia.org/wikipedia/en/thumb/3/38/Shannon_game_graph.svg/175px-Shannon_game_graph.svg.png" alt="Un jeu en cours" /></p>
<p>Ce jeu est directement inspir� d'un jeu de graphe : �Shannon Switching Game�. Le jeu est le m�me, les deux joueurs se pr�nommant dans la version originale Short et Cut.</p>
<p><a href="http://en.wikipedia.org/wiki/Shannon_switching_game" rel="no follow"></a></p>

<h3>L'intelligence artificielle</h3>
<p>Le probl�me du jeu �tait de cr�er une intelligence qui ne soit ni imbattable, ni compl�tement cr�dule</p>
<p>Math�matiquement, il existe des algorithmes qui permettrait d'assurer la victoire � l'ordinateur : je renverrais le lecteur curieux vers <a href="http://sky.fit.qut.edu.au/~maire/ALL/2004%20connectioin%20game%20book%20appendix%20%20maire-shannon.PDF" rel="no follow">ce PDF</a>, ou vers l'article d'IBM <em>An implemented graph algorithm for winning shannon switching game</em>. Cependant, l'inter�t de jouer contre un ordinateur imbattable est extr�mement restreint, de m�me que de jouer contre un ordinateur incoh�rent avec ses pr�c�dentes actions.</p>

<p>Face � ce dilemme, j'ai choisi d'imiter le comportement humain, et voici donc un r�sum� de la fa�on qu'� votre PC de comprendre le jeu.<br />
Basiquement, l'ordinateur calcule une liste de chemins et joue l'ar�te qui est pr�sente dans le plus de chemins.<br />
Ce comportement est bien entendu plus raffin�, puisqu'il fait en sorte de pond�rer chque ar�te en fonction de la taille du chemin et de quelques autres param�tres, tels que le nombre de coups d�j� jou�s � dans la zone �.<br />
Cette IA calcule tous les chemins possibles dans la carte, en faisant bien �videmment en sorte de ne pas prendre de doublons ou de chemins inutiles (ainsi, faire une boucle est compl�tement inutile, de m�me que repasser par une ar�te d�j� utilis�e dans le chemin).<br />
Une fois cette liste de chemins d�termin�es, toutes les ar�tes sont examin�es et pond�r�es en fonction de l'inverse de la taille du chemin. Une chemin qui comprend trois ar�te affectera chaque ar�te d'un coefficient 1/3, qui s'ajoutera � tous les autres chemins qui passent par l�. Si une ar�te du chemin a d�j� �t� jou�e, elle ne compte pas dans la taille : autrement dit, un chemin de taille 5 qui contient 2 traits jou�s par <em>Paintre</em> ajoutera aux trois autres lignes un coefficient d'un tiers.<br />

Enfin, l'ordinateur r�cup�re dans la liste des ar�tes celle qui a le plus gros coefficient, et la joue.</p>

<p>Apr�s plusieurs tests, il s'est av�r� que l'IA la plus r�active et dont les comportements �taient les plus int�ressants �tait celle que j'avais affectueusement nomm�e <q>la carr�e</q>.<br />
Celle-ci, au lieu de donner � chaque arete l'inverse de la taille du chemin, affectait l'inverse du carr� de la taille du chemin : 1/9 pour un chemin de taille 3. Cela permettait de minimiser au maximum les chemins trop longs pour �tre envisag�s, puisque le poids d'un chemin d�croit <q>au carr�</q>.</p>

<p>Sur cette id�e de base s'ajoutent plusieursconcepts, tels que la d�termination des ar�tes inutiles, e.g la structure ----------o----------- qui est proprement injouable : jouer un trait d'un c�t� forcera l'autre joueur � couper le second cot�, n'amenant rien au jeu. Des cas plus complexes sont aussi envisag�s, afin de minimiser au maximum les incoh�rences et les tours "stupides".</p>

<p>Vous pouvez voir l'intelligence artificielle � l'oeuvre en activant le mode DEBUG (mettez la valeur correspondante dans le fichier Const.as). Vous trouverez aussi des swf en mode d�bug dans toutes les versions de sauvegarde pr�c�dant la 8.<br />
Ce mode affiche le poids de chaque ar�te ainsi que les ar�tes "non utilisables".</p>

<h2>T�l�chargement</h2>
<h3>Derni�re version :</h3>
<p>Voir le fichier SWF, et le code.</p>
<h3>Sauvegardes</h3>
<p>Les sauvegardes sont r�alis�es sur une base plus ou moins r�guli�re, lorsque le code a �t� am�lior� significativement depuis la sauvegarde pr�cedente.<br />
Dans le cas de C-Graphe, le code a �t� d�velopp� de fa�on sporadique sur plusieurs mois, d'o� les intervalles entre sauvegardes.
Chaque sauvegarde contient une version swf du jeu tel qu'il �tait � l'�poque.</p>
<ul>
<li><a href="Release/C-graphe-0.zip">Sauvegarde du 18/10/08</a></li>
<li><a href="Release/C-graphe-1.zip">Sauvegarde du 25/10/08</a></li>
<li><a href="Release/C-graphe-2.zip">Sauvegarde du 30/10/08</a></li>
<li><a href="Release/C-graphe-3.zip">Sauvegarde du 30/10/08</a></li>
<li><a href="Release/C-graphe-4.zip">Sauvegarde du 31/10/08</a></li>
<li><a href="Release/C-graphe-5.zip">Sauvegarde du 31/10/08</a></li>
<li><a href="Release/C-graphe-6.zip">Sauvegarde du 6/01/09 (pause dans le d�veloppement)</a></li>
<li><a href="Release/C-graphe-7.zip">&beta; Sauvegarde du 1/02/09 </a></li>
<li><a href="Release/C-graphe-8.zip">RC-1 Sauvegarde du 6/02/09 </a></li>
</ul>
<h3>Historique des versions</h3>
<ul>
<li>D�marrage du codage : 10/10/08</li>
<li>Version &alpha; : 20/10/08 (Testeurs : Damien, Patrick, Am�lie, Cl�ment, Damien, Clotilde, Etienne P.)</li>
<li>Version &beta; : 1/02/09 (Testeurs : XHTML_Boy, Jean Martin, MyGB, Morgan, M.A, Yannish, Sylvain, Geoffrey, Nico, Etienne V.)</li>
<li>Version RC-1 : 8/02/09 (Testeurs : Tefandil, Laurie, Membres du SDZ)</li>
<li>Version anglaise : traduction par Yannish (1/03/09)</li>
</ul>
<h2>Le code</h2>
<h3>� propos du code</h3>
<p>Le code est r�parti en classes claires et nettes.<br />L'ensemble du fichier repr�sente moins de 10ko !</p>
<p><a href="Code.php">Afin d'�viter l'engorgement du serveur, le code a �t� d�centralis� sur une page externe.</a></p>
<?php
include('../footer.php');
?>
