window.onload= function(){
CreerSommaire();
if(document.getElementById('Relations'))
	GererRelation();

var Ancre=document.location.toString().substring(document.location.toString().lastIndexOf("#"));
if(document.location.toString().indexOf("#") != -1 && Ancre!='')
	document.location.hash= Ancre//Si il y a une ancre dans l'URL, la charger.
};

function CreerSommaire()
{//Génére une table des matières à gauche.
	if (document.getElementsByClassName == undefined)
	{
		document.getElementsByClassName = function(className)
		{
			var hasClassName = new RegExp("(?:^|\\s)" + className + "(?:$|\\s)");
			var allElements = document.getElementsByTagName("*");
			var results = [];

			var element;
			for (var i = 0; (element = allElements[i]) != null; i++)
			{
				var elementClass = element.className;
				if (elementClass && elementClass.indexOf(className) != -1 && hasClassName.test(elementClass))
					results.push(element);
			}
			return results;
		}
	}

	function URLWord(Mot)
	{//Prend un texte en paramètre, et ne renvoie que les caractères valides pour une URL
		return Mot.replace(/[^a-z0-9éèê]/gi,"_");
	}
	function Array_Add(a,b)
	{//Prend en paramètre deux array, renvoie un array qui contient tous les éléments de a et b
		var Resultat=a;
		for(var j=0;j<b.length;j++)
			Resultat.push(b[j]);
		return Resultat;
	}
	function Trieur(a,b)
	{
		if(a.offsetTop<b.offsetTop)
			return -1;
		else
			return 1;
	}
	var TOCs=document.getElementsByClassName('TOC')
	var Contenu="";

	//Le titre global du document.
	var Titre=document.getElementById('Main').getElementsByTagName("h1")[0].innerHTML;
	document.getElementsByTagName("h1")[0].id=URLWord(Titre);
	Contenu="<h1 onclick=\"document.location='#"+URLWord(Titre)+"';\">"+Titre+"</h1>";



	var Titres=new Array();

	Titres=Array_Add(Titres,document.getElementById('Main').getElementsByTagName("h2"));
	Titres=Array_Add(Titres,document.getElementById('Main').getElementsByTagName("h3"));
	Titres=Array_Add(Titres,document.getElementById('Main').getElementsByTagName("h4"));

	Titres.sort(Trieur);

	//Les sous titres et sous sous titres (en gérant l'ordre)
	for(var i=0;i<Titres.length;i++)
	{
		if(!Titres[i].parentNode.nodeName || Titres[i].parentNode.nodeName=='DIV')
		{
			Contenu+="<"+Titres[i].tagName+" onclick=\"document.location='#"+URLWord(Titres[i].innerHTML)+"';\">"+Titres[i].innerHTML+"</"+Titres[i].tagName+">";
			Titres[i].id=URLWord(Titres[i].innerHTML);
		}
	}

	for(var i=0;i<TOCs.length;i++)
		TOCs[i].innerHTML=Contenu;

	return Contenu;
}

function GererRelation()
{
	//Faire le lien entre les relations de fin de page et la liste finale. (les petits 1 et 2 mis en puissance)
	var Doc=document.getElementById('Relations').getElementsByTagName("li");
	var Ref=document.getElementById('Main').getElementsByTagName("sup");
	for(var i=0;i<Ref.length;i++)
	{
		Ref[i].id="Reference-"+i;
		Ref[i].innerHTML='<a href="#Documentation-'+i+'" title="' + Doc[i].innerHTML + '">'+Ref[i].innerHTML+'</a>';
		Doc[i].id="Documentation-"+i;
		Doc[i].innerHTML='<a href="#Reference-'+i+'" title="Aller à la réference correspondante">'+Doc[i].innerHTML+'</a>';
	}
}
