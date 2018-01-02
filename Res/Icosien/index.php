<?php
$Titre='Le jeu Icosien';
$Box = array("Auteur" => "Neamar","Date" => "Juin 2010", "But" =>"Finir le jeu","Voir aussi"=>'<a href="../Compiler_AS3">Compiler l\'AS3</a>',"Voir aussi"=>'<a href="../Graphe">Jeux de graphe</a>');
include('../header.php');

$Flash ='/Res/Icosien/Icosien.swf';
?>
<h1 style="text-align:center;"><img src="Images/assets/Icosien.png" alt="Le jeu icosien en Flash" class="nonflottant"/></h1>
<h2>Le r�sultat</h2>
<h3>Fichier Flash :</h3>
<div style="border:1px solid black; width:640px; height:480px; margin:auto;">
	<object type="application/x-shockwave-flash" data="<?php echo $Flash ?>" width="640" height="480" >
		<param name="movie" value="<?php echo $Flash ?>" />
		<param name="quality" value="high" />
		<param name="wmode" value="transparent" />
		<p>Installez le plugin Flash pour voir l'animation : <a href="http://www.adobe.com/go/gntray_dl_getflashplayer_fr" >Cliquez ici pour le t�l�charger</a></p>
	</object>
</div>

<div style="border:1px dotted red">
<p>Icosien est aussi disponible en version mobile, sans publicit� et avec encore plus de niveaux !</p>
<ul>
	<li><a href="https://play.google.com/store/apps/details?id=air.neamar.Icosien">Icosien sur le Google Play Store (Android)</a></li>
	<li><a href="http://appworld.blackberry.com/webstore/content/104908/">Icosien pour Blackberry</a></li>
</ul>
</div>

<h2>Explications</h2>

<p>Ce jeu a fait l'objet de plusieurs publications ; elles sont list�es ici.</p>

<p>Articles sur l'algorithmie derri�re le jeu :</p>
<ul>
	<li><a href="http://blog.neamar.fr/component/content/article/18-algorithmie-et-optimisation/119-mouvement-intuitif-graphe-souris">D�placement intuitif sur un graphe</a></li>
	<li><a href="http://blog.neamar.fr/component/content/article/18-algorithmie-et-optimisation/129-algorithme-cycle-hamiltonien-graphe">Trouver un cycle hamiltonien dans un graphe</a></li>
</ul>

<p>Articles sur des petites astuces de programmation AS3 :</p>
<ul>
	<li><a href="http://blog.neamar.fr/component/content/article/15-as3/133-clic-droit-flash-as3">Modifier le menu clic droit de Flash Player en as3</a></li>
	<li><a href="http://blog.neamar.fr/component/content/article/15-as3/128-for-each-in-ajout-suppression-changement-variable">Fonctionnement du <tt>foreach</tt> as3 dans les cas particuliers</a></li>
	<li><a href="http://blog.neamar.fr/component/content/article/15-as3/127-as3-snippets-double-click-keyboard">Faire fonctionner le double clic Flash</a></li>
	<li><a href="http://blog.neamar.fr/component/content/article/15-as3/127-as3-snippets-double-click-keyboard">Le <tt>listener</tt> du clavier ne marche pas !</a></li>
	<li><a href="http://blog.neamar.fr/component/content/article/15-as3/126-string-multilignes-heredoc-as3">D�finir un <tt>string</tt> sur plusieurs lignes dans le code source as3</a></li>
	<li><a href="http://blog.neamar.fr/component/content/article/15-as3/125-enchassement-ressource-as3">Ench�sser une ressource dans un fichier flash pour ne pas la charger</a></li>
	<li><a href="http://blog.neamar.fr/component/content/article/15-as3/124-effet-miroir-bitmap-as3">Donner un effet miroir � un <tt>Bitmap</tt></a></li>
</ul>

<p>Articles sur le jeu :</p>
<ul>
	<li><a href="http://blog.neamar.fr/component/content/article/6-flash-game/123-icosien-alpha-beta">Annonce du jeu</a></li>
	<li><a href="http://blog.neamar.fr/component/content/article/6-flash-game/143-presentation-icosien-release">Pr�sentation du jeu</a></li>
	<li><a href="http://blog.neamar.fr/component/content/article/15-as3/137-images-icosien">De rien du tout au jeu : g�n�se d'Icosien</a></li>
	<li><a href="http://blog.neamar.fr/component/content/article/6-flash-game/149-icosien-suite-et-fin-la-solution">La solution du jeu</a></li>

