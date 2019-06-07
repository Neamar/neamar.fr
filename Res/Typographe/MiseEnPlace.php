<?php
$Titre="Int�gration du Typographe sur votre site Web";
$Box = array("Auteur" => "Neamar","Date" => "2009","Accueil"=>'<a href="./">Le Typographe</a>');
include('../header.php');
function Source($Titre,$Source)
{
	echo '
	<fieldset style="width:90%;">
	<legend>Code source : ' . $Titre.  '</legend>';
	include_once('../../lib/geshi.php');
	$RessourceCode = new GeSHi($Source,'PHP');
	$RessourceCode->enable_classes();//Utiliser des classes, c'est moins lourd
	$RessourceCode->enable_keyword_links(false);
	echo $RessourceCode->parse_code();
	echo '</fieldset>';
}
?>
<h1>Envie d'essayer le Typographe ?</h1>
<p class="important">Pour des raisons d'ordre pratique (affichage des codes sources d'un serveur), cette page n'est pas mise en forme avec le Typographe. Vous pouvez donc y trouver des aberrations que le Typographe corrige normalement.</p>
<div class="TOC floatR insideTOC"></div>

<p>Vous voulez utiliser <a href="./">le Typographe</a> sur votre site Web ? C'est tr�s simple, suivez le guide !<br />

<h2 style="clear:right;">Installation</h2>
<h3>�tape 1 : cr�ation du conteneur</h3>
<p>Il vous suffit de cr�er un nouveau dossier sur votre site qui contiendra l'ensemble des fichiers. Nommez-le par exemple "Typo".</p>

<h3>�tape 2 : r�cup�ration du contenu</h3>
<p>Le Typographe inclut un module de mise � jour automatique. Il vous suffit donc de t�l�charger le fichier g�rant la Mise � Jour pour r�cup�rer la version la plus � jour du Typographe. Le code source du fichier est juste en-dessous :</p>

<?php Source('MAJ_client.php',file_get_contents('../../lib/Typo/MAJ_client.php')); ?>

<p>Enregistrez ce document sous le nom <tt>MAJ_client.php</tt> dans votre r�p�rtoire cr�e � l'�tape 1.</p>

<h3>�tape 3 : t�l�chargement des donn�es</h3>
<p>Ex�cutez maintenant le fichier <tt>MAJ_client.php</tt> en l'appelant depuis votre navigateur (e.g. http://votresite.fr/Typo/MAJ_client.php).<br />
Vous devriez avoir alors des messages vous informant de la progression de la mise � jour. Une fois le script termin�, regardez dans votre FTP le dossier Typo qui a d� se remplir de donn�es.</p>

<p class="important">L'installation est alors termin�e.</p>



<h2>Utilisation</h2>
<h3>Initialisation</h3>
<p>Sur chaque page o� vous souhaitez utiliser le Typographe, vous devrez :</p>
<ul>
	<li>Inclure le code source du Typographe au d�but de chaque page qui doit l'utiliser (ou dans votre <tt>header.php</tt> pour une utilisation sur toutes les pages) : <?php Source('Inclusion Typographe',"include('Chemin/Vers/Typo/Typo.php');"); ?></li>
	<li>Inclure la feuille de style de base du Typographe dans votre HTML (<tt>Chemin/Vers/Typo/Typo.css</tt>). Notez que son utilisation n'est pas obligatoire mais fortement recommand�e ; en effet la feuille ne d�finit pas de mise en forme au sens graphique mais plus les conventions typographiques : par exemple, afficher un "R�sum�" au dessus des environnements abstracts, enlever l'emphase � l'int�rieur d'une autre emphase, <em>etc.</em> :
	<?php Source('CSS Typographe','<link rel="stylesheet" type="text/css" href="https://neamar.fr/lib/Typo/Typo.css" />'); ?></li>
</ul>

<h3>Utilisation</h3>
<p>L'utilisation du Typographe se fait en deux temps : premi�rement, r�gler le texte, ensuite, demander une sortie mise en forme.</p>
<h4>R�gler le texte</h4>
<p>Deux m�thodes sont disponibles : <tt>Typo::setTexte($Texte);</tt> et <tt>Typo::setTexteFromFile($Fichier);</tt>. Si le texte n'est pas un string, ou si le fichier n'existe pas, une erreur sera d�clench�e : vous pouvez supprimer ce comportement en activant l'option <tt>RAISE_NO_ERROR</tt>, mais ceci est fortement d�conseill�.</p>
<h4>R�cup�rer la sortie</h4>
<p>Une fois le texte enregistr� en m�moire, vous pouvez le r�cup�rer de trois fa�ons diff�rentes :</p>
<ol>
	<li>La premi�re et la plus courante se fait avec <tt>Typo::Parse()</tt> qui renverra alors un chaine de caract�res au format HTML.</li>
	<li>La seconde option est de r�cup�rer un texte "plat" : toutes les balises seront alors n�glig�es, mais les ligatures, tirets, guillemets et autres seront correctement format�s. Ceci peut �tre utile pour afficher une version "light" du texte.</li>
	<li>Derni�re option : afficher le texte en mode �dition avec <tt>Typo::renderIDE()</tt>. Le Typographe dessine alors un IDE complet pour mettre en forme le texte. L'int�gration de l'IDE est d�finie plus loin, ainsi que les options disponibles.</li>
</ol>

