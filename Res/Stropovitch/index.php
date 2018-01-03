<?php
$Titre='Roman : Stropovitch, le Pèlerinage du Démon';
$Box = array("Auteur" => "Stropovitch","Date" => "2007-2008","Voir aussi"=>'<a href="http://forums.wow-europe.com/thread.html?topicId=298635138" rel="nofollow">Forum associé</a>');

$AddLine='<link rel="stylesheet" type="text/css" href="https://neamar.fr/lib/Typo/Typo.css" />';

include('../header.php');
include("Parse.php");

// if(is_file('Cache'))
// 	echo file_get_contents("Cache");
// else
// {
?>

<div style="background:white url('Images/Draenei_Clair.png') no-repeat fixed bottom;" id="Layer">
<h1>Stropovitch, le Pèlerinage du Démon</h1>
<?php
ParseChapter('Prologue','Prologue');
?>
<h2>Première partie : Echos</h2>
<?php
for($i=1;$i<=6;$i++)
	ParseChapter('Chapitre ' . $i,'Chap-' . $i);
?>
<h2>Deuxième partie : Guerrier</h2>
<?php
for($i=7;$i<=16;$i++)
	ParseChapter('Chapitre ' . $i,'Chap-' . $i);
?>
<h2>Troisième partie : Destins </h2>
<?php
for($i=17;$i<=20;$i++)
	ParseChapter('Chapitre ' . $i,'Chap-' . $i);
?>
<h2>Quatrième partie : Apocalypses </h2>
<?php
ParseChapter('','Chap-21');


// }
?>

<p>
<br />
À SUIVRE...</p>
</div>
<?php
include('../footer.php');
?>
