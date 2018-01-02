<?php
$Titre='TXT2JPG online';
$Box = array("Auteur" => "Neamar","Date" => "2009");

include('../header.php');
?>
<h1><?php echo $Titre; ?></h1>
<p class="auteur">Neamar</p>
<p class="erreur">Cette page a été supprimée. Les baladeurs qui n'affichent que des images n'existent plus depuis belle lurette.</p>
<!--
<form method="post" action="converter.php">
	<fieldset><legend>Document</legend>
		<label for="titre">Titre du document :</label>
		<input type="text" name="titre" id="titre" /><br />
		<label for="captcha">Écrivez 10 en toutes lettres : </label>
		<input type="text" name="captcha" id="captcha" /><br />
	</fieldset>

	<fieldset><legend>Mise en page</legend>
		<label for="width">Largeur de l'écran du baladeur : (en pixel)</label>
		<input type="text" name="width" id="width" value="320" /><br />

		<label for="height">Hauteur de l'écran du baladeur : (en pixel)</label>
		<input type="text" name="height" id="height" value="240" /><br />
		Astuce : si votre baladeur dispose d'une fonction zoom, vous pouvez multiplier la valeur nominale de la hauteur par 20 : vous aurez ainsi moins d'images, et un meilleur confort de lecture.
	</fieldset>

	<fieldset><legend>Mise en page</legend>
		<label for="font">Police :</label>
		<select name="font" id="font">
			<option value="Serif.ttf">Serif (par défaut)</option>
			<?php
			$handler = opendir('Fonts');
			while ($file = readdir($handler))
			{
				if ($file != '.' && $file != '..')
					echo '<option value="' .$file . '">' . substr($file,0,-4) . '</option>' . "\n";
			}
			closedir($handler);
			?>
		</select><br />

		<label for="size">Taille :</label>
		<select name="size" id="size">
		<option value="10">10 (par défaut)</option>
		<?php
		for($i=7;$i<=15;$i++)
			echo  '<option value="' .$i . '">' . $i . '</option>' . "\n";
		?>
		</select>
	</fieldset>

	<fieldset><legend>Mise en page</legend>
		<label for="texte">Votre texte :</label><br />
		<textarea cols="25" rows="25" style="width:90%;" name="texte" id="texte"></textarea>
	</fieldset>

	<p class="centre"><input type="submit" value="Convertir" onclick="this.disabled='disabled'; this.value='Conversion en cours... peut prendre plusieurs secondes. Vous serez redirigés une fois l'opération terminée.';"/></p>
	<p class="petitTexte">En utilisant cet outil, vous avez conscience que le texte devient librement accessible sur Internet ; les données envoyées depuis ce formulaire perdront toute confidentialité.<br />
	Cet outil en ligne ne convertit pas les textes ayant une taille supérieure à 50 000 caractères, et ne supporte pas la mise en forme du texte. Pour abolir ces limites, tournez vous vers le logiciel gratuit <a href="http://neamar.free.fr/txt2jpg">TXT2JPG</a>.</p>
</form>
-->
<?php
include('../footer.php');
