<?php
$Titre='La r�cursivit�';
$Box = array("Auteur" => "Neamar","Date" => "Juill. 2008", "Formats" => "<a href=\"la_recursivite.docx\">DOCX</a>", "But" =>"Panorama r�cursif");
include('../header.php');
?>

<h1>La r�cursivit� : quand l�utiliser et quand ne pas l�utiliser</h1>

<h2>Introduction</h2>

<p>Vous avez d�couvert avec le <a href="http://www.siteduzero.com/tuto-3-23774-1-la-recursivite.html" rel="nofollow">tutorial de bluestorm</a> la r�cursivit� ?</p>
<p>Cette m�thode bien utilis�e peut r�duire drastiquement la taille de votre code, faciliter sa compr�hension �mais elle poss�de aussi quelques revers qui ne doivent pas �tre n�glig�s.<br />
Alors avant de foncer t�te baiss�e, pensez � tout : la m�thode r�cursive est-elle vraiment la plus adapt�e ? C�est ce que nous allons essayer de d�couvrir � travers quelques �tudes de cas. Les exemples seront donn�es dans un langage proche de l�algorithmique, le BASIC. Ce langage offre tr�s peu de fonctions, et vous pourrez donc convertir sans aucun probl�me n�importe quel code dans un langage plus �volu� que vous maitrisez mieux.<br />
Les codes seront fournis pour chaque exemple, et un fichier .exe compil�. Malheureusement, les amateurs de Linux ne pourront pas tester ces codes�ils devront se rabattre sur la capture d��cran !</p>

<p class="erreur">PETIT RAPPEL : Avant de commencer, un petit rappel de vocabulaire. Un algorithme est dit it�ratif lorsqu�il utilise des boucles (for�next, do�loop).<br />
Il est dit r�cursif lorsqu�il utilise des appels d�une fonction vers <strong>la m�me fonction</strong> en r�duisant la complexit� � chaque appel.</p>

<h2>A l�assaut du bastion r�cursif !</h2>
<h3>PARTIE 1 : QUAND L�UTILISER</h3>

<p>Avant de diaboliser la r�cursivit�, voyons quelques exemples ou elle peut s�av�rer bien pratique.<br />
Quelques crit�res qui d�terminent une utilisation possible et justifi�e :</p>
<ul>
<li>La complexit� du probl�me se r�duit bien en utilisant la r�cursivit�</li>
<li>La m�thode it�rative ne peut pas se mettre en place, est trop lourde ou peu adapt�e.</li>
<li>Plusieurs solutions � votre probl�me sont envisageables.</li>
<li>La complexit� du probl�me est impr�visible, et pas forc�ment lin�aire (explorer des tableaux contenant des tableaux, par exemple)</li>
</ul>

<h4>Exemple 1 : Une calculatrice � en ligne de commande �</h4>

<p>Imaginons que l�on souhaite r�aliser une calculette �volu�e, prenant en compte priorit� des op�rateurs, parenth�ses�avec la m�thode it�rative, ceci est proprement infaisable : pour �valuer l�expression (2+1)*[(3+4)+(5+2)], seule la m�thode r�cursive se r�v�le fiable : essayez donc de r�aliser ce calcul en it�ratif�vous m�en donnerez des nouvelles.</p>
<p>En revanche, avec la r�cursivit�, le probl�me se d�compose en sous-probl�mes beaucoup plus simples :</p>
<ol class="Comptable">
<li><cite>Fonction Calculer</cite> : re�oit en param�tre (2+1)*[(3+4)+(5+2)]
<ol class="Comptable">
	<li>Evaluer (2+1)</li>
	<li>En d�duire (2+1) = 3</li>
	<li>Evaluer [(3+4)+(5+2)]
	<ol class="Comptable">
		<li>Evaluer (3+4)</li>
		<li>En d�duire (3+4)=7</li>
		<li>Evaluer (5+2)</li>
		<li>En d�duire (5+2)=7</li>
	</ol></li>
	<li>En d�duire [(3+4)+(5+2)] = 14</li>
</ol></li>
<li>En d�duire (2+1)*[(3+4)+(5+2)] = 42</li>
</ol>
<p>Comme on le voit, il suffit maintenant d��crire un code g�rant la d�composition du calcul selon les parenth�ses (facile), puis un sous module utilisant la priorit� des op�rations (l�g�rement plus complexe, mais r�alisable). Un probl�me insoluble � premi�re vue s�av�re ainsi � facile � � r�soudre.</p>


