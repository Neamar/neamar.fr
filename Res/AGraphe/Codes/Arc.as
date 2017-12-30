//Un lien (arete, arc...peut importe le nom !)
//Rien de bien compliqu�, si ce n'est la d�finition de la courbe de b�zier lors de l'utilisation de curveTo.
package
{
	import flash.display.Shape;//Shape consomme moins de ressource que Sprite. En contrepartie, il ne peut pasz avoir d'enfants, et ne recoit pas d'�venements souris. Ca tombe bien, on en a pas besoin :)
	import flash.geom.Point;

	public class Arc extends Shape
	{
		public var Parent:Point;
		public var Enfant:Point;

		public function Arc(Parent:Point,Enfant:Point)
		{//Instancie un nouveau lien : prend en param�tre le parent et l'enfant (en fait, leurs coordonn�es)
			this.Parent=Parent;
			this.Enfant=Enfant;
			this.Refresh();
		}

		public function ChangeOrigine(Parent:Point):void
		{//Change l'origine du lien
			this.Parent=Parent;
			this.Refresh();
		}

		private function Refresh():void
		{//Redessine enti�rement le lien. Cette m�thode est utilis�e lorsque l'un des noeuds se d�place||est d�plac�
			this.graphics.clear();
			this.graphics.moveTo(this.Parent.x,this.Parent.y);
			this.graphics.lineStyle(2,0x444444);
// 			this.graphics.lineTo(this.Enfant.x,this.Enfant.y);
			this.graphics.curveTo(this.Enfant.x,this.Parent.y + (this.Enfant.y-this.Parent.y)/2, this.Enfant.x,this.Enfant.y);//Rien de bien m�chant : on commence � dessiner sur le parent, puis on d�finit un point de controle � mi-chemin, et on va jusqu'� Enfant.
		}
	}
}