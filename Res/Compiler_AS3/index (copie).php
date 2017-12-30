<?php
$Titre='Compilez l\'AS3 gratuitement et l�galement sous Windows/Linux';
$Box = array("Auteur" => "Neamar","Date" => "Jan. 2008", "But" =>"Programmation AS3");
include('../header.php');
?>
<h1>Compilez des animations Flash gratuitement et l�galement sous Windows/Linux</h1>

<h4>Quelques exemples de r�alisation</h4>
<p>Voici quelques exemples de ce que vous r�ussirez � faire apr�s avoir lu ce tutorial :</p>
<ul>
<li><a href="../Pathfinder">Un pathfinder</a> (trouver  un chemin dans un labyrinthe)</li>
<li><a href="../Graphe">Une saga de quatre jeux flash</a></li>
<li><a href="../SkyFire">Un petit peu de graphisme : des feux d'artifice</a></li>
</ul>

<p class="erreur">Ce tutoriel est une copie de celui disponible sur le site du z�ro. La version pr�sente sur cette page est une archive qui n'est pas mise � jour. <a href="http://www.siteduzero.com/tutoriel-3-32837-compilez-l-as3-gratuitement-et-legalement-sous-windows-linux.html" rel="nofollow">Voir la version � jour.</a></p>
<h2>Introduction</h2>
<p>Dans ce tutoriel, nous allons parler de Flash...(non ! comme si le titre ne vous l'avait pas d�j� dit...)</p>
<p class="erreur">Ce tutorial ne vous apprendra pas � utiliser l'ACTIONSCRIPT ! (le langage de Flash)<br />
Il vous permettra juste � faire du flash haut niveau de fa�on multi-plateformes et gratuite.<br />
A la rigueur, si vous utilisez l'IDE, vous pouvez commencer � lire � partir de la quatri�me partie, dans un souci d'optimisation de votre code. (r�sultats <span class="petitTexte">(quasi)</span> garantis)...</p>
<p>Dans quels cas ce tutorial me sera utile ?</p>
<ul>
<li>Vous avez Windows et l'IDE d'Adobe, mais la version de d�monstration touche � sa fin et vous ne souhaitez pas d�bourser 800 euros pour continuer � programmer ?</li>
<li>Vous avez Linux et vous aimeriez bien pouvoir d�velopper en AS3 (Action Script 3) ?</li>
<li>Et surtout, vous ne <strong>voulez</strong> pas pirater un logiciel, quel qu'il soit&nbsp;! J'esp�re bien que ce n'est pas votre genre... </li>
</ul>
<p>Ce mini-tuto est fait pour vous...</p>

<h2>T�l�charger le compilateur</h2>
<p>M�me si l'IDE d'Adobe est payant <span class="petitTexte">(et beaucoup trop cher pour un particulier comme vous et moi)</span>, il existe un logiciel gratuit appel� <a rel="nofollow" href="http://www.adobe.com/fr/products/flex/">Flex SDK</a>, d�velopp� par Macromedia (l'ancien possesseur de Flash, rachet� depuis par Adobe), qui poss�de un compilateur AS3 performant (en fait, c'est le compilateur standard pour l'AS3 ;) ).</p>

<p class="comment">Depuis le d�but, je ne parle que de l'Action Script 3, mais il est bien s�r �vident que ce compilateur peut aussi g�rer l'AS2 ! (et m�me quelques autres langages, qu'il utilise dans les compilations avanc�es, mais nous n'en parlerons pas !)</p>

<p>Dans ce tutorial, nous n'allons pas nous int�resser aux capacit�s de Flex SDK, mais uniquement � son compilateur.<br />
Pour commencer, il va donc falloir t�l�charger ce compilateur dont je vous parle depuis dix minutes...<br />
Vous le trouverez ici :</p>

<p class="centre"><a rel="nofollow" href="http://download.macromedia.com/pub/flex/sdk/flex_sdk_3.zip">Flex_sdk_3.zip</a><br />
<span class="petitTexte">(vous devez accepter <a rel="nofollow" href="http://www.adobe.com/cfusion/entitlement/index.cfm?e=flex3email">les conditions d'Adobe</a>)<br />
(vous aurez besoin d'avoir <a rel="nofollow" href="http://java.sun.com/javase/downloads/index.html">Java</a> install�.)</span></p>

<fieldset><legend>Conditions du Flex SDK (extrait)</legend>
The Adobe� Flex 3 Software Development Kit (SDK) includes the Flex framework (component class library) and Flex compiler, enabling you to freely develop and deploy Flex applications using an IDE of your choice.
</fieldset>

<p>Une fois t�l�charg�, d�compressez le tout dans un dossier quelconque... et voil�, vous en avez fini avec l'installation ! Vous avouerez que ce n'�tait pas tr�s compliqu�... la mauvaise nouvelle, c'est que �a ne va pas tarder � le devenir (compliqu�, vous me suivez ?) !</p>

<h2>Utiliser le compilateur</h2>
<p>Vous �tes maintenant en possession d'un superbe compilateur tout beau tout neuf, mais vous ne savez pas comment l'utiliser !<br />
Ce compilateur s'utilise en ligne de commande. Non non ! Ne partez pas tout de suite..<br />
 Les vieux de la vieille de Windows se souviennent surement de la console. Il va y avoir des retrouvailles �mues !<br />
Quant � ceux qui utilisent Linux, les pr�sentations ne s'imposent m�me pas, je crois !</p>

<p>Comment faire pour ouvrir la console ?</p>
<ul>
<li>Sous <strong>Win Me / XP</strong> : un clic sur d�marrer, puis un clic sur ex�cuter, vous marquez <cite>cmd</cite>. Welcome back to the old world !</li>
<li>Sous <strong>Windows Me / 98 / 95</strong> : lancez le fichier <cite>command.com</cite></li>
<li>Sous <strong>Windows Vista</strong> : Cliquez sur d�marrer, puis entrez directement <cite>cmd</cite> dans la barre de recherche.</li>
<li class="comment">Astuce : Pour tous les Windows, vous pouvez aussi utiliser la combinaison de touches <strong>Windows - R</strong>, et marquer cmd</li>
<li>Sous <strong>Linux</strong> : Comment �a ? Vous utilisez Linux et vous ne savez pas ouvrir une console ? Allez, zou ! <a rel="nofollow" href="http://www.siteduzero.com/tuto-3-1840-0-reprenez-le-controle-avec-linux.html">C'est par ici...</a></li>
</ul>
<p class="erreur">N'utilisez pas une des vraies consoles (Ctrl-Alt-F(1~6))! Sinon l'�tape de la compilation sera particuli�rement fastidieuse (changements de r�solution). Pr�f�rez donc un terminal, ou mieux, un �diteur de texte avec terminal int�gr�. (Kate, par exemple !)</p>

<p>Vous avez maintenant devant vous une superbe console  :-� ... il va falloir se d�placer jusqu'au dossier <em>bin</em> du dossier que vous venez de t�l�charger.<br />
Pour cela, il faut utiliser la commande <strong>cd</strong> ("<em>Change Directory</em>"), qui permet de se d�placer dans l'arborescence du disque dur.</p>
<p>Dans mon cas, le dossier se situe presque � la racine...</p>
<p class="comment">Vous pouvez aussi indiquer directement le chemin absolu : C:\Users\Neamar\Flex SDK 3\bin dans cet exemple.</p>

<ul>
<li>Windows : <img class="nonflottant" style="vertical-align:middle;" src="Images/ConsoleWindows.jpg" alt="La console Windows"/></li>
<li>Linux : <img class="nonflottant" style="vertical-align:middle;" src="Images/ConsoleLinux.jpg" alt="La console Linux"/></li>
</ul>

<p class="erreur">Attention aux caract�res d'�chappements ! Sous Windows, il faut mettre le nom du dossier entre ' <strong>"</strong> ', sous Linux il faut utiliser un \ devant les espaces.</p>
<p class="comment">ASTUCE : Vous pouvez appuyer sur Tabulation lorsque vous avez commenc� � marquer le nom (<em>Flex</em> par exemple) pour que votre OS compl�te automatiquement le chemin du dossier.</p>

<p>En r�sum�, vous disposez maintenant d'un compilateur pr�t � fonctionner... alors, qu'est ce qu'on attend pour continuer ?</p>

<h2>Votre premier SWF libre !</h2>
<p class="comment">Afin de ne pas jongler avec les OS, les manipulations qui suivent seront effectu�es sous Windows.<br />
Pas d'inqui�tude : la marche � suivre est <strong>exactement</strong> la m�me sous Linux !</p>

<p>Pour cette partie, nous allons utiliser un fichier .as de test. Il n'a qu'une seule utilit� : servir de test.
Afin que tout le monde soit d'accord, je vous donne ce fichier pour que vous puissiez faire des tests.
<strong>N'essayez pas encore de compiler un de vos anciens codes sources r�alis�s avec l'IDE ! Le nombre d'erreurs vous ferait pleurer, on en reparlera dans la prochaine sous-partie !</strong></p>
<?php InclureCode("Souris.as","actionscript3"); ?>

<p class="comment">N'oubliez pas que vous devrez recompiler apr�s <strong>chaque</strong> modification d'un des fichiers composant votre application ! Au d�but, il vous arrivera souvent d'oublier cette �tape...(et n'oubliez pas d'enregistrer avec Ctrl-S !)</p>

<p>Enregistrez ce fichier (nommez-le <strong>souris.as</strong>) dans un dossier "<em>Source</em>" du r�pertoire <em>bin</em>.<br />
Le but de ce code est tr�s simple : cr�er un fond rouge�tre, et un carr� vert qui suit la souris. Ne vous attardez pas sur le code, qui diff�re surement de ce que vous connaissez dans votre IDE : on reparlera de tout �a plus tard !</p>

<p>Dans votre console, marquez la ligne suivante : <cite>mxmlc "Sources/Souris.as"</cite><br />
Sous Linux, vous aurez besoin de rajouter bash, et d'enlever les guillemets : <cite>bash mxmlc Sources/Souris.as</cite></p>
<p>Appuyez sur Entr�e...</p>

<p class="centre"><img src="Images/ConsoleWindows2.jpg" alt="Console Windows" class="nonflottant"/></p>

<p>Regardez dans votre dossier <em>Source</em> : un fichier <strong>souris.swf</strong> s'est cr�� ! Miracle !
Vous pouvez le lancer : il r�agira comme n'importe quel swf, mis � part que vous n'avez pas d�bours� 800 euros !</p>

<p class="comment">Le SWF cr�� � une hauteur/largeur infinie !<br />
Vous pouvez rem�dier � ce probl�me en ajoutant des param�tres de compilation avant la ligne 11 ("<em>public class souris extends Sprite</em>", juste apr�s les import).<br />
Le plus souvent, vous utiliserez ces param�tres :<br />
<strong>[SWF(width="640", height="480", frameRate=24)]</strong><br />
(dans ce cas, j'en ai profit� pour sp�cifier un <strong>framerate</strong>. Les valeurs de <strong>width</strong> et <strong>height</strong> sont donn�es en pixels).<br />
(<a rel="nofollow" href="http://www.senocular.com/flash/tutorials/as3withmxmlc/">une liste des param�tres de compilation est disponible i�i</a>, ou <a rel="nofollow" href="http://www.ekameleon.net/blog/index.php?2006/08/02/42--as3-stage-et-compilation">une version simplifi�e en fran�ais</a>)</p>

<p>L'�tape suivante ne sera pas forc�ment la plus dr�le : je vous expliquerai comment modifier vos anciens codes pour les rendre compatibles avec ce compilateur. M�me si aucune modification de fond n'est n�cessaire (mis � part quelques rares cas, comme les interpolations complexes), cette t�che ne sera pas forc�ment dr�le, voire m�me particuli�rement emb�tante ! Mais pas de soucis ! Je reste ici pour vous expliquer !</p>

<h2>Correction des bugs et optimisations du code-source</h2>

<p class="comment">Cette partie int�ressera aussi les heureux propri�taires de l'IDE !</p>

<h3>Le point-virgule</h3>

<p>Commen�ons par les choses simples : toutes vos instructions doivent se terminer par un point-virgule. Dans beaucoup de cas, le compilateur ne rechignera pas si vous ne mettez pas de point virgule, mais le jour o� un probl�me arrivera, l'erreur renvoy�e ne sera pas forc�ment claire. Alors, prenez tout de suite les bonnes habitudes : toutes les <strong>instructions</strong> se terminent par un point-virgule !</p>

<h3>Le typage</h3>

<p>Cette op�ration est primordiale quel que soit le langage utilis�, mais l'IDE d'Adobe est assez (beaucoup trop � mon gout) laxiste sur ce point.</p>

<h4>Typage : A quoi �a sert ?</h4>

<p>Le typage, qu'est-ce que c'est ? C'est tout simplement donner un type � une variable.</p>
<p>Par exemple, c'est dire <em>"Toi, tu es une variable qui contient forc�ment un chiffre, je vais donc indiquer � l'ordinateur que tu n'es autoris�e � ne recevoir que des chiffres".</em></p>
<p>A premi�re vue, �a peut paraitre inutile et �vident. D�trompez-vous ! Le typage �vite beaucoup d'erreurs. Ainsi, si vous essayez de mettre une chaine de caract�res dans une variable num�rique, le compilateur vous en avertira, alors que sans typage, la compilation s'effectuerait sans probl�me. Sauf que quand vous lancerez le fichier, l'ordinateur pourra �tre appel� � faire des calculs bizarres, comme <em>sinus(2*"Bonjour"+3.1415)</em>. Personnellement, je ne sais pas faire ce type de calcul...Le probl�me, c'est que l'ordinateur non plus n'en a aucune id�e : il y aura donc erreur, et bugs sur tous les appels de cette variable//fonction. Pas cool !</p>

<p>En plus, en typant vos variables, l'ordinateur sait d�s le d�but que telle variable ne contiendra que des chiffres : il n'aura donc pas besoin de faire des changements de type complexes ! C'est tout b�n�f' pour la rapidit�/propret� de votre code.</p>

<p>Je ne m'attarde pas trop sur ce sujet, <a rel="nofollow" href="http://www.siteduzero.com/tuto-3-18941-1-le-typage-presentation-thematique-et-historique.html">un superbe tutorial est disponible sur le Site du Z�ro</a>  ;).</p>

<h4>Comment typer en AS ?</h4>
<p>Vous devez typer vos variables et vos fonctions.<br />
Pour les variables, cela implique qu'il faut aussi les d�clarer !<br />
Quelques exemples de typage de variables :</p>
<?php InclureCode("Exemple1.as","actionscript3"); ?>
<p>Il y a une multitude de types : <strong>Array</strong>, <strong>MovieClip</strong>, <strong>Point</strong>, <strong>Line</strong>... j'en passe, regardez <a rel="nofollow" href="http://livedocs.adobe.com/flash/9.0_fr/ActionScriptLangRefV3/">la documentation AS3 </a>!</p>

<p>En plus des variables, vous devez aussi typer vos fonctions ! D�s que vous utilisez l'instruction return, votre fonction a un type : celui de la variable retourn�e. Le type s'indique de la m�me fa�on que pour les variables :<br /> "<strong>Nom_De_La_Fonction(parametre:type_parametre):[type]</strong>"<br />
Si une fonction ne renvoie rien (on parle alors de proc�dure), vous devez quand m�me la typer : puisque votre fonction ne renvoie rien, elle sera de type <em>void</em>, ce qui signifie n�ant en anglais.</p>

<p>Des exemples ?</p>
<?php InclureCode("Exemple2.as","actionscript3"); ?>

<p class="comment">Il existe aussi le type �toile, qui type une variable n'importe comment : <strong>var i:*</strong> : i peut alors contenir un objet, un long, un string...<br />
Essayez de le bannir au maximum, normalement vous n'en aurez besoin que dans les �num�rations de tableaux.</p>

<h3>Les packages</h3>

<p>Voil� le point qui f�che...<br />
Qu'est-ce qu'un package ? Il s'agit d'un ensemble de fichiers qui contiennent les d�finitions de certaines fonctions.</p>

<p>Lorsque vous compilez manuellement, vous <strong>devez</strong> inclure les packages que vous utilisez.<br />
Regardez le code de <strong>souris.as</strong> :</p>
<?php InclureCode("SourisExtrait.as","actionscript3"); ?>

<p>Je vais donc vous parler de ces import.<br />
En soi, rien de bien complexe : si vous utilisez des �v�nements de la souris (MouseEvent.MOUSE_MOVE, par exemple), vous devez inclure <em>flash.events.MouseEvent</em>.<br />
Si vous utilisez des Sprites, vous devrez marquer import <em>flash.display.Sprite</em>...et ainsi de suite.<br />
Mais...comment faire pour trouver le bon package ?</p>
<p>� priori, ce n'est pas compliqu�, le seul probl�me �tant de trouver le package quand l'instruction n'a pas un nom en rapport.<br />
Une petite �tude de cas ?</p>
<blockquote><p>Je veux cacher mon curseur de souris avec la m�thode <em>hide()</em>. Quand je compile, j'obtiens une erreur : j'ai donc besoin d'inclure un package... mais lequel ?
Apr�s avoir farfouill� dans l'aide de Flash, je d�couvre une cat�gorie Mouse qui semble int�ressante. Encore deux trois liens, et hop ! <a rel="nofollow" href="http://livedocs.adobe.com/flash/9.0_fr/ActionScriptLangRefV3/flash/ui/Mouse.html"> flash.ui.Mouse</a>.C'est exactement ce qu'il me fallait ! Je n'ai plus qu'� inclure le package...</p></blockquote>

<p>Comme vous le voyez, �a reste tr�s artisanal : <a rel="nofollow" href="http://livedocs.adobe.com/flash/9.0_fr/ActionScriptLangRefV3/">l'aide de Flash</a> sera indispensable dans votre recherche de packages.</p>

<p class="comment">Une petite astuce : inclure les packages est une t�che longue, fastidieuse et peu gratifiante. Vous pouvez vous �viter du travail avec l'op�rateur * : il inclue toutes les sous-classes indiqu�es.<br />
Ainsi, <strong>import flash.events.*</strong> est �quivalent � import <strong>flash.events.MouseEvent</strong> ET <strong>import flash.events.Event</strong>.<br />
Parfait, me direz-vous ? S�rement pas ! Car en proc�dant, ainsi, vous incluez aussi une myriade d'objets Event (<a rel="nofollow" href="http://livedocs.adobe.com/flash/9.0_fr/ActionScriptLangRefV3/flash/events/package-detail.html">la liste</a>). Et il est tr�s peu probable que vous ayez besoin d'inclure tous ces objets !<br />
Au bilan, en utilisant cette m�thode, vous vous simplifiez la vie dans une certaine mesure, mais vous alourdissez inutilement la m�moire de l'ordinateur qui fera tourner votre application.</p>

<h3>Les formes</h3>

<p>Quand vous utilisiez l'IDE, vous avez s�rement pris l'habitude d'utiliser en permanence l'outil de dessin vectoriel ?<br /> Dans ce cas-l�, j'ai deux nouvelles pour vous : une bonne et une mauvaise. Je commence par laquelle ? Allez, la mauvaise !<br />
La mauvaise nouvelle, c'est que cette option n'est pas disponible avec ce compilateur. Il vous sera donc impossible de redessiner vos superbes vaguelettes � la souris...<br />
La bonne nouvelle, c'est que tout n'est pas perdu ! Regardez le code source de souris.as :</p>
<?php InclureCode("SourisExtrait2.as","actionscript3"); ?>
<p>Comme vous voyez, ce que vous faisiez � la main est faisable en code ! Fini le WYSIWYG, bienvenue au code !</p>

<p class="erreur">C'est l� l'inconv�nient majeur de ce compilateur : alors que l'IDE de Flash est compl�tement orient� vers le graphisme, ce compilateur est beaucoup plus tourn� vers le code. Au final, �a revient au m�me, puisque l'IDE se contente de transformer de fa�on transparente vos formes en code, mais pour vous, c'est beaucoup plus lourd. Impossible de d�velopper une superbe application graphique en quelques minutes !<br />
Il reste cependant possible d'utiliser un IDE libre sur le net pour le dessin vectoriel...il suffit apr�s d'exporter vos cr�ations en swc et des les inclure dans les options de compilation.</p>

<h3>La TimeLine</h3>

<p>Je crains d'avoir encore une mauvaise nouvelle � vous annoncer !<br />
Malgr� de nombreuses recherches, je n'ai pas trouv� comment cr�er une frame en code. Et il semble admis sur les forums que les frames n'existent pas dans Flex. Bilan : vous allez devoir faire une croix sur cette Timeline.<br />
Attendez ! Ne partez pas... r�fl�chissons ensemble : quel est l'int�r�t de ces frames ?</p>

<ul>
<li><em>Les animations de d�but // de fin</em>  => Faux ! Maintenant que vous r�alisez toutes vos animations en code, ces anims seront incorpor�es dans votre code source. Pas de clips � acc�der, donc pas besoin de frames !</li>
<li><em>Les preloaders</em> => L� vous marquez un point ! Effectivement, Flash attend normalement que la premi�re frame soit charg�e pour afficher le swf. Si vous n'avez qu'une seule frame, il vous sera donc impossible de r�aliser une petite barre de chargement.<br />
Malheureusement, il n'y a pas de solutions simples � ce probl�me. Vous pouvez le contourner en utilisant un LoaderFlash qui chargera votre swf complet, ou vous pouvez utiliser <a rel="nofollow" href="http://www.bit-101.com/blog/?p=946">la m�thode d�crite i�i</a> (attention : en anglais, et demande un certain niveau de comp�tence ! Entra�nez-vous un peu avant d'aller voir �a). Une troisi�me solution existe, avec les classe tween. Je ne m'attarde pas l�-dessus, car je n'en sais pas beaucoup plus.</li>
</ul>
<p class="comment">Cet abandon des frames aura un rebondissement inattendu sur vos codes : vous pouvez en finir avec les MovieClip ! Car apr�s tout, la seule distinction entre un MovieClip et un Sprite, c'est cette Timeline ! Mieux vaut utiliser un Sprite dont vous modifierez l'animation quand le besoin s'en fait sentir. Ainsi, vous pouvez faire l'�conomie de tous ces MovieClip, au profit de Sprites. Optimisation, quand tu nous tiens....<br />
Plus d'infos : <a rel="nofollow" href="http://www.aggelos.org/index.php?2005/10/17/54--as3-movieclip-est-mort-buvez-du-sprite">MovieClip est mort. Buvez du Sprite</a></p>
<blockquote><p>vVous obtiendrez des performances nettement sup�rieures en utilisant Shape plut�t que Sprite ou MovieClip (l'Aide de Flash)<br />
<br />
Si vous avez besoin d'un objet qui sera le conteneur d'autres objets d'affichage (que vous ayez ou non l'intention de dessiner en ActionScript dans cet objet), choisissez l'une des sous-classes de DisplayObjectContainer :<br />
<br />
    * Sprite si l'objet doit �tre cr�� en ActionScript uniquement, ou servira de classe de base � un objet d'affichage qui sera uniquement cr�� et manipul� en ActionScript,<br />
    * MovieClip si vous cr�ez une variable pour pointer sur un symbole de clip cr�� dans Flash.</p></blockquote>


<p>�a y est, vos anciens codes sources devraient se compiler.<br />
Ah non ! Il vous manque encore une notion...</p>

<h3>Ench�ssez-moi tout �a !</h3>

<p>Votre code source <strong>doit</strong> �tre contenu dans une classe.<br />
Voil� donc la structure standard d'un fichier .as :</p>
<?php InclureCode("Prototype.as","actionscript3"); ?>
<p class="erreur">IMPORTANT : Les noms de la classe et de la fonction de d�part <strong>doivent</strong> �tre les m�mes que le nom du fichier. Si votre fichier s'appelle anticonstitutionnellement.as, votre classe devra comporter  <em>public class anticonstitutionnellement extends Sprite</em> !</p>

<p>Je vous vois venir : "<cite>Mais ! C'est moche ! Toutes les fonctions dans le m�me fichier ? �a va �tre un sacr� bordel !</cite>"...</p>
<p>Qui a dit que vous deviez tout mettre dans le m�me fichier ? Ah oui ! Moi  :-� ... oubliez �a alors !<br />
Vous pouvez parfaitement cr�er des fichiers annexes qui contiennent des fonctions.<br />
Ainsi, rien ne vous emp�che de cr�er un fichier Evenements.as, Graphisme.as , Calculs.as...<br />
Une fois cr�es, vous pouvez les inclure tr�s facilement, en utilisant la fonction <strong>include</strong> dans la fonction de d�part.</p>
<?php InclureCode("Prototype2.as","actionscript3"); ?>

<p>�a y est !<br />
Vous en avez fini avec cette sous-partie assez longue, je dois l'avouer ! (mes doigts fument encore d'avoir tapot� le clavier sans r�mission).<br />
Allez courage, plus que quelques lignes et c'est termin� !</p>

<h2>La fonction Trace</h2>
<p><strong>Trace</strong>, vous connaissez ? Elle permet un <span style="text-decoration:line-through">d�buggage</span> d�bogage (parait qu'en fran�ais, �a s'�crit comme �a, moi je suis pas compliqu�  :D !), bref, cette fonction permet d'enlever facilement certains bugs de votre application.</p>

<p>Malheureusement, il s'agit d'un des ajouts de l'IDE. Pas d'IDE, pas de Trace !</p>

<p>Pas de panique ! Rien ne vous emp�che de recr�er une fonction trace, voire m�me d'am�liorer l'ancienne.<br />
Personnellement, j'utilise cette fonction (inspir�e du travail de Kisscoool).<br />
Pour l'utiliser, il vous <em>suffit</em> d'inclure le fichier trace.as...comme vous venez d'apprendre � le faire !</p>

<p class="erreur">Cette fonction n'est pas aussi parfaite que celle incluse dans l'IDE : elle ne g�re pas l'affichage des tableaux, par exemple. Vous �tes donc oblig� de passer par un for each...</p>

<?php InclureCode('Trace.as',"actionscript3"); ?>

<h2>Conclusion</h2>
<p><img src="Images/LinuxAS.jpg" alt="Linux, Flash et l'ActionScript..."/>Vous savez maintenant comment compiler votre application en AS3 de fa�on gratuite et multi-plateformes.
Comme vous l'avez remarqu�, le plus dur n'est pas la compilation, mais la rectification des probl�mes qui sont normalement g�r�s par l'IDE.</p>

<p class="comment">Gardez en t�te que les informations affich�es i�i servent uniquement de base : elles sont loin d'�tre exhaustives.</p>

<p>Pour aller plus loin, quelques liens :</p>
<ul>
<li><a rel="nofollow" href="http://www.adobe.com/support/documentation/fr/flash/">La documentation d'adobe</a></li>
<li><a rel="nofollow" href="http://www.senocular.com/flash/tutorials/as3withmxmlc/">Pour aller beaucoup plus loin avec mxmlc (en)</a></li>
<li><a rel="nofollow" href="http://www.flashdevelop.org/">FlashDevelop : Un IDE (code uniquement, mais tr�s complet) gratuit utilisant ce noyau de compilateur (Windows uniquement)</a></li>
<li><a rel="nofollow" href="http://osflash.org/projects">Une liste de projets Open Source Flash : IDE, code, graphismes... (pas forc�ment compatible AS3) (en)</a></li>
<li><a rel="nofollow" href="http://filt3r.free.fr/index.php/2007/07/24/23-mon-premier-swf9-gratos-avec-flex-sdk">Inclure des fichiers dans un swf pour ne pas avoir � les charger</a></li>
</ul>

<p>Merci � Kisscoool pour sa relecture et ses conseils attentifs.</p>

<?php
include("../footer.php");
?>
