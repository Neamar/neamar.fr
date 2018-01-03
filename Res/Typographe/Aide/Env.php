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
'Liste � puce',
 'begin, liste, puces, itemize',

 "\\begin{itemize}
 \li @PremierItem
 \li @SecondItem
 ...
 \li @NItem
 \\end{itemize}",
 "\item @PremierItem, @SecondItem et @NItem sont les �lements composant la liste � puce.",

 "L'environnement \b{itemize} vous permet de mettre en forme des listes non num�rot�es. Pour les listes num�rot�es, consultez \lien[?b=enumerate]{enumerate}. L'utilisation d'itemize offre plus de souplesse que la balise \lien[?b=item]{item} : vous pouvez en effet mettre plusieurs paragraphes de texte dans chaque �lement de la liste.

 \b{Notes sur les conventions} : Rappelons � toutes fins utiles que si vous souhaitez utiliser une liste, les r�gles de ponctuation continuent de s'appliquer. Veillez donc � finir vos �l�ments de liste par un point ou un point vigule ; s'il s'agit d'un point virgule, on ne met pas en majuscule l'item suivant.",

 "\\begin{itemize}
 \li Voil� un item de texte.

 \li Un second item. Notez que les sauts de ligne entre les \\i{li} sont facultatifs
 \li La preuve. \li Encore une autre preuve.

 \li Vous pouvez mettre un paragraphe :

 Nouveau Paragraphe.
 Dans ce cas l�, comme pour tous les textes, la premi�re lettre est color�e, et le paragraphe est automatiquement pr�c�d� d'un alin�a.

 \li Vous pouvez aussi mettre des item � l'int�rieur d'une liste, le style des puces change alors :
 \item Nouvel item
 \item Second item imbriqu�
 \item Et ainsi \i{ad lib.}.