<p>Dans ce cas, l�usage de la r�cursivit� s�av�re donc plus que justifi�e, mais ce n�est pas le cas tout le temps�</p>
<p class="centre"><a href="http://neamar.fr/Res/Calc">Lien vers le programme complet et fonctionnel<br /><img src="Images/Calc.png" alt="Calcultrice" class="nonflottant" /></a></p>

<h4>Exemple 2 : R�solution d�une grille de Sudoku</h4>

<p class="comment">Pour ceux ayant v�cu dans des grottes troglodytes ces trois derni�res ann�es, voil� un petit rappel des r�gles du Sudoku, jeu qui vient de connaitre un succ�s plan�taire : <a href="http://fr.wikipedia.org/wiki/Sudoku" rel="nofollow">R�gles du Sudoku Sur Wikipedia</a></p>

<p>La r�solution d�une grille de Sudoku standard peut se concevoir de plusieurs fa�ons, et la m�thode it�rative fait partie des solutions possibles.<br />
Mais imaginons maintenant que l�on souhaite r�soudre une grille qui peut poss�der plus d�une solution. Ce n�est pas le cas des grilles de jeux donn�es dans les magazines, mais cela peut �tre l�objet d�un petit d�fi math�matique.<br />
Cette fois, la m�thode it�rative s�av�re beaucoup plus lourde, voire ing�rable : il faudrait utiliser une m�thode de Brute-Force, et les r�sultats risqueraient de prendre beaucoup de temps pour sortir�examinons donc la m�thode r�cursive, qui se r�v�lera un petit peu plus fine, et qui ne demandera pas d�acheter un ordinateur Deep Blue 4 !</p>
<p>Prenons le raisonnement suivant :</p>
<ol class="Comptable">
<li><cite>Fonction Sudoku_Solver</cite> : re�oit une grille de sudoku</li>
<li>Si la grille est pleine, l�enregistrer</li>
<li>Sinon,
<ol class="Comptable">
	<li>Trouver UNE case vide</li>
	<li>Tester pour tous les chiffres de 1 � 9 :
	<ol class="Comptable">
		<li>Si le chiffre test� est envisageable pour la case vide choisie, placer le chiffre sur la grille � cet emplacement. Envoyer la grille � la fonction Sudoku_Solver</li>
	</ol></li>
	<li>Si aucun chiffre n�est envisageable pour cette position, c�est que la grille est incorrecte. Ce n�est pas grave : cette branche de la r�cursivit� s�arr�tera ici.</li>
</ol></li>
<li>Arr�ter la fonction</li>
</ol>

<p>A chaque it�ration, la grille se remplit d�une case. (Comme on teste pour tous les nombres de 1 � 9, on est sur qu�au moins une des grilles contient la bonne r�ponse�si la bonne r�ponse existe)</p>

<p>On peut voir cet algorithme de r�solution comme un arbre : � chaque passage, on rajoute quelques branches. Si aucune solution n�est possible, la grille est fausse : la branche n�engendre pas d�enfants, et meurt donc.</p>
<p class="comment">On peut remarquer que si on envoie � la fonction Sudoku_Solver une grille compl�tement vide, on peut en th�orie obtenir toutes les grilles de Sudoku du monde. Cependant, au vu du nombre de possibilit�s (6 670 903 752 021 072 936 960) et des d�fauts de l�algorithme list�s ci-dessous, il faudrait un ordinateur disposant d�une �norme quantit� de m�moire vive.</p>
<p>A premi�re vue, cet algorithme parait optimal�mais ne nous emballons pas : le nombre de possibilit�s test�es est impressionnant et loin d��tre optimal. Pour ne rien faciliter, le type de retour de la fonction est Array (tableau) : � chaque appel on envoie plusieurs donn�es (on doit utiliser un passage par valeur et non par r�f�rence : sinon on agit sur la r�f�rence m�moire du parent, donc sur la grille du parent, ce qui emp�cherait les enfants de fonctionner correctement).</p>

<p>Dans ce cas l�, l�avantage principal est que l�on peut recevoir autant de solutions que l�on veut. Dans le cas d�une grille standard � solution unique, cette m�thode perd tout int�r�t par rapport � une r�solution classique it�rative, qui sera beaucoup plus rapide</p>
<p class="centre"><a href="http://neamar.fr/Res/Sudoku">Lien vers le programme complet et fonctionnel<br /><img src="Images/Sudoku.png" alt="Sudoku" class="nonflottant" /></a></p>

<h3>PARTIE 2: QUAND NE PAS L�UTILISER</h3>

