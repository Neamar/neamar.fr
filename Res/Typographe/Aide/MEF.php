<?php
$Titre="Balises de mise en forme";
$Description="Ces balises permettent de rejouter de la mise en forme à votre texte.";

/*
array(
NOM,
KeyWord,
PROTOTYPE,
Variables
Utilisation
Exemple
)
*/

$Lines=array(
	array
	(
		'Gras',
		'gras,bold,b',

		"\b{@Texte}",
		"\item @Texte est le texte qui doit être mis en gras.",

		"La balise \b{b} permet de mettre en gras du texte. Vous pouvez utiliser l'alias \b{textbf} pour respecter une syntaxe plus LaTeX.",

		"\b{Ceci est un texte en gras}, ceci ne l'est pas."
	),
	array
	(
	'Italique',
	'italique,emphase,i',

	"\i{@Texte}",
	"\item @Texte est le texte qui doit être mis en italique.",

	"La balise \b{i} (alias de \b{emph}) permet de mettre en emphase du texte. Vous pouvez utiliser \b{textit} pour mettre votre texte en italique.
	Attention à ne pas confondre italique et emphase ! Un texte doublement mis en italique reste italique, un texte doublement mis en emphase revient sur une fonte normale.",

	"\i{Ceci est un texte \i{doublement} en emphase}."
	),
	array
	(
	'Exposant',
	'exposant,super,up',

	"\up{@Texte}",
	"\item @Texte est le texte qui doit être mis en exposant.",

	"La balise \b{up} met le texte en exposant. Si vous souhaitez écrire des équations mathématiques, up n'est pas la bonne solution : tournez vous plutôt vers les \lien[/Res/Typo/Aide/?b=math]{\\$}. Pour les notes de bas de page, utilisez \lien[/Res/Typo/Aide/?b=footnote]{footnote}.",

	"Adam est le 1\up{er} homme."
	),
	array
	(
	'Indice',
	'indice, lower, subscript',

	"\down{@Texte}",
	"\item @Texte est le texte qui doit être mis en indice.",

	"La balise \b{down} met le texte en indice. Si vous souhaitez écrire des équations mathématiques, down n'est pas la bonne solution : tournez vous plutôt vers les \lien[/Res/Typo/Aide/?b=math]{\\$}. Cette balise ne devrait normalement pas être utilisée, puisque seules les mathématiques et la physique nécessitent l'utilisation d'un indice.",

	"U\down{n}=4 est incorrect et devrait être remplacé par \$U_n=4$"
	),
	array
	(
	'Petit',
	'petit,small',

	"\small{@Texte}",
	"\item @Texte est le texte qui doit être écrit en petits caractères.",

	"La balise \b{small} écrit le texte en caractères de taille inférieure à la taille standard.",

	"Bla \small{bla} bla..."
	),
	array
	(
	'Grand',
	'grand,gros,small',

	"\small{@Texte}",
	"\item @Texte est le texte qui doit être écrit en gros caractères.",

	"La balise \b{big} écrit le texte en caractères de taille supérieure à la taille standard.",

	"Bla \big{bla} bla..."
	),
	array
	(
	'Sans Serif',
	'sans serif,ss,textss,sans-serif',

	"\\textss{@Texte}",
	"\item @Texte est le texte qui doit être sans empattements.",

	"La balise \b{textss} écrit le texte avec une police sans empattements (les petites extensions qui forment la terminaison des caractères sur les polices standards). Cette balise est idéale pour écrire un code informatique de moins d'une ligne. Pour les textes plus long, préférez l'environnement \lien[?b=verbatim]{verbatim}.",

	"Le code PHP sera alors \\textss{if(\$a=2) echo 'Réussi !';}."
	),
	array
	(
	'Monospace',
	'monospace,ms,textms',

	"\\textms{@Texte}",
	"\item @Texte est le texte qui doit être en monospace.",

	"La balise \b{textms} écrit le texte avec une police à chasse fixe : l'écart entre deux lettres est alors constant.",

	"Le code PHP sera alors \\textms{if(\$a=2) echo 'Réussi !';}."
	),
	array
	(
	'Citation "en ligne"',
	'quote,citation',

	"\\quote{@Texte}",
	"\item @Texte est la citation.",

	"La balise \b{quote} permet de citer un auteur. Les guillemets sont automatiquement ajoutés. Attention à ne pas confondre cette balise avec les guillemets \lien[?b=«]{« » et \"' '\"}.",

	"Comme le disait V, \quote{People should not be afraid of their governments. Governments should be afraid of their people.}"
	),
	array
	(
	'Siècle',
	'siècle,century',

	"\\century{@Siecle}",
	"\item @Siecle est un siecle au format latin.",

	"La balise \b{century} met en forme un numéro de siècle : ajout automatique d'un \"e\" en exposant, utilisation de petites majuscules. Ceci rend bien mieux qu'une tentative manuelle, cf. l'exemple.

	De plus, cela ajoute du sens à vos textes et permet au webmaster d'établir des \"lignes de temps\", par exemple pour savoir quelle époque est la plus citée.",

	"Bien : La brosse à dents apparaît au \century{XIX}.
Pas bien : La brosse à dents apparaît au XIX\up{e}."
	),
	array
	(
	'Verbatim "en ligne"',
	'verbatim',

	"\\verbatim{@NoTypo}",
	"\item @NoTypo est le texte qui ne doit pas être modifié.",

	"La balise \b{verbatim} empêche la mise en forme automatique du texte en paramètre. Peut être utile pour écrire un nom de balise, par exemple.",

	"\\verbatim{Ce texte devrait être en \color[red]{rouge}}. Ce texte \color[red]{l'est}."
	),
	array
	(
	'Titres et sous titres',
	'titre, section, sous titre, subsection, sous sous titre, subsubsection',

	"\\section{@Titre}
\\subsection{@SousTitre}
\\subsubsection{@SousSousTitre}",
	"\item @Titre est un titre de premier niveau ;
	\item @SousTitre est un titre de second niveau ;
	\item @SousSousTitre est un titre de troisième niveau",

	"Les balises \b{section}, \b{subsection} et \b{subsubsection} permettent de structurer un texte complexe en ajoutant des titres et des sous titres.
Vous ne pouvez pas utiliser de balises pour obtenir un titre HTML \\textss{h1}, ce titre étant reservé pour le titre global des pages web.
Selon les sites Web qui utilisent le Typographe, ces fonctionalités peuvent être désactivées, e.g.  si le webmaster ne souhaite pas que les auteurs puissent écrire de textes trop longs.
De même, une numérotation peut être apposée automatiquement devant les titres.",

	"\\section{Jeunesse}
\\section{Roi de France}
\\subsection{Une administration nouvelle}
\\subsection{Les relations étrangères}
\\subsubsection{L'Angleterre}
\\subsubsection{Les Habsbourg}
\\subsubsection{La fin des guerres d'Italie}
\\subsubsection{Derniers affrontements entre Philippe II et Henri II}
\\subsection{Le protestantisme}
\\subsection{ Les arts}
\\subsection{Le Nouveau Monde}
\\subsection{Fiefs réunis à la Couronne}
\\section{Descendance}
\\section{Mort et postérité}"
	),
);
?>