package Niveaux
{
	import com.greensock.TweenMax;
	import flash.display.Bitmap;
	import flash.display.DisplayObject;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.filters.BevelFilter;
	import flash.geom.Point;
	import Niveaux.Level;
	
	/**
	 * Le même labyrinthe que dans le niveau précédent, mais dans une partie de un deux trois soleil.
	 * Chaque fois que le soleil apparait, il faut arrêter de bouger la souris.
	 * @author Neamar
	 */
	public class Level_20 extends LabyLevel
	{		
		[Embed(source="../../assets/Sun.svg")]
		public static var Sun:Class;
		
		private static var Duree:int = 1;
		
		private var Un:Sprite = new Sprite();
		private var Deux:Sprite = new Sprite();
		private var Trois:Sprite = new Sprite();
		private var Soleil:Sprite = new Sprite();
		
		public function Level_20(Depart:Point, Arrivee:Point=null)
		{
			Arrivee = new Point(620, 20);
			super(Depart, Arrivee);
			
			Un.graphics.lineStyle(3, Main.BORDS_OBSTACLE);
			Un.graphics.beginFill(Main.LEVEL_PERDU);
			Un.graphics.drawCircle(0, 0, 15);
			Un.filters = FiltreArriveeTab;
			
			Deux.graphics.lineStyle(3, Main.BORDS_OBSTACLE);
			Deux.graphics.beginFill(Main.LEVEL_PERDU);
			Deux.graphics.drawCircle(-22, 0, 15);
			Deux.graphics.drawCircle(22, 0, 15);
			Deux.filters = FiltreArriveeTab;
						
			Trois.graphics.lineStyle(3, Main.BORDS_OBSTACLE);
			Trois.graphics.beginFill(Main.LEVEL_PERDU);
			Trois.graphics.drawCircle(0, 0, 15);
			Trois.graphics.drawCircle(-45, 0, 15);
			Trois.graphics.drawCircle(45, 0, 15);
			Trois.filters = FiltreArriveeTab;
			
			var ContenuSoleil:DisplayObject = new Sun();
			ContenuSoleil.x = -ContenuSoleil.width / 2;
			ContenuSoleil.y = -ContenuSoleil.height / 2;
			Soleil.addChild(ContenuSoleil);
			Soleil.filters = FiltreArriveeTab;
			
			//Lancer le jeu
			soleil_un();
		}
	
		public final override function destroy():void
		{
			TweenMax.killTweensOf(Un);
			TweenMax.killTweensOf(Deux);
			TweenMax.killTweensOf(Trois);
			TweenMax.killTweensOf(Soleil);
			removeEventListener(MouseEvent.MOUSE_MOVE, perdu_soleil);
			Soleil.removeChild(Soleil.getChildAt(0));
			Soleil = Un = Deux = Trois = null;
			super.destroy();
		}
		
		
		private function soleil_un():void
		{
			TweenMax.resumeAll();
			removeEventListener(MouseEvent.MOUSE_MOVE, perdu_soleil);
			deplacement(Un,Soleil,soleil_deux);
		}
		
		
		private function soleil_deux():void
		{
			deplacement(Deux,Un,soleil_trois);
		}

		private function soleil_trois():void
		{
			deplacement(Trois,Deux,soleil_soleil);
		}

		private function soleil_soleil():void
		{
			addEventListener(MouseEvent.MOUSE_MOVE, perdu_soleil);
			TweenMax.pauseAll();
			deplacement(Soleil,Trois,soleil_un,2.5);
		}
		
		private function deplacement(Obj:Sprite, Ancien:Sprite,onComplete:Function,scaleIntermediaire:Number=.5):void
		{
			if (contains(Ancien))
				removeChild(Ancien);
				
			addChild(Obj);
			Obj.y = 240;
			Obj.x = -Obj.width;
			TweenMax.to(Obj,Duree,{x:320,scaleX:scaleIntermediaire,scaleY:scaleIntermediaire});
			TweenMax.to(Obj,Duree,{delay:Duree+1,x:640+Obj.width,scaleX:1,scaleY:1, onComplete:onComplete});
		}
		
		private function perdu_soleil(e:Event):void
		{
			dispatchEvent(new Event(LEVEL_PERDU));
		}
	}	
}