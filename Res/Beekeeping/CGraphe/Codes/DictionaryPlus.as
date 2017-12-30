//Ajoute quelques fonctions à la classe Dictionary de base.
//On doit la mettre dynamique pour pouvoir stocker des données dedans.

package
{
	import flash.utils.Dictionary
	public dynamic class DictionaryPlus extends Dictionary
	{
		public function DictionaryPlus(weakKeys:Boolean=false)
		{
			super(weakKeys);
		}

		public function Clone():DictionaryPlus
		{
			var Bis:DictionaryPlus=new DictionaryPlus(this.weakKeys);
			for(var i:* in this)
				Bis[i]=this[i];

			return Bis;
		}

		public function Contains(item:*):Boolean
		{
			return (this[item]!=undefined);
		}
	}
}