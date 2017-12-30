<?php
$Titre='Quelques r�flexions sur Microsoft';
$Box = array("Auteur" => "Neamar","Date" => "Juill. 2008", "Formats" => "<a href=\"Microsoft.pdf\">PDF</a><br /><a href=\"Microsoft.docx\">DOCX</a>", "But" =>"Prise de position");
include('../header.php');
?>
<h1>� propos de Microsoft</h1>
<p class="centre"><img src="Images/microsoft_logo.jpg" alt="Logo de Microsoft" class="nonflottant "/></p>
<h2>Introduction</h2>

<p>Microsoft est l�entreprise informatique la plus connue au monde. Ses syst�mes d�exploitation s�duisent plus de 90% des utilisateurs d�ordinateurs�<br />
Mais Microsoft ne se r�duit pas � quelques OS ! Il fournit aussi de nombreux logiciels dont la suite Office est certainement la meilleure repr�sentante.</p>

<p>Depuis quelques ann�es, il semble de bon ton dans les sph�res virtuelles de critiquer Microsoft�et Google indexe des milliers de discussions trollesques<sup>1</sup>  Windows vs. Linux.</p>

<p>En quelques paragraphes, je vais tenter d�exprimer une opinion sur trois des principaux programmes de Microsoft :</p>
<ul>
<li>Le navigateur de la firme, Internet Explorer</li>
<li>Le dernier syst�me d�exploitation sorti, Windows Vista</li>
<li>La derni�re version de la suite Office : Office 2007</li>
</ul>

<h2>Le navigateur : Internet Explorer</h2>

<p><img src="Images/IE.png" alt="Internet Explorer" />Commen�ons par les choses qui f�chent�Internet Explorer (IE) est de tr�s loin le pire logiciel de la firme de Redmond (surnom donn� � Microsoft, qui est la firme la plus importante de la ville de Redmond, � Washington).</p>

<p>Disponible pendant des ann�es en standard avec Windows, IE s�est impos� comme le navigateur le plus utilis� sur Internet. � Un seul � couac : c�est aussi le moins respectueux des standards, le moins stable, le moins personnalisable, le moins d�buggable�j�en passe et des meilleures !</p>

<h3>Les standards</h3>
<p>Le W3C<sup>2</sup> a d�fini une norme en ce qui concerne les sites WEB : le xHTML. Internet Explorer s�av�re incapable de la respecter�La preuve en trois points.</p>
<h4>Le CSS<sup>3</sup></h4>
<p><img src="Images/CSS.png" alt="CSS" />C�est la technologie utilis�e par les sites modernes pour g�rer l�affichage d�un site.<br />
Elle est simple � comprendre, mais peut g�rer des cas complexes de mise en page.<br />
C�est aussi l� que se voient le plus rapidement les probl�mes�en effet, la norme CSS est extr�mement stricte, et � l�heure actuelle, aucun des quatre principaux navigateurs<sup>4</sup> ne la supporte enti�rement. Mais Internet Explorer est le plus attard� de tous�</p>

<p class="comment">ATTENTION ! La partie qui suit est assez technique et s�adresse uniquement aux habitu�s du CSS.</p>
<ul>
<li>La fa�on dont est interpr�t� l�emboitement n�est pas standard : ainsi, lorsque l�on sp�cifie un width (resp. height), cela interf�re avec padding et margin�heureusement, depuis IE7, il est possible de corriger ce probl�me en sp�cifiant un Doctype au d�but du document. Mais cela ne facilite pas la compr�hension au novice, qui aimerait bien savoir pourquoi sa page n�est pas la m�me sous IE et sous Firefox (ou Opera, Safari�)</li>
<li>Les pseudo-classes :
<ul>
<li>Sous IE6, � :hover � n��tait accept� et compris que pour les balises &lt;a&gt;. Ce qui obligeait � passer par JavaScript lorsque l�on souhaitait r�aliser un menu d�roulant�pas tr�s pratique, et lourd�enfin bon, ne nous attardons pas sur les rares probl�mes r�solus ;-) !</li>
<li>� :first-letter � : de m�me que pour � :hover �, il aura fallu attendre IE7 pour voir cette propri�t� support�e. Pas qu�elle soit extr�mement utile�mais bon, c�est toujours �a de pris !</li>
<li>� :before � et � :after � : cette fois, le constat est plus simple : ce n�est tout simplement pas support� ! Dommage, on peut facilement leur trouver des utilit�s�par exemple, ajouter automatiquement des � � autour des balises &lt;cite&gt; et &lt;blockquote&gt;</li>
<li>� caption-side � : peu connue, cette propri�t� permet de s�lectionner l�emplacement o� doit s�afficher le &lt;caption&gt; d�une &lt;table&gt;. Support�, cela ouvrirait de nombreuses nouvelles possibilit�s pour la conception de menus (qui a parl� de web s�mantique ?)</li>
</ul></li>
<li>Les couleurs : IE s�est dit que g�rer des millions de couleurs est trop compliqu� ! Le navigateur en est rest� aux temps archa�ques o� un d�bit de 10bits/min �tait spectaculaire�alors il ne supporte que les couleurs HTML. Mais on aimerait plus de diversit�ne serait-ce que pour pouvoir adapter une couleur de fond � une image qui ne se r�p�te pas !</li>
</ul>

