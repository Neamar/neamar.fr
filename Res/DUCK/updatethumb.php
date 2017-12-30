<?php
$i=0;
$dh = opendir('DUCK');
while (($file = readdir($dh)) !== false)
{
	if($file != '.' && $file != '..')
	{
		if(!preg_match('#^(.+)(_DUCK)\.(jpg|png|gif)$#isU',$file))
		{
			if(!is_file('T/DUCK/' . $file))
			{

				makethumb($file,300,'T/DUCK/');
				echo $file . '<br />';
			}
			if(!is_file('T2/DUCK/' . $file))
			{

				makethumb($file,100,'T2/DUCK/');
				echo $file . '<br />';
				$i++;
				if($i==50)
					exit();
			}
		}
	}
}
echo 'No more.';

closedir($dh);

function makethumb($Source,$Size,$Dest)
{
	$source = imagecreatefromjpeg('DUCK/' . $Source); // La photo est la source
	$destination = imagecreatetruecolor(imagesx($source)*$Size/imagesy($source),$Size); // On crée la miniature vide

	// On crée la miniature
	imagecopyresampled($destination, $source, 0, 0, 0, 0, imagesx($destination), imagesy($destination), imagesx($source), imagesy($source));

	// On enregistre la miniature sous le nom "mini_couchersoleil.jpg"
	imagejpeg($destination, $Dest . $Source);
	echo '<img src="' . $Dest . $Source . '" />';
}
?>
