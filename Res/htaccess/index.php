<?php
$Titre='Tout ce qu\'il faut savoir du .htaccess';
$Box = array("Auteur" => "Neamar","Date" => "Juill. 2008","Date" => "Juill. 2008", "But" =>"Découvrir .htaccess");
include('../header.php');
?>
<h1>Maitrisez à fond le .htaccess</h1>
<h2>A quoi ca sert ?</h2>
<p><img src="Images/htaccess.png" alt="Un fichier .htaccess" />Vous disposez de PHP, d'un serveur Apache, vous aimeriez aller un peu plus loin avec votre site web ?<br />
Découvrez les fichiers .htaccess. Il s'agit de petits fichiers de configuration qui vont vous permettre de personnaliser le comportement de "votre" serveur. Ils se révéleront très utiles si vous n'avez pas accès au fichier de configuration principal.</p>
<p>A quoi servent-ils plus précisément ? À une foultitude de choses ! Vous pouvez personnaliser les pages d'erreurs (fini l'horrible 404 !), changer la page d'accueil, protéger un répertoire, et surtout, pratiquer l'URL rewriting, ce qui vous permettra de masquer vos URL telles que</p>
<fieldset>index.php?pseudo=neamar&amp;age=15&amp;nationalite=france...</fieldset><br />
<p>Sans tarder, commençons !</p>
<h2>La création</h2>
<p>Si vous êtes sous Linux, pas de problèmes ! Il vous suffit de créer un fichier .htaccess dans le répertoire correspondant de votre FTP.<br />
Si vous êtes sous Windows, c'est plus complexe : par défaut, Windows n'accepte pas les fichiers qui commencent par un point. Vous pouvez contourner le problème en entourant le nom par des guillemets au moment de l'enregistrement: "".</p>
<p class="centre nonflottant"><img src="Images/Enregistrement.png" alt="Enregistrer un .htaccess sous Windows" class="centre nonflottant"/></p>
<p class="nonflottant">Deuxième solution : nommer le fichier htaccess, puis l'uploader sur le serveur, et le renommer en .htaccess.</p>
<p class="comment">Les .htaccess sont disposés en bubbling : c'est à dire que si vous mettez un fichier htaccess à l'index de votre site, tous les sous-dossiers seront affectés. Ainsi, de sous-dossiers en sous-dossiers, les fonctions vont s'ajouter.</p>
<h2>Les fonctions</h2>
<h3>Changement d'index</h3>
<p>En temps normal, lorsque l'on demande un dossier, Apache recherche un fichier index.htm, puis index.html, puis index.php....<br />
Vous pouvez changer ce comportement en utilisant la directive DirectoryIndex :</p>
<fieldset><span style="font-weight: bold;color: #0000ff;">DirectoryIndex</span><span style="color: #dd0000;"> Presentation.php</span>
</fieldset>
<h3>Pages d'erreur personnalisées</h3>
<p>Par défaut, Apache sert une page d'erreur sobre lorsqu'il ne trouve pas le document. Vous pouvez changer l'URL de la page d'erreur : c'est le but de la fonction ErrorDocument :</p>
<fieldset><span style="font-weight: bold;color: #0000ff;">ErrorDocument</span><span style="color: #dd0000;"> 404 Erreur-404.htm</span></fieldset>
<p>Le premier paramètre est le numéro de l'erreur à récupérer<sup>1</sup>, le second paramètre est la page vers laquelle il faut renvoyer.</p>
<p class="comment">Attention ! Vous devez marquer l'URL de la page en notation relative. Si vous la marquez en notation absolue (e.g. http://neamar.fr/Erreur-404.htm), la redirection s'effectuera bien, mais les headers envoyés seront avec un code d'erreur 200. Long story short, cela signifie que les moteurs de recherche, tels Google, ne seront pas capable de dire si une page est valide ou pas.<br />
Vous pourriez aussi expérimenter certains problèmes avec des outils pour webmasters, qui cherchent à savoir si vous êtes le vrai webmaster d'un domaine en vous demandant d'uploader une page spéciale. Le logiciel n'aurait alors aucun moyen de dire si la page existe bien ou pas !</p>
<h3>Du PHP dans le CSS !</h3>
<p>Vous avez adoré dynamiser vos page HTML avec PHP ?<br />
A priori, vous ne pourrez pas faire de même dans un fichier CSS, JavaScript, ou autre. Mais cela pourrait tout de même être utile : par exemple, si on voulait que le visiteur puisse choisir sa couleur d'affichage dans une palette graphique complète.<br />
Pas de problème ! Une nouvelle fois, le .htaccess va vous sauver la mise via l'instruction AddType :</p>
<?php InclureCode('AddType','apache'); ?>
<h3>Passer au PHP 5</h3>
<p>Plusieurs hébergeurs proposent par défaut la version 4 de PHP. Mais mieux vaut passer à la version 5 : elle est plus stable, plus performante, plus sécurisée, et admet quelques nouvelles fonctions.<br />
Selon votre hébergeur, vous pouvez passer à la version 5 de PHP ! Il vous suffit d'incorporer les lignes suivantes :</p>
<?php InclureCode('PHP5','apache'); ?>
<p class="comment">Ces lignes dépendent des hébergeurs. Renseignez-vous plour plus d'informations !</p>

