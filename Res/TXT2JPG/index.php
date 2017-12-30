<?php
set_time_limit  (120);//Le chargement risque d'être long...

$Titre='Code source de TXT2JPG';
$Box = array("Auteur" => "Neamar","Date" => "2007", "But" =>"Conversion");
include('../header.php');

//L'ensemble est en cache pour ne pas tuer le serveur !
//Il suffit de commenter les trois lignes pour reprendre une génération standard.
readfile("Cache.php");
include("../footer.php");
exit();

?>
<h1>Code source de TXT2JPG</h1>
<h2>Avant de commencer</h2>
<h3>A propos...</h3>
<p><img src="Images/VB6.png" alt="Visual Basic 6" />TXT2JPG est un logiciel permettant de lire du texte sur n'importe quel baladeur affichant des images. Vous trouverez plus d'informations au sujet de ce logiciel sur <a href="http://neamar.free.fr/txt2jpg">le site du projet</a>.<br />
Cette page sert uniquement à l'affichage et au téléchargement du code. Si vous n'êtes pas programmeur (ou simplement curieux), vous pouvez passer votre chemin !</p>
<p>Le logiciel a été programmé à l'aide de l'ancien éditeur de BASIC de Microsoft, Visual Basic 6.0 (dernière version apparue avant l'avénement de l'architecture .NET).<br />
En conséquent, le code utilise le BASIC, mais aussi les APIs mises à disposition par Windows, et les possibilités de création de contrôles.</p>
<h3>Licence</h3>
<p>Ce code est fourni sous la licence <a href="http://creativecommons.org/licenses/by/3.0/deed.fr" rel="nofollow">Creative Commons BY</a></p>
<p>Cela signifie grossièrement :</p>
<ul>
<li>Vous êtes libres :
	<ul>
	<li>de reproduire, distribuer et communiquer cette création au public</li>
	<li>de modifier cette création</li>
	</ul>
</li>
<li>Selon les conditions suivantes :
	<ul>
	<li><strong>Paternité</strong>. Vous devez citer le nom de l'auteur original de la manière indiquée par l'auteur de l'oeuvre ou le titulaire des droits qui vous confère cette autorisation (mais pas d'une manière qui suggérerait qu'ils vous soutiennent ou approuvent votre utilisation de l'oeuvre).</li>
	</ul>
</li>
</ul>
<p><span class="petitTexte">Ceci n'est qu'un résumé de la licence, l'ensemble du texte juridique peut être trouvé en suivant le lien ci-dessus.</span></p>
<h2>Téléchargement</h2>
<p class="erreur">L'ensemble du code, des images et des fichiers associés peut être téléchargé ici : <a href="Release/TXT2JPG.zip">Zip du projet</a>.<br />
Cette archive contient aussi les anciennes versions des fichiers EXE de TXT2JPG, ainsi que les modules (Degrade, Convert PowerPoint)<br />
Attention, l'ensemble pèse plus de 6Mo.</p>

<h2>Visionnage du code source</h2>
<p><img src="Images/Arborescence.png" alt="L'arborescence du projet"/>Si vous souhaitez juste visionner le code pour satisfaire votre curiosité, cette section devrait vous plaire !<br />
Attention, le projet représente tout de même près de 3 000 lignes de code !</p>
<p>L'ensemble du code est très fortement commenté (près de 40%), et vous devriez pouvoir le comprendre sans difficulté.<br />
En revanche, les contrôles ne sont pas du tout commentés...mais ils respectent la même structure que n'importe quel contrôle VB, et vous ne devriez donc pas avoir de problèmes pour leur compréhension si vous êtes familier des notions abordées.</p>
<h3>La feuille principale</h3>
<p class="centre"><img src="Images/Form.png" alt="La feuille de travail" class="nonflottant petit" /></p>
<p>Seul le code de la feuille est présenté ici, le placement des contrôles ne présentant pas d'intêret. (vous le trouverez dans le zip)</p>
<?php InclureCode('Feuille.frm','vb'); ?>

<h3>Les modules :</h3>
<h4>Fonctions</h4>
<p>Le module fonction gère toutes les fonctions annexes qui ne sont pas des événements.</p>
<?php InclureCode('Fonctions.bas','vb'); ?>
<h4>Subclassing</h4>
<p>Le module Subclassing, comme son nom l'indique, gère tout ce qui concerne le sous classement de l'application (et les graphiques donc).</p>
<?php InclureCode('Subclassing.bas','vb'); ?>

<h3>Les contrôles :</h3>
<h4>Bouton</h4>
<p>Les boutons "Vista Like".</p>
<?php InclureCode('AfBtn.ctl','vb'); ?>
<h4>Case à cocher</h4>
<p>Les check box relookées.</p>
<?php InclureCode('CheckBoxPlus.ctl','vb'); ?>
<h4>Infobulles</h4>
<p>Les infobulles qui affichent l'aide contextuelle.</p>
<?php InclureCode('Tip.ctl','vb'); ?>

<h3>Fichiers de langues :</h3>
<p>Les textes d'accueil des deux langages sont stockés dans le dossier Lang du Zip.</p>
<h4>Francais</h4>
<p>Un fichier ini standard...</p>
<?php InclureCode('Francais.lng','ini'); ?>
<h4>Anglais</h4>
<p>Un autre fichier ini standard...</p>
<?php InclureCode('English.lng','ini'); ?>

<h3>Fichier d'installation :</h3>
<p>Le fichier setup est généré à l'aide du logiciel libre InnoSetup.<br />
Le fichier présenté ici contient des paths incorrects qu'il faudra remplacer par les vôtres si vous souhaitez compiler l'application.</p>
<?php InclureCode('setupscript.iss','inno'); ?>

<?php
include("../footer.php");
?>
