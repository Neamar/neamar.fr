<?php
$Titre='Aper�u et documentation rapide pour le Typographe';
$Box = array("Auteur" => "Neamar","Date" => "2009");

$AddLine='<link rel="stylesheet" type="text/css" href="https://neamar.fr/lib/Typo/Typo.css" />';
$UseMath=true;
include('../header.php');
include('../Typo/Typo.php');
?>
<h1><?php echo $Titre; ?></h1>
<p class="auteur">Neamar</p>
<p class="erreur">Attention, cette page recense rapidement les diff�rentes fonctionalit�s offertes par le Typographe. Pour plus d'informations, consultez <a href="/Res/Typo/Aide/">l'aide d�taill�e</a>. Vous pouvez aussi consulter <a href=".">l'accueil du typographe.</a>.</p>

<p>La colonne de gauche repr�sente le texte brut, tel que vous le marqueriez dans votre interface d'�dition. Chaque balise de cette colonne est un lien qui vous am�nera vers une aide d�taill�e.<br />
La colonne de droite repr�sente le texte en sortie du Typographe</p>
<?php
$texte=array(
'\section{Introduction}

Le Typographe est un script PHP qui se charge de mettre automatiquement en forme un texte quelconque selon les r�gles courantes de l\'�dition, tout en restant valide xHTML Strict.',

'\section{Mode �dition}
\subsection{Ponctuation}

Le script modifie les espaces autour des ponctuations (en g�rant les espaces fines, fortes et ins�cable), permettant une lecture plus fluide.
Les espaces fortes et fines sont automatiquement plac�es autour des signes de ponctuation;ainsi,ici,point de probl�mes.M�me apr�s le point ?! (remarquez le point exclarrogatif).',

'\subsection{Caract�res typographiques}
Le symbole "--" devient un tiret demi cadratin, le "---" un tiret cadratin.
Le programme d�tecte automatiquement incises et entames, si celles-ci sont plac�es de fa�on coh�rente - comme ceci, par exemple - avec le reste du paragraphe.
Cela permet -- par exemple -- de faire des incises, ou des dialogues :
---"Bonjour" (remarquez qu\'ici, le triple tiret est inutile : le programme aurait devin� tout seul qu\'il s\'agissait d\'une entame).
Les guillemets typographiques sont remplac�s par des guillemets � la fran�aise entour�s de la ponctuation n�cessaire : regardez le r�sultat pour "ce texte".
Les guillemets imbriqu�s sont automatiquement remplac�s par des guillemets � l\'anglaise :
- "Il me dit alors "Imbrication de guillemets". Je ne sus que r�pondre !"

N\'oubliez pas que la convention recommande d\'accentuer les majuscules\footnote{Cf. \lien[http://www.synec-doc.be/doc/accents2.htm]{cette page}.} : �, �, �...
Les ligatures sont automatiquement ajout�es, pas la peine de les taper manuellement : \emph{et caetera}, \emph{Oedipe}. Pour bloquer le remplacement, pr�c�dez les deux lettres d\'un anti slash : \emph{m\oelleux}.',/*SECTION */





'\section{Les balises}
Vous pouvez utiliser quelques balises, inspir�s du langage de mise en forme TeX. Les balises peuvent �tres modif�es et \l[http://neamar.fr/Res/Typographe/MiseEnPlace.php#Ajout_de_balises]{ajout�es en temps r�el par le programmeur} selon les besoins.',/*SECTION */

'\subsection{Commandes simples}',/*SECTION */
'\subsubsection{Un seul param�tre}
\item Vous pouvez utiliser les balises de mise en forme standard : \textbf{gras (Bold Face)}, \textit{italique} et en \emph{emphase};
\item La diff�rence entre l\'emphase et l\'italique ? \emph{Un texte \emph{doublement} mis en emphase revient en fonte normale} ;
\item Le \textss{texte sans serif} (� ne pas confondre avec le \textms{texte monospace}) s\'obtient ainsi, tandis que la \quote{citation} est obtenue avec la balise quote ;
\item Envie de divaguer ? �crivez en \up{haut}, ou en \down{bas} ;
\item Pour indiquer un si�cle, utilisez \century{XXI} qui ajoute automatiquement le e en exposant et affiche de fa�on coh�rente les chiffres romains : comparez avec XXI\up{e}.',/*SECTION */

'\subsubsection{Deux param�tres}
Les commandes � deux param�tres s\'utilisent de la m�me fa�on que celles � un param�tre.
Les arguments entre crochets [ ] ne sont pas affich�s "directement", tandis qu\'\textit{� contrario}, les commandes entour�es d\'accolades { } se voient � l\'�cran.

\item Vous pouvez ainsi d�finir un acronyme : \acronym[Le seigneur des anneaux]{LSDA} ou une abr�viation.(\abrev[Ma�tre]{M\up{e}}) ;
\item Faites un lien vers \lien[http://google.fr]{un site ext�rieur} (par d�faut, les liens sont en dofollow. Les webmasteurs aigris et �gocentriques peuvent forcer l\'ajout d\'un nofollow);
\item �gayez vos textes avec un peu de \color[red]{couleur} ! (l\'abus de couleurs est dangereux pour la sant� -- � consommer avec mod�ration);
\item Ajoutez des images : \image[L\'icone de Neamar]{http://neamar.fr/favicon.ico}.',/*SECTION */

'\subsubsection{Imbrication de balises}
Toutes les balises peuvent �tre imbriqu�es avec les m�mes limitations que les environnements dans la majorit� des cas : autrement dit \i{Italique et \b{gras italique et \textss{gras italique sans serif}} et retour � italique} ne pose pas de probl�mes, mais les doubles imbrications d\'une m�me balise ne sont pas forc�ment accept�es (deux italiques reviennent � la mise en forme standard, tandis que deux gras ne correspondent � rien : seule la premi�re balise est remplac�e).

',/*SECTION*/
'\section{Commandes avanc�es}

\item Vous aurez compris que le mot item indique une liste � puce...
\item   ...mais saviez-vous que vous pouviez faire des r�f�rences\footnote{Promis, c\'est possible.} ? Pratique\footnote{N\'est-ce pas ?} ! Le num�ro est incr�ment� tout au long de la page Web, m�me sur plusieurs environnements diff�rents.
\item Vous pouvez utiliser des math�matiques dans votre texte si le webmaster a activ� l\'option PARSE_MATH : $\sum_0^{\infty}\frac{\pi}{\frac{2}{3}+\sqrt{2+5^x}} \times y_n$ (le double dollar est aussi disponible pour les maths en mode block.). Attention, l\'option PARSE_MATH ne fait qu\'entourer votre texte de balise math, vous aurez � g�rer vous m�me l\'utilisation d\'un moteur TeX.',/*SECTION */

'\subsection{Alias}

Des alias plus courts sont disponibles pour les balises les plus courantes : \b{bold}, \i{italique}, \l[http://neamar.fr]{liens}, \c{IV}',/*SECTION */

'\section{Les environnements}
Les environnements sont un cran au dessus des balises. Les balises agissent de fa�on lin�aire, les environnement forment des blocs. Ils permettent entre autre d\'avoir des listes compl�tes (ce qui n\'est pas possible avec la seule combinaison \item), des affichages AS-IS, des tableaux, et m�me des quizz !

Pour ouvrir un environnement, utilisez \verbatim{\begin{nom-environnement}}, fermez-le avec \verbatim{\end{nom-environnement}}. Les environnements peuvent s\'emboiter s\'ils sont diff�rents, \i{i.e.} vous pouvez mettre un tableau dans un liste ou vice versa, mais pas un tableau dans un tableau.',

'\subsection{Listes}
Deux environnements pour les listes :',

'\subsubsection{Liste � puce}
\begin{itemize}
\li Itemize permet d\'avoir des listes qui s\'�talent...

Sur plusieurs paragraphes.
\li Ce qu\'item ne permet pas, puisque un saut de ligne sans \item � la suite termine la liste.
\end{itemize}',

'\subsubsection{Liste num�rot�e}
\begin{enumerate}
\li Comportement similaire � \i{itemize}, mais les puces sont num�rot�es ;
\li Puce n� 2 (notez le remplacement de n� par un o en exposant);
\li ...
\end{enumerate}',

'\subsection{Abstract}
\begin{abstract}
Utilisez abstract pour le r�sum� d\'un article, il met automatiquement le texte en forme et ajoute un "R�sum�" au dessus, texte sans valeur s�mantique dans le code.
\end{abstract}',

'\subsection{Verbatim}
Pour l\'environnement verbatim, consultez la section "�chappement".',

'\subsection{Tableaux}
\begin[petitTexte|ss]{tabular}
Tabular est l\'environnement le plus puissant. & Il permet de cr�er facilement des tableaux \\\\
Pour s�parer deux cellules
sur la m�me ligne, utilisez l\'esperluette (\&) & Pour terminer une ligne, utilisez un double antislash. \\\\
Vous pouvez mettres \i{des balises dans vos textes}, et vous n\'�tes pas forc�s d\'avoir le m�me nombre de colonnes pour chaque ligne. \\\\
Enfin, vous remarquerez que vous pouvez passer des options au tableau : il s\'agit de classes CSS, elles d�pendent du site sur lequel est utilis� le typographe. Par d�faut, Le Typographe ne propose que "ss" pour sans-serif, et "ms" pour monospace. Renseignez-vous aupr�s du site pour plus d\'informations.
\end{tabular}
\\quickref{ATTENTION, les utilisateurs du Typographe ont alors acc�s � toutes les classes CSS. Les administrateurs souhaiteront peut �tre d�sactiver cette fonction.}',

'\subsection{Quizz}
Quizz est un environnement ludique sans grande pr�tention, qui permet de poser des questions aux internautes\footnote{Quizz extrait de l\'article \link[http://omnilogie.fr/O/On_perd_des_os_en_grandissant]{on perd des os en grandissant}.}.
\begin{quizz}
\question Quel est l\'os le plus long du corps humain ?
\answer Le f�mur

\question O� se trouve l\'hum�rus ?
\answer Dans le bras

\question Quel est l\'autre nom de la fibula ?
\answer Le p�ron�

\question O� se trouve le carpe ?
\answer Dans le poignet

\question Combien avons-nous de paires de cotes flottantes ?
\answer 2

\question O� se situe la rotule ?
\answer Dans le genou

\question Comment se nomment les os du pied ?
\answer Tarse, m�tatarse, phalange
\end{quizz}

Pour aller plus loin, vous pourrez consulter l\'environnement \l[Aide/?b=qcm]{QCM} qui r�alise un v�ritable d�compte des notes.
',


'\section{�chappement}

Imaginez que vous souhaitiez mettre en gras une balise fermante (\}): le programme serait alors incapable de d�terminer sur quelle accolade s\'appuyer. Vous pouvez donc �chapper les �l�ments n�cessaires : \textbf{\}} en les pr�c�dant d\'un \"anti slash\". Vous pouvez �chapper les accolades, les crochets, les guillemets, les ligatures, le tilde (qui, pour rappel, d�note une barre horizontale), et le dollar (pour les math�matiques).

Si vous devez �chapper des passages complets, vous pouvez utiliser la balise verbatim : \verbatim{\textbf{Ce texte devrait �tre en gras}}. Pour �chapper un pragraphe complet et l\'afficher comme dans votre texte original, vous pouvez utiliser l\'environnement verbatim :

\begin{verbatim}
Le contenu de verbatim est rendu "tel quel" :
la ponctuation n\'est pas corrig�e,
les guillemets ne sont pas modif�s,
les \b{balises} ne sont pas pars�es.
\end{verbatim}' ,/*SECTION */

'\section{Bonus}
Certaines fonctions sont pr�sentes en bonus : ainsi, on notera la barre horizontale :
~~~
Ou encore \quickref{Une r�f�rence rapide} ainsi que quelques autres qui restent non-document�es pour le plaisir de la d�couverte (essayez verse) !',/*SECTION */
);
?>

<table class="noborder">
<thead>
<tr>
	<th style="width:45%; border-right:1px dashed gray;">Texte brut</th>
	<th style="width:55%">R�sultat automatique</th>
</tr>
</thead>
<tbody>
<?php
foreach($texte as $Part)
{
	Typo::setTexte($Part);
	echo '<tr><td style="border-right:1px dashed gray;">' . preg_replace('#\\\\([a-z]+)({|\[| |\))#iU','<a href="Aide/?b=$1" class="ss" style="color:gray; text-decoration:underline;">\\\\$1</a>$2',nl2br(htmlentities($Part))) . '</td><td>' .  Typo::Parse() . '</td></tr>';
}
?>
</tbody>
</table>

<?php
include('../footer.php');
?>
