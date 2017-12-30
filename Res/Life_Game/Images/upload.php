<?php
ob_start();
print_r($_POST);
file_put_contents('OK',ob_get_clean());

function microtime_float()
{
   return array_sum(explode(' ', microtime()));
}
$debut = microtime_float();

if($_POST['api_key']!='7f022eae-e09f-428b-a9f5-1c41c4a5df46')
	exit('Access denied : wrong API Key');
elseif(!preg_match('#^[0-9]+$#',$_POST['Name']))
	exit('Access denied : Wrong or incorrect name');
elseif(is_file('Screenshots/' . $_POST['Name'] . '.png'))
	exit('Access denied : File already exists');
else
{
	$ID=$_POST['Name'];

	$Width=$_POST['sizeX'];//min(1200,$_POST['sizeX']);
	$Height=$_POST['sizeY']+20;//min(1200,$_POST['sizeY']) + 20;
	$capture=imagecreatetruecolor($Width,$Height);
	$noir=imagecolorallocate($capture,0,0,0);
	$Particules=explode('|',$_POST['items']);
	foreach($Particules as $Particule)
	{
		$ParticuleD=explode(',',$Particule);
		$x=base_convert($ParticuleD[0],32,10);
		$y=base_convert($ParticuleD[1],32,10);
		$rgb=base_convert($ParticuleD[2],32,10);
		$R = ($rgb >> 16) & 0xFF;
		$G = ($rgb >> 8) & 0xFF;
		$B = $rgb & 0xFF;

		imagesetpixel($capture,$x,$y,imagecolorallocate($capture,$R,$G,$B));
	}

	$Blanc=imagecolorallocate($capture,255,255,255);
	imagettftext($capture,10,0,6,12,imagecolorallocate($capture,255,255,255),'arial.ttf','http://neamar.fr/Res/Life_Game/Images/Screenshots/' . $ID . '.png');
	imagettftext($capture,10,0,10,$Height -2,imagecolorallocate($capture,255,255,255),'arial.ttf',stripslashes($_POST['Infos']));

	imagepng($capture,"Screenshots/" . $ID . ".png");
	echo 'OK';
}

$fin = microtime_float();
// echo ' (' . round($fin-$debut,4) . ')';