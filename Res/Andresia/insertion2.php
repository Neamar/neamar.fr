<?php
include('header.php');

define('EASYSQL_PREFIXE','OMNI_');
include('../../lib/EasySQL.php');

if(isset($_POST['ajoutSort']) && EasySQL::commitInsert('Sorts',$_POST))
	echo 'Enregistr�.';

if(isset($_POST['updateSort']) && EasySQL::commitUpdate('Sorts',$_POST))
	echo 'Modifi�.';

if(isset($_POST['retraitSort']))
	echo 'Enregistrements supprim�s : ' . EasySQL::commitDelete('Sorts',$_POST);


EasySQL::getFormInsert('Propositions','ajoutSort');

echo '<hr />';

// EasySQL::getFormUpdate('Sorts','b','updateSort');
//
// echo '<hr />';
//
// EasySQL::getFormDelete('Sorts','retraitSort');