package Niveaux
{
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.geom.Point;
	import Niveaux.Level;
	
	/**
	 * Un niveau de jeu. Une spirale, il faut rester dans le rond qui rétércit au fur et à mesure.
	 * @author Neamar
	 */
	public class Level_6 extends HitLevel
	{
		private var Rayon:int;
		private var Angle:Number;
		
		private var Masque:Sprite;
		
		public function Level_6(Depart:Point, Arrivee:Point=null)
		{
			Rayon = Point.distance(new Point(320, 240), Depart);
			Angle = Math.atan2(Depart.y - 240, Depart.x - 320);
			
			Arrivee = new Point(320,240);
			
			super(Depart, Arrivee);
			
			Obstacles.graphics.beginFill(Main.OBSTACLE);
			Obstacles.graphics.drawCircle(0, 0, RAYON_ARRIVEE * 2);
			deplacement();
			
			setChildIndex(Obstacles, 0);

			addEventListener(Event.ENTER_FRAME, deplacement)
			
			DoitEviterObstacles = false;//Indiquer que on doit rester sur obstacles, et pas l'éviter.
		}
		
		public final override function destroy():void
		{
			removeEventListener(Event.ENTER_FRAME, deplacement);
			super.destroy();
		}
		
		private function deplacement(e:Event=null):void
		{
			Obstacles.x = 320 + Rayon * Math.cos(-Math.abs(Angle));
			Obstacles.y = 240 + Rayon * Math.sin(-Math.abs(Angle));
			
			if(Rayon>0)
				Rayon--;
				
			if(Rayon<240)
				Angle += Math.PI / 150;
			
			Obstacles.scaleX = Obstacles.scaleY = Math.max(.3,Rayon / 240);
		}
	}
	
}