<?php
$Titre='Plan des ressources';
$Box = array("Auteur" => "Neamar","But" =>"Listing de sujets");
include('header.php');
include('../ConnectBDD.php');

mysql_query('PREPARE Listeur FROM \'SELECT Caption, Lien
FROM _Menus
WHERE ChildOf=?
ORDER BY ID DESC\'')or die(mysql_error());

function AfficherListe($NumID)
{
	echo '<ul>';
	mysql_query('SET @ID=' . $NumID);
	$donnees=mysql_query('EXECUTE Listeur USING @ID');
	while($Ligne=mysql_fetch_assoc($donnees))
	{
		$Titre=str_replace('/','',str_replace('http://neamar.fr/Res/','',$Ligne['Lien']));
		if(file_exists($Titre . '/Abstract.htm'))
			$Abstract='<blockquote><p>' . file_get_contents($Titre . '/Abstract.htm') . '</p></blockquote>';
		else
			$Abstract='';

		echo '<li><a href="'. $Ligne['Lien'] . '" title="' . $Ligne['Caption'] . '">' . $Ligne['Caption'] . '</a><span class="petitTexte">(' . getLineCount(str_replace('http://neamar.fr/Res/','/app/mount/neamar/Res/',$Ligne['Lien']) . "/Stats.txt") . ')</span>' . $Abstract . '</li>';
	}
	echo '</ul>';
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
?>
<h1>Plan des ressources de http://neamar.fr</h1>
<p class="centre">
	<a href="http://neamar.fr"><img class="nonflottant" src="http://neamar.fr/Pics/NeamarStampLittle.png" alt="Une production Neamar" /></a>
</p>
<p>Le site neamar.fr contient plusieurs dossiers classifiés comme ressources. Il s'agit majoritairement de codes sources et de tutoriaux, mais il existe aussi quelques articles traitant de sujets divers et variés.</p>
<p>L'ensemble des pages sont valides XHTML 1.0.</p>
<h3>Recherche</h3>
<p>Moins fatigant que de rechercher un sujet dans la liste, vous pouvez utiliser la recherche !</p>
<form action="http://www.google.fr/cse" id="cse-search-box">
  <div>
    <input type="hidden" name="cx" value="partner-pub-4506683949348156:g5irco-o1uv" />
    <input type="hidden" name="ie" value="ISO-8859-1" />
    <input type="text" name="q" size="31" />
    <input type="submit" name="sa" value="Rechercher" />
  </div>
</form>
<script type="text/javascript" src="http://www.google.com/coop/cse/brand?form=cse-search-box&amp;lang=fr"></script>

<h2 id="Outils">Utilitaires et outils</h2>
<?php AfficherListe(144); ?>

<h2 id="Codes">Publications de codes sources</h2>
<p class="erreur">Les fichiers listés ici ne sont que les applications les plus importantes.<br />
D'autres codes sources existent dans cette section, mais afin de ne pas l'encombrer, ils n'aparaissent pas ici.</p>
<?php AfficherListe(80); ?>
<p>Les codes sources sont colorés à l'aide de Geshi.</p>
<h2 id="Tutoriaux">Tutoriaux</h2>
<?php AfficherListe(81); ?>
<h2 id="Articles">Articles</h2>
<?php AfficherListe(82); ?>
<h2 id="Sagas">Sagas</h2>
<?php AfficherListe(173); ?>
<h2 id="Nouvelles">Nouvelles</h2>
<?php AfficherListe(134); ?>
<?php
include "footer.php";
?>
