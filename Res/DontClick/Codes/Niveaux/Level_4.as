package Niveaux
{
	import flash.geom.Point;
	import Niveaux.Level;
	
	/**
	 * Un niveau de jeu. Le curseur est invisible.
	 * @author Neamar
	 */
	public class Level_4 extends HiddenLevel
	{
		public function Level_4(Depart:Point, Arrivee:Point=null)
		{
			Arrivee = new Point(620, 460);
			
			super(Depart, Arrivee);
		}
	}
	
}