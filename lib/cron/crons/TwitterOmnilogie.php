<?php
//éà CETTE PAGE EST EN UTF-8

defined('CALL_FROM_CRON') or exit('Forbidden');

define('TWITTER_USER','Omnilogie');
define('TWITTER_PWD','BotOmnilogie69');

define('TWITTER_ID',111340166);

include_once('/kunden/homepages/38/d222425658/htdocs/lib/twitter/twitter.php');
include_once('/kunden/homepages/38/d222425658/htdocs/ConnectBDD.php');
$D=mysql_query('SELECT ID, Titre, Accroche
FROM OMNI_Omnilogismes
WHERE !ISNULL(Sortie)
ORDER BY RAND()
LIMIT 1') or die(mysql_error());
$D=mysql_fetch_assoc($D);
$D['URL'] = 'http://omnilogie.fr/' . strtoupper(base_convert($D['ID'],10,35));
$D['Tweet'] = '♻ ' . $D['URL'] . ' : ' . utf8_encode(($D['Accroche']==''?$D['Titre']:$D['Accroche']));

//echo $D['Tweet'];
twit(TWITTER_USER,TWITTER_PWD,$D['Tweet'],true);