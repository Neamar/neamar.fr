<?php
$Empl='Joueurs/' . $_SERVER['REMOTE_ADDR'];
$fichier = fopen($Empl, 'w'); //Ouvrir le fichier
if(is_numeric($_GET['LVL']))
	fputs($fichier, $_GET['LVL']);//Puis enregistrer les données...
else
	fputs($fichier, 0);//Problème
fputs($fichier, "\n");
fclose($fichier); //Et fermer le fichier
?>