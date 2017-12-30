<?php
$Titre='Google Logo\'s Collection || Historique des logos Google';
$Box = array("Auteur" => "Neamar","Date" => "Sept. 2008", "Voir aussi" =>'<a href="../Google/">Maîtriser Google</a>');
include('../header.php');
?>
<h1>Google Logo's Collection || Historique des logos Google</h1>
<h2>WARNING || AVERTISSEMENT</h2>
<table>
<tr><td class="erreur" >These logos, picked everywhere on the web do not belong to me and therefore are still Google's property !</td>
<td class="erreur">Ces logos, récupérés un peu partout sur le web, ne m'appartiennent pas et restent la propriété de Google !</td>
</tr>
</table>
<h2>Logos &amp; GOOGLE</h2>
<p class="centre">
<?php
$dir = "Images/Logos";

//Liste tous les fichiers
if (is_dir($dir))
{
    if ($dh = opendir($dir))
    {
        while (($file = readdir($dh)) !== false)
        {
            if($file !=".." && $file !=".")
            	echo '<img src="' . $dir . '/' . $file . '" alt="Logo Google : ' . $file . '" class="nonflottant" /><br />' . "\n";
        }
        closedir($dh);
    }
}
?>
</p>
<h2>Doodles &amp; Google</h2>
<table>
<tr><td class="erreur" >Doodles are littles stories made out of logos...</td>
<td class="erreur">Les doodles sont de petites historiettes en logos...</td>
</tr>
</table>
<?php
for($i=1;$i<=14;$i++)
{
	echo '<h3>Doodle  #' . $i . '</h3>' . "\n" . '<ol>';
	$dir = 'Images/doodle' . $i . '_fichiers';
	$Images=array();
	//Liste tous les fichiers
	if ($dh = opendir($dir))
	{
		while (($file = readdir($dh)) !== false)
		{
			if($file !=".." && $file !=".")
				array_push($Images,$file);
		}
		arsort($Images);
		$Images=array_reverse($Images);
		closedir($dh);
		foreach($Images as $file)
			echo '<li><img src="' . $dir . '/' . $file . '" alt="Doodle Google (' . $i .') ' . ': ' . $file . '" class="nonflottant" style="vertical-align:middle;" title="Doodle Google (' . $i .') ' . ': ' . $file . '" /></li>' . "\n";
	}
	echo '</ol>' . "\n";
}
?>
<?php
include "../footer.php";
?>