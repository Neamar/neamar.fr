package
{
	import flash.display.Bitmap;
	import flash.display.BitmapData;
	import flash.display.BitmapDataChannel;
	import flash.display.Sprite;
	import flash.filters.DisplacementMapFilter;
	import flash.geom.Matrix;
	/**
	 * La texture de fond qui défile. Elle est générée à la volée par un sprite.
	 * Singleton récpérable par Background.Instance() depuis n'importe quel fichier.
	 */
	public class Background extends Sprite
	{

		/**
		 * Accès à l'objet Background de l'application.
		 */
		
		public static var Instance:Background;
		//Inclut la ressource spécifiée par source, une image png ici.
		//De nombreux formats sont gérés : polices, svg, images bitmap, ressources flash...
		//Le chemin doit être spécifié par rapport au fichier source.
		[Embed(source = "../assets/Plank.png")]
		//Définit la classe à instancier pour récupérer un objet de ce type.
		private var Plank:Class;
		
		//Instancie un objet de type Plank et le stocke dans une variable de type Bitmap (polymorphisme). Ici, on a bien un type Bitmap (Plank extends Bitmap).
		//De toute façon, on ne peut pas mettre :Plank car c'est un type "inconnu à la compilation".
		public var FondNormal:Bitmap = new Plank();
		public var FondMiroir:Bitmap;
		
		/**
		 * Le fond qui défile et qui contient la planche et son miroir.
		 */
		private var FondSeemless:Sprite = new Sprite();
		
		public const Deplacement:Array = new Array(new DisplacementMapFilter(FondNormal.bitmapData, null, BitmapDataChannel.RED, BitmapDataChannel.RED, 5, 5, "color"));
		
		public function Background()
		{
			Instance = this;
			
			//L'objet s'utilise normalement après.
			FondNormal.x = 0;
			addChild(FondNormal);
			
			//Construction du miroir
			FondMiroir = mirror(FondNormal);
			FondMiroir.x = Main.WIDTH;
			addChild( FondMiroir );
			FondMiroir
		}
		
		public override function set x(v:Number):void
		{
			super.x = v;
			
			//Gérer le décalage des textures : trop à gauche.
			if (FondNormal.x + v < -Main.WIDTH)
				FondNormal.x += 2 * Main.WIDTH;
				
			if (FondMiroir.x + v < -Main.WIDTH)
				FondMiroir.x += 2*Main.WIDTH;

			//Gérer le décalage des textures : trop à droite.
			if (FondNormal.x + v >= Main.WIDTH)
				FondNormal.x -= 2 * Main.WIDTH;
				
			if (FondMiroir.x + v >= Main.WIDTH)
				FondMiroir.x -= 2*Main.WIDTH;
		}
		
		/**
		 * Retourne l'image passée en paramètre pour lui appliquer un effet miroir
		 * @param	ImageOriginale l'image à retourner verticalement (les coordonnées Y restent im
		 * @return
		 */
		public function mirror(ImageOriginale:Bitmap):Bitmap
		{
			var ImageMiroir:Bitmap = new Bitmap();

			//Construction de la matrice de transformation.
			//scaleX = -1
			//Translation X : 
			var Miroir:Matrix = new Matrix( -1, 0, 0, 1, ImageOriginale.width, 0 );
			
			//Construction des données, en dessinant ImageOriginale avec la matrice 
			var MiroirData:BitmapData = new BitmapData(ImageOriginale.width,ImageOriginale.height);
			MiroirData.draw(ImageOriginale, Miroir);

			ImageMiroir.bitmapData = MiroirData;
			return ImageMiroir;
		}

	}
}