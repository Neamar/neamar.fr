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

	//Charger la libraire GeShi
	include_once(substr(__FILE__,0,strrpos(__FILE__,'/')) . '/../lib/geshi.php');
	echo '<fieldset>' . "\n" . '<legend>Code source : <a href="Codes/' . $URL . '" title="T�lecharger le fichier">' . $URL . '</a></legend>'. "\n";
	if($LNG!="AUCUN")
	{
		$RessourceCode = new GeSHi($CodeSource,$LNG);
		if($UseClass)
			$RessourceCode->enable_classes();//Utiliser des classes, c'est moins lourd
		if(!$Discret)
		{
			$RessourceCode->set_header_content('<ul><li>Langage : <em>{LANGUAGE}</em></li><li>&Delta;T : <em>{TIME}s</em></li><li>Taille :' . filesize('Codes/' . $URL) . ' caract�res</li></ul>');
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


	<link href="//neamar.fr/Res/Office.css" rel="stylesheet" title="Office" type="text/css" media="screen, handheld" />

	<link href="//neamar.fr/Res/dream.css" rel="alternate stylesheet" title="Dream" type="text/css" />

	<link rel="stylesheet" type="text/css" href="//neamar.fr/Res/Codes.css" />
	<?php if(isset($AddLine)) echo $AddLine; ?>
	<link rel="icon" type="image/x-icon" href="http://neamar.fr/favicon.ico" />
	<script type="text/javascript" src="<?php if(!isset($ScriptURI)){ echo 'http://neamar.fr/Res/ressources.js';} else { echo $ScriptURI; }?>"></script>
</head>

<body>
<div id="Main">
<?php
if(isset($Abstract) && preg_match('#^/Res/(.+)/$#U',$_SERVER['REQUEST_URI']))//N'afficher le r�sum� que sur la page d'index.
	echo '<p class="abstract erreur"><q>' .$Abstract . '</q></p>';

//enregistrer les infos sur le Referrer dans le fichier Stats :

echo '/app/mount/Res/' . $_SERVER['REQUEST_URI'] . '/Stats.txt';
$fichier = fopen('/app/mount/Res/' . $_SERVER['REQUEST_URI'] . '/Stats.txt', 'a'); //Ouvrir le fichier
if(!isset($_SERVER['HTTP_REFERER']))
	$_SERVER['HTTP_REFERER']='';
$Chaine = time() . '|' .  $_SERVER['REMOTE_ADDR'] . '|' . $_SERVER['HTTP_REFERER'] . '|';	//Formater la chaine : Date|IP|Referrer
fputs($fichier, $Chaine);//Puis enregistrer les donn�es
fputs($fichier, "\n");
fclose($fichier); //Et fermer le fichier
?>
