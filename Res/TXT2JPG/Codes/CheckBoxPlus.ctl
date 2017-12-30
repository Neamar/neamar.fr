VERSION 5.00
Begin VB.UserControl CheckBoxPlus 
   BackColor       =   &H80000008&
   ClientHeight    =   495
   ClientLeft      =   0
   ClientTop       =   0
   ClientWidth     =   1185
   ForeColor       =   &H8000000B&
   ScaleHeight     =   495
   ScaleWidth      =   1185
   Begin VB.Timer Tmr_OO 
      Enabled         =   0   'False
      Interval        =   100
      Left            =   1155
      Top             =   420
   End
   Begin VB.Image CheckData 
      Height          =   195
      Index           =   4
      Left            =   945
      Picture         =   "CheckBoxPlus.ctx":0000
      Top             =   0
      Width           =   195
   End
   Begin VB.Image CheckData 
      Height          =   195
      Index           =   6
      Left            =   630
      Picture         =   "CheckBoxPlus.ctx":024A
      Top             =   0
      Width           =   195
   End
   Begin VB.Image CheckData 
      Height          =   195
      Index           =   3
      Left            =   945
      Picture         =   "CheckBoxPlus.ctx":0494
      Top             =   315
      Width           =   195
   End
   Begin VB.Image CheckData 
      Height          =   195
      Index           =   2
      Left            =   630
      Picture         =   "CheckBoxPlus.ctx":06DE
      Top             =   315
      Width           =   195
   End
   Begin VB.Image CheckData 
      Height          =   195
      Index           =   1
      Left            =   315
      Picture         =   "CheckBoxPlus.ctx":0928
      Top             =   315
      Width           =   195
   End
   Begin VB.Image CheckData 
      Height          =   195
      Index           =   0
      Left            =   0
      Picture         =   "CheckBoxPlus.ctx":0B72
      Top             =   315
      Width           =   195
   End
   Begin VB.Image Check 
      Height          =   195
      Left            =   0
      Top             =   0
      Width           =   195
   End
End
Attribute VB_Name = "CheckBoxPlus"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = True
Attribute VB_PredeclaredId = False
Attribute VB_Exposed = False
'--------------------------------------------------------------------------------
'    Component  : CheckBoxPlus
'    Project    : TXT2JPG
'
'    Description: Un chackbox avec moins do'ptions que l'original, mais des graphismes différents. Un bon compromis pour économiser du poids au projet.
'
'    Modified   :
'--------------------------------------------------------------------------------
Option Explicit

Private Type POINTAPI

    X       As Long
    Y       As Long

End Type

'
Private mEnabled As Boolean

Private mValue   As Boolean

Private Declare Function GetCursorPos Lib "user32" (lpPoint As POINTAPI) As Long

Private Declare Function WindowFromPoint Lib "user32" (ByVal xPoint As Long, ByVal yPoint As Long) As Long

Public Event Click()

Public Event MouseDown(Button As Integer, Shift As Integer)

Public Event MouseUp(Button As Integer, Shift As Integer)

Public Event MouseMove(Button As Integer, Shift As Integer)

Public Sub Redraw_Me(Optional Hilite As Boolean = False)

    'Si la souris est dessus :
    On Error Resume Next

    Dim pPos As POINTAPI, Hover As Boolean

    pPos.X = 0: pPos.Y = 0
    Hover = False

    If UserControl.Ambient.UserMode Then
        Call GetCursorPos(pPos)

        If WindowFromPoint(pPos.X, pPos.Y) = UserControl.hwnd Or Hilite Then
            Hover = True
        Else
            Tmr_OO.Enabled = False
        End If
    End If

    If Not (mEnabled) Then Hover = False
    Check.Picture = CheckData(4 * (Abs(Not (mEnabled))) + Abs(Hover) + 2 * Abs(mValue)).Picture
End Sub

'Propriétés :
Public Property Get hwnd() As Long

    On Error Resume Next

    hwnd = UserControl.hwnd
End Property

Public Property Get hdc() As Long

    On Error Resume Next

    hdc = UserControl.hdc
End Property

Public Property Let Value(ByVal mValeur As Boolean)

    On Error Resume Next

    mValue = mValeur
    Redraw_Me
    RaiseEvent Click
    PropertyChanged "Value"
End Property

Public Property Get Value() As Boolean

    On Error Resume Next

    Value = Abs(mValue)
End Property

Public Property Get Enabled() As Boolean

    On Error Resume Next

    Enabled = mEnabled
End Property

Public Property Let Enabled(ByVal mActif As Boolean)

    On Error Resume Next

    mEnabled = mActif
    Redraw_Me
End Property

'
'
'   *- PROPBAG -*
Private Sub UserControl_InitProperties()

    On Error Resume Next

    mValue = False
    mEnabled = True
End Sub

'
Private Sub UserControl_ReadProperties(PropBag As PropertyBag)

    On Error Resume Next

    Value = PropBag.ReadProperty("Value", mValue)
    Enabled = PropBag.ReadProperty("Enabled", mEnabled)
    'If UserControl.Ambient.UserMode Then Tmr_OO.Enabled = True
End Sub

'
Private Sub UserControl_WriteProperties(PropBag As PropertyBag)

    On Error Resume Next

    PropBag.WriteProperty "Value", mValue, False
    PropBag.WriteProperty "Enabled", mEnabled, True
End Sub

'
'
'   *- INIT/RESIZE/TERMINATE -*
Private Sub UserControl_Initialize()

    On Error Resume Next

    'CheckLabel.BackStyle = 0
    Check.Picture = CheckData(0).Picture
    mValue = False
    mEnabled = True
End Sub

'
Private Sub UserControl_Resize()

    On Error Resume Next

    If UserControl.Width <> 195 Then UserControl.Width = 195
    If UserControl.Height <> 195 Then UserControl.Height = 195
    'If UserControl.Ambient.UserMode Then Tmr_OO.Enabled = True Else Tmr_OO.Enabled = False
End Sub

'
Private Sub UserControl_Terminate()

    On Error Resume Next

    Tmr_OO.Enabled = False
End Sub

'
'
'   *- EVENTS -*
Private Sub Check_Click()

    On Error Resume Next

    If mEnabled Then
        mValue = IIf(mValue = False, True, False)
        Redraw_Me
        RaiseEvent Click
    End If

End Sub

Private Sub Check_MouseDown(Button As Integer, Shift As Integer, X As Single, Y As Single)

    On Error Resume Next

    RaiseEvent MouseDown(Button, Shift)
End Sub

Private Sub Check_MouseUp(Button As Integer, Shift As Integer, X As Single, Y As Single)

    On Error Resume Next

    RaiseEvent MouseUp(Button, Shift)
End Sub

Private Sub Check_MouseMove(Button As Integer, Shift As Integer, X As Single, Y As Single)

    On Error Resume Next

    Tmr_OO.Enabled = True
    RaiseEvent MouseMove(Button, Shift)
End Sub

'
Private Sub Tmr_OO_Timer()

    On Error Resume Next

    Redraw_Me
End Sub
