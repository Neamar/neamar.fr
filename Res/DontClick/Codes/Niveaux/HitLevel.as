package Niveaux
{
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.filters.BevelFilter;
	import flash.filters.GlowFilter;
	import flash.geom.Point;
	import Niveaux.Level;
	
	/**
	 * Un niveau avec des obstacles.
	 * Tous les obstacles sont regroupés et addChildés dans le Sprite Obstacles, un hitTest permet de trouve rles collisions.
	 * On interpole les points manquants si l'ordi rame pour éviter la triche en déplaçant très vite la souris.
	 * On fait aussi le test sur enterframe pour éviter de rester immobile sur un niveau qui bouge (sans enterframe, on ne perd pas puisque que mousemove n'est pas lancé).
	 * 
	 * Hérité par la quasi totalité des niveaux du jeu.
	 * @author Neamar
	 */
	public class HitLevel extends Level
	{
		protected var Obstacles:Sprite = new Sprite();
		protected var DoitEviterObstacles:Boolean = true;
		
		public static var FiltreObstacles:GlowFilter = new GlowFilter(Main.FLOU_OBSTACLE);
		public static var FiltreObstaclesTab:Array = new Array(FiltreObstacles,new BevelFilter(4,45,0xFFFFFF,1,Main.FLOU_OBSTACLE));
		
		//Enregistrer pour l'interpolation
		protected var DernierPoint:Point;
		
		public function HitLevel(Depart:Point,Arrivee:Point=null)
		{
			DernierPoint = new Point(mouseX, mouseY);
			super(Depart, Arrivee);
			
			addChild(Obstacles);
			setChildIndex(Obstacles,0);
			prepareFill();
			
			addEventListener(Event.ENTER_FRAME, verifierTriche);
			
			Obstacles.filters = FiltreObstaclesTab;
		}
		
		public override function destroy():void
		{
			Obstacles = null;
			removeEventListener(Event.ENTER_FRAME, verifierTriche);
			super.destroy();
		}
		
		public function prepareFill():void
		{
			Obstacles.graphics.lineStyle(3,Main.BORDS_OBSTACLE);
			//Obstacles.graphics.beginFill(Main.OBSTACLE);
		}
		
		protected override function deplacementSouris(e:MouseEvent):void
		{	
			majCoordonneesSouris(e);
			
			var Distance:Number = Point.distance(DernierPoint, CurseurVirtuel)
			
			//Faire un hittest sur tous les points pour s'assurer qu'il ne tirhce pas en déplaçant rapidement la souris
			for (var i:int = 0; i < Distance; i++)
			{
				var PointVirtuel:Point = Point.interpolate(DernierPoint, CurseurVirtuel, i / Distance);
				if (Obstacles.hitTestPoint(PointVirtuel.x, PointVirtuel.y, true)==DoitEviterObstacles)
					dispatchEvent(new Event(Level.LEVEL_PERDU));
			}
			
			super.deplacementSouris(e);
			
			//Enregister le dernier point si le level n'est pas détruit
			if (DernierPoint != null)
			{
				DernierPoint.x = CurseurVirtuel.x;
				DernierPoint.y = CurseurVirtuel.y;
			}
		}
		
		private function verifierTriche(e:Event):void
		{
			if(Obstacles.hitTestPoint(CurseurVirtuel.x, CurseurVirtuel.y, true)==DoitEviterObstacles)
					dispatchEvent(new Event(Level.LEVEL_PERDU));
		}
	}
	
}