<?php
$Titre="M�ta balises";
$Description="Les m�ta-balises, contrairement aux balises standards agissent non pas sur un extrait de texte, mais sur l'int�gralit� du texte.<br />
Elles permettent par exemple de remplacer toutes les occurrences d'un mot par un autre mot, ou par une balise conventionnelle. La syntaxe d'une m�ta-balise est {{[NOM|Option]}}";

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
		'Pr�-compilation : Remplacements',
		'{{[REPLACE|]}}, replace',

		"{{[REPLACE|@Original|@Remplacement]}}",
		"\item @Original est le texte original qui doit �tre recherch� ;
		\item @Remplacement Est le texte de remplacement � utiliser.",

		"La m�ta-balise \b{REPLACE} permet d'effectuer des remplacements sur l'ensemble d'un texte.",
<<<EOD
{{[REPLACE|\oe|\b{\oe}]}}
{{[REG-REPLACE|#([^\\\\])(oe)#|\$1\b{\$2}]}}
"oe" est une ligature, appel�e "e dans l'o"\\footnote{Un jeu de mots avec "oeufs dans l'eau".}, et parfois "o et e li�s", voire \i{ethel} pour les plus cultiv�s.

Avec \i{ae}, il s'agit des deux ligatures linguistiques\\footnote{Et non typographiques, les ligatures typographiques rapprochant deux lettres dans un simple souci d'esth�tisme (\i{ff} par exemple).} de la langue fran�aise, ce qui signifie que "oe" et "\oe" ne se prononcent pas de la m�me fa�on (comparez oeufs et m\oelleux par exemple !).

Dans l'ordre alphab�tique, "oe" est class� comme un o et un e ind�pendants ("oenoch�" est donc entre "odyss�e" et "off"), bien que l'ensemble ne forme qu'un unique caract�re : la mise en majuscule de oe est OE et non \Oe.
(\l[http://omnilogie.fr/5T]{source})
EOD
	),
	array
	(
	'Pr�-compilation : Remplacements via expression r�guli�re',
	'{{[REG-REPLACE|]}}, replacepp',

	"{{[REG-REPLACE|@Regexp|@Remplacement]}}",
	"\item @Regexp est l'expression r�guli�re qui doit �tre trouv�e.;
	\item @Remplacement Est le texte de remplacement � utiliser, qui peut contenir des \i{placeholders} de la premi�re requ�te.",

	"La m�ta-balise \b{REG-REPLACE} permet d'effectuer des remplacements bas�s sur une expression r�guli�re sur l'ensemble d'un texte.",
<<<EOD
{{[REPLACE|\oe|\b{\oe}]}}
{{[REG-REPLACE|#([^\\\\])(oe)#|\$1\b{\$2}]}}
"oe" est une ligature, appel�e "e dans l'o"\\footnote{Un jeu de mots avec "oeufs dans l'eau".}, et parfois "o et e li�s", voire \i{ethel} pour les plus cultiv�s.

Avec \i{ae}, il s'agit des deux ligatures linguistiques\\footnote{Et non typographiques, les ligatures typographiques rapprochant deux lettres dans un simple souci d'esth�tisme (\i{ff} par exemple).} de la langue fran�aise, ce qui signifie que "oe" et "\oe" ne se prononcent pas de la m�me fa�on (comparez oeufs et m\oelleux par exemple !).

Dans l'ordre alphab�tique, "oe" est class� comme un o et un e ind�pendants ("oenoch�" est donc entre "odyss�e" et "off"), bien que l'ensemble ne forme qu'un unique caract�re : la mise en majuscule de oe est OE et non \Oe.
(\l[http://omnilogie.fr/5T]{source})
EOD
	),
);
?>