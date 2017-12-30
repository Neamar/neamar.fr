//Code original par Neamar. Réutilisation libre.
//neamar@neamar.fr
//Date : 2008

//Ligne de commande pour compiler :
//(après s'être placé dans le bon dossier, cf. http://neamar.fr/Res/Compiler_AS3/)
//
//bash mxmlc Sources/SkyFire/SkyFire.as -default-size 640 480 -compiler.strict

//Life begins when you can spend your spare time programming instead of watching television.

package
{

	import flash.display.Stage;//...
	import flash.display.StageDisplayState;//Pour le plein écran
	import flash.display.StageScaleMode;//Pour le plein écran
	import flash.display.Sprite;//La classe de base, fort utile !
	import flash.events.Event;//Les évenements "de bases", classe dont dérive MouseEvent
	import flash.events.MouseEvent;//Interaction utilisateur//souris
	import flash.geom.Rectangle;//Un rectangle : x,y, width, height
	import flash.geom.Point;//Un point tout ce qu'il y a de plus normal : défini par (x,y).
	import flash.text.TextField;//Champ de texte. Classe assez vaste, utilisée uniquement pour l'affichage de texte ici. Peut être du texte au format HTML.

	import flash.filters.BitmapFilter;//Classe globale pour les filtres
	import flash.filters.GlowFilter;//Filtre d'irridescence (éclairage, le plus utilisé)
	import flash.filters.BlurFilter//Flouter
	import flash.filters.BevelFilter;//Effet de biseau, appliqué sur le "Plus de jeux".
	import flash.filters.DisplacementMapFilter;
	import flash.filters.DisplacementMapFilterMode;

	import flash.display.Bitmap;
	import flash.display.BitmapData;
	import flash.display.BitmapDataChannel;
	import flash.display.GradientType;
	import flash.display.SpreadMethod;
	import flash.display.Sprite;
	import flash.display.Shape;
	import flash.geom.ColorTransform;

	import flash.geom.Matrix;

	import flash.system.System;

	import Particules.*;


	[SWF(frameRate = 25)];//Quelques paramètres pour la compilation. Ils sont cependant redéfinis dans la ligne de commande, mais laissés ici pour des raisons sentimentales (sic)

	public class SkyFire extends Sprite
	{
		private static const MaxDistance:int=8;
		public static const Origine:Point=new Point();
		public static const Size:Point=new Point(800,600);
		public static const Ecran:Rectangle = new Rectangle(0,0,Size.x,Size.y);
		public static const TransformationMatrix:Matrix=new Matrix(1,0,0,1);//La matrice par défaut d'affichage : scaleX=scaleY = 1, pas de transformée

		public var d_Fond:BitmapData=new BitmapData(Size.x,Size.y,false,0x000000);
		public var Fond:Bitmap;
		public var Operateur:Artificier;

		public var Items:Array=new Array();

		private var k:int=0;
		private var Ligne:Shape=new Shape();
		private var Fumee:BlurFilter=new BlurFilter(8,8);

		function SkyFire():void
		{
			include "../Trace.as";
 			Fond=new Bitmap(d_Fond);

 			addChild(Fond);

 			function toggleFullScreen(e:MouseEvent):void
			{
				stage.displayState = StageDisplayState.FULL_SCREEN;
				stage.scaleMode= StageScaleMode.SHOW_ALL;
// 				Fond.pixelSmoothing=true;//Lisser le bitmap.
			}

			stage.addEventListener(MouseEvent.CLICK,toggleFullScreen);

			Operateur = new Artificier();
			addEventListener(Event.ENTER_FRAME,Move);


			function Move(e:Event):void
			{
				d_Fond.lock();//Economiser les ressources

				//Flouter les anciens évenements
				//function applyFilter(sourceBitmapData:BitmapData, sourceRect:Rectangle, destPoint:Point, filter:BitmapFilter):void
				d_Fond.applyFilter(d_Fond,Ecran,Origine,Fumee);

				for each(var Item:Particule in Operateur.Feux)//ON "tronque" à Particule, même si c'est une classe qui dérive de Particule.
				{
					if(Item.y<=Size.y)
					{
						Ligne.graphics.clear();
						Ligne.graphics.lineStyle(Item.Diametre,Item.Couleur,.4)
						Ligne.graphics.moveTo(Item.x,Item.y);

						Item.Iterate();


						Ligne.graphics.lineTo(Item.x,Item.y);
						Ligne.filters=Item.filters;

						//function draw(source:IBitmapDrawable, matrix:Matrix = null, colorTransform:ColorTransform = null, blendMode:String = null, clipRect:Rectangle = null, smoothing:Boolean = false):void
						d_Fond.draw(Ligne,TransformationMatrix,Item.colorTransform);
					}
				}

// 				Trace(System.totalMemory / 1000000 + "Mb");
				d_Fond.unlock();

			}
		}
	}
}
