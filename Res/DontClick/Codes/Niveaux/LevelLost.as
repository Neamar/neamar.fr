package Niveaux 
{
	import flash.geom.Point;
	import Niveaux.Level;
	import Utilitaires.DirectShape;
	
	/**
	 * Un "Level perdu" qui oblige l'utilisateur à recommencer le niveau
	 * @author Neamar
	 */
	public class LevelLost extends Level
	{
		public function LevelLost(Depart:Point, Arrivee:Point) 
		{
			super(Depart, Arrivee);
			this.graphics.clear();
			this.graphics.lineStyle(1,0xAAAAAA);
			this.graphics.beginFill(Main.LEVEL_PERDU);
			this.graphics.drawRect(0, 0, 640, 480);
		}
	}

}