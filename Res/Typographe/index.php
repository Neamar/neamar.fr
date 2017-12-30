<?php
if(isset($_POST['texte']))
	ob_start();//Si on a post� un texte, on sera redirig�.



$Titre='Le typographe';
$Box = array("Auteur" => "Neamar","Date" => "2009");

$AddLine='<link rel="stylesheet" type="text/css" href="http://neamar.fr/Res/Typo/Typo.css" />';
$UseMath=true;
include('../header.php');
include('../Typo/Typo.php');

if(isset($_POST['texte']))
{//Enregistrer le nouveau texte.
	if(strpos($_POST['texte'],'<a href=')!==false)
		exit("Pas de spams, merci.");
	include('../../ConnectBDD.php');
	mysql_query('INSERT INTO TYPO_Textes VALUES
	(
	\'\',
	\'' . $_POST['titre'] . '\',
	\'' . $_POST['texte'] . '\',
	\'' . $_SERVER['REMOTE_ADDR'] . '\',
	\'' . date('l jS \of F Y h:i:s A') . '\'
	)');
	header('Location:show.php?ID=' . mysql_insert_id());
	ob_end_clean;
	exit();
}

Typo::addOption(PARSE_MATH);
?>
<p class="auteur"><q style="font-family: Monospace;">S�duire le lecteur et faciliter la lecture r�sument les qualit�s d'une bonne typographie</q></p>
<h1>Le typographe</h1>
<p class="auteur">Neamar</p>
<h2>Qu'est ce que le Typographe ?</h2>
<p>Le Typographe est une application en ligne pour mettre en forme vos textes. Vous entrez votre texte de fa�on intuitive, et le Typographe se charge de les corriger en ajoutant automatiquement les petites subtilit�s qui font la beaut� de la langue fran�aise : ligatures, tirets cadratins, espaces ins�cables, guillemets � la fran�aise...<br />
Vous pouvez aussi mettre en forme votre texte : du gras aux images en passant par les notes de bas de page, le Typographe fournit un environnement de travail <em>a priori</em> aust�re mais au r�sultat complet.</p>

<p>Besoin d'�crire un article important ? Envie d'avoir un certain standing dans vos �crits ? Vous pouvez utiliser le typographe directement depuis cette page web.</p>
<p>Les webmasters qui le souhaitent peuvent l'incorporer sur leurs sites, le Typographe renvoie un code valide xHTML. <a href="MiseEnPlace.php">Page d'aide pour l'installation.</a></p>

<h2>O� trouver de l'aide ?</h2>
<p>Vous pouvez consulter le <a href="Apercu.php">tour rapide</a> pour apprendre en quelques lignes les bases de l'utilisation du typographe.</p>
<p>Pour une utilisation plus avanc�e, voyez <a href="Aide/">la liste des balises et leur description d�taill�e</a>.</p>

<h2>Quels sites utilisent le Typographe ?</h2>
<ul>
	<li><a href="http://neamar.fr/Res">La section des ressources de neamar.fr</a> ;</li>
	<li><a href="http://omnilogie.fr">Le site d'omnilogie : culture g�n�rale quotidienne pour tous</a> ;</li>
	<li><a href="http://lachal.neamar.fr">Lachal : les mots exhum�s des catacombes du dictionnaire fran�ais</a> ;</li>
	<li><a href="http://laparoleestalaccusation.fr">La parole est � l'accusation</a> ;</li>
	<li><a href="http://histoiredunlivre.tarna.fr/">Histoire d'un livre</a>.</li>
</ul>

<h2>Cr�dits</h2>
<p>Le Typographe est d�velopp� par <a href="http://neamar.fr">Neamar</a>.<br />
Le langage de balise utilis� se base sur <a href="http://www.latex-project.org/">LaTeX</a>.<br />
L'outil d'�dition de texte se base sur l'excellente librairie <a href="http://markitup.jaysalvat.com/home/">MarkItUp</a>.<br />
Les icones de l'�diteur proviennent de <a href="http://www.famfamfam.com/lab/icons/silk/">fam fam fam</a>.</p>

<h2>Testez le typographe</h2>
<form method="post" action="">
<p>
<label for="titre">Titre : </label><input type="text" name="titre" id="titre" /><br />
<?php
Typo::setTexte('');
Typo::renderIDE(array('Name'=>'texte','Rows'=>17));
?>
<input type="submit" value="Valider" />
</p>
</form>
<?php
include('../footer.php');
?>
