Attribute VB_Name = "Fonctions"
'--------------------------------------------------------------------------------
'    Component  : Fonctions
'    Project    : TXT2JPG
'
'    Description:
'Module utilisé pour le subclassing
'Et pour trouver le chemin des fichiers spéciaux
'Et pour afficher un comdlg, un colorpicker et un select folder
'Et pour des petites fonctions : Min, MyMid
'Et pour SetBackColorSel
'Bref, toutes les petites fonctions qui ne trouvaient leurs places nulle part..
'
'    Modified   :
'--------------------------------------------------------------------------------
'
Option Explicit

'Quasiment l'API principale...pour tout les messages Windows
Public Declare Function SendMessage Lib "user32" Alias "SendMessageA" (ByVal hwnd As Long, ByVal wMsg As Long, ByVal wParam As Long, lParam As Any) As Long

'
Private Declare Function GetPrivateProfileString Lib "kernel32" Alias "GetPrivateProfileStringA" (ByVal lpApplicationName As String, ByVal lpKeyName As Any, ByVal lpDefault As String, ByVal lpReturnedString As String, ByVal nSize As Long, ByVal lpFileName As String) As Long



'Choix d'un fichier : type des données envoyées
Private Type OPENFILENAME

    lStructSize As Long
    hWndOwner As Long
    hInstance As Long
    lpstrFilter As String
    lpstrCustomFilter As String
    nMaxCustFilter As Long
    nFilterIndex As Long
    lpstrFile As String
    nMaxFile As Long
    lpstrFileTitle As String
    nMaxFileTitle As Long
    lpstrInitialDir As String
    lpstrTitle As String
    flags As Long
    nFileOffset As Integer
    nFileExtension As Integer
    lpstrDefExt As String
    lCustData As Long
    lpfnHook As Long
    lpTemplateName As String

End Type

'Choix d'un dossier : type des données envoyées
Private Type BrowseInfo

    hWndOwner As Long
    pIDLRoot As Long
    pszDisplayName As Long
    lpszTitle As Long
    ulFlags As Long
    lpfnCallback As Long
    lParam As Long
    iImage As Long

End Type

'Choix de couleur : type des données envoyées
Private Type ChooseColor

    lStructSize As Long
    hWndOwner As Long
    hInstance As Long
    rgbResult As Long
    lpCustColors As String
    flags As Long
    lCustData As Long
    lpfnHook As Long
    lpTemplateName As String

End Type

'Pour les dossiers spéciaux :
Private Type SHITEMID

    CB As Long
    abID As Byte

End Type

'
Private Type ITEMIDLIST

    mkid As SHITEMID

End Type

'
Private Declare Function SHGetSpecialFolderLocation Lib "shell32.dll" (ByVal hWndOwner As Long, ByVal nFolder As Long, pidl As ITEMIDLIST) As Long

Private Declare Function SHGetPathFromIDList Lib "shell32.dll" Alias "SHGetPathFromIDListA" (ByVal pidl As Long, ByVal pszPath As String) As Long

'Grise le bouton de fermeture de la feuille pendant la numérisation :
Private Declare Function GetMenuItemCount Lib "user32" (ByVal hMenu As Long) As Long

Private Declare Function GetSystemMenu Lib "user32" (ByVal hwnd As Long, ByVal bRevert As Long) As Long

Private Declare Function DeleteMenu Lib "user32" (ByVal hMenu As Long, ByVal nPosition As Long, ByVal wFlags As Long) As Long

Private Declare Function DrawMenuBar Lib "user32" (ByVal hwnd As Long) As Long

Private Const SC_CLOSE     As Long = &HF060&

Private Const MF_BYCOMMAND As Long = &H0&

Private Const MF_BYPOSITION = &H400&

' Déclaration de fonctions API
'ComDlg
Private Declare Function GetOpenFileName Lib "comdlg32.dll" Alias "GetOpenFileNameA" (pOpenfilename As OPENFILENAME) As Long

'ColorPicker
Private Declare Function ChooseColorAPI Lib "comdlg32.dll" Alias "ChooseColorA" (pChoosecolor As ChooseColor) As Long

'File picker
Private Declare Function SHBrowseForFolder Lib "shell32" (lpbi As BrowseInfo) As Long

