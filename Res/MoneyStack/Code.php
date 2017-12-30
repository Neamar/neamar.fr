<?php
$Titre='Code de MoneyStack';
$codeAreUTF8=true;
$Box = array("Auteur" => "Neamar","Date" => "Aout 2008","Voir aussi"=>'<a href="../Compiler_AS3">Compiler l\'AS3</a>',"Retour"=>'<a href="../MoneyStack">Retour au jeu</a>');
include('../header.php');
?>
<h1>Rapidité et stratégie : MoneyStack</h1>
<p>Ce jeu flash a été développé à l'aide de FlashDevelop, un puissant IDE gratuit pour Flash, mais malheureusement non disponible sous Linux.<br />
Le jeu a donc été écrit sous un Windows XP virtualisé par VirtualBox OSE (Wine ne fonctionnant pas pour FlashDevelop, ou plutôt :  Wine ne supportant pas le framework .NET2.0 nécessaire à l'utilisation de FlashDevelop).<br />
<img src="../CoinStack/Images/Dev.jpg" alt="Le développement" class="nonflottant" style="width:100%"/></p>
<h3>Licence</h3>
<p class="erreur">Ce code est fourni sous une licence CC-By (cf. fin de page).<br />
De plus, il est interdit de recompiler le jeu "tel quel" en supprimant le lien « Plus de jeux », la mention « tel quel » restant à l'appréciation de l'auteur original du code source (copie, plagiat...).</p>
<h3>À propos du code</h3>
<p>Vous pouvez générer la documentation du code via l'outil asdoc distribué par défaut avec le Flex SDK.</p>
<h3>Classes de BankNoteStack</h3>
<h4>Fichiers de bases :</h4>
<?php
InclureCode('Main.as','actionscript3');
InclureCode('Level.as','actionscript3');
InclureCode('BankNote.as','actionscript3');
InclureCode('Coin.as','actionscript3');
?>
<h4>Mathématiques</h4>
<p>Ce jeu utilise le théorème de séparation des axes. Afin de simplifier la programmation, on trouvera donc une classe Vecteur.</p>
<?php
InclureCode('Vecteur.as','actionscript3');
InclureCode('SatCircle.as','actionscript3');
InclureCode('SatRectangle.as','actionscript3');
InclureCode('SatShape.as','actionscript3');
?>

<h4>Constantes Globales</h4>
<?php
InclureCode('Global.as','actionscript3');
?>
<h3>Spécial</h3>
<p>MochiAds demande un sprite dynamique pour afficher ses scores, d'où cette classe inutile.</p>
<?php
InclureCode('SecondSprite.as','actionscript3');
?>

<?php
include('../footer.php');
?>