<?php
$Titre='Calculatrice évoluée (type TI/Casio)';
$Box = array("Auteur" => "Neamar","Date" => "Mai 2008", "But" =>"La récursivité","Langage" =>"Visual Basic");
include('../header.php');
?>
<h1>Une calculatrice "en ligne"</h1>
<h2>Présentation</h2>
<h3>Images</h3>
<p><img src="Images/Calc.png" alt="Calculatrice" /><img src="Images/Calc3.jpg" alt="Calculatrice" /><img src="Images/Calc2.jpg" alt="Calculatrice" /></p>
<h3>Description</h3>
<p>Vous en avez marre de ces sources de calculette qui se contentent de vous offrir des boutons ?<br />
Je comprends.<br />
Cependant, il faut avouer que la réalisation d'une calculatrice capable de transformer le string :<br />
<cite>(sqr(e(ln((1+3)*(1/(2^2))))))^<sup>2</sup></cite><br />
en calcul n'est pas facile (pour les plus courageux, ca vaut 1 :-))!</p>
<p>Il faut bien penser que les maths ne nous simplifient pas le travail : priorité des opérations, parenthèses (le code <cite>2(2+1) = 2*(2+1)</cite> n'est pas forcément évident !)...</p>

<p>Cette calculette semble bien s'en tirer...cependant, j'ai commencé à la programmer il y a 48h, il est donc possible que certains bugs se soient dissimulés.</p>

<p>Le code est extrêmement commenté...il n'utilise aucune API, aucune fonction avancée..le calcul est entièrement géré par le module appelé "Théorie". (211 lignes de code // 84 lignes de commentaires)<br />
Le but était d'obtenir un code très souple et portable. On aurait certes pu utiliser les expressions régulières, ou un composant tout fait, mais dans ce cas là on perdait toute la portabilité de l'ensemble. Le fait d'avoir tout programmé <em>from scratches</em> permettrait ainsi d'exporter le code en n'importe quel langage en moins d'une demie heure, voire même de l'implanter sur un microprocesseur et de lancer sa propre calculette !</p>

<p>Le module "Graphique", quant à lui, "colorie" le code : il met en exposant les puissances, met le contenu des parenthèses en couleur...(utilisation du contrôle RichTextBox 6.0)(41 lignes de code // 8 lignes de commentaires)</p>

<p>Et la Form ne contient que 30 lignes...</p>

<p>La calculette gère les opérations standards : + - * / % (modulo), et ! (factorielle),ainsi que e (exponentielle), ln (logarithme népérien),tan et atn, avec gestion des priorités! C'est à dire que : <br />
<cite>1 + 2/2 = 2</cite><br />
...ce qui pour l'ordinateur était loin d'être clair !</p>
<p>Il y a aussi un outil somme, qui s'utilise de la façon suivante :<br />
<cite>somme([Nom_Variable]=[départ],[Arrivee],[Calcul])</cite></p>
<p>Cette somme est incorporable dans n'importe quel calcul, et vous pouvez même effectuer des sommes à l'intérieur de sommes à l'intérieur de sommes à l'intérieur de sommes...bref!<br />
Par exemple, le code suivant renvoie une approximation de PI en utilisant la méthode du développement limité d'arctangente :<br />
<cite>4*somme(k=0,5000,(-1)^<sup>k</sup>*(1/(2*k+1)))</cite>.</p>

<h3>Plus d'informations</h3>
<p>Si vous ne comprenez pas tout, lancez un calcul, et regardez la fenêtre exécution : elle affiche en temps réel les calculs effectués.</p>


<p>Par exemple :</p>

<pre>Initialisation du calcul (sqr(e(ln((1+3)*(1/(2^2))))))^2
-------------------------------------------------------
     Math_It va effectuer le calcul (sqr(e(ln((1+3)*(1/(2^2))))))^2
          Math_It va effectuer le calcul sqr(e(ln((1+3)*(1/(2^2)))))
               Math_It va effectuer le calcul (e(ln((1+3)*(1/(2^2)))))
                    Math_It va effectuer le calcul (ln((1+3)*(1/(2^2))))
                         Math_It va effectuer le calcul ((1+3)*(1/(2^2)))
                              Math_It va effectuer le calcul 1+3
                                   Math_It va effectuer le calcul 3
3 a renvoyé 3
1+3 a renvoyé 4
                                        Math_It va effectuer le calcul 1/(2^2)
                                             Math_It va effectuer le calcul 2^2
                                                  Math_It va effectuer le calcul 2
2 a renvoyé 2
2^2 a renvoyé 4
1/(2^2) a renvoyé 0,25
(1+3)*(1/(2^2)) a renvoyé 1
ln((1+3)*(1/(2^2))) a renvoyé 0
e(ln((1+3)*(1/(2^2)))) a renvoyé 1
sqr(e(ln((1+3)*(1/(2^2))))) a renvoyé 1
                                                       Math_It va effectuer le calcul 2
2 a renvoyé 2
(sqr(e(ln((1+3)*(1/(2^2))))))^2 a renvoyé 1</pre>

<p>Comme vous le voyez, le calcul se décompose sous plusieurs formes très simples...(ce qui est, rappelons le, le but de la récursivité !)</p>

<p>De plus, le code est extrêmement souple : si quelqu'un voulait par exemple créer un grapheur, il n'y aurait pas de grosses difficultés.<br />
De même, si quelqu'un souhaitait le passer dans un autre langage, il lui suffirait de traduire le module théorie dans le bon langage...Comme ce module utilise des fonctions communes à tous les langages, il n'y a aucun problème.<br />

Quant à la rapidité, c'est acceptable : pour un DL de 5000 termes, le temps d'exécution est très inférieur à 2 secondes.</p>

<h3>A propos du débordement</h3>
<p class="comment">Les calculs se font avec des variables Double...ce qui laisse assez de marges pour les calculs.</p>

<h2>Téléchargement</h2>
<p class="erreur">Ce fichier n'est disponible que pour Windows, car il a été écrit en Visual Basic.</p>
<h3>Fichier ZIP (EXE + Sources)</h3>
<ul>
<li><a href="Release/Calc.zip">Code source + Fichier EXE</a></li>
</ul>
<h3>Fichier EXE</h3>
<ul>
<li><a href="Release/Calc.exe">Fichier EXE</a></li>
<li><a href="Release/vb6fr.dll">vb6fr.DLL</a> : En cas de problème, la mettre à coté de l'application</li>
<li><a href="Release/vb6fr.zip">vb6fr.DLL.zip</a> : La même, zippée</li>
<li><a href="Release/RICHTX32.OCX">RICHTX32.OCX.zip</a> : Vous aurez peut être besoin de ce composant, toujours à placer à côté. (inclus dans le premier zip)</li>
</ul>
<h2>Code source</h2>
<h3>Feuille</h3>
<?php InclureCode('Calculette.frm',"vb"); ?>
<h3>Modules</h3>
<h4>Module Théorie</h4>
<?php InclureCode('Theorie.bas',"vb"); ?>
<h4>Module Graphique</h4>
<?php InclureCode('Graphique.bas',"vb"); ?>
<?php
include('../footer.php');
?>
