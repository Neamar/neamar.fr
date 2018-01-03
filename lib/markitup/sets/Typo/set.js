// ----------------------------------------------------------------------------
// markItUp!
// ----------------------------------------------------------------------------
// Copyright (C) 2008 Jay Salvat
// http://markitup.jaysalvat.com/
// ----------------------------------------------------------------------------
// Html tags
// http://neamar.fr/Res/Typographe/Aide/
// ----------------------------------------------------------------------------

TypoSettings = {
	onTab:{keepDefault:false, replaceWith:'    '},
	afterInsert:majHelp,
	markupSet:  [
		{name:'Important', className:'typo_gras', key:'B', openWith:'\\b{', closeWith:'}', placeHolder:'texte en gras' },
		{name:'Emphase', className:'typo_italique', key:'I', openWith:'\\i{', closeWith:'}', placeHolder:'texte en italique'  },
		{name:'Couleurs', className:'typo_couleurs', openWith:'\\color[[![Couleur CSS]!]]{', closeWith:'}', dropMenu: [
			{name:'Bleu', className:'typo_couleur_bleu', openWith:'\\color[blue]{', closeWith:'}'  },
			{name:'Orange', className:'typo_couleur_orange', openWith:'\\color[orange]{', closeWith:'}'  },
			{name:'Vert', className:'typo_couleur_vert', openWith:'\\color[green]{', closeWith:'}'  },
			{name:'Jaune', className:'typo_couleur_jaune', openWith:'\\color[yellow]{', closeWith:'}'  },
			{name:'Rose', className:'typo_couleur_rose', openWith:'\\color[pink]{', closeWith:'}'  },
			{name:'Violet', className:'typo_couleur_violet', openWith:'\\color[purple]{', closeWith:'}'  },
			{name:'Rouge', className:'typo_couleur_rouge', openWith:'\\color[red]{', closeWith:'}'  },
		]},
		{name:'Mise en forme', className:'typo_MEF', dropMenu :[
		{name:'Taille', className:'typo_tailles', dropMenu :[
				{name:'Gros', className:'typo_gros', key:'G', openWith:'\\big{', closeWith:'}' },
				{name:'Petit', className:'typo_petit', openWith:'\\small{', closeWith:'}' }
			]},
			{name:'Sans-Serif', className:'typo_ss', openWith:'\\textss{', closeWith:'}'},
			{name:'MonoSpace', className:'typo_ms', openWith:'\\textms{', closeWith:'}' },
			{name:'Exposant', className:'typo_exposant', openWith:'\\up{', closeWith:'}'},
			{name:'Indice', className:'typo_indice', openWith:'\\down{', closeWith:'}' },
			{name:'Abréviation', className:'typo_abreviation', openWith:'\\abrev[[![Signification de l\'abréviation :]!]]{', closeWith:'}'},
			{name:'Acronyme', className:'typo_acronyme', openWith:'\\acronym[[![Signification de l\'acronyme :]!]]{', closeWith:'}' },
		]},

		{name:'Chapitrage', className:'typo_introsection', dropMenu: [
			{name:'Titre principal', className:'typo_section', openWith:'\\section{', closeWith:'}'  },
			{name:'Titre', className:'typo_subsection', openWith:'\\subsection{', closeWith:'}'  },
			{name:'Sous Titre', className:'typo_subsubsection', openWith:'\\subsubsection{', closeWith:'}'  },
		]},

		{name:'Citation courte', className:'typo_quote', key:'Q', openWith:'\\quote{', closeWith:'}' },
		{name:'Siècle', className:'typo_century', openWith:'\\century{', closeWith:'}' },
		{name:'Note de bas de page', className:'typo_footnote', openWith:'\\footnote{', closeWith:'}', placeHolder:'note à décaler en bas de page' },
		{name:'Mathématiques', className:'typo_mathematiques', openWith:'$', closeWith:'$', placeHolder:'formule LaTeX' },

		{separator:'---------------' },

		{name:'Image', className:'typo_image', key:'P', openWith:'\\image[[![Description de l\'image:!:]!]]{', closeWith:'}', placeHolder:'http://adresse.com/image.jpg'},
		{name:'Lien', className:'typo_lien', key:'L', openWith:'\\l[[![Adresse du lien:!:http://]!]]{', closeWith:'}', placeHolder:'texte du lien' },

		{separator:'---------------' },

		{name:'Liste simple', className:'typo_item', replaceWith:makeItems},

		{separator:'---------------' },

		{name:'Plus d\'options', className:'typo_plus', dropMenu: [
			{name:'Séparateurs', className:'typo_trait', dropMenu: [
				{name:'Trait court', className:'typo_trait_court', replaceWith:'~' },
				{name:'Trait', className:'typo_trait', replaceWith:'~~~' }
			]},
			{name:'Texte protégé', className:'typo_verbatim', openWith:'\\verbatim{', closeWith:'}' },
			{name:'Typographie', className:'typo_typographie', dropMenu: [
				{name:'Accentuation', dropMenu: [
					{name:'À', replaceWith:'À' },
					{name:'É', replaceWith:'É' },
					{name:'È', replaceWith:'È' },
					{name:'Ê', replaceWith:'Ê' },
					{name:'Ô', replaceWith:'Ô' },
	 				{name:'Ç', replaceWith:'Ç' },
				]},
				{name:'Ponctuation', dropMenu: [
					{name:'Tiret demi-cadratin', replaceWith:'--' },
					{name:'Tiret cadratin', replaceWith:'---' },
				]},
				{name:'Ligatures', dropMenu: [
					{name:'OE', replaceWith:'\\OE' },
					{name:'&OElig; (automatique)', replaceWith:'OE' },
					{name:'AE', replaceWith:'\\AE' },
					{name:'&AElig; (automatique)', replaceWith:'AE' },
					{name:'oe', replaceWith:'\\oe' },
					{name:'&oelig; (automatique)', replaceWith:'oe' },
					{name:'ae', replaceWith:'\\ae' },
					{name:'&aelig; (automatique)', replaceWith:'ae' },
				]},
				{name:'Guillemets', dropMenu: [
					{name:'« ... »', openWith:'"', closeWith:'"'},
					{name:'&ldquo;...&rdquo;', openWith:'"\'', closeWith:'\'"'},
				]},
				{name:'Espace insécable', replaceWith:'&nbsp;' },
				{name:'Césure optionnelle', replaceWith:'&shy;' }
			]}
		]},

		{separator:'---------------' },

		{name:'Environnements', className:'typo_environnements', dropMenu: [
			{name:'Listes', className:'typo_itemize', dropMenu: [
				{name:'Non numérotée', replaceWith:makeItemize},
				{name:'Numérotée', className:'typo_enumerate', replaceWith:makeEnumerate},
				{name:'Élément', className:'typo_li', openWith:'\\li '}
			]},
			{name:'Données', className:'typo_itemize', dropMenu: [
				{name:'Graphique', className:'typo_chart', openWith:'\\begin{chart}\n', closeWith:'\n\\end{chart}\n'},
				{name:'Tableau', className:'typo_table', openWith:'\\begin{tabular}\n', closeWith:'\n\\end{tabular}\n'},
				{name:'Dialogue', className:'typo_quote', openWith:'\\begin{dialog}\n', closeWith:'\n\\end{dialog}\n'},
			]},
			{name:'Formatage', className:'typo_formatage', dropMenu: [
				{name:'Colonnes', className:'typo_column', openWith:'\\begin[[![Nombre de colonnes:!:2]!]]{column}\n', closeWith:'\n\\end{column}\n'},
				{name:'Citation longue', className:'typo_quote', openWith:'\\begin[[![Auteur de la citation (vide si non pertinent):!:]!]]{quote}\n', closeWith:'\n\\end{quote}\n'},
				{name:'Sans modifications', className:'typo_verbatim', openWith:'\\begin{verbatim}\n', closeWith:'\n\\end{verbatim}\n'},
				{name:'Code source', className:'typo_code', openWith:'\\begin[[![Langage:!:php]!]]{code}\n', closeWith:'\n\\end{code}\n'},
				{name:'Texte indenté', className:'typo_indente', openWith:'\\begin{indented}\n', closeWith:'\n\\end{indented}\n'},
				{name:'Mathématiques', className:'typo_mathematiques', openWith:'\n$$ ', closeWith:' $$\n'},
			]},
			{name:'Préparseur', className:'typo_preparser', dropMenu: [
				{name:'Remplacements', className:'typo_replace', replaceWith:'{{[REPLACE|[![Terme cherché:!:]!]|[![Remplacer par:!:]!]]}}\n'},
				{name:'Remplacements++', className:'typo_replacepp', replaceWith:'{{[REG-REPLACE|[![Expression régulière recherchée:!:]!]|[![Remplacer par:!:]!]]}}\n'},
			]},
		]},
		{name:'À l\'aide !', className:'typo_help', call:'afficherHelp'},
		{name:'Preview', className:'typo_preview',  replaceWith:typo_preview}
	]
}

