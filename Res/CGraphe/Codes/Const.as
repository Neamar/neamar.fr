//Les constantes utilisées tout au long de l'exécution.
//Les variables sont mises static afin d epouvoir y accéder à partir de n'importe quelle classe de CGraphe.
package
{
	import flash.filters.BevelFilter;
	import flash.filters.GlowFilter;
	import flash.display.Stage;

	public class Const
	{
		public static var _stage:Stage; //Pouvoir bénéficier du stage partout.

		public static  const VERSION:String="Final";//La version
			public static const DEBUG:String="debug";
			public static const RELEASE:String="release"
		public static const MODE:String=RELEASE;//Le mode debug affiche des informations utiles concernant l'intelligence artificielle.

		public static const SHORT:int=0;
		public static const CUT:int=1;
		public static const AI_NOT_SMART:Boolean=false;
		public static const AI_SMART:Boolean=true;

		public static const HUMAN:int=0;
		public static const COMPUTER:int=1;
		public static const INTERNET:int=2;

		public static const FLASHWIDTH:int = 640;
		public static const FLASHHEIGHT:int = 480;

		public static const BEVEL_IN:BevelFilter=new BevelFilter(8,45,0x000000);
		public static const BEVEL_OUT:BevelFilter=new BevelFilter();

		public static const Filtre_Noeuds_Extremes:Array=new Array(new GlowFilter(0xFF0000, 0.8,16,16,4),new GlowFilter(0xFF0000, 0.8,8,8,4,1,true))

		public function Const()
		{
		}
	}
}