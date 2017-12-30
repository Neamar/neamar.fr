<?php
$Titre='Quelques réflexions sur Microsoft';
$Box = array("Auteur" => "Neamar","Date" => "Juill. 2008", "Formats" => "<a href=\"Microsoft.pdf\">PDF</a><br /><a href=\"Microsoft.docx\">DOCX</a>", "But" =>"Prise de position");
include('../header.php');
?>
<h1>À propos de Microsoft</h1>
<p class="centre"><img src="Images/microsoft_logo.jpg" alt="Logo de Microsoft" class="nonflottant "/></p>
<h2>Introduction</h2>

<p>Microsoft est l’entreprise informatique la plus connue au monde. Ses systèmes d’exploitation séduisent plus de 90% des utilisateurs d’ordinateurs…<br />
Mais Microsoft ne se réduit pas à quelques OS ! Il fournit aussi de nombreux logiciels dont la suite Office est certainement la meilleure représentante.</p>

<p>Depuis quelques années, il semble de bon ton dans les sphères virtuelles de critiquer Microsoft…et Google indexe des milliers de discussions trollesques<sup>1</sup>  Windows vs. Linux.</p>

<p>En quelques paragraphes, je vais tenter d’exprimer une opinion sur trois des principaux programmes de Microsoft :</p>
<ul>
<li>Le navigateur de la firme, Internet Explorer</li>
<li>Le dernier système d’exploitation sorti, Windows Vista</li>
<li>La dernière version de la suite Office : Office 2007</li>
</ul>

<h2>Le navigateur : Internet Explorer</h2>

<p><img src="Images/IE.png" alt="Internet Explorer" />Commençons par les choses qui fâchent…Internet Explorer (IE) est de très loin le pire logiciel de la firme de Redmond (surnom donné à Microsoft, qui est la firme la plus importante de la ville de Redmond, à Washington).</p>

<p>Disponible pendant des années en standard avec Windows, IE s’est imposé comme le navigateur le plus utilisé sur Internet. « Un seul » couac : c’est aussi le moins respectueux des standards, le moins stable, le moins personnalisable, le moins débuggable…j’en passe et des meilleures !</p>

<h3>Les standards</h3>
<p>Le W3C<sup>2</sup> a défini une norme en ce qui concerne les sites WEB : le xHTML. Internet Explorer s’avère incapable de la respecter…La preuve en trois points.</p>
<h4>Le CSS<sup>3</sup></h4>
<p><img src="Images/CSS.png" alt="CSS" />C’est la technologie utilisée par les sites modernes pour gérer l’affichage d’un site.<br />
Elle est simple à comprendre, mais peut gérer des cas complexes de mise en page.<br />
C’est aussi là que se voient le plus rapidement les problèmes…en effet, la norme CSS est extrêmement stricte, et à l’heure actuelle, aucun des quatre principaux navigateurs<sup>4</sup> ne la supporte entièrement. Mais Internet Explorer est le plus attardé de tous…</p>

<p class="comment">ATTENTION ! La partie qui suit est assez technique et s’adresse uniquement aux habitués du CSS.</p>
<ul>
<li>La façon dont est interprété l’emboitement n’est pas standard : ainsi, lorsque l’on spécifie un width (resp. height), cela interfère avec padding et margin…heureusement, depuis IE7, il est possible de corriger ce problème en spécifiant un Doctype au début du document. Mais cela ne facilite pas la compréhension au novice, qui aimerait bien savoir pourquoi sa page n’est pas la même sous IE et sous Firefox (ou Opera, Safari…)</li>
<li>Les pseudo-classes :
<ul>
<li>Sous IE6, « :hover » n’était accepté et compris que pour les balises &lt;a&gt;. Ce qui obligeait à passer par JavaScript lorsque l’on souhaitait réaliser un menu déroulant…pas très pratique, et lourd…enfin bon, ne nous attardons pas sur les rares problèmes résolus ;-) !</li>
<li>« :first-letter » : de même que pour « :hover », il aura fallu attendre IE7 pour voir cette propriété supportée. Pas qu’elle soit extrêmement utile…mais bon, c’est toujours ça de pris !</li>
<li>« :before » et « :after » : cette fois, le constat est plus simple : ce n’est tout simplement pas supporté ! Dommage, on peut facilement leur trouver des utilités…par exemple, ajouter automatiquement des « » autour des balises &lt;cite&gt; et &lt;blockquote&gt;</li>
<li>« caption-side » : peu connue, cette propriété permet de sélectionner l’emplacement où doit s’afficher le &lt;caption&gt; d’une &lt;table&gt;. Supporté, cela ouvrirait de nombreuses nouvelles possibilités pour la conception de menus (qui a parlé de web sémantique ?)</li>
</ul></li>
<li>Les couleurs : IE s’est dit que gérer des millions de couleurs est trop compliqué ! Le navigateur en est resté aux temps archaïques où un débit de 10bits/min était spectaculaire…alors il ne supporte que les couleurs HTML. Mais on aimerait plus de diversité…ne serait-ce que pour pouvoir adapter une couleur de fond à une image qui ne se répète pas !</li>
</ul>

