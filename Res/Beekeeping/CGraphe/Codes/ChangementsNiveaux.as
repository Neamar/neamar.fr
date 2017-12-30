/////////////////////////////////////
//Fonctions utilisées en cours de niveau
/////////////////////////////////////

function FinNiveau():void
{//Fonction de callback appelée quand le niveau est terminé.
	if(Partie.Gagnant.IsHuman)
		TerminerNiveau(1);
	else
		TerminerNiveau(0);
}

/////////////////////////////////////
//Fonctions utilisées lors des changements de niveaux
/////////////////////////////////////
function TerminerNiveau(Valeur:int):void
{//Termine un niveau en affichant la boite de changement
//Débloque un nouveau niveau si le dernier est réussi

	Boite.visible=true;

	NumeroNiveauActuel+=Valeur;
	if(NumeroNiveauActuel>NumeroNiveauUnlockes && NumeroNiveauActuel<=11 && Partie.Officiel)
	{//Si il vient de réussir le niveau sur lequel il était bloqué
		NumeroNiveauUnlockes+=Valeur;//Débloquer un nouveau niveau
		SESSION.NumeroNiveauActuel=NumeroNiveauActuel;//Et enregistrer en local la progression
		SESSION.NumeroNiveauUnlockes=NumeroNiveauUnlockes;
		ChangeLevelInfo.htmlText="Nouveau Niveau débloqué !";
		LancerNouveauNiveau();
	}
	else if(NumeroNiveauUnlockes==11 && NumeroNiveauActuel>=11 && NumeroNiveauActuel>NumeroNiveauUnlockes && Partie.Officiel)
	{
		ShowMessage("<u>Félicitations !</u> Vous avez fini les 12 niveaux proposés par le jeu.<br>Maintenant, pourquoi ne pas tenter votre chance sur les prédecesseurs de ce jeu, <a href=\"http://www.neamar.fr/Res/Agraphe/\" target=\"_blank\">AGraphe</a> et <a href=\"http://www.neamar.fr/Res/Bgraphe/\" target=\"_blank\">BGraphe</a> ? Sinon, vous pouvez aussi éteindre votre ordinateur et reprendre une activité normale...<br>À la revoyure pour DGraphe, le dernier de la série, Neamar.");
		NumeroNiveauActuel=11;
		if(contains(Partie.Terrain))
		{//C'est la première fois que le jeu est fini :
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
{//Arrête le niveau directement.
 	TerminerNiveau(0);
  	Message_Container.visible=false;
	ChangeLevelInfo.htmlText="<b>Niveau abandonné !</b>";
}

function LancerNouveauNiveau(NumNiveau:int=-1):void
{//Lancer un niveau "quelconque"
	if(NumNiveau==-1)
		NumNiveau=NumeroNiveauActuel;

	if(Partie!=null && contains(Partie.Terrain))
		removeChild(Partie.Terrain);//Si Fond a déjà été utilisé, le nettoyer.
	Partie=GetLevelData(NumNiveau);

	InitialiserJeu();
}

function InitialiserJeu():void
{//Appelé depuis LancerNouveauNiveau ou depuis LancerNouveauNiveauPerso
	Partie.CallBack=FinNiveau;
	addChild(Partie.Terrain);
	//Repasser la boite de message au premier plan
	setChildIndex(Partie.Terrain,0);

	Boite.visible=false;
	ChangeLevelInfo.htmlText="<u>Liste des niveaux</u>";
}