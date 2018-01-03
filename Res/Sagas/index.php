<?php
date_default_timezone_set("Europe/Paris");

//V�rifier qu'il n'y a pas d'erreur et qu'on vient bien d'une page � Saga.
if(!isset($_Nom))
	exit();

if(!isset($UseCache))
	$UseCache = true;

if(!defined('FILE_ARE_UTF8'))
	define('FILE_ARE_UTF8',false);

error_reporting(E_ALL);

//La classe pour g�rer un dialogue
include('../Sagas/Codes/Dialogue.php');

//Le titre ne doit pas contenir ce caract�res sp�ciaux sous peine de permettre l'utilisation de n'importe quel fichier.
if(isset($_GET['E']))
	$_GET['E']=preg_replace('#[^A-Z0-9_]#i','',$_GET['E']);

if(!isset($_GET['E']))
	$Titre='R�f�rences et statistiques sur ' . $_Nom;
else
	$Titre='Liste des r�f�rences de l\'�pisode ' . $_GET['E'] . ' &ndash; ' . $_Nom;


//Fonction pour afficher les liens suivants et pr�c�dents.
function showBeforeAfter()
{

	global $NBEpisode;
	if(!is_numeric($_GET['E']))
		return;
	if($_GET['E']>1)
		echo '<p style="text-align:left;"><a href="Episode-' . ($_GET['E']-1) . '">�pisode pr�c�dent &larr;</a></p>';
	if($_GET['E']<$NBEpisode)
		echo '<p style="text-align:right;"><a href="Episode-' . ($_GET['E']+1) . '">�pisode suivant &rarr;</a></p>';
}

//Afficher la base du HTML
include('../header.php');

?>
<script type="text/javascript">
function gID(Item)
{
	return document.getElementById(Item);
}
</script>
<?php

















//----------------------------------------------------------------------------------------------------------------------------------
///CAS O� ON DEMANDE LA PAGE D'ACCUEIL
//Notons que ce n'est pas si simple : il peut y avoir un cache � lire, des donn�es � traiter si le visiteur utiliser � votre tambouille, ou un cache � rafraichir.
if(!isset( $_GET['E']) || (is_numeric($_GET['E']) && $_GET['E']>$NBEpisode))
{

	?>
	<h1>Statistiques globales sur <?php echo  $_Nom; ?></h1>
	<form action="//www.google.fr/cse" id="cse-search-box" class="centre">
	<div>
		<input type="hidden" name="cx" value="partner-pub-4506683949348156:g5irco-o1uv" />

		<input type="hidden" name="ie" value="ISO-8859-1" />
		<input type="text" name="q" size="31" />
		<input type="submit" name="sa" value="Rechercher" />
	</div>
	</form>
	<script type="text/javascript" src="//www.google.com/coop/cse/brand?form=cse-search-box&amp;lang=fr"></script>


	<?php
	$cache = '.cache';
	if($UseCache && file_exists($cache) && date('d',filemtime($cache)) == date('d') && !isset($_POST['Envoi']))
		readfile($cache);
	elseif(isset($_POST['Envoi']))
	{
		include('../Sagas/PrepareForStats.php');
		include('Stats.php');
		include('../Sagas/CommonStats.php');
	}
	else
	{
		if($UseCache)
			ob_start();
		include('../Sagas/PrepareForStats.php');
		include('Stats.php');
		include('../Sagas/CommonStats.php');
		if($UseCache)
		{
			$page = ob_get_contents(); // copie du contenu du tampon dans une cha�ne
			file_put_contents($cache, $page) ; // on �crit la cha�ne pr�c�demment r�cup�r�e ($page) dans un fichier ($cache)
			ob_flush();
		}
	}

	include('../footer.php');
	exit();
}











//----------------------------------------------------------------------------------------------------------------------------------
///CAS O� ON DEMANDE UN �PISODE
if(isset($DisableEpisodes))
	exit('L\'acc�s aux �pisodes n\'est pas disponible pour l\'instant, merci.');

//Dans ce cas, il suffit de charger un seul fichier et de l'envoyer.
$cache='.cache-' . $_GET['E'];
if(file_exists($cache) && date('d',filemtime($cache)) == date('d') && !isset($_POST['Envoi']) && 0)
	readfile($cache);
else
{
// 	ob_start();
	if(is_numeric($_GET['E']))
	{
		$Episode = new Dialogue("�pisode n�" .  $_GET['E']);
		$Episode->CreateFromFile('Textes/' . $_Prefix . '-' . $_GET['E'] . '.html');
	}
	elseif(is_file('Textes/' . $_GET['E'] . '.html'))
	{
		$Episode = new Dialogue('');
		$Episode->CreateFromFile('Textes/' . $_GET['E'] . '.html');
	}
	else
		exit('WTF ar u doing ? (Sagas/index.php, ligne 151)');

	$Episode->OutputIntro();
	?>
	<p class="erreur"><img src="//i.creativecommons.org/l/by-nc/2.0/fr/88x31.png" alt="CC BY-NC" />Cette &oelig;uvre est un travail collaboratif bas� sur l'ouvrage de <?php echo $_Auteur; ?>. Les internautes ayant particip� sont list�s sur la <a href="./">page d'accueil</a> du projet.<br /><br />
	Une subtilit� n'est pas r�f�renc�e ? N'h�sitez pas � la <a rel="nofollow" href="https://github.com/Neamar/sagas-mp3/issues">signaler</a> !</p>
	<?php

	showBeforeAfter();
	?>
	<p class="centre"><a href="./">Index et statistiques</a></p>
	<?php
	echo '<h2>Statistiques de l\'�pisode</h2>';

	$Episode->OutputStats();

	echo '<h2>Texte de l\'�pisode</h2>';
	$Episode->OutputText();


	showBeforeAfter();
	?>
	<p class="centre"><a href="./">Retour � l'index et affichage des statistiques</a></p>

	<script type="text/javascript" src="//neamar.fr/Res/Sagas/Edit.js"></script>

	<?php
	include('../footer.php');
// 	$page = ob_get_contents(); // copie du contenu du tampon dans une cha�ne
// 	file_put_contents($cache, $page) ; // on �crit la cha�ne pr�c�demment r�cup�r�e ($page) dans un fichier ($cache)
// 	ob_flush();
}


?>
