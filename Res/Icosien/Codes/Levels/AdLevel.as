package Levels
{
	import com.greensock.TweenLite;
	import flash.display.Bitmap;
	import flash.display.MovieClip;
	import flash.events.Event;
	import mochi.as3.*;
	
	/**
	 * Un niveau "publicitaire".
	 * @author Neamar
	 */
	public class AdLevel extends TextLevel
	{
		private var Pub:MovieClip;
		
		public function AdLevel(Datas:String,Pub:MovieClip)
		{
	
			super(Datas);
			
			//L'élément dynamique contenant la pub DOIT être placé sur le stage pour que MochiAd puisse récupérer les infos de chargement. S'il n'est pas sur stage, on l'y remet donc :
			if(!Pub.stageParent.contains(Pub))
				Pub.stageParent.addChild(Pub);
				
			MochiAd.showInterLevelAd( {
				clip:Pub,
				id:"803e3dbb622e59fc",
				res:"640x480",
				no_bg:true,
				ad_skipped:makeVictory,
				ad_finished:makeVictory,
				ad_loaded:positionAd
				 } );

			//Puis la replacer sur nous même.
			Pub.visible = true;
			addChild(Pub);
			//Pub.y = -50;
		}
		
		public override function destroy(e:Event=null):void
		{
			//Virer la pub si elle est encore chez nous.
			//if (contains(Pub))
				//removeChild(Pub);
				
			super.destroy();
		}
		
		/**
		 * Recommence le niveau.
		 * @param	e
		 */
		public override function restart(e:Event = null):void
		{
			trace("On ne recommence pas la pub :p");
		}
		
		protected final function positionAd(width:Number, height:Number):void
		{
			trace(width, height);
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