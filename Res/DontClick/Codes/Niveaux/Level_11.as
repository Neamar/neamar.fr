package Niveaux
{
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.geom.Point;
	import Niveaux.Level;
	
	/**
	 * L'anneau tourne à chaque fois que la souris bouge, d'un angle proportionnel au déplacement. Il faut donc jouer subtil pour profiter de la rotation en entrant dans l'anneau.
	 * @author Neamar
	 */
	public class Level_11 extends HitLevel
	{
		private var Anneau:Ring;
		
		public function Level_11(Depart:Point, Arrivee:Point=null)
		{
			Anneau = new Ring(60, 60);
			Arrivee = new Point(60, 60);
						
			super(Depart, Arrivee);
			
			Obstacles.addChild(Anneau);

		}


		public final override function destroy():void
		{
			Anneau.destroy();
			super.destroy();
		}
		
		protected final override function majCoordonneesSouris(e:MouseEvent):void
		{
			super.majCoordonneesSouris(e);
			
			Anneau.tournerVersRelatif(Point.distance(DernierPoint, CurseurVirtuel));
		}
	}
	
}