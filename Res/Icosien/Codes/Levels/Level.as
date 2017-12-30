package Levels
{
	import com.greensock.TweenLite;
	import flash.display.Shape;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;//Interaction utilisateur//souris
	import flash.filters.BitmapFilter;
	import flash.utils.Dictionary;
	import Web.Eulris;
	import Web.HookManager;

	import flash.filters.GlowFilter;
	import flash.text.TextField;//Champ de texte. Classe assez vaste, utilisée uniquement pour l'affichage de texte ici. Peut être du texte au format HTML.

	/**
	 * Un niveau de jeu abstrait.
	 * Prend en paramètre le graphe au format décrit dans E-Ditor (sans points de contrôles)
	 * Exemple 0,0|100,100:0,1 crée deux noeuds (aux coordonnées 0,0 et 100,100) et place un trait entre les noeuds 0 et 1.
	 * Dispatche l'evénement LEVEL_WIN une fois le niveau gagné.
	 * Les tests de AretesInitiales se font avec la fonction abstraite checkVictory() qui est appelée à chaque ajout de noeuds sur le graphe des Hooks.
	 */
	public class Level extends Sprite
	{
		//Evénement dispatché à la fin du niveau
		public static const LEVEL_WIN:String = "levelWin";
		//Evénement dispatché si le niveau est recommencé
		public static const LEVEL_RESTART:String = "levelRestart";
		
		/**
		 * Le graphique avec les traits gris indiquant le Graphe à atteindre
		 */
		public var Graphe:Shape = new Shape();
		
		/**
		 * Liste des points définissant le niveau
		 */
		public var Points:Vector.<Point> = new Vector.<Point>();
		
		/**
		 * Graphe défini par les conditions initiales (arêtes de départ)
		 */
		public var AretesInitiales:Dictionary = new Dictionary();
		
		/**
		 * Liste des arêtes actuellements tracées. Le jeu s'arrête quand AretesInitiales == Aretes
		 */
		public var Aretes:Dictionary = new Dictionary();
		
		/**
		 * Gestion des déplacements
		 */
		public var Toile:Eulris;

		/**
		 * Initialise le niveau et les éléments graphiques qui le composent.
		 * Appelle la méthode createLevel() pour générer les données du graphe de base.
		 * @param	Datas Les données au format E-Ditor.
		 */
		public function Level(Datas:String)
		{
			
			//Cas des niveaux "directs".
			if (Datas == "")
				return;
				
			var Niv_String:String=Datas;
			var Composants:Array;
			var Part:Array=Niv_String.split(":");
			var strNoeuds_Array:Array=Part[0].split("|");
			var strArc_Array:Array=Part[1].split("|");
			var Noeuds:Array=new Array();
			var Liens:Array=new Array();
			for each(var Node:String in strNoeuds_Array)
			{
				Composants=Node.split(",");
				Noeuds.push(Composants);
			}
			for each(var Arete:String in strArc_Array)
			{
				Composants=Arete.split(",");
				Liens.push(Composants);
			}

			createLevel(Noeuds, Liens);

			addEventListener(Event.REMOVED_FROM_STAGE, destroy);
		}
		
		/**
		 * Détruit le niveau et le rend inutilisable !
		 */
		public function destroy(e:Event=null):void
		{
			//Nettoyage des objets graphiques.
			Graphe.graphics.clear();
			graphics.clear();
			Toile.destroy();
			while (numChildren != 0)
				removeChildAt(0);
			
			//Suppression des listeneres :
			removeEventListener(Event.REMOVED_FROM_STAGE, destroy);			
			Toile.removeEventListener(Eulris.FIRST_HOOK_ADDED, firstHookAdded);
			Toile.removeEventListener(Eulris.HOOK_ADDED, hookAdded);
			Toile.removeEventListener(Eulris.HOOK_REMOVED, hookRemoved);
			Toile.removeEventListener(MouseEvent.DOUBLE_CLICK, restart);
			
			//Mise à null de tout le monde
			Points = null;
			Aretes = AretesInitiales = null;
			Toile = null;
			Graphe = null;
		}
		
		/**
		 * Recommence le niveau.
		 * @param	e
		 */
		public function restart(e:Event = null):void
		{
			initEulris();
		}

		/**
		 * Créer le niveau en insérant dans le bon ordre les noeuds
		 * @param	Noeuds La liste des noeuds au format <x,y>
		 * @param	Liens La liste des arêtes au format <noeud1,noeud2>
		 */
		private function createLevel(Noeuds:Array,Liens:Array):void
		{
			addChild(Graphe);
			setChildIndex(Graphe, 0);
			
			//Le numéro du noeud.
			var i:int = 0;
			for each(var Arr_Noeud:Array in Noeuds)
			{
				Points.push(new Point(Arr_Noeud[0], Arr_Noeud[1],i));
				AretesInitiales[Points[Points.length-1]] = new Vector.<Point>();
				Aretes[Points[Points.length - 1]] = new Vector.<Point>();
				i++
			}
			
			initEulris();
			
			Graphe.graphics.clear();
			Graphe.graphics.lineStyle(1, 0xDDDDDD);
			Graphe.filters = Background.Instance.Deplacement;
			
			//Dessin de l'image de fond.
			for each(var Arr_Lien:Array in Liens)
			{
				//Dessiner les traits gris désignants l'Graphe
				Graphe.graphics.moveTo(Points[Arr_Lien[0]].x, Points[Arr_Lien[0]].y);
				Graphe.graphics.lineTo(Points[Arr_Lien[1]].x, Points[Arr_Lien[1]].y);
				
				//Contrôle des redondances.
				if (AretesInitiales[Points[Arr_Lien[0]]].indexOf(Points[Arr_Lien[1]]) != -1)
					throw new Error("Niveau mal formé (" + Arr_Lien[0] + "," + Arr_Lien[1] + ").");
				
				//Et enregistrer l'état à atteindre pour la AretesInitiales :
				AretesInitiales[Points[Arr_Lien[0]]].push(Points[Arr_Lien[1]])
				AretesInitiales[Points[Arr_Lien[1]]].push(Points[Arr_Lien[0]])
			}
			
			//Un peu d'optimisation, la figure est quand même relativement complexe (surtout son filtre)
			Graphe.cacheAsBitmap = true;
		}
		
		/**
		 * Exporte la matrice d'adjacence du graphe.
		 * @return la matrice, séparée par des " " et des \n.
		 */
		public function exportAdjacencyMatrix():String
		{
			var O:String = "";
			for each(var P:Point in Points)
			{
				for each(var P2:Point in Points)
					O += " " + (AretesInitiales[P].indexOf(P2) == -1?0:1);
				O += "\n";
			}
			return O;
		}
		
		/**
		 * Construit des données à partir d'une matrice d'adjacence.
		 * @param	Matrix la matrice
		 * @return des données suffisantes pour créer un niveau.
		 */
		public static function fromAdjacencyMatrix(Matrix:String,LigneSeparator:String="\n",ColumnSeparator:String=" "):String
		{
				var Retour:String = ":";
				var Lignes:Array = Matrix.split(LigneSeparator);
				for (var i:int = 0; i < Lignes.length;i++)
				{
					var Cellules:Array = Lignes[i].split(ColumnSeparator);
					//S'arrêter sur la diagonale, sinon on va doublonner.
					for (var j:int = 0; j < i; j++)
					{
						if (Cellules[j] == "1")
							Retour += i + "," + j + "|";
					}
				}
				return Retour;
		}
		
		/**
		 * Initialise (réinitialise) un objet Eulris pour le niveau.
		 */
		protected function initEulris(e:Event=null):void
		{
			if (Toile != null)
			{
				removeChild(Toile);
				Toile.disconnect();
				Toile.destroy();
				Toile.removeEventListener(Eulris.FIRST_HOOK_ADDED, firstHookAdded);
				Toile.removeEventListener(Eulris.HOOK_ADDED, hookAdded);
				Toile.removeEventListener(Eulris.HOOK_REMOVED, hookRemoved);
				Toile.removeEventListener(HookManager.WILL_DRAW, checkValidity);
				Toile.removeEventListener(MouseEvent.DOUBLE_CLICK, restart);
				
				
				//Réinitialiser les points parcourus pour ne pas tricher ;)
				for each(var P:Point in Points)
					Aretes[P] = new Vector.<Point>();
			}
			
			Toile = new Eulris(Points);
			Toile.doubleClickEnabled = true;
			addChild(Toile);
			Toile.addEventListener(Eulris.FIRST_HOOK_ADDED, firstHookAdded);
			Toile.addEventListener(MouseEvent.DOUBLE_CLICK, restart);
			Toile.addEventListener(HookManager.WILL_DRAW, checkValidity);
			
			setChildIndex(Toile, 1);//Au dessus de Graphe, en dessous des noeuds.
			setChildIndex(Graphe, 0);
			
			dispatchEvent(new Event(LEVEL_RESTART));
		}
		
		/**
		 * Déclenché une fois le noeud initial sélectionné.
		 * @param	e
		 */
		private function firstHookAdded(e:Event):void
		{
			Toile.removeEventListener(Eulris.FIRST_HOOK_ADDED, firstHookAdded);
			Toile.addEventListener(Eulris.HOOK_ADDED, hookAdded);
			Toile.addEventListener(Eulris.HOOK_REMOVED, hookRemoved);
		}
		
		/**
		 * Déclenché à chaque ajout d'un hook sur le graphe.
		 * 
		 * @param	e possède deux propriétés en plus d'un simple Event : lastHook:Hook et newHook:Hook
		 */
		private function hookAdded(e:CustomEvent):void
		{
			//Pour les tricheurs ; on place ici le chemin calculé par un algorithme (ici, la solution du dernier niveau)
			//Et on a une petite animation qui indique les points à relier à tout moment :)
			//ça aide :)
			//var Solution:Array = [1,15,10,26,23,2,14,22,27,9,16,20,29,7,18,31,5,11,25,24,12,13,3,6,30,19,17,32,4,21,28,8];
			//TweenLite.to(Points[Solution[Solution.indexOf(e.newHook.P.Num + 1) + 1] - 1], 1.5, { scaleX:.5 } );
			
			Aretes[e.lastHook.P].push(e.newHook.P);
			Aretes[e.newHook.P].push(e.lastHook.P);

			checkVictory();
		}
		
		/**
		 * Déclenché à chaque suppression d'un hook
		 * 
		 * @param	e possède deux propriétés en plus : lastHook:Hook et newHook:Hook
		 */
		private function hookRemoved(e:CustomEvent):void
		{
			//Supprimer les points du tableau
			Aretes[e.lastHook.P].splice(Aretes[e.lastHook.P].indexOf(e.newHook.P),1);
			Aretes[e.newHook.P].splice(Aretes[e.newHook.P].indexOf(e.lastHook.P), 1);
		}
		
		
		/**
		 * Fonction abstraite permettant de déterminer si la victoire a été obtenue ou non.
		 */
		protected function checkVictory():void
		{
			throw new Error("Appel d'une méthode abstraite.");
		}
		
		/**
		 * Fonction permettant d'interagir dynamiquement lors du rendu de la corde.
		 * Modifie les paramètres de dessin (disponibles dans e.drawer).
		 * @return true si l'arête est correcte. Utilisé pour l'héritage.
		 */
		protected function checkValidity(e:CustomEvent):Boolean
		{
			//Test arête correcte (disponible dans le graphe)
			//ET arête non en double
			if (AretesInitiales[e.From].indexOf(e.To) != -1
			&& Aretes[e.To].indexOf(e.From) == Aretes[e.To].lastIndexOf(e.From))
			{
				//e.drawer.lineStyle(3, 0xbd9969, .8);
				e.drawer.Etat = e.drawer.OK;
				return true;
			}
			else
			{
				//e.drawer.lineStyle(3, 0xbd0000, .8);//Arête INCORRECTE
				e.drawer.Etat = e.drawer.Erreur;
				return false;
			}
		}
	}
}