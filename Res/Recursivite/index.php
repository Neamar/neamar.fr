<?php
$Titre='La récursivité';
$Box = array("Auteur" => "Neamar","Date" => "Juill. 2008", "Formats" => "<a href=\"la_recursivite.docx\">DOCX</a>", "But" =>"Panorama récursif");
include('../header.php');
?>

<h1>La récursivité : quand l’utiliser et quand ne pas l’utiliser</h1>

<h2>Introduction</h2>

<p>Vous avez découvert avec le <a href="http://www.siteduzero.com/tuto-3-23774-1-la-recursivite.html" rel="nofollow">tutorial de bluestorm</a> la récursivité ?</p>
<p>Cette méthode bien utilisée peut réduire drastiquement la taille de votre code, faciliter sa compréhension …mais elle possède aussi quelques revers qui ne doivent pas être négligés.<br />
Alors avant de foncer tête baissée, pensez à tout : la méthode récursive est-elle vraiment la plus adaptée ? C’est ce que nous allons essayer de découvrir à travers quelques études de cas. Les exemples seront données dans un langage proche de l’algorithmique, le BASIC. Ce langage offre très peu de fonctions, et vous pourrez donc convertir sans aucun problème n’importe quel code dans un langage plus évolué que vous maitrisez mieux.<br />
Les codes seront fournis pour chaque exemple, et un fichier .exe compilé. Malheureusement, les amateurs de Linux ne pourront pas tester ces codes…ils devront se rabattre sur la capture d’écran !</p>

<p class="erreur">PETIT RAPPEL : Avant de commencer, un petit rappel de vocabulaire. Un algorithme est dit itératif lorsqu’il utilise des boucles (for…next, do…loop).<br />
Il est dit récursif lorsqu’il utilise des appels d’une fonction vers <strong>la même fonction</strong> en réduisant la complexité à chaque appel.</p>

<h2>A l’assaut du bastion récursif !</h2>
<h3>PARTIE 1 : QUAND L’UTILISER</h3>

<p>Avant de diaboliser la récursivité, voyons quelques exemples ou elle peut s’avérer bien pratique.<br />
Quelques critères qui déterminent une utilisation possible et justifiée :</p>
<ul>
<li>La complexité du problème se réduit bien en utilisant la récursivité</li>
<li>La méthode itérative ne peut pas se mettre en place, est trop lourde ou peu adaptée.</li>
<li>Plusieurs solutions à votre problème sont envisageables.</li>
<li>La complexité du problème est imprévisible, et pas forcément linéaire (explorer des tableaux contenant des tableaux, par exemple)</li>
</ul>

<h4>Exemple 1 : Une calculatrice « en ligne de commande »</h4>

<p>Imaginons que l’on souhaite réaliser une calculette évoluée, prenant en compte priorité des opérateurs, parenthèses…avec la méthode itérative, ceci est proprement infaisable : pour évaluer l’expression (2+1)*[(3+4)+(5+2)], seule la méthode récursive se révèle fiable : essayez donc de réaliser ce calcul en itératif…vous m’en donnerez des nouvelles.</p>
<p>En revanche, avec la récursivité, le problème se décompose en sous-problèmes beaucoup plus simples :</p>
<ol class="Comptable">
<li><cite>Fonction Calculer</cite> : reçoit en paramètre (2+1)*[(3+4)+(5+2)]
<ol class="Comptable">
	<li>Evaluer (2+1)</li>
	<li>En déduire (2+1) = 3</li>
	<li>Evaluer [(3+4)+(5+2)]
	<ol class="Comptable">
		<li>Evaluer (3+4)</li>
		<li>En déduire (3+4)=7</li>
		<li>Evaluer (5+2)</li>
		<li>En déduire (5+2)=7</li>
	</ol></li>
	<li>En déduire [(3+4)+(5+2)] = 14</li>
</ol></li>
<li>En déduire (2+1)*[(3+4)+(5+2)] = 42</li>
</ol>
<p>Comme on le voit, il suffit maintenant d’écrire un code gérant la décomposition du calcul selon les parenthèses (facile), puis un sous module utilisant la priorité des opérations (légèrement plus complexe, mais réalisable). Un problème insoluble à première vue s’avère ainsi « facile » à résoudre.</p>


