package Niveaux
{
	import com.greensock.TweenMax;
	import flash.display.Sprite;
	import flash.events.MouseEvent;
	import flash.geom.Point;
	import Niveaux.Level;
	
	/**
	 * Un "nuage" qui dissimule l'arrivée. Il faut la chercher à tâtons !
	 * @author Neamar
	 */
	public class Level_14 extends Level
	{
		public var Nuage:Sprite;
		public function Level_14(Depart:Point,Arrivee:Point=null)
		{
			Arrivee = new Point(610, 240);
			super(Depart, Arrivee);
			
			Nuage = new Sprite();
			Nuage.graphics.lineStyle(1,0xAAAAAA);
			Nuage.graphics.beginFill(0xFFFFFF);
			Nuage.graphics.drawRect(0, 0, 640, 480);
			addChild(Nuage);
			swapChildren(Nuage, this.Depart);
			setChildIndex(this.Arrivee, 0);
			
			this.Arrivee.alpha = 0;
			TweenMax.to(this.Arrivee, 1, { delay:2, alpha:1 });
		}
		
		protected final override function deplacementSouris(e:MouseEvent):void
		{
			super.deplacementSouris(e);
		}
	}
}