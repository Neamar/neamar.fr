package 
{
	import flash.display.Bitmap;
	import flash.display.DisplayObject;
	import flash.display.Sprite;
	import flash.events.MouseEvent;
	import flash.filters.DropShadowFilter;
	import flash.filters.GlowFilter;
	
	import gs.TweenLite;
	
	/**
	 * Une pièce.
	 * @author Neamar
	 */
	public class Coin extends Sprite
	{
		[Embed(source="../assets/1Centime.png")]
		public static var p1Cent:Class;
		[Embed(source="../assets/2Centimes.png")]
		public static var p2Cents:Class;
		[Embed(source="../assets/5Centimes.png")]
		public static var p5Cents:Class;
		[Embed(source="../assets/10Centimes.png")]
		public static var p10Cents:Class;		
		[Embed(source="../assets/20Centimes.png")]
		public static var p20Cents:Class;
		[Embed(source="../assets/50Centimes.png")]
		public static var p50Cents:Class;
		[Embed(source="../assets/1Euro.png")]
		public static var p1Euro:Class;
		[Embed(source="../assets/2Euros.png")]
		public static var p2Euros:Class;

		/**
		 * Le rayon de la pièce.
		 */
		public var Rayon:int;
		
		/**
		 * La valeur en points de la pièce.
		 */
		public var Valeur:int;
		
		private var Parent:Level;
		
		/**
		 * Crée une nouvelle pièce
		 * 
		 * @param Parent Le niveau conteneur.
		 * @param IDClass Le type que doit avoir la pièce : 1€, 50 centimes...
		 */
		public function Coin(Parent:Level,IDClass:int)
		{
			this.Parent = Parent;
			
			var CoinStyle:int = 0;
			
			var Img:Bitmap;
			Img = new Level.PiecesPossibles[IDClass];
			this.Valeur = Level.PiecesValeurs[IDClass];
			this.Rayon = Math.min(Img.width, Img.height) / 2;
			
			Img.smoothing = true;
			Img.x = -Img.width/2;
			Img.y = -Img.height/2;
			
			
			this.addChild(Img);
			this.filters = new Array(Global.SHADOW);
			this.addEventListener(MouseEvent.CLICK, supprimerPiece);
			
			this.cacheAsBitmap = true;
			
			this.x = Global.FLASH_WIDTH * Math.random();
			this.y = Global.FLASH_HEIGHT * Math.random();
			this.rotation = -180 + Math.random() * 360;
		}
		
		/**
		 * Détruit la pièce pour gagner de la mémoire.
		 */
		public function destroy():void
		{
			Parent.removeChild(this);
			removeChild(getChildAt(0));
			removeEventListener(MouseEvent.CLICK, supprimerPiece);
		}
		
		/**
		 * Supprime la pièce une fois qu'on lui a cliquée dessus.
		 */
		public function supprimerPiece(e:MouseEvent=null):void
		{
			if (!Parent.hasStarted)
				return;
				
			var i:int = Parent.numChildren - 1;
			var estDessous:Boolean = false;
			while (Parent.getChildAt(i) != this)
			{
				var Piece:Coin = (Parent.getChildAt(i) as Coin);
				if (Math.pow(this.x - Piece.x, 2) + Math.pow(this.y - Piece.y, 2) < Math.pow(this.Rayon + Piece.Rayon - Global.TOLERANCE, 2))
				{
					TweenLite.to(this, .7, { scaleX:.7, scaleY:.7 } );
					TweenLite.to(this, .3, { delay:.7, scaleX:1, scaleY:1 } );
					TweenLite.to(Piece, 1, { rotation:Piece.rotation+180+Math.random()*180 } );
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
			trace(Global.Score);

		}
	}
	
}