<?php
include('../../ConnectBDD.php');
$ID=intval($_GET['ID']);
$Texte=mysql_query('SELECT Titre, Texte,Misc FROM TYPO_Textes WHERE ID=' . $ID);
if(mysql_num_rows($Texte)!=1)
{
	echo 'Ressource non trouvée.';
	exit();
}

$Texte=mysql_fetch_assoc($Texte);

$Titre=$Texte['Titre'] . ' &ndash; Le typographe';
// $Box = array("Auteur" => "Neamar","Date" => "2009");

$AddLine='<link rel="stylesheet" type="text/css" href="http://neamar.fr/lib/Typo/Typo.css" />';
$UseMath=true;
include('../header.php');
include('../Typo/Typo.php');
echo '<p class="petitTexte"><a href="show.php?ID=' . ($ID+1) . '">Texte suivant</a></p>';
echo '<p class="petitTexte"><a href="show.php?ID=' . ($ID-1) . '">Texte précédent</a></p>';

if($Texte['Titre']!='')
	Typo::setTexte($Texte['Titre']);
else
	Typo::setTexte("Texte sans titre");
echo "\n" . '<h1>' . Typo::parseLinear() . '</h1>' . "\n\n\n\n\n\n\n\n\n\n\n\n\n<!--Début du texte-->\n\n<div id=\"Typo_Rendu\">";
if(!isset($_GET['Source']))
{
	Typo::addOption(PARSE_MATH);
	Typo::setTexte($Texte['Texte']);

	echo Typo::Parse();

	echo "</div>\n<!--Fin du texte-->\n\n\n\n\n\n\n\n\n\n\n\n\n<pre>" . $Texte['Misc'] . '</pre>';
	?>
	<div id="Typo_cut_container" style="position:relative">
		<div id="Typo_cut"><a href='#' onclick="return false;">Copier le code HTML dans le presse-papier</a></div>
	</div>

	<script type="text/javascript" src="http://neamar.fr/lib/ZeroClipboard/ZeroClipboard.js"></script>
	<script type="text/javascript">
	ZeroClipboard.setMoviePath( 'http://neamar.fr/lib/ZeroClipboard/ZeroClipboard10.swf' );
	var clip = new ZeroClipboard.Client();
	clip.setText(document.getElementById('Typo_Rendu').innerHTML);
	clip.glue('Typo_cut','Typo_cut_container');
	//window.onresize=new function(){alert('move'); clip.reposition();}
	</script>

	<?php
}
else
	echo '<pre>' . $Texte['Texte'] . '</pre>';

echo '<p class="discret petitTexte centre"><a href="show.php?ID=' . $ID . '&amp;Source">Afficher la source</a><br />Mis en forme avec <a href="http://neamar.fr/Res/Typo/">le typographe</a></p>';
include('../footer.php');
?>
