Option Explicit

Private Sub Nb_Change()
'Quand le texte change, executer la d�composition en facteurs premiers
Ajouter Nb.Text & " => " & DecoFact_fonction(Val(Nb.Text))
End Sub


