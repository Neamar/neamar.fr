
//Déclaration des Sprites
var Boite:Sprite = new Sprite();
var RetryLevelButtonInterne:Sprite;
var Annuler_Choix:Sprite;
var Neamar_Sprite:Sprite;

var Message_Container:Sprite=new Sprite();
var Message_TexteOK:Sprite=new Sprite();
var Mods:Sprite=new Sprite();
var LVL_En_Cours:Niveau;
var LVL_Edit:Niveau=null;

//Remplissage des Sprites

Message_Container.graphics.beginFill(0x444444);
Message_Container.graphics.lineStyle(2,0x000000);
Message_Container.graphics.drawRect(0, 0,440,140);
Message_Container.x=100;
Message_Container.y=160;
Message_Container.visible=false;
Message_Container.alpha=.8;

var Message_Texte:TextField = CreerTextField(Message_Container,10,10,420,100);

Message_TexteOK = LevelChangeButton(0);
Message_TexteOK.scaleX=Message_TexteOK.scaleY=.3;
Message_Container.addChild(Message_TexteOK);
Message_TexteOK.x=420;
Message_TexteOK.y=120;
Message_TexteOK.addEventListener(MouseEvent.CLICK,RemoveMessage);


Boite.graphics.beginFill(0xCCCCCC);
Boite.graphics.lineStyle(1,0x000000);
Boite.graphics.drawRect(0, 0,240,180);
Boite.x=50;
Boite.y=50;
Boite.width=FlashWidth-100;
Boite.height=FlashHeight-100;
Boite.visible=false;
addChild(Boite);
AppliquerFiltre(Boite);

Annuler_Choix=LevelChangeButton(180);
Annuler_Choix.scaleX=Annuler_Choix.scaleY=0.15;
Annuler_Choix.addEventListener(MouseEvent.CLICK,Annuler);

addChild(Message_Container);
AppliquerFiltre(Message_Container);


var ChangeLevelInfo:TextField = CreerTextField(Boite,30,0,FlashWidth-100,25,false,false,false);
ChangeLevelInfo.htmlText="<u>Liste des niveaux</u>";


RetryLevelButtonInterne=LevelChangeButton(90);
addChild(RetryLevelButtonInterne);
RetryLevelButtonInterne.x=640;
RetryLevelButtonInterne.y=450;
RetryLevelButtonInterne.scaleX=RetryLevelButtonInterne.scaleY=.2;
RetryLevelButtonInterne.addEventListener(MouseEvent.CLICK,StopLevel);


Neamar_Sprite = new Sprite();
Neamar_Sprite.graphics.beginFill(0xCCCCCC);
Neamar_Sprite.graphics.drawRect(0, 0, 640, 480);
Neamar_Sprite.graphics.endFill();
Neamar_Sprite.graphics.lineStyle(2,0x000000);
Neamar_Sprite.graphics.lineTo(640,0);
Neamar_Sprite.graphics.lineTo(340,220);
Neamar_Sprite.graphics.moveTo(0,0);
Neamar_Sprite.graphics.lineTo(320,220);
Neamar_Sprite.graphics.moveTo(320,260);
Neamar_Sprite.graphics.lineTo(0,480);
Neamar_Sprite.graphics.lineTo(640,480);
Neamar_Sprite.graphics.lineTo(360,260);
Neamar_Sprite.graphics.drawCircle(320, 240,120);
Neamar_Sprite.width=640;
Neamar_Sprite.height=480;
Neamar_Sprite.scaleX=Neamar_Sprite.scaleY=0.07;
AppliquerFiltre(Neamar_Sprite);
Neamar_Sprite.addEventListener(MouseEvent.MOUSE_OVER,APropos);
Neamar_Sprite.addEventListener(MouseEvent.CLICK,AProposTexte);

Mods.graphics.beginFill(0xCCCCCC);
Mods.graphics.drawRect(0, 0, 100,30);
Mods.graphics.endFill();
AppliquerFiltre(Mods);

//Ajout dans Mods
var SpriteReset:Sprite=new Sprite();
var Mods_Reset:TextField = CreerTextField(SpriteReset,0,0,180,20,false,false,false);
Mods_Reset.htmlText="<li>RESET</li>";
SpriteReset.scaleX=SpriteReset.scaleY=0.4;
SpriteReset.y=16;
Mods.addChild(SpriteReset);
SpriteReset.addEventListener(MouseEvent.MOUSE_OVER,SourisIN);
SpriteReset.addEventListener(MouseEvent.MOUSE_OUT,SourisOUT);
SpriteReset.addEventListener(MouseEvent.CLICK,ResetAll);

