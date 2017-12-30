//Un lien (arete, arc...peut importe le nom !)
package
{
 	import flash.display.Sprite;
	import flash.geom.Point;
	import flash.events.Event;
	import flash.events.MouseEvent;//Interaction utilisateur//souris
	import flash.filters.BitmapFilter;
	import flash.filters.GlowFilter;
	import flash.geom.ColorTransform;

	import flash.text.TextField;//Champ de texte. Classe assez vaste, utilisée uniquement pour l'affichage de texte ici. Peut être du texte au format HTML.

	public class Arc extends Sprite
	{

		private var Final_Glow:int=0;//La valeur de rayonnement désirée
		private var Current_Glow:Number=0;//Le rayonnement actuel du noeud
		private var PBS:Boolean=false;

		public var Extremites:Array;//Extremites contient les noeuds parents
		public var ID:int;

		private var Layer:Land;

		private static var Defaut_Color:ColorTransform= new ColorTransform();
		private static var Short_Color:ColorTransform = new ColorTransform(1, 1, 1,1, 255,255,255);

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
		new Array(new GlowFilter(0x00FF00, 0.8,16,16,5)));//Evite d'avoir à recréer le filtre en permanence. En plus on utilise static ce qui allège la consommation de mémoire : les filtres ne sont crées qu'une fois au démarrage de l'application, pas à chaque instanciation de noeud.


		//la representation graphique de l'arc :
		private var Depart:Point;//Depart est l'emplacement du premier parent, avec un peu de trigonométrie...cf. plus bas
		private var Arrivee:Point;//idem
		private var Controle:Point;//Le point de controle pour la courbe de Bézier
		private var Texte:TextField=new TextField();

		public function Arc(Layer:Land,Point1:Noeud,Point2:Noeud,ControlePoint:Point)
		{//Instancie un nouveau lien : prend en paramètre le conteneur et les extremités.
			this.Layer = Layer;
			Layer.PremierPlan.addChild(this);
			Layer.PremierPlan.setChildIndex(this,0);

			this.Extremites=new Array(Point1,Point2);
			this.Controle=ControlePoint;

			this.Refresh();

			Texte.x = (Point1.x+Point2.x)/2;
			Texte.y = (Point1.y+Point2.y)/2-10;
			Texte.autoSize = "left";
			Texte.mouseEnabled=false;
			this.addChild(Texte);

		}

		public function set PlayedByShort(v:Boolean):void
		{
			this.PBS=v;

			if(v)
			{
				this.transform.colorTransform=Short_Color;
				this.AddFocus(2);
			}
		}
		public function get PlayedByShort():Boolean
		{
			return this.PBS;
		}

		public function set Caption(v:String):void
		{
			if(Const.MODE==Const.DEBUG)
				Texte.text=v;
		}
		public function Refresh():void
		{//Redessine entièrement le lien. Cette méthode est utilisée lorsque l'un des noeuds se déplace||est déplacé
			//Met aussi à jour la liste des collisions.
			this.graphics.clear();

			this.Depart=new Point(this.Extremites[0].x,this.Extremites[0].y);
			this.Arrivee=new Point(this.Extremites[1].x,this.Extremites[1].y);

			//Le trait principal
			this.graphics.moveTo(Depart.x,Depart.y);
			this.graphics.lineStyle(3,0x444444,.9);
			this.graphics.curveTo(Controle.x,Controle.y,Arrivee.x,Arrivee.y);

			//L'ombrage
			this.graphics.lineStyle(23,0xFFFFFF,.001);
			this.graphics.curveTo(Controle.x,Controle.y,Depart.x,Depart.y);
		}

		public function AddFocus(Level:int):void
		{//Ajoute un flou à la forme.
			this.Final_Glow=2*Level;//Il y a un facteur 2 entre ce qui est demandé et ce qui est dessiné.
			this.addEventListener(Event.ENTER_FRAME,ChangeFiltre);
		}

		public function Sommet(OtherThan:Noeud):Noeud
		{
			if(OtherThan==this.Extremites[0])
				return Extremites[1];
			else
				return Extremites[0];
		}

		private function ChangeFiltre(e:Event=null):void
		{//gestion des filtres dans le temps

			//Filtre HOVER
			if(Current_Glow<Final_Glow)
				Current_Glow=Math.min(Final_Glow,Current_Glow+.5);
			else
				Current_Glow=Math.max(Final_Glow,Current_Glow-1);

			this.filters=Filtres[int(Current_Glow)];

			//Enlever l'évenement afin de décharger la mémoire.
			if(Current_Glow==Final_Glow)
				this.removeEventListener(Event.ENTER_FRAME,ChangeFiltre);
		}
	}
}