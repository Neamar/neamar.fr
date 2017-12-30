//Un niveau standard : contient des liens et des noeuds !
package
{
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;//Interaction utilisateur//souris


	public class Niveau extends Sprite
	{
		public var All_Noeuds:Array;
		public var All_Liens:Array;

		public var Officiel:Boolean=true;

		public var NumeroNiveau:int=0;

		public var TailleActuelle:Number=1;//Le niveau de Taille du Fond actuel
		private var TailleFinale:Number=1;//Le niveau final de Taille demandé pour Fond.

		private var Is_Destructing:Boolean=false;
		private var DestructionTerminee:Boolean=false;

		private static const RAYON_NOEUDS:int=200; //Le rayon du cercle fait par les noeuds lors du chargement du niveau

		public function Niveau(Liens:Array,Largeur:int=0,Hauteur:int=0)
		{
			function Shuffle(a:Noeud,b:Noeud):Number
			{
				return -1 + Math.floor(3*Math.random());//Mélange aléatoirement l'ensemble
			}
			//Trouver le nombre de noeuds :
			var NbNoeuds:int=0;
			var Lien:Array;
			var Arete:Arc

			for each(Lien in Liens)
				NbNoeuds=Math.max(NbNoeuds,Lien[0],Lien[1]);

			All_Noeuds = new Array();
			All_Liens = new Array();
			NbNoeuds++;//Petite astuce trigonométrique...
			for(var i:int=0;i<NbNoeuds;i++)//Remarquer qu'on fait < et pas <=, pour contourner l'astuce
			{//Ajouter le noeud
				All_Noeuds.push(new Noeud(this,
				Math.cos(2*Math.PI*(i/NbNoeuds))*RAYON_NOEUDS,
				Math.sin(2*Math.PI*(i/NbNoeuds))*RAYON_NOEUDS
				,NbNoeuds));
			}

  			All_Noeuds.sort(Shuffle);

			for each(Lien in Liens)
			{
				Arete=new Arc(this,All_Noeuds[Lien[0]],All_Noeuds[Lien[1]]);
				All_Noeuds[Lien[0]].AjouterLien(Arete);
				All_Noeuds[Lien[1]].AjouterLien(Arete);
				All_Liens.push(Arete);
			}
			for each(Arete in All_Liens)//Tous les liens sont crées, reste à updater :
				Arete.UpdateCollision(false);//Paramètre forward à false pour passer en O(n) (pas de récursion)

			this.graphics.beginFill(0xFFFFFF);
			this.graphics.drawRect(-Largeur/2, -Hauteur/2, Largeur, Hauteur);
		}

		public function set Taille(value:Number):void
		{
			TailleFinale=value;
			this.Passif=true;
			this.addEventListener(Event.ENTER_FRAME,GererTaille);
		}
		public function get Taille():Number
		{
 			return TailleFinale
		}

		public function Param():String
		{
			//Renvoie les paramètres du niveau : nombre de noeuds, nombre d'arretes, et Densité
 			return All_Noeuds.length +" noeuds, " + All_Liens.length + " liens. Degré : " + Math.round(100*this.Densite())/100;
		}

		public function Densite():Number
		{
			//Renvoie un indice de difficulté du niveau.
			//Cet indice est calculé de façon empirique.
			var Difficulte:Number=1.5*All_Liens.length/All_Noeuds.length + All_Noeuds.length/35 + All_Liens.length/30 + 0.2*(All_Liens.length/2.2 - All_Noeuds.length);
			return Difficulte;
// 			//Une méthode alternative qui utilise la classification d'Euler sur la densité maximale des graphes planaires :
// 			100*(1.5*All_Liens.length/All_Noeuds.length + All_Noeuds.length/35 + All_Liens.length/30 + 0.2*(All_Liens.length/2.2 - All_Noeuds.length) - .5*(3*All_Noeuds.length -6-All_Liens.length));

		}

		public function get Termine():Boolean
		{//Renvoie true si aucune collision détectée
			function EnCollision(Lien:Arc, index:int, array:Array):Boolean
			{
				return Lien.Collusion;
			}
			//Teste si le niveau est terminé.
			//S'il l'est, on lance l'auto destruction. On ne renvoie le signal terminé que lorsque tout a été nettoyé.
			if(!Is_Destructing)
			{
				var Reponse:Boolean = !this.All_Liens.some(EnCollision);
				if(Reponse)
				{//Le niveau est terminé, préparer l'auto destruction !
					Is_Destructing=true;
					this.addEventListener(Event.ENTER_FRAME,Auto_Destruction);
					//Arreter le drag
					this.startDrag();
					this.stopDrag();
					//rendre passif tous les noeuds :
					this.Passif=true;
				}
			}
			else if(DestructionTerminee)
				return true;

			return false;
		}

		public function set Passif(value:Boolean):void
		{//rend le niveau passif : on ne peut pas cliquer sur les noeuds, et ils ne s'illuminent pas. Cela permet :
// 		-De ne pas surharger le processeur d'évenement lrosque tous les niveaux sont affichés
//		-D'éviter de continuer un drag lors d'un changement de zoom (sinon, la souris sort du noeud et on ne peut plus le dédragger)
			for each(var Node:Noeud in All_Noeuds)
				Node.Passif=value;
		}

		private function Auto_Destruction(e:Event):void
		{//L'auto destruction sert à quitter le niveau de façon agréable. Auparavant, dès qu'il était terminé, le nouveau apparaissait. Ce mode n'a pas convaincu les testeurs, d'où l'apparition de l'autodestruction.
			if(All_Liens.length==0)
			{
				DestructionTerminee=true;
				this.mouseEnabled=false;
				this.removeEventListener(Event.ENTER_FRAME,Auto_Destruction);
			}
			else if(Math.random()>Math.min(All_Liens.length/10,.9))
			{
				var UnLien:Arc=All_Liens.pop();
				this.removeChild(UnLien);
			}
			this.rotation++;
			if(this.Taille!=1)
				this.Taille=1;
		}

		private function GererTaille(e:Event):void
		{//Zoomer // dézoomer sur le niveau
		    var dS:Number = (this.TailleFinale - this.scaleX)/5;
			if (Math.abs(dS)>0.003)
				this.scaleX = this.scaleY += dS;
			else
			{
				this.Passif=false;//Redonner de la réactivité au niveau.
				this.TailleActuelle=this.scaleX=this.scaleY=TailleFinale;
				this.removeEventListener(Event.ENTER_FRAME,GererTaille);
			}
		}
	}
}