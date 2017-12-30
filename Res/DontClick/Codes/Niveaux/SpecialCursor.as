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
	 * Classe de base pour les niveaux à curseur spécial (qui ne se déplace pas avec la souris)
	 * @author Neamar
	 */
	public class SpecialCursor extends Level
	{
		[Embed(source="../../assets/Curseur.png")]
		private static var Curseur:Class;
		
		protected var Souris:Bitmap = new SpecialCursor.Curseur();
		
		public function SpecialCursor(Depart:Point, Arrivee:Point=null)
		{
			super(Depart, Arrivee);
			addChild(Souris);
			Mouse.hide();
		}
		
		public override function destroy():void
		{
			Souris = null;
			super.destroy();
		}

		protected override function majCoordonneesSouris(e:MouseEvent):void
		{	
			Souris.x = CurseurVirtuel.x;
			Souris.y = CurseurVirtuel.y;
			
			//PAS d'APPEL à super !
		}
	}
	
}