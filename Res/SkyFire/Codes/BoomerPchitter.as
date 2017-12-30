//Une particule qui explose en plusieurs particules
package Particules
{
 	import flash.display.Shape;
	import flash.geom.Point;
	import flash.geom.ColorTransform;


	public class BoomerPchitter extends Particule
	{
		private static const MeanNbChildren:int=120;

		private var Explosion:int=30;

		private var NbIteration:int=0;
		private var Operateur:Artificier;

		public function BoomerPchitter(Operateur:Artificier,Couleur:int=0xFFFFFF,Rayon:int=1,Densite:int=1)
		{//Les feux qui explosent
			this.Operateur=Operateur;
			this.Explosion=this.Explosion - 7 + 14*Math.random();
			super(Couleur,Rayon,Densite);
		}

		public override function Iterate():void
		{//Y a-t-il explosion ?
			NbIteration++;

			super.Iterate();

			if(NbIteration==Explosion && this.y<500)
			{//Boooom !
				Operateur.GarbageCollector();//On va rajouter beaucoup de particules, alors on nettoie d'abord.
				var NbChildren:int=MeanNbChildren;
				var Couleur:int=this.Couleur;
				for(var i:int=0;i<NbChildren;i++)
				{
					var Enfant:DistanceFader = new DistanceFader(Couleur);
					var Angle:Number=Math.random()*2*Math.PI;
					var Amplitude:int=50*Math.random();

					Enfant.Pos=new Point(this.x,this.y);
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
					Enfant.MaxDistance=12 + 14*Math.random();

					Operateur.Feux.push(Enfant);
				}
				this.Pos=new Point(0,2000);
				this.colorTransform=new ColorTransform(0,0,0,0,0,0,0,0);
			}

		}
	}
}