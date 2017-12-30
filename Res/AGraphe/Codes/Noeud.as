//Un noeud quelconque
package
{
	import flash.display.Sprite;
	import flash.geom.Point;
	import flash.events.*;
	import flash.filters.BitmapFilter;
	import flash.filters.GlowFilter;

	public class Noeud extends Sprite
	{
		public var Enfants:Array;//La liste des enfants
		public var Parents:Array;//idem pour les parents
		public var Ferme:Boolean;//Si le noeud est allumé, Ferme vaut true
		public var Hook_Y:int;
		public var Peut_Eteint:Boolean;//Les noeuds avec une croix à l'intérieur ont Peut_Eteint=false
		public var aEteFerme:Boolean;//Le noeud a déjà été allumé

		private const RAYON:int=15;
		private var Layer:Niveau;//Le sprite conteneur
		private var Arc_Liste:Array=new Array();//La liste des liens vers les enfants
		private var Final_Glow:int;//Le rayonnement du noeud
		private var Current_Glow:Number;//La valeur de rayonnement désirée
		private var NbPlacements:int;//Le nombre de fois que le noeud a été placé
		private const PI:Number=3.141;//...

		public function Noeud(Enfants:Array,Layer:Niveau)
		{//Instancie un nouveau noeud
			this.Enfants = Enfants;
			this.Parents=new Array();
			this.Ferme=false;
			this.aEteFerme=false;
			this.Layer=Layer;
			this.Final_Glow=this.Current_Glow=0;
			this.NbPlacements=0; //Le nombre de fois que le noeud a été déplacé dans l'arbre, cf. fonction GererXY.
			this.Hook_Y=0;
			this.Peut_Eteint=true;

			this.graphics.beginFill(0xEEEEEE);
			this.graphics.lineStyle(1,0x000000);
			this.graphics.drawCircle(0, 0, RAYON);

			this.addEventListener(MouseEvent.MOUSE_MOVE,SourisIN);
			this.addEventListener(MouseEvent.MOUSE_OUT,SourisOUT);
			this.addEventListener(MouseEvent.CLICK,SourisClick);

			RecreerArbreLien();
		}

		public function RecreerArbreLien():void
		{//Recrée l'ensemble des liens
			//D'abord les supprimer proprement
			RemoveLiens();
			var Lien:Arc;
			//Et refaire l'ensemble
			for each(var Child:Noeud in Enfants)
			{
				Lien=new Arc(new Point(this.x,this.y),new Point(Child.x,Child.y));
				Arc_Liste.push(Lien);
				Layer.addChild(Lien);
				Layer.setChildIndex(Lien,0);
				//Ne pas oublier d'informer l'enfant que l'on a refait l'arbre :
				Child.RecreerArbreLien();
			}
		}

		public function Profondeur():int
		{//Renvoie la profondeur de l'objet, i.e le nombre maximal de sous enfants disponibles.
			//Utilise la récursivité en faisant appel à ses enfants.
			var Max:uint=0;
			if(this.Enfants.length==0)
				return 1;
			else
			{
				for each(var Child:Noeud in Enfants)
				{
					Max=Math.max(Max,Child.Profondeur());
				}
				return 1+Max;
			}
		}

		public function addParent(Parent:Noeud):void
		{//Ajoute un parent au noeud
			this.Parents.push(Parent);
		}

		public function AddFocus(Level:int):void
		{//Ajoute un flou à la forme.
			for each(var Enfant:Noeud in Enfants)
			{//Demande aux enfants d'afficher un flou aussi, mais un peu plus faible
				Enfant.AddFocus(Math.max(0,Level-1));
			}

			//Puis lancer l'animation
			this.Final_Glow=Level;
			this.addEventListener(Event.ENTER_FRAME,ChangeFiltre);
		}

		public function addHook(Level:int):void
		{
			this.Hook_Y=Level;
		}

		public function Is_Not_Eteignable(Valeur:Boolean):void
		{
			this.Peut_Eteint=! Valeur;
			if(Valeur==true)
			{
				this.graphics.moveTo(-RAYON*Math.sin(PI/4),-RAYON*Math.sin(PI/4));
				this.graphics.lineTo(RAYON*Math.sin(PI/4),RAYON*Math.sin(PI/4));
				this.graphics.moveTo(-RAYON*Math.sin(PI/4),RAYON*Math.sin(PI/4));
				this.graphics.lineTo(RAYON*Math.sin(PI/4),-RAYON*Math.sin(PI/4));
			}
		}

		public function GererXY(NiveauActuel:int,NiveauMax:int,Largeur:int,Position:int):void
		{//Cette fonction a pour but de gérer l'agencement des noeuds dans le graphe.
		//Le noeud recoit des ordres : sa position y est determinée par son imbrication
		//Sa position X est determinée par la variable Position.
		//Largeur lui indique que tous ses enfants devront être dans un rectangle de Position-Largeur/2 à Position+Largeur/2.
			var Child:Noeud; //Pour les boucles!
			var FutureLargeur:Number=Largeur/this.Enfants.length;
			var i:int=0;
			var YDemande:int=20+400*(NiveauActuel-1)/(NiveauMax-1);//Le niveau Y des enfants
			var DecalageYHook:int=400/(NiveauMax-1);//Une valeur de décalage de Y
			var PositionInitialeXEnfants:int=Position-Largeur/2;

			this.NbPlacements++;//Nombre de fois que l'on place le noeud. Si on le place plusieurs fois, il faut le centrer de façon à ce qu'il soit bien, et pour cela on a besoin d ela moyenne, donc du nombre de déplacements à prendre en compte.
			this.x=(Position+(this.NbPlacements-1)*this.x)/this.NbPlacements; //Si il a déjà été placé auparavant, on le centre : un simple calcul de moyenne avec pondération.
			this.y = Math.max(this.y,YDemande) + this.Hook_Y*DecalageYHook;//Sile noeud a déjà été placé, ne conserver que le y le plus élevé. Ajouter le Hook si besoin.

			for each(Child in this.Enfants)
			{//Smells like recursivity again ;-)
				i++;
				Child.GererXY(NiveauActuel+1,NiveauMax,FutureLargeur,PositionInitialeXEnfants + (i-.5)*FutureLargeur);
			}
		}

		public function Peut_Etre_Allume():Boolean
		{//Ce noeud est il allumable ?
			var unEnfantOuvert:Boolean=false;
			for each(var Enfant:Noeud in Enfants)
			{//Vérifier que tous les enfants sont bien fermés
				if(!Enfant.Ferme)
					unEnfantOuvert=true;
			}
			return (!unEnfantOuvert && !this.aEteFerme && !this.Ferme); //Si le noeud a déjà été fermé, il ne peut pas être refermé.
		}

		public function Peut_Etre_Eteint():Boolean
		{//Ce noeud est-il éteignable ?
			return (this.Ferme && this.Peut_Eteint);
		}

		public function ChangeState(Etat:Boolean,TriggerUpdate:Boolean=true):void
		{//Passer d'un état à un autre.
			this.Ferme=Etat;
			if(Etat)
			{
				this.addEventListener(Event.ENTER_FRAME,ChangeFiltre)
				if(!this.Peut_Eteint)
					this.addEventListener(Event.ENTER_FRAME,Tourne);
			}
			else
			{
				this.aEteFerme=true;
				this.filters=new Array();
			}

			//On peut demander à ne pas mettre à jour le niveau. Pratique dans le cas où on change juste les jetons indiquants le nombre de noeuds allumés :)
			if(TriggerUpdate)
				Layer.UpdateNbJetons();//Demander une MAJ du nombre de jetons
		}

		public function DeleteYourself():void
		{//Demande l'auto destruction du noeud et de ses enfants.
			RemoveLiens();
			for each(var Enfant:Noeud in Enfants)
			{//Demander la destruction des enfants.
				Enfant.DeleteYourself();
			}
			//Puis supprimer du niveau le noeud
			if(Layer.contains(this))
				Layer.removeChild(this);
		}


		//Fonctions privées
		private function SourisIN(e:MouseEvent):void
		{//Ajoute un filtre indiquant que la forme est hoverée
			AddFocus(Profondeur());
		}
		private function SourisOUT(e:MouseEvent):void
		{//Ajoute le filtre indiquant que la forme n'est plus hoverée
			AddFocus(0);
		}

		private function SourisClick(e:Event):void
		{//swapper l'état de ouvert à fermé ou vice versa.
			if(Peut_Etre_Eteint())
				this.ChangeState(false);//Eteindre le noeud
			else if(Peut_Etre_Allume())
				this.ChangeState(true);//L'allumer
		}

		private function Tourne(e:Event):void
		{//Fait tourner le noeud, modulo 360.
			this.rotation=(this.rotation+1)%360;
		}

		private function ChangeFiltre(e:Event=null):void
		{//gestion des filtres dans le temps

			//Filtre HOVER
			if(Current_Glow<Final_Glow)
				Current_Glow=Math.min(Final_Glow,Current_Glow+0.2);
			else
				Current_Glow=Math.max(Final_Glow,Current_Glow-0.1);

			var ListeFiltres:Array = new Array(new GlowFilter(0xFF0000, 0.8,16,16,Current_Glow,1,false,false));

			//Filtre FORME FERMEE
			if(Ferme)
			{
				if(Peut_Eteint)
					ListeFiltres.push(new GlowFilter(0x00FF00, 1,16,16,2*Profondeur(),1,false,false));
				else
					ListeFiltres.push(new GlowFilter(0xFEA900, 1,16,16,2*Profondeur(),1,false,false));
			}

			//Applications des filtres
			for each(var Lien:Arc in Arc_Liste)
				Lien.filters=ListeFiltres;

			this.filters=ListeFiltres;

			if(Current_Glow==Final_Glow)
				this.removeEventListener(Event.ENTER_FRAME,ChangeFiltre);
		}

		private function RemoveLiens():void
		{//Supprime les images des liens entres noeuds.
			var Lien:Arc;
			for each(Lien in Arc_Liste)
			{
				if(Layer.contains(Lien))
					Layer.removeChild(Lien);
			}
			Arc_Liste=new Array();
		}
	}
}