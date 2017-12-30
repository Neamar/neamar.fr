<?php
include_once('../../lib/Typo.php');
Typo::addOption(P_UNGREEDY);

function ParseChapter($Titre,$Fichier)
{

	Typo::setTexteFromFile('Textes/' . $Fichier . '.txt');

	if($Titre!='')
		echo  "\n\n\n" . '<h3>' . $Titre . "</h3>\n\n\n";
	echo str_replace(array('&lt;','&gt;','<i>','</i>'),array('<','>','<em>','</em>'),Typo::Parse(true));
}