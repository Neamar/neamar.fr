//Trace permet d'afficher � l'�cran des informations utiles.
//Classe statique, qui doit �tre initialis�e via sa m�thode initialiser()
package
{
	import flash.display.Sprite;
	import flash.display.Stage;
	import flash.text.TextField;//Champ de texte. Classe assez vaste, utilis�e uniquement pour l'affichage de texte ici. Peut �tre du texte au format HTML.
	import flash.events.Event;
	import flash.events.MouseEvent;


	public class Trace extends Sprite
	{
		private static var _stage:Stage;
		private static var Container:Sprite = new Sprite();//Le conteneur principal
			Container.addEventListener(MouseEvent.MOUSE_DOWN, StartDrag);
			Container.scaleX=1;
			Container.scaleY=1;
			Container.alpha=1;

		private static var Texte:TextField=new TextField();
			Texte.x = 5;
			Texte.y = 5;
			Texte.autoSize = "left";
			Container.addChild(Texte);

		private static var Reduire:Sprite = new Sprite();
			Reduire.graphics.beginFill(0xFFFFFF,1);
			Reduire.graphics.drawRect(0,0,10,10);
			Reduire.addEventListener(MouseEvent.MOUSE_UP, Delete);
			Container.addChild(Reduire);

		private static var LastTrace:String="";

		public function Trace()
		{//Constructeur non utilis�.
		}

		public static function initialiser(vstage:Stage):void
		{
			_stage=vstage;
			_stage.addChild(Container);
		}
		public static function append(txt:String,ForceRepeat:Boolean=false):void
		{//La fonction principale, qui trace le texte pass� en param�tre.
		if(LastTrace!=txt || ForceRepeat)
		{
			Texte.text = txt + "\r" + Texte.text;//\r indique un retour � la ligne.

			if(_stage)//Seulement si initialis�.
				_stage.setChildIndex(Container,_stage.numChildren-1);
			LastTrace=txt;
		}
		}

		public static function clear():void
		{//Efface le contenu du Trace.
			Texte.text="";
			LastTrace="";
		}

		//Les fonctions pour d�placer
		public static function set draggable(v:Boolean):void
		{
			if(v)
				Container.addEventListener(MouseEvent.MOUSE_DOWN, StartDrag);
			else
				Container.removeEventListener(MouseEvent.MOUSE_DOWN, StartDrag);
		}
		private static function StartDrag(e:Event):void
		{
			Container.startDrag();
			Container.addEventListener(MouseEvent.MOUSE_UP, StopDrag);
			Container.removeEventListener(MouseEvent.MOUSE_DOWN, StartDrag);
			Texte.selectable=false;
		}
		private static function StopDrag(e:Event):void
		{
			Container.stopDrag();
			Container.removeEventListener(MouseEvent.MOUSE_UP, StopDrag);
			Container.addEventListener(MouseEvent.MOUSE_DOWN, StartDrag);
			Texte.selectable=true;
		}

		//Et pour supprimer la boite :
		private static function Delete(e:Event):void
		{
			Container.visible=false;
			Reduire.removeEventListener(MouseEvent.MOUSE_UP, Delete);
			Container.removeEventListener(MouseEvent.MOUSE_DOWN, StartDrag);
			Container.removeEventListener(MouseEvent.MOUSE_UP, StopDrag);
			Container=null;
			Texte=null;
		}
	}
}