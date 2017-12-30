package
{
	import flash.display.Sprite;
	public class t_Ligne extends Sprite
	{
		public var Indestructible:Boolean; //Cette ligne est elle destructible ?
		public function t_Ligne(Indestructible:Boolean=false)
		{
			this.Indestructible = Indestructible;
		}
	}
}