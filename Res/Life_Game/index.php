<?php
$Titre='Life Game IX';
$Box = array("Auteur" => "Neamar","Date" => "Juin 2009", "But" =>"Aucun","Voir aussi"=>'<a href="../Compiler_AS3">Compiler l\'AS3</a>',"Voir aussi "=>'<a href="../VBLifeGame">Life Game VII</a>');
include('../header.php');
?>
<h1>Life Game, version 9 : Flash release</h1>

<div class="erreur">
<p>Ce jeu est une lubie anthropocentrique de l'auteur de ce site <small>(parfait pour la PAO &ndash; procrastination assistée par ordinateur)</small>.<br />
Il a été programmé dans une grande variété de langages, du BASIC au PASCAL en passant par les APIs Windows "bas-niveau".<br />
Cette version se veut la plus complète : pas la plus rapide (Flash n'est pas là pour ça...)</p>
</div>

<h2>Le résultat</h2>
<h3>Fichier Flash :</h3>
<p>Attention, Life Game n'est pas forcément facile d'accès. Visionnez <a href="http://www.youtube.com/watch?v=X81AEYiWJTQ"> cette vidéo</a> pour une rapide introduction.</p>
<div style="border:10px outset black; width:640px; height:480px; margin:auto;">
	<object type="application/x-shockwave-flash" data="LifeGameIX.swf" width="640" height="480">
		<param name="movie" value="LifeGameIX.swf" />
		<param name="quality" value="high" />
		<param name="wmode" value="transparent" />
		<param name="allowFullScreen" value="true" />

		<p>Installez le plugin Flash pour voir l'animation : <a href="http://www.adobe.com/go/gntray_dl_getflashplayer_fr" >Cliquez ici pour le télécharger</a></p>
	</object>
</div>
<h2>Que faire ?</h2>
<p>Quelques idées en vrac de "crazy machines" :</p>
<ul>
	<li>Une cocotte minute : de l'eau qui bout dans un récipient de métal ;</li>
	<li>Un montage de distillation ;</li>
	<li>Des électrodes ;</li>
	<li>Des soupapes de sécurité ;</li>
	<li>Une usine de vitrification ;</li>
	<li>Une usine de dessalement ;</li>
	<li>Un mouvement pérpétuel tordu ;</li>
	<li>Une peinture artistique impressioniste ;</li>
	<li>Éxpérimenter les limites de la capillarité ;</li>
	<li>Un percolateur.</li>
</ul>

<h2>Comment jouer ?</h2>
<p>Mauvaise nouvelle : on ne peut pas jouer. Cette animation Flash ne sert strictement à rien sinon à vous faire perdre votre temps.<br />
Il n'y a aucun but, mais aucune limite non plus :)<br />
Les touches :</p>
<ul>
<li>La série de 1~9 au dessus des caractères alphabétiques :
	<ul>
		<li>1 : Béton : la particule la plus basique du jeu. Ne bouge pas, ne fond pas, ne transmet pas la chaleur.</li>
		<li>2 : Bois : très légèr pour le processeur. S'enflamme lentement si exposé à une forte température. Ne transmet pas la chaleur.</li>
		<li>3 : Métal : un élément indispensable pour vos constructions. Ne tombe pas, mais transmet la chaleur.</li>
		<li>4 : Eau : bah... de l'eau. S'aplanit comme un liquide, s'évapore si trop chauffée et se recondense une fois refroidie. Peut être utilisée pour vos cicuits de refroidissement.</li>
		<li>5 : Huile : Flotte sur l'eau, s'enflamme facilement. Brûle bien mais peu.</li>
		<li>6 : Alcool : LA particule pour les pyromanes en puissance. S'enflamme extrêmement facilement, et produit un feu intense (idéal pour vitrifier du sable). Flotte sur l'huile et l'eau.</li>
		<li>7 : Sable : Un solide qui forme des tas réguliers, s'effondre dans les liquides. Exposés à de fortes températures, il rougit avant de se vitrifier.</li>
		<li>8 : Sel : Du sel. Peut se dissoudre dans l'eau (dans une certains limite). Si l'eau bout, le sel réapparait. À part cela, aucune utilité.</li>
		<li>9 : Feu : la particule maîtresse qui donne tout son charme au jeu. Utile pour chauffer votre métal et faire une cocotte minute, vitrifier, enflammer, et autres joyeusetés pour pyromanes refoulés.</li>
	</ul></li>
<li>MAJ + 1~9 : mode générateur pour la particule sélectionnée ;</li>
<li>Clic pour tracer des traits de la particule sélectionnée ;</li>
<li>Ctrl + Clic pour effacer ;</li>
<li>1 à 9 du pavé numérique pour changer la taille du pinceau ;</li>
<li>"R" pour <em>restart</em> : effacer toutes les particules et objets et recommencer une construction ;</li>
<li>"C" pour <em>clean</em> : supprime tous les élements de béton, métal, verre et générateurs, le reste peut tomber. À noter : le bois est conservé pour que vous puissiez élaborer des crazy machines catalysées par l'action sur la touche "c" tout en gardant des objets fixes ;</li>
<li>"P" pour <em>pause</em> : pour faire des dessins pointilleux et précis, ou pour faire apparaitre en une seule frame des milliers de particules ;</li>
<li>"V" pour <em>vacuum</em> : une particule spéciale qui « boit » tout ;</li>
<li>"F" pour <em>FullScreen</em> : passage en plein écran, certains sites peuvent bloquer cette fonctionalité ;</li>
<li>"G" pour <em>Givrer</em> : remet la température de toutes les particules à 0 ;</li>
<li>"U" pour <em>Upload</em> : envoie votre &oelig;uvre sur le serveur ; quelques secondes après vous récupérerez une URL vers l'image générée (dans le presse papier, utilisez la commande "coller") ;</li>
<li>"Suppr"  supprime toutes les occurrences de la particule sélectionnée ;</li>
<li>Clic droit + zoom avant / zoom arrière : ce sont des fonctionalités intégrées à Flash, ne les négligez pas !</li>
</ul>

<h3>Images</h3>
<p><a href="Pics.php">Voir cette page pour les images.</a></p>

<h3>Historique</h3>
<ul>
<li>Démarrage du codage : 7/06/09, 14h</li>
<li>Démarrage bêta : 8/06/09 (Testeurs : jolo2 (plus de 50 tests effectués, merci !), Patrick)</li>
<li>Version RC1 : 10/06/09</li>
</ul>

<h2>Téléchargement</h2>
<h3>Dernière version</h3>
<p>Voir le fichier SWF, et le code.
<a href="LifeGameIX.swf">Pour l'enregistrement local</a></p>

<h2>Statistiques...</h2>
<p>Nombre de joueurs : <?php echo count(file('StatsJeu.txt'));?></p>
<h2>Le code</h2>
<h3>À propos du code</h3>
<p>L'ensemble des fichiers représente moins de 10ko !</p>
<p><a href="Code.php">Afin d'éviter l'engorgement du serveur, le code a été décentralisé sur une page externe.</a></p>
<?php
include('../footer.php');
?>
