/////////////////////////////////////
//Fonctions utilisées en cours de niveau
/////////////////////////////////////
function TesterFinNiveau(e:Event):void
{//Teste si le niveau est terminé

	if(Fond.Termine)
	{
		if(Fond.Officiel)
			TerminerNiveau(1);
		else
			TerminerNiveau(0);//S'il ne s'agit pas d'un niveau officiel, afficher la boite de dialogue.
	}
}

/////////////////////////////////////
//Fonctions utilisées lors des changements de niveaux
/////////////////////////////////////
function TerminerNiveau(Valeur:int):void
{//Termine un niveau en affichant la boite de changement
//Débloque un nouveau niveau si le dernier est réussi.
	removeEventListener(Event.ENTER_FRAME,TesterFinNiveau);

	Fond.Taille=0;//Réduire
	Boite.visible=true;

	NumeroNiveauActuel+=Valeur;
	if(NumeroNiveauActuel>NumeroNiveauUnlockes && NumeroNiveauActuel<=11)
	{//Si il vient de réussir le niveau sur lequel il était bloqué
		NumeroNiveauUnlockes+=Valeur;//Débloquer un nouveau niveau
		SESSION.NumeroNiveauActuel=NumeroNiveauActuel;//Et enregistrer en local la progression
		SESSION.NumeroNiveauUnlockes=NumeroNiveauUnlockes;
		ChangeLevelInfo.htmlText="Nouveau Niveau débloqué !";
		LancerNouveauNiveau();
	}
	else if(NumeroNiveauUnlockes==11 && NumeroNiveauActuel>=11)
	{
		ShowMessage("<u>Félicitations !</u> Vous avez fini les 12 niveaux proposés par le jeu.<br>Maintenant, pourquoi ne pas tenter votre chance sur le prédecesseur de ce jeu, <a href=\"http://www.neamar.fr/Res/Agraphe/\" target=\"_blank\">AGraphe</a>  (même graphique, mais concept différent) ? Sinon, vous pouvez aussi éteindre votre ordinateur et reprendre une activité normale...<font size=\"-4\">(z'avez pas du boulot à faire ?)</font><br>À la revoyure, Neamar.");
		NumeroNiveauActuel=11;
		if(contains(Fond))
		{//C'est la première fois que le jeu est fini :
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
{//Arrête le niveau directement.
 	TerminerNiveau(0);
  	Message_Container.visible=false;
	ChangeLevelInfo.htmlText="<b>Niveau abandonné !</b>";
}

function LancerNouveauNiveau(NumNiveau:int=-1):void
{//Lancer un niveau "quelconque"
	if(NumNiveau==-1)
		NumNiveau=NumeroNiveauActuel;

	if(Fond!=null && contains(Fond))
		removeChild(Fond);//Si Fond a déjà été utilisé, le nettoyer.

	Fond = GetLevelData(NumNiveau);
	Fond.graphics.clear();//Supprimer le fond blanc
	Fond.x=FlashWidth/2;
	Fond.y=FlashHeight/2;
	Fond.scaleX=Fond.scaleY=Fond.TailleActuelle=0;
	addChild(Fond);
	//Repasser la boite de message au premier plan
	setChildIndex(Fond,1);


	Fond.Taille=1;//Rezoomer
	addEventListener(MouseEvent.MOUSE_WHEEL,Zoom);//Le zoom à la souris, disposé sur le stage. (sinon, il faut avoir la souris SUR le niveau I.e sur un noeud ou une arete...ce qui n'est pas pratique)

	Boite.visible=false;
	addEventListener(Event.ENTER_FRAME,TesterFinNiveau);//Remettre le test de fin de niveau
	ChangeLevelInfo.htmlText="<u>Liste des niveaux</u>";
}