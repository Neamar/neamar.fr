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
<h2>Le r�sultat</h2>
<h3>Fichier Flash :</h3>
<div style="border:1px solid black; width:640px; height:480px; margin:auto;">
	<object type="application/x-shockwave-flash" data="<?php echo $Flash ?>" width="640" height="480" >
		<param name="movie" value="<?php echo $Flash ?>" />
		<param name="quality" value="high" />
		<param name="wmode" value="transparent" />
		<p>Installez le plugin Flash pour voir l'animation : <a href="http://www.adobe.com/go/gntray_dl_getflashplayer_fr" >Cliquez ici pour le t�l�charger</a></p>
	</object>
</div>
<h3>Images</h3>
<p>Passez votre souris par dessus une image pour l'afficher.</p>
<h4>Version pr�-&alpha;</h4>
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

<h4>Fonds cr��s :</h4>
<p class="erreur">(Astuce : vous pouvez r�cup�rer le fichier gimp en remplacant .png par .xcf)</p>
<p>

	<img src="Images/Fonds/Fond1.png" class="miniatureFlash" alt="Deuxi�me fond cr�e (A-Graphe ArtWork)" />
	<img src="Images/Fonds/Fond2.png" class="miniatureFlash" alt="Troisi�me fond cr�e (A-Graphe ArtWork)" /></p><hr /><p>
	<img src="Images/Fonds/Fond3.png" class="miniatureFlash" alt="Premier fond cr�e (A-Graphe ArtWork)" />
	<img src="Images/Fonds/Fond4.png" class="miniatureFlash" alt="Premier fond cr�e (A-Graphe ArtWork)" /></p><hr /><p>
	<img src="Images/Fonds/Fond5.png" class="miniatureFlash" alt="Premier fond cr�e (A-Graphe ArtWork)" />
</p>
<h4>Fond retenu</h4>
<p>
	<img src="Images/Fond.png" class="miniatureFlash" alt="Fond retenu pour l'application (A-Graphe ArtWork)" />
</p>
<h2>Explications</h2>
<h3>R�gle du jeu</h3>
<p>La r�gle est expliqu�e par �tapes � l'int�rieur du jeu.<br />
La voici compl�te :</p>
<ol>
<li>Pour allumer un noeud (represent� par un cercle), cliquer dessus.</li>
<li>Pour terminer un niveau, allumer le noeud principal, centr� en haut.</li>
<li>Un noeud est allumable si et seulement si tous ses enfants (les noeuds qui descendent de lui) sont allum�s.</li>
<li>Il est interdit d'allumer simultan�ment plus de noeuds que le nombre imparti pour chaque niveau (ce nombre est affich� en haut, � droite).</li>
<li>Une fois un noeud allum�, on peut �teindre ses enfants sans que cela �teigne le parent.</li>
<li>Un noeud allum� puis �teint ne peut pas �tre rallum�.</li>
<li>Les noeuds marqu�s d'une croix ne peuvent pas �tre �teints.</li>
</ol>
<h3>A propos du concept</h3>
<p>Ce jeu utilise un graphe orient�, acyclique et connexe. Autrement dit, un arbre !<br />
Le concept original serait inspir� d'un jeu de jetons, dont je n'ai pas r�ussi � retrouver ni la r�gle, ni des exemples.</p>
<p><img src="http://upload.wikimedia.org/wikipedia/commons/thumb/0/0c/Small_directed_graph.JPG/250px-Small_directed_graph.JPG" alt="Un exemple de graphe" />C'est en voyant cette image sur Wikipedia que je me suis dit qu'il fallait faire un jeu avec les graphes. J'ai envisag� plusieurs possibilit�s, et le premier codage est celui-ci. Peut �tre un jour sortira-t-il un B-Graphe (EDIT : <a href="../BGraphe/">�a y est !</a>) ?</p>
<h3>Historique</h3>
<ul>
<li>D�marrage du codage : 19/07/08</li>
<li>Version pr�-&alpha; : 21/07/08 (Testeurs : Kisscoool, Etienne P.)</li>
<li>Version &alpha; : 27/07/08 (Testeurs : MyGB, Devilgeo, �tienne V., Am�lie, Jules)</li>
<li>Version &beta; : 3/08/08 (Testeurs : aucun !)</li>
<li>Version RC1 : 6/08/08  (Testeurs : trop nombreux pour �tre list�s ici, mes remerciements les accompagnent)</li>
</ul>

