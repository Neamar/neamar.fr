package
{
	import Levels.HamiltonLevel;
	/**
	* R�sout un niveau de jeu.
	*/
	public class Solver
	{
		/**
		* Initialise le solver.
		*/
		public function Solver()
		{}

		/**
		* R�sout un niveau hamiltonien en ajoutant les hooks n�cessaires.
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
		* Trouve un cycle Hamiltonien (s'il existe !) dans le graphe pass� en param�tres.
		* Se base sur un algorithme r�cursif.
		* Prend en param�tre une liste de noeuds, tel que Noeuds[i] contienne tous les noeuds li�s � i.
		* @param Noeuds:Vector.<Vector.<int>> la liste des points composant le niveau. Typ� comme array car les vector ne sont pas sparse.
		* @param Actuel le noeud sur lequel on est actuellement plac�. Non sp�cifi� au premier appel.
		* @param LongueurCycle la longueur du cycle actuelle. Si longueur == noeuds.length, c'est fini :)
		* @return true si un cycle a �t� trouv�, false sinon.
		*/
		private function solveHamiltonian(Noeuds:Array,Actuel:int=0,LongueurCycle:int=0):Boolean
		{
			//R�cup�rer la liste des itin�raires possibles depuis le noeud Actuel.
			var Possibilites:Vector.<int> = Noeuds[Actuel];
			//Supprimer ce noeud de la liste (pour qu'on ne le reprenne pas)
			Noeuds[Actuel] = null;

			//Examiner chacun des itin�raires disponibles depuis ce noeud.
			for each(var Possibilite:int in Possibilites)
			{
				//Si :
				// - on a la longueur d'un cycle, et on peut rejoindre 0 (le point de d�part)
				// - le noeud n'a pas encore �t� pris, et qu'on peut trouver un chemin hamiltonien dessus :
				if((LongueurCycle==Noeuds.length-1 && Possibilite == 0) ||
					(Noeuds[Possibilite]!=null && solveHamiltonian(Noeuds,Possibilite,LongueurCycle+1)))
				{
					//Chemin trouv� !
					trace("Trouv� : " + Actuel);
					return true;
				}
			}

			//Sinon, aucun chemin hamiltonien ne passe par cette combinaison. Remettre le tableau dans son �tat initial, puis quitter et revenir � la fonction pr�c�dente.
			Noeuds[Actuel] = Possibilites;
			return false;
		}
		
		private function solveEulerian(Noeuds:Array, Actuel:int, Cycle:Vector.<int>):void
		{}
	}
}