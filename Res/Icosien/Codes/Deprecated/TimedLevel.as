package Levels
{
	import flash.events.Event;
	import flash.events.TimerEvent;
	import flash.utils.Timer;
	
	/**
	 * Un niveau automatiquement gagné au bout d'un certain temps.
	 * @author Neamar
	 */
	public class TimedLevel extends Level 
	{
		private var Chrono:Timer;
		/**
		 * Crée le chronomètre de la victoire !
		 * @param	Datas non utilisé.
		 * @param	Duree la durée après laquelle le niveau dispatchera automatiquement LEVEL_WIN
		 */
		public function TimedLevel(Datas:String,Duree:int)
		{
			super(Datas);
			
			Chrono = new Timer(Duree*1000, 1);
			Chrono.start();
			
			Chrono.addEventListener(TimerEvent.TIMER, makeVictory);
		}
		
		/**
		 * Dispatch l'evenement LEVEL_WIN.
		 */
		protected final function makeVictory(e:Event=null):void
		{
			dispatchEvent(new Event(LEVEL_WIN));
		}
	}
	
}