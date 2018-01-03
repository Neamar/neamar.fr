<?php
$Titre="Recueil de moisissures argumentatives";
$AddLine='<link rel="stylesheet" type="text/css" href="https://neamar.fr/lib/Typo/Typo.css" />';
$Box = array("Auteur" => "<strong>Stanislas Antczak</strong> et <strong>Richard Monvoisin</strong>","Date" => "2008",'Version ODT'=>'<a href="Sophismes.odt">ODT</a>');

$Auteurs="Stanislas Antczak, Richard Monvoisin et Nicolas Vivant, 2007-2008";

include('../header.php');
include('../Typo/Typo.php');

$Contenu=<<<INTRO
Cette feuille de \b{Moisissures argumentatives} est fournie à tous les participants du "concours de mauvaise foi", jeu zététique consistant à justifier avec le maximum d'aplomb une position \i{a priori} intenable.
Les différentes figures de style listées ci-dessous représentent un échantillon non exhaustif des arguments "'de mauvaise foi'" auxquels on peut se trouver confronté dans ce genre de débat rhétorique.
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
		'Desc'=>"Tirer une conclusion ne suivant pas logiquement les prémisses (mais la conclusion peut être vraie). Deux types :
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
			'Si la psychokinèse existe, alors cette cuiller peut être tordue. Comme cette cuiller a été tordue, c\'est que la psychokinèse existe.',
			'Si on prouve qu\'il y a eu fraude, alors on ne retient pas les résultats de l\'expérience. On n\'a pas démontré la tricherie, donc l\'expérience est valide.'
		)
	),
'Le raisonnement panglossien'=>array
	(
		'Desc'=>"Raisonner à rebours vers une cause possible, vers une position préconçue.",
		'Ex'=>array('La complexité de l\'être humain est une preuve de l\'existence d\'une volonté divine.')
	),
'Le raisonnement par analogie'=>array
	(
		'Desc'=>"Utiliser une situation de référence pour effectuer la démonstration ; l'analogie peut être valide ou invalide.
\\item situation de référence : A et B sont vraies ;
\\item situation présente : A est vraie ; donc B est vraie.",
		'Ex'=>array('Galilée a été condamné et avait raison. Vous procédez de même avec moi. \\i{(sous-entendu : l\'avenir montrera que j\'ai raison, comme dans le cas de Galilée)}')
	),
'La généralisation'=>array
	(
		'Desc'=>'Inférer une conclusion à partir d\'un échantillon trop petit.',
		'Ex'=>array('Mon voisin est un connard moustachu, donc tous les moustachus sont des cons.')
	),
'L\'\i{argumentum ad ignorantiam}'=>array
	(
		'Desc'=>'Affirmer quelque chose parce que le contraire n\'a pas été démontré.',
		'Ex'=>array("On ne peut pas savoir ce qu'est cet objet dans le ciel, donc c'est un vaisseau spatial extraterrestre.")
	),
'Le sophisme \i{post hoc, ergo propter hoc}'=>array
	(
		'Desc'=>'Après cela, donc à cause de cela. Confondre conséquence et postériorité :
\\item B est arrivé après A ;
\\item donc B a été causée par A.',
		'Ex'=>array("J'ai bu une tisane, puis mon rhume a disparu ; donc c'est grâce à la tisane.")
	),
);

