<?php

function french_format($number)
{
	return number_format($number, 0, ',', ' ');
}


//Remplace count(file()) qui ne fonctionne pas sur les gros fichiers
function getLineCount($file)
{
	$lines = 0;

	$fh = fopen($file, 'r');
	while (!feof($fh))
	{
		fgets($fh);
		$lines++;
	}
	return $lines; // line count
}
ini_set('memory_limit','90M');
set_time_limit(90);
$Titre='Statistiques sur la page « ' . $_GET['For'] . ' »';
$Box = array("But" =>"Statistiques");
include('header.php');

if(!is_file($_GET['For'] . '/Stats.txt'))
	exit('Ressource inconnue.');
?>

<h1>Statistiques</h1>
<h2>Visites</h2>
<p>Nombre total de visite : <?php echo french_format(getLineCount($_GET['For'] . '/Stats.txt'));?></p>

<?php
$referrer=explode('|',str_replace("\n",'',file_get_contents($_GET['For'] . '/Stats.txt')));
$taille=count($referrer);

if($taille<86500)
	$EXCEED=false;
else
	$EXCEED=true;

$PremiereVisite=$referrer[0];
$DerniereVisite=$referrer[$taille-4];

if($EXCEED)
	$referrer=array_slice($referrer,$taille-45000,45000);//Passer à un quota "exploitable".

$Groupes=array_count_values($referrer)or die('erreur');//Equivalent du GROUP BY SQL
$URLs=array();
$Visiteurs=array();
foreach($Groupes as $URL=>$nombre)
{
	//Les URL
	if(substr($URL,0,4)=='http')
		$URLs[$URL]=$nombre;
	if(preg_match('#[0-9]{0,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[1-9]{1,3}#',$URL))
		$Visiteurs[]=$nombre;

}
?>

<p>Première visite : <?php echo date('d/m/Y',$PremiereVisite); ?><br />
<p>Dernière visite : <?php echo date('d/m/Y à H:i',$DerniereVisite) ?></p>

<h2>Visiteurs</h2>
<?php
if($EXCEED)
echo '<p class="erreur">La génération des statisitiques Visiteurs a été tronquée : trop de données à manipuler.<br />(Stats tronquées aux 45 000 derniers enregistrements)</p>';
?>
<p>Nombre total de visiteurs uniques : <?php echo french_format(count($Visiteurs));?></p>
<p>Moyenne pages vues par visiteurs : <?php echo floor(count($referrer)/3)/count($Visiteurs);?></p>

<?php
if(file_exists($_GET['For'] . "/StatsJeu.txt"))
{?>
<h2>Nombre de joueurs</h2>
<p>Personnes ayant joué : <?php echo french_format(getLineCount($_GET['For'] . "/StatsJeu.txt"));?></p>
<?php
}
?>


<h2>Referrer</h2>
<p class="petitTexte">(par ordre de popularité)</p>
<?php
if($EXCEED)
echo '<p class="erreur">La génération des statistiques Referrer a été tronquée : trop de données à manipuler.<br />(Stats tronquées aux 45 000 derniers enregistrements)</p>';
?>
<p>Les pages suivantes lient vers <a href="https://neamar.fr/Res/<?php echo $_GET['For']; ?>/"><?php echo $_GET['For']; ?></a></p>

<ol>
<?php
arsort($URLs);
foreach($URLs as $URL=>$nombre)
{
	echo '<li><a href="' . $URL . '" rel="nofollow">' . urldecode($URL) . '</a> <span class="petitTexte">(' . $nombre . ' hits)</span></li>';
}?>
</ol>

<?php
include "footer.php";
?>
