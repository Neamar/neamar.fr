package Niveaux
{
	import com.greensock.TweenMax;
	import flash.events.MouseEvent;
	import flash.geom.Point;
	import Niveaux.Level;
	
	/**
	 * L'arrivée apparait toute seule après quelques secondes
	 * @author Neamar
	 */
	public class Level_18 extends Level
	{
		public function Level_18(Depart:Point,Arrivee:Point=null)
		{
			Arrivee = new Point(620, 460);
			super(Depart, Arrivee);
			
			this.Arrivee.visible = false;
			this.Arrivee.alpha = 0;
			TweenMax.to(this.Arrivee, 1, { delay:5, onStart:afficherArrivee, alpha:1 } );
		}
		
		private function afficherArrivee():void
		{
			Arrivee.visible = true;
		}
	}
}