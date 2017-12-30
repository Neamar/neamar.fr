//Un noeud quelconque
package
{
	import flash.display.Sprite;
	import flash.geom.Point;
	import flash.events.Event;
	import flash.events.MouseEvent;//Interaction utilisateur//souris
	import flash.filters.BitmapFilter;
	import flash.filters.GlowFilter;
// 	import flash.utils.getTimer;


	public class Noeud extends Sprite
	{
		private var Final_Glow:int;//La valeur de rayonnement désirée
		private var Current_Glow:Number;//Le rayonnement actuel du noeud

		private var Layer:Niveau;//Le conteneur
		private var Liens:Array;

		private static const RAYON:int=20;

		private static const Filtres:Array=new Array(
		new Array(),
		new Array(new GlowFilter(0x00FF00, 0.8,16,16,.5)),
		new Array(new GlowFilter(0x00FF00, 0.8,16,16,1)),
		new Array(new GlowFilter(0x00FF00, 0.8,16,16,1.5)),
		new Array(new GlowFilter(0x00FF00, 0.8,16,16,2)),
		new Array(new GlowFilter(0x00FF00, 0.8,16,16,2.5)),
		new Array(new GlowFilter(0x00FF00, 0.8,16,16,3)),
		new Array(new GlowFilter(0x00FF00, 0.8,16,16,3.5)),
		new Array(new GlowFilter(0x00FF00, 0.8,16,16,4)),
		new Array(new GlowFilter(0x00FF00, 0.8,16,16,4.5)),
		new Array(new GlowFilter(0x00FF00, 0.8,16,16,5))
		);//Evite d'avoir à recréer le filtre en permanence. En plus on utilise static ce qui allège la consommation de mémoire : les filtres ne sont crées qu'une fois au démarrage de l'application, pas à chaque instanciation de noeud.

		private static const Filtres_Enfants:Array=new Array(
		null,
		new Array(new GlowFilter(0x0000FF, 0.8,16,16,.35)),
		new Array(new GlowFilter(0x0000FF, 0.8,16,16,.7)),
		new Array(new GlowFilter(0x0000FF, 0.8,16,16,1.05)),
		new Array(new GlowFilter(0x0000FF, 0.8,16,16,1.4)),
		new Array(new GlowFilter(0x0000FF, 0.8,16,16,1.75)),
		new Array(new GlowFilter(0x0000FF, 0.8,16,16,2.1)),
		new Array(new GlowFilter(0x0000FF, 0.8,16,16,2.45)),
		new Array(new GlowFilter(0x0000FF, 0.8,16,16,2.8)),
		new Array(new GlowFilter(0x0000FF, 0.8,16,16,3.15)),
		new Array(new GlowFilter(0x0000FF, 0.8,16,16,3.5))
		);//Même raison,

		public function Noeud(Layer:Niveau,x:Number,y:Number,NbNoeuds:int=1)
		{//Instancie un nouveau noeud

			this.Layer = Layer;
			this.Liens=new Array();

			this.x=x;
			this.y=y;

			this.graphics.beginFill(0xEEEEEE);
			this.graphics.lineStyle(1,0x000000);
			this.graphics.drawCircle(0, 0, Math.max(7,RAYON-NbNoeuds));//Plus il y a de noeuds, plus le dessin est petit. Mais on impose une taille minimum !

			Layer.addChild(this);
			this.Final_Glow=this.Current_Glow=0;
		}

		public function AjouterLien(Lien:Arc):void
		{
			Liens.push(Lien);
		}

		public function set Passif(value:Boolean):void
		{
			if(value==true)
			{
				//Empeche toute action sur le noeud
				this.removeEventListener(MouseEvent.MOUSE_OVER,SourisIN);
				this.removeEventListener(MouseEvent.MOUSE_OUT,SourisOUT);
				this.removeEventListener(MouseEvent.MOUSE_DOWN,SourisDown);
// 				this.Dragger();
				SourisOUT(); //Simuler une sortie de souris, pour supprimer le drag et les filtres.
			}
			else
			{//Remettre les évenements souris.
				this.addEventListener(MouseEvent.MOUSE_OVER,SourisIN);
				this.addEventListener(MouseEvent.MOUSE_OUT,SourisOUT);
				this.addEventListener(MouseEvent.MOUSE_DOWN,SourisDown);
			}
		}

		//Fonctions privées



		private function Dragger(e:Event=null):void
		{//MAJ des collisions
				for each(var Lien:Arc in Liens)
					Lien.Refresh();
		}

		private function SourisDown(e:Event):void
		{//Dragger : supprimer les évenements obsolets, ajouter les nouveaux.
			this.removeEventListener(MouseEvent.MOUSE_DOWN,SourisDown);
			this.removeEventListener(MouseEvent.MOUSE_OUT,SourisOUT);//Quand on dragge trop vite, l'évenenement se déclenche et les filtres font du yoyo.
			this.addEventListener(MouseEvent.MOUSE_UP,SourisUp);
			this.addEventListener(MouseEvent.MOUSE_MOVE,Dragger);
			this.startDrag();
		}
		private function SourisUp(e:Event):void
		{
			this.removeEventListener(MouseEvent.MOUSE_UP,SourisUp);
			this.removeEventListener(MouseEvent.MOUSE_MOVE,Dragger);

			this.addEventListener(MouseEvent.MOUSE_DOWN,SourisDown);
			this.addEventListener(MouseEvent.MOUSE_OUT,SourisOUT);

			this.stopDrag();
// 			DerniereAction=0;
			this.Dragger(); //En cas de drag rapide, il peut y avoir décalage : avec cette instruction, on met à jour de façon sûre.
		}

		private function AddFocus(Level:int):void
		{//Ajoute un flou à la forme.
			this.Final_Glow=2*Level;//Il y a un facteur 2 entre ce qui est demandé et ce qui est dessiné
			this.addEventListener(Event.ENTER_FRAME,ChangeFiltre);
		}

		private function SourisIN(e:MouseEvent):void
		{//Ajoute un filtre indiquant que la forme est hoverée
			AddFocus(5);
		}
		private function SourisOUT(e:MouseEvent=null):void
		{//Ajoute un filtre indiquant que la forme n'est plus hoverée
			AddFocus(0);
		}

		private function ChangeFiltre(e:Event=null):void
		{//gestion des filtres dans le temps

			//Filtre HOVER
			if(Current_Glow<Final_Glow)
				Current_Glow=Math.min(Final_Glow,Current_Glow+1);
			else
				Current_Glow=Math.max(Final_Glow,Current_Glow-0.5);

			this.filters=Filtres[int(Current_Glow)];

			for each(var Lien:Arc in Liens)
			{
				if(Lien.Extremites[0]==this)
					Lien.Extremites[1].filters = Filtres_Enfants[int(Current_Glow)];
				else
					Lien.Extremites[0].filters = Filtres_Enfants[int(Current_Glow)];
			}

			//Enlever l'évenement afin de décharger la mémoire.
			if(Current_Glow==Final_Glow)
				this.removeEventListener(Event.ENTER_FRAME,ChangeFiltre);
		}
	}
}