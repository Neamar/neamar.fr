<?php
//Infos relatives � la saga
$_Nom='Reflets d\'Acide';
$_Auteur='JBX';
$NBEpisode=15;
$_Prefix='Reflets';
$PersoDefaut=array("NARRATEUR"=>"ABCDFF","ENORIEL"=>"ff0000","ZARAKA�"=>"00ff00","TRICHELIEU"=>"0000ff","WRANDRALL"=>"000000","ZEHIRMANN"=>"AAAAAA","MOUMOUNE"=>"FF22AA","ROGER"=>"AAFF22", "KYO"=>"22AAFF");
$Bonus=array('Krak','Avril','BoitePerdue','BoitePerdue_2','Noel_d_Acide','Joyeux_Noel','Franconie','Fleau','Narrateur_Avril','Alkoor','Mordave','Cadeau_Acide','Cadeau_Accidentel',);

//Infos relatives � l'affichage
$NoPub=true;
$Box = array(
	"Auteur Textes" =>$_Auteur,
	"Mise en forme" => "Neamar",
	"Date" => "Ao�t 2008",
	"But" =>"R�f�rences",
	'Index RdA'=>'<a href="./">Accueil RdA</a>',
	'� voir'=>'<a href="/Res/Adoprixtoxis">Adoprixtoxis</a>');

///--------------------------
//Puis l'afficher comme n'importe quelle saga
include('../Sagas/index.php');
?>