var SpriteQualiteL:Sprite=new Sprite();
var Mods_QualiteL:TextField = CreerTextField(SpriteQualiteL,0,0,180,20,false,false,false);
Mods_QualiteL.htmlText="<li>Réduire la qualité</li>";
SpriteQualiteL.scaleX=SpriteQualiteL.scaleY=0.4;
SpriteQualiteL.y=0;
Mods.addChild(SpriteQualiteL);
SpriteQualiteL.addEventListener(MouseEvent.MOUSE_OVER,SourisIN);
SpriteQualiteL.addEventListener(MouseEvent.MOUSE_OUT,SourisOUT);
SpriteQualiteL.addEventListener(MouseEvent.CLICK,ToggleQuality);


//Lien vers http://www.mini-jeu-gratuit.fr/
var SpriteSponsor:Sprite=new Sprite();

var Mods_Sponsor:TextField=CreerTextField(SpriteSponsor,0,0,50,35,false,true,false)
Mods_Sponsor.htmlText="<a href=\"http://www.mini-jeu-gratuit.fr/vip/neamar/\" target=\"_blank\">Plus de jeux</a>";
// SpriteSponsor.addEventListener(MouseEvent.MOUSE_MOVE,SourisIN);
// SpriteSponsor.addEventListener(MouseEvent.MOUSE_OUT,SourisOUT);


function CreerTextField(Parent:Sprite,x:int,y:int,width:int,height:int,multiline:Boolean=true, selectable:Boolean=false,border:Boolean=true):TextField
{//Instanciateur de TextField
	var TextFieldTemporaire:TextField=new TextField();
	Parent.addChild(TextFieldTemporaire);
	TextFieldTemporaire.x=x;
	TextFieldTemporaire.y=y;
	TextFieldTemporaire.width=width;
	TextFieldTemporaire.height=height;
	TextFieldTemporaire.wordWrap=true;
	TextFieldTemporaire.background =TextFieldTemporaire.border=border;
	TextFieldTemporaire.multiline=multiline;
	TextFieldTemporaire.selectable=selectable;
	return TextFieldTemporaire;
}

function LevelChangeButton(Angle:int):Sprite
{//fonction qui génére un bouton de type "Suivant".
	var LevelChangeButtonSprite:Sprite=new Sprite();
	LevelChangeButtonSprite.graphics.beginFill(0x7F7FB3);
	LevelChangeButtonSprite.graphics.lineStyle(1,0x000000);
	LevelChangeButtonSprite.graphics.drawCircle(75,75,75)
	LevelChangeButtonSprite.graphics.endFill();
	LevelChangeButtonSprite.graphics.lineStyle(10,0xFF0000);
	LevelChangeButtonSprite.graphics.moveTo(33,33);
	LevelChangeButtonSprite.graphics.lineTo(116,75);
	LevelChangeButtonSprite.graphics.lineTo(33,117);
	LevelChangeButtonSprite.rotation=Angle;
	LevelChangeButtonSprite.alpha=1;
	LevelChangeButtonSprite.addEventListener(MouseEvent.MOUSE_MOVE,SourisIN);
	LevelChangeButtonSprite.addEventListener(MouseEvent.MOUSE_OUT,SourisOUT);
	return LevelChangeButtonSprite;
}

function ShowMessage(Texte:String):void
{//Affiche un message.
	Message_Container.visible=true;
	Message_Texte.htmlText=Texte;
}
function RemoveMessage(e:Event=null):void
{//Cache la boite de messages
	Message_Container.visible=false;
}

