package Niveaux
{
	import com.greensock.TweenMax;
	import flash.events.MouseEvent;
	import flash.geom.Point;
	import Niveaux.Level;
	
	/**
	 * Un niveau de jeu. Arrivée cachée sous la pub de mochiads
	 * @author Neamar
	 */
	public class Level_1 extends Level
	{
		public function Level_1(Depart:Point,Arrivee:Point=null)
		{
			Arrivee = new Point(320, 240);
			super(Depart, Arrivee);
			this.Arrivee.visible = false;
			
			addChild(Main.Sponsor);
			Main.Sponsor.x = 320 - Main.Sponsor.width / 2;
			Main.Sponsor.y = 240 - Main.Sponsor.height / 2;
			
			TweenMax.to(Main.Sponsor, 1, {delay:4, alpha:0, onComplete:enleverSponsor } );
		}
		
		private function enleverSponsor():void
		{
			removeChild(Main.Sponsor);
			Arrivee.visible = true;
			Arrivee.alpha = 0;
			TweenMax.to(Arrivee, 1, { alpha:1 } );
		}
	}
}