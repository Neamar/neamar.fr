<?php
if(!is_numeric($_GET['Erreur']) || $_GET['Erreur']>600)
	$_GET['Erreur']=':-)';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
<title>L'erreur est humaine...</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="owner" content="Neamar" />
<meta name="author" content="Neamar" />
<meta name="robots" content="all" />
<meta name="rating" content="general" />

<link rel="start" title="Accueil" href="http://neamar.fr/" />
</head>

<body>
<div style="margin:auto; text-align: center; margin-top:100px;">
<h1 style="font-family:monospace; font-size:5em;"><?php echo $_GET['Erreur']; ?></h1>
<img src="/Pics/CSS/404.png" alt="Erreur 404" />
<ul>
	<li><a href="http://neamar.fr">Portail Neamar.fr</a></li>
	<li><a href="http://lachal.neamar.fr">Le dictionnaire</a></li>
	<li><a href="http://ccds.neamar.fr">Ça coule de source</a></li>
	<li><a href="http://neamar.fr/Res">Ressources</a></li>
</ul>
</div>
</body>
</html>