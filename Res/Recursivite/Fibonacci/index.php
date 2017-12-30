<?php
$Titre='Une implémentation naïve de la suite de Fibonacci.';
$Box = array("Auteur" => "Neamar","Date" => "Juillet 2008", "But" =>"Fibonacci récursif","Langage" =>"Visual Basic","Voir aussi" =>'<a href="..">La récursivité</a>');
include('../../header.php');
?>
<h1>Une implémentation naïve de la suite de Fibonacci</h1>
<h2>Présentation</h2>
<h3>Images</h3>
<p><img src="Images/Fibonacci.png" alt="Fibonacci" /></p>

<h3>Description</h3>
<p>Ce code illustre une nouvelle fois la récursivité. Le but est de montrer que dans ce cas là, l'utilisation récursive est loin d'être justifiée, et conduit à des problèmes extrêmements lourds.<br />
Il calcule la suite de Fibonacci, qui est définie selon la relation de récurrence suivante :<br />
F<sub>n+2</sub>=F<sub>n+1</sub>+F<sub>n</sub></p>
<p>Il affiche aussi le nombre d'itérations requises pour calculer chaque terme.</p>
<h2>Plus d'informations</h2>
<p>Ce code source a été écrit pour le tutorial sur la récursivité que vous retrouverez ici : <a href="..">La récursivité</a></p>
<h2>Téléchargement</h2>
<h3>Version Zippée : EXE + Code source</h3>
<ul>
<li><a href="Release/Fibonacci.zip">ZIP</a></li>
</ul>
<h3>Version EXE</h3>
<ul>
<li><a href="Release/Fibonacci.exe">EXE</a></li>
<li><a href="Release/vb6fr.dll">VB6FR.dll</a> : à placer dans le même dossier que le fichier EXE</li>
</ul>
<h2>Code source</h2>
<p>La feuille :</p>
<?php InclureCode('Fibo.frm','vb'); ?>
<p>Les modules :</p>
<?php InclureCode('Fibo.bas','vb');

include('../../footer.php');
?>