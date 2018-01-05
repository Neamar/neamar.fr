<?php
$titre='Timeline de neamar.fr : toutes les dernières modifications';
$menus = array ("Sites Web","Programmes","Publications");

include('header.php');


/**Concernant l'ajout*/

if(isset($_GET['Ajout']))
{
	if(count($_POST)!=0 && $_POST['pass']=='1618')
		mysql_query('INSERT INTO _TimeLine VALUES(\'\',\'' . $_POST['Projet'] . '\',NOW(),\'' . $_POST['Modification'] . '\')');
?>
<form method="post" action="">
<p>
<label for="Projet">Projet :</label>
<select name="Projet" id="Projet">
	<optgroup label="Sites">
		<option value="Neamar.fr">Neamar.fr</option>
		<option value="Omnilogie">Omnilogie</option>
		<option value="CCDS">CCDS</option>
		<option value="Lachal">Lachal</option>
		<option value="Blog">Blog</option>
	</optgroup>
	<optgroup label="Outils">
		<option value="Res">Res</option>
		<option value="Typo">Typo</option>
		<option value="EasySQL">EasySQL</option>
	</optgroup>
	<optgroup label="Flash">
		<option value="LifeGameIX">LifeGameIX</option>
		<option value="Stacks">Stacks</option>
	</optgroup>
</select><br />
<input type="password" name="pass" /><br />
<textarea rows="5" cols="50" name="Modification" id="Modification"></textarea><br />
<input type="submit" value="Ajouter" />
</p>
</form>
<?php
}

/**Fonction d'affichage de liste*/
function ListIt($Items)
{
	echo "\n<ol>\n";
	foreach($Items as $Item)
		echo '	<li>' . $Item . "</li>\n";
	echo "</ol>\n";
}

$Liens=array(
"Blog"=>"http://blog.neamar.fr",
"CCDS"=>"https://ccds.neamar.fr",
"Stacks"=>"https://neamar.fr/Res/CoinStack",
"LifeGameIX"=>"https://neamar.fr/Res/LifeGame",
"Typo"=>"https://neamar.fr/Res/Typo",
"Omnilogie"=>"https://omnilogie.fr",
"Res"=>"https://neamar.fr/Res",
"Neamar.fr"=>"https//neamar.fr",
'EasySQL'=>'https://neamar.fr',
);

?>

<h1>Timeline Neamar</h1>

<p>Cette page recense jour par jour les modifications faites sur l'ensemble des productions Neamar.<br />
Le contenu de cette page ne saurait en aucun cas être exhaustif !</p>

<?php
/**Les derniières actions*/
echo '<h2>Dernières actions</h2>';
$Dernieres=mysql_query('SELECT DATE_FORMAT(Date, "%d/%m/%Y à %T") AS Date,Modification, Projet
FROM _TimeLine
ORDER BY _TimeLine.Date DESC
LIMIT 0,5');
$Liste=array();
while($Derniere=mysql_fetch_assoc($Dernieres))
	$Liste[]='<strong>{' . $Derniere['Projet'] . '}</strong><span class="petitTexte">[' . $Derniere['Date'] . ']</span> ' . $Derniere['Modification'];
ListIt($Liste);




/**Liste complète*/
echo '<hr />';
echo '<h2 style="margin-top:50px;">Par projet</h2>';
$Projets=mysql_query('SELECT DISTINCT Projet FROM _TimeLine ORDER BY ID DESC') or die(mysql_error());
while($Projet=mysql_fetch_assoc($Projets))
{
	echo '<h3><a href="' . $Liens[$Projet['Projet']] . '">' . $Projet['Projet']  . '</a></h3>';
	$Events=mysql_query('
SELECT DATE_FORMAT(Date, "%d/%m/%Y à %T") AS Date,Modification
FROM _TimeLine
WHERE Projet="' . $Projet['Projet'] . '"
ORDER BY _TimeLine.Date DESC') or die(mysql_error());

	$Liste=array();
	while($Event=mysql_fetch_assoc($Events))
		$Liste[]='<span class="petitTexte">[' . $Event['Date'] . ']</span> ' . $Event['Modification'];

	ListIt($Liste);
}

include('footer.php');
