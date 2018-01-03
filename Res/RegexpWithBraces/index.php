<?php
$Titre='Regexp with brace matching';
$Box = array("Auteur" => "Neamar","Date" => "2009");

$AddLine='<link rel="stylesheet" type="text/css" href="https://neamar.fr/Res/Typo/Typo.css" />';
include('../header.php');
//include('../Typo/Typo.php');
?>
<h1><?php echo $Titre; ?></h1>
<p class="auteur">Neamar</p>

<p class="important">This page is outdated. See <a href="http://php.net/manual/en/regexp.reference.recursive.php">Recursive patterns</a> for a native implementation.</p>

<p>Sometimes, you need your regexp to do more than PCRE can provide. For example, if you were to try to do brace matching with regexp, you'll soon find it's simply impossible to do such a thing (unless you're using perl6, in which case you should see <a href="http://dev.perl.org/rfc/145.html">this page</a>).</p>

<h2>What's this ?</h2>
<p>First, what's brace matching ?<br />
Let's say you want to find all texts between {} ; for instance for LaTeX-like support.<br />
So you'll write something like <span class="ms">#{(.+)}#U</span>.<br />
If your input is <span class="ss">Some {input provided} by the user</span>, everything will be fine and you'll get the expected "input provided".<br />
But let's say your user write this : <span class="ss">Some {input {provided} and encapsulated} by the user</span>. This time, all you'll get is "input { provided". Which is obviously an error...</p>

<h2>Example</h2>
<p>This page covers a solution for this problem. With the code below, heavy-braced input like this one (who even crash GeShi !):</p>
<?php
InclureCode('input.tex','LaTeX',true,false);
?>
<p>... will be translated to the HTML result you are looking for :</p>
<?php
InclureCode('resultat.html','HTML',true,false);
?>


<h2>Solution</h2>
<p>The trick is to override the default function (PHP <span class="ms">preg_replace</span> in this case, although the solution can be adapted to any language) and to look for any braces. This solution is clearly incomplete and simple, but you may build more complex layer of code on it once you understand the principles behind.</p>
<?php
InclureCode('preg_replace_wb','PHP');
?>
<h3>Limitation</h3>
<p>This piece of code will only work if you're looking for one pair of brace and no more : codes such as this one <span class="ms">#{(.+)}{(.+)#U</span> will result in unpredictable behavior. If you want to match such case, you'll need to code your solution... or to improve this one.</p>
<h3>Examples</h3>
<?php
InclureCode('example','PHP');
?>
<p>This snippet is used on <a href="/Res/Typo">Le Typographe</a>, a french application for text formatting.</p>
<?php
include('../footer.php');
?>
