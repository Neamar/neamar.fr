<?php
$Titre='Un jeu de graphe';
$Box = array("Auteur" => "Neamar","Date" => "Aout 2008", "But" =>"Finir le jeu","Voir aussi"=>'<a href="../Compiler_AS3">Compiler l\'AS3</a>',"Voir aussi"=>'<a href="../Graphe">Jeux de graphe</a>');
include('../header.php');

if(isset($_GET['en']))
	$Flash ='http://games.mochiads.com/c/g/agraphe/Agraphe.swf';
else if(isset($_GET['cn']))
	$Flash ='http://games.mochiads.com/c/g/agraphe_cn/Agraphe.swf';
else
	$Flash = 'Agraphe.swf';

?>
<h1>Un jeu de logique en Flash</h1>
<h2>Le résultat</h2>
<h3>Fichier Flash :</h3>
<div style="border:1px solid black; width:640px; height:480px; margin:auto;">
	<object type="application/x-shockwave-flash" data="<?php echo $Flash ?>" width="640" height="480" >
		<param name="movie" value="<?php echo $Flash ?>" />
		<param name="quality" value="high" />
		<param name="wmode" value="transparent" />
		<p>Installez le plugin Flash pour voir l'animation : <a href="http://www.adobe.com/go/gntray_dl_getflashplayer_fr" >Cliquez ici pour le télécharger</a></p>
	</object>
</div>
<h3>Images</h3>
<p>Passez votre souris par dessus une image pour l'afficher.</p>
<h4>Version pré-&alpha;</h4>
<p>
	<img src="Images/Alpha-1.png" class="miniatureFlash" alt="Capture d'A-Graphe" />
	<img src="Images/Alpha-2.png" class="miniatureFlash" alt="Capture d'A-Graphe" />
</p>
<h4>Version &beta;</h4>
<p>
	<img src="Images/Beta-1.png" class="miniatureFlash" alt="Capture d'A-Graphe" />
	<img src="Images/Beta-2.png" class="miniatureFlash" alt="Capture d'A-Graphe" /></p><hr /><p>
	<img src="Images/Beta-3.png" class="miniatureFlash" alt="Capture d'A-Graphe" />
	<img src="Images/Beta-4.png" class="miniatureFlash" alt="Capture d'A-Graphe" />
</p>

<h4>Fonds créés :</h4>
<p class="erreur">(Astuce : vous pouvez récupérer le fichier gimp en remplacant .png par .xcf)</p>
<p>

	<img src="Images/Fonds/Fond1.png" class="miniatureFlash" alt="Deuxième fond crée (A-Graphe ArtWork)" />
	<img src="Images/Fonds/Fond2.png" class="miniatureFlash" alt="Troisième fond crée (A-Graphe ArtWork)" /></p><hr /><p>
	<img src="Images/Fonds/Fond3.png" class="miniatureFlash" alt="Premier fond crée (A-Graphe ArtWork)" />
	<img src="Images/Fonds/Fond4.png" class="miniatureFlash" alt="Premier fond crée (A-Graphe ArtWork)" /></p><hr /><p>
	<img src="Images/Fonds/Fond5.png" class="miniatureFlash" alt="Premier fond crée (A-Graphe ArtWork)" />
</p>
<h4>Fond retenu</h4>
<p>
	<img src="Images/Fond.png" class="miniatureFlash" alt="Fond retenu pour l'application (A-Graphe ArtWork)" />
