<?php
class TEX_Ressource
{
	// Déclarations des données membres
	private $T_rawHeader='';
	public $T_Header=array
		(
		'title'=>'TEX Article',
		'author'=>'',
		'date'=>"Aujourd'hui"//Si la date n'est pas précisée, utiliser la date courante.
		);
	private $T_Header_Flags=array();

	private $T_rawBody='';
	private $T_Body;

	//Le constructeur
	public function __construct($Texte)
	{
		preg_match("#^(.+)\\\begin\{document\}(.+)\\\end\{document\}#isU",$Texte,$Cut);
 		$this->T_rawHeader=$Cut[1];
		$this->T_rawBody=$Cut[2];

		//Récupérer les données d'en tête de facon convenable (en array) :
		$this->GetHeader();

		$this->T_Body=new TEX_Translater($this->T_rawBody,$this);
	}

/////////////////////

//FONCTIONS PUBLIQUES

/////////////////////



/////////////////////

//FONCTIONS PRIVÉES

/////////////////////

	private function GetHeader()
	{//Récupére toutes les informations d'en tête disponible à l'intérieur du document.
		//Transforme \usepackage[french]{babel} en
// 		Array
//         (
//             [0] => \usepackage[french]{babel}
//             [1] => usepackage
//             [2] => [french]
//             [3] => french
//             [4] => babel
//         )

		preg_match_all('#\\\(.+)(\[(.+)\])?\{(.+)\}#misU',$this->T_rawHeader,$Heads,PREG_SET_ORDER);
		foreach($Heads as $Head)
		{
			$this->T_Header[$Head[1]]=$Head[4];
			$this->T_Header_Flags[$Head[1]]=$Head[3];
		}
	}

}
?>
