<?php
$Titre="Méta balises";
$Description="Les méta-balises, contrairement aux balises standards agissent non pas sur un extrait de texte, mais sur l'intégralité du texte.<br />
Elles permettent par exemple de remplacer toutes les occurrences d'un mot par un autre mot, ou par une balise conventionnelle. La syntaxe d'une méta-balise est {{[NOM|Option]}}";

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
		'Pré-compilation : Remplacements',
		'{{[REPLACE|]}}, replace',

		"{{[REPLACE|@Original|@Remplacement]}}",
		"\item @Original est le texte original qui doit être recherché ;
		\item @Remplacement Est le texte de remplacement à utiliser.",

		"La méta-balise \b{REPLACE} permet d'effectuer des remplacements sur l'ensemble d'un texte.",
<<<EOD
{{[REPLACE|\oe|\b{\oe}]}}
{{[REG-REPLACE|#([^\\\\])(oe)#|\$1\b{\$2}]}}
"oe" est une ligature, appelée "e dans l'o"\\footnote{Un jeu de mots avec "oeufs dans l'eau".}, et parfois "o et e liés", voire \i{ethel} pour les plus cultivés.

Avec \i{ae}, il s'agit des deux ligatures linguistiques\\footnote{Et non typographiques, les ligatures typographiques rapprochant deux lettres dans un simple souci d'esthétisme (\i{ff} par exemple).} de la langue française, ce qui signifie que "oe" et "\oe" ne se prononcent pas de la même façon (comparez oeufs et m\oelleux par exemple !).

Dans l'ordre alphabétique, "oe" est classé comme un o et un e indépendants ("oenoché" est donc entre "odyssée" et "off"), bien que l'ensemble ne forme qu'un unique caractère : la mise en majuscule de oe est OE et non \Oe.
(\l[http://omnilogie.fr/5T]{source})
EOD
	),
	array
	(
	'Pré-compilation : Remplacements via expression régulière',
	'{{[REG-REPLACE|]}}, replacepp',

	"{{[REG-REPLACE|@Regexp|@Remplacement]}}",
	"\item @Regexp est l'expression régulière qui doit être trouvée.;
	\item @Remplacement Est le texte de remplacement à utiliser, qui peut contenir des \i{placeholders} de la première requête.",

	"La méta-balise \b{REG-REPLACE} permet d'effectuer des remplacements basés sur une expression régulière sur l'ensemble d'un texte.",
<<<EOD
{{[REPLACE|\oe|\b{\oe}]}}
{{[REG-REPLACE|#([^\\\\])(oe)#|\$1\b{\$2}]}}
"oe" est une ligature, appelée "e dans l'o"\\footnote{Un jeu de mots avec "oeufs dans l'eau".}, et parfois "o et e liés", voire \i{ethel} pour les plus cultivés.

Avec \i{ae}, il s'agit des deux ligatures linguistiques\\footnote{Et non typographiques, les ligatures typographiques rapprochant deux lettres dans un simple souci d'esthétisme (\i{ff} par exemple).} de la langue française, ce qui signifie que "oe" et "\oe" ne se prononcent pas de la même façon (comparez oeufs et m\oelleux par exemple !).

Dans l'ordre alphabétique, "oe" est classé comme un o et un e indépendants ("oenoché" est donc entre "odyssée" et "off"), bien que l'ensemble ne forme qu'un unique caractère : la mise en majuscule de oe est OE et non \Oe.
(\l[http://omnilogie.fr/5T]{source})
EOD
	),
);
?>