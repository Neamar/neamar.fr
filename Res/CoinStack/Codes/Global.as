package 
{
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.display.Stage;
	import flash.filters.DropShadowFilter;
	import flash.text.TextField;
	import flash.text.TextFieldAutoSize;
	

	
	/**
	 * ...
	 * @author Neamar
	 */
	public class Global 
	{
		public static var stage:Stage;
		
		public static const FLASH_WIDTH:int = 640;
		public static const FLASH_HEIGHT:int = 480;
		
		public static const LEVEL_TIME:int = 60*1000;
		public static const COINS_IN_GAME:int = 500;
		public static const TOLERANCE:int = 3;//La tolérance indique de combien de pixels peut se tromper le joueur, certaines jonctions étant assez traitres.
		
		public static const SHADOW:DropShadowFilter = new DropShadowFilter(7, -45, 0, 0.8, 4, 4, 2);
		//public static const LIGHT:DropShadowFilter = new DropShadowFilter(3, -45, 0xFFFFFF, 0.5, 2, 2, 3,1,true);
		
		public static var Score:int = 0;
		
		public static var Logo:Loader;
	
	}
	
}