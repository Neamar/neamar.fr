<?php
$Titre='Aperçu et documentation rapide pour le Typographe';
$Box = array("Auteur" => "Neamar","Date" => "2009");

$AddLine='<link rel="stylesheet" type="text/css" href="https://neamar.fr/lib/Typo/Typo.css" />';
$UseMath=true;
include('../header.php');
include('../Typo/Typo.php');
?>
<h1><?php echo $Titre; ?></h1>
<p class="auteur">Neamar</p>
<p class="erreur">Attention, cette page recense rapidement les différentes fonctionalités offertes par le Typographe. Pour plus d'informations, consultez <a href="/Res/Typo/Aide/">l'aide détaillée</a>. Vous pouvez aussi consulter <a href=".">l'accueil du typographe.</a>.</p>

<p>La colonne de gauche représente le texte brut, tel que vous le marqueriez dans votre interface d'édition. Chaque balise de cette colonne est un lien qui vous amènera vers une aide détaillée.<br />
La colonne de droite représente le texte en sortie du Typographe</p>
<?php
$texte=array(
'\section{Introduction}

Le Typographe est un script PHP qui se charge de mettre automatiquement en forme un texte quelconque selon les règles courantes de l\'édition, tout en restant valide xHTML Strict.',

'\section{Mode édition}
\subsection{Ponctuation}

Le script modifie les espaces autour des ponctuations (en gérant les espaces fines, fortes et insécable), permettant une lecture plus fluide.
Les espaces fortes et fines sont automatiquement placées autour des signes de ponctuation;ainsi,ici,point de problèmes.Même après le point ?! (remarquez le point exclarrogatif).',

'\subsection{Caractères typographiques}
Le symbole "--" devient un tiret demi cadratin, le "---" un tiret cadratin.
Le programme détecte automatiquement incises et entames, si celles-ci sont placées de façon cohérente - comme ceci, par exemple - avec le reste du paragraphe.
Cela permet -- par exemple -- de faire des incises, ou des dialogues :
---"Bonjour" (remarquez qu\'ici, le triple tiret est inutile : le programme aurait deviné tout seul qu\'il s\'agissait d\'une entame).
Les guillemets typographiques sont remplacés par des guillemets à la française entourés de la ponctuation nécessaire : regardez le résultat pour "ce texte".
Les guillemets imbriqués sont automatiquement remplacés par des guillemets à l\'anglaise :
- "Il me dit alors "Imbrication de guillemets". Je ne sus que répondre !"

N\'oubliez pas que la convention recommande d\'accentuer les majuscules\footnote{Cf. \lien[http://www.synec-doc.be/doc/accents2.htm]{cette page}.} : À, É, È...
Les ligatures sont automatiquement ajoutées, pas la peine de les taper manuellement : \emph{et caetera}, \emph{Oedipe}. Pour bloquer le remplacement, précédez les deux lettres d\'un anti slash : \emph{m\oelleux}.',/*SECTION */





'\section{Les balises}
Vous pouvez utiliser quelques balises, inspirés du langage de mise en forme TeX. Les balises peuvent êtres modifées et \l[http://neamar.fr/Res/Typographe/MiseEnPlace.php#Ajout_de_balises]{ajoutées en temps réel par le programmeur} selon les besoins.',/*SECTION */

'\subsection{Commandes simples}',/*SECTION */
'\subsubsection{Un seul paramètre}
\item Vous pouvez utiliser les balises de mise en forme standard : \textbf{gras (Bold Face)}, \textit{italique} et en \emph{emphase};
\item La différence entre l\'emphase et l\'italique ? \emph{Un texte \emph{doublement} mis en emphase revient en fonte normale} ;
\item Le \textss{texte sans serif} (à ne pas confondre avec le \textms{texte monospace}) s\'obtient ainsi, tandis que la \quote{citation} est obtenue avec la balise quote ;
\item Envie de divaguer ? Écrivez en \up{haut}, ou en \down{bas} ;
\item Pour indiquer un siècle, utilisez \century{XXI} qui ajoute automatiquement le e en exposant et affiche de façon cohérente les chiffres romains : comparez avec XXI\up{e}.',/*SECTION */

'\subsubsection{Deux paramètres}
Les commandes à deux paramètres s\'utilisent de la même façon que celles à un paramètre.
Les arguments entre crochets [ ] ne sont pas affichés "directement", tandis qu\'\textit{à contrario}, les commandes entourées d\'accolades { } se voient à l\'écran.

\item Vous pouvez ainsi définir un acronyme : \acronym[Le seigneur des anneaux]{LSDA} ou une abréviation.(\abrev[Maître]{M\up{e}}) ;
\item Faites un lien vers \lien[http://google.fr]{un site extérieur} (par défaut, les liens sont en dofollow. Les webmasteurs aigris et égocentriques peuvent forcer l\'ajout d\'un nofollow);
\item Égayez vos textes avec un peu de \color[red]{couleur} ! (l\'abus de couleurs est dangereux pour la santé -- à consommer avec modération);
\item Ajoutez des images : \image[L\'icone de Neamar]{http://neamar.fr/favicon.ico}.',/*SECTION */

'\subsubsection{Imbrication de balises}
Toutes les balises peuvent être imbriquées avec les mêmes limitations que les environnements dans la majorité des cas : autrement dit \i{Italique et \b{gras italique et \textss{gras italique sans serif}} et retour à italique} ne pose pas de problèmes, mais les doubles imbrications d\'une même balise ne sont pas forcément acceptées (deux italiques reviennent à la mise en forme standard, tandis que deux gras ne correspondent à rien : seule la première balise est remplacée).

',/*SECTION*/
'\section{Commandes avancées}

\item Vous aurez compris que le mot item indique une liste à puce...
\item   ...mais saviez-vous que vous pouviez faire des références\footnote{Promis, c\'est possible.} ? Pratique\footnote{N\'est-ce pas ?} ! Le numéro est incrémenté tout au long de la page Web, même sur plusieurs environnements différents.
\item Vous pouvez utiliser des mathématiques dans votre texte si le webmaster a activé l\'option PARSE_MATH : $\sum_0^{\infty}\frac{\pi}{\frac{2}{3}+\sqrt{2+5^x}} \times y_n$ (le double dollar est aussi disponible pour les maths en mode block.). Attention, l\'option PARSE_MATH ne fait qu\'entourer votre texte de balise math, vous aurez à gérer vous même l\'utilisation d\'un moteur TeX.',/*SECTION */

'\subsection{Alias}

Des alias plus courts sont disponibles pour les balises les plus courantes : \b{bold}, \i{italique}, \l[http://neamar.fr]{liens}, \c{IV}',/*SECTION */

'\section{Les environnements}
Les environnements sont un cran au dessus des balises. Les balises agissent de façon linéaire, les environnement forment des blocs. Ils permettent entre autre d\'avoir des listes complètes (ce qui n\'est pas possible avec la seule combinaison \item), des affichages AS-IS, des tableaux, et même des quizz !

Pour ouvrir un environnement, utilisez \verbatim{\begin{nom-environnement}}, fermez-le avec \verbatim{\end{nom-environnement}}. Les environnements peuvent s\'emboiter s\'ils sont différents, \i{i.e.} vous pouvez mettre un tableau dans un liste ou vice versa, mais pas un tableau dans un tableau.',

'\subsection{Listes}
Deux environnements pour les listes :',

'\subsubsection{Liste à puce}
\begin{itemize}
\li Itemize permet d\'avoir des listes qui s\'étalent...

Sur plusieurs paragraphes.
\li Ce qu\'item ne permet pas, puisque un saut de ligne sans \item à la suite termine la liste.
\end{itemize}',

'\subsubsection{Liste numérotée}
\begin{enumerate}
\li Comportement similaire à \i{itemize}, mais les puces sont numérotées ;
\li Puce n° 2 (notez le remplacement de n° par un o en exposant);
\li ...
\end{enumerate}',

'\subsection{Abstract}
\begin{abstract}
Utilisez abstract pour le résumé d\'un article, il met automatiquement le texte en forme et ajoute un "Résumé" au dessus, texte sans valeur sémantique dans le code.
\end{abstract}',

'\subsection{Verbatim}
Pour l\'environnement verbatim, consultez la section "Échappement".',

'\subsection{Tableaux}
\begin[petitTexte|ss]{tabular}
Tabular est l\'environnement le plus puissant. & Il permet de créer facilement des tableaux \\\\
Pour séparer deux cellules
sur la même ligne, utilisez l\'esperluette (\&) & Pour terminer une ligne, utilisez un double antislash. \\\\
Vous pouvez mettres \i{des balises dans vos textes}, et vous n\'êtes pas forcés d\'avoir le même nombre de colonnes pour chaque ligne. \\\\
Enfin, vous remarquerez que vous pouvez passer des options au tableau : il s\'agit de classes CSS, elles dépendent du site sur lequel est utilisé le typographe. Par défaut, Le Typographe ne propose que "ss" pour sans-serif, et "ms" pour monospace. Renseignez-vous auprès du site pour plus d\'informations.
\end{tabular}
\\quickref{ATTENTION, les utilisateurs du Typographe ont alors accès à toutes les classes CSS. Les administrateurs souhaiteront peut être désactiver cette fonction.}',

'\subsection{Quizz}
Quizz est un environnement ludique sans grande prétention, qui permet de poser des questions aux internautes\footnote{Quizz extrait de l\'article \link[http://omnilogie.fr/O/On_perd_des_os_en_grandissant]{on perd des os en grandissant}.}.
\begin{quizz}
\question Quel est l\'os le plus long du corps humain ?
\answer Le fémur

\question Où se trouve l\'humérus ?
\answer Dans le bras

\question Quel est l\'autre nom de la fibula ?
\answer Le péroné

\question Où se trouve le carpe ?
\answer Dans le poignet

\question Combien avons-nous de paires de cotes flottantes ?
\answer 2

\question Où se situe la rotule ?
\answer Dans le genou

\question Comment se nomment les os du pied ?
\answer Tarse, métatarse, phalange
\end{quizz}

Pour aller plus loin, vous pourrez consulter l\'environnement \l[Aide/?b=qcm]{QCM} qui réalise un véritable décompte des notes.
',


'\section{Échappement}

Imaginez que vous souhaitiez mettre en gras une balise fermante (\}): le programme serait alors incapable de déterminer sur quelle accolade s\'appuyer. Vous pouvez donc échapper les éléments nécessaires : \textbf{\}} en les précédant d\'un \"anti slash\". Vous pouvez échapper les accolades, les crochets, les guillemets, les ligatures, le tilde (qui, pour rappel, dénote une barre horizontale), et le dollar (pour les mathématiques).

Si vous devez échapper des passages complets, vous pouvez utiliser la balise verbatim : \verbatim{\textbf{Ce texte devrait être en gras}}. Pour échapper un pragraphe complet et l\'afficher comme dans votre texte original, vous pouvez utiliser l\'environnement verbatim :

\begin{verbatim}
Le contenu de verbatim est rendu "tel quel" :
la ponctuation n\'est pas corrigée,
les guillemets ne sont pas modifés,
les \b{balises} ne sont pas parsées.
\end{verbatim}' ,/*SECTION */

'\section{Bonus}
Certaines fonctions sont présentes en bonus : ainsi, on notera la barre horizontale :
~~~
Ou encore \quickref{Une référence rapide} ainsi que quelques autres qui restent non-documentées pour le plaisir de la découverte (essayez verse) !',/*SECTION */
);
?>

<table class="noborder">
<thead>
<tr>
	<th style="width:45%; border-right:1px dashed gray;">Texte brut</th>
	<th style="width:55%">Résultat automatique</th>
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
