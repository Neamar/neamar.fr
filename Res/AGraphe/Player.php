<?php
//enregistrer les infos sur le Referrer dans le fichier Stats :
$fichier = fopen('StatsJeu.txt', 'a'); //Ouvrir le fichier
$Chaine = time() . '|' .  $_SERVER['REMOTE_ADDR'] . '|' . $_SERVER['HTTP_REFERER'] . '|';	//Formater la chaine : Date|IP|Referrer
fputs($fichier, $Chaine);//Puis enregistrer les données
fputs($fichier, "\n");
fclose($fichier); //Et fermer le fichier
?>