<p>Dans ce cas, l’usage de la récursivité s’avère donc plus que justifiée, mais ce n’est pas le cas tout le temps…</p>
<p class="centre"><a href="http://neamar.fr/Res/Calc">Lien vers le programme complet et fonctionnel<br /><img src="Images/Calc.png" alt="Calcultrice" class="nonflottant" /></a></p>

<h4>Exemple 2 : Résolution d’une grille de Sudoku</h4>

<p class="comment">Pour ceux ayant vécu dans des grottes troglodytes ces trois dernières années, voilà un petit rappel des règles du Sudoku, jeu qui vient de connaitre un succès planétaire : <a href="http://fr.wikipedia.org/wiki/Sudoku" rel="nofollow">Règles du Sudoku Sur Wikipedia</a></p>

<p>La résolution d’une grille de Sudoku standard peut se concevoir de plusieurs façons, et la méthode itérative fait partie des solutions possibles.<br />
Mais imaginons maintenant que l’on souhaite résoudre une grille qui peut posséder plus d’une solution. Ce n’est pas le cas des grilles de jeux données dans les magazines, mais cela peut être l’objet d’un petit défi mathématique.<br />
Cette fois, la méthode itérative s’avère beaucoup plus lourde, voire ingérable : il faudrait utiliser une méthode de Brute-Force, et les résultats risqueraient de prendre beaucoup de temps pour sortir…examinons donc la méthode récursive, qui se révélera un petit peu plus fine, et qui ne demandera pas d’acheter un ordinateur Deep Blue 4 !</p>
<p>Prenons le raisonnement suivant :</p>
<ol class="Comptable">
<li><cite>Fonction Sudoku_Solver</cite> : reçoit une grille de sudoku</li>
<li>Si la grille est pleine, l’enregistrer</li>
<li>Sinon,
<ol class="Comptable">
	<li>Trouver UNE case vide</li>
	<li>Tester pour tous les chiffres de 1 à 9 :
	<ol class="Comptable">
		<li>Si le chiffre testé est envisageable pour la case vide choisie, placer le chiffre sur la grille à cet emplacement. Envoyer la grille à la fonction Sudoku_Solver</li>
	</ol></li>
	<li>Si aucun chiffre n’est envisageable pour cette position, c’est que la grille est incorrecte. Ce n’est pas grave : cette branche de la récursivité s’arrêtera ici.</li>
</ol></li>
<li>Arrêter la fonction</li>
</ol>

<p>A chaque itération, la grille se remplit d’une case. (Comme on teste pour tous les nombres de 1 à 9, on est sur qu’au moins une des grilles contient la bonne réponse…si la bonne réponse existe)</p>

<p>On peut voir cet algorithme de résolution comme un arbre : à chaque passage, on rajoute quelques branches. Si aucune solution n’est possible, la grille est fausse : la branche n’engendre pas d’enfants, et meurt donc.</p>
<p class="comment">On peut remarquer que si on envoie à la fonction Sudoku_Solver une grille complètement vide, on peut en théorie obtenir toutes les grilles de Sudoku du monde. Cependant, au vu du nombre de possibilités (6 670 903 752 021 072 936 960) et des défauts de l’algorithme listés ci-dessous, il faudrait un ordinateur disposant d’une énorme quantité de mémoire vive.</p>
<p>A première vue, cet algorithme parait optimal…mais ne nous emballons pas : le nombre de possibilités testées est impressionnant et loin d’être optimal. Pour ne rien faciliter, le type de retour de la fonction est Array (tableau) : à chaque appel on envoie plusieurs données (on doit utiliser un passage par valeur et non par référence : sinon on agit sur la référence mémoire du parent, donc sur la grille du parent, ce qui empêcherait les enfants de fonctionner correctement).</p>

<p>Dans ce cas là, l’avantage principal est que l’on peut recevoir autant de solutions que l’on veut. Dans le cas d’une grille standard à solution unique, cette méthode perd tout intérêt par rapport à une résolution classique itérative, qui sera beaucoup plus rapide</p>
<p class="centre"><a href="http://neamar.fr/Res/Sudoku">Lien vers le programme complet et fonctionnel<br /><img src="Images/Sudoku.png" alt="Sudoku" class="nonflottant" /></a></p>

<h3>PARTIE 2: QUAND NE PAS L’UTILISER</h3>