<p>Dans la majorit� des cas, dire qu�une fonction r�cursive n�est pas optimale n�est pas faisable au premier coup d��il : cela demande de r�fl�chir � la fa�on dont on pourrait r�aliser la solution en it�ratif, si la fonction r�cursive est bien employ�e�car il est facile de tomber dans l�exc�s ! En croyant faire le bien avec la m�thode r�cursive, on peut obtenir bien pire�Quelque cas :</p>

<ul>
<li>La m�thode r�cursive implique une redondance des calculs (cf. Exemple 1)</li>
<li>Le langage utilis� ne permet pas l�emploi de fonctions tail-rec</li>
<li>La m�thode r�cursive s�av�re plus complexe que la m�thode it�rative (m�me si la version r�cursive peut �tre beaucoup plus courte en lignes de code, il ne faut pas perdre de vue que ce qui importe au final c�est la version compil�e, et il faut qu�elle soit optimale)</li>
<li>On n�a pas forc�ment besoin d�explorer toutes les possibilit�s (ce que l�on cherche n�est pas forc�ment situ� sur une des branches finales, mais peut se situer sur une branche secondaire, ou m�me directement sur le tronc)</li>
</ul>

<h4>Exemple 1: La suite de Fibonacci</h4>
<p>Nous venons de voir deux exemples o� l�utilisation de la r�cursivit� �tait acceptable, � d�faut d��tre optimal. Mais ce n�est pas toujours le cas ! Je souhaite commencer ce r�quisitoire par quelque chose de tr�s simple.<br />
Je citerais ainsi sans m�y attarder la <a href="http://fr.wikipedia.org/wiki/Suite_de_Fibonacci" rel="nofollow">suite de Fibonacci</a>, souvent donn�e en exemple de r�cursivit� sous cette forme :</p>

<ol class="Comptable">
<li><cite>Fonction Fibonacci</cite> : Recevoir un nombre n
<ol class="Comptable">
<li>Si n&lt;2, renvoyer 1 car F<sub>1</sub>=F<sub>0</sub>=1</li>
<li>Sinon, renvoyer Fibonacci(n-1) + Fibonacci(n-2)</li>
</ol></li>
</ol>

<p>Regardons rapidement l�enchainement des calculs : pour Fibonacci(4) on obtient :<br />
<img src="Images/FiboDiagramme.png" alt="Diagramme de la suite de Fibonacci" class="nonflottant" /></p>
<p>Que remarque-t-on ? Que F(2) est calcul� plusieurs fois. Dans ce cas, cela reste minime. Mais quand n augmente, chaque nombre sera calcul� plusieurs fois. Ainsi, l� ou une solution it�rative impliquerait n-1 calculs, la solution r�cursive en demande beaucoup plus (une �tude plus approfondie montre que le nombre de calculs effectu�s avec la m�thode r�cursive est tr�s li�e � la suite de Fibonacci...et cela n�a aucun rapport avec la suite ! mais cela rentre dans le cadre de math�matiques l�g�rement plus pouss�es, nous n�en parlerons donc pas).<br />
Certes, on peut optimiser la m�thode r�cursive en utilisant des tableaux, mais cela devient au final plus lourd que la m�thode it�rative.</p>
<p class="centre"><a href="Fibonacci/">Lien vers le programme complet et fonctionnel<br /><img src="Images/Fibonacci.png" alt="Fibonacci" class="nonflottant" /></a></p>

<h4>Exemple 2 : D�composition en produits de facteurs premiers</h4>
<p><img src="Images/factoring_the_time.png" alt="Un strip de XKCD parfaitement adapt�" /></p>

<p>Nous allons maintenant nous pencher sur un nouvel exemple : la d�composition en facteurs premiers. Il s�agit d�un th�or�me math�matique : tout entier peut �tre d�compos� en un produit de facteurs premier.<br />
Quelques exemples :</p>
<ul>
<li>12 = 2<sup>2</sup>*3</li>
<li>54 = 2 * 3<sup>3</sup></li>
<li>53 = 53 (car 53 est premier !)</li>
</ul>
<p>Nous allons maintenant tenter de r�aliser un algorithme qui r�alisera cette tache fastidieuse pour nous. (On admet que cette d�composition est unique)</p>
<p class="comment">Rappel : Pour trouver la d�composition d�un nombre, il faut et il suffit de tester les nombres inf�rieurs � la racine du nombre. (Cela se d�montre facilement en observant les propri�t�s du produit et du carr�)</p>

