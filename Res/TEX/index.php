<?php

include('Codes/TEX_Ressource.php');
include('Codes/TEX_Translater.php');

$Titre='Convertisseur LaTeX => HTML';
$AddLine='<link rel="stylesheet" type="text/css" href="http://neamar.fr/Res/TEX/TEX.css" />';


$Box = array("Auteur" => "Neamar","Date" => "Nov. 2008", "But" =>"Conversion");
$UseMath=true;
include('../header.php');
?>
<h1>TEX2HTML</h1>

<?php
if(isset($_POST['Input']))
{
	$Doc=new TEX_Ressource(stripslashes($_POST['Input']));
	echo $Doc->Output();
}
?>
<form method="post" action="">
<textarea name="Input" id="Input" cols="120" rows="40">
\documentclass[a4paper,10pt]{article}
\usepackage[french]{babel}

%opening
\title{Exercice 1.2.3 : &quot;Geometrique&quot; et restes}
\author{BACCONNIER || BONNET}

\begin{document}

\maketitle

\tableofcontents

\begin{abstract}Bonjour, ou bonsoir à tous...



 J'avais \textit{dans ma jeunesse} cree un site avec plus de deux cent enigmes mathematiques...plusieurs annees se sont ecoulees depuis, et je me suis aperçu que certaines m'avaient vraiment marquees, que ce soit par leur mode de raisonnement ou par les concepts qu'elles exploitaient...

Je me suis donc attele à la tache de compiler cette fine fleur, pour finalement n'en obtenir plus que 10 : les 10 plus belles enigmes de logique...\textbf{à mon humble gout} ! (aucune de ces enigmes ne requiere de \underline{connaissances mathematiques poussees} : au maximum, ce sera de la manipulation de fractions...la seule chose importante est votre esprit logique.)

\end{abstract}

\begin{verse}
On definit $u_n=\frac{1}{2^n}$ et $S_n=\displaystyle \sum_{k=0}^n (\frac{1}{2})^k$
\end{verse}
\section{Partie 1}
$$S_n = \sum_{i=0}^n \frac{1}{2^i} = \sum_{i=0}^n (\frac{1}{2})^i = \frac{1-\frac{1}{2^{n+1}}}{1-\frac{1}{2}} = 2(1-\frac{1}{2^{n+1}})$$
De plus,
$$R_n = S - S_n = \lim_{i \to +\infty} \sum_{k=0}^i u_k - S_n = \lim_{i \to +\infty} S_i - S_n = 2 - S_n = 2*\frac{1}{2^{n+1}} = \frac{1}{2^n}$$

Montrons que $| R_n | \leq 10^{-3}$ a partir d'un certain rang.
$$n&gt;10$$
$$2^n&gt;2^{10}$$
$$\frac{1}{2^n}&lt;\frac{1}{2^{10}}&lt;10^{-3}$$

On peut donc en deduire que pour tout $ n \geq 10$, $R_n \leq 10^{-3}$

\section{Partie 2}
On a $2^k \leq 1+ 2^k$ et ce $\forall k \in N$
$$ \frac{1}{2^k} \geq \frac{1}{1+2^k} \geq 0$$
Par sommation d'egalites, on a donc :
$$0 \leq \sum_{k=0}^n \frac{1}{1+2^k} \leq \sum_{k=0}^n \frac{1}{2^k}$$
(car la somme est finie)

On en deduit $U_k \geq V_k \geq0$, et d'apres le theoreme de comparaison en terme d'ordre, $\sum V_k$ converge car $\sum U_k$ converge.
On note : $$V = \lim_{n \to +\infty} V_n$$.

\section{Partie 3}
Posons $T_n = V - V_n$.

Alors $V_n \leq U_n$ et de plus, $V&lt;U$

Donc $V- V_n \leq U - U_n$ (car $\sum V_k$ et $\sum U_k$ convergent).

D'ou l'inegalite $T_n \leq R_n$.

On a donc : $$\sum_{k=0}^{10} v_n +T_{10} = V \Leftrightarrow \sum_{k=0}^{10} v_n + R_{10} \geq V \Leftrightarrow \sum_{k=0}^{10} v_n \geq V - 10^{-3} \Leftrightarrow \overline{V} \simeq 1,263$$

\end{document}
</textarea>
<br />
<input type="submit" value="Convertir !" />
</form>

<?php

include("../footer.php");
?>
