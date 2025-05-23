﻿package 
{
	import flash.display.Bitmap;
	import flash.display.DisplayObject;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.FocusEvent;
	import flash.events.MouseEvent;
	import flash.filters.DropShadowFilter;
	import flash.filters.GlowFilter;
	import flash.geom.Point;
	import flash.geom.Rectangle;
	import Utilitaires.ArrayPlus;
	import Utilitaires.geom.SatRectangle;
	import Utilitaires.geom.SatShape;
	import Utilitaires.geom.Vector;
	
	import gs.TweenLite;
	
	/**
	 * Une pièce.
	 * @author Neamar
	 */
	public class BankNote extends SatRectangle
	{
		[Embed(source="../assets/5.jpg")]
		public static var b5:Class;
		[Embed(source="../assets/10.jpg")]
		public static var b10:Class;
		[Embed(source="../assets/20.jpg")]
		public static var b20:Class;
		[Embed(source="../assets/50.jpg")]
		public static var b50:Class;		
		[Embed(source="../assets/100.jpg")]
		public static var b100:Class;
		[Embed(source="../assets/200.jpg")]
		public static var b200:Class;
		[Embed(source="../assets/500.jpg")]
		public static var b500:Class;
		
		/**
		 * La valeur en points de la pièce.
		 */
		public var Valeur:int;
		
		private var Parent:Level;
		
		private var Img:Bitmap;
		
		/**
		 * Crée une nouvelle pièce
		 * 
		 * @param Parent Le niveau conteneur.
		 * @param IDClass Le type que doit avoir la pièce : 1€, 50 centimes...
		 */
		public function BankNote(Parent:Level,IDClass:int)
		{
			Img = new Level.BilletsPossibles[IDClass];
			super(Global.FLASH_WIDTH * Math.random(), Global.FLASH_HEIGHT * Math.random(), Img.width, Img.height);
			
			this.Parent = Parent;
			
			var BilletStyle:int = 0;
			this.Valeur = Level.BilletsValeurs[IDClass];
			
			Img.smoothing = true;
			Img.x = -width/2;
			Img.y = -height / 2;
			
			
			this.addChild(Img);
			this.filters = new Array(Global.SHADOW);
			this.addEventListener(MouseEvent.CLICK, supprimerBillet);
			
			this.cacheAsBitmap = true;
			
			this.rotation = -180 + Math.random() * 360;
		
			this.alpha = 0;
			TweenLite.to(this, .5, { alpha:1 } );
			
		}
		
		/**
		 * Détruit la pièce pour gagner de la mémoire.
		 */
		public override function destroy():void
		{
			Parent.removeChild(this);
			removeChild(getChildAt(0));
			removeEventListener(MouseEvent.CLICK, supprimerBillet);
		}
		
		/**
		 * Supprime la pièce une fois qu'on lui a cliquée dessus.
		 */
		public function supprimerBillet(e:MouseEvent=null):void
		{
			if (!Parent.hasStarted)//Ne rien faire tant que la partie n'a pas commencée.
				return;
				
			var i:int = Parent.numChildren - 1;
			var estDessous:Boolean = false;
			while (Parent.getChildAt(i) != this)
			{
				var Billet:SatShape = (Parent.getChildAt(i) as SatShape);
				if (this.hitTest(Billet))
				{
					TweenLite.to(this, .7, { scaleX:.7, scaleY:.7 } );
					TweenLite.to(this, .3, { delay:.7, scaleX:1, scaleY:1 } );
					TweenLite.to(Billet, 1, { rotation:Billet.rotation+360 } );
					estDessous = true;
				}
				i--;
			}
			if (!estDessous)
			{
				Global.Score += Valeur;
				destroy();
			}
			else
			 	Global.Score -= Valeur;
		}
	}
	
}