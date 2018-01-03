<?php
$Titre="Recueil de moisissures argumentatives";
$AddLine='<link rel="stylesheet" type="text/css" href="https://neamar.fr/lib/Typo/Typo.css" />';
$Box = array("Auteur" => "<strong>Stanislas Antczak</strong> et <strong>Richard Monvoisin</strong>","Date" => "2008",'Version ODT'=>'<a href="Sophismes.odt">ODT</a>');

$Auteurs="Stanislas Antczak, Richard Monvoisin et Nicolas Vivant, 2007-2008";

include('../header.php');
include('../Typo/Typo.php');

$Contenu=<<<INTRO
Cette feuille de \b{Moisissures argumentatives} est fournie � tous les participants du "concours de mauvaise foi", jeu z�t�tique consistant � justifier avec le maximum d'aplomb une position \i{a priori} intenable.
Les diff�rentes figures de style list�es ci-dessous repr�sentent un �chantillon non exhaustif des arguments "'de mauvaise foi'" auxquels on peut se trouver confront� dans ce genre de d�bat rh�torique.
INTRO;

Typo::setTexte($Contenu);
?>
<h1><?php echo $Titre; ?></h1>
<p class="auteur"><?php echo $Auteurs; ?></p>


<?php
echo Typo::Parse();

$Erreurs=array
(
'Le \i{Non sequitur}'=>array
	(
		'Desc'=>"Tirer une conclusion ne suivant pas logiquement les pr�misses (mais la conclusion peut �tre vraie). Deux types :
\\begin[2]{column}
\\begin{enumerate}
\\li Si A est vraie, alors B est vraie ;
or, B est vraie ;
donc A est vraie.
\\li Si A est vraie, alors B est vraie ;
or, A est fausse ;
donc B est fausse.
\\end{enumerate}
\\end{column}",
		'Ex'=>array
		(
			'Si la psychokin�se existe, alors cette cuiller peut �tre tordue. Comme cette cuiller a �t� tordue, c\'est que la psychokin�se existe.',
			'Si on prouve qu\'il y a eu fraude, alors on ne retient pas les r�sultats de l\'exp�rience. On n\'a pas d�montr� la tricherie, donc l\'exp�rience est valide.'
		)
	),
'Le raisonnement panglossien'=>array
	(
		'Desc'=>"Raisonner � rebours vers une cause possible, vers une position pr�con�ue.",
		'Ex'=>array('La complexit� de l\'�tre humain est une preuve de l\'existence d\'une volont� divine.')
	),
'Le raisonnement par analogie'=>array
	(
		'Desc'=>"Utiliser une situation de r�f�rence pour effectuer la d�monstration ; l'analogie peut �tre valide ou invalide.
\\item situation de r�f�rence : A et B sont vraies ;
\\item situation pr�sente : A est vraie ; donc B est vraie.",
		'Ex'=>array('Galil�e a �t� condamn� et avait raison. Vous proc�dez de m�me avec moi. \\i{(sous-entendu : l\'avenir montrera que j\'ai raison, comme dans le cas de Galil�e)}')
	),
'La g�n�ralisation'=>array
	(
		'Desc'=>'Inf�rer une conclusion � partir d\'un �chantillon trop petit.',
		'Ex'=>array('Mon voisin est un connard moustachu, donc tous les moustachus sont des cons.')
	),
'L\'\i{argumentum ad ignorantiam}'=>array
	(
		'Desc'=>'Affirmer quelque chose parce que le contraire n\'a pas �t� d�montr�.',
		'Ex'=>array("On ne peut pas savoir ce qu'est cet objet dans le ciel, donc c'est un vaisseau spatial extraterrestre.")
	),
'Le sophisme \i{post hoc, ergo propter hoc}'=>array
	(
		'Desc'=>'Apr�s cela, donc � cause de cela. Confondre cons�quence et post�riorit� :
\\item B est arriv� apr�s A ;
\\item donc B a �t� caus�e par A.',
		'Ex'=>array("J'ai bu une tisane, puis mon rhume a disparu ; donc c'est gr�ce � la tisane.")
	),
);

