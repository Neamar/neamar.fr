'EN CAS DE BUG : Remplacer SetpixelV par setpixel, et ca remarchera !

Option Explicit

Private Type Point
        x As Long
        y As Long
End Type

Private Type carte
        IP As Long
        Type As Long
        Pression As Long
End Type
Private Type objet
        x As Long
        y As Long
        Type As Long
        Couleur As Long
End Type
Private Type Essence_d_objet
        Type As Long
        Couleur As Long
        nb_par_tour As Long
        emplacement As Long
End Type

Private Declare Function GetKeyState Lib "user32" (ByVal nVirtKey As Long) As Integer
Private Declare Function GetCursorPos Lib "user32" (lpPoint As Point) As Long
Private Declare Function ScreenToClient Lib "user32" (ByVal hwnd As Long, lpPoint As Point) As Long
Private Declare Function GetTickCount Lib "kernel32" () As Long
Private Declare Function SetPriorityClass Lib "kernel32" (ByVal hProcess As Long, ByVal dwPriorityClass As Long) As Long
Private Declare Function GetCurrentProcess Lib "kernel32" () As Long
Private Declare Function TextOut Lib "gdi32" Alias "TextOutA" (ByVal hdc As Long, ByVal x As Long, ByVal y As Long, ByVal lpString As String, ByVal nCount As Long) As Long
Private Declare Function SetPixelV Lib "gdi32" (ByVal hdc As Long, ByVal x As Long, ByVal y As Long, ByVal crColor As Long) As Long

Private Const KEY_DOWN As Long = &H1000
Private Const gris As Long = 8421504
Private Const NORMAL As Long = &H20
Private Const HAUTE As Long = &H80
Private Const REAL_TIME As Long = &H100

Private Const SAND As Long = 254
Private Const SAND_COLOR As Long = 54741 '38550
Private Const SALT As Long = 250
Private Const SALT_COLOR As Long = 16119285
Private Const WATER As Long = 127
Private Const WATER_COLOR As Long = 15605314
Private Const OIL As Long = 64
Private Const OIL_COLOR As Long = 12910591 '10813439
Private Const FIRE As Long = 21
Private Const FIRE_COLOR As Long = 255

Private Const VIDE As Long = 0

Private Sub jeu()
'C'est le coeur qui sent Dieu et non la raison

'Evenements souris
Dim Mouse As Point, svg_Mouse As Point, This_Time As Long, WhichOne As Long
'Evenements claviers
Dim SelectedOne As Long, essences(5) As Essence_d_objet
'Carte
Dim map(800, 600) As carte, type_de_beton As Long, particules(480000) As objet, nb_particule As Long, gauche As Long, droite As Long
'Outils
Dim pen_size As Long, dist_x As Long, dist_y As Long, Rien As carte
'Variables poubelles
Dim tempo As Long, x As Long, y As Long, flottant As Point, quota As Long, quota2 As Long, to_draw As String, B_G As Long, amelie As Long
'Variables API
Dim c_hDc As Long, SpeeD As Long, Debut As Long, Fin As Long, C_Hwnd As Long
'Le splash Screen
c_hDc = Me.hdc
C_Hwnd = GetCurrentProcess

to_draw = "LIFE GAME VII"
TextOut c_hDc, 1, 1, to_draw, Len(to_draw)
to_draw = "Touches utilisées par le jeu :"
TextOut c_hDc, 1, 15, to_draw, Len(to_draw)
to_draw = " -Pavé numérique : taille du pinceau"
TextOut c_hDc, 1, 30, to_draw, Len(to_draw)
to_draw = " -Touches 1 à 9 : Vitesse d'apparition de la particule sélectionnée, Touche gauche et droite : emplacement d'apparition de la particule"
TextOut c_hDc, 1, 45, to_draw, Len(to_draw)
to_draw = "  -A : Eau, B : Sable, C : Huile"
TextOut c_hDc, 1, 60, to_draw, Len(to_draw)
to_draw = "  -Clic gauche : tracer un mur, clic droit efface, Clic sur la roulette (et non roulement) tout effacer"
TextOut c_hDc, 1, 75, to_draw, Len(to_draw)
Me.ForeColor = RGB(0, 255, 0)
to_draw = "- F1 : Définir la priorité comme normale, F2 : Définir la priorité comme haute (ralentissements des autres applications), F3 : Très haute ! Risque de crash"
TextOut c_hDc, 1, 90, to_draw, Len(to_draw)
Me.ForeColor = &H8000000D
to_draw = "Quitter : ECHAP"
TextOut c_hDc, 1, 110, to_draw, Len(to_draw)
Me.ForeColor = 255
to_draw = "ATTENTION ! CE PROGRAMME SUPPRIME LES CONTROLES D'ERREURS WINDOWS."
TextOut c_hDc, 1, 200, to_draw, Len(to_draw)
to_draw = "NE PAS FAIRE APPARAITRE PLUS DE PARTICULES QUE CE QUE L'ECRAN PEUT CONTENIR !"
TextOut c_hDc, 1, 212, to_draw, Len(to_draw)
Me.ForeColor = &H8000000D
to_draw = "Appuyez sur ESPACE pour commencer"
TextOut c_hDc, 1, 300, to_draw, Len(to_draw)
Me.ForeColor = RGB(128, 128, 128)
to_draw = "By Neamar 2007"
TextOut c_hDc, 1, 500, to_draw, Len(to_draw)

