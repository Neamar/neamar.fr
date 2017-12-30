<?php
$Titre='La série des graphes';
$Box = array("Auteur" => "Neamar","Date" => "2008 - 2009", "But" =>"Listing","Voir aussi"=>'<a href="../Compiler_AS3">Compiler l\'AS3</a>');
include('../header.php');
?>
<h1>La série des Graphes</h1>
<p>La série des graphes est un ensemble de quatre jeux exploitant la théorie mathématique des graphes (partez pas ! c'est sous forme très ludique).</p>
<p>Cette page sert de portail vers les jeux de cette série.</p>
<h2>AGraphe</h2>
<p><a href="/Res/AGraphe">Page dédiée</a></p>
<p>A-Graphe est le premier jeu de la série, le plus simple et le plus léger.<br />
Le but est d'allumer le noeud central, en suivant certaines règles simples de combinatoire mises sous formes de jeux. Un concept attrayant mais un peu trop facile</p>
<ul><li>Se joue seul, sur un plateau discret</li></ul>
<h2>BGraphe</h2>
<p><a href="/Res/BGraphe">Page dédiée</a></p>
<p>Le deuxième de la série, avec un design très similaire à celui d'AGraphe. C'est le jeu avec les règles les plus simples (elles se résument en <q>demêler les noeuds</q>).<br />
Même si l'idée de base est sympathique, il est difficile d'apporter des nouveaux élements au fur et à mesure des niveaux, et la difficulté augmente artificiellement avec le nombre de noeuds. Sympathique au début, intéressant quand on a compris comment progresser, mais un peu longuet sur la fin, car les niveaux deviennent réellement complexes.</p>
<ul><li>Se joue seul, sur un plateau continu</li></ul>
<h2>CGraphe</h2>
<p><a href="/Res/CGraphe">Page dédiée</a></p>
<p>On remet pour la troisième et avant-dernière fois le couvert ! Cette fois, le design évolue : exit le fond statique, il est remplacé par un bruit numérique du plus bel effet... même s'il pompe pas mal de ressources.<br />
Basé sur le peu connu <q>Shannon Switching Game</q>, le jeu introduit pour la première fois dans la série une intelligence artificielle, au comportement assez informatique pour mettre du piquant au jeu, et assez humain pour laisser sa chance au joueur. Quant à la difficulté, après le "trop facile" AGraphe et "trop compliqué" BGraphe, elle est un peu mieux dosée... même si d'aucuns continuent de juger le jeu trop facile.</p>
<ul><li>Se joue à deux, sur un plateau discret</li></ul>
<h2>DGraphe</h2>
<p><a href="/Res/DGraphe">Page dédiée</a></p>
<p>Une fois les trois jeux finis, Dgraphe représentait un peu l'apothéose. Il reprend dans son code des idées de chacun des jeux, formant un jeu de stratégie temps réel au concept simple mais puissant. Bientôt disponible !</p>
<ul><li>Se joue à deux, sur un plateau continu</li></ul>
<?php
include('../footer.php');
?>