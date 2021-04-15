<?php
@ini_set('default_charset', 'ISO-8859-1');

/*
- $Titre permet de donner un titre � la page.
- $UseMath=true active le parseur LaTeX
- $noKeyWords=true empeche la g�n�ration dynamique des mots cl�s
- $AddLine contient des lignes � ajouter dans la partie <head> de la page.
- $ScriptURI contient une adresse vers un script. S'il n'est pas fourni, c'est le script par d�faut qui est appel�.
*/


function InclureCode($URL,$LNG="AUCUN",$Discret=false,$UseClass=true)
{
	global $codeAreUTF8;
	$CodeSource=file_get_contents('Codes/' . $URL);
	if(isset($codeAreUTF8))
		$CodeSource=utf8_decode($CodeSource);

	echo '<fieldset>' . "\n" . '<legend>Code source : <a href="Codes/' . $URL . '" title="T�lecharger le fichier">' . $URL . '</a></legend>'. "\n";
	if($LNG!="AUCUN")
	{
		if(!$Discret)
		{
			echo '<ul><li>Langage : <em>' . $LNG . '</em></li><li>Taille : ' . filesize('Codes/' . $URL) . ' caract�res</li></ul>';
		}
		echo '<pre>' . nl2br(htmlspecialchars($CodeSource)) . '</pre>';
	}
	else
		echo $CodeSource;
	echo "</fieldset>";
}

if(file_exists('Abstract.htm'))
	$Abstract=file_get_contents('Abstract.htm');

$keyWords='';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<title><?php echo $Titre; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="owner" content="Neamar" />
	<meta name="author" content="Neamar" />
	<meta name="robots" content="all" />
	<meta name="rating" content="general" />
	<meta name="reply-to" content="neamar@neamar.fr" />
	<meta name="copyright" content="Copyright � - Some Right Reserved - 2006-<?php echo date("Y"); ?>" />
	<?php
	if(isset($Abstract))
		echo '<meta name="description" content="' . str_replace("\n",'',str_replace('<br />','',str_replace('"','\'',htmlentities($Abstract)))) . '" />' . "\n";
	?>

	<link href="//neamar.fr/Res/ressources.css" rel="stylesheet" type="text/css" media="screen, handheld" />
	<link href="//neamar.fr/Res/ressources_print.css" rel="stylesheet" type="text/css" media="print" />
	<link rel="stylesheet" type="text/css" href="//neamar.fr/Res/Codes.css" />

	<?php if(isset($AddLine)) echo $AddLine; ?>
	<link rel="icon" type="image/x-icon" href="https://neamar.fr/favicon.ico" />
	<script type="text/javascript" src="<?php if(!isset($ScriptURI)){ echo 'https://neamar.fr/Res/ressources.js';} else { echo $ScriptURI; }?>"></script>

	<script async defer data-domain="neamar.fr" src="https://a.neamar.fr/js/plausible.js"></script>

</head>

<body>
<div id="Main">
<?php
if(isset($Abstract) && preg_match('#^/Res/(.+)/$#U',$_SERVER['REQUEST_URI']))//N'afficher le r�sum� que sur la page d'index.
	echo '<p class="abstract erreur"><q>' .$Abstract . '</q></p>';

function flashPlayerStats() {
	echo '(non disponible)';
}
?>
