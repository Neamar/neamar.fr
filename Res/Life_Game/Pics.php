<?php
$Titre='Derni�res images de Life Game IX';
$Box = array("Auteur" => "Neamar","Date" => "Juin 2009", "But" =>"Aucun","Voir aussi"=>'<a href="./">Life Game</a>');
include('../header.php');
?>
<h1>Screenshots de LifeGame</h1>
<p class="erreur">Vous trouverez sur cette page la liste des images upload�es.<br />
Pour rappel, l'application est limit�e � un upload toutes les 30 secondes ! Merci pour votre compr�hension.</p>
<p>Si vous venez d'envoyer une image, n'oubliez pas que si elle comporte beaucoup de particules, la dur�e avant sa mise � disposition peut atteindre une minute.</p>

<h3>Captures d'�cran</h3>
<p>Les images qui suivent ont �t� prises pendant le d�veloppement de l'application. Elles peuvent mettre en exergue des comportements anormaux ou sp�ciaux qui ont �t� enlev�s de la version finale.</p>

<p>
<?php
$handler = opendir('Images/Screenshots');
while ($file = readdir($handler))
{
	if ($file != '.' && $file != '..')
	echo '<img src="Images/Screenshots/' . $file . '" alt="' . $file . ' : screenshots de Life Game IX" class="miniatureFlash"/>' . "\n";
}

// tidy up: close the handler
closedir($handler);
?>
</p>

<?php
echo '<hr />';
include('../footer.php');
?>