Me.ForeColor = &H8000000D
to_draw = "Le petit point rouge en bas indique la vitesse. Plus il est proche de la gauche, plus le déroulement d'une phase est rapide."
TextOut c_hDc, 1, 580, to_draw, Len(to_draw)
Me.Refresh
to_draw = vbNullString
Do
    DoEvents
Loop Until (GetKeyState(vbKeySpace) And KEY_DOWN)
Me.ForeColor = 255
TextOut c_hDc, 400, 300, "Chargement des objets...", 24
Me.Refresh
Rien.IP = 0
Rien.Pression = 0
Rien.Type = 0
flottant.x = 0
flottant.y = 0
Mouse.y = 0

'Initialisation
For flottant.x = 0 To 800
    For flottant.y = 0 To 600
        SetPixelV c_hDc, flottant.x, flottant.y, VIDE
        map(flottant.x, flottant.y) = Rien
    Next
Next

to_draw = "LIFE GAME VII"
TextOut c_hDc, 801, 1, to_draw, Len(to_draw)
to_draw = "By Neamar"
TextOut c_hDc, 801, 13, to_draw, Len(to_draw)
to_draw = "________________"
TextOut c_hDc, 801, 25, to_draw, Len(to_draw)
Me.ForeColor = RGB(200, 200, 200)
to_draw = "Objets :"
TextOut c_hDc, 831, 50, to_draw, Len(to_draw)
to_draw = "-Eau (A)"
TextOut c_hDc, 831, 62, to_draw, Len(to_draw)
to_draw = "-Sable (B)"
TextOut c_hDc, 831, 74, to_draw, Len(to_draw)
to_draw = "-Huile (C)"
TextOut c_hDc, 831, 86, to_draw, Len(to_draw)
to_draw = "-Sel (D)"
TextOut c_hDc, 831, 98, to_draw, Len(to_draw)
to_draw = "-Feu (E)"
TextOut c_hDc, 831, 110, to_draw, Len(to_draw)
to_draw = "________________"
TextOut c_hDc, 801, 122, to_draw, Len(to_draw)
Me.ForeColor = 32768
to_draw = "Taille du pinceau : 1 "
TextOut c_hDc, 801, 147, to_draw, Len(to_draw)
to_draw = "________________"
TextOut c_hDc, 801, 157, to_draw, Len(to_draw)
to_draw = vbNullString

For quota = 801 To 806
    SetPixelV c_hDc, quota, 69, 255
Next

pen_size = 1
type_de_beton = 255
SelectedOne = 0
For x = 1 To 799 Step 798
    For y = 0 To 600
        map(x, y).Type = type_de_beton
    Next
Next
For x = 0 To 800
    map(x, 598).Type = type_de_beton
    map(x, 599).Type = type_de_beton
    map(x, 0).Type = type_de_beton
    map(x, 1).Type = type_de_beton
Next
essences(0).emplacement = 150
essences(0).Type = WATER
essences(0).Couleur = WATER_COLOR
essences(0).nb_par_tour = 0

essences(1).emplacement = 310
essences(1).Type = SAND
essences(1).Couleur = SAND_COLOR
essences(1).nb_par_tour = 0

essences(2).emplacement = 470
essences(2).Type = OIL
essences(2).Couleur = OIL_COLOR
essences(2).nb_par_tour = 0

essences(3).emplacement = 630
essences(3).Type = SALT
essences(3).Couleur = SALT_COLOR
essences(3).nb_par_tour = 0