<p>Dans la majorité des cas, dire qu’une fonction récursive n’est pas optimale n’est pas faisable au premier coup d’œil : cela demande de réfléchir à la façon dont on pourrait réaliser la solution en itératif, si la fonction récursive est bien employée…car il est facile de tomber dans l’excès ! En croyant faire le bien avec la méthode récursive, on peut obtenir bien pire…Quelque cas :</p>

<ul>
<li>La méthode récursive implique une redondance des calculs (cf. Exemple 1)</li>
<li>Le langage utilisé ne permet pas l’emploi de fonctions tail-rec</li>
<li>La méthode récursive s’avère plus complexe que la méthode itérative (même si la version récursive peut être beaucoup plus courte en lignes de code, il ne faut pas perdre de vue que ce qui importe au final c’est la version compilée, et il faut qu’elle soit optimale)</li>
<li>On n’a pas forcément besoin d’explorer toutes les possibilités (ce que l’on cherche n’est pas forcément situé sur une des branches finales, mais peut se situer sur une branche secondaire, ou même directement sur le tronc)</li>
</ul>

<h4>Exemple 1: La suite de Fibonacci</h4>
<p>Nous venons de voir deux exemples où l’utilisation de la récursivité était acceptable, à défaut d’être optimal. Mais ce n’est pas toujours le cas ! Je souhaite commencer ce réquisitoire par quelque chose de très simple.<br />
Je citerais ainsi sans m’y attarder la <a href="http://fr.wikipedia.org/wiki/Suite_de_Fibonacci" rel="nofollow">suite de Fibonacci</a>, souvent donnée en exemple de récursivité sous cette forme :</p>

<ol class="Comptable">
<li><cite>Fonction Fibonacci</cite> : Recevoir un nombre n
<ol class="Comptable">
<li>Si n&lt;2, renvoyer 1 car F<sub>1</sub>=F<sub>0</sub>=1</li>
<li>Sinon, renvoyer Fibonacci(n-1) + Fibonacci(n-2)</li>
</ol></li>
</ol>

<p>Regardons rapidement l’enchainement des calculs : pour Fibonacci(4) on obtient :<br />
<img src="Images/FiboDiagramme.png" alt="Diagramme de la suite de Fibonacci" class="nonflottant" /></p>
<p>Que remarque-t-on ? Que F(2) est calculé plusieurs fois. Dans ce cas, cela reste minime. Mais quand n augmente, chaque nombre sera calculé plusieurs fois. Ainsi, là ou une solution itérative impliquerait n-1 calculs, la solution récursive en demande beaucoup plus (une étude plus approfondie montre que le nombre de calculs effectués avec la méthode récursive est très liée à la suite de Fibonacci...et cela n’a aucun rapport avec la suite ! mais cela rentre dans le cadre de mathématiques légèrement plus poussées, nous n’en parlerons donc pas).<br />
Certes, on peut optimiser la méthode récursive en utilisant des tableaux, mais cela devient au final plus lourd que la méthode itérative.</p>
<p class="centre"><a href="Fibonacci/">Lien vers le programme complet et fonctionnel<br /><img src="Images/Fibonacci.png" alt="Fibonacci" class="nonflottant" /></a></p>

<h4>Exemple 2 : Décomposition en produits de facteurs premiers</h4>
<p><img src="Images/factoring_the_time.png" alt="Un strip de XKCD parfaitement adapté" /></p>

<p>Nous allons maintenant nous pencher sur un nouvel exemple : la décomposition en facteurs premiers. Il s’agit d’un théorème mathématique : tout entier peut être décomposé en un produit de facteurs premier.<br />
Quelques exemples :</p>
<ul>
<li>12 = 2<sup>2</sup>*3</li>
<li>54 = 2 * 3<sup>3</sup></li>
<li>53 = 53 (car 53 est premier !)</li>
</ul>
<p>Nous allons maintenant tenter de réaliser un algorithme qui réalisera cette tache fastidieuse pour nous. (On admet que cette décomposition est unique)</p>
<p class="comment">Rappel : Pour trouver la décomposition d’un nombre, il faut et il suffit de tester les nombres inférieurs à la racine du nombre. (Cela se démontre facilement en observant les propriétés du produit et du carré)</p>

