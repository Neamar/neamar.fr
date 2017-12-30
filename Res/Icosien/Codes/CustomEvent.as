package 
{
	import flash.events.Event;
	
	/**
	 * Un évenement personnalisé qui peut prendre des valeurs dynamiques.
	 * @author Neamar
	 */
	public dynamic class CustomEvent extends Event
	{
		public function CustomEvent(Type:String)
		{
			super(Type);
		}
	}
	
}