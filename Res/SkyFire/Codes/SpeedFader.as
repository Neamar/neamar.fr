//Une particule qui se dissout en dessous d'une certaine vitesse selon Y.
//Ne pas confondre avec DistanceFader, qui se dissout quand elle atteint une durée de vie maxi.
package Particules
{
 	import flash.display.Shape;
	import flash.geom.Point;

	import flash.geom.ColorTransform;


	public class SpeedFader extends Particule
	{
		public var MaxYSpeed:int=30;

		public function SpeedFader(Couleur:int=0xFFFFFF,Rayon:int=1,Densite:int=1)
		{//les feux qui disparaissent progressivement
			super(Couleur,Rayon,Densite);
		}

		public override function Iterate():void
		{//Atténuer la couleur
			var CoeffAttenuation:Number=(MaxYSpeed - this.Vitesse.y)/MaxYSpeed;
			if(this.Vitesse.y>0)
				this.colorTransform=new ColorTransform(CoeffAttenuation,CoeffAttenuation,CoeffAttenuation);
			else
				this.colorTransform=new ColorTransform();

			super.Iterate();
		}
	}
}