<p>Voyons le résultat, codé de façon naïve :</p>
<ol style="clear:both;" class="Comptable">
<li><cite>Fonction DecoFact</cite> : reçoit un nombre K</li>
<li>Calculer sa racine</li>
<li>Pour tous les nombres inférieurs à cette racine (appelons les « i »),
<ol class="Comptable">
	<li>Si i est premier
	<ol class="Comptable">
		<li>Si le nombre testé est divisible par i (i.e K % i = 0 ou encore K/i = E(K/i) avec % le modulo, et E la fonction partie entière)
		<ol class="Comptable">
			<li>Trouver le complément j tel que i*j=k</li>
			<li>Ajouter i à la liste des diviseurs à retourner</li>
			<li>Envoyer j à la fonction DecoFact, récupérer le résultat et l’ajouter au tableau préexistant</li>
		</ol></li>
	</ol></li>
</ol></li>
<li>Fin de la fonction : renvoyer la liste crée</li>
</ol>
<p>Comme on le voit, cet algorithme possède de nombreuses contraintes :</p>
<ul>
<li>Il faut réaliser une fonction qui teste si le nombre est premier, ce qui obligera encore à faire une boucle (on ne sait pas, dans le cas général, dire si un nombre est premier sans tester exhaustivement tous les nombres inférieurs à sa racine).</li>
<li>Il utilise la récursivité : ce n’est pas forcément un défaut, mais dans ce cas là c’est inutile et lourd à mettre en place. N’oubliez pas que le processeur doit retenir la pile d’appel, ce qui alourdit inutilement les opérations.</li>
</ul>
<p>Réfléchissons ensemble : comment améliorer cet algorithme ? Je vous laisse prendre une longueur d’avance…</p>

<p>Vous avez trouvés ? Félicitations, dans ce cas là vous n’avez plus besoin de moi…ah si, le monsieur qui lève le doigt au fond ! Vous voulez plus d’explications ? Bon très bien.<br />
On peut éviter le recours à la récursivité : que diriez-vous de l’algorithme suivant :</p>

<ol class="Comptable">
<li>Fonction DecoFact : reçoit un nombre K</li>
<li>Calculer sa racine</li>
<li>Pour tous les nombres inférieurs à cette racine (appelons les « i »),
<ol class="Comptable">
	<li>Si le nombre testé est divisible par i
	<ol class="Comptable">
		<li>L’ajouter dans la liste des diviseurs.</li>
		<li>Faire K = K / i</li>
		<li>Faire i = i -1</li>
	</ol></li>
	<li>Si K&gt;2, continuer la boucle, sinon en sortir</li>
</ol></li>
<li>Si K&gt;2, le nombre restant est premier : l’ajouter à la liste</li>
<li>Fin de la fonction : Renvoyer la liste.</li>
</ol>

<p>On obtient strictement le même résultat qu’avec l’algorithme précédent. Seule différence : on ne fait plus le test de primalité, on n’a plus besoin de la récursivité, et le nombre d’itérations dans les boucles est réduit au strict minimum.<br />
Attardons nous d’abord sur le test de primalité. Il est complètement inutile dans ce nouveau programme, puisque si i divise K, alors i est forcément premier puisque K est ajusté en permanence. Nous venons de gagner plusieurs cycles machines ! (faites des tests, vous verrez !)<br />
Quant à la récursivité, une observation attentive du premier algorithme nous montre qu’il est absolument inutile de refaire les tests pour les numéros inférieurs à i : si K n’est pas divisible par z, alors K/i ne sera pas non plus divisible par z ! En fait, l’appel récursif n’a pas complètement disparu : on a juste profité du fait que les tests pouvaient se « continuer » à l’intérieur de la fonction, sans avoir besoin de remettre en place la fonction (le fait que la fonction du 1er algorithme « s’arrête» une fois trouvé un nombre aide bien à le simplifier).</p>

<p class="centre"><a href="DecoFact/">Lien vers le programme complet et fonctionnel<br /><img src="Images/DecoFact.png" alt="Décomposition en produit de facteurs premiers" class="nonflottant" /></a></p>

<p>On l’a vu, cette fois, la récursivité était loin d’être adaptée ! Ne foncez pas dedans tête baissée à tout moment, cela peut amener à des codes beaucoup plus complexes.</p>

