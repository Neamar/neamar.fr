<?php
//Infos relatives � la saga
$_Nom='Adoprixtoxis';
$_Auteur='Nico &amp; Matt';
$_Prefix='Adoprixtoxis';
$NBEpisode=18;
$PersoDefaut=array("GLOOMY"=>"ABCDFF","K�VIN"=>"ff0000","KELLOGS"=>"00ff00","SYPHILIS"=>"0000ff","KROTE"=>"000000","ZLUGLU"=>"AAAAAA");
$Bonus=array('Bande_Annonce','Joyeux_Noyel','Petite_Pub_Bonus','Ununktapalach','Hiver_Dernier');

//Infos relatives � l'affichage
$NoPub=true;
$Box = array(
	'Auteur Textes' => $_Auteur,
	'Mise en forme' => 'Neamar',
	'Date' => 'Oct. 2009',
	'But' =>'R�f�rences',
	'Index Adop'=>'<a href="./">Accueil Adop</a>',
	'� voir' => '<a href="/Res/Reflets">Reflets d\'acide</a>',
	'� voir ' => '<a href="/Res/Xantah">Xantah</a>',
);

$UseCache=true;//false;
define('FILE_ARE_UTF8',true);

///--------------------------
//Puis l'afficher comme n'importe quelle saga
include('../Sagas/index.php');
?>
