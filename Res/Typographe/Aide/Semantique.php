<?php
$Titre="Balises de sémantique";
$Description="Ces balises permettent d'obtenir un texte sémantiquement cohérent.
Vous pourrez par exemple définir un acronyme, changer la couleur, insérer des liens ou des images.";

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
		'Acronyme',
		'acronym, acronyme',

		'\acronym[@Signification]{@Acronyme}',

		'\item @Acronyme correspond à un acronyme qui doit être défini ;
		\item @Signification est le texte que représente @Acronyme.',

		"La balise \b{acronym} définit un acronyme, c'est-à-dire une abréviation qui se prononce comme un seul mot : il n'y a donc pas de \".\" séparant les différentes lettres.
		Pour plus d'informations sur la différence entre un sigle, une abréviation  et un acronyme, consultez \l[http://omnilogie.fr/O/Abr%C3%A9viation,_acronyme_ou_sigle_?]{cette page}.",

		'Le \acronym[light amplification by stimulated emission of radiation]{laser} est un appareil émettant de la lumière.'
	),
	array
	(
		'Abréviation',
		'abrev, abréviation, abreviation',

		'\abrev[@Signification]{@Abrev}',

		'\item @Abrev correspond à une abréviation qui doit être défini ;
		\item @Signification est le texte que représente @Abrev.',

		"La balise \b{abrev} définit une abréviation, c'est à dire un groupe de lettre utilisé pour raccourcir l'écriture d'un terme.
		Pour plus d'informations sur la différence entre un sigle, une abréviation et un acronyme, consultez \l[http://omnilogie.fr/O/Abr%C3%A9viation,_acronyme_ou_sigle_?]{cette page}.",

		'La \abrev[Bande dessinée]{BD} est le neuvième art.'
	),
	array
	(
		'Lien',
		'l,lien,link',

		'\l[@URL]{@TitreLien}',

		"\item @URL est l'adresse du site web à afficher ;
		\item @TitreLien est le titre qui doit s'afficher pour le lien.",

		"La balise \b{link} permet de créer un lien vers une page web. Elle possède plusieurs alias : \b{lien} et \b{l}, qui fonctionnent toutes sur le même principe.

		Les liens sont marqués d'un attribut \\textss{\\verbatim{rel=\"nofollow\"}}, pour éviter les publicités spams. Consultez \l[http://en.wikipedia.org/wiki/Nofollow]{Nofollow} pour en savoir plus.",

		'\link[http://google.fr]{Google} est un moteur de recherche très utilisé.'
	),
	array
	(
	'Emphase spéciale',
	'emph,character',

	'\emph[@1-6]{@Texte}',

	"\item @1-6 est un nombre entre un et six;
	\item @Texte est le texte à mettre en emphase spéciale.",

	"Contrairement à la balise \lien[/Res/Typo/Aide/?b=italique,emphase,i]{emph}, emph[1-6] est une balise sémantique. Elle permet de mettre en emphase de façon répétitive un mot ou groupe de mot, en le distinguant d'un simple italique. Il est difficile de défnir cette balise, consultez l'exemple pour mieux comprendre.

	Notez que même si les résultats produits sont similaires à \lien[/Res/Typo/Aide/?b=color]{color}, les résultats sont sémantiquements différents. Préférez cette balise si la couleur n'importe pas pour votre mise en emphase.",

	"L'enquête de gendarmerie qui s'ensuit est un modèle du genre, et rapidement les informations affluent.
On découvre par exemple qu'un dénommé \emph[1]{Laborde}, marchand de vin de son état, aurait été le seul passager de la malle-poste, et qu'il avait un sabre pour tout bagage.
On pourra s'étonner que les autorités laissent un homme aussi louche emprunter un convoi aussi important, mais toujours est-il que le dénommé \emph[1]{Laborde} n'est pas retrouvé.
Des rebondissements rocambolesques mènent à l'arrestation de six hommes : \emph[2]{Couriol}, \emph[3]{Lesurques}, Guénot, Richard, Bruer et Bernard.

\emph[3]{Lesurques} ne cesse de clamer son innocence, arguant qu'il s'agit d'un terrible malentendu et persuadé que le procès fera toute la lumière sur cette sombre histoire.
Quant à \emph[2]{Couriol}, on découvre que son porte monnaie contient l'énorme somme de 1170460 livres en assignats... étrange.
(extrait de \l[http://omnilogie.fr/O/L%27affaire_du_courrier_de_Lyon]{L'affaire du courrier de Lyon})"
	),
	array
	(
	'Note de bas de page',
	'note de bas de page, footnote',

	'\footnote{@Note}',

	"\item @Note est le contenu de la note.",

	"La balise \b{footnote} est une balise extrêmement puissante gérant les notes de bas de page. Dans le cas d'un document web, ces notes ne sont pas affichées en fin de page, mais en fin de texte. Le contenu de la balise footnote peut contenir d'autres balises ou du contenu complexe (mais pas de footnote), mais celui-ci ne sera pas forcément affiché au passage de la souris sur le numéro (il sera en revanche affiché correctement en fin d'article). La numérotation des notes est correctement gérée même si plusieurs articles utilisant la classe Typo sont affichés sur une même page.

	\i{Note} : Pensez à fermer vos notes de bas de page par un point, il s'agit d'une phrase complète et indépendante qui doit à ce titre être terminée correctement.",

	"On nous dit\\footnote{cf. \l[http://neamar.fr]{cette page web}.} que nous sommes bêtes : c'est vrai.

	J'en veux pour preuve que nous descendons du singe !"
	),
	array
	(
		'Couleur',
		'color, couleur',

		'\color[@color]{@Texte}',

		'\begin{itemize}
		\li @color est la couleur que doit prendre le texte. Les couleurs supportées sont les couleurs CSS :
			\item white
			\item silver
			\item gray
			\item black
			\item red
			\item maroon
			\item lime
			\item green
			\item yellow
			\item olive
			\item blue
			\item navy
			\item fuchsia
			\item purple
			\item aqua
			\item teal
		\li @Texte est le texte à mettre en couleur.
		\end{itemize}',

		"La balise \b{color} permet de colorer vos textes. Il est conseillé de l'utiliser avec parcimonie : \"trop de couleurs tuent la couleur\". De plus, un texte a rarement besoin de couleurs...",

		"\color[maroon]{Bonjour} ! Je parle en \color[green]{vert}.
		\color[purple]{Des enchâssement \color[red]{complexes} sont \color[fuchsia]{po\color[lime]{ss}ibles}}"
	),
	array
	(
		'Image',
		'image,picture',

		'\image[@Description]{@URL}',
		"\item @Description est une courte description de l'image, qui s'affichera au survol de la souris, et quand l'image n'est pas chargée (navigateur en mode texte, petite connexion, problème du serveur...) ;
		\item @URL est l'adresse de l'image sur \b{internet}. \color[red]{Vous ne pouvez pas utiliser directement une image de votre disque dur}.",

		"La balise \b{image} permet d'afficher une image de l'internet dans votre texte. Pour utiliser une image de votre disque, vous devez utiliser un service d'envoi d'image - tel que \l[http://tinypic.com/]{http://tinypic.com/} --, puis mettre l'adresse obtenue en tant que paramètre @URL.",

		"\image[Mon favicon !]{http://neamar.fr/favicon.ico} Le favicon de ce site"
	),
	array
	(
	'Image étiquetée',
	'labelimage, label',

	'\labelimage[@Description]{@URL}',
	"\item @Description est une courte description de l'image, qui s'affichera au survol de la souris, et quand l'image n'est pas chargée (navigateur en mode texte, petite connexion, problème du serveur. De plus, @Description servira da légende dans le cadre.) ;
	\item @URL est l'adresse de l'image sur \b{internet}. \color[red]{Vous ne pouvez pas utiliser directement une image de votre disque dur}.",

	"La balise \b{labelimage} permet d'afficher une image de l'internet dans votre texte et de la mettre en valeur par rapport au texte en la séparant. Pour utiliser une image de votre disque, vous devez utiliser un service d'envoi d'image - tel que \l[http://tinypic.com/]{http://tinypic.com/} --, puis mettre l'adresse obtenue en tant que paramètre @URL.",

	"\labelimage[Voici un favicon !]{http://neamar.fr/favicon.ico}

Le favicon est une toute petite icône permettant de personaliser les favoris et les onglets en leur donnant une petite touche spéciale. À l'origine, les favicons étaient forcément au format \\textss{ico}, mais a plupart des navigateurs acceptent maintenant tous les formats, même animés, comme le montre l'image ci contre.

Je ne sais que dire pour continuer, mais je dois ajouter du texte pour bien montrer que derrière la boite créée pour le labelimage, le texte se remet correctement en place. Normalement, cela devrait être compréhensible et visible, redimensionnez votre fenêtre sinon."
	),
	array
	(
	'Étiquettes',
	'label, étiquette',

	'\label[@Nom]{@Texte}',

	'\item @Nom est un identifiant unique qui décrit votre contenu, composé uniquement de lettres \b{standard} : a-z ;
	\item @Texte est un texte (potentiellement vide).',

	"La balise \b{label} définit une étiquette qui peut être utilisée avec \lien[/Res/Typo/Aide/?b=ref]{ref} pour faire des renvois.",

'\label[haut]{}Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ullamcorper, mauris nec euismod mollis, nunc ipsum aliquam urna, nec blandit ligula augue id nisi. Ut at lorem vitae quam dictum tempus. Nulla quis mattis justo. Nunc vehicula adipiscing elit et ultricies. Nulla id magna ipsum, vel pulvinar urna. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla volutpat sapien et libero tempor ac pellentesque lorem accumsan. Praesent lobortis dui sit amet elit pellentesque gravida. Integer eget odio et elit rhoncus ultricies. Suspendisse vestibulum commodo fringilla.

Curabitur accumsan aliquam ullamcorper. Cras in nisi purus. Nunc odio eros, interdum in aliquet tristique, tincidunt nec purus. Aenean lobortis, nisi sit amet euismod lacinia, nulla mauris congue libero, a vestibulum sem nisi id ligula. Curabitur pretium, quam ut dictum aliquet, nisl dolor tristique odio, non feugiat mi sem vitae nulla. \label[Vivamus]{Vivamus} porttitor ipsum mattis mi condimentum in porta nunc condimentum. Suspendisse facilisis justo blandit augue porta non pharetra dolor eleifend. Aenean nec nunc mauris, at ornare purus. Suspendisse molestie, eros sit amet tincidunt ornare, ipsum justo volutpat ante, nec sollicitudin risus enim id felis. Proin id purus eget ante tristique dignissim eu vel arcu. In sit amet egestas urna. Vestibulum leo erat, venenatis et fringilla non, auctor sed augue. Curabitur sed augue eget dolor consequat scelerisque quis hendrerit velit. Etiam tempor arcu id metus vestibulum in lobortis enim pellentesque. Suspendisse vel sodales neque. Phasellus fringilla viverra pretium. Curabitur id nulla arcu, non imperdiet ante. Vivamus velit nunc, laoreet a hendrerit nec, mollis eu dolor. Suspendisse potenti.

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean in odio nibh. In posuere commodo enim eu feugiat. Sed vel magna non libero laoreet adipiscing. Nunc tincidunt volutpat neque, vel tincidunt augue consectetur faucibus. Vestibulum varius mauris pulvinar urna ullamcorper sit amet porttitor lectus tempor. Donec massa quam, porta non vestibulum sed, consectetur in eros. Cras quis metus non mauris condimentum rutrum vitae ut dui. Proin velit mi, dapibus sed commodo eu, faucibus vel leo. Nullam lorem turpis, pretium vehicula luctus nec, dapibus sit amet diam. Quisque sit amet velit mauris. Suspendisse mattis, est sed rhoncus laoreet, tellus risus hendrerit nulla, ut ullamcorper magna massa sit amet velit. Fusce nec magna nulla, sit amet condimentum lorem. Phasellus cursus consectetur egestas. Maecenas adipiscing nulla sed elit ornare tempor.

Cras tincidunt felis sed ante vulputate laoreet. Maecenas commodo mi eget nulla pharetra hendrerit. Curabitur rhoncus interdum ante, vitae tristique odio congue eu. Mauris sapien diam, mollis nec sodales vitae, blandit eget metus. Aliquam ipsum felis, vestibulum quis volutpat non, pretium quis nisl. In ac ligula purus, et vestibulum nulla. Ut et nisl tellus. Sed justo tortor, volutpat in tincidunt at, ornare vitae erat. Ut et nulla lectus. Suspendisse imperdiet purus et tortor ornare eget vulputate sapien faucibus. Fusce ullamcorper justo eu nibh luctus a accumsan lectus accumsan. Etiam ipsum neque, vestibulum sit amet vehicula sed, posuere ut mauris. Nulla facilisi. \ref[Vivamus]{Vivamus} est nibh, venenatis non venenatis sed, lobortis at tortor. Sed consequat consequat orci, vel egestas tortor facilisis in. Suspendisse aliquam mattis nulla ornare sodales.
\ref[haut]{Début}.'
	),
	array
	(
	'Référence',
	'ref,reference',

	'\ref[@Label]{@Texte}',

	'\item @Label est un identifiant unique crée à l\'aide de \lien[/Res/Typo/Aide/?b=label]{label} ;
	\item @Texte est un texte.',

	"La balise \b{ref} définit une référence vers une \lien[/Res/Typo/Aide/?b=label]{étiquette}. L'étiquette peut être crée plus tard dans le texte si besoin est.",

'\label[haut]{}Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ullamcorper, mauris nec euismod mollis, nunc ipsum aliquam urna, nec blandit ligula augue id nisi. Ut at lorem vitae quam dictum tempus. Nulla quis mattis justo. Nunc vehicula adipiscing elit et ultricies. Nulla id magna ipsum, vel pulvinar urna. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla volutpat sapien et libero tempor ac pellentesque lorem accumsan. Praesent lobortis dui sit amet elit pellentesque gravida. Integer eget odio et elit rhoncus ultricies. Suspendisse vestibulum commodo fringilla.

Curabitur accumsan aliquam ullamcorper. Cras in nisi purus. Nunc odio eros, interdum in aliquet tristique, tincidunt nec purus. Aenean lobortis, nisi sit amet euismod lacinia, nulla mauris congue libero, a vestibulum sem nisi id ligula. Curabitur pretium, quam ut dictum aliquet, nisl dolor tristique odio, non feugiat mi sem vitae nulla. \label[Vivamus]{Vivamus} porttitor ipsum mattis mi condimentum in porta nunc condimentum. Suspendisse facilisis justo blandit augue porta non pharetra dolor eleifend. Aenean nec nunc mauris, at ornare purus. Suspendisse molestie, eros sit amet tincidunt ornare, ipsum justo volutpat ante, nec sollicitudin risus enim id felis. Proin id purus eget ante tristique dignissim eu vel arcu. In sit amet egestas urna. Vestibulum leo erat, venenatis et fringilla non, auctor sed augue. Curabitur sed augue eget dolor consequat scelerisque quis hendrerit velit. Etiam tempor arcu id metus vestibulum in lobortis enim pellentesque. Suspendisse vel sodales neque. Phasellus fringilla viverra pretium. Curabitur id nulla arcu, non imperdiet ante. Vivamus velit nunc, laoreet a hendrerit nec, mollis eu dolor. Suspendisse potenti.

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean in odio nibh. In posuere commodo enim eu feugiat. Sed vel magna non libero laoreet adipiscing. Nunc tincidunt volutpat neque, vel tincidunt augue consectetur faucibus. Vestibulum varius mauris pulvinar urna ullamcorper sit amet porttitor lectus tempor. Donec massa quam, porta non vestibulum sed, consectetur in eros. Cras quis metus non mauris condimentum rutrum vitae ut dui. Proin velit mi, dapibus sed commodo eu, faucibus vel leo. Nullam lorem turpis, pretium vehicula luctus nec, dapibus sit amet diam. Quisque sit amet velit mauris. Suspendisse mattis, est sed rhoncus laoreet, tellus risus hendrerit nulla, ut ullamcorper magna massa sit amet velit. Fusce nec magna nulla, sit amet condimentum lorem. Phasellus cursus consectetur egestas. Maecenas adipiscing nulla sed elit ornare tempor.

Cras tincidunt felis sed ante vulputate laoreet. Maecenas commodo mi eget nulla pharetra hendrerit. Curabitur rhoncus interdum ante, vitae tristique odio congue eu. Mauris sapien diam, mollis nec sodales vitae, blandit eget metus. Aliquam ipsum felis, vestibulum quis volutpat non, pretium quis nisl. In ac ligula purus, et vestibulum nulla. Ut et nisl tellus. Sed justo tortor, volutpat in tincidunt at, ornare vitae erat. Ut et nulla lectus. Suspendisse imperdiet purus et tortor ornare eget vulputate sapien faucibus. Fusce ullamcorper justo eu nibh luctus a accumsan lectus accumsan. Etiam ipsum neque, vestibulum sit amet vehicula sed, posuere ut mauris. Nulla facilisi. \ref[Vivamus]{Vivamus} est nibh, venenatis non venenatis sed, lobortis at tortor. Sed consequat consequat orci, vel egestas tortor facilisis in. Suspendisse aliquam mattis nulla ornare sodales.
\ref[haut]{Début}.'
	),
	array
	(
		'Mathématiques',
		'mathématiques, $, mathematiques',

		'$@Formule$',
		"\item @Formule est une formule mathématique au format LaTeX.",

		"Les dollars (\b{\$}) permettent de rédiger une formule mathématique au format LaTeX. Si la formule est assez simple, elle est affichée au format HTML, sinon une image est générée.
		Dans certains cas, il peut être préférable de rendre le LaTeX en image même si la formule est simple : il suffit alors de terminer la formule par un tilde (~) pour forcer la génération de l'image (cf. Exemples).",

		"La série factorielle converge vers \$e^1$ : $\sum_{n=0}^{\infty} \\frac{1}{n!}\;=e^1$.
\item Le $^{140}_{54}Xe$ xénon est produit lors de la désintégration de l'uranium.
\item Le $^{140}_{54}Xe~$ xénon est produit lors de la désintégration de l'uranium."
	),
	array(
		'Item',
		'item,puce',

		'\item Premier élément de liste
\item Second élément de liste
\item ...',

		'Aucun paramètre.',

		"La balise \b{item} permet de créer très facilement une liste ; elle est cependant plus limitée que les environnement dédiés itemize et enumerate. Un premier item crée une liste, qui continue tant que les débuts de ligne sont des balises item. Si vous faites un saut de ligne, ou commencez une phrase sans item, la liste est fermée.
		Vous ne pouvez pas imbriquer plusieurs listes avec la méthode des item, passez par itemize ou enumerate.",

		"\item \b{Premier} élément de liste ;
\item \i{Second} élément de liste ;
\item et ainsi de suite ad libitum..."
	),
	array(
		'Trait horizontal court',
		'Trait horizontal court, ~, trait court',

		'Texte
~
Nouveau paragraphe',

		'Aucun paramètre.',

		"La balise \b{~} insére un trait horizontal court, et ferme le paragraphe précédant le symbole. Pour commencer une phrase par un tilde, échappez le avec un backslash. Pour un trait complet, voyez \lien[/Res/Typo/Aide/?b=~~~]{~~~}.",

		"...à ses généraux.
~
Napoléon dit alors : ..."
	),
	array(
		'Trait horizontal long',
		'Trait horizontal long,~~~, trait long',

		'Texte
~~~
Nouveau paragraphe',

		'Aucun paramètre.',

		"La balise \b{~~~} insére un trait horizontal, et ferme le paragraphe précédant le symbole. Pour commencer une phrase par un tilde, échappez le avec un backslash. Pour un trait court, voyez \lien[/Res/Typo/Aide/?b=~]{~}.",

		"...à ses généraux.
~~~
Napoléon dit alors : ..."
	),
	array(
	'Caractères accentués majuscules',
	'À,É,È,Ê,Ô,Ù,Â',

	'À propos... Élevons-nous vers l\'infini !',

	'Aucun paramètre.',

"Les majuscules doivent comporter les accents\\footnote{Contrairement à une vieille légende qui affirme le contraire, \lien[http://omnilogie.fr/55]{héritée des temps où les caractères en plomb composant la police ne pouvait effectivement pas contenir l'accent.}}, mais l'accès à ces symboles est complexe sur un clavier Windows. Vous pouvez donc vous servir directement des symboles intégrés dans le typographe.",

	"À,É,È,Ê,Ô,Ù,Â"
	),
	array(
	'Tirets cadratins et demi-cadratins',
	'&mdash;  Cadratin (auto), &ndash; Demi cadratin (auto) ',

	"&mdash; Et ceci &ndash; remarquez l'incise &ndash; est la preuve que vous avez tort.",

	'Aucun paramètre.',

	"Les tirets ont une histoire complexe. Notons simplement qu'un tiret qui fait la liaison entre deux mots est appelé trait d'union, ou tiret quart-cadratin. Un tiret d'incise - ceci est une incise - est légérement plus grand, d'où son nom de demi-cadratin. Enfin, le tiret cadratin (---) est utilisé pour les entames de dialogue. \i{Le Typographe} tente de mettre automatiquement en forme vos tirets (en détectant les espaces autour), mais vous pouvez le forcer à utiliser un certain type de tirets. Marquez deux \\verbatim{tirets (--)} pour un tiret demi-cadratin, concaténez en trois pour le tiret \\verbatim{cadratin (---)}",

	"
- Le premier tiret est détecté comme un tiret d'entame et mis en forme
- Et cette incise - celle là - est détectée de même. Les noms composés ne posent pas de problème : mal-voyant. Vous n'avez qu'à comparer la largeur des tirets pour comprendre !"
	),
	array(
	'Guillemets à la française, guillemets à l\'anglaise',
	'« ... » (auto), &ldquo;...&rdquo; (auto)',

	'«&nbsp;Bonjour, capitaine&nbsp;»
&ldquo;Hello capitain&rdquo;',

	'Aucun paramètre.',

	"Les guillemets typographiques \\verbatim{(les guillemets droits : \")} sont automatiquement transformés en guillemets à la française séparés par des espaces insécables. \i{Le Typographe} peut reconnaitre les imbrications de guillemets si celle-ci sont bien faites (espaces bien placés). Consultez les exemples pour plus d'informations.

	Les guillemets anglais sont utilisées pour les imbrications de guillemets. Vous pouvez forcer leur utilisation \\verbatim{en entourant vos guillemets d'apostrophe : \"'du texte'\"} qui deviendra alors \"'du texte'\". Attention, sémantiquement parlant, ces guillemets ne sont pas les mêmes que la balise \lien[?b=quote]{quote}. Si vous souhaitez citer une personne, c'est la balise quote qu'il faut utiliser.",

	'"Les guillemets typographiques deviennent des guillemets à la française."
"Je lui ai dit "imbrication de guillemets" mais je crois qu\'il n\'a pas compris."
Sachez, "\'jeune homme\'", que je ne tergiverse pas.'
	),
	array(
	'Espace insécable',
	'Espace insécable, non breaking space',

	'\nbsp;',

	'Aucun paramètre.',

	"Dans certaines situations, on peut souhaiter que le texte n'aille pas automatiquement à la ligne : par exemple, il est assez désagréable de voir un point d'exclamation déporté en début de ligne tout seul ! \i{Le Typographe} gère automatiquement tous les problèmes de ponctuation, mais dans certaines situations, vous aurez besoin d'ajouter vous même vos espaces insécables sur certains mots.",

	'&empty;'
	),
	array(
	'Césure optionnelle',
	'Césure optionnelle, soft hyphen',

	'\shy;',

	'Aucun paramètre.',

	"Le tiret de césure optionnelle vous permet d'indiquer au navigateur qu'il peut, si besoin est, couper le mot à cet endroit et le continuer sur la ligne d'après. Cela peut être pratique quand votre texte est justifié",

	"L'Hexakosioihexekontahexaphobie désigne les hexa\shy;kosioi\shy;hexe\shy;konta\shy;hexa\shy;phobe.
hexa\shy;kosioi\shy;hexe\shy;konta\shy;hexa\shy;phobehexa\shy;kosioi\shy;hexe\shy;konta\shy;hexa\shy;phobehexa\shy;kosioi\shy;hexe\shy;konta\shy;hexa\shy;phobehexa\shy;kosioi\shy;hexe\shy;konta\shy;hexa\shy;phobehexa\shy;kosioi\shy;hexe\shy;konta\shy;hexa\shy;phobe."
	),
)

?>