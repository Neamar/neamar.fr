//Une particule de base
package Particules
{
 	import flash.display.Shape;
	import flash.geom.Point;
	import flash.filters.BitmapFilter;
	import flash.filters.GlowFilter;

	import flash.geom.ColorTransform;


	public class Particule
	{
		public var Gravite:Vecteur=new Vecteur(0,4);

		public var Couleur:int;
		public var Rayon:Number;
		public var Diametre:int;

		protected var Masse:Number;

		protected var Vitesse:Vecteur=new Vecteur();
		protected var Forces:Array=new Array();

		protected var Rayonnement_Strength:int;

		public var filters:Array=new Array();
		public var x:int=0;
		public var y:int=0;
		public var colorTransform:ColorTransform=new ColorTransform();


		public function Particule(Couleur:int=0xFFFFFF,Rayon:int=1,Densite:int=1)
		{//Instancie un nouveau lien : prend en paramètre le conteneur et les extremités.

			this.Rayon = Rayon;
			this.Diametre = 2*Rayon;//On le calcule une fois pour toutes, et on le stocke dans un entier pour optimiser les calculs.
			this.Masse=Math.PI*Rayon*Rayon*Densite;
			this.Couleur=Couleur;

// 			this.graphics.beginFill(Couleur);
// 			this.graphics.drawCircle(0,0,Rayon);
		}

		public function Iterate():void
		{//Met à jour la position de la particule.

			//Ajouter un peu de gravité :
			this.applyForce(Gravite);

			//Calcul de la somme des forces
			var Resultante:Vecteur=new Vecteur();
			for each(var Force:Vecteur in Forces)
			{
				Resultante.Plus(Force);
			}

			//application du PFD : Somme des forces = masse * Acceleration
			Resultante.ScalarMul(1/this.Masse);
			var Acceleration:Vecteur = Resultante;

			//Puis mise à jour de la vitesse
			Vitesse.Plus(Acceleration);

			//Et enfin, de la position.
			this.x +=Vitesse.x;
			this.y +=Vitesse.y;

			//Vidage de la liste des forces
			Forces=new Array();
		}

		public function applyForce(F:Vecteur):void
		{//Ajoute une force en liste
			Forces.push(F);
		}

		public function set glow(v:Number):void
		{
			this.Rayonnement_Strength=v;
			updateFilters();
		}
		public function get glow():Number
		{
			return this.Rayonnement_Strength;
		}

		public function set Pos(P:Point):void
		{
			this.x=P.x;
			this.y=P.y;
		}
		public function get Pos():Point
		{
			return new Point(this.x,this.y);
		}

// 		public override function set filters(F:Array):void
// 		{
// 			this.inner_filters=F;
// 		}
// 		public override function get filters():Array
// 		{
// 			return this.inner_filters;
// 		}
//
// 		public override function set x(v:int):void
// 		{
// 			this.inner_x=v;
// 		}
// 		public override function get x():int
// 		{
// 			return this.inner_x;
// 		}
//
// 		public override function set y(v:int):void
// 		{
// 			this.inner_y=v;
// 		}
// 		public override function get y():int
// 		{
// 			return this.inner_y;
// 		}

		private function updateFilters():void
		{
			//GlowFilter(color:uint = 0xFF0000, alpha:Number = 1.0, blurX:Number = 6.0, blurY:Number = 6.0, strength:Number = 2, quality:int = 1, inner:Boolean = false, knockout:Boolean = false)
			var Rayon_Filtre:GlowFilter = new GlowFilter(this.Couleur,.8,8,8,this.Rayonnement_Strength);

			var Filtres:Array=new Array(Rayon_Filtre);
			this.filters=Filtres;
		}
	}
}