</ul>

<h3>R�gle du jeu</h3>
<p>La r�gle est expliqu�e dans le jeu. Vous la retrouverez ici :</p>
<ol>
<li><strong>Premi�re partie : Euler</strong>. <p>Reproduisez le motif gris d'un seul mouvement de souris, sans repasser deux fois sur le m�me trait (mais les croisements de fil sont autoris�s).<br /> Double cliquez pour recommencer !</p><p>Ayez des mouvements amples de souris, imaginez que vous tirez un fil derri�re vous : pas besoin de fr�ler les clous !</p><p>Pour commencer � jouer, entra�nez-vous sur la fl�che ci-dessous.<br />Cliquez sur un clou pour attacher votre corde et commencer.</p></li>
<li><strong>Seconde partie : Hamilton</strong>. <p>Vous avez maintenant fini l'�chauffement, passons � la partie int�ressante !</p><p></p><p>Changement de r�gle : il faut passer une et une seule fois sur chaque clou, en utilisant uniquement les traits disponibles pour joindre deux clous (mais vous n'�tes pas oblig�s de passer sur tous les traits).</p><p>Contrainte suppl�mentaire : il faut commencer et finir sur le m�me point.</p></li>
</ol>

<h3>� propos du concept</h3>
<p>Cette animation Flash met en jeu deux concepts math�matiques extraits de la th�orie des graphes. </p>

<p>Pour rappel, un graphe est un ensemble constitu� de points (nomm�s �&nbsp;n�uds&nbsp;�) et de liens entre ces points (�&nbsp;ar�tes&nbsp;�). Notons qu'un graphe math�matique peut �tre plac� n'importe comment, les dispositions choisies servant simplement � faciliter la compr�hension du niveau ou � berner l'utilisateur pour complexifier artificiellement le niveau (apr�s tout, on pourrait afficher tous les n�uds dans l'ordre pour faciliter le probl�me&nbsp;! )</p>

<h4>Premi�re partie&nbsp;: graphes eul�riens</h4>
<p>Dans la premi�re partie (une dizaine de niveaux) c'est le concept de <a href="http://mathworld.wolfram.com/EulerianCycle.html">graphe eul�rien</a> qui est utilis�. <br>
Pour expliquer clairement, un graphe est dit �&nbsp;eul�rien&nbsp;� si l'on peut le dessiner d'un seul coup sans lever le stylo et en finissant sur le point de d�part. <br>
Pour Icosien, nul besoin de finir au m�me point que le d�part (ce qui facilite la chose)&nbsp;: on ne peut donc pas dire qu'il s'agit d'une recherche de cycle d'Euler. </p>