<h4>Le JavaScript</h4>
<p><img src="Images/JS.png" alt="JavaScript" />Pourquoi respecter une norme quand on peut se créer la sienne !  Développer une application JavaScript multi-navigateurs s’avère un vrai chemin de croix…il faut la tester une fois sous un navigateur compétent pour la validité de l’algorithme, et une fois sous IE pour la compatibilité…c’est loin d’être agréable, mais c’est malheureusement incontournable : on peut difficilement choisir de rendre son site inutilisable par 50% des internautes…</p>

<h3>L’interface</h3>
<p><img src="Images/Tab.png" alt="Les onglets" />Même si on peut difficilement critiquer l’interface d’IE7 (on n’aime ou on n’aime pas), celle d’IE6 est vraiment archaïque (et en plus, il n’y a même pas d’onglets…ils arriveront avec IE7).<br />
Non, le vrai problème, c’est l’absence d’options transversales qui facilitent la vie : des liens tels que « afficher l’image », « copier l’adresse du lien », « code source de la sélection », « changer de style » (les alernate stylesheets ne sont pas acceptées) seraient les bienvenus…tout comme un debugger digne de ce nom, à l’image de Firebug sous Firefox.</p>



<p>Cela dit, de nombreux progrès ont été réalisés par l’équipe qui développe Internet Explorer entre la version 6 et la version 7. On ne peut qu’espérer que la version 8 fera mieux !</p>


<h2>Le système d’exploitation : Windows Vista</h2>

<p><img src="Images/Vista.png" alt="Windows Vista" />Fortement décrié à sa sortie, Vista est pourtant la succession logique de Windows XP.  Lors de sa sortie, deux inconvénients ont reçus la majorité des critiques.</p>
<h3>« Windows Vista est lourd »</h3>
<p><img src="Images/Vista2.png" alt="Windows Vista" />Non, non et non ! De nombreuses études ont prouvé que cela n’était qu’une impression basée sur des faits inexacts.<br />
Certes, Vista consomme beaucoup plus de mémoire vive au repos que son prédécesseur Windows XP. Mais si vous équipez XP d’un firewall, d’outils de gestion réseau, d’outils de sécurité de bases, d’un client mail, de Media Center, d’outils pour la synchronisation des périphériques mobiles et d’un outil d’indexation…bref, ce que vous devrez forcément faire avec votre nouvel XP, et vous obtenez des performances équivalentes à celle d’un Vista neuf. Sauf qu’avec Vista, c’est inclus par défaut ! Et si vous n’en voulez pas, vous n’avez qu’à les désinstaller…<br />
Vous allez me dire, mais pourquoi les inclure ? Que chacun fasse ce qu’il veut ! Mais non, misonéistes ! Le monde doit évoluer. Vous imaginez si on vous livrait Windows sans aucun pilote pour vos périphériques ? Vous crieriez au scandale…et bien, vous venez de toucher du doigt la raison pour laquelle Vista est livré ainsi…</p>

<h3>« Vista est trop différent de XP »</h3>
<p><img src="Images/Vista3.png" alt="Windows Vista" />C’est vrai : l’ensemble Vista est beaucoup plus orienté Internet, recherche, communautarisme.<br />
Dans Vista, si vous voulez quelque chose, vous aurez toujours à votre disposition une boite de recherche : que ce soit dans le panneau de configuration, dans n’importe quel dossier, ou même dans le menu Démarrer<sup>5</sup>. Cela facilite beaucoup la gestion de ses fichiers, puisque la recherche ne s’effectue pas uniquement sur le nom du fichier, mais aussi sur son contenu. Pratique quand on dispose d’une véritable bibliothèque virtuelle…<br />
On m’a aussi fait remarquer que l’arborescence des documents personnels a été modifiée. D’accord. Et alors ? Je vous rappelle que vous descendez de singes qui ont su faire preuve de capacités d’adaptation importantes…vous n’allez quand même pas les déshonorer en affirmant que vous êtes incapables de vous adapter…De même « Poste de Travail » a été renommé en « Ordinateur ».Et si c’est le plus gros problème de votre vie, estimez-vous heureux !<br />
Dernière remarque : un clic sur le bouton éteindre n’éteint pas complètement l’ordinateur, mais le met en veille. Ce comportement est personnalisable, adaptez-le à vos besoins ! Mais n’allez pas hurler que « c’est différent » !</p>

