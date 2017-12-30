package Web
{
	import flash.display.Shape;
	import flash.display.Sprite;
	
	/**
	 * Dessine une forme entourant tous les points contenus dans la tableau statique Point.Points
	 * Utilise l'agorithme dit "de la marche de Jarvis" ou "du papier cadeau".
	 * @author Neamar
	 */
	public class HookManager extends Sprite 
	{
		public static var WILL_DRAW:String = "willDraw";
		/**
		 * Liste des accroches par lequel passe le fil.
		 * Structure de l'objet :
		 * .Point : le point d'accroche
		 * .Angle : l'angle d'arrivée
		 * .Sens : +1 ou -1 selon le sens d'arrivée de l'angle.
		 */
		private var Hooks:Vector.<Hook> = new Vector.<Hook>();
		
		/**
		 * Liste des points disponibles
		 */		
		protected var Points:Vector.<Point> = new Vector.<Point>();
		
		/**
		 * La corde des points déjà accrochés par un hook.
		 */
		protected var Corde:Rope = new Rope();
		
		public function HookManager(Points:Vector.<Point>)
		{
			this.Points = Points;
			
			addChild(Corde);
		}
		
		public function destroy():void
		{
			Hooks = null;
		}
		
		/**
		 * Ajoute un nouveau point d'accroche.
		 * @param	P le point d'accroche
		 * @param	Angle l'angle sur lequel le fil s'est enroulé
		 * @param	Sens dans quel sens le fil s'est enrolé (-1 ou +1)
		 */
		protected function addHook(P:Point, Angle:Number, Sens:int):void
		{
			Hooks.push(new Hook(P, Angle, Sens));
			
			//Dessiner l'emplacement sur lequel on interceptera les évenements souris.
			this.graphics.clear();
			this.graphics.beginFill(0x000000,.001);
			this.graphics.drawRect(0, 0, Main.WIDTH,Main.HEIGHT);
			this.graphics.endFill();
			
			//Redessiner la forme
			drawShape();
		}
		
		/**
		 * Supprimer le dernier hook.
		 * Cette fonction ne fait rien si on tente de supprimer le dernier hameçon.
		 * @return true si la suppression a été effectuée.
		 */
		protected function removeHook():Boolean
		{
			if (Hooks.length > 1)
			{
				Hooks.pop();
				//Redessiner la forme
				drawShape();
				return true;
			}
			else
				return false;
		}
		
		/**
		 * Récupérer le dernier hameçon planté.
		 * Contrat : le premier hook a été correctement placé.
		 * @return le dernier élément enregistré.
		 * 
		 */
		protected function getHook():Hook
		{
			return Hooks[Hooks.length-1];
		}
		
		protected function getHooksLength():int
		{
			return Hooks.length;
		}
		
		/**
		 * Dessine une forme passant par les points spécifiés dans le tableau Enveloppe.
		 */
		protected final function drawShape():void
		{		
			Corde.clear();
			
			if (Hooks.length == 0)
				return;

			var P:Point = Hooks[0].P;
			Corde.moveTo(P);
			
			for each(var A:Hook in Hooks)
			{
				//Permettre la modification des couleurs si quelqu'un veut listener la dessus.
				var E:CustomEvent = new CustomEvent(HookManager.WILL_DRAW);
				E.drawer = Corde;
				E.From = P;
				E.To = A.P;
				if(E.From != E.To)
					dispatchEvent(E);
				P = A.P;
				
				Corde.lineTo(P);
			}
			
			this.graphics.lineStyle(3, 0xbd9969,.8);
		}
	}
}

