function SolveLevel(Level:Niveau,MaxJetons:int=0,NbActions:int=0):int
{//Prend en param�tre un niveau, renvoie le nombre minimum de noeuds � allumer simultan�ment.
//Utilise la r�cursivit�...
var Enfant:Noeud;//Variable utilis�e dans les boucles
var Jetons_actuel:int; //Le nombre de jetons consomm�s au maximum pendant la r�solution
var BestValue:int; //Le meilleur Jetons_actuel que l'on ait trouv�;
var HasMadeChange:Boolean=false;//Si il vaut false � la fin de l'�tape 1, on arrete tout
var DernierParentTraite:Noeud=new Noeud(new Array(),null);

//D'abord, pr�senter quelques fonctions utiles :
	function Parents_Allumes(Element:Noeud, index:int, Tableau:Array):Boolean
	{//renvoie Vrai si l'�lement a �t� ferm�, ou est ferm�.
		return (Element.Ferme || Element.aEteFerme)
	}

//Etape 0 : Si GrandPere est allum�, arr�ter la recherche !
if(Level.All_Noeuds[Level.All_Noeuds.length-1].Ferme==true)
	return 0;

//Etape 1 : Eteindre tous les noeuds qui n'ont plus besoin d'�tre allum�s
for each(Enfant in Level.All_Noeuds)
{
	if(Enfant.Ferme==true && Enfant.Parents.every(Parents_Allumes))
	{//Every effectue un test sur tous les parents : si ils ont tous �t� allum�s, on peut �teindre ce noeud.
		Enfant.ChangeState(false);//Eteindre l'item
	}
}

//Etape 2 : Allumer tous les noeuds possibles, les passer � la fonction SolveLevel.
//R�cuperer le plus petit r�sultat, et le renvoyer.
Jetons_actuel=1000;
BestValue=1000;
for each(Enfant in Level.All_Noeuds)
{
	if(Enfant.Peut_Etre_Allume() && DernierParentTraite != Enfant.Parents[0])
	{//L'allumer
		Enfant.ChangeState(true);
		Jetons_actuel=Math.max(Level.NbJetonsUtilises,MaxJetons);
		Jetons_actuel=Math.max(Jetons_actuel,SolveLevel(String2Level(Level.Niveau2String(),"R�solution"),Jetons_actuel,NbActions + 1)); //On est oblig� de passer par un export en string, car sinon on agirait sur la copie originale...ce qui n'est pas id�al.
		//SolveLevel va nous renvoyer le nombre de jetons requis. On ne le garde que si il est int�ressant ;)
		Enfant.ChangeState(false);
		Enfant.aEteFerme=false;
		HasMadeChange=true;
		DernierParentTraite=Enfant.Parents[0];
	}
	BestValue=Math.min(Jetons_actuel,BestValue);
}
if(!HasMadeChange)
	return 10000;//Renvoyer une grosse valeur !

return BestValue;
}