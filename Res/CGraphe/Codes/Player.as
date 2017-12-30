//Un Player d�finit un joueur de la fa�on la plus g�n�rale possible.
//LEs sp�cificit�s sont ajout�s via les classes qui h�ritent de Player, telles que AI ou Human.

package
{
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;

	import flash.geom.Point;


	public class Player extends Sprite
	{
		public var Tour_Termine:Boolean=false;
		public var Pret:Boolean=false;
		public var Joueur:int;
		public var IsHuman:Boolean;

		protected var Jeu:Game;
		protected var Terrain:Land;



		public function Player()
		{
		}

	//Les fonctions pr�sent�es ici sont destin�es � �tre overrid�es dans certains cas, voir les sous classes.
		public function Initialiser(TriggerWhenReady:Function):void
		{//Par d�faut, l'intialisation est instantan�e.
			this.Pret=true;
			TriggerWhenReady.call(this);
		}

		public function Fin_Tour():void
		{
		}

		public function JouerArete(Arete:Arc):Boolean
		{
			if(Arete.PlayedByShort)
				return false; //L'arete a d�j� �t� jou�e.

			if(Joueur==Const.CUT)
			{//Supprimer l'arete :
				//Le graphisme
				Arete.graphics.clear();
				this.Terrain.PremierPlan.removeChild(Arete);

				//Les r�f�rences :
				Arete.Extremites[0].RemoveLien(Arete);
				Arete.Extremites[1].RemoveLien(Arete);

				//La copie originale :
				this.Terrain.All_Liens.splice(this.Terrain.All_Liens.indexOf(Arete),1);
				Arete=null;
			}
			else//Cas Joueur==SHORT)
				Arete.PlayedByShort=true;
			Tour_Termine=true;
			return true;
		}
	}
}