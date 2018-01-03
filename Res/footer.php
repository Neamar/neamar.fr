</div>
<div id="Box">
	<dl>
	<?php
	$Box['Menu'] = '<a href="http://neamar.fr/Res" title="Retour à l\'accueil des ressources">Index des ressources</a>';
	foreach ($Box as $Titre => $Valeur)
	{
		echo '
		<dt>' . $Titre . '</dt>
		<dd>' . $Valeur . '</dd>';
	}
	?>
	</dl>
	<script type="text/javascript"><!--
	google_ad_client = "pub-4506683949348156";
	google_ad_slot = "2318898604";
	google_ad_width = 120;
	google_ad_height = 600;
	//-->
	</script>
	<?php
	if(!isset($NoPub))
	{?>
	<script type="text/javascript"
	src="https://pagead2.googlesyndication.com/pagead/show_ads.js">
	</script>
	<?php
	}?>
</div>

<div id="Sommaire" class="TOC">
	<p class="petitTexte">Chargement du sommaire...</p>
	<noscript><p>Activez Javascript et rechargez la page pour voir apparaitre le sommaire interactif.</p></noscript>
</div>

<div id="Footer" class="centre">
	<script type="text/javascript"><!--
	google_ad_client = "pub-4506683949348156";
	/* Neamar.fr/Res Footer */
	google_ad_slot = "5933721578";
	google_ad_width = 728;
	google_ad_height = 90;
	//-->
	</script>
	<script type="text/javascript"
	src="https://pagead2.googlesyndication.com/pagead/show_ads.js">
	</script>
	<!--Ressource sous licence Creative Commons BY-->
	<p class="centre cliquable">
		<img src="http://i.creativecommons.org/l/by/3.0/88x31.png" alt="Licence Creative Commons : BY" class="nonflottant" onclick="document.location='http://creativecommons.org/licenses/by/3.0/deed.fr';" title="Cliquez pour plus d'informations"/>
	</p>
	<script type="text/javascript">
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
	</script>
	<script type="text/javascript">
	var pageTracker = _gat._getTracker("UA-4257957-1");
	pageTracker._initData();
	pageTracker._trackPageview();
	</script>
</div>
</body>
</html>
