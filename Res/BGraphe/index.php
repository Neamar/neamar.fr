<?php
$Titre='Un (autre) jeu de graphe';
$Box = array("Auteur" => "Neamar","Date" => "Aout 2008", "But" =>"D�m�ler les n&oelig;uds","Voir aussi"=>'<a href="../Compiler_AS3/">Compiler l\'AS3</a>',"Voir aussi"=>'<a href="../Graphe/">Jeux de graphe</a>');
$AddLine=<<<EOF
  <script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      tex2jax: {inlineMath: [['\\\\(','\\\\)']]}
    });
    </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=TeX-MML-AM_CHTML"></script>
EOF;
include('../header.php');
?>
<h1>Un jeu de reflexion en Flash</h1>
<p class="erreur">Ce jeu fait partie de la saga des Graphes. Voir les liens dans le menu � droite pour plus de d�tails</p>
<h2>Le r�sultat</h2>
<h3>Fichier Flash :</h3>
<div style="border:1px solid black; width:640px; height:480px; margin:auto;">
	<object type="application/x-shockwave-flash" data="Bgraphe.swf" width="640" height="480" >
		<param name="movie" value="Bgraphe.swf" />
		<param name="quality" value="high" />
		<param name="wmode" value="transparent" />
		<p>Installez le plugin Flash pour voir l'animation : <a href="http://www.adobe.com/go/gntray_dl_getflashplayer_fr" >Cliquez ici pour le t�l�charger</a></p>
	</object>
</div>
<h3>Images</h3>
<p>Passez votre souris par dessus une image pour l'afficher.</p>
<h4>Version &alpha;</h4>
<p>
	<img src="Images/ALPHA-1.png" class="miniatureFlash" alt="Capture de B-Graphe" />
	<img src="Images/ALPHA-2.png" class="miniatureFlash" alt="Capture de B-Graphe" />
</p><hr /><p>
	<img src="Images/ALPHA-3.png" class="miniatureFlash" alt="Capture de B-Graphe" />
</p>
<h4>Version &beta;</h4>
<p>
	<img src="Images/BETA-1.png" class="miniatureFlash" alt="Capture de B-Graphe" />
	<img src="Images/BETA-2.png" class="miniatureFlash" alt="Capture de B-Graphe" />
</p>
<h4>Version <em>Release Candidate</em></h4>
<p>
	<img src="Images/RC-1.png" class="miniatureFlash" alt="Capture de B-Graphe" />
	<img src="Images/RC-2.png" class="miniatureFlash" alt="Capture de B-Graphe" />
</p><hr /><p>
	<img src="Images/RC-3.png" class="miniatureFlash" alt="Capture de B-Graphe" />
</p>
<h4>Version <em>Release Candidate 2</em></h4>
<p>BGraphe a rencontr� un probl�me important dans sa version RC1 : le jeu crashait sous Internet Explorer, sur plateforme  Vista. Apr�s modification du code, il s'est av�r� que le probl�me venait d'une trop grosse utilisation des filtres...bref, r�-optimisation globale du jeu.</p>
<p>
	<img src="Images/RC2-1.png" class="miniatureFlash" alt="Capture de B-Graphe" />
	<img src="Images/RC2-2.png" class="miniatureFlash" alt="Capture de B-Graphe" />
</p><hr /><p>
	<img src="Images/RC2-3.png" class="miniatureFlash" alt="Capture de B-Graphe" />
</p>

<h4>Fond retenu</h4>
<p>
	<img src="Images/Fond.png" class="miniatureFlash" alt="Fond retenu pour l'application (B-Graphe ArtWork)" />
</p>
<h2>Explications</h2>
<h3>R�gle du jeu</h3>
<p><img src="Images/Graphe_Planaire.png" alt="Un exemple de graphe standard transform� en graphe planaire" /></p>
<p>La r�gle de B-Graphe est extr�mement simple : il faut et il suffit de supprimer toutes les intersections entre les lignes. Pour cela, il faut agir sur les noeuds (represent�s par un rond). Rien de bien compliqu�...et pourtant !</p>
<p>Les ar�tes en rouge sont les ar�tes avec une intersection, il faut les corriger.</p>
<h3>A propos du concept</h3>
<p><img src="https://upload.wikimedia.org/wikipedia/fr/a/a2/Graphe_K5.png" alt="K5" /><img src="https://upload.wikimedia.org/wikipedia/fr/3/3c/Graphe_K3%2C3.png" alt="K3,3" />Ce jeu utilise un graphe non-orient�, et cherche � le representer sous forme planaire.<br />
Le concept est extr�mement simple, mais la solution n'est pas toujours facile, loin de l� !</p>
<p>D'un point de vue math�matique, deux algorithmes �connus� permettant de d�terminer la planarit� d'un graphe. L'un deux, relativement simple � comprendre, se limite � montrer que le graphe n'est une expansion ni de K<sub>5</sub>, ni de K<sub>3,3</sub> (les deux graphes repr�sent�s ci-contre). Pour des explications plus math�matiques, je vous invite � consulter <a href="http://fr.wikipedia.org/wiki/Graphe_planaire" rel="nofollow">cette page</a>.</p>

