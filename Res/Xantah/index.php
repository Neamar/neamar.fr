<?php
//Infos relatives � la saga
$_Nom='Xantah';
$_Auteur='Nico &amp; Matt';
$_Prefix='Xantah';
$NBEpisode=5;
$PersoDefaut=array("KANNITSH"=>"ABCDFF","ROSTEN"=>"ff0000","GONTO"=>"00ff00", "GLOOMY"=>"0000ff");
$Bonus=array();

//Infos relatives � l'affichage
$NoPub=true;
$Box = array(
	'Auteur Textes' => $_Auteur,
	'Mise en forme' => 'Neamar',
	'Date' => 'Jui. 2011',
	'But' =>'R�f�rences',
	'Index Xantah'=>'<a href="./">Accueil Xantah</a>',
	'� voir' => '<a href="/Res/Adoprixtoxis">Adoprixtoxis</a>',
	'� voir ' => '<a href="/Res/Reflets">Reflets d\'acide</a>');

$UseCache=true;//false;
define('FILE_ARE_UTF8',true);

///--------------------------
//Puis l'afficher comme n'importe quelle saga
include('../Sagas/index.php');
?>