<h3>Les avantages</h3>
<h4>Le dernier d’une longue lignée</h4>
<p><img src="Images/Vista4.png" alt="Windows Vista" />Windows Vista est le 6ème<sup>6</sup> d’une longue série de systèmes d’exploitation « Made In Microsoft » . Il hérite donc du socle solide de ses prédécesseurs : des milliers d’APIs<sup>7</sup>  sont disponibles pour le programmeur, quelques centaines ont été ajoutées (dont une bonne partie concernant la gestion de l’interface graphique Aero), la MSDN (l’aide de Microsoft pour les développeurs) est toujours aussi bien documentée…bref, développer pour Windows reste un vrai plaisir !</p>
<h4>Une stabilité respectable</h4>
<p><img src="Images/Vista5.png" alt="Windows Vista" />Avez-vous déjà réussi à ouvrir plusieurs applications simultanément avec Windows 95 sans faire cracher le système ? Peu probable…alors que sous Vista, la stabilité est au moins égale à celle de XP. Certes, il y a eu quelques ratés au lancement, mais après quelques mois de rodage, la stabilité de Vista est parfaitement respectable ! Je peux témoigner que ma version d’Ubuntu crashe plus souvent que Vista<sup>8</sup>.</p>
<h4>Un centre réseau fiable et robuste</h4>
<p><img src="Images/Vista6.png" alt="Windows Vista" />Depuis le temps que l’on rêvait de messages d’erreurs moins sibyllins…<br />
Sous XP, en cas d’erreur, on avait droit à un quelque peu ridiculisant « Vérifiez que votre modem est allumé ». Vista propose un assistant à la réparation de réseaux, et pour l’avoir expérimenté, j’ai été agréablement surpris…il y a même une option de réparation automatique qui fait tout, sans action extérieure. What Else ?<sup>9</sup></p>
<p>La création d’un nouveau réseau, d’un nouveau pont, n’a jamais été aussi facile : elle est en tout cas égale à celles des distributions Linux courantes, alors que XP restait un cran en dessous.</p>
<h4>Des graphismes innovants</h4>
<p><img src="Images/Vista7.png" alt="Windows Vista" />Cet argument manque d’objectivité, mais je trouve personnellement que l’interface graphique est particulièrement réussie. La transparence (un flou gaussien, à mon avis) est bien réussie, et les choix graphiques sont sympathiques (bleu très clair et noir).</p>
<p>Un seul regret : l’icône du Media Player est vraiment moche !<sup>10</sup></p>
<h3>En conclusion</h3>
<p><img src="Images/Vista8.png" alt="Windows Vista" />Au final, Vista s’avère parfaitement capable de soutenir la comparaison avec son petit frère. Plus qu’un lifting d’XP, il s’agit d’une nouvelle base pour une nouveau départ. Les débuts de Vista n’ont pas été brillants, il faut le concéder, mais Vista s’est bonifié avec l’âge. Et toutes les innovations proposées formeront un socle de travail intéressant pour l’hypothétique Windows 7, prévu en 2009<sup>11</sup>.<br />
N’ayez donc pas peur du saut : il serait ridicule d’acquérir un PC équipé de XP. Ce système aurait du disparaitre depuis plusieurs mois, mais Microsoft a été « contraint » de repousser son départ suite à la pression d’un groupe de logomachiens (néologisme indiquant des adeptes de la logomachie) incoercibles qui s’émeuvent du changement…</p>

<h2>Office 2007</h2>

<p><img src="Images/Office.png" alt="Microsoft Office 2007" class="petit"/>L’équipe responsable de la version 2007 s’est déchainée !</p>


