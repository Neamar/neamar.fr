<?php
$Titre='La s�rie des graphes';
$Box = array("Auteur" => "Neamar","Date" => "2008 - 2009", "But" =>"Listing","Voir aussi"=>'<a href="../Compiler_AS3">Compiler l\'AS3</a>');
include('../header.php');
?>
<h1>La s�rie des Graphes</h1>
<p>La s�rie des graphes est un ensemble de quatre jeux exploitant la th�orie math�matique des graphes (partez pas ! c'est sous forme tr�s ludique).</p>
<p>Cette page sert de portail vers les jeux de cette s�rie.</p>
<h2>AGraphe</h2>
<p><a href="/Res/AGraphe">Page d�di�e</a></p>
<p>A-Graphe est le premier jeu de la s�rie, le plus simple et le plus l�ger.<br />
Le but est d'allumer le noeud central, en suivant certaines r�gles simples de combinatoire mises sous formes de jeux. Un concept attrayant mais un peu trop facile</p>
<ul><li>Se joue seul, sur un plateau discret</li></ul>
<h2>BGraphe</h2>
<p><a href="/Res/BGraphe">Page d�di�e</a></p>
<p>Le deuxi�me de la s�rie, avec un design tr�s similaire � celui d'AGraphe. C'est le jeu avec les r�gles les plus simples (elles se r�sument en <q>dem�ler les noeuds</q>).<br />
M�me si l'id�e de base est sympathique, il est difficile d'apporter des nouveaux �lements au fur et � mesure des niveaux, et la difficult� augmente artificiellement avec le nombre de noeuds. Sympathique au d�but, int�ressant quand on a compris comment progresser, mais un peu longuet sur la fin, car les niveaux deviennent r�ellement complexes.</p>
<ul><li>Se joue seul, sur un plateau continu</li></ul>
<h2>CGraphe</h2>
<p><a href="/Res/CGraphe">Page d�di�e</a></p>
<p>On remet pour la troisi�me et avant-derni�re fois le couvert ! Cette fois, le design �volue : exit le fond statique, il est remplac� par un bruit num�rique du plus bel effet... m�me s'il pompe pas mal de ressources.<br />
Bas� sur le peu connu <q>Shannon Switching Game</q>, le jeu introduit pour la premi�re fois dans la s�rie une intelligence artificielle, au comportement assez informatique pour mettre du piquant au jeu, et assez humain pour laisser sa chance au joueur. Quant � la difficult�, apr�s le "trop facile" AGraphe et "trop compliqu�" BGraphe, elle est un peu mieux dos�e... m�me si d'aucuns continuent de juger le jeu trop facile.</p>
<ul><li>Se joue � deux, sur un plateau discret</li></ul>
<h2>DGraphe</h2>
<p><a href="/Res/DGraphe">Page d�di�e</a></p>
<p>Une fois les trois jeux finis, Dgraphe repr�sentait un peu l'apoth�ose. Il reprend dans son code des id�es de chacun des jeux, formant un jeu de strat�gie temps r�el au concept simple mais puissant. Bient�t disponible !</p>
<ul><li>Se joue � deux, sur un plateau continu</li></ul>
<?php
include('../footer.php');
?>