</p>
<h2>Explications</h2>
<h3>Règle du jeu</h3>
<p>La règle est expliquée par étapes à l'intérieur du jeu.<br />
La voici complète :</p>
<ol>
<li>Pour allumer un noeud (representé par un cercle), cliquer dessus.</li>
<li>Pour terminer un niveau, allumer le noeud principal, centré en haut.</li>
<li>Un noeud est allumable si et seulement si tous ses enfants (les noeuds qui descendent de lui) sont allumés.</li>
<li>Il est interdit d'allumer simultanément plus de noeuds que le nombre imparti pour chaque niveau (ce nombre est affiché en haut, à droite).</li>
<li>Une fois un noeud allumé, on peut éteindre ses enfants sans que cela éteigne le parent.</li>
<li>Un noeud allumé puis éteint ne peut pas être rallumé.</li>
<li>Les noeuds marqués d'une croix ne peuvent pas être éteints.</li>
</ol>
<h3>A propos du concept</h3>
<p>Ce jeu utilise un graphe orienté, acyclique et connexe. Autrement dit, un arbre !<br />
Le concept original serait inspiré d'un jeu de jetons, dont je n'ai pas réussi à retrouver ni la règle, ni des exemples.</p>
<p><img src="http://upload.wikimedia.org/wikipedia/commons/thumb/0/0c/Small_directed_graph.JPG/250px-Small_directed_graph.JPG" alt="Un exemple de graphe" />C'est en voyant cette image sur Wikipedia que je me suis dit qu'il fallait faire un jeu avec les graphes. J'ai envisagé plusieurs possibilités, et le premier codage est celui-ci. Peut être un jour sortira-t-il un B-Graphe (EDIT : <a href="../BGraphe/">ça y est !</a>) ?</p>
<h3>Historique</h3>
<ul>
<li>Démarrage du codage : 19/07/08</li>
<li>Version pré-&alpha; : 21/07/08 (Testeurs : Kisscoool, Etienne P.)</li>
<li>Version &alpha; : 27/07/08 (Testeurs : MyGB, Devilgeo, Étienne V., Amélie, Jules)</li>
<li>Version &beta; : 3/08/08 (Testeurs : aucun !)</li>
<li>Version RC1 : 6/08/08  (Testeurs : trop nombreux pour être listés ici, mes remerciements les accompagnent)</li>
</ul>

<h2>Mods</h2>
<h3>Mod "2-Joueurs"</h3>
<p>Le mod «2 Joueurs» est très simple au niveau des règles, mais assez stratégique. <em>(pour les curieux, il s'agit d'un <a href="http://fr.wikipedia.org/wiki/Jeu_de_strat%C3%A9gie_combinatoire_abstrait" rel="nofollow">jeu de stratégie combinatoire abstrait</a>, ce qui signifie : pas de hasard, tous les élements sont connus, jeu à tour de roles)</em></p>
<p>Règles :</p>
<ul>
<li>Les règles pour allumer et éteindre un noeud restent semblables au mode 1 joueur.</li>
<li>Au début de son tour, chaque joueur peut éteindre autant de noeuds qu'il le souhaite (ou aucun)</li>
<li>Pour valider son tour, le joueur doit allumer un noeud. À ce moment là, c'est au tour du joueur suivant de tenter sa chance.</li>
<li>Le jeu se termine lorsque l'un des joueurs n'a plus aucune possibilité, soit parce qu'il a éteint trop de noeuds, soit parce que son adversaire l'a bloqué en allumant le dernier noeud disponible.</li>
</ul>
<p>Soyez méchants, réfléchissez...</p>

