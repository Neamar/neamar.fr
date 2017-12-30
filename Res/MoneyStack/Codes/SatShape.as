package Utilitaires.geom
{
	import flash.display.Sprite;
	import Utilitaires.ArrayPlus;
	
	/**
	 * Une forme qui peut être utilisée avec le Separating Axis Theorem pour des hitTests plus avancés.
	 * @author Neamar
	 */
	public class SatShape extends Sprite
	{
		public var rotation_rad:Number;
		
		
		/**
		 * Liste des axes à tester pour SAT.
		 */
		protected var _Axes:ArrayPlus=new ArrayPlus();//Coordonnées ABSOLUES
		
		/**
		 * Liste des vecteurs (segments) composant la figure.
		 */
		public var Vecteurs:ArrayPlus = new ArrayPlus();//Coordonnées ABSOLUES
		public var Sommets:ArrayPlus = new ArrayPlus();//Coordonnées RELATIVES
		
		public function SatShape(x:int,y:int)
		{
			this.x = x;
			this.y = y;
		}
		
		public function destroy():void
		{
			Vecteurs = null;
			Sommets = null;
			_Axes = null;
		}
		
		public function makeAxis():void
		{
			_Axes = new ArrayPlus();
			for each(var Vecteur:Vector in Vecteurs)
			{
				var Axe:Vector = Vecteur.clone();
				Axe.unitaire();
				_Axes.push(Axe);
			}
		}
		public function makeVector():void
		{
			//Une fois la génération des vecteurs finies, en déduire les axes.
			makeAxis();
		}
		
		public override function set rotation(v:Number):void
		{
			this.rotation_rad = v * Math.PI / 180;//Angle en radians
			super.rotation = v;
			
			makeVector();
		}
		
		/**
		 * Renvoie la liste des axes à utiliser pour SAT
		 * 
		 * @param Forme La forme avec laquelle sera effectuée la collision (utilisée pour les cercles)
		 */
		public function axesAvec(Forme:SatShape):ArrayPlus
		{
			return _Axes;
		}
		
		/**
		 * Détermine si la forme est en collision avec Obj.
		 * 
		 * @param Obj La forme avec laquelle la collision doit être testée.
		 */
		public function hitTest(Obj:SatShape):Boolean 
		{
			//if (!this.hitTestObject(Obj))
				//return false;
				
			//Vecteur entre les centres des deux formes.
			var Delta:Vector = new Vector(Obj.x - this.x, Obj.y - this.y);
			
			///Liste des axes à tester.
			var Axes:ArrayPlus = ArrayPlus.concat(this.axesAvec(Obj), Obj.axesAvec(this));
			for each(var Axe:Vector in Axes)
			{
				//projection des billets selon ces axes.
				var aSize:Number = this.projeter(Axe);//Produit scalaire de la diagonale de this avec l'axe
				var bSize:Number = Obj.projeter(Axe);//Produit scalaire de la diag de Obj selon Axe.
				
				var dSize:Number = Math.abs(Vector.scalaire(Delta,Axe));

				if ((aSize + bSize) - dSize <= 0)
				{
					return false;			
					break;
				}
			}
			return true;
		}
		
		/**
		 * Projette la forme selon Axe. Renvoie la longueur de la projection.
		 * 
		 * @param Axe L'axe sur lequel la forme doit être projeté.
		 */
		public function projeter(Axe:Vector):Number
		{
			throw(new Error("Appel d'une méthode abstraite."));
		}
	}
	
	
	
}