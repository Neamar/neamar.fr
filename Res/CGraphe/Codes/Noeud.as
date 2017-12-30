//Un noeud quelconque.
//Dans C_Graphe les noeuds n'ont pas d'utilité particulière.
//Le code est donc très court...
package
{
	import flash.display.Shape;
	import flash.geom.Point;


	public class Noeud extends Shape
	{

		public var Liens:Array=new Array();

		private var Final_Glow:int;//La valeur de rayonnement désirée
		private var Current_Glow:Number;//Le rayonnement actuel du noeud

		private var Layer:Land;//Le conteneur


		private static const RAYON:int=10;

		public function Noeud(Layer:Land,x:Number,y:Number)
		{//Instancie un nouveau noeud

			this.Layer = Layer;

			this.x=x; this.y=y;

			this.graphics.beginFill(0xEEEEEE);
			this.graphics.lineStyle(1,0x000000);
			this.graphics.drawCircle(0, 0, 4);//Plus il y a de noeuds, plus le dessin est petit. Mais on impose une taille minimum !

			Layer.PremierPlan.addChild(this);

		}

		public function AjouterLien(Lien:Arc):void
		{
			Liens.push(Lien);
		}
		public function RemoveLien(Lien:Arc):void
		{
			Liens.splice(Liens.indexOf(Lien),1);
			if(Liens.length==0)
				this.alpha=.3;
		}
	}
}