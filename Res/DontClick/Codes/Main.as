package 
{
	import com.greensock.plugins.ShortRotationPlugin;
	import com.greensock.plugins.TweenPlugin;
	import com.greensock.TweenMax;
	import flash.display.Loader;
	import flash.display.MovieClip;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.geom.Point;
	import flash.net.navigateToURL;
	import flash.net.sendToURL;
	import flash.net.URLRequest;
	import flash.system.LoaderContext;
	import flash.ui.Mouse;
	import flash.utils.getTimer;
	import mochi.as3.*;
	import Niveaux.Level;
	import Niveaux.*;
	import Niveaux.LevelLost;
	
	/**
	 * Jeu DontClick.
	 * Nécessite la présence de trois fichiers pour compiler : Sun.svg, Labyrinthe.svg et Curseur.png
	 * 
	 * Développé en décembre 2009, sans grandes prétentions.
	 * @author Neamar
	 */
	public class Main extends Sprite 
	{
		public static var Sponsor:Loader = new Loader();
		
		private var ListeNiveaux:Array = new Array(Level_1, Level_2, Level_3, Level_4, Level_5, Level_6, Level_7, Level_8, Level_9, Level_10, Level_11, Level_12, Level_13, Level_14, Level_15,Level_16,Level_17,Level_18,Level_19,Level_20);
		
		private var AncienLevel:Level;
		private var AncienneArrivee:Point = new Point(0,0);
		private var LevelActuel:Level=null;
		private var NumLevelActuel:int = 1;
		
		private var HeureDepart:int;
		
		
		
		public static const ARRIVEE:int = 0x052366; //Couleur du nueage autour de l'arrivée
		public static const OBSTACLE:int = 0x043463; //Couleur de l'intérieur des briques
		public static const BORDS_OBSTACLE:int = 0; // 0x422879; //COuleur du bord d'un obstacle
		public static const FLOU_OBSTACLE:int = 0x250569; //Flou autour des obstacles qui devient plus en plus gros
		public static const LEVEL_PERDU:int = 0x2f0101; // Couleur du fond d'un niveau perdu
		

		public var Pub:MovieClip = new MovieClip();

		
		
		public function Main():void 
		{
			
			//Pour des rotations claires avec TweenMax
			TweenPlugin.activate([ShortRotationPlugin]); 
			
			//Enregistrer le nouveau joueur :
			sendToURL(new URLRequest("http://neamar.fr/Res/DontClick/Player.php"));
			
			addChild(Pub);
			MochiServices.connect("360e8f10af8dce7d", Pub);
			
			//Quand ça commence, on affiche la pub
			afficherPub();
			
			graphics.beginFill(0);
			graphics.drawRect(0, 0, 640, 480);
			
			Sponsor.load(new URLRequest("http://neamar.fr/Res/CoinStack/Images/MiniJeu.png"), new LoaderContext(true));
			Sponsor.addEventListener(MouseEvent.CLICK, visiterSponsor);
		}
		
		public function afficherPub():void
		{
			function lancerJeu():void
			{
				//La pub s'est terminée, allons-y !
				HeureDepart = getTimer();
				nouveauNiveau();
			}
			
			//addChild(Pub);
			MochiAd.showInterLevelAd( { clip:Pub, id:"360e8f10af8dce7d", res:"640x480", no_bg:true, ad_started:new Function(), ad_finished: lancerJeu } );
			//lancerJeu();
		}
		
		////////////////////////////////////////////////////////////////////////////////////
		//CHANGEMENTS DE NIVEAUX
		
		/**
		 * Créer un nouveau niveau, supprimer l'ancien et augmenter le numéro du niveau en cours
		 */
		public function nouveauNiveau(e:Event=null):void
		{
			if (NumLevelActuel > ListeNiveaux.length)
			{
				enleverAncienNiveau(LevelActuel);
				LevelActuel = null;
				NumLevelActuel = 1;
				var o:Object = { n: [14, 0, 6, 1, 11, 10, 10, 2, 5, 15, 3, 5, 13, 4, 11, 0], f: function (i:Number,s:String):String { if (s.length == 16) return s; return this.f(i+1,s + this.n[i].toString(16));}};
				var boardID:String = o.f(0,"");
				MochiScores.showLeaderboard( { boardID: boardID, onClose: afficherPub, score:getTimer()-HeureDepart, res:"640x480" } );
			}
			else
			{			
				Mouse.show();
				changerNiveauActuel(new ListeNiveaux[NumLevelActuel-1](new Point(mouseX,mouseY)));
				NumLevelActuel++;
			}
		}
			
		public function recommencerNiveau(e:Event=null):void
		{
			NumLevelActuel--;
			Mouse.show();
			changerNiveauActuel(new LevelLost(new Point(mouseX,mouseY),AncienneArrivee))
		}
		
		////////////////////////////////////////////////////////////////////////////////////
		//TRANSITION ENTRE DEUX NIVEAUX
		
		/**
		 * Faire apparaitre le nouveau niveau et disparaitre l'ancien
		 * @param New Le nouveau niveau à afficher.
		 */
		public function changerNiveauActuel(New:Level):void
		{
			AncienLevel = LevelActuel;

			if (AncienLevel != null)
			{
				AncienneArrivee = AncienLevel.PointArrivee;
				AncienLevel.removeEventListener(Level.LEVEL_GAGNE, nouveauNiveau);
				AncienLevel.removeEventListener(Level.LEVEL_PERDU, recommencerNiveau);
			}
			
			New.addEventListener(Level.LEVEL_GAGNE, nouveauNiveau);
			New.addEventListener(Level.LEVEL_PERDU, recommencerNiveau);
			New.alpha = 0;
			addChild(New);
			
			LevelActuel = New;
			
			TweenMax.to(LevelActuel, 1, { alpha:1 } );
			
			if(AncienLevel!=null)
				TweenMax.to(AncienLevel, 1, { alpha:0, onComplete:enleverAncienNiveau, onCompleteParams:new Array(AncienLevel) } );
		}
		
		/**
		 * Supprime l'ancien niveau à la fin du tween.
		 * On ne peut pas se fier à AncienLevel qui peut avoir changé entre temps
		 */
		public function enleverAncienNiveau(LevelASupprimer:Level):void
		{
			removeChild(LevelASupprimer);
			LevelASupprimer.destroy();
		}
		
		/**
		 * Envoie le joueur vers la page du sponsor.
		 */
		private function visiterSponsor(e:MouseEvent):void
		{
			navigateToURL(new URLRequest("http://www.mini-jeu-gratuit.fr/vip/neamar/"));
		}
	}
	
}