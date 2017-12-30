'2008
'neamar@neamar.fr

'A voir :
'Problème de commutativité de la soustraction : sqr(2) - 1 - ,4142 = PB....
'quand on marque 2e2, rajouter un * : 2*e2
'EN COURS Gestion plus poussée des erreurs
'CORRIGE ! Priorité de * et / par rapport à + et -
' CORRIGE ! 2^2^3 =>mauvais ordre
'EN COURS Ajout des fonctions
'Priorité du Modulo ?
'FINI Autoriser les très grands nombres && les nombres à virgules
'Autoriser les nombres décimaux en input
Option Explicit




Private Sub Calcul_Change()
'Rafraichir les parenthèses
If Colorier.Value Then DrawCalcul Calcul
End Sub


Private Sub Calcul_KeyPress(KeyAscii As Integer)
'Si on presse ², remplacer automatiquement par ^2
If KeyAscii = 178 Then KeyAscii = 0: Calcul.SelText = "^2"

'Ne pas autoriser les sauts de ligne, les considérer comme une validation du calcul
If KeyAscii = 13 Then
    KeyAscii = 0    'Annule l'appui sur la touche
    Lancer_Click
End If
End Sub

Private Sub Colorier_Click()
'Quand on décoche le bouton, remettre le texte à 0
'Si on le coche, on met le texte à 0..ce qui lance automatiquement la colorisation
Calcul.TextRTF = Calcul.Text
End Sub

Private Sub Form_Load()
    'Calcul par défaut :
    Calcul.Text = "(sqr(e(ln((1+3)*(1/(2^2))))))^2"
    Information(2).Caption = "Fonctions supportées :" & vbCrLf & "e | ln | sqr | + | - | * | / | % | ! |"
End Sub

Private Sub Form_Resize()
    On Error Resume Next
    Resultat.Height = Me.Height / 15 - Resultat.Top - 50
    Resultat.Width = Me.Width / 15 - Resultat.Left - 20
    Calcul.Width = Me.Width / 15 - Calcul.Left - 20
    Lancer.Left = Me.Width / 15 - Lancer.Width - 40
    Colorier.Left = Me.Width / 15 - Colorier.Width - 40
End Sub


Private Sub Lancer_Click()
Dim Resultat_Calcul As Double
'Ne pas afficher de messages
Information(1).Caption = vbNullString

'Enlever les sauts de ligne
Calcul.Text = Replace(Replace(Calcul.Text, vbCrLf, ""), ")(", ")*(")
Debug.Print vbCrLf & vbCrLf & "Initialisation du calcul " & Calcul.Text
Debug.Print "-------------------------------------------------------"

'Effectuer le calcul
Pile_Appel = 0: Erreur = vbNullString
Resultat_Calcul = Math_It(Calcul.Text)
Information(1).Caption = Erreur

'Et l'afficher
Resultat.Text = Calcul.Text & IIf(Erreur = vbNullString, "       Calculs effectués en " & Pile_Appel & " sous parties." & vbCrLf & Resultat_Calcul, vbCrLf & Erreur) & vbCrLf & vbCrLf & vbCrLf & vbCrLf & Replace(Resultat.Text, vbCrLf & vbCrLf, vbCrLf)

'Puis colorier le résultat
DrawCalcul Resultat

End Sub


