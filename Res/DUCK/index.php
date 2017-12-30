<?php
$Titre='D.U.C.K. : Dedicated To Uncle Karl by Keno &mdash; Don Rosa';
$Box = array("Author" => "Don Rosa","Date" => "2009", "Goal" =>"Find the D.U.C.K. !");
$AddLine = '
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
<script>
$(function() {
	$("#accordion").accordion({ header: \'h2\'});
	$(".notFound").each(function()
	{
		$(this).closest("div").prev("h2").css("color", "red");
	});
});
</script>

<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
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

div.thumbs
{
	text-align:center;
}
</style>
';

include('../header.php');

//Charger la liste des images
include('loader.php');
?>
<h1>Dedicated To Uncle Karl by Keno</h1>

<p class="petitTexte centre">This site is an uncommercial fanpage.<br />
Comic images available from these pages are © The Walt Disney Company. They are provided for purposes of study and reference only. Disney's copyright is acknowledged and respected. Nothing shown in these pages is meant as a Copyright Infringement</p>

<div id="accordion">
<?php
foreach($Files as $Histoire => $Images)
{
	$href = 'Story-' . str_replace(' ', '_', $Histoire);

	echo "\n\n" . '<h2>' . $Histoire . '</h2>' . "\n";
	echo '<div>';

	echo '<div class="thumbs"><a href="' . $href . '">';
	foreach($Images['IMAGE'] as $Type => $URL)
	{
		echo '<img src="T2/' . $URL . '" alt="' . $Histoire . ' by Don Rosa" />';
	}
	echo '</a></div>';

	echo '<ul class="status">' . "\n";

	foreach($Images['IMAGE'] as $Type => $URL)
	{
		if(isset($Comment[str_replace(array('DUCK/','.jpg'),'',$URL)]))
		{
			$Rem = $Comment[str_replace(array('DUCK/','.jpg'), '', $URL)];
			$borderColor = 'orange';
		}
		elseif(isset($Images['DUCK'][$Type]))
		{
			$borderColor = 'green';
			$Rem = 'D.U.C.K Found.';
		}
		else
		{
			$Rem = '<span class="notFound">D.U.C.K not found</span>';
			$borderColor = 'red';
		}

		echo '
<li>
	<span style="color: ' . $borderColor . '">' . ucfirst($Type) . '</span>: ' . $Rem . '
</li>' . "\n";
	}
	echo '
	</ul>
	<a href="' . $href . '">View "' . $Histoire . '" images full-size and the D.U.C.K dedication</a>
</div>';
}

?>
</div>

<p class="petitTexte">Contact : neamar@neamar.fr<br />
See <a href="http://www.duckmania.de/english/" rel="nofollow">duckburg.de</a> for don Rosa's news.</p>
<?php
include('../footer.php');
?>