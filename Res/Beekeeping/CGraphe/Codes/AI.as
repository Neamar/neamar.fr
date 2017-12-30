//D�finit le comportement d'un ordinateur en instanciant un Joueur.
//Cette classe comporte plus de fonctions que Human, et peut �tre plus difficile d'acc�s.

package
{
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.utils.Timer;
    import flash.events.TimerEvent;


	import flash.geom.Point;


	public class AI extends Player
	{
		public static const NO_CLEANING:Boolean=false;
		public var Smart:Boolean;//Si cette valeur vaut AI_NOT_SMART, l'ordinateur sera moins intelligent et plus facile � vaincre.

		private var AreteSelectionnee:Arc;
		private var Chrono:Timer;

		public function AI(Jeu:Game,Joueur:int,AI_Is_Smart:Boolean)
		{
			this.IsHuman=false;
			this.Jeu = Jeu;
			this.Terrain = Jeu.Terrain;
			this.Joueur=Joueur;
			this.Smart=AI_Is_Smart;

			this.Chrono= new Timer(750);
            Chrono.addEventListener(TimerEvent.TIMER, ActNow);

		}

		public function Jouer():void
		{//S�lectionne l'ar�te la plus utile, et lance la coloration dessus. ATtention, elle n'est pas encor ejou�e : il y a un petit temps pour permettre � l'utilisateur de voir le coup.
			function GetMax():Array
			{
				var BestEdge:Arc;
				var BestEdgesCoeff:Number=-1;
				var CurrCoeff:Number;
				for(var Arete:* in Aretes_Ponderees)
				{
					CurrCoeff=Aretes_Ponderees[Arete];
					if(BestEdgesCoeff<=CurrCoeff && !Arete.PlayedByShort)
					{
						BestEdge=Arete;
						BestEdgesCoeff=CurrCoeff;
					}
					Arete.Caption=(Math.round(CurrCoeff*100)/100).toString();
				}
				return new Array(BestEdge,BestEdgesCoeff);
			}

			Tour_Termine=false;
			var Aretes_Ponderees:DictionaryPlus=this.getPonderedEdges();
			var PlusLourd:Array=GetMax();
			if(PlusLourd[1]==0)
			{//Si le plus lourd vaut 0, alors toutes les aretes valent 0 et ont �t� interdites : relancer le calcul, m�me si la partie est plus que probablement perdue.
				Aretes_Ponderees=this.getPonderedEdges(NO_CLEANING);//Refaire le calcul en autorisant toutes les aretes
				PlusLourd=GetMax();
			}

			this.AreteSelectionnee=PlusLourd[0];
			this.AreteSelectionnee.AddFocus(4);
			Chrono.start();
		}

		//Fonctions priv�es

		private function ActNow(e:TimerEvent):void
		{
			JouerArete(this.AreteSelectionnee);
			Chrono.stop();
		}
		private function getPonderedEdges(Nettoyer:Boolean=true):DictionaryPlus
		{//Cette fonction renvoie la liste des ar�tes tri�es par ordre d'importance...selon un pseudo-pathfinding.
			var All_Possible_Path:Array=new Array();
			var ForbiddenEdge:DictionaryPlus=new DictionaryPlus();
			var Edge:Arc;
			var Node:Noeud;

			if(Nettoyer && Smart)
			{//Enl�ve du jeu les ar�tes inutiles, � condition que l'on ne force pas l'utilisation de tout les noeuds (Nettoyer=true) et que l'ordinateur doit �tre intelligent.
				//Commencer par lister les aretes inutiles :
				for each(Node in this.Terrain.All_Noeuds)
				{
					//CAS 1 : ---------------O------------------- : deux liens seuls sur le m�me sommet, aucun des deux n'est jou�.
					if(Node.Liens.length==2 && !Node.Liens[0].PlayedByShort && !Node.Liens[1].PlayedByShort && Node!=Terrain.StartNode && Node!=Terrain.EndNode && Node.Liens[0].Sommet(Node)!=Node.Liens[1].Sommet(Node))
					{
						ForbiddenEdge[Node.Liens[0]]=true;
						ForbiddenEdge[Node.Liens[1]]=true;
						if(Const.MODE==Const.DEBUG)
							Node.Liens[0].alpha=Node.Liens[1].alpha=.7;
					}
				}

				for each(Edge in this.Terrain.All_Liens)
				{
					//CAS 2 : Un chemin PlayedByShort existe entre les deux extr�mit�s de l'ar�te.
					var CheminExiste:Boolean=false;
					Short_PathFinde(Edge.Extremites[0],Edge.Extremites[1],Edge,new DictionaryPlus())
					if(CheminExiste)
					{
						ForbiddenEdge[Edge]=true;
						if(Const.MODE==Const.DEBUG)
							Edge.alpha=.5;
					}
				}
				function Short_PathFinde(Node:Noeud,Arrivee:Noeud,Excluding:Arc,Path:DictionaryPlus):void
				{
					//Si le noeud examin� est le noeud final, on a gagn� :)
					if(Node==Arrivee)
						CheminExiste=true;
					if(CheminExiste!=true)
					{//Sinon, on regarde chaque arete du noeud et on teste r�cursivement.
						for each(var Arete:Arc in Node.Liens)
						{
							if(Arete.PlayedByShort && Excluding!=Arete && !Path.Contains(Arete))
							{
								var CopiePath:DictionaryPlus=Path.Clone();
								CopiePath[Arete]=true;
								Short_PathFinde(Arete.Sommet(Node),Arrivee,Excluding,CopiePath)
							}
						}
					}
				}
			}
			function PathFind(Node:Noeud,Path:DictionaryPlus,Node_Liste:DictionaryPlus):void
			{
				//Si le noeud examin� est le noeud final, on a un nouveau chemin : l'enregistrer en m�moire.
				if(Node==Terrain.EndNode)
					All_Possible_Path.push(Path);
				else
				{
	// 				Puis on regarde chaque arete du noeud et on teste r�cursivement.
					for each(var Arete:Arc in Node.Liens)
					{
						var AutreExtremite:Noeud=Arete.Sommet(Node);//R�cup�re le noeud � l'autre bout du lien.

						if(!Path.Contains(Arete) && !Node_Liste.Contains(AutreExtremite) && !ForbiddenEdge.Contains(Arete))
						{
							var CopiePath:DictionaryPlus=Path.Clone();
							CopiePath[Arete]=true;
							var CopieNode:DictionaryPlus=Node_Liste.Clone();
							CopieNode[AutreExtremite]=true;
							PathFind(AutreExtremite,CopiePath,CopieNode)
						}
					}
				}
			}
			var Node_Liste:DictionaryPlus=new DictionaryPlus();
			Node_Liste[Terrain.StartNode]=true;
			PathFind(Terrain.StartNode,new DictionaryPlus(),Node_Liste);

			//A ce point, le tableau All_Possible_Path est plein et contient l'ensemble des chemins que l'on peut emprunter pour se rendre du d�part � l'arriv�e.

			function SizeOf(Item:DictionaryPlus):Number
			{//Renvoie le nombre minimal d'ar�tes � allumer pour terminer le chemin :
				var Jouees:int=0;
				var Total:int=0;
				for(var Arete:* in Item)
				{
					if(Arete.PlayedByShort)
						Jouees++;
					Total++;
				}
				var DeltaS:int=Total-Jouees;
				if(DeltaS>1)
					return DeltaS;
				else
					return 0.001;
			}

			//On initialise la r�ponse :
			var Poids:DictionaryPlus=new DictionaryPlus();
			var Taille:int=this.Terrain.initialAll_Lienslength;
			for each(Edge in Terrain.All_Liens)
				Poids[Edge]=0;

			//On va maintenant compter combien de fois chaque arete est pr�sente :
			for each(var Path:DictionaryPlus in All_Possible_Path)
			{
				if(this.Smart)
					Taille=Math.pow(SizeOf(Path),2);//Selon l'intelligence, on n'utilise pas la m�me loi de calcul.
				else
					Taille=SizeOf(Path);
				for(var Arete:* in Path)
				{
					if(!Arete.PlayedByShort)
						Poids[Arete] +=1/Taille;
				}
			}
			return Poids;
		}
	}
}