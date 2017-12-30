/////////////////////////////////////
//Fonctions utilis�es en cours de niveau
/////////////////////////////////////
function TesterFinNiveau(e:Event):void
{//Teste si le niveau est termin�

	if(Fond.Termine)
	{
		if(Fond.Officiel)
			TerminerNiveau(1);
		else
			TerminerNiveau(0);//S'il ne s'agit pas d'un niveau officiel, afficher la boite de dialogue.
	}
}

/////////////////////////////////////
//Fonctions utilis�es lors des changements de niveaux
/////////////////////////////////////
function TerminerNiveau(Valeur:int):void
{//Termine un niveau en affichant la boite de changement
//D�bloque un nouveau niveau si le dernier est r�ussi.
	removeEventListener(Event.ENTER_FRAME,TesterFinNiveau);

	Fond.Taille=0;//R�duire
	Boite.visible=true;

	NumeroNiveauActuel+=Valeur;
	if(NumeroNiveauActuel>NumeroNiveauUnlockes && NumeroNiveauActuel<=11)
	{//Si il vient de r�ussir le niveau sur lequel il �tait bloqu�
		NumeroNiveauUnlockes+=Valeur;//D�bloquer un nouveau niveau
		SESSION.NumeroNiveauActuel=NumeroNiveauActuel;//Et enregistrer en local la progression
		SESSION.NumeroNiveauUnlockes=NumeroNiveauUnlockes;
		ChangeLevelInfo.htmlText="Nouveau Niveau d�bloqu� !";
		LancerNouveauNiveau();
	}
	else if(NumeroNiveauUnlockes==11 && NumeroNiveauActuel>=11)
	{
		ShowMessage("<u>F�licitations !</u> Vous avez fini les 12 niveaux propos�s par le jeu.<br>Maintenant, pourquoi ne pas tenter votre chance sur le pr�decesseur de ce jeu, <a href=\"http://www.neamar.fr/Res/Agraphe/\" target=\"_blank\">AGraphe</a>  (m�me graphique, mais concept diff�rent) ? Sinon, vous pouvez aussi �teindre votre ordinateur et reprendre une activit� normale...<font size=\"-4\">(z'avez pas du boulot � faire ?)</font><br>� la revoyure, Neamar.");
		NumeroNiveauActuel=11;
		if(contains(Fond))
		{//C'est la premi�re fois que le jeu est fini :
			removeChild(Fond);
			Boite.visible=false;
		}
		else
			UpdaterBoite();
	}
	else //Sinon, afficher la boite avec la liste des niveaux.
		UpdaterBoite();
}


function StopLevel(e:Event=null):void
{//Arr�te le niveau directement.
 	TerminerNiveau(0);
  	Message_Container.visible=false;
	ChangeLevelInfo.htmlText="<b>Niveau abandonn� !</b>";
}

function LancerNouveauNiveau(NumNiveau:int=-1):void
{//Lancer un niveau "quelconque"
	if(NumNiveau==-1)
		NumNiveau=NumeroNiveauActuel;

	if(Fond!=null && contains(Fond))
		removeChild(Fond);//Si Fond a d�j� �t� utilis�, le nettoyer.

	Fond = GetLevelData(NumNiveau);
	Fond.graphics.clear();//Supprimer le fond blanc
	Fond.x=FlashWidth/2;
	Fond.y=FlashHeight/2;
	Fond.scaleX=Fond.scaleY=Fond.TailleActuelle=0;
	addChild(Fond);
	//Repasser la boite de message au premier plan
	setChildIndex(Fond,1);


	Fond.Taille=1;//Rezoomer
	addEventListener(MouseEvent.MOUSE_WHEEL,Zoom);//Le zoom � la souris, dispos� sur le stage. (sinon, il faut avoir la souris SUR le niveau I.e sur un noeud ou une arete...ce qui n'est pas pratique)

	Boite.visible=false;
	addEventListener(Event.ENTER_FRAME,TesterFinNiveau);//Remettre le test de fin de niveau
	ChangeLevelInfo.htmlText="<u>Liste des niveaux</u>";
}