$Attaques=array
(
'Les attaques personnelles (\i{argumentum ad hominem})'=>array
	(
		'Desc'=>'Attaquer la personne et non ses arguments.',
		'Ex'=>array
			(
				"Nicolas Vivant est un ivrogne, donc sa position sur la télépathie est irrecevable.",
				'Comment peut-on adhérer aux positions de Rousseau sur l\'éducation, alors qu\'il a abandonné ses propres enfants ?'
			)
	),
"Le déshonneur par association (cas particulier : \\i{reductio ad hitlerum})"=>array
	(
		'Desc'=>"Comparer l'interlocuteur ou ses positions à une situation servant de repoussoir.",
		'Ex'=>array
		(
			"Tu ne crois pas à la télépathie ? Tiens, comme cet ivrogne de Nicolas Vivant.",
			'Le darwinisme, la sélection des espèces, mènent à un eugénisme digne des Nazis.'
		)
	),
"L'appel à la peur ; la pente savonneuse"=>array
	(
		'Desc'=>"Disqualifier un argument en montrant (ou en faisant croire) qu'une telle position conduirait à des catastrophes.",
		'Ex'=>array
		(
			"Les thérapies comportementalo-cognitives réduisent l'humain à des réflexes et des médicaments. Et c'est la porte ouverte au Prozac pour les enfants.",
			"Si on autorise les téléphones portables à l'école, ce sera quoi la prochaine fois ? Des armes ? De la drogue ?"
		)
	),
"L'homme de paille (technique de l'épouvantail)"=>array
	(
		'Desc'=>"Travestir la position de l'interlocuteur en une autre, plus facile à réfuter ou à ridiculiser.",
		'Ex'=>array("Les adversaires de l'astrologie prétendent que les astres n'ont pas d'influence sur nous. Allez donc demander aux marins si la Lune n'a pas d'influence sur les marées !")
	),
"L'argument du silence (\\i{argumentum a silentio})"=>array
	(
		'Desc'=>"Accuser l'interlocuteur d'ignorance d'un sujet parce qu'il ne dit rien dessus.",
		'Ex'=>array("Je vois que vous ne connaissez pas la parapsychologie puisque vous passez sous silence les travaux de Bem et Honorton.")
	),
"Le renversement de la charge de la preuve"=>array
	(
		'Desc'=>"Demander à l'interlocuteur de prouver que ce qu'on avance est faux.",
		'Ex'=>array("Prouvez-moi donc que le monstre du Loch Ness n'existe pas.")
	),
);

$Travestissements=array
(
"Le faux dilemme"=>array
	(
		'Desc'=>'Réduire abusivement le problème à deux choix pour conduire à une conclusion.',
		'Ex'=>array
		(
			'Le sol sous-marin de Bimini a été fait soit par des humains, ce qui paraît peu probable, soit par des Atlantes, ce qui est déjà plus réaliste.',
			'OVNI : mythe ou réalité ?'
		)
	),
'La pétition de principe'=>array
	(
		'Desc'=>"Faire une démonstration contenant déjà l'acceptation de sa conclusion.",
		'Ex'=>array
		(
			"Comme une maison a besoin d'un architecte, l'Univers a besoin d'un Créateur.",
			"Les lois physiques existent indépendamment de la volonté de Dieu, peut-être ?"
		)
	),
"La technique du chiffon rouge"=>array
	(
		'Desc='=>"Déplacer le débat vers une position intenable par l'interlocuteur.",
		'Ex'=>array("Et tous ces gens qui utilisent l'acupuncture, ce sont des imbéciles, peut-être ?")
	),
"L'argument d'autorité (\\i{argumentum ad verecundiam})"=>array
	(
		'Desc'=>'Invoquer une personnalité faisant ou semblant faire autorité dans le domaine concerné.',
		'Ex'=>array("Quand un scientifique du niveau de d'Espagnat m'écrit que ce livre est le GPS de la science actuelle, c'est savoureux de voir un étudiant en zététique dire que c'est de la pseudo-science.\\footnote{Jean Staune, UIP, communication personnelle à Richard Monvoisin, 13 juin 2007.}")
	),
"L'appel à la popularité (\\i{argumentum ad populum})"=>array
	(
		'Desc'=>'Invoquer le grand nombre de personnes qui adhèrent à une idée.',
		'Ex'=>array('Les millions de personnes utilisant l\'homéopathie ne peuvent pas tous avoir tort.')
	),
"L'appel à la pitié (\i{argumentum ad misericordiam})"=>array
	(
		'Desc'=>'Susciter la sympathie ou la pitié.',
		'Ex'=>array("Bien sûr, Uri Geller\\footnote{Célèbre psychokinésiste prétendant avoir la faculté de tordre le métal.} a triché, mais sous la pression que lui mettaient les scientifiques, on comprend qu'il en soit venu là.")
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
