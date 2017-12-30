//Une particule qui explose en plusieurs particules
package Particules
{
 	import flash.display.Shape;
	import flash.geom.Point;
	import flash.geom.ColorTransform;


	public class BiBoomer extends Particule
	{
		private static const Explosion:int=20;
		private static const MeanNbChildren:int=30;

		private var NbIteration:int=0;
		private var Operateur:Artificier;

		public function BiBoomer(Operateur:Artificier,Couleur:int=0xFFFFFF,Rayon:int=1,Densite:int=1)
		{//Les feux qui explosent
			this.Operateur=Operateur;
			super(Couleur,Rayon,Densite);
		}

		public override function Iterate():void
		{//Y a-t-il explosion ?
			NbIteration++;

			super.Iterate();

			if(NbIteration>=Explosion && this.y<500 && Math.random()<.2)
			{//Boooom !

				var NbChildren:int=MeanNbChildren - 5 + 10*Math.random();
				var Couleur:int=0xFF0000;//0xFFFFFF*Math.random();
				for(var i:int=0;i<NbChildren;i++)
				{
					var Enfant:Boomer = new Boomer(this.Operateur,Couleur);
					var Angle:Number=i*2*Math.PI / NbChildren;
					var Amplitude:int=20*Math.random()+70;

					Enfant.Pos=new Point(this.x,this.y);
					Enfant.applyForce
					(
						new Vecteur
						(
							Amplitude*Math.cos(Angle),
							Amplitude*Math.sin(Angle)
						)
					);

					Enfant.glow=8;

					Operateur.Feux.push(Enfant);
				}
				this.Pos=new Point(0,2000);
				this.colorTransform=new ColorTransform(0,0,0,0,0,0,0,0);
			}

		}
	}
}