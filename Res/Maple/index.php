<?php
$Titre='Aide mémoire ne prétendant à aucune exhaustivité concernant Maple';
$Box = array("Auteurs" => "Neamar &amp; Aloïs","Date" => "Juin 2008", "But" =>"Aide mémoire");
$AddLine=<<<EOF
  <script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      tex2jax: {inlineMath: [['\\\\(','\\\\)']]}
    });
    </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=TeX-MML-AM_CHTML"></script>
EOF;
include('../header.php');
?>
<h1>Les fonctions courantes de Maple</h1>
<p><img src="Images/Maple.jpg" alt="Maple 11" /></p>
<div class="TOC floatR insideTOC"></div>
<p>Maple peut être très utile, à condition de savoir le maitriser.<br />
Voici un mini formulaire, qui ne remplacera pas un cours, mais saura vous aider pour les trous de mémoire.</p>
<p class="comment">En marquant la fonction avec une majuscule sur la première lettre, on affiche l'expression qui va être calculée. Cela permet de clarifier la lecture du document !</p>




<h2>Manipulation d'expression</h2>
<h3>Valeurs approchées :</h3>
<p>&gt; <span style="color:red;">evalf(Pi,25)</span>;</p>
<p class="centre no_lettrine">\(3.141592653589793238462643\)</p>

<h3>Tests Logiques :</h3>
<p>&gt; <span style="color:red;">is(2>1)</span>;</p>
<p class="centre no_lettrine">\(true\)</p>

<h3>Sommes</h3>
<p>&gt; <span style="color:red">Sum(x,x=1..5) = sum(x,x=1..5)</span>;</p>
<p class="centre no_lettrine">\(\sum_1^5 x=15\)</p>

<h3>Produits</h3>

<p>&gt; <span style="color:red">Product(x,x=1..5) = product(x,x=1..5)</span>;</p>
<p class="centre no_lettrine">\(\prod_1^5 x=120\)</p>


<h2>Manipulation de fonctions</h2>
<h3>Définition de fonction :</h3>
<p>Attention à bien faire la différence entre une fonction et une expression.<br />
Pour créer directement une fonction :</p>
<p>&gt; <span style="color:red;">f:=x->1/(x*(x+1)*(x+2)(x+3))</span>;</p>
<p class="centre no_lettrine">\(f:=x\rightarrow\frac{1}{x(x + 1)(x + 2)(x + 3)}\)</p>

<p>On peut aussi transformer une expression (i.e une chaine alphanumérique) en fonction, il suffit d'indiquer de quelles variables doit dépendre la fonction.</p>
<p>&gt; <span style="color:red;">f:=unapply(1/(x*(x+1)*(x+2)(x+3)),x)</span>;</p>
<p class="centre no_lettrine">\(f:=x\rightarrow\frac{1}{x(x + 1)(x + 2)(x + 3)}\)</p>

<h3>Fractions</h3>
<h4>Décomposition en élements simples :</h4>
<p>&gt; <span style="color:red;">convert(f(x),parfrac,x)</span>;</p>
<p class="centre no_lettrine">\(\frac{1}{2(x+2)} + \frac{1}{6x} - \frac{1}{6x+3} -  \frac{1}{2(x+1)}\)</p>

<h4>Réduction au même dénominateur</h4>
<p>&gt; <span style="color:red">Req:=1/((1/R1)+(1/R2))</span>;</p>
<p class="centre no_lettrine">\(Req:=\frac{1}{\frac{1}{R_1}+\frac{1}{R_2}}\)</p>

<p>&gt; <span style="color:red">normal(Req)</span>;</p>
<p class="centre no_lettrine">\(\frac{R_1R_2}{R1+R2}\)</p>

<h4>Tri par puissances décroissantes</h4>
<p>&gt; <span style="color:red">sort(1/(x+x^2+1))</span>;</p>
<p class="centre no_lettrine">\(\frac{1}{x^2+x+1}\)</p>

<h3>Dérivation, primitives et intégration :</h3>

<p>&gt; <span style="color:red">f:=x->sqrt(x)+cos(x)</span>;</p>
<p class="centre no_lettrine">\(f:=x\rightarrow \sqrt{x}+\cos(x)\)</p>

