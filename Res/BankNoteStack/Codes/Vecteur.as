//Un vecteur, qui est en fait un déguisement de Point, mais cela clarifie le code.
package
{
	import flash.geom.Point;

	public class Vecteur extends Point
	{
		public function Vecteur(x:Number=0,y:Number=0)
		{
			super(x,y);
		}

		public function Plus(P:Vecteur):void
		{
			this.x += P.x;
			this.y += P.y;
		}
		public function ScalarMul(k:Number):void
		{
			this.x=k*this.x;
			this.y=k*this.y;
		}
	}
}