<h3 id="Createur">Création de niveau</h3>
<p>A-Graphe vous permet de créer vos propres niveaux.<br />
Un niveau est une simple chaîne de caractères, les virgules délimitant des intervalles contenant un noeud chacun. (cf. plus bas)<br />
Le deuxième champ de texte permet d'indiquer le nombre de jetons dont dosipose le joueur.<br />
Un noeud sans enfant est noté «null». Ainsi, pour réaliser un niveau avec un unique noeud, il faut simplement marquer <strong>null</strong> dans le champ de texte.<br />
Pour les parents (les noeuds avec des enfants), il faut marquer le numéro des noeuds enfants, séparés par un / (slash). Ainsi, le premier niveau du jeu (un noeud principal avec deux enfants) se code très simplement de la façon suivante : <strong>null,null,0/1/</strong></p>
<p class="erreur">ATTENTION : N'oubliez pas de mettre un slash à la fin de la liste, même si le noeud n'a qu'un seul enfant !</p>
<p>Quelques astuces pour aller plus loin :</p>
<ul>
<li>Vous pouvez marquer un noeud comme inextinctible en placant un X dans la liste : <strong>nullX,null,0/1/X</strong></li>
<li>Vous pouvez décaler l'affichage d'un noeud à l'aide de «hook» : + et -. Cela force l'affichage du noeud un cran plus haut (ou un cran moins haut). Par exemple, <strong>null,null,0/1/+</strong> affiche un niveau «en ligne».</li>
<li>Vous pouvez allumer un noeud dès le début du niveau à l'aide du caractère @.</li>
</ul>
<fieldset>
<legend>Quelques niveaux extraits du jeu...</legend>
<p>
null,null,null,null,0/1/,2/3/,4/,4/,5/,5/,6/,6/7/,7/,8/,9/,10/11/12/,13/14/,15/,15/16/,16/,null,null,null,null,null,22/20/23/,23/21/24/,25/26/,17/18/,18/19/,28/29/,30/27/<br /><br />
null,0/,0/,1/,1/0/,2/0/,2/,3/,3/1/4/,5/6/,6/,7/3/8/,9/10/,11/8/4/5/9/12/<br /><br />
null,0/,null,0/2/,1/,4/,1/0/,3/2/,5/4/,null,null,null,9/10/,10/11/,12/,13/,14/,15/,12/,13/,10/,16/18/20/19/17/,6/7/8/,21/22/<br /><br />
null,0/,0/,0/,1/,1/2/,2/3/,3/X,4/5/,5/6/7/,8/,null,9/11/,10/,12/,13/14/,13/15/,14/11/7/,16/15/17/<br /><br />
null,null,null,0/1/2/,null,null,4/5/,3/6/,null,null,8/9/,null,null,11/12/,null,null,14/15/,10/13/16/,null,17/18/,7/19/<br /><br />
null,null,0/1/,null,null,1/3/4/,null,4/6/,null,8/,9/,2/5/7/10/
</p>
</fieldset>

<h2>Téléchargement</h2>
<h3>Dernière version</h3>
<p>Voir le fichier SWF, et le code.</p>
<h3>Sauvegardes</h3>
<p>Les sauvegardes sont réalisées sur une base plus ou moins régulière, lorsque le code a été amélioré significativement depuis la sauvegarde précedente.</p>
<p class="erreur">Ce code est fourni sous une licence CC-By (cf. fin de page).<br />
De plus, il est interdit de recompiler le jeu "tel quel" en supprimant le lien «Plus de jeux», la mention «tel quel» restant à l'appréciation de l'auteur original du code source (copie, plagiat...).</p>
<ul>
<li><a href="Release/A-graphe_SVG5.zip">Sauvegarde du 7/09/08</a></li>
<li><a href="Release/A-graphe_SVG4.zip">Sauvegarde du 5/08/08</a></li>
<li><a href="Release/A-graphe_SVG3.zip">Sauvegarde du 4/08/08</a></li>
<li><a href="Release/A-graphe_SVG2.zip">Sauvegarde du 31/07/08</a></li>
<li><a href="Release/A-graphe_SVG1.zip">Sauvegarde du 28/07/08</a></li>
<li><a href="Release/A-graphe_SVG0.zip">Sauvegarde du 27/07/08</a></li>
</ul>
<h2>Statistiques...</h2>
<p>Nombre de joueurs : <?php echo count(file('StatsJeu.txt'));?></p>
<h2>Le code</h2>
<h3>À propos du code</h3>
<p>Le code est réparti en classes claires et nettes.<br />L'ensemble du fichier représente moins de 10ko !</p>
<p>La position de chaque noeud est calculée à la volée, à l'aide d'une méthode récursive plutôt performante.</p>
<p><a href="Code.php">Afin d'éviter l'engorgement du serveur, le code a été décentralisé sur une page externe.</a></p>
<?php
include('../footer.php');
?>