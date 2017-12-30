package 
{
	import flash.display.Bitmap;
	import flash.display.BitmapData;
	import flash.display.Shape;
	import flash.display.Sprite;
	import flash.filters.BevelFilter;
	import flash.geom.ColorTransform;
	import flash.geom.Matrix;
	import flash.geom.Rectangle;
	
	/**
	 * Dessine une corde.
	 * @author Neamar
	 */
	public class Rope extends Bitmap
	{
		[Embed(source = "../assets/Corde.png")]
		private static var Corde:Class;
		private static var Texture:Bitmap = new Corde();
		private static const Biseau:Array = new Array(new BevelFilter(2),new BevelFilter(2,-45));
			
		private static var lastPoint:Point;
		
		private var Datas:BitmapData = new BitmapData(Main.WIDTH, Main.HEIGHT,true, 0x00000000);
		
		private var Drawer:Shape = new Shape();
		private var Transform:Matrix = new Matrix();
		public var OK:ColorTransform = new ColorTransform();
		public var Erreur:ColorTransform = new ColorTransform(2);
		
		public var Etat:ColorTransform = OK;
		
		/**
		 * Méthode de convenance pour simplifier les accès et les rendre similaires aux DisplayObject
		 * Permet e retourner facilement à une corde Spritée si nécessaire.
		 */
		public var graphics:Rope;
		
		public function Rope()
		{
			super(Datas);
			graphics = this;
			this.filters = Biseau;
		}
		
		public function clear():void
		{
			Datas.fillRect(new Rectangle(0, 0, Datas.width, Datas.height), 0x00000000);
		}
		
		public function moveTo(P:Point):void
		{
			lastPoint = P;
		}
		
		public function lineTo(P:Point):void
		{
			//Dessiner sur le shape une forme verticale de la bonne taille
			Drawer.graphics.clear();
			Drawer.graphics.beginBitmapFill(Texture.bitmapData);
			Drawer.graphics.drawRect(0,-2, Point.getDistance(lastPoint,P),4);
			Drawer.graphics.endFill();
			
			Transform.identity();
			Transform.rotate(Point.getDirectAngle(lastPoint, P));
			Transform.translate(lastPoint.x, lastPoint.y);
			Datas.draw(Drawer, Transform,Etat,null,null,true);
			
			moveTo(P);
		}
	
	}
	
}