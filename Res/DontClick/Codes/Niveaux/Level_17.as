package Niveaux
{
	import com.greensock.TweenMax;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.geom.Point;
	import Niveaux.Level;
	
	/**
	 * Des anneaux qui tournent et se réduisent.
	 * @author Neamar
	 */
	public class Level_17 extends HitLevel
	{
		private var Anneaux:Array = new Array();
		
		private var FrameID:int = 0;
		
		public function Level_17(Depart:Point,Arrivee:Point=null)
		{
			Arrivee = new Point(30,30);
			super(Depart, Arrivee);
			
			for (var i:int = 2; i <= 5; i++)
			{
				var Anneau:Ring = new Ring(0, 0, 100*i);
				Anneau.x = 320;
				Anneau.y = 240;
				Obstacles.addChild(Anneau);
				TweenMax.to(Anneau, 2*i, { scaleX:0, scaleY:0, rotation:360*Math.random(), onComplete:enleverAnneau } );
				Anneaux.push(Anneau)
			}
			
			addEventListener(Event.ENTER_FRAME, ajouterAnneau);
		}
		
		public final override function destroy():void
		{
			removeEventListener(Event.ENTER_FRAME, ajouterAnneau);
			for each(var Anneau:Ring in Anneaux)
				Anneau.destroy();
			super.destroy();
		}
		
		public function ajouterAnneau(e:Event):void
		{
			if (FrameID % 20 == 0)
			{
				var Anneau:Ring = new Ring(0, 0, 600);
				Anneau.x = 320;
				Anneau.y = 240;
				Obstacles.addChild(Anneau);
				TweenMax.to(Anneau, 12, { scaleX:0, scaleY:0, shortRotation:{rotation:360*Math.random()}, onComplete:enleverAnneau } );
				Anneaux.push(Anneau);
			}
			
			FrameID++;
		}
		
		private function enleverAnneau():void
		{
			(Anneaux.shift() as Ring).destroy();
		}
	}
	
}