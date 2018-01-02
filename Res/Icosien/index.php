<?php
$Titre='Le jeu Icosien';
$Box = array("Auteur" => "Neamar","Date" => "Juin 2010", "But" =>"Finir le jeu","Voir aussi"=>'<a href="../Compiler_AS3">Compiler l\'AS3</a>',"Voir aussi"=>'<a href="../Graphe">Jeux de graphe</a>');
include('../header.php');

$Flash ='/Res/Icosien/Icosien.swf';
?>
<h1 style="text-align:center;"><img src="Images/assets/Icosien.png" alt="Le jeu icosien en Flash" class="nonflottant"/></h1>
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

<div style="border:1px dotted red">
<p>Icosien est aussi disponible en version mobile, sans publicité et avec encore plus de niveaux !</p>
<ul>
	<li><a href="https://play.google.com/store/apps/details?id=air.neamar.Icosien">Icosien sur le Google Play Store (Android)</a></li>
	<li><a href="http://appworld.blackberry.com/webstore/content/104908/">Icosien pour Blackberry</a></li>
</ul>
</div>

<h2>Explications</h2>

<p>Ce jeu a fait l'objet de plusieurs publications ; elles sont listées ici.</p>

<p>Articles sur l'algorithmie derrière le jeu :</p>
<ul>
	<li><a href="http://blog.neamar.fr/component/content/article/18-algorithmie-et-optimisation/119-mouvement-intuitif-graphe-souris">Déplacement intuitif sur un graphe</a></li>
	<li><a href="http://blog.neamar.fr/component/content/article/18-algorithmie-et-optimisation/129-algorithme-cycle-hamiltonien-graphe">Trouver un cycle hamiltonien dans un graphe</a></li>
</ul>

<p>Articles sur des petites astuces de programmation AS3 :</p>
<ul>
	<li><a href="http://blog.neamar.fr/component/content/article/15-as3/133-clic-droit-flash-as3">Modifier le menu clic droit de Flash Player en as3</a></li>
	<li><a href="http://blog.neamar.fr/component/content/article/15-as3/128-for-each-in-ajout-suppression-changement-variable">Fonctionnement du <tt>foreach</tt> as3 dans les cas particuliers</a></li>
	<li><a href="http://blog.neamar.fr/component/content/article/15-as3/127-as3-snippets-double-click-keyboard">Faire fonctionner le double clic Flash</a></li>
	<li><a href="http://blog.neamar.fr/component/content/article/15-as3/127-as3-snippets-double-click-keyboard">Le <tt>listener</tt> du clavier ne marche pas !</a></li>
	<li><a href="http://blog.neamar.fr/component/content/article/15-as3/126-string-multilignes-heredoc-as3">Définir un <tt>string</tt> sur plusieurs lignes dans le code source as3</a></li>
	<li><a href="http://blog.neamar.fr/component/content/article/15-as3/125-enchassement-ressource-as3">Enchâsser une ressource dans un fichier flash pour ne pas la charger</a></li>
	<li><a href="http://blog.neamar.fr/component/content/article/15-as3/124-effet-miroir-bitmap-as3">Donner un effet miroir à un <tt>Bitmap</tt></a></li>
</ul>

<p>Articles sur le jeu :</p>
<ul>
	<li><a href="http://blog.neamar.fr/component/content/article/6-flash-game/123-icosien-alpha-beta">Annonce du jeu</a></li>
	<li><a href="http://blog.neamar.fr/component/content/article/6-flash-game/143-presentation-icosien-release">Présentation du jeu</a></li>
	<li><a href="http://blog.neamar.fr/component/content/article/15-as3/137-images-icosien">De rien du tout au jeu : génèse d'Icosien</a></li>
	<li><a href="http://blog.neamar.fr/component/content/article/6-flash-game/149-icosien-suite-et-fin-la-solution">La solution du jeu</a></li>

</ul>

