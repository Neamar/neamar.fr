<?php
session_start();
$UseMath=true;
$Titre='Les 10 plus belles énigmes';
$Box = array("Auteur" => "Neamar","Date" => "Nov. 2008", "But" =>"Divertissement");

$AddLine=<<<EOF
  <link rel="stylesheet" type="text/css" href="https://neamar.fr/lib/Typo/Typo.css" />
  <script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      tex2jax: {inlineMath: [['$','$']]}
    });
    </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=TeX-MML-AM_CHTML"></script>
EOF;

include('../header.php');
include('../../lib/Typo.php');
?>

<h1>Les 10 plus belles énigmes</h1>
<p class="auteur">Neamar</p>

<?php

Typo::setTexteFromFile('Texte.txt');
echo str_replace('</math>', '$', str_replace('<math>', '$', Typo::Parse()));
?>

<p class="petitTexte centre">Mis en forme avec <a href="../Typo">le Typographe</a></p>
<?php
include('../footer.php');
?>
