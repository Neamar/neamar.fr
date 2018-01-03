<?php
$Titre="Environnement pour les textes";
$Description="Les environnements sont des structures complexes qui vous permettent de mettre en forme des blocs de texte.";

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
'Liste à puce',
 'begin, liste, puces, itemize',

 "\\begin{itemize}
 \li @PremierItem
 \li @SecondItem
 ...
 \li @NItem
 \\end{itemize}",
 "\item @PremierItem, @SecondItem et @NItem sont les élements composant la liste à puce.",

 "L'environnement \b{itemize} vous permet de mettre en forme des listes non numérotées. Pour les listes numérotées, consultez \lien[?b=enumerate]{enumerate}. L'utilisation d'itemize offre plus de souplesse que la balise \lien[?b=item]{item} : vous pouvez en effet mettre plusieurs paragraphes de texte dans chaque élement de la liste.

 \b{Notes sur les conventions} : Rappelons à toutes fins utiles que si vous souhaitez utiliser une liste, les règles de ponctuation continuent de s'appliquer. Veillez donc à finir vos éléments de liste par un point ou un point vigule ; s'il s'agit d'un point virgule, on ne met pas en majuscule l'item suivant.",

 "\\begin{itemize}
 \li Voilà un item de texte.

 \li Un second item. Notez que les sauts de ligne entre les \\i{li} sont facultatifs
 \li La preuve. \li Encore une autre preuve.

 \li Vous pouvez mettre un paragraphe :

 Nouveau Paragraphe.
 Dans ce cas là, comme pour tous les textes, la première lettre est colorée, et le paragraphe est automatiquement précédé d'un alinéa.

 \li Vous pouvez aussi mettre des item à l'intérieur d'une liste, le style des puces change alors :
 \item Nouvel item
 \item Second item imbriqué
 \item Et ainsi \i{ad lib.}.
