<?php
$Titre='Solutionneur de sudoku gratuit, fiable et rapide.';
$Box = array("Auteur" => "Neamar","Date" => "Avril 2008", "But" =>"Résoudre sudoku","Langage" =>"Visual Basic","Voir aussi" =>'<a href="../Recursivite">La récursivité</a>');
include('../header.php');
?>
<h1>Résolveur de Sudoku complet et efficace</h1>
<h2>Présentation</h2>
<h3>Images</h3>

<p><img src="Images/Sudoku.jpg" alt="Sudoku solver" /></p>
<p><img src="Images/Sudoku2.png" alt="Sudoku solver : La grille la plus dure de sudoku" />Résout même "The hardest Sudoku Grid !" (2ème image)</p>
<h3>Description</h3>
<p>Ce code illustre une nouvelle fois la récursivité.<br />
Il se charge de calculer tous les sudoku possibles selon ce que vous lui donnez en entrée.<br />
Si vous ne lui donnez rien (en laissant toutes les cases vides), il se "contentera" de vous sortir toutes les grilles de sudoku existantes (oui oui, les 6'670'903'752'021'072'936'960. grilles possibles !</p>
<p>Enfin, soyons franc, votre PC risque fortement d'être à court de mémoire avant que vous n'en voyez la couleur !</p>
<p>Le tout tient en moins de 80 lignes de code... vive la récursivité (la source est abondamment détaillée).<br />
En moyenne, il lui faut 0.2 secondes pour résoudre une grille diabolique...et il a résolu la grille "Near worst case" (la grille la plus complexe à résoudre) en moins de 5 minutes, là ou les autres algorithmes prennent en moyenne entre 30 et 45 minutes : (Wikipedia)</p>
<blockquote><p>Based on the specific construction of the computer code, programmers have found the solution time for this puzzle to be between 30 and 45 minutes with a computer processor running at 3 GHz.</p></blockquote>
<p>Je l'ai laissé tourner pendant une heure et demie sur mon PC, j'ai recu 2 000 000 de solutions...ce qui prend 1.52 Go de mémoire (il y a une option pour enregistrer les solutions dans un fichier).</p>


<h2>Plus d'informations</h2>
<p>La résolution d'une grille de Sudoku standard peut se concevoir de plusieurs façons, et la méthode itérative fait partie des solutions possibles.<br />
Mais imaginons maintenant que l'on souhaite résoudre une grille qui peut posséder plus d'une solution. Ce n'est pas le cas des grilles de jeux données dans les magazines, mais cela peut être l'objet d'un petit défi mathématique.</p>

<p>Cette fois, la méthode itérative s'avère beaucoup plus lourde, voire ingérable : il faudrait utiliser une méthode de Brute-Force, et les résultats risqueraient de prendre beaucoup de temps pour sortir...examinons donc la méthode récursive, qui se révélera un petit peu plus fine, et qui ne demandera pas d'acheter un ordinateur Deep Blue 4 !</p>
<p>Prenons le raisonnement suivant :</p>
<ol>
<li><cite>Fonction Sudoku_Solver</cite> : reçoit une grille de sudoku</li>
<li>Si la grille est pleine, l'enregistrer</li>
<li>Sinon,
<ol>
	<li>Trouver UNE case vide</li>
	<li>Tester pour tous les chiffres de 1 à 9 :
	<ol>

		<li>Si le chiffre testé est envisageable pour la case vide choisie, placer le chiffre sur la grille à cet emplacement. Envoyer la grille à la fonction Sudoku_Solver</li>
	</ol></li>
	<li>Si aucun chiffre n'est envisageable pour cette position, c'est que la grille est incorrecte. Ce n'est pas grave : cette branche de la récursivité s'arrêtera ici.</li>
</ol></li>
<li>Arrêter la fonction</li>
</ol>

<p>A chaque itération, la grille se remplit d'une case. (Comme on teste pour tous les nombres de 1 à 9, on est sur qu'au moins une des grilles contient la bonne réponse...si la bonne réponse existe)</p>

<p>On peut voir cet algorithme de résolution comme un arbre : à chaque passage, on rajoute quelques branches. Si aucune solution n'est possible, la grille est fausse : la branche n'engendre pas d'enfants, et meurt donc.</p>
<p class="comment">On peut remarquer que si on envoie à la fonction Sudoku_Solver une grille complètement vide, on peut en théorie obtenir toutes les grilles de Sudoku du monde. Cependant, au vu du nombre de possibilités (6 670 903 752 021 072 936 960) et des défauts de l'algorithme listés ci-dessous, il faudrait un ordinateur disposant d'une énorme quantité de mémoire vive.</p>

<p>Un article détaillé a été écrit couvrant les tenants et aboutissants de la méthode récursive par rapport à la méthode itérative : <a href="../Recursivite">À propos de la récursivité</a></p>
<h2>Téléchargement</h2>
<h3>Version Zippée : EXE + Code source</h3>
<ul>
<li><a href="Release/Sudoku.zip">ZIP</a></li>
</ul>
<h3>Version EXE</h3>
<ul>
<li><a href="Release/Sudoku.exe">EXE</a></li>
<li><a href="Release/vb6fr.dll">VB6FR.dll</a> : à placer dans le même dossier que le fichier EXE</li>
</ul>
<h2>Code source</h2>
<p>La feuille :</p>
<?php InclureCode('Form1.frm',"VB"); ?>
<p>Les modules :</p>
<?php InclureCode('Solver.bas',"VB"); ?>
<?php
include('../footer.php');
?>