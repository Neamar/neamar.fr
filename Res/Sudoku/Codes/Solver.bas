Option Explicit

Private NBIterations As Long, Termine As Boolean, AfficherToutesSoluces As Boolean, Debut As Long, NBSolutions As Long, EnregistrerDansFichier As Boolean


Private Sub AfficherSolution(Texte As String, Grille_A_Afficher() As Long)
'Affiche une grille passé en paramètre, avec le Texte.
Dim i As Long, j As Long, Texte_A_Afficher As String
Texte_A_Afficher = vbCrLf

'Faire une boucle sur toute la grille, rajouter des éléments permettants une lecture plus intuitive
For i = 1 To 10
    If (i - 1) Mod 3 = 0 Then Texte_A_Afficher = Texte_A_Afficher & "|---|---|---|" & vbCrLf
    If i = 10 Then Exit For
    For j = 1 To 9
        If (j - 1) Mod 3 = 0 Then Texte_A_Afficher = Texte_A_Afficher & "|"
        Texte_A_Afficher = Texte_A_Afficher & Grille_A_Afficher(i, j)
    Next
    Texte_A_Afficher = Texte_A_Afficher & "|" & vbCrLf
Next

'L'ajouter à la suite des calculs préexistants
Form1.Solution.Text = Texte & vbCrLf & Texte_A_Afficher & vbCrLf & Form1.Solution.Text
'L'enregistrer dans le fichier si nécessaire:
If EnregistrerDansFichier Then Print #1, Texte & vbCrLf & Texte_A_Afficher & vbCrLf
End Sub

Public Function LancerRecherche()
    'Lance la recherche en fonction des paramètres passés à l'interface graphique.
    Debut = Timer
    NBSolutions = 0
    'Transformer les textbox en données utilisables
    Dim GrilleDepart(1 To 9, 1 To 9) As Long
    Dim i As Long
    For i = 0 To 80
        GrilleDepart(1 + i \ 9, 1 + i Mod 9) = IIf(Form1.ChiffreSudoku(i).Text = vbNullString, 0, Form1.ChiffreSudoku(i).Text)
    Next
    
    'Puis initialiser les variables de Statistiques, qui garderont en méoire le nombre de grilles trouvées, testées...
    NBIterations = 0
    Termine = False
    AfficherToutesSoluces = Form1.AfficherTous.Value
    Form1.Solution = vbNullString
    EnregistrerDansFichier = Form1.SaveInFile.Value
    If EnregistrerDansFichier Then Open App.Path & "\Sudoku_Soluces.txt" For Output As #1
    AfficherSolution "Grille de départ :", GrilleDepart()
    Solver GrilleDepart
    
End Function


Private Sub Solver(Grille_A_Solver() As Long)
    'Fonction récursive principale : elle prend en paramètre une grille et cherche à la remplir.
    'L'idée de base est d eprocéder par petits pas :
    'Cette fonction cherche UN emplacement vide.
    'Si elle n'en trouve pas, la grille passé en paramètre est déjà complète : parfaite.
    'Si elle en trouve un, elle essaie successivement d'y placer les nombres de 1 à 9. Si elle peut placer par exemple un 1, elle s'auto appelle alors avec une grille un peu moins vide.
    'De proche en proche, on obtien finalement une grille parfaitement remplie..et seules les combinaisons qui ont une probabilité d'être vraies sont testées.
    
    'Pour un très bon tutorial sur la récursivité : (sous formes d'algorithmes)
    'http://www.siteduzero.com/tuto-3-23774-1-la-recursivite.html
    
    
    Dim i As Long, j As Long, k As Long, Case_Etait_Vide As Boolean
    
    'Si on a une solution et que l'on en a demandé une seule, c'est terminé !
    If Termine And Not (AfficherToutesSoluces) Then Exit Sub
    NBIterations = NBIterations + 1
    
    'i,j => parcourent le tableau
    'k parcourt les nombres de 1 à 9
    'Case_Etait_Vide indique si on a effectué une opération sur le tableau
    Case_Etait_Vide = False
    For i = 1 To 9
        For j = 1 To 9
            If Grille_A_Solver(i, j) = 0 Then
                'C'est une case vide, on va tenter de la remplir
                For k = 1 To 9
                    If Try_To_Add(Grille_A_Solver, k, i, j) Then 'Si on a le droit d eplace k à l'emplacement i,j
                        'Remplir la grille avec ce nombre, et la passer en paramètre à Grille_A_Solver.
                        Grille_A_Solver(i, j) = k
                        Solver Grille_A_Solver()
                        'Puis la remettre à zéro pour la suite.
                        Grille_A_Solver(i, j) = 0
                    End If
                Next
                Case_Etait_Vide = True: Exit For
            End If
        Next
        If Case_Etait_Vide Then Exit For
    Next
    
    'Si on a jamais trouvé de case vide, c'est fini !
    If Case_Etait_Vide = False Then
        NBSolutions = NBSolutions + 1
        AfficherSolution "TERMINE !!!! (Delta T = " & Int((Timer - Debut) * 100) / 100 & "s - Solution n°" & NBSolutions & ", cas traités : " & NBIterations & ")", Grille_A_Solver
        Termine = True
        DoEvents
    End If
    'Debug.Print NBIterations
    
End Sub


Private Function Try_To_Add(Grille() As Long, Nombre As Long, coord_x As Long, coord_y As Long) As Boolean
'Cette fonction renvoie un boolean :
'TRUE si Nombre peut être inséré dans Grille() a l'emplacement (coord_x,coord_y), selon les régles classiques du sudoku : une seule fois le même
'nombre par ligne, par colonne et par carré.
'FALSE si les règles du sudoku interdisent la présence de ce nombre à cet emplacement.

Dim i As Long, Invalide As Boolean, CarreStartX As Long, CarreStartY As Long
'Trouver les coordonnées d ebase du carré dans lequel l'emplacement se situe.
CarreStartX = 1 + 3 * Int((coord_x - 1) / 3)
CarreStartY = 1 + 3 * Int((coord_y - 1) / 3)
Invalide = False
'Tester les 9 nombres : si un seul n'est pas possible, sortir d ela boucle en mettant Invalide à True.
For i = 1 To 9
    If Grille(i, coord_y) = Nombre Or Grille(coord_x, i) = Nombre Or Grille(CarreStartX + (i - 1) \ 3, CarreStartY + (i Mod 3)) = Nombre Then
        Invalide = True
        Exit For
    End If
Next
Try_To_Add = Not (Invalide)
End Function


