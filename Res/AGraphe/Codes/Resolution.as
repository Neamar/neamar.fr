function SolveLevel(Level:Niveau,MaxJetons:int=0,NbActions:int=0):int
{//Prend en paramètre un niveau, renvoie le nombre minimum de noeuds à allumer simultanément.
//Utilise la récursivité...
var Enfant:Noeud;//Variable utilisée dans les boucles
var Jetons_actuel:int; //Le nombre de jetons consommés au maximum pendant la résolution
var BestValue:int; //Le meilleur Jetons_actuel que l'on ait trouvé;
var HasMadeChange:Boolean=false;//Si il vaut false à la fin de l'étape 1, on arrete tout
var DernierParentTraite:Noeud=new Noeud(new Array(),null);

//D'abord, présenter quelques fonctions utiles :
	function Parents_Allumes(Element:Noeud, index:int, Tableau:Array):Boolean
	{//renvoie Vrai si l'élement a été fermé, ou est fermé.
		return (Element.Ferme || Element.aEteFerme)
	}

//Etape 0 : Si GrandPere est allumé, arrêter la recherche !
if(Level.All_Noeuds[Level.All_Noeuds.length-1].Ferme==true)
	return 0;

//Etape 1 : Eteindre tous les noeuds qui n'ont plus besoin d'être allumés
for each(Enfant in Level.All_Noeuds)
{
	if(Enfant.Ferme==true && Enfant.Parents.every(Parents_Allumes))
	{//Every effectue un test sur tous les parents : si ils ont tous été allumés, on peut éteindre ce noeud.
		Enfant.ChangeState(false);//Eteindre l'item
	}
}

//Etape 2 : Allumer tous les noeuds possibles, les passer à la fonction SolveLevel.
//Récuperer le plus petit résultat, et le renvoyer.
Jetons_actuel=1000;
BestValue=1000;
for each(Enfant in Level.All_Noeuds)
{
	if(Enfant.Peut_Etre_Allume() && DernierParentTraite != Enfant.Parents[0])
	{//L'allumer
		Enfant.ChangeState(true);
		Jetons_actuel=Math.max(Level.NbJetonsUtilises,MaxJetons);
		Jetons_actuel=Math.max(Jetons_actuel,SolveLevel(String2Level(Level.Niveau2String(),"Résolution"),Jetons_actuel,NbActions + 1)); //On est obligé de passer par un export en string, car sinon on agirait sur la copie originale...ce qui n'est pas idéal.
		//SolveLevel va nous renvoyer le nombre de jetons requis. On ne le garde que si il est intéressant ;)
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