<p>Voyons le r�sultat, cod� de fa�on na�ve :</p>
<ol style="clear:both;" class="Comptable">
<li><cite>Fonction DecoFact</cite> : re�oit un nombre K</li>
<li>Calculer sa racine</li>
<li>Pour tous les nombres inf�rieurs � cette racine (appelons les � i �),
<ol class="Comptable">
	<li>Si i est premier
	<ol class="Comptable">
		<li>Si le nombre test� est divisible par i (i.e K % i = 0 ou encore K/i = E(K/i) avec % le modulo, et E la fonction partie enti�re)
		<ol class="Comptable">
			<li>Trouver le compl�ment j tel que i*j=k</li>
			<li>Ajouter i � la liste des diviseurs � retourner</li>
			<li>Envoyer j � la fonction DecoFact, r�cup�rer le r�sultat et l�ajouter au tableau pr�existant</li>
		</ol></li>
	</ol></li>
</ol></li>
<li>Fin de la fonction : renvoyer la liste cr�e</li>
</ol>
<p>Comme on le voit, cet algorithme poss�de de nombreuses contraintes :</p>
<ul>
<li>Il faut r�aliser une fonction qui teste si le nombre est premier, ce qui obligera encore � faire une boucle (on ne sait pas, dans le cas g�n�ral, dire si un nombre est premier sans tester exhaustivement tous les nombres inf�rieurs � sa racine).</li>
<li>Il utilise la r�cursivit� : ce n�est pas forc�ment un d�faut, mais dans ce cas l� c�est inutile et lourd � mettre en place. N�oubliez pas que le processeur doit retenir la pile d�appel, ce qui alourdit inutilement les op�rations.</li>
</ul>
<p>R�fl�chissons ensemble : comment am�liorer cet algorithme ? Je vous laisse prendre une longueur d�avance�</p>

<p>Vous avez trouv�s ? F�licitations, dans ce cas l� vous n�avez plus besoin de moi�ah si, le monsieur qui l�ve le doigt au fond ! Vous voulez plus d�explications ? Bon tr�s bien.<br />
On peut �viter le recours � la r�cursivit� : que diriez-vous de l�algorithme suivant :</p>

<ol class="Comptable">
<li>Fonction DecoFact : re�oit un nombre K</li>
<li>Calculer sa racine</li>
<li>Pour tous les nombres inf�rieurs � cette racine (appelons les � i �),
<ol class="Comptable">
	<li>Si le nombre test� est divisible par i
	<ol class="Comptable">
		<li>L�ajouter dans la liste des diviseurs.</li>
		<li>Faire K = K / i</li>
		<li>Faire i = i -1</li>
	</ol></li>
	<li>Si K&gt;2, continuer la boucle, sinon en sortir</li>
</ol></li>
<li>Si K&gt;2, le nombre restant est premier : l�ajouter � la liste</li>
<li>Fin de la fonction : Renvoyer la liste.</li>
</ol>

<p>On obtient strictement le m�me r�sultat qu�avec l�algorithme pr�c�dent. Seule diff�rence : on ne fait plus le test de primalit�, on n�a plus besoin de la r�cursivit�, et le nombre d�it�rations dans les boucles est r�duit au strict minimum.<br />
Attardons nous d�abord sur le test de primalit�. Il est compl�tement inutile dans ce nouveau programme, puisque si i divise K, alors i est forc�ment premier puisque K est ajust� en permanence. Nous venons de gagner plusieurs cycles machines ! (faites des tests, vous verrez !)<br />
Quant � la r�cursivit�, une observation attentive du premier algorithme nous montre qu�il est absolument inutile de refaire les tests pour les num�ros inf�rieurs � i : si K n�est pas divisible par z, alors K/i ne sera pas non plus divisible par z ! En fait, l�appel r�cursif n�a pas compl�tement disparu : on a juste profit� du fait que les tests pouvaient se � continuer � � l�int�rieur de la fonction, sans avoir besoin de remettre en place la fonction (le fait que la fonction du 1er algorithme � s�arr�te� une fois trouv� un nombre aide bien � le simplifier).</p>

<p class="centre"><a href="DecoFact/">Lien vers le programme complet et fonctionnel<br /><img src="Images/DecoFact.png" alt="D�composition en produit de facteurs premiers" class="nonflottant" /></a></p>

<p>On l�a vu, cette fois, la r�cursivit� �tait loin d��tre adapt�e ! Ne foncez pas dedans t�te baiss�e � tout moment, cela peut amener � des codes beaucoup plus complexes.</p>

