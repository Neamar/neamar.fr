<?php
$Titre="Intégration du Typographe sur votre site Web";
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

<p>Vous voulez utiliser <a href="./">le Typographe</a> sur votre site Web ? C'est très simple, suivez le guide !<br />

<h2 style="clear:right;">Installation</h2>
<h3>Étape 1 : création du conteneur</h3>
<p>Il vous suffit de créer un nouveau dossier sur votre site qui contiendra l'ensemble des fichiers. Nommez-le par exemple "Typo".</p>

<h3>Étape 2 : récupération du contenu</h3>
<p>Le Typographe inclut un module de mise à  jour automatique. Il vous suffit donc de télécharger le fichier gérant la Mise À Jour pour récupérer la version la plus à jour du Typographe. Le code source du fichier est juste en-dessous :</p>

<?php Source('MAJ_client.php',file_get_contents('../../lib/Typo/MAJ_client.php')); ?>

<p>Enregistrez ce document sous le nom <tt>MAJ_client.php</tt> dans votre répértoire crée à l'étape 1.</p>

<h3>Étape 3 : téléchargement des données</h3>
<p>Exécutez maintenant le fichier <tt>MAJ_client.php</tt> en l'appelant depuis votre navigateur (e.g. http://votresite.fr/Typo/MAJ_client.php).<br />
Vous devriez avoir alors des messages vous informant de la progression de la mise à jour. Une fois le script terminé, regardez dans votre FTP le dossier Typo qui a dû se remplir de données.</p>

<p class="important">L'installation est alors terminée.</p>



<h2>Utilisation</h2>
<h3>Initialisation</h3>
<p>Sur chaque page où vous souhaitez utiliser le Typographe, vous devrez :</p>
<ul>
	<li>Inclure le code source du Typographe au début de chaque page qui doit l'utiliser (ou dans votre <tt>header.php</tt> pour une utilisation sur toutes les pages) : <?php Source('Inclusion Typographe',"include('Chemin/Vers/Typo/Typo.php');"); ?></li>
	<li>Inclure la feuille de style de base du Typographe dans votre HTML (<tt>Chemin/Vers/Typo/Typo.css</tt>). Notez que son utilisation n'est pas obligatoire mais fortement recommandée ; en effet la feuille ne définit pas de mise en forme au sens graphique mais plus les conventions typographiques : par exemple, afficher un "Résumé" au dessus des environnements abstracts, enlever l'emphase à l'intérieur d'une autre emphase, <em>etc.</em> :
	<?php Source('CSS Typographe','<link rel="stylesheet" type="text/css" href="https://neamar.fr/lib/Typo/Typo.css" />'); ?></li>
</ul>