<h2>Mods</h2>
<h3>Mod "2-Joueurs"</h3>
<p>Le mod �2 Joueurs� est tr�s simple au niveau des r�gles, mais assez strat�gique. <em>(pour les curieux, il s'agit d'un <a href="http://fr.wikipedia.org/wiki/Jeu_de_strat%C3%A9gie_combinatoire_abstrait" rel="nofollow">jeu de strat�gie combinatoire abstrait</a>, ce qui signifie : pas de hasard, tous les �lements sont connus, jeu � tour de roles)</em></p>
<p>R�gles :</p>
<ul>
<li>Les r�gles pour allumer et �teindre un noeud restent semblables au mode 1 joueur.</li>
<li>Au d�but de son tour, chaque joueur peut �teindre autant de noeuds qu'il le souhaite (ou aucun)</li>
<li>Pour valider son tour, le joueur doit allumer un noeud. � ce moment l�, c'est au tour du joueur suivant de tenter sa chance.</li>
<li>Le jeu se termine lorsque l'un des joueurs n'a plus aucune possibilit�, soit parce qu'il a �teint trop de noeuds, soit parce que son adversaire l'a bloqu� en allumant le dernier noeud disponible.</li>
</ul>
<p>Soyez m�chants, r�fl�chissez...</p>

<h3 id="Createur">Cr�ation de niveau</h3>
<p>A-Graphe vous permet de cr�er vos propres niveaux.<br />
Un niveau est une simple cha�ne de caract�res, les virgules d�limitant des intervalles contenant un noeud chacun. (cf. plus bas)<br />
Le deuxi�me champ de texte permet d'indiquer le nombre de jetons dont dosipose le joueur.<br />
Un noeud sans enfant est not� �null�. Ainsi, pour r�aliser un niveau avec un unique noeud, il faut simplement marquer <strong>null</strong> dans le champ de texte.<br />
Pour les parents (les noeuds avec des enfants), il faut marquer le num�ro des noeuds enfants, s�par�s par un / (slash). Ainsi, le premier niveau du jeu (un noeud principal avec deux enfants) se code tr�s simplement de la fa�on suivante : <strong>null,null,0/1/</strong></p>
<p class="erreur">ATTENTION : N'oubliez pas de mettre un slash � la fin de la liste, m�me si le noeud n'a qu'un seul enfant !</p>
<p>Quelques astuces pour aller plus loin :</p>
<ul>
<li>Vous pouvez marquer un noeud comme inextinctible en placant un X dans la liste : <strong>nullX,null,0/1/X</strong></li>
<li>Vous pouvez d�caler l'affichage d'un noeud � l'aide de �hook� : + et -. Cela force l'affichage du noeud un cran plus haut (ou un cran moins haut). Par exemple, <strong>null,null,0/1/+</strong> affiche un niveau �en ligne�.</li>
<li>Vous pouvez allumer un noeud d�s le d�but du niveau � l'aide du caract�re @.</li>
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

<h2>T�l�chargement</h2>
<h3>Derni�re version</h3>
<p>Voir le fichier SWF, et le code.</p>
<h3>Sauvegardes</h3>
<p>Les sauvegardes sont r�alis�es sur une base plus ou moins r�guli�re, lorsque le code a �t� am�lior� significativement depuis la sauvegarde pr�cedente.</p>
<p class="erreur">Ce code est fourni sous une licence CC-By (cf. fin de page).<br />
De plus, il est interdit de recompiler le jeu "tel quel" en supprimant le lien �Plus de jeux�, la mention �tel quel� restant � l'appr�ciation de l'auteur original du code source (copie, plagiat...).</p>
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
<h3>� propos du code</h3>
<p>Le code est r�parti en classes claires et nettes.<br />L'ensemble du fichier repr�sente moins de 10ko !</p>
<p>La position de chaque noeud est calcul�e � la vol�e, � l'aide d'une m�thode r�cursive plut�t performante.</p>
<p><a href="Code.php">Afin d'�viter l'engorgement du serveur, le code a �t� d�centralis� sur une page externe.</a></p>
<?php
include('../footer.php');
?>