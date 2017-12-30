Option Explicit


Private Sub Form_Load()
Dim i As Integer

For i = 1 To 20
    NbIteration = 0
    Resultat.Text = Resultat.Text & "F(" & i & ") =     " & Fibonacci_rec(i) & "        Nbiterations : " & " = >" & NbIteration & vbCrLf
Next
End Sub


