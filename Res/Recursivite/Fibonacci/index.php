<?php
$Titre='Une impl�mentation na�ve de la suite de Fibonacci.';
$Box = array("Auteur" => "Neamar","Date" => "Juillet 2008", "But" =>"Fibonacci r�cursif","Langage" =>"Visual Basic","Voir aussi" =>'<a href="..">La r�cursivit�</a>');
include('../../header.php');
?>
<h1>Une impl�mentation na�ve de la suite de Fibonacci</h1>
<h2>Pr�sentation</h2>
<h3>Images</h3>
<p><img src="Images/Fibonacci.png" alt="Fibonacci" /></p>

<h3>Description</h3>
<p>Ce code illustre une nouvelle fois la r�cursivit�. Le but est de montrer que dans ce cas l�, l'utilisation r�cursive est loin d'�tre justifi�e, et conduit � des probl�mes extr�mements lourds.<br />
Il calcule la suite de Fibonacci, qui est d�finie selon la relation de r�currence suivante :<br />
F<sub>n+2</sub>=F<sub>n+1</sub>+F<sub>n</sub></p>
<p>Il affiche aussi le nombre d'it�rations requises pour calculer chaque terme.</p>
<h2>Plus d'informations</h2>
<p>Ce code source a �t� �crit pour le tutorial sur la r�cursivit� que vous retrouverez ici : <a href="..">La r�cursivit�</a></p>
<h2>T�l�chargement</h2>
<h3>Version Zipp�e : EXE + Code source</h3>
<ul>
<li><a href="Release/Fibonacci.zip">ZIP</a></li>
</ul>
<h3>Version EXE</h3>
<ul>
<li><a href="Release/Fibonacci.exe">EXE</a></li>
<li><a href="Release/vb6fr.dll">VB6FR.dll</a> : � placer dans le m�me dossier que le fichier EXE</li>
</ul>
<h2>Code source</h2>
<p>La feuille :</p>
<?php InclureCode('Fibo.frm','vb'); ?>
<p>Les modules :</p>
<?php InclureCode('Fibo.bas','vb');

include('../../footer.php');
?>