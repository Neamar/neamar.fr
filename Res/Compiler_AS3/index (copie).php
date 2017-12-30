<?php
$Titre='Compilez l\'AS3 gratuitement et légalement sous Windows/Linux';
$Box = array("Auteur" => "Neamar","Date" => "Jan. 2008", "But" =>"Programmation AS3");
include('../header.php');
?>
<h1>Compilez des animations Flash gratuitement et légalement sous Windows/Linux</h1>

<h4>Quelques exemples de réalisation</h4>
<p>Voici quelques exemples de ce que vous réussirez à faire après avoir lu ce tutorial :</p>
<ul>
<li><a href="../Pathfinder">Un pathfinder</a> (trouver  un chemin dans un labyrinthe)</li>
<li><a href="../Graphe">Une saga de quatre jeux flash</a></li>
<li><a href="../SkyFire">Un petit peu de graphisme : des feux d'artifice</a></li>
</ul>

<p class="erreur">Ce tutoriel est une copie de celui disponible sur le site du zéro. La version présente sur cette page est une archive qui n'est pas mise à jour. <a href="http://www.siteduzero.com/tutoriel-3-32837-compilez-l-as3-gratuitement-et-legalement-sous-windows-linux.html" rel="nofollow">Voir la version à jour.</a></p>
<h2>Introduction</h2>
<p>Dans ce tutoriel, nous allons parler de Flash...(non ! comme si le titre ne vous l'avait pas déjà dit...)</p>
<p class="erreur">Ce tutorial ne vous apprendra pas à utiliser l'ACTIONSCRIPT ! (le langage de Flash)<br />
Il vous permettra juste à faire du flash haut niveau de façon multi-plateformes et gratuite.<br />
A la rigueur, si vous utilisez l'IDE, vous pouvez commencer à lire à partir de la quatrième partie, dans un souci d'optimisation de votre code. (résultats <span class="petitTexte">(quasi)</span> garantis)...</p>
<p>Dans quels cas ce tutorial me sera utile ?</p>
<ul>
<li>Vous avez Windows et l'IDE d'Adobe, mais la version de démonstration touche à sa fin et vous ne souhaitez pas débourser 800 euros pour continuer à programmer ?</li>
<li>Vous avez Linux et vous aimeriez bien pouvoir développer en AS3 (Action Script 3) ?</li>
<li>Et surtout, vous ne <strong>voulez</strong> pas pirater un logiciel, quel qu'il soit&nbsp;! J'espère bien que ce n'est pas votre genre... </li>
</ul>
<p>Ce mini-tuto est fait pour vous...</p>

<h2>Télécharger le compilateur</h2>
<p>Même si l'IDE d'Adobe est payant <span class="petitTexte">(et beaucoup trop cher pour un particulier comme vous et moi)</span>, il existe un logiciel gratuit appelé <a rel="nofollow" href="http://www.adobe.com/fr/products/flex/">Flex SDK</a>, développé par Macromedia (l'ancien possesseur de Flash, racheté depuis par Adobe), qui possède un compilateur AS3 performant (en fait, c'est le compilateur standard pour l'AS3 ;) ).</p>

<p class="comment">Depuis le début, je ne parle que de l'Action Script 3, mais il est bien sûr évident que ce compilateur peut aussi gérer l'AS2 ! (et même quelques autres langages, qu'il utilise dans les compilations avancées, mais nous n'en parlerons pas !)</p>

<p>Dans ce tutorial, nous n'allons pas nous intéresser aux capacités de Flex SDK, mais uniquement à son compilateur.<br />
Pour commencer, il va donc falloir télécharger ce compilateur dont je vous parle depuis dix minutes...<br />
Vous le trouverez ici :</p>

<p class="centre"><a rel="nofollow" href="http://download.macromedia.com/pub/flex/sdk/flex_sdk_3.zip">Flex_sdk_3.zip</a><br />
<span class="petitTexte">(vous devez accepter <a rel="nofollow" href="http://www.adobe.com/cfusion/entitlement/index.cfm?e=flex3email">les conditions d'Adobe</a>)<br />
(vous aurez besoin d'avoir <a rel="nofollow" href="http://java.sun.com/javase/downloads/index.html">Java</a> installé.)</span></p>

<fieldset><legend>Conditions du Flex SDK (extrait)</legend>
The Adobe® Flex 3 Software Development Kit (SDK) includes the Flex framework (component class library) and Flex compiler, enabling you to freely develop and deploy Flex applications using an IDE of your choice.
</fieldset>

<p>Une fois téléchargé, décompressez le tout dans un dossier quelconque... et voilà, vous en avez fini avec l'installation ! Vous avouerez que ce n'était pas très compliqué... la mauvaise nouvelle, c'est que ça ne va pas tarder à le devenir (compliqué, vous me suivez ?) !</p>

<h2>Utiliser le compilateur</h2>
<p>Vous êtes maintenant en possession d'un superbe compilateur tout beau tout neuf, mais vous ne savez pas comment l'utiliser !<br />
Ce compilateur s'utilise en ligne de commande. Non non ! Ne partez pas tout de suite..<br />
 Les vieux de la vieille de Windows se souviennent surement de la console. Il va y avoir des retrouvailles émues !<br />
Quant à ceux qui utilisent Linux, les présentations ne s'imposent même pas, je crois !</p>

<p>Comment faire pour ouvrir la console ?</p>
<ul>
<li>Sous <strong>Win Me / XP</strong> : un clic sur démarrer, puis un clic sur exécuter, vous marquez <cite>cmd</cite>. Welcome back to the old world !</li>
<li>Sous <strong>Windows Me / 98 / 95</strong> : lancez le fichier <cite>command.com</cite></li>
<li>Sous <strong>Windows Vista</strong> : Cliquez sur démarrer, puis entrez directement <cite>cmd</cite> dans la barre de recherche.</li>
<li class="comment">Astuce : Pour tous les Windows, vous pouvez aussi utiliser la combinaison de touches <strong>Windows - R</strong>, et marquer cmd</li>
<li>Sous <strong>Linux</strong> : Comment ça ? Vous utilisez Linux et vous ne savez pas ouvrir une console ? Allez, zou ! <a rel="nofollow" href="http://www.siteduzero.com/tuto-3-1840-0-reprenez-le-controle-avec-linux.html">C'est par ici...</a></li>
</ul>
<p class="erreur">N'utilisez pas une des vraies consoles (Ctrl-Alt-F(1~6))! Sinon l'étape de la compilation sera particulièrement fastidieuse (changements de résolution). Préférez donc un terminal, ou mieux, un éditeur de texte avec terminal intégré. (Kate, par exemple !)</p>

<p>Vous avez maintenant devant vous une superbe console  :-° ... il va falloir se déplacer jusqu'au dossier <em>bin</em> du dossier que vous venez de télécharger.<br />
Pour cela, il faut utiliser la commande <strong>cd</strong> ("<em>Change Directory</em>"), qui permet de se déplacer dans l'arborescence du disque dur.</p>
<p>Dans mon cas, le dossier se situe presque à la racine...</p>
<p class="comment">Vous pouvez aussi indiquer directement le chemin absolu : C:\Users\Neamar\Flex SDK 3\bin dans cet exemple.</p>

<ul>
<li>Windows : <img class="nonflottant" style="vertical-align:middle;" src="Images/ConsoleWindows.jpg" alt="La console Windows"/></li>
<li>Linux : <img class="nonflottant" style="vertical-align:middle;" src="Images/ConsoleLinux.jpg" alt="La console Linux"/></li>
</ul>

<p class="erreur">Attention aux caractères d'échappements ! Sous Windows, il faut mettre le nom du dossier entre ' <strong>"</strong> ', sous Linux il faut utiliser un \ devant les espaces.</p>
<p class="comment">ASTUCE : Vous pouvez appuyer sur Tabulation lorsque vous avez commencé à marquer le nom (<em>Flex</em> par exemple) pour que votre OS complète automatiquement le chemin du dossier.</p>

<p>En résumé, vous disposez maintenant d'un compilateur prêt à fonctionner... alors, qu'est ce qu'on attend pour continuer ?</p>

<h2>Votre premier SWF libre !</h2>
<p class="comment">Afin de ne pas jongler avec les OS, les manipulations qui suivent seront effectuées sous Windows.<br />
Pas d'inquiétude : la marche à suivre est <strong>exactement</strong> la même sous Linux !</p>

<p>Pour cette partie, nous allons utiliser un fichier .as de test. Il n'a qu'une seule utilité : servir de test.
Afin que tout le monde soit d'accord, je vous donne ce fichier pour que vous puissiez faire des tests.
<strong>N'essayez pas encore de compiler un de vos anciens codes sources réalisés avec l'IDE ! Le nombre d'erreurs vous ferait pleurer, on en reparlera dans la prochaine sous-partie !</strong></p>
<?php InclureCode("Souris.as","actionscript3"); ?>

<p class="comment">N'oubliez pas que vous devrez recompiler après <strong>chaque</strong> modification d'un des fichiers composant votre application ! Au début, il vous arrivera souvent d'oublier cette étape...(et n'oubliez pas d'enregistrer avec Ctrl-S !)</p>

<p>Enregistrez ce fichier (nommez-le <strong>souris.as</strong>) dans un dossier "<em>Source</em>" du répertoire <em>bin</em>.<br />
Le but de ce code est très simple : créer un fond rougeâtre, et un carré vert qui suit la souris. Ne vous attardez pas sur le code, qui diffère surement de ce que vous connaissez dans votre IDE : on reparlera de tout ça plus tard !</p>

<p>Dans votre console, marquez la ligne suivante : <cite>mxmlc "Sources/Souris.as"</cite><br />
Sous Linux, vous aurez besoin de rajouter bash, et d'enlever les guillemets : <cite>bash mxmlc Sources/Souris.as</cite></p>
<p>Appuyez sur Entrée...</p>

<p class="centre"><img src="Images/ConsoleWindows2.jpg" alt="Console Windows" class="nonflottant"/></p>

<p>Regardez dans votre dossier <em>Source</em> : un fichier <strong>souris.swf</strong> s'est créé ! Miracle !
Vous pouvez le lancer : il réagira comme n'importe quel swf, mis à part que vous n'avez pas déboursé 800 euros !</p>

<p class="comment">Le SWF créé à une hauteur/largeur infinie !<br />
Vous pouvez remédier à ce problème en ajoutant des paramètres de compilation avant la ligne 11 ("<em>public class souris extends Sprite</em>", juste après les import).<br />
Le plus souvent, vous utiliserez ces paramètres :<br />
<strong>[SWF(width="640", height="480", frameRate=24)]</strong><br />
(dans ce cas, j'en ai profité pour spécifier un <strong>framerate</strong>. Les valeurs de <strong>width</strong> et <strong>height</strong> sont données en pixels).<br />
(<a rel="nofollow" href="http://www.senocular.com/flash/tutorials/as3withmxmlc/">une liste des paramètres de compilation est disponible içi</a>, ou <a rel="nofollow" href="http://www.ekameleon.net/blog/index.php?2006/08/02/42--as3-stage-et-compilation">une version simplifiée en français</a>)</p>

<p>L'étape suivante ne sera pas forcément la plus drôle : je vous expliquerai comment modifier vos anciens codes pour les rendre compatibles avec ce compilateur. Même si aucune modification de fond n'est nécessaire (mis à part quelques rares cas, comme les interpolations complexes), cette tâche ne sera pas forcément drôle, voire même particulièrement embêtante ! Mais pas de soucis ! Je reste ici pour vous expliquer !</p>

<h2>Correction des bugs et optimisations du code-source</h2>

<p class="comment">Cette partie intéressera aussi les heureux propriétaires de l'IDE !</p>

<h3>Le point-virgule</h3>

<p>Commençons par les choses simples : toutes vos instructions doivent se terminer par un point-virgule. Dans beaucoup de cas, le compilateur ne rechignera pas si vous ne mettez pas de point virgule, mais le jour où un problème arrivera, l'erreur renvoyée ne sera pas forcément claire. Alors, prenez tout de suite les bonnes habitudes : toutes les <strong>instructions</strong> se terminent par un point-virgule !</p>

<h3>Le typage</h3>

<p>Cette opération est primordiale quel que soit le langage utilisé, mais l'IDE d'Adobe est assez (beaucoup trop à mon gout) laxiste sur ce point.</p>

<h4>Typage : A quoi ça sert ?</h4>

<p>Le typage, qu'est-ce que c'est ? C'est tout simplement donner un type à une variable.</p>
<p>Par exemple, c'est dire <em>"Toi, tu es une variable qui contient forcément un chiffre, je vais donc indiquer à l'ordinateur que tu n'es autorisée à ne recevoir que des chiffres".</em></p>
<p>A première vue, ça peut paraitre inutile et évident. Détrompez-vous ! Le typage évite beaucoup d'erreurs. Ainsi, si vous essayez de mettre une chaine de caractères dans une variable numérique, le compilateur vous en avertira, alors que sans typage, la compilation s'effectuerait sans problème. Sauf que quand vous lancerez le fichier, l'ordinateur pourra être appelé à faire des calculs bizarres, comme <em>sinus(2*"Bonjour"+3.1415)</em>. Personnellement, je ne sais pas faire ce type de calcul...Le problème, c'est que l'ordinateur non plus n'en a aucune idée : il y aura donc erreur, et bugs sur tous les appels de cette variable//fonction. Pas cool !</p>

<p>En plus, en typant vos variables, l'ordinateur sait dès le début que telle variable ne contiendra que des chiffres : il n'aura donc pas besoin de faire des changements de type complexes ! C'est tout bénéf' pour la rapidité/propreté de votre code.</p>

<p>Je ne m'attarde pas trop sur ce sujet, <a rel="nofollow" href="http://www.siteduzero.com/tuto-3-18941-1-le-typage-presentation-thematique-et-historique.html">un superbe tutorial est disponible sur le Site du Zéro</a>  ;).</p>

<h4>Comment typer en AS ?</h4>
<p>Vous devez typer vos variables et vos fonctions.<br />
Pour les variables, cela implique qu'il faut aussi les déclarer !<br />
Quelques exemples de typage de variables :</p>
<?php InclureCode("Exemple1.as","actionscript3"); ?>
<p>Il y a une multitude de types : <strong>Array</strong>, <strong>MovieClip</strong>, <strong>Point</strong>, <strong>Line</strong>... j'en passe, regardez <a rel="nofollow" href="http://livedocs.adobe.com/flash/9.0_fr/ActionScriptLangRefV3/">la documentation AS3 </a>!</p>

<p>En plus des variables, vous devez aussi typer vos fonctions ! Dès que vous utilisez l'instruction return, votre fonction a un type : celui de la variable retournée. Le type s'indique de la même façon que pour les variables :<br /> "<strong>Nom_De_La_Fonction(parametre:type_parametre):[type]</strong>"<br />
Si une fonction ne renvoie rien (on parle alors de procédure), vous devez quand même la typer : puisque votre fonction ne renvoie rien, elle sera de type <em>void</em>, ce qui signifie néant en anglais.</p>

<p>Des exemples ?</p>
<?php InclureCode("Exemple2.as","actionscript3"); ?>

<p class="comment">Il existe aussi le type étoile, qui type une variable n'importe comment : <strong>var i:*</strong> : i peut alors contenir un objet, un long, un string...<br />
Essayez de le bannir au maximum, normalement vous n'en aurez besoin que dans les énumérations de tableaux.</p>

<h3>Les packages</h3>

<p>Voilà le point qui fâche...<br />
Qu'est-ce qu'un package ? Il s'agit d'un ensemble de fichiers qui contiennent les définitions de certaines fonctions.</p>

<p>Lorsque vous compilez manuellement, vous <strong>devez</strong> inclure les packages que vous utilisez.<br />
Regardez le code de <strong>souris.as</strong> :</p>
<?php InclureCode("SourisExtrait.as","actionscript3"); ?>

<p>Je vais donc vous parler de ces import.<br />
En soi, rien de bien complexe : si vous utilisez des évènements de la souris (MouseEvent.MOUSE_MOVE, par exemple), vous devez inclure <em>flash.events.MouseEvent</em>.<br />
Si vous utilisez des Sprites, vous devrez marquer import <em>flash.display.Sprite</em>...et ainsi de suite.<br />
Mais...comment faire pour trouver le bon package ?</p>
<p>À priori, ce n'est pas compliqué, le seul problème étant de trouver le package quand l'instruction n'a pas un nom en rapport.<br />
Une petite étude de cas ?</p>
<blockquote><p>Je veux cacher mon curseur de souris avec la méthode <em>hide()</em>. Quand je compile, j'obtiens une erreur : j'ai donc besoin d'inclure un package... mais lequel ?
Après avoir farfouillé dans l'aide de Flash, je découvre une catégorie Mouse qui semble intéressante. Encore deux trois liens, et hop ! <a rel="nofollow" href="http://livedocs.adobe.com/flash/9.0_fr/ActionScriptLangRefV3/flash/ui/Mouse.html"> flash.ui.Mouse</a>.C'est exactement ce qu'il me fallait ! Je n'ai plus qu'à inclure le package...</p></blockquote>

<p>Comme vous le voyez, ça reste très artisanal : <a rel="nofollow" href="http://livedocs.adobe.com/flash/9.0_fr/ActionScriptLangRefV3/">l'aide de Flash</a> sera indispensable dans votre recherche de packages.</p>

<p class="comment">Une petite astuce : inclure les packages est une tâche longue, fastidieuse et peu gratifiante. Vous pouvez vous éviter du travail avec l'opérateur * : il inclue toutes les sous-classes indiquées.<br />
Ainsi, <strong>import flash.events.*</strong> est équivalent à import <strong>flash.events.MouseEvent</strong> ET <strong>import flash.events.Event</strong>.<br />
Parfait, me direz-vous ? Sûrement pas ! Car en procédant, ainsi, vous incluez aussi une myriade d'objets Event (<a rel="nofollow" href="http://livedocs.adobe.com/flash/9.0_fr/ActionScriptLangRefV3/flash/events/package-detail.html">la liste</a>). Et il est très peu probable que vous ayez besoin d'inclure tous ces objets !<br />
Au bilan, en utilisant cette méthode, vous vous simplifiez la vie dans une certaine mesure, mais vous alourdissez inutilement la mémoire de l'ordinateur qui fera tourner votre application.</p>

<h3>Les formes</h3>

<p>Quand vous utilisiez l'IDE, vous avez sûrement pris l'habitude d'utiliser en permanence l'outil de dessin vectoriel ?<br /> Dans ce cas-là, j'ai deux nouvelles pour vous : une bonne et une mauvaise. Je commence par laquelle ? Allez, la mauvaise !<br />
La mauvaise nouvelle, c'est que cette option n'est pas disponible avec ce compilateur. Il vous sera donc impossible de redessiner vos superbes vaguelettes à la souris...<br />
La bonne nouvelle, c'est que tout n'est pas perdu ! Regardez le code source de souris.as :</p>
<?php InclureCode("SourisExtrait2.as","actionscript3"); ?>
<p>Comme vous voyez, ce que vous faisiez à la main est faisable en code ! Fini le WYSIWYG, bienvenue au code !</p>

<p class="erreur">C'est là l'inconvénient majeur de ce compilateur : alors que l'IDE de Flash est complètement orienté vers le graphisme, ce compilateur est beaucoup plus tourné vers le code. Au final, ça revient au même, puisque l'IDE se contente de transformer de façon transparente vos formes en code, mais pour vous, c'est beaucoup plus lourd. Impossible de développer une superbe application graphique en quelques minutes !<br />
Il reste cependant possible d'utiliser un IDE libre sur le net pour le dessin vectoriel...il suffit après d'exporter vos créations en swc et des les inclure dans les options de compilation.</p>

<h3>La TimeLine</h3>

<p>Je crains d'avoir encore une mauvaise nouvelle à vous annoncer !<br />
Malgré de nombreuses recherches, je n'ai pas trouvé comment créer une frame en code. Et il semble admis sur les forums que les frames n'existent pas dans Flex. Bilan : vous allez devoir faire une croix sur cette Timeline.<br />
Attendez ! Ne partez pas... réfléchissons ensemble : quel est l'intérêt de ces frames ?</p>

<ul>
<li><em>Les animations de début // de fin</em>  => Faux ! Maintenant que vous réalisez toutes vos animations en code, ces anims seront incorporées dans votre code source. Pas de clips à accéder, donc pas besoin de frames !</li>
<li><em>Les preloaders</em> => Là vous marquez un point ! Effectivement, Flash attend normalement que la première frame soit chargée pour afficher le swf. Si vous n'avez qu'une seule frame, il vous sera donc impossible de réaliser une petite barre de chargement.<br />
Malheureusement, il n'y a pas de solutions simples à ce problème. Vous pouvez le contourner en utilisant un LoaderFlash qui chargera votre swf complet, ou vous pouvez utiliser <a rel="nofollow" href="http://www.bit-101.com/blog/?p=946">la méthode décrite içi</a> (attention : en anglais, et demande un certain niveau de compétence ! Entraînez-vous un peu avant d'aller voir ça). Une troisième solution existe, avec les classe tween. Je ne m'attarde pas là-dessus, car je n'en sais pas beaucoup plus.</li>
</ul>
<p class="comment">Cet abandon des frames aura un rebondissement inattendu sur vos codes : vous pouvez en finir avec les MovieClip ! Car après tout, la seule distinction entre un MovieClip et un Sprite, c'est cette Timeline ! Mieux vaut utiliser un Sprite dont vous modifierez l'animation quand le besoin s'en fait sentir. Ainsi, vous pouvez faire l'économie de tous ces MovieClip, au profit de Sprites. Optimisation, quand tu nous tiens....<br />
Plus d'infos : <a rel="nofollow" href="http://www.aggelos.org/index.php?2005/10/17/54--as3-movieclip-est-mort-buvez-du-sprite">MovieClip est mort. Buvez du Sprite</a></p>
<blockquote><p>vVous obtiendrez des performances nettement supérieures en utilisant Shape plutôt que Sprite ou MovieClip (l'Aide de Flash)<br />
<br />
Si vous avez besoin d'un objet qui sera le conteneur d'autres objets d'affichage (que vous ayez ou non l'intention de dessiner en ActionScript dans cet objet), choisissez l'une des sous-classes de DisplayObjectContainer :<br />
<br />
    * Sprite si l'objet doit être créé en ActionScript uniquement, ou servira de classe de base à un objet d'affichage qui sera uniquement créé et manipulé en ActionScript,<br />
    * MovieClip si vous créez une variable pour pointer sur un symbole de clip créé dans Flash.</p></blockquote>


<p>Ça y est, vos anciens codes sources devraient se compiler.<br />
Ah non ! Il vous manque encore une notion...</p>

<h3>Enchâssez-moi tout ça !</h3>

<p>Votre code source <strong>doit</strong> être contenu dans une classe.<br />
Voilà donc la structure standard d'un fichier .as :</p>
<?php InclureCode("Prototype.as","actionscript3"); ?>
<p class="erreur">IMPORTANT : Les noms de la classe et de la fonction de départ <strong>doivent</strong> être les mêmes que le nom du fichier. Si votre fichier s'appelle anticonstitutionnellement.as, votre classe devra comporter  <em>public class anticonstitutionnellement extends Sprite</em> !</p>

<p>Je vous vois venir : "<cite>Mais ! C'est moche ! Toutes les fonctions dans le même fichier ? Ça va être un sacré bordel !</cite>"...</p>
<p>Qui a dit que vous deviez tout mettre dans le même fichier ? Ah oui ! Moi  :-° ... oubliez ça alors !<br />
Vous pouvez parfaitement créer des fichiers annexes qui contiennent des fonctions.<br />
Ainsi, rien ne vous empêche de créer un fichier Evenements.as, Graphisme.as , Calculs.as...<br />
Une fois crées, vous pouvez les inclure très facilement, en utilisant la fonction <strong>include</strong> dans la fonction de départ.</p>
<?php InclureCode("Prototype2.as","actionscript3"); ?>

<p>Ça y est !<br />
Vous en avez fini avec cette sous-partie assez longue, je dois l'avouer ! (mes doigts fument encore d'avoir tapoté le clavier sans rémission).<br />
Allez courage, plus que quelques lignes et c'est terminé !</p>

<h2>La fonction Trace</h2>
<p><strong>Trace</strong>, vous connaissez ? Elle permet un <span style="text-decoration:line-through">débuggage</span> débogage (parait qu'en français, ça s'écrit comme ça, moi je suis pas compliqué  :D !), bref, cette fonction permet d'enlever facilement certains bugs de votre application.</p>

<p>Malheureusement, il s'agit d'un des ajouts de l'IDE. Pas d'IDE, pas de Trace !</p>

<p>Pas de panique ! Rien ne vous empêche de recréer une fonction trace, voire même d'améliorer l'ancienne.<br />
Personnellement, j'utilise cette fonction (inspirée du travail de Kisscoool).<br />
Pour l'utiliser, il vous <em>suffit</em> d'inclure le fichier trace.as...comme vous venez d'apprendre à le faire !</p>

<p class="erreur">Cette fonction n'est pas aussi parfaite que celle incluse dans l'IDE : elle ne gère pas l'affichage des tableaux, par exemple. Vous êtes donc obligé de passer par un for each...</p>

<?php InclureCode('Trace.as',"actionscript3"); ?>

<h2>Conclusion</h2>
<p><img src="Images/LinuxAS.jpg" alt="Linux, Flash et l'ActionScript..."/>Vous savez maintenant comment compiler votre application en AS3 de façon gratuite et multi-plateformes.
Comme vous l'avez remarqué, le plus dur n'est pas la compilation, mais la rectification des problèmes qui sont normalement gérés par l'IDE.</p>

<p class="comment">Gardez en tête que les informations affichées içi servent uniquement de base : elles sont loin d'être exhaustives.</p>

<p>Pour aller plus loin, quelques liens :</p>
<ul>
<li><a rel="nofollow" href="http://www.adobe.com/support/documentation/fr/flash/">La documentation d'adobe</a></li>
<li><a rel="nofollow" href="http://www.senocular.com/flash/tutorials/as3withmxmlc/">Pour aller beaucoup plus loin avec mxmlc (en)</a></li>
<li><a rel="nofollow" href="http://www.flashdevelop.org/">FlashDevelop : Un IDE (code uniquement, mais très complet) gratuit utilisant ce noyau de compilateur (Windows uniquement)</a></li>
<li><a rel="nofollow" href="http://osflash.org/projects">Une liste de projets Open Source Flash : IDE, code, graphismes... (pas forcément compatible AS3) (en)</a></li>
<li><a rel="nofollow" href="http://filt3r.free.fr/index.php/2007/07/24/23-mon-premier-swf9-gratos-avec-flex-sdk">Inclure des fichiers dans un swf pour ne pas avoir à les charger</a></li>
</ul>

<p>Merci à Kisscoool pour sa relecture et ses conseils attentifs.</p>

<?php
include("../footer.php");
?>
