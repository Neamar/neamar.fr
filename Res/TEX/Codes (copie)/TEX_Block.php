<?php
class TEX_Block
{
	// D�clarations des donn�es membres
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
// 			if($Char=='\\' && $CommandName=='')//Une nouvelle commande vient d'�tre trouv�e
// 			{
// 				echo $Char;
// 				$IsWritingCommand=true;
// 				$CommandName='';
// 			}
//
// 			if($Char=='{' && !$IsWritingCommand)//Une nouvelle accolade a �t� vue � l'int�rieur de la commande : retenir de ne pas tenir compte d'une paire d'accolade suppl�mentaire.
// 				$NestingLevel++;
// 			if($Char=='}')
// 				$NestingLevel--;
//
// 			if($Char=='}' && $NestingLevel==0)//Une accolade fermante a �t� trouv�e et elle correspond � celle utilis�e en  d�but de commande.
// 			{
// 				$IsWritingCommand=false;
// 				echo $CommandName;
// 			}
// 		}


	}


/////////////////////

//FONCTIONS PRIV�ES

/////////////////////

	//Ajouter un chapitre :
	private function AddChapter($Titre)
	{
	}
}
?>
