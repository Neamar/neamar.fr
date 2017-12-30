package Niveaux
{
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.geom.Point;
	import Niveaux.Level;
	
	/**
	 * Des anneaux qui tournent sans changer de taille.
	 * @author Neamar
	 */
	public class Level_13 extends HitLevel
	{
		private var Anneaux:Array = new Array();
		private const NB_ANNEAUX:int = 5;
		
		public function Level_13(Depart:Point, Arrivee:Point=null)
		{
			Arrivee = new Point(320,240);
			
			super(Depart, Arrivee);
			
			for (var i:int = 0; i < NB_ANNEAUX; i++)
			{
				var Anneau:Ring = new Ring(320, 240, 50 +  200 * (i / NB_ANNEAUX));
				Anneau.rotation = 360 * (i / NB_ANNEAUX);
				Obstacles.addChild(Anneau);
				Anneaux.push(Anneau);
			}
			
			addEventListener(Event.ENTER_FRAME, rotationAnneaux)
		}


		public final override function destroy():void
		{
			removeEventListener(Event.ENTER_FRAME, rotationAnneaux);
			for each(var Anneau:Ring in Anneaux)
				Anneau.destroy();
			super.destroy();
		}
		
		protected final function rotationAnneaux(e:Event):void
		{			
			for (var i:int = 0; i < NB_ANNEAUX; i++)
			{
				(Anneaux[i] as Ring).tournerVersRelatif(2 * Math.pow( -1, i));
			}
		}
	}
	
}