<h4>Exemple 3 : Le pathfinding</h4>
<p class="centre"><img src="Images/PathFinder.png" alt="Un exemple de PathFinder" class="nonflottant" /></p>
<p class="comment">Cette dernière section couvrira rapidement le pathfinding, et plus particulièrement l’algorithme A*. Elle sera légèrement plus complexe que les précédentes : je considérerais que vous connaissez le fonctionnement d’un pathfinder standard, qu’il soit A* ou Djikstra. Sinon, vous pourrez découvrir ces algorithmes ici : <a href="http://www.policyalmanac.org/games/aStarTutorial.htm" rel="nofollow">Le PathFinding avec A*</a></p>

 <p>L’algorithme A* fonctionne sur le principe des listes fermées et ouvertes. L’une des opérations les plus couteuses en temps est la maintenance de liste ouverte triée selon la distance F, somme de la distance parcourue et de la distance heuristique.</p>
<p>Imaginons que l’on souhaite « améliorer » cet algorithme en y ajoutant de la récursivité.<br />
On pourrait imaginer deux façons : </p>
<ul>
<li>1ère idée : au lieu de maintenir une liste ouverte, on appelle une fonction qui prend en paramètres :
<ul>
	<li>La carte du terrain, avec ses spécificités</li>
	<li>Le carré Parent</li>
	<li>Le coût F.</li>
</ul>
<p>Dans une variable globale, on stockerait le coût F que l’on accepte.<br />
Au tout début de la fonction, on ferait une boucle tant que le cout F global est inférieur au coût F de la fonction. Tant que l’on a cela, on laisserait la main aux autres événements, tandis qu’une fonction maitresse contrôlerait l’incrémentation de la variable F.</p>

<p>Dois-je vraiment donner tous les inconvénients de cette méthode ? Variables Globales, Multi threading, encombrement de la pile d’appel, tests inutiles et répétitifs, gestion de la fonction maitresse…on obtiendrait certes un pathfinder beaucoup plus propre, mais ô combien moins performant ! Ca tombe mal, c’est justement le but principal d’un pathfinder…</p></li>
<li>2ème idée : cette fois, focalisons nous sur l’algorithme de Djikstra, dont le but n’est pas de se rendre en un point fixe X,Y, mais en un point contenant un certain type d’item : par exemple, un villageois lancerait l’algorithme de Djikstra pour trouver la mine d’or la plus proche. On pourrait penser que la méthode récursive est une alternative possible. Malheureusement, la récursivité oblige à « fouiller » entièrement une branche avant de pouvoir passer à la suivante. C’est justement ce que l’algorithme de Djikstra essaie de ne pas faire : il faut fouiller le moins de nœuds possibles ! Si on utilisait la récursivité, une immense partie de la carte serait explorée à chaque recherche. Pour pallier à cet inconvénient, il faudrait mettre en place un paramètre qui indique à la fonction son niveau sur l’arbre (branche de niveau 1, de niveau 2…) et ne pas commencer un niveau tant que le précédant n’est pas fini. On retombe à nouveau sur un système de gestion de priorités en multithreading : infaisable pour un algorithme supposé être « real-time » !</li>
</ul>
<p>Bref, le pathfinding est bien mieux tel qu’il est : des générations de programmeurs s’y sont cassés les dents, il était peu probable qu’une modification aussi « évidente » n’ait pas déjà été envisagée. Et si elle avait plus intéressante, cela se saurait ! Comme le dit un célèbre proverbe geek : « pas d’intérêt à réinventer la roue »</p>
<p class="centre"><a href="https://neamar.fr/Res/Pathfinder/">Lien vers le programme complet et fonctionnel (écrit en AS3)<br /><img src="/Res/Pathfinder/Images/Pathfinder.png" alt="Décomposition en produit de facteurs premiers" class="nonflottant" /></a></p>

<h2>Conclusion</h2>

<p>J’espère que vous avez compris le message : la récursivité peut s’avérer un outil précieux pour la simplification de vos codes.<br />
Malheureusement, le verso des choses est moins brillant : il peut s’avérer que la méthode récursive soit plus complexe, plus lourde, et qu’au final elle rende l’algorithme incompréhensible pour un lecteur externe.</p>
<p>Ce n’est pas une raison pour oublier la récursivité : il ne faut simplement pas l’assaisonner à toutes les sauces. Tous comme le slogan « Manger Bouger », n’oubliez pas que l’arsenal du programmeur comporte d’autres outils, qui peuvent s’avérer plus pratiques et/ou plus adaptés que la récursivité. Se focaliser sur la même source n'est jamais une bonne idée !</p>
<p>Bonne continuation dans la programmation !</p>
<?php
include "../footer.php";
?>
