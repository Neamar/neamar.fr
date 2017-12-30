//Ajout dans Mods
var SpritePerso:Sprite=new Sprite();
var Mods_Perso:TextField = CreerTextField(SpritePerso,0,0,180,20,false,false,false);
Mods_Perso.htmlText="<li>Éditeur de niveaux persos</li>";
SpritePerso.scaleX=SpritePerso.scaleY=0.4;
SpritePerso.y=8;
Mods.addChild(SpritePerso);

SpritePerso.addEventListener(MouseEvent.MOUSE_OVER,SourisIN);
SpritePerso.addEventListener(MouseEvent.MOUSE_OUT,SourisOUT);
SpritePerso.addEventListener(MouseEvent.CLICK,ShowLoadLevel);



//Graphismes de la boite
var LoadLevel:Sprite=new Sprite();
LoadLevel.graphics.beginFill(0x444444);
LoadLevel.graphics.lineStyle(2,0x000000);
LoadLevel.graphics.drawRect(0, 0,440,140);
LoadLevel.x=100;
LoadLevel.y=160;
LoadLevel.visible=false;
LoadLevel.alpha=.95;

var LoadLevelTexte:TextField = CreerTextField(LoadLevel,20,65,360,20,false,true);
LoadLevelTexte.type="input";
LoadLevelTexte.restrict=":,|0-9";
LoadLevelTexte.text="50,223|167,115|212,175|163,251|197,333|313,220|308,130|435,165:0,1,109,169|1,6,238,123|6,7,372,148|1,2,190,145|2,3,188,213|3,4,180,292|0,3,107,237|0,4,124,278|3,5,238,236|2,7,324,170|5,7,374,193|5,2,263,198";

var LoadLevelCaption:TextField = CreerTextField(LoadLevel,10,10,400,55,true,true,false);

var Lancer_Level:Sprite=LevelChangeButton(0);
Lancer_Level.scaleX=Lancer_Level.scaleY=.3;
Lancer_Level.x=420;
Lancer_Level.y=100;
Lancer_Level.addEventListener(MouseEvent.CLICK,LancerNouveauNiveauPerso);
LoadLevel.addChild(Lancer_Level);

//Qui commence ?
	var FirstPlayer:int=Const.CUT;
	var Perso_FPC:TextField = CreerTextField(LoadLevel,0,85,200,20,false,false,false);//First Player Coupheur : FPC
	Perso_FPC.htmlText="<li>Coupheur commence</li>";
	Perso_FPC.addEventListener(MouseEvent.MOUSE_OVER,tfSourisIN);
	Perso_FPC.addEventListener(MouseEvent.MOUSE_OUT,tfSourisOUT);
	Perso_FPC.addEventListener(MouseEvent.CLICK,FPC);
	Perso_FPC.addEventListener(MouseEvent.CLICK,tfSourisCLICK);

	var Perso_FPP:TextField = CreerTextField(LoadLevel,200,85,200,20,false,false,false);
	Perso_FPP.htmlText="<li>Paintre commence</li>";
	Perso_FPP.addEventListener(MouseEvent.MOUSE_OVER,tfSourisIN);
	Perso_FPP.addEventListener(MouseEvent.MOUSE_OUT,tfSourisOUT);
	Perso_FPP.addEventListener(MouseEvent.CLICK,FPP);
	Perso_FPP.addEventListener(MouseEvent.CLICK,tfSourisCLICK);

	function FPC(e:MouseEvent):void
	{
		FirstPlayer=Const.CUT;
	}
	function FPP(e:MouseEvent):void
	{
		FirstPlayer=Const.SHORT;
	}


