<?php
/**
 * Construit le tableau des fichiers
 */
function getPics($Dir,&$Files)
{
   $dh = opendir($Dir);
	while (($file = readdir($dh)) !== false)
	{
		if($file != '.' && $file != '..')
		{
			if(is_dir($Dir . '/' . $file))
				getPics($Dir . '/' . $file,$Files);
			else
			{
				if(preg_match('#^(.+)(_(.+))?(_DUCK)?\.(jpg|png|gif)$#isU',$file,$Match))
				{
					$URL=$Dir . '/' . $file;
					$Histoire=$Match[1];
					$Type=$Match[3];
					if($Type=='')
						$Type='first page';

					if(!isset($Files[$Histoire]))
						$Files[$Histoire]=array('IMAGE'=>array(),'DUCK'=>array());

					if($Match[4]=='')
						$Files[$Histoire]['IMAGE'][$Type]=$URL;
					elseif($Match[4]=='_DUCK')
						$Files[$Histoire]['DUCK'][$Type]=$URL;
					else
						echo 'Fichier non correspondant : ' . $file . '<br />';

				}
				else
					echo 'Fichier non correspondant : ' . $file . '<br />';
			}
		}
	}

	closedir($dh);
}
$Files=array();
getPics('DUCK',$Files);
ksort($Files);

//Fichiers spéciaux
$Comment=array(
	'A Letter From Home_prologue'=>'Prologue has no dedication',
	'Attack Of The Hideous Space-Varmints!_cover'=>'This cover has no dedication.',
	'Back in Time for a Dime!'=>'Don made the story, but he didn\'t draw it: no D.U.C.K here.',
	'Fiscal Fitness'=>'No dedication.',
	'Forget Me Not'=>'No dedication.',
	'Give Unto Others'=>'No dedication.',
	'His Majesty McDuck_cover'=>'This cover was done before Don started writing D.U.C.K.s on covers.',
	'Last Sled to Dawson_cover'=>'No dedication',
	'Leaky Luck'=>'No dedication',
	'Well-Educated Duck'=>'No dedication',
	'Mythological Menagerie'=>'No dedication',
	'Nobody\'s Business'=>'Dedication is in the last page of the issue.',
	'On A Silver Platter'=>'No dedication',
	'On Stolen Time'=>'No dedication',
	'Recalled Wreck'=>'No dedication',
	'Return To Plain Awful_cover'=>'No dedication',
	'Return To Xanadu_cover2'=>'No dedication',
	'Rocket Reverie'=>'No dedication',
	'The Duck Who Fell To Earth'=>'No dedication',
	'The Duck Who Never Was'=>'No dedication',
	'The Duck Who Never Was_cover'=>'No dedication',
	'The Guardians of the Lost Library_cover'=>'No dedication',
	'The Master Landscapist'=>'Originally in the flower at the bottom left, but disappeared due to inking and coloring.',
	'The Pied Piper of Duckburg'=>'The first three pages were done by Barks, so no dedication.',
	'The Quest for Kalevala_cover'=>'No dedication',
	'The Son Of The Sun_cover'=>'No dedication',
	'The Son Of The Sun'=>'No dedication',
	'The Treasury Of Croesus_cover'=>'No dedication',
	'The Universal Solvent'=>'No dedication',
	'Treasure Under Glass'=>'No dedication',
	'Treasure Under Glass_cover'=>'No dedication',
);
?>