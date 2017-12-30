<?php
$Titre="Balises de mise en forme";
$Description="Ces balises permettent de rejouter de la mise en forme � votre texte.";

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
		"\item @Texte est le texte qui doit �tre mis en gras.",

		"La balise \b{b} permet de mettre en gras du texte. Vous pouvez utiliser l'alias \b{textbf} pour respecter une syntaxe plus LaTeX.",

		"\b{Ceci est un texte en gras}, ceci ne l'est pas."
	),
	array
	(
	'Italique',
	'italique,emphase,i',

	"\i{@Texte}",
	"\item @Texte est le texte qui doit �tre mis en italique.",

	"La balise \b{i} (alias de \b{emph}) permet de mettre en emphase du texte. Vous pouvez utiliser \b{textit} pour mettre votre texte en italique.
	Attention � ne pas confondre italique et emphase ! Un texte doublement mis en italique reste italique, un texte doublement mis en emphase revient sur une fonte normale.",

	"\i{Ceci est un texte \i{doublement} en emphase}."
	),
	array
	(
	'Exposant',
	'exposant,super,up',

	"\up{@Texte}",
	"\item @Texte est le texte qui doit �tre mis en exposant.",

	"La balise \b{up} met le texte en exposant. Si vous souhaitez �crire des �quations math�matiques, up n'est pas la bonne solution : tournez vous plut�t vers les \lien[/Res/Typo/Aide/?b=math]{\\$}. Pour les notes de bas de page, utilisez \lien[/Res/Typo/Aide/?b=footnote]{footnote}.",

	"Adam est le 1\up{er} homme."
	),
	array
	(
	'Indice',
	'indice, lower, subscript',

	"\down{@Texte}",
	"\item @Texte est le texte qui doit �tre mis en indice.",

	"La balise \b{down} met le texte en indice. Si vous souhaitez �crire des �quations math�matiques, down n'est pas la bonne solution : tournez vous plut�t vers les \lien[/Res/Typo/Aide/?b=math]{\\$}. Cette balise ne devrait normalement pas �tre utilis�e, puisque seules les math�matiques et la physique n�cessitent l'utilisation d'un indice.",

	"U\down{n}=4 est incorrect et devrait �tre remplac� par \$U_n=4$"
	),
	array
	(
	'Petit',
	'petit,small',

	"\small{@Texte}",
	"\item @Texte est le texte qui doit �tre �crit en petits caract�res.",

	"La balise \b{small} �crit le texte en caract�res de taille inf�rieure � la taille standard.",

	"Bla \small{bla} bla..."
	),
	array
	(
	'Grand',
	'grand,gros,small',

	"\small{@Texte}",
	"\item @Texte est le texte qui doit �tre �crit en gros caract�res.",

	"La balise \b{big} �crit le texte en caract�res de taille sup�rieure � la taille standard.",

	"Bla \big{bla} bla..."
	),
	array
	(
	'Sans Serif',
	'sans serif,ss,textss,sans-serif',

	"\\textss{@Texte}",
	"\item @Texte est le texte qui doit �tre sans empattements.",

	"La balise \b{textss} �crit le texte avec une police sans empattements (les petites extensions qui forment la terminaison des caract�res sur les polices standards). Cette balise est id�ale pour �crire un code informatique de moins d'une ligne. Pour les textes plus long, pr�f�rez l'environnement \lien[?b=verbatim]{verbatim}.",

	"Le code PHP sera alors \\textss{if(\$a=2) echo 'R�ussi !';}."
	),
	array
	(
	'Monospace',
	'monospace,ms,textms',

	"\\textms{@Texte}",
	"\item @Texte est le texte qui doit �tre en monospace.",

	"La balise \b{textms} �crit le texte avec une police � chasse fixe : l'�cart entre deux lettres est alors constant.",

	"Le code PHP sera alors \\textms{if(\$a=2) echo 'R�ussi !';}."
	),
	array
	(
	'Citation "en ligne"',
	'quote,citation',

	"\\quote{@Texte}",
	"\item @Texte est la citation.",

	"La balise \b{quote} permet de citer un auteur. Les guillemets sont automatiquement ajout�s. Attention � ne pas confondre cette balise avec les guillemets \lien[?b=�]{� � et \"' '\"}.",

	"Comme le disait V, \quote{People should not be afraid of their governments. Governments should be afraid of their people.}"
	),
	array
	(
	'Si�cle',
	'si�cle,century',

	"\\century{@Siecle}",
	"\item @Siecle est un siecle au format latin.",

	"La balise \b{century} met en forme un num�ro de si�cle : ajout automatique d'un \"e\" en exposant, utilisation de petites majuscules. Ceci rend bien mieux qu'une tentative manuelle, cf. l'exemple.

	De plus, cela ajoute du sens � vos textes et permet au webmaster d'�tablir des \"lignes de temps\", par exemple pour savoir quelle �poque est la plus cit�e.",

	"Bien : La brosse � dents appara�t au \century{XIX}.
Pas bien : La brosse � dents appara�t au XIX\up{e}."
	),
	array
	(
	'Verbatim "en ligne"',
	'verbatim',

	"\\verbatim{@NoTypo}",
	"\item @NoTypo est le texte qui ne doit pas �tre modifi�.",

	"La balise \b{verbatim} emp�che la mise en forme automatique du texte en param�tre. Peut �tre utile pour �crire un nom de balise, par exemple.",

	"\\verbatim{Ce texte devrait �tre en \color[red]{rouge}}. Ce texte \color[red]{l'est}."
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
	\item @SousSousTitre est un titre de troisi�me niveau",

	"Les balises \b{section}, \b{subsection} et \b{subsubsection} permettent de structurer un texte complexe en ajoutant des titres et des sous titres.
Vous ne pouvez pas utiliser de balises pour obtenir un titre HTML \\textss{h1}, ce titre �tant reserv� pour le titre global des pages web.
Selon les sites Web qui utilisent le Typographe, ces fonctionalit�s peuvent �tre d�sactiv�es, e.g.  si le webmaster ne souhaite pas que les auteurs puissent �crire de textes trop longs.
De m�me, une num�rotation peut �tre appos�e automatiquement devant les titres.",

	"\\section{Jeunesse}
\\section{Roi de France}
\\subsection{Une administration nouvelle}
\\subsection{Les relations �trang�res}
\\subsubsection{L'Angleterre}
\\subsubsection{Les Habsbourg}
\\subsubsection{La fin des guerres d'Italie}
\\subsubsection{Derniers affrontements entre Philippe II et Henri II}
\\subsection{Le protestantisme}
\\subsection{ Les arts}
\\subsection{Le Nouveau Monde}
\\subsection{Fiefs r�unis � la Couronne}
\\section{Descendance}
\\section{Mort et post�rit�}"
	),
);
?>