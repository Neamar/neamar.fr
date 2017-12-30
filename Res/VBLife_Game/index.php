<?php
$Titre='Life Game : Un petit jeu physique sans pr�tention.';
$Box = array("Auteur" => "Neamar","Date" => "2006&shy;~2007", "But" =>"Divertis&shy;sement","Langage" =>"Visual Basic");
include('../header.php');
?>
<h1>Life Game</h1>
<h2>Pr�sentation</h2>
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
<p>Ce jeu se place dans la continuit� de <a href="http://www.koreus.com/jeu/sand7.html" rel="nofollow">World Of Sand</a> : aucun but pr�cis, juste le r�ve et la distraction.</p>

<p>Comment �jouer� :</p>
<ul>
<li>Un clic (ou un gliss�) de la souris dans le cadre noir trace un mur</li>
<li>Les touches du pav� num�rique de 1 � 9 permettent de r�gler la taille du pinceau qui cr�e les murs.</li>
<li>Vous pouvez choisir sur quel �l�ment vous souhaitez agir � l'aide des lettres du clavier :
	<ul>
		<li>�a� pour l'eau</li>
		<li>�b� pour le sable</li>
		<li>�c� pour l'huile</li>
		<li>�d� pour le sel</li>
		<li>�e� pour le feu</li>
	</ul></li>
<li>Une fois un �lement s�lectionn�, utilisez les chiffres au dessus du clavier (en dessous de la s�rie des touches F1~F12) pour r�gler le d�bit du jet. (0 =>Arr�t)</li>
<li>D�placez le jet � l'aide des touches gauche et droite</li>
<li>Vous pouvez aussi faire apparaitre l'�lement directement sous le curseur de la souris en effectuant ESPACE+ CLIC ou ESPACE+GLISSE</li>
<li>Le feu ne peut pas sortir en jet, il n'apparait qu'� l'aide de la touche ESPACE</li>
</ul>

<h3>Le �moteur physique�</h3>
<p>Il ne s'agit pas d'un moteur physique, loin de l� ! Mais quelques fonctionalit�es sont tout de m�me pr�sentes :</p>
<ol>
<li>L'huile a une densit� plus faible que l'eau et flotte.</li>
<li>Le d�placement de particules isol�es est al�atoire.</li>
<li>Le sel et l'eau sont miscibles et forment un liquide de densit� sup�rieur � l'huile et inf�rieure � l'eau.</li>
<li>Il faut beaucoup de feu pour faire disparaitre de l'eau</li>
<li>L'huile br�le</li>
<li>Le sable stoppe le feu</li>
</ol>

<p>Reste � faire :</p>
<ol>
<li>Le sel se consume</li>
<li>Le syst�me des vases communicants</li>
<li>Ajout de param�tres physiques (temp�rature et pression)</li>
<li>Gestion des diff�rents �tats de la mati�re</li>
<li>liste sans limite...</li>
</ol>

<h2>T�l�chargement</h2>
<h3>Version Zipp�e : EXE + Code source</h3>
<ul>
<li><a href="Release/Life Game VII.zip">ZIP</a></li>
</ul>
<h3>Version EXE</h3>
<ul>
<li><a href="Release/LifeGameVII.exe">EXE</a></li>
<li><a href="Release/vb6fr.dll">VB6FR.dll</a> : � placer dans le m�me dossier que le fichier EXE</li>
</ul>
<h2>Code source</h2>
<p>Le projet est �crit en Visual Basic 6. Il utilise les APIs Windows pour la sortie graphique.<br />
Le langage Visual Basic n'�tant pas extr�mement adapt� � la gestion pixel par pixel, le programme est relativement lent.</p>
<p>La feuille :</p>
<?php InclureCode('Form1.frm',"VB"); ?>
<?php
include('../footer.php');
?>
