<?php
$Story = stripslashes(str_replace('_', ' ', $_GET['h']));

/**
 * Affiche le contenu
 * $Story l'histoire
 * $Content le contenu du tableau généré par ce fichier
 */
function displayContent($Story, $Content, $hLevel = 2)
{
	global $Comment;

	echo "\n\n" . '<h' . $hLevel . '>' . $Story . '</h' . $hLevel . '>' . "\n";
	echo '<div>
	<ul class="image-overlay">' . "\n";

	foreach($Content['IMAGE'] as $Type => $URL)
	{
		if(isset($Comment[str_replace(array('DUCK/','.jpg'),'',$URL)]))
		{
			$Rem = $Comment[str_replace(array('DUCK/','.jpg'), '', $URL)];
			$borderColor = 'orange';
		}
		elseif(isset($Content['DUCK'][$Type]))
		{
			$borderColor = 'green';
			$Rem = 'Found.';
		}
		else
		{
			$Rem = 'D.U.C.K not found';
			$borderColor = 'red';
		}

		echo '
	<li>
		<a href="' . $URL . '" style="border:2px solid ' . $borderColor . '" title="' . $Rem . '">
		<img src="T/' . $URL . '" />
		<div class="caption">
		<h3>' . ucfirst($Type) . '</h3>' . "\n"
		. '<p>' . $Rem . "</p>\n";


		echo '</div>
		</a>
	</li>' . "\n";
	}
	echo "\n
	</ul>
	</div>";
}

include('loader.php');

if(!isset($Files[$Story]))
{
	header('Location:http://neamar.fr/Res/DUCK/');
	exit();
}

$Titre='D.U.C.K. dedication in ' . $Story . ' by Don Rosa';
$Box = array("Author" => "Don Rosa","Date" => "20011", "Goal" =>"Find the D.U.C.K. !");
$AddLine = '
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
<script type="text/javascript" src="jquery.imageoverlay/jquery.metadata.2.1/jquery.metadata.js"></script>
<script type="text/javascript" src="jquery.imageoverlay/jquery.ImageOverlay.min.js"></script>
<script type="text/javascript" src="jquery.lightbox/js/jquery.lightbox-0.5.js"></script>
<script>
$(function() {
	$(".image-overlay").ImageOverlay();
	$(".image-overlay").each(function(){$(this).find("a").lightBox() });
	$(".toggleDuck").click(function()
	{
		$("ul.image-overlay a").each(function()
		{
			var thumb = $(this).find("img");
			console.log(thumb);
			if(this.title=="Found.")
			{
				this.href = this.href.replace(".jpg", "_DUCK.jpg");
				this.title="Found and shown."
				thumb.css("height", "300px");
				thumb.data("oldSrc", thumb.attr("src"));
				thumb.css("background-image", "url(images/lightbox-ico-loading.gif)");
				thumb.attr("src", "");
				thumb.attr("src", this.href);
			}
			else if(this.title=="Found and shown.")
			{
				this.href = this.href.replace("_DUCK.jpg", ".jpg");
				this.title="Found."
				thumb.attr("src", thumb.data("oldSrc"));
			}
		});
	return false;
	});
});
</script>

<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="jquery.imageoverlay/ImageOverlay.css" />
<link rel="stylesheet" type="text/css" href="jquery.lightbox/css/jquery.lightbox-0.5.css" />
<style type="text/css">
h2:before
{
	margin-left:2.5em;
}

img
{
	clear:none;
	float:none;
	padding: 0;
}

div.caption p
{
	font-size:75%;
}
</style>
';

include('../header.php');
displayContent($Story, $Files[$Story], 1);
?>
<p>Hover any image to view the status. Click to see full-size.<br />
Can't find the D.U.C.K dedication ? <a href="#" class="toggleDuck">Click to toggle !</a></p>