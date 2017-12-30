package Niveaux 
{
	import com.greensock.TweenMax;
	import flash.display.Sprite;
	
	/**
	 * Un anneau, utilisé dans beaucoup de niveaux.
	 * Cercle légérement entrouvert, type Circlip.
	 * @author Neamar
	 */
	public class Ring extends Sprite
	{
		public var RayonOut:int = 15;
		
		private var _rotation:Number = 0;
		
		public function Ring(x:int,y:int,Rayon:int=50, Angle:Number=(Math.PI/6)) 
		{
			RayonOut += Rayon;
			
			super();
			this.x = x;
			this.y = y;
			
			//Diviser l'angle par 2 pour travailler avec plus facilement
			Angle = Angle / 2;
			
			this.graphics.lineStyle(5, 0);
			
			//this.graphics.drawCircle(0, 0, Rayon);
			
			this.graphics.moveTo(RayonOut * Math.cos(Angle), RayonOut * Math.sin(Angle));
			this.graphics.lineTo(Rayon * Math.cos(Angle), Rayon * Math.sin(Angle));
			for (var teta:Number = Angle; teta < 2 * Math.PI - Angle; teta += Math.PI / 30)
				this.graphics.lineTo(Rayon * Math.cos(teta), Rayon * Math.sin(teta));
			this.graphics.lineTo(RayonOut * Math.cos(-Angle), RayonOut * Math.sin(-Angle));
		}
		
		public function destroy():void
		{
			this.graphics.clear();
			TweenMax.killTweensOf(this);
		}
		
		public function tournerVersRelatif(Angle:Number):void
		{
			if(Angle!=0)
				tournerVers(_rotation + Angle);
		}
		
		public function tournerVers(Angle:Number):void
		{
			Angle = Angle % 360;
				
			_rotation = Angle;
			
			TweenMax.to(this, .5, { shortRotation:{rotation:Angle} } );
		}
	}
}