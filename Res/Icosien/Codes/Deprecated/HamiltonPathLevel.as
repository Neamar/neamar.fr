package Levels
{
	import flash.events.Event;
	
	/**
	 * Un niveau que l'on gagne en créant un circuit hamiltonien sur le graphe, i.e en parcourant tous les somments en une seule fois, sans passer deux fois par le même sommet et en utilisant les arêtes du graphe.
	 * @author Neamar
	 */
	public class HamiltonPathLevel extends Level 
	{
		public function HamiltonPathLevel(Datas:String)
		{
			super(Datas);
		}
		
		/**
		 * Si chaque sommet n'est utilisé qu'une fois, dispatch l'evenement LEVEL_WIN.
		 */
		protected override final function checkVictory():void
		{
			var P:Point;
			
			//Fast test : on devrait avoir tous les noeuds qui sont liés à deux sommets (arrivée vers le noeud + départ du noeud), sauf 2 (le départ du parcours et la fin) qui n'ont qu'un seul lien.
			//Complexité : O(n)
			var Nb1:int = 0;
			for each(P in Points)
			{
				//Si les tailles diffèrent on peut s'arrêter tout de suite.
				if (Aretes[P].length != 2)
				{
					if (Aretes[P].length != 1) //Aucun lien / trop de liens : arrêter tout de suite.
						return;
					else
						Nb1++;
				}
					
			}
			
			//Si on a pas exactement deux noeuds avec un seul lien, on est sûr que ce n'est pas fini.
			if (Nb1 != 2)
				return;
			
			//Si tous les noeuds ont deux connexions sauf 2, il y a un chemin hamiltonien.
			//Reste à vérifier que tous les chemins pris sont bien dans la liste des arêtes autorisées !
			
			for each(P in Points)
			{
				for each(var P2:Point in Aretes[P])
				{
					if(AretesInitiales[P].indexOf(P2)==-1)
						return;//L'arête n'appartient pas au graphe.
				}
			}
			
			dispatchEvent(new Event(LEVEL_WIN));
		}
	}
	
}