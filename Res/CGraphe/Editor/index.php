<?php
$Titre='�diteur de niveaux pour Cgraphe';
$Box = array("Auteur" => "Neamar","Date" => "Janvier 2009", "But" =>"Gagner !","� propos"=>'<a href="../../Compiler_AS3">Compiler l\'AS3</a>',"Voir aussi"=>'<a href="../../Graphe">Jeux de graphe</a>');
include('../../header.php');
?>
<h1>Un jeu en tour par tour en Flash</h1>
<p class="erreur">Cet �diteur de niveaux est une application secondaire de <a href="../">CGraphe</a></p>
<h2>Le r�sultat</h2>
<h3>Fichier Flash :</h3>
<div style="border:1px solid black; width:640px; height:480px; margin:auto;">
	<object type="application/x-shockwave-flash" data="Editor.swf" width="640" height="480" >
		<param name="movie" value="Editor.swf" />
		<param name="quality" value="high" />
		<param name="wmode" value="transparent" />
		<p>Installez le plugin Flash pour voir l'animation : <a href="http://www.adobe.com/go/gntray_dl_getflashplayer_fr" >Cliquez ici pour le t�l�charger</a></p>
	</object>
</div>
<h2>Cr�ateur de niveaux</h2>
<p>Cette application permet la cr�ation de niveaux pour CGraphe. Elle est relativement intuitive, mais assez peu maniable : elle n'�tait � l'origine pr�vue que pour le d�veloppeur, qui n'avait pas les m�mes besoins en ergonomie qu'un utilisateur lambda.</p>
<p>Cr�ez un noeud en cliquant sur un endroit vide. Reliez plusieurs noeuds entre eux en cliquant successivement sur chacun d'eux.</p>
<p>D�placez un lien pour le courber en cliquant sur le lien et en le <em>draggant</em> vers le point de controle voulu (d�termine l'inflexion de la courbe)<br />
Vous pouvez aussi d�placer un noeud en cliquant sur le noeud tout en maintenant la touche <em>Ctrl</em> enfonc�e.<br />
Si vous avez mis un lien en trop, retirez-le en maintenant la touche <em>Ctrl</em> lors du clic.</p>
<p class="erreur">Le d�but et la fin sont forc�ment les premiers et derniers liens que vous avez plac�s !</p>
<p>Pour r�cup�rer le niveau, cliquez sur le rond gris en haut � droite, puis s�lectionnez le texte affich� (cliquez sur le texte pour lui donner le focus, faites un clic droit => s�lectionner tout). Vous n'avez plus qu'� la coller dans la boite de dialogue � Niveaux persos � de C-Graphe</p>
<p>Limitations : vous ne pouvez pas supprimer un noeud. Cependant, un noeud qui n'est pas reli� au r�seau ne sera pas enregistr�.</p>
<?php
include('../../footer.php');
?>