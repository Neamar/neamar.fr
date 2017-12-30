function ChargerProgression():void
{
	var request:URLRequest = new URLRequest("http://neamar.fr/Res/AGraphe/GetProfile.php");
// 	sendToURL(request);
}

function EnregistrerProgression():void
{
	//Enregistrer la progression
	var request:URLRequest = new URLRequest("http://neamar.fr/Res/AGraphe/ChangeProfile.php?LVL="+NumeroNiveauUnlockes);
// 	sendToURL(request);
}


