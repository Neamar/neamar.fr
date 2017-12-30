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
	 * Un labyrinthe qui tourne
	 * @author Neamar
	 */
	public class Level_19 extends LabyLevel
	{
		public function Level_19(Depart:Point, Arrivee:Point=null)
		{
			Arrivee = new Point(320, 240);
			super(Depart,Arrivee);
			
			this.Arrivee.scaleX = this.Arrivee.scaleY = .5;
		}
		
	}
	
}