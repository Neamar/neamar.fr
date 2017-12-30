/////////////////////////////////////
//Fonctions de création de niveau
/////////////////////////////////////

function GetLevelData(Numero:int,Not_Mute:Boolean=true):Niveau
{

	//La structure d'enregistrement de niveau est loin d'être optimale : avec du recul, je m'apercois que j'aurais du lui préferer quelque chose de similaire à :
// 	1:2,3,4
// 	2:3,4
// 	J'y aurais gagné en clarté et en concision !
	var Message:String="";
	var Liens:Array=new Array();//La representation interne du niveau
	function T(...Liste):Array
	{//T comme Tableau
	//Plus court à écrire que new Array() à chaque fois
		return Liste;
	}
	if(Numero==0)
	{//Insolemment easy
		Liens=new Array(T(0,1),T(0,2),T(0,3),T(1,2),T(1,3),T(2,3));
		Message ="<u>Règles de B-graphe : <font size=\"-2\"><i>(partie 1/1)</i></font></u><br>Enlevez tout croisement entre les traits pour passer au niveau suivant.<br>Pour cela, déplacez les ronds à l'aide de la souris.";
	}
	else if(Numero==1)//Très facile (deux figures distinctes)
		Liens=new Array(T(0,1),T(1,5),T(5,4),T(4,0),T(6,7),T(7,3),T(3,2),T(2,6));
	else if(Numero==2)//Très facile
		Liens=new Array(T(1,4),T(1,2),T(1,5),T(2,3),T(2,4),T(3,4),T(3,5),T(4,5),T(5,0),T(2,5),T(0,4));
	else if(Numero==3)//Plutot facile
		Liens=new Array(T(1,2),T(1,3),T(1,4),T(1,5),T(2,6),T(3,6),T(4,7),T(5,7),T(5,9),T(6,8),T(7,0),T(8,0),T(9,0),T(0,1));
	else if(Numero==4)//Facile
		Liens=new Array(T(0,1),T(0,8),T(0,9),T(1,2),T(1,3),T(2,3),T(2,4),T(2,5),T(3,7),T(4,5),T(4,6),T(5,6),T(6,7),T(7,9),T(7,11),T(8,9),T(9,10),T(10,11));
	else if(Numero==5)//Moyen
		Liens=new Array(T(0,1),T(0,4),T(0,5),T(1,2),T(1,5),T(2,3),T(2,6),T(3,6),T(3,7),T(4,5),T(4,9),T(5,10),T(5,8),T(5,6),T(6,8),T(6,7),T(6,11),T(7,12),T(8,10),T(8,11),T(9,10),T(9,13),T(10,13),T(10,14),T(10,11),T(11,12),T(11,15),T(12,16),T(13,14),T(14,15),T(15,16),T(11,16));
	else if(Numero==6)//Moyen Dur
	{
		Liens=new Array(T(0,1),T(0,2),T(0,7),T(0,9),T(0,10),T(1,2),T(1,3),T(1,6),T(1,7),T(2,3),T(2,9),T(3,4),T(3,9),T(3,6),T(4,5),T(4,6),T(4,7),T(4,13),T(4,14),T(4,10),T(5,6),T(5,14),T(5,15),T(5,12),T(5,11),T(6,7),T(6,15),T(6,16),T(7,10),T(7,11),T(7,12),T(7,13),T(7,16),T(7,8),T(9,10),T(11,12),T(11,15),T(11,16),T(12,13),T(12,14),T(13,14),T(15,16));
		Message ="<u>Astuce</u><br>Vous pouvez utiliser la roulette de la souris pour dézoomer le niveau, afin d'y voir plus clair. Attention cependant, seul un faible niveau de recul est permis !";
	}
	else if(Numero==7)//Dur
		Liens=new Array(T(0,1),T(0,2),T(0,3),T(0,4),T(0,5),T(0,6),T(0,7),T(1,8),T(2,3),T(2,8),T(3,4),T(3,8),T(3,9),T(4,9),T(4,5),T(4,10),T(5,11),T(5,6),T(5,10),T(6,11),T(7,11),T(8,15),T(8,16),T(9,16),T(9,17),T(9,10),T(10,17),T(10,18),T(11,18),T(11,19),T(12,17), T(13,17),T(14,17),T(15,20),T(16,17),T(16,23),T(17,18),T(18,23),T(19,25),T(19,26),T(20,27),T(20,28),T(21,28),T(21,22),T(22,28),T(22,23),T(23,28),T(23,24),T(24,28),T(24,25),T(25,28),T(26,28),T(26,29),T(27,28),T(27,32),T(28,30),T(28,31),T(28,29),T(29,32),T(28,29),T(28,32));
	else if(Numero==8)//Dur, trois figures distinctes.
		Liens=new Array(T(0,1),T(0,13),T(0,8),T(0,11),T(1,2),T(1,11),T(2,3),T(2,11),T(2,12),T(3,10),T(3,4),T(4,10),T(4,5),T(5,10),T(5,6),T(6,9),T(6,7),T(6,12),T(7,9),T(7,8),T(8,9),T(8,21),T(9,21),T(9,12),T(10,12),T(11,12),T(11,13),T(12,13),T(12,14),T(12,15),T(12,16),T(12,17), T(12,18),T(12,19),T(12,20),T(12,21),T(13,14),T(13,15),T(13,17),T(13,21),T(14,15),T(15,16),T(15,17),T(16,17),T(17,18),T(17,19),T(17,21),T(18,19),T(19,20),T(19,21),T(20,21),T(30,31),T(30,37),T(30,41),T(30,42),T(30,35),T(30,36),T(31,32),T(31,33),T(31,34),T(31,41),T(31,42),T(32,33),T(32,37),T(32,39),T(32,40),T(32,41),T(33,34),T(34,42),T(34,35),T(35,36),T(36,37),T(36,38),T(37,39),T(37,41),T(37,38),T(38,39),T(39,40),T(22,23),T(22,24),T(22,25),T(22,26),T(22,27),T(22,28),T(22,29),T(23,25),T(26,28),T(23,28),T(23,24),T(24,25),T(25,29),T(29,26),T(26,27),T(27,28));
	else if(Numero==9)//Inspiré par http://pigale.sourceforge.net/images/graphT0.png
		Liens=new Array(T(1,2),T(1,6),T(1,8),T(1,9),T(1,10),T(1,13),T(1,16),T(1,21),T(2,6),T(2,9),T(2,14),T(2,18),T(2,22),T(2,23),T(3,4),T(3,5),T(3,8),T(4,5),T(4,7),T(5,6),T(6,0),T(6,7),T(6,8),T(6,15),T(6,18),T(6,16),T(7,5),T(7,8),T(7,9),T(7,12),T(7,18),T(7,19),T(7,23),T(7,24),T(7,26),T(7,0),T(8,5),T(8,9),T(8,10),T(8,11),T(8,12),T(8,15),T(8,16),T(8,17),T(8,25), T(9,11),T(9,12),T(9,13),T(9,14),T(9,19),T(9,20),T(10,11),T(10,21),T(11,21),T(12,24),T(12,25),T(13,14),T(13,20),T(14,20),T(15,16),T(15,17),T(16,17),T(18,26),T(18,0),T(19,22),T(19,23),T(22,23),T(24,25),T(26,0));
	else if(Numero==10)//Pas facile, proche du maximum de densité théorique
 		Liens=new Array(T(0,1),T(0,2),T(0,5),T(0,6),T(0,8),T(0,13),T(0,16),T(1,2),T(1,3),T(1,4),T(1,5),T(2,3),T(2,11),T(2,12),T(2,13),T(3,4),T(3,11),T(4,5),T(4,11),T(4,17),T(5,6),T(5,7),T(5,17),T(6,7),T(6,8),T(7,8),T(7,9),T(7,10),T(7,17),T(8,9),T(8,10),T(8,16),T(9,10),T(9,15),T(9,16),T(9,17),T(11,12),T(11,17),T(11,18),T(11,21),T(11,27),T(12,13),T(12,14),T(12,16),T(12,18),T(13,16),T(14,15), T(14,16),T(15,16),T(15,17),T(17,18),T(18,19),T(18,21),T(18,22),T(18,23),T(18,24),T(18,26),T(18,27),T(19,20),T(19,22),T(19,23),T(20,21),T(20,22),T(20,23),T(21,22),T(21,23),T(23,24),T(23,25),T(23,26),T(24,26),T(25,26),T(25,27));
	else if(Numero==11)//Le graphe maximal...à 42 noeuds. Afin de le simplifier dans sa representation, on commence par les noeuds avec le moins d'aretes. De cette façon, on obtient bien trois aretes pour CHAQUE noeud, sauf sur les trois derniers : l'anté pénultième n'en a que deux, l'avant dernier un et le dernier n'a aucune arete propre. On a donc un total de 3*n -6 aretes, ce qui est bien la limite théorique pour un graphe planaire !
	{
		Liens=new Array(T(42,5),T(42,3),T(42,14),T(41,12),T(41,2),T(41,1),T(40,11),T(40,6),T(40,1),T(39,1),T(39,6),T(39,12),T(38,2),T(38,6),T(38,12),T(37,2),T(37,6),T(37,10),T(36,2),T(36,3),T(36,10),T(35,3),T(35,6),T(35,10),T(34,3),T(34,6),T(34,11),T(33,1),T(33,3),T(33,11),T(32,1),T(32,3),T(32,14),T(31,1),T(31,5),T(31,14),T(30,1),T(30,5),T(30,15),T(29,0),T(29,1),T(29,15),T(28,0),T(28,5),T(28,15),T(27,0),T(27,5),T(27,13),T(26,3),T(26,5),T(26,13),T(25,0),T(25,3),T(25,13),T(24,0),T(24,3),T(24,8),T(23,0),T(23,4),T(23,8),T(22,3),T(22,4),T(22,8),T(21,3),T(21,4),T(21,9),T(20,2),T(20,3),T(20,9),T(19,2),T(19,4),T(19,9),T(18,2),T(18,4),T(18,7),T(17,0),T(17,4),T(17,7),T(16,0),T(16,2),T(16,7),T(15,0),T(15,1),T(15,5),T(14,1),T(14,3),T(14,5),T(13,0),T(13,3),T(13,5),T(12,1),T(12,2),T(12,6),T(11,1),T(11,3),T(11,6),T(10,2),T(10,3),T(10,6),T(9,2),T(9,3),T(9,4),T(8,0),T(8,3),T(8,4),T(7,0),T(7,2),T(7,4),T(6,1),T(6,2),T(6,3),T(5,0),T(5,1),T(5,3),T(4,0),T(4,2),T(4,3),T(3,0),T(3,1),T(3,2),T(2,0),T(2,1),T(1,0));
		Message="Bienvenue dans le dernier niveau de BGraphe.<br>Ce niveau est spécial : tous les autres niveaux admettaient des solutions multiples. Cette fois, il s'agit du  «graphe maximal mathématique» : le nombre d'arêtes est poussé à son maximum. En conséquent, une seule solution existe <font size=\"-4\">enfin...avec des arêtes droites</font>...pour vous aider, vous pouvez vous renseigner sur le «tapis de triangle» de Sierpinski. Bon courage...";
	}

	if(Message!="" && Not_Mute)
		ShowMessage(Message);

	return LoadNiveau(Liens,Numero);
}

