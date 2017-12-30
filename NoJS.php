<?php
$titre="Contenu du menu " . $_GET['Menu'];
$_GET['Menu']=htmlentities($_GET['Menu']);
$menus=array();
include('header.php');
?>
<p>Théoriquement, vous êtes censé voir ce sous menu de facon interactive ! Vous devriez vraiment utiliser un nvaigateur plus récent.<br />
Cependant, pour ne pas trop vous pénaliser, voilà le contenu du menu :</p>
<ul>
<?php
$donnees=mysql_query('SELECT _Menus.Caption,_Menus.Lien,CONCAT("<ul>",SousMenus,"</ul>") As SousSousMenu
FROM _Menus
LEFT JOIN
(
	SELECT GROUP_CONCAT("<li><a href=\\"",Sous_Menus.Lien,"\\">",Sous_Menus.Caption,"</a></li>" ORDER BY Sous_Menus.ID DESC SEPARATOR \'' . "\n" . '\') AS SousMenus,Sous_Menus.ChildOf
	FROM _Menus AS Sous_Menus
	GROUP BY Sous_Menus.ChildOf
) Concatenation ON Concatenation.ChildOf=_Menus.ID
WHERE _Menus.Categorie=\'' . $_GET['Menu'] . '\'
AND _Menus.ChildOf=0') or die(mysql_error());

while($sousmenu=mysql_fetch_array($donnees))

	echo '				<li><a href="' . $sousmenu['Lien'] . '">' . $sousmenu['Caption'] . '</a>' . $sousmenu['SousSousMenu'] . '</li>' . "\n";


?>
</ul>
</div>
</body>
</html>