<h3>Règle du jeu</h3>
<p>La règle est expliquée dans le jeu. Vous la retrouverez ici :</p>
<ol>
<li><strong>Première partie : Euler</strong>. <p>Reproduisez le motif gris d'un seul mouvement de souris, sans repasser deux fois sur le même trait (mais les croisements de fil sont autorisés).<br /> Double cliquez pour recommencer !</p><p>Ayez des mouvements amples de souris, imaginez que vous tirez un fil derrière vous : pas besoin de frôler les clous !</p><p>Pour commencer à jouer, entraînez-vous sur la flèche ci-dessous.<br />Cliquez sur un clou pour attacher votre corde et commencer.</p></li>
<li><strong>Seconde partie : Hamilton</strong>. <p>Vous avez maintenant fini l'échauffement, passons à la partie intéressante !</p><p></p><p>Changement de règle : il faut passer une et une seule fois sur chaque clou, en utilisant uniquement les traits disponibles pour joindre deux clous (mais vous n'êtes pas obligés de passer sur tous les traits).</p><p>Contrainte supplémentaire : il faut commencer et finir sur le même point.</p></li>
</ol>

<h3>À propos du concept</h3>
<p>Cette animation Flash met en jeu deux concepts mathématiques extraits de la théorie des graphes. </p>

<p>Pour rappel, un graphe est un ensemble constitué de points (nommés «&nbsp;nœuds&nbsp;») et de liens entre ces points («&nbsp;arêtes&nbsp;»). Notons qu'un graphe mathématique peut être placé n'importe comment, les dispositions choisies servant simplement à faciliter la compréhension du niveau ou à berner l'utilisateur pour complexifier artificiellement le niveau (après tout, on pourrait afficher tous les nœuds dans l'ordre pour faciliter le problème&nbsp;! )</p>

<h4>Première partie&nbsp;: graphes eulériens</h4>
<p>Dans la première partie (une dizaine de niveaux) c'est le concept de <a href="http://mathworld.wolfram.com/EulerianCycle.html">graphe eulérien</a> qui est utilisé. <br>
Pour expliquer clairement, un graphe est dit «&nbsp;eulérien&nbsp;» si l'on peut le dessiner d'un seul coup sans lever le stylo et en finissant sur le point de départ. <br>
Pour Icosien, nul besoin de finir au même point que le départ (ce qui facilite la chose)&nbsp;: on ne peut donc pas dire qu'il s'agit d'une recherche de cycle d'Euler. </p>