<h3>Utilisation</h3>
<p>L'utilisation du Typographe se fait en deux temps : premièrement, régler le texte, ensuite, demander une sortie mise en forme.</p>
<h4>Régler le texte</h4>
<p>Deux méthodes sont disponibles : <tt>Typo::setTexte($Texte);</tt> et <tt>Typo::setTexteFromFile($Fichier);</tt>. Si le texte n'est pas un string, ou si le fichier n'existe pas, une erreur sera déclenchée : vous pouvez supprimer ce comportement en activant l'option <tt>RAISE_NO_ERROR</tt>, mais ceci est fortement déconseillé.</p>
<h4>Récupérer la sortie</h4>
<p>Une fois le texte enregistré en mémoire, vous pouvez le récupérer de trois façons différentes :</p>
<ol>
	<li>La première et la plus courante se fait avec <tt>Typo::Parse()</tt> qui renverra alors un chaine de caractères au format HTML.</li>
	<li>La seconde option est de récupérer un texte "plat" : toutes les balises seront alors négligées, mais les ligatures, tirets, guillemets et autres seront correctement formatés. Ceci peut être utile pour afficher une version "light" du texte.</li>
	<li>Dernière option : afficher le texte en mode édition avec <tt>Typo::renderIDE()</tt>. Le Typographe dessine alors un IDE complet pour mettre en forme le texte. L'intégration de l'IDE est définie plus loin, ainsi que les options disponibles.</li>
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
<p class="important">Cette étape est facultative.</p>
<h3>Mise à jour</h3>
<p>Le Typographe est en mutation constante.<br />
Vous pouvez remettre à jour la version dont vous disposer en appelant à nouveau le fichier <tt>MAJ_client.php</tt> : si des nouveautés sont disponibles, la mise à jour sera automatiquement effectuée.<br />
<strong>Si vous ne souhaitez pas laisser un accès à votre site, pensez à supprimer le fichier <tt>MAJ_client.php</tt> qui peut potentiellement être une faille de sécurité.</strong></p>
<h3>Configuration</h3>
<p>Il se peut que la configuration par défaut ne vous plaise pas. Vous disposez d'un ensemble d'options pour transformer le Typographe en module agréable.</p>
<p>Consultez les premières lignes du fichier <tt>Typo.php</tt> pour voir les options disponibles.</p>
<p>Voici par exemple la configuration pour écrire un texte en anglais, en interdisant les balises titres, en utilisant le moteur mathématique et en affichant les footnotes entre parenthèses:</p>
<?php Source('Configuration d\'exemple','
Typo::switchLanguage("en");

//Les textes entre $ seront remplacés par leur équivalent LaTeX.
Typo::addOption(PARSE_MATH);

//removeOption supprime l\'option : les \\section, \\subsection et autres ne seront pas remplacés.
Typo::removeOption(ALLOW_SECTIONING);

//Pour que les notes de bas de page soient entourées de parenthèses,
//ce qui évite de les confondre avec des puissances mathématiques.
Typo::addOption(ALLOW_FOOTNOTE,FOOTNOTE_SCIENCE);'); ?>

<h3>Langage</h3>
<p>Chaque langue a ses propres règles typographiques. Le Typographe fournit des fichiers de configuration indiquant de quelle façon le texte doit être rendu.<br />
Par défaut, le Typographe charge les fichiers de configuration pour la langue française.</p>
<?php Source('Exemple d\'utilisation des langues',"
Typo::setTexte('Une phrase,sans règles;qui sera correctement - enfin normalement - mise en forme selon les standards du pays !');
echo Typo::parseLinear();
Typo::switchLanguage('en');
echo Typo::parseLinear(); ");?>
<p>Ce qui renverra :<br />
<tt>Une phrase, sans règles&nbsp;; qui sera correctement &ndash; enfin normalement &ndash; mise en forme selon les standards du pays&nbsp;!<br />
Une phrase, sans règles; qui sera correctement&mdash;enfin normalement&mdash;mise en forme selon les standards du pays!</tt></p>

<h3>Ajout de balises</h3>
<p>Si vous le souhaitez, vous pouvez ajouter de nouvelles balises ou en supprimer certaines. Attention, ceci nécessite une connaissance des expressions régulières !<br />
La liste des balises par défaut se trouve dans le fichier <tt>Lng/fr.php</tt>. Ne modifiez pas cette liste, car le fichier peut être écrasé à tout moment par une mise à jour : préférez donc utiliser la méthode <tt>addBalise()</tt>.</p>
<?php Source('Exemple de configuration des balises',"
//Redéfinir la balise \\ref pour effectuer un lien vers un article précis plutôt que vers une section de la page.
Typo::addBalise('#\\\\ref\[(.+)\]{(.+)}#isU','<a href=\"/O/$1\">$2</a>');

//Définir une nouvelle balise.
Typo::addBalise('#\\\\sagaref\[(.+)\]{(.+)}#isU','<a href=\"/Liste/$1\">$2</a>');");?>

<h3>IDE</h3>
<p>L'affichage de l'IDE peut être personnalisé en envoyant en paramètres un tableau d'options. Ceci permet par exemple de définir un bouton affichant dynamiquement un apercu du texte.</p>
<?php Source('Exemple de configuration de l\'IDE',"
Typo::setTexteFromFile('UnFichierTexte.txt');
//Si aucun paramètre n'est spécifié, l'IDE est affiché avec le name Texte, 10 lignes et 25 colonnes.
//Ici, on écrase les paramètres par défaut.
Typo::renderIDE(array('Name'=>'Editeur','Rows'=>20,'Cols'=>15));
");?>
<p>Comme dit plus haut, vous pouvez configurer un module d'affichage pour un aperçu. Ceci se passe via l'option Preview du tableau d'options :</p>
<?php Source('Exemple de configuration de l\'IDE',"
Typo::setTexte(\$News);
//Les paramètres doivent inclure :
// - L'url à appeler (les données sont fournies via la méthode POST, variable Texte : c'est à vous de les traiter.
//  Le plus souvent, un simple Typo::Parse(); suffit.
// - L'ID de l'élément  HTML dans lequel le résultat doit être affiché.
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
<p>Si vous ne trouviez pas votre bonheur dans cette rapide présentation, <a href="/Mail.php">vous pouvez me contacter</a>.</p>

<?php
include('../footer.php');
