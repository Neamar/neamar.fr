//Code original par Neamar. R�utilisation libre.
//neamar@neamar.fr

//Ligne de commande pour compiler :
//(apr�s s'�tre plac� dans le bon dossier, cf. http://neamar.fr/Res/Compiler_AS3/)
//
//bash mxmlc Sources/B-graphe/graphe.as -default-size 640 480 -compiler.strict

//Life begins when you can spend your spare time programming instead of
//watching television.

package
{
	import flash.display.Sprite;//La classe de base, fort utile !
	import flash.events.Event;//Les �venements "de bases", classe dont d�rive MouseEvent
	import flash.events.MouseEvent;//Interaction utilisateur//souris
	import flash.geom.Point;//Un point tout ce qu'il y a de plus normal : d�fini par (x,y).
	import flash.text.TextField;//Champ de texte. Classe assez vaste, utilis�e uniquement pour l'affichage de texte ici. Peut �tre du texte au format HTML.

	import flash.filters.BitmapFilter;//Classe globale pour les filtres
	import flash.filters.GlowFilter;//Filtre d'irridescence (�clairage, le plus utilis�)
	import flash.filters.BlurFilter//Flouter
	import flash.filters.BevelFilter;//Effet de biseau, appliqu� sur le "Plus de jeux".

	import flash.net.URLRequest;//Pr�pare une requete pour une page web.
    import flash.display.Loader;//Chargement d'un fichier normal, et r�cup�re le contenu
    import flash.system.LoaderContext;//Forcer le chargement du crossdomain.xml
	import flash.net.sendToURL;//Execute une requete sans r�cuperer la r�ponse du serveur. Assez pratique, l'air de rien.

	import flash.net.SharedObject;//Sauvegarde locale sur le PC de l'utilisateur : enregistrement du dernier niveau jou�, et des niveaux d�bloqu�s.

	[SWF(width = "640", height = "480", frameRate = 25)];//Quelques param�tres pour la compilation. Ils sont cependant red�finis dans la ligne de commande, mais laiss�s ici pour des raisons sentimentales (sic)

	public class Bgraphe extends Sprite
	{
		public var Fond:Niveau=new Niveau(new Array());//Fond est un Sprite instance de Niveau, qui contient le niveau en cours.

		public const VERSION:String="RC1";//La version
		public var Img_Fond:Loader = new Loader();//L'image en fond du player.

		public var SAVE_LOCAL:SharedObject;//L'enregistrement du niveau en cours, et des niveaux unlock�s.
		public var SESSION:Object;//Un raccourci vers SharedObject.datas

		public var NumeroNiveauActuel:int=0;
		public var NumeroNiveauUnlockes:int;

		private var Images_Niveaux:Array=new Array();

		function Bgraphe():void
		{
// 			Les constantes primitives utilis�es tout au long du Flash
			const FlashWidth:int = 640;
			const FlashHeight:int = 480;

//			R�cuperer les donn�es locales, si elles existent.
			SAVE_LOCAL = SharedObject.getLocal("BGraphe");
			SESSION = SAVE_LOCAL.data;

//    			SESSION.NumeroNiveauUnlockes=SESSION.NumeroNiveauActuel=11;
// 			SESSION.NumeroNiveauActuel=SESSION.NumeroNiveauUnlockes=null;

			if(SESSION.NumeroNiveauActuel==null)
				SESSION.NumeroNiveauActuel=SESSION.NumeroNiveauUnlockes=0;//Cr�ation de la sauvegarde.

			NumeroNiveauUnlockes=SESSION.NumeroNiveauUnlockes;//Recharger les derni�res valeurs
			NumeroNiveauActuel=NumeroNiveauUnlockes;//Commencer au dernier niveau

   			include "../Trace.as";
   			Trace("NON FINALISEE");
   			Trace("VERSION EN DEVELOPPEMENT");
 			include "ChangementsNiveaux.as";//Pendant le niveau, teste si il est fini. Pr�pare le passage � un nouveau niveau, et l'affiche.
 			include "ChargementNiveaux.as";//La liste des niveaux, et les fonctions pour les charger en m�moire.
 			include "Message.as";//La boite de message. Montre un message via la m�thode ShowMessage(message:String)
 			include "Persos.as";//G�re l'�diteur de niveau. Code assez simple.

			//Enregistrer le nouveau joueur :
			sendToURL(new URLRequest("http://neamar.fr/Res/BGraphe/Player.php"));//Permet de garder des statistiques sur le nombre de joueurs m�me quand le jeu est h�berg� sur un autre site.

			SwapBackGround();//Afficher l'image de fond


			Fond.scaleX=0;//Animation
			LancerNouveauNiveau();//charge le niveau de num�ro NumeroNiveauActuel.

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
				Img_Fond.load(new URLRequest("http://neamar.fr/Res/BGraphe/Images/Fond.png"),new LoaderContext(true));
				if(!contains(Img_Fond))
				{//Et la mettre au dernier plan
					addChild(Img_Fond);
					setChildIndex(Img_Fond,0);
				}
			}
			function ResetAll(e:Event):void
			{//No comment !
				NumeroNiveauActuel=NumeroNiveauUnlockes=SESSION.NumeroNiveauActuel=SESSION.NumeroNiveauUnlockes=0;
				UpdaterBoite();
			}
		}
	}
}
