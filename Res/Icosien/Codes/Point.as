package 
{
	import flash.display.Bitmap;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	
	/**
	 * Les points composant le graphe.
	 * @author Neamar
	 */
	public class Point extends Sprite 
	{
		[Embed(source = "../assets/Clou.png")]
		private static var Clou:Class;
		
		[Embed(source = "../assets/Vis.png")]
		private static var Vis:Class;
		
		public var Num:int = 0;
		
		/**
		 * Construit un nouveau point avec les coordonnées spécifiées.
		 * @param	x
		 * @param	y
		 */
		public function Point(x:Number, y:Number, Num:int=0 )
		{
			//function T(e:Event):void { trace(Num+1) }
			//addEventListener(MouseEvent.MOUSE_MOVE, T) ;
			
			this.Num = Num;
			
			
			this.x = x;
			this.y = y;
			
			//Générer l'image
			toNail();
		}
		
		/**
		 * Transformer le point en clou
		 */
		public function toNail():void
		{
			toItem(Clou);
		}
		
		/**
		 * Transformer le point en vis, le lisser.
		 */
		public function toScrew():void
		{
			toItem(Vis).smoothing = true;
		}
		
		private function toItem(Item:Class):Bitmap
		{
			if (numChildren != 0)
				(removeChildAt(0) as Bitmap).bitmapData.dispose();

			var Image:Bitmap = new Item();
			
			//Centrer le clou
			Image.x = -Image.width / 2;
			Image.y = -Image.height / 2;
			addChild(Image);
			
			return Image;
		}
		
		/**
		 * Fonction de debug
		 * @return la trace du point.
		 */
		public override function toString():String
		{
			return Num.toString();
		}
		
		
		
		/***********************
		 * FONCTIONS STATIQUES
		*/
		
		/**
		 * Calcule l'angle entre la droite formée par les deux points et l'horizontale.
		 * Valeur de retour comprise entre 0 et 2PI.
		 * Note : l'ordre des paramètres est important !
		 * Note : utilise la fonction atan2. Cf. http://fr.wikipedia.org/wiki/Atan2
		 * @param  P1 le premier point
		 * @param  P2 le second point
		 * @return l'angle (P1P2,x)
		 */
		public static function getAngle(P1:Point, P2:Point):Number
		{
			var Angle:Number = -Math.atan2(P2.y - P1.y, P2.x - P1.x);
			if (Angle < 0)
				Angle += 2 * Math.PI;
			
			return Angle;
		}
		
		/**
		 * Calcule l'angle entre la droite formée par les deux points et l'horizontale.
		 * Valeur de retour comprise entre -PI et PI, notation anglaise.
		 * Note : l'ordre des paramètres est important !
		 * Note : utilise la fonction atan2. Cf. http://fr.wikipedia.org/wiki/Atan2
		 * @param  P1 le premier point
		 * @param  P2 le second point
		 * @return l'angle (P1P2,x)
		 */
		public static function getDirectAngle(P1:Point, P2:Point):Number
		{
			var Angle:Number = Math.atan2(P2.y - P1.y, P2.x - P1.x);
			
			return Angle;
		}
		
		/**
		 * Distance pythagoréenne entre deux points.
		 * @param  P1 le premier point
		 * @param  P2 le deuxième point
		 * @return la distance calculée avec le théorème de Pythagore.
		 */
		public static function getDistance(P1:Point, P2:Point):Number
		{
			return Math.sqrt(Math.pow(P1.x - P2.x, 2) + Math.pow(P1.y - P2.y, 2));
		}
	}
	
}