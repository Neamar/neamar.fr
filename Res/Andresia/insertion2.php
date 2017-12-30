<?php
include('header.php');

define('EASYSQL_PREFIXE','OMNI_');
include('../../lib/EasySQL.php');

if(isset($_POST['ajoutSort']) && EasySQL::commitInsert('Sorts',$_POST))
	echo 'Enregistré.';

if(isset($_POST['updateSort']) && EasySQL::commitUpdate('Sorts',$_POST))
	echo 'Modifié.';

if(isset($_POST['retraitSort']))
	echo 'Enregistrements supprimés : ' . EasySQL::commitDelete('Sorts',$_POST);


EasySQL::getFormInsert('Propositions','ajoutSort');

echo '<hr />';

// EasySQL::getFormUpdate('Sorts','b','updateSort');
//
// echo '<hr />';
//
// EasySQL::getFormDelete('Sorts','retraitSort');