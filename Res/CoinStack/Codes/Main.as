package 
{
	import flash.display.Loader;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.KeyboardEvent;
	import flash.events.MouseEvent;
	import flash.events.TextEvent;
	import flash.net.navigateToURL;
	import flash.net.sendToURL;
	import flash.net.URLRequest;
	import flash.system.LoaderContext;
	import flash.text.TextField;
	import flash.text.TextFieldAutoSize;
	import flash.text.TextFieldType;
	import gs.easing.Elastic;
	import gs.TweenLite;
	
	import gs.OverwriteManager;
	import mochi.as3.*;
	
	/**
	 * Crée un nouveau jeu CoinStack.
	 * 
	 * <p>Le but de cette application Flash est de ramasser un maximum de pièces.
	 * Une pièce ne peut être ramassée que si elle n'est pas recouverte par d'autres pièces.
	 * Au niveau du code, cette application est extrêmement simple.</p>
	 * <p>On distingue les classes suivantes :</p>
	 * <ul>
	 * <li>Level : Un niveau. Affiche une pub, l'aide, puis le jeu. A la fin du temps réglementaire, les pièces disparaissent une à une. Lorsque la dernière pièce a disparue, le niveau envoie l'évenement Level.LEVEL_ENDED, qui est récupére par cette classe pour enregistrer le score grâce au leaderboard mochiads ;</li>
	 * <li>Coin : Une pièce.</li>
	 * </ul>
	 * 
	 * <p>En plus de ces deux classes, on trouve :</p>
	 * <ul>
	 * <li>Global : une classe qui contient en statique toutes les constantes du jeu, ainsi que le score et autre ;</li>
	 * <li>SecondSprite : un sprite dynamic, pour afficher les publicités mochiads.</li>
	 * </ul>
	 * @author Neamar
	 */
	public class Main extends Sprite 
	{
		/**
		 * L'image du billet de 500€
		 * 
		 */
		public var Fond:Loader = new Loader();
		
		private var Sponsor:Loader = new Loader();
		private var Logo:Loader = new Loader();
		
		private var Niveau:Level;
		private var Scores:SecondSprite = new SecondSprite();
		
		private var EnregistrerScore:Sprite = new Sprite();
		private var EnregistrerScore_Texte:TextField = new TextField();
		private var EnregistrerScore_Pseudo:TextField = new TextField();
		private var EnregistrerScore_OK:TextField = new TextField();
		
		public function Main():void 
		{
			if (stage) init();
			else addEventListener(Event.ADDED_TO_STAGE, init);
		}
		
		private function init(e:Event = null):void 
		{
			removeEventListener(Event.ADDED_TO_STAGE, init);
			// entry point
			
			//Enregistrer le nouveau joueur :
			sendToURL(new URLRequest("http://neamar.fr/Res/CoinStack/Player.php"));
			
			OverwriteManager.init();
			
			Global.stage = this.stage;
			
			addChild(Scores);
			
			MochiServices.connect("42bc08b63834e4b6", Scores);
			
			Niveau = new Level();
			Niveau.addEventListener(Level.LEVEL_ENDED, niveauTermine);
			
			Fond.load(new URLRequest("http://neamar.fr/Res/CoinStack/Images/500.jpg"),new LoaderContext(true));
			addChild(Fond);
			setChildIndex(Fond, 0);
			
			//On met cet écouteur d'évenement ici pour ne pas le répéter.
			EnregistrerScore_Pseudo.addEventListener(KeyboardEvent.KEY_DOWN, toucheAppuyee);
			EnregistrerScore_OK.addEventListener(MouseEvent.CLICK, saveScore);
			
			Sponsor.load(new URLRequest("http://neamar.fr/Res/CoinStack/Images/MiniJeu.png"), new LoaderContext(true));
			Sponsor.addEventListener(MouseEvent.CLICK, visiterSponsor);
			
			Logo.load(new URLRequest("http://neamar.fr/Res/CoinStack/Images/CoinStack.png"), new LoaderContext(true));
			Global.Logo = Logo;
		}
		
		/**
		 * Valide la case avec le pseudo du joueur.
		 * 
		 * @param e L'évenement clavier.
		 * @author Neamar
		 */
		private function toucheAppuyee(e:KeyboardEvent):void 
		{
			if (e.charCode == 13 || e.keyCode == 13)
				EnregistrerScore_OK.dispatchEvent(new MouseEvent(MouseEvent.CLICK));
		}
		
		/**
		 * Fonction appelée quand l'évenement Level.LEVEL_ENDED est émis.
		 * 
		 * Affiche une boite permettant d'enregistrer son pseudo et son score, ainsi que le sponsor du jeu.
		 * @param e Inutile
		 * @author Neamar
		 */
		public function niveauTermine(e:Event=null):void
		{	
			removeEventListener(Level.LEVEL_ENDED, niveauTermine);
			this.stage.removeChild(Niveau);
			
			EnregistrerScore.graphics.clear();
			EnregistrerScore.addChild(EnregistrerScore_Texte);
			
			EnregistrerScore_Texte.multiline = true;
			EnregistrerScore_Texte.width = 380;
			//EnregistrerScore_Texte.height = 100;
			EnregistrerScore_Texte.x = 20;
			EnregistrerScore_Texte.y = 5;
			EnregistrerScore_Texte.htmlText ="<font size=\"20\">Fin de la partie.</font><br>Votre score : <b>" + Global.Score + "</b><br><br>Entrez votre pseudo pour enregistrer vos points :";
			EnregistrerScore_Texte.selectable = false;

			
			EnregistrerScore.addChild(EnregistrerScore_Pseudo);

			EnregistrerScore_Pseudo.autoSize = TextFieldAutoSize.CENTER;
			EnregistrerScore_Pseudo.type = TextFieldType.INPUT;
			if(EnregistrerScore_Pseudo.text=='')
				EnregistrerScore_Pseudo.text = "Pseudo";
			EnregistrerScore_Pseudo.width = 100;
			EnregistrerScore_Pseudo.height = 25;
			EnregistrerScore_Pseudo.background = true;
			EnregistrerScore_Pseudo.backgroundColor = 0xFFFFFF;
			EnregistrerScore_Pseudo.alpha = .4;
			EnregistrerScore_Pseudo.x = EnregistrerScore_Texte.width/2 - EnregistrerScore_Pseudo.width / 2;
			EnregistrerScore_Pseudo.y = EnregistrerScore_Texte.height - 20;
			
			addChild(EnregistrerScore);
			EnregistrerScore.scaleX = EnregistrerScore.scaleY = 1.4;					
			EnregistrerScore.x = Global.FLASH_WIDTH / 2 - 200;
			EnregistrerScore.y = 480;
			TweenLite.to(EnregistrerScore,2,{y:35,ease:Elastic.easeOut});
			EnregistrerScore.width = 400;
			//EnregistrerScore.height = 200;
			EnregistrerScore.filters=new Array(Global.SHADOW);
			
			EnregistrerScore.graphics.lineStyle(2, 0, .8);
			EnregistrerScore.graphics.beginFill(0xFFFFFF, .4);
			EnregistrerScore.graphics.drawRoundRect(0, 0, EnregistrerScore.width, 120, 10, 10);
			
			EnregistrerScore.addChild(EnregistrerScore_OK);
			EnregistrerScore_OK.text = "Enregistrer";
			EnregistrerScore_OK.selectable = false;
			EnregistrerScore_OK.textColor = 0xB30000;
			EnregistrerScore_OK.x = 300;
			EnregistrerScore_OK.y = 80;
			
			//Le sponsor MiniJeu gratuit :
			addChild(Sponsor);
			Sponsor.x = Global.FLASH_WIDTH / 2 - 303 / 2;//303 = Sponsor.width
			Sponsor.y = 220;
			
			
			Global.stage.focus = EnregistrerScore_Pseudo;
			EnregistrerScore_Pseudo.setSelection(0, EnregistrerScore_Pseudo.text.length);
		}
		
		/**
		 * Fonction appelée quand l'utilisateur a entré son pseudo et appuyé sur "Enregistrer".
		 * 
		 * Enregistre le score et l'envoie aux serveurs de MochiAds, affiche le leaderBoard.
		 * @param e Inutile
		 * @author Neamar
		 */
		public function saveScore(e:Event):void
		{
			if (EnregistrerScore_Pseudo.text == "Pseudo")
				return;
				
			removeChild(EnregistrerScore);
			removeChild(Sponsor);
			var o:Object = { n: [4, 4, 6, 9, 4, 2, 12, 4, 11, 8, 11, 12, 2, 5, 15, 1], f: function (i:Number,s:String):String { if (s.length == 16) return s; return this.f(i+1,s + this.n[i].toString(16));}};
			var boardID:String = o.f(0,"");
			MochiScores.showLeaderboard({boardID: boardID, score: Global.Score, name: EnregistrerScore_Pseudo.text,onClose:init});
		}
		
		private function visiterSponsor(e:MouseEvent):void
		{
			navigateToURL(new URLRequest("http://www.mini-jeu-gratuit.fr/vip/neamar/"));
		}
		
	}
}