<h3>L'URL rewriting</h3>
<p>L'URL rewriting est sûrement la fonction la plus utile des fichiers .htaccess. C'est malheureusement aussi une des plus complexes à maitriser !<br />
Voyons d'abord quelle en est l'utilité : vous allez pouvoir simplifier vos URL et les clarifier pour vos visiteurs et les moteurs de recherche.<br />
Ainsi, l'URL suivante :</p>
<fieldset>index.php?pseudo=neamar&amp;age=15&amp;nationalite=france</fieldset>
<p>va devenir</p>
<fieldset>Fiche-neamar-15ans-france</fieldset>
<h4>Les Expressions Régulières</h4>
<p>Pour maitriser l'URL rewriting, des connaissances de base avec les RegExp sont nécessaires. Je ne peux malheureusement pas en faire un cours ici, ce serait bien trop long...Je vous mets donc juste un lien vers un tutorial très complet<sup>2</sup>.
Voilà juste la base, qui vous permettra de comprendre les exemples fournis :</p>
<ul>
<li>[a-z] indique n'importe quel caractère de a à z.</li>
<li>[a-zA-E] indique n'importe quel caractère minuscule entre a et z, ou une majuscule entre A et E.</li>
<li>. indique n'importe quel caractère : [a-zA-Z1-9&amp;é"'(-....].</li>
<li>+ indique la répétition d'un caractère plus d'une fois</li>
</ul>

<p>Par exemple : la RegExp [a-z]+ renverra :</p>
<ul>
<li>Bon pour "bonjour", "neamar", "azertyuiop".</li>
<li>Faux pour "123","Bonjour" (majuscule),"#Az".</li>
</ul>
<p>Voilà qui devrait suffire pour élaborer vos première regexp !</p>
<h4>Élaborer votre réécriture</h4>
<p>Examinons notre exemple :</p>
<fieldset>index.php?pseudo=neamar&amp;age=15&amp;nationalite=france</fieldset>
<p>va devenir</p>
<fieldset>Fiche-neamar-15ans-france</fieldset>
<p>Cherchons une RegExp qui corresponde à l'URL réécrite quels que soient les paramètres fournis :</p>
<fieldset>Fiche-.+-[1-9]+-[a-zA-Z]+</fieldset>
<p>Vérifions la validité de notre choix : un âge est forcément constitué d'un ou plusieurs chiffres : donc [1-9]+<br />
Une nationalité est constituée de lettre minuscules et majuscules (pour l'instant, on négligera les pays composés !)<br />
Un pseudo peut être constitué d'à peu près n'importe quoi : on utilise donc le point.</p>
<p>Il va maintenant falloir placer les parenthèses capturantes : elles détermineront quelles parties doivent être renvoyées dans l'URL de destination. Nous, nous cherchons à récupérer trois paramètres :</p>
<fieldset>Fiche-(.+)-([1-9]+)-([a-zA-Z]+)</fieldset>
<p>Maintenant la ligne miracle :</p>
<fieldset><span style="font-weight: bold;color: #0000ff;">RewriteRule</span><span style="color: #dd0000;"> ^>Fiche-(.+)-([1-9]+)-([a-zA-Z]+)$ /index.php?pseudo=$1&amp;age=$2&amp;nationalite=$3 [L]</span></fieldset>
<p>Quelques explications s'imposent...<br />
Notre RegExp est maintenant entourée de ^et $. Si vous ne comprenez pas pourquoi, relisez le tutorial...cela signifie que l'URL <strong>doit</strong> commencer par Fiche et finir par la nationalité.<br />
Le contenu des parenthèses est réinjecté dans la deuxième partie de la ligne : ce sont les $1, $2 et $3 qui contiennent respectivement le contenu des parenthèses 1, 2 et 3.<br />
Le [L] indique que le moteur d'URL rewriting doit arrêter sa recherche ici si l'URL correspond à l'expression régulière. Cela vous sera utile quand vous aurez plusieurs lignes d'URL Rewriting.</p>
<p>Si vous avez marqué ce code dans votre .htaccess, vous risquez d'avoir une mauvaise surprise...c'est par ce que cette simple ligne ne suffit pas. Je ne vous fais pas languir plus longtemps, voilà le total :</p>
<?php InclureCode("Rewriting",'apache'); ?>
<p>Je pense que je n'ai pas besoin d'en dire beucoup plus, les commentaires sont éloquents !<br />
Profitez bien de ce module, il s'avère extrêmement utile !</p>

<h2>Quelques problèmes courants</h2>
<p>Si après avoir uploadé votre fichier .htaccess, vous obtenez une erreur 500 (Internal Server Error), pas de chance ! Votre serveur n'est pas compatible avec les .htaccess. Si vous êtes sur un hébergement mutualisé, il est fort probable que votre hébergeur ait interdit l'utilisation de ces fichiers. Vous allez devoir supprimer le fichier .htaccess, dommage...vous devrez faire sans !</p>
<p>Si vous obtenez une erreur 500 en utilisant l'URL rewriting, deux possibilités :</p>
<ul>
<li>Soit votre hébergeur a désactivé l'URL rewriting. Il faut dire qu'il s'agit d'une action particulièrement lourde, complexifiée encore par la gestion du bubbling. C'est le cas par exemple de chez Free pour l'hébergement gratuit.</li>
<li>Soit vous vous êtes plantés dans votre expression régulière, soit vous avez fait une opération illégale. Cela arrive relativement souvent, il vous suffit de supprimer la ligne que vous venez de modifier...et de retenter (différemment, évidemment) !</li>
</ul>
<hr class="separateur"/>
<p>Références :</p>
<ol id="Relations">
<li>La liste officielle des erreurs est disponible ici : http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html</li>
<li>Les expressions régulières sur le Site Du Zero : http://www.siteduzero.com/tuto-3-168-1-les-expressions-regulieres-partie-1-2.html</li>
</ol>
<?php
include("../footer.php");
?>