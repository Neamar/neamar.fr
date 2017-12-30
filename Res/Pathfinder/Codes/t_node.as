package
{
	import flash.geom.Point;
	public class t_Node
	{
		public var Empl:Point;
		public var F:uint;
		public var G:uint;
		public var H:uint;
		public var Parent:Point;

		public function t_Node(Empl:Point,F:uint,G:uint,H:uint,Parent:Point)
		{
			this.Empl = Empl;
			this.F = F;
			this.G = G;
			this.H = H;
			this.Parent = Parent;
		}
	}
}
