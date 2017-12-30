<?php
$Titre='Life Game : Un petit jeu physique sans prétention.';
$Box = array("Auteur" => "Neamar","Date" => "2006&shy;~2007", "But" =>"Divertis&shy;sement","Langage" =>"Visual Basic");
include('../header.php');
?>
<h1>Life Game</h1>
<h2>Présentation</h2>
<h3>Images</h3>
<p>Passez votre souris par dessus une image pour l'afficher.</p>
<p>
<img src="Images/Intro.png" alt="Life Game" class="miniatureFlash"/>
<img src="Images/Jeu1.png" alt="Life Game" class="miniatureFlash"/></p>
<hr />
<p>
<img src="Images/Jeu2.png" alt="Life Game" class="miniatureFlash"/>
<img src="Images/Jeu3.png" alt="Life Game" class="miniatureFlash"/>
</p>
<h3>Description</h3>
<p>Ce jeu se place dans la continuité de <a href="http://www.koreus.com/jeu/sand7.html" rel="nofollow">World Of Sand</a> : aucun but précis, juste le rêve et la distraction.</p>

<p>Comment «jouer» :</p>
<ul>
<li>Un clic (ou un glissé) de la souris dans le cadre noir trace un mur</li>
<li>Les touches du pavé numérique de 1 à 9 permettent de régler la taille du pinceau qui crée les murs.</li>
<li>Vous pouvez choisir sur quel élément vous souhaitez agir à l'aide des lettres du clavier :
	<ul>
		<li>«a» pour l'eau</li>
		<li>«b» pour le sable</li>
		<li>«c» pour l'huile</li>
		<li>«d» pour le sel</li>
		<li>«e» pour le feu</li>
	</ul></li>
<li>Une fois un élement sélectionné, utilisez les chiffres au dessus du clavier (en dessous de la série des touches F1~F12) pour régler le débit du jet. (0 =>Arrêt)</li>
<li>Déplacez le jet à l'aide des touches gauche et droite</li>
<li>Vous pouvez aussi faire apparaitre l'élement directement sous le curseur de la souris en effectuant ESPACE+ CLIC ou ESPACE+GLISSE</li>
<li>Le feu ne peut pas sortir en jet, il n'apparait qu'à l'aide de la touche ESPACE</li>
</ul>

<h3>Le «moteur physique»</h3>
<p>Il ne s'agit pas d'un moteur physique, loin de là ! Mais quelques fonctionalitées sont tout de même présentes :</p>
<ol>
<li>L'huile a une densité plus faible que l'eau et flotte.</li>
<li>Le déplacement de particules isolées est aléatoire.</li>
<li>Le sel et l'eau sont miscibles et forment un liquide de densité supérieur à l'huile et inférieure à l'eau.</li>
<li>Il faut beaucoup de feu pour faire disparaitre de l'eau</li>
<li>L'huile brûle</li>
<li>Le sable stoppe le feu</li>
</ol>

<p>Reste à faire :</p>
<ol>
<li>Le sel se consume</li>
<li>Le système des vases communicants</li>
<li>Ajout de paramètres physiques (température et pression)</li>
<li>Gestion des différents états de la matière</li>
<li>liste sans limite...</li>
</ol>

<h2>Téléchargement</h2>
<h3>Version Zippée : EXE + Code source</h3>
<ul>
<li><a href="Release/Life Game VII.zip">ZIP</a></li>
</ul>
<h3>Version EXE</h3>
<ul>
<li><a href="Release/LifeGameVII.exe">EXE</a></li>
<li><a href="Release/vb6fr.dll">VB6FR.dll</a> : à placer dans le même dossier que le fichier EXE</li>
</ul>
<h2>Code source</h2>
<p>Le projet est écrit en Visual Basic 6. Il utilise les APIs Windows pour la sortie graphique.<br />
Le langage Visual Basic n'étant pas extrêmement adapté à la gestion pixel par pixel, le programme est relativement lent.</p>
<p>La feuille :</p>
<?php InclureCode('Form1.frm',"VB"); ?>
<?php
include('../footer.php');
?>
