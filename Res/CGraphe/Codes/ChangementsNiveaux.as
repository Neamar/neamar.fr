/////////////////////////////////////
//Fonctions utilis�es en cours de niveau
/////////////////////////////////////

function FinNiveau():void
{//Fonction de callback appel�e quand le niveau est termin�.
	if(Partie.Gagnant.IsHuman)
		TerminerNiveau(1);
	else
		TerminerNiveau(0);
}

/////////////////////////////////////
//Fonctions utilis�es lors des changements de niveaux
/////////////////////////////////////
function TerminerNiveau(Valeur:int):void
{//Termine un niveau en affichant la boite de changement
//D�bloque un nouveau niveau si le dernier est r�ussi

	Boite.visible=true;

	NumeroNiveauActuel+=Valeur;
	if(NumeroNiveauActuel>NumeroNiveauUnlockes && NumeroNiveauActuel<=11 && Partie.Officiel)
	{//Si il vient de r�ussir le niveau sur lequel il �tait bloqu�
		NumeroNiveauUnlockes+=Valeur;//D�bloquer un nouveau niveau
		SESSION.NumeroNiveauActuel=NumeroNiveauActuel;//Et enregistrer en local la progression
		SESSION.NumeroNiveauUnlockes=NumeroNiveauUnlockes;
		ChangeLevelInfo.htmlText="Nouveau Niveau d�bloqu� !";
		LancerNouveauNiveau();
	}
	else if(NumeroNiveauUnlockes==11 && NumeroNiveauActuel>=11 && NumeroNiveauActuel>NumeroNiveauUnlockes && Partie.Officiel)
	{
		ShowMessage("<u>F�licitations !</u> Vous avez fini les 12 niveaux propos�s par le jeu.<br>Maintenant, pourquoi ne pas tenter votre chance sur les pr�decesseurs de ce jeu, <a href=\"http://www.neamar.fr/Res/Agraphe/\" target=\"_blank\">AGraphe</a> et <a href=\"http://www.neamar.fr/Res/Bgraphe/\" target=\"_blank\">BGraphe</a> ? Sinon, vous pouvez aussi �teindre votre ordinateur et reprendre une activit� normale...<br>� la revoyure pour DGraphe, le dernier de la s�rie, Neamar.");
		NumeroNiveauActuel=11;
		if(contains(Partie.Terrain))
		{//C'est la premi�re fois que le jeu est fini :
			removeChild(Partie.Terrain);
			Boite.visible=false;
		}
		else
			UpdaterBoite();
	}
	else //Sinon, afficher la boite avec la liste des niveaux.
		UpdaterBoite("<b>PERDU !</b> Essaie encore !");
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

	if(Partie!=null && contains(Partie.Terrain))
		removeChild(Partie.Terrain);//Si Fond a d�j� �t� utilis�, le nettoyer.
	Partie=GetLevelData(NumNiveau);

	InitialiserJeu();
}

function InitialiserJeu():void
{//Appel� depuis LancerNouveauNiveau ou depuis LancerNouveauNiveauPerso
	Partie.CallBack=FinNiveau;
	addChild(Partie.Terrain);
	//Repasser la boite de message au premier plan
	setChildIndex(Partie.Terrain,0);

	Boite.visible=false;
	ChangeLevelInfo.htmlText="<u>Liste des niveaux</u>";
}