$Attaques=array
(
'Les attaques personnelles (\i{argumentum ad hominem})'=>array
	(
		'Desc'=>'Attaquer la personne et non ses arguments.',
		'Ex'=>array
			(
				"Nicolas Vivant est un ivrogne, donc sa position sur la t�l�pathie est irrecevable.",
				'Comment peut-on adh�rer aux positions de Rousseau sur l\'�ducation, alors qu\'il a abandonn� ses propres enfants ?'
			)
	),
"Le d�shonneur par association (cas particulier : \\i{reductio ad hitlerum})"=>array
	(
		'Desc'=>"Comparer l'interlocuteur ou ses positions � une situation servant de repoussoir.",
		'Ex'=>array
		(
			"Tu ne crois pas � la t�l�pathie ? Tiens, comme cet ivrogne de Nicolas Vivant.",
			'Le darwinisme, la s�lection des esp�ces, m�nent � un eug�nisme digne des Nazis.'
		)
	),
"L'appel � la peur ; la pente savonneuse"=>array
	(
		'Desc'=>"Disqualifier un argument en montrant (ou en faisant croire) qu'une telle position conduirait � des catastrophes.",
		'Ex'=>array
		(
			"Les th�rapies comportementalo-cognitives r�duisent l'humain � des r�flexes et des m�dicaments. Et c'est la porte ouverte au Prozac pour les enfants.",
			"Si on autorise les t�l�phones portables � l'�cole, ce sera quoi la prochaine fois ? Des armes ? De la drogue ?"
		)
	),
"L'homme de paille (technique de l'�pouvantail)"=>array
	(
		'Desc'=>"Travestir la position de l'interlocuteur en une autre, plus facile � r�futer ou � ridiculiser.",
		'Ex'=>array("Les adversaires de l'astrologie pr�tendent que les astres n'ont pas d'influence sur nous. Allez donc demander aux marins si la Lune n'a pas d'influence sur les mar�es !")
	),
"L'argument du silence (\\i{argumentum a silentio})"=>array
	(
		'Desc'=>"Accuser l'interlocuteur d'ignorance d'un sujet parce qu'il ne dit rien dessus.",
		'Ex'=>array("Je vois que vous ne connaissez pas la parapsychologie puisque vous passez sous silence les travaux de Bem et Honorton.")
	),
"Le renversement de la charge de la preuve"=>array
	(
		'Desc'=>"Demander � l'interlocuteur de prouver que ce qu'on avance est faux.",
		'Ex'=>array("Prouvez-moi donc que le monstre du Loch Ness n'existe pas.")
	),
);

$Travestissements=array
(
"Le faux dilemme"=>array
	(
		'Desc'=>'R�duire abusivement le probl�me � deux choix pour conduire � une conclusion.',
		'Ex'=>array
		(
			'Le sol sous-marin de Bimini a �t� fait soit par des humains, ce qui para�t peu probable, soit par des Atlantes, ce qui est d�j� plus r�aliste.',
			'OVNI : mythe ou r�alit� ?'
		)
	),
'La p�tition de principe'=>array
	(
		'Desc'=>"Faire une d�monstration contenant d�j� l'acceptation de sa conclusion.",
		'Ex'=>array
		(
			"Comme une maison a besoin d'un architecte, l'Univers a besoin d'un Cr�ateur.",
			"Les lois physiques existent ind�pendamment de la volont� de Dieu, peut-�tre ?"
		)
	),
"La technique du chiffon rouge"=>array
	(
		'Desc='=>"D�placer le d�bat vers une position intenable par l'interlocuteur.",
		'Ex'=>array("Et tous ces gens qui utilisent l'acupuncture, ce sont des imb�ciles, peut-�tre ?")
	),
"L'argument d'autorit� (\\i{argumentum ad verecundiam})"=>array
	(
		'Desc'=>'Invoquer une personnalit� faisant ou semblant faire autorit� dans le domaine concern�.',
		'Ex'=>array("Quand un scientifique du niveau de d'Espagnat m'�crit que ce livre est le GPS de la science actuelle, c'est savoureux de voir un �tudiant en z�t�tique dire que c'est de la pseudo-science.\\footnote{Jean Staune, UIP, communication personnelle � Richard Monvoisin, 13 juin 2007.}")
	),
"L'appel � la popularit� (\\i{argumentum ad populum})"=>array
	(
		'Desc'=>'Invoquer le grand nombre de personnes qui adh�rent � une id�e.',
		'Ex'=>array('Les millions de personnes utilisant l\'hom�opathie ne peuvent pas tous avoir tort.')
	),
"L'appel � la piti� (\i{argumentum ad misericordiam})"=>array
	(
		'Desc'=>'Susciter la sympathie ou la piti�.',
		'Ex'=>array("Bien s�r, Uri Geller\\footnote{C�l�bre psychokin�siste pr�tendant avoir la facult� de tordre le m�tal.} a trich�, mais sous la pression que lui mettaient les scientifiques, on comprend qu'il en soit venu l�.")
	)
);

function outputArray($Titre,&$V)
{
$Contenu = '\section{' . $Titre . '}' . "\n";

	foreach($V as $Nom=>$Def)
	{
		$Contenu .='\\subsection{' . $Nom . '})' . "\n";
		$Contenu .= $Def['Desc'] . "\n\n";
		$Contenu .='\\begin{quote}' . "\n" . '\\begin{itemize}' . "\n";
		foreach($Def['Ex'] as $Exemple)
		{
			$Contenu .='\\li ' . $Exemple . "\n";
		}
		$Contenu .='\\end{itemize}' . "\n" . '\\end{quote}' . "\n";
	}
	return $Contenu;
}

$Texte = outputArray('Erreurs logiques',$Erreurs);

$Texte .= outputArray('Attaques',$Attaques);

$Texte .= outputArray('Travestissements',$Travestissements);

Typo::setTexte($Texte);

echo Typo::Parse();
?>

<p class="auteur"><?php echo $Auteurs; ?></p>

<?php
include('../footer.php');
?>
