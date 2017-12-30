/////////////////////////////////////
//Fonctions utilisées en cours de niveau
/////////////////////////////////////
function TesterFinNiveau(e:Event):void
{//Teste si le niveau est terminé, ou si il est invalide.
//Fonctionne aussi quand le mode 2 joueurs est activé.
	if(Mode2Joueurs)
		Verifier_2Joueurs();
	else
	{
		if(GrandPere.Ferme)
			TerminerNiveau(1);//GAGNÉ !
		else
		{
			if(Fond.NbJetonsToleres-Fond.NbJetonsUtilises<0)
			{//PERDU
				TerminerNiveau(0);
				ChangeLevelInfo.htmlText="<b>Trop de noeuds allumés !</b>";
			}
		}
	}
}

/////////////////////////////////////
//Fonctions utilisées lors des changements de niveaux
/////////////////////////////////////
function TerminerNiveau(Valeur:int):void
{//Termine un niveau en affichant la boite de changement
//Ajoute la valeur aux niveaux unlockés.
	removeEventListener(Event.ENTER_FRAME,TesterFinNiveau);

	Flouter(Fond,0,Fond.FLOU_FINAL);//Ajouter un flou

	NumeroNiveauActuel+=Valeur;
	if(NumeroNiveauActuel>NumeroNiveauUnlockes && Fond.Officiel==true && NumeroNiveauActuel<12)
	{//Si il vient de réussir le niveau sur lequel il était bloqué
		NumeroNiveauUnlockes+=Valeur;//Débloquer un nouveau niveau
		SESSION.NumeroNiveauActuel=NumeroNiveauActuel;//Et enregistrer en local la progression
		SESSION.NumeroNiveauUnlockes=NumeroNiveauUnlockes;
		ChangeLevelInfo.htmlText="Nouveau Niveau débloqué !";
	}

	//Puis afficher la boite avec la liste des niveaux.
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
	{//Si Fond a déjà été utilisé, nettoyer l'ensemble
		Fond.Nettoyer();
		removeChild(Fond);
	}


	//SwapBackGround();
	Fond = GetLevelData(NumNiveau);
	Fond.graphics.clear();//Supprimer le fond blanc
	addChild(Fond);
	//Repasser la boite de message au premier plan
	setChildIndex(Fond,1);

	Flouter(Fond,Fond.FLOU_FINAL,0);//Déflouter

	addEventListener(Event.ENTER_FRAME,TesterFinNiveau);
	ChangeLevelInfo.htmlText="<u>Liste des niveaux</u>";
}

////////////////////////////////////////
//Partie gérant les effets graphiques
////////////////////////////////////////
function Flouter(Layer:Niveau,Depart:int,Arrivee:int):void
{
	Layer.FlouFinal=Arrivee;
	Layer.Flou=Depart;
	Layer.addEventListener(Event.ENTER_FRAME,GererFlou);
}

function GererFlou(e:Event):void
{//Flouter le niveau en arrière plan
	var Layer:Object=e.currentTarget;
	if(Layer.Flou!=Layer.FlouFinal)
	{
		if(Layer.Flou<Layer.FlouFinal)
			Layer.Flou+=2;
		else
			Layer.Flou-=2;
		var FiltreFlou:BitmapFilter = new BlurFilter(Layer.Flou,Layer.Flou)
		var ListeFiltres:Array = new Array();
		ListeFiltres.push(FiltreFlou);
		Layer.filters=ListeFiltres;
		if(Layer.FlouFinal==0)
		{
			Boite.alpha=Math.max(0,Layer.Flou/Layer.FLOU_FINAL);
			if(Layer.Flou==0)
				Boite.visible=false;
		}
		else
		{
			Boite.visible=true;
			Boite.alpha = Math.min(1,2*Layer.Flou/Layer.FlouFinal);
		}
	}
	else
	{
		Boite.visible=(Boite.alpha>.5);
		Layer.removeEventListener(Event.ENTER_FRAME,GererFlou);
	}
}