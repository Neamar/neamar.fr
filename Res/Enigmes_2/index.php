<?php
session_start();
$UseMath=true;
$Titre='Les 10 plus belles �nigmes &ndash; Tome 2';
$Box = array("Auteur" => "Neamar","Date" => "Nov. 2008", "But" =>"Divertissement",'Analyse'=>'<a href="http://blog.neamar.fr/component/content/article/5-looking-back/22-retour-sur-les-10-plus-belles-enigmes-deuxieme-saison">Notes de l\'auteur</a>');

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

<h1>Lutin, une sin�cure ?</h1>
<p class="auteur">Neamar</p>
<?php

Typo::setTexteFromFile('Enigmes_2.tex');
Typo::addOption(PARSE_MATH);
Typo::addOption(ALLOW_FOOTNOTE,FOOTNOTE_SCIENCE);//Pour que les notes de bas de page soient entour�es de parenth�ses, ce qui �vite de les confondre avec des puissances math�matiques.
echo str_replace('</math>', '$', str_replace('<math>', '$', Typo::Parse()));
?>
<p class="petitTexte centre">Mis en forme avec <a href="../Typo">le Typographe</a></p>
<?php
include('../footer.php');
?>