'Private Declare Function SHGetPathFromIDList Lib "shell32" (ByVal pidList As Long,ByVal lpBuffer As String) As Long
Private Declare Function lstrcat Lib "kernel32" Alias "lstrcatA" (ByVal lpString1 As String, ByVal lpString2 As String) As Long

'Constantes
'Pour le select folder
Private Const BIF_RETURNONLYFSDIRS = 1

Private Const BIF_DONTGOBELOWDOMAIN = 2

Public Const BIF_USENEWUI = &H40

'Pour le comdlg file :
Public Enum esFlags

    OFN_ALLOWMULTISELECT = &H200
    OFN_CREATEPROMPT = &H2000
    OFN_ENABLEHOOK = &H20
    OFN_ENABLETEMPLATEHANDLE = &H80
    OFN_EXPLORER = &H80000
    OFN_EXTENSIONDIFFERENT = &H400
    OFN_FILEMUSTEXIST = &H1000
    OFN_HIDEREADONLY = &H4
    OFN_LONGNAMES = &H200000
    OFN_NOCHANGEDIR = &H8
    OFN_NODEREFERENCELINKS = &H100000
    OFN_NOLONGNAMES = &H40000
    OFN_NONETWORKBUTTON = &H20000
    OFN_NOREADONLYRETURN = &H8000
    OFN_NOTESTFILECREATE = &H10000
    OFN_NOVALIDATE = &H100
    OFN_OVERWRITEPROMPT = &H2
    OFN_PATHMUSTEXIST = &H800
    OFN_READONLY = &H1
    OFN_SHAREAWARE = &H4000
    OFN_SHOWHELP = &H10

End Enum

'Pour le color picker :
Dim CustomColors() As Byte

Private Const LF_FACESIZE = 32

' Format structure, passé avec SendMessage au contrôle pour changer le backcolor
Private Type FORMAT

    cbSize As Integer
    wPad1 As Integer
    dwMask As Long
    dwEffects As Long
    yHeight As Long
    yOffset As Long
    crTextColor As Long
    bCharSet As Byte
    bPitchAndFamily As Byte
    szFaceName(0 To LF_FACESIZE - 1) As Byte
    wPad2 As Integer
    wWeight As Integer
    sSpacing As Integer
    crBackColor As Long
    lLCID As Long
    dwReserved As Long
    sStyle As Integer
    wKerning As Integer
    bUnderlineType As Byte
    bAnimation As Byte
    bRevAuthor As Byte
    bReserved1 As Byte

End Type

Private Const SCF_SELECTION = &H1&

Private Const WM_USER = &H400

' pour recuperer les messages et text avec richtextbox
Private Const EM_SETCHARFORMAT = (WM_USER + 68)

' pour Font et BackColor
Private Const CFM_BACKCOLOR = &H4000000

Private Const CFE_AUTOBACKCOLOR = CFM_BACKCOLOR

Public Type ResultConstant
    URL As String
    EstUnLiens As Boolean
    Email As Boolean
    interne As Boolean
End Type
Private Type POINTAPI
    X       As Long
    Y       As Long
End Type



Public Stockage As String

'Empeche le rafraichissement d'un controle
Public Declare Function LockWindowUpdate Lib "user32" (ByVal hwndLock As Long) As Long
Private Declare Function GetParent Lib "user32" (ByVal hwnd As Long) As Long

Private Type RECT
    Left As Long
    Top As Long
    Right As Long
    Bottom As Long
End Type

Dim Rectangle As RECT

Private Const EM_GETRECT = &HB2
Private Const EM_SETRECT = &HB3

'Faire un son pour l'infobulle
Private Declare Function MessageBeep Lib "user32" (ByVal wType As Long) As Long

Public Sub ShowHelpFor(controle As Control, MessageTitre As String, MessageTexte As String)
    If Principale.BallonTip.Left <> controle.Width \ 2 + controle.Left - Principale.BallonTip.Width + 18 + controle.Container.Left Or Principale.BallonTip.Top <> controle.Top + controle.Height + controle.Container.Top Then AfficherTip MessageTitre, MessageTexte, controle
End Sub