essences(4).emplacement = 0
essences(4).Type = FIRE
essences(4).Couleur = FIRE_COLOR
essences(4).nb_par_tour = 0
'Ca commence
Debut = GetTickCount()
Do
    SetPixelV c_hDc, SpeeD, 598, VIDE
    SetPixelV c_hDc, SpeeD, 599, VIDE
    SetPixelV c_hDc, SpeeD + 1, 598, VIDE
    SetPixelV c_hDc, SpeeD + 1, 599, VIDE
    Fin = GetTickCount
    SpeeD = Fin - Debut
    Debut = Fin
    SetPixelV c_hDc, SpeeD, 598, 255
    SetPixelV c_hDc, SpeeD, 599, 255
    SetPixelV c_hDc, SpeeD + 1, 598, 255
    SetPixelV c_hDc, SpeeD + 1, 599, 255
    DoEvents
    Me.Refresh
''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
'Evenements externes
''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
    'Réglage de la priorité
    If (GetKeyState(vbKeyF1) And KEY_DOWN) Then SetPriorityClass C_Hwnd, NORMAL
    If (GetKeyState(vbKeyF2) And KEY_DOWN) Then SetPriorityClass C_Hwnd, HAUTE
    If (GetKeyState(vbKeyF3) And KEY_DOWN) Then SetPriorityClass C_Hwnd, REAL_TIME
    'Taille du pinceau
    For tempo = 96 To 105
        If (GetKeyState(tempo) And KEY_DOWN) Then
            pen_size = tempo - 96
            For flottant.x = 890 To 900
                For flottant.y = 148 To 163
                    SetPixelV c_hDc, flottant.x, flottant.y, VIDE
                Next
            Next
            to_draw = pen_size
            TextOut c_hDc, 890, 148, to_draw, 1
            to_draw = vbNullString
        End If
    Next
    'Objet selectionné
    For tempo = 65 To 70
        If (GetKeyState(tempo) And KEY_DOWN) Then
            If SelectedOne <> tempo - 65 Then
                For quota = 801 To 806
                    SetPixelV c_hDc, quota, 69 + 12 * SelectedOne, VIDE
                Next
                SelectedOne = tempo - 65
                For quota = 801 To 806
                    SetPixelV c_hDc, quota, 69 + 12 * SelectedOne, 255
                Next
            End If
        End If
    Next
    'Déplacer le flux à gauche / à droite
    If (GetKeyState(vbKeyLeft) And KEY_DOWN) Then
        essences(SelectedOne).emplacement = essences(SelectedOne).emplacement - 1
        If essences(SelectedOne).emplacement <= 25 Then essences(SelectedOne).emplacement = 775
    End If
    If (GetKeyState(vbKeyRight) And KEY_DOWN) Then essences(SelectedOne).emplacement = (essences(SelectedOne).emplacement + 1) Mod 775
    For tempo = 48 To 57
        If (GetKeyState(tempo) And KEY_DOWN) Then essences(SelectedOne).nb_par_tour = tempo - 48
    Next
    If (GetKeyState(vbKeyMButton) And KEY_DOWN) Then
        'Apothéose
        For x = 2 To 798
            For y = 2 To 597
                If map(x, y).Type = type_de_beton Then
                    map(x, y) = Rien
                    SetPixelV c_hDc, x, y, VIDE
                End If
            Next
        Next
    End If
    If (GetKeyState(vbKeyLButton) And KEY_DOWN) Then
        'Acquérir la souris
        GetCursorPos Mouse
        ScreenToClient Me.hwnd, Mouse
        If (GetKeyState(vbKeySpace) And KEY_DOWN) Then
            'Apparition de particules
            If Mouse.x - pen_size >= 5 And Mouse.y - pen_size >= 5 And Mouse.x + pen_size <= 795 And Mouse.y + pen_size <= 595 Then
                For flottant.x = Mouse.x - pen_size To Mouse.x + pen_size
                    For flottant.y = Mouse.y - pen_size To Mouse.y + pen_size
                        If map(flottant.x, flottant.y).Type <> essences(SelectedOne).Type And map(flottant.x, flottant.y).Type <> type_de_beton Then
                            If map(flottant.x, flottant.y).Type <> VIDE Then
                                WhichOne = map(flottant.x, flottant.y).IP
                                GoSub RemoveItem
                            End If
                            nb_particule = nb_particule + 1
                            tempo = nb_particule
                            particules(nb_particule).x = flottant.x
                            particules(nb_particule).y = flottant.y
                            particules(tempo).Type = essences(SelectedOne).Type
                            particules(tempo).Couleur = essences(SelectedOne).Couleur
                            map(flottant.x, flottant.y).IP = nb_particule
                            map(flottant.x, flottant.y).Type = particules(nb_particule).Type
                        End If
                    Next
                Next
                svg_Mouse = Mouse
            End If
        Else
            If svg_Mouse.x <> Mouse.x And svg_Mouse.y <> Mouse.y And B_G And svg_Mouse.x <> 0 And svg_Mouse.y <> 0 Then
                If Mouse.x - pen_size >= 0 And Mouse.y - pen_size >= 0 And Mouse.x + pen_size <= 800 And Mouse.y + pen_size <= 600 Then
                    'Joindre le dernier point avec le nouveau
                    dist_x = svg_Mouse.x - Mouse.x
                    dist_y = svg_Mouse.y - Mouse.y
                    If Abs(dist_x) >= Abs(dist_y) Then
                        For x = Mouse.x To svg_Mouse.x Step Sgn(dist_x)
                            tempo = Mouse.y + dist_y * Abs(((x - Mouse.x) / dist_x))
                            For flottant.x = x - pen_size To x + pen_size
                                For flottant.y = tempo - pen_size To tempo + pen_size
                                    If map(flottant.x, flottant.y).Type <> 0 And map(flottant.x, flottant.y).Type <> type_de_beton Then particules(map(flottant.x, flottant.y).IP).y = tempo - 1
                                    map(flottant.x, flottant.y).Type = type_de_beton
                                    map(flottant.x, flottant.y).Pression = 15 + 10 * pen_size
                                    SetPixelV c_hDc, flottant.x, flottant.y, gris
                                Next
                            Next
                        Next
                    Else
                        For y = Mouse.y To svg_Mouse.y Step Sgn(dist_y)
                            tempo = Mouse.x + dist_x * Abs(((y - Mouse.y) / dist_y))
                            For flottant.y = y - pen_size To y + pen_size
                                For flottant.x = tempo - pen_size To tempo + pen_size
                                    If map(flottant.x, flottant.y).Type <> 0 And map(flottant.x, flottant.y).Type <> type_de_beton Then particules(map(flottant.x, flottant.y).IP).y = y - 3
                                    map(flottant.x, flottant.y).Type = type_de_beton
                                    SetPixelV c_hDc, flottant.x, flottant.y, gris
                                Next
                            Next
                        Next
                    End If
                    svg_Mouse = Mouse
                End If
            Else
                If B_G = 0 Then
                    If Mouse.x - pen_size >= 0 And Mouse.y - pen_size >= 0 And Mouse.x + pen_size <= 800 And Mouse.y + pen_size <= 600 Then
                        For flottant.x = Mouse.x - pen_size To Mouse.x + pen_size
                            For flottant.y = Mouse.y - pen_size To Mouse.y + pen_size
                                If map(flottant.x, flottant.y).Type <> 0 And map(flottant.x, flottant.y).Type <> type_de_beton Then particules(map(flottant.x, flottant.y).IP).y = flottant.y - 3
                                map(flottant.x, flottant.y).Type = type_de_beton
                                SetPixelV c_hDc, flottant.x, flottant.y, gris
                            Next
                        Next
                        If svg_Mouse.x = 0 And svg_Mouse.y = 0 Then svg_Mouse = Mouse
                    End If
                End If
            End If
            B_G = 1
        End If
    Else
        B_G = 0
        svg_Mouse.x = 0
        svg_Mouse.y = 0
    End If
    If (GetKeyState(vbKeyRButton) And KEY_DOWN) Then
        'Acquérir la souris, effacer
        GetCursorPos Mouse
        ScreenToClient Me.hwnd, Mouse
        If Mouse.x - pen_size >= 0 And Mouse.y - pen_size >= 0 And Mouse.x + pen_size <= 800 And Mouse.y + pen_size <= 600 Then
            For flottant.x = Mouse.x - pen_size To Mouse.x + pen_size
                For flottant.y = Mouse.y - pen_size To Mouse.y + pen_size
                    If map(flottant.x, flottant.y).Type <> type_de_beton And map(flottant.x, flottant.y).IP <> 0 Then
                        WhichOne = map(flottant.x, flottant.y).IP
                        GoSub RemoveItem
                    End If
                    map(flottant.x, flottant.y) = Rien
                    SetPixelV c_hDc, flottant.x, flottant.y, VIDE
                Next
            Next
        End If
    End If
    This_Time = Int(5 * Rnd)
    ''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
    'Algorithme
    ''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
    For tempo = 1 To nb_particule
        'Pour chaque particule
        quota = 1
        If particules(tempo).Type < 128 Then quota = 0
        quota2 = 1
        If particules(tempo).Type < 32 Then quota2 = -1

        If map(particules(tempo).x, particules(tempo).y + quota2).Type = 0 Then
            'Si c'est vide en dessous..c'est simple !
            map(particules(tempo).x, particules(tempo).y) = Rien
            SetPixelV c_hDc, particules(tempo).x, particules(tempo).y, VIDE
            particules(tempo).y = particules(tempo).y + quota2
            'Si c'est supérieur à 590 on vire...RemoveItem
            If particules(tempo).y < 590 Then
                map(particules(tempo).x, particules(tempo).y).Type = particules(tempo).Type
                map(particules(tempo).x, particules(tempo).y).IP = tempo
                SetPixelV c_hDc, particules(tempo).x, particules(tempo).y, particules(tempo).Couleur
            Else
                map(particules(tempo).x, particules(tempo).y).Type = 0
                map(particules(tempo).x, particules(tempo).y).IP = 0
                SetPixelV c_hDc, particules(tempo).x, particules(tempo).y, VIDE
                particules(tempo).y = 1
                map(particules(tempo).x, particules(tempo).y).IP = tempo
                map(particules(tempo).x, particules(tempo).y).Type = particules(tempo).Type
                SetPixelV c_hDc, particules(tempo).x, particules(tempo).y, particules(tempo).Couleur
            End If
        Else
            'Faut tester les deux sens :
            gauche = map(particules(tempo).x - 1, particules(tempo).y + quota).Type
            droite = map(particules(tempo).x + 1, particules(tempo).y + quota).Type
            If droite = 0 And gauche = 0 Then
                'Si ca marche des deux cotés on choisit aléatoirement
                gauche = Int(2 * Rnd)
                droite = (gauche + 1) Mod 2
            End If
            If gauche = 0 Then
                'Si c'est vide à gauche
                map(particules(tempo).x, particules(tempo).y) = Rien
                SetPixelV c_hDc, particules(tempo).x, particules(tempo).y, VIDE
                particules(tempo).x = particules(tempo).x - 1
                particules(tempo).y = particules(tempo).y + quota
                map(particules(tempo).x, particules(tempo).y).Type = particules(tempo).Type
                map(particules(tempo).x, particules(tempo).y).IP = tempo
                SetPixelV c_hDc, particules(tempo).x, particules(tempo).y, particules(tempo).Couleur
            End If
            If droite = 0 Then
                'Si c'est vide à droite
                map(particules(tempo).x, particules(tempo).y) = Rien
                SetPixelV c_hDc, particules(tempo).x, particules(tempo).y, VIDE
                particules(tempo).x = particules(tempo).x + 1
                particules(tempo).y = particules(tempo).y + quota
                map(particules(tempo).x, particules(tempo).y).Type = particules(tempo).Type
                map(particules(tempo).x, particules(tempo).y).IP = tempo
                SetPixelV c_hDc, particules(tempo).x, particules(tempo).y, particules(tempo).Couleur
            End If



            'C'était les mvmts simples, maintenant on complique :


            'Pour les solides :
            If particules(tempo).Type > 128 Then
                If map(particules(tempo).x, particules(tempo).y + 1).Type < 128 And map(particules(tempo).x, particules(tempo).y + 1).Type <> 0 Then
                    'Faire couler le solide, monter le liquide
                    map(particules(tempo).x, particules(tempo).y).Type = map(particules(tempo).x, particules(tempo).y + 1).Type
                    map(particules(tempo).x, particules(tempo).y).IP = map(particules(tempo).x, particules(tempo).y + 1).IP
                    particules(map(particules(tempo).x, particules(tempo).y).IP).y = particules(map(particules(tempo).x, particules(tempo).y).IP).y - 1
                    SetPixelV c_hDc, particules(tempo).x, particules(tempo).y, particules(map(particules(tempo).x, particules(tempo).y).IP).Couleur
                    particules(tempo).y = particules(tempo).y + 1
                    map(particules(tempo).x, particules(tempo).y).Type = particules(tempo).Type
                    map(particules(tempo).x, particules(tempo).y).IP = tempo
                    SetPixelV c_hDc, particules(tempo).x, particules(tempo).y, particules(tempo).Couleur
                End If
                If This_Time = 0 And 3 * Rnd < 1 Then
                    'Caractérise la viscosité du sable.
                    gauche = map(particules(tempo).x - 1, particules(tempo).y).Type
                    droite = map(particules(tempo).x + 1, particules(tempo).y).Type
                    If gauche < 128 And gauche <> 0 Then gauche = 1
                    If droite < 128 And droite <> 0 Then droite = 1
                    If droite = 1 And gauche = 1 Then
                        'Si ca marche des deux cotés on choisit aléatoirement
                        gauche = Int(2 * Rnd)
                        droite = (gauche + 1) Mod 2
                    End If
                    If gauche = 1 Then
                        'Le sable s'effondre dans l'eau...
                        map(particules(tempo).x, particules(tempo).y).Type = map(particules(tempo).x - 1, particules(tempo).y).Type
                        map(particules(tempo).x, particules(tempo).y).IP = map(particules(tempo).x - 1, particules(tempo).y).IP
                        particules(map(particules(tempo).x, particules(tempo).y).IP).x = particules(map(particules(tempo).x, particules(tempo).y).IP).x + 1
                        SetPixelV c_hDc, particules(tempo).x, particules(tempo).y, particules(map(particules(tempo).x, particules(tempo).y).IP).Couleur
                        particules(tempo).x = particules(tempo).x - 1
                        If particules(tempo).Type = SAND Then particules(tempo).Couleur = 38550
                        map(particules(tempo).x, particules(tempo).y).Type = particules(tempo).Type
                        map(particules(tempo).x, particules(tempo).y).IP = tempo
                        SetPixelV c_hDc, particules(tempo).x, particules(tempo).y, particules(tempo).Couleur
                    End If
                    If droite = 1 Then
                        'Le sable s'effondre..bis
                        map(particules(tempo).x, particules(tempo).y).Type = map(particules(tempo).x + 1, particules(tempo).y).Type
                        map(particules(tempo).x, particules(tempo).y).IP = map(particules(tempo).x + 1, particules(tempo).y).IP
                        particules(map(particules(tempo).x, particules(tempo).y).IP).x = particules(map(particules(tempo).x, particules(tempo).y).IP).x - 1
                        SetPixelV c_hDc, particules(tempo).x, particules(tempo).y, particules(map(particules(tempo).x, particules(tempo).y).IP).Couleur
                        particules(tempo).x = particules(tempo).x + 1
                        If particules(tempo).Type = SAND Then particules(tempo).Couleur = 38550
                        map(particules(tempo).x, particules(tempo).y).Type = particules(tempo).Type
                        map(particules(tempo).x, particules(tempo).y).IP = tempo
                        SetPixelV c_hDc, particules(tempo).x, particules(tempo).y, particules(tempo).Couleur
                    End If
                End If
            End If
        End If
        'Et pour les liquides
        If particules(tempo).Type < 128 Then
            If particules(tempo).Type <> WATER Then
                If map(particules(tempo).x, particules(tempo).y - 1).Type > particules(tempo).Type And map(particules(tempo).x, particules(tempo).y - 1).Type <> type_de_beton Then
                    'L'huile flotte au dessus de tout
                    map(particules(tempo).x, particules(tempo).y).Type = map(particules(tempo).x, particules(tempo).y - 1).Type
                    map(particules(tempo).x, particules(tempo).y).IP = map(particules(tempo).x, particules(tempo).y - 1).IP
                    particules(map(particules(tempo).x, particules(tempo).y).IP).y = particules(map(particules(tempo).x, particules(tempo).y).IP).y + 1
                    SetPixelV c_hDc, particules(tempo).x, particules(tempo).y, particules(map(particules(tempo).x, particules(tempo).y).IP).Couleur
                    particules(tempo).y = particules(tempo).y - 1
                    map(particules(tempo).x, particules(tempo).y).Type = particules(tempo).Type
                    map(particules(tempo).x, particules(tempo).y).IP = tempo
                    SetPixelV c_hDc, particules(tempo).x, particules(tempo).y, particules(tempo).Couleur
                End If
                gauche = map(particules(tempo).x - 1, particules(tempo).y).Type
                droite = map(particules(tempo).x + 1, particules(tempo).y).Type
                If gauche > particules(tempo).Type And gauche < 128 Then gauche = 1
                If droite > particules(tempo).Type And droite < 128 Then droite = 1
                If gauche = droite And gauche = 1 Then
                    'Si ca marche des deux cotés on choisit aléatoirement
                    gauche = Int(2 * Rnd)
                    droite = (gauche + 1) Mod 2
                End If
                If gauche = 1 Then
                    'L'huile flotte au dessus de tout, et se déplace de façon quantique ;-) à gauche
                    map(particules(tempo).x, particules(tempo).y).Type = map(particules(tempo).x - 1, particules(tempo).y).Type
                    map(particules(tempo).x, particules(tempo).y).IP = map(particules(tempo).x - 1, particules(tempo).y).IP
                    particules(map(particules(tempo).x, particules(tempo).y).IP).x = particules(map(particules(tempo).x, particules(tempo).y).IP).x + 1
                    SetPixelV c_hDc, particules(tempo).x, particules(tempo).y, particules(map(particules(tempo).x, particules(tempo).y).IP).Couleur
                    particules(tempo).x = particules(tempo).x - 1
                    map(particules(tempo).x, particules(tempo).y).Type = particules(tempo).Type
                    map(particules(tempo).x, particules(tempo).y).IP = tempo
                    SetPixelV c_hDc, particules(tempo).x, particules(tempo).y, particules(tempo).Couleur
                End If
                If droite = 1 Then
                    'L 'huile flotte au dessus de tout, et se déplace de façon quantique ;-) à droite
                    map(particules(tempo).x, particules(tempo).y).Type = map(particules(tempo).x + 1, particules(tempo).y).Type
                    map(particules(tempo).x, particules(tempo).y).IP = map(particules(tempo).x + 1, particules(tempo).y).IP
                    particules(map(particules(tempo).x, particules(tempo).y).IP).x = particules(map(particules(tempo).x, particules(tempo).y).IP).x - 1
                    SetPixelV c_hDc, particules(tempo).x, particules(tempo).y, particules(map(particules(tempo).x, particules(tempo).y).IP).Couleur
                    particules(tempo).x = particules(tempo).x + 1
                    map(particules(tempo).x, particules(tempo).y).Type = particules(tempo).Type
                    map(particules(tempo).x, particules(tempo).y).IP = tempo
                    SetPixelV c_hDc, particules(tempo).x, particules(tempo).y, particules(tempo).Couleur
                End If
            End If
            If map(particules(tempo).x + 1, particules(tempo).y).Type <> type_de_beton And map(particules(tempo).x - 1, particules(tempo).y).Type <> type_de_beton Then
                If map(particules(tempo).x + 2, particules(tempo).y).Type = 0 And map(particules(tempo).x + 1, particules(tempo).y).Type <> 0 Then
                    'Un peu plus avancé : le double-droite.
                    map(particules(tempo).x, particules(tempo).y).Type = 0
                    SetPixelV c_hDc, particules(tempo).x, particules(tempo).y, VIDE
                    particules(tempo).x = particules(tempo).x + 2
                    map(particules(tempo).x, particules(tempo).y).Type = particules(tempo).Type
                    map(particules(tempo).x, particules(tempo).y).IP = tempo
                    SetPixelV c_hDc, particules(tempo).x, particules(tempo).y, particules(tempo).Couleur
                End If
                If map(particules(tempo).x - 2, particules(tempo).y).Type = 0 And map(particules(tempo).x + 1, particules(tempo).y).Type <> 0 Then
                    'Un peu plus avancé : le double-gauche
                    map(particules(tempo).x, particules(tempo).y).Type = 0
                    SetPixelV c_hDc, particules(tempo).x, particules(tempo).y, VIDE
                    particules(tempo).x = particules(tempo).x - 2
                    map(particules(tempo).x, particules(tempo).y).Type = particules(tempo).Type
                    map(particules(tempo).x, particules(tempo).y).IP = tempo
                    SetPixelV c_hDc, particules(tempo).x, particules(tempo).y, particules(tempo).Couleur
                End If
            End If
