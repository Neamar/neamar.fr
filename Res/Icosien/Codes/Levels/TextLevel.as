package Levels
{
	import com.greensock.TweenLite;
	import flash.display.Bitmap;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.filters.DropShadowFilter;
	import flash.text.TextField;
	import flash.text.TextFormat;
	
	/**
	 * Un niveau avec de l'aide.
	 * Pas vraiment utile d'un point de vue conceptuel, mais pratique pour séparer les concepts et ne pas tout balancer sur Level.
	 * @author Neamar
	 */
	public class TextLevel extends Level
	{
		private static var TextEffet:Array = new Array(new DropShadowFilter(1, 40, 0, 1, 1, 1, 1, 1, true));
		[Embed(source = "../../assets/Laouib.ttf", fontFamily = "Laouib", fontWeight = "bold", mimeType="application/x-font-truetype")]
		private static var EmbedFont:String;
		
		private static var Aide_format:TextFormat = new TextFormat();
		{
			Aide_format.font = "Laouib";
			Aide_format.size = 18;
			Aide_format.bold = true
			Aide_format.color = 0xd2cdc3;
		}
		protected var Aide:TextField = new TextField();
		protected var AideEffet:Sprite = new Sprite();
		
		protected var Infos:TextField = new TextField();
		protected var InfosEffet:Sprite = new Sprite();
		
		/**
		 * Constructeur du niveau.
		 * @param	Datas cf. super()
		 * @param	Texte le texte à afficher au format HTML.
		 */
		public function TextLevel(Datas:String,Texte:String="")
		{
			super(Datas);

			//Numéro du niveau.
			Infos.x=60;
			Infos.y = 65;
			Infos.width = 500;
			Infos.height = 400;
			initTextField(Infos, InfosEffet);
			InfosEffet.filters = Background.Instance.Deplacement;
			
			//Texte d'aide.
			if (Texte != "")
			{
				Aide.x=60;
				Aide.y = 65;
				Aide.width = 500;
				Aide.height = 400;
				
				initTextField(Aide, AideEffet);
				Aide.multiline = true;
				Aide.wordWrap = true;
				
				AideEffet.filters = TextEffet;
				
				Text = Texte;
			}
		}
		
		public override function destroy(e:Event=null):void
		{
			Aide.htmlText = Infos.htmlText = "";
			
			if (contains(AideEffet))
				removeChild(AideEffet);
			removeChild(InfosEffet);
			AideEffet.filters = InfosEffet.filters = null;
			Aide = Infos = null;
		}
		
		/**
		 * Afficher un texte d'aide.
		 * @param Texte en HTML
		 */
		public function set Text(Texte:String):void
		{
			if (!contains(AideEffet))
				throw new Error("Ce niveau n'a pas été initialisé pour afficher du texte.");
			Aide.htmlText = Texte;
		}
		
		/**
		 * Afficher le numéro du niveau.
		 * @param Texte brut.
		 */
		public function set Caption(Texte:String):void
		{
			Infos.text = Texte;
			Infos.x = Main.WIDTH - Infos.textWidth - 20;
			Infos.y = Main.HEIGHT - Infos.textHeight;
		}
		
		/**
		 * Initialise un Textfield pour qu'il ait le style par défaut.
		 * @param	T le textfield
		 * @param	Container son container
		 */
		protected function initTextField(T:TextField,Container:Sprite):void
		{
			T.embedFonts = true;
			T.defaultTextFormat = Aide_format;
			//T.autoSize = "left";
			T.thickness=3;
			T.selectable=false;
			T.mouseEnabled = Container.mouseEnabled = false;
			Container.addChild(T);
			addChild(Container);
			
			//Toujours garder l'effet en bas, sinon on ne peut plus cliquer sur les noeuds
			function setEffetUnderEverything(e:Event=null):void
			{
				setChildIndex(Container, 0);
			}
			addEventListener(Level.LEVEL_RESTART, setEffetUnderEverything);
			setEffetUnderEverything();
		}
	}
	
}