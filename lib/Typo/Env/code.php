<?php
//Changer le niveau du rapport d'erreur pour �viter les notices GeShi
$oldError=error_reporting(E_ALL ^ E_NOTICE);

if($Env[2]=='')//Le langage
	Typo::raiseError("Vous devez sp�cifier le langage du fichier");

//Le code peut contenir des balises qui feront bloquer typo, on ajoute donc cette option pour �viter d'afficher les erreurs.
Typo::addOption(RAISE_NO_ERROR);

$Rendu = '<fieldset>' . "\n" . '<legend>Code source (' . $Env[2] . ')</legend>'. "\n";

$NumEscape=preg_replace('#[^0-9]#','',$envContent);

$envContent=html_entity_decode(Typo::$Escape_And_Prepare['#\\\\begin\[[a-z]+\]{code}\s([^�]+)\s\\\\end{code}#isU']['_Occurrences'][$NumEscape-1]);
$Rendu .= $envContent;

$Rendu .= "</fieldset>";

$envContent=$Rendu;

error_reporting($oldError);
