<?php
$Titre='Éditeur de niveaux pour Cgraphe';
$Box = array("Auteur" => "Neamar","Date" => "Janvier 2009", "But" =>"Gagner !","À propos"=>'<a href="../../Compiler_AS3">Compiler l\'AS3</a>',"Voir aussi"=>'<a href="../../Graphe">Jeux de graphe</a>');
include('../../header.php');
?>
<h1>Un jeu en tour par tour en Flash</h1>
<p class="erreur">Cet éditeur de niveaux est une application secondaire de <a href="../">CGraphe</a></p>
<h2>Le résultat</h2>
<h3>Fichier Flash :</h3>
<div style="border:1px solid black; width:640px; height:480px; margin:auto;">
	<object type="application/x-shockwave-flash" data="Editor.swf" width="640" height="480" >
		<param name="movie" value="Editor.swf" />
		<param name="quality" value="high" />
		<param name="wmode" value="transparent" />
		<p>Installez le plugin Flash pour voir l'animation : <a href="http://www.adobe.com/go/gntray_dl_getflashplayer_fr" >Cliquez ici pour le télécharger</a></p>
	</object>
</div>
<h2>Créateur de niveaux</h2>
<p>Cette application permet la création de niveaux pour CGraphe. Elle est relativement intuitive, mais assez peu maniable : elle n'était à l'origine prévue que pour le développeur, qui n'avait pas les mêmes besoins en ergonomie qu'un utilisateur lambda.</p>
<p>Créez un noeud en cliquant sur un endroit vide. Reliez plusieurs noeuds entre eux en cliquant successivement sur chacun d'eux.</p>
<p>Déplacez un lien pour le courber en cliquant sur le lien et en le <em>draggant</em> vers le point de controle voulu (détermine l'inflexion de la courbe)<br />
Vous pouvez aussi déplacer un noeud en cliquant sur le noeud tout en maintenant la touche <em>Ctrl</em> enfoncée.<br />
Si vous avez mis un lien en trop, retirez-le en maintenant la touche <em>Ctrl</em> lors du clic.</p>
<p class="erreur">Le début et la fin sont forcément les premiers et derniers liens que vous avez placés !</p>
<p>Pour récupérer le niveau, cliquez sur le rond gris en haut à droite, puis sélectionnez le texte affiché (cliquez sur le texte pour lui donner le focus, faites un clic droit => sélectionner tout). Vous n'avez plus qu'à la coller dans la boite de dialogue « Niveaux persos » de C-Graphe</p>
<p>Limitations : vous ne pouvez pas supprimer un noeud. Cependant, un noeud qui n'est pas relié au réseau ne sera pas enregistré.</p>
<?php
include('../../footer.php');
?>