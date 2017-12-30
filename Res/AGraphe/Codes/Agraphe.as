//Code original par Neamar. R�utilisation libre.
//neamar@neamar.fr

//Ligne de commande pour compiler :
//(apr�s s'�tre plac� dans le bon dossier, cf. http://neamar.fr/Res/Compiler_AS3/)
//
//bash mxmlc Sources/A-graphe/Agraphe.as -default-size 640 480 -compiler.strict

//Life begins when you can spend your spare time programming instead of
//watching television.

package
{
	import flash.display.Sprite;//La classe de base, fort utile !
	import flash.events.*;//Chargons tous les �venements ce sera plus simple :)
	import flash.geom.Point;//Un point tout ce qu'il y a de plus normal : d�fini par (x,y).
	import flash.text.TextField;//Champ de texte. Classe assez vaste, utilis�e uniquement pour l'affichage de texte ici

	import flash.filters.BitmapFilter;//Classe globale pour les filtres
	import flash.filters.GlowFilter;//Filtre d'irridescence (�clairage, le plus utilis�)
	import flash.filters.BlurFilter//Flouter
	import flash.filters.BevelFilter;

	import flash.net.URLRequest;//Pr�pare une requete.
	import flash.net.sendToURL;//Execute une requete sans r�cuperer la r�ponse
    import flash.display.Loader;//Chargement d'un fichier normal, et r�cup�re le contenu
    import flash.system.LoaderContext;//Forcer le chargement du crossdomain.xml
	import flash.net.SharedObject;//Sauvegarde locale



	[SWF(width = "640", height = "480", frameRate = 25)];//Quelques param�tres pour la compilation. Ils sont cependant red�finis dans la ligne de commande.

	public class Agraphe extends Sprite
	{
		public var Fond:Niveau;//Fond est un Sprite Niveau, qui contient le niveau en cours.

		public const VERSION:String="RC1";//La version
		public var Img_Fond:Loader = new Loader();

		public var SAVE_LOCAL:SharedObject;//L'enregistrement du niveau en cours, et des niveaux unlock�s.
		public var SESSION:Object;//Un raccourci vers SharedObject.datas

		public var NumeroNiveauActuel:int=0;
		public var NumeroNiveauUnlockes:int;


		private var GrandPere:Noeud; //GrandPere est pr�sent dans chaque niveau, c'est le noeud final � atteindre.

		function Agraphe():void
		{
// 			Les constantes primitives utilis�es tout au long du Flash
			const FlashWidth:int = 640;
			const FlashHeight:int = 480;

//			R�cuperer les donn�es locales
			SAVE_LOCAL = SharedObject.getLocal("AGraphe");
			SESSION = SAVE_LOCAL.data;

// 			SESSION.NumeroNiveauUnlockes=SESSION.NumeroNiveauActuel=11;
// 			SESSION.NumeroNiveauActuel=SESSION.NumeroNiveauUnlockes=null;

			if(SESSION.NumeroNiveauActuel==null)
				SESSION.NumeroNiveauActuel=SESSION.NumeroNiveauUnlockes=NumeroNiveauActuel;//On ne met pas � 0 afin de permettre des tests : lors du d�buggage, il suffit de changer une variable pour passer � un niveau.

			NumeroNiveauUnlockes=SESSION.NumeroNiveauUnlockes;//Recharger les derni�res valeurs
			NumeroNiveauActuel=NumeroNiveauUnlockes;//Commencer au dernier niveau

//    			include "../Trace.as";
			include "ChangementsNiveaux.as";//Pendant le niveau, test si il est fini. Pr�pare le passage � un nouveau niveau.
			include "ChargementNiveaux.as";//La liste des niveaux, les diff�rentes possibilit�s de le charger (via un String, un Array...)
			include "Message.as";//La boite de message. Montre un message via la m�thode ShowMessage(message:String)
			include "2Joueurs.as";//Gestion du mod �2 Joueurs�
			include "Persos.as";//Gestion du mod �Cr�ateur de niveaux�
//  		include "Resolution.as";//Non inclus dans la version distribu�e. Teste un niveau, renvoie le nombre minimal de noeuds � allumer.

			SwapBackGround();//Afficher l'image de fond

			//Enregistrer le nouveau joueur :
			sendToURL(new URLRequest("http://neamar.fr/Res/AGraphe/Player.php"));

			Fond = GetLevelData(NumeroNiveauActuel);//Charger le niveau de num�ro NumeroNiveauActuel
			addChild(Fond);
			Fond.graphics.clear();//enlever le fond blanc que les niveaux ont normalement.
			Fond.FlouFinal=Fond.FLOU_FINAL;

			//Repasser la boite de message au premier plan...c'est plus pratique pour la lire :-)
			setChildIndex(Fond,1);//Sinon, Fond est au 1er plan et bloque la lecture des informations.
			addEventListener(Event.ENTER_FRAME,TesterFinNiveau);


			////////////////////////////////
			//Les �l�ments inclassables
			////////////////////////////////
			function SourisIN(e:Event):void
			{//Fonction Utilis�e sur tous les sprites de type bouton : ajoute un filtre au Sprite afin de l'illuminer
				AppliquerFiltre(e.currentTarget)
			}
			function SourisOUT(e:Event):void
			{//Fonction Utilis�e sur tous les sprites de type bouton : retire les filtres du Sprite
				e.currentTarget.filters=new Array();
			}
			function AppliquerFiltre(Element:Sprite,Couleur:uint=0x000000):void
			{//Ajoute un filtre de rayonnement � l'objet sp�cifi�
				var FiltreHover:BitmapFilter = new GlowFilter(Couleur, 0.8,16,16,3,1,false,false);
				var ListeFiltres:Array = new Array();
				ListeFiltres.push(FiltreHover);
				Element.filters=ListeFiltres;
			}
			function SwapBackGround():void
			{//T�lecharger l'image de fond, l'afficher.
				//Le Img_FondContext  sert � demander le t�lechargement du fichier crossdomain.xml
				Img_Fond.load(new URLRequest("http://neamar.fr/Res/AGraphe/Images/Fond.png"),new LoaderContext(true));
				if(!contains(Img_Fond))
				{//Et la mettre au dernier plan
					addChild(Img_Fond);
					setChildIndex(Img_Fond,0);
				}
			}
			function ResetAll(e:Event):void
			{
				NumeroNiveauActuel=NumeroNiveauUnlockes=SESSION.NumeroNiveauActuel=SESSION.NumeroNiveauUnlockes=0;
				UpdaterBoite();
			}
		}
	}
}
