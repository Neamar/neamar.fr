Option Explicit


Public Sub Ajouter(Texte As String)
    'Ajoute un string au début du champ de texte affichant les résultats
    Form1.Result.Text = Texte & vbCrLf & Form1.Result.Text
End Sub


Public Function DecoFact_fonction(Nombre As Long) As String
Dim i, Racine_Nombre As Long
Dim Resultat As String
'Le test de primalité inclue de tester au maximum jusqu'à la racine du nombre
'On stocke donc la racixne afin de ne pas la recalculer à chaque itération
Racine_Nombre = Int(Sqr(Nombre)) + 1
For i = 2 To Racine_Nombre
    'Si Nombre est divisible par i (c'est à dire si le reste de la division vaut 0)
    If Nombre Mod i = 0 Then
        'Ajouter le nombre à la liste des résultats (un String dans ce cas)
        Resultat = Resultat + Str$(i) + " ; "
        'Pseudo-récursivité : diviser le nombre, recommencer la boucle en partant un cran plus bas
        Nombre = Nombre / i
        i = i - 1
    End If
    'Si le nombre qui reste vaut plus que 2, alors c'est un nbombre premier.
    If Nombre < 2 Then Exit For
Next

If Nombre > 2 Then DecoFact_fonction = Resultat + Str$(Nombre) Else DecoFact_fonction = Resultat
End Function


