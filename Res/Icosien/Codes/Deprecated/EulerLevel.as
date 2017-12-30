package Levels
{
	import flash.events.Event;
	import Web.Eulris;
	
	/**
	 * Un niveau que l'on gagne en créant un circuit eulérien sur le graphe, i.e en parcourant toutes les arêtes en une seule fois.
	 * @author Neamar
	 */
	public class EulerLevel extends TextLevel 
	{
		private var PremierNoeud:Point;
		private var DernierNoeud:Point;
		
		/**
		 * Constructeur.
		 * @param	Datas cf. super()
		 * @param	Aide Le texte d'aide à afficher au format HTML.
		 */
		public function EulerLevel(Datas:String,Aide:String="")
		{
			super(Datas, Aide);
			
			Toile.addEventListener(Eulris.FIRST_HOOK_ADDED, rememberFirstHook);
			Toile.addEventListener(Eulris.HOOK_ADDED, rememberLastHook);
		}
		
		private function rememberFirstHook(e:CustomEvent):void
		{
			PremierNoeud = e.newHook.P;
			e.newHook.P.scaleX = 2;
		}
		
		private function rememberLastHook(e:CustomEvent):void
		{
			DernierNoeud = e.newHook.P;
		}
		
		/**
		 * Compare les dictionnaires Aretes et AretesInitiales. Si chacune de leurs clés sont égales, dispatch l'evenement LEVEL_WIN.
		 */
		protected override final function checkVictory():void
		{
			//Very Fast test : si premier noeud != dernier noeud, on peut s'arrêter :)
			//Complexité : O(1);
			if (PremierNoeud != DernierNoeud)
				return;
			
			var P:Point;
			
			//Fast test : juste comparer les tailles des tableaux.
			//Complexité : O(n)
			for each(P in Points)
			{
				//Si les tailles diffèrent on peut s'arrêter tout de suite.
				if (Aretes[P].length != AretesInitiales[P].length)
					return;
			}
			
			//Si tous les tableaux sont égaux, il faut être plus exhaustif et vérifier que le contenu de chaque tableau est similaire aux autres.
			//Ici l'ordre n'a aucune importance : les tableaux sont donc des ensembles.
			//Mathématiquement pour prouver que A = B il faut prouver que A est inclus dans B ET QUE B est inclus dans A.
			//Ici cependant on va utiliser deux propriétés spécifiques de nos ensembles :
			// - ils font la même taille
			// - le contenu du tableau AretesInitiales[x] est unique (pas de doublons si le niveau est bien conçu).
			//Il suffit alors de prouver que tous les élements de AretesInitiales[x] sont dans Aretes[x], et ce pour tout x.
			//Complexité théorique O(n^3) (tous les points, tous les liens entre ces points, + une recherche avec indexOf)
			for each(P in Points)
			{
				for each(var P2:Point in AretesInitiales[P])
				{
					if(Aretes[P].indexOf(P2)==-1)
						return;
				}
			}
			
			//Dernière chose à vérifier : que le point de départ est le même que l'arrivée
			
			dispatchEvent(new Event(LEVEL_WIN));
			
		}
	}
	
}