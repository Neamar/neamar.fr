<?php
$Titre='Le calcul de pi &pi; à travers l\'Histoire';
$Box = array("Auteur" => "18th Candidate","Date" => "2010","Traducteur"=>'Neamar');
$AddLine=<<<EOF
  <script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      tex2jax: {inlineMath: [['\\\\(','\\\\)']]}
    });
    </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=TeX-MML-AM_CHTML"></script>
  <link rel="stylesheet" type="text/css" href="//neamar.fr/Res/Typo/Typo.css" />
EOF;
include('../header.php');
include('../Typo/Typo.php');
?>
<div style="background:white url('Images/Ouroboros_light.jpg') no-repeat fixed bottom;">
<h1>À la recherche de &pi;</h1>
<p class="auteur">Neamar, traduit de <a href="http://www-groups.dcs.st-and.ac.uk/~history/HistTopics/Pi_through_the_ages.html">J J O'Connor et E F Robertson</a></p>

<?php
Typo::addOption(PARSE_MATH);
Typo::setTexteFromFile('Pi.tex');
// Typo::addOption(P_UNGREEDY);
echo str_replace('<math>', '\\(', str_replace('</math>', '\\)', Typo::Parse()));
?>
</div>
<p class="petitTexte centre">Mis en forme avec <a href="../Typo">le Typographe</a></p>
<?php
include('../footer.php');
?>
