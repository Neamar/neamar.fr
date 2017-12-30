//Un artificer virtuel qui gère tous les feux
package
{
	import flash.display.Shape;
	import flash.geom.Point;
    import flash.utils.Timer;
    import flash.events.TimerEvent;
    import flash.events.Event;

	import Particules.*;

	public class Artificier extends Shape
	{
		public var Feux:Array=new Array();
		public var GarbageCollectorTimer:Timer= new Timer(15000);


		public function Artificier()
		{
			addEventListener(Event.ENTER_FRAME,AjoutFeux);

			GarbageCollectorTimer.start();
			GarbageCollectorTimer.addEventListener(TimerEvent.TIMER, GarbageCollector);
		}

		public function AjoutFeux(e:Event):void
		{
			AjoutFontaine();
			AjoutRampant();
			AjoutBoomer();
			AjoutBiBoomer();
			AjoutPchitter();
			AjoutBoomerPchitter();
		}

		public function GarbageCollector(e:TimerEvent=null):void
		{
			function Cleaner(Element:*, Index:int, Arr:Array):*
			{//Nettoie les artifices inutilisés
				return (Element.y<SkyFire.Size.y)
			}
			Feux = Feux.filter(Cleaner);
		}



		private function Prob(P:Number):Boolean
		{
			return (Math.random()<P)
		}

		private function AjoutFontaine():void
		{//Les feux de type fontaine qui ne s'atténuent pas dans le temps, et retombent forcément. Couleur blanche
			if(Prob(.15))
			{
				var	Ma_Particule:Particule=new Particule();
				var Angle:Number=Math.random()*Math.PI;

				Ma_Particule.Pos=new Point(SkyFire.Size.x*Math.random(),SkyFire.Size.y);
				Ma_Particule.applyForce
				(
					new Vecteur
					(
						(100*Math.random())*Math.cos(Angle),
						-(50 + 60*Math.random())*Math.sin(Angle)
					)
				);

				Ma_Particule.glow=10*Math.random()+4;

				Feux.push(Ma_Particule);
			}
		}

		private function AjoutRampant():void
		{//Les feux "normaux" qui montent et s'éteignent à leur apogée. Couleur aléatoire.
			if(Prob(.04))
			{
				var	Ma_Particule:SpeedFader=new SpeedFader(Math.random()*0xFFFFFF);
				var Angle:Number=Math.random()*Math.PI;

				Ma_Particule.Pos=new Point(SkyFire.Size.x*Math.random(),SkyFire.Size.y);
				Ma_Particule.applyForce
				(
					new Vecteur
					(
						(100*Math.random()+2)*Math.cos(Angle),
						-(100*Math.random() + 50 )*Math.sin(Angle)
					)
				);

				Ma_Particule.glow=20*Math.random()+4;

				Feux.push(Ma_Particule);
			}
		}

		private function AjoutBoomer():void
		{//Les feux qui explosent en une gerbe de fontaines. Rouge à l'origine, couleur aléatoire après
			if(Prob(.015))
			{
				var	Ma_Particule:Boomer=new Boomer(this,0xFF0000);
				var Angle:Number=Math.PI/4 + Math.random()*Math.PI/2;

				Ma_Particule.Pos=new Point(SkyFire.Size.x*Math.random(),SkyFire.Size.y);
				Ma_Particule.applyForce
				(
					new Vecteur
					(
						(100*Math.random())*Math.cos(Angle),
						-(50 + 100*Math.random())*Math.sin(Angle)
					)
				);

				Ma_Particule.glow=6*Math.random()+20;

				Feux.push(Ma_Particule);
			}
		}

		private function AjoutBiBoomer():void
		{//Des feux qui explosent en feux qui explosent : des bi-boomers en quelque sorte !
			if(Prob(.0025))
			{
				var	Ma_Particule:BiBoomer=new BiBoomer(this,0xFF0000);
				var Angle:Number=Math.PI/4 + Math.random()*Math.PI/2;

				Ma_Particule.Pos=new Point(SkyFire.Size.x*Math.random(),SkyFire.Size.y);
				Ma_Particule.applyForce
				(
					new Vecteur
					(
						(100*Math.random())*Math.cos(Angle),
						-(50 + 100*Math.random())*Math.sin(Angle)
					)
				);

				Ma_Particule.glow=6*Math.random()+20;

				Feux.push(Ma_Particule);
			}
		}

		private function AjoutPchitter():void
		{//Les feux "normaux" un peu améliorés : ils ont des étincelles à leurs bouts. Couleur aléatoire.
			if(Prob(.1))
			{
				var	Ma_Particule:Pchitter=new Pchitter(this,Math.random()*0xFFFFFF);
				var Angle:Number=Math.random()*Math.PI;

				Ma_Particule.Pos=new Point(SkyFire.Size.x*Math.random(),SkyFire.Size.y);
				Ma_Particule.applyForce
				(
					new Vecteur
					(
						(100*Math.random())*Math.cos(Angle),
						-(100*Math.random() + 50 )*Math.sin(Angle)
					)
				);

				Ma_Particule.glow=20*Math.random()+4;

				Feux.push(Ma_Particule);
			}
		}

		private function AjoutBoomerPchitter():void
		{//Les feux qui explosent, relachant plein de petites étincelles.
			if(Prob(.03))
			{
				var	Ma_Particule:BoomerPchitter=new BoomerPchitter(this,Math.random()*0xFFFFFF);
				var Angle:Number=Math.random()*Math.PI;

				Ma_Particule.Pos=new Point(SkyFire.Size.x*Math.random(),SkyFire.Size.y);
				Ma_Particule.applyForce
				(
					new Vecteur
					(
						(100*Math.random())*Math.cos(Angle),
						-(100*Math.random() + 50 )*Math.sin(Angle)
					)
				);

				Ma_Particule.glow=20*Math.random()+4;

				Feux.push(Ma_Particule);
			}
		}
	}
}