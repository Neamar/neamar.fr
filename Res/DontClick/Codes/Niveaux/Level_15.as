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
	 * Une sorte de vent repousse en permanence la souris vers la droite, il faut faire plusieurs tours à l'exétrieur du jeu pour s'en sortir.
	 * @author Neamar
	 */
	public class Level_15 extends SpecialCursor
	{
		private var DernierePositionX:int;
		
		private var AngleArrivee:Number=0;
		
		public function Level_15(Depart:Point, Arrivee:Point=null)
		{
			Arrivee = new Point(20,240);
			super(Depart, Arrivee);
			
			DernierePositionX = CurseurVirtuel.x = mouseX;
			addEventListener(Event.ENTER_FRAME, decalerCurseur);
		}
		
		public final override function destroy():void
		{
			removeEventListener(Event.ENTER_FRAME, decalerCurseur);
			super.destroy();
		}
		
		private function decalerCurseur(e:Event):void
		{
		
			CurseurVirtuel.x += 7*(640 - CurseurVirtuel.x)/640;
			
			Souris.x = CurseurVirtuel.x;
			
			AngleArrivee = (AngleArrivee + Math.PI / 40) % (2*Math.PI);
			Arrivee.y = 240 + 200 * Math.sin(AngleArrivee);
		}

		
		protected final override function majCoordonneesSouris(e:MouseEvent):void
		{
			if (Math.abs(DernierePositionX - e.stageX) < 50)
				CurseurVirtuel.x -= (DernierePositionX - e.stageX);
				
			CurseurVirtuel.x = Math.max(0, CurseurVirtuel.x);
			CurseurVirtuel.y = e.stageY;
			
			DernierePositionX = e.stageX;
			
			super.majCoordonneesSouris(e);
		}
	}
	
}