'Sub pour l'affichage d'une infobulle style XP. Possibilité de définir un son, recoit l'id du message et va chercher dans le fichier ini la traduction
Public Sub AfficherTip(Titre As String, Contenu As String, ctl As Control, Optional SoundToPlay As Long = 0)
    On Error Resume Next
    If Left$(Titre, 1) = "i" Then

        'L'infobulle n'est qu'une simple information qui ne sera affichée qu'une seule fois.
        If GetSetting("TXT2JPG", "ShownTip", Left$(Titre, 4) & Left$(Contenu, 2), 0) > 1 Then Exit Sub
        SaveSetting "TXT2JPG", "ShownTip", Left$(Titre, 4) & Left$(Contenu, 2), GetSetting("TXT2JPG", "ShownTip", Left$(Titre, 4) & Left$(Contenu, 2), 0) + 1
        Titre = Right$(Titre, Len(Titre) - 1)
        Principale.MouseOutProc.Tag = ctl.hwnd
        Principale.MouseOutProc.Enabled = True
    End If

    Principale.BallonTip.Top = ctl.Top + ctl.Height + ctl.Container.Top
    Principale.BallonTip.Left = ctl.Width \ 2 + ctl.Left - Principale.BallonTip.Width + 18 + ctl.Container.Left
    Principale.BallonTip.Titre = Titre
    Principale.BallonTip.Text = Contenu
    Principale.BallonTip.Visible = True

    If SoundToPlay <> False And SoundToPlay <> True Then MessageBeep SoundToPlay
    '    Dim pt As POINTAPIre
    '
    '    pt.x = 0: pt.y = 0
    '    On Error GoTo cantshow
    '    If Not (Me.ActiveControl = ctl) And ExitOnUnFocus Then Exit Sub
    'cantshow:
    '    If Left$(Titre, 1) = "i" Then
    '        'L'infobulle n'est qu'une simple information qui ne sera affichée qu'une seule fois.
    '        If GetSetting("TXT2JPG", "ShownTip", Left$(Titre, 4) & Left$(English_Titre, 4) & Left$(Contenu, 2), 0) > 1 Then Exit Sub
    '        SaveSetting "TXT2JPG", "ShownTip", Left$(Titre, 4) & Left$(English_Titre, 4) & Left$(Contenu, 2), GetSetting("TXT2JPG", "ShownTip", Left$(Titre, 4) & Left$(English_Titre, 4) & Left$(Contenu, 2), 0) + 1
    '        Titre = Right(Titre, Len(Titre) - 1)
    '    End If
    '    'Affiche un message dans une infobulle
    '    'D'abord l'arrière plan : (un simple blit..mais avec des screentoclient^-1)
    '    BallonTip.Visible = False
    '    'Afficher une icone si critique !
    '    BallonTipCaption.Left = IIf(SoundToPlay = vbCritical, 55, 14)
    '    BallonTipCaption.Width = IIf(SoundToPlay = vbCritical, 255, 302)
    '    BallonTipCritique.Visible = IIf(SoundToPlay = vbCritical, True, False)
    '    BallonTip.Top = ctl.Top + ctl.Height + ctl.Container.Top
    '    BallonTip.Left = ctl.Width \ 2 + ctl.Left - BallonTip.Width + 18 + ctl.Container.Left
    '    DoEvents
    '    ClientToScreen BallonTip.hWnd, pt
    '    BitBlt BallonTip.hdc, 0, 0, 327, 113, GetDC(0), pt.x, pt.y, vbSrcCopy
    '
    '    TransparentBlt BallonTip.hdc, 0, 0, 327, 113, BallonTipPic.hdc, 0, 0, 327, 113, RGB(255, 255, 255)
    '    If Selected_Language = "Francais" Then
    '        BallonTipTitre = Titre
    '        BallonTipCaption = Contenu
    '    Else
    '        BallonTipTitre = English_Titre
    '        BallonTipCaption = English_Contenu
    '    End If
    '    If SoundToPlay <> 0 Then MessageBeep SoundToPlay
    '
    '    'Remettre la croix à vide
    '    BallonTipCancel(0).Visible = True
    '    BallonTipCancel(1).Visible = False
    '    BallonTip.Visible = True
End Sub


