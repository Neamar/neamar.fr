package 
{
	import flash.display.Shape;
	import flash.filters.BevelFilter;
	import flash.geom.ColorTransform;
	
	/**
	 * Dessine une corde.
	 * @author Neamar
	 */
	public class Rope extends Shape
	{
		private static const Biseau:Array = new Array(new BevelFilter(2));
		public const OK:int = 0xca913d;
		public const Erreur:int = 0xbd0000;
		
		public var Etat:int = OK;
		
		public function Rope()
		{
			this.filters = Biseau;
		}
		
		public function clear():void
		{
			graphics.clear();
		}
		
		public function moveTo(P:Point):void
		{
			graphics.moveTo(P.x, P.y);
		}
		
		public function lineTo(P:Point):void
		{
			graphics.lineStyle(3, Etat,.8);
			graphics.lineTo(P.x, P.y);
		}
	
	}
	
}