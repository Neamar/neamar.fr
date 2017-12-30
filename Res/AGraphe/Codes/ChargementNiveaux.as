/////////////////////////////////////
//Fonctions de création de niveau
/////////////////////////////////////

function GetLevelData(Numero:int,Not_Mute:Boolean=true):Niveau
{
	const NIVEAUX_JETONS:Array=new Array(3,4,5,4,5,5,3,5,6,7,5,6);
	var Hook:Array=new Array(); //Vide la liste des Hook.
	var Non_Extinctible:Array=new Array(); //Vide la liste des Non_Extinctible.
	var Niveau_datas:Array; //Contient l'arborescence sous forme numérique
	var Inutile:Array=null;//Evite de réecrire complètement un niveau lors de sa modification
	var Message:String="";

	function T(...Liste):Array
	{//T comme Tableau
	//Plus court à écrire que new Array() à chaque fois
		return Liste;
	}
	if(Numero==0)
	{
		Niveau_datas=new Array(null,null,T(0,1));
		Message ="<u>Règles d'A-graphe : <font size=\"-2\"><i>(partie 1/3)</i></font></u><br><li><b>Règle n°1 : </b> Pour allumer un noeud (representé par un cercle), cliquer dessus.</li><li><b>Règle n°2 : </b> Pour terminer un niveau, allumer le noeud principal, centré en haut.</li><li><b>Règle n°3 : </b> Un noeud est allumable si et seulement si tous ses enfants (les noeuds qui descendent de lui) sont allumés.</li>";
	}

	else if(Numero==1)
	{
		Niveau_datas=new Array(null,null,null,T(0,1,2),null,null,T(4,5),T(3,6));
		Message = "<u>Règles d'A-graphe : <font size=\"-2\"><i>(partie 2/3)</i></font></u><br><li><b>Règle n°4 : </b> Il est interdit d'allumer simultanément plus de noeuds que le nombre imparti pour chaque niveau (ce nombre est affiché en haut, à droite).</li><li><b>Règle n°5 : </b> Une fois un noeud allumé, on peut éteindre ses enfants sans que cela éteigne le parent.</li>";
	}
	else if(Numero==2)
	{
		Niveau_datas=new Array(null,null,T(0,1),null,null,T(1,3,4),null,T(4,6),null,T(8),T(9),T(2,5,7,10));
		Message = "<u>Règles d'A-graphe : <font size=\"-2\"><i>(partie 3/3)</i></font></u><br><li><b>Règle n°6 : </b> Un noeud allumé puis éteint ne peut pas être rallumé.</li><li><b>Règle n°7 : </b> Les noeuds marqués d'une croix ne peuvent pas être éteints.</li><br>Voilà, c'est tout pour les règles. Bonne chance !";
	}
	else if(Numero==3)
		Niveau_datas=new Array(null,null,null,T(0),T(3,2),T(1,0),T(5,0,4));
 	else if(Numero==4)
 	{
		Niveau_datas=new Array( null,null,null,T(0,1,2),null,null,T(4,5),T(3,6),null,null,T(8,9),null,null,T(11,12),null,null,T(14,15),T(10,13,16),null,T(17,18),T(7,19));
	}
	else if(Numero==5)
	{
		Niveau_datas=new Array(null,null,null,T(0),T(0,2),T(2),T(3,4,5),T(1),T(3,4,5),T(6,7,8));
		Hook[1]=1;
		Message = "<li><b>Dernier niveau du tutorial.</b> Les choses vont rapidement se gâter ! Bonne chance pour la suite...</li><li>Un conseil avant de nous quitter : pensez à bien vérifier l'agencement des noeuds avant de commencer : certains sont un peu traîtres...</li>";
	}
	else if(Numero==6)
	{
		Niveau_datas=new Array(null,T(0),null,null,T(3),T(2,3),T(4),T(5,6),T(1,7));
		Hook[3]=-1;
	}
	else if(Numero==7)
	{
		Niveau_datas=new Array(null,T(0),T(0),T(0),T(1),T(1,2),T(2,3),T(3),T(4,5),T(5,6,7),T(8),null,T(9,11),T(10),T(12),T(13,14),T(13,15),T(14,11,7),T(16,15,17));
		//Hook[15]=-1;
 		Non_Extinctible[7]=true;
	}
	else if(Numero==8)
	{
		Niveau_datas=new Array(null,T(0),null,T(0,2),T(1),T(4),T(1,0),T(3,2),T(5,4),null,null,null,T(9,10),T(10,11),T(12),T(13),T(14),T(15),T(12),T(13),T(10),T(16,18,20,19,17),T(6,7,8),T(21,22));
	}
	else if(Numero==9)
		Niveau_datas=new Array(null,T(0),T(0),T(1),T(1,0),T(2,0),T(2),T(3),T(3,1,4),T(5,6),T(6),T(7,3,8),T(9,10),T(11,8,4,5,9,12));
	else if(Numero==10)
		Niveau_datas=new Array(null,null,null,null,T(0,1),T(2,3),T(4),T(4),T(5),T(5),T(6),T(6,7),T(7),T(8),T(9),T(10,11,12),T(13,14),T(15),T(15,16),T(16),null,null,null,null,null,T(22,20,23),T(23,21,24),T(25,26),T(17,18),T(18,19),T(28,29),T(30,27));
	else if(Numero==11)
	{
		Niveau_datas=new Array(null,T(0),T(0),T(0),T(1,0),T(1,0,2),T(1,2,3),T(4,5,6),T(5,0,6),T(0,6),null,null,T(10),T(11),T(13,11),null,null,null,null,null,T(12),T(14),T(13,20),T(15,16,17,18),T(19,12,10),T(21,20),T(22,23,24),T(25),T(25),T(26,27),T(27),T(28),T(29),T(29,30),T(0,6,31,32,33),T(7,8,34));
		Message="<u>Dernier niveau</u><br>Je vous souhaiterais bien bonne chance, mais je crains que cela ne suffise pas ;-)";
	}

	if(Message!="" && Not_Mute && !Mode2Joueurs)
		ShowMessage(Message);
	if(Mode2Joueurs)
		ShowMessage("<u>Niveau en mode 2 Joueurs</u><li>Les informations du niveau sont affichées en haut, à droite.</li><li>N'oubliez pas que vous pouvez éteindre des noeuds ! Votre tour ne se finit que quand vous en allumez un.</li>");

	return LoadNiveau(Niveau_datas,Numero.toString(),NIVEAUX_JETONS[Numero],Hook,Non_Extinctible);
}

