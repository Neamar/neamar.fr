<?php

/*
R�cup�rer tables :
SHOW TABLE STATUS
WHERE Name LIKE "Andresia%"
*/

/*
R�cup�rer carac table :
DESCRIBE ANDRESIA_Magies
*/

//Cr�e un combobox avec les options fournies dans le tableau
function makeCombo($Name,$Tableau)
{
	echo '<select ' . nameID($Name) . '>';
	foreach($Tableau as $Val=>$Option)
		echo '<option value="' . $Val . '">' . $Option . '</option>';
	echo '</select>';
}

//Cr�er une liste de boutons radios avec les options fournies dans le tableau
function makeRadio($Name,$Tableau)
{
	foreach($Tableau as $Val=>$Option)
		echo '<input type="radio" name="' . $Name . '" value="' . $Val . '" id="' . $Val . '" /> <label for="' . $Val . '">' . $Option . '</label>';
}

//Fonction de conv�nience pour ajouter les attributs name et id � un formulaire.
function nameId($Name)
{
	return 'name="'  . $Name . '" id="' . $Name . '"';
}


if(!isset($_GET['Table']))
{
	//S�lectionner une table parmi les diff�rentes possibilit�s.
	$Titre='Ajout de r�gles';
	include('header.php');

	echo '<form method="get" action="">';
	$Tables=mysql_query('SHOW TABLE STATUS
	WHERE Name LIKE "' . PREFIXE . '%"');

	$TablesCombo=array();
	while($Table=mysql_fetch_assoc($Tables))
	{
		$Table['Name']=str_replace(PREFIXE,'',$Table['Name']);
		$Table['Comment']=$Table['Name'] . ' : ' . substr($Table['Comment'],0,strpos($Table['Comment'],';'));

		$TablesCombo[$Table['Name']]=$Table['Comment'];
	}

	makeCombo('Table',$TablesCombo);
	echo '<input type="submit" value="Ajouter une ligne sur cette table" />';
	echo '</form>';
}
else
{
	$Titre='Ajout de r�gles pour <strong>' . $_GET['Table'] . '</strong>';
	include('header.php');
	$Table=PREFIXE . $_GET['Table'];

	if(count($_POST)!=0)
	{
		//S�curiser les donn�es
		$_POST=array_map(mysql_real_escape_string,$_POST);

		//Enregistrer la ligne
		$SQL='INSERT INTO ' . $Table . '
		VALUES(""';
		foreach($_POST as $Val)
			$SQL .=',"' . $Val . '"';
		$SQL .=')';
		mysql_query($SQL)or die('<pre>' . $SQL . '</pre>Erreur : ' . mysql_error());
		$Msg= '<p>Ligne correctement ajout�e.</p>';
	}

	//Formulaire d'ajout de lignes sur la table $_GET['Table']
	echo '<p><a href="insertion.php">Retour aux choix des tables</a></p>';
	echo '<p>' . $Msg . '</p>';
	echo '<form method="post" action="">';
	$Structure=mysql_query('DESCRIBE ' . $Table)or die(mysql_error());
	//R�cup�rer la structure de la table
	while($Colonne=mysql_fetch_assoc($Structure))
	{
		if($Colonne['Field']!='ID')
		{
			echo '<label for="' . $Colonne['Field'] . '" style="float:left; width:350px;">' . $Colonne['Field'] . ' : </label>';
			if(strpos($Colonne['Field'],'_')!==false)//Cl� �trang�re
			{
				//Syntaxe : TABLE_Cle
				$Delimiteur=strpos($Colonne['Field'],'_');
				$Table=substr($Colonne['Field'],0,$Delimiteur);
				$Cle=substr($Colonne['Field'],$Delimiteur+1);
				$Possibilites=mysql_query('SELECT ' . $Cle . ' FROM ' . PREFIXE . $Table);
				$PossibilitesCombo=array();
				while($Possibilite=mysql_fetch_assoc($Possibilites))
				{
					$PossibilitesCombo[$Possibilite[$Cle]] = $Possibilite[$Cle];
				}
				makeCombo($Colonne['Field'],$PossibilitesCombo);
			}
			elseif(strpos($Colonne['Type'],'varchar')!==false)//Type VARCHAR
				echo '<input type="text" ' . nameID($Colonne['Field']) . ' />';
			elseif($Colonne['Type']=='text')//Type TEXT
				echo '<br /><textarea cols="25" rows="5" style="width:90%;" ' . nameID($Colonne['Field']) . '></textarea>';
			elseif($Colonne['Type']=='tinyint(1)')//Type BOOL
				makeRadio($Colonne['Field'],array('1'=>'Oui','0'=>'Non'));
			else
				echo 'ERREUR, type de colonne inconnu.';
		}
		echo '<br />';
	}
	echo '<input type="submit" value="Ajouter une ligne sur ' . $Table . '" />';
	echo '</form>';
}


include('../footer.php');