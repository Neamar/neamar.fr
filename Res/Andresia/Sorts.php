<?php
$Titre="Sorts";
include('header.php');
?>
<div class="TOC floatR insideTOC"></div>

<p class="important">Liste des différents sorts accessibles aux joueurs d'Andrésia.</p>

<?php
//Pour chaque type de magie :
$Magies=mysql_query('SELECT Magie
FROM ' . PREFIXE . 'Magies');

while($Magie=mysql_fetch_assoc($Magies))
{
	$Texte .='\section{' . $Magie['Magie'] . '}' . "\n";
	$Sorts=mysql_query('SELECT Nom,Niveaux_Niveau,Effet,Contact
	FROM ' . PREFIXE . 'Sorts
	WHERE Magies_Magie="'  . $Magie['Magie'] . '"
	ORDER BY Niveaux_Niveau, Nom')or die(mysql_error());
	while($Sort=mysql_fetch_assoc($Sorts))
	{
		$Texte .='\subsection{' . $Sort['Nom'] . '}' . "\n";
		$Texte .='\begin{itemize}' . "\n";
		$Texte .='\li \b{Niveau requis pour son utilisation} : Niveau ' . $Sort['Niveaux_Niveau'] . "\n";
		$Texte .='\li \b{Effet} : ' . $Sort['Effet'] . "\n";
		if($Sort['Contact']==1)
			$Texte .='\li Ce sort est un sort de contact.' . "\n";
		$Texte .="\end{itemize}" . "\n";
	}
}

Typo::setTexte($Texte);
echo Typo::Parse();

include('../footer.php');