<?php
class TEX_Translater
{
	// D�clarations des donn�es membres
	public $Parent;
	public $Erreurs=array();

	public $TEXText;
	public $T_Content;
	public $HTMLText;


	//Le constructeur
	public function __construct($Content,$Parent)
	{
		$this->Parent=$Parent;
		$this->TEXText=$Content;

		$Content=str_replace("\r",'',$Content);
		$this->T_Content=explode("\n",$Content);
		$this->ParseBlock();
		$this->ParseInline();
	}

/////////////////////

//FONCTIONS PUBLIQUES

/////////////////////
	private function ParseBlock()
	{
		function FermeParagraphe($texte)
		{
			if(substr($texte,strlen($texte)-7,6)=='<br />');
			$texte=substr($texte,0,strlen($texte)-7);
			$texte .= '</p>' . "\n\n";
			return $texte;
		}
// 		include('Codes/TEX_Block.php');

		$texte='<p>';
		$parOpen=true;
		$firstLine=true;
		foreach($this->T_Content as $Ligne)
		{
			if(preg_match('#\\\\section{(.+)}#sU',$Ligne,$titre))
			{
				if($firstLine)
					$texte='';//Si �a commence par un titre, pas de paragraphes avant. (on r�gle le $parOpen juste apr�s)
				elseif($parOpen)
					$texte=FermeParagraphe($texte);

				$texte .='<h2>' . $titre[1] . '</h2>';
				$parOpen=false;
			}
			elseif(preg_match('#\\$\\$(.+)\\$\\$#sU',$Ligne,$Math))
			{
				if($parOpen)
					$texte=FermeParagraphe($texte);
				$texte .='<p class="block_math"><math>' . $Math[1] . '</math></p>';
				$parOpen=false;
			}
			else
			{
				if($Ligne!='' && !$parOpen)
				{
					$texte .='<p>';
					$parOpen=true;
				}
				elseif(($Ligne=='' || $Ligne=="\r") && $parOpen)
				{
					$texte=FermeParagraphe($texte);
					$parOpen=false;
				}

				if($parOpen)
					$texte .=$Ligne . '<br />' . "\n";
			}

			$firstLine=false;
		}
		if($parOpen)
			$texte=FermeParagraphe($texte);//Fermer le dernier paragraphe.
		$this->HTMLText=$texte;
	}

	private function ParseInline()
	{
		include('Codes/TEX_Inline.php');//Charger les balises inline$Inline
		$this->HTMLText=preg_replace(array_keys($Inline),array_values($Inline),$this->HTMLText);
	}





















	public function ParseEnvContent()
	{//Transformer les environnements.
		function Remplacement_Env($Texte)
		{//$Texte est de la forme Array(
		//1=>Nom de la commande
		//2=>Contenu de la commande
			static $Environnements = array
				(//Les environnements sp�ciaux qui ne peuvent pas �tre obtenus par une simple propri�t� CSS:
				'abstract'		=> '<div class="abstract"><p class="abstract_title">R�sum�</p><p>$2</p></div>',
				'itemize'		=> '<ul>$1</ul>',
				'numerize'		=> '<ol>$1</ol>'
				);
			if(array_key_exists($Texte[1],$Environnements))
				return str_replace('$2',$Texte[2],$Environnements[$Texte[1]]);
			else
				return '<div class="' . $Texte[1] . '"><p>' . $Texte[2] . '</p></div>';
		}
		$this->T_rawContent=preg_replace_callback('#\\\begin\{(.+)\}(.+)\\\end\{\1}#misU',Remplacement_Env,$this->T_rawContent);
	}

	public function ParseMathContent()
	{//Transformer les math�matiques, qui contiendraient sinon plein de commandes inexploitables
		function Remplacement_Display_Math($Texte)
		{//$Texte est de la forme Array()
			$GLOBALS['DisplayMath'][]=$Texte[1];
			return '@MATH_IMG_DISPLAY(' . count($GLOBALS['DisplayMath']) . ')@';
		}
		function Remplacement_Math($Texte)
		{//$Texte est de la forme Array()
			$GLOBALS['Math'][]=$Texte[1];
			return '@MATH_IMG(' . count($GLOBALS['Math']) . ')@';
		}
		$this->T_rawContent=preg_replace_callback('#\$\$(.+)\$\$#iU',Remplacement_Display_Math,$this->T_rawContent);
		$this->T_rawContent=preg_replace_callback('#\$(.+)\$#isU',Remplacement_Math,$this->T_rawContent);
	}

