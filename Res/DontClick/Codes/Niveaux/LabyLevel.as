package Niveaux
{
	import com.greensock.TweenMax;
	import flash.display.Bitmap;
	import flash.display.DisplayObject;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.filters.BevelFilter;
	import flash.geom.Point;
	import Niveaux.Level;
	
	/**
	 * Un niveau qui utilise le labyrinthe.
	 * Initialise un sprite, le positionne et le fait tourner.
	 * @author Neamar
	 */
	public class LabyLevel extends HitLevel
	{
		[Embed(source="../../assets/Labyrinthe.svg")]
		public static var Labyrinthe:Class;
		
		protected var Revolution:int = 75;
		protected var Laby:DisplayObject = new Labyrinthe();
		
		public function LabyLevel(Depart:Point, Arrivee:Point=null)
		{
			super(Depart, Arrivee);
			Obstacles.addChild(Laby);

			Laby.x = 59 - 320;
			Laby.y = -34 - 240;
			
			Obstacles.x = 320;
			Obstacles.y = 240;
			Obstacles.rotation = 135;
			
			TweenMax.to(Obstacles, Revolution, { delay:2, rotation:360+90} );
		}
		
		public override function destroy():void
		{
			TweenMax.killTweensOf(Obstacles);
			Obstacles.removeChild(Laby);
			Laby = null;
			
			super.destroy();
		}
	}
}