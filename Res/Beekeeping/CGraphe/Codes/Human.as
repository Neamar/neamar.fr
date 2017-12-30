//Cette classe permet à un humain de jouer.
//Elle s'occupe de placer les listneers ou il faut quand il faut, de les enlever...
//Elle n'est pas très complexe, par rapport à AI.
package
{
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;

	import flash.geom.Point;

	public class Human extends Player
	{

		public function Human(Jeu:Game,Joueur:int)
		{
			this.IsHuman=true;
			this.Jeu = Jeu;
			this.Terrain = Jeu.Terrain;
			this.Joueur=Joueur;
		}

		public function Jouer():void
		{

			Tour_Termine=false;
			for each(var Arete:Arc in this.Terrain.All_Liens)
			{
				if(!Arete.PlayedByShort)
				{
					Arete.addEventListener(MouseEvent.CLICK,ChoixArete);
					Arete.addEventListener(MouseEvent.MOUSE_OVER,SourisIN);
					Arete.addEventListener(MouseEvent.MOUSE_OUT,SourisOUT);
				}
			}
			var Actuel:Array=this.Terrain.getObjectsUnderPoint(new Point(this.Terrain.mouseX,this.Terrain.mouseY));
			for each(var Forme:* in Actuel)
			{
				if(Forme is Arc)
				{
					Forme.AddFocus(5);
					break;
				}
			}
		}

		public override function Fin_Tour():void
		{
			for each(var Arete:Arc in this.Terrain.All_Liens)
			{
				Arete.removeEventListener(MouseEvent.CLICK,ChoixArete);
				Arete.removeEventListener(MouseEvent.MOUSE_OVER,SourisIN);
				Arete.removeEventListener(MouseEvent.MOUSE_OUT,SourisOUT);
			}
		}

		//Fonctions privées
		private function SourisIN(e:Event):void
		{
			e.target.AddFocus(5);
		}
		private function SourisOUT(e:Event):void
		{
			e.target.AddFocus(0);
		}
		private function ChoixArete(e:Event):void
		{
			JouerArete(Arc(e.target))
		}
	}
}