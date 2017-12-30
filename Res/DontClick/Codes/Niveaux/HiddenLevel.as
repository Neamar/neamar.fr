package Niveaux 
{
	import flash.events.MouseEvent;
	import flash.geom.Point;
	import flash.ui.Mouse;
	import Niveaux.HitLevel;
	
	/**
	 * Masque le curseur en dehore du point de départ. Hérité par les niveaux sans curseurs.
	 * @author Neamar
	 */
	public class HiddenLevel extends HitLevel
	{
		
		public function HiddenLevel(Depart:Point, Arrivee:Point = null) 
		{
			super(Depart, Arrivee);
		}
		
		public override function destroy():void
		{
			Mouse.show();
			super.destroy();
		}
		
		protected override function deplacementSouris(e:MouseEvent):void
		{
			if (Point.distance(CurseurVirtuel, PointDepart) < RAYON_ARRIVEE)
				Mouse.show();
			else
				Mouse.hide();
				
			super.deplacementSouris(e);
		}
	}

}