function ChargementNiveauDirect(e:Event):void
{//Triggeré quand clic sur une des miniatures dans Boite.
	while(Boite.numChildren > 0)
		Boite.removeChildAt(0);//libérer de la mémoire (même si on ne peut s'assurer du passage du garbage collector)

	Boite.addChild(ChangeLevelInfo);

	ChangeLevelInfo.htmlText="<u>Chargement en cours</u> (niv. <b>"+e.currentTarget.NumeroNiveau+"</b>)";
	if(e.currentTarget.Officiel==true)
	{
		NumeroNiveauActuel=e.currentTarget.NumeroNiveau;
		LancerNouveauNiveau(e.currentTarget.NumeroNiveau);
	}
	else
		LancerChargement();//Charger le level perso
}


function LoadNiveau(Liens:Array,Numero:int):Niveau
{//La fonction principale, qui charge le niveau dans un sprite
	var Layer:Niveau; //Layer est le Sprite qui doit contenir le niveau
	Layer=new Niveau(Liens,FlashWidth,FlashHeight);
	Layer.NumeroNiveau=Numero;
	return Layer;
}

function String2Level(Niv_String:String):Niveau
{//prend un string en paramètre, le transforme et renvoie un niveau.
	var Niv_Array:Array=Niv_String.split("|");
	var Liens:Array=new Array();
	for each(var Lien:String in Niv_Array)
	{
		var Composants:Array=Lien.split(",");
		Liens.push(Composants);
	}
	var LeNiveau:Niveau = LoadNiveau(Liens,100);
	if(3*LeNiveau.All_Noeuds.length -6<LeNiveau.All_Liens.length)
		ShowMessage("Ce niveau est <i>à priori</i> irréalisable !");
	return LeNiveau;
}