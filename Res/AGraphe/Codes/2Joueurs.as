
//Les variables utiles :
var Mode2Joueurs:Boolean=false;

var SVGNbJetons:int=-1;
var TourDuJoueur:int=1;


//Les sprites du Mods
var Sprite2Joueurs:Sprite=new Sprite();

var Mods_2Joueurs:TextField=CreerTextField(Sprite2Joueurs,0,0,180,25,true,false,false);
Mods_2Joueurs.htmlText="<li>Activer le mode \"2 Joueurs\"</li>";


Sprite2Joueurs.scaleX=Sprite2Joueurs.scaleY=0.4;
Mods.addChild(Sprite2Joueurs);
Sprite2Joueurs.addEventListener(MouseEvent.MOUSE_OVER,SourisIN);
Sprite2Joueurs.addEventListener(MouseEvent.MOUSE_OUT,SourisOUT);
Sprite2Joueurs.addEventListener(MouseEvent.CLICK,SwapMode);

function SwapMode(e:Event):void
{//passe du mode 1 joueur au mode 2 joueurs et vice versa
	Mode2Joueurs=! Mode2Joueurs;
	UpdaterBoite();
	if(Mode2Joueurs)
	{
		Mods_2Joueurs.htmlText="<li>D�sactiver le mode \"2 Joueurs\"</li>";
		ShowMessage("<u>Mode 2 Joueurs</u> : Le mode 2 Joueurs se joue sur les m�mes niveaux que le mode normal. En voici les r�gles :<li>Chacun votre tour, il faut allumer un noeud. Avant d'allumer un noeud, vous pouvez en �teindre autant que vous le souhaitez ;</li><li>Le perdant est celui qui ne peut plus allumer de noeuds.</li>Les r�gles sont simples, � vous de bloquer l'adversaire !<br>Que le meilleur gagne...");
	}
	else
		Mods_2Joueurs.htmlText="<li>Activer le mode \"2 Joueurs\"</li>";

	if(contains(Fond))
		removeChild(Fond);
}

function Verifier_2Joueurs():void
{//Changmeent de tours, et v�rification pour savoir si la partie est termin�e
	var NbNoeudsPossible:int;
	if(SVGNbJetons<Fond.NbJetonsUtilises)
		TourDuJoueur=(TourDuJoueur+1)%2;

	//Tester si gagn� ou perdu :
	NbNoeudsPossible=0;
	for each(var Enfant:Noeud in Fond.All_Noeuds)
	{//V�rifier que tous les enfants sont bien ferm�s
		if(Enfant.Peut_Etre_Allume())
			NbNoeudsPossible++;
	}
	if(NbNoeudsPossible==0)
		Fond.Informations.htmlText="<b>Joueur "+(TourDuJoueur+1)+" a perdu !</b>";
	else
		Fond.Informations.htmlText="Tour de Joueur <b>"+(TourDuJoueur+1)+"</b> ("+NbNoeudsPossible+" choix)";

	//Mettre � jour la sauvegarde
	SVGNbJetons=Fond.NbJetonsUtilises;
}