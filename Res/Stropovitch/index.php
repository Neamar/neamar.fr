<?php
$Titre='Roman : Stropovitch, le P�lerinage du D�mon';
$Box = array("Auteur" => "Stropovitch","Date" => "2007-2008","Voir aussi"=>'<a href="http://forums.wow-europe.com/thread.html?topicId=298635138" rel="nofollow">Forum associ�</a>');

$AddLine='<link rel="stylesheet" type="text/css" href="https://neamar.fr/lib/Typo/Typo.css" />';

include('../header.php');
include("Parse.php");

// if(is_file('Cache'))
// 	echo file_get_contents("Cache");
// else
// {
?>

<div style="background:white url('Images/Draenei_Clair.png') no-repeat fixed bottom;" id="Layer">
<h1>Stropovitch, le P�lerinage du D�mon</h1>
<?php
ParseChapter('Prologue','Prologue');
?>
<h2>Premi�re partie : Echos</h2>
<?php
for($i=1;$i<=6;$i++)
	ParseChapter('Chapitre ' . $i,'Chap-' . $i);
?>
<h2>Deuxi�me partie : Guerrier</h2>
<?php
for($i=7;$i<=16;$i++)
	ParseChapter('Chapitre ' . $i,'Chap-' . $i);
?>
<h2>Troisi�me partie : Destins </h2>
<?php
for($i=17;$i<=20;$i++)
	ParseChapter('Chapitre ' . $i,'Chap-' . $i);
?>
<h2>Quatri�me partie : Apocalypses </h2>
<?php
ParseChapter('','Chap-21');


// }
?>

<p>
<br />
� SUIVRE...</p>
</div>
<?php
include('../footer.php');
?>
