package Niveaux
{
	import com.greensock.TweenMax;
	import flash.display.GradientType;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.filters.BevelFilter;
	import flash.filters.BlurFilter;
	import flash.filters.GlowFilter;
	import flash.geom.Point;
	
	/**
	 * Un niveau de jeu. Type abstrait.
	 * @author Neamar
	 */
	public class Level extends Sprite
	{
		/**
		 * Liste des évenements dispatchés
		 */
		public static var LEVEL_GAGNE:String = "levelGagne";
		public static var LEVEL_PERDU:String = "levelPerdu";
		
		public static var RAYON_ARRIVEE:int = 20;
		
		
		public static var FiltreArrivee:GlowFilter = new GlowFilter(Main.ARRIVEE);
		public static var FiltreArriveeTab:Array = new Array(FiltreArrivee,new BevelFilter(6));
		public var AngleIntensite:Number = 0;
		public var IntensiteMax:int = 50;
		public var IntensiteMin:int = 20;
		public var AngleCouleur:Number = 0;
		
		protected var Depart:Sprite = new Sprite();
		protected var Arrivee:Sprite = new Sprite();
		
		protected var CurseurVirtuel:Point = new Point();
		
		public function Level(Depart:Point, Arrivee:Point=null)
		{
			this.graphics.lineStyle(1,0xAAAAAA);
			this.graphics.beginFill(0x000000);
			this.graphics.drawRect(0, 0, 640, 480);
			
			//Le cercle de départ
			this.Depart.graphics.lineStyle(2, 0xAAAAAA);
			this.Depart.graphics.drawCircle(0, 0, RAYON_ARRIVEE);
			this.Depart.x = Depart.x;
			this.Depart.y = Depart.y;
			addChild(this.Depart);
			TweenMax.to(this.Depart,3, { alpha:0,onComplete:removeDepart } );

			//Le cercle de l'arrivée
			this.Arrivee.graphics.lineStyle(2, 0x000080);
			this.Arrivee.graphics.beginFill(FiltreArrivee.color);// GradientType.RADIAL, new Array(0xFFFFFF, 0), new Array(1, 1), new Array(0, 255));
			this.Arrivee.x = Arrivee.x;
			this.Arrivee.y = Arrivee.y;
			
			this.Arrivee.graphics.drawCircle(0, 0 , RAYON_ARRIVEE);
			
			addChild(this.Arrivee);
			
			addEventListener(MouseEvent.MOUSE_MOVE, deplacementSouris);
			
			addEventListener(Event.ENTER_FRAME, brillerArrivee);
			addEventListener(Event.ENTER_FRAME,brillerDepart);
		}
		
		/**
		 * Détruit entièrement le niveau. Overridé par chacun des niveaux qui occupe de la mémoire supplémentaire.
		 * Cela permet de faciliter le travail du garbage collecotr, et aussi de s'assurer que tout est bien détruit et qu'aucun listener ne reste.
		 */
		public function destroy():void
		{
			Depart = null;
			Arrivee.filters = null;
			Arrivee = null;
			this.graphics.clear();
			removeEventListener(MouseEvent.MOUSE_MOVE, deplacementSouris);
			removeEventListener(Event.ENTER_FRAME, brillerArrivee);
			removeEventListener(Event.ENTER_FRAME,brillerDepart);
			CurseurVirtuel = null;
		}
		
		/**
		 * Accesseurs faciles pour des propriétés souvent utilisées
		 * @param
		 */
		public function get PointArrivee():Point
		{
			return new Point(Arrivee.x, Arrivee.y);
		}
		public function get PointDepart():Point
		{
			return new Point(Depart.x, Depart.y);
		}
		
		/**
		 * Trigerré par un mouvement de la souris.
		 * Met à jour la position, et vérifie si on a gagné ou non.
		 * @param
		 */
		protected function majCoordonneesSouris(e:MouseEvent):void
		{
			CurseurVirtuel.x = e.stageX;
			CurseurVirtuel.y = e.stageY;
		}
		
		/**
		 * Appellé à chaque mouvement de la souris.
		 * Overridé dans presque toutes les classes
		 * @param e Les coordonnées souris
		 */
		protected function deplacementSouris(e:MouseEvent):void
		{
			majCoordonneesSouris(e);
			if (Arrivee.visible && Point.distance(CurseurVirtuel, PointArrivee) < RAYON_ARRIVEE)
			{
				this.dispatchEvent(new Event(LEVEL_GAGNE));
				this.removeEventListener(MouseEvent.MOUSE_MOVE, deplacementSouris);
			}
		}
		
		/**
		 * Graphismes
		 */
		protected function brillerArrivee(e:Event):void
		{
			AngleIntensite = (AngleIntensite+Math.PI / 200) % Math.PI;
			AngleCouleur = (AngleCouleur + Math.PI / 33) % Math.PI;
			
			FiltreArrivee.blurX = FiltreArrivee.blurY = IntensiteMin + (IntensiteMax - IntensiteMin) * Math.sin(AngleIntensite);
			//FiltreArrivee.color = 0x2e0094 + 0x00FF00 * Math.abs(Math.sin(AngleIntensite));
			Arrivee.filters = FiltreArriveeTab;
		}
		
		protected function brillerDepart(e:Event):void
		{
			FiltreArrivee.blurX = FiltreArrivee.blurY = IntensiteMin + (IntensiteMax - IntensiteMin) * Math.sin(Math.PI - AngleIntensite);
			Depart.filters = FiltreArriveeTab;
		}
		
		protected function removeDepart():void
		{
			if(Depart!=null)
				removeChild(Depart);
			removeEventListener(Event.ENTER_FRAME,brillerDepart);
		}
	}
	
}