<h4>Le JavaScript</h4>
<p><img src="Images/JS.png" alt="JavaScript" />Pourquoi respecter une norme quand on peut se cr�er la sienne !  D�velopper une application JavaScript multi-navigateurs s�av�re un vrai chemin de croix�il faut la tester une fois sous un navigateur comp�tent pour la validit� de l�algorithme, et une fois sous IE pour la compatibilit�c�est loin d��tre agr�able, mais c�est malheureusement incontournable : on peut difficilement choisir de rendre son site inutilisable par 50% des internautes�</p>

<h3>L�interface</h3>
<p><img src="Images/Tab.png" alt="Les onglets" />M�me si on peut difficilement critiquer l�interface d�IE7 (on n�aime ou on n�aime pas), celle d�IE6 est vraiment archa�que (et en plus, il n�y a m�me pas d�onglets�ils arriveront avec IE7).<br />
Non, le vrai probl�me, c�est l�absence d�options transversales qui facilitent la vie : des liens tels que � afficher l�image �, � copier l�adresse du lien �, � code source de la s�lection �, � changer de style � (les alernate stylesheets ne sont pas accept�es) seraient les bienvenus�tout comme un debugger digne de ce nom, � l�image de Firebug sous Firefox.</p>



<p>Cela dit, de nombreux progr�s ont �t� r�alis�s par l��quipe qui d�veloppe Internet Explorer entre la version 6 et la version 7. On ne peut qu�esp�rer que la version 8 fera mieux !</p>


<h2>Le syst�me d�exploitation : Windows Vista</h2>

<p><img src="Images/Vista.png" alt="Windows Vista" />Fortement d�cri� � sa sortie, Vista est pourtant la succession logique de Windows XP.  Lors de sa sortie, deux inconv�nients ont re�us la majorit� des critiques.</p>
<h3>� Windows Vista est lourd �</h3>
<p><img src="Images/Vista2.png" alt="Windows Vista" />Non, non et non ! De nombreuses �tudes ont prouv� que cela n��tait qu�une impression bas�e sur des faits inexacts.<br />
Certes, Vista consomme beaucoup plus de m�moire vive au repos que son pr�d�cesseur Windows XP. Mais si vous �quipez XP d�un firewall, d�outils de gestion r�seau, d�outils de s�curit� de bases, d�un client mail, de Media Center, d�outils pour la synchronisation des p�riph�riques mobiles et d�un outil d�indexation�bref, ce que vous devrez forc�ment faire avec votre nouvel XP, et vous obtenez des performances �quivalentes � celle d�un Vista neuf. Sauf qu�avec Vista, c�est inclus par d�faut ! Et si vous n�en voulez pas, vous n�avez qu�� les d�sinstaller�<br />
Vous allez me dire, mais pourquoi les inclure ? Que chacun fasse ce qu�il veut ! Mais non, mison�istes ! Le monde doit �voluer. Vous imaginez si on vous livrait Windows sans aucun pilote pour vos p�riph�riques ? Vous crieriez au scandale�et bien, vous venez de toucher du doigt la raison pour laquelle Vista est livr� ainsi�</p>

<h3>� Vista est trop diff�rent de XP �</h3>
<p><img src="Images/Vista3.png" alt="Windows Vista" />C�est vrai : l�ensemble Vista est beaucoup plus orient� Internet, recherche, communautarisme.<br />
Dans Vista, si vous voulez quelque chose, vous aurez toujours � votre disposition une boite de recherche : que ce soit dans le panneau de configuration, dans n�importe quel dossier, ou m�me dans le menu D�marrer<sup>5</sup>. Cela facilite beaucoup la gestion de ses fichiers, puisque la recherche ne s�effectue pas uniquement sur le nom du fichier, mais aussi sur son contenu. Pratique quand on dispose d�une v�ritable biblioth�que virtuelle�<br />
On m�a aussi fait remarquer que l�arborescence des documents personnels a �t� modifi�e. D�accord. Et alors ? Je vous rappelle que vous descendez de singes qui ont su faire preuve de capacit�s d�adaptation importantes�vous n�allez quand m�me pas les d�shonorer en affirmant que vous �tes incapables de vous adapter�De m�me � Poste de Travail � a �t� renomm� en � Ordinateur �.Et si c�est le plus gros probl�me de votre vie, estimez-vous heureux !<br />
Derni�re remarque : un clic sur le bouton �teindre n��teint pas compl�tement l�ordinateur, mais le met en veille. Ce comportement est personnalisable, adaptez-le � vos besoins ! Mais n�allez pas hurler que � c�est diff�rent � !</p>