<h4>Dérivation :</h4>
<p>&gt; <span style="color:red">Diff(f(x),x)=diff(f(x),x)</span>;</p>
<p class="centre no_lettrine">\(\frac{d}{dx}\left(\sqrt{x}+\cos(x)\right) = \frac{1}{2\sqrt{x}}-\sin(x)\)</p>

<h4>Primitives :</h4>
<p>&gt; <span style="color:red">Int(f(x),x)=int(f(x),x)</span>;</p>
<p class="centre no_lettrine">\(\int \,\sqrt{x}+\cos(x)dx = \frac23 x^{\frac32}+\sin(x)\)</p>

<h4>Intégration</h4>
<p>&gt; <span style="color:red">Int(x^9,x=0..1)=int(x^9,x=0..1)</span>;</p>
<p class="centre no_lettrine">\(\int_0^1\,x^9dx = \frac{1}{10}\)</p>

<h3>Somme :</h3>
<p>&gt; <span style="color:red;">u:=n->sum(f(k),k=1..n-1)</span>;</p>
<p class="centre no_lettrine">\(u:=n \rightarrow \sum_{k=1}^{n-1}f(k)\)</p>

<h3>Limites :</h3>
<p>&gt; <span style="color:red;">Limit(u(x),x=+infinity) = limit(u(x),x=+infinity)</span>;</p>
<p class="centre no_lettrine">\(\lim_{x \rightarrow \infty} \left(\frac{1}{3x(x+1)(x+2)}+\frac{1}{18} \right) =  \frac{1}{18}\)</p>

<h3>Linéarisation</h3>
<p>&gt; <span style="color:red">sin(x)^5 = combine(sin(x)^5)</span>;</p>
<p class="centre no_lettrine">\(\sin(x)^5=\frac{1}{16}\sin(5x)-\frac{5}{16}\sin(3x)+\frac58 sin(x)\)</p>

<h3>Développement</h3>
<p>&gt; <span style="color:red">expand((x+1)^5*(x-1)^2)</span>;</p>
<p class="centre no_lettrine">\(x^7 + 3x^6 + x^5 - 5x^4 - 5x^3 + x^2 + 3x + 1\)</p>

<h3>Factorisation</h3>
<p>&gt; <span style="color:red">factor(x^7 + 3*x^6 + x^5 - 5*x^4 - 5*x^3 + x^2 + 3*x + 1)</span>;</p>
<p class="centre no_lettrine">\((x+1)^5(x-1)^2\)</p>
<p>On peut aussi indiquer par quel nombre on souhaite factoriser en deuxième argument.</p>

<h3>Développements limités</h3>
<p>&gt; <span style="color:red">taylor(sin(x),x=0,7)</span>;</p>
<p class="centre no_lettrine">\(x-\frac16x^3+\frac{1}{120}x^5+o(x^7)\)</p>

<h3>Fonctions polynomiales</h3>
<h4>Degré d'un polynome</h4>
<p>&gt; <span style="color:red">degree(x^2+9)</span>;</p>
<p class="centre no_lettrine">\(2\)</p>

<h4>Valuation d'un polynome</h4>
<p>&gt; <span style="color:red">degree(x^2+9,lcoeff)</span>;</p>
<p class="centre no_lettrine">\(0\)</p>

<h4>Quotient et reste</h4>
<h5>Quotient</h5>
<p>&gt; <span style="color:red">quo(x^2+x,x-1,x)</span>;</p>
<p class="centre no_lettrine">\(x+2\)</p>

<h5>Reste</h5>
<p>&gt; <span style="color:red">rem(x^2+x,x-1,x)</span>;</p>
<p class="centre no_lettrine">\(2\)</p>

<h2>Algèbre linéaire</h2>
<h3>Chargement du package :</h3>
<p>&gt; <span style="color:red">restart:with(linalg)</span>:</p>
<p class="centre no_lettrine">\(Warning,\,the\, protected\, names\, norm\, and\, trace\, have\, been\, redefined\, and\, unprotected\)</p>

<p>Maple indique donc que certaines fonctions ont changées : il montre aussi toutes les nouvelles fonctions chargées.</p>

