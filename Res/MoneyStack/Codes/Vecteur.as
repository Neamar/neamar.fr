package 
{
	import flash.geom.Point;
	
	/**
	 * ...
	 * @author Neamar
	 */
	public class Vecteur extends Point 
	{
		public function Vecteur(x:Number, y:Number)
		{
			super(x, y);
		}
		
		public static function fromPoints(A:Point, B:Point):Vecteur
		{
			return new Vecteur(B.x - A.x, B.y - A.y);
		}
		
		
		public function get Unitaire():Vecteur
		{
			var N:Number = Norme;
			return new Vecteur(x / Norme, y / Norme);
		}
		
		public function get Norme():Number
		{
			return Math.sqrt(Math.pow(x, 2) + Math.pow(y, 2));
		}
		
		public function scalaire(V:Vecteur):Number
		{
			return this.x * V.x + this.y * V.y;
		}
		
		public function multiplier(k:Number):Vecteur
		{
			return new Vecteur(k * x, k * y);
		}
	}
	
}