//� l'origine, devait d�finir un joueur "online" pour pouvoir jouer en r�seau. L'id�e a �t� abandonn�e, peut �tre pour �tre reprise dans DGraphe.
package
{
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;

	import flash.geom.Point;



	public class OnlinePlayer extends Player
	{
		public function OnlinePlayer(Jeu:Game,Joueur:int)
		{
			this.IsHuman=true;
			this.Jeu = Jeu;
			this.Terrain = Jeu.Terrain;
			this.Joueur=Joueur;
		}

		public override function Initialiser(TriggerWhenReady:Function):void
		{//Recherche un joueur en ligne
			Jeu.Terrain.Texte="Recherche d'un partenaire..."
			TriggerWhenReady.call(this);
		}

		public function Jouer():void
		{
			Tour_Termine=false;
		}

		//Fonctions priv�es
	}
}