<h3>Estimation de la complexit�</h3>
<p>Un mini algorithme tente d'attribuer � chaque niveau une complexit�. Cette complexit� est calcul�e de fa�on tr�s empirique. Elle prend en compte le nombre de noeuds, mais aussi le nombre moyen d'arcs par sommet, et attribue un bonus aux niveaux ayant un fort ratio :<br />
\(\frac{3}{2} * \frac{Nb_{Liens}}{Nb_{Noeuds}} + \frac{Nb_{Noeuds}}{35} + \frac{Nb_{Liens}}{30} + \frac{1}{5}*(\frac{Nb_{Liens}}{2.2} - Nb_{Noeuds})'\)</p>

<h2>Mods</h2>
<h3 id="Createur">Cr�ation de niveau</h3>
<p>B-Graphe inclut un �diteur de niveaux.<br />
Pour comprendre son fonctionnement, il faut d'abord comprendre le fonctionnement du moteur interne :<br />
Chaque niveau est d�fini, non par des noeuds, mais par des liens, un lien englobant deux noeuds.<br />
Le moteur interne d�termine de lui m�me le nombre de noeuds (en trouvant le maximum dans les couples de noeuds). Une fois ce maximum trouv�, tous les noeuds sont g�n�r�s, et le moteur parcourt le tableau des liens et les ajoute graphiquement.<br />
Enfin, les noeuds sont plac�s de fa�on al�atoire (autour d'un cercle), et affich�s � l'�cran.</p>
<p>Pour l'�diteur, cela signifie qu'il suffit juste d'indiquer les couples, tout le reste �tant g�r� de fa�on interne.<br />
Un couple, comme dit plus haut, est d�fini par deux noeuds. On prend pour convention de s�parer ces deux noeuds par une virgule �,�. Les couples sont s�par�s par un � | � pipe (alt gr + 6 sur un clavier franco belge).<br />Derni�re convention, la liste des noeuds commence � 0.</p>
<p>Un exemple concret pour mettre tout cela en pratique :<br />
<img src="Images/ExempleCreateur.png" alt="Un exemple de niveau" />Pour r�aliser le graphe ci contre, on utilisera donc ce code : <em>1,2|1,5|2,3|3,4|4,5|4,6</em>.</p>
<p>Que remarque-t-on ? M�me si aucun lien ne pointait vers 0, un noeud n�0 a quand m�me �t� cr�e, et n'est rattach� � aucun autre. Les plus assidus remarqueront qu'en chargant deux fois le niveau, ils obtiennent deux configurations diff�rentes...normal, puisque l'ordre des noeuds est recalcul� al�atoirement � chaque fois.</p>

<h2>T�l�chargement</h2>
<h3>Derni�re version :</h3>
<p>Voir le fichier SWF, et le code.</p>
<h3>Sauvegardes</h3>
<p>Les sauvegardes sont r�alis�es sur une base plus ou moins r�guli�re, lorsque le code a �t� am�lior� significativement depuis la sauvegarde pr�cedente.</p>
<ul>
<li><a href="Release/B-graphe_SVG8.zip">Sauvegarde du 19/10/08, version finalis�e</a></li>
<li><a href="Release/B-graphe_SVG7.zip">Sauvegarde du 28/09/08</a></li>
<li><a href="Release/B-graphe_SVG6.zip">Sauvegarde du 21/09/08, soir�e</a></li>
<li><a href="Release/B-graphe_SVG5.zip">Sauvegarde du 21/09/08, matin</a></li>
<li><a href="Release/B-graphe_SVG4.zip">Sauvegarde du 09/09/08</a></li>
<li><a href="Release/B-graphe_SVG3.zip">Sauvegarde du 18/08/08</a></li>
<li><a href="Release/B-graphe_SVG2.zip">Sauvegarde du 13/08/08</a></li>
<li><a href="Release/B-graphe_SVG1.zip">Sauvegarde du 13/08/08</a></li>
<li><a href="Release/B-graphe_SVG0.zip">Sauvegarde du 12/08/08</a></li>
</ul>
<h3>Historique des versions</h3>
<ul>
<li>D�marrage du codage : 12/08/08</li>
<li>Version &alpha; : 12/08/08 (Testeurs : Am�lie, Etienne P.)</li>
<li>Version &beta; : 14/08/08 (Testeurs : M.A, Kisscoool, Nano, Morgan, Camille, Patrick, Coco, MyGB, Tefandil)</li>
<li>Version RC1 : 21/09/08</li>
</ul>
<h2>Statistiques...</h2>
<p>Player count : <?php flashPlayerStats() ?></p>

<h2>Le code</h2>
<h3>� propos du code</h3>
<p>Le code est r�parti en classes claires et nettes.<br />L'ensemble du fichier repr�sente moins de 10ko !</p>
<p><a href="Code.php">Afin d'�viter l'engorgement du serveur, le code a �t� d�centralis� sur une page externe.</a></p>
<h3>Solution de Bgraphe</h3>
<p>Pour les plus frustr�s, la solution est disponible sur ce serveur...<br />
Mais je n'allais pas non plus la marquer directement ! Regardez un peu le code source de cette page...ou sinon, trouvez l'URL ! Ce n'est pas bien dur, je vous rassure...<!--Les solutions : http://neamar.fr/Res/BGraphe/Solutions.php--><br />
Ces solutions ne vous seront pas forc�ment utiles, puisque les noeuds n'ont pas de num�ros...mais si cela vous fait plaisir !</p>
<?php
include('../footer.php');
?>
