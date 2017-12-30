<?php
//defined('CALL_FROM_CRON') or exit('Forbidden');

ignore_user_abort(true);
function send_mail($aliasBase,$URI)
{
	//Envoyer par mail le résultat
	$boundary = "_".md5 (uniqid (rand()));

	$headers ="From: neamar@neamar.fr \r\n";
	$headers .= "MIME-Version: 1.0\r\nContent-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

	mail(
	'neamar@neamar.fr',
	'Sauvegarde SQL : ' . $aliasBase,
	"--". $boundary ."\nContent-Type: text/plain; charset=ISO-8859-1\r\n\nSauvegarde de la base de données.\n\n". "--" .$boundary . "\nContent-Type: application/x-gzip; name=\"dump_$aliasBase.sql.gz\"\r\nContent-Transfer-Encoding: base64\r\nContent-Disposition: attachment; filename=\"dump_$aliasBase.sql.gz\"\r\n\n".chunk_split(base64_encode(file_get_contents($URI))) . "--" . $boundary . "--",
	$headers);
}

/**
* Sauvegarde la base demandée.
* @param serveur : le serveur
* @param login : le login de connexion
* @param password
* @param base
*/
function dumpMySQL($serveur, $login, $password, $base, $aliasBase)
{
	$URI = date('Y-m-d') . ' ' . $aliasBase . '.gz';
	$Fichier = gzopen($URI,'w');

	$connexion = mysql_connect($serveur, $login, $password);
	mysql_select_db($base, $connexion);

	gzwrite($Fichier,"-- ----------------------
-- dump de la base ".$base." au " . date("d-M-Y")."
-- ----------------------\n\n\n");

	$listeTables = mysql_query("show tables", $connexion);
	$partie=0;
	while($table = mysql_fetch_array($listeTables))
	{
		gzwrite($Fichier, "-- -----------------------------
-- creation de la table ".$table[0] . "
-- -----------------------------\n");

		$listeCreationsTables = mysql_query("show create table ".$table[0], $connexion);
		while($creationTable = mysql_fetch_array($listeCreationsTables))
			gzwrite($Fichier, $creationTable[1].";\n\n");

	//Table à ne pas exporter
		$forbidden = array('MISC_Mots','OT2J_Textes','TYPO_Textes');
	//Champs à quoter
		$quotes = array("string","blob","date","time","datetime");
		if(!in_array($table[0],$forbidden))
		{
			$donnees = mysql_query("SELECT * FROM ".$table[0]);

			gzwrite($Fichier, "-- -----------------------------
-- insertions dans la table ".$table[0]."
-- -----------------------------\n");

			while($nuplet = mysql_fetch_array($donnees))
			{
				$tuple = "INSERT INTO ".$table[0]." VALUES(";
				for($i=0; $i < mysql_num_fields($donnees); $i++)
				{
					if($i != 0)
						$tuple .=  ", ";
					if(in_array(mysql_field_type($donnees, $i),$quotes))
						$tuple .=  "'";
					$tuple .= str_replace(array('\'','\\'),array('\'\'','\\\\'),$nuplet[$i]);
					if(in_array(mysql_field_type($donnees, $i),$quotes))
						$tuple .=  "'";
				}
				$tuple .=  ");\n";

				gzwrite($Fichier, $tuple);
			}
		}
		else
			gzwrite($Fichier, '-- DONNÉE DE LA TABLE ' . $table[0] . ' non exportées.' . "\n");
	}
    mysql_close($connexion);

	unset($donnees,$nuplet,$listeCreationsTables,$forbidden,$listeTables);
	gzclose($Fichier);

	send_mail($aliasBase,$URI);
	unlink($URI);
}

dumpMySQL('db2238.1and1.fr','dbo312382846','gIiobdz461hJ','db312382846','Blog');
dumpMySQL('db2228.1and1.fr','dbo312253462','vxNzF1oeWcdy','db312253462','Picanas');
//dumpMySQL('db2538.1and1.fr','dbo332511559','M$$~/OdqJjkeG-b','db332511559','Malphas');
dumpMySQL('db1182.1and1.fr','dbo222432208',strrev("Wypx4xsD"),'db222432208','Neamar');