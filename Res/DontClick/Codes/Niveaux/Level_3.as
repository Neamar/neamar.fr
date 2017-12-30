package Niveaux
{
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.geom.Point;
	import Niveaux.Level;
	
	/**
	 * Un niveau de jeu. Ne pas toucher les bords pour le finir.
	 * @author Neamar
	 */
	public class Level_3 extends HitLevel
	{
		public function Level_3(Depart:Point, Arrivee:Point=null)
		{
			Arrivee = new Point(40, 460);
			super(Depart,Arrivee);
			
			//Cercle inférieur
			Obstacles.graphics.drawCircle(630, 630, 570);
			Obstacles.graphics.endFill();
			
			//Cercle supérieur
			prepareFill();
			Obstacles.graphics.moveTo(0, 480);
			var Rayon:int = 640;
			var CentreX:int = 600;
			var CentreY:int = 640;
			for (var i:int = 12; i < 42; i++)
			{
				var teta:Number = Math.PI/2 + i * Math.PI / 60 + Math.PI/3;
				Obstacles.graphics.lineTo(CentreX + Rayon * Math.cos(teta), CentreY + Rayon * Math.sin(teta));
			}
			//Obstacles.graphics.lineTo(0, 0);
			//Obstacles.graphics.lineTo(0, 480);

		}
		
	}
	
}