Attribute VB_Name = "Subclasser"
'--------------------------------------------------------------------------------
'    Component  : Subclasser
'    Project    : TXT2JPG
'
'    Description: Une petite sub qui s'occupe "simplement" de récupérer tout les messages envoyés par Windows à l'application, et en particulier les resize
'
'    Modified   :
'--------------------------------------------------------------------------------
Option Explicit

Public OldWindowProc As Long

Public myHDC As Long

Private Declare Function CallWindowProc Lib "user32" Alias "CallWindowProcA" (ByVal lpPrevWndFunc As Long, ByVal hwnd As Long, ByVal msg As Long, ByVal wParam As Long, ByVal lParam As Long) As Long

Public Declare Function SetWindowLong Lib "user32" Alias "SetWindowLongA" (ByVal hwnd As Long, ByVal nIndex As Long, ByVal dwNewLong As Long) As Long

Private Declare Function GetProp Lib "user32.dll" Alias "GetPropA" (ByVal hwnd As Long, ByVal lpString As String) As Long

Private Declare Function SetProp Lib "user32.dll" Alias "SetPropA" (ByVal hwnd As Long, ByVal lpString As String, ByVal hData As Long) As Long

Private Declare Sub CopyMemory Lib "kernel32.dll" Alias "RtlMoveMemory" (ByRef Destination As Any, ByRef Source As Any, ByVal Length As Long)

Public Const GWL_WNDPROC = (-4)

Private Const WM_GETMINMAXINFO As Long = &H24

Const WM_NCDESTROY = &H82

Const WM_SIZE = 5

Private Type POINTAPI

    X As Long
    Y As Long

End Type

Private Type MINMAXINFO

    ptReserved As POINTAPI
    ptMaxSize As POINTAPI
    ptMaxPosition As POINTAPI
    ptMinTrackSize As POINTAPI
    ptMaxTrackSize As POINTAPI

End Type

Public Sub SetFormMinMaxSize(Form As Form, Optional MinWidth As Long = -1, Optional MaxWidth As Long = -1, Optional MinHeight As Long = -1, Optional MaxHeight As Long = -1)

    'Cette sub permet de spécifier à Windows une taille minimale pour l'application, au delà de laquelle est ne peut plus être réduite
    Dim Provided As Long

    On Error Resume Next

    '# On mémorise les dimensions, et on met a jour la liste des dimensions figées
    If MinWidth <> -1 Then
        Provided = Provided Or 1
        '# On prend en compte le Scalemode de la form
        SetProp Form.hwnd, "MINWIDTH", Form.ScaleX(MinWidth, Form.ScaleMode, vbPixels)
    End If

    If MaxWidth <> -1 Then
        Provided = Provided Or 2
        SetProp Form.hwnd, "MAXWIDTH", Form.ScaleX(MaxWidth, Form.ScaleMode, vbPixels)
    End If

    If MinHeight <> -1 Then
        Provided = Provided Or 4
        SetProp Form.hwnd, "MINHEIGHT", Form.ScaleY(MinHeight, Form.ScaleMode, vbPixels)
    End If

    If MaxHeight <> -1 Then
        Provided = Provided Or 8
        SetProp Form.hwnd, "MAXHEIGHT", Form.ScaleY(MaxHeight, Form.ScaleMode, vbPixels)
    End If

    SetProp Form.hwnd, "MINMAX", Provided
End Sub

' Display message names.
Public Function NewWindowProc(ByVal hwnd As Long, ByVal msg As Long, ByVal wParam As Long, ByVal lParam As Long) As Long

    On Error Resume Next

    Dim MinMax   As MINMAXINFO

    Dim Provided As Long

    'Debug.Print Hex$(msg)
    Select Case msg

        Case WM_SIZE 'La feuille a été redimensionnée
            Principale.Form_TailleChange
            Principale.Form_Redraw

        Case WM_GETMINMAXINFO
            '# Liste des dimensions figées
            Provided = GetProp(hwnd, "MINMAX")
            '# On recupere les infos deja presentes
            CopyMemory MinMax, ByVal lParam, Len(MinMax)

            '# On met a jour les dimensions
            If (Provided And 1) <> 0 Then
                MinMax.ptMinTrackSize.X = GetProp(hwnd, "MINWIDTH")
            End If

            If (Provided And 2) <> 0 Then
                MinMax.ptMaxTrackSize.X = GetProp(hwnd, "MAXWIDTH")
            End If

            If (Provided And 4) <> 0 Then
                MinMax.ptMinTrackSize.Y = GetProp(hwnd, "MINHEIGHT")
            End If

            If (Provided And 8) <> 0 Then
                MinMax.ptMaxTrackSize.Y = GetProp(hwnd, "MAXHEIGHT")
            End If

            '# On réinsère le tout...
            CopyMemory ByVal lParam, MinMax, Len(MinMax)
            '# On ne repasse pas par la procédure classique...
            NewWindowProc = 0&

            Exit Function

        Case WM_NCDESTROY   'Rétablir la bonne sub de classe :
            SetWindowLong hwnd, GWL_WNDPROC, OldWindowProc
    End Select

    'Transférer le message
    NewWindowProc = CallWindowProc(OldWindowProc, hwnd, msg, wParam, lParam)
End Function
