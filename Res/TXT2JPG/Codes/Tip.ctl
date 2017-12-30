VERSION 5.00
Begin VB.UserControl Tip 
   BackColor       =   &H80000011&
   BackStyle       =   0  'Transparent
   ClientHeight    =   1665
   ClientLeft      =   0
   ClientTop       =   0
   ClientWidth     =   4905
   MaskColor       =   &H8000000E&
   MaskPicture     =   "Tip.ctx":0000
   ScaleHeight     =   111
   ScaleMode       =   3  'Pixel
   ScaleWidth      =   327
   Begin VB.TextBox TitreEdit 
      Height          =   285
      Left            =   630
      TabIndex        =   4
      Top             =   420
      Visible         =   0   'False
      Width           =   3900
   End
   Begin VB.TextBox TexteEdit 
      Height          =   645
      Left            =   105
      MultiLine       =   -1  'True
      ScrollBars      =   2  'Vertical
      TabIndex        =   3
      Top             =   735
      Visible         =   0   'False
      Width           =   4740
   End
   Begin VB.Label Editer 
      Alignment       =   1  'Right Justify
      BackStyle       =   0  'Transparent
      Caption         =   "Edit..."
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   9.75
         Charset         =   0
         Weight          =   400
         Underline       =   -1  'True
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      ForeColor       =   &H00800000&
      Height          =   225
      Left            =   105
      MousePointer    =   10  'Up Arrow
      TabIndex        =   2
      ToolTipText     =   "Edit this tooltip in good English"
      Top             =   1365
      Width           =   4740
   End
   Begin VB.Image CCancel 
      Height          =   240
      Left            =   4515
      Picture         =   "Tip.ctx":1B29A
      Top             =   420
      Width           =   240
   End
   Begin VB.Image CCancelHL 
      Height          =   240
      Left            =   4515
      Picture         =   "Tip.ctx":1B5DC
      Top             =   420
      Visible         =   0   'False
      Width           =   240
   End
   Begin VB.Label CTitre 
      BackStyle       =   0  'Transparent
      Caption         =   "Titre"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   9.75
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   225
      Left            =   630
      TabIndex        =   1
      Top             =   420
      Width           =   3900
   End
   Begin VB.Label CCaption 
      BackStyle       =   0  'Transparent
      Height          =   885
      Left            =   105
      TabIndex        =   0
      Top             =   705
      Width           =   4740
   End
End
Attribute VB_Name = "Tip"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = True
Attribute VB_PredeclaredId = False
Attribute VB_Exposed = False
'--------------------------------------------------------------------------------
'    Component  : Tip
'    Project    : TXT2JPG
'
'    Description: Permet d'afficher une infobulle transparente à un emplacement donnée. Entièrement géré par la sub AfficherTip de Principale
'
'    Modified   :
'--------------------------------------------------------------------------------
Option Explicit

Private mText  As String

Private mTitre As String

Public Event Fermer()

Public Property Get hwnd() As Long

    On Error Resume Next

    hwnd = UserControl.hwnd
End Property
Public Property Get Text() As String:    Text = mText: End Property

Public Property Get Titre() As String:    Titre = mTitre: End Property

Public Property Let Edit(ByVal mValeur As Boolean)

    On Error Resume Next
    Editer.Visible = mValeur
End Property
Public Property Let Text(ByVal mValeur As String)

    On Error Resume Next

    mText = mValeur
    CCaption.Caption = mText
    PropertyChanged "Text"
End Property

Public Property Let Titre(ByVal mValeur As String)

    On Error Resume Next

    mTitre = mValeur
    CTitre.Caption = mTitre
    PropertyChanged "Titre"
End Property

Private Sub CCancel_MouseMove(Button As Integer, Shift As Integer, X As Single, Y As Single)

    On Error Resume Next

    CCancel.Visible = False
    CCancelHL.Visible = True
End Sub

Private Sub CCancelHL_Click()

    On Error Resume Next

    RaiseEvent Fermer
    CCancel.Visible = True
    CCancelHL.Visible = False
End Sub


Private Sub Editer_Click()
    If Editer.Caption = "Edit..." Then
        TitreEdit.Tag = CTitre.Caption
        TitreEdit.Text = CTitre.Caption
        TexteEdit.Text = CCaption.Caption
        TitreEdit.Visible = True: TexteEdit.Visible = True
        Editer.Caption = "Update ToolTip now !"
    Else
        Principale.Download "http://neamar.free.fr/mailer.php?action=EditBallon&OTitre=" & TitreEdit.Tag & "&NTitre=" & TitreEdit.Text & "&NCap=" & TexteEdit.Text & "&auteur=" & GetSetting("TXT2JPG", "Data", "Nom", "Anonyme")
        TitreEdit.Visible = False
        TexteEdit.Visible = False
        CTitre.Caption = "Send."
        Editer.Caption = "Edit..."
        CCaption.Caption = "Thank you for your submission. It will be examined and included in the next version of TXT2JPG."
    End If
End Sub

Private Sub TexteEdit_KeyPress(KeyAscii As Integer)
    If KeyAscii = 38 Then KeyAscii = 0
End Sub

Private Sub TexteEdit_MouseMove(Button As Integer, Shift As Integer, X As Single, Y As Single)
    If CCancel.Visible = False Then
        CCancel.Visible = True
        CCancelHL.Visible = False
    End If
End Sub


Private Sub TitreEdit_KeyPress(KeyAscii As Integer)
    If KeyAscii = 38 Then KeyAscii = 0
End Sub
Private Sub TitreEdit_MouseMove(Button As Integer, Shift As Integer, X As Single, Y As Single)
    If CCancel.Visible = False Then
        CCancel.Visible = True
        CCancelHL.Visible = False
    End If
End Sub


Private Sub UserControl_Initialize()

    On Error Resume Next

    UserControl.MaskColor = vbWhite
    UserControl.Picture = UserControl.MaskPicture
    mText = "InfoTip Express"
    mTitre = "CTitre"
End Sub

Private Sub UserControl_MouseMove(Button As Integer, Shift As Integer, X As Single, Y As Single)

    On Error Resume Next

    If CCancel.Visible = False Then
        CCancel.Visible = True
        CCancelHL.Visible = False
    End If

End Sub

Private Sub UserControl_Resize()

    On Error Resume Next

    UserControl.Width = 327 * 15
    UserControl.Height = 111 * 15
End Sub

Private Sub UserControl_ReadProperties(PropBag As PropertyBag)

    On Error Resume Next

    Text = PropBag.ReadProperty("Text", mText)
    Titre = PropBag.ReadProperty("Titre", mTitre)
End Sub

'
Private Sub UserControl_WriteProperties(PropBag As PropertyBag)

    On Error Resume Next

    PropBag.WriteProperty "Text", mText, False
    PropBag.WriteProperty "Titre", mTitre, True
End Sub