<h3>Exemple d'utilisation</h3>
<p>Voici un exemple d'utilisation basique :</p>
<?php Source('Exemple d\'utilisation',"
include('Chemin/Vers/Typo/Typo.php');
Typo::setTexte('Ceci est un texte exemple, avec un minimum de mise en forme - ceci est, par exemple,
en \b{gras} tandis que ceci est en \i{italique}.');

//Renvoie :
//<p>Ceci est un texte exemple, avec un minimum de mise en forme &ndash; ceci est, par exemple,
//en <strong>gras</strong> tandis que ceci est en <em>italique</em>. </p>
echo Typo::Parse();");
?>

<h2>Pour aller plus loin...</h2>
<p class="important">Cette �tape est facultative.</p>
<h3>Mise � jour</h3>
<p>Le Typographe est en mutation constante.<br />
Vous pouvez remettre � jour la version dont vous disposer en appelant � nouveau le fichier <tt>MAJ_client.php</tt> : si des nouveaut�s sont disponibles, la mise � jour sera automatiquement effectu�e.<br />
<strong>Si vous ne souhaitez pas laisser un acc�s � votre site, pensez � supprimer le fichier <tt>MAJ_client.php</tt> qui peut potentiellement �tre une faille de s�curit�.</strong></p>
<h3>Configuration</h3>
<p>Il se peut que la configuration par d�faut ne vous plaise pas. Vous disposez d'un ensemble d'options pour transformer le Typographe en module agr�able.</p>
<p>Consultez les premi�res lignes du fichier <tt>Typo.php</tt> pour voir les options disponibles.</p>
<p>Voici par exemple la configuration pour �crire un texte en anglais, en interdisant les balises titres, en utilisant le moteur math�matique et en affichant les footnotes entre parenth�ses:</p>
<?php Source('Configuration d\'exemple','
Typo::switchLanguage("en");

//Les textes entre $ seront remplac�s par leur �quivalent LaTeX.
Typo::addOption(PARSE_MATH);

//removeOption supprime l\'option : les \\section, \\subsection et autres ne seront pas remplac�s.
Typo::removeOption(ALLOW_SECTIONING);

//Pour que les notes de bas de page soient entour�es de parenth�ses,
//ce qui �vite de les confondre avec des puissances math�matiques.
Typo::addOption(ALLOW_FOOTNOTE,FOOTNOTE_SCIENCE);'); ?>

<h3>Langage</h3>
<p>Chaque langue a ses propres r�gles typographiques. Le Typographe fournit des fichiers de configuration indiquant de quelle fa�on le texte doit �tre rendu.<br />
Par d�faut, le Typographe charge les fichiers de configuration pour la langue fran�aise.</p>
<?php Source('Exemple d\'utilisation des langues',"
Typo::setTexte('Une phrase,sans r�gles;qui sera correctement - enfin normalement - mise en forme selon les standards du pays !');
echo Typo::parseLinear();
Typo::switchLanguage('en');
echo Typo::parseLinear(); ");?>
<p>Ce qui renverra :<br />
<tt>Une phrase, sans r�gles&nbsp;; qui sera correctement &ndash; enfin normalement &ndash; mise en forme selon les standards du pays&nbsp;!<br />
Une phrase, sans r�gles; qui sera correctement&mdash;enfin normalement&mdash;mise en forme selon les standards du pays!</tt></p>

<h3>Ajout de balises</h3>
<p>Si vous le souhaitez, vous pouvez ajouter de nouvelles balises ou en supprimer certaines. Attention, ceci n�cessite une connaissance des expressions r�guli�res !<br />
La liste des balises par d�faut se trouve dans le fichier <tt>Lng/fr.php</tt>. Ne modifiez pas cette liste, car le fichier peut �tre �cras� � tout moment par une mise � jour : pr�f�rez donc utiliser la m�thode <tt>addBalise()</tt>.</p>
<?php Source('Exemple de configuration des balises',"
//Red�finir la balise \\ref pour effectuer un lien vers un article pr�cis plut�t que vers une section de la page.
Typo::addBalise('#\\\\ref\[(.+)\]{(.+)}#isU','<a href=\"/O/$1\">$2</a>');

//D�finir une nouvelle balise.
Typo::addBalise('#\\\\sagaref\[(.+)\]{(.+)}#isU','<a href=\"/Liste/$1\">$2</a>');");?>

<h3>IDE</h3>
<p>L'affichage de l'IDE peut �tre personnalis� en envoyant en param�tres un tableau d'options. Ceci permet par exemple de d�finir un bouton affichant dynamiquement un apercu du texte.</p>
<?php Source('Exemple de configuration de l\'IDE',"
Typo::setTexteFromFile('UnFichierTexte.txt');
//Si aucun param�tre n'est sp�cifi�, l'IDE est affich� avec le name Texte, 10 lignes et 25 colonnes.
//Ici, on �crase les param�tres par d�faut.
Typo::renderIDE(array('Name'=>'Editeur','Rows'=>20,'Cols'=>15));
");?>
<p>Comme dit plus haut, vous pouvez configurer un module d'affichage pour un aper�u. Ceci se passe via l'option Preview du tableau d'options :</p>
<?php Source('Exemple de configuration de l\'IDE',"
Typo::setTexte(\$News);
//Les param�tres doivent inclure :
// - L'url � appeler (les donn�es sont fournies via la m�thode POST, variable Texte : c'est � vous de les traiter.
//  Le plus souvent, un simple Typo::Parse(); suffit.
// - L'ID de l'�l�ment  HTML dans lequel le r�sultat doit �tre affich�.
Typo::renderIDE(array(
	'Name'=>'texte-' . \$ID,
	'Rows'=>30,
	'Preview'=>array(
		'URL'=>'/membres/preview.php',
		'ID'=>'Typo_preview-' . \$ID
		)
	)
);
");?>

<h2>Pour aller plus loin...</h2>
<p>Si vous ne trouviez pas votre bonheur dans cette rapide pr�sentation, <a href="/Mail.php">vous pouvez me contacter</a>.</p>

<?php
include('../footer.php');
