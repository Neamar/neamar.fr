package Niveaux
{
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.geom.Point;
	import Niveaux.Level;
	
	/**
	 * L'angle de l'anneau est égal à la distance de la souris au centre  - 90°.
	 * Si on reste à une même distance, l'anneau ne tourne pas.
	 * @author Neamar
	 */
	public class Level_12 extends HitLevel
	{
		private var Anneau:Ring;
		private var Help:Sprite;
		
		public function Level_12(Depart:Point, Arrivee:Point=null)
		{
			Anneau = new Ring(640 - 60, 480 - 60);
			Arrivee = new Point(640 - 60, 480 - 60);
			
			Help = new Sprite();
			addChild(Help);
			super(Depart, Arrivee);
			
			Obstacles.addChild(Anneau);
		}


		public final override function destroy():void
		{
			removeChild(Help);
			Help.graphics.clear();
			Help = null;
			Anneau.destroy();
			super.destroy();
		}
		
		protected final override function majCoordonneesSouris(e:MouseEvent):void
		{			
			super.majCoordonneesSouris(e);
			
			Anneau.tournerVers(- 90 + Point.distance(new Point(320, 240), CurseurVirtuel));
			
			Help.graphics.clear();
			Help.graphics.lineStyle(1, 0xCCDDCC);
			Help.graphics.moveTo(320, 240);
			Help.graphics.lineTo(CurseurVirtuel.x, CurseurVirtuel.y);
		}
	}
	
}