VERSION 5.00
Begin VB.UserControl Bouton 
   ClientHeight    =   2535
   ClientLeft      =   0
   ClientTop       =   0
   ClientWidth     =   4365
   MaskColor       =   &H00C0C0C0&
   ScaleHeight     =   2535
   ScaleWidth      =   4365
   ToolboxBitmap   =   "AfBtn.ctx":0000
   Begin VB.Timer Tmr_OO 
      Enabled         =   0   'False
      Interval        =   100
      Left            =   2205
      Top             =   735
   End
   Begin VB.Image IMG_mouse 
      Height          =   1065
      Left            =   1575
      Picture         =   "AfBtn.ctx":0312
      Stretch         =   -1  'True
      Top             =   1155
      Width           =   2325
   End
   Begin VB.Image IMG_nomouse 
      Height          =   1065
      Left            =   105
      Picture         =   "AfBtn.ctx":2484
      Stretch         =   -1  'True
      Top             =   1155
      Width           =   2310
   End
   Begin VB.Label Lbl_Btn 
      Alignment       =   2  'Center
      Appearance      =   0  'Flat
      BackColor       =   &H80000005&
      Caption         =   "Btn XP"
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   12
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      ForeColor       =   &H80000008&
      Height          =   375
      Left            =   0
      TabIndex        =   0
      Top             =   240
      Width           =   2655
   End
   Begin VB.Image Img_Btn 
      Height          =   1170
      Left            =   0
      Stretch         =   -1  'True
      Top             =   0
      Width           =   2640
   End
End
Attribute VB_Name = "Bouton"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = True
Attribute VB_PredeclaredId = False
Attribute VB_Exposed = False
'--------------------------------------------------------------------------------
'    Component  : Bouton
'    Project    : TXT2JPG
'
'    Description: Un bouton "a la vista", qui gère mouse over et mouseout
'
'    Modified   :
'--------------------------------------------------------------------------------
Option Explicit

Private Type POINTAPI
    x       As Long
    y       As Long
End Type

'
Private mEnabled As Boolean

Private mTaille  As Long

Dim bDown        As Boolean

Private Declare Function GetCursorPos Lib "user32" (lpPoint As POINTAPI) As Long

Private Declare Function WindowFromPoint Lib "user32" (ByVal xPoint As Long, ByVal yPoint As Long) As Long

Public Event Click()
Attribute Click.VB_MemberFlags = "200"

Public Event MouseDown(Button As Integer, Shift As Integer, x As Single, y As Single)

Public Event MouseUp(Button As Integer, Shift As Integer, x As Single, y As Single)

Public Event MouseMove(Button As Integer, Shift As Integer, x As Single, y As Single)

Public Property Get Caption() As String
Attribute Caption.VB_UserMemId = -518
Attribute Caption.VB_MemberFlags = "200"

    On Error Resume Next

    Caption = Lbl_Btn.Caption
End Property

Public Property Let Caption(ByVal new_mCaption As String)

    On Error Resume Next

    Lbl_Btn.Caption = new_mCaption
    PropertyChanged "Caption"
End Property

Public Property Get Taille() As Long

    On Error Resume Next

    Taille = Lbl_Btn.FontSize
End Property

Public Property Let Taille(ByVal New_Size As Long)

    On Error Resume Next

    Lbl_Btn.FontSize = New_Size
    mTaille = New_Size
    PropertyChanged "Taille"
End Property

Public Property Get hwnd() As Long

    On Error Resume Next

    hwnd = UserControl.hwnd
End Property

Public Property Get hdc() As Long

    On Error Resume Next

    hdc = UserControl.hdc
End Property

Public Property Get Enabled() As Boolean

    On Error Resume Next

    Enabled = mEnabled
End Property

Public Property Let Enabled(ByVal new_mEnabled As Boolean)

    On Error Resume Next

    mEnabled = new_mEnabled

    If mEnabled Then
        Lbl_Btn.ForeColor = vbBlack
    Else
        Lbl_Btn.ForeColor = &HC0C0C0
    End If
    PropertyChanged "Enabled"
End Property

Public Property Let TimerState(ByVal nValue As Boolean)

    On Error Resume Next

    Tmr_OO.Enabled = nValue
    PropertyChanged "TimerState"
End Property

Private Sub UserControl_InitProperties()

    On Error Resume Next

    Caption = Lbl_Btn.Caption
    Taille = Lbl_Btn.FontSize
    mEnabled = True
End Sub