<h4>Exemple 3 : Le pathfinding</h4>
<p class="centre"><img src="Images/PathFinder.png" alt="Un exemple de PathFinder" class="nonflottant" /></p>
<p class="comment">Cette derni�re section couvrira rapidement le pathfinding, et plus particuli�rement l�algorithme A*. Elle sera l�g�rement plus complexe que les pr�c�dentes : je consid�rerais que vous connaissez le fonctionnement d�un pathfinder standard, qu�il soit A* ou Djikstra. Sinon, vous pourrez d�couvrir ces algorithmes ici : <a href="http://www.policyalmanac.org/games/aStarTutorial.htm" rel="nofollow">Le PathFinding avec A*</a></p>

 <p>L�algorithme A* fonctionne sur le principe des listes ferm�es et ouvertes. L�une des op�rations les plus couteuses en temps est la maintenance de liste ouverte tri�e selon la distance F, somme de la distance parcourue et de la distance heuristique.</p>
<p>Imaginons que l�on souhaite � am�liorer � cet algorithme en y ajoutant de la r�cursivit�.<br />
On pourrait imaginer deux fa�ons : </p>
<ul>
<li>1�re id�e : au lieu de maintenir une liste ouverte, on appelle une fonction qui prend en param�tres :
<ul>
	<li>La carte du terrain, avec ses sp�cificit�s</li>
	<li>Le carr� Parent</li>
	<li>Le co�t F.</li>
</ul>
<p>Dans une variable globale, on stockerait le co�t F que l�on accepte.<br />
Au tout d�but de la fonction, on ferait une boucle tant que le cout F global est inf�rieur au co�t F de la fonction. Tant que l�on a cela, on laisserait la main aux autres �v�nements, tandis qu�une fonction maitresse contr�lerait l�incr�mentation de la variable F.</p>

<p>Dois-je vraiment donner tous les inconv�nients de cette m�thode ? Variables Globales, Multi threading, encombrement de la pile d�appel, tests inutiles et r�p�titifs, gestion de la fonction maitresse�on obtiendrait certes un pathfinder beaucoup plus propre, mais � combien moins performant ! Ca tombe mal, c�est justement le but principal d�un pathfinder�</p></li>
<li>2�me id�e : cette fois, focalisons nous sur l�algorithme de Djikstra, dont le but n�est pas de se rendre en un point fixe X,Y, mais en un point contenant un certain type d�item : par exemple, un villageois lancerait l�algorithme de Djikstra pour trouver la mine d�or la plus proche. On pourrait penser que la m�thode r�cursive est une alternative possible. Malheureusement, la r�cursivit� oblige � � fouiller � enti�rement une branche avant de pouvoir passer � la suivante. C�est justement ce que l�algorithme de Djikstra essaie de ne pas faire : il faut fouiller le moins de n�uds possibles ! Si on utilisait la r�cursivit�, une immense partie de la carte serait explor�e � chaque recherche. Pour pallier � cet inconv�nient, il faudrait mettre en place un param�tre qui indique � la fonction son niveau sur l�arbre (branche de niveau 1, de niveau 2�) et ne pas commencer un niveau tant que le pr�c�dant n�est pas fini. On retombe � nouveau sur un syst�me de gestion de priorit�s en multithreading : infaisable pour un algorithme suppos� �tre � real-time � !</li>
</ul>
<p>Bref, le pathfinding est bien mieux tel qu�il est : des g�n�rations de programmeurs s�y sont cass�s les dents, il �tait peu probable qu�une modification aussi � �vidente � n�ait pas d�j� �t� envisag�e. Et si elle avait plus int�ressante, cela se saurait ! Comme le dit un c�l�bre proverbe geek : � pas d�int�r�t � r�inventer la roue �</p>
<p class="centre"><a href="https://neamar.fr/Res/Pathfinder/">Lien vers le programme complet et fonctionnel (�crit en AS3)<br /><img src="/Res/Pathfinder/Images/Pathfinder.png" alt="D�composition en produit de facteurs premiers" class="nonflottant" /></a></p>

<h2>Conclusion</h2>

<p>J�esp�re que vous avez compris le message : la r�cursivit� peut s�av�rer un outil pr�cieux pour la simplification de vos codes.<br />
Malheureusement, le verso des choses est moins brillant : il peut s�av�rer que la m�thode r�cursive soit plus complexe, plus lourde, et qu�au final elle rende l�algorithme incompr�hensible pour un lecteur externe.</p>
<p>Ce n�est pas une raison pour oublier la r�cursivit� : il ne faut simplement pas l�assaisonner � toutes les sauces. Tous comme le slogan � Manger Bouger �, n�oubliez pas que l�arsenal du programmeur comporte d�autres outils, qui peuvent s�av�rer plus pratiques et/ou plus adapt�s que la r�cursivit�. Se focaliser sur la m�me source n'est jamais une bonne id�e !</p>
<p>Bonne continuation dans la programmation !</p>
<?php
include "../footer.php";
?>