\\end{itemize}"
 ),
 array
 (
 'Liste à numéros',
 'begin, liste, numéros, enumerate',

  "\\begin{enumerate}
  \li @PremierItem
  \li @SecondItem
  ...
  \li @NItem
  \\end{enumerate}",
  "\item @PremierItem, @SecondItem et @NItem sont les élements composant la liste numérotée.",

  "L'environnement \b{enumerate} vous permet de mettre en forme des listes numérotées. Pour les listes non numérotées, consultez \lien[?b=itemize]{itemize}.

  \b{Notes sur les conventions} : Rappelons à toutes fins utiles que si vous souhaitez utiliser une liste, les règles de ponctuation continuent de s'appliquer. Veillez donc à finir vos éléments de liste par un point ou un point vigule ; s'il s'agit d'un point virgule, on ne met pas en majuscule l'item suivant.

  \b{Avancé} : Vous pouvez utiliser un argument optionnel pour indiquer que la liste ne doit pas commencer à 1 : par exemple, \\verbatim{\\begin[5]{enumerate}} fera commencer la liste à 5.",

  "\\begin{enumerate}
  \li Voilà un premier item de texte.

  \li Un second item. Notez que les sauts de ligne entre les \\i{li} sont facultatifs
  \li La preuve. \li Encore une autre preuve.

  \li Vous pouvez mettre un paragraphe :

  Nouveau Paragraphe.
  Dans ce cas là, comme pour tous les textes, la première lettre est colorée, et le paragraphe est automatiquement précédé d'un alinéa.

  \li Vous pouvez aussi mettre des item à l'intérieur d'une liste, le style des puces change alors :
  \item Nouvel item
  \item Second item imbriqué
  \item Et ainsi \i{ad lib.}.
\\end{enumerate}"
  ),
  array
  (
  'Graphique',
  'begin, graphiques, charts, googleAPI, diagramme, figure',

   "\\begin{chart}
   Type:@Type
   Size:@Size
   Data:@Data
   Title:@Title
   Legend:@Legend;
   Axis:@Axis
   AxisLabel:@AxisLabel
   Color:@Color
\\end{chart}",
   "Vous n'êtes \b{pas} obligés d'utiliser tous ces paramètres. Seuls @Type, @Size et @Data sont nécessaires. Les autres paramètres sont facultatifs.
   \item @Type (alias de cht) décrit le type de graphique : lc, ls, lxy, bhs, bvs, bhg, ... tous les types supportés par l'API Google (cf. lien ci-dessous) peuventêtre utilisés. Les plus courants sont lc (ligne) et p3 (camembert) ;
   \item @Size (alias de chs) donne la taille du graphique sous la forme Largeur\b{x}Hauteur ;
   \item @Data (alias de chd) décrit les données à utiliser pour tracer les graphes. Ces données sont obligatoirement sous forme brute (chiffres séparés par une virgule).
   \item @Title (alias de chtt) décrit le titre du graphique ;
   \item @Legend (alias de chl) ;
   \item @Axis (alias de chxt) ;
   \item @AxisLabel (alias de chxl).

   Voyez \lien[http://code.google.com/apis/chart/]{la documentation Google} pour une plus ample description des possibilités.",

   "L'environnement \b{chart} vous permet de mettre en forme des données sous forme de graphique. Il s'agit d'un environnement extrêmement complet (et complexe), gérant plusieurs dizaines de paramètres. Il utilise l'API Google, dont vous trouverez une description détaillée sur \lien[http://code.google.com/apis/chart/]{cette page}.",

   "Qui parle dans Reflets d'Acide Épisode 1 ?
\\begin{chart}
	Type:p3
	Size:400x150
	Legend:Narrateur|Wrandrall|Enoriel|ZarakaI|Zehirmann|Guertrude|Roger|Inconnu|Tous
	Color:FFFFFF,FF0000,00FF00,0000FF,000000
	Data:26,26,13,11,10,5,2,2,2
\\end{chart}

Et que dit le narrateur ?
\\begin{chart}
	Type:lc
	Size:400x150
	Title:Narrateur
	Data:100,27,33,25,22,14,17,16,14,11,10,8,28
	Axis:x,y
	AxisLabel:0:|Ep.+1|Ep.+2|Ep.+3|Ep.+4|Ep.+5|Ep.+6|Ep.+7|Ep.+8|Ep.+9|Ep.+10|Ep.+11|Ep.+12|Ep.+13|1:||13%|26%
	Color:ABCDFF
\\end{chart}

Notez bien que vous pouvez aussi utiliser directement les paramètres Google, la seule contrainte étant d'utiliser un encodage brut (type \i{t}).
\\begin{chart}
Type:t
Size:440x200
Data:0
chtm:world
chf:bg,s,EAF7FE
\\end{chart}
"
),
array
(
	'Tableaux',
	'begin, tableaux, tabular, cellules',

"Utilisation simple :
\\begin{tabular}
@Cellule & @Cellule & @Cellule \\\\
@Cellule & @Cellule & @Cellule \\\\
@Cellule & @Cellule & @Cellule
\\end{tabular}

<hr />
Utilisation avancée :

\\begin[@Classes]{tabular}
\\caption @TitreTableau
\\head
	@Titre & @Titre & @Titre
\\body
	@Cellule & @Cellule & @Cellule \\\\
	@Cellule & @Cellule & @Cellule \\\\
	@Cellule & @Cellule & @Cellule
\\foot
	@Fin & @Fin & @Fin
\\end{tabular}",
	"\item @Cellule contient la cellule courante. @Cellule peut être un simple mot, une phrase avec ou sans balises, voire un environnement complexe. Vous pouvez utiliser le caractère & à l'intérieur de votre texte en les précédant d'un backslash : \\;
	\item @Classes (facultatif) permet de spécifier une classe CSS à appliquer à chaque cellule (les classes doivent être séparées par un pipe). Par exemple, ss|ms mettra en \lien[?b=sans-serif]{sans serif} la première cellule de chaque ligne, et en \lien[?b=monospace]{monospace} la seconde cellule. Les autres cellules conserveront la mise en forme standard.
	\item @TitreTableau (facultatif) permet de spécifier le titre du tableau.
	\item @Titre (facultatif) permet de spécifier un en-tête de colonnes.
	\item @Fin (facultatif) permet de spécifier un rappel des en-tête de colonnes.",

	"L'environnement \b{tabular} vous permet de mettre en forme des données à l'aide d'un tableau.

	Il en existe deux formes, une version simple et complexe.
	Tous les arguments de la version complexe sont indépendants : la version simple correspond à une version complexe pour laquelle tous les paramètres ont été omis.
	L'attribut \big{@Classes} ne devrait pas être utilisé par les rédacteurs de contenu, et être reservé pour les webmasters.",

	"\subsubsection{Exemple simple d'utilisation :}
\\begin{tabular}
Du texte & Une autre colonne \\\\
Une nouvelle ligne & Deuxième ligne, deuxième colonne \\\\
\i{etc.} & ...
\\end{tabular}

\subsubsection{Un tableau plus avancé :}
Les tabulations sont optionnelles. L'ordre des paramètres n'est pas important (caption, head et foot ou foot, head, body et caption).
\\begin{tabular}
	\\caption Titre du tableau
	\\head
		Nom & Âge
	\\body
		Stanislas & 40 \\\\
		Romain & 20 \\\\
		Lucie & 18 \\\\
		Benoît & 21
	\\foot
		Nom & Âge
\\end{tabular}

\subsubsection{Exemple d'utilisation des classes:}
\\begin[ss|centre]{tabular}
La première cellule de chaque ligne est en sans-serif & La seconde est centrée. \\\\
Échappez l'esperluette pour l'utiliser : \\& & Vous pouvez avoir autant & de colonnes & que nécessaires \\\\
Toutes les lignes n'ont pas obligatoirement... & ... le même nombre de cellules. & Mais dans ce cas là, les bordures seront mal tracées. \\\\
Vous pouvez utiliser des balises complexes
\\item Comme des élements de liste
\\item \i{etc.} & Ou \i{de la mise en forme} & Voire des maths : $\\frac{125}{25}=25=5^2$\\\\
\\end{tabular}"
),
 array
 (
 'Quizz',
 'begin, quizz, questions, réponses',

  "\\begin{quizz}
\question @Question
\answer @Reponse

\question @Question
\answer @Reponse
\\end{quizz}",
  "\item @Question est une question du quizz.
  \item @Reponse est la réponse à la balise \question précédente.",

  "L'environnement \b{quizz} vous permet de mettre un quizz interactif dans vos pages.",

  "\\begin{quizz}
  \question Quel est l'os le plus long du corps humain ?
  \answer Le fémur

  \question Où se trouve l'humérus ?
  \answer Dans le bras

  \question Où se situe la rotule ?
  \answer Dans le genou

  \question Comment se nomment les os du pied ?
  \answer Tarse, métatarse, phalange
  \\end{quizz}"
  ),
  array
  (
  'Citations de plusieurs lignes',
  'begin, quote, citation',

   "\\begin[@Auteur]{quote}
@Citation
\\end{quote}",
   "\item @Auteur est l'auteur de la citation. Son utilisation n'est pas obligatoire, vous pouvez laisser ce paramètre vide (enlevez les crochets dans ce cas là) ;
   \item @Citation est la citation à mettre en forme.",

   "L'environnement \b{quote} vous permet de mettre une citation de plusieurs phrases.",

   "\\begin[Le Petit Chaperon rouge]{quote}
   Le Loup lui cria en adoucissant un peu sa voix :
   \"Tire la chevillette, la bobinette cherra\".
   Le Petit Chaperon rouge tira la chevillette, et la porte s'ouvrit.
\\end{quote}"
   ),
   array
   (
   'Résumé',
   'begin, abstract, résumé, chapeau',

	"\\begin{abstract}
@Abstrait
\\end{abstract}",
	"\item @Abstrait est un résumé en quelques lignes de votre article.",

	"L'environnement \b{abstract} vous permet de placer un chapeau en haut de vos textes ; un petit résumé de quelques lignes qui décrit ce dont vous allez parler.",

	"\\begin{abstract}
Dans cet article, nous étudierons différentes formes de vie cellulaire non reproductibles par la méthode \"in\".
Différents points de vue seront abordés, ainis que la vision de Jean Marie du Mollay.
\\end{abstract}"
	),
	array
	(
	'Code non mis en forme',
	'begin, code, verbatim',

	 "\\begin{verbatim}
	 @Texte
\\end{verbatim}",
	 "\item @Texte est un texte qui ne sera pas mis en forme et affiché sous forme sans-serif.",

	 "L'environnement \b{verbatim} vous permet de placer du code informatique dans vos articles, sans que celui là soit mis en forme (tirets, espaces devant la ponctuation). Voir aussi  \lien[?b=code]{code} qui colorie les codes sources.",

	 '\\begin{verbatim}
Private Declare Function GetKeyState Lib "user32" (ByVal nVirtKey As Long) As Integer
Private Declare Function GetCursorPos Lib "user32" (lpPoint As Point) As Long
Private Declare Function ScreenToClient Lib "user32" (ByVal hwnd As Long, lpPoint As Point) As Long
Private Declare Function GetTickCount Lib "kernel32" () As Long
Private Declare Function SetPriorityClass Lib "kernel32" (ByVal hProcess As Long, ByVal dwPriorityClass As Long) As Long
Private Declare Function GetCurrentProcess Lib "kernel32" () As Long
Private Declare Function TextOut Lib "gdi32" Alias "TextOutA" (ByVal hdc As Long, ByVal x As Long, ByVal y As Long, ByVal lpString As String, ByVal nCount As Long) As Long
Private Declare Function SetPixelV Lib "gdi32" (ByVal hdc As Long, ByVal x As Long, ByVal y As Long, ByVal crColor As Long) As Long

\\end{verbatim}'
	 ),
	 array
	 (
	 'Mathématiques en bloc',
	  'mathématiques, bloc, $$',

	  "$$ @Math $$",
	  "\item @Math est une expression mathématique au format LaTeX.",

	  "Les doubles dollars (\b{\$\$}) permettent d'écrire tout un paragraphe de texte en mode mathématique. Le résultat obtenu est centré.",

	  "En analyse, la série de Taylor se définit pour une fonction \$f\$ indéfiniment dérivable d'une variable réelle ou complexe et en un point \$a\$ au voisinage duquel la fonction est définie. La série de Taylor de \$f\$ en \$a\$ est la série entière suivante :

\$\$ f(a)+\\frac{f'(a)}{1!}(x-a)+\\frac{f''(a)}{2!}(x-a)^2+\\frac{f^{(3)}(a)}{3!}(x-a)^3+\\cdots \$\$
 (Source : Wikipedia)"
	  ),
	  array
	  (
	  'Poésie',
	   'verse, vers, poésie',

	   "\\begin{verse}
@Vers
\\end{verse}",
	   "\item @Vers est un ensemble de phrases représentant la poésie.",

	   "L'environnement \b{verse} permet de mettre en forme de la poésie dans vos textes.",

	   "
\\begin{verse}
Je fus le noir souci des orgues infernales :
Elles hurlaient parfois et roucoulaient toujours.
Dites-moi la beauté des ombres sépulcrales
Pour que leur fils revienne en leurs froides amours
\\end{verse}
	   "
	   ),
	   array
	   (
	   'Indentation',
		'indented, indentation',

		"\\begin{indented}
@TexteIndente
\\end{indented}",
		"\item @TexteIndente est un ensemble de phrases contenant des tabulations qui seront rendues telles quelles.",

		"Par défaut, les tabulations dans le texte ne sont pas rendues à l'écran pour clarifier votre code. Si vous souhaiter imposer une indentation particulière, vous pouvez utiliser l'environnement \i{indented}.",

		"
\\begin{indented}
Bien sûr mille raisons d'expliquer le nom de « Mer Blanche »
Et depuis longtemps sur ce nom beaucoup se penchent.

Mais de toutes et la plus poétique
Est celle retenue par les encyclopédiques :

Les Ottomans installés à partir du \century{XI} siècle en Anatolie
Auraient donné le nom, à ce que l'on dit.

Les points cardinaux, par eux et par des couleurs sont désignés:
	\i{Kara} ou noir désigne le Nord bien nommé,
		\i{Ak} ou blanc désigne le sud,
			L'Ouest désigné par le rouge ou \i{Kyzyl},
				Est désigné par le vert ou \i{Yeshil}.
\\end{indented}
(via \l[https://omnilogie.fr/5K]{Mers blanche, rouge ou noire})
		"
		),
	   array
	   (
	   'Colonnes',
		'colonnes, column',

		"\\begin[%NbColonnes]{column}
@Texte
\\end{column}",
		"\item @NbColonnes est le nombre de colonnes à mettre en place ;
		\item @Texte est le texte qui doit être placé dans les colonnes.",

		"L'environnement \b{column} permet une mise en forme \i{en colonnes}, comme dans les magazines. Cette fonctionalité n'est pas supportée par tous les navigateurs (la spécification officielle est encore en brouillon) : sous Internet Explorer et Opera, le contenu s'affichera donc sans modifications. Les colonnes sont balancées au maximum (le texte se répartit au mieux). L'ensemble des balises reste utilisable dans cet environnement.",

		"
\\begin[3]{column}
\section{Lorem Ipsum}
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris at vehicula ligula. Proin a nisi purus, in molestie nisl. Nulla sed massa lacus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras id augue id augue fringilla consequat non sed metus. Donec ac tortor vel purus tincidunt pretium quis eget dui. Integer massa leo, congue eget commodo eu, rhoncus nec risus. Mauris eros magna, fringilla a tristique nec, viverra vel elit. Phasellus laoreet, nisl ac mattis consequat, libero nunc fringilla risus, nec laoreet orci metus vitae nisl. Etiam vel ante enim.

Curabitur volutpat enim sed turpis fermentum a luctus libero varius. Nullam pellentesque dignissim sodales. In sagittis eleifend augue non pulvinar. Vivamus sollicitudin tellus vel dui egestas sagittis. In hac habitasse platea dictumst. Nullam consequat fringilla fringilla. Duis commodo augue ac purus ultrices eu dictum dui hendrerit. Integer ac neque massa, at suscipit leo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam egestas elementum sem nec facilisis.

Ut aliquet, velit vitae semper faucibus, risus enim aliquet nibh, vel lacinia quam ipsum et odio. Morbi ullamcorper neque lacus. Nullam a magna tortor. Nulla facilisi. Duis vel nulla vel ante vulputate varius in eu mauris. Nunc sodales luctus adipiscing. Suspendisse mi purus, rhoncus a imperdiet sit amet, gravida sit amet eros. Aliquam cursus consequat nulla et blandit. Vestibulum dignissim faucibus convallis. Nam sit amet nunc erat. Aenean laoreet ligula nec tortor fermentum ultrices. Vestibulum luctus malesuada est non lobortis. Etiam metus turpis, vulputate ac auctor in, molestie eu arcu. Morbi interdum venenatis justo, id bibendum leo feugiat eget. Cras nec ligula erat, eget malesuada diam.

\section{Donec dignissim}
Donec dignissim auctor ante, sit amet scelerisque risus eleifend eu. Etiam egestas accumsan accumsan. Vestibulum sollicitudin accumsan nisl eu interdum. Quisque feugiat fringilla ante et condimentum. Aliquam erat volutpat. Proin dolor erat, convallis vel tincidunt tristique, euismod et metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; \b{Integer} a ipsum vitae eros euismod facilisis vitae sit amet est. Donec eget nibh mi, ut dignissim sapien. Fusce eleifend consequat tortor, sit amet lobortis erat adipiscing sit amet. Nam bibendum, erat ac euismod pellentesque, odio massa tincidunt libero, sit amet semper justo purus feugiat enim. Aliquam nec odio sed odio varius consectetur. Phasellus gravida sapien vitae elit iaculis non sagittis augue dictum. Nulla malesuada velit non risus egestas eget viverra leo rhoncus. Mauris in turpis dui, id varius nunc. Nunc imperdiet adipiscing nisl non tempus. Donec mi quam, volutpat ac cursus consectetur, volutpat at quam. Ut fringilla ante ut eros rutrum nec egestas mauris aliquam.

~

Vestibulum non sem magna, id pulvinar felis. Donec sed vestibulum urna. Nullam id orci tortor, id ultricies eros. Nulla tincidunt est ut nibh porta tempor non ac nulla. Duis fermentum magna massa. Curabitur congue sodales ligula et dapibus. Sed sit amet felis justo, sed tincidunt augue. In vel risus ipsum. Proin eget nulla a odio dictum mattis. Quisque vitae aliquam leo. Pellentesque risus neque, rutrum vel commodo non, viverra ac libero. Nunc ut tortor velit. Aliquam quis sapien quis nibh vulputate ornare id quis nibh. Pellentesque enim sem, aliquam sed molestie quis, tempor vel nisi. Duis pharetra justo sit amet arcu egestas consectetur. Mauris venenatis vulputate adipiscing. Nunc tempor purus eget libero porttitor et lobortis arcu consectetur. Nam vel sapien enim, at scelerisque libero. Suspendisse potenti. Proin viverra sapien nec ante mollis cursus nec at mauris.
\\end{column}",
		),
		array
		(
		'Questionnaire à choix multiple',
		 'qcm, questionnaire',

		 "\\begin{qcm}
\question @Question
\answer Réponse fausse
\answer Réponse fausse
...
\answer[right] Réponse juste
\\end{qcm}",
		 "\item @Question est la question ;
		 \item La bonne réponse doit être précédée de \\textms{[right]}",

		 "L'environnement \b{qcm} permet de créer un questionnaire à choix multiple interactif. Le nombre de questions n'est pas limité, et le nombre de réponse par question n'est pas limité non plus - il n'est même pas obligé d'être constant : la question 1 peut avoir 5 propositions, et la question 2 deux choix. Une seule réponse peut être correcte.

		 La note finale est ramenée sur 20 automatiquement, elle est calculée à partir de Javascript (pas de charge serveur, mais pas de possibilité de logger les réponses).

		 Sur les navigateurs modernes, le  QCM s'affichera sur deux colonnes.",
		 "
\\begin{qcm}

\question Combien vaut $\sqrt{6+3}$ ?
\answer[right] $3$
\answer $9$
\answer $\pi$

\question Le point virgule doit être suivi d'une espace insécable :
\answer Vrai
\answer[right] Faux

\question Quel est le plus long mot (selon les dictionnaires usuels) de la langue française :
\answer hexakosioihexekontahexaphobie
\answer glycosylphosphatidylinositol
\answer kalepomentaneïnomineïologie
\answer[right] anticonstitutionnellement
\answer apopathodiaphulatophobie
\answer déconstitutionnalisassions
\answer Hippopotomonstrosesquippedaliophobie
\\end{qcm}
		 "
		 ),
		 array
		 (
		 'Code',
		  'begin, code, geshi',

		  "\\begin[@Lang]{code}
	@CodeSource
\\end{code}",
		  "\item @Lang est le mot-clé caractérisant le langage dans l'implémentation Geshi (exemple : HTML4, PHP, AS3)
			\item @CodeSource est le texte à mettre en forme.",

		  "L'environnement \b{code} vous permet de placer du code informatique colorié dans vos articles, sans qu'il soit mis en forme (tirets, espaces devant la ponctuation). Voir aussi  \lien[?b=verbatim]{verbatim} qui ne colorie pas les codes sources.",

		  'Code Visual Basic :
\\begin[vb]{code}
Private Declare Function GetKeyState Lib "user32" (ByVal nVirtKey As Long) As Integer
Private Declare Function GetCursorPos Lib "user32" (lpPoint As Point) As Long
Private Declare Function ScreenToClient Lib "user32" (ByVal hwnd As Long, lpPoint As Point) As Long
Private Declare Function GetTickCount Lib "kernel32" () As Long
Private Declare Function SetPriorityClass Lib "kernel32" (ByVal hProcess As Long, ByVal dwPriorityClass As Long) As Long
Private Declare Function GetCurrentProcess Lib "kernel32" () As Long
Private Declare Function TextOut Lib "gdi32" Alias "TextOutA" (ByVal hdc As Long, ByVal x As Long, ByVal y As Long, ByVal lpString As String, ByVal nCount As Long) As Long
Private Declare Function SetPixelV Lib "gdi32" (ByVal hdc As Long, ByVal x As Long, ByVal y As Long, ByVal crColor As Long) As Long
\\end{code}

Code PHP :
\\begin[php]{code}
<?php
	echo "Hello World ";
?>
\\end{code}'
		  ),
		  array
		 (
		 'Dialogue',
		  'begin, dialogue, dialog',

		  "\\begin{dialog}
	@Auteur : @Texte
	@Auteur2 : @Texte2
	...
\\end{dialog}",
		  "\item @Auteur, @Auteur2 sont les personnes qui s'expriment dans le dialogue.
		  \item @Texte, @Texte2 sont les phrases prononcées.",

		  "L'environnement \b{dialog} vous permet d'insérer un dialogue dans votre texte. Il se veut naturel et sépare texte et auteurs par un symbole deux points.
		  Un texte peut s'étendre sur plusieurs lignes, attention cependant s'il contient un symbole \":\" le début de la phrase sera considéré comme un auteur. Pour éviter ce comportement, échappez le deux points en le précédant d'un antislash (voir exemple).

		  Note sur la sémantique : HTML ne définit pas de structure pour les dialogues. En conséquence, le texte est placé dans un div et les auteurs dans une classe auteur. Le Typographe ne style pas ces balises.",

		  '\\begin{dialog}
améthyst : Ont à tous un prof qui nous à rien apprit...
Midori : Quelque chose me dit que tu parles de ta/ton prof de français...
améthyst : Coment tu sait ?
Midori : L\'intuition...
\\end{dialog}
Note : le style de l\'exemple peut varier selon le site où est intégré le Typographe.'
		  ),
 );
 ?>
