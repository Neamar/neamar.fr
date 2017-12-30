//Ajout dans Mods
var SpritePerso:Sprite=new Sprite();
var Mods_Perso:TextField = CreerTextField(SpritePerso,0,0,180,20,false,false,false);
Mods_Perso.htmlText="<li>Éditeur de niveaux</li>";
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

var LoadLevelTexte:TextField = CreerTextField(LoadLevel,20,110,360,20,false,true);
LoadLevelTexte.type="input";
LoadLevelTexte.restrict="null,/@+-X0-9";
LoadLevelTexte.text="null,null,0/1/,2/,null,null,4/5/,3/6/";

var LoadLevelNb_Jetons:TextField = CreerTextField(LoadLevel,390,110,20,20,false,true);
LoadLevelNb_Jetons.type="input";
LoadLevelNb_Jetons.restrict="0-9";
LoadLevelNb_Jetons.text="4";

var LoadLevelCaption:TextField = CreerTextField(LoadLevel,20,10,400,100,true,true,false);

var Lancer_Level:Sprite=LevelChangeButton(0);
Lancer_Level.scaleX=Lancer_Level.scaleY=.3;
Lancer_Level.x=420;
Lancer_Level.y=90;
Lancer_Level.addEventListener(MouseEvent.CLICK,LancerChargement);
LoadLevel.addChild(Lancer_Level);

AppliquerFiltre(LoadLevel);

LoadLevelCaption.htmlText="<i>(Utilisez la roulette de la souris pour faire défiler le texte)<br>(<a href=\"http://neamar.fr/Res/AGraphe#Createur\" target=\"_blank\">http://neamar.fr/Res/AGraphe#Createur pour un tutorial plus clair</a>)<br><u>Éditeur de niveau</u><br>Un niveau est une simple chaine de caractères, les virgules délimitant des intervalles contenant un noeud chacun.<br>Un noeud sans enfant est noté null. Ainsi, pour réaliser un niveau avec un unique noeud, il faut simplement marquer <u>null</u> dans le champ de texte.<br>Pour les parents, il faut marquer le numéro d'intervalle des noeuds enfants, séparés par un / (slash). Ainsi, le premier niveau du jeu se code très simplement de la façon suivante : <u>null,null,0/1/</u> : deux enfants, et un parent qui réunit les deux.<br><b>Attention</b> : N'oubliez pas de mettre un slash à la fin de la liste !<br>Quelques astuces pour aller plus loin :<li>Vous pouvez marquer un noeud comme inextinctible en placant un X dans la liste : <u>nullX,null,0/1/X</u></li><li>Vous pouvez décaler l'affichage d'un noeud à l'aide de hook : + et -. Cela force l'affichage du noeud un cran plus haut (ou un cran moins haut). Par exemple, <u>null,null,0/1/+</u> affiche un niveau «en ligne».</li>";

addChild(LoadLevel);

function ShowLoadLevel(e:Event):void
{
	LoadLevel.visible=true;
	Boite.visible=false;
}


function LancerChargement(e:Event=null):void
{
	LoadLevel.visible=false;
	Boite.visible=false;
	Fond.filters=new Array();
	if(contains(Fond))
		removeChild(Fond);

	Fond=String2Level(LoadLevelTexte.text,"Niveau Perso",LoadLevelNb_Jetons.text);
	Fond.Officiel=false;
	addChild(Fond);
	Fond.graphics.clear();

	//Repasser la boite de message au premier plan...c'est plus pratique pour la lire :-)
	setChildIndex(Fond,1);
	addEventListener(Event.ENTER_FRAME,TesterFinNiveau);

	//Mettre à jour la preview
	LVL_Edit=String2Level(LoadLevelTexte.text,"Édition Actuelle",LoadLevelNb_Jetons.text);
	LVL_Edit.Officiel=false;
//  	Trace("Nb :"+SolveLevel(Fond));
}