//Qui seront les adversaires ?
	var Short_type:int=Const.COMPUTER;
	var Cut_type:int=Const.HUMAN;

	var Perso_PH_CH:TextField = CreerTextField(LoadLevel,0,100,200,20,false,false,false);
	Perso_PH_CH.htmlText="<li>Paintre et Coupheur humains</li>";
	Perso_PH_CH.addEventListener(MouseEvent.MOUSE_OVER,tfSourisIN);
	Perso_PH_CH.addEventListener(MouseEvent.MOUSE_OUT,tfSourisOUT);
	Perso_PH_CH.addEventListener(MouseEvent.CLICK,PH_CH);
	Perso_PH_CH.addEventListener(MouseEvent.CLICK,tfSourisCLICK);

	var Perso_PH_CC:TextField = CreerTextField(LoadLevel,0,120,200,20,false,false,false);//Player Human Coupheur Computer : PHCC
	Perso_PH_CC.htmlText="<li>Paintre humain, Coupheur AI</li>";
	Perso_PH_CC.addEventListener(MouseEvent.MOUSE_OVER,tfSourisIN);
	Perso_PH_CC.addEventListener(MouseEvent.MOUSE_OUT,tfSourisOUT);
	Perso_PH_CC.addEventListener(MouseEvent.CLICK,PH_CC);
	Perso_PH_CC.addEventListener(MouseEvent.CLICK,tfSourisCLICK);

	var Perso_PC_CH:TextField = CreerTextField(LoadLevel,200,100,200,20,false,false,false);
	Perso_PC_CH.htmlText="<li>Paintre AI, Coupheur humain</li>";
	Perso_PC_CH.addEventListener(MouseEvent.MOUSE_OVER,tfSourisIN);
	Perso_PC_CH.addEventListener(MouseEvent.MOUSE_OUT,tfSourisOUT);
	Perso_PC_CH.addEventListener(MouseEvent.CLICK,PC_CH);
	Perso_PC_CH.addEventListener(MouseEvent.CLICK,tfSourisCLICK);

	var Perso_PC_CC:TextField = CreerTextField(LoadLevel,200,120,200,20,false,false,false);
	Perso_PC_CC.htmlText="<li>Paintre et Coupheur AI</li>";
	Perso_PC_CC.addEventListener(MouseEvent.MOUSE_OVER,tfSourisIN);
	Perso_PC_CC.addEventListener(MouseEvent.MOUSE_OUT,tfSourisOUT);
	Perso_PC_CC.addEventListener(MouseEvent.CLICK,PC_CC);
	Perso_PC_CC.addEventListener(MouseEvent.CLICK,tfSourisCLICK);

	function PH_CH(e:Event=null):void
	{
		Short_type=Const.HUMAN;
		Cut_type=Const.HUMAN;
	}
	function PH_CC(e:Event=null):void
	{
		Short_type=Const.HUMAN;
		Cut_type=Const.COMPUTER;
	}
	function PC_CH(e:Event=null):void
	{
		Short_type=Const.COMPUTER;
		Cut_type=Const.HUMAN;
	}
	function PC_CC(e:Event=null):void
	{
		Short_type=Const.COMPUTER;
		Cut_type=Const.COMPUTER;
	}

AppliquerFiltre(LoadLevel);

LoadLevelCaption.htmlText="<u>Éditeur de niveau</u><br>Créez vos propres niveaux en utilisant  <a href=\"http://www.neamar.fr/Res/Cgraphe/Editor\" target=\"_blank\">E-Ditor (cliquez ici)</a>, puis collez le résultat ici.";

addChild(LoadLevel);

function ShowLoadLevel(e:Event):void
{
	LoadLevel.visible=true;
	Boite.visible=false;
}

function tfSourisIN(e:MouseEvent):void
{
	if(e.currentTarget.textColor!=0xFF0000)
		e.currentTarget.textColor=0xFFFFFF;
}
function tfSourisOUT(e:MouseEvent):void
{
	if(e.currentTarget.textColor!=0xFF0000)
		e.currentTarget.textColor=0x000000;
}
function tfSourisCLICK(e:MouseEvent):void
{

	if(e.currentTarget==Perso_FPC || e.currentTarget==Perso_FPP)
		Perso_FPP.textColor=Perso_FPC.textColor=0x000000;
	else
		Perso_PC_CC.textColor=Perso_PH_CC.textColor=Perso_PC_CH.textColor=Perso_PH_CH.textColor=0x000000;
	e.currentTarget.textColor=0xFF0000;
}

function LancerNouveauNiveauPerso(e:Event=null):void
{//Lance le chargement à partir d'un niveau perso.
	if(Partie!=null && contains(Partie.Terrain))
		removeChild(Partie.Terrain);//Si Fond a déjà été utilisé, le nettoyer.
	LoadLevel.visible=false;
	Boite.visible=false;
	Partie=new Game(Const.SHORT,Short_type,Cut_type,LoadLevelTexte.text);
	Partie.Officiel=false;
	InitialiserJeu();
}


