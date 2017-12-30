function PathFind(Depart:Point,Arrivee:Point,Carte:Array):Array
{
	var OpenList:Array = new Array();
	var OpenList_Map:Array = GenerateArrayOfOpenList();
	var CurrentSquare:t_Node;
	var CurPoint:Point;
	var CurF:uint;
	var CurG:uint;
	var CurH:uint;
	var i:int=0;
	var j:int=0;
	//Ajouter l'élement de départ
	OpenList.push(new t_Node(Depart,0,0,0,Depart));
	OpenList_Map[Depart.x][Depart.y].Parent=Depart;
	//Trier la liste selon F
	i=0;
	do
	{
		i++;
		if(i % 4==0)
		{//En temps normal, on devrait retrier cette liste en permanence. Pour gagner du temps, on ne le fait qu'une fois sur 4
		OpenList.sortOn("F", Array.NUMERIC);
		}

		//Récuperer le premier élement (le plus petit F, le supprimer de openlist et l'ajouter dans closedlist)
		CurrentSquare = OpenList.shift();
		CurPoint=CurrentSquare.Empl; //Un petit raccourci pour simplifier l'écriture

		OpenList_Map[CurPoint.x][CurPoint.y].Ferme=true;
		CurG=CurrentSquare.G+10; //La valeur non heuristique est toujours la même, on la précalcule

		//Faire le test pour les quatre adjacents :
		//-A gauche
		if(CurPoint.x>0 && Carte[CurPoint.x][CurPoint.y].Gauche==null)
		{
			CurH=10*(Math.abs(CurPoint.x-Arrivee.x-1) + Math.abs(CurPoint.y-Arrivee.y));
			//la ligne précédente calcule la valeur heuristique, méthode de Manhattan
			CurF=CurG+CurH;//En déduire le cout du chemin.
			if(OpenList_Map[CurPoint.x-1][CurPoint.y].Visite==false && OpenList_Map[CurPoint.x-1][CurPoint.y].Ferme!=true)
			{//Si le chemin est possible, l'enregistrer comme ouvert
			OpenList.push(new t_Node(new Point(CurPoint.x-1,CurPoint.y),CurF,CurG,CurH,CurPoint));
			OpenList_Map[CurPoint.x-1][CurPoint.y].Visite=true;
			OpenList_Map[CurPoint.x-1][CurPoint.y].Parent=CurPoint;
			}

		}
		//-En haut
		if(CurPoint.y>0 && Carte[CurPoint.x][CurPoint.y].Haut==null)
		{
			CurH=10*(Math.abs(CurPoint.x-Arrivee.x) + Math.abs(CurPoint.y-Arrivee.y-1));
			CurF=CurG+CurH;
			if(OpenList_Map[CurPoint.x][CurPoint.y-1].Visite==false && OpenList_Map[CurPoint.x][CurPoint.y-1].Ferme!=true)
			{
				OpenList.push(new t_Node(new Point(CurPoint.x,CurPoint.y-1),CurF,CurG,CurH,CurPoint));
				OpenList_Map[CurPoint.x][CurPoint.y-1].Visite=true;
				OpenList_Map[CurPoint.x][CurPoint.y-1].Parent=CurPoint;
			}
		}
		//-A droite
		if(CurPoint.x<LabyWidth && Carte[CurPoint.x+1][CurPoint.y].Gauche==null)
		{
			CurH=10*(Math.abs(CurPoint.x-Arrivee.x+1) + Math.abs(CurPoint.y-Arrivee.y));
			CurF=CurG+CurH;
			if(OpenList_Map[CurPoint.x+1][CurPoint.y].Visite==false && OpenList_Map[CurPoint.x+1][CurPoint.y].Ferme!=true)
			{
				OpenList.push(new t_Node(new Point(CurPoint.x+1,CurPoint.y),CurF,CurG,CurH,CurPoint));
				OpenList_Map[CurPoint.x+1][CurPoint.y].Visite=true;
				OpenList_Map[CurPoint.x+1][CurPoint.y].Parent=CurPoint;
			}
		}
		//-En bas
		if(CurPoint.y<LabyHeight && Carte[CurPoint.x][CurPoint.y+1].Haut==null)
		{
			CurH=10*(Math.abs(CurPoint.x-Arrivee.x) + Math.abs(CurPoint.y-Arrivee.y+1));
			CurF=CurG+CurH;
			if(OpenList_Map[CurPoint.x][CurPoint.y+1].Visite==false && OpenList_Map[CurPoint.x][CurPoint.y+1].Ferme!=true)
			{
				OpenList.push(new t_Node(new Point(CurPoint.x,CurPoint.y+1),CurF,CurG,CurH,CurPoint));
				OpenList_Map[CurPoint.x][CurPoint.y+1].Visite=true;
				OpenList_Map[CurPoint.x][CurPoint.y+1].Parent=CurPoint;
			}
		}
		// 		if(i %20==0)
		// 		{
			// 		Trace(OpenList.length+"=>"+CurPoint.x+"?"+CurPoint.y);
			// 		}
	}
	while(!(CurPoint.x==Arrivee.x && CurPoint.y==Arrivee.y) && OpenList.length!=0 && i<PATHFINDING_LIMITE);

	if(OpenList_Map[CurPoint.x][CurPoint.y].Parent==null)
	{
		Trace("Le chemin n'a pas été trouvé : aucun parent !");
		return null;
	}
	if(i>=PATHFINDING_LIMITE)
	{
		Trace("La constante PATHFINDING_LIMITE a été dépassée.");
		return null;
	}
	if(OpenList.length==0)
	{
		Trace("Aucun chemin trouvé :-(");
		return null;
	}

	//	Si on est encore dans la fonction, c'est qu'il n'ya a pas eu d'erreurs : on peut donc renvohyer le chemin.
	// 	Faire le chemin inverse pour retrouver le path
	var Chemin:Array=new Array();
	CurPoint=Arrivee;
	i=0;
	//Trace(OpenList_Map[17][7].Parent.x+"?"+OpenList_Map[17][7].Parent.y);
	Chemin.push(Arrivee);
	do
	{
		i++;
		CurPoint=OpenList_Map[CurPoint.x][CurPoint.y].Parent;
		Chemin.push(CurPoint);
		//Trace(CurPoint.x+"?"+CurPoint.y);
	}
	while(!(CurPoint.x==Depart.x && CurPoint.y==Depart.y) && i<PATHFINDING_LIMITE);
	Chemin.push(Depart);
	Chemin.reverse(); //Remettre dans le bon ordre...
	return Chemin;

	//Et c'est terminé !
}