Public Sub TextBoxMargins(TextBox As RichTextBox, ByVal LeftMargin As Variant, ByVal TopMargin As Variant, ByVal RightMargin As Variant, ByVal BottomMargin As Variant)

  Dim nRect As RECT
  
  TextBoxResetRect TextBox
  With TextBox
    SendMessage .hwnd, EM_GETRECT, 0, nRect
        With nRect
            .Left = LeftMargin
            .Top = TopMargin
            .Right = TextBox.Width - RightMargin
            .Bottom = TextBox.Height - BottomMargin
        End With
        SendMessage .hwnd, EM_SETRECT, 0, nRect
  End With
End Sub
Private Sub TextBoxResetRect(TextBox As RichTextBox)
  Dim nWidth As Single

  With TextBox
    LockWindowUpdate GetParent(.hwnd)
    nWidth = .Width
    .Width = 1
    .Width = nWidth
    LockWindowUpdate 0
  End With
End Sub
Public Function LoadString(ID As Long) As String
    'Lire dans le fichier INi pour les langues
    Dim Retour As String, Variable As String, fichier As String
    fichier = App.Path & "\Lang\" & GetSetting("TXT2JPG", "Data", "Langue", "Francais") & ".lng"
    Variable = "String" & Str(ID)
    Retour = String(512, Chr(0))
    LoadString = Left$(Retour, GetPrivateProfileString("Strings", ByVal Variable, "", Retour, Len(Retour), fichier))
End Function


Public Function LoadCaption(ID As String) As String
    'Lire dans le fichier INi pour les langues
    Dim Retour As String, fichier As String
    fichier = App.Path & "\Lang\" & GetSetting("TXT2JPG", "Data", "Langue", "Francais") & ".lng"
    Retour = String(512, Chr(0))
    LoadCaption = Left$(Retour, GetPrivateProfileString("FormData", ByVal ID, "", Retour, Len(Retour), fichier))
End Function

Public Function LoadMSG(ID As Long) As String
    'Lire dans le fichier lng (ini) pour les langues
    Dim Retour As String, Variable As String, fichier As String
    fichier = App.Path & "\Lang\" & GetSetting("TXT2JPG", "Data", "Langue", "Francais") & ".lng"
    Variable = "MSG" & Str(ID)
    Retour = String(512, Chr(0))
    LoadMSG = Left$(Retour, GetPrivateProfileString("Message", ByVal Variable, "", Retour, Len(Retour), fichier))
End Function


Public Function SetBackColorSel(ByVal RichHwnd As Long, ByVal NouveauFontBackColorSel As Long)

    On Error Resume Next

    Dim iniformat As FORMAT

    ' Set BackColor a masqué
    iniformat.dwMask = CFM_BACKCOLOR

    ' Si le nouveau backcolour est mis à -1 alors nous avons mis le
    ' Backcolour RichTextbox a zero (vbwhite)
    If NouveauFontBackColorSel = -1 Then
        iniformat.dwEffects = CFE_AUTOBACKCOLOR
        iniformat.crBackColor = -1
    Else
        ' donner la nouvelle couleur à BackColour
        iniformat.crBackColor = NouveauFontBackColorSel 'ChangerColor(NouveauFontBackColorSel)
    End If

    ' Nous avons besoin de passer la dimension de la structure comme un
    ' partie de la structure.
    iniformat.cbSize = Len(iniformat)
    ' Envoyez le message et le nouveau format de caractère au RichTextbox
    SetBackColorSel = SendMessage(RichHwnd, EM_SETCHARFORMAT, SCF_SELECTION, iniformat)
End Function

Public Sub Griser_Fermer(hwnd As Long)

    On Error Resume Next

    Dim hSysMenu As Long

    ' Récupère le handle du menu système
    hSysMenu = GetSystemMenu(hwnd, False)
    ' Supprime le menu "Fermer"
    Call DeleteMenu(hSysMenu, SC_CLOSE, MF_BYCOMMAND)
    ' Supprime la barre d'espacement
    Call DeleteMenu(hSysMenu, GetMenuItemCount(hSysMenu) - 1, MF_BYPOSITION)
    ' Redessine la barre de menu
    Call DrawMenuBar(hwnd)
End Sub

