//Une particule qui se dissout quand elle atteint une durée de vie maxi.
//Ne pas confondre avec SpeedFader, qui se dissout en dessous d'une certaine vitesse selon Y.
package Particules
{
 	import flash.display.Shape;
	import flash.geom.Point;

	import flash.geom.ColorTransform;


	public class DistanceFader extends Particule
	{
		public var MaxDistance:int=7;

		private var NbIteration:int=0;

		public function DistanceFader(Couleur:int=0xFFFFFF,Rayon:int=1,Densite:int=1)
		{//les feux qui disparaissent progressivement
			super(Couleur,Rayon,Densite);
		}

		public override function Iterate():void
		{//Atténuer la couleur
			NbIteration++;
			var CoeffAttenuation:Number=1-(NbIteration/MaxDistance);
			if(NbIteration<MaxDistance)
			{
				this.colorTransform=new ColorTransform(CoeffAttenuation,CoeffAttenuation,CoeffAttenuation);
				this.glow = this.glow * .9
			}
			else if(NbIteration==MaxDistance)
			{
				this.colorTransform=new ColorTransform(0,0,0,0,0,0,0,0);
				this.Gravite=new Vecteur(0,60);
			}

			super.Iterate();
		}
	}
}