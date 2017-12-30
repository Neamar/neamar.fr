package Niveaux
{
	import flash.display.Bitmap;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.geom.Point;
	import flash.ui.Mouse;
	import Niveaux.Level;
	
	/**
	 * Inversion des coordonnées x et y
	 * @author Neamar
	 */
	public class Level_9 extends SpecialCursor
	{	
		public function Level_9(Depart:Point, Arrivee:Point=null)
		{
			Arrivee = new Point(320,30);
			super(Depart, Arrivee);
		}

		protected final override function majCoordonneesSouris(e:MouseEvent):void
		{
			//Inverser X et Y
			CurseurVirtuel.x = 640/480 *e.stageY;
			CurseurVirtuel.y = 480/640 *e.stageX;
			
			super.majCoordonneesSouris(e);
		}
	}
	
}