<p>Vous l'aurez remarqu� en jouant, le point de d�part est important. Effectivement, il faut commencer par un n�ud qui a un nombre impair d'ar�tes (s'il y en a). Pourquoi&nbsp;? Parce que un passage sur le n�ud enl�ve deux itin�raires � chaque fois&nbsp;: l'ar�te par laquelle on arrive, et l'ar�te par laquelle on repart. Pour les n�uds incidents � un nombre pair d'ar�tes (<span class="TexTexte">2n</span> par exemple), on passera donc <span class="TexTexte">n</span> fois autour du n�ud. Mais pour les n�uds incidents � un nombre impair (3 ar�tes par exemple), un passage r�duira � 1&nbsp;le nombre d'ar�te disponible� ce qui force donc � prendre ce n�ud pour d�part, ou pour arriv�e. </p>

<p>� quoi �a sert, un graphe eul�rien dans la vraie vie&nbsp;? Imaginez par exemple que vous soyez responsables de la distribution du courrier dans une ville. Pour �viter le temps perdu, il faudrait id�alement trouver le chemin qui emprunte toutes les routes une seule fois, et revient au point de d�part. Et voil� un graphe eul�rien !</p>

<p>Math�matiquement, les graphes eul�riens sont assez simples � analyser et sont l'objet de peu de recherches. On connait plusieurs algorithmes pour trouver rapidement un cycle eul�rien&nbsp;; le plus �l�gant �tant sans conteste l'algorithme de Fleury. </p>

<h4>Seconde partie&nbsp;: graphes hamiltoniens</h4>
<p>Dans la deuxi�me partie, la r�gle du jeu change&nbsp;: on ne demande plus de passer une fois sur chaque ar�te, mais de passer une fois sur chaque n�ud (en empruntant uniquement certaines ar�tes, sinon c'est bien entendu �vident&nbsp;! ). <br>
Plus complexe encore, puisqu'il faudra aussi finir sur le point de d�part pour obtenir un cycle. <br>
Ce type de parcours s'appelle un <a href="http://mathworld.wolfram.com/HamiltonianCycle.html">cycle hamiltonien</a>. Notons d'ailleurs qu'un m�me graphe peut avoir plusieurs cycles hamiltoniens&nbsp;! </p>

<p>Cette fois, le point de d�part n'a aucune importance&nbsp;: c'est presque aussi incoh�rent que de demander o� commencer � dessiner un cercle&nbsp;! Cependant, intuitivement on pr�f�re commencer sur les n�uds qui ont beaucoup d'ar�tes incidentes � ce qui est idiot, mieux vaut se r�server ces carrefours pour sortir d'une situation bloqu�e. </p>

<p>Et dans la vraie vie, un graphe hamiltonien&nbsp;? Les graphes hamiltoniens peuvent �tre utiles pour rechercher le plus long cycle / chemin dans un graphe (reconnaissance d'images). Plus prosa�quement, prenez un voyageur qui d�cide de visiter certaines villes (les n�uds) dont il connait les distances entre elles (la longueur des ar�tes)&nbsp;: le cycle hamiltonien est un cas particulier de cette recherche. </p>

<p>Math�matiquement, on ne sait pas calculer rapidement un cycle hamiltonien&nbsp;: grossi�rement, on est oblig� d'examiner chaque possibilit� avec un ordinateur. On peut faire des petites optimisations, mais rien de probant. En fait, la recherche d'un cycle hamiltonien (ou d'un chemin hamiltonien, puisque math�matiquement la complexit� est similaire) est un probl�me dit NP-complet, un domaine de recherche sur lequel les plus grands scientifiques s'arrachent actuellement les cheveux&nbsp;;)<br>
Et pour complexifier le tout, m�me l'ajout de propri�t�s habituellement simplificatrices (par exemple, <a href="http://neamar.fr/Res/Bgraphe/">graphe planaire</a>) laisse le probl�me NP-complet. </p>

<h4>Graphes eul�riens <em>vs. </em> graphes hamiltoniens</h4>
<p>� premi�re vue, les deux concepts sont tr�s similaires&nbsp;: passer une seule fois sur chaque �l�ment. Mais en fait, les deux probl�mes sont bien distincts, et on peut avoir de tout&nbsp;: un graphe hamiltonien et eul�rien, un graphe eul�rien et non hamiltonien, un graphe hamiltonien et non eul�rien, ou un graphe qui n'est ni hamiltonien, ni eul�rien. </p>

<p>De plus, la recherche d'un cycle eul�rien ou hamiltonien ne fonctionne pas du tout selon le m�me principe, et comme je le soulignais la recherche hamiltonienne continue de d�fier les chercheurs&nbsp;! </p>

<h3>Graphes utilis�s</h3>
<p>Cette fois, je n'ai que peu innov� et je me suis inspir� de graphes existants aux propri�t�s bien connues. <br>
On retrouvera donc&nbsp;: </p>


<ol>
<li>La fl�che du premier tutoriel, pas tr�s originale&nbsp;; )</li>
<li>La Maison, ou enveloppe, bien connue sur les bancs de l'�cole primaire �&nbsp;dessine-�a sans lever le crayon&nbsp;�, l'astuce �tant bien �videmment de commencer en bas.</li>
<li><a href="http://en.wikipedia.org/wiki/File:Labelled_Eulergraph.svg">Labelled Eulergraph</a></li>
<li><a href="http://mathworld.wolfram.com/CuboctahedralGraph.html">Cuboctahedral Graph</a></li>
<li>Graphe d'explication <a href="http://www.cmis.brighton.ac.uk/~jt40/MM322/MM322_FleurysAlgorithm.pdf">algorithme de Fleury</a> modifi� pour le complexifier</li>
<li><a href="http://mathworld.wolfram.com/CocktailPartyGraph.html">Cocktail Party Graph</a></li>
<li>Des �toiles plein la t�te&nbsp;!</li>
<li><a href="http://mathworld.wolfram.com/SmallRhombicuboctahedralGraph.html">Small Rhombicuboctahedral Graph</a></li>
<li><a href="http://mathworld.wolfram.com/DoyleGraph.html">Doyle Graph</a> ; avec une petite subtilit� : il faut bien choisir son point de d�part !</li>
<li>La fl�che du second tutoriel, qui est hamiltonienne mais pas eul�rienne (pour forcer les gens � assimiler la nouvelle r�gle&nbsp;! )</li>
<li><a href="http://mathworld.wolfram.com/MoserSpindle.html">Moser Spindle</a></li>
<li><a href="http://mathworld.wolfram.com/FranklinGraph.html">Franklin Graph</a></li>
<li><a href="http://mathworld.wolfram.com/IcosianGame.html">Dodecahedron</a></li>
<li><a href="http://mathworld.wolfram.com/GroetzschGraph.html">Gr�tzsch graph</a></li>
<li><a href="http://en.wikipedia.org/wiki/File:Lindgren_hypohamiltonian_15.svg">Graphe Hypohamitonien de Lindgren</a>&nbsp;; un graphe hypohamiltonien est un graphe qui n'est pas hamiltonien, mais dont la suppression d'un n�ud (n'importe lequel) le rend hamiltonien. Ici, j'ai supprim� le n�ud en haut du cercle.</li>
<li><a href="http://mathworld.wolfram.com/BlanusaSnarks.html">First Blanusa Snarks</a>&nbsp;: lui aussi est hypohamiltonien, j'ai vir� un n�ud.</li>
<li><a href="http://mathworld.wolfram.com/PappusGraph.html">Pappus Graph</a>&nbsp;: non eul�rien, non planaire� mais hamiltonien&nbsp;!</li>
<li><a href="http://en.wikipedia.org/wiki/McGee_graph">McGee graph</a> modifi� (suppression d'ar�tes)</li>
<li><a href="http://fr.wikipedia.org/wiki/60-graphe_de_Thomassen">60&nbsp;Graph Thomassen</a> hypohamiltonien, 60 sommets, 99 ar�tes (moins dans le jeu, puisque j'en ai supprim� un sommet)&nbsp;!</li>
<li><a href="http://www.dharwadker.org/hamilton/">Tauraso's graph</a>&nbsp;: un graphe d'exemple pr�sentant un nouvel algorithme pour trouver des cycles hamiltoniens.
</li>
</ol>

<h3>Historique</h3>
<ul>
<li>D�marrage du codage : 1/06/10</li>
<li>Version &alpha; : 1/06/10 (Testeurs : Licoti, Vertigo [un peu !])</li>
<li>Version &beta; : 5/06/10 (Testeurs : Licoti, Vertigo)</li>
<li>Version RC1 : Futur  (Testeurs : Licoti, Vertigo, Serge, Bom, Lagile, Malphas, Ugo, MyGB, Goulu, wyngen073, Grebnetor, Jolo2, Lagile, Goulu, rastagong)</li>
</ul>

<h3>Remerciements</h3>
<p>Merci � Licoti qui s'est beaucoup investi dans le jeu et qui a fait les graphismes, au Dr Goulu qui a bien particip� aux tests, et � Yannish qui a aid� pour la traduction anglaise.</p>
<h2>Le code</h2>
<h3>� propos du code</h3>
<p>Je commence � bien m'amuser avec Actionscript 3, et le code est... disons, pas trop sale ;)</p>
<p><a href="Code.php">Afin d'�viter l'engorgement du serveur, le code est d�centralis� sur une page externe.</a></p>
<?php
include('../footer.php');
?>
