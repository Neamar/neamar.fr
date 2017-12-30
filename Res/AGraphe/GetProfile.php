<?php
$Empl='Joueurs/' . $_SERVER['REMOTE_ADDR'];
if(!file_exists($Empl))
{
	$fichier = fopen($Empl, 'a'); //Ouvrir le fichier
	fputs($fichier, '0');//Puis enregistrer les données
	fputs($fichier, "\n");
	fclose($fichier); //Et fermer le fichier
}

$fichier = fopen($Empl, 'r'); //Ouvrir le fichier
echo fgets($fichier);
fclose($fichier); //Et fermer le fichier

?>