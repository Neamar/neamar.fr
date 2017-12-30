package Web
{
	
	/**
	 * Indique un point d'accroche pour le fil.
	 * @author Neamar
	 */
	public class Hook
	{
		public var P:Point;
		public var Angle:Number;
		public var Sens:int;
		
		/**
		 * Construit un objet d'accroche du fil.
		 * @param	P le point d'accroche
		 * @param	Angle l'angle sur lequel le fil s'est enroulé
		 * @param	Sens dans quel sens le fil s'est enrolé (-1 ou +1)
		 */
		function Hook(P:Point,Angle:Number,Sens:int)
		{
			this.P = P;
			this.Angle = Angle;
			this.Sens = Sens;
		}
	}
	
}