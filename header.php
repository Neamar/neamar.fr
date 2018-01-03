<?php
@ini_set('default_charset', 'ISO-8859-1');

if(!isset($titre))
	$titre="Ressources de neamar.fr";

if(!isset($keywords))
	$keywords=str_replace('"','',$titre);

if(!isset($description))
	$description=str_replace('"','',$titre);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<title><?php echo $titre; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="owner" content="Neamar" />
	<meta name="author" content="Neamar" />
	<meta name="robots" content="all" />
	<meta name="rating" content="general" />
	<meta name="reply-to" content="neamar@neamar.fr" />
	<meta name="keywords" content="<?php echo $keywords; ?>" />
	<meta name="description" content="<?php echo $description; ?>" />
	<meta name="copyright" content="Copyright © - Some Right Reserved - 2006-<?php echo date("Y"); ?>" />
	<?php echo $AdditionelMetas . "\n"; ?>
	<link rel="start" title="Accueil" href="https://neamar.fr/index.php" />
	<?php echo $AddLine . "\n"; ?>
	<?php if(!isset($NoDefaultDesign)) {?>
	<link href="/design.css" rel="stylesheet" title="Design par défaut. (Vista)" type="text/css" media="screen" />
	<?php } ?>
	<link href="/Menu.css" rel="stylesheet" type="text/css" media="screen" />
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-4257957-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-4257957-1');
	</script>

</head>

<body>
<div id="menu">
	<?php
	if(!isset($NoWelcomeCenter))
	{?>
<dl id="menu-accueil">
		<dt class="Single_Item"><a href="https://<?php echo $_SERVER['SERVER_NAME']; ?>" title="Retour à l'accueil">Accueil</a></dt>
	</dl>

<?php
	}
	include('ConnectBDD.php');
	include('lib/cron/cron.php');
	mysql_query("SET SESSION group_concat_max_len = 4096");
	array_push($menus,"Misc");

	foreach($menus as $element)
	{
// 		Donner le nom du menu
		echo '	<!--Menu ' . $element . ' -->' . "\n";
		echo '	<dl id="menu-' . strtolower($element) . '">' . "\n" . '		<dt><a href="https://neamar.fr/NoJS.php?Menu=' . $element . '" rel="nofollow" onclick="return false">' . $element . '</a></dt>' . "\n";
		echo '		<dd>' . "\n";
// 		Faire une requete qui prend en compte les relations parents enfants
		echo '			<ul>' . "\n";

		//Bien que moins propre, la requête suivante est près de 100 fois plus rapide !
		$donnees=mysql_query('SELECT _Menus.Caption,_Menus.Lien,CONCAT("\n<ul>\n",SousMenus,"\n</ul>") As SousMenu
		FROM _Menus
		LEFT JOIN
		(
			SELECT GROUP_CONCAT("<li><a href=\\"",Sous_Menus.Lien,"\\">",Sous_Menus.Caption,"</a></li>" ORDER BY Sous_Menus.ID DESC SEPARATOR "\n") AS SousMenus,Sous_Menus.ChildOf
			FROM _Menus AS Sous_Menus
			GROUP BY Sous_Menus.ChildOf
		) Concatenation ON Concatenation.ChildOf=_Menus.ID
		WHERE _Menus.Categorie=\'' . $element . '\'
		AND ISNULL(_Menus.ChildOf)') or die(mysql_error());

		while($sousmenu=mysql_fetch_array($donnees))
		{
			echo '				<li><a href="' . $sousmenu['Lien'] . '">' . $sousmenu['Caption'] . '</a>' . $sousmenu['SousMenu'] . '</li>' . "\n";
		}
		echo "\n" . '				<li class="fin_liste">&nbsp;</li>' . "\n" . '			</ul>' . "\n" . '		</dd>' . "\n" . '	</dl>' . "\n";
	}
	?>
	<?php
	if(isset($GoogleSearch))
	{?>
<div style="position:absolute; right:0px; top:5px;" id="GoogleSearch">
	<form action="//www.google.fr/cse" id="cse-search-box">
	<div>
		<input type="hidden" name="cx" value="partner-pub-<?php echo $GoogleSearch; ?>" />
		<input type="hidden" name="ie" value="ISO-8859-1" />
		<input type="text" name="q" size="12" onmouseover="this.size=25;" onmouseout="this.size=12;"/>
		<input type="submit" name="sa" value="Rechercher" />
	</div>
	</form>
	<script type="text/javascript" src="//www.google.com/coop/cse/brand?form=cse-search-box&amp;lang=fr"></script>
</div>
	<?php
	}
	?>
<noscript><p style="color:red; text-decoration: blink; font-weight:800;"><br /><br /><br />Afin de pouvoir profiter au maximum des sites sur neamar.fr, il est fortement recommandé d'activer JavaScript.</p></noscript>
</div>

<div id="Main">
