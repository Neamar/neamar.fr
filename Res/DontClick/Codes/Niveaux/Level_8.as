package Niveaux
{
	import flash.display.Bitmap;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.geom.Point;
	import flash.ui.Mouse;
	import Niveaux.Level;
	
	/**
	 * Un niveau de jeu. Les mouvements de la souris sont ralentis, il faut passer par l'extérieur du flash pour s'en sortir.
	 * @author Neamar
	 */
	public class Level_8 extends SpecialCursor
	{
		private var DernierePositionSouris:Point = new Point();
		private const RALENTISSEUR:int = 4;
		
		public function Level_8(Depart:Point, Arrivee:Point=null)
		{
			Arrivee = new Point(620,460);
			super(Depart, Arrivee);
		}

		protected final override function majCoordonneesSouris(e:MouseEvent):void
		{
			//Ralentir les mvmts souris, et éviter les sauts
			if (Point.distance(new Point(e.stageX, e.stageY), DernierePositionSouris) < 150)
			{
				CurseurVirtuel.x += (e.stageX - DernierePositionSouris.x) / RALENTISSEUR;
				CurseurVirtuel.y += (e.stageY - DernierePositionSouris.y) / RALENTISSEUR;
				
				CurseurVirtuel.x = Math.min(640, Math.max(0, CurseurVirtuel.x));
				CurseurVirtuel.y = Math.min(480, Math.max(0, CurseurVirtuel.y));
			}
			
			DernierePositionSouris.x = e.stageX;
			DernierePositionSouris.y = e.stageY;
			
			super.majCoordonneesSouris(e);
		}
	}
	
}