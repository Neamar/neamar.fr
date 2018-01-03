<?php
$UseMath=true;

$Titre='Aide pour l\'utilisation du logiciel de mise en forme';
if(isset($_GET['b']))
{
	$_GET['b']=urldecode($_GET['b']);
	$Titre = $_GET['b'] . ' &ndash; ' . $Titre;
}

$Box = array("Auteur" => "Neamar","Date" => "2009");

$AddLine='<link rel="stylesheet" type="text/css" href="https://neamar.fr/lib/Typo/Typo.css" />
<style type="text/css">
.code_box
{
	background-color:#EEEEFF;
	border:2px solid #CCCCCC;
	margin:15px;
	padding:15px;
}
</style>';
include('../../header.php');
include('../../../lib/Typo.php');

?>
<h1><?php echo $Titre; ?></h1>
<p class="auteur">Neamar</p>
<p><a href=".">Index de l'aide</a></p>


<?php
function Linearise($Item)
{
	$Retour ='<h3><a href="/Res/Typo/Aide/?b=' . urlencode($Item[1]) . '">' . $Item[0] . '</a></h3>' . "\n";

	Typo::setTexte($Item[4]);
	$Retour .='<div class="code_box"><h5>Description</h5>
	<pre class="ss ms grandTexte" style="background-color:rgb(200,200,200); margin:40px;">' .
		preg_replace('#({|}|\[|\])#','<big style="color:blue;">$1</big>',preg_replace('#(\\\\\w+)({|\[)#U','<strong>$1</strong>$2',preg_replace('#(@\w+)(\W)#U','<em style="color:red;">$1</em>$2',$Item[2]))) . '</pre>';
	$Retour .=Typo::Parse()  . "\n</div>";

	Typo::setTexte(preg_replace('#(@\w+)(\W)#U','\textss{$1}$2',$Item[3]));
	$Retour .='<div class="code_box"><h5>Paramètres</h5>
	' . Typo::Parse()  . "\n</div>";


	Typo::setTexte($Item[5]);
	$Retour .='<div class="code_box"><h5>Exemple d\'utilisation</h5>
	<pre class="ss ms" style="background-color:rgb(200,200,200); margin:40px; overflow:auto;">' . preg_replace('#\\\\([-a-z]+)#i','\<a href="?b=$1">$1</a>',$Item[5]) . '</pre>';
	$Retour .= Typo::Parse()  . "\n</div>";

	return $Retour;
}

function getDocIn($From)
{
	include($From);

	$Retour='';

	foreach($Lines as $Line)
	{
		if(stripos($Line[1],$_GET['b'])!==false)
			$Retour .=Linearise($Line) . "\n\n";
	}
	return $Retour;
}

function getDoc($From)
{
	include($From);

	$Retour = '<h2>' . $Titre . '</h2>' . '<p>' . $Description . '</p>' . "\n";
	foreach($Lines as $Line)
	{
		$Retour .='<h3>' . $Line[0] . '</h3>' . "\n";
		Typo::setTexte($Line[4]);
		$Retour .=Typo::Parse();
		$Retour .='<div><a href="/Res/Typo/Aide/?b=' . urlencode($Line[1]) . '">Aide à l\'utilisation de <em>' . $Line[0] . '</em></a></div>' . "\n";
	}
	return $Retour;
}

if(isset($_GET['b']))
{
	echo getDocIn('Semantique.php');
	echo getDocIn('MEF.php');
	echo getDocIn('Env.php');
	echo getDocIn('MOC.php');
}
else
{
	echo '<p class="important">Ce qui suit est l\'aide détaillée du Typographe. Vous pouvez consulter un <a href="../Apercu.php">aperçu rapide</a> si vous ne savez pas pas où commencer...</p>';
	echo getDoc('Semantique.php');
	echo getDoc('MEF.php');
	echo getDoc('Env.php');
	echo getDoc('MOC.php');
}
?>

<p><a href=".">Index de l'aide</a></p>
<p class="discret petitTexte centre">Mis en forme avec <a href="https://neamar.fr/Res/Typo/">le typographe</a></p>

<?php
include('../../footer.php');
?>