Public Function SelectFolder(Titre As String, Handle As Long) As String

    On Error Resume Next

    Dim lpIDList    As Long

    Dim strBuffer   As String

    Dim strTitre    As String

    Dim tBrowseInfo As BrowseInfo

    strTitre = Titre

    With tBrowseInfo
        .hWndOwner = Handle
        .lpszTitle = lstrcat(strTitre, "")
        .ulFlags = BIF_RETURNONLYFSDIRS + BIF_DONTGOBELOWDOMAIN + BIF_USENEWUI
    End With

    lpIDList = SHBrowseForFolder(tBrowseInfo)

    If (lpIDList) Then
        strBuffer = String$(260, vbNullChar)
        SHGetPathFromIDList lpIDList, strBuffer
        SelectFolder = Left$(strBuffer, InStr(strBuffer, vbNullChar) - 1)
    End If

End Function

Public Function ChoixCouleur(lg_hwnd As Long) As Long

    On Error Resume Next

    Dim cc      As ChooseColor

    Dim lReturn As Long

    ReDim CustomColors(0 To 16 * 4 - 1) As Byte

    Dim I As Integer, Bas As Long, Haut As Long

    Bas = LBound(CustomColors): Haut = UBound(CustomColors)

    For I = Bas To Haut
        CustomColors(I) = 0
    Next

    cc.lStructSize = Len(cc)
    cc.hWndOwner = lg_hwnd
    cc.hInstance = 0
    cc.lpCustColors = StrConv(CustomColors, vbUnicode)
    cc.flags = 0
    lReturn = ChooseColorAPI(cc)

    If lReturn <> 0 Then
        ChoixCouleur = cc.rgbResult
        CustomColors = StrConv(cc.lpCustColors, vbFromUnicode)
    Else
        ChoixCouleur = -1
    End If

End Function

Public Function OpenFile(lgHwnd As Long, stFiltre As String, FiltreParDefaut As Long, Optional lgFlags As esFlags = OFN_EXPLORER + OFN_LONGNAMES + OFN_PATHMUSTEXIST, Optional stTitre As String = vbNullString, Optional stInitFile As String = vbNullString, Optional stInitDir As String = vbNullString, Optional stDefautExt As String = vbNullString) As String

    On Error Resume Next

    ' Fenêtre "Ouvrir un fichier".
    Dim tyDialog As OPENFILENAME

    tyDialog.lStructSize = Len(tyDialog)
    tyDialog.hWndOwner = lgHwnd ' Handle du propriétraire de la fenêtre.
    tyDialog.hInstance = App.hInstance
    tyDialog.lpstrFilter = Replace(stFiltre, "|", vbNullChar) & vbNullChar & vbNullChar
    tyDialog.lpstrCustomFilter = vbNullString ' Filtre personnalisé (non géré).
    tyDialog.nMaxCustFilter = 0 ' Index de filtre personnalisé (non géré).
    tyDialog.nFilterIndex = FiltreParDefaut  ' Index du filtre à utiliser par défaut.
    tyDialog.lpstrFile = Left$(stInitFile & String$(1024, vbNullChar), 1024) ' Nom de fichier affiché à l'initialisation de la fenêtre.
    tyDialog.nMaxFile = Len(tyDialog.lpstrFile) - 1 ' Longueur du nom de fichier.
    tyDialog.lpstrFileTitle = tyDialog.lpstrFile ' Nom et extension du fichier (sans chemin).
    tyDialog.nMaxFileTitle = tyDialog.nMaxFile ' Taille de la chaîne précédente.
    tyDialog.lpstrInitialDir = stInitDir ' Répertoire initial.
    tyDialog.lpstrTitle = stTitre ' Titre de la fenêtre.
    tyDialog.flags = lgFlags ' Flags pour affichage de la fenêtre.
    'tyDialog.nFileOffset ' Position du nom du fichier dans la chaîne.
    'tyDialog.nFileExtension ' Position de l'extension du fichier dans la chaîne.
    ' Extension par défaut ajoutée automatiquement si l'utilisateur l'oublie.
    tyDialog.lpstrDefExt = stDefautExt
    tyDialog.lCustData = 0
    tyDialog.lpfnHook = 0
    tyDialog.lpTemplateName = 0
    ' Affichage de la boîte de dialogue.
    GetOpenFileName tyDialog
    ' Retourne le nom long du fichier.
    'lgLastIdxFilter = tyDialog.nFilterIndex
    OpenFile = Left$(tyDialog.lpstrFile, InStr(1, tyDialog.lpstrFile, vbNullChar) - 1)
