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

	//Charger la libraire GeShi
	include_once(substr(__FILE__,0,strrpos(__FILE__,'/')) . '/../lib/geshi.php');
	echo '<fieldset>' . "\n" . '<legend>Code source : <a href="Codes/' . $URL . '" title="Télecharger le fichier">' . $URL . '</a></legend>'. "\n";
	if($LNG!="AUCUN")
	{
		$RessourceCode = new GeSHi($CodeSource,$LNG);
		if($UseClass)
			$RessourceCode->enable_classes();//Utiliser des classes, c'est moins lourd
		if(!$Discret)
		{
			$RessourceCode->set_header_content('<ul><li>Langage : <em>{LANGUAGE}</em></li><li>&Delta;T : <em>{TIME}s</em></li><li>Taille :' . filesize('Codes/' . $URL) . ' caractères</li></ul>');
			$RessourceCode->set_header_type(GESHI_HEADER_DIV);
		}
		$RessourceCode->enable_keyword_links(false);
		$CodeColorie=$RessourceCode->parse_code();
		echo $CodeColorie;
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

//enregistrer les infos sur le Referrer dans le fichier Stats :
include_once(substr(__FILE__,0,strrpos(__FILE__,'/')) . '/../ConnectBDD.php');
mysql_query("INSERT INTO RES_Access VALUES(0, '" . mysql_real_escape_string($_SERVER['HTTP_X_FORWARDED_FOR']) . "', '" . mysql_real_escape_string($_SERVER['REQUEST_URI']) . "', '" . mysql_real_escape_string($_SERVER['HTTP_REFERER']) . "', NOW())") or die(mysql_error());

$fichier = fopen('/app/mount/' . $_SERVER['REQUEST_URI'] . '/Stats.txt', 'a'); //Ouvrir le fichier
if($fichier) {
	if(!isset($_SERVER['HTTP_REFERER']))
		$_SERVER['HTTP_REFERER']='';
	$Chaine = time() . '|' .  $_SERVER['HTTP_X_FORWARDED_FOR'] . '|' . $_SERVER['HTTP_REFERER'] . '|';	//Formater la chaine : Date|IP|Referrer
	fputs($fichier, $Chaine);//Puis enregistrer les données
	fputs($fichier, "\n");
	fclose($fichier); //Et fermer le fichier
}

function getLineCount($file)
{
	$lines = 0;

	$fh = fopen($file, 'r');
	while (!feof($fh))
	{
		fgets($fh);
		$lines++;
	}
	return $lines; // line count
}
function flashPlayerStats() {
	echo number_format(getLineCount('/app/mount/' . $_SERVER['REQUEST_URI'] . '/StatsJeu.txt'), 0, ',', ' ');
}
?>