function UpdaterBoite():void
{
	var i:int=0;
	var ThumbShot:Niveau;

	function Afficher(Image:Niveau,Empl:int):void
	{
		Boite.addChild(Image);
		Image.scaleX=Image.scaleY=0.07;
		Image.x=15 + (Empl%4 +.5)*Ecart;//Le niveau est centré, il faut ajouter le paramètre .5 pour obtenir le bon emplacement
		Image.addEventListener(MouseEvent.MOUSE_OVER,SourisIN);
		Image.addEventListener(MouseEvent.MOUSE_OVER,AfficherInfos);
		Image.addEventListener(MouseEvent.MOUSE_OUT,SourisOUT);
		Image.addEventListener(MouseEvent.CLICK,ChargementNiveauDirect);
		Image.y=20 + (Math.floor(Empl/4) +.5)*Ecart/1.3;
	}

	RemoveMessage();
	//Générer un préview des niveaux
	while(Boite.numChildren > 0)
		Boite.removeChildAt(0);

	var Ecart:Number=Boite.width/10;
	if(Images_Niveaux.length<NumeroNiveauUnlockes)
	{
		Images_Niveaux=new Array();
		for(i=0;i<=NumeroNiveauUnlockes;i++)
		{
			ThumbShot=GetLevelData(i,true);//true indique qu'il ne faut pas afficher les messages;
			ThumbShot.Passif=true;
			Images_Niveaux.push(ThumbShot);
		}
	}
	for(i=0;i<=NumeroNiveauUnlockes;i++)
	{
		ThumbShot=Images_Niveaux[i];
		Afficher(ThumbShot,i);
		Boite.addChild(ThumbShot);
		if(i==NumeroNiveauActuel)
			AppliquerFiltre(ThumbShot,0x7F7FB3)
	}

	if(LVL_Edit!=null)//LVL_Edit est mis à jour lors du chargement d'un niveau perso
	{
		Afficher(LVL_Edit,14);
		LVL_Edit.y -=4;
	}
	else
	{
		Boite.addChild(SpriteSponsor);
		SpriteSponsor.x=15+2*Ecart;
		SpriteSponsor.y=20+3*Ecart/1.3;
		SpriteSponsor.filters=new Array(new BevelFilter(7,90,0x7F7F00,1,0x000000,1,10,4,10));
	}

	//Retour
	Boite.addChild(Annuler_Choix);
	Annuler_Choix.y=16;
	Annuler_Choix.x=16;
	Boite.addChild(ChangeLevelInfo);

	//Informations
	Boite.addChild(Neamar_Sprite);
	Neamar_Sprite.x=17 + 3*Ecart;
	Neamar_Sprite.y=20 + 3*Ecart/1.3;

	Boite.addChild(Mods);
	Mods.x=15;
	Mods.y=20 + 3*Ecart/1.3;

}

function AfficherInfos(e:Event):void
{
	if(e.currentTarget.Officiel==true)
		ChangeLevelInfo.htmlText="Charger le niveau <b>"+e.currentTarget.NumeroNiveau +"</b>";
	else
		ChangeLevelInfo.htmlText="Niveau Perso";
	if(e.currentTarget.NumeroNiveau==NumeroNiveauUnlockes)
		ChangeLevelInfo.htmlText="Dernier niveau débloqué : <b>"+e.currentTarget.NumeroNiveau +"</b>";
	else if(e.currentTarget.NumeroNiveau==NumeroNiveauActuel)
	{
		ChangeLevelInfo.htmlText="Dernier niveau tenté : <b>"+e.currentTarget.NumeroNiveau +"</b>";
		AppliquerFiltre(e.currentTarget,0x7F7FB3)
	}
	ChangeLevelInfo.htmlText += "<font size=\"-7\">{" + e.currentTarget.Param() + "}</font>";
}
function APropos(e:Event):void
{
	ChangeLevelInfo.htmlText="Informations, explications, code source...";
}

function AProposTexte(e:Event):void
{
	ShowMessage("<u>À propos...</u><br><li>Jeu réalisé par Neamar en AS3 libre.</li><li>Explications du jeu, dernières mises à jour, code source, aide à la compilation : <a href=\"http://neamar.fr/Res/BGraphe/\" target=\"_blank\">http://neamar.fr/Res/BGraphe (click to go)</a></li>");
}

function Annuler(e:Event):void
{
	Fond.Taille = 1;//Rezoomer
	Boite.visible=false;
	addEventListener(Event.ENTER_FRAME,TesterFinNiveau);
}

function ToggleQuality(e:Event):void
{
	if(stage.quality == "HIGH")
	{
		stage.quality="LOW";
		Mods_QualiteL.htmlText="<li>Augmenter la qualité</li>";
	}
	else
	{
		stage.quality="HIGH";
		Mods_QualiteL.htmlText="<li>Réduire la qualité</li>";
	}
}

function Zoom(evt:MouseEvent):void
{
	Fond.startDrag();
	Fond.stopDrag();
	if(evt.delta>0)
		Fond.Taille=Math.min(Fond.scaleX + 0.2*Fond.scaleX,1.2);
	else
		Fond.Taille=Math.max(Fond.scaleX - 0.2*Fond.scaleX,0.2);
}