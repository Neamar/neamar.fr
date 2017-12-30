//Un lien (arete, arc...peut importe le nom !)
package
{
	import flash.display.DisplayObject;
 	import flash.display.Shape;
	import flash.geom.Point;
	import flash.filters.BitmapFilter;
	import flash.filters.GlowFilter;

	import flash.geom.ColorTransform;


	public class Arc extends Shape
	{

		private static var Defaut_Color:ColorTransform= new ColorTransform();
		private static var Highlight_Color:ColorTransform = new ColorTransform(1, 1, 1,1, 255,-255,-255);

		public var Extremites:Array;//Extremites contient les noeuds parents

		private var Layer:Niveau;
		private var All_Liens:Array;
		private var All_Noeuds:Array;


		//la representation graphique de l'arc :
		private var Depart:Point;//Depart est l'emplacement du premier parent, avec un peu de trigonométrie...cf. plus bas
		private var Arrivee:Point;//idem
		private var Angle:Number;//l'angle entre les deux noeuds.

		//Les informations associées :
		private var CollisionAvec:Array=new Array();
		private var DernierEtat:Boolean=false;
		private var Forward:Boolean=false;

		private const Rayon:Number=.05;

		public function Arc(Layer:Niveau,Point1:Noeud,Point2:Noeud)
		{//Instancie un nouveau lien : prend en paramètre le conteneur et les extremités.
			this.Layer = Layer;
			Layer.addChild(this);
			Layer.setChildIndex(this,0);

			this.Extremites=new Array(Point1,Point2);
			this.All_Liens = Layer.All_Liens;//garder en mémoire qu'il ne s'agit que d'une copie par référence : la mise à jour de l'un agit sur le second et vice versa.
			this.All_Noeuds= Layer.All_Noeuds;
			this.Refresh();
		}

		public function Refresh():void
		{//Redessine entièrement le lien. Cette méthode est utilisée lorsque l'un des noeuds se déplace||est déplacé
			//Met aussi à jour la liste des collisions.
			this.graphics.clear();
			this.Angle=GetAngle();//On est obligé de ruser, sinon tous les liens d'un même noeud seraient considérés commme intersectant (ils auraient le centre du noeud en point de collision)/
			//La ruse consiste à placer les points AUTOUR du centre, à "Rayon" de distance : ainsi, il n'y a plus de points communs. Le problème, c'est qu'on laisse ouvert le point central...en zoomant, on peut donc tricher. (dans certains cas, pas tout le temps !)

			var Cosinus:Number=Rayon*Math.cos(this.Angle);
			var Sinus:Number=Rayon*Math.sin(this.Angle);
			this.Depart=new Point(
				this.Extremites[0].x+Cosinus,
				this.Extremites[0].y+Sinus
			);

			//Pour l'arrivée : en théorie :
			//this.Extremites[1].x+Rayon*Math.cos(this.Angle+Math.PI),
			//this.Extremites[1].y+Rayon*Math.sin(this.Angle+Math.PI) mais cos(x+pi)=-cos(pi) et sin(x+pi)=-sin(pi)
			this.Arrivee=new Point(
				this.Extremites[1].x-Cosinus,
				this.Extremites[1].y-Sinus
			);

			this.graphics.moveTo(Depart.x,Depart.y);
			this.graphics.lineStyle(2,0x444444);
			this.graphics.lineTo(Arrivee.x,Arrivee.y);

			this.UpdateCollision();
		}

		public function get Collusion():Boolean
		{
			return (CollisionAvec.length!=0);
		}

		public function UpdateCollision(Forward:Boolean=true):void
		{//Met à jour la liste des collisions.
		//Le paramètre Forward indique si les messages doivent se transmettre : par exemple, si une arete A a une collision avec B, qu'on la déplace de façon à enlever la collision, A demandera à B de mettre à jour sa liste de collisions, sauf si Forward vaut false.
			this.Forward=Forward;

			CollisionAvec = All_Liens.filter(TestCollisionArcArc);

// 			var Filtres:Array=new Array();
// 			var DegreCollision:int=CollisionAvec.length;
// 			if(DegreCollision!=0)//on pourrait aussi utiliser la méthode this.Collusion mais on cherche à faire le moins de calculs possibles, cette méthode étant souvent utilisée.
// 				Filtres.push(new GlowFilter(0xFF0000, 0.8,5,5,DegreCollision,1,false,false));
//
// 			this.filters=Filtres;
			var DegreCollision:int=CollisionAvec.length;
			if((DegreCollision!=0)!=DernierEtat)
			{
				if(DegreCollision!=0)//on pourrait aussi utiliser la méthode this.Collusion mais on cherche à faire le moins de calculs possibles, cette méthode étant souvent utilisée.
					this.transform.colorTransform = Highlight_Color;
				else
					this.transform.colorTransform = Defaut_Color;
					DernierEtat=(DegreCollision!=0);
			}
		}

		private function TestCollisionArcArc(Lien:Arc, index:int, array:Array):Boolean
		{//on effectue plusieurs tests, du moins lent au plus lent.
		//(fonction appelée via Array*.filter)
			var Resultat:Boolean = (Lien!=this && this.hitTestObject(Lien) && this.intersectionArc(Lien));

			if(this.Forward && ((!Resultat && this.CollisionAvec.indexOf(Lien)!=-1) || Resultat))
			{//Il y a une collision de moins !
				//Demander la MAJ du trait, puisqu'il est peut être libre maintenant :
				Lien.UpdateCollision(false);//Pas besoin de re-forwarder le message
			}
			return Resultat;
		}

		private function intersectionArc(Lien:Arc):Boolean
		{//Renvoie true si une intersection existe entre les deux segments.
			var A:Point=this.Depart;
			var B:Point=this.Arrivee;
			var C:Point=Lien.Depart;
			var D:Point=Lien.Arrivee;
			var r_num:Number = (A.y-C.y)*(D.x-C.x)-(A.x-C.x)*(D.y-C.y);
			var r_den:Number = (B.x-A.x)*(D.y-C.y)-(B.y-A.y)*(D.x-C.x);

			if (r_den==0) return false;     // Pas d'interesection
			var r:Number = r_num/r_den;
			if (r<=0 || r>=1) return false; // Intersection en dehors du segment [AB]

			var s_num:Number = (A.y-C.y)*(B.x-A.x)-(A.x-C.x)*(B.y-A.y);
			var s_den:Number = (B.x-A.x)*(D.y-C.y)-(B.y-A.y)*(D.x-C.x);
// 			this.graphics.clear();
			if (s_den==0) return false;     // Pas d'interesection
			var s:Number = s_num/s_den;
			if (s<=0 || s>=1) return false; // Intersection en dehors du segment [CD]

			//Si on est encore là, il y a intersection...
			return true;
		}


		private function GetAngle():Number
		{//Renvoie l'angle entre les extremités.
		//Rien que des maths !
			var x:Number=Extremites[1].x-Extremites[0].x;
			var y:Number=Extremites[1].y-Extremites[0].y;

			if(y!=0)
				return (Math.PI*(y/Math.abs(y)))*.5 - Math.atan(x/y);
			else if(x>0)
				return 0;
			else
				return Math.PI;
		}
	}
}