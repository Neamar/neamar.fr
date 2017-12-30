<h1>Code source de TXT2JPG</h1>
<h2>Avant de commencer</h2>
<h3>A propos...</h3>
<p><img src="Images/VB6.png" alt="Visual Basic 6" />TXT2JPG est un logiciel permettant de lire du texte sur n'importe quel baladeur affichant des images. Vous trouverez plus d'informations au sujet de ce logiciel sur <a href="http://neamar.free.fr/txt2jpg">le site du projet</a>.<br />
Cette page sert uniquement à l'affichage et au téléchargement du code. Si vous n'êtes pas programmeur (ou simplement curieux), vous pouvez passer votre chemin !</p>
<p>Le logiciel a été programmé à l'aide de l'ancien éditeur de BASIC de Microsoft, Visual Basic 6.0 (dernière version apparue avant l'avénement de l'architecture .NET).<br />
En conséquent, le code utilise le BASIC, mais aussi les APIs mises à disposition par Windows, et les possibilités de création de contrôles.</p>

<h3>Licence</h3>
<p>Ce code est fourni sous la licence <a href="http://creativecommons.org/licenses/by/3.0/deed.fr" rel="nofollow">Creative Commons BY</a></p>
<p>Cela signifie grossièrement :</p>
<ul>
<li>Vous êtes libres :
<ul>
<li>de reproduire, distribuer et communiquer cette création au public</li>
<li>de modifier cette création</li>
</ul>

</li>
<li>Selon les conditions suivantes :
<ul>
<li><strong>Paternité</strong>. Vous devez citer le nom de l'auteur original de la manière indiquée par l'auteur de l'oeuvre ou le titulaire des droits qui vous confère cette autorisation (mais pas d'une manière qui suggérerait qu'ils vous soutiennent ou approuvent votre utilisation de l'oeuvre).</li>
</ul>
</li>
</ul>
<p><span class="petitTexte">Ceci n'est qu'un résumé de la licence, l'ensemble du texte juridique peut être trouvé en suivant le lien ci-dessus.</span></p>
<h2>Téléchargement</h2>
<p class="erreur">L'ensemble du code, des images et des fichiers associés peut être téléchargé ici : <a href="Release/TXT2JPG.zip">Zip du projet</a>.<br />

Cette archive contient aussi les anciennes versions des fichiers EXE de TXT2JPG, ainsi que les modules (Degrade, Convert PowerPoint)<br />
Attention, l'ensemble pèse plus de 6Mo.</p>

<h2>Visionnage du code source</h2>
<p><img src="Images/Arborescence.png" alt="L'arborescence du projet"/>Si vous souhaitez juste visionner le code pour satisfaire votre curiosité, cette section devrait vous plaire !<br />
Attention, le projet représente tout de même près de 3 000 lignes de code !</p>
<p>L'ensemble du code est très fortement commenté (près de 40%), et vous devriez pouvoir le comprendre sans difficulté.<br />
En revanche, les contrôles ne sont pas du tout commentés...mais ils respectent la même structure que n'importe quel contrôle VB, et vous ne devriez donc pas avoir de problèmes pour leur compréhension si vous êtes familier des notions abordées.</p>
<h3>La feuille principale</h3>

<p class="centre"><img src="Images/Form.png" alt="La feuille de travail" class="nonflottant petit" /></p>
<p>Seul le code de la feuille est présenté ici, le placement des contrôles ne présentant pas d'intêret. (vous le trouverez dans le zip)</p>
<fieldset>
<legend>Code source : <a href="Codes/Feuille.frm" title="Télecharger le fichier">Feuille.frm</a></legend>
<div class="vb" style="font-family: monospace;"><div class="head"><ul><li>Langage : <em>vb</em></li><li>&Delta;T : <em>3.824s</em></li><li>Taille :117839 caractères</li></ul></div><br />
<span class="co1">'--------------------------------------------------------------------------------</span><br />
<span class="co1">' &nbsp; &nbsp;Component &nbsp;: Principale</span><br />

<span class="co1">' &nbsp; &nbsp;Project &nbsp; &nbsp;: TXT2JPG</span><br />
<span class="co1">'</span><br />
<span class="co1">' &nbsp; &nbsp;Description: LA feuille principale de TXT2JPG, contient tout les controles</span><br />
<span class="co1">'Your life is yours alone. Rise up and live it !</span><br />
<span class="co1">'Nothing is ever easy</span><br />
<span class="co1">'</span><br />

<span class="co1">' &nbsp; &nbsp;Modified &nbsp; :</span><br />
<span class="co1">'--------------------------------------------------------------------------------</span><br />
<br />
<span class="kw1">Option</span> <span class="kw1">Explicit</span><br />
<br />
<span class="co1">'Graphismes</span><br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> GetDC Lib <span class="st0">&quot;user32&quot;</span> <span class="br0">&#40;</span>ByVal hwnd <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> GetPixel Lib <span class="st0">&quot;gdi32&quot;</span> <span class="br0">&#40;</span>ByVal hdc <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal X <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal Y <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> StretchBlt Lib <span class="st0">&quot;gdi32&quot;</span> <span class="br0">&#40;</span>ByVal hdc <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal X <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal Y <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal nWidth <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal nHeight <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal hSrcDC <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal xSrc <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal ySrc <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal nSrcWidth <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal nSrcHeight <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal dwRop <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> BitBlt Lib <span class="st0">&quot;gdi32&quot;</span> <span class="br0">&#40;</span>ByVal hDestDC <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal X <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal Y <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal nWidth <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal nHeight <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal hSrcDC <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal xSrc <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal ySrc <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal dwRop <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> TransparentBlt Lib <span class="st0">&quot;msimg32.dll&quot;</span> <span class="br0">&#40;</span>ByVal hDestDC <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal X <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal Y <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal nWidth <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal nHeight <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal hSrcDC <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal xSrc <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal ySrc <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal nWidthSrc <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal nHeightSrc <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal crTranparent <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> SetPixelV Lib <span class="st0">&quot;gdi32&quot;</span> <span class="br0">&#40;</span>ByVal hdc <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal X <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal Y <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal crColor <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> TextOut Lib <span class="st0">&quot;gdi32&quot;</span> Alias <span class="st0">&quot;TextOutA&quot;</span> <span class="br0">&#40;</span>ByVal hdc <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal X <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal Y <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal lpString <span class="kw1">As</span> <span class="kw1">String</span>, ByVal nCount <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="co1">'Apis de telechargement</span><br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> InternetOpen Lib <span class="st0">&quot;wininet.dll&quot;</span> Alias <span class="st0">&quot;InternetOpenA&quot;</span> <span class="br0">&#40;</span>ByVal sAgent <span class="kw1">As</span> <span class="kw1">String</span>, ByVal lAccessType <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal sProxyName <span class="kw1">As</span> <span class="kw1">String</span>, ByVal sProxyBypass <span class="kw1">As</span> <span class="kw1">String</span>, ByVal lFlags <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> InternetOpenUrl Lib <span class="st0">&quot;wininet.dll&quot;</span> Alias <span class="st0">&quot;InternetOpenUrlA&quot;</span> <span class="br0">&#40;</span>ByVal hOpen <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal sUrl <span class="kw1">As</span> <span class="kw1">String</span>, ByVal sHeaders <span class="kw1">As</span> <span class="kw1">String</span>, ByVal lLength <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal lFlags <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal lContext <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> InternetReadFile Lib <span class="st0">&quot;wininet.dll&quot;</span> <span class="br0">&#40;</span>ByVal hFile <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal sBuffer <span class="kw1">As</span> <span class="kw1">String</span>, ByVal lNumBytesToRead <span class="kw1">As</span> <span class="kw1">Long</span>, lNumberOfBytesRead <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Integer</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> InternetCloseHandle Lib <span class="st0">&quot;wininet.dll&quot;</span> <span class="br0">&#40;</span>ByVal hInet <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Integer</span><br />

<br />
<span class="co1">'Toujours au premier plan/Déplacement de controles</span><br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> SetWindowPos Lib <span class="st0">&quot;user32&quot;</span> <span class="br0">&#40;</span>ByVal hwnd <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal hWndInsertAfter <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal X <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal Y <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal cx <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal cy <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal wFlags <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="co1">'Private Declare Function SetParent Lib &quot;user32&quot; (ByVal hWndChild As Long, ByVal hWndNewParent As Long) As Long</span><br />
<span class="co1">'Convertir en JPG</span><br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> BMP2JPGpourVBFrance Lib <span class="st0">&quot;BMP2JPG.dll&quot;</span> <span class="br0">&#40;</span>ByVal A <span class="kw1">As</span> <span class="kw1">String</span>, ByVal B <span class="kw1">As</span> <span class="kw1">String</span>, ByVal c <span class="kw1">As</span> <span class="kw1">Integer</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Integer</span><br />

<br />
<span class="co1">'Temps</span><br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> GetTickCount Lib <span class="st0">&quot;kernel32&quot;</span> <span class="br0">&#40;</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="co1">'Souris</span><br />
<span class="co1">'Private Declare Function GetCursorPos Lib &quot;user32&quot; (lpPoint As POINTAPI) As Long</span><br />
<span class="co1">'Private Declare Function ScreenToClient Lib &quot;user32&quot; (ByVal hWnd As Long, lpPoint As POINTAPI) As Long</span><br />
<span class="co1">'Private Declare Function ClientToScreen Lib &quot;user32&quot; (ByVal hwnd As Long, lpPoint As POINTAPI) As Long</span><br />

<span class="co1">'Priorités</span><br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> GetCurrentProcess Lib <span class="st0">&quot;kernel32&quot;</span> <span class="br0">&#40;</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />
<br />

<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> SetPriorityClass Lib <span class="st0">&quot;kernel32&quot;</span> <span class="br0">&#40;</span>ByVal hProcess <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal dwPriorityClass <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="co1">'Lancer une utilitaire externe</span><br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> ShellExecute Lib <span class="st0">&quot;shell32.dll&quot;</span> Alias <span class="st0">&quot;ShellExecuteA&quot;</span> <span class="br0">&#40;</span>ByVal hwnd <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal lpOperation <span class="kw1">As</span> <span class="kw1">String</span>, ByVal lpFile <span class="kw1">As</span> <span class="kw1">String</span>, ByVal lpParameters <span class="kw1">As</span> <span class="kw1">String</span>, ByVal lpDirectory <span class="kw1">As</span> <span class="kw1">String</span>, ByVal nShowCmd <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="co1">'Masque le curseur du RTB</span><br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> HideCaret Lib <span class="st0">&quot;user32&quot;</span> <span class="br0">&#40;</span>ByVal hwnd <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="co1">'API pour mettre en mémoire les RGB</span><br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Sub</span> CopyMemory Lib <span class="st0">&quot;kernel32&quot;</span> Alias <span class="st0">&quot;RtlMoveMemory&quot;</span> <span class="br0">&#40;</span>pDst <span class="kw1">As</span> Any, pSrc <span class="kw1">As</span> Any, ByVal ByteLen <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span><br />

<br />
<span class="co1">'APIs pour simuler les mouse out</span><br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> GetCursorPos Lib <span class="st0">&quot;user32&quot;</span> <span class="br0">&#40;</span>lpPoint <span class="kw1">As</span> POINTAPI<span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> WindowFromPoint Lib <span class="st0">&quot;user32&quot;</span> <span class="br0">&#40;</span>ByVal xPoint <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal yPoint <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="co1">'Type pointApi</span><br />
<span class="kw1">Private</span> <span class="kw1">Type</span> POINTAPI<br />
<br />
&nbsp; &nbsp; X <span class="kw1">As</span> <span class="kw1">Long</span><br />

&nbsp; &nbsp; Y <span class="kw1">As</span> <span class="kw1">Long</span><br />
<br />
<span class="kw1">End</span> <span class="kw1">Type</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Type</span> vRGB<br />

<br />
&nbsp; &nbsp; R <span class="kw1">As</span> Byte<br />
&nbsp; &nbsp; G <span class="kw1">As</span> Byte<br />
&nbsp; &nbsp; B <span class="kw1">As</span> Byte<br />

<br />
<span class="kw1">End</span> <span class="kw1">Type</span><br />
<br />
<span class="kw1">Private</span> NotUse <span class="kw1">As</span> <span class="kw1">Boolean</span>, DoNotChange <span class="kw1">As</span> <span class="kw1">Boolean</span>, BG_red <span class="kw1">As</span> <span class="kw1">Long</span>, BG_green <span class="kw1">As</span> <span class="kw1">Long</span>, BG_blue <span class="kw1">As</span> <span class="kw1">Long</span>, sens_dessin <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="kw1">Private</span> poubelle <span class="kw1">As</span> <span class="kw1">Long</span>, tempo <span class="kw1">As</span> <span class="kw1">Long</span>, NonForcé <span class="kw1">As</span> <span class="kw1">Boolean</span><br />
<br />

<span class="kw1">Private</span> SelectedPlug <span class="kw1">As</span> Control, IsSlidingWorking <span class="kw1">As</span> <span class="kw1">Boolean</span>, NoSelEvents <span class="kw1">As</span> <span class="kw1">Boolean</span>, SVGofRTF <span class="kw1">As</span> <span class="kw1">String</span> &nbsp; &nbsp;<span class="co1">'Variables génerales pour le programme</span><br />

<br />
<span class="kw1">Private</span> Splitter <span class="kw1">As</span> <span class="kw1">String</span>, Splitter_Cur <span class="kw1">As</span> <span class="kw1">Long</span>, Split_Count <span class="kw1">As</span> <span class="kw1">Long</span> &nbsp; <span class="co1">'Les paramètres pour le Split des chapter</span><br />

<br />
<span class="kw1">Private</span> MyChoiceIs <span class="kw1">As</span> <span class="kw1">Long</span> &nbsp;<span class="co1">'Empeche de redemander à chaque fois les paramètres pour les images lorsque l'on utilise splitchapter</span><br />
<br />
<span class="kw1">Private</span> BackPicture <span class="kw1">As</span> IPictureDisp <span class="co1">'L'image de fond, si il ne s'agit pas d'un dégradé</span><br />

<br />
<span class="kw1">Private</span> debut <span class="kw1">As</span> <span class="kw1">Single</span> <span class="co1">'Pour tout les timers...</span><br />
<br />
<span class="kw1">Private</span> NoInternet <span class="kw1">As</span> <span class="kw1">Boolean</span> &nbsp; <span class="co1">'Si pas de connexion vaut true</span><br />

<br />
<span class="kw1">Private</span> Reponse <span class="kw1">As</span> <span class="kw1">String</span>, Couleur_Selectionnee <span class="kw1">As</span> <span class="kw1">Long</span> <span class="co1">'Contient la réponse du Comdlg</span><br />
<br />
<span class="kw1">Private</span> TailleTexte <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="kw1">Private</span> CleverColor <span class="kw1">As</span> <span class="kw1">Boolean</span> <span class="co1">'détrermine si les forecolor doivent s'adapter à l'arrière plan.</span><br />
<br />
<span class="co1">'Messages Windows</span><br />
<span class="kw1">Const</span> WM_PASTE = &amp;H302<br />

<br />
<span class="kw1">Const</span> WM_VSCROLL = &amp;H115<br />
<br />
<span class="co1">'Messages Windows Priorité</span><br />
<span class="co1">'Const NORMAL_PRIORITY_CLASS As Long = &amp;H20 ' normal</span><br />
<span class="kw1">Const</span> ABOVE_NORMAL_PRIORITY_CLASS <span class="kw1">As</span> <span class="kw1">Long</span> = &amp;H8000 <span class="co1">' normal +</span><br />

<br />
<span class="kw1">Const</span> HIGH_PRIORITY_CLASS <span class="kw1">As</span> <span class="kw1">Long</span> = &amp;H80 <span class="co1">' haute</span><br />
<br />
<span class="kw1">Const</span> REALTIME_PRIORITY_CLASS <span class="kw1">As</span> <span class="kw1">Long</span> = &amp;H100 <span class="co1">' maximum</span><br />

<br />
<span class="co1">'Messages RTFBox/ComboBox</span><br />
<span class="kw1">Const</span> SB_PAGEDOWN = <span class="nu0">3</span><br />
<br />
<span class="kw1">Const</span> EM_CHARFROMPOS = &amp;HD7<br />
<br />
<span class="kw1">Const</span> CB_SHOWDROPDOWN = &amp;H14F<br />

<br />
<span class="kw1">Const</span> CB_SETDROPPEDWIDTH = &amp;H160<br />
<br />
<span class="kw1">Const</span> Barre <span class="kw1">As</span> <span class="kw1">String</span> = <span class="st0">&quot;{\pict\wmetafile8\picw1764\pich882\picwgoal9070\pichgoal29 &quot;</span> &amp; <span class="kw1">vbCrLf</span> &amp; <span class="st0">&quot;010009000003bb00000006001c00000000000400000003010800050000000b0200000000050000&quot;</span> &amp; <span class="kw1">vbCrLf</span> &amp; <span class="st0">&quot;000c023300ca0e040000002e0118001c000000fb021000070000000000bc020000000001020222&quot;</span> &amp; <span class="kw1">vbCrLf</span> &amp; <span class="st0">&quot;53797374656d0000ca0e00002c3e0000a489120026e2823900d61a000c020000040000002d0100&quot;</span> &amp; <span class="kw1">vbCrLf</span> &amp; <span class="st0">&quot;0004000000020101001c000000fb029cff0000000000009001000000000440001254696d657320&quot;</span> &amp; <span class="kw1">vbCrLf</span> &amp; <span class="st0">&quot;4e657720526f6d616e0000000000000000000000000000000000040000002d0101000500000009&quot;</span> &amp; <span class="kw1">vbCrLf</span> &amp; <span class="st0">&quot;02000000020d000000320a5a0000000100040000000000c50e320020932d00030000001e000700&quot;</span> &amp; <span class="kw1">vbCrLf</span> &amp; <span class="st0">&quot;0000fc020000dbdee8000000040000002d01020008000000fa02050000000000ffffff00040000&quot;</span> &amp; <span class="kw1">vbCrLf</span> &amp; <span class="st0">&quot;002d0103000e00000024030500ffffffffffff3200c40e3200c40effffffffffff08000000fa02&quot;</span> &amp; <span class="kw1">vbCrLf</span> &amp; <span class="st0">&quot;00000000000000000000040000002d01040007000000fc020000ffffff000000040000002d0105&quot;</span> &amp; <span class="kw1">vbCrLf</span> &amp; <span class="st0">&quot;00040000002701ffff040000002d010000030000000000&quot;</span> &amp; <span class="kw1">vbCrLf</span> &amp; <span class="st0">&quot;}&quot;</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Do_Abort<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; Abandon.<span class="me1">Visible</span> = <span class="kw1">True</span><br />
&nbsp; &nbsp; Abandon.<span class="me1">Top</span> = <span class="nu0">126</span><br />
&nbsp; &nbsp; tempo = <span class="kw1">Timer</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">Do</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Abandon.<span class="me1">Top</span> = <span class="nu0">126</span> - <span class="br0">&#40;</span><span class="kw1">Timer</span> - tempo<span class="br0">&#41;</span> * <span class="nu0">31.5</span><br />

&nbsp; &nbsp; <span class="kw1">Loop</span> <span class="kw1">While</span> <span class="kw1">Timer</span> - tempo &lt; <span class="nu0">3</span><br />
<br />
&nbsp; &nbsp; Abandon.<span class="me1">Visible</span> = <span class="kw1">False</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Public</span> <span class="kw1">Sub</span> Form_TailleChange<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="co1">'Sub triggered chaque fois qu'il y a un évenement size</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

<br />
&nbsp; &nbsp; <span class="co1">'Autorise le redimensionnement de la feuille. Replace les controles au bons endroits</span><br />
&nbsp; &nbsp; <span class="kw1">Dim</span> Current_Height <span class="kw1">As</span> <span class="kw1">Long</span>, Current_Width <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
&nbsp; &nbsp; Current_Height = <span class="kw1">Me</span>.<span class="me1">ScaleHeight</span><br />
&nbsp; &nbsp; Current_Width = <span class="kw1">Me</span>.<span class="me1">ScaleWidth</span><br />
&nbsp; &nbsp; <span class="co1">'If Current_Height &lt; 310 Then Me.ScaleHeight = 310: Exit Sub</span><br />

&nbsp; &nbsp; <span class="co1">'If Current_Width &lt; 600 Then Me.ScaleHeight = 600: Exit Sub</span><br />
&nbsp; &nbsp; <span class="co1">'Redimensionner sur la hauteur</span><br />
&nbsp; &nbsp; <span class="co1">'Replacer les controles</span><br />
&nbsp; &nbsp; Apercu.<span class="me1">Height</span> = <span class="kw1">IIf</span><span class="br0">&#40;</span>Rechercher.<span class="me1">Visible</span>, <span class="kw1">Me</span>.<span class="me1">ScaleHeight</span> - Rechercher.<span class="me1">Height</span> - Apercu.<span class="me1">Top</span>, <span class="kw1">Me</span>.<span class="me1">ScaleHeight</span> - Apercu.<span class="me1">Top</span> - <span class="nu0">12</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; Separateur<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Y2</span> = <span class="kw1">Me</span>.<span class="me1">ScaleHeight</span><br />
&nbsp; &nbsp; Rechercher.<span class="me1">Top</span> = Current_Height - <span class="nu0">30</span><br />

&nbsp; &nbsp; MainContainer.<span class="me1">Top</span> = Current_Height \ <span class="nu0">2</span> - MainContainer.<span class="me1">Height</span> \ <span class="nu0">2</span><br />
&nbsp; &nbsp; SelectedPlug.<span class="me1">Top</span> = Current_Height \ <span class="nu0">2</span> - SelectedPlug.<span class="me1">Height</span> \ <span class="nu0">2</span><br />

&nbsp; &nbsp; <span class="co1">'Replacer la fenêtre au milieu :</span><br />
&nbsp; &nbsp; <span class="co1">'Me.Top = Screen.Height \ 2 - (Me.Height \ 2)</span><br />
&nbsp; &nbsp; <span class="co1">'Redimensionner sur la largeur</span><br />
&nbsp; &nbsp; <span class="co1">'Replacer les controles</span><br />
&nbsp; &nbsp; Apercu.<span class="kw1">Width</span> = Current_Width - <span class="nu0">362</span><br />

&nbsp; &nbsp; MainContainer.<span class="kw1">Left</span> = Apercu.<span class="kw1">Left</span> + Apercu.<span class="kw1">Width</span> + <span class="nu0">2</span><br />
&nbsp; &nbsp; Separateur<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">X1</span> = MainContainer.<span class="kw1">Left</span> + MainContainer.<span class="kw1">Width</span> + <span class="nu0">4</span><br />

&nbsp; &nbsp; Separateur<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">X2</span> = MainContainer.<span class="kw1">Left</span> + MainContainer.<span class="kw1">Width</span> + <span class="nu0">4</span><br />
&nbsp; &nbsp; SelectedPlug.<span class="kw1">Left</span> = MainContainer.<span class="kw1">Left</span> + MainContainer.<span class="kw1">Width</span> + <span class="nu0">7</span><br />

&nbsp; &nbsp; BallonTip.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
<br />
&nbsp; &nbsp; Form_Redraw<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Glass<span class="br0">&#40;</span>X1 <span class="kw1">As</span> <span class="kw1">Long</span>, Y1 <span class="kw1">As</span> <span class="kw1">Long</span>, X2 <span class="kw1">As</span> <span class="kw1">Long</span>, Y2 <span class="kw1">As</span> <span class="kw1">Long</span>, Optional Me_DC <span class="kw1">As</span> <span class="kw1">Long</span> = <span class="nu0">0</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="co1">'Une petite sub bien pratique qui permet d'afficher un glassage par dessus un controle, pour le mettre en valeur ou simplement pour faire joli !</span><br />
&nbsp; &nbsp; <span class="kw1">Dim</span> X &nbsp; &nbsp;<span class="kw1">As</span> <span class="kw1">Long</span>, Y <span class="kw1">As</span> <span class="kw1">Long</span>, V <span class="kw1">As</span> <span class="kw1">Long</span>, T <span class="kw1">As</span> <span class="kw1">Long</span>, pre_compute <span class="kw1">As</span> <span class="kw1">Long</span>, pre_compute2 <span class="kw1">As</span> <span class="kw1">Long</span>, pre_compute3 <span class="kw1">As</span> <span class="kw1">Long</span>, pre_compute4 <span class="kw1">As</span> <span class="kw1">Long</span>, pre_compute5 <span class="kw1">As</span> <span class="kw1">Long</span>, LenType <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">Dim</span> iRGB <span class="kw1">As</span> vRGB<br />
<br />
&nbsp; &nbsp; iRGB.<span class="me1">B</span> = <span class="nu0">0</span>: iRGB.<span class="me1">R</span> = <span class="nu0">0</span>: iRGB.<span class="me1">G</span> = <span class="nu0">0</span><br />

&nbsp; &nbsp; LenType = <span class="kw1">LenB</span><span class="br0">&#40;</span>iRGB<span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> Me_DC = <span class="nu0">0</span> <span class="kw1">Then</span> Me_DC = myHDC<br />

&nbsp; &nbsp; pre_compute = X1 + X2<br />
<br />
&nbsp; &nbsp; <span class="kw1">For</span> Y = <span class="nu0">0</span> <span class="kw1">To</span> <span class="nu0">10</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; pre_compute2 = Y1 + Y<br />

&nbsp; &nbsp; &nbsp; &nbsp; pre_compute3 = <span class="br0">&#40;</span><span class="nu0">15</span> - Y<span class="br0">&#41;</span> * <span class="br0">&#40;</span><span class="nu0">10</span> - Y \ <span class="nu0">2</span><span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">For</span> X = X1 <span class="kw1">To</span> pre_compute<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Haut</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; V = GetPixel<span class="br0">&#40;</span>Me_DC, X, pre_compute2<span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; CopyMemory iRGB, V, LenType<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SetPixelV Me_DC, X, pre_compute2, <span class="kw1">RGB</span><span class="br0">&#40;</span><span class="kw1">Min</span><span class="br0">&#40;</span>iRGB.<span class="me1">R</span> + pre_compute3, <span class="nu0">255</span><span class="br0">&#41;</span>, <span class="kw1">Min</span><span class="br0">&#40;</span>iRGB.<span class="me1">G</span> + pre_compute3, <span class="nu0">255</span><span class="br0">&#41;</span>, <span class="kw1">Min</span><span class="br0">&#40;</span>iRGB.<span class="me1">B</span> + pre_compute3, <span class="nu0">255</span><span class="br0">&#41;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="co1">'La partie la plus longue : le milieu</span><br />
&nbsp; &nbsp; pre_compute4 = Y2 - <span class="nu0">5</span> - Y1<br />

<br />
&nbsp; &nbsp; <span class="kw1">For</span> Y = <span class="nu0">11</span> <span class="kw1">To</span> pre_compute4<br />
&nbsp; &nbsp; &nbsp; &nbsp; pre_compute2 = Y1 + Y<br />

&nbsp; &nbsp; &nbsp; &nbsp; pre_compute3 = <span class="br0">&#40;</span><span class="nu0">15</span> - Y<span class="br0">&#41;</span> * <span class="br0">&#40;</span><span class="nu0">10</span> - Y \ <span class="nu0">2</span><span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">For</span> X = X1 <span class="kw1">To</span> pre_compute<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; V = GetPixel<span class="br0">&#40;</span>Me_DC, X, pre_compute2<span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; CopyMemory iRGB, V, LenType<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SetPixelV Me_DC, X, pre_compute2, <span class="kw1">RGB</span><span class="br0">&#40;</span><span class="kw1">Min</span><span class="br0">&#40;</span>iRGB.<span class="me1">R</span> + <span class="nu0">20</span>, <span class="nu0">255</span><span class="br0">&#41;</span>, <span class="kw1">Min</span><span class="br0">&#40;</span>iRGB.<span class="me1">G</span> + <span class="nu0">20</span>, <span class="nu0">255</span><span class="br0">&#41;</span>, <span class="kw1">Min</span><span class="br0">&#40;</span>iRGB.<span class="me1">B</span> + <span class="nu0">20</span>, <span class="nu0">255</span><span class="br0">&#41;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; T = <span class="nu0">2</span><br />
&nbsp; &nbsp; pre_compute3 = Y2 - Y1<br />

<br />
&nbsp; &nbsp; <span class="kw1">For</span> Y = pre_compute4 <span class="kw1">To</span> pre_compute3<br />
&nbsp; &nbsp; &nbsp; &nbsp; T = T + <span class="nu0">2</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; pre_compute2 = Y1 + Y<br />
&nbsp; &nbsp; &nbsp; &nbsp; pre_compute5 = <span class="br0">&#40;</span>T + <span class="nu0">2</span><span class="br0">&#41;</span> * <span class="br0">&#40;</span>T \ <span class="nu0">2</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">For</span> X = X1 <span class="kw1">To</span> pre_compute<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; V = GetPixel<span class="br0">&#40;</span>Me_DC, X, pre_compute2<span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; CopyMemory iRGB, V, LenType<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SetPixelV Me_DC, X, pre_compute2, <span class="kw1">RGB</span><span class="br0">&#40;</span><span class="kw1">Min</span><span class="br0">&#40;</span>iRGB.<span class="me1">R</span> + pre_compute5, <span class="nu0">255</span><span class="br0">&#41;</span>, <span class="kw1">Min</span><span class="br0">&#40;</span>iRGB.<span class="me1">G</span> + pre_compute5, <span class="nu0">255</span><span class="br0">&#41;</span>, <span class="kw1">Min</span><span class="br0">&#40;</span>iRGB.<span class="me1">B</span> + pre_compute5, <span class="nu0">255</span><span class="br0">&#41;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> Me_DC = myHDC <span class="kw1">Then</span> <span class="kw1">Me</span>.<span class="kw1">Line</span> <span class="br0">&#40;</span>X1, Y1<span class="br0">&#41;</span>-<span class="br0">&#40;</span>X1 + X2, Y2<span class="br0">&#41;</span>, <span class="kw1">RGB</span><span class="br0">&#40;</span><span class="nu0">192</span>, <span class="nu0">192</span>, <span class="nu0">192</span><span class="br0">&#41;</span>, B<br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Numeriser<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; <span class="co1">'LA SUB PRINCIPALE ! EN FIN ? ENFIN !</span><br />
&nbsp; &nbsp; <span class="co1">'C'est celle qui fait toute la numérisation..</span><br />

&nbsp; &nbsp; <span class="kw1">Dim</span> C_dc &nbsp;<span class="kw1">As</span> <span class="kw1">Long</span>, numero <span class="kw1">As</span> <span class="kw1">Long</span>, LastLen <span class="kw1">As</span> <span class="kw1">Long</span>, Size <span class="kw1">As</span> <span class="kw1">Long</span>, <span class="kw1">base</span> <span class="kw1">As</span> <span class="kw1">String</span>, racine <span class="kw1">As</span> <span class="kw1">String</span>, Utilisation_Filigrane <span class="kw1">As</span> <span class="kw1">Boolean</span>, Couleur_De_Fond <span class="kw1">As</span> <span class="kw1">Long</span>, HHauteur <span class="kw1">As</span> <span class="kw1">Long</span>, LLargeur <span class="kw1">As</span> <span class="kw1">Long</span>, JPG <span class="kw1">As</span> <span class="kw1">Boolean</span>, nom_Fichier <span class="kw1">As</span> <span class="kw1">String</span>, c_SelStart <span class="kw1">As</span> <span class="kw1">Long</span>, R_DC <span class="kw1">As</span> <span class="kw1">Long</span>, Image_A_Blitter_DC <span class="kw1">As</span> <span class="kw1">Long</span>, app_path <span class="kw1">As</span> <span class="kw1">String</span>, MargeTop <span class="kw1">As</span> <span class="kw1">Long</span>, MargeBottom <span class="kw1">As</span> <span class="kw1">Long</span>, MarquerPage <span class="kw1">As</span> <span class="kw1">Boolean</span>, avancement_DC <span class="kw1">As</span> <span class="kw1">Long</span>, Xp <span class="kw1">As</span> <span class="kw1">Long</span>, Yp <span class="kw1">As</span> <span class="kw1">Long</span>, Retours_Chariot <span class="kw1">As</span> <span class="kw1">String</span>, Converter_Hwnd <span class="kw1">As</span> <span class="kw1">Long</span>, Retour <span class="kw1">As</span> <span class="kw1">Long</span>, pt <span class="kw1">As</span> POINTAPI, TinySize <span class="kw1">As</span> <span class="kw1">Long</span>, EraseUncompleteLine <span class="kw1">As</span> <span class="kw1">Boolean</span>, curseur_x <span class="kw1">As</span> <span class="kw1">Long</span>, curseur_y <span class="kw1">As</span> <span class="kw1">Long</span>, LigneIncomplete <span class="kw1">As</span> <span class="kw1">Boolean</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">Dim</span> ProgressBar_DC <span class="kw1">As</span> <span class="kw1">Long</span>, ProgressBar_FORE_DC <span class="kw1">As</span> <span class="kw1">Long</span><br />
<br />
&nbsp; &nbsp; <span class="co1">'Changer la priorité du processus !</span><br />

&nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Priorite&quot;</span>, <span class="st0">&quot;Normal&quot;</span><span class="br0">&#41;</span> &lt;&gt; <span class="st0">&quot;Normal&quot;</span> <span class="kw1">Then</span> ReglerPriorite <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Priorite&quot;</span>, <span class="st0">&quot;Normal&quot;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="co1">'Ensuite cacher ce sein que je ne saurais voir :</span><br />
&nbsp; &nbsp; BUG.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
<br />
&nbsp; &nbsp; Form_Redraw <span class="co1">'Rafraichir l'ensemble</span><br />

&nbsp; &nbsp; app_path = <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Default_Path&quot;</span>, <span class="st0">&quot;NotDefine&quot;</span><span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; <span class="co1">'Si jamais c'est la toute première fois :-)</span><br />

&nbsp; &nbsp; <span class="kw1">If</span> app_path = <span class="st0">&quot;NotDefine&quot;</span> <span class="kw1">Then</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Do</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; app_path = SelectFolder<span class="br0">&#40;</span>LoadString<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>, <span class="kw1">Me</span>.<span class="me1">hwnd</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Loop</span> <span class="kw1">While</span> app_path = <span class="kw1">vbNullString</span> <span class="kw1">Or</span> app_path = <span class="st0">&quot;NotDefine&quot;</span><br />
<br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Default_Path&quot;</span>, app_path<br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

<br />
&nbsp; &nbsp; <span class="co1">'Sauver les données utiles en variables pour minimiser le temps d'accès</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> UseTopAndBottomMargin.<span class="me1">Value</span> = <span class="nu0">0</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Si l'on a dit qu'on ne voulait pas de marges haut bas, on met à 0</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; SetMarge<span class="br0">&#40;</span><span class="nu0">2</span><span class="br0">&#41;</span>.<span class="me1">Tag</span> = <span class="nu0">0</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; SetMarge<span class="br0">&#40;</span><span class="nu0">3</span><span class="br0">&#41;</span>.<span class="me1">Tag</span> = <span class="nu0">0</span><br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

<br />
&nbsp; &nbsp; MargeTop = SetMarge<span class="br0">&#40;</span><span class="nu0">2</span><span class="br0">&#41;</span>.<span class="me1">Tag</span><br />
&nbsp; &nbsp; MargeBottom = SetMarge<span class="br0">&#40;</span><span class="nu0">3</span><span class="br0">&#41;</span>.<span class="me1">Tag</span><br />
&nbsp; &nbsp; MarquerPage = Pagination.<span class="me1">Value</span><br />

&nbsp; &nbsp; HHauteur = Hauteur.<span class="me1">Text</span> - MargeTop - MargeBottom<br />
&nbsp; &nbsp; LLargeur = Largeur.<span class="me1">Text</span><br />
&nbsp; &nbsp; Converter.<span class="kw1">Width</span> = LLargeur<br />

&nbsp; &nbsp; Converter.<span class="me1">Height</span> = HHauteur<br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> Converter.<span class="me1">Height</span> &gt; <span class="nu0">230</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">WindowState</span> = <span class="kw1">vbNormal</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">Height</span> = <span class="br0">&#40;</span><span class="nu0">50</span> + Converter.<span class="me1">Height</span> + <span class="nu0">56</span><span class="br0">&#41;</span> * Screen.<span class="me1">TwipsPerPixelY</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; MainContainer.<span class="me1">Top</span> = <span class="nu0">7</span><br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />

&nbsp; &nbsp; Resultat.<span class="kw1">Width</span> = LLargeur<br />
&nbsp; &nbsp; Resultat.<span class="me1">Height</span> = HHauteur + MargeTop + MargeBottom<br />
&nbsp; &nbsp; nom_Fichier = Dest_Folder.<span class="me1">Text</span><br />

&nbsp; &nbsp; racine = Root.<span class="me1">Text</span><br />
<br />
&nbsp; &nbsp; <span class="co1">'Les erreurs potentielles</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> Dest_Folder.<span class="me1">Invalide</span> <span class="kw1">Or</span> Dest_Folder.<span class="me1">Text</span> = <span class="kw1">vbNullString</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Pas de nom de fichiers, ou erreur</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; PlugChoice<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Value</span> = <span class="kw1">True</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Dest_Folder.<span class="me1">Invalide</span> = <span class="kw1">True</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Dest_Folder.<span class="me1">SetFocus</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />

&nbsp; &nbsp; <span class="kw1">If</span> Root.<span class="me1">BackColor</span> = <span class="nu0">255</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Mauvais nom de racine</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; PlugChoice<span class="br0">&#40;</span><span class="nu0">2</span><span class="br0">&#41;</span>.<span class="me1">Value</span> = <span class="kw1">True</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Root.<span class="me1">SetFocus</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />

&nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Dir</span>$<span class="br0">&#40;</span>Filig.<span class="me1">Text</span><span class="br0">&#41;</span> = <span class="kw1">vbNullString</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; PlugChoice<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">Value</span> = <span class="kw1">True</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Filig.<span class="me1">SetFocus</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />
<br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> SplitChapter.<span class="me1">Value</span> = <span class="kw1">True</span> <span class="kw1">And</span> <span class="br0">&#40;</span>KeyWord.<span class="me1">Text</span> = <span class="kw1">vbNullString</span> <span class="kw1">Or</span> KeyWord.<span class="me1">Invalide</span> = <span class="kw1">True</span><span class="br0">&#41;</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; PlugChoice<span class="br0">&#40;</span><span class="nu0">2</span><span class="br0">&#41;</span>.<span class="me1">Value</span> = <span class="kw1">True</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; KeyWord.<span class="me1">SetFocus</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />

&nbsp; &nbsp; numero = <span class="nu0">0</span><br />
<br />
&nbsp; &nbsp; <span class="co1">'Creer le dossier (si pas crée, evidemment)</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Dir</span>$<span class="br0">&#40;</span>app_path &amp; <span class="st0">&quot;\&quot;</span> &amp; nom_Fichier, <span class="kw1">vbDirectory</span><span class="br0">&#41;</span> = <span class="kw1">vbNullString</span> <span class="kw1">Then</span> <span class="kw1">MkDir</span> app_path &amp; <span class="st0">&quot;\&quot;</span> &amp; nom_Fichier<br />

<br />
&nbsp; &nbsp; <span class="co1">'Redimensionner l'image de fond si besoin est</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> RedimToFit.<span class="me1">Value</span> = <span class="kw1">True</span> <span class="kw1">Then</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">With</span> Image_A_Blitter<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">BackColor</span> = <span class="kw1">RGB</span><span class="br0">&#40;</span><span class="nu0">254</span>, <span class="nu0">255</span>, <span class="nu0">255</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">AutoSize</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="kw1">Width</span> = Largeur.<span class="me1">Text</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">Height</span> = Hauteur.<span class="me1">Text</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">Picture</span> = <span class="kw1">LoadPicture</span><span class="br0">&#40;</span><span class="kw1">vbNullString</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">PaintPicture</span> <span class="kw1">LoadPicture</span><span class="br0">&#40;</span>Filig.<span class="me1">Text</span><span class="br0">&#41;</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, Largeur.<span class="me1">Text</span>, Hauteur.<span class="me1">Text</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">With</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">Else</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Image_A_Blitter.<span class="me1">Picture</span> = <span class="kw1">LoadPicture</span><span class="br0">&#40;</span>Filig.<span class="me1">Text</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> Filig.<span class="me1">Text</span> &lt;&gt; <span class="kw1">vbNullString</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Tous les cas d'utilisations de filigrane</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Utilisation_Filigrane = <span class="kw1">True</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Cover.<span class="me1">Value</span> = <span class="kw1">True</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Utilisation_Filigrane = <span class="kw1">False</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; BitBlt Resultat.<span class="me1">hdc</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, Largeur.<span class="me1">Text</span>, Hauteur.<span class="me1">Text</span>, Image_A_Blitter.<span class="me1">hdc</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, vbSrcCopy<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Resultat.<span class="me1">Refresh</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">SavePicture</span> Resultat.<span class="me1">Image</span>, app_path &amp; <span class="st0">&quot;\&quot;</span> &amp; nom_Fichier &amp; <span class="st0">&quot;\&quot;</span> &amp; racine &amp; <span class="st0">&quot;0000.bmp&quot;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; numero = <span class="nu0">1</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; <span class="co1">'Mettre au premier plan</span><br />
&nbsp; &nbsp; SetWindowPos <span class="kw1">Me</span>.<span class="me1">hwnd</span>, <span class="nu0">-1</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">2</span> <span class="kw1">Or</span> <span class="nu0">1</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">Caption</span> = LoadString<span class="br0">&#40;</span><span class="nu0">2</span><span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; <span class="co1">'Masquer les controles</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

<br />
&nbsp; &nbsp; SelectedPlug.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; MainContainer.<span class="me1">Visible</span> = <span class="kw1">False</span><br />

&nbsp; &nbsp; BallonTip.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; Separateur<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Visible</span> = <span class="kw1">False</span><br />

&nbsp; &nbsp; MAJ.<span class="me1">Enabled</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; Apercu.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">15</span><span class="br0">&#41;</span>.<span class="me1">Visible</span> = <span class="kw1">False</span><br />

&nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Visible</span> = <span class="kw1">True</span><br />
&nbsp; &nbsp; Griser_Fermer <span class="br0">&#40;</span><span class="kw1">Me</span>.<span class="me1">hwnd</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">Set</span> etiquette<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Container</span> = <span class="kw1">Me</span><br />
&nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Move</span> LLargeur + <span class="nu0">55</span>, <span class="nu0">56</span>, <span class="nu0">253</span>, HHauteur - <span class="nu0">5</span><br />

&nbsp; &nbsp; Glass LLargeur + <span class="nu0">45</span>, <span class="nu0">50</span>, <span class="nu0">258</span>, <span class="nu0">60</span> + HHauteur - <span class="nu0">5</span><br />
&nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> = LoadString<span class="br0">&#40;</span><span class="nu0">3</span><span class="br0">&#41;</span> &amp; <span class="kw1">vbCrLf</span> &amp; LoadString<span class="br0">&#40;</span><span class="nu0">4</span><span class="br0">&#41;</span> &amp; <span class="kw1">vbCrLf</span><br />

&nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">ForeColor</span> = <span class="kw1">RGB</span><span class="br0">&#40;</span><span class="nu0">255</span>, <span class="nu0">255</span>, <span class="nu0">255</span><span class="br0">&#41;</span> - GetPixel<span class="br0">&#40;</span>myHDC, LLargeur + <span class="nu0">50</span>, <span class="nu0">26</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; Converter.<span class="me1">Visible</span> = <span class="kw1">True</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> SplitChapter.<span class="me1">Value</span> = <span class="kw1">True</span> <span class="kw1">Then</span> &nbsp; &nbsp; &nbsp;<span class="co1">'Splittage des chapitres</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Splitter = <span class="kw1">vbNullString</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Premier split</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Splitter = Apercu.<span class="me1">TextRTF</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Splitter_Cur = <span class="nu0">1</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Split_Count = <span class="nu0">0</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; Converter.<span class="me1">TextRTF</span> = Splitter<br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> = Replace<span class="br0">&#40;</span>LoadString<span class="br0">&#40;</span><span class="nu0">5</span><span class="br0">&#41;</span>, <span class="st0">&quot;%u&quot;</span>, KeyWord.<span class="me1">Text</span><span class="br0">&#41;</span> &amp; <span class="kw1">vbCrLf</span> &amp; LoadString<span class="br0">&#40;</span><span class="nu0">6</span><span class="br0">&#41;</span> &amp; Split_Count &amp; <span class="kw1">vbCrLf</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Splitter_Cur = <span class="kw1">Len</span><span class="br0">&#40;</span>Converter.<span class="me1">Text</span><span class="br0">&#41;</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ShellExecute <span class="kw1">Me</span>.<span class="me1">hwnd</span>, <span class="st0">&quot;open&quot;</span>, app_path &amp; <span class="st0">&quot;\&quot;</span> &amp; Dest_Folder.<span class="me1">Text</span> &amp; <span class="st0">&quot;\&quot;</span>, <span class="kw1">vbNullString</span>, App.<span class="me1">Path</span>, <span class="nu0">1</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Unload</span> <span class="kw1">Me</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; Split_Count = Split_Count + <span class="nu0">1</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Converter.<span class="me1">SelStart</span> = Splitter_Cur - <span class="nu0">1</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Splitter_Cur = <span class="kw1">InStr</span><span class="br0">&#40;</span>Splitter_Cur + <span class="nu0">5</span>, Converter.<span class="me1">Text</span>, KeyWord.<span class="me1">Text</span><span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Splitter_Cur = <span class="nu0">0</span> <span class="kw1">Then</span> Splitter_Cur = <span class="kw1">Len</span><span class="br0">&#40;</span>Converter.<span class="me1">Text</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Converter.<span class="me1">SelLength</span> = Splitter_Cur - Converter.<span class="me1">SelStart</span> - <span class="nu0">1</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Converter.<span class="me1">TextRTF</span> = Converter.<span class="me1">SelRTF</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">TextRTF</span> = Converter.<span class="me1">TextRTF</span><br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />

&nbsp; &nbsp; <span class="co1">'Et ca commence ! On est sur qu'il n'y a pas de problèmes !</span><br />
&nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">MousePointer</span> = vbCustom<br />
<br />
&nbsp; &nbsp; <span class="kw1">DoEvents</span><br />

&nbsp; &nbsp; SVGofRTF = Apercu.<span class="me1">TextRTF</span><br />
&nbsp; &nbsp; Converter.<span class="me1">TextRTF</span> = SVGofRTF<br />
&nbsp; &nbsp; Apercu.<span class="me1">TextRTF</span> = <span class="kw1">vbNullString</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
&nbsp; &nbsp; Couleur_De_Fond = Couleur<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">BackColor</span><br />
&nbsp; &nbsp; C_dc = GetDC<span class="br0">&#40;</span>Converter.<span class="me1">hwnd</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; avancement_DC = Avancement.<span class="me1">hdc</span><br />
&nbsp; &nbsp; LastLen = <span class="kw1">Len</span><span class="br0">&#40;</span>Converter.<span class="me1">Text</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; Converter.<span class="me1">SelStart</span> = LastLen<br />

&nbsp; &nbsp; Converter.<span class="me1">SelLength</span> = <span class="nu0">0</span><br />
&nbsp; &nbsp; EraseUncompleteLine = <span class="kw1">Not</span> <span class="br0">&#40;</span>Type_Numerisation.<span class="me1">Value</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; Retours_Chariot = <span class="kw1">vbNullString</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">For</span> tempo = <span class="nu0">1</span> <span class="kw1">To</span> <span class="nu0">25</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Retours_Chariot = Retours_Chariot &amp; <span class="kw1">vbCrLf</span><br />

&nbsp; &nbsp; <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; Converter.<span class="me1">SelText</span> = Retours_Chariot<br />
&nbsp; &nbsp; Converter.<span class="me1">SelFontSize</span> = <span class="nu0">8.25</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
&nbsp; &nbsp; JPG = En_JPG.<span class="me1">Value</span><br />
&nbsp; &nbsp; <span class="co1">'Converter.SelStart =</span><br />
&nbsp; &nbsp; Size = <span class="kw1">Len</span><span class="br0">&#40;</span>Converter.<span class="me1">Text</span><span class="br0">&#41;</span> <span class="co1">'Converter.SelStart</span><br />

&nbsp; &nbsp; Converter.<span class="me1">SelStart</span> = <span class="nu0">0</span><br />
&nbsp; &nbsp; c_SelStart = <span class="nu0">0</span><br />
&nbsp; &nbsp; Resultat.<span class="me1">BackColor</span> = <span class="kw1">RGB</span><span class="br0">&#40;</span><span class="nu0">255</span>, <span class="nu0">255</span>, <span class="nu0">255</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; R_DC = Resultat.<span class="me1">hdc</span><br />
&nbsp; &nbsp; Image_A_Blitter_DC = Image_A_Blitter.<span class="me1">hdc</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">InStr</span><span class="br0">&#40;</span><span class="nu0">1</span>, SVGofRTF, <span class="st0">&quot;\pict&quot;</span><span class="br0">&#41;</span> &lt;&gt; <span class="nu0">0</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Converter.<span class="me1">Enabled</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; PlugChoice_Click <span class="nu0">6</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">With</span> Plug<span class="br0">&#40;</span><span class="nu0">6</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">Visible</span> = <span class="nu0">1</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">Top</span> = <span class="br0">&#40;</span><span class="kw1">Me</span>.<span class="me1">ScaleHeight</span> - .<span class="me1">Height</span><span class="br0">&#41;</span> \ <span class="nu0">2</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; BitBlt .<span class="me1">hdc</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">176</span>, <span class="nu0">289</span>, myHDC, .<span class="kw1">Left</span>, .<span class="me1">Top</span>, vbSrcCopy<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="kw1">Left</span> = <span class="nu0">745</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">Refresh</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">With</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Set</span> SelectedPlug = Plug<span class="br0">&#40;</span>tempo<span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">For</span> tempo = <span class="nu0">0</span> <span class="kw1">To</span> PlugChoice.<span class="kw1">Count</span> - <span class="nu0">1</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Plug<span class="br0">&#40;</span>tempo<span class="br0">&#41;</span>.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Next</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; IsSlidingWorking = <span class="kw1">True</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Do</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Loop</span> <span class="kw1">While</span> <span class="br0">&#40;</span>IsSlidingWorking = <span class="kw1">True</span> <span class="kw1">And</span> MyChoiceIs = <span class="nu0">25</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> MyChoiceIs &lt;&gt; <span class="nu0">25</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Traitement_Img<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Value</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Traitement_Img<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">Value</span> = <span class="kw1">False</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Traitement_Img<span class="br0">&#40;</span><span class="nu0">2</span><span class="br0">&#41;</span>.<span class="me1">Value</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Traitement_Img<span class="br0">&#40;</span>MyChoiceIs<span class="br0">&#41;</span>.<span class="me1">Value</span> = <span class="kw1">True</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; tempo = <span class="nu0">1</span><br />
<br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Traitement_Img<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">Value</span> = <span class="kw1">True</span> <span class="kw1">Or</span> Traitement_Img<span class="br0">&#40;</span><span class="nu0">2</span><span class="br0">&#41;</span>.<span class="me1">Value</span> = <span class="kw1">True</span> <span class="kw1">Then</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Dim</span> poubelle <span class="kw1">As</span> <span class="kw1">String</span>, LLargeurReelle <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; LLargeurReelle = LLargeur - SetMarge<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Tag</span> - SetMarge<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">Tag</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> = etiquette<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> &amp; LoadString<span class="br0">&#40;</span><span class="nu0">7</span><span class="br0">&#41;</span> &amp; <span class="kw1">vbCrLf</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Do</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Redimensionner toutes les images</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'D'abord les Width</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; tempo = <span class="kw1">InStr</span><span class="br0">&#40;</span>tempo, SVGofRTF, <span class="st0">&quot;\objw&quot;</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> tempo = <span class="nu0">0</span> <span class="kw1">Then</span> <span class="kw1">Exit</span> <span class="kw1">Do</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; tempo = tempo + <span class="nu0">5</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; poubelle = <span class="kw1">vbNullString</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Do</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; poubelle = poubelle &amp; <span class="kw1">Mid</span>$<span class="br0">&#40;</span>SVGofRTF, tempo, <span class="nu0">1</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; tempo = tempo + <span class="nu0">1</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Loop</span> <span class="kw1">While</span> <span class="br0">&#40;</span><span class="kw1">Mid</span>$<span class="br0">&#40;</span>SVGofRTF, tempo, <span class="nu0">1</span><span class="br0">&#41;</span> Like <span class="st0">&quot;[123456789]&quot;</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Val</span><span class="br0">&#40;</span>poubelle<span class="br0">&#41;</span> \ Screen.<span class="me1">TwipsPerPixelX</span> &gt; LLargeurReelle <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Redimensionner (fonction de malade !)</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Mid</span>$<span class="br0">&#40;</span>SVGofRTF, tempo - <span class="kw1">Len</span><span class="br0">&#40;</span>poubelle<span class="br0">&#41;</span>, <span class="kw1">Len</span><span class="br0">&#40;</span>poubelle<span class="br0">&#41;</span><span class="br0">&#41;</span> = <span class="kw1">FORMAT</span>$<span class="br0">&#40;</span>LLargeurReelle * Screen.<span class="me1">TwipsPerPixelX</span>, Replace<span class="br0">&#40;</span><span class="kw1">Space</span>$<span class="br0">&#40;</span><span class="kw1">Len</span><span class="br0">&#40;</span>poubelle<span class="br0">&#41;</span><span class="br0">&#41;</span>, <span class="st0">&quot; &quot;</span>, <span class="st0">&quot;0&quot;</span><span class="br0">&#41;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Traitement_Img<span class="br0">&#40;</span><span class="nu0">2</span><span class="br0">&#41;</span>.<span class="me1">Value</span> = <span class="kw1">True</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Ensuite les height</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; tempo = <span class="kw1">InStr</span><span class="br0">&#40;</span>tempo - <span class="nu0">1</span>, SVGofRTF, <span class="st0">&quot;\objh&quot;</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> tempo = <span class="nu0">0</span> <span class="kw1">Then</span> <span class="kw1">Exit</span> <span class="kw1">Do</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; tempo = tempo + <span class="nu0">5</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; poubelle = <span class="kw1">vbNullString</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Do</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; poubelle = poubelle &amp; <span class="kw1">Mid</span>$<span class="br0">&#40;</span>SVGofRTF, tempo, <span class="nu0">1</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; tempo = tempo + <span class="nu0">1</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Loop</span> <span class="kw1">While</span> <span class="br0">&#40;</span><span class="kw1">Mid</span>$<span class="br0">&#40;</span>SVGofRTF, tempo, <span class="nu0">1</span><span class="br0">&#41;</span> Like <span class="st0">&quot;[0123456789]&quot;</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Val</span><span class="br0">&#40;</span>poubelle<span class="br0">&#41;</span> \ Screen.<span class="me1">TwipsPerPixelY</span> &gt; HHauteur <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Redimensionner (fonction de malade ! 2 )</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Mid</span>$<span class="br0">&#40;</span>SVGofRTF, tempo - <span class="kw1">Len</span><span class="br0">&#40;</span>poubelle<span class="br0">&#41;</span>, <span class="kw1">Len</span><span class="br0">&#40;</span>poubelle<span class="br0">&#41;</span><span class="br0">&#41;</span> = <span class="kw1">FORMAT</span>$<span class="br0">&#40;</span>HHauteur * Screen.<span class="me1">TwipsPerPixelY</span>, Replace<span class="br0">&#40;</span><span class="kw1">Space</span>$<span class="br0">&#40;</span><span class="kw1">Len</span><span class="br0">&#40;</span>poubelle<span class="br0">&#41;</span><span class="br0">&#41;</span>, <span class="st0">&quot; &quot;</span>, <span class="st0">&quot;0&quot;</span><span class="br0">&#41;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Loop</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; tempo = <span class="nu0">1</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Do</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Redimensionner toutes les images incluse d'origine dans le fichier</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Uniquement les picwgoal</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; tempo = <span class="kw1">InStr</span><span class="br0">&#40;</span>tempo, SVGofRTF, <span class="st0">&quot;\picwgoal&quot;</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> tempo = <span class="nu0">0</span> <span class="kw1">Then</span> <span class="kw1">Exit</span> <span class="kw1">Do</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; tempo = tempo + <span class="nu0">9</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; poubelle = <span class="kw1">vbNullString</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Do</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; poubelle = poubelle &amp; <span class="kw1">Mid</span>$<span class="br0">&#40;</span>SVGofRTF, tempo, <span class="nu0">1</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; tempo = tempo + <span class="nu0">1</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Loop</span> <span class="kw1">While</span> <span class="br0">&#40;</span><span class="kw1">Mid</span>$<span class="br0">&#40;</span>SVGofRTF, tempo, <span class="nu0">1</span><span class="br0">&#41;</span> Like <span class="st0">&quot;[0123456789]&quot;</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Val</span><span class="br0">&#40;</span>poubelle<span class="br0">&#41;</span> \ Screen.<span class="me1">TwipsPerPixelX</span> &gt; LLargeurReelle <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Redimensionner (fonction de malade !)</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Mid</span>$<span class="br0">&#40;</span>SVGofRTF, tempo - <span class="kw1">Len</span><span class="br0">&#40;</span>poubelle<span class="br0">&#41;</span>, <span class="kw1">Len</span><span class="br0">&#40;</span>poubelle<span class="br0">&#41;</span><span class="br0">&#41;</span> = <span class="kw1">FORMAT</span>$<span class="br0">&#40;</span>LLargeurReelle * Screen.<span class="me1">TwipsPerPixelX</span>, Replace<span class="br0">&#40;</span><span class="kw1">Space</span>$<span class="br0">&#40;</span><span class="kw1">Len</span><span class="br0">&#40;</span>poubelle<span class="br0">&#41;</span><span class="br0">&#41;</span>, <span class="st0">&quot; &quot;</span>, <span class="st0">&quot;0&quot;</span><span class="br0">&#41;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Traitement_Img<span class="br0">&#40;</span><span class="nu0">2</span><span class="br0">&#41;</span>.<span class="me1">Value</span> = <span class="kw1">True</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Ensuite les height</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; tempo = <span class="kw1">InStr</span><span class="br0">&#40;</span>tempo - <span class="nu0">1</span>, SVGofRTF, <span class="st0">&quot;\pichgoal&quot;</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> tempo = <span class="nu0">0</span> <span class="kw1">Then</span> <span class="kw1">Exit</span> <span class="kw1">Do</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; tempo = tempo + <span class="nu0">9</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; poubelle = <span class="kw1">vbNullString</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Do</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; poubelle = poubelle &amp; <span class="kw1">Mid</span>$<span class="br0">&#40;</span>SVGofRTF, tempo, <span class="nu0">1</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; tempo = tempo + <span class="nu0">1</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Loop</span> <span class="kw1">While</span> <span class="br0">&#40;</span><span class="kw1">Mid</span>$<span class="br0">&#40;</span>SVGofRTF, tempo, <span class="nu0">1</span><span class="br0">&#41;</span> Like <span class="st0">&quot;[0123456789]&quot;</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Val</span><span class="br0">&#40;</span>poubelle<span class="br0">&#41;</span> \ Screen.<span class="me1">TwipsPerPixelY</span> &gt; HHauteur <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Redimensionner (fonction de malade ! 2 )</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Mid</span>$<span class="br0">&#40;</span>SVGofRTF, tempo - <span class="kw1">Len</span><span class="br0">&#40;</span>poubelle<span class="br0">&#41;</span>, <span class="kw1">Len</span><span class="br0">&#40;</span>poubelle<span class="br0">&#41;</span><span class="br0">&#41;</span> = <span class="kw1">FORMAT</span>$<span class="br0">&#40;</span>HHauteur * Screen.<span class="me1">TwipsPerPixelY</span>, Replace<span class="br0">&#40;</span><span class="kw1">Space</span>$<span class="br0">&#40;</span><span class="kw1">Len</span><span class="br0">&#40;</span>poubelle<span class="br0">&#41;</span><span class="br0">&#41;</span>, <span class="st0">&quot; &quot;</span>, <span class="st0">&quot;0&quot;</span><span class="br0">&#41;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Loop</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Converter.<span class="me1">TextRTF</span> = SVGofRTF<br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Sauvegarder ces paramètres au cas ou on fait une numérisation multiple</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Traitement_Img<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Value</span> = <span class="kw1">True</span> <span class="kw1">Then</span> MyChoiceIs = <span class="nu0">0</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Traitement_Img<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">Value</span> = <span class="kw1">True</span> <span class="kw1">Then</span> MyChoiceIs = <span class="nu0">1</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Traitement_Img<span class="br0">&#40;</span><span class="nu0">2</span><span class="br0">&#41;</span>.<span class="me1">Value</span> = <span class="kw1">True</span> <span class="kw1">Then</span> MyChoiceIs = <span class="nu0">2</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; Converter.<span class="me1">Enabled</span> = <span class="kw1">True</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> = etiquette<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> &amp; LoadString<span class="br0">&#40;</span><span class="nu0">8</span><span class="br0">&#41;</span> &amp; <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Priorite&quot;</span>, <span class="st0">&quot;Normal&quot;</span><span class="br0">&#41;</span> &amp; <span class="kw1">vbCrLf</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">If</span> Utilisation_Filigrane = <span class="kw1">True</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> = etiquette<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> &amp; Replace<span class="br0">&#40;</span>LoadString<span class="br0">&#40;</span><span class="nu0">9</span><span class="br0">&#41;</span>, <span class="st0">&quot;%u&quot;</span>, Filig.<span class="me1">Text</span><span class="br0">&#41;</span> &amp; <span class="kw1">vbCrLf</span><br />

&nbsp; &nbsp; <span class="kw1">Else</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> = etiquette<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> &amp; LoadString<span class="br0">&#40;</span><span class="nu0">10</span><span class="br0">&#41;</span> &amp; <span class="kw1">vbCrLf</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> = etiquette<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> &amp; LoadString<span class="br0">&#40;</span><span class="nu0">11</span><span class="br0">&#41;</span> &amp; <span class="kw1">Int</span><span class="br0">&#40;</span>LastLen \ <span class="br0">&#40;</span><span class="br0">&#40;</span>HHauteur * LLargeur<span class="br0">&#41;</span> \ <span class="nu0">64</span><span class="br0">&#41;</span> * <span class="nu0">2.5</span> + <span class="nu0">1</span><span class="br0">&#41;</span> &amp; <span class="kw1">vbCrLf</span><br />

&nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> = etiquette<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> &amp; LoadString<span class="br0">&#40;</span><span class="nu0">12</span><span class="br0">&#41;</span> &amp; <span class="kw1">vbCrLf</span> &amp; <span class="kw1">vbCrLf</span> &amp; <span class="kw1">vbCrLf</span><br />

<br />
&nbsp; &nbsp; <span class="co1">'Enfin... c'est maintenant que ca commence vraiment !</span><br />
&nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> = etiquette<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> &amp; LoadString<span class="br0">&#40;</span><span class="nu0">13</span><span class="br0">&#41;</span> &amp; <span class="kw1">vbCrLf</span><br />

<br />
&nbsp; &nbsp; Start.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; <span class="kw1">base</span> = app_path &amp; <span class="st0">&quot;\&quot;</span> &amp; nom_Fichier &amp; <span class="st0">&quot;\&quot;</span> &amp; racine<br />

&nbsp; &nbsp; Converter_Hwnd = Converter.<span class="me1">hwnd</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> SplitChapter.<span class="me1">Value</span> = <span class="kw1">True</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">base</span> = <span class="kw1">base</span> &amp; KeyWord.<span class="me1">Text</span> &amp; <span class="st0">&quot; &quot;</span> &amp; Split_Count &amp; <span class="st0">&quot;\&quot;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Dir</span>$<span class="br0">&#40;</span><span class="kw1">base</span>, <span class="kw1">vbDirectory</span><span class="br0">&#41;</span> = <span class="kw1">vbNullString</span> <span class="kw1">Then</span> <span class="kw1">MkDir</span> <span class="kw1">base</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> PutACopyOfFileInFolder.<span class="me1">Value</span> = <span class="kw1">True</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Converter.<span class="me1">SaveFile</span> <span class="kw1">base</span> &amp; nom_Fichier &amp; <span class="st0">&quot;.rtf&quot;</span><br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

<br />
&nbsp; &nbsp; Converter.<span class="me1">SetFocus</span><br />
&nbsp; &nbsp; pt.<span class="me1">X</span> = LLargeur - <span class="nu0">2</span><br />
&nbsp; &nbsp; pt.<span class="me1">Y</span> = HHauteur - <span class="nu0">2</span><br />

&nbsp; &nbsp; HideCaret Converter_Hwnd &nbsp; &nbsp;<span class="co1">'Masque le caret</span><br />
&nbsp; &nbsp; Retour = <span class="nu0">0</span><br />
&nbsp; &nbsp; TinySize = <span class="kw1">Max</span><span class="br0">&#40;</span>Size - <span class="nu0">2000</span>, <span class="nu0">0</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="co1">'Et centrer la feuille :</span><br />
&nbsp; &nbsp; <span class="kw1">Me</span>.<span class="kw1">Left</span> = <span class="br0">&#40;</span>Screen.<span class="kw1">Width</span> - <span class="kw1">Me</span>.<span class="kw1">Width</span><span class="br0">&#41;</span> \ <span class="nu0">2</span><br />

&nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">Top</span> = <span class="br0">&#40;</span>Screen.<span class="me1">Height</span> - <span class="kw1">Me</span>.<span class="me1">Height</span><span class="br0">&#41;</span> \ <span class="nu0">2</span><br />

&nbsp; &nbsp; <span class="kw1">Me</span>.<span class="kw1">Width</span> = <span class="br0">&#40;</span>LLargeur + <span class="nu0">50</span> + <span class="nu0">253</span> + <span class="nu0">20</span><span class="br0">&#41;</span> * Screen.<span class="me1">TwipsPerPixelY</span><br />

&nbsp; &nbsp; Size = <span class="kw1">Len</span><span class="br0">&#40;</span>Converter.<span class="me1">Text</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="co1">'Préparer le progressbar :</span><br />
&nbsp; &nbsp; ProgressBar_DC = ProgressBar.<span class="me1">hdc</span><br />
&nbsp; &nbsp; ProgressBar.<span class="me1">Height</span> = <span class="nu0">48</span><br />

&nbsp; &nbsp; ProgressBar_FORE_DC = ProgressBar_FORE.<span class="me1">hdc</span><br />
&nbsp; &nbsp; ProgressBar.<span class="me1">Visible</span> = <span class="kw1">True</span><br />
&nbsp; &nbsp; BitBlt ProgressBar_DC, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">563</span>, <span class="nu0">48</span>, myHDC, ProgressBar.<span class="kw1">Left</span>, <span class="nu0">0</span>, vbSrcCopy<br />

&nbsp; &nbsp; BitBlt ProgressBar_DC, <span class="nu0">0</span>, <span class="nu0">3</span>, <span class="nu0">563</span>, <span class="nu0">21</span>, ProgressBar_BACK.<span class="me1">hdc</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, vbSrcCopy<br />

&nbsp; &nbsp; BitBlt ProgressBar_DC, <span class="nu0">0</span>, <span class="nu0">27</span>, <span class="nu0">563</span>, <span class="nu0">21</span>, ProgressBar_BACK.<span class="me1">hdc</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, vbSrcCopy<br />

&nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">Refresh</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">For</span> tempo = <span class="nu0">0</span> <span class="kw1">To</span> <span class="nu0">15</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
&nbsp; &nbsp; <span class="kw1">Next</span><br />

<br />
<span class="co1">'C EST PARTI ICI :</span><br />
&nbsp; &nbsp; <span class="kw1">Do</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Utilisation_Filigrane <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Si on utilise un filigrane, on fait en deux fois : d'abord on blitte l'image de fond</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; BitBlt R_DC, <span class="nu0">0</span>, <span class="nu0">0</span>, LLargeur, HHauteur + MargeTop + MargeBottom, Image_A_Blitter_DC, <span class="nu0">0</span>, <span class="nu0">0</span>, vbSrcCopy<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Et ensuite on transparentblit le texte par dessus</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; TransparentBlt R_DC, <span class="nu0">0</span>, MargeTop, LLargeur, HHauteur, C_dc, <span class="nu0">0</span>, <span class="nu0">0</span>, LLargeur, HHauteur, Couleur_De_Fond<br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Else</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Sinon, c'est pas compliqué : on fait un seul blit !</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; BitBlt R_DC, <span class="nu0">0</span>, MargeTop, LLargeur, HHauteur, C_dc, <span class="nu0">0</span>, <span class="nu0">0</span>, vbSrcCopy<br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> MarquerPage <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Là, on marque le numéro de page au fer rouge en bas de l'image...</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; StretchBlt R_DC, <span class="nu0">0</span>, HHauteur + MargeTop, c_SelStart * <span class="br0">&#40;</span>LLargeur - <span class="nu0">30</span><span class="br0">&#41;</span> \ Size + <span class="nu0">30</span>, MargeBottom, avancement_DC, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">2</span>, <span class="nu0">20</span>, vbSrcCopy<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; TextOut R_DC, <span class="nu0">0</span>, HHauteur + MargeTop + <span class="br0">&#40;</span>MargeBottom - <span class="nu0">12</span><span class="br0">&#41;</span> \ <span class="nu0">2</span>, <span class="kw1">FORMAT</span>$<span class="br0">&#40;</span>numero, <span class="st0">&quot;0000&quot;</span><span class="br0">&#41;</span>, <span class="nu0">4</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> EraseUncompleteLine <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Et on efface les lignes incomplètes...</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'On commence par le haut</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; curseur_y = HHauteur + MargeTop<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Do</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; curseur_y = curseur_y - <span class="nu0">1</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; LigneIncomplete = <span class="kw1">False</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Utilisation_Filigrane <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; BitBlt R_DC, <span class="nu0">0</span>, curseur_y + <span class="nu0">1</span>, LLargeur, <span class="nu0">1</span>, Image_A_Blitter_DC, <span class="nu0">0</span>, curseur_y + <span class="nu0">1</span>, vbSrcCopy<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Else</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; BitBlt R_DC, <span class="nu0">0</span>, curseur_y + <span class="nu0">1</span>, LLargeur, <span class="nu0">1</span>, C_dc, <span class="nu0">0</span>, <span class="nu0">0</span>, &amp;HFF0062<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">For</span> curseur_x = <span class="nu0">0</span> <span class="kw1">To</span> LLargeur<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> GetPixel<span class="br0">&#40;</span>R_DC, curseur_x, curseur_y<span class="br0">&#41;</span> = <span class="kw1">vbBlack</span> <span class="kw1">Then</span> LigneIncomplete = <span class="kw1">True</span>: <span class="kw1">Exit</span> <span class="kw1">For</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Next</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Loop</span> <span class="kw1">While</span> LigneIncomplete = <span class="kw1">True</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Et on finit par le bas</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; curseur_y = <span class="nu0">0</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Do</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; curseur_y = curseur_y + <span class="nu0">1</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; LigneIncomplete = <span class="kw1">False</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Utilisation_Filigrane <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; BitBlt R_DC, <span class="nu0">0</span>, curseur_y - <span class="nu0">1</span>, LLargeur, <span class="nu0">1</span>, Image_A_Blitter_DC, <span class="nu0">0</span>, curseur_y - <span class="nu0">1</span>, vbSrcCopy<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Else</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; BitBlt R_DC, <span class="nu0">0</span>, curseur_y - <span class="nu0">1</span>, LLargeur, <span class="nu0">1</span>, C_dc, <span class="nu0">0</span>, <span class="nu0">0</span>, &amp;HFF0062<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">For</span> curseur_x = <span class="nu0">0</span> <span class="kw1">To</span> LLargeur<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> GetPixel<span class="br0">&#40;</span>R_DC, curseur_x, curseur_y<span class="br0">&#41;</span> = <span class="kw1">vbBlack</span> <span class="kw1">Then</span> LigneIncomplete = <span class="kw1">True</span>: <span class="kw1">Exit</span> <span class="kw1">For</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Next</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Loop</span> <span class="kw1">While</span> LigneIncomplete = <span class="kw1">True</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">SavePicture</span> Resultat.<span class="me1">Image</span>, <span class="kw1">base</span> &amp; <span class="kw1">FORMAT</span>$<span class="br0">&#40;</span>numero, <span class="st0">&quot;0000&quot;</span><span class="br0">&#41;</span> &amp; <span class="st0">&quot;.bmp&quot;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; numero = numero + <span class="nu0">1</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Envoyer un message : pagedown et scroll</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; SendMessage Converter_Hwnd, WM_VSCROLL, SB_PAGEDOWN, <span class="nu0">0</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Retour &lt; TinySize <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Retour = Retour + <span class="nu0">1500</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Else</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Envoyer un message : avoir la position en fonction d'un point(le bord droit du RTB)</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Retour = SendMessage<span class="br0">&#40;</span>Converter_Hwnd, EM_CHARFROMPOS, <span class="nu0">0</span>&amp;, pt<span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Puis on remet à jour le progress bar...</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; BitBlt ProgressBar_DC, <span class="nu0">0</span>, <span class="nu0">3</span>, <span class="nu0">563</span>, <span class="nu0">21</span>, ProgressBar_BACK.<span class="me1">hdc</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, vbSrcCopy<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; StretchBlt ProgressBar_DC, <span class="nu0">1</span>, <span class="nu0">28</span>, <span class="br0">&#40;</span>Retour * <span class="nu0">561</span><span class="br0">&#41;</span> \ Size, <span class="nu0">19</span>, ProgressBar_FORE_DC, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">67</span>, <span class="nu0">19</span>, vbSrcCopy<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; TextOut ProgressBar_DC, <span class="nu0">275</span>, <span class="nu0">30</span>, <span class="kw1">FORMAT</span>$<span class="br0">&#40;</span><span class="br0">&#40;</span>Retour * <span class="nu0">100</span><span class="br0">&#41;</span> \ Size, <span class="st0">&quot;000&quot;</span><span class="br0">&#41;</span> &amp; <span class="st0">&quot;%&quot;</span>, <span class="nu0">4</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Barre d'avancement</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; StretchBlt ProgressBar_DC, <span class="nu0">1</span>, <span class="nu0">4</span>, <span class="br0">&#40;</span>Retour * <span class="nu0">561</span><span class="br0">&#41;</span> \ Size, <span class="nu0">19</span>, ProgressBar_FORE_DC, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">67</span>, <span class="nu0">19</span>, vbSrcCopy<br />

&nbsp; &nbsp; &nbsp; &nbsp; ProgressBar.<span class="me1">Refresh</span><br />
&nbsp; &nbsp; <span class="kw1">Loop</span> <span class="kw1">While</span> Retour &lt;&gt; Size<br />

<br />
&nbsp; &nbsp; <span class="co1">'If LastLen &lt; TotalLen Then</span><br />
&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;numero = numero - 1</span><br />
&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;GoTo demarrage</span><br />

&nbsp; &nbsp; <span class="co1">'End If</span><br />
&nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> = etiquette<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> &amp; LoadString<span class="br0">&#40;</span><span class="nu0">14</span><span class="br0">&#41;</span> &amp; <span class="kw1">vbCrLf</span><br />

&nbsp; &nbsp; <span class="co1">'Détruire les dernière image blanches</span><br />
&nbsp; &nbsp; tempo = <span class="nu0">0</span><br />
&nbsp; &nbsp; Image_A_Blitter.<span class="me1">Visible</span> = <span class="kw1">True</span><br />

&nbsp; &nbsp; Converter.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; Image_A_Blitter.<span class="kw1">Left</span> = <span class="nu0">5</span><br />
&nbsp; &nbsp; Image_A_Blitter.<span class="me1">Top</span> = <span class="nu0">50</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">Do</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; tempo = tempo + <span class="nu0">1</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Image_A_Blitter.<span class="me1">Picture</span> = <span class="kw1">LoadPicture</span><span class="br0">&#40;</span><span class="kw1">base</span> &amp; <span class="kw1">FORMAT</span>$<span class="br0">&#40;</span>numero - tempo, <span class="st0">&quot;0000&quot;</span><span class="br0">&#41;</span> &amp; <span class="st0">&quot;.bmp&quot;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Size = <span class="nu0">0</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Check les images blanches</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Dim</span> NouLarg <span class="kw1">As</span> <span class="kw1">Long</span>, NouHaut <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; NouLarg = LLargeur - <span class="nu0">5</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; NouHaut = HHauteur - <span class="nu0">5</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">For</span> Xp = <span class="nu0">5</span> <span class="kw1">To</span> NouLarg<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">For</span> Yp = <span class="nu0">5</span> <span class="kw1">To</span> NouHaut<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Size = Size + <span class="br0">&#40;</span><span class="nu0">16777215</span> - GetPixel<span class="br0">&#40;</span>Image_A_Blitter.<span class="me1">hdc</span>, Xp, Yp<span class="br0">&#41;</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Size &gt; <span class="nu0">1</span> <span class="kw1">Then</span> Size = <span class="nu0">1</span>: <span class="kw1">Exit</span> <span class="kw1">For</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Size &gt;= <span class="nu0">1</span> <span class="kw1">Then</span> <span class="kw1">Exit</span> <span class="kw1">For</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Size = <span class="nu0">0</span> <span class="kw1">Then</span> <span class="kw1">Kill</span> <span class="kw1">base</span> &amp; <span class="kw1">FORMAT</span>$<span class="br0">&#40;</span>numero - tempo, <span class="st0">&quot;0000&quot;</span><span class="br0">&#41;</span> &amp; <span class="st0">&quot;.bmp&quot;</span><br />

&nbsp; &nbsp; <span class="kw1">Loop</span> <span class="kw1">While</span> Size = <span class="nu0">0</span><br />
<br />
&nbsp; &nbsp; numero = numero - tempo<br />
&nbsp; &nbsp; BitBlt ProgressBar_DC, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">563</span>, <span class="nu0">48</span>, myHDC, ProgressBar.<span class="kw1">Left</span>, <span class="nu0">0</span>, vbSrcCopy<br />

&nbsp; &nbsp; BitBlt ProgressBar_DC, <span class="nu0">0</span>, <span class="nu0">3</span>, <span class="nu0">563</span>, <span class="nu0">21</span>, ProgressBar_BACK.<span class="me1">hdc</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, vbSrcCopy<br />

<br />
&nbsp; &nbsp; <span class="kw1">If</span> JPG <span class="kw1">Then</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Conversion en JPG</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> = etiquette<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> &amp; LoadString<span class="br0">&#40;</span><span class="nu0">15</span><span class="br0">&#41;</span> &amp; <span class="kw1">vbCrLf</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">MousePointer</span> = vbCustom<br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">For</span> tempo = <span class="nu0">0</span> <span class="kw1">To</span> numero<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Convert <span class="kw1">base</span> &amp; <span class="kw1">FORMAT</span>$<span class="br0">&#40;</span>tempo, <span class="st0">&quot;0000&quot;</span><span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; StretchBlt ProgressBar_DC, <span class="nu0">1</span>, <span class="nu0">4</span>, <span class="br0">&#40;</span><span class="nu0">600</span> * tempo<span class="br0">&#41;</span> \ numero, <span class="nu0">19</span>, ProgressBar_FORE_DC, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">67</span>, <span class="nu0">19</span>, vbSrcCopy<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ProgressBar.<span class="me1">Refresh</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Kill</span> <span class="kw1">base</span> &amp; <span class="kw1">FORMAT</span>$<span class="br0">&#40;</span>tempo, <span class="st0">&quot;0000&quot;</span><span class="br0">&#41;</span> &amp; <span class="st0">&quot;.bmp&quot;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; Converter.<span class="me1">Visible</span> = <span class="kw1">False</span><br />

&nbsp; &nbsp; Resultat.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; Image_A_Blitter.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
<br />

&nbsp; &nbsp; <span class="kw1">If</span> SplitChapter.<span class="me1">Value</span> <span class="kw1">Then</span> Numeriser: <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />
&nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> = etiquette<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> &amp; Replace<span class="br0">&#40;</span>LoadString<span class="br0">&#40;</span><span class="nu0">16</span><span class="br0">&#41;</span>, <span class="st0">&quot;%u&quot;</span>, numero<span class="br0">&#41;</span> &amp; <span class="kw1">vbCrLf</span> &amp; LoadString<span class="br0">&#40;</span><span class="nu0">18</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
&nbsp; &nbsp; <span class="co1">'Et voilà ! C'est terminé !</span><br />
&nbsp; &nbsp; <span class="co1">'D'abord, on enregistre l'adresse du fichier</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> PutACopyOfFileInFolder <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Last_File&quot;</span>, <span class="kw1">base</span> &amp; nom_Fichier &amp; <span class="st0">&quot;.rtf&quot;</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
&nbsp; &nbsp; ShellExecute <span class="kw1">Me</span>.<span class="me1">hwnd</span>, <span class="st0">&quot;open&quot;</span>, app_path &amp; <span class="st0">&quot;\&quot;</span> &amp; Dest_Folder.<span class="me1">Text</span> &amp; <span class="st0">&quot;\&quot;</span>, <span class="kw1">vbNullString</span>, App.<span class="me1">Path</span>, <span class="nu0">1</span><br />

&nbsp; &nbsp; <span class="kw1">Unload</span> <span class="kw1">Me</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> ReglerPriorite<span class="br0">&#40;</span>Niveau <span class="kw1">As</span> <span class="kw1">String</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="co1">'Fonction réglant la priorité en cas de besoin, selon le niveau demandé</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> Niveau = <span class="st0">&quot;ABOVE_NORMAL_PRIORITY_CLASS&quot;</span> <span class="kw1">Then</span> SetPriorityClass GetCurrentProcess<span class="br0">&#40;</span><span class="br0">&#41;</span>, ABOVE_NORMAL_PRIORITY_CLASS<br />

&nbsp; &nbsp; <span class="kw1">If</span> Niveau = <span class="st0">&quot;HIGH_PRIORITY_CLASS&quot;</span> <span class="kw1">Then</span> SetPriorityClass GetCurrentProcess<span class="br0">&#40;</span><span class="br0">&#41;</span>, HIGH_PRIORITY_CLASS<br />
&nbsp; &nbsp; <span class="kw1">If</span> Niveau = <span class="st0">&quot;REALTIME_PRIORITY_CLASS&quot;</span> <span class="kw1">Then</span> SetPriorityClass GetCurrentProcess<span class="br0">&#40;</span><span class="br0">&#41;</span>, REALTIME_PRIORITY_CLASS<br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Convert<span class="br0">&#40;</span>Entree <span class="kw1">As</span> <span class="kw1">String</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; <span class="co1">'Convertit l'image d'entrée de BMP vers JPG</span><br />
&nbsp; &nbsp; BMP2JPGpourVBFrance Entree &amp; <span class="st0">&quot;.bmp&quot;</span>, Entree &amp; <span class="st0">&quot;.jpg&quot;</span>, Qualite.<span class="me1">Tag</span> &nbsp;<span class="co1">'qualité réglable de 1 à 100</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Public</span> <span class="kw1">Sub</span> Download<span class="br0">&#40;</span>URL <span class="kw1">As</span> <span class="kw1">String</span>, Optional Stockage2 <span class="kw1">As</span> <span class="kw1">String</span> = <span class="st0">&quot;Nothing&quot;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="co1">'Telecharge un fichier spécifié</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> NoInternet = <span class="kw1">True</span> <span class="kw1">Then</span> <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />

&nbsp; &nbsp; <span class="kw1">If</span> Stockage2 = <span class="st0">&quot;Nothing&quot;</span> <span class="kw1">Then</span> Stockage2 = Stockage<br />
<br />
&nbsp; &nbsp; <span class="kw1">Dim</span> hOpen &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<span class="kw1">As</span> <span class="kw1">Long</span>, App_Name <span class="kw1">As</span> <span class="kw1">String</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">Dim</span> hOpenUrl &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">As</span> <span class="kw1">Long</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">Dim</span> bDoLoop &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<span class="kw1">As</span> <span class="kw1">Boolean</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">Dim</span> sReadBuffer &nbsp; &nbsp; &nbsp; &nbsp;<span class="kw1">As</span> <span class="kw1">String</span> * <span class="nu0">2048</span><br />
<br />

&nbsp; &nbsp; <span class="kw1">Dim</span> lNumberOfBytesRead <span class="kw1">As</span> <span class="kw1">Long</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">Dim</span> sBuffer &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<span class="kw1">As</span> <span class="kw1">String</span><br />

<br />
&nbsp; &nbsp; App_Name = <span class="kw1">Me</span>.<span class="me1">Caption</span><br />
&nbsp; &nbsp; lNumberOfBytesRead = <span class="nu0">0</span><br />
&nbsp; &nbsp; debut = GetTickCount<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">Caption</span> = <span class="st0">&quot;TXT 2 JPG =&gt;&quot;</span> &amp; LoadString<span class="br0">&#40;</span><span class="nu0">19</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="co1">'Vider les déchets</span><br />

&nbsp; &nbsp; <span class="kw1">Kill</span> Stockage2<br />
&nbsp; &nbsp; <span class="kw1">Open</span> Stockage2 <span class="kw1">For</span> Output <span class="kw1">As</span> #<span class="nu0">1</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Print</span> #<span class="nu0">1</span>, <span class="kw1">vbNullString</span><br />
&nbsp; &nbsp; <span class="kw1">Close</span> #<span class="nu0">1</span><br />

&nbsp; &nbsp; hOpen = InternetOpen<span class="br0">&#40;</span><span class="st0">&quot;Zen User&quot;</span>, <span class="nu0">0</span>, <span class="kw1">vbNullString</span>, <span class="kw1">vbNullString</span>, <span class="nu0">0</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; hOpenUrl = InternetOpenUrl<span class="br0">&#40;</span>hOpen, URL, <span class="kw1">vbNullString</span>, <span class="nu0">0</span>, &amp;H80000000, <span class="nu0">0</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; bDoLoop = <span class="kw1">True</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">While</span> bDoLoop<br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; sReadBuffer = <span class="kw1">vbNullString</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; InternetReadFile hOpenUrl, sReadBuffer, <span class="kw1">Len</span><span class="br0">&#40;</span>sReadBuffer<span class="br0">&#41;</span>, lNumberOfBytesRead<br />
&nbsp; &nbsp; &nbsp; &nbsp; sBuffer = sBuffer &amp; <span class="kw1">Left</span>$<span class="br0">&#40;</span>sReadBuffer, lNumberOfBytesRead<span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Not</span> <span class="kw1">CBool</span><span class="br0">&#40;</span>lNumberOfBytesRead<span class="br0">&#41;</span> <span class="kw1">Then</span> bDoLoop = <span class="kw1">False</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> GetTickCount - debut &gt; <span class="nu0">5000</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">MsgBox</span> LoadString<span class="br0">&#40;</span><span class="nu0">20</span><span class="br0">&#41;</span>, <span class="kw1">vbExclamation</span> + <span class="kw1">vbOKOnly</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; NoInternet = <span class="kw1">True</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">GoTo</span> err_handler<br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">Wend</span><br />
<br />
err_handler:<br />
&nbsp; &nbsp; <span class="kw1">Open</span> Stockage2 <span class="kw1">For</span> Binary Access <span class="kw1">Write</span> <span class="kw1">As</span> #<span class="nu0">1</span><br />

&nbsp; &nbsp; <span class="kw1">Put</span> #<span class="nu0">1</span>, , sBuffer<br />
&nbsp; &nbsp; <span class="kw1">Close</span> #<span class="nu0">1</span><br />
&nbsp; &nbsp; <span class="kw1">DoEvents</span><br />

&nbsp; &nbsp; <span class="kw1">If</span> hOpenUrl &lt;&gt; <span class="nu0">0</span> <span class="kw1">Then</span> InternetCloseHandle <span class="br0">&#40;</span>hOpenUrl<span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> hOpen &lt;&gt; <span class="nu0">0</span> <span class="kw1">Then</span> InternetCloseHandle <span class="br0">&#40;</span>hOpen<span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">Caption</span> = App_Name<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="co1">'Redessine la feuille et les conteneurs, appelable lors d'un redimensionnement par exemple</span><br />
<span class="kw1">Public</span> <span class="kw1">Sub</span> Form_Redraw<span class="br0">&#40;</span>Optional cWidth <span class="kw1">As</span> <span class="kw1">Long</span> = <span class="nu0">0</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> cWidth = <span class="nu0">0</span> <span class="kw1">Then</span> cWidth = <span class="kw1">Me</span>.<span class="me1">ScaleWidth</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">Dim</span> Hauteur_f <span class="kw1">As</span> <span class="kw1">Long</span>, PreCompile <span class="kw1">As</span> <span class="kw1">Single</span><br />
<br />
&nbsp; &nbsp; Hauteur_f = <span class="kw1">Me</span>.<span class="me1">ScaleHeight</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;BackPic&quot;</span>, <span class="kw1">vbNullString</span><span class="br0">&#41;</span> = <span class="kw1">vbNullString</span> <span class="kw1">Then</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Dessiner le BG</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">For</span> tempo = <span class="nu0">0</span> <span class="kw1">To</span> Hauteur_f<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; PreCompile = <span class="kw1">Abs</span><span class="br0">&#40;</span><span class="nu0">255</span> * sens_dessin - <span class="br0">&#40;</span><span class="br0">&#40;</span><span class="nu0">255</span> * tempo<span class="br0">&#41;</span> \ Hauteur_f<span class="br0">&#41;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SetPixelV myHDC, <span class="nu0">0</span>, tempo, <span class="kw1">RGB</span><span class="br0">&#40;</span>BG_red * PreCompile, BG_green * PreCompile, BG_blue * PreCompile<span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Next</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Le stretcher</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; StretchBlt myHDC, <span class="nu0">0</span>, <span class="nu0">0</span>, cWidth, Hauteur_f, myHDC, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">1</span>, Hauteur_f, vbSrcCopy<br />

&nbsp; &nbsp; <span class="kw1">Else</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">PaintPicture</span> BackPicture, <span class="nu0">0</span>, <span class="nu0">0</span>, cWidth, <span class="kw1">Me</span>.<span class="me1">ScaleHeight</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> CleverColor <span class="kw1">Then</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">For</span> tempo = <span class="nu0">0</span> <span class="kw1">To</span> etiquette.<span class="kw1">UBound</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span>tempo<span class="br0">&#41;</span>.<span class="me1">ForeColor</span> = <span class="kw1">IIf</span><span class="br0">&#40;</span>GetPixel<span class="br0">&#40;</span>myHDC, etiquette<span class="br0">&#40;</span>tempo<span class="br0">&#41;</span>.<span class="kw1">Left</span>, etiquette<span class="br0">&#40;</span>tempo<span class="br0">&#41;</span>.<span class="me1">Top</span><span class="br0">&#41;</span> &gt; <span class="nu0">8421504</span>, <span class="kw1">vbBlack</span>, <span class="kw1">vbWhite</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">Refresh</span><br />

&nbsp; &nbsp; MAJ.<span class="me1">Enabled</span> = <span class="kw1">True</span><br />
<br />
&nbsp; &nbsp; <span class="co1">'Les conteneurs :</span><br />
&nbsp; &nbsp; <span class="kw1">For</span> tempo = <span class="nu0">0</span> <span class="kw1">To</span> PlugChoice.<span class="kw1">Count</span> - <span class="nu0">1</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> PlugChoice<span class="br0">&#40;</span>tempo<span class="br0">&#41;</span>.<span class="me1">Value</span> = <span class="nu0">0</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; PlugChoice<span class="br0">&#40;</span>tempo<span class="br0">&#41;</span>.<span class="me1">BackColor</span> = GetPixel<span class="br0">&#40;</span>myHDC, PlugChoice<span class="br0">&#40;</span>tempo<span class="br0">&#41;</span>.<span class="kw1">Left</span> + PlugChoice<span class="br0">&#40;</span>tempo<span class="br0">&#41;</span>.<span class="me1">Container</span>.<span class="kw1">Left</span>, PlugChoice<span class="br0">&#40;</span>tempo<span class="br0">&#41;</span>.<span class="me1">Top</span> + PlugChoice<span class="br0">&#40;</span>tempo<span class="br0">&#41;</span>.<span class="me1">Container</span>.<span class="me1">Top</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; PlugChoice<span class="br0">&#40;</span>tempo<span class="br0">&#41;</span>.<span class="me1">ForeColor</span> = <span class="nu0">16777215</span> - PlugChoice<span class="br0">&#40;</span>tempo<span class="br0">&#41;</span>.<span class="me1">BackColor</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Else</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; PlugChoice<span class="br0">&#40;</span>tempo<span class="br0">&#41;</span>.<span class="me1">BackColor</span> = &amp;H8000000F<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; PlugChoice<span class="br0">&#40;</span>tempo<span class="br0">&#41;</span>.<span class="me1">ForeColor</span> = &amp;H80000012<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; BitBlt SelectedPlug.<span class="me1">hdc</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">176</span>, <span class="nu0">289</span>, myHDC, SelectedPlug.<span class="kw1">Left</span>, SelectedPlug.<span class="me1">Top</span>, vbSrcCopy<br />

&nbsp; &nbsp; BitBlt MainContainer.<span class="me1">hdc</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">168</span>, <span class="nu0">302</span>, myHDC, MainContainer.<span class="kw1">Left</span>, MainContainer.<span class="me1">Top</span>, vbSrcCopy<br />

&nbsp; &nbsp; SelectedPlug.<span class="me1">Refresh</span><br />
&nbsp; &nbsp; MainContainer.<span class="me1">Refresh</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Load_Text_File<span class="br0">&#40;</span>File_Path <span class="kw1">As</span> <span class="kw1">String</span>, Optional ISAnInternetURL <span class="kw1">As</span> <span class="kw1">Boolean</span> = <span class="kw1">False</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="co1">'Objets ole utilisés pour charger les formats exotiques, et les formats standards aussi. Gestion htm, pdf,lrc,doc,txt,rtf.</span><br />
&nbsp; &nbsp; <span class="co1">'On Error GoTo err_handler</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">Dim</span> oWord &nbsp; <span class="kw1">As</span> Object<br />

<br />
&nbsp; &nbsp; <span class="kw1">Dim</span> oDoc &nbsp; &nbsp;<span class="kw1">As</span> Object<br />
<br />
&nbsp; &nbsp; <span class="kw1">Dim</span> oIE &nbsp; &nbsp; <span class="kw1">As</span> Object<br />

<br />
&nbsp; &nbsp; <span class="kw1">Dim</span> donnees <span class="kw1">As</span> <span class="kw1">String</span>, auteur <span class="kw1">As</span> <span class="kw1">String</span>, Start <span class="kw1">As</span> <span class="kw1">Long</span>, total <span class="kw1">As</span> <span class="kw1">Long</span>, Titre <span class="kw1">As</span> <span class="kw1">String</span><br />

<br />
&nbsp; &nbsp; Apercu.<span class="me1">TextRTF</span> = <span class="kw1">vbNullString</span><br />
&nbsp; &nbsp; Apercu.<span class="me1">Text</span> = LoadString<span class="br0">&#40;</span><span class="nu0">21</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="co1">'Charge un fichier autorisé (3 sources : browse_click + ole apercu et directory)</span><br />
&nbsp; &nbsp; Directory.<span class="me1">Text</span> = File_Path<br />
&nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">MousePointer</span> = vbCustom<br />

<br />
&nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">LCase</span>$<span class="br0">&#40;</span><span class="kw1">Right</span>$<span class="br0">&#40;</span>Directory.<span class="me1">Text</span>, <span class="nu0">3</span><span class="br0">&#41;</span><span class="br0">&#41;</span> = <span class="st0">&quot;txt&quot;</span> <span class="kw1">Or</span> <span class="kw1">LCase</span>$<span class="br0">&#40;</span><span class="kw1">Right</span>$<span class="br0">&#40;</span>Directory.<span class="me1">Text</span>, <span class="nu0">3</span><span class="br0">&#41;</span><span class="br0">&#41;</span> = <span class="st0">&quot;rtf&quot;</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'---------------------------------------------&gt;Fichiers txt et rtf&gt;---------------------------------------------</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">LoadFile</span> Directory.<span class="me1">Text</span><br />

&nbsp; &nbsp; <span class="kw1">Else</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">LCase</span>$<span class="br0">&#40;</span><span class="kw1">Right</span>$<span class="br0">&#40;</span>Directory.<span class="me1">Text</span>, <span class="nu0">3</span><span class="br0">&#41;</span><span class="br0">&#41;</span> = <span class="st0">&quot;doc&quot;</span> <span class="kw1">Or</span> <span class="kw1">LCase</span>$<span class="br0">&#40;</span><span class="kw1">Right</span>$<span class="br0">&#40;</span>Directory.<span class="me1">Text</span>, <span class="nu0">4</span><span class="br0">&#41;</span><span class="br0">&#41;</span> = <span class="st0">&quot;docx&quot;</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'---------------------------------------------&gt;Fichiers doc&gt;---------------------------------------------</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Créer l'application Word</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Set</span> oWord = <span class="kw1">CreateObject</span><span class="br0">&#40;</span><span class="st0">&quot;word.application&quot;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Ouvrir le document</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Set</span> oDoc = oWord.<span class="me1">documents</span>.<span class="me1">Add</span><span class="br0">&#40;</span>File_Path<span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">TextRTF</span> = LoadString<span class="br0">&#40;</span><span class="nu0">22</span><span class="br0">&#41;</span> &amp; <span class="kw1">vbCrLf</span> &amp; LoadString<span class="br0">&#40;</span><span class="nu0">23</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; oWord.<span class="me1">Application</span>.<span class="me1">Selection</span>.<span class="me1">WholeStory</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; oWord.<span class="me1">Application</span>.<span class="me1">Selection</span>.<span class="me1">Copy</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; oWord.<span class="me1">Quit</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Set</span> oWord = <span class="kw1">Nothing</span> &nbsp; &nbsp;<span class="co1">' détruire l'objet Word</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">TextRTF</span> = LoadString<span class="br0">&#40;</span><span class="nu0">24</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; CollerWordFile.<span class="me1">Enabled</span> = <span class="kw1">True</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">ElseIf</span> ISAnInternetURL <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'---------------------------------------------&gt;Fichiers Internet : htm,asp,xhtml,html,php...&gt;---------------------------------------------</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Créer l'instance d'IE</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Set</span> oIE = <span class="kw1">CreateObject</span><span class="br0">&#40;</span><span class="st0">&quot;internetexplorer.application&quot;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Telecharger la page en arrière plan</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; oIE.<span class="me1">Navigate</span> <span class="br0">&#40;</span>File_Path<span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">TextRTF</span> = LoadString<span class="br0">&#40;</span><span class="nu0">25</span><span class="br0">&#41;</span> &amp; <span class="kw1">vbCrLf</span> &amp; LoadString<span class="br0">&#40;</span><span class="nu0">26</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Attendre la fin du telechargement pour continuer</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Do</span> <span class="kw1">While</span> <span class="br0">&#40;</span>oIE.<span class="me1">ReadyState</span> &lt;&gt; <span class="nu0">4</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Loop</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">TextRTF</span> = LoadString<span class="br0">&#40;</span><span class="nu0">27</span><span class="br0">&#41;</span> &amp; <span class="kw1">vbCrLf</span> &amp; LoadString<span class="br0">&#40;</span><span class="nu0">28</span><span class="br0">&#41;</span> &amp; <span class="kw1">vbCrLf</span> &amp; LoadString<span class="br0">&#40;</span><span class="nu0">29</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Copier l'adresse</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; oIE.<span class="me1">Document</span>.<span class="me1">body</span>.<span class="me1">createTextRange</span>.<span class="me1">execCommand</span> <span class="br0">&#40;</span><span class="st0">&quot;Copy&quot;</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; oIE.<span class="me1">Quit</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Set</span> oIE = <span class="kw1">Nothing</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">TextRTF</span> = LoadString<span class="br0">&#40;</span><span class="nu0">30</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; CollerWordFile.<span class="me1">Enabled</span> = <span class="kw1">True</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; AfficherTip LoadMSG<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>, LoadMSG<span class="br0">&#40;</span><span class="nu0">2</span><span class="br0">&#41;</span>, PlugChoice<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>, <span class="kw1">False</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Download File_Path</span><br />

<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Open Stockage For Input As #1</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;donnees = vbNullString</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Do Until EOF(1) = -1</span><br />

<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Line Input #1, Titre</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;donnees = donnees &amp; Titre</span><br />

<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Loop</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Close #1</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Apercu.Text = Replace(Replace(Replace(Replace(Replace(Replace(Replace(donnees, vbCrLf, &quot;&quot;), &quot;&lt;br&gt;&quot;, vbCrLf), &quot;&lt;br/&gt;&quot;, vbCrLf), &quot;&lt;br /&gt;&quot;, vbCrLf), &quot;&lt;p&gt;&quot;, vbCrLf), &quot;&lt;/p&gt;&quot;, vbCrLf), &quot;&lt;/li&gt;&quot;, vbCrLf)</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">ElseIf</span> <span class="kw1">LCase</span>$<span class="br0">&#40;</span><span class="kw1">Right</span>$<span class="br0">&#40;</span>Directory.<span class="me1">Text</span>, <span class="nu0">3</span><span class="br0">&#41;</span><span class="br0">&#41;</span> = <span class="st0">&quot;pdf&quot;</span> <span class="kw1">Then</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'---------------------------------------------&gt;Fichiers PDf&gt;---------------------------------------------</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">vbNo</span> = <span class="kw1">MsgBox</span><span class="br0">&#40;</span>LoadString<span class="br0">&#40;</span><span class="nu0">31</span><span class="br0">&#41;</span>, <span class="st0">&quot;TXT2JPG&quot;</span><span class="br0">&#41;</span> <span class="kw1">Then</span> <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">TextRTF</span> = LoadString<span class="br0">&#40;</span><span class="nu0">32</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ShellExecute <span class="kw1">Me</span>.<span class="me1">hwnd</span>, <span class="st0">&quot;open&quot;</span>, LoadString<span class="br0">&#40;</span><span class="nu0">33</span><span class="br0">&#41;</span>, <span class="kw1">vbNullString</span>, App.<span class="me1">Path</span>, <span class="nu0">1</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">TextRTF</span> = <span class="st0">&quot;Path : &quot;</span> &amp; File_Path<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">ElseIf</span> <span class="kw1">LCase</span>$<span class="br0">&#40;</span><span class="kw1">Right</span>$<span class="br0">&#40;</span>Directory.<span class="me1">Text</span>, <span class="nu0">3</span><span class="br0">&#41;</span><span class="br0">&#41;</span> = <span class="st0">&quot;lrc&quot;</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'---------------------------------------------&gt;Fichiers lrc contenant les lyrics d'une chanson&gt;---------------------------------------------</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">LoadFile</span> Directory.<span class="me1">Text</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; donnees = Apercu.<span class="me1">Text</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">Text</span> = LoadString<span class="br0">&#40;</span><span class="nu0">34</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; auteur = MyMid<span class="br0">&#40;</span>donnees, <span class="st0">&quot;[by:&quot;</span>, <span class="st0">&quot;]&quot;</span>, <span class="nu0">1</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Titre = MyMid<span class="br0">&#40;</span>donnees, <span class="st0">&quot;[ti:&quot;</span>, <span class="st0">&quot;]&quot;</span>, <span class="nu0">1</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Titre = <span class="kw1">vbNullString</span> <span class="kw1">Then</span> Titre = <span class="kw1">InputBox</span><span class="br0">&#40;</span>LoadString<span class="br0">&#40;</span><span class="nu0">35</span><span class="br0">&#41;</span>, LoadString<span class="br0">&#40;</span><span class="nu0">36</span><span class="br0">&#41;</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; donnees = Titre &amp; <span class="kw1">vbCrLf</span> &amp; donnees<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; donnees = Replace<span class="br0">&#40;</span>donnees, <span class="st0">&quot;[by:&quot;</span> &amp; auteur &amp; <span class="st0">&quot;]&quot;</span>, <span class="st0">&quot;Par : &quot;</span> &amp; <span class="kw1">IIf</span><span class="br0">&#40;</span>auteur &lt;&gt; <span class="kw1">vbNullString</span>, auteur, <span class="st0">&quot;----&quot;</span><span class="br0">&#41;</span> &amp; <span class="kw1">vbCrLf</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; total = <span class="kw1">Len</span><span class="br0">&#40;</span>donnees<span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">For</span> tempo = <span class="nu0">1</span> <span class="kw1">To</span> total<br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Mid</span>$<span class="br0">&#40;</span>donnees, tempo, <span class="nu0">1</span><span class="br0">&#41;</span> = <span class="st0">&quot;[&quot;</span> <span class="kw1">Then</span> Start = tempo<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Mid</span>$<span class="br0">&#40;</span>donnees, tempo, <span class="nu0">1</span><span class="br0">&#41;</span> = <span class="st0">&quot;]&quot;</span> <span class="kw1">Then</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; donnees = Replace<span class="br0">&#40;</span>donnees, <span class="kw1">Mid</span>$<span class="br0">&#40;</span>donnees, Start, tempo - Start + <span class="nu0">1</span><span class="br0">&#41;</span>, <span class="kw1">vbNullString</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; tempo = Start <span class="co1">'Si deux balises à la suite</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; total = <span class="kw1">Len</span><span class="br0">&#40;</span>donnees<span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Next</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; total = <span class="kw1">Len</span><span class="br0">&#40;</span>donnees<span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">For</span> tempo = <span class="nu0">1</span> <span class="kw1">To</span> total<br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Mid</span>$<span class="br0">&#40;</span>donnees, tempo, <span class="nu0">1</span><span class="br0">&#41;</span> = <span class="st0">&quot;&lt;&quot;</span> <span class="kw1">Then</span> Start = tempo<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Mid</span>$<span class="br0">&#40;</span>donnees, tempo, <span class="nu0">1</span><span class="br0">&#41;</span> = <span class="st0">&quot;&gt;&quot;</span> <span class="kw1">Then</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; donnees = Replace<span class="br0">&#40;</span>donnees, <span class="kw1">Mid</span>$<span class="br0">&#40;</span>donnees, Start, tempo - Start + <span class="nu0">1</span><span class="br0">&#41;</span>, <span class="kw1">vbNullString</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; tempo = Start <span class="co1">'Si deux balises à la suite</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; total = <span class="kw1">Len</span><span class="br0">&#40;</span>donnees<span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Next</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; NoSelEvents = <span class="kw1">True</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">With</span> Apercu<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">Text</span> = donnees<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">SelStart</span> = <span class="nu0">0</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">SelLength</span> = <span class="kw1">InStr</span><span class="br0">&#40;</span><span class="nu0">1</span>, donnees, <span class="kw1">vbCrLf</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">SelUnderline</span> = <span class="kw1">True</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">SelColor</span> = <span class="kw1">vbRed</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">SelFontSize</span> = <span class="nu0">11</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">SelStart</span> = <span class="kw1">InStr</span><span class="br0">&#40;</span><span class="nu0">1</span>, donnees, <span class="st0">&quot;Par : &quot;</span> &amp; <span class="kw1">IIf</span><span class="br0">&#40;</span>auteur &lt;&gt; <span class="kw1">vbNullString</span>, auteur, <span class="st0">&quot;----&quot;</span><span class="br0">&#41;</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> .<span class="me1">SelStart</span> &lt;&gt; <span class="nu0">0</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">SelStart</span> = .<span class="me1">SelStart</span> - <span class="nu0">1</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">SelLength</span> = <span class="kw1">Len</span><span class="br0">&#40;</span><span class="st0">&quot;Par : &quot;</span> &amp; auteur<span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">SelItalic</span> = <span class="kw1">True</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">SelFontSize</span> = <span class="nu0">7</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">SelColor</span> = <span class="kw1">RGB</span><span class="br0">&#40;</span><span class="nu0">128</span>, <span class="nu0">128</span>, <span class="nu0">128</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">SelStart</span> = <span class="nu0">0</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">SelLength</span> = <span class="nu0">0</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">With</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; NoSelEvents = <span class="kw1">False</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Else</span><br />
<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'---------------------------------------------&gt;Fichiers non reconnus mais lisibles en mode texte&gt;---------------------------------------------</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">vbNo</span> = <span class="kw1">MsgBox</span><span class="br0">&#40;</span>LoadString<span class="br0">&#40;</span><span class="nu0">37</span><span class="br0">&#41;</span>, <span class="kw1">vbYesNo</span> + <span class="kw1">vbExclamation</span>, <span class="st0">&quot;TXT2JPG&quot;</span><span class="br0">&#41;</span> <span class="kw1">Then</span> <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">LoadFile</span> Directory.<span class="me1">Text</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Not</span> <span class="br0">&#40;</span>ISAnInternetURL<span class="br0">&#41;</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Dest_Folder_GotTheFocus<br />
&nbsp; &nbsp; &nbsp; &nbsp; Dest_Folder.<span class="me1">Text</span> = <span class="kw1">Right</span>$<span class="br0">&#40;</span>Directory.<span class="me1">Text</span>, <span class="kw1">Len</span><span class="br0">&#40;</span>Directory.<span class="me1">Text</span><span class="br0">&#41;</span> - <span class="kw1">InStrRev</span><span class="br0">&#40;</span>Directory.<span class="me1">Text</span>, <span class="st0">&quot;\&quot;</span><span class="br0">&#41;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Dest_Folder.<span class="me1">Text</span> = <span class="kw1">Left</span>$<span class="br0">&#40;</span>Dest_Folder.<span class="me1">Text</span>, <span class="kw1">Len</span><span class="br0">&#40;</span>Dest_Folder.<span class="me1">Text</span><span class="br0">&#41;</span> - <span class="nu0">4</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">Else</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Dest_Folder_GotTheFocus<br />
&nbsp; &nbsp; &nbsp; &nbsp; Dest_Folder.<span class="me1">Text</span> = <span class="kw1">Right</span>$<span class="br0">&#40;</span>Directory.<span class="me1">Text</span>, <span class="kw1">Len</span><span class="br0">&#40;</span>Directory.<span class="me1">Text</span><span class="br0">&#41;</span> - <span class="kw1">InStrRev</span><span class="br0">&#40;</span>Directory.<span class="me1">Text</span>, <span class="st0">&quot;/&quot;</span><span class="br0">&#41;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; Dest_Folder.<span class="me1">SetFocus</span><br />
&nbsp; &nbsp; Apercu.<span class="me1">SelStart</span> = <span class="nu0">1</span><br />

&nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">MousePointer</span> = <span class="nu0">0</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />
<br />

err_handler:<br />
&nbsp; &nbsp; AfficherTip LoadMSG<span class="br0">&#40;</span><span class="nu0">3</span><span class="br0">&#41;</span>, <span class="kw1">Err</span>.<span class="me1">Description</span>, Dest_Folder, <span class="kw1">vbExclamation</span><br />
&nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">MousePointer</span> = vbDefault<br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Translate_Text<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; <span class="co1">'Change le texte de la boite d'accueil selon le langage choisi</span><br />
&nbsp; &nbsp; <span class="co1">'Ne change que si rien n'est déjà chargé</span><br />
&nbsp; &nbsp; <span class="kw1">Dim</span> Texte_Orig <span class="kw1">As</span> <span class="kw1">String</span>, ctl <span class="kw1">As</span> Control, CurIndex <span class="kw1">As</span> <span class="kw1">Long</span>, Current_ligne <span class="kw1">As</span> <span class="kw1">String</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">InStr</span><span class="br0">&#40;</span><span class="nu0">1</span>, Apercu.<span class="me1">Text</span>, <span class="st0">&quot;TXT2JPG&quot;</span><span class="br0">&#41;</span> &lt;&gt; <span class="nu0">0</span> <span class="kw1">Or</span> Apercu.<span class="me1">Text</span> = <span class="kw1">vbNullString</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">LoadFile</span> <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Last_File&quot;</span>, App.<span class="me1">Path</span> &amp; <span class="st0">&quot;\Lang\HOME_&quot;</span> &amp; <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Langue&quot;</span>, <span class="st0">&quot;Francais&quot;</span><span class="br0">&#41;</span> &amp; <span class="st0">&quot;.rtf&quot;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
&nbsp; &nbsp; <span class="co1">'Puis charger tout les caption, text et autres : (le on error goto est très important !)</span><br />
&nbsp; &nbsp; <span class="kw1">For</span> Each ctl In <span class="kw1">Me</span>.<span class="me1">Controls</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> TypeOf ctl Is Label <span class="kw1">Or</span> TypeOf ctl Is Bouton <span class="kw1">Or</span> TypeOf ctl Is OptionButton <span class="kw1">Or</span> TypeOf ctl Is TextBox <span class="kw1">Or</span> TypeOf ctl Is ComboBox <span class="kw1">Or</span> TypeOf ctl Is TextBoxPlus <span class="kw1">Or</span> TypeOf ctl Is CheckBoxPlus <span class="kw1">Or</span> TypeOf ctl Is Image <span class="kw1">Or</span> TypeOf ctl Is CommandButton <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Charger le ToolTipText :</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ctl.<span class="me1">ToolTipText</span> = LoadCaption<span class="br0">&#40;</span>ctl.<span class="kw1">Name</span> &amp; <span class="st0">&quot;|0|ToolTipText&quot;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ctl.<span class="me1">ToolTipText</span> = LoadCaption<span class="br0">&#40;</span>ctl.<span class="kw1">Name</span> &amp; <span class="st0">&quot;|&quot;</span> &amp; ctl.<span class="me1">Index</span> &amp; <span class="st0">&quot;|ToolTipText&quot;</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Puis les propriétés spécifiques à chaque controles.</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> TypeOf ctl Is Label <span class="kw1">Or</span> TypeOf ctl Is Bouton <span class="kw1">Or</span> TypeOf ctl Is OptionButton <span class="kw1">Or</span> TypeOf ctl Is CommandButton <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ctl.<span class="me1">Caption</span> = LoadCaption<span class="br0">&#40;</span>ctl.<span class="kw1">Name</span> &amp; <span class="st0">&quot;|0|Caption&quot;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ctl.<span class="me1">Caption</span> = LoadCaption<span class="br0">&#40;</span>ctl.<span class="kw1">Name</span> &amp; <span class="st0">&quot;|&quot;</span> &amp; ctl.<span class="me1">Index</span> &amp; <span class="st0">&quot;|Caption&quot;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> TypeOf ctl Is TextBox <span class="kw1">Or</span> TypeOf ctl Is ComboBox <span class="kw1">Or</span> TypeOf ctl Is TextBoxPlus <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ctl.<span class="me1">Text</span> = LoadCaption<span class="br0">&#40;</span>ctl.<span class="kw1">Name</span> &amp; <span class="st0">&quot;|0|Text&quot;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ctl.<span class="me1">Text</span> = LoadCaption<span class="br0">&#40;</span>ctl.<span class="kw1">Name</span> &amp; <span class="st0">&quot;|&quot;</span> &amp; ctl.<span class="me1">Index</span> &amp; <span class="st0">&quot;|Text&quot;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> TypeOf ctl Is TextBoxPlus <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ctl.<span class="me1">CueBanner</span> = LoadCaption<span class="br0">&#40;</span>ctl.<span class="kw1">Name</span> &amp; <span class="st0">&quot;|0|CueBanner&quot;</span><span class="br0">&#41;</span>: <span class="kw1">Err</span>.<span class="me1">Number</span> = <span class="nu0">0</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ctl.<span class="me1">CueBanner</span> = LoadCaption<span class="br0">&#40;</span>ctl.<span class="kw1">Name</span> &amp; <span class="st0">&quot;|&quot;</span> &amp; ctl.<span class="me1">Index</span> &amp; <span class="st0">&quot;|CueBanner&quot;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

&nbsp; &nbsp; <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="co1">'Puis changee les menus</span><br />
&nbsp; &nbsp; <span class="kw1">For</span> tempo = <span class="nu0">0</span> <span class="kw1">To</span> Edition.<span class="kw1">UBound</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Edition<span class="br0">&#40;</span>tempo<span class="br0">&#41;</span>.<span class="me1">Caption</span> = LoadCaption<span class="br0">&#40;</span><span class="st0">&quot;Edition|&quot;</span> &amp; tempo &amp; <span class="st0">&quot;|Caption&quot;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">Next</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Abandon_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; Abandon.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; Apercu.<span class="me1">TextRTF</span> = SVGofRTF<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Align_Click<span class="br0">&#40;</span>Index <span class="kw1">As</span> <span class="kw1">Integer</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; Apercu.<span class="me1">SelAlignment</span> = Index<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Alignement_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">IsNull</span><span class="br0">&#40;</span>Apercu.<span class="me1">SelAlignment</span><span class="br0">&#41;</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; PopupMenu Edition<span class="br0">&#40;</span><span class="nu0">18</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">Else</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; PopupMenu Edition<span class="br0">&#40;</span><span class="nu0">18</span><span class="br0">&#41;</span>, , , , Align<span class="br0">&#40;</span>Apercu.<span class="me1">SelAlignment</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Apercu_KeyDown<span class="br0">&#40;</span>KeyCode <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="kw1">Dim</span> TXT <span class="kw1">As</span> <span class="kw1">String</span>, Sel_emplacement <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">If</span> TailleTexte &lt; <span class="nu0">5000</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; TXT = Apercu.<span class="me1">TextRTF</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; TailleTexte = <span class="kw1">Len</span><span class="br0">&#40;</span>TXT<span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">InStr</span><span class="br0">&#40;</span><span class="nu0">1</span>, TXT, <span class="st0">&quot;&lt;hr /&gt;&quot;</span><span class="br0">&#41;</span> &lt;&gt; <span class="nu0">0</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Sel_emplacement = Apercu.<span class="me1">SelStart</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">TextRTF</span> = Replace<span class="br0">&#40;</span>TXT, <span class="st0">&quot;&lt;hr /&gt;&quot;</span>, Barre<span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">SelStart</span> = Sel_emplacement - <span class="nu0">5</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> Shift = vbCtrlMask <span class="kw1">And</span> KeyCode = vbKeyF <span class="kw1">Then</span> Edition_Click <span class="br0">&#40;</span><span class="nu0">3</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">If</span> Shift = vbCtrlMask <span class="kw1">And</span> KeyCode = vbKeyH <span class="kw1">Then</span> Edition_Click <span class="br0">&#40;</span><span class="nu0">2</span><span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; <span class="co1">' Le KeyCode = 9, correspond à la touche [TAB]</span><br />

&nbsp; &nbsp; <span class="kw1">If</span> <span class="br0">&#40;</span>KeyCode = <span class="nu0">9</span><span class="br0">&#41;</span> <span class="kw1">And</span> <span class="br0">&#40;</span>Shift = <span class="nu0">0</span><span class="br0">&#41;</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">' Remet le KeyCode à 0 pour éviter la perte du focus</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; KeyCode = <span class="nu0">0</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">' Envoie un [Control]+[TAB], pour insérer une tabulation</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">SendKeys</span> <span class="st0">&quot;^{TAB}&quot;</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Apercu_MouseDown<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="kw1">Dim</span> mouse_pt <span class="kw1">As</span> POINTAPI<br />

&nbsp; &nbsp; <span class="co1">'Affiche le menu pop up avec les options d'ajustement, utilise aussi le message EM_CHARFROMPOS afin de positionnner correctement le curseur</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> Button = vbRightButton <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; mouse_pt.<span class="me1">X</span> = X \ Screen.<span class="me1">TwipsPerPixelX</span>: mouse_pt.<span class="me1">Y</span> = Y \ Screen.<span class="me1">TwipsPerPixelY</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Apercu.<span class="me1">SelLength</span> = <span class="nu0">0</span> <span class="kw1">Then</span> Apercu.<span class="me1">SelStart</span> = SendMessage<span class="br0">&#40;</span>Apercu.<span class="me1">hwnd</span>, EM_CHARFROMPOS, <span class="nu0">0</span>&amp;, mouse_pt<span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">Enabled</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">Enabled</span> = <span class="kw1">True</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; PopupMenu Menus<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>, , , , Edition<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Apercu_MouseUp<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="kw1">Dim</span> LinkResult <span class="kw1">As</span> ResultConstant<br />

<br />
&nbsp; &nbsp; LinkResult = IsLink<span class="br0">&#40;</span>X, Y, Apercu<span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> Button = <span class="nu0">1</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">With</span> LinkResult<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> .<span class="me1">EstUnLiens</span> = <span class="kw1">True</span> <span class="kw1">And</span> .<span class="me1">Email</span> = <span class="kw1">False</span> <span class="kw1">And</span> .<span class="me1">interne</span> = <span class="kw1">False</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Right</span><span class="br0">&#40;</span>.<span class="me1">URL</span>, <span class="nu0">1</span><span class="br0">&#41;</span> = <span class="st0">&quot; &quot;</span> <span class="kw1">Then</span> .<span class="me1">URL</span> = <span class="kw1">Left</span><span class="br0">&#40;</span>.<span class="me1">URL</span>, <span class="kw1">Len</span><span class="br0">&#40;</span>.<span class="me1">URL</span><span class="br0">&#41;</span> - <span class="nu0">1</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ShellExecute <span class="kw1">Me</span>.<span class="me1">hwnd</span>, <span class="kw1">vbNullString</span>, .<span class="me1">URL</span>, <span class="kw1">vbNullString</span>, <span class="st0">&quot;C:\&quot;</span>, <span class="nu0">2</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">ElseIf</span> .<span class="me1">EstUnLiens</span> = <span class="kw1">True</span> <span class="kw1">And</span> .<span class="me1">Email</span> = <span class="kw1">True</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ShellExecute <span class="kw1">Me</span>.<span class="me1">hwnd</span>, <span class="kw1">vbNullString</span>, <span class="st0">&quot;mailto:&quot;</span> &amp; .<span class="me1">URL</span>, <span class="kw1">vbNullString</span>, <span class="st0">&quot;C:\&quot;</span>, <span class="nu0">2</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">With</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Apercu_OLEDragDrop<span class="br0">&#40;</span>Data <span class="kw1">As</span> RichTextLib.<span class="me1">DataObject</span>, Effect <span class="kw1">As</span> <span class="kw1">Long</span>, Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="co1">'Autorise le glisser déposer de fichier</span><br />
&nbsp; &nbsp; SVGofRTF = Apercu.<span class="me1">TextRTF</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">If</span> Data.<span class="me1">GetFormat</span><span class="br0">&#40;</span>vbCFRTF<span class="br0">&#41;</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">TextRTF</span> = LoadString<span class="br0">&#40;</span><span class="nu0">47</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">TextRTF</span> = Data.<span class="me1">GetData</span><span class="br0">&#40;</span>vbCFRTF<span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">ElseIf</span> Data.<span class="me1">GetFormat</span><span class="br0">&#40;</span>vbCFText<span class="br0">&#41;</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">TextRTF</span> = <span class="kw1">vbNullString</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">Text</span> = Data.<span class="me1">GetData</span><span class="br0">&#40;</span>vbCFText<span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">ElseIf</span> Data.<span class="me1">GetFormat</span><span class="br0">&#40;</span>vbCFFiles<span class="br0">&#41;</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Load_Text_File Data.<span class="me1">Files</span>.<span class="me1">Item</span><span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">ElseIf</span> Data.<span class="me1">GetFormat</span><span class="br0">&#40;</span>vbCFBitmap<span class="br0">&#41;</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; SendMessage Apercu.<span class="me1">hwnd</span>, WM_PASTE, <span class="nu0">0</span>, <span class="nu0">0</span><br />

&nbsp; &nbsp; <span class="kw1">Else</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">MsgBox</span> LoadString<span class="br0">&#40;</span><span class="nu0">48</span><span class="br0">&#41;</span>, <span class="kw1">vbCritical</span> + <span class="kw1">vbOKOnly</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; Do_Abort<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Apercu_SelChange<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="co1">'Si on travaille sur l'ensemble, on peut accélerer le tout !</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> NoSelEvents <span class="kw1">Then</span> <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />

<br />
&nbsp; &nbsp; <span class="co1">'Règle ce qui peut être reglé (taille et police en fait) en fonction de la sélection</span><br />
<br />
&nbsp; &nbsp; DoNotChange = <span class="kw1">True</span><br />
&nbsp; &nbsp; Taille.<span class="me1">Text</span> = Apercu.<span class="me1">SelFontSize</span><br />

&nbsp; &nbsp; Polices.<span class="me1">Text</span> = Apercu.<span class="me1">SelFontName</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> SetMarge<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Tag</span> &lt;&gt; Apercu.<span class="me1">SelIndent</span> <span class="kw1">Then</span> SetMarge_MouseMove <span class="nu0">0</span>, vbLeftButton, <span class="nu0">0</span>, Apercu.<span class="me1">SelIndent</span> * <span class="nu0">1.48</span>, <span class="nu0">0</span><br />

<br />
&nbsp; &nbsp; DoNotChange = <span class="kw1">True</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> SetMarge<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">Tag</span> &lt;&gt; Apercu.<span class="me1">SelRightIndent</span> <span class="kw1">Then</span> SetMarge_MouseMove <span class="nu0">1</span>, vbLeftButton, <span class="nu0">0</span>, Apercu.<span class="me1">SelRightIndent</span> * <span class="nu0">1.48</span>, <span class="nu0">0</span><br />

<br />
&nbsp; &nbsp; DoNotChange = <span class="kw1">False</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Appliquer_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="co1">'Appliquer les effets dégradés</span><br />
&nbsp; &nbsp; <span class="kw1">Dim</span> SVGofCaption <span class="kw1">As</span> <span class="kw1">String</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">If</span> Apercu.<span class="me1">SelLength</span> = <span class="nu0">0</span> <span class="kw1">Then</span> AfficherTip LoadMSG<span class="br0">&#40;</span><span class="nu0">5</span><span class="br0">&#41;</span>, LoadMSG<span class="br0">&#40;</span><span class="nu0">6</span><span class="br0">&#41;</span>, ColorRangeOverView, <span class="kw1">False</span>: <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />

&nbsp; &nbsp; SVGofCaption = Appliquer.<span class="me1">Caption</span><br />
&nbsp; &nbsp; Appliquer.<span class="me1">Caption</span> = <span class="st0">&quot;....&quot;</span><br />
&nbsp; &nbsp; SVGofRTF = Apercu.<span class="me1">TextRTF</span><br />

&nbsp; &nbsp; Annuler.<span class="me1">Enabled</span> = <span class="kw1">True</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">Dim</span> longueur <span class="kw1">As</span> <span class="kw1">Long</span>, X <span class="kw1">As</span> Variant, rouge1 <span class="kw1">As</span> <span class="kw1">Long</span>, vert1 <span class="kw1">As</span> <span class="kw1">Long</span>, bleu1 <span class="kw1">As</span> <span class="kw1">Long</span>, rouge2 <span class="kw1">As</span> <span class="kw1">Long</span>, vert2 <span class="kw1">As</span> <span class="kw1">Long</span>, bleu2 <span class="kw1">As</span> <span class="kw1">Long</span>, Fin <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
&nbsp; &nbsp; debut = Apercu.<span class="me1">SelStart</span><br />
&nbsp; &nbsp; longueur = Apercu.<span class="me1">SelLength</span><br />
&nbsp; &nbsp; bleu1 = <span class="kw1">Int</span><span class="br0">&#40;</span>ColorRange<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">BackColor</span> \ <span class="nu0">65536</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; vert1 = <span class="kw1">Int</span><span class="br0">&#40;</span><span class="br0">&#40;</span>ColorRange<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">BackColor</span> - <span class="br0">&#40;</span><span class="nu0">65536</span> * bleu1<span class="br0">&#41;</span><span class="br0">&#41;</span> \ <span class="nu0">256</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; rouge1 = ColorRange<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">BackColor</span> - <span class="br0">&#40;</span><span class="br0">&#40;</span>bleu1 * <span class="nu0">65536</span><span class="br0">&#41;</span> + <span class="br0">&#40;</span>vert1 * <span class="nu0">256</span><span class="br0">&#41;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; bleu2 = <span class="kw1">Int</span><span class="br0">&#40;</span>ColorRange<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">BackColor</span> \ <span class="nu0">65536</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; vert2 = <span class="kw1">Int</span><span class="br0">&#40;</span><span class="br0">&#40;</span>ColorRange<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">BackColor</span> - <span class="br0">&#40;</span><span class="nu0">65536</span> * bleu2<span class="br0">&#41;</span><span class="br0">&#41;</span> \ <span class="nu0">256</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; rouge2 = ColorRange<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">BackColor</span> - <span class="br0">&#40;</span><span class="br0">&#40;</span>bleu2 * <span class="nu0">65536</span><span class="br0">&#41;</span> + <span class="br0">&#40;</span>vert2 * <span class="nu0">256</span><span class="br0">&#41;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; Fin = debut + longueur - <span class="nu0">1</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">For</span> tempo = debut <span class="kw1">To</span> Fin<br />
&nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">SelStart</span> = tempo<br />

&nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">SelLength</span> = <span class="nu0">1</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; X = <span class="br0">&#40;</span>tempo - debut<span class="br0">&#41;</span> / longueur<br />

&nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">SelColor</span> = <span class="kw1">RGB</span><span class="br0">&#40;</span>rouge1 + <span class="br0">&#40;</span>rouge2 - rouge1<span class="br0">&#41;</span> * X, vert1 + <span class="br0">&#40;</span>vert2 - vert1<span class="br0">&#41;</span> * X, bleu1 + <span class="br0">&#40;</span>bleu2 - bleu1<span class="br0">&#41;</span> * X<span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; Apercu.<span class="me1">SelStart</span> = debut<br />
&nbsp; &nbsp; Apercu.<span class="me1">SelLength</span> = longueur<br />

&nbsp; &nbsp; Appliquer.<span class="me1">Caption</span> = SVGofCaption<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> AppliquImage_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="kw1">For</span> tempo = <span class="nu0">0</span> <span class="kw1">To</span> <span class="nu0">2</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Traitement_Img<span class="br0">&#40;</span>tempo<span class="br0">&#41;</span>.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; <span class="kw1">Next</span><br />
<br />

&nbsp; &nbsp; <span class="kw1">For</span> tempo = <span class="nu0">35</span> <span class="kw1">To</span> <span class="nu0">0</span> Step <span class="nu0">-1</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">32</span><span class="br0">&#41;</span>.<span class="me1">Top</span> = tempo<br />

&nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">33</span><span class="br0">&#41;</span>.<span class="me1">Top</span> = tempo + <span class="nu0">42</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">34</span><span class="br0">&#41;</span>.<span class="me1">Top</span> = tempo + <span class="nu0">119</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">35</span><span class="br0">&#41;</span>.<span class="me1">Top</span> = tempo + <span class="nu0">168</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; AppliquImage.<span class="me1">Top</span> = <span class="nu0">210</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
&nbsp; &nbsp; <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; AppliquImage.<span class="me1">Visible</span> = <span class="kw1">False</span><br />

&nbsp; &nbsp; IsSlidingWorking = <span class="kw1">False</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> BC_Click<span class="br0">&#40;</span>Index <span class="kw1">As</span> <span class="kw1">Integer</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="co1">'Updater le registre</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> DoNotChange <span class="kw1">Then</span> <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />

&nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;BG_red&quot;</span>, <span class="kw1">IIf</span><span class="br0">&#40;</span>BC<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Value</span> = <span class="kw1">True</span>, <span class="nu0">1</span>, <span class="nu0">0</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;BG_green&quot;</span>, <span class="kw1">IIf</span><span class="br0">&#40;</span>BC<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">Value</span> = <span class="kw1">True</span>, <span class="nu0">1</span>, <span class="nu0">0</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;BG_blue&quot;</span>, <span class="kw1">IIf</span><span class="br0">&#40;</span>BC<span class="br0">&#40;</span><span class="nu0">2</span><span class="br0">&#41;</span>.<span class="me1">Value</span> = <span class="kw1">True</span>, <span class="nu0">1</span>, <span class="nu0">0</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Sens_dessin&quot;</span>, <span class="kw1">IIf</span><span class="br0">&#40;</span>BC<span class="br0">&#40;</span><span class="nu0">3</span><span class="br0">&#41;</span>.<span class="me1">Value</span> = <span class="kw1">True</span>, <span class="nu0">1</span>, <span class="nu0">0</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="co1">'Updater les variables</span><br />
&nbsp; &nbsp; BG_red = <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;BG_red&quot;</span>, <span class="st0">&quot;0&quot;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; BG_green = <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;BG_green&quot;</span>, <span class="st0">&quot;0&quot;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; BG_blue = <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;BG_blue&quot;</span>, <span class="st0">&quot;1&quot;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; sens_dessin = <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Sens_dessin&quot;</span>, <span class="st0">&quot;0&quot;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;BackPic&quot;</span>, <span class="kw1">vbNullString</span><br />
<br />
&nbsp; &nbsp; <span class="co1">'Updater la feuille</span><br />

&nbsp; &nbsp; Form_Redraw<br />
&nbsp; &nbsp; Qualite_MouseMove <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">1</span>, <span class="nu0">1</span><br />
&nbsp; &nbsp; <span class="co1">'Et terminé !</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="co1">'Private Sub BlackAndWhite_Click()</span><br />
<span class="co1">'Mettre l'image en niveau de noir et gris</span><br />
<span class="co1">'Dim X As Long, Y As Long, rouge As Long, vert As Long, bleu As Long, CCouleur As Long, LLargeur As Long, HHauteur As Long, Img_To_Blit_DC As Long</span><br />
<span class="co1">'Me.MousePointer = 11</span><br />
<span class="co1">' &nbsp; If BlackAndWhite.Value = true Then</span><br />

<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;DoEvents</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;LLargeur = Largeur.Text</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;HHauteur = Hauteur.Text</span><br />

<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;Img_To_Blit_DC = Image_A_Blitter.hDC</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;For X = 1 To LLargeur</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;For Y = 1 To HHauteur</span><br />

<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;CCouleur = GetPixel(Img_To_Blit_DC, X, Y)</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;bleu = Int(CCouleur \ 65536)</span><br />

<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;vert = Int((CCouleur - (65536 * bleu)) \ 256)</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;rouge = CCouleur - ((bleu * 65536) + (vert * 256))</span><br />

<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;CCouleur = (rouge + vert + bleu) \ 3</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;SetpixelV Img_To_Blit_DC, X, Y, RGB(CCouleur, CCouleur, CCouleur)</span><br />

<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Next</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;Next</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;Image_A_Blitter.Refresh</span><br />

<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;Pochette.Picture = LoadPicture(vbnullstring)</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;DoEvents</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;Pochette.Picture = Image_A_Blitter.Image</span><br />

<span class="co1">' &nbsp; &nbsp;Else</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;Pochette.Picture = LoadPicture(Filig.Text)</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;Image_A_Blitter.Picture = LoadPicture(Filig.Text)</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;DoEvents</span><br />

<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;If Image_A_Blitter.Width &gt; Largeur.Text Or Image_A_Blitter.Height &gt; Hauteur.Text Then</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;tempo = MsgBox(LoadString(49), vbYesNoCancel + vbInformation, LoadString(50))</span><br />

<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;If tempo = vbCancel Then Exit Sub</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Image_A_Blitter.BackColor = RGB(254, 255, 255)</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;If tempo = vbYes Then Image_A_Blitter.PaintPicture LoadPicture(Filig.Text), 0, 0, Largeur.Text, Hauteur.Text</span><br />

<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;DoEvents</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;End If</span><br />
<span class="co1">' &nbsp; &nbsp;End If</span><br />

<span class="co1">'Me.MousePointer = 0</span><br />
<span class="co1">'End Sub</span><br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Browse_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

<br />
&nbsp; &nbsp; <span class="co1">'Charge un fichier texte avec comdlg API</span><br />
&nbsp; &nbsp; Reponse = OpenFile<span class="br0">&#40;</span><span class="kw1">Me</span>.<span class="me1">hwnd</span>, LoadString<span class="br0">&#40;</span><span class="nu0">51</span><span class="br0">&#41;</span>, <span class="nu0">1</span>, OFN_FILEMUSTEXIST + OFN_PATHMUSTEXIST + OFN_HIDEREADONLY, LoadString<span class="br0">&#40;</span><span class="nu0">52</span><span class="br0">&#41;</span>, <span class="kw1">vbNullString</span>, <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;LastPathName&quot;</span>, App.<span class="me1">Path</span><span class="br0">&#41;</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">If</span> Reponse = <span class="kw1">vbNullString</span> <span class="kw1">Or</span> Reponse = <span class="st0">&quot;0&quot;</span> <span class="kw1">Then</span> <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />

&nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;LastPathName&quot;</span>, Reponse<br />
&nbsp; &nbsp; Load_Text_File Reponse<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Browse_MouseMove<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; ShowHelpFor Browse, LoadMSG<span class="br0">&#40;</span><span class="nu0">7</span><span class="br0">&#41;</span>, LoadMSG<span class="br0">&#40;</span><span class="nu0">8</span><span class="br0">&#41;</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Browse2_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

<br />
&nbsp; &nbsp; <span class="co1">'Charge une image avec comdlg</span><br />
&nbsp; &nbsp; Reponse = OpenFile<span class="br0">&#40;</span><span class="kw1">Me</span>.<span class="me1">hwnd</span>, LoadString<span class="br0">&#40;</span><span class="nu0">53</span><span class="br0">&#41;</span>, <span class="nu0">1</span>, OFN_FILEMUSTEXIST + OFN_PATHMUSTEXIST + OFN_HIDEREADONLY, LoadString<span class="br0">&#40;</span><span class="nu0">54</span><span class="br0">&#41;</span>, <span class="kw1">vbNullString</span>, <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;LastPathName&quot;</span>, App.<span class="me1">Path</span><span class="br0">&#41;</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">If</span> Reponse = <span class="kw1">vbNullString</span> <span class="kw1">Then</span> <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />
&nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;LastPathName&quot;</span>, Reponse<br />

&nbsp; &nbsp; Filig.<span class="me1">Text</span> = Reponse<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Bug_Envoi_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; Download <span class="st0">&quot;http://neamar.free.fr/mailer.php?action=bug&amp;nom=&quot;</span> &amp; <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Nom&quot;</span>, <span class="st0">&quot;Anonyme&quot;</span><span class="br0">&#41;</span> &amp; <span class="st0">&quot;&amp;message=&quot;</span> &amp; Bug_Texte.<span class="me1">Text</span><br />

&nbsp; &nbsp; Bug_Texte.<span class="me1">BackColor</span> = <span class="kw1">RGB</span><span class="br0">&#40;</span><span class="nu0">255</span>, <span class="nu0">140</span>, <span class="nu0">140</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; Bug_Texte.<span class="me1">Text</span> = <span class="kw1">vbNullString</span><br />

&nbsp; &nbsp; Bug_Texte.<span class="me1">CueBanner</span> = LoadString<span class="br0">&#40;</span><span class="nu0">55</span><span class="br0">&#41;</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> BUG_MouseMove<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; Bug_Envoi.<span class="me1">ForeColor</span> = <span class="kw1">vbBlack</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Bug_rapport_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; BUG.<span class="me1">Visible</span> = <span class="kw1">True</span><br />
&nbsp; &nbsp; BUG.<span class="me1">Top</span> = <span class="nu0">-30</span><br />
&nbsp; &nbsp; <span class="co1">'Bug_Close.Picture = BallonTipCancel(0).Picture</span><br />

&nbsp; &nbsp; debut = <span class="kw1">Timer</span><br />
&nbsp; &nbsp; Apercu.<span class="me1">Height</span> = Apercu.<span class="me1">Height</span> - <span class="br0">&#40;</span><span class="nu0">30</span> - Apercu.<span class="me1">Top</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
&nbsp; &nbsp; <span class="kw1">Do</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; tempo = <span class="kw1">Min</span><span class="br0">&#40;</span><span class="nu0">-30</span> + <span class="nu0">60</span> * <span class="br0">&#40;</span><span class="kw1">Timer</span> - debut<span class="br0">&#41;</span>, <span class="nu0">0</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; BUG.<span class="me1">Top</span> = tempo<br />
&nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">Top</span> = tempo + <span class="nu0">30</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
&nbsp; &nbsp; <span class="kw1">Loop</span> <span class="kw1">While</span> tempo &lt;&gt; <span class="nu0">0</span><br />

<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Bug_rapport_MouseMove<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">16</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> = LoadString<span class="br0">&#40;</span><span class="nu0">56</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">16</span><span class="br0">&#41;</span>.<span class="me1">Tag</span> = <span class="st0">&quot;Come into &nbsp;bug ? Have some ideas to share ? Clic and write !&quot;</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Bug_Texte_MouseMove<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; Bug_Envoi.<span class="me1">ForeColor</span> = <span class="kw1">vbBlack</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> CharMap_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> <span class="nu0">0</span> = <span class="kw1">Shell</span><span class="br0">&#40;</span><span class="st0">&quot;C:\Windows\System32\charmap.exe&quot;</span>, vbNormalFocus<span class="br0">&#41;</span> <span class="kw1">Then</span> <span class="kw1">MsgBox</span> LoadString<span class="br0">&#40;</span><span class="nu0">57</span><span class="br0">&#41;</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> ChoosePic_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

<br />
&nbsp; &nbsp; <span class="co1">'Charge une image de fond avec comdlg</span><br />
&nbsp; &nbsp; BallonTip.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; Reponse = OpenFile<span class="br0">&#40;</span><span class="kw1">Me</span>.<span class="me1">hwnd</span>, LoadString<span class="br0">&#40;</span><span class="nu0">58</span><span class="br0">&#41;</span>, <span class="nu0">1</span>, OFN_FILEMUSTEXIST + OFN_PATHMUSTEXIST + OFN_HIDEREADONLY, LoadString<span class="br0">&#40;</span><span class="nu0">54</span><span class="br0">&#41;</span>, <span class="kw1">vbNullString</span>, <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;LastPathName&quot;</span>, App.<span class="me1">Path</span><span class="br0">&#41;</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">If</span> Reponse = <span class="kw1">vbNullString</span> <span class="kw1">Then</span> <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />
&nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;LastPathName&quot;</span>, Reponse<br />

&nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;BackPic&quot;</span>, Reponse<br />
&nbsp; &nbsp; <span class="kw1">Set</span> BackPicture = <span class="kw1">LoadPicture</span><span class="br0">&#40;</span>Reponse<span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; Form_Redraw<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> ChoosePic_MouseMove<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; ShowHelpFor ChoosePic, LoadMSG<span class="br0">&#40;</span><span class="nu0">9</span><span class="br0">&#41;</span>, LoadMSG<span class="br0">&#40;</span><span class="nu0">10</span><span class="br0">&#41;</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> CollerWordFile_Timer<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="co1">'Colle le RTF d'un fichier word recupéré, car bug du do events à priori...</span><br />
&nbsp; &nbsp; CollerWordFile.<span class="me1">Enabled</span> = <span class="kw1">False</span><br />

&nbsp; &nbsp; Apercu.<span class="me1">TextRTF</span> = <span class="kw1">vbNullString</span><br />
&nbsp; &nbsp; <span class="co1">'Edition_Click 11</span><br />
&nbsp; &nbsp; SendMessage Apercu.<span class="me1">hwnd</span>, WM_PASTE, <span class="nu0">0</span>, <span class="nu0">0</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> ColorRange_Click<span class="br0">&#40;</span>Index <span class="kw1">As</span> <span class="kw1">Integer</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; <span class="kw1">Dim</span> X <span class="kw1">As</span> <span class="kw1">Long</span>, Y <span class="kw1">As</span> <span class="kw1">Long</span>, rouge1 <span class="kw1">As</span> <span class="kw1">Long</span>, vert1 <span class="kw1">As</span> <span class="kw1">Long</span>, bleu1 <span class="kw1">As</span> <span class="kw1">Long</span>, CCouleur <span class="kw1">As</span> <span class="kw1">Long</span>, color_dc <span class="kw1">As</span> <span class="kw1">Long</span>, rouge2 <span class="kw1">As</span> <span class="kw1">Long</span>, vert2 <span class="kw1">As</span> <span class="kw1">Long</span>, bleu2 <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
&nbsp; &nbsp; Couleur_Selectionnee = ChoixCouleur<span class="br0">&#40;</span><span class="kw1">Me</span>.<span class="me1">hwnd</span><span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> Couleur_Selectionnee = <span class="nu0">-1</span> <span class="kw1">Then</span> <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />

&nbsp; &nbsp; ColorRange<span class="br0">&#40;</span>Index<span class="br0">&#41;</span>.<span class="me1">BackColor</span> = Couleur_Selectionnee<br />
&nbsp; &nbsp; <span class="co1">'Rafraichir l'apercu</span><br />
&nbsp; &nbsp; color_dc = ColorRangeOverView.<span class="me1">hdc</span><br />

&nbsp; &nbsp; bleu1 = <span class="kw1">Int</span><span class="br0">&#40;</span>ColorRange<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">BackColor</span> \ <span class="nu0">65536</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; vert1 = <span class="kw1">Int</span><span class="br0">&#40;</span><span class="br0">&#40;</span>ColorRange<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">BackColor</span> - <span class="br0">&#40;</span><span class="nu0">65536</span> * bleu1<span class="br0">&#41;</span><span class="br0">&#41;</span> \ <span class="nu0">256</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; rouge1 = ColorRange<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">BackColor</span> - <span class="br0">&#40;</span><span class="br0">&#40;</span>bleu1 * <span class="nu0">65536</span><span class="br0">&#41;</span> + <span class="br0">&#40;</span>vert1 * <span class="nu0">256</span><span class="br0">&#41;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; bleu2 = <span class="kw1">Int</span><span class="br0">&#40;</span>ColorRange<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">BackColor</span> \ <span class="nu0">65536</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; vert2 = <span class="kw1">Int</span><span class="br0">&#40;</span><span class="br0">&#40;</span>ColorRange<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">BackColor</span> - <span class="br0">&#40;</span><span class="nu0">65536</span> * bleu2<span class="br0">&#41;</span><span class="br0">&#41;</span> \ <span class="nu0">256</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; rouge2 = ColorRange<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">BackColor</span> - <span class="br0">&#40;</span><span class="br0">&#40;</span>bleu2 * <span class="nu0">65536</span><span class="br0">&#41;</span> + <span class="br0">&#40;</span>vert2 * <span class="nu0">256</span><span class="br0">&#41;</span><span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">For</span> X = <span class="nu0">0</span> <span class="kw1">To</span> <span class="nu0">113</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Règle de trois !</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; CCouleur = <span class="kw1">RGB</span><span class="br0">&#40;</span>rouge1 + <span class="br0">&#40;</span>rouge2 - rouge1<span class="br0">&#41;</span> * X \ <span class="nu0">113</span>, vert1 + <span class="br0">&#40;</span>vert2 - vert1<span class="br0">&#41;</span> * X \ <span class="nu0">113</span>, bleu1 + <span class="br0">&#40;</span>bleu2 - bleu1<span class="br0">&#41;</span> * X \ <span class="nu0">113</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">For</span> Y = <span class="nu0">0</span> <span class="kw1">To</span> <span class="nu0">15</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SetPixelV color_dc, X, Y, CCouleur<br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; ColorRangeOverView.<span class="me1">Refresh</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Annuler_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; <span class="co1">'Demande l'annulation du dernier effet appliqué</span><br />
&nbsp; &nbsp; <span class="co1">'If Annuler.Enabled Then</span><br />
&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;AfficherTip LoadMSG(11), LoadMSG(12) &amp; vbCrLf &amp; &quot;-Aucune modification effectuée&quot; &amp; vbCrLf &amp; &quot;-Annulation déjà effectuée&quot;, &quot;Can't Undo&quot;, &quot;This error may come because :&quot; &amp; vbCrLf &amp; &quot;-No change done&quot; &amp; vbCrLf &amp; &quot;-Change still done, can't undo more than once.&quot;, Annuler</span><br />

&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;Exit Sub</span><br />
&nbsp; &nbsp; <span class="co1">'End If</span><br />
&nbsp; &nbsp; Apercu.<span class="me1">TextRTF</span> = SVGofRTF<br />

&nbsp; &nbsp; Annuler.<span class="me1">Enabled</span> = <span class="kw1">False</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> ColorRange_MouseMove<span class="br0">&#40;</span>Index <span class="kw1">As</span> <span class="kw1">Integer</span>, Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; ShowHelpFor ColorRange<span class="br0">&#40;</span>Index<span class="br0">&#41;</span>, LoadMSG<span class="br0">&#40;</span><span class="nu0">13</span><span class="br0">&#41;</span>, LoadMSG<span class="br0">&#40;</span><span class="nu0">14</span><span class="br0">&#41;</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Defaut_MouseMove<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; ShowHelpFor Defaut, LoadMSG<span class="br0">&#40;</span><span class="nu0">69</span><span class="br0">&#41;</span>, LoadMSG<span class="br0">&#40;</span><span class="nu0">70</span><span class="br0">&#41;</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Dest_Folder_GotTheFocus<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; AfficherTip LoadMSG<span class="br0">&#40;</span><span class="nu0">15</span><span class="br0">&#41;</span>, LoadMSG<span class="br0">&#40;</span><span class="nu0">16</span><span class="br0">&#41;</span>, Dest_Folder<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Dest_Folder_MouseMove<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; ShowHelpFor Dest_Folder, LoadMSG<span class="br0">&#40;</span><span class="nu0">15</span><span class="br0">&#41;</span>, LoadMSG<span class="br0">&#40;</span><span class="nu0">16</span><span class="br0">&#41;</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> DL_From_URL_MouseMove<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; ShowHelpFor DL_From_URL, LoadMSG<span class="br0">&#40;</span><span class="nu0">17</span><span class="br0">&#41;</span>, LoadMSG<span class="br0">&#40;</span><span class="nu0">18</span><span class="br0">&#41;</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Bug_Envoi_MouseMove<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; Bug_Envoi.<span class="me1">ForeColor</span> = <span class="kw1">vbBlue</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> BallonTip_Fermer<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; BallonTip.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> En_JPG_MouseMove<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; ShowHelpFor En_JPG, LoadMSG<span class="br0">&#40;</span><span class="nu0">41</span><span class="br0">&#41;</span>, LoadMSG<span class="br0">&#40;</span><span class="nu0">42</span><span class="br0">&#41;</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Filig_KeyPress<span class="br0">&#40;</span>KeyAscii <span class="kw1">As</span> <span class="kw1">Integer</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="co1">'Empêche de marquer manuellement une valeur</span><br />
&nbsp; &nbsp; KeyAscii = <span class="nu0">0</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> KeyWord_Change<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> KeyWord.<span class="me1">Text</span> = <span class="kw1">vbNullString</span> <span class="kw1">Then</span> KeyWord.<span class="me1">Invalide</span> = <span class="kw1">True</span> <span class="kw1">Else</span> KeyWord.<span class="me1">Invalide</span> = <span class="kw1">False</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Marque_DropDown<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; BallonTip.<span class="me1">Visible</span> = <span class="kw1">False</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Marque_GotFocus<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="co1">'Dérouler le combobox</span><br />
&nbsp; &nbsp; SendMessage Marque.<span class="me1">hwnd</span>, CB_SHOWDROPDOWN, <span class="kw1">True</span>, ByVal <span class="nu0">0</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Modeles_GotFocus<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="co1">'Dérouler le combobox</span><br />
&nbsp; &nbsp; SendMessage Modeles.<span class="me1">hwnd</span>, CB_SHOWDROPDOWN, <span class="kw1">True</span>, ByVal <span class="nu0">0</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> MouseOutProc_Timer<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
<span class="kw1">Dim</span> pPos <span class="kw1">As</span> POINTAPI<br />

<span class="kw1">Call</span> GetCursorPos<span class="br0">&#40;</span>pPos<span class="br0">&#41;</span><br />
<span class="kw1">If</span> WindowFromPoint<span class="br0">&#40;</span>pPos.<span class="me1">X</span>, pPos.<span class="me1">Y</span><span class="br0">&#41;</span> &lt;&gt; MouseOutProc.<span class="me1">Tag</span> <span class="kw1">And</span> WindowFromPoint<span class="br0">&#40;</span>pPos.<span class="me1">X</span>, pPos.<span class="me1">Y</span><span class="br0">&#41;</span> &lt;&gt; BallonTip.<span class="me1">hwnd</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; BallonTip.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; BallonTip.<span class="me1">Top</span> = <span class="nu0">0</span><br />
&nbsp; &nbsp; BallonTip.<span class="kw1">Left</span> = <span class="nu0">0</span><br />

&nbsp; &nbsp; MouseOutProc.<span class="me1">Enabled</span> = <span class="kw1">False</span><br />
<span class="kw1">End</span> <span class="kw1">If</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />

<span class="kw1">Private</span> <span class="kw1">Sub</span> Pagination_MouseMove<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; ShowHelpFor Pagination, LoadMSG<span class="br0">&#40;</span><span class="nu0">57</span><span class="br0">&#41;</span>, LoadMSG<span class="br0">&#40;</span><span class="nu0">58</span><span class="br0">&#41;</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> PutACopyOfFileInFolder_MouseMove<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; ShowHelpFor PutACopyOfFileInFolder, LoadMSG<span class="br0">&#40;</span><span class="nu0">67</span><span class="br0">&#41;</span>, LoadMSG<span class="br0">&#40;</span><span class="nu0">68</span><span class="br0">&#41;</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Qualite_GotFocus<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; AfficherTip LoadMSG<span class="br0">&#40;</span><span class="nu0">19</span><span class="br0">&#41;</span>, LoadMSG<span class="br0">&#40;</span><span class="nu0">20</span><span class="br0">&#41;</span>, Qualite, <span class="kw1">True</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Rechercher_Texte_KeyDown<span class="br0">&#40;</span>KeyCode <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> KeyCode = <span class="nu0">13</span> <span class="kw1">Then</span> Rechercher_Suite_Click<br />

&nbsp; &nbsp; Rechercher_Texte.<span class="me1">SetFocus</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Reseau_Change<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; Reseau.<span class="me1">BackColor</span> = <span class="kw1">vbWhite</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Root_Change<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; <span class="co1">'OLE ! Pour l'apparence visuelle...</span><br />
&nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">4</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> = LoadString<span class="br0">&#40;</span><span class="nu0">59</span><span class="br0">&#41;</span> &amp; <span class="kw1">vbCrLf</span> &amp; Dest_Folder.<span class="me1">Text</span> &amp; <span class="st0">&quot;\&quot;</span> &amp; Root.<span class="me1">Text</span><br />

<br />
&nbsp; &nbsp; <span class="co1">'Nom de root invalide &nbsp;car contenant caractère interdit</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> Root.<span class="me1">Text</span> Like <span class="st0">&quot;*[\/:*?&quot;</span><span class="st0">&quot;&lt;&gt;]*&quot;</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Root.<span class="me1">Invalide</span> = <span class="kw1">True</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; AfficherTip LoadMSG<span class="br0">&#40;</span><span class="nu0">21</span><span class="br0">&#41;</span>, LoadMSG<span class="br0">&#40;</span><span class="nu0">22</span><span class="br0">&#41;</span> &amp; <span class="kw1">vbCrLf</span> &amp; LoadMSG<span class="br0">&#40;</span><span class="nu0">4</span><span class="br0">&#41;</span> &amp; <span class="st0">&quot;\ / : * ? \&quot;</span><span class="st0">&quot; &lt; &gt;&quot;</span>, Root, <span class="kw1">vbCritical</span><br />

&nbsp; &nbsp; <span class="kw1">Else</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Root.<span class="me1">Invalide</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">If</span> Root.<span class="me1">Text</span> &lt;&gt; <span class="kw1">vbNullString</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Separateur<span class="br0">&#40;</span><span class="nu0">5</span><span class="br0">&#41;</span>.<span class="me1">Y1</span> = <span class="nu0">210</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; debut = <span class="kw1">Timer</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Do</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; tempo = <span class="kw1">Min</span><span class="br0">&#40;</span><span class="nu0">210</span> + <span class="nu0">56</span> * <span class="br0">&#40;</span><span class="kw1">Timer</span> - debut<span class="br0">&#41;</span>, <span class="nu0">238</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Separateur<span class="br0">&#40;</span><span class="nu0">5</span><span class="br0">&#41;</span>.<span class="me1">Y1</span> = tempo<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Separateur<span class="br0">&#40;</span><span class="nu0">5</span><span class="br0">&#41;</span>.<span class="me1">Y2</span> = tempo<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">22</span><span class="br0">&#41;</span>.<span class="me1">Top</span> = tempo + <span class="nu0">7</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">7</span><span class="br0">&#41;</span>.<span class="me1">Top</span> = <span class="br0">&#40;</span><span class="nu0">0.95</span> * tempo<span class="br0">&#41;</span> + <span class="nu0">35</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ClearType.<span class="me1">Top</span> = tempo + <span class="nu0">7</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Type_Numerisation.<span class="me1">Top</span> = <span class="br0">&#40;</span><span class="nu0">0.95</span> * tempo<span class="br0">&#41;</span> + <span class="nu0">35</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">38</span><span class="br0">&#41;</span>.<span class="me1">Top</span> = <span class="br0">&#40;</span><span class="nu0">0.97</span> * tempo<span class="br0">&#41;</span> + <span class="nu0">45</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SplitChapter.<span class="me1">Top</span> = <span class="br0">&#40;</span><span class="nu0">0.97</span> * tempo<span class="br0">&#41;</span> + <span class="nu0">45</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Loop</span> Until tempo = <span class="nu0">238</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">4</span><span class="br0">&#41;</span>.<span class="me1">Visible</span> = <span class="kw1">True</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Root_GotTheFocus<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; MAJ_Timer<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Root_MouseMove<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

ShowHelpFor Root, LoadMSG<span class="br0">&#40;</span><span class="nu0">23</span><span class="br0">&#41;</span>, LoadMSG<span class="br0">&#40;</span><span class="nu0">24</span><span class="br0">&#41;</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> SetMarge_MouseDown<span class="br0">&#40;</span>Index <span class="kw1">As</span> <span class="kw1">Integer</span>, Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; SetMarge_MouseMove Index, Button, Shift, X, Y<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> SetMarge_MouseMove<span class="br0">&#40;</span>Index <span class="kw1">As</span> <span class="kw1">Integer</span>, Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="co1">'Updater la valeur</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> Button = vbLeftButton <span class="kw1">And</span> X &gt;= <span class="nu0">0</span> <span class="kw1">And</span> X &lt;= <span class="nu0">144</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; SetMarge<span class="br0">&#40;</span>Index<span class="br0">&#41;</span>.<span class="me1">Tag</span> = <span class="br0">&#40;</span><span class="nu0">100</span> * X<span class="br0">&#41;</span> \ <span class="nu0">148</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; <span class="co1">'Arrière plan</span><br />
&nbsp; &nbsp; BitBlt SetMarge<span class="br0">&#40;</span>Index<span class="br0">&#41;</span>.<span class="me1">hdc</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">148</span>, <span class="nu0">15</span>, Plug<span class="br0">&#40;</span><span class="nu0">2</span><span class="br0">&#41;</span>.<span class="me1">hdc</span>, SetMarge<span class="br0">&#40;</span>Index<span class="br0">&#41;</span>.<span class="kw1">Left</span>, SetMarge<span class="br0">&#40;</span>Index<span class="br0">&#41;</span>.<span class="me1">Top</span>, vbSrcCopy<br />

&nbsp; &nbsp; TransparentBlt SetMarge<span class="br0">&#40;</span>Index<span class="br0">&#41;</span>.<span class="me1">hdc</span>, <span class="nu0">0</span>, <span class="nu0">2</span>, <span class="nu0">148</span>, <span class="nu0">13</span>, QualiteMask.<span class="me1">hdc</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">148</span>, <span class="nu0">13</span>, <span class="kw1">RGB</span><span class="br0">&#40;</span><span class="nu0">255</span>, <span class="nu0">255</span>, <span class="nu0">255</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="co1">'Bulle</span><br />
&nbsp; &nbsp; TransparentBlt SetMarge<span class="br0">&#40;</span>Index<span class="br0">&#41;</span>.<span class="me1">hdc</span>, <span class="br0">&#40;</span>SetMarge<span class="br0">&#40;</span>Index<span class="br0">&#41;</span>.<span class="me1">Tag</span><span class="br0">&#41;</span> * <span class="nu0">1.48</span> - <span class="nu0">4</span>, <span class="nu0">1</span>, <span class="nu0">11</span>, <span class="nu0">13</span>, QualiteMask.<span class="me1">hdc</span>, <span class="nu0">149</span>, <span class="nu0">0</span>, <span class="nu0">11</span>, <span class="nu0">13</span>, <span class="kw1">RGB</span><span class="br0">&#40;</span><span class="nu0">255</span>, <span class="nu0">255</span>, <span class="nu0">255</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; SetMarge<span class="br0">&#40;</span>Index<span class="br0">&#41;</span>.<span class="me1">Refresh</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> DoNotChange <span class="kw1">Then</span> DoNotChange = <span class="kw1">False</span>: <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />

&nbsp; &nbsp; <span class="kw1">If</span> Button = vbLeftButton <span class="kw1">Then</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Index &lt;= <span class="nu0">1</span> <span class="kw1">Then</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Marge à gauche/A droite</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Apercu.<span class="me1">SelText</span> = <span class="kw1">vbNullString</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">SelStart</span> = <span class="nu0">0</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">SelLength</span> = <span class="kw1">Len</span><span class="br0">&#40;</span>Apercu.<span class="me1">Text</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Index = <span class="nu0">0</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">SelIndent</span> = SetMarge<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Tag</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">13</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> = <span class="kw1">Left</span>$<span class="br0">&#40;</span>etiquette<span class="br0">&#40;</span><span class="nu0">13</span><span class="br0">&#41;</span>.<span class="me1">Caption</span>, <span class="kw1">Len</span><span class="br0">&#40;</span>etiquette<span class="br0">&#40;</span><span class="nu0">13</span><span class="br0">&#41;</span>.<span class="me1">Caption</span><span class="br0">&#41;</span> - <span class="nu0">5</span><span class="br0">&#41;</span> &amp; <span class="kw1">FORMAT</span>$<span class="br0">&#40;</span>Apercu.<span class="me1">SelIndent</span>, <span class="st0">&quot;000&quot;</span><span class="br0">&#41;</span> &amp; <span class="st0">&quot;px&quot;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Else</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">SelRightIndent</span> = SetMarge<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">Tag</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">14</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> = <span class="kw1">Left</span>$<span class="br0">&#40;</span>etiquette<span class="br0">&#40;</span><span class="nu0">14</span><span class="br0">&#41;</span>.<span class="me1">Caption</span>, <span class="kw1">Len</span><span class="br0">&#40;</span>etiquette<span class="br0">&#40;</span><span class="nu0">14</span><span class="br0">&#41;</span>.<span class="me1">Caption</span><span class="br0">&#41;</span> - <span class="nu0">5</span><span class="br0">&#41;</span> &amp; <span class="kw1">FORMAT</span>$<span class="br0">&#40;</span>Apercu.<span class="me1">SelRightIndent</span>, <span class="st0">&quot;000&quot;</span><span class="br0">&#41;</span> &amp; <span class="st0">&quot;px&quot;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Else</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Marge en haut/en bas</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">27</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> = <span class="kw1">Left</span>$<span class="br0">&#40;</span>etiquette<span class="br0">&#40;</span><span class="nu0">27</span><span class="br0">&#41;</span>.<span class="me1">Caption</span>, <span class="kw1">Len</span><span class="br0">&#40;</span>etiquette<span class="br0">&#40;</span><span class="nu0">27</span><span class="br0">&#41;</span>.<span class="me1">Caption</span><span class="br0">&#41;</span> - <span class="nu0">5</span><span class="br0">&#41;</span> &amp; <span class="kw1">FORMAT</span>$<span class="br0">&#40;</span>SetMarge<span class="br0">&#40;</span><span class="nu0">2</span><span class="br0">&#41;</span>.<span class="me1">Tag</span>, <span class="st0">&quot;000&quot;</span><span class="br0">&#41;</span> &amp; <span class="st0">&quot;px&quot;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">26</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> = <span class="kw1">Left</span>$<span class="br0">&#40;</span>etiquette<span class="br0">&#40;</span><span class="nu0">26</span><span class="br0">&#41;</span>.<span class="me1">Caption</span>, <span class="kw1">Len</span><span class="br0">&#40;</span>etiquette<span class="br0">&#40;</span><span class="nu0">26</span><span class="br0">&#41;</span>.<span class="me1">Caption</span><span class="br0">&#41;</span> - <span class="nu0">5</span><span class="br0">&#41;</span> &amp; <span class="kw1">FORMAT</span>$<span class="br0">&#40;</span>SetMarge<span class="br0">&#40;</span><span class="nu0">3</span><span class="br0">&#41;</span>.<span class="me1">Tag</span>, <span class="st0">&quot;000&quot;</span><span class="br0">&#41;</span> &amp; <span class="st0">&quot;px&quot;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; TextBoxMargins Apercu, <span class="nu0">5</span>, SetMarge<span class="br0">&#40;</span><span class="nu0">2</span><span class="br0">&#41;</span>.<span class="me1">Tag</span>, <span class="nu0">5</span>, SetMarge<span class="br0">&#40;</span><span class="nu0">3</span><span class="br0">&#41;</span>.<span class="me1">Tag</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; TextBoxMargins Converter, <span class="nu0">5</span>, SetMarge<span class="br0">&#40;</span><span class="nu0">2</span><span class="br0">&#41;</span>.<span class="me1">Tag</span>, <span class="nu0">5</span>, SetMarge<span class="br0">&#40;</span><span class="nu0">3</span><span class="br0">&#41;</span>.<span class="me1">Tag</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'If Index &gt; 1 Then AfficherTip LoadMSG(25), LoadMSG(26), SetMarge(3), False</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> SplitChapter_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> SplitChapter.<span class="me1">Value</span> = <span class="kw1">True</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; KeyWord.<span class="me1">Visible</span> = <span class="kw1">True</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; KeyWord.<span class="me1">Top</span> = SplitChapter.<span class="me1">Top</span> - <span class="nu0">3</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">38</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> = LoadString<span class="br0">&#40;</span><span class="nu0">60</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; AfficherTip LoadMSG<span class="br0">&#40;</span><span class="nu0">27</span><span class="br0">&#41;</span>, LoadMSG<span class="br0">&#40;</span><span class="nu0">28</span><span class="br0">&#41;</span>, PlugChoice<span class="br0">&#40;</span><span class="nu0">2</span><span class="br0">&#41;</span>, <span class="kw1">False</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'KeyWord.SetFocus</span><br />
&nbsp; &nbsp; <span class="kw1">Else</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; KeyWord.<span class="me1">Visible</span> = <span class="kw1">False</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">38</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> = LoadString<span class="br0">&#40;</span><span class="nu0">61</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> DL_From_URL_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; <span class="kw1">Dim</span> URL_To_Load <span class="kw1">As</span> <span class="kw1">String</span><br />
<br />
&nbsp; &nbsp; URL_To_Load = <span class="kw1">InputBox</span><span class="br0">&#40;</span>LoadString<span class="br0">&#40;</span><span class="nu0">62</span><span class="br0">&#41;</span>, LoadString<span class="br0">&#40;</span><span class="nu0">63</span><span class="br0">&#41;</span>, LoadString<span class="br0">&#40;</span><span class="nu0">38</span><span class="br0">&#41;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">If</span> URL_To_Load = <span class="kw1">vbNullString</span> <span class="kw1">Then</span> <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />
<br />
&nbsp; &nbsp; Load_Text_File URL_To_Load, <span class="kw1">True</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Filig_GotFocus<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="co1">'Dérouler le combobox</span><br />
&nbsp; &nbsp; SendMessage Filig.<span class="me1">hwnd</span>, CB_SHOWDROPDOWN, <span class="kw1">True</span>, ByVal <span class="nu0">0</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Marque_KeyPress<span class="br0">&#40;</span>KeyAscii <span class="kw1">As</span> <span class="kw1">Integer</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; KeyAscii = <span class="nu0">0</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Modeles_KeyPress<span class="br0">&#40;</span>KeyAscii <span class="kw1">As</span> <span class="kw1">Integer</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="co1">'Locker sans locker</span><br />

&nbsp; &nbsp; KeyAscii = <span class="nu0">0</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> ModulesWhat_Click<span class="br0">&#40;</span>Index <span class="kw1">As</span> <span class="kw1">Integer</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> Index <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; WhatAbout.<span class="me1">Visible</span> = <span class="kw1">True</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Affiche l'historique des versions</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">MousePointer</span> = vbCustom<br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; Download <span class="st0">&quot;http://neamar.free.fr/Addins/Zen.php?version=1&quot;</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">With</span> WhatAbout<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">TextRTF</span> = <span class="kw1">vbNullString</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">LoadFile</span> Stockage<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">SelStart</span> = <span class="nu0">0</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">SelLength</span> = <span class="nu0">0</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">SelText</span> = <span class="st0">&quot;TXT2JPg - Build n°&quot;</span> &amp; App.<span class="me1">Revision</span> &amp; <span class="kw1">vbCrLf</span> &amp; <span class="st0">&quot;Neamar, 2007. &quot;</span> &amp; <span class="kw1">vbCrLf</span> &amp; <span class="st0">&quot;Mail : neamart@yahoo.fr&quot;</span> &amp; <span class="kw1">vbCrLf</span> &amp; LoadString<span class="br0">&#40;</span><span class="nu0">64</span><span class="br0">&#41;</span> &amp; <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Nom&quot;</span>, <span class="st0">&quot;Anonyme&quot;</span><span class="br0">&#41;</span> &amp; <span class="kw1">vbCrLf</span> &amp; LoadString<span class="br0">&#40;</span><span class="nu0">65</span><span class="br0">&#41;</span> &amp; <span class="kw1">vbCrLf</span> &amp; <span class="st0">&quot;------------------------------&quot;</span> &amp; <span class="kw1">vbCrLf</span> &amp; LoadString<span class="br0">&#40;</span><span class="nu0">66</span><span class="br0">&#41;</span> &amp; <span class="kw1">vbCrLf</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">Text</span> = Replace<span class="br0">&#40;</span>Replace<span class="br0">&#40;</span>.<span class="me1">Text</span>, <span class="st0">&quot;&lt;br&gt;&quot;</span>, <span class="kw1">vbCrLf</span><span class="br0">&#41;</span>, <span class="st0">&quot;&lt;br /&gt;&quot;</span>, <span class="kw1">vbCrLf</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">SelStart</span> = <span class="nu0">0</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">SelLength</span> = <span class="nu0">20</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">SelColor</span> = <span class="kw1">vbRed</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">With</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Kill</span> Stockage<br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">MousePointer</span> = vbDefault<br />
&nbsp; &nbsp; <span class="kw1">Else</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; WhatAbout.<span class="me1">Visible</span> = <span class="kw1">False</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Polices_GotFocus<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="co1">'Dérouler le combobox</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> Polices.<span class="me1">ListCount</span> &lt;&gt; <span class="nu0">0</span> <span class="kw1">Then</span> SendMessage Polices.<span class="me1">hwnd</span>, CB_SHOWDROPDOWN, <span class="kw1">True</span>, ByVal <span class="nu0">0</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Polices_KeyPress<span class="br0">&#40;</span>KeyAscii <span class="kw1">As</span> <span class="kw1">Integer</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="co1">'Locker sans locker</span><br />

&nbsp; &nbsp; KeyAscii = <span class="nu0">0</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Priorite_GotFocus<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; <span class="co1">'Dérouler le combobox</span><br />
&nbsp; &nbsp; SendMessage Priorite.<span class="me1">hwnd</span>, CB_SHOWDROPDOWN, <span class="kw1">True</span>, ByVal <span class="nu0">0</span><br />
&nbsp; &nbsp; AfficherTip LoadMSG<span class="br0">&#40;</span><span class="nu0">29</span><span class="br0">&#41;</span>, LoadMSG<span class="br0">&#40;</span><span class="nu0">30</span><span class="br0">&#41;</span>, PlugChoice<span class="br0">&#40;</span><span class="nu0">3</span><span class="br0">&#41;</span>, <span class="kw1">False</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Priorite_KeyPress<span class="br0">&#40;</span>KeyAscii <span class="kw1">As</span> <span class="kw1">Integer</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; <span class="co1">'Locker sans locker</span><br />
&nbsp; &nbsp; KeyAscii = <span class="nu0">0</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> PutACopyOfFileInFolder_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;PutCopy&quot;</span>, PutACopyOfFileInFolder.<span class="me1">Value</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Rechercher_Close_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; Rechercher.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; Apercu.<span class="me1">Height</span> = Apercu.<span class="me1">Height</span> + Rechercher.<span class="me1">Height</span> - <span class="nu0">10</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Rechercher_Close_MouseMove<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> Rechercher_Close.<span class="me1">Tag</span> &lt;&gt; <span class="st0">&quot;Highlight&quot;</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Rechercher_Close.<span class="me1">Picture</span> = Cross<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">Picture</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Rechercher_Close.<span class="me1">Tag</span> = <span class="st0">&quot;Highlight&quot;</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Rechercher_Fond_MouseMove<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> Rechercher_Close.<span class="me1">Tag</span> = <span class="st0">&quot;Highlight&quot;</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Rechercher_Close.<span class="me1">Picture</span> = Cross<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Picture</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Rechercher_Close.<span class="me1">Tag</span> = <span class="kw1">vbNullString</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Rechercher_Suite_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> Rechercher.<span class="me1">Tag</span> = LoadString<span class="br0">&#40;</span><span class="nu0">67</span><span class="br0">&#41;</span> <span class="kw1">Then</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Rechercher</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">SelStart</span> = <span class="kw1">InStr</span><span class="br0">&#40;</span>Apercu.<span class="me1">SelStart</span> + <span class="nu0">2</span>, Apercu.<span class="me1">Text</span>, Rechercher_Texte.<span class="me1">Text</span><span class="br0">&#41;</span> - <span class="nu0">1</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">SelLength</span> = <span class="kw1">Len</span><span class="br0">&#40;</span>Rechercher_Texte.<span class="me1">Text</span><span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Apercu.<span class="me1">SelText</span> &lt;&gt; Rechercher_Texte.<span class="me1">Text</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">SelLength</span> = <span class="nu0">0</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Rechercher_Texte.<span class="me1">ForeColor</span> = <span class="kw1">vbRed</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Else</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Rechercher_Texte.<span class="me1">ForeColor</span> = <span class="kw1">vbBlack</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">SetFocus</span><br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">If</span> Rechercher.<span class="me1">Tag</span> = LoadString<span class="br0">&#40;</span><span class="nu0">68</span><span class="br0">&#41;</span> <span class="kw1">Then</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Rechercher &amp; remplacer</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Dim</span> compteur <span class="kw1">As</span> <span class="kw1">Long</span>, cherche <span class="kw1">As</span> <span class="kw1">String</span>, remplace <span class="kw1">As</span> <span class="kw1">String</span>, LenCherche <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; cherche = Rechercher_Texte.<span class="me1">Text</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; remplace = Rechercher_Remplacer.<span class="me1">Text</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; LenCherche = <span class="kw1">Len</span><span class="br0">&#40;</span>cherche<span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">MousePointer</span> = vbCustom<br />
&nbsp; &nbsp; &nbsp; &nbsp; compteur = <span class="nu0">0</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; tempo = -LenCherche + <span class="nu0">1</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Do</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; tempo = <span class="kw1">InStr</span><span class="br0">&#40;</span>tempo + LenCherche, Apercu.<span class="me1">Text</span>, cherche<span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> tempo = <span class="nu0">0</span> <span class="kw1">Then</span> <span class="kw1">Exit</span> <span class="kw1">Do</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">SelStart</span> = tempo - <span class="nu0">1</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">SelLength</span> = LenCherche<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">SelText</span> = remplace<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; compteur = compteur + <span class="nu0">1</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Loop</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; AfficherTip LoadMSG<span class="br0">&#40;</span><span class="nu0">31</span><span class="br0">&#41;</span>, compteur &amp; LoadMSG<span class="br0">&#40;</span><span class="nu0">32</span><span class="br0">&#41;</span>, PlugChoice<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>, <span class="kw1">vbInformation</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">MousePointer</span> = vbDefault<br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Rechercher_Texte_Change<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; <span class="kw1">If</span> Rechercher.<span class="me1">Tag</span> = LoadString<span class="br0">&#40;</span><span class="nu0">67</span><span class="br0">&#41;</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Rechercher</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">SelStart</span> = <span class="kw1">InStr</span><span class="br0">&#40;</span><span class="nu0">1</span>, Apercu.<span class="me1">Text</span>, Rechercher_Texte.<span class="me1">Text</span><span class="br0">&#41;</span> - <span class="nu0">1</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">SelLength</span> = <span class="kw1">Len</span><span class="br0">&#40;</span>Rechercher_Texte.<span class="me1">Text</span><span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Apercu.<span class="me1">SelText</span> &lt;&gt; Rechercher_Texte.<span class="me1">Text</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">SelLength</span> = <span class="nu0">0</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Rechercher_Texte.<span class="me1">ForeColor</span> = <span class="kw1">vbRed</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Else</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Rechercher_Texte.<span class="me1">ForeColor</span> = <span class="kw1">vbBlack</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Reseau_GotFocus<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; AfficherTip LoadMSG<span class="br0">&#40;</span><span class="nu0">33</span><span class="br0">&#41;</span>, LoadMSG<span class="br0">&#40;</span><span class="nu0">34</span><span class="br0">&#41;</span>, Reseau<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Reseau_LostFocus<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; BallonTip.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Save_Folder_GotFocus<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; AfficherTip LoadMSG<span class="br0">&#40;</span><span class="nu0">35</span><span class="br0">&#41;</span>, LoadMSG<span class="br0">&#40;</span><span class="nu0">36</span><span class="br0">&#41;</span>, Save_Folder<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Save_Folder_LostFocus<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; BallonTip.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Taille_GotFocus<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="co1">'MEssage de déroulement</span><br />
&nbsp; &nbsp; SendMessage Taille.<span class="me1">hwnd</span>, CB_SHOWDROPDOWN, <span class="kw1">True</span>, ByVal <span class="nu0">0</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> TailleDegrade_MouseDown<span class="br0">&#40;</span>Index <span class="kw1">As</span> <span class="kw1">Integer</span>, Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; TailleDegrade_MouseMove Index, Button, Shift, X, Y<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> TailleDegrade_MouseMove<span class="br0">&#40;</span>Index <span class="kw1">As</span> <span class="kw1">Integer</span>, Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="co1">'Updater la valeur</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> Button = vbLeftButton <span class="kw1">And</span> Y &gt; <span class="nu0">5</span> <span class="kw1">And</span> Y &lt; <span class="nu0">135</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; BallonTip.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Apercu.<span class="me1">SelLength</span> = <span class="nu0">0</span> <span class="kw1">Then</span> AfficherTip LoadMSG<span class="br0">&#40;</span><span class="nu0">37</span><span class="br0">&#41;</span>, LoadMSG<span class="br0">&#40;</span><span class="nu0">38</span><span class="br0">&#41;</span>, TailleDegrade<span class="br0">&#40;</span>Index<span class="br0">&#41;</span>, <span class="kw1">False</span>: <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; TailleDegrade<span class="br0">&#40;</span>Index<span class="br0">&#41;</span>.<span class="me1">Tag</span> = Y<br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

<br />
&nbsp; &nbsp; <span class="co1">'Arrière plan</span><br />
&nbsp; &nbsp; BitBlt TailleDegrade<span class="br0">&#40;</span>Index<span class="br0">&#41;</span>.<span class="me1">hdc</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">15</span>, <span class="nu0">148</span>, Plug<span class="br0">&#40;</span><span class="nu0">5</span><span class="br0">&#41;</span>.<span class="me1">hdc</span>, TailleDegrade<span class="br0">&#40;</span>Index<span class="br0">&#41;</span>.<span class="kw1">Left</span>, TailleDegrade<span class="br0">&#40;</span>Index<span class="br0">&#41;</span>.<span class="me1">Top</span>, vbSrcCopy<br />

&nbsp; &nbsp; TransparentBlt TailleDegrade<span class="br0">&#40;</span>Index<span class="br0">&#41;</span>.<span class="me1">hdc</span>, <span class="nu0">0</span>, <span class="nu0">2</span>, <span class="nu0">13</span>, <span class="nu0">148</span>, TailleMask.<span class="me1">hdc</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">13</span>, <span class="nu0">148</span>, <span class="kw1">RGB</span><span class="br0">&#40;</span><span class="nu0">255</span>, <span class="nu0">255</span>, <span class="nu0">255</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="co1">'Bulle</span><br />
&nbsp; &nbsp; TransparentBlt TailleDegrade<span class="br0">&#40;</span>Index<span class="br0">&#41;</span>.<span class="me1">hdc</span>, <span class="nu0">1</span>, TailleDegrade<span class="br0">&#40;</span>Index<span class="br0">&#41;</span>.<span class="me1">Tag</span>, <span class="nu0">13</span>, <span class="nu0">11</span>, TailleMask.<span class="me1">hdc</span>, <span class="nu0">0</span>, <span class="nu0">149</span>, <span class="nu0">13</span>, <span class="nu0">11</span>, <span class="kw1">RGB</span><span class="br0">&#40;</span><span class="nu0">255</span>, <span class="nu0">255</span>, <span class="nu0">255</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; TailleDegrade<span class="br0">&#40;</span>Index<span class="br0">&#41;</span>.<span class="me1">Refresh</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> Button = vbLeftButton <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; SVGofRTF = Apercu.<span class="me1">TextRTF</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Annuler.<span class="me1">Enabled</span> = <span class="kw1">True</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Dim</span> longueur <span class="kw1">As</span> <span class="kw1">Long</span>, left_value <span class="kw1">As</span> <span class="kw1">Long</span>, right_value <span class="kw1">As</span> <span class="kw1">Single</span>, SVGofCaption <span class="kw1">As</span> <span class="kw1">String</span>, Fin <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; SVGofCaption = etiquette<span class="br0">&#40;</span><span class="nu0">30</span><span class="br0">&#41;</span>.<span class="me1">Caption</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">30</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> = LoadString<span class="br0">&#40;</span><span class="nu0">69</span><span class="br0">&#41;</span> &amp; <span class="kw1">vbCrLf</span> &amp; LoadString<span class="br0">&#40;</span><span class="nu0">70</span><span class="br0">&#41;</span> &amp; Apercu.<span class="me1">SelLength</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; left_value = <span class="nu0">135</span> - TailleDegrade<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Tag</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">With</span> Apercu<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; longueur = .<span class="me1">SelLength</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; debut = .<span class="me1">SelStart</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; right_value = <span class="br0">&#40;</span><span class="br0">&#40;</span><span class="nu0">135</span> - TailleDegrade<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">Tag</span><span class="br0">&#41;</span> - left_value<span class="br0">&#41;</span> \ longueur <span class="co1">'Right value correspond en fait à la différence...divisée par la longueur. C'est de la précompilation ^^</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Fin = debut + longueur<br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">For</span> tempo = debut <span class="kw1">To</span> Fin<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">SelStart</span> = tempo<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">SelLength</span> = <span class="nu0">1</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Une simple règle de trois ;-)</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">SelFontSize</span> = left_value + <span class="br0">&#40;</span>tempo - debut<span class="br0">&#41;</span> * right_value<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">SelStart</span> = debut<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">SelLength</span> = longueur<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">With</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">30</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> = SVGofCaption<br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Start_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; Numeriser<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Dest_Folder_Change<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; <span class="kw1">If</span> Dest_Folder.<span class="me1">Text</span> = <span class="kw1">vbNullString</span> <span class="kw1">Then</span> <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> Dest_Folder.<span class="me1">Text</span> Like <span class="st0">&quot;*[\/:*?&quot;</span><span class="st0">&quot;&lt;&gt;]*&quot;</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Nom de fichier invalide &nbsp;car contenant caractère interdit</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Dest_Folder.<span class="me1">Invalide</span> = <span class="kw1">True</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; AfficherTip LoadMSG<span class="br0">&#40;</span><span class="nu0">39</span><span class="br0">&#41;</span>, LoadMSG<span class="br0">&#40;</span><span class="nu0">4</span><span class="br0">&#41;</span> &amp; <span class="st0">&quot;\ / : * ? \&quot;</span><span class="st0">&quot; &lt; &gt;&quot;</span>, Dest_Folder, <span class="kw1">vbCritical</span><br />
&nbsp; &nbsp; <span class="kw1">Else</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Dest_Folder.<span class="me1">Invalide</span> = <span class="kw1">False</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Dest_Folder.<span class="me1">HasFocus</span> <span class="kw1">Then</span> BallonTip.<span class="me1">Visible</span> = <span class="kw1">False</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Le fichier existe déjà ? On informe !</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Dir</span>$<span class="br0">&#40;</span><span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Default_Path&quot;</span>, App.<span class="me1">Path</span><span class="br0">&#41;</span> &amp; <span class="st0">&quot;\&quot;</span> &amp; Dest_Folder.<span class="me1">Text</span>, <span class="kw1">vbDirectory</span><span class="br0">&#41;</span> &lt;&gt; <span class="kw1">vbNullString</span> <span class="kw1">Then</span> AfficherTip LoadMSG<span class="br0">&#40;</span><span class="nu0">65</span><span class="br0">&#41;</span>, Replace<span class="br0">&#40;</span>LoadMSG<span class="br0">&#40;</span><span class="nu0">66</span><span class="br0">&#41;</span>, <span class="st0">&quot;%u&quot;</span>, Root.<span class="me1">Text</span><span class="br0">&#41;</span>, Dest_Folder, <span class="kw1">vbInformation</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Traitement_Img_Click<span class="br0">&#40;</span>Index <span class="kw1">As</span> <span class="kw1">Integer</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> NonForcé <span class="kw1">Then</span> <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />

&nbsp; &nbsp; NonForcé = <span class="kw1">True</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">For</span> tempo = <span class="nu0">0</span> <span class="kw1">To</span> <span class="nu0">2</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Traitement_Img<span class="br0">&#40;</span>tempo<span class="br0">&#41;</span>.<span class="me1">Value</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; <span class="kw1">Next</span><br />
<br />

&nbsp; &nbsp; Traitement_Img<span class="br0">&#40;</span>Index<span class="br0">&#41;</span>.<span class="me1">Value</span> = <span class="kw1">True</span><br />
&nbsp; &nbsp; NonForcé = <span class="kw1">False</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Use_Back_Picture_MouseMove<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; ShowHelpFor Use_Back_Picture, LoadMSG<span class="br0">&#40;</span><span class="nu0">71</span><span class="br0">&#41;</span>, LoadMSG<span class="br0">&#40;</span><span class="nu0">72</span><span class="br0">&#41;</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> UseForeColor_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;CleverColor&quot;</span>, <span class="kw1">Abs</span><span class="br0">&#40;</span>UseForeColor.<span class="me1">Value</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; CleverColor = UseForeColor.<span class="me1">Value</span><br />

<br />
&nbsp; &nbsp; Form_Redraw<br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Not</span> <span class="br0">&#40;</span>CleverColor<span class="br0">&#41;</span> <span class="kw1">Then</span><br />
<br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">For</span> tempo = <span class="nu0">0</span> <span class="kw1">To</span> etiquette.<span class="kw1">UBound</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span>tempo<span class="br0">&#41;</span>.<span class="me1">ForeColor</span> = <span class="nu0">-2147483633</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">41</span><span class="br0">&#41;</span>.<span class="me1">ForeColor</span> = <span class="kw1">vbBlack</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">40</span><span class="br0">&#41;</span>.<span class="me1">ForeColor</span> = <span class="kw1">vbBlack</span><br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> VoirApercu_MouseDown<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; VoirApercu_MouseMove Button, Shift, X, Y<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> VoirApercu_MouseMove<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> Button &lt;&gt; <span class="nu0">0</span> <span class="kw1">And</span> X &gt; <span class="nu0">0</span> <span class="kw1">And</span> Y &gt; <span class="nu0">0</span> <span class="kw1">And</span> X &lt; VoirApercu.<span class="kw1">Width</span> * Screen.<span class="me1">TwipsPerPixelX</span> <span class="kw1">And</span> Y &lt; VoirApercu.<span class="me1">Height</span> * Screen.<span class="me1">TwipsPerPixelY</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; OverView.<span class="me1">Picture</span> = Image_A_Blitter.<span class="me1">Picture</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; OverView.<span class="me1">Visible</span> = <span class="kw1">True</span><br />

&nbsp; &nbsp; <span class="kw1">Else</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; OverView.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Filig_OLEDragDrop<span class="br0">&#40;</span>Data <span class="kw1">As</span> DataObject, Effect <span class="kw1">As</span> <span class="kw1">Long</span>, Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="co1">'Le drag drop Windows pour un path d'image</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> Data.<span class="me1">GetFormat</span><span class="br0">&#40;</span>vbCFFiles<span class="br0">&#41;</span> <span class="kw1">Then</span> Filig.<span class="me1">Text</span> = Data.<span class="me1">Files</span>.<span class="me1">Item</span><span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Use_Back_Picture_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; <span class="co1">'Mini animation de déroulement du controle shape</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> Use_Back_Picture.<span class="me1">Value</span> = <span class="kw1">True</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; debut = <span class="kw1">Timer</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Do</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; tempo = <span class="kw1">Min</span><span class="br0">&#40;</span><span class="nu0">99</span> * <span class="br0">&#40;</span><span class="kw1">Timer</span> - debut<span class="br0">&#41;</span>, <span class="nu0">99</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; BitBlt Plug<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">hdc</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">176</span>, <span class="nu0">289</span>, myHDC, Plug<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="kw1">Left</span>, Plug<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">Top</span>, vbSrcCopy<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Glass <span class="nu0">9</span>, <span class="nu0">180</span>, <span class="nu0">170</span>, <span class="nu0">170</span> + tempo, Plug<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">hdc</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Plug<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">Refresh</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> tempo + Use_Back_Picture.<span class="me1">Top</span> + <span class="nu0">10</span> &gt; Filig.<span class="me1">Top</span> <span class="kw1">Then</span> Filig.<span class="me1">Visible</span> = <span class="kw1">True</span>: Browse2.<span class="me1">Visible</span> = <span class="kw1">True</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> tempo + Use_Back_Picture.<span class="me1">Top</span> + <span class="nu0">10</span> &gt; RedimToFit.<span class="me1">Top</span> <span class="kw1">Then</span> RedimToFit.<span class="me1">Visible</span> = <span class="kw1">True</span>: etiquette<span class="br0">&#40;</span><span class="nu0">6</span><span class="br0">&#41;</span>.<span class="me1">Visible</span> = <span class="kw1">True</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> tempo + Use_Back_Picture.<span class="me1">Top</span> + <span class="nu0">10</span> &gt; Cover.<span class="me1">Top</span> <span class="kw1">Then</span> Cover.<span class="me1">Visible</span> = <span class="kw1">True</span>: etiquette<span class="br0">&#40;</span><span class="nu0">12</span><span class="br0">&#41;</span>.<span class="me1">Visible</span> = <span class="kw1">True</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Loop</span> Until tempo = <span class="nu0">99</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">BackColor</span> = <span class="kw1">vbWhite</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Converter.<span class="me1">BackColor</span> = <span class="kw1">vbWhite</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Resultat.<span class="me1">BackColor</span> = <span class="kw1">vbWhite</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; ClearType.<span class="me1">Value</span> = <span class="nu0">0</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; ClearType.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">22</span><span class="br0">&#41;</span>.<span class="me1">Visible</span> = <span class="kw1">False</span><br />

&nbsp; &nbsp; <span class="kw1">Else</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; debut = <span class="kw1">Timer</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; BitBlt Plug<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">hdc</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">176</span>, <span class="nu0">289</span>, myHDC, <span class="nu0">0</span>, Plug<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">Top</span>, vbSrcCopy<br />

&nbsp; &nbsp; &nbsp; &nbsp; Plug<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">Refresh</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Filig.<span class="me1">Visible</span> = <span class="kw1">False</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Browse2.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; RedimToFit.<span class="me1">Visible</span> = <span class="kw1">False</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">6</span><span class="br0">&#41;</span>.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Cover.<span class="me1">Visible</span> = <span class="kw1">False</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">12</span><span class="br0">&#41;</span>.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; ClearType.<span class="me1">Visible</span> = <span class="kw1">True</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">22</span><span class="br0">&#41;</span>.<span class="me1">Visible</span> = <span class="kw1">True</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; VoirApercu.<span class="me1">Visible</span> = <span class="kw1">False</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Browse3_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="kw1">Do</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Save_Folder.<span class="me1">Text</span> = SelectFolder<span class="br0">&#40;</span>LoadString<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>, <span class="kw1">Me</span>.<span class="me1">hwnd</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">Loop</span> <span class="kw1">While</span> Save_Folder.<span class="me1">Text</span> = <span class="kw1">vbNullString</span> <span class="kw1">Or</span> Save_Folder.<span class="me1">Text</span> = <span class="st0">&quot;NotDefine&quot;</span><br />

<br />
&nbsp; &nbsp; Enregistrer_Click <span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<span class="co1">'Private Sub Dest_Folder_LostFocus()</span><br />
<span class="co1">''Masquer l'infobulle</span><br />
<span class="co1">'BallonTip.Visible = False</span><br />
<span class="co1">'</span><br />

<span class="co1">'With Dest_Folder</span><br />
<span class="co1">' &nbsp; &nbsp;If .Text = vbNullString Then</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;.ForeColor = RGB(100, 100, 100)</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;.FontBold = False</span><br />

<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;.Text = LoadString(71)</span><br />
<span class="co1">' &nbsp; &nbsp;End If</span><br />
<span class="co1">'End With</span><br />
<span class="co1">'End Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Directory_DblClick<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="co1">'Bouble clic = clic sur le bouton</span><br />
&nbsp; &nbsp; Browse_Click<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Directory_OLEDragDrop<span class="br0">&#40;</span>Data <span class="kw1">As</span> DataObject, Effect <span class="kw1">As</span> <span class="kw1">Long</span>, Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="co1">'Drag'n drop</span><br />
&nbsp; &nbsp; Directory.<span class="me1">Text</span> = <span class="kw1">vbNullString</span><br />

&nbsp; &nbsp; Load_Text_File Data.<span class="me1">Files</span>.<span class="me1">Item</span><span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Enregistrer_Click<span class="br0">&#40;</span>Index <span class="kw1">As</span> <span class="kw1">Integer</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> Index = <span class="nu0">0</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Reseau.<span class="me1">Text</span> = <span class="kw1">vbNullString</span> <span class="kw1">Then</span> Reseau.<span class="me1">Text</span> = <span class="kw1">Environ</span>$<span class="br0">&#40;</span><span class="st0">&quot;USERNAME&quot;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Nom&quot;</span>, Reseau.<span class="me1">Text</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Enregistrer<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Visible</span> = <span class="kw1">False</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Reseau.<span class="me1">BackColor</span> = <span class="kw1">RGB</span><span class="br0">&#40;</span><span class="nu0">0</span>, <span class="nu0">196</span>, <span class="nu0">0</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">If</span> Index = <span class="nu0">1</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Dir</span>$<span class="br0">&#40;</span>Save_Folder.<span class="me1">Text</span>, <span class="kw1">vbDirectory</span><span class="br0">&#41;</span> = <span class="kw1">vbNullString</span> <span class="kw1">Then</span> Save_Folder.<span class="me1">BackColor</span> = <span class="nu0">255</span>: <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Save_Folder.<span class="me1">BackColor</span> = <span class="kw1">RGB</span><span class="br0">&#40;</span><span class="nu0">0</span>, <span class="nu0">196</span>, <span class="nu0">0</span><span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Save_Folder.<span class="me1">Text</span> = <span class="kw1">vbNullString</span> <span class="kw1">Then</span> Save_Folder.<span class="me1">Text</span> = App.<span class="me1">Path</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Default_Path&quot;</span>, Save_Folder.<span class="me1">Text</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Enregistrer<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">Visible</span> = <span class="kw1">False</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> etiquette_Click<span class="br0">&#40;</span>Index <span class="kw1">As</span> <span class="kw1">Integer</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="kw1">Dim</span> ctl <span class="kw1">As</span> Control<br />

<br />
&nbsp; &nbsp; <span class="co1">'Vérifier si on ne veut pas activer un checkbox</span><br />
&nbsp; &nbsp; <span class="kw1">For</span> Each ctl In <span class="kw1">Me</span>.<span class="me1">Controls</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> TypeOf ctl Is CheckBoxPlus <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> ctl.<span class="me1">Top</span> = etiquette<span class="br0">&#40;</span>Index<span class="br0">&#41;</span>.<span class="me1">Top</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> ctl.<span class="kw1">Left</span> &gt; etiquette<span class="br0">&#40;</span>Index<span class="br0">&#41;</span>.<span class="kw1">Left</span> - <span class="nu0">16</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> ctl.<span class="kw1">Left</span> &lt; etiquette<span class="br0">&#40;</span>Index<span class="br0">&#41;</span>.<span class="kw1">Left</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> ctl.<span class="me1">Enabled</span> = <span class="kw1">True</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ctl.<span class="me1">Value</span> = <span class="br0">&#40;</span>ctl.<span class="me1">Value</span> + <span class="nu0">1</span><span class="br0">&#41;</span> Mod <span class="nu0">2</span> &nbsp; &nbsp; &nbsp; <span class="co1">'On fait en cascade pour s'éviter un max de temps...</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">Next</span><br />
<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Filig_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; <span class="co1">'Propose plein de trucs marrants !</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> Filig.<span class="me1">Text</span> = LoadString<span class="br0">&#40;</span><span class="nu0">96</span><span class="br0">&#41;</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; ShellExecute <span class="kw1">Me</span>.<span class="me1">hwnd</span>, <span class="st0">&quot;open&quot;</span>, <span class="st0">&quot;http://www.ict.tuwien.ac.at/pictures/&quot;</span>, <span class="kw1">vbNullString</span>, App.<span class="me1">Path</span>, <span class="nu0">1</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />

&nbsp; &nbsp; <span class="co1">'Charge une belle image...</span><br />
&nbsp; &nbsp; Filig.<span class="me1">Text</span> = <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;BackPicture&quot;</span>, Filig.<span class="me1">Text</span>, Filig.<span class="me1">Text</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; MAJ.<span class="me1">Tag</span> = Filig.<span class="me1">Text</span><br />
&nbsp; &nbsp; MAJ.<span class="me1">Enabled</span> = <span class="kw1">True</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Langue_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; <span class="co1">'Change la langue de l'interface (a partir des tag des controles, ou de mon experience)</span><br />
&nbsp; &nbsp; <span class="kw1">Dim</span> ctl <span class="kw1">As</span> Control, swapper <span class="kw1">As</span> <span class="kw1">String</span><br />
&nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Langue&quot;</span>, Langue.<span class="me1">Text</span><br />

&nbsp; &nbsp; <span class="co1">'Truc à faire manuellement (hélas)</span><br />
&nbsp; &nbsp; Align<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> = LoadCaption<span class="br0">&#40;</span><span class="st0">&quot;Align|1|Caption&quot;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; Align<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> = LoadCaption<span class="br0">&#40;</span><span class="st0">&quot;Align|2|Caption&quot;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; Align<span class="br0">&#40;</span><span class="nu0">2</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> = LoadCaption<span class="br0">&#40;</span><span class="st0">&quot;Align|3|Caption&quot;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">For</span> tempo = <span class="nu0">0</span> <span class="kw1">To</span> <span class="nu0">18</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Edition<span class="br0">&#40;</span>tempo<span class="br0">&#41;</span>.<span class="me1">Caption</span> = LoadCaption<span class="br0">&#40;</span><span class="st0">&quot;Edition|&quot;</span> &amp; tempo &amp; <span class="st0">&quot;|Caption&quot;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">Next</span><br />
&nbsp; &nbsp; BallonTip.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; Translate_Text<br />
<br />

<span class="co1">' &nbsp; &nbsp;For Each ctl In Me.Controls</span><br />
<span class="co1">'</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;If TypeOf ctl Is Label Or TypeOf ctl Is CommandButton Or TypeOf ctl Is OptionButton Or TypeOf ctl Is Bouton Then</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;If ctl.Caption &lt;&gt; vbNullString Then</span><br />

<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;swapper = ctl.Caption</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;ctl.Caption = ctl.Tag</span><br />

<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;ctl.Tag = swapper</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Else</span><br />

<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;swapper = ctl.ToolTipText</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;ctl.ToolTipText = ctl.Tag</span><br />

<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;ctl.Tag = swapper</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;End If</span><br />

<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;End If</span><br />
<span class="co1">'</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;If TypeOf ctl Is Image Or TypeOf ctl Is CheckBox Or TypeOf ctl Is TextBox Then</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;swapper = ctl.ToolTipText</span><br />

<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;ctl.ToolTipText = ctl.Tag</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;ctl.Tag = swapper</span><br />
<span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;End If</span><br />

<span class="co1">'</span><br />
<span class="co1">' &nbsp; &nbsp;Next</span><br />
<br />
<span class="co1">' &nbsp; &nbsp;swapper = Dest_Folder.CueBanner</span><br />
<span class="co1">' &nbsp; &nbsp;Dest_Folder.CueBanner = Dest_Folder.Tag</span><br />
<span class="co1">' &nbsp; &nbsp;Dest_Folder.Tag = swapper</span><br />

<span class="co1">' &nbsp; &nbsp;swapper = KeyWord.CueBanner</span><br />
<span class="co1">' &nbsp; &nbsp;KeyWord.CueBanner = KeyWord.Tag</span><br />
<span class="co1">' &nbsp; &nbsp;KeyWord.Tag = swapper</span><br />
<span class="co1">' &nbsp; &nbsp;swapper = Root.CueBanner</span><br />
<span class="co1">' &nbsp; &nbsp;Root.CueBanner = Root.Tag</span><br />

<span class="co1">' &nbsp; &nbsp;Root.Tag = swapper</span><br />
<span class="co1">' &nbsp; &nbsp;swapper = Bug_Texte.CueBanner</span><br />
<span class="co1">' &nbsp; &nbsp;Bug_Texte.CueBanner = Bug_Texte.Tag</span><br />
<span class="co1">' &nbsp; &nbsp;Bug_Texte.Tag = swapper</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Couleur_Click<span class="br0">&#40;</span>Index <span class="kw1">As</span> <span class="kw1">Integer</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; <span class="co1">'Change la couleur de premier/arrière plan</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> Cover.<span class="me1">Value</span> = <span class="nu0">0</span> <span class="kw1">And</span> Index = <span class="nu0">2</span> <span class="kw1">And</span> Use_Back_Picture.<span class="me1">Value</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; AfficherTip LoadMSG<span class="br0">&#40;</span><span class="nu0">43</span><span class="br0">&#41;</span>, LoadMSG<span class="br0">&#40;</span><span class="nu0">44</span><span class="br0">&#41;</span>, Couleur<span class="br0">&#40;</span><span class="nu0">2</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; Couleur_Selectionnee = ChoixCouleur<span class="br0">&#40;</span><span class="kw1">Me</span>.<span class="me1">hwnd</span><span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> Couleur_Selectionnee = <span class="nu0">-1</span> <span class="kw1">Then</span> <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />

<br />
&nbsp; &nbsp; <span class="co1">'If Couleur((Index + 1) Mod 2).BackColor = Couleur_Selectionnee Then</span><br />
&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;AfficherTip LoadMSG(45), LoadMSG(46), Couleur(Index), False</span><br />
&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;Exit Sub</span><br />

&nbsp; &nbsp; <span class="co1">'End If</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> Index = <span class="nu0">0</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Apercu.<span class="me1">SelLength</span> = <span class="nu0">0</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">SelStart</span> = <span class="nu0">0</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">SelLength</span> = <span class="kw1">Len</span><span class="br0">&#40;</span>Apercu.<span class="me1">Text</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">SelColor</span> = Couleur_Selectionnee<br />

&nbsp; &nbsp; <span class="kw1">ElseIf</span> Index = <span class="nu0">1</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Apercu.BackColor = Couleur_Selectionnee</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Converter.BackColor = Couleur_Selectionnee</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Resultat.BackColor = Apercu.BackColor</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; SetBackColorSel Apercu.<span class="me1">hwnd</span>, Couleur_Selectionnee<br />
&nbsp; &nbsp; <span class="kw1">Else</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">BackColor</span> = Couleur_Selectionnee<br />
&nbsp; &nbsp; &nbsp; &nbsp; Converter.<span class="me1">BackColor</span> = Couleur_Selectionnee<br />

&nbsp; &nbsp; &nbsp; &nbsp; Resultat.<span class="me1">BackColor</span> = Couleur_Selectionnee<br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; Apercu.<span class="me1">SetFocus</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Defaut_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; <span class="co1">'Enregistrer le baladeur comme baladeur par défaut</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> Modeles.<span class="me1">Text</span> = LoadString<span class="br0">&#40;</span><span class="nu0">74</span><span class="br0">&#41;</span> <span class="kw1">Or</span> Modeles.<span class="me1">Text</span> = <span class="kw1">vbNullString</span> <span class="kw1">Then</span> <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />

&nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Modele&quot;</span>, <span class="kw1">vbNullString</span><span class="br0">&#41;</span> &lt;&gt; <span class="kw1">vbNullString</span> <span class="kw1">And</span> <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Marque&quot;</span>, <span class="kw1">vbNullString</span><span class="br0">&#41;</span> &lt;&gt; <span class="kw1">vbNullString</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Demander confirmation avant le remplacement</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">vbNo</span> = <span class="kw1">MsgBox</span><span class="br0">&#40;</span>Replace<span class="br0">&#40;</span>Replace<span class="br0">&#40;</span>LoadString<span class="br0">&#40;</span><span class="nu0">78</span><span class="br0">&#41;</span>, <span class="st0">&quot;%u&quot;</span>, <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Modele&quot;</span>, <span class="kw1">vbNullString</span><span class="br0">&#41;</span> &amp; <span class="st0">&quot;-&quot;</span> &amp; <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Marque&quot;</span>, <span class="kw1">vbNullString</span><span class="br0">&#41;</span><span class="br0">&#41;</span>, <span class="st0">&quot;%n&quot;</span>, Modeles.<span class="me1">Text</span> &amp; <span class="st0">&quot;-&quot;</span> &amp; Marque.<span class="me1">Text</span><span class="br0">&#41;</span> &amp; <span class="st0">&quot;?&quot;</span>, <span class="kw1">vbYesNo</span> + <span class="kw1">vbExclamation</span>, LoadString<span class="br0">&#40;</span><span class="nu0">80</span><span class="br0">&#41;</span><span class="br0">&#41;</span> <span class="kw1">Then</span> <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
&nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Modele&quot;</span>, Modeles.<span class="me1">Text</span><br />

&nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Marque&quot;</span>, Marque.<span class="me1">Text</span><br />
&nbsp; &nbsp; Defaut.<span class="me1">Visible</span> = <span class="kw1">False</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Edition_Click<span class="br0">&#40;</span>Index <span class="kw1">As</span> <span class="kw1">Integer</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; <span class="co1">'toutes les options du clic droit</span><br />
&nbsp; &nbsp; <span class="kw1">Dim</span> donnees <span class="kw1">As</span> <span class="kw1">String</span><br />
<br />
&nbsp; &nbsp; Select <span class="kw1">Case</span> Index<br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Case</span> <span class="nu0">0</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Annuler</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">SetFocus</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">SendKeys</span> <span class="st0">&quot;^z&quot;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Case</span> <span class="nu0">2</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Remplacer</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Rechercher.<span class="me1">Visible</span> = <span class="kw1">True</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Rechercher.<span class="me1">Top</span> = <span class="kw1">Me</span>.<span class="me1">ScaleHeight</span> - Rechercher.<span class="me1">Height</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">Height</span> = <span class="kw1">Me</span>.<span class="me1">ScaleHeight</span> - Rechercher.<span class="me1">Height</span> - <span class="nu0">6</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Rechercher_Remplacer.<span class="me1">Enabled</span> = <span class="kw1">True</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Rechercher_Remplacer.<span class="me1">BackColor</span> = <span class="kw1">vbWhite</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Rechercher_Texte.<span class="me1">ForeColor</span> = <span class="kw1">vbBlack</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Rechercher_Texte.<span class="me1">Text</span> = Apercu.<span class="me1">SelText</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Rechercher.<span class="me1">Tag</span> = LoadString<span class="br0">&#40;</span><span class="nu0">68</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Rechercher_Close.<span class="me1">Picture</span> = Cross<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Picture</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Rechercher_Suite.<span class="me1">Caption</span> = LoadString<span class="br0">&#40;</span><span class="nu0">68</span><span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Case</span> <span class="nu0">3</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Rechercher</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Rechercher.<span class="me1">Visible</span> = <span class="kw1">True</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Rechercher.<span class="me1">Top</span> = <span class="kw1">Me</span>.<span class="me1">ScaleHeight</span> - Rechercher.<span class="me1">Height</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">Height</span> = <span class="kw1">Me</span>.<span class="me1">ScaleHeight</span> - Rechercher.<span class="me1">Height</span> - <span class="nu0">6</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Rechercher_Remplacer.<span class="me1">Enabled</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Rechercher_Close.<span class="me1">Picture</span> = Cross<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Picture</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Rechercher_Remplacer.<span class="me1">BackColor</span> = <span class="kw1">RGB</span><span class="br0">&#40;</span><span class="nu0">128</span>, <span class="nu0">128</span>, <span class="nu0">128</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Rechercher_Texte.<span class="me1">Text</span> = Apercu.<span class="me1">SelText</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Rechercher.<span class="me1">Tag</span> = LoadString<span class="br0">&#40;</span><span class="nu0">67</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Rechercher_Suite.<span class="me1">Caption</span> = LoadString<span class="br0">&#40;</span><span class="nu0">81</span><span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Case</span> <span class="nu0">5</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Ajuster</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">MousePointer</span> = vbCustom<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SVGofRTF = Apercu.<span class="me1">TextRTF</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; donnees = Apercu.<span class="me1">Text</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; donnees = Replace<span class="br0">&#40;</span>donnees, <span class="st0">&quot; &quot;</span> &amp; <span class="kw1">vbCrLf</span>, <span class="kw1">vbCrLf</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; donnees = Replace<span class="br0">&#40;</span>donnees, <span class="st0">&quot; &nbsp;&quot;</span>, <span class="st0">&quot; &quot;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; donnees = Replace<span class="br0">&#40;</span>donnees, <span class="st0">&quot; .&quot;</span>, <span class="st0">&quot;.&quot;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; donnees = Replace<span class="br0">&#40;</span>donnees, <span class="st0">&quot; ,&quot;</span>, <span class="st0">&quot;,&quot;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; donnees = Replace<span class="br0">&#40;</span>donnees, <span class="st0">&quot;?&quot;</span>, <span class="st0">&quot;--&quot;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; donnees = Replace<span class="br0">&#40;</span>donnees, <span class="st0">&quot;?&quot;</span>, <span class="st0">&quot;..&quot;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">TextRTF</span> = <span class="kw1">vbNullString</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">Text</span> = donnees<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">MousePointer</span> = <span class="nu0">0</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Do_Abort<br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Case</span> <span class="nu0">6</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Double sauts de ligne</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; donnees = Apercu.<span class="me1">Text</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; donnees = Replace<span class="br0">&#40;</span>donnees, <span class="kw1">vbCrLf</span> &amp; <span class="kw1">vbCrLf</span>, <span class="kw1">vbCrLf</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SVGofRTF = Apercu.<span class="me1">TextRTF</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">TextRTF</span> = <span class="kw1">vbNullString</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">TextRTF</span> = donnees<br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Do_Abort<br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Case</span> <span class="nu0">7</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;'Faire des modifs de police</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;On Error Resume Next</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;'Préremplir les champs</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;With Browser</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;.fontname = Apercu.SelFontName</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;.FontSize = Apercu.SelFontSize</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;.FontBold = Apercu.SelBold</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;.FontItalic = Apercu.SelItalic</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;.FontUnderline = Apercu.SelUnderline</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;.FontStrikethru = Apercu.SelStrikeThru</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;.flags = 1</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;.ShowFont</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;End With</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;'Si abandon</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;If Err = 32755 Then Exit Sub</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;' Modifier ce qu'il faut</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;With Browser</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;Apercu.SelFontName = .fontname</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;Apercu.SelFontSize = .FontSize</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;Apercu.SelBold = .FontBold</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;Apercu.SelItalic = .FontItalic</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;Apercu.SelUnderline = .FontUnderline</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;Apercu.SelStrikeThru = .FontStrikethru</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;End With</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Case</span> <span class="nu0">9</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Couper</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">SetFocus</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">SendKeys</span> <span class="st0">&quot;^x&quot;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Case</span> <span class="nu0">10</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Copier</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">SetFocus</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">SendKeys</span> <span class="st0">&quot;^c&quot;</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Case</span> <span class="nu0">11</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Coller</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">SetFocus</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">SendKeys</span> <span class="st0">&quot;^v&quot;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Case</span> <span class="nu0">12</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'RTF=&gt;TXT</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SVGofRTF = Apercu.<span class="me1">TextRTF</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">TextRTF</span> = <span class="kw1">vbNullString</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">Text</span> = SVGofRTF<br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Case</span> <span class="nu0">13</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'TXT=&gt;RTF</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">TextRTF</span> = Apercu.<span class="me1">Text</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Case</span> <span class="nu0">15</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Recharge tout en mettant par défaut</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Unload</span> <span class="kw1">Me</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">Show</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Case</span> <span class="nu0">17</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">SelRTF</span> = Barre &amp; Apercu.<span class="me1">SelRTF</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Case</span> <span class="nu0">19</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<span class="kw1">MsgBox</span> Replace<span class="br0">&#40;</span>LoadString<span class="br0">&#40;</span><span class="nu0">120</span><span class="br0">&#41;</span>, <span class="st0">&quot;%u&quot;</span>, <span class="st0">&quot;CTRL + SHIFT + A&quot;</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Case</span> <span class="nu0">20</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">MsgBox</span> Replace<span class="br0">&#40;</span>LoadString<span class="br0">&#40;</span><span class="nu0">120</span><span class="br0">&#41;</span>, <span class="st0">&quot;%u&quot;</span>, <span class="st0">&quot;CTRL + 2 or CTRL + 1&quot;</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Case</span> <span class="nu0">21</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">MsgBox</span> Replace<span class="br0">&#40;</span>LoadString<span class="br0">&#40;</span><span class="nu0">120</span><span class="br0">&#41;</span>, <span class="st0">&quot;%u&quot;</span>, <span class="st0">&quot;CTRL + SHIFT + =&quot;</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Case</span> <span class="nu0">22</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">MsgBox</span> Replace<span class="br0">&#40;</span>LoadString<span class="br0">&#40;</span><span class="nu0">120</span><span class="br0">&#41;</span>, <span class="st0">&quot;%u&quot;</span>, <span class="st0">&quot;CTRL + =&quot;</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">End</span> Select<br />
<br />
&nbsp; &nbsp; <span class="co1">'Et on remet le focus</span><br />
&nbsp; &nbsp; Apercu.<span class="me1">SetFocus</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> En_JPG_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; <span class="co1">'Proposer d'encoder les images en JPG</span><br />
&nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;SaveAsJpg&quot;</span>, En_JPG.<span class="me1">Value</span><br />
&nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">MousePointer</span> = vbCustom<br />

<br />
&nbsp; &nbsp; <span class="kw1">If</span> En_JPG.<span class="me1">Value</span> = <span class="kw1">True</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Dir</span>$<span class="br0">&#40;</span>GiveMePathOf<span class="br0">&#40;</span>&amp;H25<span class="br0">&#41;</span> &amp; <span class="st0">&quot;\BMP2JPG.dll&quot;</span><span class="br0">&#41;</span> = <span class="kw1">vbNullString</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">vbYes</span> = <span class="kw1">MsgBox</span><span class="br0">&#40;</span>LoadString<span class="br0">&#40;</span><span class="nu0">82</span><span class="br0">&#41;</span> &amp; <span class="kw1">vbCrLf</span> &amp; <span class="kw1">vbCrLf</span> &amp; <span class="kw1">vbCrLf</span> &amp; <span class="st0">&quot;You should download a DLL in order to save in Jpg. Do it now ? (if an error occur, please see you firewall)&quot;</span>, <span class="kw1">vbYesNo</span> + <span class="kw1">vbCritical</span>, LoadString<span class="br0">&#40;</span><span class="nu0">83</span><span class="br0">&#41;</span><span class="br0">&#41;</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; AfficherTip LoadMSG<span class="br0">&#40;</span><span class="nu0">49</span><span class="br0">&#41;</span>, LoadMSG<span class="br0">&#40;</span><span class="nu0">50</span><span class="br0">&#41;</span>, Start, <span class="kw1">False</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Download <span class="st0">&quot;http://neamar.free.fr/Addins/BMP2JPG.dll&quot;</span>, GiveMePathOf<span class="br0">&#40;</span>&amp;H25<span class="br0">&#41;</span> &amp; <span class="st0">&quot;\BMP2JPG.dll&quot;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; BallonTip.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; En_JPG_Click<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Else</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; En_JPG.<span class="me1">Value</span> = <span class="nu0">0</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Else</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">11</span><span class="br0">&#41;</span>.<span class="me1">Visible</span> = <span class="kw1">True</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Qualite.<span class="me1">Visible</span> = <span class="kw1">True</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Qualite_MouseMove <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">1</span>, <span class="nu0">1</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">Else</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">11</span><span class="br0">&#41;</span>.<span class="me1">Visible</span> = <span class="kw1">False</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Qualite.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />

&nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">MousePointer</span> = <span class="nu0">0</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Filig_Change<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="kw1">Dim</span> PATH_FOLDER <span class="kw1">As</span> <span class="kw1">String</span><br />

<br />
&nbsp; &nbsp; <span class="co1">'Validité du chemin passé en paramètre</span><br />
&nbsp; &nbsp; PATH_FOLDER = Filig.<span class="me1">Text</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">LCase</span>$<span class="br0">&#40;</span><span class="kw1">Right</span>$<span class="br0">&#40;</span>PATH_FOLDER, <span class="nu0">3</span><span class="br0">&#41;</span><span class="br0">&#41;</span> = <span class="st0">&quot;bmp&quot;</span> <span class="kw1">Or</span> <span class="kw1">LCase</span>$<span class="br0">&#40;</span><span class="kw1">Right</span>$<span class="br0">&#40;</span>PATH_FOLDER, <span class="nu0">3</span><span class="br0">&#41;</span><span class="br0">&#41;</span> = <span class="st0">&quot;jpg&quot;</span> <span class="kw1">Then</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Dim</span> attente <span class="kw1">As</span> <span class="kw1">String</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Dir</span>$<span class="br0">&#40;</span>PATH_FOLDER<span class="br0">&#41;</span> = <span class="kw1">vbNullString</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; AfficherTip LoadMSG<span class="br0">&#40;</span><span class="nu0">51</span><span class="br0">&#41;</span>, LoadMSG<span class="br0">&#40;</span><span class="nu0">52</span><span class="br0">&#41;</span>, Filig, <span class="kw1">vbExclamation</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Filig.<span class="me1">BackColor</span> = <span class="nu0">255</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Filig.<span class="me1">ForeColor</span> = <span class="nu0">0</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; VoirApercu.<span class="me1">Visible</span> = <span class="kw1">False</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; BallonTip.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Svg dans le registre</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; attente = <span class="kw1">Right</span>$<span class="br0">&#40;</span>PATH_FOLDER, <span class="kw1">Len</span><span class="br0">&#40;</span>PATH_FOLDER<span class="br0">&#41;</span> - <span class="kw1">InStrRev</span><span class="br0">&#40;</span>PATH_FOLDER, <span class="st0">&quot;\&quot;</span><span class="br0">&#41;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;BackPicture&quot;</span>, <span class="kw1">Left</span>$<span class="br0">&#40;</span>attente, <span class="kw1">Len</span><span class="br0">&#40;</span>attente<span class="br0">&#41;</span> - <span class="nu0">4</span><span class="br0">&#41;</span>, PATH_FOLDER<br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Changer la couleur</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Filig.<span class="me1">BackColor</span> = GetPixel<span class="br0">&#40;</span>Filig.<span class="me1">Container</span>.<span class="me1">hdc</span>, Filig.<span class="kw1">Left</span>, Filig.<span class="me1">Top</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Filig.<span class="me1">ForeColor</span> = <span class="kw1">RGB</span><span class="br0">&#40;</span><span class="nu0">255</span>, <span class="nu0">255</span>, <span class="nu0">255</span><span class="br0">&#41;</span> - Filig.<span class="me1">BackColor</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Afficher un bouton pour apercu</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; VoirApercu.<span class="me1">Visible</span> = <span class="kw1">True</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Et puis le but principal</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Image_A_Blitter.<span class="me1">Picture</span> = <span class="kw1">LoadPicture</span><span class="br0">&#40;</span>PATH_FOLDER<span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Et remettre pour être sur que ca marche !</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">BackColor</span> = <span class="kw1">vbWhite</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Converter.<span class="me1">BackColor</span> = <span class="kw1">vbWhite</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Resultat.<span class="me1">BackColor</span> = <span class="kw1">vbWhite</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Image_A_Blitter.<span class="kw1">Width</span> &lt;&gt; Largeur.<span class="me1">Text</span> <span class="kw1">Or</span> Image_A_Blitter.<span class="me1">Height</span> &lt;&gt; Hauteur.<span class="me1">Text</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; RedimToFit.<span class="me1">Value</span> = <span class="kw1">True</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; RedimToFit.<span class="me1">Visible</span> = <span class="kw1">True</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">6</span><span class="br0">&#41;</span>.<span class="me1">Visible</span> = <span class="kw1">True</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Else</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; RedimToFit.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">6</span><span class="br0">&#41;</span>.<span class="me1">Visible</span> = <span class="kw1">False</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">Else</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; AfficherTip LoadMSG<span class="br0">&#40;</span><span class="nu0">53</span><span class="br0">&#41;</span>, LoadMSG<span class="br0">&#40;</span><span class="nu0">54</span><span class="br0">&#41;</span>, Filig<br />

&nbsp; &nbsp; &nbsp; &nbsp; Image_A_Blitter.<span class="me1">Picture</span> = <span class="kw1">LoadPicture</span><span class="br0">&#40;</span><span class="kw1">vbNullString</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; VoirApercu.<span class="me1">Visible</span> = <span class="kw1">False</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Form_Load<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="kw1">Dim</span> Premiere_Utilisation <span class="kw1">As</span> <span class="kw1">Boolean</span>, Last <span class="kw1">As</span> <span class="kw1">Long</span>, donnees <span class="kw1">As</span> <span class="kw1">String</span>, MySettings <span class="kw1">As</span> Variant, poubelle2 <span class="kw1">As</span> <span class="kw1">Long</span><br />

&nbsp; &nbsp; <span class="co1">'Lancer le subclassing</span><br />
&nbsp; &nbsp; myHDC = <span class="kw1">Me</span>.<span class="me1">hdc</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> App.<span class="me1">LogMode</span> &lt;&gt; <span class="nu0">0</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; SetFormMinMaxSize <span class="kw1">Me</span>, <span class="nu0">900</span>, , <span class="nu0">344</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; OldWindowProc = SetWindowLong<span class="br0">&#40;</span>hwnd, GWL_WNDPROC, AddressOf NewWindowProc<span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> App.<span class="me1">PrevInstance</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">MsgBox</span> LoadString<span class="br0">&#40;</span><span class="nu0">84</span><span class="br0">&#41;</span>, <span class="kw1">vbOKOnly</span>, <span class="st0">&quot;PrevInstance&quot;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Unload</span> <span class="kw1">Me</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

<br />
&nbsp; &nbsp; <span class="co1">'Définition des variables utilisiées tout au long du programme</span><br />
&nbsp; &nbsp; Stockage = GiveMePathOf<span class="br0">&#40;</span>&amp;H1C<span class="br0">&#41;</span> &amp; <span class="st0">&quot;\Stockage.txt&quot;</span>: &nbsp; &nbsp; NotUse = <span class="kw1">False</span>: &nbsp; &nbsp; Premiere_Utilisation = <span class="kw1">False</span>: &nbsp; &nbsp;NoInternet = <span class="kw1">False</span>: &nbsp; &nbsp;MyChoiceIs = <span class="nu0">25</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Nom&quot;</span>, <span class="kw1">vbNullString</span><span class="br0">&#41;</span> = <span class="kw1">vbNullString</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Nom&quot;</span>, <span class="kw1">Environ</span>$<span class="br0">&#40;</span><span class="st0">&quot;USERNAME&quot;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Premiere_Utilisation = <span class="kw1">True</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
<br />
&nbsp; &nbsp; <span class="co1">'Nettoyer les anciennes traces</span><br />
&nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">MousePointer</span> = vbCustom<br />

<br />
&nbsp; &nbsp; <span class="co1">'Initialiser la feuille : cocher ce qui doit l'être, régler la taille, afficher un BG</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Dir</span>$<span class="br0">&#40;</span><span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;BackPic&quot;</span>, <span class="kw1">vbNullString</span><span class="br0">&#41;</span><span class="br0">&#41;</span> &lt;&gt; <span class="kw1">vbNullString</span> <span class="kw1">Then</span> <span class="kw1">Set</span> BackPicture = <span class="kw1">LoadPicture</span><span class="br0">&#40;</span><span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;BackPic&quot;</span>, <span class="kw1">vbNullString</span><span class="br0">&#41;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">Me</span>.<span class="kw1">Width</span> = Screen.<span class="kw1">Width</span>: <span class="kw1">Me</span>.<span class="me1">Height</span> = <span class="nu0">5160</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> App.<span class="me1">LogMode</span> = <span class="nu0">0</span> <span class="kw1">Then</span> <span class="kw1">Me</span>.<span class="kw1">Width</span> = <span class="nu0">13950</span><br />

&nbsp; &nbsp; DoNotChange = <span class="kw1">True</span><br />
&nbsp; &nbsp; BG_red = <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;BG_red&quot;</span>, <span class="st0">&quot;0&quot;</span><span class="br0">&#41;</span>: BC<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Value</span> = BG_red<br />

&nbsp; &nbsp; BG_green = <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;BG_green&quot;</span>, <span class="nu0">1</span><span class="br0">&#41;</span>: BC<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">Value</span> = BG_green<br />

&nbsp; &nbsp; BG_blue = <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;BG_blue&quot;</span>, <span class="st0">&quot;0&quot;</span><span class="br0">&#41;</span>: BC<span class="br0">&#40;</span><span class="nu0">2</span><span class="br0">&#41;</span>.<span class="me1">Value</span> = BG_blue<br />

&nbsp; &nbsp; Make_Slide.<span class="me1">Value</span> = <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Make_Slide&quot;</span>, <span class="kw1">True</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; Reseau.<span class="me1">Text</span> = <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Nom&quot;</span>, <span class="kw1">Environ</span>$<span class="br0">&#40;</span><span class="st0">&quot;USERNAME&quot;</span><span class="br0">&#41;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; sens_dessin = <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Sens_dessin&quot;</span>, <span class="st0">&quot;0&quot;</span><span class="br0">&#41;</span>: BC<span class="br0">&#40;</span><span class="nu0">3</span><span class="br0">&#41;</span>.<span class="me1">Value</span> = sens_dessin<br />

&nbsp; &nbsp; Save_Folder.<span class="me1">Text</span> = <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Default_Path&quot;</span>, App.<span class="me1">Path</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; PutACopyOfFileInFolder.<span class="me1">Value</span> = <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;PutCopy&quot;</span>, <span class="kw1">False</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; UseForeColor.<span class="me1">Value</span> = <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;CleverColor&quot;</span>, <span class="kw1">False</span><span class="br0">&#41;</span>: CleverColor = <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;CleverColor&quot;</span>, <span class="kw1">False</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; Couleur<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">BackColor</span> = <span class="nu0">0</span><br />
&nbsp; &nbsp; En_JPG.<span class="me1">Value</span> = <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;SaveAsJpg&quot;</span>, <span class="kw1">True</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="co1">'Crée la liste par défaut des bG.</span><br />
&nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;BackPicture&quot;</span>, LoadString<span class="br0">&#40;</span><span class="nu0">86</span><span class="br0">&#41;</span>, App.<span class="me1">Path</span> &amp; <span class="st0">&quot;\parchment.jpg&quot;</span><br />

&nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;BackPicture&quot;</span>, LoadString<span class="br0">&#40;</span><span class="nu0">87</span><span class="br0">&#41;</span>, App.<span class="me1">Path</span> &amp; <span class="st0">&quot;\aqua.jpg&quot;</span><br />
&nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;BackPicture&quot;</span>, LoadString<span class="br0">&#40;</span><span class="nu0">88</span><span class="br0">&#41;</span>, App.<span class="me1">Path</span> &amp; <span class="st0">&quot;\earth.jpg&quot;</span><br />

&nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;BackPicture&quot;</span>, LoadString<span class="br0">&#40;</span><span class="nu0">89</span><span class="br0">&#41;</span>, App.<span class="me1">Path</span> &amp; <span class="st0">&quot;\sign.jpg&quot;</span><br />
&nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;BackPicture&quot;</span>, LoadString<span class="br0">&#40;</span><span class="nu0">90</span><span class="br0">&#41;</span>, App.<span class="me1">Path</span> &amp; <span class="st0">&quot;\stars.jpg&quot;</span><br />

&nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;BackPicture&quot;</span>, LoadString<span class="br0">&#40;</span><span class="nu0">91</span><span class="br0">&#41;</span>, App.<span class="me1">Path</span> &amp; <span class="st0">&quot;\wave.jpg&quot;</span><br />
&nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;BackPicture&quot;</span>, LoadString<span class="br0">&#40;</span><span class="nu0">92</span><span class="br0">&#41;</span>, App.<span class="me1">Path</span> &amp; <span class="st0">&quot;\sky.jpg&quot;</span><br />

&nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;BackPicture&quot;</span>, LoadString<span class="br0">&#40;</span><span class="nu0">93</span><span class="br0">&#41;</span>, App.<span class="me1">Path</span> &amp; <span class="st0">&quot;\Paix.jpg&quot;</span><br />
&nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;BackPicture&quot;</span>, LoadString<span class="br0">&#40;</span><span class="nu0">94</span><span class="br0">&#41;</span>, App.<span class="me1">Path</span> &amp; <span class="st0">&quot;\Ondine.jpg&quot;</span><br />

&nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;BackPicture&quot;</span>, LoadString<span class="br0">&#40;</span><span class="nu0">95</span><span class="br0">&#41;</span>, App.<span class="me1">Path</span> &amp; <span class="st0">&quot;\Cristal.jpg&quot;</span><br />
&nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;BackPicture&quot;</span>, LoadString<span class="br0">&#40;</span><span class="nu0">96</span><span class="br0">&#41;</span>, LoadString<span class="br0">&#40;</span><span class="nu0">96</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="co1">'Charger les priorités..</span><br />
&nbsp; &nbsp; Priorite.<span class="me1">AddItem</span> <span class="st0">&quot;NORMAL_PRIORITY_CLASS&quot;</span><br />
&nbsp; &nbsp; Priorite.<span class="me1">AddItem</span> <span class="st0">&quot;ABOVE_NORMAL_PRIORITY_CLASS&quot;</span><br />

&nbsp; &nbsp; Priorite.<span class="me1">AddItem</span> <span class="st0">&quot;HIGH_PRIORITY_CLASS&quot;</span><br />
&nbsp; &nbsp; Priorite.<span class="me1">AddItem</span> <span class="st0">&quot;REALTIME_PRIORITY_CLASS&quot;</span><br />
&nbsp; &nbsp; Priorite.<span class="me1">Text</span> = <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Priorite&quot;</span>, <span class="st0">&quot;NORMAL_PRIORITY_CLASS&quot;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; SendMessage Priorite.<span class="me1">hwnd</span>, CB_SETDROPPEDWIDTH, <span class="nu0">200</span>, ByVal <span class="nu0">0</span><br />
<br />
&nbsp; &nbsp; <span class="co1">' Extrait les paramètres et remplit la liste des BG</span><br />
&nbsp; &nbsp; MySettings = GetAllSettings<span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;BackPicture&quot;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; poubelle = <span class="kw1">UBound</span><span class="br0">&#40;</span>MySettings, <span class="nu0">1</span><span class="br0">&#41;</span>: poubelle2 = <span class="kw1">LBound</span><span class="br0">&#40;</span>MySettings, <span class="nu0">1</span><span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">For</span> tempo = poubelle2 <span class="kw1">To</span> poubelle<br />

&nbsp; &nbsp; &nbsp; &nbsp; Filig.<span class="me1">AddItem</span> MySettings<span class="br0">&#40;</span>tempo, <span class="nu0">0</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="co1">'Afficher le &quot;CHARGEMENT...&quot;</span><br />

&nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">2</span><span class="br0">&#41;</span>.<span class="me1">Top</span> = Hauteur - etiquette<span class="br0">&#40;</span><span class="nu0">2</span><span class="br0">&#41;</span>.<span class="me1">Height</span> - <span class="nu0">50</span><br />
&nbsp; &nbsp; DoNotChange = <span class="kw1">False</span><br />

<br />
&nbsp; &nbsp; <span class="co1">'Initialisation de l'ensemble linguistique</span><br />
&nbsp; &nbsp; donnees = <span class="kw1">Dir</span><span class="br0">&#40;</span>App.<span class="me1">Path</span> &amp; <span class="st0">&quot;\Lang\*.LNG&quot;</span><span class="br0">&#41;</span> <span class="co1">'lister les langues disponibles</span><br />

&nbsp; &nbsp; <span class="kw1">Do</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Langue.<span class="me1">AddItem</span> <span class="kw1">Left</span>$<span class="br0">&#40;</span>donnees, <span class="kw1">Len</span><span class="br0">&#40;</span>donnees<span class="br0">&#41;</span> - <span class="nu0">4</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; donnees = <span class="kw1">Dir</span><br />
&nbsp; &nbsp; <span class="kw1">Loop</span> <span class="kw1">While</span> donnees &lt;&gt; <span class="kw1">vbNullString</span><br />

&nbsp; &nbsp; Translate_Text<br />
&nbsp; &nbsp; Langue.<span class="me1">Text</span> = <span class="st0">&quot;&lt;Chose Your Language&gt;&quot;</span><br />
<br />
&nbsp; &nbsp; <span class="co1">'Et voilà, on montre la feuille !</span><br />

&nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">Caption</span> = <span class="st0">&quot;TXT2JPG, build &quot;</span> &amp; App.<span class="me1">Revision</span><br />
&nbsp; &nbsp; Apercu.<span class="me1">Visible</span> = <span class="kw1">False</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">Show</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
&nbsp; &nbsp; Qualite_MouseMove <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">0</span><br />

&nbsp; &nbsp; <span class="kw1">Kill</span> Stockage<br />
<br />
<br />
&nbsp; &nbsp; NonForcé = <span class="kw1">False</span><br />
&nbsp; &nbsp; TailleDegrade_MouseMove <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">0</span>: TailleDegrade_MouseMove <span class="nu0">1</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">0</span><br />

&nbsp; &nbsp; ColorRange<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">BackColor</span> = <span class="nu0">0</span>: ColorRange<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">BackColor</span> = <span class="nu0">0</span><br />

&nbsp; &nbsp; Browse2.<span class="me1">Picture</span> = Browse.<span class="me1">Picture</span><br />
&nbsp; &nbsp; Browse3.<span class="me1">Picture</span> = Browse.<span class="me1">Picture</span><br />
&nbsp; &nbsp; Enregistrer<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">Picture</span> = Enregistrer<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Picture</span><br />

&nbsp; &nbsp; Defaut.<span class="me1">Picture</span> = Enregistrer<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Picture</span><br />
&nbsp; &nbsp; ChoosePic.<span class="me1">Taille</span> = <span class="nu0">8</span><br />

&nbsp; &nbsp; VoirApercu.<span class="me1">Taille</span> = <span class="nu0">10</span><br />
&nbsp; &nbsp; Appliquer.<span class="me1">Taille</span> = <span class="nu0">10</span><br />
&nbsp; &nbsp; AppliquImage.<span class="me1">Taille</span> = <span class="nu0">10</span><br />

&nbsp; &nbsp; Couleur<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">BackColor</span> = <span class="kw1">RGB</span><span class="br0">&#40;</span><span class="nu0">255</span>, <span class="nu0">255</span>, <span class="nu0">255</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; Converter.<span class="me1">BackColor</span> = <span class="kw1">RGB</span><span class="br0">&#40;</span><span class="nu0">255</span>, <span class="nu0">255</span>, <span class="nu0">255</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; OverView.<span class="me1">ZOrder</span> <span class="nu0">0</span><br />
&nbsp; &nbsp; PlugChoice_Click <span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> Premiere_Utilisation <span class="kw1">Then</span> AfficherTip LoadMSG<span class="br0">&#40;</span><span class="nu0">55</span><span class="br0">&#41;</span>, LoadMSG<span class="br0">&#40;</span><span class="nu0">56</span><span class="br0">&#41;</span>, PlugChoice<span class="br0">&#40;</span><span class="nu0">3</span><span class="br0">&#41;</span>, <span class="kw1">vbExclamation</span><br />

&nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Command</span>$<span class="br0">&#40;</span><span class="br0">&#41;</span> &lt;&gt; <span class="kw1">vbNullString</span> <span class="kw1">Then</span> Load_Text_File <span class="kw1">Mid</span>$<span class="br0">&#40;</span><span class="kw1">Command</span>$<span class="br0">&#40;</span><span class="br0">&#41;</span>, <span class="nu0">2</span>, <span class="kw1">Len</span><span class="br0">&#40;</span><span class="kw1">Command</span>$<span class="br0">&#40;</span><span class="br0">&#41;</span><span class="br0">&#41;</span> - <span class="nu0">2</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="co1">'De seconde main (dl liste baladeur..)</span><br />
&nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
&nbsp; &nbsp; Download <span class="st0">&quot;http://neamar.free.fr/Addins/baladeurs.php?requete=MarqueENUM&quot;</span><br />
&nbsp; &nbsp; <span class="kw1">Open</span> Stockage <span class="kw1">For</span> <span class="kw1">Input</span> <span class="kw1">As</span> #<span class="nu0">1</span><br />

&nbsp; &nbsp; <span class="kw1">Line</span> <span class="kw1">Input</span> #<span class="nu0">1</span>, donnees<br />
&nbsp; &nbsp; <span class="kw1">Close</span> #<span class="nu0">1</span><br />

<br />
&nbsp; &nbsp; donnees = donnees &amp; LoadString<span class="br0">&#40;</span><span class="nu0">109</span><span class="br0">&#41;</span> &amp; <span class="st0">&quot;|&quot;</span><br />
&nbsp; &nbsp; <span class="co1">'Liste des marques</span><br />
&nbsp; &nbsp; tempo = <span class="nu0">1</span><br />

&nbsp; &nbsp; Last = <span class="nu0">1</span><br />
&nbsp; &nbsp; <span class="co1">'Explode la liste</span><br />
&nbsp; &nbsp; poubelle = <span class="kw1">Len</span><span class="br0">&#40;</span>donnees<span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">For</span> tempo = <span class="nu0">1</span> <span class="kw1">To</span> poubelle<br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Mid</span>$<span class="br0">&#40;</span>donnees, tempo, <span class="nu0">1</span><span class="br0">&#41;</span> = <span class="st0">&quot;|&quot;</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Marque.<span class="me1">AddItem</span> <span class="kw1">Mid</span>$<span class="br0">&#40;</span>donnees, Last, tempo - Last<span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Last = tempo + <span class="nu0">1</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; tempo = tempo + <span class="nu0">1</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Modele&quot;</span>, <span class="kw1">vbNullString</span><span class="br0">&#41;</span> &lt;&gt; <span class="kw1">vbNullString</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Marque.<span class="me1">Text</span> = <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Marque&quot;</span>, <span class="kw1">vbNullString</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Marque_Click<br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Modeles.<span class="me1">Text</span> = <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Modele&quot;</span>, <span class="kw1">vbNullString</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Modeles_Click<br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; Apercu.<span class="me1">Visible</span> = <span class="kw1">True</span><br />

&nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">MousePointer</span> = <span class="nu0">0</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> <span class="br0">&#40;</span><span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;ExitCode&quot;</span>, <span class="nu0">0</span><span class="br0">&#41;</span> &lt;&gt; <span class="nu0">0</span> <span class="kw1">And</span> App.<span class="me1">LogMode</span> &lt;&gt; <span class="nu0">0</span><span class="br0">&#41;</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Le logiciel a été mal quitté ! (et est compilé !)</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; BUG.<span class="me1">Visible</span> = <span class="kw1">True</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; BUG.<span class="me1">Top</span> = <span class="nu0">-30</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Bug_Close.Picture = BallonTipCancel(0).Picture</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; debut = <span class="kw1">Timer</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">Height</span> = Apercu.<span class="me1">Height</span> - <span class="br0">&#40;</span><span class="nu0">30</span> - Apercu.<span class="me1">Top</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Do</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; tempo = <span class="kw1">Min</span><span class="br0">&#40;</span><span class="nu0">-30</span> + <span class="nu0">60</span> * <span class="br0">&#40;</span><span class="kw1">Timer</span> - debut<span class="br0">&#41;</span>, <span class="nu0">0</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; BUG.<span class="me1">Top</span> = tempo<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">Top</span> = tempo + <span class="nu0">30</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Loop</span> <span class="kw1">While</span> tempo &lt;&gt; <span class="nu0">0</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;ExitCode&quot;</span>, <span class="nu0">1</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Form_Unload<span class="br0">&#40;</span>Cancel <span class="kw1">As</span> <span class="kw1">Integer</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="co1">'Quand on quitte, on verifie les updates et puis on sauvegarde qui'l n'y a pas eu de bugs (miracle lol)..</span><br />

&nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;NbUse&quot;</span>, <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;NbUse&quot;</span>, <span class="st0">&quot;0&quot;</span><span class="br0">&#41;</span> + <span class="nu0">1</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">If</span> App.<span class="me1">LogMode</span> &lt;&gt; <span class="nu0">0</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> NotUse = <span class="kw1">False</span> <span class="kw1">Then</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Dim</span> <span class="kw1">base</span> <span class="kw1">As</span> <span class="kw1">String</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">15</span><span class="br0">&#41;</span>.<span class="me1">Visible</span> = <span class="kw1">False</span>: etiquette<span class="br0">&#40;</span><span class="nu0">2</span><span class="br0">&#41;</span>.<span class="me1">Visible</span> = <span class="kw1">True</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Y a t il une nouvelle version ?</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Download <span class="st0">&quot;http://neamar.free.fr/cible2.php?action=ZenUser&amp;version=&quot;</span> &amp; App.<span class="me1">Revision</span> &amp; <span class="st0">&quot;&amp;utilisateur=&quot;</span> &amp; <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Nom&quot;</span>, <span class="st0">&quot;Anonyme&quot;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">Text</span> = <span class="kw1">vbNullString</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">LoadFile</span> Stockage<br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Len</span><span class="br0">&#40;</span>Apercu.<span class="me1">Text</span><span class="br0">&#41;</span> &gt; <span class="nu0">150</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Une nouvelle version est disponible !</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">base</span> = LoadString<span class="br0">&#40;</span><span class="nu0">98</span><span class="br0">&#41;</span> &amp; <span class="kw1">vbCrLf</span> &amp; Replace<span class="br0">&#40;</span>Replace<span class="br0">&#40;</span>Apercu.<span class="me1">Text</span>, <span class="st0">&quot;&lt;br&gt;&quot;</span>, <span class="kw1">vbCrLf</span><span class="br0">&#41;</span>, <span class="st0">&quot;&lt;br /&gt;&quot;</span>, <span class="kw1">vbCrLf</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">vbYes</span> = <span class="kw1">MsgBox</span><span class="br0">&#40;</span><span class="kw1">base</span>, <span class="kw1">vbYesNo</span> + <span class="kw1">vbApplicationModal</span>, LoadString<span class="br0">&#40;</span><span class="nu0">99</span><span class="br0">&#41;</span><span class="br0">&#41;</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Et il veut la telecharger ! Le bonheur ;-)</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ShellExecute <span class="kw1">Me</span>.<span class="me1">hwnd</span>, <span class="st0">&quot;open&quot;</span>, LoadString<span class="br0">&#40;</span><span class="nu0">38</span><span class="br0">&#41;</span> &amp; <span class="st0">&quot;?version=&quot;</span> &amp; App.<span class="me1">Revision</span>, <span class="kw1">vbNullString</span>, App.<span class="me1">Path</span>, <span class="nu0">1</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Kill</span> Stockage<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; <span class="co1">'Proposer un sondage...</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;NbUse&quot;</span>, <span class="st0">&quot;0&quot;</span><span class="br0">&#41;</span> = <span class="st0">&quot;3&quot;</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">vbYes</span> = <span class="kw1">MsgBox</span><span class="br0">&#40;</span>LoadString<span class="br0">&#40;</span><span class="nu0">100</span><span class="br0">&#41;</span> &amp; <span class="kw1">vbCrLf</span> &amp; LoadString<span class="br0">&#40;</span><span class="nu0">101</span><span class="br0">&#41;</span>, <span class="kw1">vbYesNo</span>, <span class="st0">&quot;Help TXT2JPG !&quot;</span><span class="br0">&#41;</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ShellExecute <span class="kw1">Me</span>.<span class="me1">hwnd</span>, <span class="st0">&quot;open&quot;</span>, <span class="st0">&quot;http://neamar.free.fr/&quot;</span> &amp; LoadString<span class="br0">&#40;</span><span class="nu0">73</span><span class="br0">&#41;</span> &amp; <span class="st0">&quot;/sondage.php&quot;</span>, <span class="kw1">vbNullString</span>, App.<span class="me1">Path</span>, <span class="nu0">1</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; <span class="co1">'Arrêter le subclassing !</span><br />

&nbsp; &nbsp; <span class="co1">'Il n'y a pas eu de bug !</span><br />
&nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;ExitCode&quot;</span>, <span class="nu0">0</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Pagination_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; <span class="kw1">If</span> Pagination.<span class="me1">Value</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; UseTopAndBottomMargin.<span class="me1">Value</span> = <span class="kw1">True</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; UseTopAndBottomMargin.<span class="me1">Enabled</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; SetMarge_MouseMove <span class="nu0">3</span>, vbLeftButton, <span class="nu0">0</span>, <span class="nu0">14</span> * <span class="nu0">1.5</span>, <span class="nu0">0</span><br />

&nbsp; &nbsp; <span class="kw1">Else</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; BallonTip.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; UseTopAndBottomMargin.<span class="me1">Enabled</span> = <span class="kw1">True</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">29</span><span class="br0">&#41;</span>.<span class="me1">BackStyle</span> = <span class="nu0">0</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> PlugChoice_Click<span class="br0">&#40;</span>Index <span class="kw1">As</span> <span class="kw1">Integer</span><span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">Dim</span> pos_depart <span class="kw1">As</span> <span class="kw1">Long</span>, longueur <span class="kw1">As</span> <span class="kw1">Long</span>, Current_time <span class="kw1">As</span> <span class="kw1">Long</span>, Pre_compile <span class="kw1">As</span> <span class="kw1">Single</span>, pos_depart2 <span class="kw1">As</span> <span class="kw1">Long</span>, My_DC <span class="kw1">As</span> <span class="kw1">Long</span>, Plug_DC <span class="kw1">As</span> <span class="kw1">Long</span>, OLD_Plug_DC <span class="kw1">As</span> <span class="kw1">Long</span>, Plug_Left <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> IsSlidingWorking <span class="kw1">Then</span> <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />

&nbsp; &nbsp; BallonTip.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; IsSlidingWorking = <span class="kw1">True</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">Dim</span> duree <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
&nbsp; &nbsp; duree = <span class="nu0">1000</span> * <span class="kw1">Abs</span><span class="br0">&#40;</span>Make_Slide.<span class="me1">Value</span><span class="br0">&#41;</span> <span class="co1">'durée du slide en ms (0 si désactivé)</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">With</span> Plug<span class="br0">&#40;</span>Index<span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">Visible</span> = <span class="kw1">True</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">Top</span> = -.<span class="me1">Height</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; pos_depart = .<span class="me1">Top</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; longueur = <span class="kw1">Abs</span><span class="br0">&#40;</span>pos_depart<span class="br0">&#41;</span> + <span class="kw1">Me</span>.<span class="me1">ScaleHeight</span> \ <span class="nu0">2</span> - .<span class="me1">Height</span> \ <span class="nu0">2</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; .<span class="kw1">Left</span> = MainContainer.<span class="kw1">Left</span> + MainContainer.<span class="kw1">Width</span> + <span class="nu0">7</span> <span class="co1">'745</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; BitBlt .<span class="me1">hdc</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">176</span>, <span class="nu0">289</span>, myHDC, .<span class="kw1">Left</span>, .<span class="me1">Top</span>, vbSrcCopy<br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">With</span><br />
<br />
&nbsp; &nbsp; <span class="co1">'Précompiler les valeurs utiles au sliding</span><br />
&nbsp; &nbsp; Pre_compile = longueur / duree<br />
&nbsp; &nbsp; pos_depart2 = SelectedPlug.<span class="me1">Top</span><br />

&nbsp; &nbsp; debut = GetTickCount<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; My_DC = myHDC<br />
&nbsp; &nbsp; Plug_DC = Plug<span class="br0">&#40;</span>Index<span class="br0">&#41;</span>.<span class="me1">hdc</span><br />
&nbsp; &nbsp; Plug_Left = Plug<span class="br0">&#40;</span>Index<span class="br0">&#41;</span>.<span class="kw1">Left</span><br />

&nbsp; &nbsp; OLD_Plug_DC = SelectedPlug.<span class="me1">hdc</span><br />
<br />
&nbsp; &nbsp; <span class="co1">'Et le petit sliding !</span><br />
&nbsp; &nbsp; <span class="kw1">Do</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Current_time = GetTickCount<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Plug<span class="br0">&#40;</span>Index<span class="br0">&#41;</span>.<span class="me1">Top</span> = pos_depart + <span class="br0">&#40;</span>Current_time - debut<span class="br0">&#41;</span> * Pre_compile<br />
&nbsp; &nbsp; &nbsp; &nbsp; BitBlt Plug_DC, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">176</span>, <span class="nu0">289</span>, My_DC, Plug_Left, Plug<span class="br0">&#40;</span>Index<span class="br0">&#41;</span>.<span class="me1">Top</span>, vbSrcCopy<br />

&nbsp; &nbsp; &nbsp; &nbsp; Plug<span class="br0">&#40;</span>Index<span class="br0">&#41;</span>.<span class="me1">Refresh</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; SelectedPlug.<span class="me1">Top</span> = pos_depart2 + <span class="br0">&#40;</span>Current_time - debut<span class="br0">&#41;</span> * Pre_compile<br />

&nbsp; &nbsp; &nbsp; &nbsp; BitBlt OLD_Plug_DC, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">176</span>, <span class="nu0">289</span>, My_DC, Plug_Left, SelectedPlug.<span class="me1">Top</span>, vbSrcCopy<br />
&nbsp; &nbsp; &nbsp; &nbsp; SelectedPlug.<span class="me1">Refresh</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
&nbsp; &nbsp; <span class="kw1">Loop</span> <span class="kw1">While</span> Current_time - debut &lt; duree<br />

<br />
&nbsp; &nbsp; SelectedPlug.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
<br />
&nbsp; &nbsp; <span class="co1">'Au cas ou on a cliqué comme un bourrin un peu partout, pour éviter des bugs anormaux :</span><br />
&nbsp; &nbsp; <span class="kw1">For</span> tempo = <span class="nu0">0</span> <span class="kw1">To</span> PlugChoice.<span class="kw1">Count</span> - <span class="nu0">1</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> PlugChoice<span class="br0">&#40;</span>tempo<span class="br0">&#41;</span>.<span class="me1">Value</span> = <span class="kw1">True</span> <span class="kw1">Then</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">With</span> Plug<span class="br0">&#40;</span>tempo<span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">Visible</span> = <span class="nu0">1</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">Top</span> = <span class="br0">&#40;</span><span class="kw1">Me</span>.<span class="me1">ScaleHeight</span> - .<span class="me1">Height</span><span class="br0">&#41;</span> \ <span class="nu0">2</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; BitBlt .<span class="me1">hdc</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">176</span>, <span class="nu0">289</span>, myHDC, <span class="nu0">0</span>, .<span class="me1">Top</span>, vbSrcCopy<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="kw1">Left</span> = MainContainer.<span class="kw1">Left</span> + MainContainer.<span class="kw1">Width</span> + <span class="nu0">7</span> <span class="co1">'745</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">With</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Set</span> SelectedPlug = Plug<span class="br0">&#40;</span>tempo<span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Else</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Plug<span class="br0">&#40;</span>tempo<span class="br0">&#41;</span>.<span class="me1">Visible</span> = <span class="kw1">False</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> PlugChoice<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">Value</span> <span class="kw1">Or</span> PlugChoice<span class="br0">&#40;</span><span class="nu0">5</span><span class="br0">&#41;</span>.<span class="me1">Value</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> PlugChoice<span class="br0">&#40;</span><span class="nu0">2</span><span class="br0">&#41;</span>.<span class="me1">Top</span> = <span class="nu0">56</span> <span class="kw1">Then</span><br />
<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">For</span> tempo = <span class="nu0">56</span> <span class="kw1">To</span> <span class="nu0">84</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; PlugChoice<span class="br0">&#40;</span><span class="nu0">2</span><span class="br0">&#41;</span>.<span class="me1">Top</span> = tempo<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; PlugChoice<span class="br0">&#40;</span><span class="nu0">4</span><span class="br0">&#41;</span>.<span class="me1">Top</span> = tempo + <span class="nu0">28</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; PlugChoice<span class="br0">&#40;</span><span class="nu0">3</span><span class="br0">&#41;</span>.<span class="me1">Top</span> = tempo + <span class="nu0">56</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; PlugChoice<span class="br0">&#40;</span><span class="nu0">5</span><span class="br0">&#41;</span>.<span class="me1">Visible</span> = <span class="kw1">True</span><br />
&nbsp; &nbsp; <span class="kw1">Else</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; PlugChoice<span class="br0">&#40;</span><span class="nu0">5</span><span class="br0">&#41;</span>.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> PlugChoice<span class="br0">&#40;</span><span class="nu0">2</span><span class="br0">&#41;</span>.<span class="me1">Top</span> = <span class="nu0">84</span> <span class="kw1">Then</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">For</span> tempo = <span class="nu0">84</span> <span class="kw1">To</span> <span class="nu0">56</span> Step <span class="nu0">-1</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; PlugChoice<span class="br0">&#40;</span><span class="nu0">2</span><span class="br0">&#41;</span>.<span class="me1">Top</span> = tempo<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; PlugChoice<span class="br0">&#40;</span><span class="nu0">4</span><span class="br0">&#41;</span>.<span class="me1">Top</span> = tempo + <span class="nu0">28</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; PlugChoice<span class="br0">&#40;</span><span class="nu0">3</span><span class="br0">&#41;</span>.<span class="me1">Top</span> = tempo + <span class="nu0">56</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Next</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; Form_Redraw<br />

<br />
&nbsp; &nbsp; <span class="kw1">If</span> Index = <span class="nu0">5</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; NoSelEvents = <span class="kw1">True</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; TailleDegrade_MouseMove <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">0</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; TailleDegrade_MouseMove <span class="nu0">1</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">0</span><br />

&nbsp; &nbsp; <span class="kw1">ElseIf</span> Index = <span class="nu0">2</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; SetMarge_MouseMove <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">0</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; SetMarge_MouseMove <span class="nu0">1</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">0</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; SetMarge_MouseMove <span class="nu0">2</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">0</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; SetMarge_MouseMove <span class="nu0">3</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">0</span><br />
&nbsp; &nbsp; <span class="kw1">ElseIf</span> Index = <span class="nu0">0</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Qualite_MouseMove <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">0</span><br />
&nbsp; &nbsp; <span class="kw1">Else</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; NoSelEvents = <span class="kw1">False</span><br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> Index = <span class="nu0">0</span> <span class="kw1">And</span> Modeles.<span class="me1">Visible</span> = <span class="kw1">False</span> <span class="kw1">Then</span> Glass <span class="nu0">10</span>, <span class="nu0">121</span>, <span class="nu0">158</span>, <span class="nu0">152</span>, Plug<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">hdc</span>: Plug<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Refresh</span><br />

&nbsp; &nbsp; <span class="kw1">If</span> Index = <span class="nu0">0</span> <span class="kw1">And</span> Modeles.<span class="me1">Visible</span> = <span class="kw1">True</span> <span class="kw1">Then</span> Glass <span class="nu0">10</span>, <span class="nu0">121</span>, <span class="nu0">158</span>, <span class="nu0">222</span>, Plug<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">hdc</span>: Plug<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Refresh</span><br />

&nbsp; &nbsp; <span class="kw1">If</span> Index = <span class="nu0">1</span> <span class="kw1">And</span> Use_Back_Picture.<span class="me1">Value</span> = <span class="kw1">True</span> <span class="kw1">Then</span> Glass <span class="nu0">9</span>, <span class="nu0">180</span>, <span class="nu0">170</span>, <span class="nu0">269</span>, Plug<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">hdc</span>: Plug<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">Refresh</span><br />

&nbsp; &nbsp; <span class="kw1">If</span> Index = <span class="nu0">4</span> <span class="kw1">Then</span> Glass <span class="nu0">0</span>, <span class="nu0">121</span>, <span class="nu0">169</span>, <span class="nu0">200</span>, Plug<span class="br0">&#40;</span><span class="nu0">4</span><span class="br0">&#41;</span>.<span class="me1">hdc</span>: Plug<span class="br0">&#40;</span><span class="nu0">4</span><span class="br0">&#41;</span>.<span class="me1">Refresh</span><br />

&nbsp; &nbsp; <span class="kw1">If</span> Index = <span class="nu0">5</span> <span class="kw1">Then</span> Glass <span class="nu0">0</span>, <span class="nu0">170</span>, <span class="nu0">169</span>, <span class="nu0">285</span>, Plug<span class="br0">&#40;</span><span class="nu0">5</span><span class="br0">&#41;</span>.<span class="me1">hdc</span>: Glass <span class="nu0">79</span>, <span class="nu0">128</span>, <span class="nu0">81</span>, <span class="nu0">160</span>, Plug<span class="br0">&#40;</span><span class="nu0">5</span><span class="br0">&#41;</span>.<span class="me1">hdc</span>: Plug<span class="br0">&#40;</span><span class="nu0">5</span><span class="br0">&#41;</span>.<span class="me1">Refresh</span><br />

&nbsp; &nbsp; IsSlidingWorking = <span class="kw1">False</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Polices_DropDown<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; <span class="kw1">If</span> Polices.<span class="me1">ListCount</span> = <span class="nu0">0</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Les polices mettent un certain temps à se charger, alors on prévient :</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Polices.<span class="me1">Text</span> = LoadString<span class="br0">&#40;</span><span class="nu0">102</span><span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Dim</span> nbpolice <span class="kw1">As</span> <span class="kw1">Long</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">MousePointer</span> = vbCustom<br />

&nbsp; &nbsp; &nbsp; &nbsp; Polices.<span class="me1">MousePointer</span> = vbCustom<br />
&nbsp; &nbsp; &nbsp; &nbsp; nbpolice = Screen.<span class="me1">FontCount</span> - <span class="nu0">1</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">For</span> tempo = <span class="nu0">0</span> <span class="kw1">To</span> nbpolice<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Polices.<span class="me1">AddItem</span> Screen.<span class="me1">Fonts</span><span class="br0">&#40;</span>tempo<span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">MousePointer</span> = vbDefault<br />

&nbsp; &nbsp; &nbsp; &nbsp; Polices.<span class="me1">MousePointer</span> = <span class="nu0">0</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">Visible</span> = <span class="kw1">True</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Polices.<span class="me1">Text</span> = <span class="st0">&quot;MS Sans Serif&quot;</span><br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Root_LostTheFocus<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="co1">'Masquer l'infobulle</span><br />
&nbsp; &nbsp; BallonTip.<span class="me1">Visible</span> = <span class="kw1">False</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> MAJ_Timer<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; MAJ.<span class="me1">Enabled</span> = <span class="kw1">False</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> MAJ.<span class="me1">Tag</span> &lt;&gt; <span class="kw1">vbNullString</span> <span class="kw1">Then</span> Filig.<span class="me1">Text</span> = MAJ.<span class="me1">Tag</span>: MAJ.<span class="me1">Tag</span> = <span class="kw1">vbNullString</span><br />

&nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">Refresh</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> Qualite.<span class="me1">Visible</span> <span class="kw1">Then</span> Qualite_MouseDown <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">0</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Marque_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; <span class="co1">'Selectionne les modèles convenant à la marque</span><br />
&nbsp; &nbsp; <span class="kw1">Dim</span> Marque_Top <span class="kw1">As</span> <span class="kw1">Long</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">Dim</span> Last <span class="kw1">As</span> <span class="kw1">Long</span>, donnees <span class="kw1">As</span> <span class="kw1">String</span><br />

<br />
&nbsp; &nbsp; Modeles.<span class="me1">Clear</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> En_JPG.<span class="me1">Top</span> = <span class="nu0">161</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Marque_Top = Marque.<span class="me1">Top</span> - <span class="nu0">6</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; debut = <span class="kw1">Timer</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Do</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; tempo = <span class="kw1">Min</span><span class="br0">&#40;</span><span class="nu0">161</span> + <span class="nu0">100</span> * <span class="br0">&#40;</span><span class="kw1">Timer</span> - debut<span class="br0">&#41;</span>, <span class="nu0">231</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; En_JPG.<span class="me1">Top</span> = tempo<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">10</span><span class="br0">&#41;</span>.<span class="me1">Top</span> = tempo<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Qualite.<span class="me1">Top</span> = tempo + <span class="nu0">28</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">11</span><span class="br0">&#41;</span>.<span class="me1">Top</span> = tempo + <span class="nu0">14</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> tempo - <span class="nu0">20</span> &gt; Modeles.<span class="me1">Top</span> <span class="kw1">Then</span> Modeles.<span class="me1">Visible</span> = <span class="kw1">True</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> tempo - <span class="nu0">15</span> &gt; etiquette<span class="br0">&#40;</span><span class="nu0">8</span><span class="br0">&#41;</span>.<span class="me1">Top</span> <span class="kw1">Then</span> etiquette<span class="br0">&#40;</span><span class="nu0">8</span><span class="br0">&#41;</span>.<span class="me1">Visible</span> = <span class="kw1">True</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> tempo - <span class="nu0">15</span> &gt; etiquette<span class="br0">&#40;</span><span class="nu0">9</span><span class="br0">&#41;</span>.<span class="me1">Top</span> <span class="kw1">Then</span> etiquette<span class="br0">&#40;</span><span class="nu0">9</span><span class="br0">&#41;</span>.<span class="me1">Visible</span> = <span class="kw1">True</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> tempo - <span class="nu0">20</span> &gt; Hauteur.<span class="me1">Top</span> <span class="kw1">Then</span> Hauteur.<span class="me1">Visible</span> = <span class="kw1">True</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> tempo - <span class="nu0">20</span> &gt; Largeur.<span class="me1">Top</span> <span class="kw1">Then</span> Largeur.<span class="me1">Visible</span> = <span class="kw1">True</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> tempo - <span class="nu0">15</span> &gt; Swap.<span class="me1">Top</span> <span class="kw1">Then</span> Swap.<span class="me1">Visible</span> = <span class="kw1">True</span>: Defaut.<span class="me1">Visible</span> = <span class="kw1">True</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Qualite_MouseMove <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">0</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; BitBlt Plug<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">hdc</span>, <span class="nu0">10</span>, Marque_Top, <span class="nu0">159</span>, <span class="nu0">289</span> - Marque_Top, myHDC, Plug<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="kw1">Left</span> + <span class="nu0">10</span>, Plug<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Top</span> + Marque_Top, vbSrcCopy<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Glass <span class="nu0">10</span>, <span class="nu0">121</span>, <span class="nu0">158</span>, tempo - <span class="nu0">9</span>, Plug<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">hdc</span>: Plug<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Refresh</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Loop</span> Until tempo = <span class="nu0">231</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; Qualite_MouseDown <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">0</span><br />

&nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">MousePointer</span> = vbCustom<br />
<br />
&nbsp; &nbsp; Download <span class="st0">&quot;http://neamar.free.fr/Addins/baladeurs.php?requete=ModeleENUM&amp;Marque=&quot;</span> &amp; Marque.<span class="me1">Text</span><br />

&nbsp; &nbsp; <span class="kw1">Open</span> Stockage <span class="kw1">For</span> <span class="kw1">Input</span> <span class="kw1">As</span> #<span class="nu0">1</span><br />
&nbsp; &nbsp; <span class="kw1">Line</span> <span class="kw1">Input</span> #<span class="nu0">1</span>, donnees<br />

&nbsp; &nbsp; <span class="kw1">Close</span> #<span class="nu0">1</span><br />
<br />
&nbsp; &nbsp; donnees = donnees &amp; LoadString<span class="br0">&#40;</span><span class="nu0">104</span><span class="br0">&#41;</span> &amp; <span class="st0">&quot;|&quot;</span><br />

&nbsp; &nbsp; <span class="co1">'Liste des marques</span><br />
&nbsp; &nbsp; tempo = <span class="nu0">1</span><br />
&nbsp; &nbsp; Last = <span class="nu0">1</span><br />
&nbsp; &nbsp; poubelle = <span class="kw1">Len</span><span class="br0">&#40;</span>donnees<span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">For</span> tempo = <span class="nu0">1</span> <span class="kw1">To</span> poubelle<br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Mid</span>$<span class="br0">&#40;</span>donnees, tempo, <span class="nu0">1</span><span class="br0">&#41;</span> = <span class="st0">&quot;|&quot;</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Modeles.<span class="me1">AddItem</span> <span class="kw1">Mid</span>$<span class="br0">&#40;</span>donnees, Last, tempo - Last<span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Last = tempo + <span class="nu0">1</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; tempo = tempo + <span class="nu0">1</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">MousePointer</span> = <span class="nu0">0</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> MEf_Click<span class="br0">&#40;</span>Index <span class="kw1">As</span> <span class="kw1">Integer</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">If</span> Index = <span class="nu0">0</span> <span class="kw1">Then</span> Apercu.<span class="me1">SelBold</span> = <span class="kw1">Not</span> <span class="br0">&#40;</span>Apercu.<span class="me1">SelBold</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">If</span> Index = <span class="nu0">1</span> <span class="kw1">Then</span> Apercu.<span class="me1">SelItalic</span> = <span class="kw1">Not</span> <span class="br0">&#40;</span>Apercu.<span class="me1">SelItalic</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">If</span> Index = <span class="nu0">2</span> <span class="kw1">Then</span> Apercu.<span class="me1">SelUnderline</span> = <span class="kw1">Not</span> <span class="br0">&#40;</span>Apercu.<span class="me1">SelUnderline</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">If</span> Index = <span class="nu0">3</span> <span class="kw1">Then</span> Apercu.<span class="me1">SelStrikeThru</span> = <span class="kw1">Not</span> <span class="br0">&#40;</span>Apercu.<span class="me1">SelStrikeThru</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">If</span> Index = <span class="nu0">4</span> <span class="kw1">Then</span> Apercu.<span class="me1">SelBullet</span> = <span class="kw1">Not</span> <span class="br0">&#40;</span>Apercu.<span class="me1">SelBullet</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; Apercu.<span class="me1">SetFocus</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Modeles_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">GoTo</span> Err_handler_Modeles<br />

<br />
&nbsp; &nbsp; <span class="kw1">Dim</span> New_Marque <span class="kw1">As</span> <span class="kw1">String</span>, New_Modele <span class="kw1">As</span> <span class="kw1">String</span>, texte <span class="kw1">As</span> <span class="kw1">String</span><br />

<br />
&nbsp; &nbsp; texte = <span class="kw1">vbNullString</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> Modeles.<span class="me1">Text</span> &lt;&gt; LoadString<span class="br0">&#40;</span><span class="nu0">104</span><span class="br0">&#41;</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Dir</span>$<span class="br0">&#40;</span>Stockage<span class="br0">&#41;</span> &lt;&gt; <span class="kw1">vbNullString</span> <span class="kw1">Then</span> <span class="kw1">Kill</span> Stockage<br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; Download <span class="st0">&quot;http://neamar.free.fr/Addins/baladeurs.php?requete=Screen_Size&amp;Modele=&quot;</span> &amp; Modeles.<span class="me1">Text</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Open</span> Stockage <span class="kw1">For</span> <span class="kw1">Input</span> <span class="kw1">As</span> #<span class="nu0">1</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Input</span> #<span class="nu0">1</span>, texte<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Close</span> #<span class="nu0">1</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Hauteur.<span class="me1">Text</span> = <span class="kw1">Val</span><span class="br0">&#40;</span><span class="kw1">Left</span>$<span class="br0">&#40;</span>texte, <span class="nu0">3</span><span class="br0">&#41;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Largeur.<span class="me1">Text</span> = <span class="kw1">Val</span><span class="br0">&#40;</span><span class="kw1">Mid</span>$<span class="br0">&#40;</span>texte, <span class="nu0">4</span>, <span class="nu0">3</span><span class="br0">&#41;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Defaut.<span class="me1">Visible</span> = <span class="kw1">True</span><br />
&nbsp; &nbsp; <span class="kw1">Else</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Hauteur.<span class="me1">Text</span> = <span class="kw1">InputBox</span><span class="br0">&#40;</span>LoadString<span class="br0">&#40;</span><span class="nu0">105</span><span class="br0">&#41;</span>, LoadString<span class="br0">&#40;</span><span class="nu0">106</span><span class="br0">&#41;</span>, <span class="st0">&quot;240&quot;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Largeur.<span class="me1">Text</span> = <span class="kw1">InputBox</span><span class="br0">&#40;</span>LoadString<span class="br0">&#40;</span><span class="nu0">107</span><span class="br0">&#41;</span>, LoadString<span class="br0">&#40;</span><span class="nu0">108</span><span class="br0">&#41;</span>, <span class="st0">&quot;320&quot;</span><span class="br0">&#41;</span><br />
<br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Hauteur.<span class="me1">Text</span> = <span class="kw1">vbNullString</span> <span class="kw1">Or</span> Largeur.<span class="me1">Text</span> = <span class="kw1">vbNullString</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; AfficherTip LoadMSG<span class="br0">&#40;</span><span class="nu0">59</span><span class="br0">&#41;</span>, LoadMSG<span class="br0">&#40;</span><span class="nu0">60</span><span class="br0">&#41;</span>, Largeur, <span class="kw1">vbExclamation</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Marque.<span class="me1">Text</span> = LoadString<span class="br0">&#40;</span><span class="nu0">109</span><span class="br0">&#41;</span> <span class="kw1">Then</span> New_Marque = <span class="kw1">InputBox</span><span class="br0">&#40;</span>LoadString<span class="br0">&#40;</span><span class="nu0">110</span><span class="br0">&#41;</span>, LoadString<span class="br0">&#40;</span><span class="nu0">77</span><span class="br0">&#41;</span>, <span class="st0">&quot;NoName&quot;</span><span class="br0">&#41;</span> <span class="kw1">Else</span> New_Marque = Marque.<span class="me1">Text</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; New_Modele = <span class="kw1">InputBox</span><span class="br0">&#40;</span>LoadString<span class="br0">&#40;</span><span class="nu0">111</span><span class="br0">&#41;</span>, LoadString<span class="br0">&#40;</span><span class="nu0">76</span><span class="br0">&#41;</span>, LoadString<span class="br0">&#40;</span><span class="nu0">76</span><span class="br0">&#41;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Modeles.<span class="me1">Text</span> = New_Modele<br />

&nbsp; &nbsp; &nbsp; &nbsp; Marque.<span class="me1">Text</span> = New_Marque<br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; Download <span class="st0">&quot;http://neamar.free.fr/mailer.php?action=Submitting&amp;marque=&quot;</span> &amp; New_Marque &amp; <span class="st0">&quot;&amp;nom=&quot;</span> &amp; New_Modele &amp; <span class="st0">&quot;&amp;hauteur=&quot;</span> &amp; Hauteur.<span class="me1">Text</span> &amp; <span class="st0">&quot;&amp;largeur=&quot;</span> &amp; Largeur.<span class="me1">Text</span> &amp; <span class="st0">&quot;&amp;auteur=&quot;</span> &amp; <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Nom&quot;</span>, <span class="st0">&quot;Anonyme&quot;</span><span class="br0">&#41;</span> &amp; <span class="st0">&quot;&amp;comment=Rien&quot;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; AfficherTip LoadMSG<span class="br0">&#40;</span><span class="nu0">61</span><span class="br0">&#41;</span>, LoadMSG<span class="br0">&#40;</span><span class="nu0">62</span><span class="br0">&#41;</span>, Marque, <span class="kw1">False</span><br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">DoEvents</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> Filig.<span class="me1">Text</span> &lt;&gt; <span class="kw1">vbNullString</span> <span class="kw1">Then</span> Filig_Change<br />

<br />
&nbsp; &nbsp; <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />
<br />
Err_handler_Modeles:<br />
&nbsp; &nbsp; AfficherTip LoadMSG<span class="br0">&#40;</span><span class="nu0">63</span><span class="br0">&#41;</span>, LoadMSG<span class="br0">&#40;</span><span class="nu0">64</span><span class="br0">&#41;</span>, Marque, <span class="kw1">False</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Modules_Click<span class="br0">&#40;</span>Index <span class="kw1">As</span> <span class="kw1">Integer</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">MousePointer</span> = vbCustom<br />
<br />
&nbsp; &nbsp; Select <span class="kw1">Case</span> Index<br />
<br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Case</span> <span class="nu0">0</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Propose le module ConvertPowerPoint au telechargement, ainsi que ses dépendances</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Dir</span>$<span class="br0">&#40;</span>App.<span class="me1">Path</span> &amp; <span class="st0">&quot;\ConvertPowerPoint.exe&quot;</span><span class="br0">&#41;</span> = <span class="kw1">vbNullString</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">vbNo</span> = <span class="kw1">MsgBox</span><span class="br0">&#40;</span>LoadString<span class="br0">&#40;</span><span class="nu0">112</span><span class="br0">&#41;</span>, <span class="kw1">vbYesNo</span> + <span class="kw1">vbCritical</span>, <span class="st0">&quot;TXT2JPG&quot;</span><span class="br0">&#41;</span> <span class="kw1">Then</span> <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Download <span class="st0">&quot;http://neamar.free.fr/txt2jpg/Modules/ConvertPowerPoint.exe&quot;</span>, App.<span class="me1">Path</span> &amp; <span class="st0">&quot;\ConvertPowerPoint.exe&quot;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Dir</span>$<span class="br0">&#40;</span>GiveMePathOf<span class="br0">&#40;</span>&amp;H25<span class="br0">&#41;</span> &amp; <span class="st0">&quot;\BMP2JPG.dll&quot;</span><span class="br0">&#41;</span> = <span class="kw1">vbNullString</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">vbNo</span> = <span class="kw1">MsgBox</span><span class="br0">&#40;</span>LoadString<span class="br0">&#40;</span><span class="nu0">113</span><span class="br0">&#41;</span>, <span class="kw1">vbYesNo</span> + <span class="kw1">vbCritical</span>, LoadString<span class="br0">&#40;</span><span class="nu0">83</span><span class="br0">&#41;</span><span class="br0">&#41;</span> <span class="kw1">Then</span> <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Download <span class="st0">&quot;http://neamar.free.fr/Addins/BMP2JPG.dll&quot;</span>, GiveMePathOf<span class="br0">&#40;</span>&amp;H25<span class="br0">&#41;</span> &amp; <span class="st0">&quot;\BMP2JPG.dll&quot;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;MalLance&quot;</span>, <span class="kw1">False</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ShellExecute <span class="kw1">Me</span>.<span class="me1">hwnd</span>, <span class="st0">&quot;open&quot;</span>, App.<span class="me1">Path</span> &amp; <span class="st0">&quot;\ConvertPowerPoint.exe&quot;</span>, <span class="kw1">vbNullString</span>, App.<span class="me1">Path</span>, <span class="nu0">1</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; NotUse = <span class="kw1">True</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Download <span class="st0">&quot;http://neamar.free.fr/cible2.php?action=ConverterPP&amp;utilisateur=&quot;</span> &amp; <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Nom&quot;</span>, <span class="st0">&quot;Anonyme&quot;</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Case</span> <span class="nu0">1</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Propose de telecharger le module degrade</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Dir</span>$<span class="br0">&#40;</span>App.<span class="me1">Path</span> &amp; <span class="st0">&quot;\Degrade.exe&quot;</span><span class="br0">&#41;</span> = <span class="kw1">vbNullString</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">vbNo</span> = <span class="kw1">MsgBox</span><span class="br0">&#40;</span>LoadString<span class="br0">&#40;</span><span class="nu0">114</span><span class="br0">&#41;</span>, <span class="kw1">vbYesNo</span> + <span class="kw1">vbCritical</span>, <span class="st0">&quot;TXT2JPG&quot;</span><span class="br0">&#41;</span> <span class="kw1">Then</span> <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Download <span class="st0">&quot;http://neamar.free.fr/txt2jpg/Modules/Degrade.exe&quot;</span>, App.<span class="me1">Path</span> &amp; <span class="st0">&quot;\Degrade.exe&quot;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> Modeles.<span class="me1">Text</span> = LoadString<span class="br0">&#40;</span><span class="nu0">74</span><span class="br0">&#41;</span> <span class="kw1">Or</span> Modeles.<span class="me1">Text</span> = <span class="kw1">vbNullString</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">MsgBox</span> LoadString<span class="br0">&#40;</span><span class="nu0">115</span><span class="br0">&#41;</span>, <span class="kw1">vbOKOnly</span> + <span class="kw1">vbInformation</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Degrade&quot;</span>, <span class="st0">&quot;Baladeur&quot;</span>, Modeles.<span class="me1">Text</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Degrade&quot;</span>, LoadString<span class="br0">&#40;</span><span class="nu0">108</span><span class="br0">&#41;</span>, Largeur.<span class="me1">Text</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Degrade&quot;</span>, LoadString<span class="br0">&#40;</span><span class="nu0">106</span><span class="br0">&#41;</span>, Hauteur.<span class="me1">Text</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ShellExecute <span class="kw1">Me</span>.<span class="me1">hwnd</span>, <span class="st0">&quot;open&quot;</span>, App.<span class="me1">Path</span> &amp; <span class="st0">&quot;\Degrade.exe&quot;</span>, <span class="kw1">vbNullString</span>, App.<span class="me1">Path</span>, <span class="nu0">1</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Download <span class="st0">&quot;http://neamar.free.fr/cible2.php?action=Degrade&amp;utilisateur=&quot;</span> &amp; <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Nom&quot;</span>, <span class="st0">&quot;Anonyme&quot;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; NotUse = <span class="kw1">True</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Case</span> <span class="nu0">2</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Lancer le module GIF2AVI</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Dir</span>$<span class="br0">&#40;</span>App.<span class="me1">Path</span> &amp; <span class="st0">&quot;\GIF2AVI.exe&quot;</span><span class="br0">&#41;</span> = <span class="kw1">vbNullString</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">vbNo</span> = <span class="kw1">MsgBox</span><span class="br0">&#40;</span>LoadString<span class="br0">&#40;</span><span class="nu0">116</span><span class="br0">&#41;</span>, <span class="kw1">vbYesNo</span> + <span class="kw1">vbCritical</span>, <span class="st0">&quot;TXT2JPG&quot;</span><span class="br0">&#41;</span> <span class="kw1">Then</span> <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Download <span class="st0">&quot;http://neamar.free.fr/txt2jpg/Modules/GIF2AVI.exe&quot;</span>, App.<span class="me1">Path</span> &amp; <span class="st0">&quot;\GIF2AVI.exe&quot;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Dir</span>$<span class="br0">&#40;</span>GiveMePathOf<span class="br0">&#40;</span>&amp;H25<span class="br0">&#41;</span> &amp; <span class="st0">&quot;\GIF89.DLL&quot;</span><span class="br0">&#41;</span> = <span class="kw1">vbNullString</span> <span class="kw1">Then</span> Download <span class="st0">&quot;http://neamar.free.fr/txt2jpg/Modules/GIF89.DLL&quot;</span>, GiveMePathOf<span class="br0">&#40;</span>&amp;H25<span class="br0">&#41;</span> &amp; <span class="st0">&quot;\GIF89.DLL&quot;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Dir</span>$<span class="br0">&#40;</span>App.<span class="me1">Path</span> &amp; <span class="st0">&quot;\Hypercube.gif&quot;</span><span class="br0">&#41;</span> = <span class="kw1">vbNullString</span> <span class="kw1">Then</span> Download <span class="st0">&quot;http://neamar.free.fr/txt2jpg/Modules/Hypercube.gif&quot;</span>, App.<span class="me1">Path</span> &amp; <span class="st0">&quot;\Hypercube.gif&quot;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Dir</span>$<span class="br0">&#40;</span>App.<span class="me1">Path</span> &amp; <span class="st0">&quot;\CreatAVI.exe&quot;</span><span class="br0">&#41;</span> = <span class="kw1">vbNullString</span> <span class="kw1">Then</span> Download <span class="st0">&quot;http://neamar.free.fr/txt2jpg/Modules/CreatAVI.exe&quot;</span>, App.<span class="me1">Path</span> &amp; <span class="st0">&quot;\CreatAVI.exe&quot;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;MalLance&quot;</span>, <span class="kw1">False</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ShellExecute <span class="kw1">Me</span>.<span class="me1">hwnd</span>, <span class="st0">&quot;open&quot;</span>, App.<span class="me1">Path</span> &amp; <span class="st0">&quot;\GIF2AVI.exe&quot;</span>, <span class="kw1">vbNullString</span>, App.<span class="me1">Path</span>, <span class="nu0">1</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; NotUse = <span class="kw1">True</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Download <span class="st0">&quot;http://neamar.free.fr/cible2.php?action=Gif2Avi&amp;utilisateur=&quot;</span> &amp; <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Nom&quot;</span>, <span class="st0">&quot;Anonyme&quot;</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Case</span> <span class="nu0">3</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Ouvre la page d'accueil du projet Gutenberg</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ShellExecute <span class="kw1">Me</span>.<span class="me1">hwnd</span>, <span class="st0">&quot;open&quot;</span>, LoadString<span class="br0">&#40;</span><span class="nu0">117</span><span class="br0">&#41;</span>, <span class="kw1">vbNullString</span>, App.<span class="me1">Path</span>, <span class="nu0">1</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Case</span> <span class="nu0">4</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ShellExecute <span class="kw1">Me</span>.<span class="me1">hwnd</span>, <span class="st0">&quot;open&quot;</span>, <span class="st0">&quot;http://neamar.free.fr/Ephem/ephem.php&quot;</span>, <span class="kw1">vbNullString</span>, App.<span class="me1">Path</span>, <span class="nu0">1</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> Select<br />
<br />
&nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">MousePointer</span> = <span class="nu0">0</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Modules_MouseMove<span class="br0">&#40;</span>Index <span class="kw1">As</span> <span class="kw1">Integer</span>, Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">16</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> = Modules<span class="br0">&#40;</span>Index<span class="br0">&#41;</span>.<span class="me1">ToolTipText</span><br />

&nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">16</span><span class="br0">&#41;</span>.<span class="me1">Tag</span> = Modules<span class="br0">&#40;</span>Index<span class="br0">&#41;</span>.<span class="me1">Tag</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />

<span class="kw1">Private</span> <span class="kw1">Sub</span> OverView_MouseMove<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; OverView.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Polices_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> DoNotChange <span class="kw1">Then</span> <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />

<br />
&nbsp; &nbsp; <span class="co1">'Changer la police</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> Apercu.<span class="me1">SelLength</span> = <span class="nu0">0</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">SelStart</span> = <span class="nu0">0</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">SelLength</span> = <span class="kw1">Len</span><span class="br0">&#40;</span>Apercu.<span class="me1">Text</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; Apercu.<span class="me1">SelFontName</span> = Polices.<span class="me1">Text</span><br />
&nbsp; &nbsp; Apercu.<span class="me1">SetFocus</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Priorite_Change<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; <span class="kw1">If</span> Priorite.<span class="me1">Text</span> = <span class="st0">&quot;REALTIME_PRIORITY_CLASS&quot;</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'Cette priorité peut être déstabilisante...</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">MsgBox</span> LoadString<span class="br0">&#40;</span><span class="nu0">118</span><span class="br0">&#41;</span>, <span class="kw1">vbExclamation</span><br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Priorite&quot;</span>, Priorite.<span class="me1">Text</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Priorite_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; Priorite_Change<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Qualite_MouseDown<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; Qualite_MouseMove Button, Shift, X, Y<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Qualite_MouseMove<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="co1">'Updater la valeur</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> Button = vbLeftButton <span class="kw1">And</span> X &gt;= <span class="nu0">0</span> <span class="kw1">And</span> X &lt;= <span class="nu0">148</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Qualite.<span class="me1">Tag</span> = <span class="kw1">Int</span><span class="br0">&#40;</span><span class="br0">&#40;</span>X / <span class="nu0">148</span><span class="br0">&#41;</span> * <span class="nu0">50</span> + <span class="nu0">50</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">11</span><span class="br0">&#41;</span>.<span class="me1">Caption</span> = Replace<span class="br0">&#40;</span>LoadString<span class="br0">&#40;</span><span class="nu0">119</span><span class="br0">&#41;</span>, <span class="st0">&quot;%u&quot;</span>, Qualite.<span class="me1">Tag</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; <span class="co1">'Arrière plan</span><br />
&nbsp; &nbsp; BitBlt Qualite.<span class="me1">hdc</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">148</span>, <span class="nu0">15</span>, Plug<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">hdc</span>, Qualite.<span class="kw1">Left</span>, Qualite.<span class="me1">Top</span>, vbSrcCopy<br />

&nbsp; &nbsp; TransparentBlt Qualite.<span class="me1">hdc</span>, <span class="nu0">0</span>, <span class="nu0">2</span>, <span class="nu0">148</span>, <span class="nu0">13</span>, QualiteMask.<span class="me1">hdc</span>, <span class="nu0">0</span>, <span class="nu0">0</span>, <span class="nu0">148</span>, <span class="nu0">13</span>, <span class="kw1">RGB</span><span class="br0">&#40;</span><span class="nu0">255</span>, <span class="nu0">255</span>, <span class="nu0">255</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="co1">'Bulle</span><br />
&nbsp; &nbsp; TransparentBlt Qualite.<span class="me1">hdc</span>, <span class="br0">&#40;</span>Qualite.<span class="me1">Tag</span> - <span class="nu0">50</span><span class="br0">&#41;</span> * <span class="nu0">2.96</span> - <span class="nu0">4</span>, <span class="nu0">1</span>, <span class="nu0">11</span>, <span class="nu0">13</span>, QualiteMask.<span class="me1">hdc</span>, <span class="nu0">149</span>, <span class="nu0">0</span>, <span class="nu0">11</span>, <span class="nu0">13</span>, <span class="kw1">RGB</span><span class="br0">&#40;</span><span class="nu0">255</span>, <span class="nu0">255</span>, <span class="nu0">255</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; Qualite.<span class="me1">Refresh</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Reseau_KeyPress<span class="br0">&#40;</span>KeyAscii <span class="kw1">As</span> <span class="kw1">Integer</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; Enregistrer<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Visible</span> = <span class="kw1">True</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Save_Folder_Change<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; Enregistrer<span class="br0">&#40;</span><span class="nu0">1</span><span class="br0">&#41;</span>.<span class="me1">Visible</span> = <span class="kw1">True</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Make_Slide_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Make_Slide&quot;</span>, Make_Slide.<span class="me1">Value</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />

<span class="kw1">Private</span> <span class="kw1">Sub</span> Swap_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="kw1">Dim</span> svg <span class="kw1">As</span> <span class="kw1">Integer</span><br />

<br />
&nbsp; &nbsp; svg = Largeur.<span class="me1">Text</span><br />
&nbsp; &nbsp; Largeur.<span class="me1">Text</span> = Hauteur.<span class="me1">Text</span><br />
&nbsp; &nbsp; Hauteur.<span class="me1">Text</span> = svg<br />

&nbsp; &nbsp; svg = <span class="kw1">vbNull</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Taille_Change<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; <span class="co1">'Change la taille du texte</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> DoNotChange <span class="kw1">Then</span> <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">If</span> Apercu.<span class="me1">SelLength</span> = <span class="nu0">0</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">SelStart</span> = <span class="nu0">0</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Apercu.<span class="me1">SelLength</span> = <span class="kw1">Len</span><span class="br0">&#40;</span>Apercu.<span class="me1">Text</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

<br />
&nbsp; &nbsp; Apercu.<span class="me1">SelFontSize</span> = Taille.<span class="me1">Text</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Taille_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; Taille_Change<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Taille_DropDown<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; <span class="co1">'La première fois, charger</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> Taille.<span class="me1">ListCount</span> = <span class="nu0">0</span> <span class="kw1">Then</span><br />
<br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">For</span> tempo = <span class="nu0">6</span> <span class="kw1">To</span> <span class="nu0">12</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Taille.<span class="me1">AddItem</span> <span class="kw1">FORMAT</span>$<span class="br0">&#40;</span>tempo, <span class="st0">&quot;00&quot;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Taille.<span class="me1">AddItem</span> <span class="nu0">2</span> * tempo + <span class="nu0">1</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Taille.<span class="me1">AddItem</span> <span class="nu0">4</span> * tempo + <span class="nu0">1</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Taille_KeyPress<span class="br0">&#40;</span>KeyAscii <span class="kw1">As</span> <span class="kw1">Integer</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; <span class="kw1">Dim</span> AllowedKeys <span class="kw1">As</span> <span class="kw1">String</span><br />
<br />
&nbsp; &nbsp; AllowedKeys = <span class="st0">&quot;0123456789.&quot;</span> &amp; <span class="kw1">Chr</span>$<span class="br0">&#40;</span><span class="nu0">8</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">InStr</span><span class="br0">&#40;</span>AllowedKeys, <span class="kw1">Chr</span>$<span class="br0">&#40;</span>KeyAscii<span class="br0">&#41;</span><span class="br0">&#41;</span> = <span class="nu0">0</span> <span class="kw1">Then</span> KeyAscii = <span class="nu0">0</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> UseTopAndBottomMargin_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; <span class="co1">'Détermine si l'on peut utiliser des marges haut et bas</span><br />
&nbsp; &nbsp; SetMarge<span class="br0">&#40;</span><span class="nu0">2</span><span class="br0">&#41;</span>.<span class="me1">Visible</span> = UseTopAndBottomMargin.<span class="me1">Value</span><br />
&nbsp; &nbsp; SetMarge<span class="br0">&#40;</span><span class="nu0">3</span><span class="br0">&#41;</span>.<span class="me1">Visible</span> = UseTopAndBottomMargin.<span class="me1">Value</span><br />

&nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">26</span><span class="br0">&#41;</span>.<span class="me1">Visible</span> = UseTopAndBottomMargin.<span class="me1">Value</span><br />
&nbsp; &nbsp; etiquette<span class="br0">&#40;</span><span class="nu0">27</span><span class="br0">&#41;</span>.<span class="me1">Visible</span> = UseTopAndBottomMargin.<span class="me1">Value</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> VoirApercu_MouseUp<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; VoirApercu_MouseMove Button, Shift, X, Y<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
&nbsp;</div></fieldset>
<h3>Les modules :</h3>
<h4>Fonctions</h4>
<p>Le module fonction gère toutes les fonctions annexes qui ne sont pas des événements.</p>
<fieldset>
<legend>Code source : <a href="Codes/Fonctions.bas" title="Télecharger le fichier">Fonctions.bas</a></legend>

<div class="vb" style="font-family: monospace;"><div class="head"><ul><li>Langage : <em>vb</em></li><li>&Delta;T : <em>0.587s</em></li><li>Taille :20847 caractères</li></ul></div>Attribute VB_Name = <span class="st0">&quot;Fonctions&quot;</span><br />
<span class="co1">'--------------------------------------------------------------------------------</span><br />
<span class="co1">' &nbsp; &nbsp;Component &nbsp;: Fonctions</span><br />
<span class="co1">' &nbsp; &nbsp;Project &nbsp; &nbsp;: TXT2JPG</span><br />

<span class="co1">'</span><br />
<span class="co1">' &nbsp; &nbsp;Description:</span><br />
<span class="co1">'Module utilisé pour le subclassing</span><br />
<span class="co1">'Et pour trouver le chemin des fichiers spéciaux</span><br />
<span class="co1">'Et pour afficher un comdlg, un colorpicker et un select folder</span><br />
<span class="co1">'Et pour des petites fonctions : Min, MyMid</span><br />
<span class="co1">'Et pour SetBackColorSel</span><br />
<span class="co1">'Bref, toutes les petites fonctions qui ne trouvaient leurs places nulle part..</span><br />

<span class="co1">'</span><br />
<span class="co1">' &nbsp; &nbsp;Modified &nbsp; :</span><br />
<span class="co1">'--------------------------------------------------------------------------------</span><br />
<span class="co1">'</span><br />
<span class="kw1">Option</span> <span class="kw1">Explicit</span><br />
<br />

<span class="co1">'Quasiment l'API principale...pour tout les messages Windows</span><br />
<span class="kw1">Public</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> SendMessage Lib <span class="st0">&quot;user32&quot;</span> Alias <span class="st0">&quot;SendMessageA&quot;</span> <span class="br0">&#40;</span>ByVal hwnd <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal wMsg <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal wParam <span class="kw1">As</span> <span class="kw1">Long</span>, lParam <span class="kw1">As</span> Any<span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="co1">'</span><br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> GetPrivateProfileString Lib <span class="st0">&quot;kernel32&quot;</span> Alias <span class="st0">&quot;GetPrivateProfileStringA&quot;</span> <span class="br0">&#40;</span>ByVal lpApplicationName <span class="kw1">As</span> <span class="kw1">String</span>, ByVal lpKeyName <span class="kw1">As</span> Any, ByVal lpDefault <span class="kw1">As</span> <span class="kw1">String</span>, ByVal lpReturnedString <span class="kw1">As</span> <span class="kw1">String</span>, ByVal nSize <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal lpFileName <span class="kw1">As</span> <span class="kw1">String</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<br />
<br />
<span class="co1">'Choix d'un fichier : type des données envoyées</span><br />
<span class="kw1">Private</span> <span class="kw1">Type</span> OPENFILENAME<br />
<br />
&nbsp; &nbsp; lStructSize <span class="kw1">As</span> <span class="kw1">Long</span><br />

&nbsp; &nbsp; hWndOwner <span class="kw1">As</span> <span class="kw1">Long</span><br />
&nbsp; &nbsp; hInstance <span class="kw1">As</span> <span class="kw1">Long</span><br />
&nbsp; &nbsp; lpstrFilter <span class="kw1">As</span> <span class="kw1">String</span><br />

&nbsp; &nbsp; lpstrCustomFilter <span class="kw1">As</span> <span class="kw1">String</span><br />
&nbsp; &nbsp; nMaxCustFilter <span class="kw1">As</span> <span class="kw1">Long</span><br />
&nbsp; &nbsp; nFilterIndex <span class="kw1">As</span> <span class="kw1">Long</span><br />

&nbsp; &nbsp; lpstrFile <span class="kw1">As</span> <span class="kw1">String</span><br />
&nbsp; &nbsp; nMaxFile <span class="kw1">As</span> <span class="kw1">Long</span><br />
&nbsp; &nbsp; lpstrFileTitle <span class="kw1">As</span> <span class="kw1">String</span><br />

&nbsp; &nbsp; nMaxFileTitle <span class="kw1">As</span> <span class="kw1">Long</span><br />
&nbsp; &nbsp; lpstrInitialDir <span class="kw1">As</span> <span class="kw1">String</span><br />
&nbsp; &nbsp; lpstrTitle <span class="kw1">As</span> <span class="kw1">String</span><br />

&nbsp; &nbsp; flags <span class="kw1">As</span> <span class="kw1">Long</span><br />
&nbsp; &nbsp; nFileOffset <span class="kw1">As</span> <span class="kw1">Integer</span><br />
&nbsp; &nbsp; nFileExtension <span class="kw1">As</span> <span class="kw1">Integer</span><br />

&nbsp; &nbsp; lpstrDefExt <span class="kw1">As</span> <span class="kw1">String</span><br />
&nbsp; &nbsp; lCustData <span class="kw1">As</span> <span class="kw1">Long</span><br />
&nbsp; &nbsp; lpfnHook <span class="kw1">As</span> <span class="kw1">Long</span><br />

&nbsp; &nbsp; lpTemplateName <span class="kw1">As</span> <span class="kw1">String</span><br />
<br />
<span class="kw1">End</span> <span class="kw1">Type</span><br />
<br />
<span class="co1">'Choix d'un dossier : type des données envoyées</span><br />
<span class="kw1">Private</span> <span class="kw1">Type</span> BrowseInfo<br />

<br />
&nbsp; &nbsp; hWndOwner <span class="kw1">As</span> <span class="kw1">Long</span><br />
&nbsp; &nbsp; pIDLRoot <span class="kw1">As</span> <span class="kw1">Long</span><br />
&nbsp; &nbsp; pszDisplayName <span class="kw1">As</span> <span class="kw1">Long</span><br />

&nbsp; &nbsp; lpszTitle <span class="kw1">As</span> <span class="kw1">Long</span><br />
&nbsp; &nbsp; ulFlags <span class="kw1">As</span> <span class="kw1">Long</span><br />
&nbsp; &nbsp; lpfnCallback <span class="kw1">As</span> <span class="kw1">Long</span><br />

&nbsp; &nbsp; lParam <span class="kw1">As</span> <span class="kw1">Long</span><br />
&nbsp; &nbsp; iImage <span class="kw1">As</span> <span class="kw1">Long</span><br />
<br />
<span class="kw1">End</span> <span class="kw1">Type</span><br />

<br />
<span class="co1">'Choix de couleur : type des données envoyées</span><br />
<span class="kw1">Private</span> <span class="kw1">Type</span> ChooseColor<br />
<br />
&nbsp; &nbsp; lStructSize <span class="kw1">As</span> <span class="kw1">Long</span><br />

&nbsp; &nbsp; hWndOwner <span class="kw1">As</span> <span class="kw1">Long</span><br />
&nbsp; &nbsp; hInstance <span class="kw1">As</span> <span class="kw1">Long</span><br />
&nbsp; &nbsp; rgbResult <span class="kw1">As</span> <span class="kw1">Long</span><br />

&nbsp; &nbsp; lpCustColors <span class="kw1">As</span> <span class="kw1">String</span><br />
&nbsp; &nbsp; flags <span class="kw1">As</span> <span class="kw1">Long</span><br />
&nbsp; &nbsp; lCustData <span class="kw1">As</span> <span class="kw1">Long</span><br />

&nbsp; &nbsp; lpfnHook <span class="kw1">As</span> <span class="kw1">Long</span><br />
&nbsp; &nbsp; lpTemplateName <span class="kw1">As</span> <span class="kw1">String</span><br />
<br />
<span class="kw1">End</span> <span class="kw1">Type</span><br />

<br />
<span class="co1">'Pour les dossiers spéciaux :</span><br />
<span class="kw1">Private</span> <span class="kw1">Type</span> SHITEMID<br />
<br />
&nbsp; &nbsp; CB <span class="kw1">As</span> <span class="kw1">Long</span><br />

&nbsp; &nbsp; abID <span class="kw1">As</span> Byte<br />
<br />
<span class="kw1">End</span> <span class="kw1">Type</span><br />
<br />
<span class="co1">'</span><br />
<span class="kw1">Private</span> <span class="kw1">Type</span> ITEMIDLIST<br />

<br />
&nbsp; &nbsp; mkid <span class="kw1">As</span> SHITEMID<br />
<br />
<span class="kw1">End</span> <span class="kw1">Type</span><br />
<br />
<span class="co1">'</span><br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> SHGetSpecialFolderLocation Lib <span class="st0">&quot;shell32.dll&quot;</span> <span class="br0">&#40;</span>ByVal hWndOwner <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal nFolder <span class="kw1">As</span> <span class="kw1">Long</span>, pidl <span class="kw1">As</span> ITEMIDLIST<span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> SHGetPathFromIDList Lib <span class="st0">&quot;shell32.dll&quot;</span> Alias <span class="st0">&quot;SHGetPathFromIDListA&quot;</span> <span class="br0">&#40;</span>ByVal pidl <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal pszPath <span class="kw1">As</span> <span class="kw1">String</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="co1">'Grise le bouton de fermeture de la feuille pendant la numérisation :</span><br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> GetMenuItemCount Lib <span class="st0">&quot;user32&quot;</span> <span class="br0">&#40;</span>ByVal hMenu <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> GetSystemMenu Lib <span class="st0">&quot;user32&quot;</span> <span class="br0">&#40;</span>ByVal hwnd <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal bRevert <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> DeleteMenu Lib <span class="st0">&quot;user32&quot;</span> <span class="br0">&#40;</span>ByVal hMenu <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal nPosition <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal wFlags <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> DrawMenuBar Lib <span class="st0">&quot;user32&quot;</span> <span class="br0">&#40;</span>ByVal hwnd <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Const</span> SC_CLOSE &nbsp; &nbsp; <span class="kw1">As</span> <span class="kw1">Long</span> = &amp;HF060&amp;<br />
<br />
<span class="kw1">Private</span> <span class="kw1">Const</span> MF_BYCOMMAND <span class="kw1">As</span> <span class="kw1">Long</span> = &amp;H0&amp;<br />

<br />
<span class="kw1">Private</span> <span class="kw1">Const</span> MF_BYPOSITION = &amp;H400&amp;<br />
<br />
<span class="co1">' Déclaration de fonctions API</span><br />
<span class="co1">'ComDlg</span><br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> GetOpenFileName Lib <span class="st0">&quot;comdlg32.dll&quot;</span> Alias <span class="st0">&quot;GetOpenFileNameA&quot;</span> <span class="br0">&#40;</span>pOpenfilename <span class="kw1">As</span> OPENFILENAME<span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="co1">'ColorPicker</span><br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> ChooseColorAPI Lib <span class="st0">&quot;comdlg32.dll&quot;</span> Alias <span class="st0">&quot;ChooseColorA&quot;</span> <span class="br0">&#40;</span>pChoosecolor <span class="kw1">As</span> ChooseColor<span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="co1">'File picker</span><br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> SHBrowseForFolder Lib <span class="st0">&quot;shell32&quot;</span> <span class="br0">&#40;</span>lpbi <span class="kw1">As</span> BrowseInfo<span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="co1">'Private Declare Function SHGetPathFromIDList Lib &quot;shell32&quot; (ByVal pidList As Long,ByVal lpBuffer As String) As Long</span><br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> lstrcat Lib <span class="st0">&quot;kernel32&quot;</span> Alias <span class="st0">&quot;lstrcatA&quot;</span> <span class="br0">&#40;</span>ByVal lpString1 <span class="kw1">As</span> <span class="kw1">String</span>, ByVal lpString2 <span class="kw1">As</span> <span class="kw1">String</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="co1">'Constantes</span><br />
<span class="co1">'Pour le select folder</span><br />
<span class="kw1">Private</span> <span class="kw1">Const</span> BIF_RETURNONLYFSDIRS = <span class="nu0">1</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Const</span> BIF_DONTGOBELOWDOMAIN = <span class="nu0">2</span><br />

<br />
<span class="kw1">Public</span> <span class="kw1">Const</span> BIF_USENEWUI = &amp;H40<br />
<br />
<span class="co1">'Pour le comdlg file :</span><br />
<span class="kw1">Public</span> <span class="kw1">Enum</span> esFlags<br />

<br />
&nbsp; &nbsp; OFN_ALLOWMULTISELECT = &amp;H200<br />
&nbsp; &nbsp; OFN_CREATEPROMPT = &amp;H2000<br />
&nbsp; &nbsp; OFN_ENABLEHOOK = &amp;H20<br />
&nbsp; &nbsp; OFN_ENABLETEMPLATEHANDLE = &amp;H80<br />

&nbsp; &nbsp; OFN_EXPLORER = &amp;H80000<br />
&nbsp; &nbsp; OFN_EXTENSIONDIFFERENT = &amp;H400<br />
&nbsp; &nbsp; OFN_FILEMUSTEXIST = &amp;H1000<br />
&nbsp; &nbsp; OFN_HIDEREADONLY = &amp;H4<br />

&nbsp; &nbsp; OFN_LONGNAMES = &amp;H200000<br />
&nbsp; &nbsp; OFN_NOCHANGEDIR = &amp;H8<br />
&nbsp; &nbsp; OFN_NODEREFERENCELINKS = &amp;H100000<br />
&nbsp; &nbsp; OFN_NOLONGNAMES = &amp;H40000<br />

&nbsp; &nbsp; OFN_NONETWORKBUTTON = &amp;H20000<br />
&nbsp; &nbsp; OFN_NOREADONLYRETURN = &amp;H8000<br />
&nbsp; &nbsp; OFN_NOTESTFILECREATE = &amp;H10000<br />
&nbsp; &nbsp; OFN_NOVALIDATE = &amp;H100<br />

&nbsp; &nbsp; OFN_OVERWRITEPROMPT = &amp;H2<br />
&nbsp; &nbsp; OFN_PATHMUSTEXIST = &amp;H800<br />
&nbsp; &nbsp; OFN_READONLY = &amp;H1<br />
&nbsp; &nbsp; OFN_SHAREAWARE = &amp;H4000<br />

&nbsp; &nbsp; OFN_SHOWHELP = &amp;H10<br />
<br />
<span class="kw1">End</span> <span class="kw1">Enum</span><br />
<br />
<span class="co1">'Pour le color picker :</span><br />
<span class="kw1">Dim</span> CustomColors<span class="br0">&#40;</span><span class="br0">&#41;</span> <span class="kw1">As</span> Byte<br />

<br />
<span class="kw1">Private</span> <span class="kw1">Const</span> LF_FACESIZE = <span class="nu0">32</span><br />
<br />
<span class="co1">' Format structure, passé avec SendMessage au contrôle pour changer le backcolor</span><br />
<span class="kw1">Private</span> <span class="kw1">Type</span> <span class="kw1">FORMAT</span><br />

<br />
&nbsp; &nbsp; cbSize <span class="kw1">As</span> <span class="kw1">Integer</span><br />
&nbsp; &nbsp; wPad1 <span class="kw1">As</span> <span class="kw1">Integer</span><br />
&nbsp; &nbsp; dwMask <span class="kw1">As</span> <span class="kw1">Long</span><br />

&nbsp; &nbsp; dwEffects <span class="kw1">As</span> <span class="kw1">Long</span><br />
&nbsp; &nbsp; yHeight <span class="kw1">As</span> <span class="kw1">Long</span><br />
&nbsp; &nbsp; yOffset <span class="kw1">As</span> <span class="kw1">Long</span><br />

&nbsp; &nbsp; crTextColor <span class="kw1">As</span> <span class="kw1">Long</span><br />
&nbsp; &nbsp; bCharSet <span class="kw1">As</span> Byte<br />
&nbsp; &nbsp; bPitchAndFamily <span class="kw1">As</span> Byte<br />

&nbsp; &nbsp; szFaceName<span class="br0">&#40;</span><span class="nu0">0</span> <span class="kw1">To</span> LF_FACESIZE - <span class="nu0">1</span><span class="br0">&#41;</span> <span class="kw1">As</span> Byte<br />
&nbsp; &nbsp; wPad2 <span class="kw1">As</span> <span class="kw1">Integer</span><br />

&nbsp; &nbsp; wWeight <span class="kw1">As</span> <span class="kw1">Integer</span><br />
&nbsp; &nbsp; sSpacing <span class="kw1">As</span> <span class="kw1">Integer</span><br />
&nbsp; &nbsp; crBackColor <span class="kw1">As</span> <span class="kw1">Long</span><br />

&nbsp; &nbsp; lLCID <span class="kw1">As</span> <span class="kw1">Long</span><br />
&nbsp; &nbsp; dwReserved <span class="kw1">As</span> <span class="kw1">Long</span><br />
&nbsp; &nbsp; sStyle <span class="kw1">As</span> <span class="kw1">Integer</span><br />

&nbsp; &nbsp; wKerning <span class="kw1">As</span> <span class="kw1">Integer</span><br />
&nbsp; &nbsp; bUnderlineType <span class="kw1">As</span> Byte<br />
&nbsp; &nbsp; bAnimation <span class="kw1">As</span> Byte<br />

&nbsp; &nbsp; bRevAuthor <span class="kw1">As</span> Byte<br />
&nbsp; &nbsp; bReserved1 <span class="kw1">As</span> Byte<br />
<br />
<span class="kw1">End</span> <span class="kw1">Type</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Const</span> SCF_SELECTION = &amp;H1&amp;<br />
<br />
<span class="kw1">Private</span> <span class="kw1">Const</span> WM_USER = &amp;H400<br />
<br />

<span class="co1">' pour recuperer les messages et text avec richtextbox</span><br />
<span class="kw1">Private</span> <span class="kw1">Const</span> EM_SETCHARFORMAT = <span class="br0">&#40;</span>WM_USER + <span class="nu0">68</span><span class="br0">&#41;</span><br />
<br />
<span class="co1">' pour Font et BackColor</span><br />
<span class="kw1">Private</span> <span class="kw1">Const</span> CFM_BACKCOLOR = &amp;H4000000<br />

<br />
<span class="kw1">Private</span> <span class="kw1">Const</span> CFE_AUTOBACKCOLOR = CFM_BACKCOLOR<br />
<br />
<span class="kw1">Public</span> <span class="kw1">Type</span> ResultConstant<br />
&nbsp; &nbsp; URL <span class="kw1">As</span> <span class="kw1">String</span><br />

&nbsp; &nbsp; EstUnLiens <span class="kw1">As</span> <span class="kw1">Boolean</span><br />
&nbsp; &nbsp; Email <span class="kw1">As</span> <span class="kw1">Boolean</span><br />
&nbsp; &nbsp; interne <span class="kw1">As</span> <span class="kw1">Boolean</span><br />

<span class="kw1">End</span> <span class="kw1">Type</span><br />
<span class="kw1">Private</span> <span class="kw1">Type</span> POINTAPI<br />
&nbsp; &nbsp; X &nbsp; &nbsp; &nbsp; <span class="kw1">As</span> <span class="kw1">Long</span><br />

&nbsp; &nbsp; Y &nbsp; &nbsp; &nbsp; <span class="kw1">As</span> <span class="kw1">Long</span><br />
<span class="kw1">End</span> <span class="kw1">Type</span><br />
<br />
<br />
<br />

<span class="kw1">Public</span> Stockage <span class="kw1">As</span> <span class="kw1">String</span><br />
<br />
<span class="co1">'Empeche le rafraichissement d'un controle</span><br />
<span class="kw1">Public</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> LockWindowUpdate Lib <span class="st0">&quot;user32&quot;</span> <span class="br0">&#40;</span>ByVal hwndLock <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> GetParent Lib <span class="st0">&quot;user32&quot;</span> <span class="br0">&#40;</span>ByVal hwnd <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Type</span> RECT<br />
&nbsp; &nbsp; <span class="kw1">Left</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />
&nbsp; &nbsp; Top <span class="kw1">As</span> <span class="kw1">Long</span><br />

&nbsp; &nbsp; <span class="kw1">Right</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />
&nbsp; &nbsp; Bottom <span class="kw1">As</span> <span class="kw1">Long</span><br />
<span class="kw1">End</span> <span class="kw1">Type</span><br />

<br />
<span class="kw1">Dim</span> Rectangle <span class="kw1">As</span> RECT<br />
<br />
<span class="kw1">Private</span> <span class="kw1">Const</span> EM_GETRECT = &amp;HB2<br />
<span class="kw1">Private</span> <span class="kw1">Const</span> EM_SETRECT = &amp;HB3<br />

<br />
<span class="co1">'Faire un son pour l'infobulle</span><br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> MessageBeep Lib <span class="st0">&quot;user32&quot;</span> <span class="br0">&#40;</span>ByVal wType <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="kw1">Public</span> <span class="kw1">Sub</span> ShowHelpFor<span class="br0">&#40;</span>controle <span class="kw1">As</span> Control, MessageTitre <span class="kw1">As</span> <span class="kw1">String</span>, MessageTexte <span class="kw1">As</span> <span class="kw1">String</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">If</span> Principale.<span class="me1">BallonTip</span>.<span class="kw1">Left</span> &lt;&gt; controle.<span class="kw1">Width</span> \ <span class="nu0">2</span> + controle.<span class="kw1">Left</span> - Principale.<span class="me1">BallonTip</span>.<span class="kw1">Width</span> + <span class="nu0">18</span> + controle.<span class="me1">Container</span>.<span class="kw1">Left</span> <span class="kw1">Or</span> Principale.<span class="me1">BallonTip</span>.<span class="me1">Top</span> &lt;&gt; controle.<span class="me1">Top</span> + controle.<span class="me1">Height</span> + controle.<span class="me1">Container</span>.<span class="me1">Top</span> <span class="kw1">Then</span> AfficherTip MessageTitre, MessageTexte, controle<br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="co1">'Sub pour l'affichage d'une infobulle style XP. Possibilité de définir un son, recoit l'id du message et va chercher dans le fichier ini la traduction</span><br />
<span class="kw1">Public</span> <span class="kw1">Sub</span> AfficherTip<span class="br0">&#40;</span>Titre <span class="kw1">As</span> <span class="kw1">String</span>, Contenu <span class="kw1">As</span> <span class="kw1">String</span>, ctl <span class="kw1">As</span> Control, Optional SoundToPlay <span class="kw1">As</span> <span class="kw1">Long</span> = <span class="nu0">0</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Left</span>$<span class="br0">&#40;</span>Titre, <span class="nu0">1</span><span class="br0">&#41;</span> = <span class="st0">&quot;i&quot;</span> <span class="kw1">Then</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'L'infobulle n'est qu'une simple information qui ne sera affichée qu'une seule fois.</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;ShownTip&quot;</span>, <span class="kw1">Left</span>$<span class="br0">&#40;</span>Titre, <span class="nu0">4</span><span class="br0">&#41;</span> &amp; <span class="kw1">Left</span>$<span class="br0">&#40;</span>Contenu, <span class="nu0">2</span><span class="br0">&#41;</span>, <span class="nu0">0</span><span class="br0">&#41;</span> &gt; <span class="nu0">1</span> <span class="kw1">Then</span> <span class="kw1">Exit</span> <span class="kw1">Sub</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">SaveSetting</span> <span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;ShownTip&quot;</span>, <span class="kw1">Left</span>$<span class="br0">&#40;</span>Titre, <span class="nu0">4</span><span class="br0">&#41;</span> &amp; <span class="kw1">Left</span>$<span class="br0">&#40;</span>Contenu, <span class="nu0">2</span><span class="br0">&#41;</span>, <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;ShownTip&quot;</span>, <span class="kw1">Left</span>$<span class="br0">&#40;</span>Titre, <span class="nu0">4</span><span class="br0">&#41;</span> &amp; <span class="kw1">Left</span>$<span class="br0">&#40;</span>Contenu, <span class="nu0">2</span><span class="br0">&#41;</span>, <span class="nu0">0</span><span class="br0">&#41;</span> + <span class="nu0">1</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Titre = <span class="kw1">Right</span>$<span class="br0">&#40;</span>Titre, <span class="kw1">Len</span><span class="br0">&#40;</span>Titre<span class="br0">&#41;</span> - <span class="nu0">1</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Principale.<span class="me1">MouseOutProc</span>.<span class="me1">Tag</span> = ctl.<span class="me1">hwnd</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Principale.<span class="me1">MouseOutProc</span>.<span class="me1">Enabled</span> = <span class="kw1">True</span><br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

<br />
&nbsp; &nbsp; Principale.<span class="me1">BallonTip</span>.<span class="me1">Top</span> = ctl.<span class="me1">Top</span> + ctl.<span class="me1">Height</span> + ctl.<span class="me1">Container</span>.<span class="me1">Top</span><br />

&nbsp; &nbsp; Principale.<span class="me1">BallonTip</span>.<span class="kw1">Left</span> = ctl.<span class="kw1">Width</span> \ <span class="nu0">2</span> + ctl.<span class="kw1">Left</span> - Principale.<span class="me1">BallonTip</span>.<span class="kw1">Width</span> + <span class="nu0">18</span> + ctl.<span class="me1">Container</span>.<span class="kw1">Left</span><br />

&nbsp; &nbsp; Principale.<span class="me1">BallonTip</span>.<span class="me1">Titre</span> = Titre<br />
&nbsp; &nbsp; Principale.<span class="me1">BallonTip</span>.<span class="me1">Text</span> = Contenu<br />

&nbsp; &nbsp; Principale.<span class="me1">BallonTip</span>.<span class="me1">Visible</span> = <span class="kw1">True</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> SoundToPlay &lt;&gt; <span class="kw1">False</span> <span class="kw1">And</span> SoundToPlay &lt;&gt; <span class="kw1">True</span> <span class="kw1">Then</span> MessageBeep SoundToPlay<br />

&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;Dim pt As POINTAPIre</span><br />
&nbsp; &nbsp; <span class="co1">'</span><br />
&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;pt.x = 0: pt.y = 0</span><br />
&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;On Error GoTo cantshow</span><br />

&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;If Not (Me.ActiveControl = ctl) And ExitOnUnFocus Then Exit Sub</span><br />
&nbsp; &nbsp; <span class="co1">'cantshow:</span><br />
&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;If Left$(Titre, 1) = &quot;i&quot; Then</span><br />

&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;'L'infobulle n'est qu'une simple information qui ne sera affichée qu'une seule fois.</span><br />
&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;If GetSetting(&quot;TXT2JPG&quot;, &quot;ShownTip&quot;, Left$(Titre, 4) &amp; Left$(English_Titre, 4) &amp; Left$(Contenu, 2), 0) &gt; 1 Then Exit Sub</span><br />

&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;SaveSetting &quot;TXT2JPG&quot;, &quot;ShownTip&quot;, Left$(Titre, 4) &amp; Left$(English_Titre, 4) &amp; Left$(Contenu, 2), GetSetting(&quot;TXT2JPG&quot;, &quot;ShownTip&quot;, Left$(Titre, 4) &amp; Left$(English_Titre, 4) &amp; Left$(Contenu, 2), 0) + 1</span><br />

&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;Titre = Right(Titre, Len(Titre) - 1)</span><br />
&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;End If</span><br />
&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;'Affiche un message dans une infobulle</span><br />

&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;'D'abord l'arrière plan : (un simple blit..mais avec des screentoclient^-1)</span><br />
&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;BallonTip.Visible = False</span><br />
&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;'Afficher une icone si critique !</span><br />

&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;BallonTipCaption.Left = IIf(SoundToPlay = vbCritical, 55, 14)</span><br />
&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;BallonTipCaption.Width = IIf(SoundToPlay = vbCritical, 255, 302)</span><br />
&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;BallonTipCritique.Visible = IIf(SoundToPlay = vbCritical, True, False)</span><br />

&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;BallonTip.Top = ctl.Top + ctl.Height + ctl.Container.Top</span><br />
&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;BallonTip.Left = ctl.Width \ 2 + ctl.Left - BallonTip.Width + 18 + ctl.Container.Left</span><br />
&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;DoEvents</span><br />

&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;ClientToScreen BallonTip.hWnd, pt</span><br />
&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;BitBlt BallonTip.hdc, 0, 0, 327, 113, GetDC(0), pt.x, pt.y, vbSrcCopy</span><br />
&nbsp; &nbsp; <span class="co1">'</span><br />
&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;TransparentBlt BallonTip.hdc, 0, 0, 327, 113, BallonTipPic.hdc, 0, 0, 327, 113, RGB(255, 255, 255)</span><br />

&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;If Selected_Language = &quot;Francais&quot; Then</span><br />
&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;BallonTipTitre = Titre</span><br />

&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;BallonTipCaption = Contenu</span><br />
&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;Else</span><br />
&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;BallonTipTitre = English_Titre</span><br />

&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp; &nbsp; &nbsp;BallonTipCaption = English_Contenu</span><br />
&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;End If</span><br />
&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;If SoundToPlay &lt;&gt; 0 Then MessageBeep SoundToPlay</span><br />

&nbsp; &nbsp; <span class="co1">'</span><br />
&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;'Remettre la croix à vide</span><br />
&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;BallonTipCancel(0).Visible = True</span><br />
&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;BallonTipCancel(1).Visible = False</span><br />

&nbsp; &nbsp; <span class="co1">' &nbsp; &nbsp;BallonTip.Visible = True</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<br />
<span class="kw1">Public</span> <span class="kw1">Sub</span> TextBoxMargins<span class="br0">&#40;</span>TextBox <span class="kw1">As</span> RichTextBox, ByVal LeftMargin <span class="kw1">As</span> Variant, ByVal TopMargin <span class="kw1">As</span> Variant, ByVal RightMargin <span class="kw1">As</span> Variant, ByVal BottomMargin <span class="kw1">As</span> Variant<span class="br0">&#41;</span><br />

<br />
&nbsp; <span class="kw1">Dim</span> nRect <span class="kw1">As</span> RECT<br />
&nbsp; <br />
&nbsp; TextBoxResetRect TextBox<br />
&nbsp; <span class="kw1">With</span> TextBox<br />

&nbsp; &nbsp; SendMessage .<span class="me1">hwnd</span>, EM_GETRECT, <span class="nu0">0</span>, nRect<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">With</span> nRect<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="kw1">Left</span> = LeftMargin<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">Top</span> = TopMargin<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="kw1">Right</span> = TextBox.<span class="kw1">Width</span> - RightMargin<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">Bottom</span> = TextBox.<span class="me1">Height</span> - BottomMargin<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">With</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; SendMessage .<span class="me1">hwnd</span>, EM_SETRECT, <span class="nu0">0</span>, nRect<br />
&nbsp; <span class="kw1">End</span> <span class="kw1">With</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />

<span class="kw1">Private</span> <span class="kw1">Sub</span> TextBoxResetRect<span class="br0">&#40;</span>TextBox <span class="kw1">As</span> RichTextBox<span class="br0">&#41;</span><br />
&nbsp; <span class="kw1">Dim</span> nWidth <span class="kw1">As</span> <span class="kw1">Single</span><br />

<br />
&nbsp; <span class="kw1">With</span> TextBox<br />
&nbsp; &nbsp; LockWindowUpdate GetParent<span class="br0">&#40;</span>.<span class="me1">hwnd</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; nWidth = .<span class="kw1">Width</span><br />

&nbsp; &nbsp; .<span class="kw1">Width</span> = <span class="nu0">1</span><br />
&nbsp; &nbsp; .<span class="kw1">Width</span> = nWidth<br />
&nbsp; &nbsp; LockWindowUpdate <span class="nu0">0</span><br />

&nbsp; <span class="kw1">End</span> <span class="kw1">With</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<span class="kw1">Public</span> <span class="kw1">Function</span> LoadString<span class="br0">&#40;</span>ID <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">String</span><br />

&nbsp; &nbsp; <span class="co1">'Lire dans le fichier INi pour les langues</span><br />
&nbsp; &nbsp; <span class="kw1">Dim</span> Retour <span class="kw1">As</span> <span class="kw1">String</span>, Variable <span class="kw1">As</span> <span class="kw1">String</span>, fichier <span class="kw1">As</span> <span class="kw1">String</span><br />

&nbsp; &nbsp; fichier = App.<span class="me1">Path</span> &amp; <span class="st0">&quot;\Lang\&quot;</span> &amp; <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Langue&quot;</span>, <span class="st0">&quot;Francais&quot;</span><span class="br0">&#41;</span> &amp; <span class="st0">&quot;.lng&quot;</span><br />

&nbsp; &nbsp; Variable = <span class="st0">&quot;String&quot;</span> &amp; <span class="kw1">Str</span><span class="br0">&#40;</span>ID<span class="br0">&#41;</span><br />
&nbsp; &nbsp; Retour = <span class="kw1">String</span><span class="br0">&#40;</span><span class="nu0">512</span>, <span class="kw1">Chr</span><span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; LoadString = <span class="kw1">Left</span>$<span class="br0">&#40;</span>Retour, GetPrivateProfileString<span class="br0">&#40;</span><span class="st0">&quot;Strings&quot;</span>, ByVal Variable, <span class="st0">&quot;&quot;</span>, Retour, <span class="kw1">Len</span><span class="br0">&#40;</span>Retour<span class="br0">&#41;</span>, fichier<span class="br0">&#41;</span><span class="br0">&#41;</span><br />
<span class="kw1">End</span> <span class="kw1">Function</span><br />

<br />
<br />
<span class="kw1">Public</span> <span class="kw1">Function</span> LoadCaption<span class="br0">&#40;</span>ID <span class="kw1">As</span> <span class="kw1">String</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">String</span><br />
&nbsp; &nbsp; <span class="co1">'Lire dans le fichier INi pour les langues</span><br />

&nbsp; &nbsp; <span class="kw1">Dim</span> Retour <span class="kw1">As</span> <span class="kw1">String</span>, fichier <span class="kw1">As</span> <span class="kw1">String</span><br />
&nbsp; &nbsp; fichier = App.<span class="me1">Path</span> &amp; <span class="st0">&quot;\Lang\&quot;</span> &amp; <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Langue&quot;</span>, <span class="st0">&quot;Francais&quot;</span><span class="br0">&#41;</span> &amp; <span class="st0">&quot;.lng&quot;</span><br />

&nbsp; &nbsp; Retour = <span class="kw1">String</span><span class="br0">&#40;</span><span class="nu0">512</span>, <span class="kw1">Chr</span><span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; LoadCaption = <span class="kw1">Left</span>$<span class="br0">&#40;</span>Retour, GetPrivateProfileString<span class="br0">&#40;</span><span class="st0">&quot;FormData&quot;</span>, ByVal ID, <span class="st0">&quot;&quot;</span>, Retour, <span class="kw1">Len</span><span class="br0">&#40;</span>Retour<span class="br0">&#41;</span>, fichier<span class="br0">&#41;</span><span class="br0">&#41;</span><br />

<span class="kw1">End</span> <span class="kw1">Function</span><br />
<br />
<span class="kw1">Public</span> <span class="kw1">Function</span> LoadMSG<span class="br0">&#40;</span>ID <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">String</span><br />

&nbsp; &nbsp; <span class="co1">'Lire dans le fichier lng (ini) pour les langues</span><br />
&nbsp; &nbsp; <span class="kw1">Dim</span> Retour <span class="kw1">As</span> <span class="kw1">String</span>, Variable <span class="kw1">As</span> <span class="kw1">String</span>, fichier <span class="kw1">As</span> <span class="kw1">String</span><br />

&nbsp; &nbsp; fichier = App.<span class="me1">Path</span> &amp; <span class="st0">&quot;\Lang\&quot;</span> &amp; <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Langue&quot;</span>, <span class="st0">&quot;Francais&quot;</span><span class="br0">&#41;</span> &amp; <span class="st0">&quot;.lng&quot;</span><br />

&nbsp; &nbsp; Variable = <span class="st0">&quot;MSG&quot;</span> &amp; <span class="kw1">Str</span><span class="br0">&#40;</span>ID<span class="br0">&#41;</span><br />
&nbsp; &nbsp; Retour = <span class="kw1">String</span><span class="br0">&#40;</span><span class="nu0">512</span>, <span class="kw1">Chr</span><span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; LoadMSG = <span class="kw1">Left</span>$<span class="br0">&#40;</span>Retour, GetPrivateProfileString<span class="br0">&#40;</span><span class="st0">&quot;Message&quot;</span>, ByVal Variable, <span class="st0">&quot;&quot;</span>, Retour, <span class="kw1">Len</span><span class="br0">&#40;</span>Retour<span class="br0">&#41;</span>, fichier<span class="br0">&#41;</span><span class="br0">&#41;</span><br />
<span class="kw1">End</span> <span class="kw1">Function</span><br />

<br />
<br />
<span class="kw1">Public</span> <span class="kw1">Function</span> SetBackColorSel<span class="br0">&#40;</span>ByVal RichHwnd <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal NouveauFontBackColorSel <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span><br />
<br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">Dim</span> iniformat <span class="kw1">As</span> <span class="kw1">FORMAT</span><br />

<br />
&nbsp; &nbsp; <span class="co1">' Set BackColor a masqué</span><br />
&nbsp; &nbsp; iniformat.<span class="me1">dwMask</span> = CFM_BACKCOLOR<br />
<br />
&nbsp; &nbsp; <span class="co1">' Si le nouveau backcolour est mis à -1 alors nous avons mis le</span><br />

&nbsp; &nbsp; <span class="co1">' Backcolour RichTextbox a zero (vbwhite)</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> NouveauFontBackColorSel = <span class="nu0">-1</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; iniformat.<span class="me1">dwEffects</span> = CFE_AUTOBACKCOLOR<br />

&nbsp; &nbsp; &nbsp; &nbsp; iniformat.<span class="me1">crBackColor</span> = <span class="nu0">-1</span><br />
&nbsp; &nbsp; <span class="kw1">Else</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">' donner la nouvelle couleur à BackColour</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; iniformat.<span class="me1">crBackColor</span> = NouveauFontBackColorSel <span class="co1">'ChangerColor(NouveauFontBackColorSel)</span><br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />

&nbsp; &nbsp; <span class="co1">' Nous avons besoin de passer la dimension de la structure comme un</span><br />
&nbsp; &nbsp; <span class="co1">' partie de la structure.</span><br />
&nbsp; &nbsp; iniformat.<span class="me1">cbSize</span> = <span class="kw1">Len</span><span class="br0">&#40;</span>iniformat<span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="co1">' Envoyez le message et le nouveau format de caractère au RichTextbox</span><br />
&nbsp; &nbsp; SetBackColorSel = SendMessage<span class="br0">&#40;</span>RichHwnd, EM_SETCHARFORMAT, SCF_SELECTION, iniformat<span class="br0">&#41;</span><br />
<span class="kw1">End</span> <span class="kw1">Function</span><br />
<br />
<span class="kw1">Public</span> <span class="kw1">Sub</span> Griser_Fermer<span class="br0">&#40;</span>hwnd <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">Dim</span> hSysMenu <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
&nbsp; &nbsp; <span class="co1">' Récupère le handle du menu système</span><br />
&nbsp; &nbsp; hSysMenu = GetSystemMenu<span class="br0">&#40;</span>hwnd, <span class="kw1">False</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="co1">' Supprime le menu &quot;Fermer&quot;</span><br />
&nbsp; &nbsp; <span class="kw1">Call</span> DeleteMenu<span class="br0">&#40;</span>hSysMenu, SC_CLOSE, MF_BYCOMMAND<span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="co1">' Supprime la barre d'espacement</span><br />
&nbsp; &nbsp; <span class="kw1">Call</span> DeleteMenu<span class="br0">&#40;</span>hSysMenu, GetMenuItemCount<span class="br0">&#40;</span>hSysMenu<span class="br0">&#41;</span> - <span class="nu0">1</span>, MF_BYPOSITION<span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="co1">' Redessine la barre de menu</span><br />

&nbsp; &nbsp; <span class="kw1">Call</span> DrawMenuBar<span class="br0">&#40;</span>hwnd<span class="br0">&#41;</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Public</span> <span class="kw1">Function</span> SelectFolder<span class="br0">&#40;</span>Titre <span class="kw1">As</span> <span class="kw1">String</span>, Handle <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">String</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">Dim</span> lpIDList &nbsp; &nbsp;<span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">Dim</span> strBuffer &nbsp; <span class="kw1">As</span> <span class="kw1">String</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">Dim</span> strTitre &nbsp; &nbsp;<span class="kw1">As</span> <span class="kw1">String</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">Dim</span> tBrowseInfo <span class="kw1">As</span> BrowseInfo<br />
<br />
&nbsp; &nbsp; strTitre = Titre<br />
<br />
&nbsp; &nbsp; <span class="kw1">With</span> tBrowseInfo<br />

&nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">hWndOwner</span> = Handle<br />
&nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">lpszTitle</span> = lstrcat<span class="br0">&#40;</span>strTitre, <span class="st0">&quot;&quot;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; .<span class="me1">ulFlags</span> = BIF_RETURNONLYFSDIRS + BIF_DONTGOBELOWDOMAIN + BIF_USENEWUI<br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">With</span><br />
<br />
&nbsp; &nbsp; lpIDList = SHBrowseForFolder<span class="br0">&#40;</span>tBrowseInfo<span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">If</span> <span class="br0">&#40;</span>lpIDList<span class="br0">&#41;</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; strBuffer = <span class="kw1">String</span>$<span class="br0">&#40;</span><span class="nu0">260</span>, <span class="kw1">vbNullChar</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; SHGetPathFromIDList lpIDList, strBuffer<br />
&nbsp; &nbsp; &nbsp; &nbsp; SelectFolder = <span class="kw1">Left</span>$<span class="br0">&#40;</span>strBuffer, <span class="kw1">InStr</span><span class="br0">&#40;</span>strBuffer, <span class="kw1">vbNullChar</span><span class="br0">&#41;</span> - <span class="nu0">1</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
<span class="kw1">End</span> <span class="kw1">Function</span><br />
<br />
<span class="kw1">Public</span> <span class="kw1">Function</span> ChoixCouleur<span class="br0">&#40;</span>lg_hwnd <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">Dim</span> cc &nbsp; &nbsp; &nbsp;<span class="kw1">As</span> ChooseColor<br />

<br />
&nbsp; &nbsp; <span class="kw1">Dim</span> lReturn <span class="kw1">As</span> <span class="kw1">Long</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">ReDim</span> CustomColors<span class="br0">&#40;</span><span class="nu0">0</span> <span class="kw1">To</span> <span class="nu0">16</span> * <span class="nu0">4</span> - <span class="nu0">1</span><span class="br0">&#41;</span> <span class="kw1">As</span> Byte<br />

<br />
&nbsp; &nbsp; <span class="kw1">Dim</span> I <span class="kw1">As</span> <span class="kw1">Integer</span>, Bas <span class="kw1">As</span> <span class="kw1">Long</span>, Haut <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
&nbsp; &nbsp; Bas = <span class="kw1">LBound</span><span class="br0">&#40;</span>CustomColors<span class="br0">&#41;</span>: Haut = <span class="kw1">UBound</span><span class="br0">&#40;</span>CustomColors<span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">For</span> I = Bas <span class="kw1">To</span> Haut<br />

&nbsp; &nbsp; &nbsp; &nbsp; CustomColors<span class="br0">&#40;</span>I<span class="br0">&#41;</span> = <span class="nu0">0</span><br />
&nbsp; &nbsp; <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; cc.<span class="me1">lStructSize</span> = <span class="kw1">Len</span><span class="br0">&#40;</span>cc<span class="br0">&#41;</span><br />

&nbsp; &nbsp; cc.<span class="me1">hWndOwner</span> = lg_hwnd<br />
&nbsp; &nbsp; cc.<span class="me1">hInstance</span> = <span class="nu0">0</span><br />
&nbsp; &nbsp; cc.<span class="me1">lpCustColors</span> = <span class="kw1">StrConv</span><span class="br0">&#40;</span>CustomColors, vbUnicode<span class="br0">&#41;</span><br />

&nbsp; &nbsp; cc.<span class="me1">flags</span> = <span class="nu0">0</span><br />
&nbsp; &nbsp; lReturn = ChooseColorAPI<span class="br0">&#40;</span>cc<span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> lReturn &lt;&gt; <span class="nu0">0</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; ChoixCouleur = cc.<span class="me1">rgbResult</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; CustomColors = <span class="kw1">StrConv</span><span class="br0">&#40;</span>cc.<span class="me1">lpCustColors</span>, vbFromUnicode<span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">Else</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; ChoixCouleur = <span class="nu0">-1</span><br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

<br />
<span class="kw1">End</span> <span class="kw1">Function</span><br />
<br />
<span class="kw1">Public</span> <span class="kw1">Function</span> OpenFile<span class="br0">&#40;</span>lgHwnd <span class="kw1">As</span> <span class="kw1">Long</span>, stFiltre <span class="kw1">As</span> <span class="kw1">String</span>, FiltreParDefaut <span class="kw1">As</span> <span class="kw1">Long</span>, Optional lgFlags <span class="kw1">As</span> esFlags = OFN_EXPLORER + OFN_LONGNAMES + OFN_PATHMUSTEXIST, Optional stTitre <span class="kw1">As</span> <span class="kw1">String</span> = <span class="kw1">vbNullString</span>, Optional stInitFile <span class="kw1">As</span> <span class="kw1">String</span> = <span class="kw1">vbNullString</span>, Optional stInitDir <span class="kw1">As</span> <span class="kw1">String</span> = <span class="kw1">vbNullString</span>, Optional stDefautExt <span class="kw1">As</span> <span class="kw1">String</span> = <span class="kw1">vbNullString</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">String</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="co1">' Fenêtre &quot;Ouvrir un fichier&quot;.</span><br />

&nbsp; &nbsp; <span class="kw1">Dim</span> tyDialog <span class="kw1">As</span> OPENFILENAME<br />
<br />
&nbsp; &nbsp; tyDialog.<span class="me1">lStructSize</span> = <span class="kw1">Len</span><span class="br0">&#40;</span>tyDialog<span class="br0">&#41;</span><br />

&nbsp; &nbsp; tyDialog.<span class="me1">hWndOwner</span> = lgHwnd <span class="co1">' Handle du propriétraire de la fenêtre.</span><br />
&nbsp; &nbsp; tyDialog.<span class="me1">hInstance</span> = App.<span class="me1">hInstance</span><br />
&nbsp; &nbsp; tyDialog.<span class="me1">lpstrFilter</span> = Replace<span class="br0">&#40;</span>stFiltre, <span class="st0">&quot;|&quot;</span>, <span class="kw1">vbNullChar</span><span class="br0">&#41;</span> &amp; <span class="kw1">vbNullChar</span> &amp; <span class="kw1">vbNullChar</span><br />

&nbsp; &nbsp; tyDialog.<span class="me1">lpstrCustomFilter</span> = <span class="kw1">vbNullString</span> <span class="co1">' Filtre personnalisé (non géré).</span><br />
&nbsp; &nbsp; tyDialog.<span class="me1">nMaxCustFilter</span> = <span class="nu0">0</span> <span class="co1">' Index de filtre personnalisé (non géré).</span><br />

&nbsp; &nbsp; tyDialog.<span class="me1">nFilterIndex</span> = FiltreParDefaut &nbsp;<span class="co1">' Index du filtre à utiliser par défaut.</span><br />
&nbsp; &nbsp; tyDialog.<span class="me1">lpstrFile</span> = <span class="kw1">Left</span>$<span class="br0">&#40;</span>stInitFile &amp; <span class="kw1">String</span>$<span class="br0">&#40;</span><span class="nu0">1024</span>, <span class="kw1">vbNullChar</span><span class="br0">&#41;</span>, <span class="nu0">1024</span><span class="br0">&#41;</span> <span class="co1">' Nom de fichier affiché à l'initialisation de la fenêtre.</span><br />

&nbsp; &nbsp; tyDialog.<span class="me1">nMaxFile</span> = <span class="kw1">Len</span><span class="br0">&#40;</span>tyDialog.<span class="me1">lpstrFile</span><span class="br0">&#41;</span> - <span class="nu0">1</span> <span class="co1">' Longueur du nom de fichier.</span><br />
&nbsp; &nbsp; tyDialog.<span class="me1">lpstrFileTitle</span> = tyDialog.<span class="me1">lpstrFile</span> <span class="co1">' Nom et extension du fichier (sans chemin).</span><br />

&nbsp; &nbsp; tyDialog.<span class="me1">nMaxFileTitle</span> = tyDialog.<span class="me1">nMaxFile</span> <span class="co1">' Taille de la chaîne précédente.</span><br />
&nbsp; &nbsp; tyDialog.<span class="me1">lpstrInitialDir</span> = stInitDir <span class="co1">' Répertoire initial.</span><br />

&nbsp; &nbsp; tyDialog.<span class="me1">lpstrTitle</span> = stTitre <span class="co1">' Titre de la fenêtre.</span><br />
&nbsp; &nbsp; tyDialog.<span class="me1">flags</span> = lgFlags <span class="co1">' Flags pour affichage de la fenêtre.</span><br />
&nbsp; &nbsp; <span class="co1">'tyDialog.nFileOffset ' Position du nom du fichier dans la chaîne.</span><br />

&nbsp; &nbsp; <span class="co1">'tyDialog.nFileExtension ' Position de l'extension du fichier dans la chaîne.</span><br />
&nbsp; &nbsp; <span class="co1">' Extension par défaut ajoutée automatiquement si l'utilisateur l'oublie.</span><br />
&nbsp; &nbsp; tyDialog.<span class="me1">lpstrDefExt</span> = stDefautExt<br />
&nbsp; &nbsp; tyDialog.<span class="me1">lCustData</span> = <span class="nu0">0</span><br />

&nbsp; &nbsp; tyDialog.<span class="me1">lpfnHook</span> = <span class="nu0">0</span><br />
&nbsp; &nbsp; tyDialog.<span class="me1">lpTemplateName</span> = <span class="nu0">0</span><br />
&nbsp; &nbsp; <span class="co1">' Affichage de la boîte de dialogue.</span><br />

&nbsp; &nbsp; GetOpenFileName tyDialog<br />
&nbsp; &nbsp; <span class="co1">' Retourne le nom long du fichier.</span><br />
&nbsp; &nbsp; <span class="co1">'lgLastIdxFilter = tyDialog.nFilterIndex</span><br />
&nbsp; &nbsp; OpenFile = <span class="kw1">Left</span>$<span class="br0">&#40;</span>tyDialog.<span class="me1">lpstrFile</span>, <span class="kw1">InStr</span><span class="br0">&#40;</span><span class="nu0">1</span>, tyDialog.<span class="me1">lpstrFile</span>, <span class="kw1">vbNullChar</span><span class="br0">&#41;</span> - <span class="nu0">1</span><span class="br0">&#41;</span><br />

<span class="kw1">End</span> <span class="kw1">Function</span><br />
<br />
<span class="co1">'Retourne l'adresse d'un dossier : le dossier windows, le dossier mes documents et le dossier Bureau. Utilise SHGetSpecialFolderLocation</span><br />
<span class="kw1">Public</span> <span class="kw1">Function</span> GiveMePathOf<span class="br0">&#40;</span>FolderToFind <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">String</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">Dim</span> lRet <span class="kw1">As</span> <span class="kw1">Long</span>, IDL <span class="kw1">As</span> ITEMIDLIST, sPath <span class="kw1">As</span> <span class="kw1">String</span><br />

<br />
&nbsp; &nbsp; IDL.<span class="me1">mkid</span>.<span class="me1">abID</span> = <span class="nu0">0</span>: IDL.<span class="me1">mkid</span>.<span class="me1">CB</span> = <span class="nu0">0</span><br />

&nbsp; &nbsp; lRet = SHGetSpecialFolderLocation<span class="br0">&#40;</span><span class="nu0">100</span>&amp;, FolderToFind, IDL<span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> lRet = <span class="nu0">0</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; sPath = <span class="kw1">String</span>$<span class="br0">&#40;</span><span class="nu0">512</span>, <span class="kw1">Chr</span>$<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; lRet = SHGetPathFromIDList<span class="br0">&#40;</span>ByVal IDL.<span class="me1">mkid</span>.<span class="me1">CB</span>, ByVal sPath<span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; GiveMePathOf = <span class="kw1">Left</span>$<span class="br0">&#40;</span>sPath, <span class="kw1">InStr</span><span class="br0">&#40;</span>sPath, <span class="kw1">Chr</span>$<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span><span class="br0">&#41;</span> - <span class="nu0">1</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">Else</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; GiveMePathOf = <span class="st0">&quot;C:\&quot;</span><br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

<br />
<span class="kw1">End</span> <span class="kw1">Function</span><br />
<br />
<span class="co1">'Renvoie le minimum entre deux nombres...</span><br />
<span class="kw1">Public</span> <span class="kw1">Function</span> <span class="kw1">Min</span><span class="br0">&#40;</span>nb1 <span class="kw1">As</span> <span class="kw1">Long</span>, nb2 <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> nb1 &lt; nb2 <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Min</span> = nb1<br />
&nbsp; &nbsp; <span class="kw1">Else</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Min</span> = nb2<br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
<span class="kw1">End</span> <span class="kw1">Function</span><br />
<br />
<span class="co1">'Renvoie le maximum entre deux nombres...</span><br />
<span class="kw1">Public</span> <span class="kw1">Function</span> <span class="kw1">Max</span><span class="br0">&#40;</span>nb1 <span class="kw1">As</span> <span class="kw1">Long</span>, nb2 <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> nb1 &gt; nb2 <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Max</span> = nb1<br />
&nbsp; &nbsp; <span class="kw1">Else</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Max</span> = nb2<br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
<span class="kw1">End</span> <span class="kw1">Function</span><br />
<br />
<span class="co1">'Renvoie une chaine inconnue placée entre deux chaines connues. Principalement utilisée pour les fichiers LRC [by: et [ti:</span><br />
<span class="kw1">Public</span> <span class="kw1">Function</span> MyMid<span class="br0">&#40;</span>ByRef Expression <span class="kw1">As</span> <span class="kw1">String</span>, sLeft <span class="kw1">As</span> <span class="kw1">String</span>, sRight <span class="kw1">As</span> <span class="kw1">String</span>, Optional Start <span class="kw1">As</span> <span class="kw1">Long</span> = <span class="nu0">1</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">String</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">Dim</span> lPosL <span class="kw1">As</span> <span class="kw1">Long</span>, lPosR <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
&nbsp; &nbsp; lPosL = <span class="kw1">InStr</span><span class="br0">&#40;</span>Start, Expression, sLeft<span class="br0">&#41;</span>: lPosR = <span class="kw1">InStr</span><span class="br0">&#40;</span>lPosL + <span class="nu0">1</span>, Expression, sRight<span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> lPosL &gt; <span class="nu0">0</span> <span class="kw1">And</span> lPosR &gt; <span class="nu0">0</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; MyMid = <span class="kw1">Mid</span>$<span class="br0">&#40;</span>Expression, lPosL + <span class="kw1">Len</span><span class="br0">&#40;</span>sLeft<span class="br0">&#41;</span>, lPosR - lPosL - <span class="kw1">Len</span><span class="br0">&#40;</span>sLeft<span class="br0">&#41;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">Else</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; MyMid = <span class="kw1">vbNullString</span><br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
<span class="kw1">End</span> <span class="kw1">Function</span><br />

<br />
<span class="kw1">Public</span> <span class="kw1">Function</span> IsLink<span class="br0">&#40;</span>X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span>, RtfBox <span class="kw1">As</span> RichTextBox<span class="br0">&#41;</span> <span class="kw1">As</span> ResultConstant<br />

<span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> RtfBox.<span class="me1">Text</span> = <span class="st0">&quot;&quot;</span> <span class="kw1">Then</span> <span class="kw1">Exit</span> <span class="kw1">Function</span><br />

&nbsp; &nbsp; <span class="kw1">Dim</span> pt <span class="kw1">As</span> POINTAPI<br />
&nbsp; &nbsp; <span class="kw1">Dim</span> PosStart <span class="kw1">As</span> <span class="kw1">Long</span>, I <span class="kw1">As</span> <span class="kw1">Long</span>, Start <span class="kw1">As</span> <span class="kw1">Long</span>, Mot <span class="kw1">As</span> <span class="kw1">String</span>, Fin <span class="kw1">As</span> <span class="kw1">Long</span>, A <span class="kw1">As</span> <span class="kw1">Long</span><br />

&nbsp; &nbsp; pt.<span class="me1">X</span> = X \ Screen.<span class="me1">TwipsPerPixelX</span><br />
&nbsp; &nbsp; pt.<span class="me1">Y</span> = Y \ Screen.<span class="me1">TwipsPerPixelY</span><br />
&nbsp; &nbsp; PosStart = SendMessage<span class="br0">&#40;</span>RtfBox.<span class="me1">hwnd</span>, &amp;HD7, <span class="nu0">0</span>&amp;, pt<span class="br0">&#41;</span><br />

&nbsp; &nbsp; I = PosStart<br />
&nbsp; &nbsp; A = <span class="nu0">0</span><br />
&nbsp; &nbsp; <span class="kw1">Do</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Select <span class="kw1">Case</span> <span class="kw1">Mid</span><span class="br0">&#40;</span><span class="st0">&quot; &quot;</span> &amp; RtfBox.<span class="me1">Text</span>, I, <span class="nu0">1</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Case</span> <span class="st0">&quot; &quot;</span>, <span class="kw1">Chr</span><span class="br0">&#40;</span><span class="nu0">9</span><span class="br0">&#41;</span>, <span class="kw1">Chr</span><span class="br0">&#40;</span><span class="nu0">10</span><span class="br0">&#41;</span>, <span class="kw1">Chr</span><span class="br0">&#40;</span><span class="nu0">13</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Start = I: <span class="kw1">Exit</span> <span class="kw1">Do</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> Select<br />

&nbsp; &nbsp; &nbsp; &nbsp; I = I - <span class="nu0">1</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; A = A + <span class="nu0">1</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> A = <span class="nu0">100</span> <span class="kw1">Then</span> <span class="kw1">Exit</span> <span class="kw1">Do</span><br />

&nbsp; &nbsp; <span class="kw1">Loop</span><br />
&nbsp; &nbsp; I = PosStart<br />
&nbsp; &nbsp; A = <span class="nu0">0</span><br />
&nbsp; &nbsp; <span class="kw1">Do</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> I = <span class="kw1">Len</span><span class="br0">&#40;</span>RtfBox.<span class="me1">Text</span><span class="br0">&#41;</span> <span class="kw1">Then</span> Fin = I + <span class="nu0">1</span>: <span class="kw1">Exit</span> <span class="kw1">Do</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Select <span class="kw1">Case</span> <span class="kw1">Mid</span><span class="br0">&#40;</span><span class="st0">&quot; &quot;</span> &amp; RtfBox.<span class="me1">Text</span>, I, <span class="nu0">1</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Case</span> <span class="st0">&quot; &quot;</span>, <span class="kw1">Chr</span><span class="br0">&#40;</span><span class="nu0">9</span><span class="br0">&#41;</span>, <span class="kw1">Chr</span><span class="br0">&#40;</span><span class="nu0">10</span><span class="br0">&#41;</span>, <span class="kw1">Chr</span><span class="br0">&#40;</span><span class="nu0">13</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Fin = I: <span class="kw1">Exit</span> <span class="kw1">Do</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> Select<br />

&nbsp; &nbsp; &nbsp; &nbsp; I = I + <span class="nu0">1</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; A = A + <span class="nu0">1</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> A = <span class="nu0">100</span> <span class="kw1">Then</span> <span class="kw1">Exit</span> <span class="kw1">Do</span><br />

&nbsp; &nbsp; <span class="kw1">Loop</span><br />
&nbsp; &nbsp; Mot = <span class="kw1">Mid</span><span class="br0">&#40;</span>RtfBox.<span class="me1">Text</span>, Start, Fin - Start<span class="br0">&#41;</span><br />
&nbsp; &nbsp; IsLink.<span class="me1">URL</span> = <span class="kw1">vbNullString</span><br />

&nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">UCase</span><span class="br0">&#40;</span>Mot<span class="br0">&#41;</span> Like <span class="st0">&quot;*HTTP://*&quot;</span> <span class="kw1">Or</span> <span class="kw1">UCase</span><span class="br0">&#40;</span>Mot<span class="br0">&#41;</span> Like <span class="st0">&quot;*WWW.*&quot;</span> <span class="kw1">Then</span> IsLink.<span class="me1">EstUnLiens</span> = <span class="kw1">True</span>: IsLink.<span class="me1">URL</span> = Mot: <span class="kw1">Exit</span> <span class="kw1">Function</span><br />

&nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">UCase</span><span class="br0">&#40;</span>Mot<span class="br0">&#41;</span> Like <span class="st0">&quot;*MAILTO:*&quot;</span> <span class="kw1">Then</span> IsLink.<span class="me1">EstUnLiens</span> = <span class="kw1">True</span>: IsLink.<span class="me1">Email</span> = <span class="kw1">True</span>: IsLink.<span class="me1">URL</span> = <span class="kw1">Right</span><span class="br0">&#40;</span>Mot, <span class="kw1">Len</span><span class="br0">&#40;</span>Mot<span class="br0">&#41;</span> - <span class="nu0">7</span><span class="br0">&#41;</span>: <span class="kw1">Exit</span> <span class="kw1">Function</span><br />

&nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">UCase</span><span class="br0">&#40;</span>Mot<span class="br0">&#41;</span> Like <span class="st0">&quot;*@*&quot;</span> <span class="kw1">Then</span> IsLink.<span class="me1">EstUnLiens</span> = <span class="kw1">True</span>: IsLink.<span class="me1">Email</span> = <span class="kw1">True</span>: IsLink.<span class="me1">URL</span> = Mot<br />

<span class="kw1">End</span> <span class="kw1">Function</span><br />
<br />
&nbsp;</div></fieldset><h4>Subclassing</h4>
<p>Le module Subclassing, comme son nom l'indique, gère tout ce qui concerne le sous classement de l'application (et les graphiques donc).</p>
<fieldset>
<legend>Code source : <a href="Codes/Subclassing.bas" title="Télecharger le fichier">Subclassing.bas</a></legend>
<div class="vb" style="font-family: monospace;"><div class="head"><ul><li>Langage : <em>vb</em></li><li>&Delta;T : <em>0.158s</em></li><li>Taille :4632 caractères</li></ul></div>Attribute VB_Name = <span class="st0">&quot;Subclasser&quot;</span><br />

<span class="co1">'--------------------------------------------------------------------------------</span><br />
<span class="co1">' &nbsp; &nbsp;Component &nbsp;: Subclasser</span><br />
<span class="co1">' &nbsp; &nbsp;Project &nbsp; &nbsp;: TXT2JPG</span><br />
<span class="co1">'</span><br />
<span class="co1">' &nbsp; &nbsp;Description: Une petite sub qui s'occupe &quot;simplement&quot; de récupérer tout les messages envoyés par Windows à l'application, et en particulier les resize</span><br />

<span class="co1">'</span><br />
<span class="co1">' &nbsp; &nbsp;Modified &nbsp; :</span><br />
<span class="co1">'--------------------------------------------------------------------------------</span><br />
<span class="kw1">Option</span> <span class="kw1">Explicit</span><br />
<br />
<span class="kw1">Public</span> OldWindowProc <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="kw1">Public</span> myHDC <span class="kw1">As</span> <span class="kw1">Long</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> CallWindowProc Lib <span class="st0">&quot;user32&quot;</span> Alias <span class="st0">&quot;CallWindowProcA&quot;</span> <span class="br0">&#40;</span>ByVal lpPrevWndFunc <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal hwnd <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal msg <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal wParam <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal lParam <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="kw1">Public</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> SetWindowLong Lib <span class="st0">&quot;user32&quot;</span> Alias <span class="st0">&quot;SetWindowLongA&quot;</span> <span class="br0">&#40;</span>ByVal hwnd <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal nIndex <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal dwNewLong <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> GetProp Lib <span class="st0">&quot;user32.dll&quot;</span> Alias <span class="st0">&quot;GetPropA&quot;</span> <span class="br0">&#40;</span>ByVal hwnd <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal lpString <span class="kw1">As</span> <span class="kw1">String</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> SetProp Lib <span class="st0">&quot;user32.dll&quot;</span> Alias <span class="st0">&quot;SetPropA&quot;</span> <span class="br0">&#40;</span>ByVal hwnd <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal lpString <span class="kw1">As</span> <span class="kw1">String</span>, ByVal hData <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Sub</span> CopyMemory Lib <span class="st0">&quot;kernel32.dll&quot;</span> Alias <span class="st0">&quot;RtlMoveMemory&quot;</span> <span class="br0">&#40;</span>ByRef Destination <span class="kw1">As</span> Any, ByRef Source <span class="kw1">As</span> Any, ByVal Length <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span><br />

<br />
<span class="kw1">Public</span> <span class="kw1">Const</span> GWL_WNDPROC = <span class="br0">&#40;</span><span class="nu0">-4</span><span class="br0">&#41;</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Const</span> WM_GETMINMAXINFO <span class="kw1">As</span> <span class="kw1">Long</span> = &amp;H24<br />

<br />
<span class="kw1">Const</span> WM_NCDESTROY = &amp;H82<br />
<br />
<span class="kw1">Const</span> WM_SIZE = <span class="nu0">5</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Type</span> POINTAPI<br />

<br />
&nbsp; &nbsp; X <span class="kw1">As</span> <span class="kw1">Long</span><br />
&nbsp; &nbsp; Y <span class="kw1">As</span> <span class="kw1">Long</span><br />
<br />
<span class="kw1">End</span> <span class="kw1">Type</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Type</span> MINMAXINFO<br />
<br />
&nbsp; &nbsp; ptReserved <span class="kw1">As</span> POINTAPI<br />
&nbsp; &nbsp; ptMaxSize <span class="kw1">As</span> POINTAPI<br />

&nbsp; &nbsp; ptMaxPosition <span class="kw1">As</span> POINTAPI<br />
&nbsp; &nbsp; ptMinTrackSize <span class="kw1">As</span> POINTAPI<br />
&nbsp; &nbsp; ptMaxTrackSize <span class="kw1">As</span> POINTAPI<br />

<br />
<span class="kw1">End</span> <span class="kw1">Type</span><br />
<br />
<span class="kw1">Public</span> <span class="kw1">Sub</span> SetFormMinMaxSize<span class="br0">&#40;</span>Form <span class="kw1">As</span> Form, Optional MinWidth <span class="kw1">As</span> <span class="kw1">Long</span> = <span class="nu0">-1</span>, Optional MaxWidth <span class="kw1">As</span> <span class="kw1">Long</span> = <span class="nu0">-1</span>, Optional MinHeight <span class="kw1">As</span> <span class="kw1">Long</span> = <span class="nu0">-1</span>, Optional MaxHeight <span class="kw1">As</span> <span class="kw1">Long</span> = <span class="nu0">-1</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="co1">'Cette sub permet de spécifier à Windows une taille minimale pour l'application, au delà de laquelle est ne peut plus être réduite</span><br />
&nbsp; &nbsp; <span class="kw1">Dim</span> Provided <span class="kw1">As</span> <span class="kw1">Long</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

<br />
&nbsp; &nbsp; <span class="co1">'# On mémorise les dimensions, et on met a jour la liste des dimensions figées</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> MinWidth &lt;&gt; <span class="nu0">-1</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Provided = Provided <span class="kw1">Or</span> <span class="nu0">1</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'# On prend en compte le Scalemode de la form</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; SetProp Form.<span class="me1">hwnd</span>, <span class="st0">&quot;MINWIDTH&quot;</span>, Form.<span class="me1">ScaleX</span><span class="br0">&#40;</span>MinWidth, Form.<span class="me1">ScaleMode</span>, vbPixels<span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> MaxWidth &lt;&gt; <span class="nu0">-1</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Provided = Provided <span class="kw1">Or</span> <span class="nu0">2</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; SetProp Form.<span class="me1">hwnd</span>, <span class="st0">&quot;MAXWIDTH&quot;</span>, Form.<span class="me1">ScaleX</span><span class="br0">&#40;</span>MaxWidth, Form.<span class="me1">ScaleMode</span>, vbPixels<span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> MinHeight &lt;&gt; <span class="nu0">-1</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Provided = Provided <span class="kw1">Or</span> <span class="nu0">4</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; SetProp Form.<span class="me1">hwnd</span>, <span class="st0">&quot;MINHEIGHT&quot;</span>, Form.<span class="me1">ScaleY</span><span class="br0">&#40;</span>MinHeight, Form.<span class="me1">ScaleMode</span>, vbPixels<span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> MaxHeight &lt;&gt; <span class="nu0">-1</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Provided = Provided <span class="kw1">Or</span> <span class="nu0">8</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; SetProp Form.<span class="me1">hwnd</span>, <span class="st0">&quot;MAXHEIGHT&quot;</span>, Form.<span class="me1">ScaleY</span><span class="br0">&#40;</span>MaxHeight, Form.<span class="me1">ScaleMode</span>, vbPixels<span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; SetProp Form.<span class="me1">hwnd</span>, <span class="st0">&quot;MINMAX&quot;</span>, Provided<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />

<br />
<span class="co1">' Display message names.</span><br />
<span class="kw1">Public</span> <span class="kw1">Function</span> NewWindowProc<span class="br0">&#40;</span>ByVal hwnd <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal msg <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal wParam <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal lParam <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">Dim</span> MinMax &nbsp; <span class="kw1">As</span> MINMAXINFO<br />

<br />
&nbsp; &nbsp; <span class="kw1">Dim</span> Provided <span class="kw1">As</span> <span class="kw1">Long</span><br />
<br />
&nbsp; &nbsp; <span class="co1">'Debug.Print Hex$(msg)</span><br />
&nbsp; &nbsp; Select <span class="kw1">Case</span> msg<br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Case</span> WM_SIZE <span class="co1">'La feuille a été redimensionnée</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Principale.<span class="me1">Form_TailleChange</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Principale.<span class="me1">Form_Redraw</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Case</span> WM_GETMINMAXINFO<br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'# Liste des dimensions figées</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Provided = GetProp<span class="br0">&#40;</span>hwnd, <span class="st0">&quot;MINMAX&quot;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'# On recupere les infos deja presentes</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; CopyMemory MinMax, ByVal lParam, <span class="kw1">Len</span><span class="br0">&#40;</span>MinMax<span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'# On met a jour les dimensions</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="br0">&#40;</span>Provided <span class="kw1">And</span> <span class="nu0">1</span><span class="br0">&#41;</span> &lt;&gt; <span class="nu0">0</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; MinMax.<span class="me1">ptMinTrackSize</span>.<span class="me1">X</span> = GetProp<span class="br0">&#40;</span>hwnd, <span class="st0">&quot;MINWIDTH&quot;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="br0">&#40;</span>Provided <span class="kw1">And</span> <span class="nu0">2</span><span class="br0">&#41;</span> &lt;&gt; <span class="nu0">0</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; MinMax.<span class="me1">ptMaxTrackSize</span>.<span class="me1">X</span> = GetProp<span class="br0">&#40;</span>hwnd, <span class="st0">&quot;MAXWIDTH&quot;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="br0">&#40;</span>Provided <span class="kw1">And</span> <span class="nu0">4</span><span class="br0">&#41;</span> &lt;&gt; <span class="nu0">0</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; MinMax.<span class="me1">ptMinTrackSize</span>.<span class="me1">Y</span> = GetProp<span class="br0">&#40;</span>hwnd, <span class="st0">&quot;MINHEIGHT&quot;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> <span class="br0">&#40;</span>Provided <span class="kw1">And</span> <span class="nu0">8</span><span class="br0">&#41;</span> &lt;&gt; <span class="nu0">0</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; MinMax.<span class="me1">ptMaxTrackSize</span>.<span class="me1">Y</span> = GetProp<span class="br0">&#40;</span>hwnd, <span class="st0">&quot;MAXHEIGHT&quot;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'# On réinsère le tout...</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; CopyMemory ByVal lParam, MinMax, <span class="kw1">Len</span><span class="br0">&#40;</span>MinMax<span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="co1">'# On ne repasse pas par la procédure classique...</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; NewWindowProc = <span class="nu0">0</span>&amp;<br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Exit</span> <span class="kw1">Function</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Case</span> WM_NCDESTROY &nbsp; <span class="co1">'Rétablir la bonne sub de classe :</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SetWindowLong hwnd, GWL_WNDPROC, OldWindowProc<br />

&nbsp; &nbsp; <span class="kw1">End</span> Select<br />
<br />
&nbsp; &nbsp; <span class="co1">'Transférer le message</span><br />
&nbsp; &nbsp; NewWindowProc = CallWindowProc<span class="br0">&#40;</span>OldWindowProc, hwnd, msg, wParam, lParam<span class="br0">&#41;</span><br />
<span class="kw1">End</span> <span class="kw1">Function</span><br />

&nbsp;</div></fieldset>
<h3>Les contrôles :</h3>
<h4>Bouton</h4>
<p>Les boutons "Vista Like".</p>
<fieldset>
<legend>Code source : <a href="Codes/AfBtn.ctl" title="Télecharger le fichier">AfBtn.ctl</a></legend>
<div class="vb" style="font-family: monospace;"><div class="head"><ul><li>Langage : <em>vb</em></li><li>&Delta;T : <em>0.320s</em></li><li>Taille :8247 caractères</li></ul></div>VERSION <span class="nu0">5.00</span><br />

Begin VB.<span class="me1">UserControl</span> Bouton <br />
&nbsp; &nbsp;ClientHeight &nbsp; &nbsp;= &nbsp; <span class="nu0">2535</span><br />
&nbsp; &nbsp;ClientLeft &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">0</span><br />

&nbsp; &nbsp;ClientTop &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">0</span><br />
&nbsp; &nbsp;ClientWidth &nbsp; &nbsp; = &nbsp; <span class="nu0">4365</span><br />

&nbsp; &nbsp;MaskColor &nbsp; &nbsp; &nbsp; = &nbsp; &amp;H00C0C0C0&amp;<br />
&nbsp; &nbsp;ScaleHeight &nbsp; &nbsp; = &nbsp; <span class="nu0">2535</span><br />

&nbsp; &nbsp;ScaleWidth &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">4365</span><br />
&nbsp; &nbsp;ToolboxBitmap &nbsp; = &nbsp; <span class="st0">&quot;AfBtn.ctx&quot;</span>:<span class="nu0">0000</span><br />

&nbsp; &nbsp;Begin VB.<span class="kw1">Timer</span> Tmr_OO <br />
&nbsp; &nbsp; &nbsp; Enabled &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">0</span> &nbsp; <span class="co1">'False</span><br />

&nbsp; &nbsp; &nbsp; Interval &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">100</span><br />
&nbsp; &nbsp; &nbsp; <span class="kw1">Left</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">2205</span><br />

&nbsp; &nbsp; &nbsp; Top &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">735</span><br />
&nbsp; &nbsp;<span class="kw1">End</span><br />

&nbsp; &nbsp;Begin VB.<span class="me1">Image</span> IMG_mouse <br />
&nbsp; &nbsp; &nbsp; Height &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">1065</span><br />

&nbsp; &nbsp; &nbsp; <span class="kw1">Left</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">1575</span><br />
&nbsp; &nbsp; &nbsp; Picture &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="st0">&quot;AfBtn.ctx&quot;</span>:<span class="nu0">0312</span><br />

&nbsp; &nbsp; &nbsp; Stretch &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">-1</span> &nbsp;<span class="co1">'True</span><br />
&nbsp; &nbsp; &nbsp; Top &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">1155</span><br />

&nbsp; &nbsp; &nbsp; <span class="kw1">Width</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">2325</span><br />
&nbsp; &nbsp;<span class="kw1">End</span><br />

&nbsp; &nbsp;Begin VB.<span class="me1">Image</span> IMG_nomouse <br />
&nbsp; &nbsp; &nbsp; Height &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">1065</span><br />

&nbsp; &nbsp; &nbsp; <span class="kw1">Left</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">105</span><br />
&nbsp; &nbsp; &nbsp; Picture &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="st0">&quot;AfBtn.ctx&quot;</span>:<span class="nu0">2484</span><br />

&nbsp; &nbsp; &nbsp; Stretch &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">-1</span> &nbsp;<span class="co1">'True</span><br />
&nbsp; &nbsp; &nbsp; Top &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">1155</span><br />

&nbsp; &nbsp; &nbsp; <span class="kw1">Width</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">2310</span><br />
&nbsp; &nbsp;<span class="kw1">End</span><br />

&nbsp; &nbsp;Begin VB.<span class="me1">Label</span> Lbl_Btn <br />
&nbsp; &nbsp; &nbsp; Alignment &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">2</span> &nbsp;<span class="co1">'Center</span><br />

&nbsp; &nbsp; &nbsp; Appearance &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">0</span> &nbsp;<span class="co1">'Flat</span><br />
&nbsp; &nbsp; &nbsp; BackColor &nbsp; &nbsp; &nbsp; = &nbsp; &amp;H80000005&amp;<br />

&nbsp; &nbsp; &nbsp; Caption &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="st0">&quot;Btn XP&quot;</span><br />
&nbsp; &nbsp; &nbsp; BeginProperty Font <br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<span class="kw1">Name</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="st0">&quot;Tahoma&quot;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Size &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">12</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Charset &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">0</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Weight &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">400</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Underline &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">0</span> &nbsp; <span class="co1">'False</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Italic &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">0</span> &nbsp; <span class="co1">'False</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Strikethrough &nbsp; = &nbsp; <span class="nu0">0</span> &nbsp; <span class="co1">'False</span><br />
&nbsp; &nbsp; &nbsp; EndProperty<br />

&nbsp; &nbsp; &nbsp; ForeColor &nbsp; &nbsp; &nbsp; = &nbsp; &amp;H80000008&amp;<br />
&nbsp; &nbsp; &nbsp; Height &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">375</span><br />

&nbsp; &nbsp; &nbsp; <span class="kw1">Left</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">0</span><br />
&nbsp; &nbsp; &nbsp; TabIndex &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">0</span><br />

&nbsp; &nbsp; &nbsp; Top &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">240</span><br />
&nbsp; &nbsp; &nbsp; <span class="kw1">Width</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">2655</span><br />

&nbsp; &nbsp;<span class="kw1">End</span><br />
&nbsp; &nbsp;Begin VB.<span class="me1">Image</span> Img_Btn <br />
&nbsp; &nbsp; &nbsp; Height &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">1170</span><br />

&nbsp; &nbsp; &nbsp; <span class="kw1">Left</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">0</span><br />
&nbsp; &nbsp; &nbsp; Stretch &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">-1</span> &nbsp;<span class="co1">'True</span><br />

&nbsp; &nbsp; &nbsp; Top &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">0</span><br />
&nbsp; &nbsp; &nbsp; <span class="kw1">Width</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">2640</span><br />

&nbsp; &nbsp;<span class="kw1">End</span><br />
<span class="kw1">End</span><br />
Attribute VB_Name = <span class="st0">&quot;Bouton&quot;</span><br />
Attribute VB_GlobalNameSpace = <span class="kw1">False</span><br />
Attribute VB_Creatable = <span class="kw1">True</span><br />
Attribute VB_PredeclaredId = <span class="kw1">False</span><br />

Attribute VB_Exposed = <span class="kw1">False</span><br />
<span class="co1">'--------------------------------------------------------------------------------</span><br />
<span class="co1">' &nbsp; &nbsp;Component &nbsp;: Bouton</span><br />
<span class="co1">' &nbsp; &nbsp;Project &nbsp; &nbsp;: TXT2JPG</span><br />
<span class="co1">'</span><br />

<span class="co1">' &nbsp; &nbsp;Description: Un bouton &quot;a la vista&quot;, qui gère mouse over et mouseout</span><br />
<span class="co1">'</span><br />
<span class="co1">' &nbsp; &nbsp;Modified &nbsp; :</span><br />
<span class="co1">'--------------------------------------------------------------------------------</span><br />
<span class="kw1">Option</span> <span class="kw1">Explicit</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Type</span> POINTAPI<br />
&nbsp; &nbsp; x &nbsp; &nbsp; &nbsp; <span class="kw1">As</span> <span class="kw1">Long</span><br />

&nbsp; &nbsp; y &nbsp; &nbsp; &nbsp; <span class="kw1">As</span> <span class="kw1">Long</span><br />
<span class="kw1">End</span> <span class="kw1">Type</span><br />
<br />
<span class="co1">'</span><br />

<span class="kw1">Private</span> mEnabled <span class="kw1">As</span> <span class="kw1">Boolean</span><br />
<br />
<span class="kw1">Private</span> mTaille &nbsp;<span class="kw1">As</span> <span class="kw1">Long</span><br />
<br />
<span class="kw1">Dim</span> bDown &nbsp; &nbsp; &nbsp; &nbsp;<span class="kw1">As</span> <span class="kw1">Boolean</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> GetCursorPos Lib <span class="st0">&quot;user32&quot;</span> <span class="br0">&#40;</span>lpPoint <span class="kw1">As</span> POINTAPI<span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> WindowFromPoint Lib <span class="st0">&quot;user32&quot;</span> <span class="br0">&#40;</span>ByVal xPoint <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal yPoint <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="kw1">Public</span> <span class="kw1">Event</span> Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
Attribute Click.<span class="me1">VB_MemberFlags</span> = <span class="st0">&quot;200&quot;</span><br />
<br />
<span class="kw1">Public</span> <span class="kw1">Event</span> MouseDown<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, x <span class="kw1">As</span> <span class="kw1">Single</span>, y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

<br />
<span class="kw1">Public</span> <span class="kw1">Event</span> MouseUp<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, x <span class="kw1">As</span> <span class="kw1">Single</span>, y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

<br />
<span class="kw1">Public</span> <span class="kw1">Event</span> MouseMove<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, x <span class="kw1">As</span> <span class="kw1">Single</span>, y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

<br />
<span class="kw1">Public</span> <span class="kw1">Property</span> <span class="kw1">Get</span> Caption<span class="br0">&#40;</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">String</span><br />
Attribute Caption.<span class="me1">VB_UserMemId</span> = <span class="nu0">-518</span><br />

Attribute Caption.<span class="me1">VB_MemberFlags</span> = <span class="st0">&quot;200&quot;</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

<br />
&nbsp; &nbsp; Caption = Lbl_Btn.<span class="me1">Caption</span><br />
<span class="kw1">End</span> <span class="kw1">Property</span><br />
<br />
<span class="kw1">Public</span> <span class="kw1">Property</span> <span class="kw1">Let</span> Caption<span class="br0">&#40;</span>ByVal new_mCaption <span class="kw1">As</span> <span class="kw1">String</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; Lbl_Btn.<span class="me1">Caption</span> = new_mCaption<br />

&nbsp; &nbsp; PropertyChanged <span class="st0">&quot;Caption&quot;</span><br />
<span class="kw1">End</span> <span class="kw1">Property</span><br />
<br />
<span class="kw1">Public</span> <span class="kw1">Property</span> <span class="kw1">Get</span> Taille<span class="br0">&#40;</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; Taille = Lbl_Btn.<span class="me1">FontSize</span><br />

<span class="kw1">End</span> <span class="kw1">Property</span><br />
<br />
<span class="kw1">Public</span> <span class="kw1">Property</span> <span class="kw1">Let</span> Taille<span class="br0">&#40;</span>ByVal New_Size <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; Lbl_Btn.<span class="me1">FontSize</span> = New_Size<br />

&nbsp; &nbsp; mTaille = New_Size<br />
&nbsp; &nbsp; PropertyChanged <span class="st0">&quot;Taille&quot;</span><br />
<span class="kw1">End</span> <span class="kw1">Property</span><br />
<br />
<span class="kw1">Public</span> <span class="kw1">Property</span> <span class="kw1">Get</span> hwnd<span class="br0">&#40;</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; hwnd = UserControl.<span class="me1">hwnd</span><br />

<span class="kw1">End</span> <span class="kw1">Property</span><br />
<br />
<span class="kw1">Public</span> <span class="kw1">Property</span> <span class="kw1">Get</span> hdc<span class="br0">&#40;</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; hdc = UserControl.<span class="me1">hdc</span><br />

<span class="kw1">End</span> <span class="kw1">Property</span><br />
<br />
<span class="kw1">Public</span> <span class="kw1">Property</span> <span class="kw1">Get</span> Enabled<span class="br0">&#40;</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Boolean</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; Enabled = mEnabled<br />
<span class="kw1">End</span> <span class="kw1">Property</span><br />

<br />
<span class="kw1">Public</span> <span class="kw1">Property</span> <span class="kw1">Let</span> Enabled<span class="br0">&#40;</span>ByVal new_mEnabled <span class="kw1">As</span> <span class="kw1">Boolean</span><span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

<br />
&nbsp; &nbsp; mEnabled = new_mEnabled<br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> mEnabled <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Lbl_Btn.<span class="me1">ForeColor</span> = <span class="kw1">vbBlack</span><br />

&nbsp; &nbsp; <span class="kw1">Else</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Lbl_Btn.<span class="me1">ForeColor</span> = &amp;HC0C0C0<br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

&nbsp; &nbsp; PropertyChanged <span class="st0">&quot;Enabled&quot;</span><br />
<span class="kw1">End</span> <span class="kw1">Property</span><br />
<br />
<span class="kw1">Public</span> <span class="kw1">Property</span> <span class="kw1">Let</span> TimerState<span class="br0">&#40;</span>ByVal nValue <span class="kw1">As</span> <span class="kw1">Boolean</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; Tmr_OO.<span class="me1">Enabled</span> = nValue<br />

&nbsp; &nbsp; PropertyChanged <span class="st0">&quot;TimerState&quot;</span><br />
<span class="kw1">End</span> <span class="kw1">Property</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> UserControl_InitProperties<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
<br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; Caption = Lbl_Btn.<span class="me1">Caption</span><br />
&nbsp; &nbsp; Taille = Lbl_Btn.<span class="me1">FontSize</span><br />

&nbsp; &nbsp; mEnabled = <span class="kw1">True</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="co1">'</span><br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> UserControl_ReadProperties<span class="br0">&#40;</span>PropBag <span class="kw1">As</span> PropertyBag<span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; Caption = PropBag.<span class="me1">ReadProperty</span><span class="br0">&#40;</span><span class="st0">&quot;Caption&quot;</span>, Lbl_Btn.<span class="me1">Caption</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; Enabled = PropBag.<span class="me1">ReadProperty</span><span class="br0">&#40;</span><span class="st0">&quot;Enabled&quot;</span>, <span class="kw1">True</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; Taille = PropBag.<span class="me1">ReadProperty</span><span class="br0">&#40;</span><span class="st0">&quot;Taille&quot;</span>, Lbl_Btn.<span class="me1">FontSize</span><span class="br0">&#41;</span><br />
<br />

&nbsp; &nbsp; <span class="kw1">If</span> UserControl.<span class="me1">Ambient</span>.<span class="me1">UserMode</span> <span class="kw1">Then</span> Tmr_OO.<span class="me1">Enabled</span> = <span class="kw1">True</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="co1">'</span><br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> UserControl_WriteProperties<span class="br0">&#40;</span>PropBag <span class="kw1">As</span> PropertyBag<span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; PropBag.<span class="me1">WriteProperty</span> <span class="st0">&quot;Caption&quot;</span>, Lbl_Btn.<span class="me1">Caption</span>, <span class="st0">&quot;Btn XP&quot;</span><br />

&nbsp; &nbsp; PropBag.<span class="me1">WriteProperty</span> <span class="st0">&quot;Enabled&quot;</span>, mEnabled, <span class="kw1">True</span><br />
&nbsp; &nbsp; PropBag.<span class="me1">WriteProperty</span> <span class="st0">&quot;Taille&quot;</span>, mTaille, Lbl_Btn.<span class="me1">FontSize</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="co1">'</span><br />
<span class="co1">'</span><br />
<span class="co1">' &nbsp; *- INIT/RESIZE/TERMINATE -*</span><br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> UserControl_Initialize<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; Lbl_Btn.<span class="me1">BackStyle</span> = <span class="nu0">0</span><br />

&nbsp; &nbsp; Img_Btn.<span class="me1">Picture</span> = IMG_nomouse.<span class="me1">Picture</span><br />
&nbsp; &nbsp; Lbl_Btn.<span class="me1">FontSize</span> = <span class="kw1">Me</span>.<span class="me1">Taille</span><br />

&nbsp; &nbsp; <span class="kw1">Me</span>.<span class="me1">TimerState</span> = <span class="kw1">False</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="co1">'</span><br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> UserControl_Resize<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="co1">'If UserControl.Width &lt; 300 Then UserControl.Width = 300</span><br />

&nbsp; &nbsp; <span class="co1">'If UserControl.Height &lt; 200 Then UserControl.Height = 200</span><br />
&nbsp; &nbsp; Img_Btn.<span class="kw1">Width</span> = UserControl.<span class="kw1">Width</span><br />
&nbsp; &nbsp; Img_Btn.<span class="me1">Height</span> = UserControl.<span class="me1">Height</span><br />

&nbsp; &nbsp; Lbl_Btn.<span class="kw1">Width</span> = UserControl.<span class="kw1">Width</span><br />
&nbsp; &nbsp; Lbl_Btn.<span class="me1">Top</span> = <span class="br0">&#40;</span>UserControl.<span class="me1">Height</span> \ <span class="nu0">2</span><span class="br0">&#41;</span> - <span class="br0">&#40;</span>Lbl_Btn.<span class="me1">Height</span> \ <span class="nu0">2</span><span class="br0">&#41;</span> + <span class="nu0">30</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">If</span> UserControl.<span class="me1">Ambient</span>.<span class="me1">UserMode</span> <span class="kw1">Then</span> <span class="kw1">Me</span>.<span class="me1">TimerState</span> = <span class="kw1">True</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="co1">'</span><br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> UserControl_Terminate<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

<br />
&nbsp; &nbsp; Tmr_OO.<span class="me1">Enabled</span> = <span class="kw1">False</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="co1">'</span><br />
<span class="co1">'</span><br />

<span class="co1">' &nbsp; *- EVENTS -*</span><br />
<span class="co1">'CLICK :</span><br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Img_Btn_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">If</span> mEnabled <span class="kw1">Then</span> <span class="kw1">RaiseEvent</span> Click<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />

<span class="kw1">Private</span> <span class="kw1">Sub</span> Lbl_Btn_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">If</span> mEnabled <span class="kw1">Then</span> <span class="kw1">RaiseEvent</span> Click<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />

<span class="co1">'MouseDown</span><br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Img_Btn_MouseDown<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, x <span class="kw1">As</span> <span class="kw1">Single</span>, y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> mEnabled <span class="kw1">Then</span> bDown = <span class="kw1">True</span>: <span class="kw1">RaiseEvent</span> MouseDown<span class="br0">&#40;</span>Button, Shift, x, y<span class="br0">&#41;</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Lbl_Btn_MouseDown<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, x <span class="kw1">As</span> <span class="kw1">Single</span>, y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> mEnabled <span class="kw1">Then</span> bDown = <span class="kw1">True</span>: <span class="kw1">RaiseEvent</span> MouseDown<span class="br0">&#40;</span>Button, Shift, x, y<span class="br0">&#41;</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="co1">'Mouse Up</span><br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Img_Btn_MouseUp<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, x <span class="kw1">As</span> <span class="kw1">Single</span>, y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> mEnabled <span class="kw1">Then</span> bDown = <span class="kw1">False</span>: <span class="kw1">RaiseEvent</span> MouseUp<span class="br0">&#40;</span>Button, Shift, x, y<span class="br0">&#41;</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Lbl_Btn_MouseUp<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, x <span class="kw1">As</span> <span class="kw1">Single</span>, y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> mEnabled <span class="kw1">Then</span> bDown = <span class="kw1">False</span>: <span class="kw1">RaiseEvent</span> MouseUp<span class="br0">&#40;</span>Button, Shift, x, y<span class="br0">&#41;</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="co1">'MOUSEMOVE</span><br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Img_Btn_MouseMove<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, x <span class="kw1">As</span> <span class="kw1">Single</span>, y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; Tmr_OO.<span class="me1">Enabled</span> = <span class="kw1">True</span><br />

&nbsp; &nbsp; <span class="kw1">RaiseEvent</span> MouseMove<span class="br0">&#40;</span>Button, Shift, x, y<span class="br0">&#41;</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Lbl_Btn_MouseMove<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, x <span class="kw1">As</span> <span class="kw1">Single</span>, y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; Tmr_OO.<span class="me1">Enabled</span> = <span class="kw1">True</span><br />

&nbsp; &nbsp; <span class="kw1">RaiseEvent</span> MouseMove<span class="br0">&#40;</span>Button, Shift, x, y<span class="br0">&#41;</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="co1">'Hover</span><br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Tmr_OO_Timer<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> mEnabled <span class="kw1">Then</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Dim</span> pPos <span class="kw1">As</span> POINTAPI, lHwnd <span class="kw1">As</span> <span class="kw1">Long</span><br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; pPos.<span class="me1">x</span> = <span class="nu0">0</span>: pPos.<span class="me1">y</span> = <span class="nu0">0</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Call</span> GetCursorPos<span class="br0">&#40;</span>pPos<span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; lHwnd = WindowFromPoint<span class="br0">&#40;</span>pPos.<span class="me1">x</span>, pPos.<span class="me1">y</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> lHwnd = UserControl.<span class="me1">hwnd</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Img_Btn.<span class="me1">Picture</span> = IMG_mouse.<span class="me1">Picture</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Lbl_Btn.<span class="me1">ForeColor</span> = <span class="kw1">IIf</span><span class="br0">&#40;</span>bDown, <span class="kw1">vbBlue</span>, <span class="kw1">vbRed</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Else</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Img_Btn.<span class="me1">Picture</span> = IMG_nomouse.<span class="me1">Picture</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Lbl_Btn.<span class="me1">ForeColor</span> = <span class="kw1">vbBlack</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Tmr_OO.<span class="me1">Enabled</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
&nbsp;</div></fieldset><h4>Case à cocher</h4>
<p>Les check box relookées.</p>
<fieldset>
<legend>Code source : <a href="Codes/CheckBoxPlus.ctl" title="Télecharger le fichier">CheckBoxPlus.ctl</a></legend>

<div class="vb" style="font-family: monospace;"><div class="head"><ul><li>Langage : <em>vb</em></li><li>&Delta;T : <em>0.162s</em></li><li>Taille :6746 caractères</li></ul></div>VERSION <span class="nu0">5.00</span><br />
Begin VB.<span class="me1">UserControl</span> CheckBoxPlus <br />
&nbsp; &nbsp;BackColor &nbsp; &nbsp; &nbsp; = &nbsp; &amp;H80000008&amp;<br />

&nbsp; &nbsp;ClientHeight &nbsp; &nbsp;= &nbsp; <span class="nu0">495</span><br />
&nbsp; &nbsp;ClientLeft &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">0</span><br />
&nbsp; &nbsp;ClientTop &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">0</span><br />

&nbsp; &nbsp;ClientWidth &nbsp; &nbsp; = &nbsp; <span class="nu0">1185</span><br />
&nbsp; &nbsp;ForeColor &nbsp; &nbsp; &nbsp; = &nbsp; &amp;H8000000B&amp;<br />

&nbsp; &nbsp;ScaleHeight &nbsp; &nbsp; = &nbsp; <span class="nu0">495</span><br />
&nbsp; &nbsp;ScaleWidth &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">1185</span><br />
&nbsp; &nbsp;Begin VB.<span class="kw1">Timer</span> Tmr_OO <br />

&nbsp; &nbsp; &nbsp; Enabled &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">0</span> &nbsp; <span class="co1">'False</span><br />
&nbsp; &nbsp; &nbsp; Interval &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">100</span><br />

&nbsp; &nbsp; &nbsp; <span class="kw1">Left</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">1155</span><br />
&nbsp; &nbsp; &nbsp; Top &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">420</span><br />

&nbsp; &nbsp;<span class="kw1">End</span><br />
&nbsp; &nbsp;Begin VB.<span class="me1">Image</span> CheckData <br />
&nbsp; &nbsp; &nbsp; Height &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">195</span><br />

&nbsp; &nbsp; &nbsp; Index &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">4</span><br />
&nbsp; &nbsp; &nbsp; <span class="kw1">Left</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">945</span><br />

&nbsp; &nbsp; &nbsp; Picture &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="st0">&quot;CheckBoxPlus.ctx&quot;</span>:<span class="nu0">0000</span><br />
&nbsp; &nbsp; &nbsp; Top &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">0</span><br />

&nbsp; &nbsp; &nbsp; <span class="kw1">Width</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">195</span><br />
&nbsp; &nbsp;<span class="kw1">End</span><br />

&nbsp; &nbsp;Begin VB.<span class="me1">Image</span> CheckData <br />
&nbsp; &nbsp; &nbsp; Height &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">195</span><br />

&nbsp; &nbsp; &nbsp; Index &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">6</span><br />
&nbsp; &nbsp; &nbsp; <span class="kw1">Left</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">630</span><br />

&nbsp; &nbsp; &nbsp; Picture &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="st0">&quot;CheckBoxPlus.ctx&quot;</span>:024A<br />
&nbsp; &nbsp; &nbsp; Top &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">0</span><br />

&nbsp; &nbsp; &nbsp; <span class="kw1">Width</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">195</span><br />
&nbsp; &nbsp;<span class="kw1">End</span><br />

&nbsp; &nbsp;Begin VB.<span class="me1">Image</span> CheckData <br />
&nbsp; &nbsp; &nbsp; Height &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">195</span><br />

&nbsp; &nbsp; &nbsp; Index &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">3</span><br />
&nbsp; &nbsp; &nbsp; <span class="kw1">Left</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">945</span><br />

&nbsp; &nbsp; &nbsp; Picture &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="st0">&quot;CheckBoxPlus.ctx&quot;</span>:<span class="nu0">0494</span><br />
&nbsp; &nbsp; &nbsp; Top &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">315</span><br />

&nbsp; &nbsp; &nbsp; <span class="kw1">Width</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">195</span><br />
&nbsp; &nbsp;<span class="kw1">End</span><br />

&nbsp; &nbsp;Begin VB.<span class="me1">Image</span> CheckData <br />
&nbsp; &nbsp; &nbsp; Height &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">195</span><br />

&nbsp; &nbsp; &nbsp; Index &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">2</span><br />
&nbsp; &nbsp; &nbsp; <span class="kw1">Left</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">630</span><br />

&nbsp; &nbsp; &nbsp; Picture &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="st0">&quot;CheckBoxPlus.ctx&quot;</span>:06DE<br />
&nbsp; &nbsp; &nbsp; Top &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">315</span><br />

&nbsp; &nbsp; &nbsp; <span class="kw1">Width</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">195</span><br />
&nbsp; &nbsp;<span class="kw1">End</span><br />

&nbsp; &nbsp;Begin VB.<span class="me1">Image</span> CheckData <br />
&nbsp; &nbsp; &nbsp; Height &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">195</span><br />

&nbsp; &nbsp; &nbsp; Index &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">1</span><br />
&nbsp; &nbsp; &nbsp; <span class="kw1">Left</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">315</span><br />

&nbsp; &nbsp; &nbsp; Picture &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="st0">&quot;CheckBoxPlus.ctx&quot;</span>:<span class="nu0">0928</span><br />
&nbsp; &nbsp; &nbsp; Top &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">315</span><br />

&nbsp; &nbsp; &nbsp; <span class="kw1">Width</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">195</span><br />
&nbsp; &nbsp;<span class="kw1">End</span><br />

&nbsp; &nbsp;Begin VB.<span class="me1">Image</span> CheckData <br />
&nbsp; &nbsp; &nbsp; Height &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">195</span><br />

&nbsp; &nbsp; &nbsp; Index &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">0</span><br />
&nbsp; &nbsp; &nbsp; <span class="kw1">Left</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">0</span><br />

&nbsp; &nbsp; &nbsp; Picture &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="st0">&quot;CheckBoxPlus.ctx&quot;</span>:0B72<br />
&nbsp; &nbsp; &nbsp; Top &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">315</span><br />

&nbsp; &nbsp; &nbsp; <span class="kw1">Width</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">195</span><br />
&nbsp; &nbsp;<span class="kw1">End</span><br />

&nbsp; &nbsp;Begin VB.<span class="me1">Image</span> Check <br />
&nbsp; &nbsp; &nbsp; Height &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">195</span><br />

&nbsp; &nbsp; &nbsp; <span class="kw1">Left</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">0</span><br />
&nbsp; &nbsp; &nbsp; Top &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">0</span><br />

&nbsp; &nbsp; &nbsp; <span class="kw1">Width</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">195</span><br />
&nbsp; &nbsp;<span class="kw1">End</span><br />

<span class="kw1">End</span><br />
Attribute VB_Name = <span class="st0">&quot;CheckBoxPlus&quot;</span><br />
Attribute VB_GlobalNameSpace = <span class="kw1">False</span><br />
Attribute VB_Creatable = <span class="kw1">True</span><br />
Attribute VB_PredeclaredId = <span class="kw1">False</span><br />
Attribute VB_Exposed = <span class="kw1">False</span><br />

<span class="co1">'--------------------------------------------------------------------------------</span><br />
<span class="co1">' &nbsp; &nbsp;Component &nbsp;: CheckBoxPlus</span><br />
<span class="co1">' &nbsp; &nbsp;Project &nbsp; &nbsp;: TXT2JPG</span><br />
<span class="co1">'</span><br />
<span class="co1">' &nbsp; &nbsp;Description: Un chackbox avec moins do'ptions que l'original, mais des graphismes différents. Un bon compromis pour économiser du poids au projet.</span><br />

<span class="co1">'</span><br />
<span class="co1">' &nbsp; &nbsp;Modified &nbsp; :</span><br />
<span class="co1">'--------------------------------------------------------------------------------</span><br />
<span class="kw1">Option</span> <span class="kw1">Explicit</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Type</span> POINTAPI<br />

<br />
&nbsp; &nbsp; X &nbsp; &nbsp; &nbsp; <span class="kw1">As</span> <span class="kw1">Long</span><br />
&nbsp; &nbsp; Y &nbsp; &nbsp; &nbsp; <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="kw1">End</span> <span class="kw1">Type</span><br />
<br />
<span class="co1">'</span><br />
<span class="kw1">Private</span> mEnabled <span class="kw1">As</span> <span class="kw1">Boolean</span><br />
<br />
<span class="kw1">Private</span> mValue &nbsp; <span class="kw1">As</span> <span class="kw1">Boolean</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> GetCursorPos Lib <span class="st0">&quot;user32&quot;</span> <span class="br0">&#40;</span>lpPoint <span class="kw1">As</span> POINTAPI<span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Declare</span> <span class="kw1">Function</span> WindowFromPoint Lib <span class="st0">&quot;user32&quot;</span> <span class="br0">&#40;</span>ByVal xPoint <span class="kw1">As</span> <span class="kw1">Long</span>, ByVal yPoint <span class="kw1">As</span> <span class="kw1">Long</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
<span class="kw1">Public</span> <span class="kw1">Event</span> Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
<br />
<span class="kw1">Public</span> <span class="kw1">Event</span> MouseDown<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span><span class="br0">&#41;</span><br />

<br />
<span class="kw1">Public</span> <span class="kw1">Event</span> MouseUp<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span><span class="br0">&#41;</span><br />
<br />
<span class="kw1">Public</span> <span class="kw1">Event</span> MouseMove<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span><span class="br0">&#41;</span><br />

<br />
<span class="kw1">Public</span> <span class="kw1">Sub</span> Redraw_Me<span class="br0">&#40;</span>Optional Hilite <span class="kw1">As</span> <span class="kw1">Boolean</span> = <span class="kw1">False</span><span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; <span class="co1">'Si la souris est dessus :</span><br />

&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">Dim</span> pPos <span class="kw1">As</span> POINTAPI, Hover <span class="kw1">As</span> <span class="kw1">Boolean</span><br />

<br />
&nbsp; &nbsp; pPos.<span class="me1">X</span> = <span class="nu0">0</span>: pPos.<span class="me1">Y</span> = <span class="nu0">0</span><br />
&nbsp; &nbsp; Hover = <span class="kw1">False</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">If</span> UserControl.<span class="me1">Ambient</span>.<span class="me1">UserMode</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Call</span> GetCursorPos<span class="br0">&#40;</span>pPos<span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">If</span> WindowFromPoint<span class="br0">&#40;</span>pPos.<span class="me1">X</span>, pPos.<span class="me1">Y</span><span class="br0">&#41;</span> = UserControl.<span class="me1">hwnd</span> <span class="kw1">Or</span> Hilite <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Hover = <span class="kw1">True</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">Else</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Tmr_OO.<span class="me1">Enabled</span> = <span class="kw1">False</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> <span class="kw1">Not</span> <span class="br0">&#40;</span>mEnabled<span class="br0">&#41;</span> <span class="kw1">Then</span> Hover = <span class="kw1">False</span><br />

&nbsp; &nbsp; Check.<span class="me1">Picture</span> = CheckData<span class="br0">&#40;</span><span class="nu0">4</span> * <span class="br0">&#40;</span><span class="kw1">Abs</span><span class="br0">&#40;</span><span class="kw1">Not</span> <span class="br0">&#40;</span>mEnabled<span class="br0">&#41;</span><span class="br0">&#41;</span><span class="br0">&#41;</span> + <span class="kw1">Abs</span><span class="br0">&#40;</span>Hover<span class="br0">&#41;</span> + <span class="nu0">2</span> * <span class="kw1">Abs</span><span class="br0">&#40;</span>mValue<span class="br0">&#41;</span><span class="br0">&#41;</span>.<span class="me1">Picture</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="co1">'Propriétés :</span><br />
<span class="kw1">Public</span> <span class="kw1">Property</span> <span class="kw1">Get</span> hwnd<span class="br0">&#40;</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; hwnd = UserControl.<span class="me1">hwnd</span><br />

<span class="kw1">End</span> <span class="kw1">Property</span><br />
<br />
<span class="kw1">Public</span> <span class="kw1">Property</span> <span class="kw1">Get</span> hdc<span class="br0">&#40;</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; hdc = UserControl.<span class="me1">hdc</span><br />

<span class="kw1">End</span> <span class="kw1">Property</span><br />
<br />
<span class="kw1">Public</span> <span class="kw1">Property</span> <span class="kw1">Let</span> Value<span class="br0">&#40;</span>ByVal mValeur <span class="kw1">As</span> <span class="kw1">Boolean</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; mValue = mValeur<br />
&nbsp; &nbsp; Redraw_Me<br />

&nbsp; &nbsp; <span class="kw1">RaiseEvent</span> Click<br />
&nbsp; &nbsp; PropertyChanged <span class="st0">&quot;Value&quot;</span><br />
<span class="kw1">End</span> <span class="kw1">Property</span><br />
<br />
<span class="kw1">Public</span> <span class="kw1">Property</span> <span class="kw1">Get</span> Value<span class="br0">&#40;</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Boolean</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; Value = <span class="kw1">Abs</span><span class="br0">&#40;</span>mValue<span class="br0">&#41;</span><br />

<span class="kw1">End</span> <span class="kw1">Property</span><br />
<br />
<span class="kw1">Public</span> <span class="kw1">Property</span> <span class="kw1">Get</span> Enabled<span class="br0">&#40;</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Boolean</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; Enabled = mEnabled<br />
<span class="kw1">End</span> <span class="kw1">Property</span><br />

<br />
<span class="kw1">Public</span> <span class="kw1">Property</span> <span class="kw1">Let</span> Enabled<span class="br0">&#40;</span>ByVal mActif <span class="kw1">As</span> <span class="kw1">Boolean</span><span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

<br />
&nbsp; &nbsp; mEnabled = mActif<br />
&nbsp; &nbsp; Redraw_Me<br />
<span class="kw1">End</span> <span class="kw1">Property</span><br />
<br />
<span class="co1">'</span><br />
<span class="co1">'</span><br />

<span class="co1">' &nbsp; *- PROPBAG -*</span><br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> UserControl_InitProperties<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

<br />
&nbsp; &nbsp; mValue = <span class="kw1">False</span><br />
&nbsp; &nbsp; mEnabled = <span class="kw1">True</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="co1">'</span><br />

<span class="kw1">Private</span> <span class="kw1">Sub</span> UserControl_ReadProperties<span class="br0">&#40;</span>PropBag <span class="kw1">As</span> PropertyBag<span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

<br />
&nbsp; &nbsp; Value = PropBag.<span class="me1">ReadProperty</span><span class="br0">&#40;</span><span class="st0">&quot;Value&quot;</span>, mValue<span class="br0">&#41;</span><br />
&nbsp; &nbsp; Enabled = PropBag.<span class="me1">ReadProperty</span><span class="br0">&#40;</span><span class="st0">&quot;Enabled&quot;</span>, mEnabled<span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="co1">'If UserControl.Ambient.UserMode Then Tmr_OO.Enabled = True</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="co1">'</span><br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> UserControl_WriteProperties<span class="br0">&#40;</span>PropBag <span class="kw1">As</span> PropertyBag<span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; PropBag.<span class="me1">WriteProperty</span> <span class="st0">&quot;Value&quot;</span>, mValue, <span class="kw1">False</span><br />

&nbsp; &nbsp; PropBag.<span class="me1">WriteProperty</span> <span class="st0">&quot;Enabled&quot;</span>, mEnabled, <span class="kw1">True</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="co1">'</span><br />
<span class="co1">'</span><br />

<span class="co1">' &nbsp; *- INIT/RESIZE/TERMINATE -*</span><br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> UserControl_Initialize<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

<br />
&nbsp; &nbsp; <span class="co1">'CheckLabel.BackStyle = 0</span><br />
&nbsp; &nbsp; Check.<span class="me1">Picture</span> = CheckData<span class="br0">&#40;</span><span class="nu0">0</span><span class="br0">&#41;</span>.<span class="me1">Picture</span><br />
&nbsp; &nbsp; mValue = <span class="kw1">False</span><br />

&nbsp; &nbsp; mEnabled = <span class="kw1">True</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="co1">'</span><br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> UserControl_Resize<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> UserControl.<span class="kw1">Width</span> &lt;&gt; <span class="nu0">195</span> <span class="kw1">Then</span> UserControl.<span class="kw1">Width</span> = <span class="nu0">195</span><br />

&nbsp; &nbsp; <span class="kw1">If</span> UserControl.<span class="me1">Height</span> &lt;&gt; <span class="nu0">195</span> <span class="kw1">Then</span> UserControl.<span class="me1">Height</span> = <span class="nu0">195</span><br />

&nbsp; &nbsp; <span class="co1">'If UserControl.Ambient.UserMode Then Tmr_OO.Enabled = True Else Tmr_OO.Enabled = False</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="co1">'</span><br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> UserControl_Terminate<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; Tmr_OO.<span class="me1">Enabled</span> = <span class="kw1">False</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="co1">'</span><br />
<span class="co1">'</span><br />
<span class="co1">' &nbsp; *- EVENTS -*</span><br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Check_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> mEnabled <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; mValue = <span class="kw1">IIf</span><span class="br0">&#40;</span>mValue = <span class="kw1">False</span>, <span class="kw1">True</span>, <span class="kw1">False</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Redraw_Me<br />

&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">RaiseEvent</span> Click<br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Check_MouseDown<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">RaiseEvent</span> MouseDown<span class="br0">&#40;</span>Button, Shift<span class="br0">&#41;</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Check_MouseUp<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">RaiseEvent</span> MouseUp<span class="br0">&#40;</span>Button, Shift<span class="br0">&#41;</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Check_MouseMove<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; Tmr_OO.<span class="me1">Enabled</span> = <span class="kw1">True</span><br />

&nbsp; &nbsp; <span class="kw1">RaiseEvent</span> MouseMove<span class="br0">&#40;</span>Button, Shift<span class="br0">&#41;</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="co1">'</span><br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Tmr_OO_Timer<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; Redraw_Me<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />

&nbsp;</div></fieldset><h4>Infobulles</h4>
<p>Les infobulles qui affichent l'aide contextuelle.</p>
<fieldset>
<legend>Code source : <a href="Codes/Tip.ctl" title="Télecharger le fichier">Tip.ctl</a></legend>
<div class="vb" style="font-family: monospace;"><div class="head"><ul><li>Langage : <em>vb</em></li><li>&Delta;T : <em>0.175s</em></li><li>Taille :7217 caractères</li></ul></div>VERSION <span class="nu0">5.00</span><br />

Begin VB.<span class="me1">UserControl</span> Tip <br />
&nbsp; &nbsp;BackColor &nbsp; &nbsp; &nbsp; = &nbsp; &amp;H80000011&amp;<br />
&nbsp; &nbsp;BackStyle &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">0</span> &nbsp;<span class="co1">'Transparent</span><br />

&nbsp; &nbsp;ClientHeight &nbsp; &nbsp;= &nbsp; <span class="nu0">1665</span><br />
&nbsp; &nbsp;ClientLeft &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">0</span><br />
&nbsp; &nbsp;ClientTop &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">0</span><br />

&nbsp; &nbsp;ClientWidth &nbsp; &nbsp; = &nbsp; <span class="nu0">4905</span><br />
&nbsp; &nbsp;MaskColor &nbsp; &nbsp; &nbsp; = &nbsp; &amp;H8000000E&amp;<br />

&nbsp; &nbsp;MaskPicture &nbsp; &nbsp; = &nbsp; <span class="st0">&quot;Tip.ctx&quot;</span>:<span class="nu0">0000</span><br />
&nbsp; &nbsp;ScaleHeight &nbsp; &nbsp; = &nbsp; <span class="nu0">111</span><br />

&nbsp; &nbsp;ScaleMode &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">3</span> &nbsp;<span class="co1">'Pixel</span><br />
&nbsp; &nbsp;ScaleWidth &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">327</span><br />

&nbsp; &nbsp;Begin VB.<span class="me1">TextBox</span> TitreEdit <br />
&nbsp; &nbsp; &nbsp; Height &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">285</span><br />

&nbsp; &nbsp; &nbsp; <span class="kw1">Left</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">630</span><br />
&nbsp; &nbsp; &nbsp; TabIndex &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">4</span><br />

&nbsp; &nbsp; &nbsp; Top &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">420</span><br />
&nbsp; &nbsp; &nbsp; Visible &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">0</span> &nbsp; <span class="co1">'False</span><br />

&nbsp; &nbsp; &nbsp; <span class="kw1">Width</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">3900</span><br />
&nbsp; &nbsp;<span class="kw1">End</span><br />

&nbsp; &nbsp;Begin VB.<span class="me1">TextBox</span> TexteEdit <br />
&nbsp; &nbsp; &nbsp; Height &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">645</span><br />

&nbsp; &nbsp; &nbsp; <span class="kw1">Left</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">105</span><br />
&nbsp; &nbsp; &nbsp; MultiLine &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">-1</span> &nbsp;<span class="co1">'True</span><br />

&nbsp; &nbsp; &nbsp; ScrollBars &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">2</span> &nbsp;<span class="co1">'Vertical</span><br />
&nbsp; &nbsp; &nbsp; TabIndex &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">3</span><br />

&nbsp; &nbsp; &nbsp; Top &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">735</span><br />
&nbsp; &nbsp; &nbsp; Visible &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">0</span> &nbsp; <span class="co1">'False</span><br />

&nbsp; &nbsp; &nbsp; <span class="kw1">Width</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">4740</span><br />
&nbsp; &nbsp;<span class="kw1">End</span><br />

&nbsp; &nbsp;Begin VB.<span class="me1">Label</span> Editer <br />
&nbsp; &nbsp; &nbsp; Alignment &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">1</span> &nbsp;<span class="co1">'Right Justify</span><br />

&nbsp; &nbsp; &nbsp; BackStyle &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">0</span> &nbsp;<span class="co1">'Transparent</span><br />
&nbsp; &nbsp; &nbsp; Caption &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="st0">&quot;Edit...&quot;</span><br />

&nbsp; &nbsp; &nbsp; BeginProperty Font <br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<span class="kw1">Name</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="st0">&quot;MS Sans Serif&quot;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Size &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">9.75</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Charset &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">0</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Weight &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">400</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Underline &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">-1</span> &nbsp;<span class="co1">'True</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Italic &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">0</span> &nbsp; <span class="co1">'False</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Strikethrough &nbsp; = &nbsp; <span class="nu0">0</span> &nbsp; <span class="co1">'False</span><br />

&nbsp; &nbsp; &nbsp; EndProperty<br />
&nbsp; &nbsp; &nbsp; ForeColor &nbsp; &nbsp; &nbsp; = &nbsp; &amp;H00800000&amp;<br />
&nbsp; &nbsp; &nbsp; Height &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">225</span><br />

&nbsp; &nbsp; &nbsp; <span class="kw1">Left</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">105</span><br />
&nbsp; &nbsp; &nbsp; MousePointer &nbsp; &nbsp;= &nbsp; <span class="nu0">10</span> &nbsp;<span class="co1">'Up Arrow</span><br />

&nbsp; &nbsp; &nbsp; TabIndex &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">2</span><br />
&nbsp; &nbsp; &nbsp; ToolTipText &nbsp; &nbsp; = &nbsp; <span class="st0">&quot;Edit this tooltip in good English&quot;</span><br />

&nbsp; &nbsp; &nbsp; Top &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">1365</span><br />
&nbsp; &nbsp; &nbsp; <span class="kw1">Width</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">4740</span><br />

&nbsp; &nbsp;<span class="kw1">End</span><br />
&nbsp; &nbsp;Begin VB.<span class="me1">Image</span> CCancel <br />
&nbsp; &nbsp; &nbsp; Height &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">240</span><br />

&nbsp; &nbsp; &nbsp; <span class="kw1">Left</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">4515</span><br />
&nbsp; &nbsp; &nbsp; Picture &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="st0">&quot;Tip.ctx&quot;</span>:1B29A<br />

&nbsp; &nbsp; &nbsp; Top &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">420</span><br />
&nbsp; &nbsp; &nbsp; <span class="kw1">Width</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">240</span><br />

&nbsp; &nbsp;<span class="kw1">End</span><br />
&nbsp; &nbsp;Begin VB.<span class="me1">Image</span> CCancelHL <br />
&nbsp; &nbsp; &nbsp; Height &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">240</span><br />

&nbsp; &nbsp; &nbsp; <span class="kw1">Left</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">4515</span><br />
&nbsp; &nbsp; &nbsp; Picture &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="st0">&quot;Tip.ctx&quot;</span>:1B5DC<br />

&nbsp; &nbsp; &nbsp; Top &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">420</span><br />
&nbsp; &nbsp; &nbsp; Visible &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">0</span> &nbsp; <span class="co1">'False</span><br />

&nbsp; &nbsp; &nbsp; <span class="kw1">Width</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">240</span><br />
&nbsp; &nbsp;<span class="kw1">End</span><br />

&nbsp; &nbsp;Begin VB.<span class="me1">Label</span> CTitre <br />
&nbsp; &nbsp; &nbsp; BackStyle &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">0</span> &nbsp;<span class="co1">'Transparent</span><br />

&nbsp; &nbsp; &nbsp; Caption &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="st0">&quot;Titre&quot;</span><br />
&nbsp; &nbsp; &nbsp; BeginProperty Font <br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<span class="kw1">Name</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="st0">&quot;MS Sans Serif&quot;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Size &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">9.75</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Charset &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">0</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Weight &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">700</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Underline &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">0</span> &nbsp; <span class="co1">'False</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Italic &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">0</span> &nbsp; <span class="co1">'False</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Strikethrough &nbsp; = &nbsp; <span class="nu0">0</span> &nbsp; <span class="co1">'False</span><br />
&nbsp; &nbsp; &nbsp; EndProperty<br />

&nbsp; &nbsp; &nbsp; Height &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">225</span><br />
&nbsp; &nbsp; &nbsp; <span class="kw1">Left</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">630</span><br />

&nbsp; &nbsp; &nbsp; TabIndex &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">1</span><br />
&nbsp; &nbsp; &nbsp; Top &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">420</span><br />

&nbsp; &nbsp; &nbsp; <span class="kw1">Width</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">3900</span><br />
&nbsp; &nbsp;<span class="kw1">End</span><br />

&nbsp; &nbsp;Begin VB.<span class="me1">Label</span> CCaption <br />
&nbsp; &nbsp; &nbsp; BackStyle &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">0</span> &nbsp;<span class="co1">'Transparent</span><br />

&nbsp; &nbsp; &nbsp; Height &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">885</span><br />
&nbsp; &nbsp; &nbsp; <span class="kw1">Left</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">105</span><br />

&nbsp; &nbsp; &nbsp; TabIndex &nbsp; &nbsp; &nbsp; &nbsp;= &nbsp; <span class="nu0">0</span><br />
&nbsp; &nbsp; &nbsp; Top &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">705</span><br />

&nbsp; &nbsp; &nbsp; <span class="kw1">Width</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; <span class="nu0">4740</span><br />
&nbsp; &nbsp;<span class="kw1">End</span><br />

<span class="kw1">End</span><br />
Attribute VB_Name = <span class="st0">&quot;Tip&quot;</span><br />
Attribute VB_GlobalNameSpace = <span class="kw1">False</span><br />
Attribute VB_Creatable = <span class="kw1">True</span><br />
Attribute VB_PredeclaredId = <span class="kw1">False</span><br />
Attribute VB_Exposed = <span class="kw1">False</span><br />

<span class="co1">'--------------------------------------------------------------------------------</span><br />
<span class="co1">' &nbsp; &nbsp;Component &nbsp;: Tip</span><br />
<span class="co1">' &nbsp; &nbsp;Project &nbsp; &nbsp;: TXT2JPG</span><br />
<span class="co1">'</span><br />
<span class="co1">' &nbsp; &nbsp;Description: Permet d'afficher une infobulle transparente à un emplacement donnée. Entièrement géré par la sub AfficherTip de Principale</span><br />

<span class="co1">'</span><br />
<span class="co1">' &nbsp; &nbsp;Modified &nbsp; :</span><br />
<span class="co1">'--------------------------------------------------------------------------------</span><br />
<span class="kw1">Option</span> <span class="kw1">Explicit</span><br />
<br />
<span class="kw1">Private</span> mText &nbsp;<span class="kw1">As</span> <span class="kw1">String</span><br />

<br />
<span class="kw1">Private</span> mTitre <span class="kw1">As</span> <span class="kw1">String</span><br />
<br />
<span class="kw1">Public</span> <span class="kw1">Event</span> Fermer<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
<br />
<span class="kw1">Public</span> <span class="kw1">Property</span> <span class="kw1">Get</span> hwnd<span class="br0">&#40;</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">Long</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; hwnd = UserControl.<span class="me1">hwnd</span><br />

<span class="kw1">End</span> <span class="kw1">Property</span><br />
<span class="kw1">Public</span> <span class="kw1">Property</span> <span class="kw1">Get</span> Text<span class="br0">&#40;</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">String</span>: &nbsp; &nbsp;Text = mText: <span class="kw1">End</span> <span class="kw1">Property</span><br />

<br />
<span class="kw1">Public</span> <span class="kw1">Property</span> <span class="kw1">Get</span> Titre<span class="br0">&#40;</span><span class="br0">&#41;</span> <span class="kw1">As</span> <span class="kw1">String</span>: &nbsp; &nbsp;Titre = mTitre: <span class="kw1">End</span> <span class="kw1">Property</span><br />

<br />
<span class="kw1">Public</span> <span class="kw1">Property</span> <span class="kw1">Let</span> Edit<span class="br0">&#40;</span>ByVal mValeur <span class="kw1">As</span> <span class="kw1">Boolean</span><span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

&nbsp; &nbsp; Editer.<span class="me1">Visible</span> = mValeur<br />
<span class="kw1">End</span> <span class="kw1">Property</span><br />
<span class="kw1">Public</span> <span class="kw1">Property</span> <span class="kw1">Let</span> Text<span class="br0">&#40;</span>ByVal mValeur <span class="kw1">As</span> <span class="kw1">String</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; mText = mValeur<br />
&nbsp; &nbsp; CCaption.<span class="me1">Caption</span> = mText<br />

&nbsp; &nbsp; PropertyChanged <span class="st0">&quot;Text&quot;</span><br />
<span class="kw1">End</span> <span class="kw1">Property</span><br />
<br />
<span class="kw1">Public</span> <span class="kw1">Property</span> <span class="kw1">Let</span> Titre<span class="br0">&#40;</span>ByVal mValeur <span class="kw1">As</span> <span class="kw1">String</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; mTitre = mValeur<br />
&nbsp; &nbsp; CTitre.<span class="me1">Caption</span> = mTitre<br />

&nbsp; &nbsp; PropertyChanged <span class="st0">&quot;Titre&quot;</span><br />
<span class="kw1">End</span> <span class="kw1">Property</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> CCancel_MouseMove<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; CCancel.<span class="me1">Visible</span> = <span class="kw1">False</span><br />

&nbsp; &nbsp; CCancelHL.<span class="me1">Visible</span> = <span class="kw1">True</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> CCancelHL_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">RaiseEvent</span> Fermer<br />

&nbsp; &nbsp; CCancel.<span class="me1">Visible</span> = <span class="kw1">True</span><br />
&nbsp; &nbsp; CCancelHL.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />

<br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> Editer_Click<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> Editer.<span class="me1">Caption</span> = <span class="st0">&quot;Edit...&quot;</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; TitreEdit.<span class="me1">Tag</span> = CTitre.<span class="me1">Caption</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; TitreEdit.<span class="me1">Text</span> = CTitre.<span class="me1">Caption</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; TexteEdit.<span class="me1">Text</span> = CCaption.<span class="me1">Caption</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; TitreEdit.<span class="me1">Visible</span> = <span class="kw1">True</span>: TexteEdit.<span class="me1">Visible</span> = <span class="kw1">True</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; Editer.<span class="me1">Caption</span> = <span class="st0">&quot;Update ToolTip now !&quot;</span><br />
&nbsp; &nbsp; <span class="kw1">Else</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Principale.<span class="me1">Download</span> <span class="st0">&quot;http://neamar.free.fr/mailer.php?action=EditBallon&amp;OTitre=&quot;</span> &amp; TitreEdit.<span class="me1">Tag</span> &amp; <span class="st0">&quot;&amp;NTitre=&quot;</span> &amp; TitreEdit.<span class="me1">Text</span> &amp; <span class="st0">&quot;&amp;NCap=&quot;</span> &amp; TexteEdit.<span class="me1">Text</span> &amp; <span class="st0">&quot;&amp;auteur=&quot;</span> &amp; <span class="kw1">GetSetting</span><span class="br0">&#40;</span><span class="st0">&quot;TXT2JPG&quot;</span>, <span class="st0">&quot;Data&quot;</span>, <span class="st0">&quot;Nom&quot;</span>, <span class="st0">&quot;Anonyme&quot;</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; TitreEdit.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; TexteEdit.<span class="me1">Visible</span> = <span class="kw1">False</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; CTitre.<span class="me1">Caption</span> = <span class="st0">&quot;Send.&quot;</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; Editer.<span class="me1">Caption</span> = <span class="st0">&quot;Edit...&quot;</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; CCaption.<span class="me1">Caption</span> = <span class="st0">&quot;Thank you for your submission. It will be examined and included in the next version of TXT2JPG.&quot;</span><br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />

<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> TexteEdit_KeyPress<span class="br0">&#40;</span>KeyAscii <span class="kw1">As</span> <span class="kw1">Integer</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> KeyAscii = <span class="nu0">38</span> <span class="kw1">Then</span> KeyAscii = <span class="nu0">0</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> TexteEdit_MouseMove<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">If</span> CCancel.<span class="me1">Visible</span> = <span class="kw1">False</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; CCancel.<span class="me1">Visible</span> = <span class="kw1">True</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; CCancelHL.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />

<br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> TitreEdit_KeyPress<span class="br0">&#40;</span>KeyAscii <span class="kw1">As</span> <span class="kw1">Integer</span><span class="br0">&#41;</span><br />
&nbsp; &nbsp; <span class="kw1">If</span> KeyAscii = <span class="nu0">38</span> <span class="kw1">Then</span> KeyAscii = <span class="nu0">0</span><br />

<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> TitreEdit_MouseMove<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

&nbsp; &nbsp; <span class="kw1">If</span> CCancel.<span class="me1">Visible</span> = <span class="kw1">False</span> <span class="kw1">Then</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; CCancel.<span class="me1">Visible</span> = <span class="kw1">True</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; CCancelHL.<span class="me1">Visible</span> = <span class="kw1">False</span><br />
&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />

<br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> UserControl_Initialize<span class="br0">&#40;</span><span class="br0">&#41;</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />

<br />
&nbsp; &nbsp; UserControl.<span class="me1">MaskColor</span> = <span class="kw1">vbWhite</span><br />
&nbsp; &nbsp; UserControl.<span class="me1">Picture</span> = UserControl.<span class="me1">MaskPicture</span><br />

&nbsp; &nbsp; mText = <span class="st0">&quot;InfoTip Express&quot;</span><br />
&nbsp; &nbsp; mTitre = <span class="st0">&quot;CTitre&quot;</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> UserControl_MouseMove<span class="br0">&#40;</span>Button <span class="kw1">As</span> <span class="kw1">Integer</span>, Shift <span class="kw1">As</span> <span class="kw1">Integer</span>, X <span class="kw1">As</span> <span class="kw1">Single</span>, Y <span class="kw1">As</span> <span class="kw1">Single</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; <span class="kw1">If</span> CCancel.<span class="me1">Visible</span> = <span class="kw1">False</span> <span class="kw1">Then</span><br />

&nbsp; &nbsp; &nbsp; &nbsp; CCancel.<span class="me1">Visible</span> = <span class="kw1">True</span><br />
&nbsp; &nbsp; &nbsp; &nbsp; CCancelHL.<span class="me1">Visible</span> = <span class="kw1">False</span><br />

&nbsp; &nbsp; <span class="kw1">End</span> <span class="kw1">If</span><br />
<br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> UserControl_Resize<span class="br0">&#40;</span><span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; UserControl.<span class="kw1">Width</span> = <span class="nu0">327</span> * <span class="nu0">15</span><br />

&nbsp; &nbsp; UserControl.<span class="me1">Height</span> = <span class="nu0">111</span> * <span class="nu0">15</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> UserControl_ReadProperties<span class="br0">&#40;</span>PropBag <span class="kw1">As</span> PropertyBag<span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; Text = PropBag.<span class="me1">ReadProperty</span><span class="br0">&#40;</span><span class="st0">&quot;Text&quot;</span>, mText<span class="br0">&#41;</span><br />

&nbsp; &nbsp; Titre = PropBag.<span class="me1">ReadProperty</span><span class="br0">&#40;</span><span class="st0">&quot;Titre&quot;</span>, mTitre<span class="br0">&#41;</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
<br />
<span class="co1">'</span><br />
<span class="kw1">Private</span> <span class="kw1">Sub</span> UserControl_WriteProperties<span class="br0">&#40;</span>PropBag <span class="kw1">As</span> PropertyBag<span class="br0">&#41;</span><br />

<br />
&nbsp; &nbsp; <span class="kw1">On</span> <span class="kw1">Error</span> <span class="kw1">Resume</span> <span class="kw1">Next</span><br />
<br />
&nbsp; &nbsp; PropBag.<span class="me1">WriteProperty</span> <span class="st0">&quot;Text&quot;</span>, mText, <span class="kw1">False</span><br />

&nbsp; &nbsp; PropBag.<span class="me1">WriteProperty</span> <span class="st0">&quot;Titre&quot;</span>, mTitre, <span class="kw1">True</span><br />
<span class="kw1">End</span> <span class="kw1">Sub</span><br />
&nbsp;</div></fieldset>
<h3>Fichiers de langues :</h3>
<p>Les textes d'accueil des deux langages sont stockés dans le dossier Lang du Zip.</p>

<h4>Francais</h4>
<p>Un fichier ini standard...</p>
<fieldset>
<legend>Code source : <a href="Codes/Francais.lng" title="Télecharger le fichier">Francais.lng</a></legend>
<div class="ini" style="font-family: monospace;"><div class="head"><ul><li>Langage : <em>ini</em></li><li>&Delta;T : <em>0.513s</em></li><li>Taille :21988 caractères</li></ul></div><span class="co0">; Fichier au format .ini, un ; indique un commentaire</span><br />
<span class="co0">; Le fichier se répartit en trois sections : [FormData], [Strings] et [Message]</span><br />

<span class="co0">; [FormData] =&gt; L'emplacement ou le programme va chercher les informations des contrôles au démarrage. Il est possible de rajouter des lignes, elles seront prises en compte si le contrôle gère la propriété (exemple : rajouter un tooltiptext est possible pour tout les contrôles, rajouter un CueBanner est impossible pour un label.)</span><br />
<span class="co0">; [Strings] =&gt; Tous les strings dont le programme va avoir besoin lors de son exécution. Taille Max : 512 caractères.</span><br />
<span class="co0">; [Message] =&gt;Tout les petits messages qui s'affichent sous forme d'info bulles.</span><br />
<span class="co0">;</span><br />
<span class="co0">;</span><br />
<span class="co0">; Vous pouvez créer une nouvelle langue simplement en ajoutant un fichier &lt;nom de la langue&gt;.ini dans le répertoire Lang de l'application. Il sera automatiquement détecté au démarrage.</span><br />

<span class="co0">; Dans ce cas là, n'hésitez pas à en faire profiter les autres : joignez le-moi par mail à neamart@yahoo.fr, et je l'inclurais dans la prochaine version. Merci !</span><br />
<br />
<span class="co0">;{FRANCAIS}, crée par NEAMAR -16/DEC/07</span><br />
<br />
<span class="re0"><span class="br0">&#91;</span>FormData<span class="br0">&#93;</span></span><br />
<span class="co0">; Cette section contient les informations &quot;en dur&quot; : ce sont les valeurs par défaut des contrôles.</span><br />
<br />
<span class="co0">; Les contrôles étiquette sont tout les labels de type générique, ils sons souvent associés à des option buttons.</span><br />
etiquette|<span class="nu0">0</span>|Caption<span class="sy0">=</span><span class="re2">Fichier d'origine / URL :</span><br />

etiquette|<span class="nu0">1</span>|Caption<span class="sy0">=</span><span class="re2">Nom du répertoire :</span><br />
etiquette|<span class="nu0">2</span>|Caption<span class="sy0">=</span><span class="re2">Fermeture de l'application</span><br />
etiquette|<span class="nu0">3</span>|Caption<span class="sy0">=</span><span class="re2">Taille</span><br />

etiquette|<span class="nu0">4</span>|Caption<span class="sy0">=</span><span class="re2">Enregistrer sous :</span><br />
etiquette|<span class="nu0">5</span>|Caption<span class="sy0">=</span><span class="re2">Utiliser une image d'arrière plan</span><br />
etiquette|<span class="nu0">6</span>|Caption<span class="sy0">=</span><span class="re2">Redimensionner l'image...</span><br />

etiquette|<span class="nu0">6</span>|Caption<span class="sy0">=</span><span class="re2">Numériser 'à la volée'</span><br />
etiquette|<span class="nu0">7</span>|Caption<span class="sy0">=</span><span class="re2">Numériser à la volée.</span><br />
etiquette|<span class="nu0">7</span>|ToolTipText<span class="sy0">=</span><span class="re2">Numérisation plus rapide, mais moins jolie.</span><br />

etiquette|<span class="nu0">8</span>|Caption<span class="sy0">=</span><span class="re2">Hauteur :</span><br />
etiquette|<span class="nu0">9</span>|Caption<span class="sy0">=</span><span class="re2">Largeur :</span><br />
etiquette|<span class="nu0">10</span>|Caption<span class="sy0">=</span><span class="re2">Sauver en JPG</span><br />

etiquette|<span class="nu0">10</span>|ToolTipText<span class="sy0">=</span><span class="re2">Encoder en JPG <span class="br0">&#40;</span>plus long, mais à utiliser si votre firmware ne convertit pas automatiquement<span class="br0">&#41;</span>.</span><br />
etiquette|<span class="nu0">11</span>|Caption<span class="sy0">=</span><span class="re2">Qualité : <span class="nu0">80</span>%</span><br />
etiquette|<span class="nu0">12</span>|Caption<span class="sy0">=</span><span class="re2">Couverture uniquement</span><br />

etiquette|<span class="nu0">12</span>|ToolTipText<span class="sy0">=</span><span class="re2">N'utiliser cette image que pour la première diapositive : il s'agira d'une couverture, et pas d'une image de fond.</span><br />
etiquette|<span class="nu0">13</span>|Caption<span class="sy0">=</span><span class="re2">Marge Gauche :000px</span><br />
etiquette|<span class="nu0">14</span>|Caption<span class="sy0">=</span><span class="re2">Marge Droite :000px</span><br />

etiquette|<span class="nu0">15</span>|Caption<span class="sy0">=</span><span class="re2">Chargement</span><br />
etiquette|<span class="nu0">16</span>|Caption<span class="sy0">=</span><span class="re2">Passez la souris sur un module...</span><br />
etiquette|<span class="nu0">17</span>|Caption<span class="sy0">=</span><span class="re2">Fond rouge</span><br />

etiquette|<span class="nu0">18</span>|Caption<span class="sy0">=</span><span class="re2">Fond vert</span><br />
etiquette|<span class="nu0">19</span>|Caption<span class="sy0">=</span><span class="re2">Fond bleu</span><br />
etiquette|<span class="nu0">20</span>|Caption<span class="sy0">=</span><span class="re2">Sens.</span><br />

etiquette|<span class="nu0">21</span>|Caption<span class="sy0">=</span><span class="re2">Nom sur le réseau :</span><br />
etiquette|<span class="nu0">22</span>|Caption<span class="sy0">=</span><span class="re2">Utiliser ClearType</span><br />
etiquette|<span class="nu0">22</span>|ToolTipText<span class="sy0">=</span><span class="re2">Cette option ne fonctionne pas si vous définissez une image d'arrière plan</span><br />

etiquette|<span class="nu0">23</span>|Caption<span class="sy0">=</span><span class="re2">Répertoire par défaut :</span><br />
etiquette|<span class="nu0">24</span>|Caption<span class="sy0">=</span><span class="re2">Slide des menus</span><br />
etiquette|<span class="nu0">24</span>|ToolTipText<span class="sy0">=</span><span class="re2">Marque une rapide transition lors du changement entre les menus. Peut être désactivée si votre ordinateur est vieux, ou si vous souhaitez gagner en rapidité d'utilisation.</span><br />

etiquette|<span class="nu0">25</span>|Caption<span class="sy0">=</span><span class="re2">Priorité :</span><br />
etiquette|<span class="nu0">25</span>|ToolTipText<span class="sy0">=</span><span class="re2">Définit la priorité du processus <span class="br0">&#40;</span>vitesse d'encodage<span class="br0">&#41;</span></span><br />
etiquette|<span class="nu0">26</span>|Caption<span class="sy0">=</span><span class="re2">Marge du bas :000px</span><br />

etiquette|<span class="nu0">27</span>|Caption<span class="sy0">=</span><span class="re2">Marge du haut :000px</span><br />
etiquette|<span class="nu0">28</span>|Caption<span class="sy0">=</span><span class="re2">Utiliser les marge haut et bas</span><br />
etiquette|<span class="nu0">29</span>|Caption<span class="sy0">=</span><span class="re2">Numéroter page</span><br />

etiquette|<span class="nu0">30</span>|Caption<span class="sy0">=</span><span class="re2">Sélectionnez du texte, puis effectuez des dégradés de taille à partir des barres à gauche. ATTENTION : il est déconseillé de sélectionner plus d'une trentaine de caractères...</span><br />
etiquette|<span class="nu0">31</span>|Caption<span class="sy0">=</span><span class="re2">Sélectionnez la couleur à utiliser pour le premier caractère de la sélection, la couleur du dernier, puis appuyez sur Appliquer...</span><br />
etiquette|<span class="nu0">32</span>|Caption<span class="sy0">=</span><span class="re2">Votre texte contient des images ! Que souhaitez-vous en faire ?</span><br />

etiquette|<span class="nu0">33</span>|Caption<span class="sy0">=</span><span class="re2">Ne rien changer <span class="br0">&#40;</span>aucun redimensionnement, les images dont la taille est supérieure à l'écran seront coupées<span class="br0">&#41;</span></span><br />
etiquette|<span class="nu0">34</span>|Caption<span class="sy0">=</span><span class="re2">Redimensionner les images dont la taille est supérieure à la taille de l'écran, sur la largeur uniquement.</span><br />
etiquette|<span class="nu0">35</span>|Caption<span class="sy0">=</span><span class="re2">Redimensionner sur hauteur ET largeur.</span><br />

etiquette|<span class="nu0">36</span>|Caption<span class="sy0">=</span><span class="re2">Adapter les couleurs au BG.</span><br />
etiquette|<span class="nu0">36</span>|ToolTipText<span class="sy0">=</span><span class="re2">Change le contraste de l'affichage pour améliorer la lisibilité. BETA !</span><br />
etiquette|<span class="nu0">37</span>|Caption<span class="sy0">=</span><span class="re2">Langue</span><br />

etiquette|<span class="nu0">37</span>|ToolTipText<span class="sy0">=</span><span class="re2">Choix d'une langue</span><br />
etiquette|<span class="nu0">38</span>|Caption<span class="sy0">=</span><span class="re2">Séparer les chapitres</span><br />
etiquette|<span class="nu0">38</span>|ToolTipText<span class="sy0">=</span><span class="re2">Marquez un mot. A chaque fois que le programme rencontrera ce mot, le dossier de destination changera automatiquement</span><br />

etiquette|<span class="nu0">39</span>|Caption<span class="sy0">=</span><span class="re2">Placer une copie du fichier dans le répertoire de sortie</span><br />
etiquette|<span class="nu0">39</span>|ToolTipText<span class="sy0">=</span><span class="re2">Placer une copie du fichier utilisé lors de la numérisation dans le répertoire où sont stockées les images</span><br />
etiquette|<span class="nu0">40</span>|Caption<span class="sy0">=</span><span class="re2">Rechercher :</span><br />

etiquette|<span class="nu0">41</span>|Caption<span class="sy0">=</span><span class="re2">Remplacer par :</span><br />
<br />
<span class="co0">; Les contrôles PlugChoice sont les titres des onglets, qui apparaissent à droite du texte, dans la première colonne, au dessus du bouton démarrer. Le #4 n'apparait que lorsque #1 est activé.</span><br />
PlugChoice|<span class="nu0">0</span>|Caption<span class="sy0">=</span><span class="re2">Options de dossier</span><br />
PlugChoice|<span class="nu0">1</span>|Caption<span class="sy0">=</span><span class="re2">Mise en Forme</span><br />

PlugChoice|<span class="nu0">2</span>|Caption<span class="sy0">=</span><span class="re2">Marges / Options avancées</span><br />
PlugChoice|<span class="nu0">3</span>|Caption<span class="sy0">=</span><span class="re2">Options du programme</span><br />
PlugChoice|<span class="nu0">4</span>|Caption<span class="sy0">=</span><span class="re2">Modules</span><br />

PlugChoice|<span class="nu0">5</span>|Caption<span class="sy0">=</span><span class="re2">Mise en forme <span class="br0">&#40;</span>avancé<span class="br0">&#41;</span></span><br />
<br />
<span class="co0">; Les options de Mise en forme proposées sont les suivantes :</span><br />
Couleur|<span class="nu0">0</span>|ToolTipText<span class="sy0">=</span><span class="re2">Couleur du texte sélectionné</span><br />
Couleur|<span class="nu0">1</span>|ToolTipText<span class="sy0">=</span><span class="re2">Couleur de surlignement</span><br />

Couleur|<span class="nu0">2</span>|ToolTipText<span class="sy0">=</span><span class="re2">Couleur de fond</span><br />
MEF|<span class="nu0">0</span>|ToolTipText<span class="sy0">=</span><span class="re2">En gras</span><br />
MEF|<span class="nu0">1</span>|ToolTipText<span class="sy0">=</span><span class="re2">En italique</span><br />

MEF|<span class="nu0">2</span>|ToolTipText<span class="sy0">=</span><span class="re2">Souligné</span><br />
MEF|<span class="nu0">3</span>|ToolTipText<span class="sy0">=</span><span class="re2">Barré</span><br />
MEF|<span class="nu0">4</span>|ToolTipText<span class="sy0">=</span><span class="re2">Puces</span><br />

CharMap|<span class="nu0">0</span>|ToolTipText<span class="sy0">=</span><span class="re2">Liste des caractères spéciaux</span><br />
Alignement|<span class="nu0">0</span>|ToolTipText<span class="sy0">=</span><span class="re2">Alignement</span><br />
Polices|<span class="nu0">0</span>|Text<span class="sy0">=</span><span class="re2">MS Sans Serif</span><br />

<br />
<span class="co0">;Les modules proposés ou plutôt leurs descriptions:</span><br />
Modules|<span class="nu0">0</span>|ToolTipText<span class="sy0">=</span><span class="re2">Permet de convertir un fichier diaporama PowerPoint en images JPG.</span><br />
Modules|<span class="nu0">1</span>|ToolTipText<span class="sy0">=</span><span class="re2">Crée des dégradés à mettre en fond d'écran de votre baladeur. Vous pouvez aussi vous servir des images comme fond de numérisation pour TXT2JPG</span><br />
Modules|<span class="nu0">2</span>|ToolTipText<span class="sy0">=</span><span class="re2">Convertir un fichier GIF au format AVI.</span><br />

Modules|<span class="nu0">3</span>|ToolTipText<span class="sy0">=</span><span class="re2">Le projet Gutenberg offre plusieurs milliers de livres libres de droit, dont quelques centaines en français. Ils sont téléchargeables au format texte, html ou doc.</span><br />
Modules|<span class="nu0">4</span>|ToolTipText<span class="sy0">=</span><span class="re2">Du même auteur :-<span class="br0">&#41;</span> : L'éphéméride est un projet de base de données de blagues. Il contient plus de <span class="nu0">1000</span> blagues, et plus de <span class="nu0">500</span> images drôles.</span><br />

Modules|<span class="nu0">5</span>|ToolTipText<span class="sy0">=</span><span class="re2">En préparation?Ce sera la surprise !</span><br />
ModulesWhat|<span class="nu0">0</span>|Caption<span class="sy0">=</span><span class="re2">Modules</span><br />
ModulesWhat|<span class="nu0">1</span>|Caption<span class="sy0">=</span><span class="re2">A propos</span><br />

WhatAbout|<span class="nu0">0</span>|Text<span class="sy0">=</span><span class="re2">Chargement des données...</span><br />
<br />
<span class="co0">; Les menus de clic droit (quand clic que le textbox ou sur alignement)</span><br />
Edition|<span class="nu0">0</span>|Caption<span class="sy0">=</span><span class="re2">Annuler</span><br />
Edition|<span class="nu0">1</span>|Caption<span class="sy0">=</span><span class="re2">-</span><br />

Edition|<span class="nu0">2</span>|Caption<span class="sy0">=</span><span class="re2">Remplacer</span><br />
Edition|<span class="nu0">3</span>|Caption<span class="sy0">=</span><span class="re2">Rechercher</span><br />
Edition|<span class="nu0">4</span>|Caption<span class="sy0">=</span><span class="re2">-</span><br />

Edition|<span class="nu0">5</span>|Caption<span class="sy0">=</span><span class="re2">Ajuster</span><br />
Edition|<span class="nu0">6</span>|Caption<span class="sy0">=</span><span class="re2">Suppr. dbl saut de ligne</span><br />
Edition|<span class="nu0">7</span>|Caption<span class="sy0">=</span><span class="re2">Police</span><br />

Edition|<span class="nu0">8</span>|Caption<span class="sy0">=</span><span class="re2">-</span><br />
Edition|<span class="nu0">9</span>|Caption<span class="sy0">=</span><span class="re2">Couper</span><br />
Edition|<span class="nu0">10</span>|Caption<span class="sy0">=</span><span class="re2">Copier</span><br />

Edition|<span class="nu0">11</span>|Caption<span class="sy0">=</span><span class="re2">Coller</span><br />
Edition|<span class="nu0">12</span>|Caption<span class="sy0">=</span><span class="re2">RTF=&gt;TXT</span><br />
Edition|<span class="nu0">13</span>|Caption<span class="sy0">=</span><span class="re2">TXT=&gt;RTF</span><br />

Edition|<span class="nu0">14</span>|Caption<span class="sy0">=</span><span class="re2">-</span><br />
Edition|<span class="nu0">15</span>|Caption<span class="sy0">=</span><span class="re2">Options par défaut</span><br />
Edition|<span class="nu0">16</span>|Caption<span class="sy0">=</span><span class="re2">-</span><br />

Edition|<span class="nu0">17</span>|Caption<span class="sy0">=</span><span class="re2">Barre horizontale</span><br />
Edition|<span class="nu0">18</span>|Caption<span class="sy0">=</span><span class="re2">Alignement</span><br />
Edition|<span class="nu0">19</span>|Caption<span class="sy0">=</span><span class="re2">Inverser la casse</span><br />

Edition|<span class="nu0">20</span>|Caption<span class="sy0">=</span><span class="re2">Nouveau paragraphe</span><br />
Edition|<span class="nu0">21</span>|Caption<span class="sy0">=</span><span class="re2">En exposant</span><br />
Edition|<span class="nu0">22</span>|Caption<span class="sy0">=</span><span class="re2">En indice</span><br />

Align|<span class="nu0">0</span>|Caption<span class="sy0">=</span><span class="re2">Aligné à gauche</span><br />
Align|<span class="nu0">1</span>|Caption<span class="sy0">=</span><span class="re2">Aligné à droite</span><br />
Align|<span class="nu0">2</span>|Caption<span class="sy0">=</span><span class="re2">Centré</span><br />

<br />
<span class="co0">; La barre d'outil rapport de bug : (apparait quand le programme s'est mal fermé, ou quand on clique sur Signaler un bug)</span><br />
Bug_Texte|<span class="nu0">0</span>|CueBanner<span class="sy0">=</span><span class="re2">Un bug s'est produit ?! Pouvez-vous le décrire, afin d'améliorer les prochaines versions ?</span><br />
Bug_Envoi|<span class="nu0">0</span>|Caption<span class="sy0">=</span><span class="re2">Envoyer</span><br />
Bug_Rapport|<span class="nu0">0</span>|Caption<span class="sy0">=</span><span class="re2">Reporter un bug</span><br />

Bug_Rapport|<span class="nu0">0</span>|ToolTipText<span class="sy0">=</span><span class="re2">Cliquez ici si vous avez rencontré un bug, ou si bous souhaitez proposer une amélioration au programme</span><br />
<br />
<span class="co0">; La barre d'outil Rechercher Remplacer (CTRL-F, CTRL-H dans le textbox) (voir aussi etiquette|40 et etiquette|41)</span><br />
Rechercher_Suite|<span class="nu0">0</span>|Caption<span class="sy0">=</span><span class="re2">Prochaine occurrence</span><br />
Rechercher_Close|<span class="nu0">0</span>|ToolTipText<span class="sy0">=</span><span class="re2">Fermer la barre de recherche</span><br />

<br />
<span class="co0">;A propos du baladeur</span><br />
Hauteur|<span class="nu0">0</span>|Text <span class="sy0">=</span><span class="re2"> <span class="nu0">240</span></span><br />
Largeur|<span class="nu0">0</span>|Text <span class="sy0">=</span><span class="re2"> <span class="nu0">320</span></span><br />

Defaut|<span class="nu0">0</span>|ToolTipText<span class="sy0">=</span><span class="re2">Enregistrer ce baladeur comme mon baladeur par défaut</span><br />
Swap|<span class="nu0">0</span>|ToolTipText<span class="sy0">=</span><span class="re2">Intervertir largeur et hauteur <span class="br0">&#40;</span>affichage dans l'autre sens<span class="br0">&#41;</span></span><br />
Modeles|<span class="nu0">0</span>|Text<span class="sy0">=</span><span class="re2">&lt;Modele&gt;</span><br />

Marque|<span class="nu0">0</span>|Text<span class="sy0">=</span><span class="re2">&lt;Marque du Baladeur&gt;</span><br />
<br />
<span class="co0">; Options du programme</span><br />
ChoosePic|<span class="nu0">0</span>|Caption<span class="sy0">=</span><span class="re2">Sélectionner une image de fond</span><br />
Enregistrer|<span class="nu0">0</span>|ToolTipText<span class="sy0">=</span><span class="re2">Enregistrer comme nouveau nom</span><br />

Enregistrer|<span class="nu0">1</span>|ToolTipText<span class="sy0">=</span><span class="re2">Enregistrer comme nouveau répertoire</span><br />
Browse3|<span class="nu0">0</span>|ToolTipText<span class="sy0">=</span><span class="re2">Choix du dossier principal</span><br />
Langue|<span class="nu0">0</span>|ToolTipText<span class="sy0">=</span><span class="re2">Langage :</span><br />

<br />
<span class="co0">;Boutons</span><br />
Abandon|<span class="nu0">0</span>|Caption<span class="sy0">=</span><span class="re2">ANNULER ?</span><br />
Annuler|<span class="nu0">0</span>|Caption<span class="sy0">=</span><span class="re2">Annuler</span><br />
Start|<span class="nu0">0</span>|Caption<span class="sy0">=</span><span class="re2">Commencer</span><br />

Start|<span class="nu0">0</span>|ToolTipText<span class="sy0">=</span><span class="re2">Lancer la numérisation !</span><br />
AppliquImage|<span class="nu0">0</span>|Caption<span class="sy0">=</span><span class="re2">Appliquer</span><br />
Appliquer|<span class="nu0">0</span>|Caption<span class="sy0">=</span><span class="re2">Appliquer</span><br />

<br />
<span class="co0">;Choix d'un fichier</span><br />
Dest_Folder|<span class="nu0">0</span>|CueBanner<span class="sy0">=</span><span class="re2">Nom du dossier</span><br />
Directory|<span class="nu0">0</span>|Text<span class="sy0">=</span><span class="re2">Directory</span><br />
Browse|<span class="nu0">0</span>|ToolTipText<span class="sy0">=</span><span class="re2">Parcourir</span><br />

<br />
<span class="co0">;Divers et varié</span><br />
VoirApercu|<span class="nu0">0</span>|Caption<span class="sy0">=</span><span class="re2">Voir un aperçu</span><br />
KeyWord|<span class="nu0">0</span>|CueBanner<span class="sy0">=</span><span class="re2">Mot Clé</span><br />
Root|<span class="nu0">0</span>|CueBanner<span class="sy0">=</span><span class="re2">Texte préfixe</span><br />

UseTopAndBottomMargin|<span class="nu0">0</span>|ToolTipText<span class="sy0">=</span><span class="re2">Autoriser l'utilisation des marges haut et bas</span><br />
<br />
<br />
<span class="re0"><span class="br0">&#91;</span>Strings<span class="br0">&#93;</span></span><br />
<span class="co0">; La liste des strings utilisés dans le programme.</span><br />
<br />
String <span class="nu0">1</span><span class="sy0">=</span><span class="re2">Veuillez sélectionner le dossier dans lequel toutes les images seront crées.</span><br />

String <span class="nu0">2</span><span class="sy0">=</span><span class="re2">Non, je ne suis pas buggé ! Je travaille !</span><br />
<br />
<span class="co0">; Tous les petits commentaires pendant la numérisation</span><br />
String <span class="nu0">3</span><span class="sy0">=</span><span class="re2">Initialisation...</span><br />
String <span class="nu0">4</span><span class="sy0">=</span><span class="re2">Copie du fichier... <span class="br0">&#40;</span>Peut durer quelques minutes, ne pas bouger la souris<span class="br0">&#41;</span></span><br />

String <span class="nu0">5</span><span class="sy0">=</span><span class="re2">Hachage du fichier <span class="br0">&#40;</span>%u<span class="br0">&#41;</span></span><br />
String <span class="nu0">6</span><span class="sy0">=</span><span class="re2">Partie n°</span><br />
String <span class="nu0">7</span><span class="sy0">=</span><span class="re2">Redimensionnements des images...</span><br />
String <span class="nu0">8</span><span class="sy0">=</span><span class="re2">La priorité est réglée à :</span><br />

String <span class="nu0">9</span><span class="sy0">=</span><span class="re2">Une image d'arrière plan est utilisée <span class="br0">&#40;</span>%u<span class="br0">&#41;</span></span><br />
String <span class="nu0">10</span><span class="sy0">=</span><span class="re2">Aucune image d'arrière plan utilisée.</span><br />
String <span class="nu0">11</span><span class="sy0">=</span><span class="re2">Nombre d'images <span class="br0">&#40;</span>ESTIMATION<span class="br0">&#41;</span> :</span><br />

String <span class="nu0">12</span><span class="sy0">=</span><span class="re2">La durée de numérisation va dépendre de la taille du texte et des performances de votre ordinateur</span><br />
String <span class="nu0">13</span><span class="sy0">=</span><span class="re2">Transposition texte vers bitmap..</span><br />
String <span class="nu0">14</span><span class="sy0">=</span><span class="re2">Destruction des fichiers temporaires...</span><br />
String <span class="nu0">15</span><span class="sy0">=</span><span class="re2">Conversion en JPG...</span><br />

String <span class="nu0">16</span><span class="sy0">=</span><span class="re2">Finalisation, ouverture du dossier et fermeture de l?application <span class="br0">&#40;</span> %u images<span class="br0">&#41;</span></span><br />
String <span class="nu0">18</span><span class="sy0">=</span><span class="re2">Recherche de MAJ.....</span><br />
<br />
<span class="co0">; Messages concernant la connexion Internet</span><br />
String <span class="nu0">19</span><span class="sy0">=</span><span class="re2">Téléchargement des données en cours...</span><br />

String <span class="nu0">20</span><span class="sy0">=</span><span class="re2">Impossible d'ouvrir une connexion Internet. Vous devrez entrer votre baladeur manuellement. Réglez les options de votre pare feu pour corriger le problème.</span><br />
<br />
<span class="co0">; Messages concernant l'ouverture d'un document Word/IE via la méthode automation,</span><br />
String <span class="nu0">21</span><span class="sy0">=</span><span class="re2">Chargement du fichier en cours...</span><br />
String <span class="nu0">22</span><span class="sy0">=</span><span class="re2">Fichier ouvert, récupération des données... environ une minute pour <span class="nu0">75</span> pages...</span><br />

String <span class="nu0">23</span><span class="sy0">=</span><span class="re2">ATTENTION : les images ralentissent énormément l'ensemble !</span><br />
String <span class="nu0">24</span><span class="sy0">=</span><span class="re2">Fichier récupéré. Si rien ne se passe, faites un clic droit sur ce texte, et sélectionnez copier.</span><br />
String <span class="nu0">25</span><span class="sy0">=</span><span class="re2">Automation ouvert...</span><br />
String <span class="nu0">26</span><span class="sy0">=</span><span class="re2">Récupération de la page...</span><br />

String <span class="nu0">27</span><span class="sy0">=</span><span class="re2">Page récupérée...</span><br />
String <span class="nu0">28</span><span class="sy0">=</span><span class="re2">Parsing des données...</span><br />
String <span class="nu0">29</span><span class="sy0">=</span><span class="re2">Cliquez sur oui lorsqu'une fenêtre vous demande l'accès au presse papier.</span><br />
String <span class="nu0">30</span><span class="sy0">=</span><span class="re2">Automation fermé, conversion terminée ! Si rien ne se passe, appuyez sur ctrl + V.</span><br />

<br />
<span class="co0">; Concerne les fichiers PDF</span><br />
String <span class="nu0">31</span><span class="sy0">=</span><span class="re2">La lecture de fichiers PDF n'est pas faisable par TXT2JPG. Cependant, vous pouvez utiliser un site internet pour convertir ce fichier en fichier RTF. Effectuer la conversion ?</span><br />
String <span class="nu0">32</span><span class="sy0">=</span><span class="re2">La conversion va s'ouvrir sous Internet Explorer....</span><br />
String <span class="nu0">33</span><span class="sy0">=</span><span class="re2">http://media-convert.fr</span><br />

<br />
<span class="co0">; Concerne les fichiers LRC :</span><br />
String <span class="nu0">34</span><span class="sy0">=</span><span class="re2">Passage en Texte ...</span><br />
String <span class="nu0">35</span><span class="sy0">=</span><span class="re2">Le fichier LRC ne contient pas le titre de la chanson dans ses balises. Veuillez l'entrez manuellement</span><br />
String <span class="nu0">36</span><span class="sy0">=</span><span class="re2">Aucune balise <span class="re0"><span class="br0">&#91;</span>ti:<span class="br0">&#93;</span></span> détectée</span><br />

String <span class="nu0">37</span><span class="sy0">=</span><span class="re2">Fichier invalide. Tenter de l'ouvrir en mode texte ?</span><br />
<br />
<span class="co0">; Adresse par défaut lors du choix d'une URL à télécharger, mais aussi URL vers laquelle sera affichée la dernière version.</span><br />
String <span class="nu0">38</span><span class="sy0">=</span><span class="re2">http://neamar.free.fr/txt2jpg/txt2jpg.php</span><br />
<br />
String <span class="nu0">47</span><span class="sy0">=</span><span class="re2">....patience....</span><br />

String <span class="nu0">48</span><span class="sy0">=</span><span class="re2">Ce type de fichier n'est pas pris en charge...</span><br />
String <span class="nu0">49</span><span class="sy0">=</span><span class="re2">L'image à mettre en filigrane est supérieure à la taille de l'écran du lecteur. La redimensionner ?</span><br />
String <span class="nu0">50</span><span class="sy0">=</span><span class="re2">Demande de confirmation !</span><br />
String <span class="nu0">52</span><span class="sy0">=</span><span class="re2">Charger un fichier</span><br />

<br />
<span class="co0">; Ne pas changer les masques de fichiers...</span><br />
String <span class="nu0">53</span><span class="sy0">=</span><span class="re2">Fichiers BMP, JPG<span class="br0">&#40;</span>*.bmp,*.jpg<span class="br0">&#41;</span>|*.bmp</span><span class="co0">;*.jpg|Fichiers Bitmap Windows(*.bmp)|*.bmp|Fichiers JPEG (*.jpg)|*.jpg|Fichiers GIF (*.gif)|*.gif|</span><br />
String <span class="nu0">51</span><span class="sy0">=</span><span class="re2">Fichier Texte, Texte mis en forme et Lyrics <span class="br0">&#40;</span>*.txt,*.rtf,*.doc,*.lrc<span class="br0">&#41;</span>|*.txt</span><span class="co0">;*.rtf;*.doc;*.lrc;*.docx|Fichiers plain text (*.txt)|*.txt|Fichiers de texte mis en forme (*.rtf,*.doc,*.pdf)|*.rtf;*.doc;*.pdf;*.docx|Fichiers lyrics (*.lrc)|*.lrc|Tout les fichiers (*.*)|*.*</span><br />

String <span class="nu0">58</span><span class="sy0">=</span><span class="re2">Fichiers BMP, JPG et GIF <span class="br0">&#40;</span>*.bmp,*.jpg, *.gif<span class="br0">&#41;</span>|*.bmp</span><span class="co0">;*.jpg;*.gif|Fichiers Bitmap Windows (*.bmp)|*.bmp|Fichiers JPEG (*.jpg)|*.jpg|Fichiers GIF (*.gif)|*.gif|</span><br />
String <span class="nu0">54</span><span class="sy0">=</span><span class="re2">Charger une image</span><br />
String <span class="nu0">55</span><span class="sy0">=</span><span class="re2">Merci pour votre idée, je tenterai de la traiter dans les plus brefs délais</span><br />

String <span class="nu0">56</span><span class="sy0">=</span><span class="re2">Rapporter un bug, faire une suggestion...</span><br />
String <span class="nu0">57</span><span class="sy0">=</span><span class="re2">Impossible d'afficher les caractères spéciaux !</span><br />
String <span class="nu0">59</span><span class="sy0">=</span><span class="re2">Sauver en tant que :</span><br />
String <span class="nu0">60</span><span class="sy0">=</span><span class="re2">Mot :</span><br />

String <span class="nu0">61</span><span class="sy0">=</span><span class="re2">Séparer les chapitres</span><br />
String <span class="nu0">62</span><span class="sy0">=</span><span class="re2">Entrez l'URL du fichier à télécharger. IE <span class="nu0">5.0</span> min est requis pour le bon fonctionnement. Lorsque l'on vous posera la question, cliquez sur autoriser l'accès de cette page au presse papier.</span><br />
String <span class="nu0">63</span><span class="sy0">=</span><span class="re2">Téléchargement d'une page Web</span><br />

String <span class="nu0">64</span><span class="sy0">=</span><span class="re2">Nom d'utilisateur :</span><br />
String <span class="nu0">65</span><span class="sy0">=</span><span class="re2">Graphismes : Windows XP, pack Vista Inspirat, Noia <span class="nu0">2.0</span> Xtrême, Windows Vista, Windows Media Player, ThunderBird skinné, Neamar, icone de Charmap, Images libres de droit sur Internet.</span><br />
String <span class="nu0">66</span><span class="sy0">=</span><span class="re2">Historique des versions :</span><br />

String <span class="nu0">67</span><span class="sy0">=</span><span class="re2">Rechercher</span><br />
String <span class="nu0">68</span><span class="sy0">=</span><span class="re2">Remplacer</span><br />
String <span class="nu0">69</span><span class="sy0">=</span><span class="re2">Application du filtre en cours...</span><br />
String <span class="nu0">70</span><span class="sy0">=</span><span class="re2">Taille du texte <span class="br0">&#40;</span>caractères<span class="br0">&#41;</span> :</span><br />

String <span class="nu0">71</span><span class="sy0">=</span><span class="re2">Nom du dossier</span><br />
String <span class="nu0">72</span><span class="sy0">=</span><span class="re2">&lt;Marque du Baladeur&gt;</span><br />
<br />
<span class="co0">; Path à rajouter à neamar.free.Fr pour arriver sur les pages dans la bonne langue.</span><br />
String <span class="nu0">73</span><span class="sy0">=</span><span class="re2">txt2jpg</span><br />

String <span class="nu0">74</span><span class="sy0">=</span><span class="re2">&lt;Modèle&gt;</span><br />
String <span class="nu0">76</span><span class="sy0">=</span><span class="re2">Quel est le modèle du baladeur ?</span><br />
String <span class="nu0">77</span><span class="sy0">=</span><span class="re2">Quelle est la marque ?</span><br />
<br />
<span class="co0">; %u : ancien modèle de baladeur, %n : nouveau modèle de baladeur</span><br />

String <span class="nu0">78</span><span class="sy0">=</span><span class="re2">Souhaitez vous vraiment remplacer %u par %n</span><br />
String <span class="nu0">80</span><span class="sy0">=</span><span class="re2">Confirmer le remplacement</span><br />
<br />
String <span class="nu0">81</span><span class="sy0">=</span><span class="re2">Suivant</span><br />
String <span class="nu0">82</span><span class="sy0">=</span><span class="re2">Vous ne disposez pas de la DLL bmp2jpg.dll. Le programme va la télécharger automatiquement. Si une erreur survient, vérifiez les options de votre pare feu. Continuer ?</span><br />

String <span class="nu0">83</span><span class="sy0">=</span><span class="re2">DLL manquante</span><br />
String <span class="nu0">84</span><span class="sy0">=</span><span class="re2">Une instance du programme est déjà lancée, cette session va donc s'auto détruire dans cinq secondes...éloignez vous de la bordure du quai s'il vous plait.</span><br />
<br />
<span class="co0">; Les images d'arrière plan proposées par défaut.</span><br />
String <span class="nu0">86</span><span class="sy0">=</span><span class="re2">Parchemin</span><br />

String <span class="nu0">87</span><span class="sy0">=</span><span class="re2">Aquatique</span><br />
String <span class="nu0">88</span><span class="sy0">=</span><span class="re2">Terre</span><br />
String <span class="nu0">89</span><span class="sy0">=</span><span class="re2">Ésotérique</span><br />
String <span class="nu0">90</span><span class="sy0">=</span><span class="re2">Etoiles</span><br />

String <span class="nu0">91</span><span class="sy0">=</span><span class="re2">Ondes</span><br />
String <span class="nu0">92</span><span class="sy0">=</span><span class="re2">Ciel</span><br />
String <span class="nu0">93</span><span class="sy0">=</span><span class="re2">Paix</span><br />
String <span class="nu0">94</span><span class="sy0">=</span><span class="re2">Ondine</span><br />

String <span class="nu0">95</span><span class="sy0">=</span><span class="re2">Cristal</span><br />
String <span class="nu0">96</span><span class="sy0">=</span><span class="re2">Plus...</span><br />
<br />
<br />
String <span class="nu0">98</span><span class="sy0">=</span><span class="re2">Une nouvelle version de TXT2JPG est disponible....</span><br />

String <span class="nu0">99</span><span class="sy0">=</span><span class="re2">Nouvelle version !</span><br />
<br />
String <span class="nu0">100</span><span class="sy0">=</span><span class="re2">Vous utilisez TXT2JPG depuis <span class="nu0">3</span> numérisations.</span><br />
String <span class="nu0">101</span><span class="sy0">=</span><span class="re2">Entre temps, peut être vous êtes vous fait une idée un peu avancée de ce logiciel. Pourriez vous répondre à un rapide sondage de quelques questions <span class="br0">&#40;</span>une dizaine<span class="br0">&#41;</span> afin d'améliorer les prochaines versions ?</span><br />

String <span class="nu0">102</span><span class="sy0">=</span><span class="re2">Chargement....</span><br />
String <span class="nu0">104</span><span class="sy0">=</span><span class="re2">@Autre...</span><br />
String <span class="nu0">105</span><span class="sy0">=</span><span class="re2">Quelle est la hauteur en pixel de l'écran ?</span><br />
String <span class="nu0">106</span><span class="sy0">=</span><span class="re2">Hauteur</span><br />

String <span class="nu0">107</span><span class="sy0">=</span><span class="re2">Quelle est la largeur en pixel de l'écran ?</span><br />
String <span class="nu0">108</span><span class="sy0">=</span><span class="re2">Largeur</span><br />
String <span class="nu0">109</span><span class="sy0">=</span><span class="re2"><span class="br0">&#40;</span>Autres...<span class="br0">&#41;</span></span><br />
String <span class="nu0">110</span><span class="sy0">=</span><span class="re2">Quel est la marque de votre baladeur ? <span class="br0">&#40;</span>Si votre baladeur n'a pas de marque, laissez le terme 'No Name'<span class="br0">&#41;</span></span><br />

String <span class="nu0">111</span><span class="sy0">=</span><span class="re2">Quel est le modèle de baladeur ?</span><br />
String <span class="nu0">112</span><span class="sy0">=</span><span class="re2">Vous ne disposez pas du module ConvertPowerPoint.exe. Le télécharger ?</span><br />
String <span class="nu0">113</span><span class="sy0">=</span><span class="re2">Vous ne disposez pas de la DLL bmp2jpg.dll. La télécharger?</span><br />
String <span class="nu0">114</span><span class="sy0">=</span><span class="re2">Vous ne disposez pas du module Degrade.exe. Le télécharger ?</span><br />

String <span class="nu0">115</span><span class="sy0">=</span><span class="re2">Sélectionnez votre baladeur, car le programme Dégradé doit connaitre la taille de l'écran</span><br />
String <span class="nu0">116</span><span class="sy0">=</span><span class="re2">Vous ne disposez pas du module GIF2AVI.exe. Le télécharger, ainsi que ses dépendances &nbsp;?</span><br />
String <span class="nu0">117</span><span class="sy0">=</span><span class="re2">http://www.gutenberg.org/browse/languages/fr</span><br />
String <span class="nu0">118</span><span class="sy0">=</span><span class="re2">ATTENTION : AVEC LE NIVEAU REALTIME_PRIORITY_CLASS VOUS JOUEZ AVEC LE FEU. UN SEUL PROCESSUS PEUT AVOIR CETTE PRIORITE EN MEME TEMPS. IL SERA IMPOSSIBLE D'ARRETER LE LOGICIEL TANT QUE LA NUMERISATION NE SERA PAS TERMINEE. VOTRE SOURIS ET VOTRE CLAVIER NE BOUGERONT PLUS. En contrepartie, le programme numérisera les images plusieurs dizaines de fois plus vite.</span><br />

String <span class="nu0">119</span><span class="sy0">=</span><span class="re2">Qualité : <span class="br0">&#40;</span>%u%<span class="br0">&#41;</span></span><br />
String <span class="nu0">120</span><span class="sy0">=</span><span class="re2">Appuyez &nbsp;sur les touches <span class="br0">&#123;</span> %u <span class="br0">&#125;</span>.</span><br />
<br />
<span class="re0"><span class="br0">&#91;</span>Message<span class="br0">&#93;</span></span><br />

<span class="co0">; Les messages qui s'affichent sous forme d'info bulles.</span><br />
<span class="co0">; IMPORTANT : Les titres qui commencent par un i indiquent qu'il s'agit d'une information, l'info bulle ne sera affichée que deux fois, puis sera oubliée. Laissez les i là ou ils sont...</span><br />
Msg <span class="nu0">1</span><span class="sy0">=</span><span class="re2">Cette page ne vous plait pas ?</span><br />
Msg <span class="nu0">2</span><span class="sy0">=</span><span class="re2">Si vous souhaitez conserver les effets de style de la page <span class="br0">&#40;</span>images-tableaux...<span class="br0">&#41;</span>, ouvrez IE, copiez la page, ouvrez Word, collez le texte, puis copier de nouveau et collez ici...</span><br />
Msg <span class="nu0">3</span><span class="sy0">=</span><span class="re2">Erreur !</span><br />

Msg <span class="nu0">4</span><span class="sy0">=</span><span class="re2">Les caractères suivants ne sont pas autorisés :</span><br />
Msg <span class="nu0">5</span><span class="sy0">=</span><span class="re2">Aucun texte sélectionné !</span><br />
Msg <span class="nu0">6</span><span class="sy0">=</span><span class="re2">Sélectionnez du texte dans l'aperçu pour utiliser cette option <span class="br0">&#40;</span>max conseillé : <span class="nu0">20</span> caractères<span class="br0">&#41;</span></span><br />

Msg <span class="nu0">7</span><span class="sy0">=</span><span class="re2">iOuvrir...</span><br />
Msg <span class="nu0">8</span><span class="sy0">=</span><span class="re2">Cliquez pour ouvrir un fichier Texte, Texte mis en forme et Lyrics <span class="br0">&#40;</span>*.txt,*.rtf,*.doc,*.lrc<span class="br0">&#41;</span></span><br />
Msg <span class="nu0">9</span><span class="sy0">=</span><span class="re2">iFatigué des dégradés ?</span><br />
Msg <span class="nu0">10</span><span class="sy0">=</span><span class="re2">Vous pouvez utiliser une image de fond au format JPG/BMP/GIF non animé</span><br />

Msg <span class="nu0">11</span><span class="sy0">=</span><span class="re2">Impossible d'annuler</span><br />
Msg <span class="nu0">12</span><span class="sy0">=</span><span class="re2">Causes possibles de cette erreur :</span><br />
Msg <span class="nu0">13</span><span class="sy0">=</span><span class="re2">iCliquez ici !</span><br />
Msg <span class="nu0">14</span><span class="sy0">=</span><span class="re2">Cliquez ici pour créer des dégradés colorés !</span><br />

Msg <span class="nu0">15</span><span class="sy0">=</span><span class="re2">iMarquez ici le nom de fichier</span><br />
Msg <span class="nu0">16</span><span class="sy0">=</span><span class="re2">Les images crées seront automatiquement sauvegardés dans ce dossier, qui s'ouvrira automatiquement à la fin de la numérisation.</span><br />
Msg <span class="nu0">17</span><span class="sy0">=</span><span class="re2">iOuvrir...</span><br />
Msg <span class="nu0">18</span><span class="sy0">=</span><span class="re2">Vous devez cliquer içi pour ouvrir un fichier Internet sur le web, ou stocké sur votre disque dur <span class="br0">&#40;</span>nécessite IE <span class="nu0">5.5</span> ou supérieur<span class="br0">&#41;</span></span><br />

Msg <span class="nu0">19</span><span class="sy0">=</span><span class="re2">iQualité</span><br />
Msg <span class="nu0">20</span><span class="sy0">=</span><span class="re2">Réglez la qualité du JPG de sortie. Plus elle est proche de <span class="nu0">100</span>, meilleur est le résultat, mais plus il est lourd.</span><br />
Msg <span class="nu0">21</span><span class="sy0">=</span><span class="re2">Préfixe invalide !</span><br />

Msg <span class="nu0">22</span><span class="sy0">=</span><span class="re2">Ce champ permet de sélectionner un nom de préfixe pour les images.</span><br />
Msg <span class="nu0">23</span><span class="sy0">=</span><span class="re2">iChamp préfixe</span><br />
Msg <span class="nu0">24</span><span class="sy0">=</span><span class="re2">Ce champ permet de sélectionner un nom de préfixe pour les images. Les images obtenues auront un nom de la forme &lt;dossier&gt;\&lt;préfixe&gt;XXXX.jpg</span><br />

Msg <span class="nu0">25</span><span class="sy0">=</span><span class="re2">iLes marges Haut/Bas sont configurées</span><br />
Msg <span class="nu0">26</span><span class="sy0">=</span><span class="re2">Chaque image bénéficiera bien de vos modifications <span class="br0">&#40;</span>non visibles sur l'aperçu<span class="br0">&#41;</span></span><br />
Msg <span class="nu0">27</span><span class="sy0">=</span><span class="re2">iDivision en chapitres</span><br />
Msg <span class="nu0">28</span><span class="sy0">=</span><span class="re2">Cette option crée des sous-dossiers à l'intérieur du dossier principal, chacun contenant un chapitre. La division en chapitre s'effectue chaque fois que le programme rencontre le terme marqué à droite, qui ne peut pas contenir du code RTF.</span><br />

Msg <span class="nu0">29</span><span class="sy0">=</span><span class="re2">iPriorité</span><br />
Msg <span class="nu0">30</span><span class="sy0">=</span><span class="re2">Si vous avez à numériser des textes longs, vous pouvez gagner en rapidité en réglant la priorité. Je conseille ABOVE_NORMAL_PRIORITY_CLASS !</span><br />
Msg <span class="nu0">31</span><span class="sy0">=</span><span class="re2">Remplacement terminé</span><br />
Msg <span class="nu0">32</span><span class="sy0">=</span><span class="re2"> occurrences remplacées <span class="br0">&#40;</span>en respectant la casse<span class="br0">&#41;</span></span><br />

Msg <span class="nu0">33</span><span class="sy0">=</span><span class="re2">iChamp Nom Réseau</span><br />
Msg <span class="nu0">34</span><span class="sy0">=</span><span class="re2">Ce champ vous permet de choisir le nom qui vous identifiera lors de vos connexions avec la base de données de baladeur, lors de rapport de bug....</span><br />
Msg <span class="nu0">35</span><span class="sy0">=</span><span class="re2">iChamp Base</span><br />
Msg <span class="nu0">36</span><span class="sy0">=</span><span class="re2">Ce champ permet d'indiquer l'arborescence par défaut où sont crées les dossiers de numérisation. Cliquez sur la loupe pour changer.</span><br />

Msg <span class="nu0">37</span><span class="sy0">=</span><span class="re2">Aucun texte sélectionné !</span><br />
Msg <span class="nu0">38</span><span class="sy0">=</span><span class="re2">Sélectionnez du texte dans l'aperçu pour utiliser cette option <span class="br0">&#40;</span>max conseillé : <span class="nu0">20</span> caractères<span class="br0">&#41;</span>.</span><br />
Msg <span class="nu0">39</span><span class="sy0">=</span><span class="re2">Nom de fichier invalide !</span><br />

Msg <span class="nu0">40</span><span class="sy0">=</span><span class="re2">Windows n'autorise pas la saisie des caractères suivants dans les noms de dossier : &nbsp;\ / : * ? &nbsp; &lt; &gt;</span><br />
Msg <span class="nu0">41</span><span class="sy0">=</span><span class="re2">iSauver en JPG</span><br />
Msg <span class="nu0">42</span><span class="sy0">=</span><span class="re2">Cliquez içi pour enregistrer ou non vos images au format JPG <span class="br0">&#40;</span>le format par défaut est BMP<span class="br0">&#41;</span>. Je vous conseille d'activer cette option, et de régler la qualité à <span class="nu0">75</span>%.</span><br />

Msg <span class="nu0">43</span><span class="sy0">=</span><span class="re2">Inutile !</span><br />
Msg <span class="nu0">44</span><span class="sy0">=</span><span class="re2">Il est inutile de régler la couleur d'arrière plan, car vous utilisez déjà une image d'arrière plan. Régler la couleur n'aurait aucune utilité...</span><br />
Msg <span class="nu0">45</span><span class="sy0">=</span><span class="re2">Opération impossible</span><br />
Msg <span class="nu0">46</span><span class="sy0">=</span><span class="re2">La couleur de fond et la couleur de premier plan sont semblables.</span><br />

<br />
Msg <span class="nu0">49</span><span class="sy0">=</span><span class="re2">Téléchargement en cours...</span><br />
Msg <span class="nu0">50</span><span class="sy0">=</span><span class="re2">La DLL est en train d'être téléchargée...Merci de patienter ...</span><br />
Msg <span class="nu0">51</span><span class="sy0">=</span><span class="re2">Image introuvable !</span><br />
Msg <span class="nu0">52</span><span class="sy0">=</span><span class="re2">Ce fichier n'existe pas ou plus. Vérifiez de ne pas avoir commis d'erreurs.</span><br />

Msg <span class="nu0">53</span><span class="sy0">=</span><span class="re2">iImage d'arrière plan</span><br />
Msg <span class="nu0">54</span><span class="sy0">=</span><span class="re2">Ce champ permet de sélectionner une image jpg/bmp à utiliser en arrière plan du texte numérisé.</span><br />
Msg <span class="nu0">55</span><span class="sy0">=</span><span class="re2">Welcome !</span><br />
Msg <span class="nu0">56</span><span class="sy0">=</span><span class="re2">Welcome to TXT2JPG. You are not speaking French ? Click on this tab, and select your language.</span><br />

Msg <span class="nu0">57</span><span class="sy0">=</span><span class="re2">iActiver la pagination</span><br />
Msg <span class="nu0">58</span><span class="sy0">=</span><span class="re2">Si vous activez cette option, chaque page sera marquée de son numéro et d'une barre de progression. Vous pouvez régler la taille de ces informations à l'aide du curseur de marge du bas<span class="nu0">.7</span></span><br />
Msg <span class="nu0">59</span><span class="sy0">=</span><span class="re2">Dimensions invalides</span><br />
Msg <span class="nu0">60</span><span class="sy0">=</span><span class="re2">Ces dimensions ne sont pas correctes, choisissez un baladeur !</span><br />

Msg <span class="nu0">61</span><span class="sy0">=</span><span class="re2">Baladeur Ajouté</span><br />
Msg <span class="nu0">62</span><span class="sy0">=</span><span class="re2">Merci pour votre envoi ! Fermez le logiciel puis relancez-le pour prendre en compte !</span><br />
Msg <span class="nu0">63</span><span class="sy0">=</span><span class="re2">Une erreur est survenue !</span><br />
Msg <span class="nu0">64</span><span class="sy0">=</span><span class="re2">Les paramètres de votre baladeur ont peut être été mal chargés. Si les données affichées ne correspondent pas à votre baladeur, relancez le logiciel.</span><br />

Msg <span class="nu0">65</span><span class="sy0">=</span><span class="re2">Demande de confirmation !</span><br />
Msg <span class="nu0">66</span><span class="sy0">=</span><span class="re2">Le nom de répertoire existe déjà...Les fichier préexistants portant le même nom <span class="br0">&#40;</span>%u/0XXXX.jpg<span class="br0">&#41;</span> seront écrasés. Vous devriez changer de nom.</span><br />
Msg <span class="nu0">67</span><span class="sy0">=</span><span class="re2">iMettre une copie du fichier dans le...</span><br />

Msg <span class="nu0">68</span><span class="sy0">=</span><span class="re2">Si vous effectuez des modifications sur votre texte, cochez cette option. Cela sauvegardera vos changements dans le meme dossier que les images, et rouvrira votre projet au prochain démarrage.</span><br />
Msg <span class="nu0">69</span><span class="sy0">=</span><span class="re2">iEnregistrer ce baladeur</span><br />
Msg <span class="nu0">70</span><span class="sy0">=</span><span class="re2">Enregistre le baladeur en mémoire, et le sélectionnera par défaut pour chaque numérisation.</span><br />
Msg <span class="nu0">71</span><span class="sy0">=</span><span class="re2">iImage d'arrière plan</span><br />

Msg <span class="nu0">72</span><span class="sy0">=</span><span class="re2">Par défaut, le fond de chaque image sera de la couleur de fond selectionnée <span class="br0">&#40;</span>blanc dans la majorité des cas<span class="br0">&#41;</span>. Cependant, vous pouvez aussi utiliser une image comme arrière-plan, ou simplement comme couverture.</span></div></fieldset><h4>Anglais</h4>
<p>Un autre fichier ini standard...</p>
<fieldset>
<legend>Code source : <a href="Codes/English.lng" title="Télecharger le fichier">English.lng</a></legend>
<div class="ini" style="font-family: monospace;"><div class="head"><ul><li>Langage : <em>ini</em></li><li>&Delta;T : <em>0.314s</em></li><li>Taille :18313 caractères</li></ul></div><span class="co0">; .ini file, ; is a remark.</span><br />

<span class="co0">; The file contains 3 sections: [FormData], [Strings] and [Message]</span><br />
<span class="co0">; [FormData] =&gt; Default value for the controls. You can add some line. You can add properties; they will be taken into account if the control accepts the property.</span><br />
<span class="co0">; [Strings] =&gt; Every string the program will need while. Max size: 512 chars.</span><br />
<span class="co0">; [Message] =&gt;Every single tooltip displayed by the software;</span><br />
<span class="co0">;</span><br />
<span class="co0">; You can create new languages files simply by naming them &lt;language name&gt;.ini and pasting the file in the Lang folder. He will be automatically detected at startup.</span><br />

<span class="co0">; In such a case, send me a mail and join it your language file ! neamart@yahoo.fr</span><br />
<br />
<span class="co0">;{ENGLISH}, created by NEAMAR - corrected by Y-God - 22/DEC/07</span><br />
<br />
<span class="re0"><span class="br0">&#91;</span>FormData<span class="br0">&#93;</span></span><br />
<span class="co0">; This part contains all the hard-coded information: they are the default value for controls.</span><br />
<br />
<span class="co0">; Etiquette controls are the most commons labels you'll find; they are often associated with option button</span><br />
etiquette|<span class="nu0">0</span>|Caption<span class="sy0">=</span><span class="re2">Source file / URL :</span><br />

etiquette|<span class="nu0">1</span>|Caption<span class="sy0">=</span><span class="re2">Folder's name:</span><br />
etiquette|<span class="nu0">2</span>|Caption<span class="sy0">=</span><span class="re2">Application's closing</span><br />
etiquette|<span class="nu0">3</span>|Caption<span class="sy0">=</span><span class="re2">Size</span><br />

etiquette|<span class="nu0">4</span>|Caption<span class="sy0">=</span><span class="re2">Save As :</span><br />
etiquette|<span class="nu0">5</span>|Caption<span class="sy0">=</span><span class="re2">Use a background picture</span><br />
etiquette|<span class="nu0">6</span>|Caption<span class="sy0">=</span><span class="re2">Modify the pics dimensions</span><br />

etiquette|<span class="nu0">6</span>|ToolTipText<span class="sy0">=</span><span class="re2">Modify the pics dimensions so that if fits the player's screen</span><br />
etiquette|<span class="nu0">7</span>|Caption<span class="sy0">=</span><span class="re2">Convert 'on the fly'</span><br />
etiquette|<span class="nu0">7</span>|ToolTipText<span class="sy0">=</span><span class="re2">Quicker conversion, but less aesthetical</span><br />

etiquette|<span class="nu0">8</span>|Caption<span class="sy0">=</span><span class="re2">Height:</span><br />
etiquette|<span class="nu0">9</span>|Caption<span class="sy0">=</span><span class="re2">Width:</span><br />
etiquette|<span class="nu0">10</span>|Caption<span class="sy0">=</span><span class="re2">Save as *.jpg</span><br />

etiquette|<span class="nu0">10</span>|ToolTipText<span class="sy0">=</span><span class="re2">Encode as JPG <span class="br0">&#40;</span>longer, but recommended if your firmware doesn't convert it automatically<span class="br0">&#41;</span>.</span><br />
etiquette|<span class="nu0">11</span>|Caption<span class="sy0">=</span><span class="re2">Quality: <span class="nu0">80</span>%</span><br />
etiquette|<span class="nu0">12</span>|Caption<span class="sy0">=</span><span class="re2">Cover only</span><br />

etiquette|<span class="nu0">12</span>|ToolTipText<span class="sy0">=</span><span class="re2">Use this picture only for the first picture: it'll be considered as a cover, not as a background picture.</span><br />
etiquette|<span class="nu0">13</span>|Caption<span class="sy0">=</span><span class="re2">Left Margin:000px</span><br />
etiquette|<span class="nu0">14</span>|Caption<span class="sy0">=</span><span class="re2">Right Margin:000px</span><br />

etiquette|<span class="nu0">15</span>|Caption<span class="sy0">=</span><span class="re2">Loading...</span><br />
etiquette|<span class="nu0">16</span>|Caption<span class="sy0">=</span><span class="re2">Put the mouse pointer over an image to get a description.</span><br />
etiquette|<span class="nu0">17</span>|Caption<span class="sy0">=</span><span class="re2">Red background</span><br />

etiquette|<span class="nu0">18</span>|Caption<span class="sy0">=</span><span class="re2">Green Background</span><br />
etiquette|<span class="nu0">19</span>|Caption<span class="sy0">=</span><span class="re2">Blue background</span><br />
etiquette|<span class="nu0">20</span>|Caption<span class="sy0">=</span><span class="re2">Orientation</span><br />

etiquette|<span class="nu0">21</span>|Caption<span class="sy0">=</span><span class="re2">Network Name</span><br />
etiquette|<span class="nu0">22</span>|Caption<span class="sy0">=</span><span class="re2">Use Clear Type</span><br />
etiquette|<span class="nu0">22</span>|ToolTipText<span class="sy0">=</span><span class="re2">This option won't work if you're not using a background picture.</span><br />

etiquette|<span class="nu0">23</span>|Caption<span class="sy0">=</span><span class="re2">Default path:</span><br />
etiquette|<span class="nu0">24</span>|Caption<span class="sy0">=</span><span class="re2">Menu's slide</span><br />
etiquette|<span class="nu0">24</span>|ToolTipText<span class="sy0">=</span><span class="re2">Makes a rapid transition when you swap menus. Can be deactivated if your computer is old, or if you want to gain more speed.</span><br />

etiquette|<span class="nu0">25</span>|Caption<span class="sy0">=</span><span class="re2">Priority:</span><br />
etiquette|<span class="nu0">25</span>|ToolTipText<span class="sy0">=</span><span class="re2">Sets process priority <span class="br0">&#40;</span>affect converting speed<span class="br0">&#41;</span></span><br />
etiquette|<span class="nu0">26</span>|Caption<span class="sy0">=</span><span class="re2">Bottom Margin:000px</span><br />

etiquette|<span class="nu0">27</span>|Caption<span class="sy0">=</span><span class="re2">Top Margin:000px</span><br />
etiquette|<span class="nu0">28</span>|Caption<span class="sy0">=</span><span class="re2">Use top and bottom margin</span><br />
etiquette|<span class="nu0">29</span>|Caption<span class="sy0">=</span><span class="re2">Write page number</span><br />

etiquette|<span class="nu0">30</span>|Caption<span class="sy0">=</span><span class="re2">Select some text, and make size-range with the left sliders.</span><br />
etiquette|<span class="nu0">31</span>|Caption<span class="sy0">=</span><span class="re2">Select the color for the first char, color of the last char, and click on Apply...</span><br />
etiquette|<span class="nu0">32</span>|Caption<span class="sy0">=</span><span class="re2">Your text's containing pictures! What are you willing to do?</span><br />

etiquette|<span class="nu0">33</span>|Caption<span class="sy0">=</span><span class="re2">Make no changes <span class="br0">&#40;</span>no resize, picture larger than your player's screen will be cut<span class="br0">&#41;</span></span><br />
etiquette|<span class="nu0">34</span>|Caption<span class="sy0">=</span><span class="re2">Resize, if need be, but resize nothing but width.</span><br />
etiquette|<span class="nu0">35</span>|Caption<span class="sy0">=</span><span class="re2">Resize, if need be, width AND height.</span><br />

etiquette|<span class="nu0">36</span>|Caption<span class="sy0">=</span><span class="re2">Adapt text colors to the BG.</span><br />
etiquette|<span class="nu0">36</span>|ToolTipText<span class="sy0">=</span><span class="re2">Change the contrast between the background colors, and the text colors. BETA!</span><br />
etiquette|<span class="nu0">37</span>|Caption<span class="sy0">=</span><span class="re2">Language:</span><br />

etiquette|<span class="nu0">37</span>|ToolTipText<span class="sy0">=</span><span class="re2">Choose the language you want TXT2JPG to use</span><br />
etiquette|<span class="nu0">38</span>|Caption<span class="sy0">=</span><span class="re2">Split chapter</span><br />
etiquette|<span class="nu0">38</span>|ToolTipText<span class="sy0">=</span><span class="re2">Write the splitter-word. Each time the software will find this word, a new folder will be created. A common example of word will be 'Chapter'</span><br />

etiquette|<span class="nu0">39</span>|Caption<span class="sy0">=</span><span class="re2">Put a copy of the text in the output folder</span><br />
etiquette|<span class="nu0">39</span>|ToolTipText<span class="sy0">=</span><span class="re2">Create a copy of the text file in the output folder.</span><br />
etiquette|<span class="nu0">40</span>|Caption<span class="sy0">=</span><span class="re2">Search:</span><br />

etiquette|<span class="nu0">41</span>|Caption<span class="sy0">=</span><span class="re2">Replace by:</span><br />
<br />
<span class="co0">; Plug choice controls are tabs title; they are displayed in the first row, right after the text, above the start button. The #4 button is displayed only when #1 is active.</span><br />
PlugChoice|<span class="nu0">0</span>|Caption<span class="sy0">=</span><span class="re2">Folder settings</span><br />
PlugChoice|<span class="nu0">1</span>|Caption<span class="sy0">=</span><span class="re2">Text enhancements</span><br />

PlugChoice|<span class="nu0">2</span>|Caption<span class="sy0">=</span><span class="re2">Margin / Advanced settings</span><br />
PlugChoice|<span class="nu0">3</span>|Caption<span class="sy0">=</span><span class="re2">TXT2JPG settings</span><br />
PlugChoice|<span class="nu0">4</span>|Caption<span class="sy0">=</span><span class="re2">Add-ins</span><br />

PlugChoice|<span class="nu0">5</span>|Caption<span class="sy0">=</span><span class="re2">Advanced Text Enhancements</span><br />
<br />
<span class="co0">; Text enhancement settings are listed below</span><br />
Couleur|<span class="nu0">0</span>|ToolTipText<span class="sy0">=</span><span class="re2">Text color</span><br />
Couleur|<span class="nu0">1</span>|ToolTipText<span class="sy0">=</span><span class="re2">Highlighted text color</span><br />

Couleur|<span class="nu0">2</span>|ToolTipText<span class="sy0">=</span><span class="re2">Background color.</span><br />
MEF|<span class="nu0">0</span>|ToolTipText<span class="sy0">=</span><span class="re2">Bold</span><br />
MEF|<span class="nu0">1</span>|ToolTipText<span class="sy0">=</span><span class="re2">Italic</span><br />

MEF|<span class="nu0">2</span>|ToolTipText<span class="sy0">=</span><span class="re2">Underline</span><br />
MEF|<span class="nu0">3</span>|ToolTipText<span class="sy0">=</span><span class="re2">Strike</span><br />
MEF|<span class="nu0">4</span>|ToolTipText<span class="sy0">=</span><span class="re2">Lists</span><br />

CharMap|<span class="nu0">0</span>|ToolTipText<span class="sy0">=</span><span class="re2">See the special characters list</span><br />
Alignement|<span class="nu0">0</span>|ToolTipText<span class="sy0">=</span><span class="re2">Alignment</span><br />
Polices|<span class="nu0">0</span>|Text<span class="sy0">=</span><span class="re2">MS Sans Serif</span><br />

<br />
<span class="co0">; Add-ins descriptions</span><br />
Modules|<span class="nu0">0</span>|ToolTipText<span class="sy0">=</span><span class="re2">This add-in convert a PowerPoint presentation to JPG pictures, with the right size for your player.</span><br />
Modules|<span class="nu0">1</span>|ToolTipText<span class="sy0">=</span><span class="re2">Create color range to use for your player's background.</span><br />
Modules|<span class="nu0">2</span>|ToolTipText<span class="sy0">=</span><span class="re2">Convert Gif files to AVI. NO ENGLISH SUPPORT!</span><br />

Modules|<span class="nu0">3</span>|ToolTipText<span class="sy0">=</span><span class="re2">The Gutenberg project is a website offering thousand of royalty free books. You can download them for free, as html, txt, rtf and doc.</span><br />
Modules|<span class="nu0">4</span>|ToolTipText<span class="sy0">=</span><span class="re2">Add-in for French speakers: thousands of jokes, hundreds of funny pictures....</span><br />
Modules|<span class="nu0">5</span>|ToolTipText<span class="sy0">=</span><span class="re2">Forthcoming add-in !</span><br />

ModulesWhat|<span class="nu0">0</span>|Caption<span class="sy0">=</span><span class="re2">Add-ins</span><br />
ModulesWhat|<span class="nu0">1</span>|Caption<span class="sy0">=</span><span class="re2">About</span><br />
WhatAbout|<span class="nu0">0</span>|Text<span class="sy0">=</span><span class="re2">Data are loading...</span><br />

<br />
<span class="co0">;Right click menus</span><br />
Edition|<span class="nu0">0</span>|Caption<span class="sy0">=</span><span class="re2">Undo</span><br />
Edition|<span class="nu0">1</span>|Caption<span class="sy0">=</span><span class="re2">-</span><br />
Edition|<span class="nu0">2</span>|Caption<span class="sy0">=</span><span class="re2">Replace</span><br />

Edition|<span class="nu0">3</span>|Caption<span class="sy0">=</span><span class="re2">Search</span><br />
Edition|<span class="nu0">4</span>|Caption<span class="sy0">=</span><span class="re2">-</span><br />
Edition|<span class="nu0">5</span>|Caption<span class="sy0">=</span><span class="re2">Fitter tool</span><br />

Edition|<span class="nu0">6</span>|Caption<span class="sy0">=</span><span class="re2">Delete double new-line</span><br />
Edition|<span class="nu0">7</span>|Caption<span class="sy0">=</span><span class="re2">Font</span><br />
Edition|<span class="nu0">8</span>|Caption<span class="sy0">=</span><span class="re2">-</span><br />

Edition|<span class="nu0">9</span>|Caption<span class="sy0">=</span><span class="re2">Cut</span><br />
Edition|<span class="nu0">10</span>|Caption<span class="sy0">=</span><span class="re2">Copy</span><br />
Edition|<span class="nu0">11</span>|Caption<span class="sy0">=</span><span class="re2">Paste</span><br />

Edition|<span class="nu0">12</span>|Caption<span class="sy0">=</span><span class="re2">RTF=&gt;TXT</span><br />
Edition|<span class="nu0">13</span>|Caption<span class="sy0">=</span><span class="re2">TXT=&gt;RTF</span><br />
Edition|<span class="nu0">14</span>|Caption<span class="sy0">=</span><span class="re2">-</span><br />

Edition|<span class="nu0">15</span>|Caption<span class="sy0">=</span><span class="re2">Default settings</span><br />
Edition|<span class="nu0">16</span>|Caption<span class="sy0">=</span><span class="re2">-</span><br />
Edition|<span class="nu0">17</span>|Caption<span class="sy0">=</span><span class="re2">Horizontal line</span><br />

Edition|<span class="nu0">18</span>|Caption<span class="sy0">=</span><span class="re2">Alignment</span><br />
Edition|<span class="nu0">19</span>|Caption<span class="sy0">=</span><span class="re2">Toggle case</span><br />
Edition|<span class="nu0">20</span>|Caption<span class="sy0">=</span><span class="re2">New paragraph</span><br />

Edition|<span class="nu0">21</span>|Caption<span class="sy0">=</span><span class="re2">Superscript</span><br />
Edition|<span class="nu0">22</span>|Caption<span class="sy0">=</span><span class="re2">Subscript</span><br />
Align|<span class="nu0">0</span>|Caption<span class="sy0">=</span><span class="re2">Left alignment</span><br />

Align|<span class="nu0">1</span>|Caption<span class="sy0">=</span><span class="re2">Right alignment</span><br />
Align|<span class="nu0">2</span>|Caption<span class="sy0">=</span><span class="re2">Center</span><br />
<br />
<span class="co0">;Bug toolbar, this toolbar is displayed when you launch the soft after a crash, or when you click on &quot;Report a bug&quot;</span><br />
Bug_Texte|<span class="nu0">0</span>|CueBanner<span class="sy0">=</span><span class="re2">A bug happened? Can you say a little more in order to improve future version</span><br />

Bug_Envoi|<span class="nu0">0</span>|Caption<span class="sy0">=</span><span class="re2">Send</span><br />
Bug_Rapport|<span class="nu0">0</span>|Caption<span class="sy0">=</span><span class="re2">Report a bug</span><br />
Bug_Rapport|<span class="nu0">0</span>|ToolTipText<span class="sy0">=</span><span class="re2">Click here if you came across a bug, or if you wish to make a proposition for the software.</span><br />

<br />
<span class="co0">; The Search and replace tool bar (CTRL-F, CTRL-H) (see also etiquette|40 and etiquette|41)</span><br />
Rechercher_Suite|<span class="nu0">0</span>|Caption<span class="sy0">=</span><span class="re2">Next</span><br />
Rechercher_Close|<span class="nu0">0</span>|ToolTipText<span class="sy0">=</span><span class="re2">Close this toolbar</span><br />
<br />
<span class="co0">; About the player</span><br />

Hauteur|<span class="nu0">0</span>|Text <span class="sy0">=</span><span class="re2"> <span class="nu0">240</span></span><br />
Largeur|<span class="nu0">0</span>|Text <span class="sy0">=</span><span class="re2"> <span class="nu0">320</span></span><br />
Defaut|<span class="nu0">0</span>|ToolTipText<span class="sy0">=</span><span class="re2">Save this player as my default player</span><br />

Swap|<span class="nu0">0</span>|ToolTipText<span class="sy0">=</span><span class="re2">Swap width and height <span class="br0">&#40;</span>reverse display<span class="br0">&#41;</span></span><br />
Modeles|<span class="nu0">0</span>|Text<span class="sy0">=</span><span class="re2">&lt;Player's Name&gt;</span><br />
Marque|<span class="nu0">0</span>|Text<span class="sy0">=</span><span class="re2">&lt;Player's Mark&gt;</span><br />

<br />
<span class="co0">; Program settings</span><br />
ChoosePic|<span class="nu0">0</span>|Caption<span class="sy0">=</span><span class="re2">Select back picture</span><br />
Enregistrer|<span class="nu0">0</span>|ToolTipText<span class="sy0">=</span><span class="re2">Save this as my new name</span><br />
Enregistrer|<span class="nu0">1</span>|ToolTipText<span class="sy0">=</span><span class="re2">Save as new root folder</span><br />

Browse3|<span class="nu0">0</span>|ToolTipText<span class="sy0">=</span><span class="re2">Select the root folder:</span><br />
Langue|<span class="nu0">0</span>|ToolTipText<span class="sy0">=</span><span class="re2">Select a language for the soft.</span><br />
<br />
<span class="co0">; Button</span><br />
Abandon|<span class="nu0">0</span>|Caption<span class="sy0">=</span><span class="re2">UNDO?</span><br />

Annuler|<span class="nu0">0</span>|Caption<span class="sy0">=</span><span class="re2">Undo</span><br />
Start|<span class="nu0">0</span>|Caption<span class="sy0">=</span><span class="re2">Start</span><br />
Start|<span class="nu0">0</span>|ToolTipText<span class="sy0">=</span><span class="re2">Start converting right now!</span><br />

AppliquImage|<span class="nu0">0</span>|Caption<span class="sy0">=</span><span class="re2">Apply</span><br />
Appliquer|<span class="nu0">0</span>|Caption<span class="sy0">=</span><span class="re2">Apply</span><br />
<br />
<span class="co0">; File picking</span><br />
Dest_Folder|<span class="nu0">0</span>|CueBanner<span class="sy0">=</span><span class="re2">Folder name</span><br />

Directory|<span class="nu0">0</span>|Text<span class="sy0">=</span><span class="re2">Directory</span><br />
Browse|<span class="nu0">0</span>|ToolTipText<span class="sy0">=</span><span class="re2">Browse</span><br />
<br />
<span class="co0">; Melting pot</span><br />
VoirApercu|<span class="nu0">0</span>|Caption<span class="sy0">=</span><span class="re2">Watch preview</span><br />

KeyWord|<span class="nu0">0</span>|CueBanner<span class="sy0">=</span><span class="re2">Key Word</span><br />
Root|<span class="nu0">0</span>|CueBanner<span class="sy0">=</span><span class="re2">Root text</span><br />
UseTopAndBottomMargin|<span class="nu0">0</span>|ToolTipText<span class="sy0">=</span><span class="re2">Use top and bottom margin</span><br />

<br />
<br />
<span class="re0"><span class="br0">&#91;</span>Strings<span class="br0">&#93;</span></span><br />
<span class="co0">; String list</span><br />
<br />
String <span class="nu0">1</span><span class="sy0">=</span><span class="re2">Please select the folder where all the pictures will be created.</span><br />
String <span class="nu0">2</span><span class="sy0">=</span><span class="re2">No, I?m not bugged ! I am working...</span><br />

<br />
<span class="co0">; All the step of conversion</span><br />
String <span class="nu0">3</span><span class="sy0">=</span><span class="re2">Beginning...</span><br />
String <span class="nu0">4</span><span class="sy0">=</span><span class="re2">Copying file... <span class="br0">&#40;</span>May take some minutes, don't click anywhere<span class="br0">&#41;</span></span><br />
String <span class="nu0">5</span><span class="sy0">=</span><span class="re2">Splitting file <span class="br0">&#40;</span>%u<span class="br0">&#41;</span>...</span><br />

String <span class="nu0">6</span><span class="sy0">=</span><span class="re2">Part #</span><br />
String <span class="nu0">7</span><span class="sy0">=</span><span class="re2">Resizing pictures...</span><br />
String <span class="nu0">8</span><span class="sy0">=</span><span class="re2">Priority is set to:</span><br />
String <span class="nu0">9</span><span class="sy0">=</span><span class="re2">You are using a background picture <span class="br0">&#40;</span>%u<span class="br0">&#41;</span></span><br />

String <span class="nu0">10</span><span class="sy0">=</span><span class="re2">You are not using any background picture.</span><br />
String <span class="nu0">11</span><span class="sy0">=</span><span class="re2">Picture count will be <span class="br0">&#40;</span>ESTIMATION<span class="br0">&#41;</span>:</span><br />
String <span class="nu0">12</span><span class="sy0">=</span><span class="re2">The amount of time required to complete this operation will vary depending on your settings and your computer.</span><br />

String <span class="nu0">13</span><span class="sy0">=</span><span class="re2">Converting text to bitmap...</span><br />
String <span class="nu0">14</span><span class="sy0">=</span><span class="re2">Unloading temporary files...</span><br />
String <span class="nu0">15</span><span class="sy0">=</span><span class="re2">Converting bitmap to jpg...</span><br />
String <span class="nu0">16</span><span class="sy0">=</span><span class="re2">Done, now closing application and loading your %u pictures.</span><br />

String <span class="nu0">18</span><span class="sy0">=</span><span class="re2">Searching for updates...</span><br />
<br />
<span class="co0">; Message about Internet connection</span><br />
String <span class="nu0">19</span><span class="sy0">=</span><span class="re2">Downloading data...</span><br />
String <span class="nu0">20</span><span class="sy0">=</span><span class="re2">TXT2JPG cannot open an Internet connection. You will have to enter manually your player. Look your firewall options to correct this problem.</span><br />

<br />
<span class="co0">; Messages about Word and IE automation</span><br />
String <span class="nu0">21</span><span class="sy0">=</span><span class="re2">Opening file...</span><br />
String <span class="nu0">22</span><span class="sy0">=</span><span class="re2">File now open, getting back all compatible data...</span><br />
String <span class="nu0">23</span><span class="sy0">=</span><span class="re2">Caution: Picture will make this step longer!</span><br />

String <span class="nu0">24</span><span class="sy0">=</span><span class="re2">File read. If nothing happen, right click on this text, and select 'Paste'.</span><br />
String <span class="nu0">25</span><span class="sy0">=</span><span class="re2">Automation is open...</span><br />
String <span class="nu0">26</span><span class="sy0">=</span><span class="re2">Reading the file...</span><br />
String <span class="nu0">27</span><span class="sy0">=</span><span class="re2">Page read...</span><br />

String <span class="nu0">28</span><span class="sy0">=</span><span class="re2">Parsing for data...</span><br />
String <span class="nu0">29</span><span class="sy0">=</span><span class="re2">When you are asked permission for clipboard, click OK.</span><br />
String <span class="nu0">30</span><span class="sy0">=</span><span class="re2">Automation closed, end of conversion! If nothing happen, right click on the text and select 'Paste'.</span><br />
<br />
<span class="co0">; About PDF Files</span><br />

String <span class="nu0">31</span><span class="sy0">=</span><span class="re2">TXT2JPG is unable to open PDF files. However, you can use a website which will do the conversion for you. Do you want to do this conversion now?</span><br />
String <span class="nu0">32</span><span class="sy0">=</span><span class="re2">Media convert will be opened in your default browser....</span><br />
String <span class="nu0">33</span><span class="sy0">=</span><span class="re2">http://media-convert.us</span><br />
<br />
<span class="co0">; About LRC files</span><br />

String <span class="nu0">34</span><span class="sy0">=</span><span class="re2">Converting back to text...</span><br />
String <span class="nu0">35</span><span class="sy0">=</span><span class="re2">This LRC files contain no title, please write it manually.</span><br />
String <span class="nu0">36</span><span class="sy0">=</span><span class="re2">No <span class="re0"><span class="br0">&#91;</span>ti:<span class="br0">&#93;</span></span> found</span><br />

String <span class="nu0">37</span><span class="sy0">=</span><span class="re2">Invalid file. Try opening it as plain text?</span><br />
<br />
<span class="co0">; URL for the default URL choice, but also where people will be redirected when a new version is available.</span><br />
String <span class="nu0">38</span><span class="sy0">=</span><span class="re2">http://neamar.free.fr/txt2jpg_en/txt2jpg.php</span><br />
<br />
String <span class="nu0">47</span><span class="sy0">=</span><span class="re2">....please wait....</span><br />

String <span class="nu0">48</span><span class="sy0">=</span><span class="re2">This file type is currently not supported...</span><br />
String <span class="nu0">49</span><span class="sy0">=</span><span class="re2">The background picture is bigger than your player screen. Resize it?</span><br />
String <span class="nu0">50</span><span class="sy0">=</span><span class="re2">Please confirm!</span><br />
String <span class="nu0">52</span><span class="sy0">=</span><span class="re2">Load a file</span><br />

<br />
<span class="co0">; Do not change files pattern !</span><br />
String <span class="nu0">53</span><span class="sy0">=</span><span class="re2">BMP, JPG<span class="br0">&#40;</span>*.bmp,*.jpg<span class="br0">&#41;</span>|*.bmp</span><span class="co0">;*.jpg|Bitmap Windows(*.bmp)|*.bmp|JPEG (*.jpg)|*.jpg|GIF (*.gif)|*.gif|</span><br />
String <span class="nu0">51</span><span class="sy0">=</span><span class="re2">Text, Enhanced Text and Lyrics <span class="br0">&#40;</span>*.txt,*.rtf,*.doc,*.lrc<span class="br0">&#41;</span>|*.txt</span><span class="co0">;*.rtf;*.doc;*.lrc;*.docx|Plain text (*.txt)|*.txt|Enhanced text (*.rtf,*.doc,*.pdf)|*.rtf;*.doc;*.pdf;*.docx|Lyrics (*.lrc)|*.lrc|All files (*.*)|*.*</span><br />

String <span class="nu0">58</span><span class="sy0">=</span><span class="re2">BMP, JPG et GIF <span class="br0">&#40;</span>*.bmp,*.jpg, *.gif<span class="br0">&#41;</span>|*.bmp</span><span class="co0">;*.jpg;*.gif|Bitmap Windows (*.bmp)|*.bmp|JPEG (*.jpg)|*.jpg|GIF (*.gif)|*.gif|</span><br />
<br />
<br />
String <span class="nu0">54</span><span class="sy0">=</span><span class="re2">Load a picture</span><br />
String <span class="nu0">55</span><span class="sy0">=</span><span class="re2">Thank you for your idea, I?ll try to think about it.</span><br />

String <span class="nu0">56</span><span class="sy0">=</span><span class="re2">Report a bug, make a suggestion...</span><br />
String <span class="nu0">57</span><span class="sy0">=</span><span class="re2">Can?t display special chars.</span><br />
<br />
String <span class="nu0">59</span><span class="sy0">=</span><span class="re2">Save as:</span><br />
String <span class="nu0">60</span><span class="sy0">=</span><span class="re2">Word:</span><br />

String <span class="nu0">61</span><span class="sy0">=</span><span class="re2">Split Chapter</span><br />
String <span class="nu0">62</span><span class="sy0">=</span><span class="re2">Write here the URL of your file. You'll need at least IE <span class="nu0">4.5</span> for this to work.</span><br />
String <span class="nu0">63</span><span class="sy0">=</span><span class="re2">Download a webpage</span><br />

String <span class="nu0">64</span><span class="sy0">=</span><span class="re2">User Name:</span><br />
String <span class="nu0">65</span><span class="sy0">=</span><span class="re2">Graph : Windows XP, pack Vista Inspirat, Noia <span class="nu0">2.0</span> Xtrême, Windows Vista, Windows Media Player, skinned Thunderbird, Neamar, Char map icon, free picture on the web.</span><br />
String <span class="nu0">66</span><span class="sy0">=</span><span class="re2">Features:</span><br />

String <span class="nu0">67</span><span class="sy0">=</span><span class="re2">Search</span><br />
String <span class="nu0">68</span><span class="sy0">=</span><span class="re2">Replace</span><br />
String <span class="nu0">69</span><span class="sy0">=</span><span class="re2">Applying filter...</span><br />
String <span class="nu0">70</span><span class="sy0">=</span><span class="re2">Text size <span class="br0">&#40;</span>chars<span class="br0">&#41;</span>:</span><br />

String <span class="nu0">71</span><span class="sy0">=</span><span class="re2">Folder name</span><br />
String <span class="nu0">72</span><span class="sy0">=</span><span class="re2">&lt;Player's Mark&gt;</span><br />
<br />
<span class="co0">; The string to add after the URL to get pages in the good language</span><br />
String <span class="nu0">73</span><span class="sy0">=</span><span class="re2">txt2jpg_en</span><br />

<br />
String <span class="nu0">74</span><span class="sy0">=</span><span class="re2">&lt;Player's Name&gt;</span><br />
String <span class="nu0">76</span><span class="sy0">=</span><span class="re2">Player's Model</span><br />
String <span class="nu0">77</span><span class="sy0">=</span><span class="re2">Player's Mark</span><br />
<br />

<span class="co0">; %u : former player's name, %n : new player's name</span><br />
String <span class="nu0">78</span><span class="sy0">=</span><span class="re2">Do you really want to replace %u by %n</span><br />
String <span class="nu0">80</span><span class="sy0">=</span><span class="re2">Please confirm!</span><br />
<br />
String <span class="nu0">81</span><span class="sy0">=</span><span class="re2">Next one</span><br />

String <span class="nu0">82</span><span class="sy0">=</span><span class="re2">You don't have the bmp2jpg DLL. The software will download it automatically. If an error happens, look your firewall settings. Continue?</span><br />
String <span class="nu0">83</span><span class="sy0">=</span><span class="re2">DLL's missing</span><br />
String <span class="nu0">84</span><span class="sy0">=</span><span class="re2">Another instance is already launch! This session will auto destroy herself...click on fire to continue ?</span><br />
<br />
<span class="co0">; Default background pictures</span><br />

String <span class="nu0">86</span><span class="sy0">=</span><span class="re2">Parchment</span><br />
String <span class="nu0">87</span><span class="sy0">=</span><span class="re2">Water</span><br />
String <span class="nu0">88</span><span class="sy0">=</span><span class="re2">Earth</span><br />
String <span class="nu0">89</span><span class="sy0">=</span><span class="re2">Esoteric</span><br />

String <span class="nu0">90</span><span class="sy0">=</span><span class="re2">Stars</span><br />
String <span class="nu0">91</span><span class="sy0">=</span><span class="re2">Wave</span><br />
String <span class="nu0">92</span><span class="sy0">=</span><span class="re2">Sky</span><br />
String <span class="nu0">93</span><span class="sy0">=</span><span class="re2">Peace</span><br />

String <span class="nu0">94</span><span class="sy0">=</span><span class="re2">Aqua Wave</span><br />
String <span class="nu0">95</span><span class="sy0">=</span><span class="re2">Cristal</span><br />
String <span class="nu0">96</span><span class="sy0">=</span><span class="re2">@More...</span><br />
<br />
<br />

String <span class="nu0">98</span><span class="sy0">=</span><span class="re2">A new version of TXT2JPG is available....</span><br />
String <span class="nu0">99</span><span class="sy0">=</span><span class="re2">New version!</span><br />
<br />
String <span class="nu0">100</span><span class="sy0">=</span><span class="re2">You have been using TXT2JPg for three times.</span><br />
String <span class="nu0">101</span><span class="sy0">=</span><span class="re2">During this time, you should have grown accustomed to the software. Could you take a rapid survey <span class="br0">&#40;</span><span class="nu0">10</span> questions<span class="br0">&#41;</span> in order to improve futures versions?</span><br />

String <span class="nu0">102</span><span class="sy0">=</span><span class="re2">Loading....</span><br />
String <span class="nu0">104</span><span class="sy0">=</span><span class="re2">@Other...</span><br />
String <span class="nu0">105</span><span class="sy0">=</span><span class="re2">What is screen's height?</span><br />
String <span class="nu0">106</span><span class="sy0">=</span><span class="re2">Height</span><br />

String <span class="nu0">107</span><span class="sy0">=</span><span class="re2">What is screen's width?</span><br />
String <span class="nu0">108</span><span class="sy0">=</span><span class="re2">Width</span><br />
String <span class="nu0">109</span><span class="sy0">=</span><span class="re2"><span class="br0">&#40;</span>Other...<span class="br0">&#41;</span></span><br />
String <span class="nu0">110</span><span class="sy0">=</span><span class="re2">What is your player mark? If it hasn't a name, write 'No Name'</span><br />

String <span class="nu0">111</span><span class="sy0">=</span><span class="re2">Which model do you own?</span><br />
String <span class="nu0">112</span><span class="sy0">=</span><span class="re2">You didn't have ConvertPowerPoint.exe. Download it?</span><br />
String <span class="nu0">113</span><span class="sy0">=</span><span class="re2">You didn't have the DLL bmp2jpg.dll. Download it?</span><br />
String <span class="nu0">114</span><span class="sy0">=</span><span class="re2">You didn't have Degrade.exe. Download it?</span><br />

String <span class="nu0">115</span><span class="sy0">=</span><span class="re2">Select your player, for Degrade.exe needs to know your screen size.</span><br />
String <span class="nu0">116</span><span class="sy0">=</span><span class="re2">You didn't have GIF2AVI.exe. Download necessary files?</span><br />
String <span class="nu0">117</span><span class="sy0">=</span><span class="re2">http://www.gutenberg.org/browse/languages/en</span><br />
String <span class="nu0">118</span><span class="sy0">=</span><span class="re2">WARNING: WITH THE REAL TIME PRIORITY? YOU ARE PLAYING WITH WILD FIRE</span><span class="co0">; ONLY ONE PROCESS CAN HAVE THIS PRIORITY. THE SYSTEM MAY CRASH. BUT YOUR CONVERSION WILL BE QUICKER THAN EVER...</span><br />

String <span class="nu0">119</span><span class="sy0">=</span><span class="re2">Quality: <span class="br0">&#40;</span>%u%<span class="br0">&#41;</span></span><br />
String <span class="nu0">120</span><span class="sy0">=</span><span class="re2">Press <span class="br0">&#123;</span> %u <span class="br0">&#125;</span> keys.</span><br />
<br />
<span class="re0"><span class="br0">&#91;</span>Message<span class="br0">&#93;</span></span><br />

<span class="co0">; The tool tip messages</span><br />
<span class="co0">; IMPORTANT : Title beginning with an &quot;i&quot; are temporary information tool tip : they will be displayed twice, and not anymore. Don?t change them...</span><br />
Msg <span class="nu0">1</span><span class="sy0">=</span><span class="re2">This plain text disappoint you ?</span><br />
Msg <span class="nu0">2</span><span class="sy0">=</span><span class="re2">If you want to keep then enhanced text <span class="br0">&#40;</span>pictures, table...<span class="br0">&#41;</span>, open your browser, cut the text, paste it in Word, copy it from Word and eventually paste it here.</span><br />

Msg <span class="nu0">3</span><span class="sy0">=</span><span class="re2">Error!</span><br />
Msg <span class="nu0">4</span><span class="sy0">=</span><span class="re2">The following chars are not allowed:</span><br />
Msg <span class="nu0">5</span><span class="sy0">=</span><span class="re2">No selected text!</span><br />
Msg <span class="nu0">6</span><span class="sy0">=</span><span class="re2">Select some text from the left textbox in order to use this tool</span><br />

Msg <span class="nu0">7</span><span class="sy0">=</span><span class="re2">iOpen...</span><br />
Msg <span class="nu0">8</span><span class="sy0">=</span><span class="re2">Click to open a file on your HDD <span class="br0">&#40;</span>*.txt,*.rtf,*.doc,*.lrc<span class="br0">&#41;</span></span><br />
Msg <span class="nu0">9</span><span class="sy0">=</span><span class="re2">iWant more than color range?</span><br />
Msg <span class="nu0">10</span><span class="sy0">=</span><span class="re2">You can use a background picture for the soft! <span class="br0">&#40;</span>JPG/BMP/GIF<span class="br0">&#41;</span></span><br />

Msg <span class="nu0">11</span><span class="sy0">=</span><span class="re2">Unable to undo</span><br />
Msg <span class="nu0">12</span><span class="sy0">=</span><span class="re2">Possible reasons for this problem:</span><br />
Msg <span class="nu0">13</span><span class="sy0">=</span><span class="re2">iClick here!</span><br />
Msg <span class="nu0">14</span><span class="sy0">=</span><span class="re2">To make color range, click on both blackbox.</span><br />

Msg <span class="nu0">15</span><span class="sy0">=</span><span class="re2">iWrite here the file name</span><br />
Msg <span class="nu0">16</span><span class="sy0">=</span><span class="re2">Converted images will be saved in this folder, which will automatically pop-up once the conversion ended.</span><br />
Msg <span class="nu0">17</span><span class="sy0">=</span><span class="re2">iOpen...</span><br />
Msg <span class="nu0">18</span><span class="sy0">=</span><span class="re2">Clic to open an Internet filer, located either on your HDD or on the web <span class="br0">&#40;</span>you will need IE <span class="nu0">4.5</span> or later<span class="br0">&#41;</span></span><br />

Msg <span class="nu0">19</span><span class="sy0">=</span><span class="re2">iQuality</span><br />
Msg <span class="nu0">20</span><span class="sy0">=</span><span class="re2">Sets the output JPG quality. The bigger the quality is, the best the pictures are, and the biggest their sizes.</span><br />
Msg <span class="nu0">21</span><span class="sy0">=</span><span class="re2">Invalid root!</span><br />
Msg <span class="nu0">22</span><span class="sy0">=</span><span class="re2">This field let you select a root name for your pictures.</span><br />

Msg <span class="nu0">23</span><span class="sy0">=</span><span class="re2">iRoot field</span><br />
Msg <span class="nu0">24</span><span class="sy0">=</span><span class="re2">This field let you select a prefix name for your pictures. Converted pictures will be names &lt;folder&gt;\&lt;prefix&gt;XXXX.jpg, where XXXX stands for the number.</span><br />
Msg <span class="nu0">25</span><span class="sy0">=</span><span class="re2">iTop and bottom margin configured</span><br />

Msg <span class="nu0">26</span><span class="sy0">=</span><span class="re2">Each picture will inherit of your change <span class="br0">&#40;</span>invisible in the text overview<span class="br0">&#41;</span></span><br />
Msg <span class="nu0">27</span><span class="sy0">=</span><span class="re2">iSplit the chapter</span><br />
Msg <span class="nu0">28</span><span class="sy0">=</span><span class="re2">This settings create sub folders in the main folder, each subfolder containing a chapter. This splitting takes place every time the software meets the word written in the right textbox.</span><br />
Msg <span class="nu0">29</span><span class="sy0">=</span><span class="re2">iPriority</span><br />

Msg <span class="nu0">30</span><span class="sy0">=</span><span class="re2">If you have really long text, you can gain some speed by setting the priority. I advise you to choose ABOVE_NORMAL_PRIORITY_CLASS.</span><br />
Msg <span class="nu0">31</span><span class="sy0">=</span><span class="re2">Replace successful</span><br />
Msg <span class="nu0">32</span><span class="sy0">=</span><span class="re2"> matches found and replaced <span class="br0">&#40;</span>case sensitive<span class="br0">&#41;</span></span><br />

Msg <span class="nu0">33</span><span class="sy0">=</span><span class="re2">iNetwork name</span><br />
Msg <span class="nu0">34</span><span class="sy0">=</span><span class="re2">This field let you choose the name that will be displayed when TXT2JPG download datas, such as the players list.</span><br />
Msg <span class="nu0">35</span><span class="sy0">=</span><span class="re2">iRoot field</span><br />
Msg <span class="nu0">36</span><span class="sy0">=</span><span class="re2">This field let you select the root for the converted picture. They will all be saved in this folder.</span><br />

Msg <span class="nu0">37</span><span class="sy0">=</span><span class="re2">No text selected!</span><br />
Msg <span class="nu0">38</span><span class="sy0">=</span><span class="re2">Select some text in the left textbox to use this tool</span><br />
Msg <span class="nu0">39</span><span class="sy0">=</span><span class="re2">Invalid file name!</span><br />
Msg <span class="nu0">40</span><span class="sy0">=</span><span class="re2">Windows disallow the use of this characters for folder name: &nbsp;\ / : * ? &nbsp;&lt; &gt;</span><br />

Msg <span class="nu0">41</span><span class="sy0">=</span><span class="re2">iSave in JPG</span><br />
Msg <span class="nu0">42</span><span class="sy0">=</span><span class="re2">Click here to save your pictures as a JPG file <span class="br0">&#40;</span>default is BMP<span class="br0">&#41;</span>. I advise you to save in JPG, and to select a quality of <span class="nu0">75</span>%.</span><br />
Msg <span class="nu0">43</span><span class="sy0">=</span><span class="re2">Useless!</span><br />

Msg <span class="nu0">44</span><span class="sy0">=</span><span class="re2">There is no need to set the background color, since you are using a background picture. Setting the background color will be useless...</span><br />
Msg <span class="nu0">45</span><span class="sy0">=</span><span class="re2">Unable to do this!</span><br />
Msg <span class="nu0">46</span><span class="sy0">=</span><span class="re2">Text color and background color are the same one.</span><br />
<br />
Msg <span class="nu0">49</span><span class="sy0">=</span><span class="re2">Is downloading...</span><br />

Msg <span class="nu0">50</span><span class="sy0">=</span><span class="re2">Your DLL is downloading, please be patient...</span><br />
Msg <span class="nu0">51</span><span class="sy0">=</span><span class="re2">Can't find this picture!</span><br />
Msg <span class="nu0">52</span><span class="sy0">=</span><span class="re2">This picture does not exist anymore. Try another one</span><br />
Msg <span class="nu0">53</span><span class="sy0">=</span><span class="re2">File not allowed !</span><br />

Msg <span class="nu0">54</span><span class="sy0">=</span><span class="re2">You can use BMP,JPG ang GIF files.</span><br />
Msg <span class="nu0">55</span><span class="sy0">=</span><span class="re2">Welcome !</span><br />
Msg <span class="nu0">56</span><span class="sy0">=</span><span class="re2">Welcome to TXT2JPG. You are not speaking French? Click on this tab, and select your language.</span><br />
Msg <span class="nu0">57</span><span class="sy0">=</span><span class="re2">iEnable Page number</span><br />

Msg <span class="nu0">58</span><span class="sy0">=</span><span class="re2">Each page will wore a number and a progress bar. You can set the size of this information using the bottom margin slider.</span><br />
Msg <span class="nu0">59</span><span class="sy0">=</span><span class="re2">Invalid size</span><br />
Msg <span class="nu0">60</span><span class="sy0">=</span><span class="re2">This screen size does not exist, try another player.</span><br />
Msg <span class="nu0">61</span><span class="sy0">=</span><span class="re2">Player added</span><br />

Msg <span class="nu0">62</span><span class="sy0">=</span><span class="re2">Thanks for your contribution! Close the soft and launch it again to see your player in the list.</span><br />
Msg <span class="nu0">63</span><span class="sy0">=</span><span class="re2">An error occur!</span><br />
Msg <span class="nu0">64</span><span class="sy0">=</span><span class="re2">Your player setting might be misloaded. If the displayed data are not the correct one, launch again the program.</span><br />
Msg <span class="nu0">65</span><span class="sy0">=</span><span class="re2">Please confirm!</span><br />

Msg <span class="nu0">66</span><span class="sy0">=</span><span class="re2">This folder name is already existing. Existing files with the same pattern <span class="br0">&#40;</span>%u/0XXXX.jpg<span class="br0">&#41;</span> will be erased. You had better to change the name.</span><br />
Msg <span class="nu0">67</span><span class="sy0">=</span><span class="re2">iPut a copy of my file in the folder</span><br />
Msg <span class="nu0">68</span><span class="sy0">=</span><span class="re2">If you are editing your text with TXT2JPF, enable this option : a copy of your text file will be put with your images, and will open again the next time you launch TXT2JPG.</span><br />

Msg <span class="nu0">69</span><span class="sy0">=</span><span class="re2">iSave this Player</span><br />
Msg <span class="nu0">70</span><span class="sy0">=</span><span class="re2">Save the current player in memory, and select it as the default one for each projet.</span><br />
Msg <span class="nu0">71</span><span class="sy0">=</span><span class="re2">iBackground Picture</span><br />
MSg <span class="nu0">72</span><span class="sy0">=</span><span class="re2">The default background for your picture is the background-color. However, you can select a picture to use as basckground, or as cover.</span></div></fieldset>

<h3>Fichier d'installation :</h3>
<p>Le fichier setup est généré à l'aide du logiciel libre InnoSetup.<br />
Le fichier présenté ici contient des paths incorrects qu'il faudra remplacer par les vôtres si vous souhaitez compiler l'application.</p>
<fieldset>
<legend>Code source : <a href="Codes/setupscript.iss" title="Télecharger le fichier">setupscript.iss</a></legend>
<div class="inno" style="font-family: monospace;"><div class="head"><ul><li>Langage : <em>inno</em></li><li>&Delta;T : <em>0.239s</em></li><li>Taille :4610 caractères</li></ul></div>; Script generated by the Inno <span class="kw1">Setup</span> Script Wizard.<br />

; SEE THE DOCUMENTATION <span class="kw2">FOR</span> DETAILS <span class="kw2">ON</span> CREATING INNO <span class="kw1">SETUP</span> SCRIPT <span class="kw1">FILES</span>!<br />
<br />
<span class="br0">&#91;</span><span class="kw1">Setup</span><span class="br0">&#93;</span><br />
<span class="kw3">AppName</span>=TXT2JPG<br />

<span class="kw3">AppVerName</span>=TXT2JPG <span class="nu0">1.3</span><br />
<span class="kw3">AppPublisher</span>=Neamar<br />
<span class="kw3">AppPublisherURL</span>=http:<span class="co1">//neamar.free.fr/txt2jpg/txt2jpg.php</span><br />
<span class="kw3">AppSupportURL</span>=http:<span class="co1">//neamar.free.fr/txt2jpg/txt2jpg.php</span><br />
<span class="kw3">AppUpdatesURL</span>=http:<span class="co1">//neamar.free.fr/Addins/Zen.php?version=1</span><br />

<span class="kw3">DefaultDirName</span>=<span class="br0">&#123;</span><span class="kw1">pf</span><span class="br0">&#125;</span>\TXT2JPG<br />
<span class="kw3">DefaultGroupName</span>=TXT2JPG<br />
<span class="kw3">LicenseFile</span>=C:\Documents <span class="kw2">and</span> Settings\FAMILLE\Bureau\Programmation MATTHIEU\Neamar Games VB\TXT2JPg\Images\licence.<span class="me1">rtf</span><br />
;InfoBeforeFile=C:\Documents <span class="kw2">and</span> Settings\FAMILLE\Bureau\Programmation MATTHIEU\Neamar Games VB\TXT2JPg\avant.<span class="me1">rtf</span><br />

<span class="kw3">OutputBaseFilename</span>=<span class="kw1">setup</span><br />
<span class="kw3">Compression</span>=lzma<br />
<span class="kw3">SolidCompression</span>=yes<br />
<br />
<span class="br0">&#91;</span><span class="kw1">Languages</span><span class="br0">&#93;</span><br />
<span class="kw3">Name</span>: <span class="st0">&quot;english&quot;</span>; <span class="kw3">MessagesFile</span>: <span class="st0">&quot;compiler:Default.isl&quot;</span><br />

<span class="kw3">Name</span>: <span class="st0">&quot;french&quot;</span>; <span class="kw3">MessagesFile</span>: <span class="st0">&quot;compiler:Languages\French.isl&quot;</span><br />
<br />
<span class="br0">&#91;</span><span class="kw1">Tasks</span><span class="br0">&#93;</span><br />
<span class="kw3">Name</span>: <span class="st0">&quot;desktopicon&quot;</span>; <span class="kw3">Description</span>: <span class="st0">&quot;{cm:CreateDesktopIcon}&quot;</span>; <span class="kw3">GroupDescription</span>: <span class="st0">&quot;{cm:AdditionalIcons}&quot;</span>;<br />

<span class="kw3">Name</span>: <span class="st0">&quot;quicklaunchicon&quot;</span>; <span class="kw3">Description</span>: <span class="st0">&quot;{cm:CreateQuickLaunchIcon}&quot;</span>; <span class="kw3">GroupDescription</span>: <span class="st0">&quot;{cm:AdditionalIcons}&quot;</span>; <span class="kw3">Flags</span>: <span class="kw2">unchecked</span><br />
<br />

<span class="br0">&#91;</span><span class="kw1">Files</span><span class="br0">&#93;</span><br />
<span class="kw3">Source</span>: <span class="st0">&quot;C:\Documents and Settings\FAMILLE\Bureau\Programmation MATTHIEU\Neamar Games VB\TXT2JPg\TXT2JPG.exe&quot;</span>; <span class="kw3">DestDir</span>: <span class="st0">&quot;{app}&quot;</span>; <span class="kw3">Flags</span>: <span class="kw2">ignoreversion</span><br />
<span class="kw3">Source</span>: <span class="st0">&quot;C:\Documents and Settings\FAMILLE\Bureau\Programmation MATTHIEU\Neamar Games VB\TXT2JPg\RICHTX32.OCX&quot;</span>; <span class="kw3">DestDir</span>: <span class="st0">&quot;{app}&quot;</span>; <span class="kw3">Flags</span>: <span class="kw2">ignoreversion</span><br />

;Images<br />
<span class="kw3">Source</span>: <span class="st0">&quot;C:\Documents and Settings\FAMILLE\Bureau\Programmation MATTHIEU\Neamar Games VB\TXT2JPg\Images\Cristal.jpg&quot;</span>; <span class="kw3">DestDir</span>: <span class="st0">&quot;{app}&quot;</span>; <span class="kw3">Flags</span>: <span class="kw2">ignoreversion</span><br />
<span class="kw3">Source</span>: <span class="st0">&quot;C:\Documents and Settings\FAMILLE\Bureau\Programmation MATTHIEU\Neamar Games VB\TXT2JPg\Images\parchment.jpg&quot;</span>; <span class="kw3">DestDir</span>: <span class="st0">&quot;{app}&quot;</span>; <span class="kw3">Flags</span>: <span class="kw2">ignoreversion</span><br />

<span class="kw3">Source</span>: <span class="st0">&quot;C:\Documents and Settings\FAMILLE\Bureau\Programmation MATTHIEU\Neamar Games VB\TXT2JPg\Images\earth.jpg&quot;</span>; <span class="kw3">DestDir</span>: <span class="st0">&quot;{app}&quot;</span>; <span class="kw3">Flags</span>: <span class="kw2">ignoreversion</span><br />
<span class="kw3">Source</span>: <span class="st0">&quot;C:\Documents and Settings\FAMILLE\Bureau\Programmation MATTHIEU\Neamar Games VB\TXT2JPg\Images\aqua.jpg&quot;</span>; <span class="kw3">DestDir</span>: <span class="st0">&quot;{app}&quot;</span>; <span class="kw3">Flags</span>: <span class="kw2">ignoreversion</span><br />

<span class="kw3">Source</span>: <span class="st0">&quot;C:\Documents and Settings\FAMILLE\Bureau\Programmation MATTHIEU\Neamar Games VB\TXT2JPg\Images\sky.jpg&quot;</span>; <span class="kw3">DestDir</span>: <span class="st0">&quot;{app}&quot;</span>; <span class="kw3">Flags</span>: <span class="kw2">ignoreversion</span><br />
<span class="kw3">Source</span>: <span class="st0">&quot;C:\Documents and Settings\FAMILLE\Bureau\Programmation MATTHIEU\Neamar Games VB\TXT2JPg\Images\wave.jpg&quot;</span>; <span class="kw3">DestDir</span>: <span class="st0">&quot;{app}&quot;</span>; <span class="kw3">Flags</span>: <span class="kw2">ignoreversion</span><br />

<span class="kw3">Source</span>: <span class="st0">&quot;C:\Documents and Settings\FAMILLE\Bureau\Programmation MATTHIEU\Neamar Games VB\TXT2JPg\Images\stars.jpg&quot;</span>; <span class="kw3">DestDir</span>: <span class="st0">&quot;{app}&quot;</span>; <span class="kw3">Flags</span>: <span class="kw2">ignoreversion</span><br />
<span class="kw3">Source</span>: <span class="st0">&quot;C:\Documents and Settings\FAMILLE\Bureau\Programmation MATTHIEU\Neamar Games VB\TXT2JPg\Images\sign.jpg&quot;</span>; <span class="kw3">DestDir</span>: <span class="st0">&quot;{app}&quot;</span>; <span class="kw3">Flags</span>: <span class="kw2">ignoreversion</span><br />

<span class="kw3">Source</span>: <span class="st0">&quot;C:\Documents and Settings\FAMILLE\Bureau\Programmation MATTHIEU\Neamar Games VB\TXT2JPg\Images\Paix.jpg&quot;</span>; <span class="kw3">DestDir</span>: <span class="st0">&quot;{app}&quot;</span>; <span class="kw3">Flags</span>: <span class="kw2">ignoreversion</span><br />
<span class="kw3">Source</span>: <span class="st0">&quot;C:\Documents and Settings\FAMILLE\Bureau\Programmation MATTHIEU\Neamar Games VB\TXT2JPg\Images\Ondines.jpg&quot;</span>; <span class="kw3">DestDir</span>: <span class="st0">&quot;{app}&quot;</span>; <span class="kw3">Flags</span>: <span class="kw2">ignoreversion</span><br />

<br />
;Fichiers systèmes<br />
<span class="kw3">Source</span>: <span class="st0">&quot;C:\WINDOWS\system32\VB6FR.DLL&quot;</span>; <span class="kw3">DestDir</span>: <span class="st0">&quot;{win}\system32&quot;</span>;<br />
<span class="kw3">Source</span>: <span class="st0">&quot;C:\WINDOWS\system32\oleaut32.dll&quot;</span>; <span class="kw3">DestDir</span>: <span class="st0">&quot;{win}\system32&quot;</span>;<br />

<span class="kw3">Source</span>: <span class="st0">&quot;C:\WINDOWS\system32\MSVBVM60.DLL&quot;</span>; <span class="kw3">DestDir</span>: <span class="st0">&quot;{win}\system32&quot;</span>;<br />
<span class="kw3">Source</span>: <span class="st0">&quot;C:\WINDOWS\system32\olepro32.dll&quot;</span>; <span class="kw3">DestDir</span>: <span class="st0">&quot;{win}\system32&quot;</span>;<br />

<span class="kw3">Source</span>: <span class="st0">&quot;C:\WINDOWS\system32\stdole2.tlb&quot;</span>; <span class="kw3">DestDir</span>: <span class="st0">&quot;{win}\system32&quot;</span>;<br />
<span class="kw3">Source</span>: <span class="st0">&quot;C:\WINDOWS\system32\asycfilt.dll&quot;</span>; <span class="kw3">DestDir</span>: <span class="st0">&quot;{win}\system32&quot;</span>;<br />

<span class="kw3">Source</span>: <span class="st0">&quot;C:\WINDOWS\system32\comcat.dll&quot;</span>; <span class="kw3">DestDir</span>: <span class="st0">&quot;{win}\system32&quot;</span>;<br />
<span class="kw3">Source</span>: <span class="st0">&quot;C:\Documents and Settings\FAMILLE\Bureau\Programmation MATTHIEU\Neamar Games VB\TXT2JPg\BMP2JPG.dll&quot;</span>; <span class="kw3">DestDir</span>: <span class="st0">&quot;{win}\system32&quot;</span>;<br />

;Y a plus besoin du .<span class="me1">ocx</span> !<br />
;Source: <span class="st0">&quot;C:\Documents and Settings\FAMILLE\Bureau\Programmation MATTHIEU\Neamar Games VB\TXT2JPg\COMDLG32.OCX&quot;</span>; <span class="kw3">DestDir</span>: <span class="st0">&quot;{win}\system32&quot;</span>; <span class="kw3">Flags</span>: <span class="kw2">regserver</span>;<br />

&nbsp;<br />
<span class="br0">&#91;</span><span class="kw1">INI</span><span class="br0">&#93;</span><br />
<span class="kw3">Filename</span>: <span class="st0">&quot;{app}\TXT2JPG.url&quot;</span>; <span class="kw3">Section</span>: <span class="st0">&quot;InternetShortcut&quot;</span>; <span class="kw3">Key</span>: <span class="st0">&quot;URL&quot;</span>; <span class="kw4">String</span>: <span class="st0">&quot;http://neamar.free.fr/txt2jpg/txt2jpg.php&quot;</span><br />

<br />
<span class="br0">&#91;</span><span class="kw1">Icons</span><span class="br0">&#93;</span><br />
<span class="kw3">Name</span>: <span class="st0">&quot;{group}\TXT2JPG&quot;</span>; <span class="kw3">Filename</span>: <span class="st0">&quot;{app}\TXT2JPG.exe&quot;</span>; <span class="kw3">WorkingDir</span>: <span class="st0">&quot;{app}&quot;</span><br />
<span class="kw3">Name</span>: <span class="st0">&quot;{group}\{cm:ProgramOnTheWeb,TXT2JPG}&quot;</span>; <span class="kw3">Filename</span>: <span class="st0">&quot;{app}\TXT2JPG.url&quot;</span><br />

<span class="kw3">Name</span>: <span class="st0">&quot;{group}\{cm:UninstallProgram,TXT2JPG}&quot;</span>; <span class="kw3">Filename</span>: <span class="st0">&quot;{uninstallexe}&quot;</span><br />
<span class="kw3">Name</span>: <span class="st0">&quot;{userdesktop}\TXT2JPG&quot;</span>; <span class="kw3">Filename</span>: <span class="st0">&quot;{app}\TXT2JPG.exe&quot;</span>; <span class="kw1">Tasks</span>: desktopicon<br />

<span class="kw3">Name</span>: <span class="st0">&quot;{userappdata}\Microsoft\Internet Explorer\Quick Launch\TXT2JPG&quot;</span>; <span class="kw3">Filename</span>: <span class="st0">&quot;{app}\TXT2JPG.exe&quot;</span>; <span class="kw1">Tasks</span>: quicklaunchicon<br />
<br />
<span class="br0">&#91;</span><span class="kw1">Run</span><span class="br0">&#93;</span><br />
<span class="kw3">Filename</span>: <span class="st0">&quot;{app}\TXT2JPG.exe&quot;</span>; <span class="kw3">Description</span>: <span class="st0">&quot;{cm:LaunchProgram,TXT2JPG}&quot;</span>; <span class="kw3">Flags</span>: <span class="kw2">nowait</span> <span class="kw2">postinstall</span> <span class="kw2">skipifsilent</span><br />

<br />
<span class="br0">&#91;</span><span class="kw1">UninstallDelete</span><span class="br0">&#93;</span><br />
<span class="kw2">Type</span>: <span class="kw1">files</span>; <span class="kw3">Name</span>: <span class="st0">&quot;{app}\TXT2JPG.url&quot;</span><br />
<br />
&nbsp;</div></fieldset>