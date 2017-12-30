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
	 * Un niveau de jeu. Les mouvements de la souris sont inversés.
	 * @author Neamar
	 */
	public class Level_7 extends SpecialCursor
	{
		public function Level_7(Depart:Point, Arrivee:Point=null)
		{
			Arrivee = new Point(20,20);
			super(Depart, Arrivee);
		}

		protected final override function majCoordonneesSouris(e:MouseEvent):void
		{
			//Symétrie par rapport au centre
			CurseurVirtuel.x = -(e.stageX - 320) + 320;
			CurseurVirtuel.y = -(e.stageY - 240) + 240;
			
			super.majCoordonneesSouris(e);
		}
	}
	
}