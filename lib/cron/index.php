<?php
header("content-encoding:iso-8859-1");

define('REPEAT','R'); //La tâche doit-elle être répétée ? (true|false)
	define('INTERVAL','I');//Si oui, à quel intervalle ? (secondes)
define('CRON_TASK','C');//Que faut-il faire (filename) ?
define('DO_IT_NOW','D');//L'exécution doit-elle être immédiate, ou peut-on attendre la fin du fichier (true|false) ? Bien évidemment, false est préférable ;)


if(isset($_POST['ajout']))
{
	$crontab = fopen("crontab", "r+");

	//Acquérir un verrou sur le fichier pour ne pas être dérangé.
	flock($crontab, LOCK_EX);

	$cronss=unserialize(fgets($crontab));

	$newCron=array
	(
		REPEAT=>($_POST['repetition']!=0),
		INTERVAL=>$_POST['repetition'],
		CRON_TASK=>$_POST['cible'],
		DO_IT_NOW=>($_POST['undelayed']=='on')
	);

	if(!isset($cronss[$_POST['depart']]))
		$cronss[$_POST['depart']]=array($newCron);
	else
		$cronss[$_POST['depart']][]=$newCron;
	//Trier la liste correctement :
	ksort($cronss);
	//Et enregistrer les modifications
	ftruncate($crontab, 0) ;
	fseek($crontab,0);
	fputs($crontab,serialize($cronss));
}

$cronss = unserialize(file_get_contents("crontab"));
?>
<table style="border-collapse:collapse; text-align:center;">
<caption>Crons enregistrés</cpation>
<thead>
	<tr>
		<th>Déclenchement</th>
		<th>Cible</th>
		<th>Délai de répétition</th>
		<th>Immédiat</th>
	</tr>
</thead>
<tbody>
<?php

foreach($cronss as $timestamp=>$crons)
{
	foreach($crons as $cron)
	{
		$cron[INTERVAL] /=3600;
		echo '<tr>
		<td style="border:1px solid gray; padding:5px;">' . date('d/m/Y G:i:s',$timestamp) . '</td>
		<td style="border:1px solid gray; padding:5px;">' . $cron[CRON_TASK] . '</td>
		<td style="border:1px solid gray; padding:5px;">' . ($cron[REPEAT]?(($cron[INTERVAL]>24)?($cron[INTERVAL]/(24) . 'j'):$cron[INTERVAL] . 'h'):'&empty;') . '</td>
		<td style="border:1px solid gray; padding:5px;">' . ($cron[DO_IT_NOW]?'Oui':'Non') . '</td>
	</tr>';
	}
}
?>
</tbody>
</table>

<fieldset>
<legend>Ajout d'une nouvelle tâche cron</legend>

<form method="post" action="">
<p>
<input type="hidden" name="ajout" value="1" />
<input type="text" value="<?php echo time(); ?>" name="depart" id="depart"/><label for="depart">Premier déclenchement</label><br />
<input type="text" value="" name="cible" id="cible"/><label for="cible">Cible du cron</label><br />
<input type="text" value="0" name="repetition" id="repetition"/><label for="repetition">Fréquence (0 : non répétitif)</label><br />
<input type="checkbox" name="undelayed" id="undelayed" /><label for="undelayed">Déclenchement immédiat</label><br />
<input type="submit" value="Enregistrer ce cron" />
</p>
</form>
</fieldset>