<?php
$Titre='TXT2JPG online : récupération des images.';
$Box = array("Auteur" => "Neamar","Date" => "2009");

include('../../ConnectBDD.php');
include('../header.php');
echo '<h1>' . $Titre . '</h1>';

define('MAX_TEXT_SIZE',50000);
?>
<div class="centre">
<script type="text/javascript"><!--
google_ad_client = "pub-4506683949348156";
/* Neamar.fr/Res Footer */
google_ad_slot = "5933721578";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>

<?php
if(!isset($_POST['texte']) || $_POST['texte']=='' || intval($_POST['width'])<50 || intval($_POST['height'])<50 || $_POST['captcha']!='dix')
{
	echo '<p class="erreur">Paramètres de numérisation incorrects. <a href="../OT2J/">Revenir au formulaire</a>.</p>';
	exit();
}
function makeTextBlock($text, $fontfile, $fontsize, $width)
{
	$words = explode(' ', $text);
	$lines = array($words[0]);
	$currentLine = 0;
	for($i = 1; $i < count($words); $i++)
	{
		$lineSize = imagettfbbox($fontsize, 0, $fontfile, $lines[$currentLine] . ' ' . $words[$i]);
		if($lineSize[2] - $lineSize[0] < $width)
		{
			$lines[$currentLine] .= ' ' . $words[$i];
		}
		else
		{
			$currentLine++;
			$lines[$currentLine] = $words[$i];
		}
	}

	return explode("\n",implode("\n",$lines));
}

/**
* Return human readable sizes
*
* @author      Aidan Lister <aidan@php.net>
*/
function size_readable($size, $max = null, $si = true, $retstring = '%01.2f %s')
{
	// Pick units
	if ($si === true) {
		$sizes = array('B', 'K', 'MB', 'GB', 'TB', 'PB');
		$mod   = 1000;
	} else {
		$sizes = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB');
		$mod   = 1024;
	}

	// Max unit to display
	if ($max && false !== $d = array_search($max, $sizes)) {
		$depth = $d;
} else {
	$depth = count($sizes) - 1;
}

// Loop
$i = 0;
while ($size >= 1024 && $i < $depth) {
	$size /= $mod;
	$i++;
}

return sprintf($retstring, $size, $sizes[$i]);
}


//Récuperation des paramètres :
$Width=intval($_POST['width']);
$Height=intval($_POST['height']);
$Margin=5;

$TitreFont='Fonts/Evanescent.ttf';
if(preg_match('#[A-Z0-9_ -]+#i',$_POST['font']) && is_file('Fonts/' . $_POST['font']))
	$Font='Fonts/' . $_POST['font'];
else
	$Font='Fonts/arial.ttf';//Grandesign Neue Serif.ttf
$Size=intval($_POST['size']);
$Texte=substr(stripslashes($_POST['texte']),0,MAX_TEXT_SIZE);
$Titre=preg_replace('#[^A-Z0-9_ -]#i','',$_POST['titre']);
if($Titre=='')
	$Titre='Texte';

echo '<p>Initialisation de la conversion.<br />Taille du texte : ' . strlen($Texte) . ' caractères. Les textes sont tronqués à ' . MAX_TEXT_SIZE . ' caractères.<br />';

//Calcul des paramètres nécessaires
$Directory='Img/' . uniqid($_POST['titre']);
mkdir($Directory);

$zip=new ZipArchive();
$ZipName=$Directory . '/' . str_replace(' ','_',$Titre) . '.zip';
$zip->open($ZipName,ZIPARCHIVE::CREATE);

$Lignes=makeTextBlock($Texte,$Font,$Size,$Width-2*$Margin);
$lineHeight= imagettfbbox($Size, 0, $Font, 'PDgj');
$lineHeight=$lineHeight[1]-$lineHeight[7];
$Pages=array_chunk($Lignes,floor(($Height-2*$Margin-$lineHeight)/($lineHeight+2)));

//Sauvegarde en SQL des infos :
mysql_query('INSERT INTO OT2J_Textes
VALUES
(
"",
"' . mysql_real_escape_string($_POST['Titre']) . '",
"' . mysql_real_escape_string($Texte) . '",
"' . $_SERVER['REMOTE_ADDR'] . '",
NOW(),
"' . mysql_real_escape_string($Directory) .'"
)');


echo 'Création d\'un fichier ZIP contenant ' . count($Pages) . ' images ; taille ' . $Width . 'x' . $Height . '<br />';

//Création de la couverture :
$Pic = imagecreate($Width,$Height);
$black = imagecolorallocate($Pic, 0, 0, 0);
$white = imagecolorallocate($Pic, 255, 255, 255);

$Contenu=$Titre . '

Nombre d\'images :            ' . count($Pages) . '
Nombre de mots :            ' . count(preg_split('#\s#',$Texte)) . '
Nombre de caractères :    ' . strlen($Texte) . '

Converti avec
http://neamar.fr/Res/OT2J';

$Dest=$Directory . '/0.jpg';

imagettftext($Pic,16, 0, $Margin, $Margin+$lineHeight, $white,$TitreFont, $Contenu);

imagejpeg($Pic,$Dest);
imagedestroy($Pic);
// echo '<img src="' . $Dest . '" /><br /><hr />' . "\n";
$zip->addFile($Dest, '0.jpg');





//Création des images.
foreach($Pages as $Page=>$Contenu)
{
	$Pic = imagecreate($Width,$Height);
	$white = imagecolorallocate($Pic, 255, 255, 255);
	$black = imagecolorallocate($Pic, 0, 0, 0);

	$Contenu=implode("\n",$Contenu);
	$Dest=$Directory . '/' . ($Page+1) . '.jpg';

	imagettftext($Pic, $Size, 0, $Margin, $Margin/2+$lineHeight, $black,$Font, $Contenu);

	imagejpeg($Pic,$Dest);
	imagedestroy($Pic);

// 	echo '<img src="' . $Dest . '" /><br /><hr />' . "\n";
	$zip->addFile($Dest, ($Page +1) . '.jpg');
}

//finaliser le travail en fermant l'archive zip.
echo 'Finalisation : écriture sur le disque du fichier zip.<br />';
$zip->close();

echo '<big><a href="' . $ZipName . '">Télécharger « ' . $_POST['titre'] . ' »</a></big> (' . size_readable(filesize($ZipName)) . ')</p>';

echo '<p class="centre">Première image :<br /><img src="' . $Directory . '/0.jpg" class="nonflottant"/><br />Merci d\'avoir utilisé OnlineTXT2JPG.</p>' . "\n";
include('../footer.php');
?>