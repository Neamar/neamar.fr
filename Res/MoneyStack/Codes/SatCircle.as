package Utilitaires.geom
{
	import flash.geom.Point;
	import Utilitaires.ArrayPlus;
	import Utilitaires.geom.SatShape;
	
	/**
	 * ...
	 * @author Neamar
	 */
	public class SatCircle extends SatShape
	{
		public var Rayon:int;
		
		public function SatCircle(x:int, y:int, Rayon:int)
		{
			super(x, y);
			this.Rayon = Rayon;
			
			makeVector();
		}
		
		public override function makeVector():void
		{
			this.Sommets = new ArrayPlus(new Point(0,0)); //Ce n'est pas un sommet au sens propre, mais ça nous suffira pour Sat.
			super.makeVector();
		}
		
		public override function axesAvec(Forme:SatShape):ArrayPlus
		{
			this.Vecteurs = new ArrayPlus();
			for each(var Sommet:Point in Forme.Sommets)
			{
				Vecteurs.push
				(
					Vector.fromPoints
					(
						new Point(this.x,this.y),
						Forme.localToGlobal(Sommet)
					)
				);
			}
			
			makeVector();
			
			return _Axes;
		}
		
		public override function projeter(Axe:Vector):Number
		{
			return Rayon;
		}
	}
	
}