</div>
<div id="Box">
	<dl>
	<?php
	$Box['Menu'] = '<a href="https://neamar.fr/Res" title="Retour à l\'accueil des ressources">Index des ressources</a>';
	foreach ($Box as $Titre => $Valeur)
	{
		echo '
		<dt>' . $Titre . '</dt>
		<dd>' . $Valeur . '</dd>';
	}
	?>
	</dl>
</div>

<div id="Sommaire" class="TOC">
	<p class="petitTexte">Chargement du sommaire...</p>
	<noscript><p>Activez Javascript et rechargez la page pour voir apparaitre le sommaire interactif.</p></noscript>
</div>

<div id="Footer" class="centre">
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<!-- neamar.fr Res footer -->
	<ins class="adsbygoogle"
	     style="display:block"
	     data-ad-client="ca-pub-4506683949348156"
	     data-ad-slot="9524303321"
	     data-ad-format="auto"></ins>
	<script>
	(adsbygoogle = window.adsbygoogle || []).push({});
	</script>

	<!--Ressource sous licence Creative Commons BY-->
	<p class="centre cliquable">
		<img src="https://licensebuttons.net/l/by/3.0/88x31.png" alt="Licence Creative Commons : BY" class="nonflottant" onclick="document.location='http://creativecommons.org/licenses/by/3.0/deed.fr';" title="Cliquez pour plus d'informations"/>
	</p>
</div>
</body>
</html>