	public function ParseInNoContent()
	{//Transformer les environnements.
		include 'In_Balises.php';
		foreach($lBalises as $BaliseTEX => $BaliseHTML)
		{
			$this->T_rawContent=str_replace($BaliseTEX,$BaliseHTML,$this->T_rawContent);
		}
	}

	public function ParseInContent()
	{//Transformer les environnements.
		include 'In_Balises_Content.php';
		do
		{
		$Offset=strpos($this->T_rawContent,'\\');
		if($Offset!==false)
		{
			$EndCommandName=strpos($this->T_rawContent,'{',$Offset);
			$EndLine=strpos($this->T_rawContent,"\n",$Offset);
			$CommandName = substr($this->T_rawContent,$Offset+1,min($EndCommandName,$EndLine)-$Offset-1);

			if($EndCommandName!==false && $EndCommandName < $EndLine)
			{
				$CommandContent=$this->GetBlock($this->T_rawContent,$EndCommandName);

				if(array_key_exists($CommandName,$Balises))
					$this->T_rawContent=str_replace('\\' . $CommandName . '{' . $CommandContent . '}', str_replace('$1',$CommandContent,$Balises[$CommandName]),$this->T_rawContent);
				else
				{
					$this->Erreurs[]='Attention, la commande � contenu ' . $CommandName . ' n\'est pas d�finie.';
					$this->T_rawContent=str_replace('\\' . $CommandName, '<span class="erreur">#Balise � contenu inconnue : ' . $CommandName . '#</span>',$this->T_rawContent);
				}
			}
			else
			{
					$this->Erreurs[]='Attention, la commande sans arguments ' . $CommandName . ' n\'est pas d�finie.';
					$this->T_rawContent=str_replace('\\' . $CommandName, '<span class="erreur">#Balise inconnue : ' . $CommandName . '#</span>',$this->T_rawContent);
			}
		}
		} while($Offset!==false);
	}

	public function RenderMathContent()
	{
		function Remplacement_Display_Math2($Texte)
		{//$Texte est de la forme Array()
			return '<p class="centre no_lettrine"><math>' . $GLOBALS['DisplayMath'][$Texte[1]-1] . '</math></p>';
		}
		function Remplacement_Math2($Texte)
		{//$Texte est de la forme Array()
			return '<math>' . $GLOBALS['Math'][$Texte[1]-1] . '</math>';
		}
		$this->T_rawContent=preg_replace_callback('#@MATH_IMG_DISPLAY\(([0-9]+)\)@#iU',Remplacement_Display_Math2,$this->T_rawContent);
		$this->T_rawContent=preg_replace_callback('#@MATH_IMG\(([0-9]+)\)@#iU',Remplacement_Math2,$this->T_rawContent);
	}

/////////////////////

//FONCTIONS PRIVEES

/////////////////////

	private function GetBlock($Chaine,$Start)
	{//Trouver l'accolade fermante associ�e � une certaine parenth�se
	//La m�thode avec strpos ne fonctionne pas si l'on a imbrication de parenth�es, e.g (1+5(1+3)+2)
		if($Chaine[$Start] != '{')
			echo 'ATTENTION ! Le caract�re de d�part n\'est pas une accolade.';

		$Fermante=$this->FindClosingBrace(substr($Chaine,$Start));
		return substr($Chaine,$Start+1,$Fermante-2);
	}

	private function FindClosingBrace($Chaine)
	{//Trouver l'accolade fermante associ�e � une certaine parenth�se
	//La m�thode avec strpos ne fonctionne pas si l'on a imbrication de parenth�es, e.g (1+5(1+3)+2)
		$NestedLevel = 1;
		$Len=strlen($Chaine);
		for($i = 1;$i<$Len;$i++)//On commence � 1 pour ne pas compter la premi�re accolade ouvrante.
		{
			$Char = $Chaine[$i];
			if($Char=="{")
				$NestedLevel++; //A chaque fois qu'on rencontre une {, on dit qu'il faudra une ) de plus avant de sortir
			if($Char=="}")
					$NestedLevel--;
			if($NestedLevel== 0)
				break;
		}
		//Quand on sort, c'est qu'on a la parenth�se...ou qu'elle n'existe pas !
		return $i + 1;
	}
}
?>
