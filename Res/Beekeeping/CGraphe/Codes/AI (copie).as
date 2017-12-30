package
{
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;

	import flash.geom.Point;


	public class AI extends Player
	{
		public const IsHuman:Boolean=false;

		public function AI(Jeu:Game,Joueur:int)
		{
			this.Jeu = Jeu;
			this.Terrain = Jeu.Terrain;
			this.Joueur=Joueur;
		}

		public function Jouer():void
		{
			Tour_Termine=false;
			var Aretes_Ponderees:Array=this.getPonderedEdges();
			var Taille:int=Aretes_Ponderees.length;
			var BestEdges:int=-1;
			var BestEdgesCoeff:Number=-1;
			var BestNbOccurences:int=100;

			for(var i:int=0;i<Taille;i++)
			{
				if(BestEdgesCoeff<=Aretes_Ponderees[i])
				{
					BestEdges=i;
					BestEdgesCoeff=Aretes_Ponderees[i];
				}
				if(Aretes_Ponderees[i]!=0)
					this.Terrain.All_Liens[i].Caption=Math.round(Aretes_Ponderees[i]*100)/100;
			}
			JouerArete(this.Terrain.All_Liens[BestEdges]);
		}

		//Fonctions privées

		private function getPonderedEdges():Array
		{//Cette fonction renvoie la liste des arêtes triées par ordre d'importance...selon un pseudo-pathfinding.
			var All_Possible_Path:Array=new Array();

			function PathFind(Node:Noeud,Path:ArrayPlus,Node_Liste:DictionaryPlus):void
			{
				//Si le noeud examiné est le noeud final, on a un nouveau chemin : l'enregistrer en mémoire.
				if(Node==Terrain.EndNode)
					All_Possible_Path.push(Path);
				else
				{
	// 				Puis on regarde chaque arete du noeud et on teste récursivement.
					for each(var Arete:Arc in Node.Liens)
					{
						var AutreExtremite:Noeud;
						if(Arete.Extremites[0]==Node)
							AutreExtremite=Arete.Extremites[1];
						else
							AutreExtremite=Arete.Extremites[0];

						if(!Path.Contains(Arete) && !Node_Liste.Contains(AutreExtremite))
						{
							var CopiePath:ArrayPlus=Path.Clone();
							CopiePath.push(Arete);
							var CopieNode:DictionaryPlus=Node_Liste.Clone();
							CopieNode[AutreExtremite]=true;
							PathFind(AutreExtremite,CopiePath,CopieNode)
						}
					}
				}
			}
			var Node_Liste:DictionaryPlus=new DictionaryPlus();
			Node_Liste[Terrain.StartNode]=true;
			PathFind(Terrain.StartNode,new ArrayPlus(),Node_Liste);

			//A ce point, le tableau All_Possible_Path est plein et contient l'ensemble des chemins que l'on peut emprunter pour se rendre du départ à l'arrivée.

			function SizeOf(Item:ArrayPlus):Number
			{//Renvoie le nombre minimal d'arêtes à allumer pour terminer le chemin :
				var Jouees:int=0;
				for each(var Arete:Arc in Item)
				{
					if(Arete.PlayedByShort)
						Jouees++;
				}
				var DeltaS:int=Item.length-Jouees
				if(DeltaS>1)
					return DeltaS;
				else
					return 0.1;
			}

			//On initialise la réponse :
			var Poids:Array=new Array();
			var Taille:int=this.Terrain.All_Liens.length;
			for(var i:int=0;i<Taille;i++)
				Poids[i]=0;

			//On va maintenant compter combien de fois chaque arete est présente :
			for each(var Path:ArrayPlus in All_Possible_Path)
			{
				Taille=SizeOf(Path);
				for each(var Arete:Arc in Path)
				{
					if(!Arete.PlayedByShort)
						Poids[Arete.ID] +=1/Taille;
				}
			}

			//On pourrait renvoyer les résults maintenant, mais on va d'abord édulcorer en supprimant les aretes "inutiles" : un noeud qui n'a que deux arêtes, les deux aretes ne pointant pas vers la même extremité. Aucun des joueurs n'a interet à utiliser cette structure.
			return Poids;
		}
	}
}