'
Private Sub UserControl_ReadProperties(PropBag As PropertyBag)

    On Error Resume Next

    Caption = PropBag.ReadProperty("Caption", Lbl_Btn.Caption)
    Enabled = PropBag.ReadProperty("Enabled", True)
    Taille = PropBag.ReadProperty("Taille", Lbl_Btn.FontSize)

    If UserControl.Ambient.UserMode Then Tmr_OO.Enabled = True
End Sub

'
Private Sub UserControl_WriteProperties(PropBag As PropertyBag)

    On Error Resume Next

    PropBag.WriteProperty "Caption", Lbl_Btn.Caption, "Btn XP"
    PropBag.WriteProperty "Enabled", mEnabled, True
    PropBag.WriteProperty "Taille", mTaille, Lbl_Btn.FontSize
End Sub

'
'
'   *- INIT/RESIZE/TERMINATE -*
Private Sub UserControl_Initialize()

    On Error Resume Next

    Lbl_Btn.BackStyle = 0
    Img_Btn.Picture = IMG_nomouse.Picture
    Lbl_Btn.FontSize = Me.Taille
    Me.TimerState = False
End Sub

'
Private Sub UserControl_Resize()

    On Error Resume Next

    'If UserControl.Width < 300 Then UserControl.Width = 300
    'If UserControl.Height < 200 Then UserControl.Height = 200
    Img_Btn.Width = UserControl.Width
    Img_Btn.Height = UserControl.Height
    Lbl_Btn.Width = UserControl.Width
    Lbl_Btn.Top = (UserControl.Height \ 2) - (Lbl_Btn.Height \ 2) + 30

    If UserControl.Ambient.UserMode Then Me.TimerState = True
End Sub

'
Private Sub UserControl_Terminate()

    On Error Resume Next

    Tmr_OO.Enabled = False
End Sub

'
'
'   *- EVENTS -*
'CLICK :
Private Sub Img_Btn_Click()

    On Error Resume Next

    If mEnabled Then RaiseEvent Click
End Sub

Private Sub Lbl_Btn_Click()

    On Error Resume Next

    If mEnabled Then RaiseEvent Click
End Sub

'MouseDown
Private Sub Img_Btn_MouseDown(Button As Integer, Shift As Integer, x As Single, y As Single)

    On Error Resume Next

    If mEnabled Then bDown = True: RaiseEvent MouseDown(Button, Shift, x, y)
End Sub

Private Sub Lbl_Btn_MouseDown(Button As Integer, Shift As Integer, x As Single, y As Single)

    On Error Resume Next

    If mEnabled Then bDown = True: RaiseEvent MouseDown(Button, Shift, x, y)
End Sub

'Mouse Up
Private Sub Img_Btn_MouseUp(Button As Integer, Shift As Integer, x As Single, y As Single)

    On Error Resume Next

    If mEnabled Then bDown = False: RaiseEvent MouseUp(Button, Shift, x, y)
End Sub

Private Sub Lbl_Btn_MouseUp(Button As Integer, Shift As Integer, x As Single, y As Single)

    On Error Resume Next

    If mEnabled Then bDown = False: RaiseEvent MouseUp(Button, Shift, x, y)
End Sub

'MOUSEMOVE
Private Sub Img_Btn_MouseMove(Button As Integer, Shift As Integer, x As Single, y As Single)

    On Error Resume Next

    Tmr_OO.Enabled = True
    RaiseEvent MouseMove(Button, Shift, x, y)
End Sub

Private Sub Lbl_Btn_MouseMove(Button As Integer, Shift As Integer, x As Single, y As Single)

    On Error Resume Next

    Tmr_OO.Enabled = True
    RaiseEvent MouseMove(Button, Shift, x, y)
End Sub

'Hover
Private Sub Tmr_OO_Timer()

    On Error Resume Next

    If mEnabled Then

        Dim pPos As POINTAPI, lHwnd As Long

        pPos.x = 0: pPos.y = 0
        Call GetCursorPos(pPos)
        lHwnd = WindowFromPoint(pPos.x, pPos.y)

        If lHwnd = UserControl.hwnd Then
            Img_Btn.Picture = IMG_mouse.Picture
            Lbl_Btn.ForeColor = IIf(bDown, vbBlue, vbRed)
        Else
            Img_Btn.Picture = IMG_nomouse.Picture
            Lbl_Btn.ForeColor = vbBlack
            Tmr_OO.Enabled = False
        End If
    End If

End Sub
