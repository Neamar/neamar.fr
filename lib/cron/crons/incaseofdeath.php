<?php
//////////////////////////////////////////////////////////////////////////
//In case of death. Voir http://blog.neamar.fr/component/content/article/4-prog/31-message-post-mortem-0

define('SVG_FILE',$_SERVER['DOCUMENT_ROOT'] . '/lib/cron/crons/datas/alive');

if(isset($_GET['IsAlive']))
{
	file_put_contents(SVG_FILE,1);
	echo '<p>Parfait, heureux de l\'apprendre ! Passe un bon mois :)</p>';
	exit();
}

//defined('CALL_FROM_CRON') or exit('Forbidden');


function envoimailDeath($to,$subject,$message)
{
	// Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// En-têtes additionnels
	$headers .= 'From: Neamar <neamar@neamar.fr>' . "\r\n";

	mail($to, $subject, $message, $headers);
}


$Envois=array(
'neamar@neamar.fr'=>'<p>Test du <strong>In Case Of Death</strong>.',
);

if(file_get_contents(SVG_FILE)==1)
{
	file_put_contents(SVG_FILE,0);
	envoimailDeath('neamar@neamar.fr','Still alive ?','<p>Yo Neamar !<br />Heureux de constater que tu lis ce mail ;) <a href="http://neamar.fr/lib/cron/crons/incaseofdeath.php?IsAlive">Clique ici pour garder tous les électrons au courant</a>.');
}
else
{//Et merde, j'avoue que j'aurais préféré que cette partie là du script ne s'active jamais :(
	foreach($Envois as $Dest=>$PostMortem)
	{
		envoimailDeath($Dest,"Message post mortem de neamar",$PostMortem);
	}
}
?>