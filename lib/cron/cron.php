 <?php
return;

$Path=substr(__FILE__,0,strrpos(__FILE__,'/'));
$_Path=$Path;
define('CRON_PATH',$_Path);

/**
 Structure du fichier crontab : un tableau dont la clé indique le timestamp auquel la commande doit s'exécuter, et la valeur les paramètres de la tâche cron.
Exemple :
array(
1268571201=>array
	(
		array
		(
			REPEAT=>true,
			INTERVAL=>24*3600*15,//Deux fois par mois
			CRON_TASK=>'/lib/cron/crons/db_optimizer.php',
			DO_IT_NOW=>false
		)
	)
);
a:1:{i:1268571201;a:1:{i:0;a:4:{s:1:"R";b:1;s:1:"I";i:86400;s:1:"C";s:18:"/lib/cron/crons/db_optimizer.php";s:1:"D";b:0;}}}
*/

define('CALL_FROM_CRON',true);

define('REPEAT','R'); //La tâche doit-elle être répétée ? (true|false)
	define('INTERVAL','I');//Si oui, à quel intervalle ? (secondes)
define('CRON_TASK','C');//Que faut-il faire (filename) ?
define('DO_IT_NOW','D');//L'exécution doit-elle être immédiate, ou peut-on attendre la fin du fichier (true|false) ? Bien évidemment, false est préférable ;)

//On ne peut pas modifier le tableau directement depuis le foreach, on note donc à côté ce qu'on devra faire.
$ToUnset=array();
$now=time();

//Faut-il faire quelque chose ? Récupérer la liste des crons.
$crontab = fopen(CRON_PATH . '/crontab', 'r+');

//Acquérir un verrou sur le fichier pour ne pas être dérangé.
flock($crontab, LOCK_EX);

$cronss=unserialize(fgets($crontab));
foreach($cronss as $timestamp=>$crons)
{
	//Vérifier que le cron doit bien être exécuté, sinon on dégage --->[]
	if($timestamp>$now)
		break;

	//Pour chacun des crons à déclencher à cet horaire
	foreach($crons as $cron)
	{
		//Sinon, la tâche cron doit-être faite. Si DO_IT_NOW est sur true, on l'effectue immédiatement, sinon on se permet d'attendre la fin du script.
		if($cron[DO_IT_NOW])
			cron_doCron($cron[CRON_TASK]);
		else
			register_shutdown_function('cron_doCron',$cron[CRON_TASK]);

		//Si cron répétitif, le remettre dans la liste.
		if($cron[REPEAT])
		{
			if(!isset($cronss[$timestamp+$cron[INTERVAL]]))
				$cronss[$timestamp+$cron[INTERVAL]]=array($cron);
			else
				$cronss[$timestamp+$cron[INTERVAL]][]=$cron;
		}
	}
	$ToUnset[] = $timestamp;
}

if(isset($ToUnset[0]))
{
	//Il y a eu des modifications : mettre à jour la cronlist, la trier, puis l'enregistrer.
	foreach($ToUnset as $timestamp)
	{
		unset($cronss[$timestamp]);
	}
	//Trier la liste correctement :
	ksort($cronss);

	//Et enregistrer les modifications
	ftruncate($crontab, 0) ;
	fseek($crontab,0);
	fputs($crontab,serialize($cronss));
}

//Ne pas oublier de rendre la ressource ;)
fclose($crontab);

//Fonction utilisée pour les crons qui peuvent s'exécuter
function cron_doCron($file)
{
	$fichier = fopen(CRON_PATH . '/log', 'a'); //Ouvrir le fichier

	$Chaine = time() . '|' .  $file;//Formater la chaine : Date|Cible
	fputs($fichier, $Chaine . "\n");//Puis enregistrer les données

	if(is_file('/kunden/homepages/38/d222425658/htdocs/' . $file))//On ne peut pas utiliser $_SERVER['DOCUMENT_ROOT'] car le script est appelé depuis plusieurs serveurs distincs
		include('/kunden/homepages/38/d222425658/htdocs/' . $file);
	else
		fputs($fichier, '==ERREUR : impossible de trouver ' . '/kunden/homepages/38/d222425658/htdocs/' . $file . "==\n");
	fclose($fichier); //Et fermer le fichier
}
//include('/kunden/homepages/38/d222425658/htdocs/' . '/lib/cron/crons/TwitterOmnilogie.php');
?>