package Levels
{
	import com.greensock.TweenLite;
	import flash.display.Bitmap;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import Web.Eulris;
	
	/**
	 * Un niveau que l'on gagne en créant un circuit hamiltonien sur le graphe, i.e en parcourant tous les somments en une seule fois, sans passer deux fois par le même sommet et en utilisant les arêtes du graphe.
	 * @author Neamar
	 */
	public class HamiltonLevel extends TextLevel 
	{
		private var Premier:Point;
		
		public function HamiltonLevel(Datas:String,Aide:String="")
		{
			super(Datas, Aide);
			
			Toile.addEventListener(Eulris.FIRST_HOOK_ADDED, drawFirstHook);
			addEventListener(Level.LEVEL_RESTART, eraseFirstHook);
		}
		
		/**
		 * Redessine le premier noeud selectionné pour l'identifier facilement
		 * @param	e
		 */
		private function drawFirstHook(e:CustomEvent):void
		{
			if (Premier != null)
				eraseFirstHook();
				
			Premier = (e.newHook.P as Point);
	
			Premier.toScrew();
			
			TweenLite.to(Premier, 1, { rotation:360 } );
		}
		
		private function eraseFirstHook(e:Event=null):void
		{
			if(Premier != null)
				TweenLite.to(Premier, 1, { rotation: -360, onComplete: Premier.toNail } );

			Premier = null;
			Toile.addEventListener(Eulris.FIRST_HOOK_ADDED, drawFirstHook);
		}
		
		/**
		 * Si chaque sommet n'est utilisé qu'une fois, dispatch l'evenement LEVEL_WIN.
		 */
		protected override final function checkVictory():void
		{
			var P:Point;
			
			//Fast test : on devrait avoir tous les noeuds qui sont liés à deux sommets (arrivée vers le noeud + départ du noeud).
			//Complexité : O(n)
			for each(P in Points)
			{
				//Si les tailles diffèrent on peut s'arrêter tout de suite.
				if (Aretes[P].length != 2)
					return;
			}
			
			//Si tous les noeuds ont deux connexions, il y a un cycle hamiltonien.
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
		
		/**
		 * Fonction permettant d'interagir dynamiquement lors du rendu de la corde.
		 * Modifie les paramètres de dessin (disponibles dans e.drawer).
		 */
		protected override function checkValidity(e:CustomEvent):Boolean
		{
			//Test arête correcte (disponible dans le graphe)
			//ET arête non en double
			if (super.checkValidity(e) && Aretes[e.To].length <= 2 && Aretes[e.From].length <= 2)
			{
				//e.drawer.lineStyle(3, 0xbd9969, .8);
				e.drawer.Etat = e.drawer.OK;
				return true;
			}
			else
			{
				//e.drawer.lineStyle(3, 0xbd0000, .8);//Arête INCORRECTE
				e.drawer.Etat = e.drawer.Erreur;
				return false;
			}
		}
	}
	
}