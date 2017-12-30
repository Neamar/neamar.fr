package Levels
{
	import com.greensock.TweenLite;
	import flash.display.Bitmap;
	import flash.display.Loader;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.net.navigateToURL;
	import flash.net.URLRequest;
	import flash.system.LoaderContext;
	
	/**
	 * Le niveau de présentation des crédits
	 * @author Neamar
	 */
	public class EndLevel extends Level
	{
		[Embed(source = "../../assets/Fin.jpg")]
		private static var Fin:Class;
		private static var Img_Fond:Loader;
		
		private var Image:Loader = Img_Fond;
		
		public function EndLevel(Datas:String)
		{	
			//Écraser les Datas et les remplacer par le positionnement des clous.
			Datas = "1000,1000|1001,1001|218,45|294,33|361,13|439,25|48,243|176,276|341,276|560,237:0,1";
			super(Datas);

			
			if (Image == null)
			{//On arrive probablement directement sur ce niveau, et le fichier n'a pas été chargé. Faire ça en urgence !
				downloadDatas();
				Image = Img_Fond;
			}
			
			addChild(Image);
			setChildIndex(Image, 0);
		}
		
		/**
		 * Rarement appelé, sauf si on fait touche gauche pour revenir au niveau précédent.
		 * @param	e
		 */
		public override final function destroy(e:Event=null):void
		{
			if(contains(Image))
				removeChild(Image);
			Image = null;
		}
		
		/**
		 * Initialise (réinitialise) un objet Eulris pour le niveau.
		 */
		protected override function initEulris(e:Event=null):void
		{
			super.initEulris(e);
			if (Image != null)
			{
				addChild(Image);
				setChildIndex(Image, 0);
			}
		}
		
		/**
		 * Si le mec s'amuse à joueur, s'assurer qu'il ne peut pas gagner :)
		 */
		protected override final function checkVictory():void
		{
		}
		
		/**
		 * L'image finale est relativement lourde, et rarement vue (malheureusement).
		 * Plutôt que de l'inclure dans le swf, elle est donc téléchargée dynamiquement si la progression de l'utilisateur laisse croire qu'il va s'en sortir (bref, qu'il arrive sur l'avant dernier niveau :))
		 */
		public static function downloadDatas():void
		{
			Img_Fond = new Loader()
			Img_Fond.load(new URLRequest("http://neamar.fr/Res/Icosien/Images/assets/Fin.jpg"),new LoaderContext(true));
		}
		
		
	}
	
}