<?php
$Titre='Calculatrice �volu�e (type TI/Casio)';
$Box = array("Auteur" => "Neamar","Date" => "Mai 2008", "But" =>"La r�cursivit�","Langage" =>"Visual Basic");
include('../header.php');
?>
<h1>Une calculatrice "en ligne"</h1>
<h2>Pr�sentation</h2>
<h3>Images</h3>
<p><img src="Images/Calc.png" alt="Calculatrice" /><img src="Images/Calc3.jpg" alt="Calculatrice" /><img src="Images/Calc2.jpg" alt="Calculatrice" /></p>
<h3>Description</h3>
<p>Vous en avez marre de ces sources de calculette qui se contentent de vous offrir des boutons ?<br />
Je comprends.<br />
Cependant, il faut avouer que la r�alisation d'une calculatrice capable de transformer le string :<br />
<cite>(sqr(e(ln((1+3)*(1/(2^2))))))^<sup>2</sup></cite><br />
en calcul n'est pas facile (pour les plus courageux, ca vaut 1 :-))!</p>
<p>Il faut bien penser que les maths ne nous simplifient pas le travail : priorit� des op�rations, parenth�ses (le code <cite>2(2+1) = 2*(2+1)</cite> n'est pas forc�ment �vident !)...</p>

<p>Cette calculette semble bien s'en tirer...cependant, j'ai commenc� � la programmer il y a 48h, il est donc possible que certains bugs se soient dissimul�s.</p>

<p>Le code est extr�mement comment�...il n'utilise aucune API, aucune fonction avanc�e..le calcul est enti�rement g�r� par le module appel� "Th�orie". (211 lignes de code // 84 lignes de commentaires)<br />
Le but �tait d'obtenir un code tr�s souple et portable. On aurait certes pu utiliser les expressions r�guli�res, ou un composant tout fait, mais dans ce cas l� on perdait toute la portabilit� de l'ensemble. Le fait d'avoir tout programm� <em>from scratches</em> permettrait ainsi d'exporter le code en n'importe quel langage en moins d'une demie heure, voire m�me de l'implanter sur un microprocesseur et de lancer sa propre calculette !</p>

<p>Le module "Graphique", quant � lui, "colorie" le code : il met en exposant les puissances, met le contenu des parenth�ses en couleur...(utilisation du contr�le RichTextBox 6.0)(41 lignes de code // 8 lignes de commentaires)</p>

<p>Et la Form ne contient que 30 lignes...</p>

<p>La calculette g�re les op�rations standards : + - * / % (modulo), et ! (factorielle),ainsi que e (exponentielle), ln (logarithme n�p�rien),tan et atn, avec gestion des priorit�s! C'est � dire que : <br />
<cite>1 + 2/2 = 2</cite><br />
...ce qui pour l'ordinateur �tait loin d'�tre clair !</p>
<p>Il y a aussi un outil somme, qui s'utilise de la fa�on suivante :<br />
<cite>somme([Nom_Variable]=[d�part],[Arrivee],[Calcul])</cite></p>
<p>Cette somme est incorporable dans n'importe quel calcul, et vous pouvez m�me effectuer des sommes � l'int�rieur de sommes � l'int�rieur de sommes � l'int�rieur de sommes...bref!<br />
Par exemple, le code suivant renvoie une approximation de PI en utilisant la m�thode du d�veloppement limit� d'arctangente :<br />
<cite>4*somme(k=0,5000,(-1)^<sup>k</sup>*(1/(2*k+1)))</cite>.</p>

<h3>Plus d'informations</h3>
<p>Si vous ne comprenez pas tout, lancez un calcul, et regardez la fen�tre ex�cution : elle affiche en temps r�el les calculs effectu�s.</p>


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
3 a renvoy� 3
1+3 a renvoy� 4
                                        Math_It va effectuer le calcul 1/(2^2)
                                             Math_It va effectuer le calcul 2^2
                                                  Math_It va effectuer le calcul 2
2 a renvoy� 2
2^2 a renvoy� 4
1/(2^2) a renvoy� 0,25
(1+3)*(1/(2^2)) a renvoy� 1
ln((1+3)*(1/(2^2))) a renvoy� 0
e(ln((1+3)*(1/(2^2)))) a renvoy� 1
sqr(e(ln((1+3)*(1/(2^2))))) a renvoy� 1
                                                       Math_It va effectuer le calcul 2
2 a renvoy� 2
(sqr(e(ln((1+3)*(1/(2^2))))))^2 a renvoy� 1</pre>

<p>Comme vous le voyez, le calcul se d�compose sous plusieurs formes tr�s simples...(ce qui est, rappelons le, le but de la r�cursivit� !)</p>

<p>De plus, le code est extr�mement souple : si quelqu'un voulait par exemple cr�er un grapheur, il n'y aurait pas de grosses difficult�s.<br />
De m�me, si quelqu'un souhaitait le passer dans un autre langage, il lui suffirait de traduire le module th�orie dans le bon langage...Comme ce module utilise des fonctions communes � tous les langages, il n'y a aucun probl�me.<br />

Quant � la rapidit�, c'est acceptable : pour un DL de 5000 termes, le temps d'ex�cution est tr�s inf�rieur � 2 secondes.</p>

<h3>A propos du d�bordement</h3>
<p class="comment">Les calculs se font avec des variables Double...ce qui laisse assez de marges pour les calculs.</p>

<h2>T�l�chargement</h2>
<p class="erreur">Ce fichier n'est disponible que pour Windows, car il a �t� �crit en Visual Basic.</p>
<h3>Fichier ZIP (EXE + Sources)</h3>
<ul>
<li><a href="Release/Calc.zip">Code source + Fichier EXE</a></li>
</ul>
<h3>Fichier EXE</h3>
<ul>
<li><a href="Release/Calc.exe">Fichier EXE</a></li>
<li><a href="Release/vb6fr.dll">vb6fr.DLL</a> : En cas de probl�me, la mettre � cot� de l'application</li>
<li><a href="Release/vb6fr.zip">vb6fr.DLL.zip</a> : La m�me, zipp�e</li>
<li><a href="Release/RICHTX32.OCX">RICHTX32.OCX.zip</a> : Vous aurez peut �tre besoin de ce composant, toujours � placer � c�t�. (inclus dans le premier zip)</li>
</ul>
<h2>Code source</h2>
<h3>Feuille</h3>
<?php InclureCode('Calculette.frm',"vb"); ?>
<h3>Modules</h3>
<h4>Module Th�orie</h4>
<?php InclureCode('Theorie.bas',"vb"); ?>
<h4>Module Graphique</h4>
<?php InclureCode('Graphique.bas',"vb"); ?>
<?php
include('../footer.php');
?>
