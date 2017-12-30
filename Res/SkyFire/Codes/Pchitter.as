//Une particule qui explose en plusieurs particules
package Particules
{
 	import flash.display.Shape;
	import flash.geom.Point;
	import flash.geom.ColorTransform;


	public class Pchitter extends SpeedFader
	{

		private static const MeanNbChildren:int=2;

		private var Operateur:Artificier;

		public function Pchitter(Operateur:Artificier,Couleur:int=0xFFFFFF,Rayon:int=1,Densite:int=1)
		{//Les feux qui pétillent, extension de Fader, lui même extension de Particule
			this.Operateur=Operateur;
			super(Couleur,Rayon,Densite);
		}

		public override function Iterate():void
		{

			super.Iterate();

			if(this.y<400 && this.Vitesse.y<0)
			{//Pchitt

				var NbChildren:int=2*Math.random();
				var Couleur:int=this.Couleur;
				for(var i:int=0;i<NbChildren;i++)
				{
					var Enfant:DistanceFader = new DistanceFader(Couleur);
					var Angle:Number=Math.random()*2*Math.PI;
					var Amplitude:int=30*Math.random();

					Enfant.Pos=new Point(this.x + 20*Math.random() - 10,this.y + 20*Math.random() - 10);
					Enfant.applyForce
					(
						new Vecteur
						(
							this.Vitesse.x + Amplitude*Math.cos(Angle),
							this.Vitesse.y + Amplitude*Math.sin(Angle)
						)
					);
					Enfant.Gravite=new Vecteur();
					Enfant.glow=1;

					Operateur.Feux.push(Enfant);
				}
// 				this.Pos=new Point(0,2000);
// 				this.transform.colorTransform=new ColorTransform(0,0,0,0,0,0,0,0);
			}

		}
	}
}