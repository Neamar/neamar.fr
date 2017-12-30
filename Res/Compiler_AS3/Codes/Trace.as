var Trace_Main:Sprite = new Sprite();//Le conteneur principal
Trace_Main.addEventListener(MouseEvent.MOUSE_DOWN, Trace_StartDrag);
Trace_Main.scaleX=Trace_Main.scaleY=Trace_Main.alpha=.7;
addChild(Trace_Main);

var Trace_Texte:TextField=new TextField();
Trace_Texte.x = 5;
Trace_Texte.y = 5;
Trace_Texte.autoSize = "left";
Trace_Main.addChild(Trace_Texte);

var Trace_Reduire:Sprite = new Sprite();
Trace_Reduire.graphics.beginFill(0xFFFFFF,1);
Trace_Reduire.graphics.drawRect(0,0,10,10);
Trace_Reduire.addEventListener(MouseEvent.MOUSE_UP, Trace_Reduire_fct);
Trace_Main.addChild(Trace_Reduire);

function Trace(txt:String):void
{//La fonction principale, qui trace le texte passé en paramètre.
    Trace_Texte.text = txt + "\r" + Trace_Texte.text;//\r indique un retour à la ligne.
	setChildIndex(Trace_Main,numChildren-1);
}

//Les fonctions pour déplacer
function Trace_StartDrag(e:Event):void
{
    Trace_Main.startDrag();
    Trace_Main.addEventListener(MouseEvent.MOUSE_UP, Trace_StopDrag);
    Trace_Main.removeEventListener(MouseEvent.MOUSE_DOWN, Trace_StartDrag);
    Trace_Texte.selectable=false;
}
function Trace_StopDrag(e:Event):void
{
    Trace_Main.stopDrag();
    Trace_Main.removeEventListener(MouseEvent.MOUSE_UP, Trace_StopDrag);
    Trace_Main.addEventListener(MouseEvent.MOUSE_DOWN, Trace_StartDrag);
    Trace_Texte.selectable=true;
}

//Et pour supprimer la boite :
function Trace_Reduire_fct(e:Event):void
{
	Trace_Main.visible=false;
	Trace_Reduire.removeEventListener(MouseEvent.MOUSE_UP, Trace_Reduire_fct);
	Trace_Main.removeEventListener(MouseEvent.MOUSE_DOWN, Trace_StartDrag);
	Trace_Main.removeEventListener(MouseEvent.MOUSE_UP, Trace_StopDrag);
	Trace_Main=null;
	Trace_Texte=null;
}