<h3>Les avantages</h3>
<h4>Le dernier d�une longue lign�e</h4>
<p><img src="Images/Vista4.png" alt="Windows Vista" />Windows Vista est le 6�me<sup>6</sup> d�une longue s�rie de syst�mes d�exploitation � Made In Microsoft � . Il h�rite donc du socle solide de ses pr�d�cesseurs : des milliers d�APIs<sup>7</sup>  sont disponibles pour le programmeur, quelques centaines ont �t� ajout�es (dont une bonne partie concernant la gestion de l�interface graphique Aero), la MSDN (l�aide de Microsoft pour les d�veloppeurs) est toujours aussi bien document�e�bref, d�velopper pour Windows reste un vrai plaisir !</p>
<h4>Une stabilit� respectable</h4>
<p><img src="Images/Vista5.png" alt="Windows Vista" />Avez-vous d�j� r�ussi � ouvrir plusieurs applications simultan�ment avec Windows 95 sans faire cracher le syst�me ? Peu probable�alors que sous Vista, la stabilit� est au moins �gale � celle de XP. Certes, il y a eu quelques rat�s au lancement, mais apr�s quelques mois de rodage, la stabilit� de Vista est parfaitement respectable ! Je peux t�moigner que ma version d�Ubuntu crashe plus souvent que Vista<sup>8</sup>.</p>
<h4>Un centre r�seau fiable et robuste</h4>
<p><img src="Images/Vista6.png" alt="Windows Vista" />Depuis le temps que l�on r�vait de messages d�erreurs moins sibyllins�<br />
Sous XP, en cas d�erreur, on avait droit � un quelque peu ridiculisant � V�rifiez que votre modem est allum� �. Vista propose un assistant � la r�paration de r�seaux, et pour l�avoir exp�riment�, j�ai �t� agr�ablement surpris�il y a m�me une option de r�paration automatique qui fait tout, sans action ext�rieure. What Else ?<sup>9</sup></p>
<p>La cr�ation d�un nouveau r�seau, d�un nouveau pont, n�a jamais �t� aussi facile : elle est en tout cas �gale � celles des distributions Linux courantes, alors que XP restait un cran en dessous.</p>
<h4>Des graphismes innovants</h4>
<p><img src="Images/Vista7.png" alt="Windows Vista" />Cet argument manque d�objectivit�, mais je trouve personnellement que l�interface graphique est particuli�rement r�ussie. La transparence (un flou gaussien, � mon avis) est bien r�ussie, et les choix graphiques sont sympathiques (bleu tr�s clair et noir).</p>
<p>Un seul regret : l�ic�ne du Media Player est vraiment moche !<sup>10</sup></p>
<h3>En conclusion</h3>
<p><img src="Images/Vista8.png" alt="Windows Vista" />Au final, Vista s�av�re parfaitement capable de soutenir la comparaison avec son petit fr�re. Plus qu�un lifting d�XP, il s�agit d�une nouvelle base pour une nouveau d�part. Les d�buts de Vista n�ont pas �t� brillants, il faut le conc�der, mais Vista s�est bonifi� avec l��ge. Et toutes les innovations propos�es formeront un socle de travail int�ressant pour l�hypoth�tique Windows 7, pr�vu en 2009<sup>11</sup>.<br />
N�ayez donc pas peur du saut : il serait ridicule d�acqu�rir un PC �quip� de XP. Ce syst�me aurait du disparaitre depuis plusieurs mois, mais Microsoft a �t� � contraint � de repousser son d�part suite � la pression d�un groupe de logomachiens (n�ologisme indiquant des adeptes de la logomachie) incoercibles qui s��meuvent du changement�</p>

<h2>Office 2007</h2>

<p><img src="Images/Office.png" alt="Microsoft Office 2007" class="petit"/>L��quipe responsable de la version 2007 s�est d�chain�e !</p>


