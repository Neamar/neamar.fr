<?php
$titre='Accueil de neamar.fr : ressources, codes source, jeux, publications et tutoriaux';
$keywords='neamar, tucote, AGraphe, BGraphe, CGraphe, DGraphe, SkyFire, Windows, AS3, compilation, tutoriaux, blog, SpammySMS, Life Game, Stropovitch, omnilogie, lachal, mots compliqués, dictionnaire, catacombe, culture générale, geek, programmation';
$NoWelcomeCenter=1;
$menus = array ("Sites Web","Programmes","Publications");

include('header.php');
?>
<h1>Bienvenue sur neamar.fr</h1>
<p style="float:left; padding:10px;"><img src="Pics/NeamarStampLittle.png" alt="Made In NEAMAR" /></p>
<form action="//www.google.fr/cse" id="cse-search-box">
  <div style="margin:auto;">
    <input type="hidden" name="cx" value="partner-pub-4506683949348156:h5hsp0-otsa" />
    <input type="hidden" name="ie" value="ISO-8859-1" />
    <input type="text" name="q" size="31" />
    <input type="submit" name="sa" value="Rechercher" />
  </div>
</form>
<script type="text/javascript" src="//www.google.com/coop/cse/brand?form=cse-search-box&amp;lang=fr"></script>

<p>Neamar.fr n'est pas mis à jour depuis quelques années.<br />
Seule la <a href="/Res">section Ressources</a>, le <a href="//blog.neamar.fr">blog</a> et <a href="//omnilogie.fr">Omnilogie</a> continuent de recevoir régulièrement du nouveau contenu.</p>

<p>Les menus en haut de cette page restent tout de même fonctionnels afin de vous permettre d'accéder aux anciennes pages.</p>
<!--
<p>Neamar.fr n'est pas un site, mais une nébuleuse de sous sites. En conséquent, cette page n'a pas d'utilité propre et ne présente pas d'intêret à être visitée.<br />
Vous n'y trouverez qu'une liste des applications et sites web, et des rétrospectives revenant sur les années passées.</p>

<p>Rétrospectives du site...</p>
<ul>
	<li><a href="Retrospective2008.php">Rétrospective 2007-2008</a></li>
	<li><a href="Retrospective2009.php">Rétrospective 2008-2009</a></li>
</ul>
<p class="petitTexte">En théorie, toutes les pages de tous mes sites sont <a href="http://validator.w3.org/check?uri=referer">valides XHTML 1.0/1.1</a>. Pourquoi ? Parce que c'est tellement plus propre, plus concis, et surtout plus clair...</p>
<p style="text-align:center;"><img src="Pics/apache_logo.png" alt="Serveur Apache" title="Serveur Apache"/><img src="Pics/php_logo.png" alt="Tous les sites utilisent PHP" title="Tous les sites utilisent PHP"/><img src="Pics/mysql_logo.png" alt="PHP est relié à MySQL...dans tous les projets aussi." title="PHP est relié à MySQL... dans tous les projets aussi."/></p>
<hr />
<h2>Liste des liens Neamar</h2>
<h3>Live</h3>
<p><a href="https://twitter.com/neamar">Follow me on Twitter.</a><br />
<a href="http://blog.neamar.fr">Blog ?</a><br />
<a href="http://www.google.com/profiles/neamar.fr">Who am I ?</a></p>

<h3>Au menu</h3>
<p>Cette page recense l'actualité des sites Neamar, les articles les plus récents sont en haut.</p>
<?php
$Items=mysql_query('SELECT Categorie,Caption,Lien
FROM _Menus
WHERE Lien LIKE "http://%"
AND Lien NOT LIKE "http://finder%"
ORDER BY ID DESC');
echo '<ul style="-webkit-column-count: 2; -moz-column-count: 2; -moz-column-gap: 1em; -moz-column-rule:1px solid gray; column-count: 2; column-gap: 1em; column-rule:1px solid gray;">' . "\n";
while($Item=mysql_fetch_assoc($Items))
{
	$Item['Lien']=str_replace(array('<nolink>','</nolink>'),'',$Item['Lien']);
	$Item['Caption']=str_replace(array('<nolink>','</nolink>'),'',$Item['Caption']);
	if(strpos($Item['Caption'],'Array()')===false)
	echo '	<li>' . $Item['Categorie'] . ' &rarr; <a href="' . $Item['Lien'] . '" title="' . $Item['Categorie'] . ' : ' . $Item['Caption'] . '">' . $Item['Caption'] . '</a></li>' . "\n";
}
echo '</ul>';
?>
-->

<?php
include('footer.php');
?>
