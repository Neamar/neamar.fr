package 
{
	import adobe.utils.CustomActions;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.events.TimerEvent;
	import flash.filters.BevelFilter;
	import flash.filters.DropShadowFilter;
	import flash.filters.GlowFilter;
	import flash.text.TextField;
	import flash.utils.Timer;
	import Utilitaires.geom.SatShape;
	
	import mochi.as3.*;
	import gs.TweenLite;
	
	/**
	 * Un niveau.
	 * 
	 * <p>Chaque niveau contient Global.COINS_IN_GAME pièces.<br/>
	 * On affiche d'abord une publicité pendant que les pièces tombent, puis on montre l'aide.<br/>
	 * Un clic quitte l'aide et lance le niveau. Une fois le temps écoulé, le spièces disparaissent une à une.
	 * @author Neamar
	 */
	public dynamic class Level extends Sprite
	{
		public static const LEVEL_ENDED:String = "FIN_NIVEAU";
		
		/**
		 * Vaut false tant que le jeu n'a pas commencé : écite que l'on puisse cliquer sur les pièces pendant l'affichage de la pub.
		 */
		public var hasStarted:Boolean = false;
		
		/**
		 * Les différents types de pièces que l'on peut rencontrer dans le jeu (définies dans le jeu).
		 */
		public static const MonnaiePossibles:Array/*Class*/ = new Array(Coin.p1Cent, Coin.p2Cents, Coin.p5Cents, Coin.p10Cents, Coin.p20Cents, Coin.p50Cents, Coin.p1Euro, Coin.p2Euros, BankNote.b5, BankNote.b10, BankNote.b20,  BankNote.b50, BankNote.b100, BankNote.b200,  BankNote.b500);
		
		/**
		 * Valeurs en points de chaque pièce/billet.
		 */
		public static const Valeurs:Array/*int*/= new Array(0.01, 0.02,0.05, 0.1,0.20,0.50,1,2,5,10,20,50,100,200,500);
		
		/**
		 * Nombre de pièces que contient actuellement le niveau. Sa valeur n'est pas mise à jour une fois que la partie a commencée.
		 * 
		 * <p>Cette variable sert uniquement lors de l'apparition des pièces.</p>
		 */
		public var NbBillets:int = 0;
		
		
		
		private var Chrono:Timer;
		private var ChampTexte:TextField = new TextField();
		private var TexteSprite:SecondSprite = new SecondSprite();
		private var FondTexteSprite:Sprite = new Sprite();
		private var apresMessage:Function;
		
		/**
		 * Créer un nouveau niveau.
		 */
		public function Level()
		{
			function fin_pub(e:Event = null):void
			{				
				TexteSprite.filters = new Array(new BevelFilter(), new GlowFilter(0xFFFFFF, .9, 32, 32, 6));
				TexteSprite.buttonMode = true;
				TexteSprite.scaleX = TexteSprite.scaleY = 1.5;
				TexteSprite.addChild(ChampTexte);
				ChampTexte.y = 150/TexteSprite.scaleX;
				ChampTexte.width = Global.FLASH_WIDTH/TexteSprite.scaleX;
				ChampTexte.height = Global.FLASH_HEIGHT/TexteSprite.scaleY;
				ChampTexte.selectable = false;
				//ChampTexte.textColor = 0;
				ChampTexte.multiline = true;

				afficherMessage(lancerNiveau, "<b>But du jeu</b><br>Ramassez le plus d'argent possible en cliquant sur les pièces et les billets.<br>Vous ne pouvez récupérer un élément que <b>si il n'est pas recouvert</b>.<br><br><br><b>Score</b><br>Chaque élément vous rapporte sa valeur en points (50€ : 50 points).<br>Si vous tentez de ramasser un objet recouvert, vous perdez sa valeur.<br><br><b>Fin du jeu</b><br>Le jeu se termine après " + Math.floor(Global.LEVEL_TIME / 1000) + " secondes.<br><br><b><i><font color=\"#FF0000\">Cliquez pour commencer...</font></i></b>");
			}
			
			//Mettre sur la scène le niveau.
			Global.stage.addChild(this);
			
			this.addEventListener(Event.ENTER_FRAME, creerMonnaie);
			
			
			addChild(TexteSprite);

			MochiAd.showInterLevelAd( { clip:TexteSprite, id:"028ef12af089b8d6", res:"640x480", no_bg:true, ad_started:creerMonnaie, ad_finished:fin_pub } );
			
			//removeChild(TexteSprite);
			//lancerNiveau();
		}
		
		/**
		 * Lance le jeu une fois la pub et l'aide affichées.
		 */
		public function lancerNiveau():void
		{
			removeEventListener(Event.ENTER_FRAME, creerMonnaie);
			
			//Créer tous les objets
			for (var i:int = NbBillets; i < Global.BANKS_IN_GAME; i++)
				creerMonnaie();
			
			Global.Score = 0;
			hasStarted = true;
			Chrono = new Timer(Global.LEVEL_TIME, 1);
			Chrono.start();
			Chrono.addEventListener(TimerEvent.TIMER, finNiveau);
		}
		
		public function tryRemove(e:Event):void
		{
			var Obj:SatShape = (e.currentTarget as SatShape);
			if (!hasStarted)
				return;
				
			var i:int = this.numChildren - 1;
			var estDessous:Boolean = false;
			while (getChildAt(i) != Obj)
			{
				var Monnaie:SatShape = (getChildAt(i) as SatShape);
				if (Obj.hitTest(Monnaie))
				{
					TweenLite.to(Obj, .7, { scaleX:.7, scaleY:.7 } );
					TweenLite.to(Obj, .3, { delay:.7, scaleX:1, scaleY:1 } );
					TweenLite.to(Monnaie, 1, { rotation:Monnaie.rotation+360 } );
					estDessous = true;
				}
				i--;
			}
			if (!estDessous)
			{
				Global.Score += Obj['Valeur'];
				Obj.destroy();
			}
			else
			 	Global.Score -= Obj['Valeur'];
				
			trace(Global.Score,Obj['Valeur']);
		}
		
		private function creerMonnaie(e:Event=null):SatShape
		{
			var Monnaie:SatShape;
			if (NbBillets <= Global.BANKS_IN_GAME)
			{
				if (NbBillets % MonnaiePossibles.length <= 7)
					Monnaie = new Coin(this, NbBillets % MonnaiePossibles.length);
				else
					Monnaie = new BankNote(this, NbBillets % MonnaiePossibles.length);
				
				addChild(Monnaie);
				NbBillets++;
				if(this.contains(TexteSprite))
					setChildIndex(TexteSprite, numChildren - 1);//Garder le texte au premier rang.
				
				return Monnaie;
			}
			else
				return null;
		}
		
		private function supprimerBillet(e:Event = null):void
		{
			if (numChildren!=0)
			{
				(getChildAt(0) as SatShape).destroy();
			}
			else
			{
				removeEventListener(Event.ENTER_FRAME, supprimerBillet);
				dispatchEvent(new Event(LEVEL_ENDED));
			}
		}
		
		private function finNiveau(e:TimerEvent):void
		{
			//afficherMessage(null, "<font size=\"20\">Fin de la partie.</font><br><br><br><b>Votre score : " + Global.Score + "</b>");
			
			addEventListener(Event.ENTER_FRAME, supprimerBillet);
		}
		
		private function afficherMessage(apresClick:Function,Texte:String):void
		{
			addChild(TexteSprite);
			TexteSprite.addChild(Global.Logo);
			Global.Logo.scaleX = Global.Logo.scaleY = 1 / TexteSprite.scaleX;
				
			TexteSprite.addChild(FondTexteSprite);
			
			FondTexteSprite.graphics.clear();
			FondTexteSprite.graphics.beginFill(0xFFFFFF, .3);
			FondTexteSprite.graphics.drawRect(0, 0, Global.FLASH_WIDTH, Global.FLASH_HEIGHT);
			FondTexteSprite.alpha = 0;
			TweenLite.to(FondTexteSprite, 1, { alpha:.3 , onComplete:TexteSprite.addEventListener, onCompleteParams:[MouseEvent.CLICK, supprimerMessage]} );
			
			ChampTexte.htmlText = Texte;
			//TexteSprite.addEventListener(MouseEvent.CLICK, supprimerMessage); //Inclus dans le TweenLite une fois celui-ci terminé.
			apresMessage = apresClick;
		}
		
		private function supprimerMessage(e:MouseEvent = null):void
		{
			TexteSprite.removeEventListener(MouseEvent.CLICK, supprimerMessage);
			removeChild(TexteSprite);
			ChampTexte.text = '';
			if (TexteSprite.contains(FondTexteSprite))
				TexteSprite.removeChild(FondTexteSprite);
						
			if(apresMessage!=null)
				apresMessage();
		}
	}
	
}