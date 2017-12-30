package
{
	import flash.geom.Point;
	public class t_OpenList
	{
		public var Visite:Boolean;
		public var Parent:Point;
		public var Ferme:Boolean;
		public function t_OpenList(Parent:Point,Visite:Boolean=false,Ferme:Boolean=false)
		{
			this.Visite=Visite;
			this.Parent=Parent;
			this.Ferme=Ferme;
		}
	}
}