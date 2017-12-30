package Niveaux
{
	import flash.events.MouseEvent;
	import flash.geom.Point;
	import Niveaux.Level;
	
	/**
	 * Un niveau de jeu
	 * @author Neamar
	 */
	public class Level_1 extends Level
	{
		public function Level_1(Depart:Point,Arrivee:Point=null)
		{
			Arrivee = new Point(320, 240);
			super(Depart, Arrivee);
		}
		
		public final override function destroy():void
		{
			super.destroy();
		}
		
		protected final override function deplacementSouris(e:MouseEvent):void
		{
			super.deplacementSouris(e);
		}
	}
	
}