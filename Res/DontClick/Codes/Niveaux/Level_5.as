package Niveaux
{
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.geom.Point;
	import flash.ui.Mouse;
	import Niveaux.Level;
	
	/**
	 * Un niveau de jeu. Curseur visible uniquement par le déplacement des petites bulles, y aller doucement sinon elles s'affolent et cela devient injouable.
	 * @author Neamar
	 */
	public class Level_5 extends HiddenLevel
	{
		private const NbBilles:int = 10;
		private var Billes:Array = new Array(NbBilles);
		private var Forces:Array = new Array(NbBilles);
		
		public function Level_5(Depart:Point, Arrivee:Point=null)
		{
			Arrivee = new Point(20, 15);
			
			super(Depart, Arrivee);
			
			//Partie du bas
			Obstacles.graphics.moveTo(600, 480);
			Obstacles.graphics.lineTo(0, 270);
			//Obstacles.graphics.lineTo(0, 480);
			Obstacles.graphics.endFill();
			
			//Partie du haut
			prepareFill();
			Obstacles.graphics.moveTo(60, 0);
			Obstacles.graphics.lineTo(640, 200);
			//Obstacles.graphics.lineTo(640, 0);
			Obstacles.graphics.endFill();
			
			//Triangle de droite, en bas
			prepareFill();
			Obstacles.graphics.moveTo(640, 380);
			Obstacles.graphics.lineTo(150, 270);
			Obstacles.graphics.lineTo(640, 270);
			Obstacles.graphics.endFill();
			
			//Triangle de gauche, en haut
			prepareFill();
			Obstacles.graphics.moveTo(0, 40);
			Obstacles.graphics.lineTo(520, 220);
			Obstacles.graphics.lineTo(0, 220);
			Obstacles.graphics.endFill();
			
			for (var i:int = 0; i < NbBilles; i++)
			{
				var Bille:Sprite = new Sprite();
				Bille.graphics.lineStyle(1, 0xFFFFFF * Math.random());
				Bille.graphics.drawCircle(0, 0, 10 * Math.random() + 2);
				Bille.x = Depart.x; Bille.y = Depart.y;
				
				while (Bille.x == Depart.x || Bille.y == Depart.y)
				{
					Bille.x = Depart.x - 10 + 20 * Math.random();
					Bille.y = Depart.y - 10 + 20 * Math.random();
				}
				addChild(Bille);
				Bille.filters = FiltreObstaclesTab;
				Billes[i]=Bille;
				Forces[i] = new Point(-10 + 20 * Math.random(), -10 + 20 * Math.random());
			}
			
			CurseurVirtuel = new Point(mouseX, mouseY);
			addEventListener(Event.ENTER_FRAME, deplacerBille);
		}
		public final override function destroy():void
		{
			removeEventListener(Event.ENTER_FRAME, deplacerBille);
			super.destroy();
		}
		
		private final function deplacerBille(e:Event):void
		{
			for (var i:int = 0; i < NbBilles; i++)
			{
				var Force:Point = Forces[i];
				var Bille:Sprite = Billes[i];
				
				var Distance:int = Point.distance(new Point(CurseurVirtuel.x, CurseurVirtuel.y), new Point(Bille.x, Bille.y));
				var Attraction:Number = Distance/5;
				var Angle:Number = Math.atan2(CurseurVirtuel.y - Bille.y, CurseurVirtuel.x -Bille.x);
				Force.x += Attraction * Math.cos(Angle);
				Force.y += Attraction * Math.sin(Angle);
				Bille.x += Force.x
				Bille.y += Force.y;
			}
		}
	}
	
}