<p>Vous l'aurez remarqué en jouant, le point de départ est important. Effectivement, il faut commencer par un nœud qui a un nombre impair d'arêtes (s'il y en a). Pourquoi&nbsp;? Parce que un passage sur le nœud enlève deux itinéraires à chaque fois&nbsp;: l'arête par laquelle on arrive, et l'arête par laquelle on repart. Pour les nœuds incidents à un nombre pair d'arêtes (<span class="TexTexte">2n</span> par exemple), on passera donc <span class="TexTexte">n</span> fois autour du nœud. Mais pour les nœuds incidents à un nombre impair (3 arêtes par exemple), un passage réduira à 1&nbsp;le nombre d'arête disponible… ce qui force donc à prendre ce nœud pour départ, ou pour arrivée. </p>

<p>À quoi ça sert, un graphe eulérien dans la vraie vie&nbsp;? Imaginez par exemple que vous soyez responsables de la distribution du courrier dans une ville. Pour éviter le temps perdu, il faudrait idéalement trouver le chemin qui emprunte toutes les routes une seule fois, et revient au point de départ. Et voilà un graphe eulérien !</p>

<p>Mathématiquement, les graphes eulériens sont assez simples à analyser et sont l'objet de peu de recherches. On connait plusieurs algorithmes pour trouver rapidement un cycle eulérien&nbsp;; le plus élégant étant sans conteste l'algorithme de Fleury. </p>

<h4>Seconde partie&nbsp;: graphes hamiltoniens</h4>
<p>Dans la deuxième partie, la règle du jeu change&nbsp;: on ne demande plus de passer une fois sur chaque arête, mais de passer une fois sur chaque nœud (en empruntant uniquement certaines arêtes, sinon c'est bien entendu évident&nbsp;! ). <br>
Plus complexe encore, puisqu'il faudra aussi finir sur le point de départ pour obtenir un cycle. <br>
Ce type de parcours s'appelle un <a href="http://mathworld.wolfram.com/HamiltonianCycle.html">cycle hamiltonien</a>. Notons d'ailleurs qu'un même graphe peut avoir plusieurs cycles hamiltoniens&nbsp;! </p>

<p>Cette fois, le point de départ n'a aucune importance&nbsp;: c'est presque aussi incohérent que de demander où commencer à dessiner un cercle&nbsp;! Cependant, intuitivement on préfère commencer sur les nœuds qui ont beaucoup d'arêtes incidentes – ce qui est idiot, mieux vaut se réserver ces carrefours pour sortir d'une situation bloquée. </p>

<p>Et dans la vraie vie, un graphe hamiltonien&nbsp;? Les graphes hamiltoniens peuvent être utiles pour rechercher le plus long cycle / chemin dans un graphe (reconnaissance d'images). Plus prosaïquement, prenez un voyageur qui décide de visiter certaines villes (les nœuds) dont il connait les distances entre elles (la longueur des arêtes)&nbsp;: le cycle hamiltonien est un cas particulier de cette recherche. </p>

<p>Mathématiquement, on ne sait pas calculer rapidement un cycle hamiltonien&nbsp;: grossièrement, on est obligé d'examiner chaque possibilité avec un ordinateur. On peut faire des petites optimisations, mais rien de probant. En fait, la recherche d'un cycle hamiltonien (ou d'un chemin hamiltonien, puisque mathématiquement la complexité est similaire) est un problème dit NP-complet, un domaine de recherche sur lequel les plus grands scientifiques s'arrachent actuellement les cheveux&nbsp;;)<br>
Et pour complexifier le tout, même l'ajout de propriétés habituellement simplificatrices (par exemple, <a href="http://neamar.fr/Res/Bgraphe/">graphe planaire</a>) laisse le problème NP-complet. </p>

<h4>Graphes eulériens <em>vs. </em> graphes hamiltoniens</h4>
<p>À première vue, les deux concepts sont très similaires&nbsp;: passer une seule fois sur chaque élément. Mais en fait, les deux problèmes sont bien distincts, et on peut avoir de tout&nbsp;: un graphe hamiltonien et eulérien, un graphe eulérien et non hamiltonien, un graphe hamiltonien et non eulérien, ou un graphe qui n'est ni hamiltonien, ni eulérien. </p>

<p>De plus, la recherche d'un cycle eulérien ou hamiltonien ne fonctionne pas du tout selon le même principe, et comme je le soulignais la recherche hamiltonienne continue de défier les chercheurs&nbsp;! </p>

<h3>Graphes utilisés</h3>
<p>Cette fois, je n'ai que peu innové et je me suis inspiré de graphes existants aux propriétés bien connues. <br>
On retrouvera donc&nbsp;: </p>


<ol>
<li>La flèche du premier tutoriel, pas très originale&nbsp;; )</li>
<li>La Maison, ou enveloppe, bien connue sur les bancs de l'école primaire «&nbsp;dessine-ça sans lever le crayon&nbsp;», l'astuce étant bien évidemment de commencer en bas.</li>
<li><a href="http://en.wikipedia.org/wiki/File:Labelled_Eulergraph.svg">Labelled Eulergraph</a></li>
<li><a href="http://mathworld.wolfram.com/CuboctahedralGraph.html">Cuboctahedral Graph</a></li>
<li>Graphe d'explication <a href="http://www.cmis.brighton.ac.uk/~jt40/MM322/MM322_FleurysAlgorithm.pdf">algorithme de Fleury</a> modifié pour le complexifier</li>
<li><a href="http://mathworld.wolfram.com/CocktailPartyGraph.html">Cocktail Party Graph</a></li>
<li>Des étoiles plein la tête&nbsp;!</li>
<li><a href="http://mathworld.wolfram.com/SmallRhombicuboctahedralGraph.html">Small Rhombicuboctahedral Graph</a></li>
<li><a href="http://mathworld.wolfram.com/DoyleGraph.html">Doyle Graph</a> ; avec une petite subtilité : il faut bien choisir son point de départ !</li>
<li>La flèche du second tutoriel, qui est hamiltonienne mais pas eulérienne (pour forcer les gens à assimiler la nouvelle règle&nbsp;! )</li>
<li><a href="http://mathworld.wolfram.com/MoserSpindle.html">Moser Spindle</a></li>
<li><a href="http://mathworld.wolfram.com/FranklinGraph.html">Franklin Graph</a></li>
<li><a href="http://mathworld.wolfram.com/IcosianGame.html">Dodecahedron</a></li>
<li><a href="http://mathworld.wolfram.com/GroetzschGraph.html">Grötzsch graph</a></li>
<li><a href="http://en.wikipedia.org/wiki/File:Lindgren_hypohamiltonian_15.svg">Graphe Hypohamitonien de Lindgren</a>&nbsp;; un graphe hypohamiltonien est un graphe qui n'est pas hamiltonien, mais dont la suppression d'un nœud (n'importe lequel) le rend hamiltonien. Ici, j'ai supprimé le nœud en haut du cercle.</li>
<li><a href="http://mathworld.wolfram.com/BlanusaSnarks.html">First Blanusa Snarks</a>&nbsp;: lui aussi est hypohamiltonien, j'ai viré un nœud.</li>
<li><a href="http://mathworld.wolfram.com/PappusGraph.html">Pappus Graph</a>&nbsp;: non eulérien, non planaire… mais hamiltonien&nbsp;!</li>
<li><a href="http://en.wikipedia.org/wiki/McGee_graph">McGee graph</a> modifié (suppression d'arêtes)</li>
<li><a href="http://fr.wikipedia.org/wiki/60-graphe_de_Thomassen">60&nbsp;Graph Thomassen</a> hypohamiltonien, 60 sommets, 99 arêtes (moins dans le jeu, puisque j'en ai supprimé un sommet)&nbsp;!</li>
<li><a href="http://www.dharwadker.org/hamilton/">Tauraso's graph</a>&nbsp;: un graphe d'exemple présentant un nouvel algorithme pour trouver des cycles hamiltoniens.
</li>
</ol>

<h3>Historique</h3>
<ul>
<li>Démarrage du codage : 1/06/10</li>
<li>Version &alpha; : 1/06/10 (Testeurs : Licoti, Vertigo [un peu !])</li>
<li>Version &beta; : 5/06/10 (Testeurs : Licoti, Vertigo)</li>
<li>Version RC1 : Futur  (Testeurs : Licoti, Vertigo, Serge, Bom, Lagile, Malphas, Ugo, MyGB, Goulu, wyngen073, Grebnetor, Jolo2, Lagile, Goulu, rastagong)</li>
</ul>

<h3>Remerciements</h3>
<p>Merci à Licoti qui s'est beaucoup investi dans le jeu et qui a fait les graphismes, au Dr Goulu qui a bien participé aux tests, et à Yannish qui a aidé pour la traduction anglaise.</p>
<h2>Le code</h2>
<h3>À propos du code</h3>
<p>Je commence à bien m'amuser avec Actionscript 3, et le code est... disons, pas trop sale ;)</p>
<p><a href="Code.php">Afin d'éviter l'engorgement du serveur, le code est décentralisé sur une page externe.</a></p>
<?php
include('../footer.php');
?>