\\end{itemize}"
 ),
 array
 (
 'Liste � num�ros',
 'begin, liste, num�ros, enumerate',

  "\\begin{enumerate}
  \li @PremierItem
  \li @SecondItem
  ...
  \li @NItem
  \\end{enumerate}",
  "\item @PremierItem, @SecondItem et @NItem sont les �lements composant la liste num�rot�e.",

  "L'environnement \b{enumerate} vous permet de mettre en forme des listes num�rot�es. Pour les listes non num�rot�es, consultez \lien[?b=itemize]{itemize}.

  \b{Notes sur les conventions} : Rappelons � toutes fins utiles que si vous souhaitez utiliser une liste, les r�gles de ponctuation continuent de s'appliquer. Veillez donc � finir vos �l�ments de liste par un point ou un point vigule ; s'il s'agit d'un point virgule, on ne met pas en majuscule l'item suivant.

  \b{Avanc�} : Vous pouvez utiliser un argument optionnel pour indiquer que la liste ne doit pas commencer � 1 : par exemple, \\verbatim{\\begin[5]{enumerate}} fera commencer la liste � 5.",

  "\\begin{enumerate}
  \li Voil� un premier item de texte.

  \li Un second item. Notez que les sauts de ligne entre les \\i{li} sont facultatifs
  \li La preuve. \li Encore une autre preuve.

  \li Vous pouvez mettre un paragraphe :

  Nouveau Paragraphe.
  Dans ce cas l�, comme pour tous les textes, la premi�re lettre est color�e, et le paragraphe est automatiquement pr�c�d� d'un alin�a.

  \li Vous pouvez aussi mettre des item � l'int�rieur d'une liste, le style des puces change alors :
  \item Nouvel item
  \item Second item imbriqu�
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
   "Vous n'�tes \b{pas} oblig�s d'utiliser tous ces param�tres. Seuls @Type, @Size et @Data sont n�cessaires. Les autres param�tres sont facultatifs.
   \item @Type (alias de cht) d�crit le type de graphique : lc, ls, lxy, bhs, bvs, bhg, ... tous les types support�s par l'API Google (cf. lien ci-dessous) peuvent�tre utilis�s. Les plus courants sont lc (ligne) et p3 (camembert) ;
   \item @Size (alias de chs) donne la taille du graphique sous la forme Largeur\b{x}Hauteur ;
   \item @Data (alias de chd) d�crit les donn�es � utiliser pour tracer les graphes. Ces donn�es sont obligatoirement sous forme brute (chiffres s�par�s par une virgule).
   \item @Title (alias de chtt) d�crit le titre du graphique ;
   \item @Legend (alias de chl) ;
   \item @Axis (alias de chxt) ;
   \item @AxisLabel (alias de chxl).

   Voyez \lien[http://code.google.com/apis/chart/]{la documentation Google} pour une plus ample description des possibilit�s.",

   "L'environnement \b{chart} vous permet de mettre en forme des donn�es sous forme de graphique. Il s'agit d'un environnement extr�mement complet (et complexe), g�rant plusieurs dizaines de param�tres. Il utilise l'API Google, dont vous trouverez une description d�taill�e sur \lien[http://code.google.com/apis/chart/]{cette page}.",

   "Qui parle dans Reflets d'Acide �pisode 1 ?
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

Notez bien que vous pouvez aussi utiliser directement les param�tres Google, la seule contrainte �tant d'utiliser un encodage brut (type \i{t}).
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
Utilisation avanc�e :

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
	"\item @Cellule contient la cellule courante. @Cellule peut �tre un simple mot, une phrase avec ou sans balises, voire un environnement complexe. Vous pouvez utiliser le caract�re & � l'int�rieur de votre texte en les pr�c�dant d'un backslash : \\;
	\item @Classes (facultatif) permet de sp�cifier une classe CSS � appliquer � chaque cellule (les classes doivent �tre s�par�es par un pipe). Par exemple, ss|ms mettra en \lien[?b=sans-serif]{sans serif} la premi�re cellule de chaque ligne, et en \lien[?b=monospace]{monospace} la seconde cellule. Les autres cellules conserveront la mise en forme standard.
	\item @TitreTableau (facultatif) permet de sp�cifier le titre du tableau.
	\item @Titre (facultatif) permet de sp�cifier un en-t�te de colonnes.
	\item @Fin (facultatif) permet de sp�cifier un rappel des en-t�te de colonnes.",

	"L'environnement \b{tabular} vous permet de mettre en forme des donn�es � l'aide d'un tableau.

	Il en existe deux formes, une version simple et complexe.
	Tous les arguments de la version complexe sont ind�pendants : la version simple correspond � une version complexe pour laquelle tous les param�tres ont �t� omis.
	L'attribut \big{@Classes} ne devrait pas �tre utilis� par les r�dacteurs de contenu, et �tre reserv� pour les webmasters.",

	"\subsubsection{Exemple simple d'utilisation :}
\\begin{tabular}
Du texte & Une autre colonne \\\\
Une nouvelle ligne & Deuxi�me ligne, deuxi�me colonne \\\\
\i{etc.} & ...
\\end{tabular}

\subsubsection{Un tableau plus avanc� :}
Les tabulations sont optionnelles. L'ordre des param�tres n'est pas important (caption, head et foot ou foot, head, body et caption).
\\begin{tabular}
	\\caption Titre du tableau
	\\head
		Nom & �ge
	\\body
		Stanislas & 40 \\\\
		Romain & 20 \\\\
		Lucie & 18 \\\\
		Beno�t & 21
	\\foot
		Nom & �ge
\\end{tabular}

\subsubsection{Exemple d'utilisation des classes:}
\\begin[ss|centre]{tabular}
La premi�re cellule de chaque ligne est en sans-serif & La seconde est centr�e. \\\\
�chappez l'esperluette pour l'utiliser : \\& & Vous pouvez avoir autant & de colonnes & que n�cessaires \\\\
Toutes les lignes n'ont pas obligatoirement... & ... le m�me nombre de cellules. & Mais dans ce cas l�, les bordures seront mal trac�es. \\\\
Vous pouvez utiliser des balises complexes
\\item Comme des �lements de liste
\\item \i{etc.} & Ou \i{de la mise en forme} & Voire des maths : $\\frac{125}{25}=25=5^2$\\\\
\\end{tabular}"
),
 array
 (
 'Quizz',
 'begin, quizz, questions, r�ponses',

  "\\begin{quizz}
\question @Question
\answer @Reponse

\question @Question
\answer @Reponse
\\end{quizz}",
  "\item @Question est une question du quizz.
  \item @Reponse est la r�ponse � la balise \question pr�c�dente.",

  "L'environnement \b{quizz} vous permet de mettre un quizz interactif dans vos pages.",

  "\\begin{quizz}
  \question Quel est l'os le plus long du corps humain ?
  \answer Le f�mur

  \question O� se trouve l'hum�rus ?
  \answer Dans le bras

  \question O� se situe la rotule ?
  \answer Dans le genou

  \question Comment se nomment les os du pied ?
  \answer Tarse, m�tatarse, phalange
  \\end{quizz}"
  ),
  array
  (
  'Citations de plusieurs lignes',
  'begin, quote, citation',

   "\\begin[@Auteur]{quote}
@Citation
\\end{quote}",
   "\item @Auteur est l'auteur de la citation. Son utilisation n'est pas obligatoire, vous pouvez laisser ce param�tre vide (enlevez les crochets dans ce cas l�) ;
   \item @Citation est la citation � mettre en forme.",

   "L'environnement \b{quote} vous permet de mettre une citation de plusieurs phrases.",

   "\\begin[Le Petit Chaperon rouge]{quote}
   Le Loup lui cria en adoucissant un peu sa voix :
   \"Tire la chevillette, la bobinette cherra\".
   Le Petit Chaperon rouge tira la chevillette, et la porte s'ouvrit.
\\end{quote}"
   ),
   array
   (
   'R�sum�',
   'begin, abstract, r�sum�, chapeau',

	"\\begin{abstract}
@Abstrait
\\end{abstract}",
	"\item @Abstrait est un r�sum� en quelques lignes de votre article.",

	"L'environnement \b{abstract} vous permet de placer un chapeau en haut de vos textes ; un petit r�sum� de quelques lignes qui d�crit ce dont vous allez parler.",

	"\\begin{abstract}
Dans cet article, nous �tudierons diff�rentes formes de vie cellulaire non reproductibles par la m�thode \"in\".
Diff�rents points de vue seront abord�s, ainis que la vision de Jean Marie du Mollay.
\\end{abstract}"
	),
	array
	(
	'Code non mis en forme',
	'begin, code, verbatim',

	 "\\begin{verbatim}
	 @Texte
\\end{verbatim}",
	 "\item @Texte est un texte qui ne sera pas mis en forme et affich� sous forme sans-serif.",

	 "L'environnement \b{verbatim} vous permet de placer du code informatique dans vos articles, sans que celui l� soit mis en forme (tirets, espaces devant la ponctuation). Voir aussi  \lien[?b=code]{code} qui colorie les codes sources.",

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
	 'Math�matiques en bloc',
	  'math�matiques, bloc, $$',

	  "$$ @Math $$",
	  "\item @Math est une expression math�matique au format LaTeX.",

	  "Les doubles dollars (\b{\$\$}) permettent d'�crire tout un paragraphe de texte en mode math�matique. Le r�sultat obtenu est centr�.",

	  "En analyse, la s�rie de Taylor se d�finit pour une fonction \$f\$ ind�finiment d�rivable d'une variable r�elle ou complexe et en un point \$a\$ au voisinage duquel la fonction est d�finie. La s�rie de Taylor de \$f\$ en \$a\$ est la s�rie enti�re suivante :

\$\$ f(a)+\\frac{f'(a)}{1!}(x-a)+\\frac{f''(a)}{2!}(x-a)^2+\\frac{f^{(3)}(a)}{3!}(x-a)^3+\\cdots \$\$
 (Source : Wikipedia)"
	  ),
	  array
	  (
	  'Po�sie',
	   'verse, vers, po�sie',

	   "\\begin{verse}
@Vers
\\end{verse}",
	   "\item @Vers est un ensemble de phrases repr�sentant la po�sie.",

	   "L'environnement \b{verse} permet de mettre en forme de la po�sie dans vos textes.",

	   "
\\begin{verse}
Je fus le noir souci des orgues infernales :
Elles hurlaient parfois et roucoulaient toujours.
Dites-moi la beaut� des ombres s�pulcrales
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

		"Par d�faut, les tabulations dans le texte ne sont pas rendues � l'�cran pour clarifier votre code. Si vous souhaiter imposer une indentation particuli�re, vous pouvez utiliser l'environnement \i{indented}.",

		"
\\begin{indented}
Bien s�r mille raisons d'expliquer le nom de � Mer Blanche �
Et depuis longtemps sur ce nom beaucoup se penchent.

Mais de toutes et la plus po�tique
Est celle retenue par les encyclop�diques :

Les Ottomans install�s � partir du \century{XI} si�cle en Anatolie
Auraient donn� le nom, � ce que l'on dit.

Les points cardinaux, par eux et par des couleurs sont d�sign�s:
	\i{Kara} ou noir d�signe le Nord bien nomm�,
		\i{Ak} ou blanc d�signe le sud,
			L'Ouest d�sign� par le rouge ou \i{Kyzyl},
				Est d�sign� par le vert ou \i{Yeshil}.
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
		"\item @NbColonnes est le nombre de colonnes � mettre en place ;
		\item @Texte est le texte qui doit �tre plac� dans les colonnes.",

		"L'environnement \b{column} permet une mise en forme \i{en colonnes}, comme dans les magazines. Cette fonctionalit� n'est pas support�e par tous les navigateurs (la sp�cification officielle est encore en brouillon) : sous Internet Explorer et Opera, le contenu s'affichera donc sans modifications. Les colonnes sont balanc�es au maximum (le texte se r�partit au mieux). L'ensemble des balises reste utilisable dans cet environnement.",

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
		'Questionnaire � choix multiple',
		 'qcm, questionnaire',

		 "\\begin{qcm}
\question @Question
\answer R�ponse fausse
\answer R�ponse fausse
...
\answer[right] R�ponse juste
\\end{qcm}",
		 "\item @Question est la question ;
		 \item La bonne r�ponse doit �tre pr�c�d�e de \\textms{[right]}",

		 "L'environnement \b{qcm} permet de cr�er un questionnaire � choix multiple interactif. Le nombre de questions n'est pas limit�, et le nombre de r�ponse par question n'est pas limit� non plus - il n'est m�me pas oblig� d'�tre constant : la question 1 peut avoir 5 propositions, et la question 2 deux choix. Une seule r�ponse peut �tre correcte.

		 La note finale est ramen�e sur 20 automatiquement, elle est calcul�e � partir de Javascript (pas de charge serveur, mais pas de possibilit� de logger les r�ponses).

		 Sur les navigateurs modernes, le  QCM s'affichera sur deux colonnes.",
		 "
\\begin{qcm}

\question Combien vaut $\sqrt{6+3}$ ?
\answer[right] $3$
\answer $9$
\answer $\pi$

\question Le point virgule doit �tre suivi d'une espace ins�cable :
\answer Vrai
\answer[right] Faux

\question Quel est le plus long mot (selon les dictionnaires usuels) de la langue fran�aise :
\answer hexakosioihexekontahexaphobie
\answer glycosylphosphatidylinositol
\answer kalepomentane�nomine�ologie
\answer[right] anticonstitutionnellement
\answer apopathodiaphulatophobie
\answer d�constitutionnalisassions
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
		  "\item @Lang est le mot-cl� caract�risant le langage dans l'impl�mentation Geshi (exemple : HTML4, PHP, AS3)
			\item @CodeSource est le texte � mettre en forme.",

		  "L'environnement \b{code} vous permet de placer du code informatique colori� dans vos articles, sans qu'il soit mis en forme (tirets, espaces devant la ponctuation). Voir aussi  \lien[?b=verbatim]{verbatim} qui ne colorie pas les codes sources.",

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
		  \item @Texte, @Texte2 sont les phrases prononc�es.",

		  "L'environnement \b{dialog} vous permet d'ins�rer un dialogue dans votre texte. Il se veut naturel et s�pare texte et auteurs par un symbole deux points.
		  Un texte peut s'�tendre sur plusieurs lignes, attention cependant s'il contient un symbole \":\" le d�but de la phrase sera consid�r� comme un auteur. Pour �viter ce comportement, �chappez le deux points en le pr�c�dant d'un antislash (voir exemple).

		  Note sur la s�mantique : HTML ne d�finit pas de structure pour les dialogues. En cons�quence, le texte est plac� dans un div et les auteurs dans une classe auteur. Le Typographe ne style pas ces balises.",

		  '\\begin{dialog}
am�thyst : Ont � tous un prof qui nous � rien apprit...
Midori : Quelque chose me dit que tu parles de ta/ton prof de fran�ais...
am�thyst : Coment tu sait ?
Midori : L\'intuition...
\\end{dialog}
Note : le style de l\'exemple peut varier selon le site o� est int�gr� le Typographe.'
		  ),
 );
 ?>
