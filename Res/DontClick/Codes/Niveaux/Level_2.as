package Niveaux
{
	import flash.events.MouseEvent;
	import flash.geom.Point;
	import Niveaux.Level;
	
	/**
	 * Un niveau de jeu. Aucune difficulté, permet de comprendre le principe.
	 * @author Neamar
	 */
	public class Level_2 extends Level
	{
		public function Level_2(Depart:Point,Arrivee:Point=null)
		{
			Arrivee = new Point(600, 40);
			super(Depart, Arrivee);
		}
	}
	
}