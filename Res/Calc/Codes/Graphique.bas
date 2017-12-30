Option Explicit

Public Sub DrawCalcul(RTB As RichTextBox)
    'Colorie le texte à l'intérieur d'un RichTextBox fourni en paramètre.

    Dim Texte As String, Caractere_Actuel As String * 1
    Dim Taille As Long, i As Long, Fin_BlocInstructions As Long

    Dim Couleurs(10) As Long, Indentation_Couleur As Long
    'Créer un tableau avec les couleurs à utiliser
    Indentation_Couleur = 0
    Couleurs(1) = RGB(256, 0, 0)
    Couleurs(2) = RGB(0, 256, 0)
    Couleurs(3) = RGB(0, 0, 256)
    Couleurs(4) = RGB(256, 128, 0)
    Couleurs(5) = RGB(256, 0, 256)
    Couleurs(6) = RGB(0, 155, 155)

    'Sauvegarder la position intiale du curseur
    Dim SvgSelStart As Long
    SvgSelStart = RTB.SelStart

    'Remettre la mise en forme à 0
    Texte = RTB.Text
    Taille = Len(Texte)
    RTB.SelStart = 1
    RTB.SelLength = Taille
    RTB.SelColor = vbBlack
    RTB.SelCharOffset = 0
    RTB.SelFontSize = 8

    'Boucler sur tous les caractères
    For i = 1 To Taille
        Caractere_Actuel = Mid$(Texte, i, 1)

        'Si parenthèses : trouver la parenthèse fermante associée et colorier
        If Caractere_Actuel = "(" Then
            'Trouver la prochaine parenthèse et colorier le tout
            Fin_BlocInstructions = TrouverParentheseFermante(Mid$(Texte, i + 1))
            Indentation_Couleur = ((Indentation_Couleur + 1) Mod 6)
            RTB.SelStart = i
            RTB.SelLength = Fin_BlocInstructions
            RTB.SelFontSize = RTB.SelFontSize / (5 / 6)
            RTB.SelColor = Couleurs(Indentation_Couleur + 1)
        End If

        'Si on a des puissances, on met en hauteur pour avoir une jolie visualisation graphique du concept
        If Caractere_Actuel = "^" Then
            Fin_BlocInstructions = TrouverFinBLoc(Texte, i)
            RTB.SelStart = i
            RTB.SelLength = Fin_BlocInstructions
            RTB.SelCharOffset = RTB.SelCharOffset + 60
            RTB.SelFontSize = RTB.SelFontSize * 0.75    'Et en plus, on diminue la taille
        End If
    Next
    RTB.SelStart = SvgSelStart
End Sub


