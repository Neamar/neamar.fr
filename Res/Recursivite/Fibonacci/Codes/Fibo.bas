Option Explicit

Public NbIteration As Long
Public Function Fibonacci_rec(n As Integer) As Long
NbIteration = NbIteration + 1
If n < 2 Then Fibonacci_rec = 1 Else Fibonacci_rec = Fibonacci_rec(n - 1) + Fibonacci_rec(n - 2)
End Function


