package
{
	import Levels.HamiltonLevel;
	/**
	* Résout un niveau de jeu.
	*/
	public class Solver
	{
		/**
		* Initialise le solver.
		*/
		public function Solver()
		{}

		/**
		* Résout un niveau hamiltonien en ajoutant les hooks nécessaires.
		*/
		public function solveHamilton(ToSolve:HamiltonLevel):void
		{
			var i:int = 0;
			var Datas:Array = new Array();
			for(var P:* in ToSolve.AretesInitiales)
			{
				Datas[ToSolve.Points.indexOf(P)] = new Vector.<int>();
				for each(var P2:Point in ToSolve.AretesInitiales[P])
					Datas[ToSolve.Points.indexOf(P)].push(ToSolve.Points.indexOf(P2));
			}
			for (i = 0; i < ToSolve.Points.length; i++)
				trace('[' + i + ']' + '=>' + Datas[i]);
				
			trace("Statut : " + solveHamiltonian(Datas));
		}

		/**
		* Trouve un cycle Hamiltonien (s'il existe !) dans le graphe passé en paramètres.
		* Se base sur un algorithme récursif.
		* Prend en paramètre une liste de noeuds, tel que Noeuds[i] contienne tous les noeuds liés à i.
		* @param Noeuds:Vector.<Vector.<int>> la liste des points composant le niveau. Typé comme array car les vector ne sont pas sparse.
		* @param Actuel le noeud sur lequel on est actuellement placé. Non spécifié au premier appel.
		* @param LongueurCycle la longueur du cycle actuelle. Si longueur == noeuds.length, c'est fini :)
		* @return true si un cycle a été trouvé, false sinon.
		*/
		private function solveHamiltonian(Noeuds:Array,Actuel:int=0,LongueurCycle:int=0):Boolean
		{
			//Récupérer la liste des itinéraires possibles depuis le noeud Actuel.
			var Possibilites:Vector.<int> = Noeuds[Actuel];
			//Supprimer ce noeud de la liste (pour qu'on ne le reprenne pas)
			Noeuds[Actuel] = null;

			//Examiner chacun des itinéraires disponibles depuis ce noeud.
			for each(var Possibilite:int in Possibilites)
			{
				//Si :
				// - on a la longueur d'un cycle, et on peut rejoindre 0 (le point de départ)
				// - le noeud n'a pas encore été pris, et qu'on peut trouver un chemin hamiltonien dessus :
				if((LongueurCycle==Noeuds.length-1 && Possibilite == 0) ||
					(Noeuds[Possibilite]!=null && solveHamiltonian(Noeuds,Possibilite,LongueurCycle+1)))
				{
					//Chemin trouvé !
					trace("Trouvé : " + Actuel);
					return true;
				}
			}

			//Sinon, aucun chemin hamiltonien ne passe par cette combinaison. Remettre le tableau dans son état initial, puis quitter et revenir à la fonction précédente.
			Noeuds[Actuel] = Possibilites;
			return false;
		}
		
		private function solveEulerian(Noeuds:Array, Actuel:int, Cycle:Vector.<int>):void
		{}
	}
}