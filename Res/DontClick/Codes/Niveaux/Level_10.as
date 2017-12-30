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
	 * Éviter les cercles qui poppent un peu partout.
	 * @author Neamar
	 */
	public class Level_10 extends HitLevel
	{	
		private var NbIteration:int = 0;
		
		public function Level_10(Depart:Point, Arrivee:Point=null)
		{
			Arrivee = new Point(320, 440);
			
			super(Depart, Arrivee);
			
			addEventListener(Event.ENTER_FRAME, deplacerObstacles);
			
			addEventListener(MouseEvent.MOUSE_OUT, SortieSouris);
			
			Obstacles.graphics.moveTo(50, 240);
			Obstacles.graphics.lineTo(590, 240);
			
			Obstacles.addChild(new Cercle(25, 240));
			Obstacles.addChild(new Cercle(615, 240));

		}

		public final override function destroy():void
		{
			removeEventListener(MouseEvent.MOUSE_OUT, SortieSouris);
			removeEventListener(Event.ENTER_FRAME, deplacerObstacles);
			
			for (var i:int = 0; i < Obstacles.numChildren; i++)
			{
				(Obstacles.getChildAt(i) as Cercle).destroy();
			}
			super.destroy();
		}
		
		private final function deplacerObstacles(e:Event):void
		{
			NbIteration++;
			
			if (NbIteration % 5 ==0)
				Obstacles.addChild(new Cercle(640 * Math.random(), 480 * Math.random()));
				
			if (NbIteration == 150)
			{
				Obstacles.addChild(new Cercle(300, 420));
				Obstacles.addChild(new Cercle(300, 460));
				Obstacles.addChild(new Cercle(340, 420));
				Obstacles.addChild(new Cercle(340, 460));
			}
				
		}
		
		private function SortieSouris(e:Event):void
		{
			dispatchEvent(new Event(LEVEL_PERDU));
		}
	}
}

//Classe Helper pour les cercles
import com.greensock.easing.Elastic;
import com.greensock.TweenMax;
import flash.display.Sprite;
import flash.filters.GlowFilter;
import Niveaux.Level;

class Cercle extends Sprite
{
	public function Cercle(x:int, y:int)
	{
		super();
		this.x = x;
		this.y = y;
		this.graphics.lineStyle(3,Main.BORDS_OBSTACLE);
		//this.graphics.beginFill(Main.OBSTACLE);
		this.graphics.drawCircle(0, 0, 20);
		this.graphics.endFill();
		this.scaleX = this.scaleY = 0;
		this.filters = Level.FiltreArriveeTab;
		TweenMax.to(this, 1, { scaleX:.1, scaleY:.1, onComplete:enleverFiltre} );
		TweenMax.to(this, 2, { delay:1, scaleX:2, scaleY:2, ease:Elastic.easeOut } );
		TweenMax.to(this, 2, { delay:3, scaleX:1, scaleY:1 } );
		TweenMax.to(this, 1, { delay:4, alpha:.2, onComplete:destroy } );
	}
	
	public function destroy():void
	{
		this.graphics.clear();
		if(parent!=null)
			parent.removeChild(this);
	}
	
	private function enleverFiltre():void
	{
		this.filters = null;
	}
}