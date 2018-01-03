<?php
$Titre='Un troisième jeu de graphe';
$Box = array("Auteur" => "Neamar","Date" => "Novembre 2008", "But" =>"Gagner !","Voir aussi"=>'<a href="../Compiler_AS3">Compiler l\'AS3</a>',"Voir aussi"=>'<a href="../Graphe">Jeux de graphe</a>');
include('../header.php');
?>
<h1>Un jeu en tour par tour en Flash</h1>
<p class="erreur">Ce jeu fait partie de la saga des Graphes. Voir les liens dans le menu à droite pour plus de détails</p>
<h2>Le résultat</h2>
<h3>Fichier Flash :</h3>
<div style="border:1px solid black; width:640px; height:480px; margin:auto;">
	<object type="application/x-shockwave-flash" data="Cgraphe.swf" width="640" height="480" >
		<param name="movie" value="Cgraphe.swf" />
		<param name="quality" value="high" />
		<param name="wmode" value="transparent" />
		<p>Installez le plugin Flash pour voir l'animation : <a href="http://www.adobe.com/go/gntray_dl_getflashplayer_fr" >Cliquez ici pour le télécharger</a></p>
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
<p>Le fond de l'application est généré dynamiquement à l'aide de bruit de Perlin. Il n'y a donc pas de fichiers image comme pour les autres jeux.</p>
<h2>Explications</h2>
<h3>Règle du jeu</h3>
<p>C-Graphe est un jeu :</p>
<ol>
<li>Opposant deux joueurs ou deux équipes (ou seul contre un ordinateur « intelligent »)</li>
<li>Dans lequel les joueurs ou équipes jouent à tour de rôle</li>
<li>Dont tous les éléments sont connus (jeu à information complète)</li>
<li>Où le hasard n'intervient pas pendant le déroulement du jeu</li>
</ol>
<p>Il s'agit en conséquence d'un jeu de stratégie combinatoire abstrait, qui se joue sur un graphe avec deux noeuds spéciaux (les extremités) et qui oppose deux joueurs (dénommés <strong>Coupheur</strong> et <strong>Paintre</strong>).<br />
Pendant son tour, <strong>Paintre</strong> colore un trait existant.<br />
Pendant son tour, <strong>Coupheur</strong> supprime un trait existant.</p>
<p>Si Coupheur réussit à séparer le graphe en deux graphes distincts (chacun contenant une extremité), alors Coupheur gagne.</p>
<p>Si Paintre réussit à connecter les deux extremités par des arêtes colorées, il remporte le jeu.</p>

<h3>A propos du concept</h3>
<p><img src="https://upload.wikimedia.org/wikipedia/en/thumb/3/38/Shannon_game_graph.svg/175px-Shannon_game_graph.svg.png" alt="Un jeu en cours" /></p>
<p>Ce jeu est directement inspiré d'un jeu de graphe : «Shannon Switching Game». Le jeu est le même, les deux joueurs se prénommant dans la version originale Short et Cut.</p>
<p><a href="http://en.wikipedia.org/wiki/Shannon_switching_game" rel="no follow"></a></p>

<h3>L'intelligence artificielle</h3>
<p>Le problème du jeu était de créer une intelligence qui ne soit ni imbattable, ni complètement crédule</p>
<p>Mathématiquement, il existe des algorithmes qui permettrait d'assurer la victoire à l'ordinateur : je renverrais le lecteur curieux vers <a href="http://sky.fit.qut.edu.au/~maire/ALL/2004%20connectioin%20game%20book%20appendix%20%20maire-shannon.PDF" rel="no follow">ce PDF</a>, ou vers l'article d'IBM <em>An implemented graph algorithm for winning shannon switching game</em>. Cependant, l'interêt de jouer contre un ordinateur imbattable est extrêmement restreint, de même que de jouer contre un ordinateur incohérent avec ses précédentes actions.</p>

<p>Face à ce dilemme, j'ai choisi d'imiter le comportement humain, et voici donc un résumé de la façon qu'à votre PC de comprendre le jeu.<br />
Basiquement, l'ordinateur calcule une liste de chemins et joue l'arête qui est présente dans le plus de chemins.<br />
Ce comportement est bien entendu plus raffiné, puisqu'il fait en sorte de pondérer chque arête en fonction de la taille du chemin et de quelques autres paramètres, tels que le nombre de coups déjà joués « dans la zone ».<br />
Cette IA calcule tous les chemins possibles dans la carte, en faisant bien évidemment en sorte de ne pas prendre de doublons ou de chemins inutiles (ainsi, faire une boucle est complètement inutile, de même que repasser par une arête déjà utilisée dans le chemin).<br />
Une fois cette liste de chemins déterminées, toutes les arêtes sont examinées et pondérées en fonction de l'inverse de la taille du chemin. Une chemin qui comprend trois arête affectera chaque arête d'un coefficient 1/3, qui s'ajoutera à tous les autres chemins qui passent par là. Si une arête du chemin a déjà été jouée, elle ne compte pas dans la taille : autrement dit, un chemin de taille 5 qui contient 2 traits joués par <em>Paintre</em> ajoutera aux trois autres lignes un coefficient d'un tiers.<br />