End Function

'Retourne l'adresse d'un dossier : le dossier windows, le dossier mes documents et le dossier Bureau. Utilise SHGetSpecialFolderLocation
Public Function GiveMePathOf(FolderToFind As Long) As String

    On Error Resume Next

    Dim lRet As Long, IDL As ITEMIDLIST, sPath As String

    IDL.mkid.abID = 0: IDL.mkid.CB = 0
    lRet = SHGetSpecialFolderLocation(100&, FolderToFind, IDL)

    If lRet = 0 Then
        sPath = String$(512, Chr$(0))
        lRet = SHGetPathFromIDList(ByVal IDL.mkid.CB, ByVal sPath)
        GiveMePathOf = Left$(sPath, InStr(sPath, Chr$(0)) - 1)
    Else
        GiveMePathOf = "C:\"
    End If

End Function

'Renvoie le minimum entre deux nombres...
Public Function Min(nb1 As Long, nb2 As Long) As Long

    On Error Resume Next

    If nb1 < nb2 Then
        Min = nb1
    Else
        Min = nb2
    End If

End Function

'Renvoie le maximum entre deux nombres...
Public Function Max(nb1 As Long, nb2 As Long) As Long

    On Error Resume Next

    If nb1 > nb2 Then
        Max = nb1
    Else
        Max = nb2
    End If

End Function

'Renvoie une chaine inconnue placée entre deux chaines connues. Principalement utilisée pour les fichiers LRC [by: et [ti:
Public Function MyMid(ByRef Expression As String, sLeft As String, sRight As String, Optional Start As Long = 1) As String

    On Error Resume Next

    Dim lPosL As Long, lPosR As Long

    lPosL = InStr(Start, Expression, sLeft): lPosR = InStr(lPosL + 1, Expression, sRight)

    If lPosL > 0 And lPosR > 0 Then
        MyMid = Mid$(Expression, lPosL + Len(sLeft), lPosR - lPosL - Len(sLeft))
    Else
        MyMid = vbNullString
    End If

End Function

Public Function IsLink(X As Single, Y As Single, RtfBox As RichTextBox) As ResultConstant
On Error Resume Next
    If RtfBox.Text = "" Then Exit Function
    Dim pt As POINTAPI
    Dim PosStart As Long, I As Long, Start As Long, Mot As String, Fin As Long, A As Long
    pt.X = X \ Screen.TwipsPerPixelX
    pt.Y = Y \ Screen.TwipsPerPixelY
    PosStart = SendMessage(RtfBox.hwnd, &HD7, 0&, pt)
    I = PosStart
    A = 0
    Do
        Select Case Mid(" " & RtfBox.Text, I, 1)
            Case " ", Chr(9), Chr(10), Chr(13)
                Start = I: Exit Do
        End Select
        I = I - 1
        A = A + 1
        If A = 100 Then Exit Do
    Loop
    I = PosStart
    A = 0
    Do
        If I = Len(RtfBox.Text) Then Fin = I + 1: Exit Do
        Select Case Mid(" " & RtfBox.Text, I, 1)
            Case " ", Chr(9), Chr(10), Chr(13)
                Fin = I: Exit Do
        End Select
        I = I + 1
        A = A + 1
        If A = 100 Then Exit Do
    Loop
    Mot = Mid(RtfBox.Text, Start, Fin - Start)
    IsLink.URL = vbNullString
    If UCase(Mot) Like "*HTTP://*" Or UCase(Mot) Like "*WWW.*" Then IsLink.EstUnLiens = True: IsLink.URL = Mot: Exit Function
    If UCase(Mot) Like "*MAILTO:*" Then IsLink.EstUnLiens = True: IsLink.Email = True: IsLink.URL = Right(Mot, Len(Mot) - 7): Exit Function
    If UCase(Mot) Like "*@*" Then IsLink.EstUnLiens = True: IsLink.Email = True: IsLink.URL = Mot
End Function

