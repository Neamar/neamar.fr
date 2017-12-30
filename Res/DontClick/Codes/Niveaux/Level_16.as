package Niveaux
{
	import com.greensock.TweenMax;
	import flash.display.Sprite;
	import flash.events.MouseEvent;
	import flash.geom.Point;
	import Niveaux.Level;
	
	/**
	 * Une boussole indique la direction du prochain checkpoint par rapport à la psition souris.
	 * Il faut valider tous les checkpoints pour s'en sortir.
	 * @author Neamar
	 */
	public class Level_16 extends Level
	{
		private var Points:Array = new Array(
			new Point(20, 240),
			new Point(160, 120),
			new Point(20, 60),
			new Point(620, 60),
			new Point(640 - 160, 120),
			new Point(620, 240),
			new Point(320, 120),
			new Point(320, 360),
			new Point(20, 420),
			new Point(320, 240));
			
		private var IndexObjectif:int = 1;
		
		private var Boussole:Sprite = new Sprite();
		
		private var CheckPoint:Sprite = new Sprite();
		
		public function Level_16(Depart:Point,Arrivee:Point=null)
		{
			Arrivee = new Point(800, 240);
			
			super(Depart, Arrivee);
			
			this.Arrivee.visible = false;
			
			Boussole.graphics.lineStyle(2, 0xAA0000);
			Boussole.graphics.moveTo(0, 0);
			Boussole.graphics.lineTo(50, 0);
			Boussole.graphics.moveTo(0, -10);
			Boussole.graphics.lineTo(0, 10);
			
			Boussole.graphics.lineStyle(1, 0xBBBBBB);
			Boussole.graphics.drawCircle(0, 0, 50);
			
			CheckPoint.graphics.lineStyle(2, 0xAAFF55);
			CheckPoint.graphics.drawCircle(0, 0, 3);
			
			Boussole.x = 320;
			Boussole.y = 240;
			addChild(Boussole);
			
			CheckPoint.x = Points[0].x;
			CheckPoint.y = Points[0].y;
			addChild(CheckPoint);
		}
		
		public final override function destroy():void
		{
			Boussole = null;
			CheckPoint = null;
			
			super.destroy();
		}
		
		protected final override function deplacementSouris(e:MouseEvent):void
		{
			var Obj:Point = Points[Math.min(Points.length-1,IndexObjectif)];
			
			TweenMax.to(Boussole, .5, {rotation: 360 * Math.atan2(Obj.y - e.stageY, Obj.x - e.stageX) / (2 * Math.PI)});
			
			super.deplacementSouris(e);
			
			if (Point.distance(Obj, CurseurVirtuel) < 10)
			{
				TweenMax.to(CheckPoint, 1.5, { x:Obj.x, y:Obj.y } );
				IndexObjectif++;
				
				if (IndexObjectif == Points.length - 1)
				{
					Arrivee.visible = true;
					Arrivee.alpha = 0;
					TweenMax.to(Arrivee, 2, { x:320, alpha:1 } );
					TweenMax.to(Boussole, 2, { alpha:0 } );
					TweenMax.to(CheckPoint, 2, {alpha:0 } );
				}
			}
				
			CheckPoint.filters = FiltreArriveeTab;
		}
	}
	
}