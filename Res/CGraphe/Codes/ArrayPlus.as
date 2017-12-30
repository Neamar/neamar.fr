//Ajoute quelques fonctions à la classe Array de base.
//On doit la mettre dynamique pour pouvoir stocker des données dedans.

package
{
	public dynamic class ArrayPlus extends Array
	{
		public function ArrayPlus(FirstItem:*=null)
		{
			if(FirstItem!=null)
				this.push(FirstItem);
		}

		public function Clone():ArrayPlus
		{
			var Bis:ArrayPlus=new ArrayPlus();
			for each(var i:* in this)
				Bis.push(i);

			return Bis;
		}

		public function Contains(item:*):Boolean
		{
			return (this.indexOf(item)!=-1)
		}

		//Fonctions privées
	}
}