'            'Et enfin on calcule la pression
'            If map(particules(tempo).x, particules(tempo).y - 1).Type <> type_de_beton And map(particules(tempo).x, particules(tempo).y - 1).Type <> VIDE Then map(particules(tempo).x, particules(tempo).y).Pression = map(particules(tempo).x, particules(tempo).y - 1).Pression + 1 Else map(particules(tempo).x, particules(tempo).y).Pression = 0
'            'If map(particules(tempo).x, particules(tempo).y).Pression > map(particules(tempo).x, particules(tempo).y + 1).Pression And map(particules(tempo).x, particules(tempo).y + 1).Type = type_de_beton Then map(particules(tempo).x, particules(tempo).y + 1) = Rien
'            SetPixelV c_hDc, particules(tempo).x, particules(tempo).y, particules(tempo).Couleur
'
'            'Si on trouve une différence significative entre deux eléments proches :
'            If map(particules(tempo).x, particules(tempo).y).Pression - 30 > map(particules(tempo).x + 1, particules(tempo).y).Pression Then
'                If map(particules(tempo).x + 1, particules(tempo).y).Type <> type_de_beton And 25 * Rnd < 1 Then
'                    'SetPixelV c_hDc, particules(tempo).x, particules(tempo).y, map(particules(tempo).x, particules(tempo).y).Pression
'                    distance = particules(tempo).x
'                    Do
'                        distance = distance + 1
'                    Loop While map(distance, particules(tempo).y - map(distance, particules(tempo).y).Pression - 1).Type = WATER
'                    SetPixelV c_hDc, distance, particules(tempo).y - map(distance, particules(tempo).y).Pression, RGB(256, 256, 256)
''                    If map(distance, particules(tempo).y).Type <> type_de_beton Then
''                        map(particules(tempo).x, particules(tempo).y) = Rien
''                        SetPixelV c_hDc, particules(tempo).x, particules(tempo).y, VIDE
''                        particules(tempo).y = particules(tempo).y - map(distance, particules(tempo).y).Pression - 1
''                        particules(tempo).x = distance
''                        map(particules(tempo).x, particules(tempo).y).Type = particules(tempo).Type
''                        map(particules(tempo).x, particules(tempo).y).IP = tempo
''                        SetPixelV c_hDc, particules(tempo).x, particules(tempo).y, particules(tempo).Couleur
''                    End If
'                End If
'            End If
            If map(particules(tempo).x, particules(tempo).y + 1).Type = SALT And particules(tempo).Type = WATER And particules(tempo).Couleur <> 16744449 Then
                'Du sel et de l'eau..
                particules(tempo).Couleur = 16744449
                particules(tempo).Type = 126
                SetPixelV c_hDc, particules(tempo).x, particules(tempo).y, 16744449
                particules(map(particules(tempo).x, particules(tempo).y + 1).IP).Type = 126
                particules(map(particules(tempo).x, particules(tempo).y + 1).IP).Couleur = 16744449
                SetPixelV c_hDc, particules(tempo).x, particules(tempo).y + 1, 16744449
            End If
            If particules(tempo).Type < 32 Then
                'Le feu ronge le béton
                If map(particules(tempo).x, particules(tempo).y - 1).Type = type_de_beton And Int((255 - particules(tempo).Couleur) * Rnd) < 5 And particules(tempo).y > 4 Then
                    map(particules(tempo).x, particules(tempo).y - 1) = Rien
                    particules(tempo).Couleur = (particules(tempo).Couleur + 1) / 2
                    SetPixelV c_hDc, particules(nb_particule).x, particules(nb_particule).y - 1, VIDE
                End If
                'Huile+feu=Schpouu Explosion
                If map(particules(tempo).x, particules(tempo).y - 1).Type = OIL Then
                    particules(map(particules(tempo).x, particules(tempo).y - 1).IP).Type = FIRE
                    particules(map(particules(tempo).x, particules(tempo).y - 1).IP).Couleur = FIRE_COLOR
                End If
                If map(particules(tempo).x, particules(tempo).y + 1).Type = OIL And Int(2 * Rnd) = 0 Then
                    particules(map(particules(tempo).x, particules(tempo).y + 1).IP).Type = FIRE
                    particules(map(particules(tempo).x, particules(tempo).y + 1).IP).Couleur = FIRE_COLOR
                End If
                If map(particules(tempo).x, particules(tempo).y + 1).Type = WATER Or map(particules(tempo).x, particules(tempo).y + 1).Type = 126 Then
                    particules(tempo).Couleur = (particules(tempo).Couleur + 1) / 2
                    WhichOne = map(particules(tempo).x, particules(tempo).y + 1).IP
                    GoSub RemoveItem
                End If

                'Dégradé du feu
                particules(tempo).Couleur = Abs(particules(tempo).Couleur - Int(3 * Rnd))
                If Int(particules(tempo).Couleur * Rnd) = 0 Then WhichOne = tempo: GoSub RemoveItem

            End If
        End If
    Next
    ''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
    'Creation de nouvelles particules
    ''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
    For amelie = 0 To 3
        For tempo = 1 To essences(amelie).nb_par_tour
            nb_particule = nb_particule + 1
            particules(nb_particule).x = essences(amelie).emplacement + 20 * Rnd
            particules(nb_particule).y = 5
            particules(nb_particule).Type = essences(amelie).Type
            particules(nb_particule).Couleur = essences(amelie).Couleur
            map(particules(nb_particule).x, particules(nb_particule).y).IP = nb_particule
        Next
    Next
Loop Until (GetKeyState(vbKeyEscape) And KEY_DOWN)

Unload Me
Exit Sub
RemoveItem:
        If nb_particule <= 0 Then Return
        map(particules(WhichOne).x, particules(WhichOne).y) = Rien
        SetPixelV c_hDc, particules(WhichOne).x, particules(WhichOne).y, VIDE
        particules(WhichOne) = particules(nb_particule)
        map(particules(nb_particule).x, particules(nb_particule).y) = Rien
        SetPixelV c_hDc, particules(nb_particule).x, particules(nb_particule).y, VIDE
        particules(nb_particule).x = 1
        particules(nb_particule).y = 1
        map(particules(WhichOne).x, particules(WhichOne).y).IP = WhichOne
        nb_particule = nb_particule - 1
Return
End Sub

Private Sub Form_Load()
Me.Show
DoEvents
jeu
End Sub