function majHelp(b)
{
	var NonPertinents=['typo_help','typo_plus','typo_preview'];
	if(b.className && $.inArray(b.className,NonPertinents)==-1)
	{
		var Balise=b.className.replace('typo_','').replace('_',' ');

		$('.typo_help a').addClass('typo_visible');
		$('.typo_help a').html('Aide : <a target="_blank" id="typo_goto_help" style="display:inline; background:none; color:blue;" href="https://neamar.fr/Res/Typographe/Aide/?b=' + Balise + '">' + Balise + '</a>');
	}
}

function afficherHelp(b)
{
	if(document.getElementById('typo_goto_help'))
		window.open(document.getElementById('typo_goto_help').href);
	else
		window.open('https://neamar.fr/Res/Typographe/Aide/');
}

function makeItems(h)
{
	var Retour='';
	if(h.selection && h.selection!='')
		Retour = '\\item ' + h.selection + '\n';

	while(item=prompt("Élément de liste suivant (annuler pour arrêter)",""))
		Retour +='\\item ' + item + "\n";
	return Retour;
}

function makeList(Type,h)
{
	var Retour='\\begin{' + Type + '}\n';
	Retour +=makeItems(h).replace(/\\item /g,'\\li ');
	Retour += '\\end{' + Type + '}\n';

	return Retour;
}
function makeItemize(h)
{
	return makeList('itemize',h);
}

function makeEnumerate(h)
{
	return makeList('enumerate',h);
}

function typo_preview(h)
{
	if(Previews[h.textarea.id])
		showPreview(Previews[h.textarea.id][1],Previews[h.textarea.id][0],h.textarea.value);
	else
	{
		alert("Désolé, l'aperçu n'a pas été configuré sur cette instance du Typographe.");
		$('.typo_preview').remove();
	}
	return h.selection;
}

function showPreview(ID,URL_Apercu,Datas)
{
	var xhr;
	try {  xhr = new ActiveXObject('Msxml2.XMLHTTP');   }
	catch (e)
	{
		try {   xhr = new ActiveXObject('Microsoft.XMLHTTP');    }
		catch (e2)
		{
			try {  xhr = new XMLHttpRequest();     }
			catch (e3) {  xhr = false;   }
		}
	}

	xhr.onreadystatechange  = function()
	{
		if(xhr.readyState  == 4)
		document.getElementById(ID).innerHTML=xhr.responseText;
	};

	xhr.open('Post',URL_Apercu,  true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	Datas=encodeURIComponent(Datas);
	xhr.send('Texte='+Datas);
}
