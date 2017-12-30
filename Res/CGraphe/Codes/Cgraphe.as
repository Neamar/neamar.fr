//Code original par Neamar. Réutilisation libre.
//neamar@neamar.fr
//Date : 2008

//Ligne de commande pour compiler :
//(après s'être placé dans le bon dossier, cf. http://neamar.fr/Res/Compiler_AS3/)
//
//bash mxmlc Sources/C-graphe/Cgraphe.as -default-size 640 480 -compiler.strict

//Life begins when you can spend your spare time programming instead of watching television.

package
{
	import flash.display.Sprite;//La classe de base, fort utile !
	import flash.display.Shape;//Un sprite plus light, qui ne gère pas les evenements, mais consomme moins de mémoire.
	import flash.events.Event;//Les évenements "de bases", classe dont dérive MouseEvent
	import flash.events.MouseEvent;//Interaction utilisateur//souris
	import flash.geom.Point;//Un point tout ce qu'il y a de plus normal : défini par (x,y).
	import flash.text.TextField;//Champ de texte. Classe assez vaste, utilisée uniquement pour l'affichage de texte ici. Peut être du texte au format HTML.

	import flash.filters.BitmapFilter;//Classe globale pour les filtres
	import flash.filters.GlowFilter;//Filtre d'irridescence (éclairage, le plus utilisé)
	import flash.filters.BlurFilter//Flouter
	import flash.filters.BevelFilter;//Effet de biseau, appliqué sur le "Plus de jeux".

	import flash.net.URLRequest;//Prépare une requete pour une page web.
	import flash.net.sendToURL;//Execute une requete sans récuperer la réponse du serveur. Assez pratique, l'air de rien.

	import flash.net.SharedObject;//Sauvegarde locale sur le PC de l'utilisateur : enregistrement du dernier niveau joué, et des niveaux débloqués.

	[SWF(width = "640", height = "480", frameRate = 25)];//Quelques paramètres pour la compilation. Ils sont cependant redéfinis dans la ligne de commande, mais laissés ici pour des raisons sentimentales (sic)

	public class Cgraphe extends Sprite
	{

		public var Partie:Game;//La partie en cours

		public var SAVE_LOCAL:SharedObject;//L'enregistrement du niveau en cours, et des niveaux unlockés.
		public var SESSION:Object;//Un raccourci vers SharedObject.datas

		private var Images_Niveaux:Array=new Array();//Une "capture d'écran" des niveaux, qui est affichée dans la boite de preview

		public var NumeroNiveauActuel:int=0;
		public var NumeroNiveauUnlockes:int;

		function Cgraphe():void
		{
//			Récuperer les données locales, si elles existent.
			SAVE_LOCAL = SharedObject.getLocal("CGraphe");
			SESSION = SAVE_LOCAL.data;
//    			SESSION.NumeroNiveauUnlockes=SESSION.NumeroNiveauActuel=11;

			if(SESSION.NumeroNiveauActuel==null)
				SESSION.NumeroNiveauActuel=SESSION.NumeroNiveauUnlockes=0;//Création de la sauvegarde.

			NumeroNiveauUnlockes=SESSION.NumeroNiveauUnlockes;//Recharger les dernières valeurs
			NumeroNiveauActuel=NumeroNiveauUnlockes;//Commencer au dernier niveau

			Const._stage=this.stage;

			stage.frameRate=20;

 			include "ChangementsNiveaux.as";//Pendant le niveau, teste si il est fini. Prépare le passage à un nouveau niveau, et l'affiche.
 			include "ChargementNiveaux.as";//La liste des niveaux, et les fonctions pour les charger en mémoire.
 			include "Message.as";//La boite de message. Montre un message via la méthode ShowMessage(message:String)
 			include "Persos.as";//Permet la création de levels persos.

			//Enregistrer le nouveau joueur :
			sendToURL(new URLRequest("http://neamar.fr/Res/CGraphe/Player.php"));//Permet de garder des statistiques sur le nombre de joueurs même quand le jeu est hébergé sur un autre site.

// 			SwapBackGround();//Afficher l'image de fond
			LancerNouveauNiveau();

			////////////////////////////////
			//Les éléments inclassables
			////////////////////////////////
			function SourisIN(e:Event):void
			{//Fonction Utilisée sur tous les sprites de type bouton : ajoute un filtre au Sprite afin de l'illuminer
				AppliquerFiltre(e.currentTarget)
			}
			function SourisOUT(e:Event):void
			{//Fonction Utilisée sur tous les sprites de type bouton : retire les filtres du Sprite
				e.currentTarget.filters=new Array();
			}

			function BevelIN(e:Event):void
			{//Fonction utilisée sur tous les sprites de type flèche : ajoute un filtre au Sprite afin de l'enfoncer
				e.currentTarget.filters=new Array(Const.BEVEL_IN);
			}
			function BevelOUT(e:Event):void
			{//Fonction Utilisée sur tous les sprites de type bouton : retire les filtres du Sprite
				e.currentTarget.filters=new Array(Const.BEVEL_OUT);
			}
			function AppliquerFiltre(Element:Sprite,Couleur:uint=0x000000):void
			{//Ajoute un filtre de rayonnement à l'objet spécifié
				var FiltreHover:BitmapFilter = new GlowFilter(Couleur, 0.8,16,16,3,1,false,false);
				var ListeFiltres:Array = new Array();
				ListeFiltres.push(FiltreHover);
				Element.filters=ListeFiltres;
			}
			function ResetAll(e:Event):void
			{//No comment !
				NumeroNiveauActuel=NumeroNiveauUnlockes=SESSION.NumeroNiveauActuel=SESSION.NumeroNiveauUnlockes=0;
				UpdaterBoite();
			}
		}
	}
}
