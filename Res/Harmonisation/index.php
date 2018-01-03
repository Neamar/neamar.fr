<?php
$Titre='Le problème de l\'harmonisation des notes';
$Box = array("Auteur" => "Neamar","Date" => "2010");

$AddLine=<<<EOF
  <link rel="stylesheet" type="text/css" href="//neamar.fr/lib/Typo/Typo.css" />
  <script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      tex2jax: {inlineMath: [['$','$']]}
    });
    </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=TeX-MML-AM_CHTML"></script>
EOF;
$UseMath=true;
include('../header.php');
include('../Typo/Typo.php');
?>
<h1><?php echo $Titre; ?></h1>
<p class="auteur">Neamar</p>

<?php
Typo::setTexteFromFile('Texte.txt');
echo str_replace('</math>', '$', str_replace('<math>', '$', Typo::Parse()));
?>

<?php
include('../footer.php');
?>
