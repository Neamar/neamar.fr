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
LoadLevelTexte.restrict=",|0-9";
LoadLevelTexte.text="0,1|1,5|5,4|4,0|6,7|7,3|3,2|2,6";

var LoadLevelCaption:TextField = CreerTextField(LoadLevel,20,10,400,100,true,true,false);

var Lancer_Level:Sprite=LevelChangeButton(0);
Lancer_Level.scaleX=Lancer_Level.scaleY=.3;
Lancer_Level.x=420;
Lancer_Level.y=90;
Lancer_Level.addEventListener(MouseEvent.CLICK,LancerChargement);
LoadLevel.addChild(Lancer_Level);

AppliquerFiltre(LoadLevel);

LoadLevelCaption.htmlText="<i>(Utilisez la roulette de la souris pour faire défiler le texte)<br><u>Éditeur de niveau</u><br>Un niveau est une simple chaine de caractères.<br>Chaque noeud est affecté d'un numéro. Pour créer un lien marquer Noeud1,Noeud2 : par exemple <b>0,1</b>.<br>Séparez les asociations de noeuds par un pipe (la barre verticale : <b>|</b> (alt-gr + 6)).<br>Exemple : le texte chargé actuellement permet de rejouer le premier niveau.<br>Dernière information : avant chaque lancement, les noeuds sont placés de façon aléatoire sur la surface de jeu : le même niveau peut donc produire plusieurs situations initiales.";

addChild(LoadLevel);

function ShowLoadLevel(e:Event):void
{
	LoadLevel.visible=true;
	Boite.visible=false;
}


function LancerChargement(e:Event=null):void
{//Lance le chargement à partir d'un niveau perso.
	LoadLevel.visible=false;
	Boite.visible=false;
	Fond.filters=new Array();
	if(contains(Fond))
		removeChild(Fond);

	Fond=String2Level(LoadLevelTexte.text);
	Fond.Officiel=false;

	Fond.graphics.clear();//Supprimer le fond blanc
	Fond.x=FlashWidth/2;
	Fond.y=FlashHeight/2;
	Fond.scaleX=Fond.scaleY=Fond.TailleActuelle=0;
	addChild(Fond);
	//Repasser la boite de message au premier plan
	setChildIndex(Fond,1);


	Fond.Taille=1;//Rezoomer

	//Repasser la boite de message au premier plan...c'est plus pratique pour la lire :-)
	addEventListener(Event.ENTER_FRAME,TesterFinNiveau);

	//Mettre à jour la preview
	LVL_Edit=String2Level(LoadLevelTexte.text);
	LVL_Edit.Officiel=false;
}
