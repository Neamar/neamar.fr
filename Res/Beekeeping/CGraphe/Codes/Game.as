//Une partie : contient donc les joueurs, le terrain, le bruit en arrière plan...
package
{
	import flash.display.Sprite;
	import flash.events.Event;


	public class Game extends Sprite //On doit le faire extends sprite pour pouvoir bénéficier des listeners.
	{
		public var Terrain:Land;
		public var Termine:Boolean=false;
		public var Gagnant:Player;
		public var NumeroNiveau:int=-1;
		public var CallBack:Function;
		public var Officiel:Boolean=true;//True par défaut, mis à false si chargé depuis level perso.

		private var Short:Player;
		private var Cut:Player;
		private var Joueur_Actuel:int=-1;
		private  var Tour:Array;



		public function Game(FirstPlayer:int,Short_Type:int,Cut_Type:int,Datas:String,Passif:Boolean=false,AI_Is_Smart:Boolean=true)
		{
			//L'initialisation du jeu. Rien de bien compliqué...
			this.Terrain=new Land(Datas,this);
			this.Terrain.Texte="INITIALISATION..."
			switch (Short_Type)
			{
			case Const.HUMAN: Short=new Human(this,Const.SHORT); break;
			case Const.COMPUTER: Short=new AI(this,Const.SHORT,AI_Is_Smart); break;
			case Const.INTERNET: Short=new OnlinePlayer(this,Const.SHORT); break;
			}
			switch (Cut_Type)
			{
			case Const.HUMAN: Cut=new Human(this,Const.CUT); break;
			case Const.COMPUTER: Cut=new AI(this,Const.CUT,AI_Is_Smart); break;
			case Const.INTERNET: Cut=new OnlinePlayer(this,Const.CUT); break;
			}

			this.Tour=new Array(Short,Cut);
			if(FirstPlayer==Const.CUT)
				this.Tour.reverse();

			if(!Passif)
			{
				Short.Initialiser(Fin_Initialisation);
				Cut.Initialiser(Fin_Initialisation);//Attendre que les deux joueurs soient prêts.
			}
			else
			{
				this.Terrain.StopBackGround();
				this.Terrain.PremierPlan.filters=new Array();
			}

		}

		public function Fin_Initialisation():void
		{
			if(Short.Pret && Cut.Pret)
			{
					this.Terrain.graphics.clear();
					Lancer_tour();
			}
		}

		private function Lancer_tour():void
		{
			this.removeEventListener(Event.ENTER_FRAME,TestFinTour);
			Joueur_Actuel = (Joueur_Actuel+1)%2;
			this.Tour[Joueur_Actuel].Jouer();
			this.addEventListener(Event.ENTER_FRAME,TestFinTour);

			if(this.Tour[Joueur_Actuel].Joueur==Const.SHORT)
				this.Terrain.Texte="Tour actuel : <strong>Paintre</strong>";
			else
				this.Terrain.Texte="Tour actuel : <strong>Couhpeur</strong>";
		}

		private function TestFinTour(e:Event):void
		{
			if(this.Tour[Joueur_Actuel].Tour_Termine)
			{
				this.Tour[Joueur_Actuel].Fin_Tour();
				if(TestVictoire())
				{
					this.CallBack.call(this);
					if(this.Tour[Joueur_Actuel].Joueur==Const.SHORT)
						this.Terrain.Texte="Fin de la partie, gagnant : <strong>Paintre</strong>";
					else
						this.Terrain.Texte="Fin de la partie, gagnant : <strong>Couhpeur</strong>";
					this.removeEventListener(Event.ENTER_FRAME,TestFinTour);
				}
				else
					Lancer_tour();
			}
		}

		private function TestVictoire():Boolean
		{
			var Resultat:Boolean=false;
			var CorrectPath:ArrayPlus=new ArrayPlus();
			//Teste si le jeu est terminé.
			//Le jeu est déterministe, c'est à dire qu'il y a forcément un gagnant(il ne peut pas y avoir d'égalité).

			//Teste si Short a gagné : (I.e il existe un chemin entièrement coloré)
			if(TesteShort())
			{
				this.Gagnant=Short;
				return true;
			}

			//Teste si Cut a gagné : (I.e il n'existe aucun chemin entre le départ et l'arivée)
			if(TesteCut())
			{
				this.Gagnant=Cut;
				return true;
			}

			return false;

			//Fin de la fonction....
		}

		private function TesteShort():Boolean
		{//true si short a gagné
			var CheminExiste:Boolean=false;
			function Short_PathFinde(Node:Noeud,Path:ArrayPlus):void
			{
				//Si le noeud examiné est le noeud final, on a gagné :)
				if(Node==Terrain.EndNode)
					CheminExiste=true;

				if(CheminExiste!=true)
				{//Sinon, on regarde chaque arete du noeud et on teste récursivement.d
					for each(var Arete:Arc in Node.Liens)
					{
						if(Arete.PlayedByShort && !Path.Contains(Arete))
						{
							var CopiePath:ArrayPlus=Path.Clone();
							CopiePath.push(Arete);
							if(Arete.Extremites[0]==Node)
								Short_PathFinde(Arete.Extremites[1],CopiePath)
							else
								Short_PathFinde(Arete.Extremites[0],CopiePath)
						}
					}
				}
			}
			Short_PathFinde(this.Terrain.StartNode,new ArrayPlus());
			return CheminExiste;
		}
		private function TesteCut():Boolean
		{//true si cut a gagné
			var CheminExiste:Boolean=false;
			function Cut_PathFinde(Node:Noeud,Path:DictionaryPlus,Node_Liste:DictionaryPlus):void
			{
				//Si le noeud examiné est le noeud final, on a pas encore gagné :) (il existe un chemin entre le départ et l'arrivée)
				if(Node==Terrain.EndNode)
					CheminExiste=true;
				else if(CheminExiste==false)
				{//Sinon, on regarde chaque arete du noeud et on teste récursivement.
					for each(var Arete:Arc in Node.Liens)
					{
						var AutreExtremite:Noeud;
						if(Arete.Extremites[0]==Node)
							AutreExtremite=Arete.Extremites[1];
						else
							AutreExtremite=Arete.Extremites[0];
						if(!Path.Contains(Arete) && !Node_Liste.Contains(AutreExtremite))
						{
							var CopiePath:DictionaryPlus=Path.Clone();
							CopiePath[Arete]=true;
							var CopieNode:DictionaryPlus=Node_Liste.Clone();
							CopieNode[AutreExtremite]=true;
							Cut_PathFinde(AutreExtremite,CopiePath,CopieNode);
						}
					}
				}
			}
			var Node_Liste:DictionaryPlus=new DictionaryPlus();
			Node_Liste[Terrain.StartNode]=true;
			Cut_PathFinde(this.Terrain.StartNode,new DictionaryPlus(),Node_Liste);
			return !CheminExiste;
		}
	}
}