Enfin, l'ordinateur récupére dans la liste des arêtes celle qui a le plus gros coefficient, et la joue.</p>

<p>Après plusieurs tests, il s'est avéré que l'IA la plus réactive et dont les comportements étaient les plus intéressants était celle que j'avais affectueusement nommée <q>la carrée</q>.<br />
Celle-ci, au lieu de donner à chaque arete l'inverse de la taille du chemin, affectait l'inverse du carré de la taille du chemin : 1/9 pour un chemin de taille 3. Cela permettait de minimiser au maximum les chemins trop longs pour être envisagés, puisque le poids d'un chemin décroit <q>au carré</q>.</p>

<p>Sur cette idée de base s'ajoutent plusieursconcepts, tels que la détermination des arêtes inutiles, e.g la structure ----------o----------- qui est proprement injouable : jouer un trait d'un côté forcera l'autre joueur à couper le second coté, n'amenant rien au jeu. Des cas plus complexes sont aussi envisagés, afin de minimiser au maximum les incohérences et les tours "stupides".</p>

<p>Vous pouvez voir l'intelligence artificielle à l'oeuvre en activant le mode DEBUG (mettez la valeur correspondante dans le fichier Const.as). Vous trouverez aussi des swf en mode débug dans toutes les versions de sauvegarde précédant la 8.<br />
Ce mode affiche le poids de chaque arête ainsi que les arêtes "non utilisables".</p>

<h2>Téléchargement</h2>
<h3>Dernière version :</h3>
<p>Voir le fichier SWF, et le code.</p>
<h3>Sauvegardes</h3>
<p>Les sauvegardes sont réalisées sur une base plus ou moins régulière, lorsque le code a été amélioré significativement depuis la sauvegarde précedente.<br />
Dans le cas de C-Graphe, le code a été développé de façon sporadique sur plusieurs mois, d'où les intervalles entre sauvegardes.
Chaque sauvegarde contient une version swf du jeu tel qu'il était à l'époque.</p>
<ul>
<li><a href="Release/C-graphe-0.zip">Sauvegarde du 18/10/08</a></li>
<li><a href="Release/C-graphe-1.zip">Sauvegarde du 25/10/08</a></li>
<li><a href="Release/C-graphe-2.zip">Sauvegarde du 30/10/08</a></li>
<li><a href="Release/C-graphe-3.zip">Sauvegarde du 30/10/08</a></li>
<li><a href="Release/C-graphe-4.zip">Sauvegarde du 31/10/08</a></li>
<li><a href="Release/C-graphe-5.zip">Sauvegarde du 31/10/08</a></li>
<li><a href="Release/C-graphe-6.zip">Sauvegarde du 6/01/09 (pause dans le développement)</a></li>
<li><a href="Release/C-graphe-7.zip">&beta; Sauvegarde du 1/02/09 </a></li>
<li><a href="Release/C-graphe-8.zip">RC-1 Sauvegarde du 6/02/09 </a></li>
</ul>
<h3>Historique des versions</h3>
<ul>
<li>Démarrage du codage : 10/10/08</li>
<li>Version &alpha; : 20/10/08 (Testeurs : Damien, Patrick, Amélie, Clément, Damien, Clotilde, Etienne P.)</li>
<li>Version &beta; : 1/02/09 (Testeurs : XHTML_Boy, Jean Martin, MyGB, Morgan, M.A, Yannish, Sylvain, Geoffrey, Nico, Etienne V.)</li>
<li>Version RC-1 : 8/02/09 (Testeurs : Tefandil, Laurie, Membres du SDZ)</li>
<li>Version anglaise : traduction par Yannish (1/03/09)</li>
</ul>
<h2>Le code</h2>
<h3>À propos du code</h3>
<p>Le code est réparti en classes claires et nettes.<br />L'ensemble du fichier représente moins de 10ko !</p>
<p><a href="Code.php">Afin d'éviter l'engorgement du serveur, le code a été décentralisé sur une page externe.</a></p>
<?php
include('../footer.php');
?>
