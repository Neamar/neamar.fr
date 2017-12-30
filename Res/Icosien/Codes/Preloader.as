package {
import com.greensock.TweenLite;
import flash.display.DisplayObject;
import flash.display.MovieClip;
import flash.display.Shape;
import flash.events.IOErrorEvent;
import flash.events.ProgressEvent;
import flash.utils.getDefinitionByName;
import mochi.as3.*;
// Must be dynamic!
public dynamic class Preloader extends MovieClip {
    // Keep track to see if an ad loaded or not
    private var did_load:Boolean;
    // Change this class name to your main class
    public static var MAIN_CLASS:String = "Battery";
	
	private var Cercle:Shape = new Shape();
	
    public function Preloader()
	{
        super();
        var f:Function = function(ev:IOErrorEvent):void {
            // Ignore event to prevent unhandled error exception
        }
        loaderInfo.addEventListener(IOErrorEvent.IO_ERROR, f);
		
        var opts:Object = {
				clip:this,
				id:"803e3dbb622e59fc",
				res:"640x480",
				background:0xFFFFC9,
				color:0xFF8A00,
				outline:0xD58B3C,
				no_bg:true
				//ad_finished:startup
				};
				
        opts.ad_started = function ():void {
            did_load = true;
        }
		
        opts.ad_finished = function ():void {
            // don't directly reference the class, otherwise it will be
            // loaded before the preloader can begin
			loaderInfo.removeEventListener(ProgressEvent.PROGRESS, progress);
			
			if(contains(Cercle))
				removeChild(Cercle);
			Cercle.graphics.clear();
            var mainClass:Class = Class(getDefinitionByName("Main"));
            var app:Object = new mainClass();
            addChild(app as DisplayObject);
        }
		
		opts.ad_skipped = opts.ad_finished;

		loaderInfo.addEventListener(ProgressEvent.PROGRESS, progress);
        MochiAd.showPreGameAd(opts);
		//Main.HEIGHT;
		//opts.ad_finished()
		
		
		Cercle.graphics.beginFill(0xba984f);
		//Cercle.graphics.lineStyle(2);
		Cercle.x = 320; Cercle.y = 240;
		Cercle.graphics.drawCircle(0, 0, 1);
		addChild(Cercle);
		setChildIndex(Cercle, 0);
    }
	
	private function progress(e:ProgressEvent):void
	{
		TweenLite.to(Cercle, .5, { scaleX:400 * e.bytesLoaded / e.bytesTotal, scaleY:400 * e.bytesLoaded / e.bytesTotal } );
	}
}
}