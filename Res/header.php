<?php
@ini_set('default_charset', 'ISO-8859-1');

/*
- $Titre permet de donner un titre à la page.
- $UseMath=true active le parseur LaTeX
- $noKeyWords=true empeche la génération dynamique des mots clés
- $AddLine contient des lignes à ajouter dans la partie <head> de la page.
- $ScriptURI contient une adresse vers un script. S'il n'est pas fourni, c'est le script par défaut qui est appelé.
*/


function InclureCode($URL,$LNG="AUCUN",$Discret=false,$UseClass=true)
{
	global $codeAreUTF8;
	$CodeSource=file_get_contents('Codes/' . $URL);
	if(isset($codeAreUTF8))
		$CodeSource=utf8_decode($CodeSource);

	echo '<fieldset>' . "\n" . '<legend>Code source : <a href="Codes/' . $URL . '" title="Télecharger le fichier">' . $URL . '</a></legend>'. "\n";
	if($LNG!="AUCUN")
	{
		if(!$Discret)
		{
			$RessourceCode->set_header_content('<ul><li>Langage : <em>{LANGUAGE}</em></li><li>&Delta;T : <em>{TIME}s</em></li><li>Taille :' . filesize('Codes/' . $URL) . ' caractères</li></ul>');
			$RessourceCode->set_header_type(GESHI_HEADER_DIV);
		}
		$CodeColorie=$RessourceCode->parse_code();
		echo '<pre>' . nl2br(htmlspecialchars($Source)) . '</pre>';
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
	<meta name="copyright" content="Copyright © - Some Right Reserved - 2006-<?php echo date("Y"); ?>" />
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
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-4257957-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-4257957-1');
	</script>

</head>

<body>
<div id="Main">
<?php
if(isset($Abstract) && preg_match('#^/Res/(.+)/$#U',$_SERVER['REQUEST_URI']))//N'afficher le résumé que sur la page d'index.
	echo '<p class="abstract erreur"><q>' .$Abstract . '</q></p>';

function flashPlayerStats() {
	echo '(non disponible)';
}
?>
