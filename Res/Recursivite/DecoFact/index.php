<?php
$Titre='D�composition en produits de facteurs premiers.';
$Box = array("Auteur" => "Neamar","Date" => "Juillet 2008", "But" =>"DecoFact","Langage" =>"Visual Basic","Voir aussi" =>'<a href="..">La r�cursivit�</a>');
include('../../header.php');
?>
<h1>D�composition en produits de facteurs premiers.</h1>
<h2>Pr�sentation</h2>
<h3>Images</h3>
<p><img src="Images/DecoFact.png" alt="D�composition en produits de facteurs premiers" /><img src="Images/DecoFact2.png" alt="D�composition en produits de facteurs premiers" /></p>

<h3>Description</h3>
<p>Le but de ce code est de d�composer n'importe quel nombre fourni en produit de facteurs premiers.</p>
<p>Il s'av�re relativement rapide, calculant sans aucun temps de latence jusqu'au d�passement de la valeur max autoris�e..</p>
<h2>Plus d'informations</h2>
<p>Ce code source a �t� �crit pour le tutorial sur la r�cursivit� que vous retrouverez ici : <a href="..">La r�cursivit�</a><br />
Pour l'humour, n'h�sitez pas � visiter : <a href="http://hacks.atrus.org/factor_clock/" rel="nofollow">la d�composition du temps en produits de facteurs premiers</a></p>
<h2>T�l�chargement</h2>
<h3>Version Zipp�e : EXE + Code source</h3>
<ul>
<li><a href="Release/Decofact.zip">ZIP</a></li>
</ul>
<h3>Version EXE</h3>
<ul>
<li><a href="Release/DecoFact.exe">EXE</a></li>
<li><a href="Release/vb6fr.dll">VB6FR.dll</a> : � placer dans le m�me dossier que le fichier EXE</li>
</ul>
<h2>Code source</h2>
<p>La feuille :</p>
<?php InclureCode('Form1.frm','vb'); ?>
<p>Les modules :</p>
<?php InclureCode('Fonctions.bas','vb'); ?>
<?php
include('../../footer.php');
?>
