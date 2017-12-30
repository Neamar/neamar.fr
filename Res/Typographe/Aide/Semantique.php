<?php
$Titre="Balises de s�mantique";
$Description="Ces balises permettent d'obtenir un texte s�mantiquement coh�rent.
Vous pourrez par exemple d�finir un acronyme, changer la couleur, ins�rer des liens ou des images.";

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

		'\item @Acronyme correspond � un acronyme qui doit �tre d�fini ;
		\item @Signification est le texte que repr�sente @Acronyme.',

		"La balise \b{acronym} d�finit un acronyme, c'est-�-dire une abr�viation qui se prononce comme un seul mot : il n'y a donc pas de \".\" s�parant les diff�rentes lettres.
		Pour plus d'informations sur la diff�rence entre un sigle, une abr�viation  et un acronyme, consultez \l[http://omnilogie.fr/O/Abr%C3%A9viation,_acronyme_ou_sigle_?]{cette page}.",

		'Le \acronym[light amplification by stimulated emission of radiation]{laser} est un appareil �mettant de la lumi�re.'
	),
	array
	(
		'Abr�viation',
		'abrev, abr�viation, abreviation',

		'\abrev[@Signification]{@Abrev}',

		'\item @Abrev correspond � une abr�viation qui doit �tre d�fini ;
		\item @Signification est le texte que repr�sente @Abrev.',

		"La balise \b{abrev} d�finit une abr�viation, c'est � dire un groupe de lettre utilis� pour raccourcir l'�criture d'un terme.
		Pour plus d'informations sur la diff�rence entre un sigle, une abr�viation et un acronyme, consultez \l[http://omnilogie.fr/O/Abr%C3%A9viation,_acronyme_ou_sigle_?]{cette page}.",

		'La \abrev[Bande dessin�e]{BD} est le neuvi�me art.'
	),
	array
	(
		'Lien',
		'l,lien,link',

		'\l[@URL]{@TitreLien}',

		"\item @URL est l'adresse du site web � afficher ;
		\item @TitreLien est le titre qui doit s'afficher pour le lien.",

		"La balise \b{link} permet de cr�er un lien vers une page web. Elle poss�de plusieurs alias : \b{lien} et \b{l}, qui fonctionnent toutes sur le m�me principe.

		Les liens sont marqu�s d'un attribut \\textss{\\verbatim{rel=\"nofollow\"}}, pour �viter les publicit�s spams. Consultez \l[http://en.wikipedia.org/wiki/Nofollow]{Nofollow} pour en savoir plus.",

		'\link[http://google.fr]{Google} est un moteur de recherche tr�s utilis�.'
	),
	array
	(
	'Emphase sp�ciale',
	'emph,character',

	'\emph[@1-6]{@Texte}',

	"\item @1-6 est un nombre entre un et six;
	\item @Texte est le texte � mettre en emphase sp�ciale.",

	"Contrairement � la balise \lien[/Res/Typo/Aide/?b=italique,emphase,i]{emph}, emph[1-6] est une balise s�mantique. Elle permet de mettre en emphase de fa�on r�p�titive un mot ou groupe de mot, en le distinguant d'un simple italique. Il est difficile de d�fnir cette balise, consultez l'exemple pour mieux comprendre.

	Notez que m�me si les r�sultats produits sont similaires � \lien[/Res/Typo/Aide/?b=color]{color}, les r�sultats sont s�mantiquements diff�rents. Pr�f�rez cette balise si la couleur n'importe pas pour votre mise en emphase.",

	"L'enqu�te de gendarmerie qui s'ensuit est un mod�le du genre, et rapidement les informations affluent.
On d�couvre par exemple qu'un d�nomm� \emph[1]{Laborde}, marchand de vin de son �tat, aurait �t� le seul passager de la malle-poste, et qu'il avait un sabre pour tout bagage.
On pourra s'�tonner que les autorit�s laissent un homme aussi louche emprunter un convoi aussi important, mais toujours est-il que le d�nomm� \emph[1]{Laborde} n'est pas retrouv�.
Des rebondissements rocambolesques m�nent � l'arrestation de six hommes : \emph[2]{Couriol}, \emph[3]{Lesurques}, Gu�not, Richard, Bruer et Bernard.

\emph[3]{Lesurques} ne cesse de clamer son innocence, arguant qu'il s'agit d'un terrible malentendu et persuad� que le proc�s fera toute la lumi�re sur cette sombre histoire.
Quant � \emph[2]{Couriol}, on d�couvre que son porte monnaie contient l'�norme somme de 1170460 livres en assignats... �trange.
(extrait de \l[http://omnilogie.fr/O/L%27affaire_du_courrier_de_Lyon]{L'affaire du courrier de Lyon})"
	),
	array
	(
	'Note de bas de page',
	'note de bas de page, footnote',

	'\footnote{@Note}',

	"\item @Note est le contenu de la note.",

	"La balise \b{footnote} est une balise extr�mement puissante g�rant les notes de bas de page. Dans le cas d'un document web, ces notes ne sont pas affich�es en fin de page, mais en fin de texte. Le contenu de la balise footnote peut contenir d'autres balises ou du contenu complexe (mais pas de footnote), mais celui-ci ne sera pas forc�ment affich� au passage de la souris sur le num�ro (il sera en revanche affich� correctement en fin d'article). La num�rotation des notes est correctement g�r�e m�me si plusieurs articles utilisant la classe Typo sont affich�s sur une m�me page.

	\i{Note} : Pensez � fermer vos notes de bas de page par un point, il s'agit d'une phrase compl�te et ind�pendante qui doit � ce titre �tre termin�e correctement.",

	"On nous dit\\footnote{cf. \l[http://neamar.fr]{cette page web}.} que nous sommes b�tes : c'est vrai.

	J'en veux pour preuve que nous descendons du singe !"
	),
	array
	(
		'Couleur',
		'color, couleur',

		'\color[@color]{@Texte}',

		'\begin{itemize}
		\li @color est la couleur que doit prendre le texte. Les couleurs support�es sont les couleurs CSS :
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
		\li @Texte est le texte � mettre en couleur.
		\end{itemize}',

		"La balise \b{color} permet de colorer vos textes. Il est conseill� de l'utiliser avec parcimonie : \"trop de couleurs tuent la couleur\". De plus, un texte a rarement besoin de couleurs...",

		"\color[maroon]{Bonjour} ! Je parle en \color[green]{vert}.
		\color[purple]{Des ench�ssement \color[red]{complexes} sont \color[fuchsia]{po\color[lime]{ss}ibles}}"
	),
	array
	(
		'Image',
		'image,picture',

		'\image[@Description]{@URL}',
		"\item @Description est une courte description de l'image, qui s'affichera au survol de la souris, et quand l'image n'est pas charg�e (navigateur en mode texte, petite connexion, probl�me du serveur...) ;
		\item @URL est l'adresse de l'image sur \b{internet}. \color[red]{Vous ne pouvez pas utiliser directement une image de votre disque dur}.",

		"La balise \b{image} permet d'afficher une image de l'internet dans votre texte. Pour utiliser une image de votre disque, vous devez utiliser un service d'envoi d'image - tel que \l[http://tinypic.com/]{http://tinypic.com/} --, puis mettre l'adresse obtenue en tant que param�tre @URL.",

		"\image[Mon favicon !]{http://neamar.fr/favicon.ico} Le favicon de ce site"
	),
	array
	(
	'Image �tiquet�e',
	'labelimage, label',

	'\labelimage[@Description]{@URL}',
	"\item @Description est une courte description de l'image, qui s'affichera au survol de la souris, et quand l'image n'est pas charg�e (navigateur en mode texte, petite connexion, probl�me du serveur. De plus, @Description servira da l�gende dans le cadre.) ;
	\item @URL est l'adresse de l'image sur \b{internet}. \color[red]{Vous ne pouvez pas utiliser directement une image de votre disque dur}.",

	"La balise \b{labelimage} permet d'afficher une image de l'internet dans votre texte et de la mettre en valeur par rapport au texte en la s�parant. Pour utiliser une image de votre disque, vous devez utiliser un service d'envoi d'image - tel que \l[http://tinypic.com/]{http://tinypic.com/} --, puis mettre l'adresse obtenue en tant que param�tre @URL.",

	"\labelimage[Voici un favicon !]{http://neamar.fr/favicon.ico}

Le favicon est une toute petite ic�ne permettant de personaliser les favoris et les onglets en leur donnant une petite touche sp�ciale. � l'origine, les favicons �taient forc�ment au format \\textss{ico}, mais a plupart des navigateurs acceptent maintenant tous les formats, m�me anim�s, comme le montre l'image ci contre.

Je ne sais que dire pour continuer, mais je dois ajouter du texte pour bien montrer que derri�re la boite cr��e pour le labelimage, le texte se remet correctement en place. Normalement, cela devrait �tre compr�hensible et visible, redimensionnez votre fen�tre sinon."
	),
	array
	(
	'�tiquettes',
	'label, �tiquette',

	'\label[@Nom]{@Texte}',

	'\item @Nom est un identifiant unique qui d�crit votre contenu, compos� uniquement de lettres \b{standard} : a-z ;
	\item @Texte est un texte (potentiellement vide).',

	"La balise \b{label} d�finit une �tiquette qui peut �tre utilis�e avec \lien[/Res/Typo/Aide/?b=ref]{ref} pour faire des renvois.",

'\label[haut]{}Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ullamcorper, mauris nec euismod mollis, nunc ipsum aliquam urna, nec blandit ligula augue id nisi. Ut at lorem vitae quam dictum tempus. Nulla quis mattis justo. Nunc vehicula adipiscing elit et ultricies. Nulla id magna ipsum, vel pulvinar urna. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla volutpat sapien et libero tempor ac pellentesque lorem accumsan. Praesent lobortis dui sit amet elit pellentesque gravida. Integer eget odio et elit rhoncus ultricies. Suspendisse vestibulum commodo fringilla.

Curabitur accumsan aliquam ullamcorper. Cras in nisi purus. Nunc odio eros, interdum in aliquet tristique, tincidunt nec purus. Aenean lobortis, nisi sit amet euismod lacinia, nulla mauris congue libero, a vestibulum sem nisi id ligula. Curabitur pretium, quam ut dictum aliquet, nisl dolor tristique odio, non feugiat mi sem vitae nulla. \label[Vivamus]{Vivamus} porttitor ipsum mattis mi condimentum in porta nunc condimentum. Suspendisse facilisis justo blandit augue porta non pharetra dolor eleifend. Aenean nec nunc mauris, at ornare purus. Suspendisse molestie, eros sit amet tincidunt ornare, ipsum justo volutpat ante, nec sollicitudin risus enim id felis. Proin id purus eget ante tristique dignissim eu vel arcu. In sit amet egestas urna. Vestibulum leo erat, venenatis et fringilla non, auctor sed augue. Curabitur sed augue eget dolor consequat scelerisque quis hendrerit velit. Etiam tempor arcu id metus vestibulum in lobortis enim pellentesque. Suspendisse vel sodales neque. Phasellus fringilla viverra pretium. Curabitur id nulla arcu, non imperdiet ante. Vivamus velit nunc, laoreet a hendrerit nec, mollis eu dolor. Suspendisse potenti.

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean in odio nibh. In posuere commodo enim eu feugiat. Sed vel magna non libero laoreet adipiscing. Nunc tincidunt volutpat neque, vel tincidunt augue consectetur faucibus. Vestibulum varius mauris pulvinar urna ullamcorper sit amet porttitor lectus tempor. Donec massa quam, porta non vestibulum sed, consectetur in eros. Cras quis metus non mauris condimentum rutrum vitae ut dui. Proin velit mi, dapibus sed commodo eu, faucibus vel leo. Nullam lorem turpis, pretium vehicula luctus nec, dapibus sit amet diam. Quisque sit amet velit mauris. Suspendisse mattis, est sed rhoncus laoreet, tellus risus hendrerit nulla, ut ullamcorper magna massa sit amet velit. Fusce nec magna nulla, sit amet condimentum lorem. Phasellus cursus consectetur egestas. Maecenas adipiscing nulla sed elit ornare tempor.

Cras tincidunt felis sed ante vulputate laoreet. Maecenas commodo mi eget nulla pharetra hendrerit. Curabitur rhoncus interdum ante, vitae tristique odio congue eu. Mauris sapien diam, mollis nec sodales vitae, blandit eget metus. Aliquam ipsum felis, vestibulum quis volutpat non, pretium quis nisl. In ac ligula purus, et vestibulum nulla. Ut et nisl tellus. Sed justo tortor, volutpat in tincidunt at, ornare vitae erat. Ut et nulla lectus. Suspendisse imperdiet purus et tortor ornare eget vulputate sapien faucibus. Fusce ullamcorper justo eu nibh luctus a accumsan lectus accumsan. Etiam ipsum neque, vestibulum sit amet vehicula sed, posuere ut mauris. Nulla facilisi. \ref[Vivamus]{Vivamus} est nibh, venenatis non venenatis sed, lobortis at tortor. Sed consequat consequat orci, vel egestas tortor facilisis in. Suspendisse aliquam mattis nulla ornare sodales.
\ref[haut]{D�but}.'
	),
	array
	(
	'R�f�rence',
	'ref,reference',

	'\ref[@Label]{@Texte}',

	'\item @Label est un identifiant unique cr�e � l\'aide de \lien[/Res/Typo/Aide/?b=label]{label} ;
	\item @Texte est un texte.',

	"La balise \b{ref} d�finit une r�f�rence vers une \lien[/Res/Typo/Aide/?b=label]{�tiquette}. L'�tiquette peut �tre cr�e plus tard dans le texte si besoin est.",

'\label[haut]{}Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ullamcorper, mauris nec euismod mollis, nunc ipsum aliquam urna, nec blandit ligula augue id nisi. Ut at lorem vitae quam dictum tempus. Nulla quis mattis justo. Nunc vehicula adipiscing elit et ultricies. Nulla id magna ipsum, vel pulvinar urna. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla volutpat sapien et libero tempor ac pellentesque lorem accumsan. Praesent lobortis dui sit amet elit pellentesque gravida. Integer eget odio et elit rhoncus ultricies. Suspendisse vestibulum commodo fringilla.

Curabitur accumsan aliquam ullamcorper. Cras in nisi purus. Nunc odio eros, interdum in aliquet tristique, tincidunt nec purus. Aenean lobortis, nisi sit amet euismod lacinia, nulla mauris congue libero, a vestibulum sem nisi id ligula. Curabitur pretium, quam ut dictum aliquet, nisl dolor tristique odio, non feugiat mi sem vitae nulla. \label[Vivamus]{Vivamus} porttitor ipsum mattis mi condimentum in porta nunc condimentum. Suspendisse facilisis justo blandit augue porta non pharetra dolor eleifend. Aenean nec nunc mauris, at ornare purus. Suspendisse molestie, eros sit amet tincidunt ornare, ipsum justo volutpat ante, nec sollicitudin risus enim id felis. Proin id purus eget ante tristique dignissim eu vel arcu. In sit amet egestas urna. Vestibulum leo erat, venenatis et fringilla non, auctor sed augue. Curabitur sed augue eget dolor consequat scelerisque quis hendrerit velit. Etiam tempor arcu id metus vestibulum in lobortis enim pellentesque. Suspendisse vel sodales neque. Phasellus fringilla viverra pretium. Curabitur id nulla arcu, non imperdiet ante. Vivamus velit nunc, laoreet a hendrerit nec, mollis eu dolor. Suspendisse potenti.

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean in odio nibh. In posuere commodo enim eu feugiat. Sed vel magna non libero laoreet adipiscing. Nunc tincidunt volutpat neque, vel tincidunt augue consectetur faucibus. Vestibulum varius mauris pulvinar urna ullamcorper sit amet porttitor lectus tempor. Donec massa quam, porta non vestibulum sed, consectetur in eros. Cras quis metus non mauris condimentum rutrum vitae ut dui. Proin velit mi, dapibus sed commodo eu, faucibus vel leo. Nullam lorem turpis, pretium vehicula luctus nec, dapibus sit amet diam. Quisque sit amet velit mauris. Suspendisse mattis, est sed rhoncus laoreet, tellus risus hendrerit nulla, ut ullamcorper magna massa sit amet velit. Fusce nec magna nulla, sit amet condimentum lorem. Phasellus cursus consectetur egestas. Maecenas adipiscing nulla sed elit ornare tempor.

Cras tincidunt felis sed ante vulputate laoreet. Maecenas commodo mi eget nulla pharetra hendrerit. Curabitur rhoncus interdum ante, vitae tristique odio congue eu. Mauris sapien diam, mollis nec sodales vitae, blandit eget metus. Aliquam ipsum felis, vestibulum quis volutpat non, pretium quis nisl. In ac ligula purus, et vestibulum nulla. Ut et nisl tellus. Sed justo tortor, volutpat in tincidunt at, ornare vitae erat. Ut et nulla lectus. Suspendisse imperdiet purus et tortor ornare eget vulputate sapien faucibus. Fusce ullamcorper justo eu nibh luctus a accumsan lectus accumsan. Etiam ipsum neque, vestibulum sit amet vehicula sed, posuere ut mauris. Nulla facilisi. \ref[Vivamus]{Vivamus} est nibh, venenatis non venenatis sed, lobortis at tortor. Sed consequat consequat orci, vel egestas tortor facilisis in. Suspendisse aliquam mattis nulla ornare sodales.
\ref[haut]{D�but}.'
	),
	array
	(
		'Math�matiques',
		'math�matiques, $, mathematiques',

		'$@Formule$',
		"\item @Formule est une formule math�matique au format LaTeX.",

		"Les dollars (\b{\$}) permettent de r�diger une formule math�matique au format LaTeX. Si la formule est assez simple, elle est affich�e au format HTML, sinon une image est g�n�r�e.
		Dans certains cas, il peut �tre pr�f�rable de rendre le LaTeX en image m�me si la formule est simple : il suffit alors de terminer la formule par un tilde (~) pour forcer la g�n�ration de l'image (cf. Exemples).",

		"La s�rie factorielle converge vers \$e^1$ : $\sum_{n=0}^{\infty} \\frac{1}{n!}\;=e^1$.
\item Le $^{140}_{54}Xe$ x�non est produit lors de la d�sint�gration de l'uranium.
\item Le $^{140}_{54}Xe~$ x�non est produit lors de la d�sint�gration de l'uranium."
	),
	array(
		'Item',
		'item,puce',

		'\item Premier �l�ment de liste
\item Second �l�ment de liste
\item ...',

		'Aucun param�tre.',

		"La balise \b{item} permet de cr�er tr�s facilement une liste ; elle est cependant plus limit�e que les environnement d�di�s itemize et enumerate. Un premier item cr�e une liste, qui continue tant que les d�buts de ligne sont des balises item. Si vous faites un saut de ligne, ou commencez une phrase sans item, la liste est ferm�e.
		Vous ne pouvez pas imbriquer plusieurs listes avec la m�thode des item, passez par itemize ou enumerate.",

		"\item \b{Premier} �l�ment de liste ;
\item \i{Second} �l�ment de liste ;
\item et ainsi de suite ad libitum..."
	),
	array(
		'Trait horizontal court',
		'Trait horizontal court, ~, trait court',

		'Texte
~
Nouveau paragraphe',

		'Aucun param�tre.',

		"La balise \b{~} ins�re un trait horizontal court, et ferme le paragraphe pr�c�dant le symbole. Pour commencer une phrase par un tilde, �chappez le avec un backslash. Pour un trait complet, voyez \lien[/Res/Typo/Aide/?b=~~~]{~~~}.",

		"...� ses g�n�raux.
~
Napol�on dit alors : ..."
	),
	array(
		'Trait horizontal long',
		'Trait horizontal long,~~~, trait long',

		'Texte
~~~
Nouveau paragraphe',

		'Aucun param�tre.',

		"La balise \b{~~~} ins�re un trait horizontal, et ferme le paragraphe pr�c�dant le symbole. Pour commencer une phrase par un tilde, �chappez le avec un backslash. Pour un trait court, voyez \lien[/Res/Typo/Aide/?b=~]{~}.",

		"...� ses g�n�raux.
~~~
Napol�on dit alors : ..."
	),
	array(
	'Caract�res accentu�s majuscules',
	'�,�,�,�,�,�,�',

	'� propos... �levons-nous vers l\'infini !',

	'Aucun param�tre.',

"Les majuscules doivent comporter les accents\\footnote{Contrairement � une vieille l�gende qui affirme le contraire, \lien[http://omnilogie.fr/55]{h�rit�e des temps o� les caract�res en plomb composant la police ne pouvait effectivement pas contenir l'accent.}}, mais l'acc�s � ces symboles est complexe sur un clavier Windows. Vous pouvez donc vous servir directement des symboles int�gr�s dans le typographe.",

	"�,�,�,�,�,�,�"
	),
	array(
	'Tirets cadratins et demi-cadratins',
	'&mdash;  Cadratin (auto), &ndash; Demi cadratin (auto) ',

	"&mdash; Et ceci &ndash; remarquez l'incise &ndash; est la preuve que vous avez tort.",

	'Aucun param�tre.',

	"Les tirets ont une histoire complexe. Notons simplement qu'un tiret qui fait la liaison entre deux mots est appel� trait d'union, ou tiret quart-cadratin. Un tiret d'incise - ceci est une incise - est l�g�rement plus grand, d'o� son nom de demi-cadratin. Enfin, le tiret cadratin (---) est utilis� pour les entames de dialogue. \i{Le Typographe} tente de mettre automatiquement en forme vos tirets (en d�tectant les espaces autour), mais vous pouvez le forcer � utiliser un certain type de tirets. Marquez deux \\verbatim{tirets (--)} pour un tiret demi-cadratin, concat�nez en trois pour le tiret \\verbatim{cadratin (---)}",

	"
- Le premier tiret est d�tect� comme un tiret d'entame et mis en forme
- Et cette incise - celle l� - est d�tect�e de m�me. Les noms compos�s ne posent pas de probl�me : mal-voyant. Vous n'avez qu'� comparer la largeur des tirets pour comprendre !"
	),
	array(
	'Guillemets � la fran�aise, guillemets � l\'anglaise',
	'� ... � (auto), &ldquo;...&rdquo; (auto)',

	'�&nbsp;Bonjour, capitaine&nbsp;�
&ldquo;Hello capitain&rdquo;',

	'Aucun param�tre.',

	"Les guillemets typographiques \\verbatim{(les guillemets droits : \")} sont automatiquement transform�s en guillemets � la fran�aise s�par�s par des espaces ins�cables. \i{Le Typographe} peut reconnaitre les imbrications de guillemets si celle-ci sont bien faites (espaces bien plac�s). Consultez les exemples pour plus d'informations.

	Les guillemets anglais sont utilis�es pour les imbrications de guillemets. Vous pouvez forcer leur utilisation \\verbatim{en entourant vos guillemets d'apostrophe : \"'du texte'\"} qui deviendra alors \"'du texte'\". Attention, s�mantiquement parlant, ces guillemets ne sont pas les m�mes que la balise \lien[?b=quote]{quote}. Si vous souhaitez citer une personne, c'est la balise quote qu'il faut utiliser.",

	'"Les guillemets typographiques deviennent des guillemets � la fran�aise."
"Je lui ai dit "imbrication de guillemets" mais je crois qu\'il n\'a pas compris."
Sachez, "\'jeune homme\'", que je ne tergiverse pas.'
	),
	array(
	'Espace ins�cable',
	'Espace ins�cable, non breaking space',

	'\nbsp;',

	'Aucun param�tre.',

	"Dans certaines situations, on peut souhaiter que le texte n'aille pas automatiquement � la ligne : par exemple, il est assez d�sagr�able de voir un point d'exclamation d�port� en d�but de ligne tout seul ! \i{Le Typographe} g�re automatiquement tous les probl�mes de ponctuation, mais dans certaines situations, vous aurez besoin d'ajouter vous m�me vos espaces ins�cables sur certains mots.",

	'&empty;'
	),
	array(
	'C�sure optionnelle',
	'C�sure optionnelle, soft hyphen',

	'\shy;',

	'Aucun param�tre.',

	"Le tiret de c�sure optionnelle vous permet d'indiquer au navigateur qu'il peut, si besoin est, couper le mot � cet endroit et le continuer sur la ligne d'apr�s. Cela peut �tre pratique quand votre texte est justifi�",

	"L'Hexakosioihexekontahexaphobie d�signe les hexa\shy;kosioi\shy;hexe\shy;konta\shy;hexa\shy;phobe.
hexa\shy;kosioi\shy;hexe\shy;konta\shy;hexa\shy;phobehexa\shy;kosioi\shy;hexe\shy;konta\shy;hexa\shy;phobehexa\shy;kosioi\shy;hexe\shy;konta\shy;hexa\shy;phobehexa\shy;kosioi\shy;hexe\shy;konta\shy;hexa\shy;phobehexa\shy;kosioi\shy;hexe\shy;konta\shy;hexa\shy;phobe."
	),
)

?>