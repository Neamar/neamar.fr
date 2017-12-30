package Levels
{
	import com.greensock.TweenLite;
	import flash.display.Bitmap;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.net.navigateToURL;
	import flash.net.URLRequest;
	
	/**
	 * Le niveau de présentation des crédits
	 * @author Neamar
	 */
	public class CreditsLevel extends TextLevel
	{
		private const DUREE:int = 3;
		
		[Embed(source = "../../assets/Icosien.png")]
		private var Logo:Class;
		[Embed(source = "../../assets/Neamar.png")]
		private var Neamar:Class;
		[Embed(source = "../../assets/Licoti.png")]
		private var Licoti:Class;
		

		
		private var Image:Bitmap = new Logo();
		private var ImageNeamar:Bitmap = new Neamar();
		private var ImageLicoti:Bitmap = new Licoti();
		
		public function CreditsLevel(Datas:String,Texte:String)
		{
			super(Datas,Texte);

			Image.x = (Main.WIDTH - Image.width) / 2;
			ImageNeamar.x = (Main.WIDTH - ImageNeamar.width) / 2;
			ImageLicoti.x = (Main.WIDTH - ImageLicoti.width) / 2;
			
			Image.y = ImageNeamar.y = ImageLicoti.y = 180;
			
			ImageNeamar.alpha = 0;
			ImageLicoti.alpha = 0;
			addChild(Image);
			addChild(ImageNeamar);
			addChild(ImageLicoti);
			
			Aide.x = Main.WIDTH - Aide.textWidth - 20;
			Aide.y = Main.HEIGHT - Aide.textHeight;
			
			AideEffet.addEventListener(MouseEvent.CLICK, gotoSponsor);
			AideEffet.mouseEnabled = true;
			AideEffet.buttonMode = true;
			AideEffet.useHandCursor = true;
			
			TweenLite.to(Image, DUREE, { alpha:1, onComplete:switchToNeamar } );
		}
		
		public override final function destroy(e:Event=null):void
		{
			removeChild(Image)
			removeChild(ImageNeamar);
			removeChild(ImageLicoti);
			
			Image.bitmapData.dispose();
			ImageNeamar.bitmapData.dispose();
			ImageLicoti.bitmapData.dispose();
			Image = ImageLicoti = ImageNeamar = null;
		}
		
		/**
		 * Efface Icosien, passe sur Neamar.
		 */
		public function switchToNeamar():void
		{
			TweenLite.to(Image,DUREE,{alpha:0})
			TweenLite.to(ImageNeamar, DUREE, { alpha:1, onComplete:switchToLicoti } );
		}
		
		/**
		 * Efface Neamar, passe sur Licoti.
		 */
		public function switchToLicoti():void
		{
			removeChild(Image);
			TweenLite.to(ImageNeamar, DUREE, { alpha:0 } );
			TweenLite.to(ImageLicoti, DUREE, { alpha:1, onComplete:makeVictory } );
		}
		
		public function makeVictory():void
		{
			dispatchEvent(new Event(LEVEL_WIN));
		}
		
		public function gotoSponsor(e:Event):void
		{
			var request:URLRequest = new URLRequest("http://www.mini-jeu-gratuit.fr/vip/neamar/");
			try {
			  navigateToURL(request, '_blank'); //Dans une nouvelle fenêtre (probablement nouvel onglet en fait)
			} catch (e:Error) {
			  trace("Impossible de lancer la fenêtre :(");
			}
		}
	}
	
}