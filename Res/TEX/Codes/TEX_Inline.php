<?php
$Inline=array(
"#\\$(.+)\\$#iU"=>'<math>$1</math>',
"#\\\\textbf{(.+)}#iU"=>'<strong>$1</strong>',
"#\\\\textit{(.+)}#iU"=>'<em>$1</em>',
"#\\\\underline{(.+)}#iU"=>'<span class="underline">$1</span>',
);