<h3>Une nouvelle interface</h3>
<p><img src="Images/Office2.png" alt="Microsoft Office 2007" class="petit" />L’interface à rubans a été la cible d’un intense battage médiatique sur la blogosphère.<br />
Elle remplace avantageusement les traditionnels menus « Fichier », « Edition »…<br />
Cela permet un accès beaucoup plus intuitif aux différentes fonctions : les styles, déjà présents depuis de nombreuses versions, sont enfin incorporées de façon intuitive. Il est donc possible très facilement de changer le style complet d’un document, d’insérer une table des matières, des références et un index des références, etc.<br />
La division en onglets facilite la recherche de fonctions : par exemple, l’onglet « Révision » permet la gestion collaborative d’un document, l’ajout de commentaire, la comparaison entres différentes versions d’un même document…</p>

<h3>De nouvelles fonctions</h3>
<p><img src="Images/Office3.png" alt="Microsoft Office 2007" />Même s’il m’est impossible d’assurer que ces fonctions sont nouvelles<sup>12</sup>, elles sont maintenant mises en avant et utilisables par le grand nombre. On compte entres autres la possibilité d’appliquer des effets à une image, de faciliter la lecture d’un tableau…<br />
Mais au-delà de ces ajouts intéressants mais pas forcément utiles dans la vie de tous les jours, se trouvent des vraies nouveautés.<br />
Par exemple, le seul retard de la suite Office par rapport à son concurrent libre était la gestion des PDF. C’est maintenant de l’histoire ancienne, puisqu’il est possible d’exporter les documents dans de nombreux formats, tout en conservant les mises en formes avancées telles que les sommaires, les effets sur les images…<br />
Un unique regret : l’export au format HTML crée un fichier qui s’affiche sous les navigateurs, mais qui est proprement inexploitable pour un développeur du monde du libre…<br />
Encore que…en réfléchissant bien, un deuxième regret vient à l’esprit : le prix ! Heureusement que de nombreuses offres évitent de payer le plein tarif…</p>


<h2>Conclusion</h2>
<p>Non, non, non ! Bill Gates n’est pas l’Antéchrist…<sup>13</sup><br />
La majorité des personnes qui critiquent Microsoft le font « pour suivre le mouvement », sans vraiment avoir d’arguments.<br />
Certes, pour certains types de personnes, Windows n’est pas la solution la plus adaptée (développeurs et designers entres autres), mais pour l’immense majorité des gens, Microsoft s’impose comme un géant. Et le plus gros inconvénient des logiciels Microsoft, c’est leurs prix…quel dommage que l’un des seuls logiciels gratuits de Microsoft (Internet Explorer) soit aussi leur plus grand fiasco !</p>

<hr class="separateur"/>
<p>Références :</p>
<ol id="Relations">
<li>Un Troll est une discussion où aucune conclusion n’est possible : chaque parti est convaincu de ces arguments et refuse d’écouter ceux des autres. Les trolls sont généralement interdits sur la plupart des forums.
Des exemples de troll : IE/Firefox, Windows/Linux, les constructeurs de PC…</li>
<li>World Wide Web Consortium, l’organisme chargé de gérer les standards sur l’Internet.</li>
<li>CSS : Cascading Style Sheets, feuilles de style en cascade.</li>
<li>Firefox, Opera, Safari et Internet Explorer</li>
<li>Menu « Démarrer » qui d’ailleurs ne s’appelle plus « Démarrer », ce qui n’est pas plus mal puisque cela retire le paradoxe de devoir cliquer sur « Démarrer » avant d’éteindre l’ordinateur…</li>
<li>Eh oui, déjà 6 ! Dans l’ordre : Windows 3.1, 95, 98, Me, Xp</li>
<li>Application Programming Interface : des petites fonctions qui permettent d’effectuer facilement des actions communes à tous les programmes : choix d’une couleur, d’une police, affichage à l’écran, gestion des composants, du temps…</li>
<li>Bon, c’est vrai que Compiz truque un peu  les résultats !</li>
<li>Tout lien avec une publicité connue est fortuit et dépendant de la volonté de l’auteur.</li>
<li>Comment ça ? Superficiel, moi ? Noon !</li>
<li>Devrait donc être disponible aux alentours de 2011 ?</li>
<li>Un chercheur a montré qu’un utilisateur lambda de Word et Excel n’utilisait pas 10% des possibilités de ces logiciels ! (note wikipedienne private-joke : [citation needed])</li>
<li>De toute façon, il n’est même plus PDG de Microsoft…</li>
</ol>
<?php
include "../footer.php";
?>



