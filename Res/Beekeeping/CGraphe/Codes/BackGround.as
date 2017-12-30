//Le nuage bleu derrière chaque niveau.
//Baisser la qualité permet d'arrêter la génération du bruit pour récupérer des ressources.
package
{
	import flash.display.Bitmap;
	import flash.display.BitmapData;
	import flash.display.BitmapDataChannel;
	import flash.display.Sprite;
	import flash.filters.BitmapFilter;
	import flash.filters.DisplacementMapFilter;
	import flash.filters.DisplacementMapFilterMode;
	import flash.geom.Matrix;
	import flash.geom.Point;
	import flash.geom.Rectangle;
	import flash.events.Event;//Les évenements "de bases", classe dont dérive MouseEvent

	public class BackGround extends Sprite
	{
 		public var Fond:BitmapData = new BitmapData(640,480, false);

 		private var PetitFond:BitmapData=new BitmapData(128,96,false);
		private var Champ:BitmapData=new BitmapData(128,96,true,0x00000000);
		private var Affichage:Bitmap;
		private var Influence:Bitmap;
		private var Nb:int=-1;
		private var StartValue:int;

		private var Layer:Land;
		private var Size:int=30;

		private static var FiltreDessin:DisplacementMapFilter=new DisplacementMapFilter(null,new Point(0,0),BitmapDataChannel.RED,BitmapDataChannel.RED,40,40,DisplacementMapFilterMode.CLAMP);
		private static var FiltreMvt:DisplacementMapFilter=new DisplacementMapFilter(null,new Point(0,0),BitmapDataChannel.BLUE,BitmapDataChannel.BLUE,15,15,DisplacementMapFilterMode.CLAMP,0.25,1)

		public function BackGround(Layer:Land)
		{

			this.Layer=Layer;
			StartValue=Math.random()*100;

			Champ.perlinNoise(128,96,4,StartValue+1,false,false,BitmapDataChannel.RED,false);

			Affichage = new Bitmap(Fond);
			this.addChild(Affichage);

			Influence=new Bitmap(Champ);
			Influence.scaleX=Influence.scaleY=5;
			addChild(Influence);
			Influence.alpha=.2

			this.addEventListener(Event.ENTER_FRAME,Anim_Fond);
		}

		public function StopBackGround():void
		{
			this.removeEventListener(Event.ENTER_FRAME,Anim_Fond);
			Anim_Fond();//L'appeler juste une fois, pour quand même avoir un fond.
		}

		public function Anim_Fond(e:Event=null):void
		{
			Nb++;
			if(Nb % 3==0 && (Const._stage.quality=="HIGH" || Nb ==0))
			{
			//public function perlinNoise(baseX:Number, baseY:Number, numOctaves:uint, randomSeed:int, stitch:Boolean, fractalNoise:Boolean, channelOptions:uint = 7, grayScale:Boolean = false, offsets:Array = null):void

			PetitFond.perlinNoise(128,96,2,StartValue,false,false,BitmapDataChannel.BLUE,false,new Array(new Point(Nb,0),new Point(Nb>> 1,0)));//>>1 = *.5

			FiltreDessin.mapBitmap=Champ;
 			PetitFond.applyFilter(PetitFond,new Rectangle(0,0,128,96),new Point(0,0),FiltreDessin);

 			Fond.draw(PetitFond,new Matrix(5,0,0,5));

			FiltreMvt.mapBitmap=Fond;
 			this.Layer.PremierPlan.filters=new Array(FiltreMvt);
 			}

		}
    }
}
