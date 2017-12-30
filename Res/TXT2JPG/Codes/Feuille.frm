
'--------------------------------------------------------------------------------
'    Component  : Principale
'    Project    : TXT2JPG
'
'    Description: LA feuille principale de TXT2JPG, contient tout les controles
'Your life is yours alone. Rise up and live it !
'Nothing is ever easy
'
'    Modified   :
'--------------------------------------------------------------------------------

Option Explicit

'Graphismes
Private Declare Function GetDC Lib "user32" (ByVal hwnd As Long) As Long

Private Declare Function GetPixel Lib "gdi32" (ByVal hdc As Long, ByVal X As Long, ByVal Y As Long) As Long

Private Declare Function StretchBlt Lib "gdi32" (ByVal hdc As Long, ByVal X As Long, ByVal Y As Long, ByVal nWidth As Long, ByVal nHeight As Long, ByVal hSrcDC As Long, ByVal xSrc As Long, ByVal ySrc As Long, ByVal nSrcWidth As Long, ByVal nSrcHeight As Long, ByVal dwRop As Long) As Long

Private Declare Function BitBlt Lib "gdi32" (ByVal hDestDC As Long, ByVal X As Long, ByVal Y As Long, ByVal nWidth As Long, ByVal nHeight As Long, ByVal hSrcDC As Long, ByVal xSrc As Long, ByVal ySrc As Long, ByVal dwRop As Long) As Long

Private Declare Function TransparentBlt Lib "msimg32.dll" (ByVal hDestDC As Long, ByVal X As Long, ByVal Y As Long, ByVal nWidth As Long, ByVal nHeight As Long, ByVal hSrcDC As Long, ByVal xSrc As Long, ByVal ySrc As Long, ByVal nWidthSrc As Long, ByVal nHeightSrc As Long, ByVal crTranparent As Long) As Long

Private Declare Function SetPixelV Lib "gdi32" (ByVal hdc As Long, ByVal X As Long, ByVal Y As Long, ByVal crColor As Long) As Long

Private Declare Function TextOut Lib "gdi32" Alias "TextOutA" (ByVal hdc As Long, ByVal X As Long, ByVal Y As Long, ByVal lpString As String, ByVal nCount As Long) As Long

'Apis de telechargement
Private Declare Function InternetOpen Lib "wininet.dll" Alias "InternetOpenA" (ByVal sAgent As String, ByVal lAccessType As Long, ByVal sProxyName As String, ByVal sProxyBypass As String, ByVal lFlags As Long) As Long

Private Declare Function InternetOpenUrl Lib "wininet.dll" Alias "InternetOpenUrlA" (ByVal hOpen As Long, ByVal sUrl As String, ByVal sHeaders As String, ByVal lLength As Long, ByVal lFlags As Long, ByVal lContext As Long) As Long

Private Declare Function InternetReadFile Lib "wininet.dll" (ByVal hFile As Long, ByVal sBuffer As String, ByVal lNumBytesToRead As Long, lNumberOfBytesRead As Long) As Integer

Private Declare Function InternetCloseHandle Lib "wininet.dll" (ByVal hInet As Long) As Integer

'Toujours au premier plan/Déplacement de controles
Private Declare Function SetWindowPos Lib "user32" (ByVal hwnd As Long, ByVal hWndInsertAfter As Long, ByVal X As Long, ByVal Y As Long, ByVal cx As Long, ByVal cy As Long, ByVal wFlags As Long) As Long

'Private Declare Function SetParent Lib "user32" (ByVal hWndChild As Long, ByVal hWndNewParent As Long) As Long
'Convertir en JPG
Private Declare Function BMP2JPGpourVBFrance Lib "BMP2JPG.dll" (ByVal A As String, ByVal B As String, ByVal c As Integer) As Integer

'Temps
Private Declare Function GetTickCount Lib "kernel32" () As Long

'Souris
'Private Declare Function GetCursorPos Lib "user32" (lpPoint As POINTAPI) As Long
'Private Declare Function ScreenToClient Lib "user32" (ByVal hWnd As Long, lpPoint As POINTAPI) As Long
'Private Declare Function ClientToScreen Lib "user32" (ByVal hwnd As Long, lpPoint As POINTAPI) As Long
'Priorités
Private Declare Function GetCurrentProcess Lib "kernel32" () As Long

Private Declare Function SetPriorityClass Lib "kernel32" (ByVal hProcess As Long, ByVal dwPriorityClass As Long) As Long

'Lancer une utilitaire externe
Private Declare Function ShellExecute Lib "shell32.dll" Alias "ShellExecuteA" (ByVal hwnd As Long, ByVal lpOperation As String, ByVal lpFile As String, ByVal lpParameters As String, ByVal lpDirectory As String, ByVal nShowCmd As Long) As Long

'Masque le curseur du RTB
Private Declare Function HideCaret Lib "user32" (ByVal hwnd As Long) As Long

'API pour mettre en mémoire les RGB
Private Declare Sub CopyMemory Lib "kernel32" Alias "RtlMoveMemory" (pDst As Any, pSrc As Any, ByVal ByteLen As Long)

'APIs pour simuler les mouse out
Private Declare Function GetCursorPos Lib "user32" (lpPoint As POINTAPI) As Long

Private Declare Function WindowFromPoint Lib "user32" (ByVal xPoint As Long, ByVal yPoint As Long) As Long

'Type pointApi
Private Type POINTAPI

    X As Long
    Y As Long

End Type

Private Type vRGB

    R As Byte
    G As Byte
    B As Byte

End Type

Private NotUse As Boolean, DoNotChange As Boolean, BG_red As Long, BG_green As Long, BG_blue As Long, sens_dessin As Long

Private poubelle As Long, tempo As Long, NonForcé As Boolean

Private SelectedPlug As Control, IsSlidingWorking As Boolean, NoSelEvents As Boolean, SVGofRTF As String    'Variables génerales pour le programme

Private Splitter As String, Splitter_Cur As Long, Split_Count As Long   'Les paramètres pour le Split des chapter

Private MyChoiceIs As Long  'Empeche de redemander à chaque fois les paramètres pour les images lorsque l'on utilise splitchapter

Private BackPicture As IPictureDisp 'L'image de fond, si il ne s'agit pas d'un dégradé

Private debut As Single 'Pour tout les timers...

Private NoInternet As Boolean   'Si pas de connexion vaut true

Private Reponse As String, Couleur_Selectionnee As Long 'Contient la réponse du Comdlg

Private TailleTexte As Long

Private CleverColor As Boolean 'détrermine si les forecolor doivent s'adapter à l'arrière plan.

'Messages Windows
Const WM_PASTE = &H302

Const WM_VSCROLL = &H115

'Messages Windows Priorité
'Const NORMAL_PRIORITY_CLASS As Long = &H20 ' normal
Const ABOVE_NORMAL_PRIORITY_CLASS As Long = &H8000 ' normal +

Const HIGH_PRIORITY_CLASS As Long = &H80 ' haute

Const REALTIME_PRIORITY_CLASS As Long = &H100 ' maximum

'Messages RTFBox/ComboBox
Const SB_PAGEDOWN = 3

Const EM_CHARFROMPOS = &HD7

Const CB_SHOWDROPDOWN = &H14F

Const CB_SETDROPPEDWIDTH = &H160

Const Barre As String = "{\pict\wmetafile8\picw1764\pich882\picwgoal9070\pichgoal29 " & vbCrLf & "010009000003bb00000006001c00000000000400000003010800050000000b0200000000050000" & vbCrLf & "000c023300ca0e040000002e0118001c000000fb021000070000000000bc020000000001020222" & vbCrLf & "53797374656d0000ca0e00002c3e0000a489120026e2823900d61a000c020000040000002d0100" & vbCrLf & "0004000000020101001c000000fb029cff0000000000009001000000000440001254696d657320" & vbCrLf & "4e657720526f6d616e0000000000000000000000000000000000040000002d0101000500000009" & vbCrLf & "02000000020d000000320a5a0000000100040000000000c50e320020932d00030000001e000700" & vbCrLf & "0000fc020000dbdee8000000040000002d01020008000000fa02050000000000ffffff00040000" & vbCrLf & "002d0103000e00000024030500ffffffffffff3200c40e3200c40effffffffffff08000000fa02" & vbCrLf & "00000000000000000000040000002d01040007000000fc020000ffffff000000040000002d0105" & vbCrLf & "00040000002701ffff040000002d010000030000000000" & vbCrLf & "}"

Private Sub Do_Abort()
    On Error Resume Next
    Abandon.Visible = True
    Abandon.Top = 126
    tempo = Timer

    Do
        DoEvents
        DoEvents
        Abandon.Top = 126 - (Timer - tempo) * 31.5
    Loop While Timer - tempo < 3

    Abandon.Visible = False
End Sub

Public Sub Form_TailleChange()
    'Sub triggered chaque fois qu'il y a un évenement size
    On Error Resume Next

    'Autorise le redimensionnement de la feuille. Replace les controles au bons endroits
    Dim Current_Height As Long, Current_Width As Long

    Current_Height = Me.ScaleHeight
    Current_Width = Me.ScaleWidth
    'If Current_Height < 310 Then Me.ScaleHeight = 310: Exit Sub
    'If Current_Width < 600 Then Me.ScaleHeight = 600: Exit Sub
    'Redimensionner sur la hauteur
    'Replacer les controles
    Apercu.Height = IIf(Rechercher.Visible, Me.ScaleHeight - Rechercher.Height - Apercu.Top, Me.ScaleHeight - Apercu.Top - 12)
    Separateur(0).Y2 = Me.ScaleHeight
    Rechercher.Top = Current_Height - 30
    MainContainer.Top = Current_Height \ 2 - MainContainer.Height \ 2
    SelectedPlug.Top = Current_Height \ 2 - SelectedPlug.Height \ 2
    'Replacer la fenêtre au milieu :
    'Me.Top = Screen.Height \ 2 - (Me.Height \ 2)
    'Redimensionner sur la largeur
    'Replacer les controles
    Apercu.Width = Current_Width - 362
    MainContainer.Left = Apercu.Left + Apercu.Width + 2
    Separateur(0).X1 = MainContainer.Left + MainContainer.Width + 4
    Separateur(0).X2 = MainContainer.Left + MainContainer.Width + 4
    SelectedPlug.Left = MainContainer.Left + MainContainer.Width + 7
    BallonTip.Visible = False

    Form_Redraw
End Sub

Private Sub Glass(X1 As Long, Y1 As Long, X2 As Long, Y2 As Long, Optional Me_DC As Long = 0)
    On Error Resume Next
    'Une petite sub bien pratique qui permet d'afficher un glassage par dessus un controle, pour le mettre en valeur ou simplement pour faire joli !
    Dim X    As Long, Y As Long, V As Long, T As Long, pre_compute As Long, pre_compute2 As Long, pre_compute3 As Long, pre_compute4 As Long, pre_compute5 As Long, LenType As Long

    Dim iRGB As vRGB

    iRGB.B = 0: iRGB.R = 0: iRGB.G = 0
    LenType = LenB(iRGB)

    If Me_DC = 0 Then Me_DC = myHDC
    pre_compute = X1 + X2

    For Y = 0 To 10
        pre_compute2 = Y1 + Y
        pre_compute3 = (15 - Y) * (10 - Y \ 2)

        For X = X1 To pre_compute
            'Haut
            V = GetPixel(Me_DC, X, pre_compute2)
            CopyMemory iRGB, V, LenType
            SetPixelV Me_DC, X, pre_compute2, RGB(Min(iRGB.R + pre_compute3, 255), Min(iRGB.G + pre_compute3, 255), Min(iRGB.B + pre_compute3, 255))
        Next
    Next

    'La partie la plus longue : le milieu
    pre_compute4 = Y2 - 5 - Y1

    For Y = 11 To pre_compute4
        pre_compute2 = Y1 + Y
        pre_compute3 = (15 - Y) * (10 - Y \ 2)

        For X = X1 To pre_compute
            V = GetPixel(Me_DC, X, pre_compute2)
            CopyMemory iRGB, V, LenType
            SetPixelV Me_DC, X, pre_compute2, RGB(Min(iRGB.R + 20, 255), Min(iRGB.G + 20, 255), Min(iRGB.B + 20, 255))
        Next
    Next

    T = 2
    pre_compute3 = Y2 - Y1

    For Y = pre_compute4 To pre_compute3
        T = T + 2
        pre_compute2 = Y1 + Y
        pre_compute5 = (T + 2) * (T \ 2)

        For X = X1 To pre_compute
            V = GetPixel(Me_DC, X, pre_compute2)
            CopyMemory iRGB, V, LenType
            SetPixelV Me_DC, X, pre_compute2, RGB(Min(iRGB.R + pre_compute5, 255), Min(iRGB.G + pre_compute5, 255), Min(iRGB.B + pre_compute5, 255))
        Next
    Next

    If Me_DC = myHDC Then Me.Line (X1, Y1)-(X1 + X2, Y2), RGB(192, 192, 192), B
End Sub

