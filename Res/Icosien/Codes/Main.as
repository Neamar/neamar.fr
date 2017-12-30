package 
{
	import com.greensock.TweenLite;
	import flash.display.Bitmap;
	import flash.display.MovieClip;
	import flash.display.Sprite;
	import flash.events.ContextMenuEvent;
	import flash.events.Event;
	import flash.events.KeyboardEvent;
	import flash.filters.BevelFilter;
	import flash.filters.DropShadowFilter;
	import flash.net.sendToURL;
	import flash.net.SharedObject;
	import flash.net.URLRequest;
	import flash.ui.ContextMenu;
	import flash.ui.ContextMenuItem;
	import flash.utils.getTimer;
	import mochi.as3.MochiAd;
	import Levels.*;
	
	/**
	 * Icosien : le jeu flash :)
	 * Exploite les idées de graphe Eulérien et Hamiltonien sous forme de jeu.
	 * http://neamar.fr/Res/Icosien
	 * @author Neamar
	 */
	public class Main extends Sprite 
	{
		/**
		 * Taille du SWF.
		 */
		public static const WIDTH:int = 640;
		public static const HEIGHT:int = 480;
		public static const SLIDE_DUREE:Number = 2;
		
		/**
		 * L'ombre, c'est la même pour tout le monde.
		 * On la définit une bonne fois pour toute ici pour économiser la mémoire.
		 */
		public static const Ombre:Array = new Array(new DropShadowFilter(8,45,0,.8));
		
		/**
		 * L'image des plantes en haut.
		 */
		[Embed(source = "../assets/Plante.png")]
		private static var Plant:Class;
		private var Plante:Bitmap = new Plant();
		
		/**
		 * Les données définissant le niveau.
		 */
		public const Datas:Vector.<LevelDatas> = new Vector.<LevelDatas>();
		
		/**
		 * Le numéro du niveau actuel.
		 * 0 pour commencer, on peut le modifier pour les tests.
		 */
		private var _NumeroNiveauActuel:int;
		
		/**
		 * L'objet permettant de retenir à quel niveau on en est.
		 */
		private var Partage:Object = new Object();
		
		/**
		 * L'objet contenant le niveau actuel, sur lequel on a enregistré l'evenement Level.LEVEL_WIN
		 */
		private var NiveauActuel:Level=null;
		
		/**
		 * Le dernier niveau joué, stocké temporairement pour destruction une fois sorti de l'écran.
		 */
		private var AncienNiveau:Level;
		
		/**
		 * La planche au fond.
		 */
		private var Fond:Background = new Background();
		
		/**
		 * Mdofications du menu contextuel
		 */
		private var menuItemRestart:ContextMenuItem = new ContextMenuItem("Recommencer le niveau");
		private var menuItemPrevious:ContextMenuItem = new ContextMenuItem("Reculer d'un niveau");
		private var menuItemNext:ContextMenuItem = new ContextMenuItem("Avancer d'un niveau");
		
		private var myMenu:ContextMenu = new ContextMenu();
		
		/**
		 * Gestion de la pub.
		 */
		private var Pub:MovieClip = new MovieClip();
		private var DernierePub:int = getTimer();//La première pub arrive au bout de 15 minutes de jeu (5 + 10=.
		private const PUB_INTERVAL:int = 1000 * 60 * 10;//Puis toutes les dix minutes.
		private var IsShowingAd:Boolean = false;//Empêche de passer les publicités.
		
		public function Main():void 
		{
			if (stage) init();
			else addEventListener(Event.ADDED_TO_STAGE, init);
		}
		
		/**
		 * Initialiser l'application et construire la banque de données pour les niveaux.
		 */
		private function init(e:Event = null):void 
		{
			removeEventListener(Event.ADDED_TO_STAGE, init);
			
			addChild(Pub);
			Pub.visible = false;
			Pub.stageParent = this;
			
			//Enregistrer le nouveau joueur de façon asynchrone :
			sendToURL(new URLRequest("http://neamar.fr/Res/Icosien/Player.php"));
		
			//Créer l'objet de sauvegarde locale :
			var LocalValue:Object = SharedObject.getLocal("Icosien").data;
			
			//Réinitialiser les valeurs enregistrées (debug)
			//Commenter cette ligne pour avoir un enregistrement de la progression.
			//LocalValue.NumeroNiveauActuel = null;
			
			
			//Et récupérer le dernier niveau (s'il existe)
			
			if (LocalValue.NumeroNiveauActuel == null)
			{
				trace("(Re-)set");
				LocalValue.NumeroNiveauActuel = 0;
			}
			else
			{
				NumeroNiveauActuel = LocalValue.NumeroNiveauActuel;
			}
			
			
			//Charger la banque de donnée des niveaux.
			include 'DatasBank.as';
			
			addChild(Fond);
			addChild(Plante);
			Plante.filters = Ombre;
			getNextLevel();
			
			//Permettre la navigation au clavier.
			function moveKeyboard(e:KeyboardEvent):void
			{
				//CHEAT ! Ctrl + Alt + Flèche droite permet le déplacement direct.
				if (e.ctrlKey && e.altKey && e.keyCode == 39 && NumeroNiveauActuel<Datas.length)
					moveLevel(1);
				else if (e.keyCode == 39)//Flèche droite : charger un niveau si disponible.
					getNextLevel();
				else if (e.keyCode == 37)
					getPreviousLevel();
				else if (e.keyCode == 27 || e.keyCode == 82 || e.keyCode == 75 || e.keyCode == 32)
					getSameLevel();
			}
			stage.addEventListener(KeyboardEvent.KEY_UP, moveKeyboard);
			

			//Configurer le menu clic droit
			menuItemRestart.addEventListener(ContextMenuEvent.MENU_ITEM_SELECT,getSameLevel);
			menuItemPrevious.addEventListener(ContextMenuEvent.MENU_ITEM_SELECT,getPreviousLevel);
			menuItemNext.addEventListener(ContextMenuEvent.MENU_ITEM_SELECT,getNextLevel);
			myMenu.customItems.push(menuItemRestart);
			myMenu.customItems.push(menuItemNext);
			myMenu.customItems.push(menuItemPrevious);
			
			myMenu.builtInItems.play = myMenu.builtInItems.loop = myMenu.builtInItems.rewind = myMenu.builtInItems.forwardAndBack = myMenu.builtInItems.print = false;

			contextMenu = myMenu;
		}
		
		/**
		 * Relance le niveau actuel.
		 * @param	e Un évenement non utilisé.
		 */
		public function getSameLevel(e:Event = null):void
		{
			if (NiveauActuel != null)
				NiveauActuel.restart();
		}
		
		/**
		 * Passer au niveau suivant si on a déjà débloqué le niveau
		 * @param	e Un évenement non utilisé.
		 */
		public function getNextLevel(e:Event = null):void
		{
			if((e!=null && e.type==Level.LEVEL_WIN) || canGetNextLevel())
				moveLevel(1);
		}
		
		/**
		 * Passer au niveau précédent si on n'est pas au niveau 0.
		 * @param	e Un évenement non utilisé.
		 */
		public function getPreviousLevel(e:Event = null):void
		{
			if(canGetPreviousLevel())
				moveLevel(-1);
		}
		
		/**
		 * Changer le niveau en cours pour le niveau suivant / précédent.
		 * @param	Sens S'il faut ajouter un niveau ou en retirer un.
		 */
		private function moveLevel(Sens:int):void
		{
			//Vérifier la validité de l'appel de fonction
			if (Math.abs(Sens) > 1)
				throw new Error("Impossible de se déplacer de plus d'un niveau à la fois.");
				
			//Ne pas sortir par la gauche !
			if (NumeroNiveauActuel == 0 && Sens == -1)
				return;
				
			if (NumeroNiveauActuel == Datas.length && Sens == 1)
				Sens = 0;
				
			//Allez les vieux, faites de la place aux jeunes.
			AncienNiveau = NiveauActuel;
			if(AncienNiveau != null)
			{
				AncienNiveau.removeEventListener(Level.LEVEL_WIN, getNextLevel);
				if(AncienNiveau.Toile!=null)
					AncienNiveau.Toile.disconnect();
			}
			
			//Changer le niveau, ou afficher une pub.
			if (DernierePub + PUB_INTERVAL < getTimer())
			{//Afficher une pub.
				NiveauActuel = new AdLevel("", Pub);
				(NiveauActuel as TextLevel).Caption = "Votre jeu va reprendre dans quelques secondes...";
				DernierePub = getTimer() + 10000;
				IsShowingAd = true;
			}
			else
			{
				IsShowingAd = false;
				
				//Passer au niveau suivant
				NumeroNiveauActuel += Sens;
				//Charger le niveau de la banque de données.
				NiveauActuel = Datas[NumeroNiveauActuel - 1].build();
				
				//Afficher la progression :
				if (NiveauActuel is TextLevel && NumeroNiveauActuel!=1 && NumeroNiveauActuel!=Datas.length)
					(NiveauActuel as TextLevel).Caption = (NumeroNiveauActuel-1) + " / " + (Datas.length-2);//-1 car la présentation ne compte pas, -2 car le début et la fin ne comptent pas.
					
				//Si on arrive à l'avant dernier niveau, donner l'ordre de précharger l'image finale :)
				if (NumeroNiveauActuel == Datas.length - 1)
					EndLevel.downloadDatas();
			}
			
			addChild(NiveauActuel);
			
			//Modifier le menu contextuel et les suivants / précédents
			menuItemPrevious.enabled = canGetPreviousLevel();
			menuItemNext.enabled = canGetNextLevel();
			
			//(re-)Passer la plante au premier plan et la planche au dernier.
			setChildIndex(Plante, numChildren - 1);
			setChildIndex(Fond, 0);
			
			//Faire défiler la planche à l'arrière d'un cran, et bouger les niveaux.
			//La variable Sens détermine la direction des animations (à droite / à gauche)
			NiveauActuel.x = Sens * Main.WIDTH;
			TweenLite.to(Fond, SLIDE_DUREE, { x:Fond.x - Sens*Main.WIDTH } );
			if (AncienNiveau != null)
				TweenLite.to(AncienNiveau, SLIDE_DUREE, { x: - Sens*Main.WIDTH, onComplete:removeAfterMove } );
			TweenLite.to(NiveauActuel, SLIDE_DUREE, { x:0 } );
			
			NiveauActuel.addEventListener(Level.LEVEL_WIN, getNextLevel);
		}
		
		/**
		 * Déclenché une fois le niveau fini, cette fonction est déclenchée pour mettre à jour le niveau actuel.
		 * Cette fonction n'est pas appelée au tout début.
		 */
		private function removeAfterMove():void
		{
			if (AncienNiveau != null && contains(AncienNiveau))
			{
				var i:int = 0;
				while (!(getChildAt(i) is Level)) { i++ };
				
				//Supprimer le premier élément sur la scène, qui est logiquement le plus ancien.
				removeChild(getChildAt(i));
			}
			
			// AncienNiveau.destroy(); => implicite avec le removeChild.
		}
		
		/**
		 * Numéro actuel du niveau en jeu.
		 */
		public function get NumeroNiveauActuel():int { return _NumeroNiveauActuel; }
		
		/**
		 * Met à jour le niveau actuel, et enregistre sur le disque la progression.
		 */
		public function set NumeroNiveauActuel(value:int):void 
		{
			
			try
			{
				//Enregistrer le plus haut niveau atteint sur le disque (si on en a la permission)
				SharedObject.getLocal("Icosien").data.NumeroNiveauActuel = Math.max
				(
					SharedObject.getLocal("Icosien").data.NumeroNiveauActuel,
					value-1
				);
				//écrire les données sur le disque.
				SharedObject.getLocal("Icosien").flush();
			}
			catch (e:Error)
			{
				trace("Accès au disque interdit :(, impossible d'enregistrer le niveau atteint.");
			}
			finally
			{
				_NumeroNiveauActuel = value;
			}
		}
		
		private function canGetNextLevel():Boolean { return (NumeroNiveauActuel <= SharedObject.getLocal("Icosien").data.NumeroNiveauActuel && !IsShowingAd); }
		private function canGetPreviousLevel():Boolean { return (NumeroNiveauActuel > 1 && !IsShowingAd); }
	}
}
import Levels.Level;

/**
 * Classe "database" pour stocker les niveaux à réaliser dans une structure légère.
 */
class LevelDatas
{
	public var Type:Class;
	public var Datas:String;
	public var Name:String;
	public var AdditionalDatas:*;
	
	
	private var Niveau:Level;
	
	/**
	 * Crée un nouvel Objet LevelDatas.
	 * @param	Type le type du niveau (EulerLevel ou HamiltonLevel)
	 * @param	Datas Les données du niveau au format graphe
	 * @param	Name Le nom du niveau (non affiché)
	 * @param	AdditionalDatas Second paramètre du constructeur de Type -- si nécessaire (ex: DummyLevel).

	 */
	public function LevelDatas(Type:Class, Datas:String, Name:String, AdditionalDatas:*=null)
	{
		this.Type = Type;
		this.Datas = Datas;
		this.Name = Name;
		this.AdditionalDatas = AdditionalDatas;
	}
	
	/**
	 * Construit le niveau demandé et le renvoie.
	 */
	public function build():Level
	{	
		//Construire l'objet
		if(AdditionalDatas==null)
			Niveau = new Type(Datas);
		else
			Niveau = new Type(Datas, AdditionalDatas);
			
		//Et le renvoyer
		return Niveau;
	}
}