package Utilitaires.geom
{
	import flash.geom.Point;
	import Utilitaires.ArrayPlus;
	import Utilitaires.geom.Vector;
	
	/**
	 * Un rectangle SAT.
	 * @author Neamar
	 */
	public class SatRectangle extends SatShape
	{
		private var _width:Number;
		private var _height:Number;
		
		public function SatRectangle(x:int,y:int,Width:int,Height:int)
		{
			super(x, y);
			
			_width=Width;
			_height = Height;
			
			//liste des vecteurs composant la forme.
			makeVector();
		}
		
		public override function get width():Number { return _width; }
		public override function get height():Number { return _height; }
		
		
		public override function makeVector():void
		{
			Vecteurs = new ArrayPlus
			(
				Vector.fromPoints
				(
					this.localToGlobal(new Point(-width/2,-height/2)),
					this.localToGlobal( new Point( -width / 2, height / 2))
				),
				Vector.fromPoints
				(
					this.localToGlobal(new Point( -width / 2, -height / 2)),
					this.localToGlobal(new Point(width / 2, -height / 2))
				)
			);
			
			Sommets = new ArrayPlus
			(
				new Point( -width / 2, -height / 2),
				new Point( -width / 2, height / 2),
				new Point( width / 2, -height / 2),
				new Point( width / 2, height / 2)
			)
			
			super.makeVector();
		}
		
		public override function projeter(Axe:Vector):Number
		{
			var dpi:Number = Vector.scalaire(Vecteurs[0],Axe);
			var dpj:Number = Vector.scalaire(Vecteurs[1],Axe);
			
			return (Math.abs(dpi) + Math.abs(dpj))/2;//projection de la diagonale sur Axe.
		}
	}
	
}