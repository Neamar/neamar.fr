Option Explicit

Private Sub Chercher_Click()
'Lancer la recherche des solutions
LancerRecherche
End Sub

Private Sub ChiffreSudoku_Change(Index As Integer)
'Quand on rentre un nouveau nombre, donner le focus au chap suivant.
If Not (IsNumeric(ChiffreSudoku(Index).Text)) Then
    ChiffreSudoku(Index).Text = vbNullString
ElseIf Index <> 80 Then
    ChiffreSudoku(Index + 1).SetFocus
End If
End Sub


Private Sub Form_Resize()
If Me.WindowState <> vbMinimized Then Solution.Height = Me.Height - 700
End Sub

