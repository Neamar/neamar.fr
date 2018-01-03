<?php
$Titre='Fouille de données dans les réseaux sociaux : synthèse bibliographique';
$Box = array("Date" => "2012", 'PDF'=>'<a href="fouille_donnees.pdf">Version PDF</a>');
$AddLine='<link rel="stylesheet" type="text/css" href="http://neamar.fr/lib/Typo/Typo.css" />';
$UseMath=true;
include('../header.php');
include('../Typo/Typo.php');
?>

<h1>Fouille de données dans les réseaux sociaux</h1>
<p class="auteur">Matthieu, Gaëtan, Benoît, Stéphane</p>

<?php
/**
 * PHASE 1 : récupération
 */
//Récupérer le document de base
$content = file_get_contents('content/main.tex');

//Insérer les fichiers secondaires :
$content = preg_replace_callback("`\\\\input\{(.+)\}`", create_function('$matches', 'return file_get_contents("content/" . $matches[1] . ".tex");'), $content);

$content = utf8_decode($content);

/**
 * PHASE 2 : traitement
 */

//Sauts de lignes
$content = preg_replace("`\\\\\\\\\n`U", "\n", $content);

$references = array();
function citation($matches)
{
	global $references;

	$currentRef = strtolower($matches[1]);
	$references[$matches[1]] = true;

	return '\quote{[' . strtolower($currentRef) . ']}';
}
$content = preg_replace_callback("`\\\\cite{(.+)}`U", citation, $content);


Typo::setTexte($content);
Typo::addOption(P_UNGREEDY);
echo Typo::Parse();
?>












<h2>Références</h2>
<ul>
<?php
//Liste des références :
$referencesFile = utf8_decode(file_get_contents('content/references.bib'));
foreach($references as $reference => $_)
{
	$regResult = array();

	preg_match('`{' . $reference . '[^}]*title\s*= "(.+)"`U', $referencesFile, $regResult);
	$title = $regResult[1];

	preg_match('`{' . $reference . '[^}]*author\s*= "(.+)"`U', $referencesFile, $regResult);
	$author = $regResult[1];

	preg_match('`{' . $reference . '[^}]*year\s*= "?([0-9]{4})"?`U', $referencesFile, $regResult);
	$year = $regResult[1];

	preg_match('`{' . $reference . '[^}]*note\s*= "URL : (.+)"`U', $referencesFile, $regResult);
	$url = $regResult[1];

	if(!isset($url[0]))
	{
		echo '<li><tt>' . $reference . '</tt> (' . $year . ')&nbsp;: <em>' . $title . '</em>, ' . $author . '</li>';
	}
	else
	{
		echo '<li><tt>' . $reference . '</tt> (' . $year . ')&nbsp;: <em><a href="' . $url . '">' . $title . '</a></em>, ' . $author . '</li>';
	}
}
?>
</ul>

<p class="petitTexte centre">Mis en forme avec <a href="../Typo">le Typographe</a></p>

<style type="text/css">
img
{
	float:none;
	text-align:center;
	margin:auto;
}

q:before, q:after
{
	content:""
}

q
{
	font-variant: small-caps;
}
</style>
<?php
include('../footer.php');
?>
