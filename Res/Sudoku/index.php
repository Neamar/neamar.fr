<?php
$Titre='Solutionneur de sudoku gratuit, fiable et rapide.';
$Box = array("Auteur" => "Neamar","Date" => "Avril 2008", "But" =>"R�soudre sudoku","Langage" =>"Visual Basic","Voir aussi" =>'<a href="../Recursivite">La r�cursivit�</a>');
include('../header.php');
?>
<h1>R�solveur de Sudoku complet et efficace</h1>
<h2>Pr�sentation</h2>
<h3>Images</h3>

<p><img src="Images/Sudoku.jpg" alt="Sudoku solver" /></p>
<p><img src="Images/Sudoku2.png" alt="Sudoku solver : La grille la plus dure de sudoku" />R�sout m�me "The hardest Sudoku Grid !" (2�me image)</p>
<h3>Description</h3>
<p>Ce code illustre une nouvelle fois la r�cursivit�.<br />
Il se charge de calculer tous les sudoku possibles selon ce que vous lui donnez en entr�e.<br />
Si vous ne lui donnez rien (en laissant toutes les cases vides), il se "contentera" de vous sortir toutes les grilles de sudoku existantes (oui oui, les 6'670'903'752'021'072'936'960. grilles possibles !</p>
<p>Enfin, soyons franc, votre PC risque fortement d'�tre � court de m�moire avant que vous n'en voyez la couleur !</p>
<p>Le tout tient en moins de 80 lignes de code... vive la r�cursivit� (la source est abondamment d�taill�e).<br />
En moyenne, il lui faut 0.2 secondes pour r�soudre une grille diabolique...et il a r�solu la grille "Near worst case" (la grille la plus complexe � r�soudre) en moins de 5 minutes, l� ou les autres algorithmes prennent en moyenne entre 30 et 45 minutes : (Wikipedia)</p>
<blockquote><p>Based on the specific construction of the computer code, programmers have found the solution time for this puzzle to be between 30 and 45 minutes with a computer processor running at 3 GHz.</p></blockquote>
<p>Je l'ai laiss� tourner pendant une heure et demie sur mon PC, j'ai recu 2 000 000 de solutions...ce qui prend 1.52 Go de m�moire (il y a une option pour enregistrer les solutions dans un fichier).</p>


<h2>Plus d'informations</h2>
<p>La r�solution d'une grille de Sudoku standard peut se concevoir de plusieurs fa�ons, et la m�thode it�rative fait partie des solutions possibles.<br />
Mais imaginons maintenant que l'on souhaite r�soudre une grille qui peut poss�der plus d'une solution. Ce n'est pas le cas des grilles de jeux donn�es dans les magazines, mais cela peut �tre l'objet d'un petit d�fi math�matique.</p>

<p>Cette fois, la m�thode it�rative s'av�re beaucoup plus lourde, voire ing�rable : il faudrait utiliser une m�thode de Brute-Force, et les r�sultats risqueraient de prendre beaucoup de temps pour sortir...examinons donc la m�thode r�cursive, qui se r�v�lera un petit peu plus fine, et qui ne demandera pas d'acheter un ordinateur Deep Blue 4 !</p>
<p>Prenons le raisonnement suivant :</p>
<ol>
<li><cite>Fonction Sudoku_Solver</cite> : re�oit une grille de sudoku</li>
<li>Si la grille est pleine, l'enregistrer</li>
<li>Sinon,
<ol>
	<li>Trouver UNE case vide</li>
	<li>Tester pour tous les chiffres de 1 � 9 :
	<ol>

		<li>Si le chiffre test� est envisageable pour la case vide choisie, placer le chiffre sur la grille � cet emplacement. Envoyer la grille � la fonction Sudoku_Solver</li>
	</ol></li>
	<li>Si aucun chiffre n'est envisageable pour cette position, c'est que la grille est incorrecte. Ce n'est pas grave : cette branche de la r�cursivit� s'arr�tera ici.</li>
</ol></li>
<li>Arr�ter la fonction</li>
</ol>

<p>A chaque it�ration, la grille se remplit d'une case. (Comme on teste pour tous les nombres de 1 � 9, on est sur qu'au moins une des grilles contient la bonne r�ponse...si la bonne r�ponse existe)</p>

<p>On peut voir cet algorithme de r�solution comme un arbre : � chaque passage, on rajoute quelques branches. Si aucune solution n'est possible, la grille est fausse : la branche n'engendre pas d'enfants, et meurt donc.</p>
<p class="comment">On peut remarquer que si on envoie � la fonction Sudoku_Solver une grille compl�tement vide, on peut en th�orie obtenir toutes les grilles de Sudoku du monde. Cependant, au vu du nombre de possibilit�s (6 670 903 752 021 072 936 960) et des d�fauts de l'algorithme list�s ci-dessous, il faudrait un ordinateur disposant d'une �norme quantit� de m�moire vive.</p>

<p>Un article d�taill� a �t� �crit couvrant les tenants et aboutissants de la m�thode r�cursive par rapport � la m�thode it�rative : <a href="../Recursivite">� propos de la r�cursivit�</a></p>
<h2>T�l�chargement</h2>
<h3>Version Zipp�e : EXE + Code source</h3>
<ul>
<li><a href="Release/Sudoku.zip">ZIP</a></li>
</ul>
<h3>Version EXE</h3>
<ul>
<li><a href="Release/Sudoku.exe">EXE</a></li>
<li><a href="Release/vb6fr.dll">VB6FR.dll</a> : � placer dans le m�me dossier que le fichier EXE</li>
</ul>
<h2>Code source</h2>
<p>La feuille :</p>
<?php InclureCode('Form1.frm',"VB"); ?>
<p>Les modules :</p>
<?php InclureCode('Solver.bas',"VB"); ?>
<?php
include('../footer.php');
?>