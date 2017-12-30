<?php
class TEX_Block
{
	// Déclarations des données membres
	public $T_rawContent;
	public $T_Content=array();

	//Le constructeur
	public function __construct($Content)
	{
		$this->T_rawContent=$Content;
		$this->ParseRawContent();
	}

/////////////////////

//FONCTIONS PUBLIQUES

/////////////////////

	public function ParseRawContent()
	{//transformer le contenu textuel en contenu DOM manipulable.


  		preg_match_all('#\\\begin\{(.+)\}(.+)\\\end\{(.+)}#misU',$this->T_rawContent,$Blocks,PREG_SET_ORDER);
 		print_r($Blocks);
// 		foreach($Heads as $Head)
// 		{
// 			$this->T_Header[$Head[1]]=$Head[4];
// 			$this->T_Header_Flags[$Head[1]]=$Head[3];
// 		}

// 		$len=strlen($this->T_rawContent);
// 		$IsWritingCommand=false;
// 		$CommandName='';
// 		$NestingLevel=0;
//
// 		for($i=0;$i<$len;$i++)
// 		{
// 			$Char=$this->T_rawContent[$i];
//
// 			if($IsWritingCommand && $Char=="\n")//Il s'agit d'une commande sans arguments
// 			{
// 				echo $CommandName;
// 				$CommandName='';
// 				$IsWritingCommand=false;
// 			}
//
// 			if($IsWritingCommand)//On est en train de lire une commande
// 				$CommandName .= $Char;
//
//
// 			if($Char=='\\' && $CommandName=='')//Une nouvelle commande vient d'être trouvée
// 			{
// 				echo $Char;
// 				$IsWritingCommand=true;
// 				$CommandName='';
// 			}
//
// 			if($Char=='{' && !$IsWritingCommand)//Une nouvelle accolade a été vue à l'intérieur de la commande : retenir de ne pas tenir compte d'une paire d'accolade supplémentaire.
// 				$NestingLevel++;
// 			if($Char=='}')
// 				$NestingLevel--;
//
// 			if($Char=='}' && $NestingLevel==0)//Une accolade fermante a été trouvée et elle correspond à celle utilisée en  début de commande.
// 			{
// 				$IsWritingCommand=false;
// 				echo $CommandName;
// 			}
// 		}


	}


/////////////////////

//FONCTIONS PRIVÉES

/////////////////////

	//Ajouter un chapitre :
	private function AddChapter($Titre)
	{
	}
}
?>
