package Web
{
	import flash.display.Shape;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	
	/**
	 * Permet la gestion de l'accroche / décroche d'un fil à l'aide des méthodes fournies par HookManager.
	 * Utilise un dérivé de l'agorithme dit "de la marche de Jarvis" ou "du papier cadeau".
	 * Triggere des évenements lors de l'accroche et de la décroche.
	 * @author Neamar
	 */
	public class Eulris extends HookManager
	{
		public static const FIRST_HOOK_ADDED:String = "firstHookAdded";
		public static const HOOK_ADDED:String = "hookAdded";
		public static const HOOK_REMOVED:String = "hookRemoved";
		
		private var Araignee:Point = new Point(mouseX, mouseY);
		private var BoutCorde:Rope = new Rope();
		private var Angles:Vector.<Position> = null;
		
		private var DernierAngle:Number = 0;
		private var DerniereDistance:Number = 0;
		
		public function Eulris(Points:Vector.<Point>)
		{
			super(Points);
			
			//Laisser l'utilisateur choisir le point initial
			for each(var P:Point in Points)
			{
				P.mouseEnabled = true;
				P.addEventListener(MouseEvent.CLICK, addFirstHook);
				addChild(P);
			}
			
			//Ajouter le bout de corde, masquer l'araignée et un peu d'ombre.
			addChild(BoutCorde);
			setChildIndex(BoutCorde, 0);
			setChildIndex(Corde, 0);
			Araignee.visible = false;
			this.filters = Main.Ombre;
			
		}
		
		/**
		 * Détruit l'objet, libère la mémoire (du moins, dans la limite autorisée par Flash) et rend la main.
		 */
		public final override function destroy():void
		{
			//Nettoyage des objets graphiques.
			Araignee.graphics.clear();
			graphics.clear();
			while (numChildren != 0)
				removeChildAt(0);
			
			//Suppression des listeners :
			for each(var P:Point in Points)
				P.removeEventListener(MouseEvent.CLICK, addFirstHook);
			removeEventListener(MouseEvent.MOUSE_MOVE, moveAraignee);
			
			//Mise à null de tout le monde pour avoir des erreurs si l'objet continue d'être utilisé.
			Araignee = null;
			Angles = null;
			
			//Puis destruction du super :
			super.destroy();
		}
		
		/**
		 * Une fois le noeud choisi, démarrer le parcours avec l'araignée.
		 * @param	e On se sert uniquement de e.target
		 */
		public function addFirstHook(e:MouseEvent):void
		{
				
			//Supprimer les listeners et réduire les noeuds.
			for each(var P:Point in Points)
			{
				P.removeEventListener(MouseEvent.CLICK, addFirstHook);
				P.mouseEnabled = false;
			}
			
			//Créer le premier hameçon (indécrochable, donc l'angle n'est pas important) :
			addHook(e.target as Point, 0, 0);
			Araignee.x = mouseX;
			Araignee.y = mouseY;
			Araignee.mouseEnabled = false;
			DernierAngle = Point.getAngle(getHook().P, Araignee);
			DerniereDistance = Point.getDistance(getHook().P, Araignee);

			addEventListener(MouseEvent.MOUSE_MOVE, moveAraignee);
			
			var E:CustomEvent = new CustomEvent(FIRST_HOOK_ADDED);
			E.newHook = getHook();
			dispatchEvent(E);
		}
		
		/**
		 * Déconnecte la souris du niveau, précurseur de la destruction...
		 */
		public function disconnect():void
		{
			Araignee.graphics.clear();
			removeEventListener(MouseEvent.MOUSE_MOVE, moveAraignee);
		}
		
		/**
		 * Met à jour la position de l'araignée en cas de déplacement souris.
		 * Calcule s'il faut accrocher le noeud à 'autres endroits.
		 * Ou le décrocher.
		 * Puis met à jour la toile.
		 * @param	e
		 */
		private function moveAraignee(e:MouseEvent):void
		{

			//Déplacer l'araignée
			Araignee.x = e.localX;
			Araignee.y = e.localY;

			//Variables utiles aux calculs qui vont suivre
			var DernierHook:Hook;
			var AngleActuel:Number;
			var AngleMin:Number;
			var AngleMax:Number;
			var Distance:Number;
			var Sens:int;//Sens trigo // anti trigo
			
			/**
			 * Calculer les variables nécessaires aux calculs.
			 */
			function computeProperties():void
			{
				DernierHook = getHook();
				AngleActuel = Point.getAngle(DernierHook.P, Araignee);
				AngleMin = Math.min(AngleActuel, DernierAngle);
				AngleMax = Math.max(AngleActuel, DernierAngle);
				Distance = Point.getDistance(DernierHook.P, Araignee);
				Sens = (AngleActuel > DernierAngle)?1: -1;//Sens trigo // anti trigo
				
				if (AngleMax > 5 && AngleMin < 1)
				{
					//On a tourné autour du cercle, il faut inverser les min et max et modifier l'angleMin pour ne pas avoir un saut de 2PI.
					var Swap:Number = AngleMax;
					AngleMax = AngleMin;
					AngleMin = Swap - 2 * Math.PI;
					Sens = -Sens;
				}
			}
			
			computeProperties();


			
			//Si les distances sont trop grandes, y a un problème (sortie de la souris par exemple) et on ne prend pas en compte le mouvement.
			if (Math.abs(DerniereDistance-Distance) < 100)
			{
				//Faut-il ajouter un hook ?
				//Liste des hameçons ajoutés sur cette itération, pour ne pas ajouter à l'infini (si on déplace très vite la souris) :
				var Ajoutes:Vector.<Point> = new Vector.<Point>();
				
				//Faire une boucle for pour faire un reset facile du tableau en cas d'jaout de Hameçons. Foreach agit sur une référence :\
				for (var i:int = 0; i < Angles.length;i++)
				{
					var Item:Position = Angles[i];
					
					if (Item.P != DernierHook.P && Item.Distance <= Distance && Item.Angle >= AngleMin && Item.Angle <= AngleMax && Ajoutes.indexOf(Item.P)==-1)
					{
						//On a trouvé un hameçon ! L'enregistrer et mettre à jour le dernierHook
						addHook(Item.P, Item.Angle, Sens);
						
						Ajoutes.push(Item.P);
						
						//Si l'ajout du hook a entraîné la victoire du niveau et sa destruction, stopper.
						if (Araignee == null)
							return;
						
						//Remettre à jour les variables.
						i = 0;
						computeProperties();
					}
				}
				
				//Faut-il enlever un hook ?
				while(DernierHook.Sens != Sens && DernierHook.Angle >=AngleMin && DernierHook.Angle<=AngleMax)
				{
					if(removeHook())
						{DernierHook.P.scaleY = 1; DernierHook = getHook(); }
					else
						break;
				}
			}
			
			//Enregistrer et dessiner.
			DernierAngle = AngleActuel;
			DerniereDistance = Distance;
			
			BoutCorde.clear();
			//BoutCorde.graphics.lineStyle(3, 0xbd9969,.8);
			BoutCorde.moveTo(DernierHook.P);
			BoutCorde.lineTo(Araignee);
		}
		
		/**
		 * Mettre à jour les positions des angles lors de l'ajout d'une accroche.
		 */
		protected override final function addHook(P:Point, Angle:Number, Sens:int):void
		{
			//Le dispatch de l'event renverra le dernier hook :
			var E:CustomEvent = new CustomEvent(HOOK_ADDED);
			if(getHooksLength()>0)
				E.lastHook = getHook();
			super.addHook(P, Angle, Sens);
			
			
			updateAngles();
			
			E.newHook = getHook();
			//Ne dispatcher l'event que si on a au moins deux hooks
			if(getHooksLength()>1)
				dispatchEvent(E);
			
			//Redessiner la forme. On le fait une deuxième fois (ça a déjà était fait dans le super) pour prendre en compte les modifications du dernier dispatchEvent.
			drawShape()
		}
		
		/**
		 * Mettre à jour la position des angles lors de l'ajout d'une accroche
		 */
		protected override final function removeHook():Boolean
		{
			var E:CustomEvent = new CustomEvent(HOOK_REMOVED);
			E.lastHook = getHook();
				
			var B:Boolean = super.removeHook();
			updateAngles();
			
			E.newHook = getHook();
			//Ne dispatcher l'event que si il y a bien eu modification
			if(B)
				dispatchEvent(E);
			
			//Redessiner la forme. On le fait une deuxième fois (ça a déjà était fait dans le super) pour prendre en compte les modifications du dernier dispatchEvent.
			drawShape()
			
			return B;
		}
		
		/**
		 * Calculer les angles de chaque noeud par rapport à l'accroche courante.
		 */
		private function updateAngles():void
		{
			Angles = new Vector.<Position>();
			var Accroche:Point = getHook().P;
			for each(var P:Point in Points)
			{
				Angles.push(new Position(P, Point.getAngle(Accroche, P), Point.getDistance(P,Accroche)));
			}
			
			Angles.sort(sortAngle);
		}
		
		private function sortAngle(A:Position, B:Position):Number
		{
			if (A.Distance < B.Distance)
				return -1;
			else if (A.Distance > B.Distance)
				return 1;
			else
				return 0;
		}
	}
}

/**
 * Classe Helper pour stocker les angles dans une structure facile d'accès.
 */
class Position
{
	public var P:Point;
	public var Angle:Number;
	public var Distance:Number;
	
	/**
	 * 
	 * @param	P le point concerné
	 * @param	Angle l'angle que fait le point avec le point d'accroche courant
	 * @param	Distance la distance entre P et le point d'accroche courant.
	 */
	public function Position(P:Point, Angle:Number, Distance:Number)
	{
		this.P = P;
		this.Angle = Angle;
		this.Distance = Distance;
	}
	
	public function toString():String
	{
		return "[" + Math.round(Distance) + "," + Angle + "]";
	}
}