function String2Level(Niv_String:String,Titre:String="Mon niveau perso",NbJetons:int=5):Niveau
{//Crée un niveau à partir d'un string.
//Utilisé en mode 2 joueurs, mais aussi lors de la résolution automatique d'un niveau.
	var Hook:Array=new Array(); //Vide la liste des Hook.
	var Non_Extinctible:Array=new Array(); //Vide la liste des Non_Extinctible.
	var Allumes:Array=new Array();
	var DejaAllumes:Array=new Array();
	var i:int=0;
	var Niv_Array:Array=Niv_String.split(",");
	function ReplaceNullItem(T:Array):void
	{

		if(T.length>1)
		{
			for(var j:int=0;j<T.length;j++)
			{//On ne peut pas utiliser for each, car String est un type primitif : on agirait sur une copie de l'objet.
				if(T[j]=="null")
					T[j]=null;
			}
		}
	}


	for(i=0;i<Niv_Array.length;i++)
	{//Trouver les Hook, les allumés et les non exctinctibles.
		if(Niv_Array[i]!=Niv_Array[i].replace("X",""))
		{//ajouter NonExtinctible
			Niv_Array[i]=Niv_Array[i].replace("X","");
			Non_Extinctible[i]=true;
		}
		if(Niv_Array[i]!=Niv_Array[i].replace("@",""))
		{//ajouter NonExtinctible
			Niv_Array[i]=Niv_Array[i].replace("@","");
			Allumes[i]=true;
		}
		if(Niv_Array[i]!=Niv_Array[i].replace("-",""))
		{//ajouter un Hook
			Niv_Array[i]=Niv_Array[i].replace("-","");
			Hook[i]=-1;
		}
		if(Niv_Array[i]!=Niv_Array[i].replace("+",""))
		{//ajouter un Hook
			Niv_Array[i]=Niv_Array[i].replace("+","");
			Hook[i]=1;
		}
		if(Niv_Array[i]!=Niv_Array[i].replace("!",""))
		{//ajouter un Hook
			Niv_Array[i]=Niv_Array[i].replace("!","");
			DejaAllumes[i]=true;
		}
	}
	//Remplacer "null" par...le vrai null
	ReplaceNullItem(Niv_Array);

	for(i=0;i<Niv_Array.length;i++)
	{//On ne peut pas utiliser for each, car String est un type primitif
		if(Niv_Array[i]!=null && Niv_Array[i].indexOf("/")!=-1)
		{
			Niv_Array[i]=Niv_Array[i].split("/");
			Niv_Array[i].pop();//Supprimer le dernier item, qui est null
			ReplaceNullItem(Niv_Array[i]);
		}
	}
	return LoadNiveau(Niv_Array,Titre,NbJetons,Hook,Non_Extinctible,Allumes,DejaAllumes);
}

function ChargementNiveauDirect(e:Event):void
{//Triggeré quand clic sur une des miniatures dans Boite.
	while(Boite.numChildren > 0)
		Boite.removeChildAt(0);

	Boite.addChild(ChangeLevelInfo);

	ChangeLevelInfo.htmlText="<u>Chargement en cours</u> (niv. <b>"+e.currentTarget.NumeroNiveau+"</b>)";
	if(e.currentTarget.Officiel)
	{
		NumeroNiveauActuel=e.currentTarget.NumeroNiveau;
		LancerNouveauNiveau(e.currentTarget.NumeroNiveau);
	}
	else
		LancerChargement();
}


function LoadNiveau( Level:Array,NumNiveau:String,NBJetons:int,Hook:Array,Non_Extinctible:Array,Allumes:Array=null,DejaAllumes:Array=null):Niveau
{//La fonction principale, qui charge le niveau dans un sprite
	var Layer:Niveau; //Layer est le Sprite qui doit contenir le niveau
	if(Allumes==null)
		Allumes=new Array();
	if(DejaAllumes==null)
		DejaAllumes=new Array();
	Layer=new Niveau(NumNiveau,Level,Hook,Non_Extinctible,Allumes,DejaAllumes,NBJetons,FlashHeight,FlashWidth,Mode2Joueurs);
	GrandPere=Layer.All_Noeuds[Level.length-1];
	//Puis régler les positions Y.
	//Pour cela, il faut d'abord trouver le nombre d'imbrications.
	//Facile ! Il suffit d'appeler GrandPere.Profondeur(), qui est récursive.
	GrandPere.GererXY(1,GrandPere.Profondeur(),FlashWidth-20,FlashWidth/2 -10);
	GrandPere.RecreerArbreLien();
	Layer.CreerArbreParents(GrandPere);
	return Layer;
}