Private Sub Numeriser()

    'LA SUB PRINCIPALE ! EN FIN ? ENFIN !
    'C'est celle qui fait toute la numérisation..
    Dim C_dc  As Long, numero As Long, LastLen As Long, Size As Long, base As String, racine As String, Utilisation_Filigrane As Boolean, Couleur_De_Fond As Long, HHauteur As Long, LLargeur As Long, JPG As Boolean, nom_Fichier As String, c_SelStart As Long, R_DC As Long, Image_A_Blitter_DC As Long, app_path As String, MargeTop As Long, MargeBottom As Long, MarquerPage As Boolean, avancement_DC As Long, Xp As Long, Yp As Long, Retours_Chariot As String, Converter_Hwnd As Long, Retour As Long, pt As POINTAPI, TinySize As Long, EraseUncompleteLine As Boolean, curseur_x As Long, curseur_y As Long, LigneIncomplete As Boolean

    Dim ProgressBar_DC As Long, ProgressBar_FORE_DC As Long

    'Changer la priorité du processus !
    If GetSetting("TXT2JPG", "Data", "Priorite", "Normal") <> "Normal" Then ReglerPriorite GetSetting("TXT2JPG", "Data", "Priorite", "Normal")
    'Ensuite cacher ce sein que je ne saurais voir :
    BUG.Visible = False

    Form_Redraw 'Rafraichir l'ensemble
    app_path = GetSetting("TXT2JPG", "Data", "Default_Path", "NotDefine")

    'Si jamais c'est la toute première fois :-)
    If app_path = "NotDefine" Then

        Do
            app_path = SelectFolder(LoadString(1), Me.hwnd)
        Loop While app_path = vbNullString Or app_path = "NotDefine"

        SaveSetting "TXT2JPG", "Data", "Default_Path", app_path
    End If

    'Sauver les données utiles en variables pour minimiser le temps d'accès
    If UseTopAndBottomMargin.Value = 0 Then
        'Si l'on a dit qu'on ne voulait pas de marges haut bas, on met à 0
        SetMarge(2).Tag = 0
        SetMarge(3).Tag = 0
    End If

    MargeTop = SetMarge(2).Tag
    MargeBottom = SetMarge(3).Tag
    MarquerPage = Pagination.Value
    HHauteur = Hauteur.Text - MargeTop - MargeBottom
    LLargeur = Largeur.Text
    Converter.Width = LLargeur
    Converter.Height = HHauteur

    If Converter.Height > 230 Then
        Me.WindowState = vbNormal
        Me.Height = (50 + Converter.Height + 56) * Screen.TwipsPerPixelY
        MainContainer.Top = 7
    End If

    Resultat.Width = LLargeur
    Resultat.Height = HHauteur + MargeTop + MargeBottom
    nom_Fichier = Dest_Folder.Text
    racine = Root.Text

    'Les erreurs potentielles
    If Dest_Folder.Invalide Or Dest_Folder.Text = vbNullString Then
        'Pas de nom de fichiers, ou erreur
        PlugChoice(0).Value = True
        Dest_Folder.Invalide = True
        Dest_Folder.SetFocus

        Exit Sub

    End If

    If Root.BackColor = 255 Then
        'Mauvais nom de racine
        PlugChoice(2).Value = True
        Root.SetFocus

        Exit Sub

    End If

    If Dir$(Filig.Text) = vbNullString Then
        PlugChoice(1).Value = True
        Filig.SetFocus

        Exit Sub

    End If

    If SplitChapter.Value = True And (KeyWord.Text = vbNullString Or KeyWord.Invalide = True) Then
        PlugChoice(2).Value = True
        KeyWord.SetFocus

        Exit Sub

    End If

    numero = 0

    'Creer le dossier (si pas crée, evidemment)
    If Dir$(app_path & "\" & nom_Fichier, vbDirectory) = vbNullString Then MkDir app_path & "\" & nom_Fichier

    'Redimensionner l'image de fond si besoin est
    If RedimToFit.Value = True Then

        With Image_A_Blitter
            .BackColor = RGB(254, 255, 255)
            .AutoSize = False
            .Width = Largeur.Text
            .Height = Hauteur.Text
            .Picture = LoadPicture(vbNullString)
            .PaintPicture LoadPicture(Filig.Text), 0, 0, Largeur.Text, Hauteur.Text
        End With

    Else
        Image_A_Blitter.Picture = LoadPicture(Filig.Text)
    End If

    If Filig.Text <> vbNullString Then
        'Tous les cas d'utilisations de filigrane
        Utilisation_Filigrane = True

        If Cover.Value = True Then
            Utilisation_Filigrane = False
            BitBlt Resultat.hdc, 0, 0, Largeur.Text, Hauteur.Text, Image_A_Blitter.hdc, 0, 0, vbSrcCopy
            Resultat.Refresh
            SavePicture Resultat.Image, app_path & "\" & nom_Fichier & "\" & racine & "0000.bmp"
            numero = 1
        End If
    End If

    'Mettre au premier plan
    SetWindowPos Me.hwnd, -1, 0, 0, 0, 0, 2 Or 1

    Me.Caption = LoadString(2)

    'Masquer les controles
    On Error Resume Next

    SelectedPlug.Visible = False
    MainContainer.Visible = False
    BallonTip.Visible = False
    Separateur(0).Visible = False
    MAJ.Enabled = False
    Apercu.Visible = False
    etiquette(15).Visible = False
    etiquette(0).Visible = True
    Griser_Fermer (Me.hwnd)
    Set etiquette(0).Container = Me
    etiquette(0).Move LLargeur + 55, 56, 253, HHauteur - 5
    Glass LLargeur + 45, 50, 258, 60 + HHauteur - 5
    etiquette(0).Caption = LoadString(3) & vbCrLf & LoadString(4) & vbCrLf
    etiquette(0).ForeColor = RGB(255, 255, 255) - GetPixel(myHDC, LLargeur + 50, 26)
    Converter.Visible = True

    If SplitChapter.Value = True Then      'Splittage des chapitres
        If Splitter = vbNullString Then
            'Premier split
            Splitter = Apercu.TextRTF
            Splitter_Cur = 1
            Split_Count = 0
        End If

        Converter.TextRTF = Splitter

        DoEvents
        etiquette(0).Caption = Replace(LoadString(5), "%u", KeyWord.Text) & vbCrLf & LoadString(6) & Split_Count & vbCrLf

        If Splitter_Cur = Len(Converter.Text) Then
            ShellExecute Me.hwnd, "open", app_path & "\" & Dest_Folder.Text & "\", vbNullString, App.Path, 1
            Unload Me

            Exit Sub

        End If

        Split_Count = Split_Count + 1

        DoEvents
        Converter.SelStart = Splitter_Cur - 1
        Splitter_Cur = InStr(Splitter_Cur + 5, Converter.Text, KeyWord.Text)

        If Splitter_Cur = 0 Then Splitter_Cur = Len(Converter.Text)
        Converter.SelLength = Splitter_Cur - Converter.SelStart - 1
        Converter.TextRTF = Converter.SelRTF
        Apercu.TextRTF = Converter.TextRTF
    End If

    'Et ca commence ! On est sur qu'il n'y a pas de problèmes !
    Me.MousePointer = vbCustom

    DoEvents
    SVGofRTF = Apercu.TextRTF
    Converter.TextRTF = SVGofRTF
    Apercu.TextRTF = vbNullString

    DoEvents
    Couleur_De_Fond = Couleur(1).BackColor
    C_dc = GetDC(Converter.hwnd)
    avancement_DC = Avancement.hdc
    LastLen = Len(Converter.Text)
    Converter.SelStart = LastLen
    Converter.SelLength = 0
    EraseUncompleteLine = Not (Type_Numerisation.Value)
    Retours_Chariot = vbNullString

    For tempo = 1 To 25
        Retours_Chariot = Retours_Chariot & vbCrLf
    Next

    Converter.SelText = Retours_Chariot
    Converter.SelFontSize = 8.25

    DoEvents
    JPG = En_JPG.Value
    'Converter.SelStart =
    Size = Len(Converter.Text) 'Converter.SelStart
    Converter.SelStart = 0
    c_SelStart = 0
    Resultat.BackColor = RGB(255, 255, 255)
    R_DC = Resultat.hdc
    Image_A_Blitter_DC = Image_A_Blitter.hdc

    If InStr(1, SVGofRTF, "\pict") <> 0 Then
        Converter.Enabled = False
        PlugChoice_Click 6

        With Plug(6)
            .Visible = 1
            .Top = (Me.ScaleHeight - .Height) \ 2
            BitBlt .hdc, 0, 0, 176, 289, myHDC, .Left, .Top, vbSrcCopy
            .Left = 745
            .Refresh
        End With

        Set SelectedPlug = Plug(tempo)

        For tempo = 0 To PlugChoice.Count - 1
            Plug(tempo).Visible = False
        Next

        DoEvents
        IsSlidingWorking = True

        Do
            DoEvents
            DoEvents
        Loop While (IsSlidingWorking = True And MyChoiceIs = 25)

        DoEvents
        DoEvents

        If MyChoiceIs <> 25 Then
            Traitement_Img(0).Value = False
            Traitement_Img(1).Value = False
            Traitement_Img(2).Value = False
            Traitement_Img(MyChoiceIs).Value = True
        End If

        tempo = 1

        If Traitement_Img(1).Value = True Or Traitement_Img(2).Value = True Then

            Dim poubelle As String, LLargeurReelle As Long

            LLargeurReelle = LLargeur - SetMarge(0).Tag - SetMarge(1).Tag
            etiquette(0).Caption = etiquette(0).Caption & LoadString(7) & vbCrLf

            Do
                'Redimensionner toutes les images
                'D'abord les Width
                tempo = InStr(tempo, SVGofRTF, "\objw")

                If tempo = 0 Then Exit Do
                tempo = tempo + 5
                poubelle = vbNullString

                Do
                    poubelle = poubelle & Mid$(SVGofRTF, tempo, 1)
                    tempo = tempo + 1
                Loop While (Mid$(SVGofRTF, tempo, 1) Like "[123456789]")

                If Val(poubelle) \ Screen.TwipsPerPixelX > LLargeurReelle Then
                    'Redimensionner (fonction de malade !)
                    Mid$(SVGofRTF, tempo - Len(poubelle), Len(poubelle)) = FORMAT$(LLargeurReelle * Screen.TwipsPerPixelX, Replace(Space$(Len(poubelle)), " ", "0"))
                End If

                If Traitement_Img(2).Value = True Then
                    'Ensuite les height
                    tempo = InStr(tempo - 1, SVGofRTF, "\objh")

                    If tempo = 0 Then Exit Do
                    tempo = tempo + 5
                    poubelle = vbNullString

                    Do
                        poubelle = poubelle & Mid$(SVGofRTF, tempo, 1)
                        tempo = tempo + 1
                    Loop While (Mid$(SVGofRTF, tempo, 1) Like "[0123456789]")

                    If Val(poubelle) \ Screen.TwipsPerPixelY > HHauteur Then
                        'Redimensionner (fonction de malade ! 2 )
                        Mid$(SVGofRTF, tempo - Len(poubelle), Len(poubelle)) = FORMAT$(HHauteur * Screen.TwipsPerPixelY, Replace(Space$(Len(poubelle)), " ", "0"))
                    End If
                End If

            Loop

            tempo = 1

            Do
                'Redimensionner toutes les images incluse d'origine dans le fichier
                'Uniquement les picwgoal
                tempo = InStr(tempo, SVGofRTF, "\picwgoal")

                If tempo = 0 Then Exit Do
                tempo = tempo + 9
                poubelle = vbNullString

                Do
                    poubelle = poubelle & Mid$(SVGofRTF, tempo, 1)
                    tempo = tempo + 1
                Loop While (Mid$(SVGofRTF, tempo, 1) Like "[0123456789]")

                If Val(poubelle) \ Screen.TwipsPerPixelX > LLargeurReelle Then
                    'Redimensionner (fonction de malade !)
                    Mid$(SVGofRTF, tempo - Len(poubelle), Len(poubelle)) = FORMAT$(LLargeurReelle * Screen.TwipsPerPixelX, Replace(Space$(Len(poubelle)), " ", "0"))
                End If

                If Traitement_Img(2).Value = True Then
                    'Ensuite les height
                    tempo = InStr(tempo - 1, SVGofRTF, "\pichgoal")

                    If tempo = 0 Then Exit Do
                    tempo = tempo + 9
                    poubelle = vbNullString

                    Do
                        poubelle = poubelle & Mid$(SVGofRTF, tempo, 1)
                        tempo = tempo + 1
                    Loop While (Mid$(SVGofRTF, tempo, 1) Like "[0123456789]")

                    If Val(poubelle) \ Screen.TwipsPerPixelY > HHauteur Then
                        'Redimensionner (fonction de malade ! 2 )
                        Mid$(SVGofRTF, tempo - Len(poubelle), Len(poubelle)) = FORMAT$(HHauteur * Screen.TwipsPerPixelY, Replace(Space$(Len(poubelle)), " ", "0"))
                    End If
                End If

            Loop

            Converter.TextRTF = SVGofRTF

            'Sauvegarder ces paramètres au cas ou on fait une numérisation multiple
            If Traitement_Img(0).Value = True Then MyChoiceIs = 0
            If Traitement_Img(1).Value = True Then MyChoiceIs = 1
            If Traitement_Img(2).Value = True Then MyChoiceIs = 2
        End If

        Converter.Enabled = True
    End If

    etiquette(0).Caption = etiquette(0).Caption & LoadString(8) & GetSetting("TXT2JPG", "Data", "Priorite", "Normal") & vbCrLf

    If Utilisation_Filigrane = True Then
        etiquette(0).Caption = etiquette(0).Caption & Replace(LoadString(9), "%u", Filig.Text) & vbCrLf
    Else
        etiquette(0).Caption = etiquette(0).Caption & LoadString(10) & vbCrLf
    End If

    etiquette(0).Caption = etiquette(0).Caption & LoadString(11) & Int(LastLen \ ((HHauteur * LLargeur) \ 64) * 2.5 + 1) & vbCrLf
    etiquette(0).Caption = etiquette(0).Caption & LoadString(12) & vbCrLf & vbCrLf & vbCrLf

    'Enfin... c'est maintenant que ca commence vraiment !
    etiquette(0).Caption = etiquette(0).Caption & LoadString(13) & vbCrLf

    Start.Visible = False
    base = app_path & "\" & nom_Fichier & "\" & racine
    Converter_Hwnd = Converter.hwnd

    If SplitChapter.Value = True Then
        base = base & KeyWord.Text & " " & Split_Count & "\"

        If Dir$(base, vbDirectory) = vbNullString Then MkDir base
    End If

    If PutACopyOfFileInFolder.Value = True Then
        Converter.SaveFile base & nom_Fichier & ".rtf"
    End If

    Converter.SetFocus
    pt.X = LLargeur - 2
    pt.Y = HHauteur - 2
    HideCaret Converter_Hwnd    'Masque le caret
    Retour = 0
    TinySize = Max(Size - 2000, 0)
    'Et centrer la feuille :
    Me.Left = (Screen.Width - Me.Width) \ 2
    Me.Top = (Screen.Height - Me.Height) \ 2
    Me.Width = (LLargeur + 50 + 253 + 20) * Screen.TwipsPerPixelY
    Size = Len(Converter.Text)
    'Préparer le progressbar :
    ProgressBar_DC = ProgressBar.hdc
    ProgressBar.Height = 48
    ProgressBar_FORE_DC = ProgressBar_FORE.hdc
    ProgressBar.Visible = True
    BitBlt ProgressBar_DC, 0, 0, 563, 48, myHDC, ProgressBar.Left, 0, vbSrcCopy
    BitBlt ProgressBar_DC, 0, 3, 563, 21, ProgressBar_BACK.hdc, 0, 0, vbSrcCopy
    BitBlt ProgressBar_DC, 0, 27, 563, 21, ProgressBar_BACK.hdc, 0, 0, vbSrcCopy
    Me.Refresh

    For tempo = 0 To 15

        DoEvents
        DoEvents
    Next

'C EST PARTI ICI :
    Do

        If Utilisation_Filigrane Then
            'Si on utilise un filigrane, on fait en deux fois : d'abord on blitte l'image de fond
            BitBlt R_DC, 0, 0, LLargeur, HHauteur + MargeTop + MargeBottom, Image_A_Blitter_DC, 0, 0, vbSrcCopy
            'Et ensuite on transparentblit le texte par dessus
            TransparentBlt R_DC, 0, MargeTop, LLargeur, HHauteur, C_dc, 0, 0, LLargeur, HHauteur, Couleur_De_Fond
        Else
            'Sinon, c'est pas compliqué : on fait un seul blit !
            BitBlt R_DC, 0, MargeTop, LLargeur, HHauteur, C_dc, 0, 0, vbSrcCopy
        End If

        If MarquerPage Then
            'Là, on marque le numéro de page au fer rouge en bas de l'image...
            StretchBlt R_DC, 0, HHauteur + MargeTop, c_SelStart * (LLargeur - 30) \ Size + 30, MargeBottom, avancement_DC, 0, 0, 2, 20, vbSrcCopy
            TextOut R_DC, 0, HHauteur + MargeTop + (MargeBottom - 12) \ 2, FORMAT$(numero, "0000"), 4
        End If
        If EraseUncompleteLine Then
            'Et on efface les lignes incomplètes...
            'On commence par le haut
            curseur_y = HHauteur + MargeTop
            Do
                curseur_y = curseur_y - 1
                LigneIncomplete = False
                If Utilisation_Filigrane Then
                    BitBlt R_DC, 0, curseur_y + 1, LLargeur, 1, Image_A_Blitter_DC, 0, curseur_y + 1, vbSrcCopy
                Else
                    BitBlt R_DC, 0, curseur_y + 1, LLargeur, 1, C_dc, 0, 0, &HFF0062
                End If
                For curseur_x = 0 To LLargeur
                    If GetPixel(R_DC, curseur_x, curseur_y) = vbBlack Then LigneIncomplete = True: Exit For
                Next
            Loop While LigneIncomplete = True
            'Et on finit par le bas
            curseur_y = 0
            Do
                curseur_y = curseur_y + 1
                LigneIncomplete = False
                If Utilisation_Filigrane Then
                    BitBlt R_DC, 0, curseur_y - 1, LLargeur, 1, Image_A_Blitter_DC, 0, curseur_y - 1, vbSrcCopy
                Else
                    BitBlt R_DC, 0, curseur_y - 1, LLargeur, 1, C_dc, 0, 0, &HFF0062
                End If
                For curseur_x = 0 To LLargeur
                    If GetPixel(R_DC, curseur_x, curseur_y) = vbBlack Then LigneIncomplete = True: Exit For
                Next
            Loop While LigneIncomplete = True
        End If
        SavePicture Resultat.Image, base & FORMAT$(numero, "0000") & ".bmp"
        numero = numero + 1
        'Envoyer un message : pagedown et scroll
        SendMessage Converter_Hwnd, WM_VSCROLL, SB_PAGEDOWN, 0

        If Retour < TinySize Then
            Retour = Retour + 1500
        Else
            'Envoyer un message : avoir la position en fonction d'un point(le bord droit du RTB)
            Retour = SendMessage(Converter_Hwnd, EM_CHARFROMPOS, 0&, pt)
            'Puis on remet à jour le progress bar...
            BitBlt ProgressBar_DC, 0, 3, 563, 21, ProgressBar_BACK.hdc, 0, 0, vbSrcCopy
            StretchBlt ProgressBar_DC, 1, 28, (Retour * 561) \ Size, 19, ProgressBar_FORE_DC, 0, 0, 67, 19, vbSrcCopy
            TextOut ProgressBar_DC, 275, 30, FORMAT$((Retour * 100) \ Size, "000") & "%", 4
        End If

        DoEvents
        'Barre d'avancement
        StretchBlt ProgressBar_DC, 1, 4, (Retour * 561) \ Size, 19, ProgressBar_FORE_DC, 0, 0, 67, 19, vbSrcCopy
        ProgressBar.Refresh
    Loop While Retour <> Size

    'If LastLen < TotalLen Then
    '    numero = numero - 1
    '    GoTo demarrage
    'End If
    etiquette(0).Caption = etiquette(0).Caption & LoadString(14) & vbCrLf
    'Détruire les dernière image blanches
    tempo = 0
    Image_A_Blitter.Visible = True
    Converter.Visible = False
    Image_A_Blitter.Left = 5
    Image_A_Blitter.Top = 50

    Do
        tempo = tempo + 1
        Image_A_Blitter.Picture = LoadPicture(base & FORMAT$(numero - tempo, "0000") & ".bmp")
        Size = 0

        'Check les images blanches
        Dim NouLarg As Long, NouHaut As Long

        NouLarg = LLargeur - 5
        NouHaut = HHauteur - 5

        For Xp = 5 To NouLarg
            For Yp = 5 To NouHaut
                Size = Size + (16777215 - GetPixel(Image_A_Blitter.hdc, Xp, Yp))

                If Size > 1 Then Size = 1: Exit For
            Next

            If Size >= 1 Then Exit For
        Next

        If Size = 0 Then Kill base & FORMAT$(numero - tempo, "0000") & ".bmp"
    Loop While Size = 0

    numero = numero - tempo
    BitBlt ProgressBar_DC, 0, 0, 563, 48, myHDC, ProgressBar.Left, 0, vbSrcCopy
    BitBlt ProgressBar_DC, 0, 3, 563, 21, ProgressBar_BACK.hdc, 0, 0, vbSrcCopy

    If JPG Then

        'Conversion en JPG
        etiquette(0).Caption = etiquette(0).Caption & LoadString(15) & vbCrLf
        Me.MousePointer = vbCustom

        For tempo = 0 To numero
            Convert base & FORMAT$(tempo, "0000")

            DoEvents
            StretchBlt ProgressBar_DC, 1, 4, (600 * tempo) \ numero, 19, ProgressBar_FORE_DC, 0, 0, 67, 19, vbSrcCopy
            ProgressBar.Refresh
            Kill base & FORMAT$(tempo, "0000") & ".bmp"
        Next

    End If

    Converter.Visible = False
    Resultat.Visible = False
    Image_A_Blitter.Visible = False

    If SplitChapter.Value Then Numeriser: Exit Sub
    etiquette(0).Caption = etiquette(0).Caption & Replace(LoadString(16), "%u", numero) & vbCrLf & LoadString(18)

    DoEvents
    'Et voilà ! C'est terminé !
    'D'abord, on enregistre l'adresse du fichier
    If PutACopyOfFileInFolder Then
        SaveSetting "TXT2JPG", "Data", "Last_File", base & nom_Fichier & ".rtf"
    End If
    ShellExecute Me.hwnd, "open", app_path & "\" & Dest_Folder.Text & "\", vbNullString, App.Path, 1
    Unload Me
End Sub

Private Sub ReglerPriorite(Niveau As String)

    'Fonction réglant la priorité en cas de besoin, selon le niveau demandé
    On Error Resume Next

    If Niveau = "ABOVE_NORMAL_PRIORITY_CLASS" Then SetPriorityClass GetCurrentProcess(), ABOVE_NORMAL_PRIORITY_CLASS
    If Niveau = "HIGH_PRIORITY_CLASS" Then SetPriorityClass GetCurrentProcess(), HIGH_PRIORITY_CLASS
    If Niveau = "REALTIME_PRIORITY_CLASS" Then SetPriorityClass GetCurrentProcess(), REALTIME_PRIORITY_CLASS
End Sub

Private Sub Convert(Entree As String)
    On Error Resume Next
    'Convertit l'image d'entrée de BMP vers JPG
    BMP2JPGpourVBFrance Entree & ".bmp", Entree & ".jpg", Qualite.Tag  'qualité réglable de 1 à 100
End Sub

Public Sub Download(URL As String, Optional Stockage2 As String = "Nothing")
    On Error Resume Next
    'Telecharge un fichier spécifié
    If NoInternet = True Then Exit Sub
    If Stockage2 = "Nothing" Then Stockage2 = Stockage

    Dim hOpen              As Long, App_Name As String

    Dim hOpenUrl           As Long

    Dim bDoLoop            As Boolean

    Dim sReadBuffer        As String * 2048

    Dim lNumberOfBytesRead As Long

    Dim sBuffer            As String

    App_Name = Me.Caption
    lNumberOfBytesRead = 0
    debut = GetTickCount()
    Me.Caption = "TXT 2 JPG =>" & LoadString(19)
    'Vider les déchets
    Kill Stockage2
    Open Stockage2 For Output As #1
        Print #1, vbNullString
    Close #1
    hOpen = InternetOpen("Zen User", 0, vbNullString, vbNullString, 0)
    hOpenUrl = InternetOpenUrl(hOpen, URL, vbNullString, 0, &H80000000, 0)
    bDoLoop = True

    While bDoLoop

        sReadBuffer = vbNullString
        InternetReadFile hOpenUrl, sReadBuffer, Len(sReadBuffer), lNumberOfBytesRead
        sBuffer = sBuffer & Left$(sReadBuffer, lNumberOfBytesRead)

        If Not CBool(lNumberOfBytesRead) Then bDoLoop = False
        If GetTickCount - debut > 5000 Then
            MsgBox LoadString(20), vbExclamation + vbOKOnly
            NoInternet = True
            GoTo err_handler
        End If

    Wend

err_handler:
    Open Stockage2 For Binary Access Write As #1
    Put #1, , sBuffer
    Close #1
    DoEvents
    If hOpenUrl <> 0 Then InternetCloseHandle (hOpenUrl)
    If hOpen <> 0 Then InternetCloseHandle (hOpen)
    Me.Caption = App_Name
End Sub

'Redessine la feuille et les conteneurs, appelable lors d'un redimensionnement par exemple
Public Sub Form_Redraw(Optional cWidth As Long = 0)
    On Error Resume Next

    If cWidth = 0 Then cWidth = Me.ScaleWidth

    Dim Hauteur_f As Long, PreCompile As Single

    Hauteur_f = Me.ScaleHeight

    If GetSetting("TXT2JPG", "Data", "BackPic", vbNullString) = vbNullString Then

        'Dessiner le BG
        For tempo = 0 To Hauteur_f
            PreCompile = Abs(255 * sens_dessin - ((255 * tempo) \ Hauteur_f))
            SetPixelV myHDC, 0, tempo, RGB(BG_red * PreCompile, BG_green * PreCompile, BG_blue * PreCompile)
        Next

        'Le stretcher
        StretchBlt myHDC, 0, 0, cWidth, Hauteur_f, myHDC, 0, 0, 1, Hauteur_f, vbSrcCopy
    Else
        Me.PaintPicture BackPicture, 0, 0, cWidth, Me.ScaleHeight
    End If

    If CleverColor Then

        For tempo = 0 To etiquette.UBound
            etiquette(tempo).ForeColor = IIf(GetPixel(myHDC, etiquette(tempo).Left, etiquette(tempo).Top) > 8421504, vbBlack, vbWhite)
        Next

    End If

    Me.Refresh
    MAJ.Enabled = True

    'Les conteneurs :
    For tempo = 0 To PlugChoice.Count - 1

        If PlugChoice(tempo).Value = 0 Then
            PlugChoice(tempo).BackColor = GetPixel(myHDC, PlugChoice(tempo).Left + PlugChoice(tempo).Container.Left, PlugChoice(tempo).Top + PlugChoice(tempo).Container.Top)
            PlugChoice(tempo).ForeColor = 16777215 - PlugChoice(tempo).BackColor
        Else
            PlugChoice(tempo).BackColor = &H8000000F
            PlugChoice(tempo).ForeColor = &H80000012
        End If

    Next

    BitBlt SelectedPlug.hdc, 0, 0, 176, 289, myHDC, SelectedPlug.Left, SelectedPlug.Top, vbSrcCopy
    BitBlt MainContainer.hdc, 0, 0, 168, 302, myHDC, MainContainer.Left, MainContainer.Top, vbSrcCopy
    SelectedPlug.Refresh
    MainContainer.Refresh
End Sub

Private Sub Load_Text_File(File_Path As String, Optional ISAnInternetURL As Boolean = False)

    'Objets ole utilisés pour charger les formats exotiques, et les formats standards aussi. Gestion htm, pdf,lrc,doc,txt,rtf.
    'On Error GoTo err_handler

    Dim oWord   As Object

    Dim oDoc    As Object

    Dim oIE     As Object

    Dim donnees As String, auteur As String, Start As Long, total As Long, Titre As String

    Apercu.TextRTF = vbNullString
    Apercu.Text = LoadString(21)
    'Charge un fichier autorisé (3 sources : browse_click + ole apercu et directory)
    Directory.Text = File_Path
    Me.MousePointer = vbCustom

    DoEvents

    If LCase$(Right$(Directory.Text, 3)) = "txt" Or LCase$(Right$(Directory.Text, 3)) = "rtf" Then
        '--------------------------------------------->Fichiers txt et rtf>---------------------------------------------
        Apercu.LoadFile Directory.Text
    Else

        If LCase$(Right$(Directory.Text, 3)) = "doc" Or LCase$(Right$(Directory.Text, 4)) = "docx" Then
            '--------------------------------------------->Fichiers doc>---------------------------------------------
            'Créer l'application Word
            Set oWord = CreateObject("word.application")
            'Ouvrir le document
            Set oDoc = oWord.documents.Add(File_Path)
            Apercu.TextRTF = LoadString(22) & vbCrLf & LoadString(23)
            oWord.Application.Selection.WholeStory
            oWord.Application.Selection.Copy

            DoEvents
            oWord.Quit
            Set oWord = Nothing    ' détruire l'objet Word
            Apercu.TextRTF = LoadString(24)
            CollerWordFile.Enabled = True
        ElseIf ISAnInternetURL Then
            '--------------------------------------------->Fichiers Internet : htm,asp,xhtml,html,php...>---------------------------------------------
            'Créer l'instance d'IE
            Set oIE = CreateObject("internetexplorer.application")
            'Telecharger la page en arrière plan
            oIE.Navigate (File_Path)
            Apercu.TextRTF = LoadString(25) & vbCrLf & LoadString(26)

            DoEvents

            'Attendre la fin du telechargement pour continuer
            Do While (oIE.ReadyState <> 4)
            Loop

            Apercu.TextRTF = LoadString(27) & vbCrLf & LoadString(28) & vbCrLf & LoadString(29)

            DoEvents
            'Copier l'adresse
            oIE.Document.body.createTextRange.execCommand ("Copy")

            DoEvents
            oIE.Quit

            DoEvents
            Set oIE = Nothing
            Apercu.TextRTF = LoadString(30)
            CollerWordFile.Enabled = True
            AfficherTip LoadMSG(1), LoadMSG(2), PlugChoice(0), False
'            Download File_Path
'            Open Stockage For Input As #1
'            donnees = vbNullString
'            Do Until EOF(1) = -1
'                Line Input #1, Titre
'                donnees = donnees & Titre
'            Loop
'            Close #1
'            Apercu.Text = Replace(Replace(Replace(Replace(Replace(Replace(Replace(donnees, vbCrLf, ""), "<br>", vbCrLf), "<br/>", vbCrLf), "<br />", vbCrLf), "<p>", vbCrLf), "</p>", vbCrLf), "</li>", vbCrLf)
        ElseIf LCase$(Right$(Directory.Text, 3)) = "pdf" Then

            '--------------------------------------------->Fichiers PDf>---------------------------------------------
            If vbNo = MsgBox(LoadString(31), "TXT2JPG") Then Exit Sub
            Apercu.TextRTF = LoadString(32)
            ShellExecute Me.hwnd, "open", LoadString(33), vbNullString, App.Path, 1
            Apercu.TextRTF = "Path : " & File_Path
        ElseIf LCase$(Right$(Directory.Text, 3)) = "lrc" Then
            '--------------------------------------------->Fichiers lrc contenant les lyrics d'une chanson>---------------------------------------------
            Apercu.LoadFile Directory.Text

            donnees = Apercu.Text
            Apercu.Text = LoadString(34)
            auteur = MyMid(donnees, "[by:", "]", 1)
            Titre = MyMid(donnees, "[ti:", "]", 1)

            If Titre = vbNullString Then Titre = InputBox(LoadString(35), LoadString(36))

            donnees = Titre & vbCrLf & donnees
            donnees = Replace(donnees, "[by:" & auteur & "]", "Par : " & IIf(auteur <> vbNullString, auteur, "----") & vbCrLf)
            total = Len(donnees)

            For tempo = 1 To total

                If Mid$(donnees, tempo, 1) = "[" Then Start = tempo
                If Mid$(donnees, tempo, 1) = "]" Then

                    donnees = Replace(donnees, Mid$(donnees, Start, tempo - Start + 1), vbNullString)
                    tempo = Start 'Si deux balises à la suite
                    total = Len(donnees)
                End If

            Next

            total = Len(donnees)

            For tempo = 1 To total

                If Mid$(donnees, tempo, 1) = "<" Then Start = tempo
                If Mid$(donnees, tempo, 1) = ">" Then

                    donnees = Replace(donnees, Mid$(donnees, Start, tempo - Start + 1), vbNullString)
                    tempo = Start 'Si deux balises à la suite
                    total = Len(donnees)
                End If

            Next

            NoSelEvents = True

            With Apercu
                .Text = donnees
                .SelStart = 0
                .SelLength = InStr(1, donnees, vbCrLf)
                .SelUnderline = True
                .SelColor = vbRed
                .SelFontSize = 11
                .SelStart = InStr(1, donnees, "Par : " & IIf(auteur <> vbNullString, auteur, "----"))

                If .SelStart <> 0 Then
                    .SelStart = .SelStart - 1
                    .SelLength = Len("Par : " & auteur)
                    .SelItalic = True
                    .SelFontSize = 7
                    .SelColor = RGB(128, 128, 128)
                End If

                .SelStart = 0
                .SelLength = 0
            End With

            NoSelEvents = False
        Else

            '--------------------------------------------->Fichiers non reconnus mais lisibles en mode texte>---------------------------------------------
            If vbNo = MsgBox(LoadString(37), vbYesNo + vbExclamation, "TXT2JPG") Then Exit Sub
            Apercu.LoadFile Directory.Text
        End If
    End If

    If Not (ISAnInternetURL) Then
        Dest_Folder_GotTheFocus
        Dest_Folder.Text = Right$(Directory.Text, Len(Directory.Text) - InStrRev(Directory.Text, "\"))
        Dest_Folder.Text = Left$(Dest_Folder.Text, Len(Dest_Folder.Text) - 4)
    Else
        Dest_Folder_GotTheFocus
        Dest_Folder.Text = Right$(Directory.Text, Len(Directory.Text) - InStrRev(Directory.Text, "/"))
    End If

    Dest_Folder.SetFocus
    Apercu.SelStart = 1
    Me.MousePointer = 0

    Exit Sub

err_handler:
    AfficherTip LoadMSG(3), Err.Description, Dest_Folder, vbExclamation
    Me.MousePointer = vbDefault
End Sub

Private Sub Translate_Text()
    On Error Resume Next
    'Change le texte de la boite d'accueil selon le langage choisi
    'Ne change que si rien n'est déjà chargé
    Dim Texte_Orig As String, ctl As Control, CurIndex As Long, Current_ligne As String

    If InStr(1, Apercu.Text, "TXT2JPG") <> 0 Or Apercu.Text = vbNullString Then
        Apercu.LoadFile GetSetting("TXT2JPG", "Data", "Last_File", App.Path & "\Lang\HOME_" & GetSetting("TXT2JPG", "Data", "Langue", "Francais") & ".rtf")
    End If
    'Puis charger tout les caption, text et autres : (le on error goto est très important !)
    For Each ctl In Me.Controls
        If TypeOf ctl Is Label Or TypeOf ctl Is Bouton Or TypeOf ctl Is OptionButton Or TypeOf ctl Is TextBox Or TypeOf ctl Is ComboBox Or TypeOf ctl Is TextBoxPlus Or TypeOf ctl Is CheckBoxPlus Or TypeOf ctl Is Image Or TypeOf ctl Is CommandButton Then
            'Charger le ToolTipText :
            ctl.ToolTipText = LoadCaption(ctl.Name & "|0|ToolTipText")
            ctl.ToolTipText = LoadCaption(ctl.Name & "|" & ctl.Index & "|ToolTipText")

            'Puis les propriétés spécifiques à chaque controles.
            If TypeOf ctl Is Label Or TypeOf ctl Is Bouton Or TypeOf ctl Is OptionButton Or TypeOf ctl Is CommandButton Then
                ctl.Caption = LoadCaption(ctl.Name & "|0|Caption")
                ctl.Caption = LoadCaption(ctl.Name & "|" & ctl.Index & "|Caption")
            End If

            If TypeOf ctl Is TextBox Or TypeOf ctl Is ComboBox Or TypeOf ctl Is TextBoxPlus Then
                ctl.Text = LoadCaption(ctl.Name & "|0|Text")
                ctl.Text = LoadCaption(ctl.Name & "|" & ctl.Index & "|Text")
            End If
            If TypeOf ctl Is TextBoxPlus Then
                ctl.CueBanner = LoadCaption(ctl.Name & "|0|CueBanner"): Err.Number = 0
                ctl.CueBanner = LoadCaption(ctl.Name & "|" & ctl.Index & "|CueBanner")
            End If
        End If
    Next
    'Puis changee les menus
    For tempo = 0 To Edition.UBound
        Edition(tempo).Caption = LoadCaption("Edition|" & tempo & "|Caption")
    Next
End Sub

Private Sub Abandon_Click()
    On Error Resume Next
    Abandon.Visible = False
    Apercu.TextRTF = SVGofRTF
End Sub

Private Sub Align_Click(Index As Integer)
    On Error Resume Next
    Apercu.SelAlignment = Index
End Sub

Private Sub Alignement_Click()
    On Error Resume Next
    If IsNull(Apercu.SelAlignment) Then
        PopupMenu Edition(18)
    Else
        PopupMenu Edition(18), , , , Align(Apercu.SelAlignment)
    End If

End Sub

Private Sub Apercu_KeyDown(KeyCode As Integer, Shift As Integer)
    On Error Resume Next
    Dim TXT As String, Sel_emplacement As Long

    If TailleTexte < 5000 Then
        TXT = Apercu.TextRTF
        TailleTexte = Len(TXT)

        If InStr(1, TXT, "<hr />") <> 0 Then
            Sel_emplacement = Apercu.SelStart
            Apercu.TextRTF = Replace(TXT, "<hr />", Barre)
            Apercu.SelStart = Sel_emplacement - 5
        End If
    End If

    If Shift = vbCtrlMask And KeyCode = vbKeyF Then Edition_Click (3)
    If Shift = vbCtrlMask And KeyCode = vbKeyH Then Edition_Click (2)

    ' Le KeyCode = 9, correspond à la touche [TAB]
    If (KeyCode = 9) And (Shift = 0) Then
        ' Remet le KeyCode à 0 pour éviter la perte du focus
        KeyCode = 0
        ' Envoie un [Control]+[TAB], pour insérer une tabulation
        SendKeys "^{TAB}"
    End If

End Sub

Private Sub Apercu_MouseDown(Button As Integer, Shift As Integer, X As Single, Y As Single)
    On Error Resume Next
    Dim mouse_pt As POINTAPI
    'Affiche le menu pop up avec les options d'ajustement, utilise aussi le message EM_CHARFROMPOS afin de positionnner correctement le curseur
    If Button = vbRightButton Then
        mouse_pt.X = X \ Screen.TwipsPerPixelX: mouse_pt.Y = Y \ Screen.TwipsPerPixelY

        If Apercu.SelLength = 0 Then Apercu.SelStart = SendMessage(Apercu.hwnd, EM_CHARFROMPOS, 0&, mouse_pt)
        Apercu.Enabled = False
        Apercu.Enabled = True
        PopupMenu Menus(0), , , , Edition(0)
    End If
End Sub

Private Sub Apercu_MouseUp(Button As Integer, Shift As Integer, X As Single, Y As Single)
    On Error Resume Next
    Dim LinkResult As ResultConstant

    LinkResult = IsLink(X, Y, Apercu)
    If Button = 1 Then
        With LinkResult
            If .EstUnLiens = True And .Email = False And .interne = False Then
                If Right(.URL, 1) = " " Then .URL = Left(.URL, Len(.URL) - 1)
                ShellExecute Me.hwnd, vbNullString, .URL, vbNullString, "C:\", 2
            ElseIf .EstUnLiens = True And .Email = True Then
                ShellExecute Me.hwnd, vbNullString, "mailto:" & .URL, vbNullString, "C:\", 2
            End If
        End With
    End If
End Sub

Private Sub Apercu_OLEDragDrop(Data As RichTextLib.DataObject, Effect As Long, Button As Integer, Shift As Integer, X As Single, Y As Single)
    On Error Resume Next
    'Autorise le glisser déposer de fichier
    SVGofRTF = Apercu.TextRTF

    If Data.GetFormat(vbCFRTF) Then
        Apercu.TextRTF = LoadString(47)
        Apercu.TextRTF = Data.GetData(vbCFRTF)
    ElseIf Data.GetFormat(vbCFText) Then
        Apercu.TextRTF = vbNullString
        Apercu.Text = Data.GetData(vbCFText)
    ElseIf Data.GetFormat(vbCFFiles) Then
        Load_Text_File Data.Files.Item(1)
    ElseIf Data.GetFormat(vbCFBitmap) Then
        SendMessage Apercu.hwnd, WM_PASTE, 0, 0
    Else
        MsgBox LoadString(48), vbCritical + vbOKOnly
    End If

    Do_Abort
End Sub

Private Sub Apercu_SelChange()
    On Error Resume Next
    'Si on travaille sur l'ensemble, on peut accélerer le tout !
    If NoSelEvents Then Exit Sub

    'Règle ce qui peut être reglé (taille et police en fait) en fonction de la sélection

    DoNotChange = True
    Taille.Text = Apercu.SelFontSize
    Polices.Text = Apercu.SelFontName

    If SetMarge(0).Tag <> Apercu.SelIndent Then SetMarge_MouseMove 0, vbLeftButton, 0, Apercu.SelIndent * 1.48, 0

    DoNotChange = True

    If SetMarge(1).Tag <> Apercu.SelRightIndent Then SetMarge_MouseMove 1, vbLeftButton, 0, Apercu.SelRightIndent * 1.48, 0

    DoNotChange = False
End Sub

Private Sub Appliquer_Click()
    On Error Resume Next
    'Appliquer les effets dégradés
    Dim SVGofCaption As String

    If Apercu.SelLength = 0 Then AfficherTip LoadMSG(5), LoadMSG(6), ColorRangeOverView, False: Exit Sub
    SVGofCaption = Appliquer.Caption
    Appliquer.Caption = "...."
    SVGofRTF = Apercu.TextRTF
    Annuler.Enabled = True

    Dim longueur As Long, X As Variant, rouge1 As Long, vert1 As Long, bleu1 As Long, rouge2 As Long, vert2 As Long, bleu2 As Long, Fin As Long

    debut = Apercu.SelStart
    longueur = Apercu.SelLength
    bleu1 = Int(ColorRange(0).BackColor \ 65536)
    vert1 = Int((ColorRange(0).BackColor - (65536 * bleu1)) \ 256)
    rouge1 = ColorRange(0).BackColor - ((bleu1 * 65536) + (vert1 * 256))
    bleu2 = Int(ColorRange(1).BackColor \ 65536)
    vert2 = Int((ColorRange(1).BackColor - (65536 * bleu2)) \ 256)
    rouge2 = ColorRange(1).BackColor - ((bleu2 * 65536) + (vert2 * 256))
    Fin = debut + longueur - 1

    DoEvents

    For tempo = debut To Fin
        Apercu.SelStart = tempo
        Apercu.SelLength = 1
        X = (tempo - debut) / longueur
        Apercu.SelColor = RGB(rouge1 + (rouge2 - rouge1) * X, vert1 + (vert2 - vert1) * X, bleu1 + (bleu2 - bleu1) * X)
    Next

    Apercu.SelStart = debut
    Apercu.SelLength = longueur
    Appliquer.Caption = SVGofCaption
End Sub

Private Sub AppliquImage_Click()
    On Error Resume Next
    For tempo = 0 To 2
        Traitement_Img(tempo).Visible = False
    Next

    For tempo = 35 To 0 Step -1
        etiquette(32).Top = tempo
        etiquette(33).Top = tempo + 42
        etiquette(34).Top = tempo + 119
        etiquette(35).Top = tempo + 168
        AppliquImage.Top = 210

        DoEvents
    Next

    AppliquImage.Visible = False
    IsSlidingWorking = False
End Sub

Private Sub BC_Click(Index As Integer)
    On Error Resume Next
    'Updater le registre
    If DoNotChange Then Exit Sub
    SaveSetting "TXT2JPG", "Data", "BG_red", IIf(BC(0).Value = True, 1, 0)
    SaveSetting "TXT2JPG", "Data", "BG_green", IIf(BC(1).Value = True, 1, 0)
    SaveSetting "TXT2JPG", "Data", "BG_blue", IIf(BC(2).Value = True, 1, 0)
    SaveSetting "TXT2JPG", "Data", "Sens_dessin", IIf(BC(3).Value = True, 1, 0)
    'Updater les variables
    BG_red = GetSetting("TXT2JPG", "Data", "BG_red", "0")
    BG_green = GetSetting("TXT2JPG", "Data", "BG_green", "0")
    BG_blue = GetSetting("TXT2JPG", "Data", "BG_blue", "1")
    sens_dessin = GetSetting("TXT2JPG", "Data", "Sens_dessin", "0")
    SaveSetting "TXT2JPG", "Data", "BackPic", vbNullString

    'Updater la feuille
    Form_Redraw
    Qualite_MouseMove 0, 0, 1, 1
    'Et terminé !
End Sub

'Private Sub BlackAndWhite_Click()
'Mettre l'image en niveau de noir et gris
'Dim X As Long, Y As Long, rouge As Long, vert As Long, bleu As Long, CCouleur As Long, LLargeur As Long, HHauteur As Long, Img_To_Blit_DC As Long
'Me.MousePointer = 11
'   If BlackAndWhite.Value = true Then
'        DoEvents
'        LLargeur = Largeur.Text
'        HHauteur = Hauteur.Text
'        Img_To_Blit_DC = Image_A_Blitter.hDC
'        For X = 1 To LLargeur
'            For Y = 1 To HHauteur
'                CCouleur = GetPixel(Img_To_Blit_DC, X, Y)
'                bleu = Int(CCouleur \ 65536)
'                vert = Int((CCouleur - (65536 * bleu)) \ 256)
'                rouge = CCouleur - ((bleu * 65536) + (vert * 256))
'                CCouleur = (rouge + vert + bleu) \ 3
'                SetpixelV Img_To_Blit_DC, X, Y, RGB(CCouleur, CCouleur, CCouleur)
'            Next
'        Next
'        Image_A_Blitter.Refresh
'        Pochette.Picture = LoadPicture(vbnullstring)
'        DoEvents
'        Pochette.Picture = Image_A_Blitter.Image
'    Else
'        Pochette.Picture = LoadPicture(Filig.Text)
'        Image_A_Blitter.Picture = LoadPicture(Filig.Text)
'        DoEvents
'        If Image_A_Blitter.Width > Largeur.Text Or Image_A_Blitter.Height > Hauteur.Text Then
'            tempo = MsgBox(LoadString(49), vbYesNoCancel + vbInformation, LoadString(50))
'            If tempo = vbCancel Then Exit Sub
'            Image_A_Blitter.BackColor = RGB(254, 255, 255)
'            If tempo = vbYes Then Image_A_Blitter.PaintPicture LoadPicture(Filig.Text), 0, 0, Largeur.Text, Hauteur.Text
'            DoEvents
'        End If
'    End If
'Me.MousePointer = 0
'End Sub
Private Sub Browse_Click()
    On Error Resume Next

    'Charge un fichier texte avec comdlg API
    Reponse = OpenFile(Me.hwnd, LoadString(51), 1, OFN_FILEMUSTEXIST + OFN_PATHMUSTEXIST + OFN_HIDEREADONLY, LoadString(52), vbNullString, GetSetting("TXT2JPG", "Data", "LastPathName", App.Path))

    If Reponse = vbNullString Or Reponse = "0" Then Exit Sub
    SaveSetting "TXT2JPG", "Data", "LastPathName", Reponse
    Load_Text_File Reponse
End Sub

Private Sub Browse_MouseMove(Button As Integer, Shift As Integer, X As Single, Y As Single)
    On Error Resume Next
    ShowHelpFor Browse, LoadMSG(7), LoadMSG(8)
End Sub
Private Sub Browse2_Click()
    On Error Resume Next

    'Charge une image avec comdlg
    Reponse = OpenFile(Me.hwnd, LoadString(53), 1, OFN_FILEMUSTEXIST + OFN_PATHMUSTEXIST + OFN_HIDEREADONLY, LoadString(54), vbNullString, GetSetting("TXT2JPG", "Data", "LastPathName", App.Path))

    If Reponse = vbNullString Then Exit Sub
    SaveSetting "TXT2JPG", "Data", "LastPathName", Reponse
    Filig.Text = Reponse
End Sub

Private Sub Bug_Envoi_Click()
    On Error Resume Next
    Download "http://neamar.free.fr/mailer.php?action=bug&nom=" & GetSetting("TXT2JPG", "Data", "Nom", "Anonyme") & "&message=" & Bug_Texte.Text
    Bug_Texte.BackColor = RGB(255, 140, 140)
    Bug_Texte.Text = vbNullString
    Bug_Texte.CueBanner = LoadString(55)
End Sub

Private Sub BUG_MouseMove(Button As Integer, Shift As Integer, X As Single, Y As Single)
    On Error Resume Next
    Bug_Envoi.ForeColor = vbBlack
End Sub

Private Sub Bug_rapport_Click()
    On Error Resume Next
    BUG.Visible = True
    BUG.Top = -30
    'Bug_Close.Picture = BallonTipCancel(0).Picture
    debut = Timer
    Apercu.Height = Apercu.Height - (30 - Apercu.Top)

    DoEvents
    Do
        tempo = Min(-30 + 60 * (Timer - debut), 0)
        BUG.Top = tempo
        Apercu.Top = tempo + 30

        DoEvents
    Loop While tempo <> 0

End Sub

Private Sub Bug_rapport_MouseMove(Button As Integer, Shift As Integer, X As Single, Y As Single)
    On Error Resume Next
    etiquette(16).Caption = LoadString(56)
    etiquette(16).Tag = "Come into  bug ? Have some ideas to share ? Clic and write !"
End Sub

Private Sub Bug_Texte_MouseMove(Button As Integer, Shift As Integer, X As Single, Y As Single)
    Bug_Envoi.ForeColor = vbBlack
End Sub

Private Sub CharMap_Click()
    On Error Resume Next
    If 0 = Shell("C:\Windows\System32\charmap.exe", vbNormalFocus) Then MsgBox LoadString(57)
End Sub

Private Sub ChoosePic_Click()
    On Error Resume Next

    'Charge une image de fond avec comdlg
    BallonTip.Visible = False
    Reponse = OpenFile(Me.hwnd, LoadString(58), 1, OFN_FILEMUSTEXIST + OFN_PATHMUSTEXIST + OFN_HIDEREADONLY, LoadString(54), vbNullString, GetSetting("TXT2JPG", "Data", "LastPathName", App.Path))

    If Reponse = vbNullString Then Exit Sub
    SaveSetting "TXT2JPG", "Data", "LastPathName", Reponse
    SaveSetting "TXT2JPG", "Data", "BackPic", Reponse
    Set BackPicture = LoadPicture(Reponse)

    Form_Redraw
End Sub

Private Sub ChoosePic_MouseMove(Button As Integer, Shift As Integer, X As Single, Y As Single)
    ShowHelpFor ChoosePic, LoadMSG(9), LoadMSG(10)
End Sub

Private Sub CollerWordFile_Timer()
    On Error Resume Next
    'Colle le RTF d'un fichier word recupéré, car bug du do events à priori...
    CollerWordFile.Enabled = False
    Apercu.TextRTF = vbNullString
    'Edition_Click 11
    SendMessage Apercu.hwnd, WM_PASTE, 0, 0
End Sub

Private Sub ColorRange_Click(Index As Integer)
    On Error Resume Next
    Dim X As Long, Y As Long, rouge1 As Long, vert1 As Long, bleu1 As Long, CCouleur As Long, color_dc As Long, rouge2 As Long, vert2 As Long, bleu2 As Long

    Couleur_Selectionnee = ChoixCouleur(Me.hwnd)

    If Couleur_Selectionnee = -1 Then Exit Sub
    ColorRange(Index).BackColor = Couleur_Selectionnee
    'Rafraichir l'apercu
    color_dc = ColorRangeOverView.hdc
    bleu1 = Int(ColorRange(0).BackColor \ 65536)
    vert1 = Int((ColorRange(0).BackColor - (65536 * bleu1)) \ 256)
    rouge1 = ColorRange(0).BackColor - ((bleu1 * 65536) + (vert1 * 256))
    bleu2 = Int(ColorRange(1).BackColor \ 65536)
    vert2 = Int((ColorRange(1).BackColor - (65536 * bleu2)) \ 256)
    rouge2 = ColorRange(1).BackColor - ((bleu2 * 65536) + (vert2 * 256))

    For X = 0 To 113
        'Règle de trois !
        CCouleur = RGB(rouge1 + (rouge2 - rouge1) * X \ 113, vert1 + (vert2 - vert1) * X \ 113, bleu1 + (bleu2 - bleu1) * X \ 113)

        For Y = 0 To 15
            SetPixelV color_dc, X, Y, CCouleur
        Next
    Next

    ColorRangeOverView.Refresh
End Sub

Private Sub Annuler_Click()
    On Error Resume Next
    'Demande l'annulation du dernier effet appliqué
    'If Annuler.Enabled Then
    '    AfficherTip LoadMSG(11), LoadMSG(12) & vbCrLf & "-Aucune modification effectuée" & vbCrLf & "-Annulation déjà effectuée", "Can't Undo", "This error may come because :" & vbCrLf & "-No change done" & vbCrLf & "-Change still done, can't undo more than once.", Annuler
    '    Exit Sub
    'End If
    Apercu.TextRTF = SVGofRTF
    Annuler.Enabled = False
End Sub

Private Sub ColorRange_MouseMove(Index As Integer, Button As Integer, Shift As Integer, X As Single, Y As Single)
    ShowHelpFor ColorRange(Index), LoadMSG(13), LoadMSG(14)
End Sub

Private Sub Defaut_MouseMove(Button As Integer, Shift As Integer, X As Single, Y As Single)
    ShowHelpFor Defaut, LoadMSG(69), LoadMSG(70)
End Sub

Private Sub Dest_Folder_GotTheFocus()
    AfficherTip LoadMSG(15), LoadMSG(16), Dest_Folder
End Sub


Private Sub Dest_Folder_MouseMove(Button As Integer, Shift As Integer, X As Single, Y As Single)
    ShowHelpFor Dest_Folder, LoadMSG(15), LoadMSG(16)
End Sub

Private Sub DL_From_URL_MouseMove(Button As Integer, Shift As Integer, X As Single, Y As Single)
    ShowHelpFor DL_From_URL, LoadMSG(17), LoadMSG(18)
End Sub

Private Sub Bug_Envoi_MouseMove(Button As Integer, Shift As Integer, X As Single, Y As Single)
    Bug_Envoi.ForeColor = vbBlue
End Sub

Private Sub BallonTip_Fermer()
    BallonTip.Visible = False
End Sub

Private Sub En_JPG_MouseMove(Button As Integer, Shift As Integer)
    ShowHelpFor En_JPG, LoadMSG(41), LoadMSG(42)
End Sub

Private Sub Filig_KeyPress(KeyAscii As Integer)
    'Empêche de marquer manuellement une valeur
    KeyAscii = 0
End Sub

Private Sub KeyWord_Change()
    On Error Resume Next
    If KeyWord.Text = vbNullString Then KeyWord.Invalide = True Else KeyWord.Invalide = False
End Sub



Private Sub Marque_DropDown()
    BallonTip.Visible = False
End Sub

Private Sub Marque_GotFocus()
    'Dérouler le combobox
    SendMessage Marque.hwnd, CB_SHOWDROPDOWN, True, ByVal 0
End Sub
Private Sub Modeles_GotFocus()
    'Dérouler le combobox
    SendMessage Modeles.hwnd, CB_SHOWDROPDOWN, True, ByVal 0
End Sub

Private Sub MouseOutProc_Timer()
Dim pPos As POINTAPI
Call GetCursorPos(pPos)
If WindowFromPoint(pPos.X, pPos.Y) <> MouseOutProc.Tag And WindowFromPoint(pPos.X, pPos.Y) <> BallonTip.hwnd Then
    BallonTip.Visible = False
    BallonTip.Top = 0
    BallonTip.Left = 0
    MouseOutProc.Enabled = False
End If
End Sub

Private Sub Pagination_MouseMove(Button As Integer, Shift As Integer)
    ShowHelpFor Pagination, LoadMSG(57), LoadMSG(58)
End Sub

Private Sub PutACopyOfFileInFolder_MouseMove(Button As Integer, Shift As Integer)
    ShowHelpFor PutACopyOfFileInFolder, LoadMSG(67), LoadMSG(68)
End Sub

Private Sub Qualite_GotFocus()
    AfficherTip LoadMSG(19), LoadMSG(20), Qualite, True
End Sub

Private Sub Rechercher_Texte_KeyDown(KeyCode As Integer, Shift As Integer)
    On Error Resume Next
    If KeyCode = 13 Then Rechercher_Suite_Click
    Rechercher_Texte.SetFocus
End Sub

Private Sub Reseau_Change()
    Reseau.BackColor = vbWhite
End Sub

Private Sub Root_Change()
    On Error Resume Next
    'OLE ! Pour l'apparence visuelle...
    etiquette(4).Caption = LoadString(59) & vbCrLf & Dest_Folder.Text & "\" & Root.Text

    'Nom de root invalide  car contenant caractère interdit
    If Root.Text Like "*[\/:*?""<>]*" Then
        Root.Invalide = True
        AfficherTip LoadMSG(21), LoadMSG(22) & vbCrLf & LoadMSG(4) & "\ / : * ? \"" < >", Root, vbCritical
    Else
        Root.Invalide = False
    End If

    If Root.Text <> vbNullString Then
        If Separateur(5).Y1 = 210 Then
            debut = Timer

            Do
                tempo = Min(210 + 56 * (Timer - debut), 238)
                Separateur(5).Y1 = tempo
                Separateur(5).Y2 = tempo
                etiquette(22).Top = tempo + 7
                etiquette(7).Top = (0.95 * tempo) + 35
                ClearType.Top = tempo + 7

                Type_Numerisation.Top = (0.95 * tempo) + 35

                etiquette(38).Top = (0.97 * tempo) + 45
                SplitChapter.Top = (0.97 * tempo) + 45
            Loop Until tempo = 238

            etiquette(4).Visible = True
        End If
    End If

End Sub

Private Sub Root_GotTheFocus()
    MAJ_Timer
End Sub

Private Sub Root_MouseMove(Button As Integer, Shift As Integer, X As Single, Y As Single)
ShowHelpFor Root, LoadMSG(23), LoadMSG(24)
End Sub

Private Sub SetMarge_MouseDown(Index As Integer, Button As Integer, Shift As Integer, X As Single, Y As Single)
    SetMarge_MouseMove Index, Button, Shift, X, Y
End Sub

Private Sub SetMarge_MouseMove(Index As Integer, Button As Integer, Shift As Integer, X As Single, Y As Single)
    On Error Resume Next
    'Updater la valeur
    If Button = vbLeftButton And X >= 0 And X <= 144 Then
        SetMarge(Index).Tag = (100 * X) \ 148
    End If

    'Arrière plan
    BitBlt SetMarge(Index).hdc, 0, 0, 148, 15, Plug(2).hdc, SetMarge(Index).Left, SetMarge(Index).Top, vbSrcCopy
    TransparentBlt SetMarge(Index).hdc, 0, 2, 148, 13, QualiteMask.hdc, 0, 0, 148, 13, RGB(255, 255, 255)
    'Bulle
    TransparentBlt SetMarge(Index).hdc, (SetMarge(Index).Tag) * 1.48 - 4, 1, 11, 13, QualiteMask.hdc, 149, 0, 11, 13, RGB(255, 255, 255)
    SetMarge(Index).Refresh

    If DoNotChange Then DoNotChange = False: Exit Sub
    If Button = vbLeftButton Then

        On Error Resume Next

        If Index <= 1 Then

            'Marge à gauche/A droite
            If Apercu.SelText = vbNullString Then
                Apercu.SelStart = 0
                Apercu.SelLength = Len(Apercu.Text)
            End If

            If Index = 0 Then
                Apercu.SelIndent = SetMarge(0).Tag
                etiquette(13).Caption = Left$(etiquette(13).Caption, Len(etiquette(13).Caption) - 5) & FORMAT$(Apercu.SelIndent, "000") & "px"
            Else
                Apercu.SelRightIndent = SetMarge(1).Tag
                etiquette(14).Caption = Left$(etiquette(14).Caption, Len(etiquette(14).Caption) - 5) & FORMAT$(Apercu.SelRightIndent, "000") & "px"
            End If

        Else
            'Marge en haut/en bas
            etiquette(27).Caption = Left$(etiquette(27).Caption, Len(etiquette(27).Caption) - 5) & FORMAT$(SetMarge(2).Tag, "000") & "px"
            etiquette(26).Caption = Left$(etiquette(26).Caption, Len(etiquette(26).Caption) - 5) & FORMAT$(SetMarge(3).Tag, "000") & "px"
            TextBoxMargins Apercu, 5, SetMarge(2).Tag, 5, SetMarge(3).Tag
            TextBoxMargins Converter, 5, SetMarge(2).Tag, 5, SetMarge(3).Tag
        End If

        'If Index > 1 Then AfficherTip LoadMSG(25), LoadMSG(26), SetMarge(3), False
    End If

End Sub

Private Sub SplitChapter_Click()
    On Error Resume Next
    If SplitChapter.Value = True Then
        KeyWord.Visible = True
        KeyWord.Top = SplitChapter.Top - 3
        etiquette(38).Caption = LoadString(60)
        AfficherTip LoadMSG(27), LoadMSG(28), PlugChoice(2), False
        'KeyWord.SetFocus
    Else
        KeyWord.Visible = False
        etiquette(38).Caption = LoadString(61)
    End If

End Sub

Private Sub DL_From_URL_Click()
    On Error Resume Next
    Dim URL_To_Load As String

    URL_To_Load = InputBox(LoadString(62), LoadString(63), LoadString(38))
    If URL_To_Load = vbNullString Then Exit Sub

    Load_Text_File URL_To_Load, True
End Sub

Private Sub Filig_GotFocus()
    'Dérouler le combobox
    SendMessage Filig.hwnd, CB_SHOWDROPDOWN, True, ByVal 0
End Sub

Private Sub Marque_KeyPress(KeyAscii As Integer)
    KeyAscii = 0
End Sub

Private Sub Modeles_KeyPress(KeyAscii As Integer)
    'Locker sans locker
    KeyAscii = 0
End Sub

Private Sub ModulesWhat_Click(Index As Integer)
    On Error Resume Next
    If Index Then
        WhatAbout.Visible = True
        'Affiche l'historique des versions
        Me.MousePointer = vbCustom

        Download "http://neamar.free.fr/Addins/Zen.php?version=1"

        With WhatAbout
            .TextRTF = vbNullString
            .LoadFile Stockage
            .SelStart = 0
            .SelLength = 0
            .SelText = "TXT2JPg - Build n°" & App.Revision & vbCrLf & "Neamar, 2007. " & vbCrLf & "Mail : neamart@yahoo.fr" & vbCrLf & LoadString(64) & GetSetting("TXT2JPG", "Data", "Nom", "Anonyme") & vbCrLf & LoadString(65) & vbCrLf & "------------------------------" & vbCrLf & LoadString(66) & vbCrLf
            .Text = Replace(Replace(.Text, "<br>", vbCrLf), "<br />", vbCrLf)

            DoEvents
            .SelStart = 0
            .SelLength = 20
            .SelColor = vbRed
        End With

        Kill Stockage
        Me.MousePointer = vbDefault
    Else
        WhatAbout.Visible = False
    End If

End Sub

Private Sub Polices_GotFocus()
    On Error Resume Next
    'Dérouler le combobox
    If Polices.ListCount <> 0 Then SendMessage Polices.hwnd, CB_SHOWDROPDOWN, True, ByVal 0
End Sub

Private Sub Polices_KeyPress(KeyAscii As Integer)
    'Locker sans locker
    KeyAscii = 0
End Sub

Private Sub Priorite_GotFocus()
    On Error Resume Next
    'Dérouler le combobox
    SendMessage Priorite.hwnd, CB_SHOWDROPDOWN, True, ByVal 0
    AfficherTip LoadMSG(29), LoadMSG(30), PlugChoice(3), False
End Sub

Private Sub Priorite_KeyPress(KeyAscii As Integer)
    On Error Resume Next
    'Locker sans locker
    KeyAscii = 0
End Sub

Private Sub PutACopyOfFileInFolder_Click()
    On Error Resume Next
    SaveSetting "TXT2JPG", "Data", "PutCopy", PutACopyOfFileInFolder.Value
End Sub

Private Sub Rechercher_Close_Click()
    On Error Resume Next
    Rechercher.Visible = False
    Apercu.Height = Apercu.Height + Rechercher.Height - 10
End Sub

Private Sub Rechercher_Close_MouseMove(Button As Integer, Shift As Integer, X As Single, Y As Single)
    On Error Resume Next
    If Rechercher_Close.Tag <> "Highlight" Then
        Rechercher_Close.Picture = Cross(1).Picture
        Rechercher_Close.Tag = "Highlight"
    End If

End Sub

Private Sub Rechercher_Fond_MouseMove(Button As Integer, Shift As Integer, X As Single, Y As Single)
    On Error Resume Next
    If Rechercher_Close.Tag = "Highlight" Then
        Rechercher_Close.Picture = Cross(0).Picture
        Rechercher_Close.Tag = vbNullString
    End If

End Sub

Private Sub Rechercher_Suite_Click()
    On Error Resume Next
    If Rechercher.Tag = LoadString(67) Then

        'Rechercher
        Apercu.SelStart = InStr(Apercu.SelStart + 2, Apercu.Text, Rechercher_Texte.Text) - 1
        Apercu.SelLength = Len(Rechercher_Texte.Text)

        If Apercu.SelText <> Rechercher_Texte.Text Then
            Apercu.SelLength = 0
            Rechercher_Texte.ForeColor = vbRed
        Else
            Rechercher_Texte.ForeColor = vbBlack
        End If

        Apercu.SetFocus
    End If

    If Rechercher.Tag = LoadString(68) Then

        'Rechercher & remplacer
        Dim compteur As Long, cherche As String, remplace As String, LenCherche As Long

        cherche = Rechercher_Texte.Text
        remplace = Rechercher_Remplacer.Text
        LenCherche = Len(cherche)
        Me.MousePointer = vbCustom
        compteur = 0
        tempo = -LenCherche + 1

        Do
            tempo = InStr(tempo + LenCherche, Apercu.Text, cherche)

            If tempo = 0 Then Exit Do
            Apercu.SelStart = tempo - 1
            Apercu.SelLength = LenCherche
            Apercu.SelText = remplace
            compteur = compteur + 1
        Loop

        AfficherTip LoadMSG(31), compteur & LoadMSG(32), PlugChoice(0), vbInformation
        Me.MousePointer = vbDefault
    End If

End Sub

Private Sub Rechercher_Texte_Change()
    On Error Resume Next
    If Rechercher.Tag = LoadString(67) Then
        'Rechercher
        Apercu.SelStart = InStr(1, Apercu.Text, Rechercher_Texte.Text) - 1
        Apercu.SelLength = Len(Rechercher_Texte.Text)

        If Apercu.SelText <> Rechercher_Texte.Text Then
            Apercu.SelLength = 0
            Rechercher_Texte.ForeColor = vbRed
        Else
            Rechercher_Texte.ForeColor = vbBlack
        End If
    End If

End Sub

Private Sub Reseau_GotFocus()
    AfficherTip LoadMSG(33), LoadMSG(34), Reseau
End Sub

Private Sub Reseau_LostFocus()
    BallonTip.Visible = False
End Sub

Private Sub Save_Folder_GotFocus()
    On Error Resume Next
    AfficherTip LoadMSG(35), LoadMSG(36), Save_Folder
End Sub

Private Sub Save_Folder_LostFocus()
    BallonTip.Visible = False
End Sub

Private Sub Taille_GotFocus()
    'MEssage de déroulement
    SendMessage Taille.hwnd, CB_SHOWDROPDOWN, True, ByVal 0
End Sub

Private Sub TailleDegrade_MouseDown(Index As Integer, Button As Integer, Shift As Integer, X As Single, Y As Single)
    TailleDegrade_MouseMove Index, Button, Shift, X, Y
End Sub

Private Sub TailleDegrade_MouseMove(Index As Integer, Button As Integer, Shift As Integer, X As Single, Y As Single)
    On Error Resume Next
    'Updater la valeur

    If Button = vbLeftButton And Y > 5 And Y < 135 Then
        BallonTip.Visible = False

        If Apercu.SelLength = 0 Then AfficherTip LoadMSG(37), LoadMSG(38), TailleDegrade(Index), False: Exit Sub
        TailleDegrade(Index).Tag = Y
    End If

    'Arrière plan
    BitBlt TailleDegrade(Index).hdc, 0, 0, 15, 148, Plug(5).hdc, TailleDegrade(Index).Left, TailleDegrade(Index).Top, vbSrcCopy
    TransparentBlt TailleDegrade(Index).hdc, 0, 2, 13, 148, TailleMask.hdc, 0, 0, 13, 148, RGB(255, 255, 255)
    'Bulle
    TransparentBlt TailleDegrade(Index).hdc, 1, TailleDegrade(Index).Tag, 13, 11, TailleMask.hdc, 0, 149, 13, 11, RGB(255, 255, 255)
    TailleDegrade(Index).Refresh

    If Button = vbLeftButton Then
        SVGofRTF = Apercu.TextRTF
        Annuler.Enabled = True

        Dim longueur As Long, left_value As Long, right_value As Single, SVGofCaption As String, Fin As Long

        SVGofCaption = etiquette(30).Caption
        etiquette(30).Caption = LoadString(69) & vbCrLf & LoadString(70) & Apercu.SelLength

        DoEvents
        left_value = 135 - TailleDegrade(0).Tag

        With Apercu
            longueur = .SelLength
            debut = .SelStart
            right_value = ((135 - TailleDegrade(1).Tag) - left_value) \ longueur 'Right value correspond en fait à la différence...divisée par la longueur. C'est de la précompilation ^^
            Fin = debut + longueur

            For tempo = debut To Fin
                .SelStart = tempo
                .SelLength = 1
                'Une simple règle de trois ;-)
                .SelFontSize = left_value + (tempo - debut) * right_value
            Next

            .SelStart = debut
            .SelLength = longueur
        End With
        etiquette(30).Caption = SVGofCaption
    End If

End Sub

Private Sub Start_Click()
    Numeriser
End Sub

Private Sub Dest_Folder_Change()
    On Error Resume Next
    If Dest_Folder.Text = vbNullString Then Exit Sub
    If Dest_Folder.Text Like "*[\/:*?""<>]*" Then
        'Nom de fichier invalide  car contenant caractère interdit
        Dest_Folder.Invalide = True
        AfficherTip LoadMSG(39), LoadMSG(4) & "\ / : * ? \"" < >", Dest_Folder, vbCritical
    Else
        Dest_Folder.Invalide = False

        If Dest_Folder.HasFocus Then BallonTip.Visible = False

        'Le fichier existe déjà ? On informe !
        If Dir$(GetSetting("TXT2JPG", "Data", "Default_Path", App.Path) & "\" & Dest_Folder.Text, vbDirectory) <> vbNullString Then AfficherTip LoadMSG(65), Replace(LoadMSG(66), "%u", Root.Text), Dest_Folder, vbInformation
    End If

End Sub

Private Sub Traitement_Img_Click(Index As Integer)
    On Error Resume Next
    If NonForcé Then Exit Sub
    NonForcé = True

    For tempo = 0 To 2
        Traitement_Img(tempo).Value = False
    Next

    Traitement_Img(Index).Value = True
    NonForcé = False
End Sub

Private Sub Use_Back_Picture_MouseMove(Button As Integer, Shift As Integer)
    ShowHelpFor Use_Back_Picture, LoadMSG(71), LoadMSG(72)
End Sub

Private Sub UseForeColor_Click()
    On Error Resume Next
    SaveSetting "TXT2JPG", "Data", "CleverColor", Abs(UseForeColor.Value)
    CleverColor = UseForeColor.Value

    Form_Redraw

    If Not (CleverColor) Then

        For tempo = 0 To etiquette.UBound
            etiquette(tempo).ForeColor = -2147483633
        Next

        etiquette(41).ForeColor = vbBlack
        etiquette(40).ForeColor = vbBlack
    End If

End Sub

Private Sub VoirApercu_MouseDown(Button As Integer, Shift As Integer, X As Single, Y As Single)
    VoirApercu_MouseMove Button, Shift, X, Y
End Sub

Private Sub VoirApercu_MouseMove(Button As Integer, Shift As Integer, X As Single, Y As Single)
    On Error Resume Next

    If Button <> 0 And X > 0 And Y > 0 And X < VoirApercu.Width * Screen.TwipsPerPixelX And Y < VoirApercu.Height * Screen.TwipsPerPixelY Then
        OverView.Picture = Image_A_Blitter.Picture
        OverView.Visible = True
    Else
        OverView.Visible = False
    End If

End Sub

Private Sub Filig_OLEDragDrop(Data As DataObject, Effect As Long, Button As Integer, Shift As Integer, X As Single, Y As Single)
    On Error Resume Next
    'Le drag drop Windows pour un path d'image
    If Data.GetFormat(vbCFFiles) Then Filig.Text = Data.Files.Item(1)
End Sub

Private Sub Use_Back_Picture_Click()
    On Error Resume Next
    'Mini animation de déroulement du controle shape
    If Use_Back_Picture.Value = True Then
        debut = Timer

        Do
            tempo = Min(99 * (Timer - debut), 99)
            BitBlt Plug(1).hdc, 0, 0, 176, 289, myHDC, Plug(1).Left, Plug(1).Top, vbSrcCopy
            Glass 9, 180, 170, 170 + tempo, Plug(1).hdc
            Plug(1).Refresh

            If tempo + Use_Back_Picture.Top + 10 > Filig.Top Then Filig.Visible = True: Browse2.Visible = True
            If tempo + Use_Back_Picture.Top + 10 > RedimToFit.Top Then RedimToFit.Visible = True: etiquette(6).Visible = True
            If tempo + Use_Back_Picture.Top + 10 > Cover.Top Then Cover.Visible = True: etiquette(12).Visible = True

            DoEvents
        Loop Until tempo = 99

        Apercu.BackColor = vbWhite
        Converter.BackColor = vbWhite
        Resultat.BackColor = vbWhite
        ClearType.Value = 0
        ClearType.Visible = False
        etiquette(22).Visible = False
    Else
        debut = Timer
        BitBlt Plug(1).hdc, 0, 0, 176, 289, myHDC, 0, Plug(1).Top, vbSrcCopy
        Plug(1).Refresh
        Filig.Visible = False
        Browse2.Visible = False
        RedimToFit.Visible = False
        etiquette(6).Visible = False
        Cover.Visible = False
        etiquette(12).Visible = False
        ClearType.Visible = True
        etiquette(22).Visible = True
        VoirApercu.Visible = False
    End If

End Sub

Private Sub Browse3_Click()
    On Error Resume Next
    Do
        Save_Folder.Text = SelectFolder(LoadString(1), Me.hwnd)
    Loop While Save_Folder.Text = vbNullString Or Save_Folder.Text = "NotDefine"

    Enregistrer_Click (1)
End Sub
'Private Sub Dest_Folder_LostFocus()
''Masquer l'infobulle
'BallonTip.Visible = False
'
'With Dest_Folder
'    If .Text = vbNullString Then
'        .ForeColor = RGB(100, 100, 100)
'        .FontBold = False
'        .Text = LoadString(71)
'    End If
'End With
'End Sub

Private Sub Directory_DblClick()
    'Bouble clic = clic sur le bouton
    Browse_Click
End Sub

Private Sub Directory_OLEDragDrop(Data As DataObject, Effect As Long, Button As Integer, Shift As Integer, X As Single, Y As Single)
    On Error Resume Next
    'Drag'n drop
    Directory.Text = vbNullString
    Load_Text_File Data.Files.Item(1)
End Sub

Private Sub Enregistrer_Click(Index As Integer)
    On Error Resume Next
    If Index = 0 Then
        If Reseau.Text = vbNullString Then Reseau.Text = Environ$("USERNAME")
        SaveSetting "TXT2JPG", "Data", "Nom", Reseau.Text
        Enregistrer(0).Visible = False
        Reseau.BackColor = RGB(0, 196, 0)
    End If

    If Index = 1 Then
        If Dir$(Save_Folder.Text, vbDirectory) = vbNullString Then Save_Folder.BackColor = 255: Exit Sub
        Save_Folder.BackColor = RGB(0, 196, 0)

        If Save_Folder.Text = vbNullString Then Save_Folder.Text = App.Path
        SaveSetting "TXT2JPG", "Data", "Default_Path", Save_Folder.Text
        Enregistrer(1).Visible = False
    End If

End Sub

Private Sub etiquette_Click(Index As Integer)
    On Error Resume Next
    Dim ctl As Control

    'Vérifier si on ne veut pas activer un checkbox
    For Each ctl In Me.Controls

        If TypeOf ctl Is CheckBoxPlus Then
            If ctl.Top = etiquette(Index).Top Then
                If ctl.Left > etiquette(Index).Left - 16 Then
                    If ctl.Left < etiquette(Index).Left Then
                        If ctl.Enabled = True Then
                            ctl.Value = (ctl.Value + 1) Mod 2       'On fait en cascade pour s'éviter un max de temps...
                        End If
                    End If
                End If
            End If
        End If

    Next

End Sub

Private Sub Filig_Click()
    On Error Resume Next
    'Propose plein de trucs marrants !
    If Filig.Text = LoadString(96) Then
        ShellExecute Me.hwnd, "open", "http://www.ict.tuwien.ac.at/pictures/", vbNullString, App.Path, 1

        Exit Sub

    End If

    'Charge une belle image...
    Filig.Text = GetSetting("TXT2JPG", "BackPicture", Filig.Text, Filig.Text)
    MAJ.Tag = Filig.Text
    MAJ.Enabled = True
End Sub

Private Sub Langue_Click()
    On Error Resume Next
    'Change la langue de l'interface (a partir des tag des controles, ou de mon experience)
    Dim ctl As Control, swapper As String
    SaveSetting "TXT2JPG", "Data", "Langue", Langue.Text
    'Truc à faire manuellement (hélas)
    Align(0).Caption = LoadCaption("Align|1|Caption")
    Align(1).Caption = LoadCaption("Align|2|Caption")
    Align(2).Caption = LoadCaption("Align|3|Caption")
    For tempo = 0 To 18
        Edition(tempo).Caption = LoadCaption("Edition|" & tempo & "|Caption")
    Next
    BallonTip.Visible = False
    Translate_Text

'    For Each ctl In Me.Controls
'
'        If TypeOf ctl Is Label Or TypeOf ctl Is CommandButton Or TypeOf ctl Is OptionButton Or TypeOf ctl Is Bouton Then
'            If ctl.Caption <> vbNullString Then
'                swapper = ctl.Caption
'                ctl.Caption = ctl.Tag
'                ctl.Tag = swapper
'            Else
'                swapper = ctl.ToolTipText
'                ctl.ToolTipText = ctl.Tag
'                ctl.Tag = swapper
'            End If
'        End If
'
'        If TypeOf ctl Is Image Or TypeOf ctl Is CheckBox Or TypeOf ctl Is TextBox Then
'            swapper = ctl.ToolTipText
'            ctl.ToolTipText = ctl.Tag
'            ctl.Tag = swapper
'        End If
'
'    Next

'    swapper = Dest_Folder.CueBanner
'    Dest_Folder.CueBanner = Dest_Folder.Tag
'    Dest_Folder.Tag = swapper
'    swapper = KeyWord.CueBanner
'    KeyWord.CueBanner = KeyWord.Tag
'    KeyWord.Tag = swapper
'    swapper = Root.CueBanner
'    Root.CueBanner = Root.Tag
'    Root.Tag = swapper
'    swapper = Bug_Texte.CueBanner
'    Bug_Texte.CueBanner = Bug_Texte.Tag
'    Bug_Texte.Tag = swapper
End Sub

Private Sub Couleur_Click(Index As Integer)
    On Error Resume Next
    'Change la couleur de premier/arrière plan

    If Cover.Value = 0 And Index = 2 And Use_Back_Picture.Value Then
        AfficherTip LoadMSG(43), LoadMSG(44), Couleur(2)
        Exit Sub
    End If

    Couleur_Selectionnee = ChoixCouleur(Me.hwnd)

    If Couleur_Selectionnee = -1 Then Exit Sub

    'If Couleur((Index + 1) Mod 2).BackColor = Couleur_Selectionnee Then
    '    AfficherTip LoadMSG(45), LoadMSG(46), Couleur(Index), False
    '    Exit Sub
    'End If
    If Index = 0 Then
        If Apercu.SelLength = 0 Then
            Apercu.SelStart = 0
            Apercu.SelLength = Len(Apercu.Text)
        End If

        Apercu.SelColor = Couleur_Selectionnee
    ElseIf Index = 1 Then
        'Apercu.BackColor = Couleur_Selectionnee
        'Converter.BackColor = Couleur_Selectionnee
        'Resultat.BackColor = Apercu.BackColor
        SetBackColorSel Apercu.hwnd, Couleur_Selectionnee
    Else
        Apercu.BackColor = Couleur_Selectionnee
        Converter.BackColor = Couleur_Selectionnee
        Resultat.BackColor = Couleur_Selectionnee
    End If

    Apercu.SetFocus
End Sub

Private Sub Defaut_Click()
    On Error Resume Next
    'Enregistrer le baladeur comme baladeur par défaut
    If Modeles.Text = LoadString(74) Or Modeles.Text = vbNullString Then Exit Sub
    If GetSetting("TXT2JPG", "Data", "Modele", vbNullString) <> vbNullString And GetSetting("TXT2JPG", "Data", "Marque", vbNullString) <> vbNullString Then
        'Demander confirmation avant le remplacement
        If vbNo = MsgBox(Replace(Replace(LoadString(78), "%u", GetSetting("TXT2JPG", "Data", "Modele", vbNullString) & "-" & GetSetting("TXT2JPG", "Data", "Marque", vbNullString)), "%n", Modeles.Text & "-" & Marque.Text) & "?", vbYesNo + vbExclamation, LoadString(80)) Then Exit Sub
    End If
    SaveSetting "TXT2JPG", "Data", "Modele", Modeles.Text
    SaveSetting "TXT2JPG", "Data", "Marque", Marque.Text
    Defaut.Visible = False
End Sub

Private Sub Edition_Click(Index As Integer)
    On Error Resume Next
    'toutes les options du clic droit
    Dim donnees As String

    Select Case Index

        Case 0
            'Annuler
            Apercu.SetFocus
            SendKeys "^z"

        Case 2
            'Remplacer
            Rechercher.Visible = True
            Rechercher.Top = Me.ScaleHeight - Rechercher.Height
            Apercu.Height = Me.ScaleHeight - Rechercher.Height - 6
            Rechercher_Remplacer.Enabled = True
            Rechercher_Remplacer.BackColor = vbWhite
            Rechercher_Texte.ForeColor = vbBlack
            Rechercher_Texte.Text = Apercu.SelText
            Rechercher.Tag = LoadString(68)
            Rechercher_Close.Picture = Cross(0).Picture
            Rechercher_Suite.Caption = LoadString(68)

        Case 3
            'Rechercher
            Rechercher.Visible = True
            Rechercher.Top = Me.ScaleHeight - Rechercher.Height
            Apercu.Height = Me.ScaleHeight - Rechercher.Height - 6
            Rechercher_Remplacer.Enabled = False
            Rechercher_Close.Picture = Cross(0).Picture
            Rechercher_Remplacer.BackColor = RGB(128, 128, 128)
            Rechercher_Texte.Text = Apercu.SelText
            Rechercher.Tag = LoadString(67)
            Rechercher_Suite.Caption = LoadString(81)

        Case 5
            'Ajuster
            Me.MousePointer = vbCustom
            SVGofRTF = Apercu.TextRTF

            donnees = Apercu.Text
            donnees = Replace(donnees, " " & vbCrLf, vbCrLf)
            donnees = Replace(donnees, "  ", " ")
            donnees = Replace(donnees, " .", ".")
            donnees = Replace(donnees, " ,", ",")
            donnees = Replace(donnees, "—", "--")
            donnees = Replace(donnees, "…", "..")
            Apercu.TextRTF = vbNullString
            Apercu.Text = donnees
            Me.MousePointer = 0

            Do_Abort

        Case 6

            'Double sauts de ligne
            donnees = Apercu.Text
            donnees = Replace(donnees, vbCrLf & vbCrLf, vbCrLf)
            SVGofRTF = Apercu.TextRTF
            Apercu.TextRTF = vbNullString
            Apercu.TextRTF = donnees

            Do_Abort

        Case 7

            '    'Faire des modifs de police
            '    On Error Resume Next
            '    'Préremplir les champs
            '    With Browser
            '        .fontname = Apercu.SelFontName
            '        .FontSize = Apercu.SelFontSize
            '        .FontBold = Apercu.SelBold
            '        .FontItalic = Apercu.SelItalic
            '        .FontUnderline = Apercu.SelUnderline
            '        .FontStrikethru = Apercu.SelStrikeThru
            '        .flags = 1
            '        .ShowFont
            '    End With
            '    'Si abandon
            '    If Err = 32755 Then Exit Sub
            '    ' Modifier ce qu'il faut
            '    With Browser
            '        Apercu.SelFontName = .fontname
            '        Apercu.SelFontSize = .FontSize
            '        Apercu.SelBold = .FontBold
            '        Apercu.SelItalic = .FontItalic
            '        Apercu.SelUnderline = .FontUnderline
            '        Apercu.SelStrikeThru = .FontStrikethru
            '    End With
        Case 9

            'Couper
            DoEvents
            Apercu.SetFocus
            SendKeys "^x"

        Case 10

            'Copier
            DoEvents
            Apercu.SetFocus
            SendKeys "^c"

        Case 11

            'Coller
            DoEvents
            Apercu.SetFocus
            SendKeys "^v"

        Case 12
            'RTF=>TXT
            SVGofRTF = Apercu.TextRTF
            Apercu.TextRTF = vbNullString
            Apercu.Text = SVGofRTF

        Case 13
            'TXT=>RTF
            Apercu.TextRTF = Apercu.Text

        Case 15
            'Recharge tout en mettant par défaut
            Unload Me
            Me.Show

        Case 17
            Apercu.SelRTF = Barre & Apercu.SelRTF

        Case 19
             MsgBox Replace(LoadString(120), "%u", "CTRL + SHIFT + A")

        Case 20
            MsgBox Replace(LoadString(120), "%u", "CTRL + 2 or CTRL + 1")

        Case 21
            MsgBox Replace(LoadString(120), "%u", "CTRL + SHIFT + =")

        Case 22
            MsgBox Replace(LoadString(120), "%u", "CTRL + =")

    End Select

    'Et on remet le focus
    Apercu.SetFocus
End Sub

Private Sub En_JPG_Click()
    On Error Resume Next
    'Proposer d'encoder les images en JPG
    SaveSetting "TXT2JPG", "Data", "SaveAsJpg", En_JPG.Value
    Me.MousePointer = vbCustom

    If En_JPG.Value = True Then
        If Dir$(GiveMePathOf(&H25) & "\BMP2JPG.dll") = vbNullString Then
            If vbYes = MsgBox(LoadString(82) & vbCrLf & vbCrLf & vbCrLf & "You should download a DLL in order to save in Jpg. Do it now ? (if an error occur, please see you firewall)", vbYesNo + vbCritical, LoadString(83)) Then
                AfficherTip LoadMSG(49), LoadMSG(50), Start, False

                Download "http://neamar.free.fr/Addins/BMP2JPG.dll", GiveMePathOf(&H25) & "\BMP2JPG.dll"
                BallonTip.Visible = False

                DoEvents
                En_JPG_Click
            Else
                En_JPG.Value = 0
            End If

        Else
            etiquette(11).Visible = True
            Qualite.Visible = True
            Qualite_MouseMove 0, 0, 1, 1
        End If

    Else
        etiquette(11).Visible = False
        Qualite.Visible = False
    End If

    Me.MousePointer = 0
End Sub

Private Sub Filig_Change()
    On Error Resume Next
    Dim PATH_FOLDER As String

    'Validité du chemin passé en paramètre
    PATH_FOLDER = Filig.Text

    If LCase$(Right$(PATH_FOLDER, 3)) = "bmp" Or LCase$(Right$(PATH_FOLDER, 3)) = "jpg" Then

        Dim attente As String

        If Dir$(PATH_FOLDER) = vbNullString Then
            AfficherTip LoadMSG(51), LoadMSG(52), Filig, vbExclamation
            Filig.BackColor = 255
            Filig.ForeColor = 0
            VoirApercu.Visible = False

            Exit Sub

        End If

        BallonTip.Visible = False
        'Svg dans le registre
        attente = Right$(PATH_FOLDER, Len(PATH_FOLDER) - InStrRev(PATH_FOLDER, "\"))
        SaveSetting "TXT2JPG", "BackPicture", Left$(attente, Len(attente) - 4), PATH_FOLDER
        'Changer la couleur
        Filig.BackColor = GetPixel(Filig.Container.hdc, Filig.Left, Filig.Top)
        Filig.ForeColor = RGB(255, 255, 255) - Filig.BackColor
        'Afficher un bouton pour apercu
        VoirApercu.Visible = True
        'Et puis le but principal
        Image_A_Blitter.Picture = LoadPicture(PATH_FOLDER)
        'Et remettre pour être sur que ca marche !
        Apercu.BackColor = vbWhite
        Converter.BackColor = vbWhite
        Resultat.BackColor = vbWhite

        DoEvents

        If Image_A_Blitter.Width <> Largeur.Text Or Image_A_Blitter.Height <> Hauteur.Text Then
            RedimToFit.Value = True
            RedimToFit.Visible = True
            etiquette(6).Visible = True
        Else
            RedimToFit.Visible = False
            etiquette(6).Visible = False
        End If

    Else
        AfficherTip LoadMSG(53), LoadMSG(54), Filig
        Image_A_Blitter.Picture = LoadPicture(vbNullString)
        VoirApercu.Visible = False
    End If

End Sub

Private Sub Form_Load()
    On Error Resume Next
    Dim Premiere_Utilisation As Boolean, Last As Long, donnees As String, MySettings As Variant, poubelle2 As Long
    'Lancer le subclassing
    myHDC = Me.hdc

    If App.LogMode <> 0 Then
        SetFormMinMaxSize Me, 900, , 344
        OldWindowProc = SetWindowLong(hwnd, GWL_WNDPROC, AddressOf NewWindowProc)
    End If

    If App.PrevInstance Then
        MsgBox LoadString(84), vbOKOnly, "PrevInstance"
        Unload Me
        Exit Sub
    End If

    'Définition des variables utilisiées tout au long du programme
    Stockage = GiveMePathOf(&H1C) & "\Stockage.txt":     NotUse = False:     Premiere_Utilisation = False:    NoInternet = False:    MyChoiceIs = 25

    If GetSetting("TXT2JPG", "Data", "Nom", vbNullString) = vbNullString Then
        SaveSetting "TXT2JPG", "Data", "Nom", Environ$("USERNAME")
        Premiere_Utilisation = True
    End If


    'Nettoyer les anciennes traces
    Me.MousePointer = vbCustom

    'Initialiser la feuille : cocher ce qui doit l'être, régler la taille, afficher un BG
    If Dir$(GetSetting("TXT2JPG", "Data", "BackPic", vbNullString)) <> vbNullString Then Set BackPicture = LoadPicture(GetSetting("TXT2JPG", "Data", "BackPic", vbNullString))
    Me.Width = Screen.Width: Me.Height = 5160
    If App.LogMode = 0 Then Me.Width = 13950
    DoNotChange = True
    BG_red = GetSetting("TXT2JPG", "Data", "BG_red", "0"): BC(0).Value = BG_red
    BG_green = GetSetting("TXT2JPG", "Data", "BG_green", 1): BC(1).Value = BG_green
    BG_blue = GetSetting("TXT2JPG", "Data", "BG_blue", "0"): BC(2).Value = BG_blue
    Make_Slide.Value = GetSetting("TXT2JPG", "Data", "Make_Slide", True)
    Reseau.Text = GetSetting("TXT2JPG", "Data", "Nom", Environ$("USERNAME"))
    sens_dessin = GetSetting("TXT2JPG", "Data", "Sens_dessin", "0"): BC(3).Value = sens_dessin
    Save_Folder.Text = GetSetting("TXT2JPG", "Data", "Default_Path", App.Path)
    PutACopyOfFileInFolder.Value = GetSetting("TXT2JPG", "Data", "PutCopy", False)
    UseForeColor.Value = GetSetting("TXT2JPG", "Data", "CleverColor", False): CleverColor = GetSetting("TXT2JPG", "Data", "CleverColor", False)
    Couleur(0).BackColor = 0
    En_JPG.Value = GetSetting("TXT2JPG", "Data", "SaveAsJpg", True)
    'Crée la liste par défaut des bG.
    SaveSetting "TXT2JPG", "BackPicture", LoadString(86), App.Path & "\parchment.jpg"
    SaveSetting "TXT2JPG", "BackPicture", LoadString(87), App.Path & "\aqua.jpg"
    SaveSetting "TXT2JPG", "BackPicture", LoadString(88), App.Path & "\earth.jpg"
    SaveSetting "TXT2JPG", "BackPicture", LoadString(89), App.Path & "\sign.jpg"
    SaveSetting "TXT2JPG", "BackPicture", LoadString(90), App.Path & "\stars.jpg"
    SaveSetting "TXT2JPG", "BackPicture", LoadString(91), App.Path & "\wave.jpg"
    SaveSetting "TXT2JPG", "BackPicture", LoadString(92), App.Path & "\sky.jpg"
    SaveSetting "TXT2JPG", "BackPicture", LoadString(93), App.Path & "\Paix.jpg"
    SaveSetting "TXT2JPG", "BackPicture", LoadString(94), App.Path & "\Ondine.jpg"
    SaveSetting "TXT2JPG", "BackPicture", LoadString(95), App.Path & "\Cristal.jpg"
    SaveSetting "TXT2JPG", "BackPicture", LoadString(96), LoadString(96)
    'Charger les priorités..
    Priorite.AddItem "NORMAL_PRIORITY_CLASS"
    Priorite.AddItem "ABOVE_NORMAL_PRIORITY_CLASS"
    Priorite.AddItem "HIGH_PRIORITY_CLASS"
    Priorite.AddItem "REALTIME_PRIORITY_CLASS"
    Priorite.Text = GetSetting("TXT2JPG", "Data", "Priorite", "NORMAL_PRIORITY_CLASS")
    SendMessage Priorite.hwnd, CB_SETDROPPEDWIDTH, 200, ByVal 0

    ' Extrait les paramètres et remplit la liste des BG
    MySettings = GetAllSettings("TXT2JPG", "BackPicture")
    poubelle = UBound(MySettings, 1): poubelle2 = LBound(MySettings, 1)

    For tempo = poubelle2 To poubelle
        Filig.AddItem MySettings(tempo, 0)
    Next

    'Afficher le "CHARGEMENT..."
    etiquette(2).Top = Hauteur - etiquette(2).Height - 50
    DoNotChange = False

    'Initialisation de l'ensemble linguistique
    donnees = Dir(App.Path & "\Lang\*.LNG") 'lister les langues disponibles
    Do
        Langue.AddItem Left$(donnees, Len(donnees) - 4)
        donnees = Dir
    Loop While donnees <> vbNullString
    Translate_Text
    Langue.Text = "<Chose Your Language>"

    'Et voilà, on montre la feuille !
    Me.Caption = "TXT2JPG, build " & App.Revision
    Apercu.Visible = False

    Me.Show

    DoEvents
    Qualite_MouseMove 0, 0, 0, 0
    Kill Stockage


    NonForcé = False
    TailleDegrade_MouseMove 0, 0, 0, 0, 0: TailleDegrade_MouseMove 1, 0, 0, 0, 0
    ColorRange(0).BackColor = 0: ColorRange(1).BackColor = 0
    Browse2.Picture = Browse.Picture
    Browse3.Picture = Browse.Picture
    Enregistrer(1).Picture = Enregistrer(0).Picture
    Defaut.Picture = Enregistrer(0).Picture
    ChoosePic.Taille = 8
    VoirApercu.Taille = 10
    Appliquer.Taille = 10
    AppliquImage.Taille = 10
    Couleur(1).BackColor = RGB(255, 255, 255)
    Converter.BackColor = RGB(255, 255, 255)
    OverView.ZOrder 0
    PlugChoice_Click (0)

    If Premiere_Utilisation Then AfficherTip LoadMSG(55), LoadMSG(56), PlugChoice(3), vbExclamation
    If Command$() <> vbNullString Then Load_Text_File Mid$(Command$(), 2, Len(Command$()) - 2)

    'De seconde main (dl liste baladeur..)
    DoEvents
    Download "http://neamar.free.fr/Addins/baladeurs.php?requete=MarqueENUM"
    Open Stockage For Input As #1
    Line Input #1, donnees
    Close #1

    donnees = donnees & LoadString(109) & "|"
    'Liste des marques
    tempo = 1
    Last = 1
    'Explode la liste
    poubelle = Len(donnees)

    For tempo = 1 To poubelle

        If Mid$(donnees, tempo, 1) = "|" Then
            Marque.AddItem Mid$(donnees, Last, tempo - Last)
            Last = tempo + 1
            tempo = tempo + 1
        End If

    Next

    If GetSetting("TXT2JPG", "Data", "Modele", vbNullString) <> vbNullString Then
        Marque.Text = GetSetting("TXT2JPG", "Data", "Marque", vbNullString)
        Marque_Click

        DoEvents
        Modeles.Text = GetSetting("TXT2JPG", "Data", "Modele", vbNullString)
        Modeles_Click
    End If

    Apercu.Visible = True
    Me.MousePointer = 0

    If (GetSetting("TXT2JPG", "Data", "ExitCode", 0) <> 0 And App.LogMode <> 0) Then
        'Le logiciel a été mal quitté ! (et est compilé !)
        BUG.Visible = True
        BUG.Top = -30
        'Bug_Close.Picture = BallonTipCancel(0).Picture
        debut = Timer
        Apercu.Height = Apercu.Height - (30 - Apercu.Top)

        DoEvents
        Do
            tempo = Min(-30 + 60 * (Timer - debut), 0)
            BUG.Top = tempo
            Apercu.Top = tempo + 30

            DoEvents
        Loop While tempo <> 0

    End If

    SaveSetting "TXT2JPG", "Data", "ExitCode", 1
End Sub

Private Sub Form_Unload(Cancel As Integer)
    'Quand on quitte, on verifie les updates et puis on sauvegarde qui'l n'y a pas eu de bugs (miracle lol)..
    SaveSetting "TXT2JPG", "Data", "NbUse", GetSetting("TXT2JPG", "Data", "NbUse", "0") + 1

    If App.LogMode <> 0 Then
        If NotUse = False Then

            On Error Resume Next

            Dim base As String

            etiquette(15).Visible = False: etiquette(2).Visible = True
            Apercu.Visible = False

            DoEvents

            'Y a t il une nouvelle version ?
            Download "http://neamar.free.fr/cible2.php?action=ZenUser&version=" & App.Revision & "&utilisateur=" & GetSetting("TXT2JPG", "Data", "Nom", "Anonyme")
            Apercu.Text = vbNullString
            Apercu.LoadFile Stockage

            DoEvents

            If Len(Apercu.Text) > 150 Then
                'Une nouvelle version est disponible !
                base = LoadString(98) & vbCrLf & Replace(Replace(Apercu.Text, "<br>", vbCrLf), "<br />", vbCrLf)

                If vbYes = MsgBox(base, vbYesNo + vbApplicationModal, LoadString(99)) Then
                    'Et il veut la telecharger ! Le bonheur ;-)
                    ShellExecute Me.hwnd, "open", LoadString(38) & "?version=" & App.Revision, vbNullString, App.Path, 1
                End If
            End If

            Kill Stockage
        End If
    End If

    'Proposer un sondage...
    If GetSetting("TXT2JPG", "Data", "NbUse", "0") = "3" Then
        If vbYes = MsgBox(LoadString(100) & vbCrLf & LoadString(101), vbYesNo, "Help TXT2JPG !") Then
            ShellExecute Me.hwnd, "open", "http://neamar.free.fr/" & LoadString(73) & "/sondage.php", vbNullString, App.Path, 1
        End If
    End If

    'Arrêter le subclassing !
    'Il n'y a pas eu de bug !
    SaveSetting "TXT2JPG", "Data", "ExitCode", 0
End Sub

Private Sub Pagination_Click()
    On Error Resume Next
    If Pagination.Value Then
        UseTopAndBottomMargin.Value = True
        UseTopAndBottomMargin.Enabled = False
        SetMarge_MouseMove 3, vbLeftButton, 0, 14 * 1.5, 0
    Else
        BallonTip.Visible = False
        UseTopAndBottomMargin.Enabled = True
    End If

    etiquette(29).BackStyle = 0
End Sub

Private Sub PlugChoice_Click(Index As Integer)

    Dim pos_depart As Long, longueur As Long, Current_time As Long, Pre_compile As Single, pos_depart2 As Long, My_DC As Long, Plug_DC As Long, OLD_Plug_DC As Long, Plug_Left As Long

    On Error Resume Next

    If IsSlidingWorking Then Exit Sub
    BallonTip.Visible = False
    IsSlidingWorking = True

    Dim duree As Long

    duree = 1000 * Abs(Make_Slide.Value) 'durée du slide en ms (0 si désactivé)

    With Plug(Index)
        .Visible = True
        .Top = -.Height
        pos_depart = .Top
        longueur = Abs(pos_depart) + Me.ScaleHeight \ 2 - .Height \ 2
        .Left = MainContainer.Left + MainContainer.Width + 7 '745
        BitBlt .hdc, 0, 0, 176, 289, myHDC, .Left, .Top, vbSrcCopy
    End With

    'Précompiler les valeurs utiles au sliding
    Pre_compile = longueur / duree
    pos_depart2 = SelectedPlug.Top
    debut = GetTickCount()
    My_DC = myHDC
    Plug_DC = Plug(Index).hdc
    Plug_Left = Plug(Index).Left
    OLD_Plug_DC = SelectedPlug.hdc

    'Et le petit sliding !
    Do
        Current_time = GetTickCount()
        Plug(Index).Top = pos_depart + (Current_time - debut) * Pre_compile
        BitBlt Plug_DC, 0, 0, 176, 289, My_DC, Plug_Left, Plug(Index).Top, vbSrcCopy
        Plug(Index).Refresh
        SelectedPlug.Top = pos_depart2 + (Current_time - debut) * Pre_compile
        BitBlt OLD_Plug_DC, 0, 0, 176, 289, My_DC, Plug_Left, SelectedPlug.Top, vbSrcCopy
        SelectedPlug.Refresh

        DoEvents
    Loop While Current_time - debut < duree

    SelectedPlug.Visible = False

    'Au cas ou on a cliqué comme un bourrin un peu partout, pour éviter des bugs anormaux :
    For tempo = 0 To PlugChoice.Count - 1

        If PlugChoice(tempo).Value = True Then

            With Plug(tempo)
                .Visible = 1
                .Top = (Me.ScaleHeight - .Height) \ 2
                BitBlt .hdc, 0, 0, 176, 289, myHDC, 0, .Top, vbSrcCopy
                .Left = MainContainer.Left + MainContainer.Width + 7 '745
            End With

            Set SelectedPlug = Plug(tempo)
        Else
            Plug(tempo).Visible = False
        End If

    Next

    If PlugChoice(1).Value Or PlugChoice(5).Value Then
        If PlugChoice(2).Top = 56 Then

            For tempo = 56 To 84
                PlugChoice(2).Top = tempo
                PlugChoice(4).Top = tempo + 28
                PlugChoice(3).Top = tempo + 56
            Next

        End If

        PlugChoice(5).Visible = True
    Else
        PlugChoice(5).Visible = False

        If PlugChoice(2).Top = 84 Then

            For tempo = 84 To 56 Step -1
                PlugChoice(2).Top = tempo
                PlugChoice(4).Top = tempo + 28
                PlugChoice(3).Top = tempo + 56
            Next

        End If
    End If

    Form_Redraw

    If Index = 5 Then
        NoSelEvents = True
        TailleDegrade_MouseMove 0, 0, 0, 0, 0
        TailleDegrade_MouseMove 1, 0, 0, 0, 0
    ElseIf Index = 2 Then
        SetMarge_MouseMove 0, 0, 0, 0, 0
        SetMarge_MouseMove 1, 0, 0, 0, 0
        SetMarge_MouseMove 2, 0, 0, 0, 0
        SetMarge_MouseMove 3, 0, 0, 0, 0
    ElseIf Index = 0 Then
        Qualite_MouseMove 0, 0, 0, 0
    Else
        NoSelEvents = False
    End If

    If Index = 0 And Modeles.Visible = False Then Glass 10, 121, 158, 152, Plug(0).hdc: Plug(0).Refresh
    If Index = 0 And Modeles.Visible = True Then Glass 10, 121, 158, 222, Plug(0).hdc: Plug(0).Refresh
    If Index = 1 And Use_Back_Picture.Value = True Then Glass 9, 180, 170, 269, Plug(1).hdc: Plug(1).Refresh
    If Index = 4 Then Glass 0, 121, 169, 200, Plug(4).hdc: Plug(4).Refresh
    If Index = 5 Then Glass 0, 170, 169, 285, Plug(5).hdc: Glass 79, 128, 81, 160, Plug(5).hdc: Plug(5).Refresh
    IsSlidingWorking = False
End Sub

Private Sub Polices_DropDown()
    On Error Resume Next
    If Polices.ListCount = 0 Then
        'Les polices mettent un certain temps à se charger, alors on prévient :
        Polices.Text = LoadString(102)

        DoEvents

        Dim nbpolice As Long

        Me.MousePointer = vbCustom
        Polices.MousePointer = vbCustom
        nbpolice = Screen.FontCount - 1

        For tempo = 0 To nbpolice
            Polices.AddItem Screen.Fonts(tempo)
        Next

        Me.MousePointer = vbDefault
        Polices.MousePointer = 0
        Me.Visible = True
        Polices.Text = "MS Sans Serif"
    End If

End Sub

Private Sub Root_LostTheFocus()
    'Masquer l'infobulle
    BallonTip.Visible = False
End Sub

Private Sub MAJ_Timer()
    On Error Resume Next
    MAJ.Enabled = False

    If MAJ.Tag <> vbNullString Then Filig.Text = MAJ.Tag: MAJ.Tag = vbNullString
    Me.Refresh

    If Qualite.Visible Then Qualite_MouseDown 0, 0, 0, 0
End Sub

Private Sub Marque_Click()
    On Error Resume Next
    'Selectionne les modèles convenant à la marque
    Dim Marque_Top As Long

    Dim Last As Long, donnees As String

    Modeles.Clear

    If En_JPG.Top = 161 Then
        Marque_Top = Marque.Top - 6
        debut = Timer

        Do
            tempo = Min(161 + 100 * (Timer - debut), 231)
            En_JPG.Top = tempo
            etiquette(10).Top = tempo
            Qualite.Top = tempo + 28
            etiquette(11).Top = tempo + 14

            If tempo - 20 > Modeles.Top Then Modeles.Visible = True
            If tempo - 15 > etiquette(8).Top Then etiquette(8).Visible = True
            If tempo - 15 > etiquette(9).Top Then etiquette(9).Visible = True
            If tempo - 20 > Hauteur.Top Then Hauteur.Visible = True
            If tempo - 20 > Largeur.Top Then Largeur.Visible = True
            If tempo - 15 > Swap.Top Then Swap.Visible = True: Defaut.Visible = True
            Qualite_MouseMove 0, 0, 0, 0
            BitBlt Plug(0).hdc, 10, Marque_Top, 159, 289 - Marque_Top, myHDC, Plug(0).Left + 10, Plug(0).Top + Marque_Top, vbSrcCopy
            Glass 10, 121, 158, tempo - 9, Plug(0).hdc: Plug(0).Refresh

            DoEvents
        Loop Until tempo = 231

    End If

    Qualite_MouseDown 0, 0, 0, 0
    Me.MousePointer = vbCustom

    Download "http://neamar.free.fr/Addins/baladeurs.php?requete=ModeleENUM&Marque=" & Marque.Text
    Open Stockage For Input As #1
    Line Input #1, donnees
    Close #1

    donnees = donnees & LoadString(104) & "|"
    'Liste des marques
    tempo = 1
    Last = 1
    poubelle = Len(donnees)

    For tempo = 1 To poubelle

        If Mid$(donnees, tempo, 1) = "|" Then
            Modeles.AddItem Mid$(donnees, Last, tempo - Last)
            Last = tempo + 1
            tempo = tempo + 1
        End If

    Next

    Me.MousePointer = 0
End Sub

Private Sub MEf_Click(Index As Integer)
    On Error Resume Next

    If Index = 0 Then Apercu.SelBold = Not (Apercu.SelBold)
    If Index = 1 Then Apercu.SelItalic = Not (Apercu.SelItalic)
    If Index = 2 Then Apercu.SelUnderline = Not (Apercu.SelUnderline)
    If Index = 3 Then Apercu.SelStrikeThru = Not (Apercu.SelStrikeThru)
    If Index = 4 Then Apercu.SelBullet = Not (Apercu.SelBullet)
    Apercu.SetFocus
End Sub

Private Sub Modeles_Click()
    On Error GoTo Err_handler_Modeles

    Dim New_Marque As String, New_Modele As String, texte As String

    texte = vbNullString

    If Modeles.Text <> LoadString(104) Then
        If Dir$(Stockage) <> vbNullString Then Kill Stockage

        Download "http://neamar.free.fr/Addins/baladeurs.php?requete=Screen_Size&Modele=" & Modeles.Text
        Open Stockage For Input As #1
        Input #1, texte
        Close #1
        Hauteur.Text = Val(Left$(texte, 3))
        Largeur.Text = Val(Mid$(texte, 4, 3))
        Defaut.Visible = True
    Else
        Hauteur.Text = InputBox(LoadString(105), LoadString(106), "240")
        Largeur.Text = InputBox(LoadString(107), LoadString(108), "320")

        If Hauteur.Text = vbNullString Or Largeur.Text = vbNullString Then
            AfficherTip LoadMSG(59), LoadMSG(60), Largeur, vbExclamation
            Exit Sub
        End If

        If Marque.Text = LoadString(109) Then New_Marque = InputBox(LoadString(110), LoadString(77), "NoName") Else New_Marque = Marque.Text
        New_Modele = InputBox(LoadString(111), LoadString(76), LoadString(76))
        Modeles.Text = New_Modele
        Marque.Text = New_Marque

        Download "http://neamar.free.fr/mailer.php?action=Submitting&marque=" & New_Marque & "&nom=" & New_Modele & "&hauteur=" & Hauteur.Text & "&largeur=" & Largeur.Text & "&auteur=" & GetSetting("TXT2JPG", "Data", "Nom", "Anonyme") & "&comment=Rien"
        AfficherTip LoadMSG(61), LoadMSG(62), Marque, False
    End If

    DoEvents

    If Filig.Text <> vbNullString Then Filig_Change

    Exit Sub

Err_handler_Modeles:
    AfficherTip LoadMSG(63), LoadMSG(64), Marque, False
End Sub

Private Sub Modules_Click(Index As Integer)
    On Error Resume Next
    Me.MousePointer = vbCustom

    Select Case Index

        Case 0

            'Propose le module ConvertPowerPoint au telechargement, ainsi que ses dépendances
            If Dir$(App.Path & "\ConvertPowerPoint.exe") = vbNullString Then
                If vbNo = MsgBox(LoadString(112), vbYesNo + vbCritical, "TXT2JPG") Then Exit Sub

                Download "http://neamar.free.fr/txt2jpg/Modules/ConvertPowerPoint.exe", App.Path & "\ConvertPowerPoint.exe"
            End If

            If Dir$(GiveMePathOf(&H25) & "\BMP2JPG.dll") = vbNullString Then
                If vbNo = MsgBox(LoadString(113), vbYesNo + vbCritical, LoadString(83)) Then Exit Sub

                Download "http://neamar.free.fr/Addins/BMP2JPG.dll", GiveMePathOf(&H25) & "\BMP2JPG.dll"
            End If

            SaveSetting "TXT2JPG", "Data", "MalLance", False
            ShellExecute Me.hwnd, "open", App.Path & "\ConvertPowerPoint.exe", vbNullString, App.Path, 1
            NotUse = True

            Download "http://neamar.free.fr/cible2.php?action=ConverterPP&utilisateur=" & GetSetting("TXT2JPG", "Data", "Nom", "Anonyme")

        Case 1

            'Propose de telecharger le module degrade
            If Dir$(App.Path & "\Degrade.exe") = vbNullString Then
                If vbNo = MsgBox(LoadString(114), vbYesNo + vbCritical, "TXT2JPG") Then Exit Sub

                Download "http://neamar.free.fr/txt2jpg/Modules/Degrade.exe", App.Path & "\Degrade.exe"
            End If

            If Modeles.Text = LoadString(74) Or Modeles.Text = vbNullString Then
                MsgBox LoadString(115), vbOKOnly + vbInformation

                Exit Sub

            End If

            SaveSetting "TXT2JPG", "Degrade", "Baladeur", Modeles.Text
            SaveSetting "TXT2JPG", "Degrade", LoadString(108), Largeur.Text
            SaveSetting "TXT2JPG", "Degrade", LoadString(106), Hauteur.Text
            ShellExecute Me.hwnd, "open", App.Path & "\Degrade.exe", vbNullString, App.Path, 1

            Download "http://neamar.free.fr/cible2.php?action=Degrade&utilisateur=" & GetSetting("TXT2JPG", "Data", "Nom", "Anonyme")
            NotUse = True

        Case 2

            'Lancer le module GIF2AVI
            If Dir$(App.Path & "\GIF2AVI.exe") = vbNullString Then
                If vbNo = MsgBox(LoadString(116), vbYesNo + vbCritical, "TXT2JPG") Then Exit Sub

                Download "http://neamar.free.fr/txt2jpg/Modules/GIF2AVI.exe", App.Path & "\GIF2AVI.exe"

                If Dir$(GiveMePathOf(&H25) & "\GIF89.DLL") = vbNullString Then Download "http://neamar.free.fr/txt2jpg/Modules/GIF89.DLL", GiveMePathOf(&H25) & "\GIF89.DLL"
                If Dir$(App.Path & "\Hypercube.gif") = vbNullString Then Download "http://neamar.free.fr/txt2jpg/Modules/Hypercube.gif", App.Path & "\Hypercube.gif"
                If Dir$(App.Path & "\CreatAVI.exe") = vbNullString Then Download "http://neamar.free.fr/txt2jpg/Modules/CreatAVI.exe", App.Path & "\CreatAVI.exe"
            End If

            SaveSetting "TXT2JPG", "Data", "MalLance", False
            ShellExecute Me.hwnd, "open", App.Path & "\GIF2AVI.exe", vbNullString, App.Path, 1
            NotUse = True

            Download "http://neamar.free.fr/cible2.php?action=Gif2Avi&utilisateur=" & GetSetting("TXT2JPG", "Data", "Nom", "Anonyme")

        Case 3

            'Ouvre la page d'accueil du projet Gutenberg
            ShellExecute Me.hwnd, "open", LoadString(117), vbNullString, App.Path, 1

        Case 4
            ShellExecute Me.hwnd, "open", "http://neamar.free.fr/Ephem/ephem.php", vbNullString, App.Path, 1
    End Select

    Me.MousePointer = 0
End Sub

Private Sub Modules_MouseMove(Index As Integer, Button As Integer, Shift As Integer, X As Single, Y As Single)
    On Error Resume Next
    etiquette(16).Caption = Modules(Index).ToolTipText
    etiquette(16).Tag = Modules(Index).Tag
End Sub

Private Sub OverView_MouseMove(Button As Integer, Shift As Integer, X As Single, Y As Single)
    OverView.Visible = False
End Sub

Private Sub Polices_Click()
    On Error Resume Next
    If DoNotChange Then Exit Sub

    'Changer la police
    On Error Resume Next

    If Apercu.SelLength = 0 Then
        Apercu.SelStart = 0
        Apercu.SelLength = Len(Apercu.Text)
    End If

    Apercu.SelFontName = Polices.Text
    Apercu.SetFocus
End Sub

Private Sub Priorite_Change()
    On Error Resume Next
    If Priorite.Text = "REALTIME_PRIORITY_CLASS" Then
        'Cette priorité peut être déstabilisante...
        MsgBox LoadString(118), vbExclamation
    End If

    SaveSetting "TXT2JPG", "Data", "Priorite", Priorite.Text
End Sub

Private Sub Priorite_Click()
    Priorite_Change
End Sub

Private Sub Qualite_MouseDown(Button As Integer, Shift As Integer, X As Single, Y As Single)
    Qualite_MouseMove Button, Shift, X, Y
End Sub

Private Sub Qualite_MouseMove(Button As Integer, Shift As Integer, X As Single, Y As Single)
    On Error Resume Next
    'Updater la valeur
    If Button = vbLeftButton And X >= 0 And X <= 148 Then
        Qualite.Tag = Int((X / 148) * 50 + 50)

        etiquette(11).Caption = Replace(LoadString(119), "%u", Qualite.Tag)
    End If

    'Arrière plan
    BitBlt Qualite.hdc, 0, 0, 148, 15, Plug(0).hdc, Qualite.Left, Qualite.Top, vbSrcCopy
    TransparentBlt Qualite.hdc, 0, 2, 148, 13, QualiteMask.hdc, 0, 0, 148, 13, RGB(255, 255, 255)
    'Bulle
    TransparentBlt Qualite.hdc, (Qualite.Tag - 50) * 2.96 - 4, 1, 11, 13, QualiteMask.hdc, 149, 0, 11, 13, RGB(255, 255, 255)
    Qualite.Refresh
End Sub

Private Sub Reseau_KeyPress(KeyAscii As Integer)
    Enregistrer(0).Visible = True
End Sub

Private Sub Save_Folder_Change()
    Enregistrer(1).Visible = True
End Sub

Private Sub Make_Slide_Click()
    SaveSetting "TXT2JPG", "Data", "Make_Slide", Make_Slide.Value
End Sub

Private Sub Swap_Click()
    On Error Resume Next
    Dim svg As Integer

    svg = Largeur.Text
    Largeur.Text = Hauteur.Text
    Hauteur.Text = svg
    svg = vbNull
End Sub

Private Sub Taille_Change()
    On Error Resume Next
    'Change la taille du texte
    If DoNotChange Then Exit Sub

    On Error Resume Next

    If Apercu.SelLength = 0 Then
        Apercu.SelStart = 0
        Apercu.SelLength = Len(Apercu.Text)
    End If

    Apercu.SelFontSize = Taille.Text
End Sub

Private Sub Taille_Click()
    Taille_Change
End Sub

Private Sub Taille_DropDown()
    On Error Resume Next
    'La première fois, charger
    If Taille.ListCount = 0 Then

        For tempo = 6 To 12
            Taille.AddItem FORMAT$(tempo, "00")
            Taille.AddItem 2 * tempo + 1
            Taille.AddItem 4 * tempo + 1
        Next

    End If

End Sub

Private Sub Taille_KeyPress(KeyAscii As Integer)
    On Error Resume Next
    Dim AllowedKeys As String

    AllowedKeys = "0123456789." & Chr$(8)

    If InStr(AllowedKeys, Chr$(KeyAscii)) = 0 Then KeyAscii = 0
End Sub

Private Sub UseTopAndBottomMargin_Click()
    On Error Resume Next
    'Détermine si l'on peut utiliser des marges haut et bas
    SetMarge(2).Visible = UseTopAndBottomMargin.Value
    SetMarge(3).Visible = UseTopAndBottomMargin.Value
    etiquette(26).Visible = UseTopAndBottomMargin.Value
    etiquette(27).Visible = UseTopAndBottomMargin.Value
End Sub

Private Sub VoirApercu_MouseUp(Button As Integer, Shift As Integer, X As Single, Y As Single)
    VoirApercu_MouseMove Button, Shift, X, Y
End Sub