<h3>Définition de vecteurs :</h3>
<p>V:=vector(dimension,[..,..,...];</p>

<p>&gt; <span style="color:red">A:=vector(4,[3,2,3,4])</span>;</p>
<p class="centre no_lettrine">\(A:= \begin{bmatrix} 3 & 2 & 3 & 4 \end{bmatrix}\)</p>


<p>&gt; <span style="color:red">B:=vector(4,[1,1,0,0])</span>;</p>
<p class="centre no_lettrine">\(B:= \begin{bmatrix} 1 & 1 & 0 & 0 \end{bmatrix}\)</p>

<p>&gt; <span style="color:red">B2 :=scalarmul(B,2)</span>;</p>
<p class="centre no_lettrine">\(B2:= \begin{bmatrix} 2 & 2 & 0 & 0 \end{bmatrix}\)</p>

<p>&gt; <span style="color:red">C:=vector(4,[2,1,5,0])</span>;</p>
<p class="centre no_lettrine">\(C:= \begin{bmatrix} 2 & 1 & 5 & 0 \end{bmatrix}\)</p>

<h4>Produit scalaire:</h4>
<p>&gt; <span style="color:red">dotprod(A,C)</span>;</p>
<p class="centre no_lettrine">\(23\)</p>

<h4>Produit vectoriel</h4>
<p>&gt; <span style="color:red">crossprod(A,B)</span>;</p>
<p>Ne fonctionne pas avec les deux vecteurs utilisés, car ils doivent être de dimension 3.</p>

<h3>Bases, images, espaces vectoriels, matrices:</h3>
<h4>Création de matrice:</h4>
<h5>A partir de deux vecteurs :</h5>
<p>&gt; <span style="color:red">M:=concat(A,C)</span>;</p>
<p class="centre no_lettrine">\(M:= \begin{bmatrix} 3 & 2 \\ 2 & 1 \\ 3 & 5 \\ 4 & 0 \end{bmatrix}\)</p>

<h5>Directement avec des valeurs :</h5>
<p>&gt; <span style="color:red">L:=matrix(4,2,[3,2,2,1,3,5,4,0])</span>;</p>
<p class="centre no_lettrine">\(M:= \begin{bmatrix} 3 & 2 \\ 2 & 1 \\ 3 & 5 \\ 4 & 0 \end{bmatrix}\)</p>

<h5>Matrice Identité :</h5>
<p>Par défaut, Maple ne permet pas de créer une matrice identité...mais on peut ruser !</p>
<p>&gt; <span style="color:red">diag(seq(1,x=1..4))</span>;</p>
<p class="centre no_lettrine">\(M:= \begin{bmatrix} 1 & 0 & 0 & 0 \\ 0 & 1 & 0 & 0 \\ 0 & 0 & 1 & 0 \\ 0 & 0 & 0 & 1 \end{bmatrix}\)</p>
<p>Deuxième solution :</p>
<p>&gt; <span style="color:red">diag(1$4)</span>;</p>
<p class="centre no_lettrine">\(M:= \begin{bmatrix} 1 & 0 & 0 & 0 \\ 0 & 1 & 0 & 0 \\ 0 & 0 & 1 & 0 \\ 0 & 0 & 0 & 1 \end{bmatrix}\)</p>
<h4>Produit de matrices:</h4>
<p>&gt; <span style="color:red">N:=matrix(2,4,[2,0,1,0,4,5,9,0])</span>;</p>
<p class="centre no_lettrine">\(N:= \begin{bmatrix} 2 & 0 & 1 & 0 \\ 4 & 5 & 9 & 0 \end{bmatrix}\)</p>


<p>Attention ! Pour la multiplication de matrices, on utilise le symbole &amp;* et pas * !</p>
<p>&gt; <span style="color:red">LN:=evalm(L&amp;*N)</span>;</p>
<p class="centre no_lettrine">\(LN := \begin{bmatrix} 14 & 10 & 21 & 0 \\ 8 & 5 & 11 & 0 \\ 26 & 25 & 48 & 0 \\ 8 & 0 & 4 & 0 \end{bmatrix}\)</p>


<p>&gt; <span style="color:red">LN:=multiply(L,N)</span>;</p>
<p class="centre no_lettrine">\(LN := \begin{bmatrix} 14 & 10 & 21 & 0 \\ 8 & 5 & 11 & 0 \\ 26 & 25 & 48 & 0 \\ 8 & 0 & 4 & 0 \end{bmatrix}\)</p>

<h4>Multiplication matrice-scalaire:</h4>
<p>&gt; <span style="color:red">L3:=evalm(3*L)</span>;</p>
<p class="centre no_lettrine">\(L3:= \begin{bmatrix} 9 & 6 \\ 6 & 3 \\ 9 & 15 \\ 12 & 0 \end{bmatrix}\)</p>

<p>&gt; <span style="color:red">L3bis:=scalarmul(evalm(L),3)</span>;</p>
<p class="centre no_lettrine">\(L3bis:= \begin{bmatrix} 9 & 6 \\ 6 & 3 \\ 9 & 15 \\ 12 & 0 \end{bmatrix}\)</p>

<h4>Addition de 2 matrices:</h4>
<p>&gt; <span style="color:red">evalm(M+L3)</span>;</p>
<p class="centre no_lettrine">\(N:= \begin{bmatrix} 12 & 8 \\ 8 & 4 \\ 12 & 20 \\ 16 & 0 \end{bmatrix}\)</p>

<p>On utilise evalm pour forcer l'affichage de la matrice</p>

<h4>Noyau, image:</h4>
<h5>Noyau</h5>
<p>&gt; <span style="color:red">kernel(N)</span>;</p>
<p class="centre no_lettrine">\(\begin{Bmatrix} [1,\frac{14}{5},-2,0],[0,0,0,1] \end{Bmatrix}\)</p>

<h5>Base de l'image</h5>
<p>&gt; <span style="color:red">colspace(N)</span>;</p>
<p class="centre no_lettrine">\(\begin{Bmatrix} [1, 0], [0, 1] \end{Bmatrix}\)</p>

<h4>Calcul d'une base</h4>
<p>&gt; <span style="color:red">basis([A,B,C,B2])</span>;</p>
<p class="centre no_lettrine">\([A, B, C]\)</p>

<p>(on avait bien défini B2 linéairement dépendant de B : la base ne l'inclue donc pas)</p>

<h4>Déterminant :</h4>
<p>&gt; <span style="color:red">det(LN)</span>;</p>
<p class="centre no_lettrine">\(0\)</p>

<h4>Vecteurs et valeurs propres:</h4>
<p>On va redéfinir les matrices, pour simplifier les exemples :-) !</p>
<p>&gt; <span style="color:red">L:=matrix(2,2,[1,0,0,1])</span>;</p>
<p class="centre no_lettrine">\(L3:= \begin{bmatrix} 1 & 0 \\ 0 & 1 \end{bmatrix}\)</p>

<p>&gt; <span style="color:red">eigenvectors(L)</span>;</p>
<p class="centre no_lettrine">\([1, 2, \{[1, 0], [0, 1]\}]~\)</p>
<p>1=valeur propre, 2=sa multiplicité, 3=base du SEV propre associé.<br />
Eh oui, ce serait bien d'avoir droit à Maple en interro !</p>

<h4>Matrice transposée:</h4>
<p>&gt; <span style="color:red">transpose(N)</span>;</p>
<p class="centre no_lettrine">\(L3:= \begin{bmatrix} 2 & 4 \\ 0 & 5 \\ 1 & 9 \\ 0 & 0 \end{bmatrix}\)</p>

<h4>Pour résoudre une équation </h4>
<p>&gt; <span style="color:red">linsolve(LN,A)</span>;</p>
<p class="centre no_lettrine">\(\left[t_1,\frac{14}{5}t_1-\frac95,-2t_1+1,t_2\right]\)</p>

<h4>Intersection de bases</h4>
<p>&gt; <span style="color:red">AB:=basis([A,B])</span>;</p>
<p class="centre no_lettrine">\(AB := [A, B]\)</p>

<p>&gt; <span style="color:red">B2C:=basis([B2,C])</span>;</p>
<p class="centre no_lettrine">\(B2C := [B2, C]\)</p>

<p>&gt; <span style="color:red">intbasis(AB,B2C)</span>;</p>
<p class="centre no_lettrine">\(\{[2, 2, 0, 0]\}~\)</p>


<?php
include("../footer.php");
?>
