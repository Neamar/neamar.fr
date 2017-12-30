<?php
class TEX_Translater
{
	// Déclarations des données membres
	public $T_rawContent;
	public $Parent;
	public $Erreurs=array();

	//Le constructeur
	public function __construct($Content,$Parent)
	{
		$this->Parent=$Parent;
		$this->T_rawContent=$Content;
		$this->ParseEnvContent();//Les \begin
		$this->ParseMathContent();//Les maths
		$this->ParseInNoContent();//Les commandes sans contenu, e.g \maketitle
		$this->ParseInContent();//

		$this->RenderMathContent();//Remettre les maths !


// 		print_r($GLOBALS['Math']);
		echo '<hr />' . $this->T_rawContent;
	}

/////////////////////

//FONCTIONS PUBLIQUES

/////////////////////

	public function ParseEnvContent()
	{//Transformer les environnements.
		function Remplacement_Env($Texte)
		{//$Texte est de la forme Array(
		//1=>Nom de la commande
		//2=>Contenu de la commande
			static $Environnements = array
				(//Les environnements spéciaux qui ne peuvent pas être obtenus par une simple propriété CSS:
				'abstract'		=> '<div class="abstract"><p class="abstract_title">Résumé</p><p>$2</p></div>',
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
	{//Transformer les mathématiques, qui contiendraient sinon plein de commandes inexploitables
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
					$this->Erreurs[]='Attention, la commande à contenu ' . $CommandName . ' n\'est pas définie.';
					$this->T_rawContent=str_replace('\\' . $CommandName, '<span class="erreur">#Balise à contenu inconnue : ' . $CommandName . '#</span>',$this->T_rawContent);
				}
			}
			else
			{
					$this->Erreurs[]='Attention, la commande sans arguments ' . $CommandName . ' n\'est pas définie.';
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
	{//Trouver l'accolade fermante associée à une certaine parenthèse
	//La méthode avec strpos ne fonctionne pas si l'on a imbrication de parenthèes, e.g (1+5(1+3)+2)
		if($Chaine[$Start] != '{')
			echo 'ATTENTION ! Le caractère de départ n\'est pas une accolade.';

		$Fermante=$this->FindClosingBrace(substr($Chaine,$Start));
		return substr($Chaine,$Start+1,$Fermante-2);
	}

	private function FindClosingBrace($Chaine)
	{//Trouver l'accolade fermante associée à une certaine parenthèse
	//La méthode avec strpos ne fonctionne pas si l'on a imbrication de parenthèes, e.g (1+5(1+3)+2)
		$NestedLevel = 1;
		$Len=strlen($Chaine);
		for($i = 1;$i<$Len;$i++)//On commence à 1 pour ne pas compter la première accolade ouvrante.
		{
			$Char = $Chaine[$i];
			if($Char=="{")
				$NestedLevel++; //A chaque fois qu'on rencontre une {, on dit qu'il faudra une ) de plus avant de sortir
			if($Char=="}")
					$NestedLevel--;
			if($NestedLevel== 0)
				break;
		}
		//Quand on sort, c'est qu'on a la parenthèse...ou qu'elle n'existe pas !
		return $i + 1;
	}
}
?>