<h3>Une nouvelle interface</h3>
<p><img src="Images/Office2.png" alt="Microsoft Office 2007" class="petit" />L�interface � rubans a �t� la cible d�un intense battage m�diatique sur la blogosph�re.<br />
Elle remplace avantageusement les traditionnels menus � Fichier �, � Edition ��<br />
Cela permet un acc�s beaucoup plus intuitif aux diff�rentes fonctions : les styles, d�j� pr�sents depuis de nombreuses versions, sont enfin incorpor�es de fa�on intuitive. Il est donc possible tr�s facilement de changer le style complet d�un document, d�ins�rer une table des mati�res, des r�f�rences et un index des r�f�rences, etc.<br />
La division en onglets facilite la recherche de fonctions : par exemple, l�onglet � R�vision � permet la gestion collaborative d�un document, l�ajout de commentaire, la comparaison entres diff�rentes versions d�un m�me document�</p>

<h3>De nouvelles fonctions</h3>
<p><img src="Images/Office3.png" alt="Microsoft Office 2007" />M�me s�il m�est impossible d�assurer que ces fonctions sont nouvelles<sup>12</sup>, elles sont maintenant mises en avant et utilisables par le grand nombre. On compte entres autres la possibilit� d�appliquer des effets � une image, de faciliter la lecture d�un tableau�<br />
Mais au-del� de ces ajouts int�ressants mais pas forc�ment utiles dans la vie de tous les jours, se trouvent des vraies nouveaut�s.<br />
Par exemple, le seul retard de la suite Office par rapport � son concurrent libre �tait la gestion des PDF. C�est maintenant de l�histoire ancienne, puisqu�il est possible d�exporter les documents dans de nombreux formats, tout en conservant les mises en formes avanc�es telles que les sommaires, les effets sur les images�<br />
Un unique regret : l�export au format HTML cr�e un fichier qui s�affiche sous les navigateurs, mais qui est proprement inexploitable pour un d�veloppeur du monde du libre�<br />
Encore que�en r�fl�chissant bien, un deuxi�me regret vient � l�esprit : le prix ! Heureusement que de nombreuses offres �vitent de payer le plein tarif�</p>


<h2>Conclusion</h2>
<p>Non, non, non ! Bill Gates n�est pas l�Ant�christ�<sup>13</sup><br />
La majorit� des personnes qui critiquent Microsoft le font � pour suivre le mouvement �, sans vraiment avoir d�arguments.<br />
Certes, pour certains types de personnes, Windows n�est pas la solution la plus adapt�e (d�veloppeurs et designers entres autres), mais pour l�immense majorit� des gens, Microsoft s�impose comme un g�ant. Et le plus gros inconv�nient des logiciels Microsoft, c�est leurs prix�quel dommage que l�un des seuls logiciels gratuits de Microsoft (Internet Explorer) soit aussi leur plus grand fiasco !</p>

<hr class="separateur"/>
<p>R�f�rences :</p>
<ol id="Relations">
<li>Un Troll est une discussion o� aucune conclusion n�est possible : chaque parti est convaincu de ces arguments et refuse d��couter ceux des autres. Les trolls sont g�n�ralement interdits sur la plupart des forums.
Des exemples de troll : IE/Firefox, Windows/Linux, les constructeurs de PC�</li>
<li>World Wide Web Consortium, l�organisme charg� de g�rer les standards sur l�Internet.</li>
<li>CSS : Cascading Style Sheets, feuilles de style en cascade.</li>
<li>Firefox, Opera, Safari et Internet Explorer</li>
<li>Menu � D�marrer � qui d�ailleurs ne s�appelle plus � D�marrer �, ce qui n�est pas plus mal puisque cela retire le paradoxe de devoir cliquer sur � D�marrer � avant d��teindre l�ordinateur�</li>
<li>Eh oui, d�j� 6 ! Dans l�ordre : Windows 3.1, 95, 98, Me, Xp</li>
<li>Application Programming Interface : des petites fonctions qui permettent d�effectuer facilement des actions communes � tous les programmes : choix d�une couleur, d�une police, affichage � l��cran, gestion des composants, du temps�</li>
<li>Bon, c�est vrai que Compiz truque un peu  les r�sultats !</li>
<li>Tout lien avec une publicit� connue est fortuit et d�pendant de la volont� de l�auteur.</li>
<li>Comment �a ? Superficiel, moi ? Noon !</li>
<li>Devrait donc �tre disponible aux alentours de 2011 ?</li>
<li>Un chercheur a montr� qu�un utilisateur lambda de Word et Excel n�utilisait pas 10% des possibilit�s de ces logiciels ! (note wikipedienne private-joke : [citation needed])</li>
<li>De toute fa�on, il n�est m�me plus PDG de Microsoft�</li>
</ol>
<?php
include "../footer.php";
?>



