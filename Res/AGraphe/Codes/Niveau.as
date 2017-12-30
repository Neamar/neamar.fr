//Un niveau standard : contient des liens et des noeuds !
package
{
	import flash.display.Sprite;
	import flash.geom.Point;
	import flash.display.Shape;
	import flash.events.*;
	import flash.text.TextField;

	public class Niveau extends Sprite
	{
		public var All_Noeuds:Array;//Contient l'arborescence sous forme de noeuds graphiques
		public var NbJetonsUtilises:int;
		public var NbJetonsToleres:int;
		public var NumeroNiveau:String;
		public var Mode2Joueurs:Boolean;
		public var Informations:TextField = new TextField();

		public var Flou:int=0;//Le niveau de flou du Fond actuel
		public const FLOU_FINAL:int=32;//Le niveau maximal de Flou, une constante.
		public var FlouFinal:int=FLOU_FINAL;//Le niveau final de flou demandé pour Fond.



		public var Officiel:Boolean=true;
		private var JetonsUtilises:Array;
		private var Layer:Sprite;
		private var GrandPere:Noeud;
		private var Niveau_Chiffre:Array;


		public function Niveau(NumeroNiveau:String,Niveau:Array,Hook:Array,Non_Extinctible:Array,Allumes:Array, DejaAllumes:Array, NbJetonsToleres:int, Hauteur:int,Largeur:int,Mode2Joueurs:Boolean)
		{
			this.All_Noeuds = new Array();
			this.NbJetonsToleres=NbJetonsToleres;
			this.JetonsUtilises=new Array();
			this.NumeroNiveau=NumeroNiveau;
			this.Mode2Joueurs=Mode2Joueurs;
			this.Niveau_Chiffre=Niveau;
			var Enfants:Array;
			var i:int;

			All_Noeuds=new Array(Niveau.length);
			for(i=0;i<Niveau.length;i++)
			{
				if(Niveau[i]!=null)
				{
					Enfants=new Array();
					for each(var Enfant:int in Niveau[i])
					{
						Enfants.push(All_Noeuds[Enfant]);
					}
					All_Noeuds[i]=AjoutNoeud(Enfants)
				}
				else
					All_Noeuds[i]=AjoutNoeud(null);
			}

			//Les options supplémentaires:
			//Hook
			//Inextinguible
			i=0;
			for each(var Child:Noeud in All_Noeuds)
			{
				if(Hook[i]==null)
					Hook[i]=0;
				if(Non_Extinctible[i]==null)
					Non_Extinctible[i]=false;
				Child.addHook(Hook[i]);
				Child.Is_Not_Eteignable(Non_Extinctible[i]);

				if(Allumes[i]==true)
					Child.ChangeState(true,false);
				if(DejaAllumes[i]==true)
					Child.aEteFerme=true;
				i++;
			}

			//Nombre de jetons utilisables
			for(i=0;i<NbJetonsToleres;i++)
			{
				JetonsUtilises[i]=new Noeud(new Array(),this);
				if(!Mode2Joueurs)
					this.addChild(JetonsUtilises[i]);
				JetonsUtilises[i].x=Largeur-(i+1)*25;
				JetonsUtilises[i].y=15;
				JetonsUtilises[i].scaleX=JetonsUtilises[i].scaleY=.5;
			}

			Informations.x = 500;
			Informations.y = 0;
			Informations.width=150;
 			Informations.height=20;
			Informations.background = true;
			Informations.border=true;
			Informations.selectable=false;
			if(Mode2Joueurs)
				addChild(Informations);

 			this.graphics.beginFill(0xFFFFFF);
			this.graphics.drawRect(0, 0, Largeur, Hauteur);
			GrandPere=this.All_Noeuds[All_Noeuds.length-1];
			UpdateNbJetons();//Si des noeuds sont allumés dès le départ, les compter

		}

		public function CreerArbreParents(NoeudActuel:Noeud):void
		{
			for each(var Child:Noeud in NoeudActuel.Enfants)
			{//Smells like recursivity again ;-)
				Child.addParent(NoeudActuel);
				CreerArbreParents(Child);
			}
		}

		public function UpdateNbJetons():void
		{
			var Comparaison:Boolean;
			var Nb:int=0;
			for each(var Child:Noeud in All_Noeuds)
			{
				if(Child.Ferme==true)
					Nb++;
			}
			this.NbJetonsUtilises=Nb;
			for(var i:int=0;i<this.NbJetonsToleres;i++)
			{
				Comparaison=(i<this.NbJetonsUtilises);
				JetonsUtilises[i].ChangeState(Comparaison,false);//Ne pas mettre à jour, sinon on a une réference infinie et stack overflow
				if(Comparaison)
					JetonsUtilises[i].scaleX=JetonsUtilises[i].scaleY=.7;
				else
					JetonsUtilises[i].scaleX=JetonsUtilises[i].scaleY=.5;
			}
		}

		public function Niveau2String():String
		{//Renvoyer le niveau actuel sous la forme d'un string
			var Level:String="";
			for(var i:int=0;i<Niveau_Chiffre.length;i++)
			{
				var Child:Array=Niveau_Chiffre[i];
				if(Child==null)
					Level +="null";
				else
				{
					for each(var BiChild:int in Child)
					{
						Level +=BiChild.toString()+"/";
					}
				}
				if(this.All_Noeuds[i].Ferme==true)
					Level+="@";
				if(this.All_Noeuds[i].Peut_Eteint==false)
					Level+="X";
				if(this.All_Noeuds[i].Hook_Y==-1)
					Level +="-";
				if(this.All_Noeuds[i].Hook_Y==1)
					Level +="+";
				if(this.All_Noeuds[i].aEteFerme==true)
					Level +="!";
				Level +=",";
			}
			Level=Level.slice(0,Level.length-1);
			return Level;
		}

		public function Nettoyer():void
		{
			//Nettoyer le niveau
			GrandPere.DeleteYourself();
			All_Noeuds=new Array();
			//Il y a un bug qui empêche la suppression des liens, donc on les vire manuellement.
			while(this.numChildren > 0)
			{
				this.removeChildAt(0);
			}
		}

		private function AjoutNoeud(Enfants:Array=null):Noeud
		{//Ajoute un noeud en mémoire, et retourne son occurence
			if(Enfants==null)
				Enfants=new Array();
			var NouveauNoeud:Noeud=new Noeud(Enfants,this);
			this.addChild(NouveauNoeud);
			NouveauNoeud.x=NouveauNoeud.y=-20
			return NouveauNoeud
		}
	}
}