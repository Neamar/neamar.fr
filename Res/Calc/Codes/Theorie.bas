Option Explicit

Public Pile_Appel As Long
Public Erreur As String

Private Dont_Use_Debugger As Boolean

Private Function Calculer(Operation As String, PremierParametre As Double, SecondParametre As Double) As Double
On Error GoTo Err_handler
'Prend en param�tre une op�ration et deux nombres, et calcule...logique, non ?
Select Case Operation
Case "+"
    Calculer = PremierParametre + SecondParametre
Case "-"
    Calculer = PremierParametre - SecondParametre
Case "*"
    Calculer = PremierParametre * SecondParametre
Case "/"
    Calculer = PremierParametre / SecondParametre
Case "%" 'Modulo : reste de la division euclidienne : 5 % 2 = 1
    Calculer = PremierParametre Mod SecondParametre
Case "^" 'Puissance 4^2 = 4� = 16
    Calculer = PremierParametre ^ SecondParametre
End Select
Exit Function
Err_handler:
    Erreur = Err.Description
    Calculer = 0
End Function

Private Function Factorielle(n As Long)
    'Renvoie la factorielle de n de facon r�cursive
    'Tire parti du fait que n! = n * (n+1)!

    'La factorielle n'est d�finie que sur N
    If n < 0 Then
        Erreur = "Impossible de calculer une factorielle n�gative !"
        Factorielle = 0
        Exit Function
    End If

    'Pour calculer la factorielle, on utilise la d�finition originale : seulement sur des entiers ! On va pas non plus se taper des int�grales de e !
    If n = 0 Then
        Factorielle = 1 'Par conventiuon, 0! = 1
    Else
        Factorielle = n * Factorielle(n - 1)    'Encore un peu de r�cursivit�
    End If
End Function

Public Function Math_It(Expression As String) As Double
    'Cette fonction transforme un string pass� en param�tre en nombre r�el, c'est bien entendu la plus importante du programme !
    'Variables pour le calcul th�orique :
    Dim Somme As Double, Dernier_Nombre As Double, Nombre_Actuel As Double, Caractere_Actuel As String, Chiffre_Actuel As Double, AjouterApresVirgule As Boolean, NbDecimales As Long
    'Somme => Contient la somme actuelle. C'est cette variable qui sera renvoy�e � la fin.
    'Par d�finition, les op�rations standards ont besoin de deux nombres : le nombre � gauche, et celui � droite.
    'Dernier_Nombre correspond au nombre de gauche
    'Nombre_Actuel correspond au nombre de droite, il change en quasi-permanence
    'Caractere_Actuel correspond au caract�re en cours de traitement. (voir boucle for plus bas)
    'Chiffre_Actuel correspond au chiffre en cours de traitement, soit VAL(Caractere_Actuel) SI caractere_Actuel est un nombre.
    'AjouterApresVirgule : si le nombre en cours de traitement (Nombre_Actuel) n'est pas un entier, on met cette bool�enne � true.
    'NbDecimales : le nombre de d�cimales du nombre...


    'Variables utilis�es en pratique pour r�ussir la th�orie ^^
    Dim Taille As Long, i As Long, Derniere_Operation As String, Fin_Bloc_Instruction As Long


    'Augmenter de 1 la taille de la pile pour pouvoir afficher le nombre de  sous calculs effectu�s
    Pile_Appel = Pile_Appel + 1
    'Afficher le calcul dans le volet execution
    If Not (Dont_Use_Debugger) Then Debug.Print Space$(5 * Pile_Appel) & "Math_It va effectuer le calcul " & Expression


    'V�rifier que le nombre de parenth�ses ouvrantes = nombres de parenth�ses fermantes
    If Not VerifierIntegriteReferentielle(Expression) Then
        'Si probleme, on sort de la fonction...et on renvoie 0
        Math_It = 0
        Exit Function
    End If

    'Si le calcul est de la forme "(.......)", on peut supprimer les parenth�ses qui entourent
    While Left$(Expression, 1) = "(" And TrouverParentheseFermante(Mid$(Expression, 2)) = Len(Expression) - 2
        Expression = Mid$(Expression, 2, Len(Expression) - 2)
    Wend    'On r�pete tant qu'on en a la possibilit�

    'Initialiser les variables : on va faire semblant que le calcul commence par 0+[Expression].
    'On met donc Somme � 0, et Derniere_Operation � +
    Somme = 0: Nombre_Actuel = 0: Chiffre_Actuel = 0: Dernier_Nombre = 0: Derniere_Operation = "+": AjouterApresVirgule = False

    'On enregistre la taille du string pour acc�l�rer le traitement
    Taille = Len(Expression)
    'On va effectuer une boucle : pour chaque caract�re, on r�flechira comment le traiter
    For i = 1 To Taille
        Caractere_Actuel = Mid$(Expression, i, 1)
        If IsNumeric(Caractere_Actuel) Then
            'Si le nombre est un nombre, l'ajouter au nombre en cours de traitement
            Nombre_Actuel = Concatener_Nombre(Nombre_Actuel, Caractere_Actuel)
            If AjouterApresVirgule Then NbDecimales = NbDecimales + 1
        Else
            'Si le caractere n'est pas un nombre, on va devoir faire un calcul...
            'Premi�re chose � faire : mettre le nombre sous forme d�cimale si besoin est
            If AjouterApresVirgule Then
                AjouterApresVirgule = False
                Nombre_Actuel = Nombre_Actuel / (10 ^ NbDecimales)
            End If
            'Si le caract�re actuel n'est pas un nombre, ca complique le probl�me !
            If Caractere_Actuel = "(" And i <> 1 Then
                'Si on utilise une fonction directe (2(2+1), sous entendu 2*(2+1), il faut faire aparaitre le *
                        If i <> 1 Then
                            If IsNumeric(Mid$(Expression, i - 1, 1)) Then
                                Somme = Calculer(Derniere_Operation, Somme, Nombre_Actuel)
                                Derniere_Operation = "*"
                            End If
                        End If
            End If


            'Effectuer la derni�re op�ration si on est en pr�sence d'une op�ration standard
            If Caractere_Actuel = "+" Or Caractere_Actuel = "-" Or Caractere_Actuel = "*" Or Caractere_Actuel = "/" Or Caractere_Actuel = "%" Or Caractere_Actuel = "^" Then
                'On effectue la derni�re op�ration que l'on devait faire
                Somme = Calculer(Derniere_Operation, Somme, Nombre_Actuel)
                'L'op�ration est effectu�e, vider la variable NombreActuel, stocker la prochiane op�ration
                Nombre_Actuel = 0
                'Et on stocke l'op�ration pour la prochaine fois
                Derniere_Operation = Caractere_Actuel 'A ce moment pr�cis, derni�reop�ration=prochaine operation....
                If Caractere_Actuel = "^" Then
                    'Si on a puissance, l'op�ration a priorit� sur tout le reste ! On calcule l'exposant, et on applique direct.
                    Fin_Bloc_Instruction = TrouverFinBLoc(Expression, i)
                    Nombre_Actuel = Math_It(Mid$(Expression, i + 1, Fin_Bloc_Instruction))
                    i = i + Fin_Bloc_Instruction
                End If

                If Caractere_Actuel = "+" Or Caractere_Actuel = "-" Then
                    'On doit respecter la priorit� des op�arations *,/ et ^par rapport � + et -
                    'Donc on subdivise le travail...+ �tant commutatif, ce n'est pas un probl�me.
                    Fin_Bloc_Instruction = TrouverFinBLoc(Expression, i)
                    Nombre_Actuel = Math_It(Mid$(Expression, i + 1, Fin_Bloc_Instruction))
                    i = i + Fin_Bloc_Instruction
                    'Exit For
                End If
            Else
                'Le caract�re pour indiquer un nombre d�cimal est au choix . ou ,
                If Caractere_Actuel = "," Or Caractere_Actuel = "." Then AjouterApresVirgule = True
                'Si ce n'est pas + - * /, c'est plus complexe :-)

                '///////////////////////////////////////////////////////////////////////////////////////
                'Fonctions support�es
                '///////////////////////////////////////////////////////////////////////////////////////

                If LCase$(Caractere_Actuel) = "e" Then  'Exponentielle
                    'Cas de l'exponentielle
                    Fin_Bloc_Instruction = TrouverFinBLoc(Expression, i)
                    If Nombre_Actuel = 0 Then Nombre_Actuel = 1
                    'On multiplie par NombreActuel de facon � corriger le cas 2e2 = 2*e2
                    Nombre_Actuel = Nombre_Actuel * Exp(Math_It(Mid$(Expression, i + 1, Fin_Bloc_Instruction)))
                    i = i + Fin_Bloc_Instruction
                End If
                If LCase$(Mid$(Expression, i, 2)) = "ln" Then   'Logarithme n�p�rien
                    Fin_Bloc_Instruction = TrouverFinBLoc(Expression, i + 1)
                    Nombre_Actuel = Log(Math_It(Mid$(Expression, i + 2, Fin_Bloc_Instruction)))
                    i = i + Fin_Bloc_Instruction + 1
                End If
                If LCase$(Mid$(Expression, i, 3)) = "sqr" Then  'Racine carr�e
                    'Pour rappel, SQR(x) = x^(1/2)
                    Fin_Bloc_Instruction = TrouverFinBLoc(Expression, i + 2)
                    Nombre_Actuel = Sqr(Math_It(Mid$(Expression, i + 3, Fin_Bloc_Instruction)))
                    i = i + Fin_Bloc_Instruction + 2
                End If
                If LCase$(Mid$(Expression, i, 5)) = "somme" Then  'Faire une somme
                    Fin_Bloc_Instruction = TrouverFinBLoc(Expression, i + 4)
                    Nombre_Actuel = LancerSomme(Mid$(Expression, i + 6, Fin_Bloc_Instruction - 2))
                    i = i + Fin_Bloc_Instruction + 4
                End If
                If LCase$(Mid$(Expression, i, 3)) = "atn" Then  'Racine carr�e
                    'Pour rappel, SQR(x) = x^(1/2)
                    Fin_Bloc_Instruction = TrouverFinBLoc(Expression, i + 2)
                    Nombre_Actuel = Atn(Math_It(Mid$(Expression, i + 3, Fin_Bloc_Instruction)))
                    i = i + Fin_Bloc_Instruction + 2
                End If
                If Caractere_Actuel = "!" Then Nombre_Actuel = Factorielle(Int(Nombre_Actuel)) 'Factorielle


                '///////////////////////////////////////////////////////////////////////////////////////
                'Cas des parenth�ses
                '///////////////////////////////////////////////////////////////////////////////////////

                If Caractere_Actuel = "(" Then
                    'Voil� le cas interessant du probl�me : si on a  des parenth�ses...on fait appel � la r�cursivit�.
                    'D'abord, il faut trouver la parenth�se correspondante, et l'envoyer � math_It (oui oui, la fonction dans laquelle on est !)
                    'ainsi, pour le calcul suivant : 2*(1+3) on va d'abord calculer (1+3) et ensuite * par 2
                    Fin_Bloc_Instruction = TrouverParentheseFermante(Mid$(Expression, i + 1))
                    Nombre_Actuel = Math_It(Mid$(Expression, i + 1, Fin_Bloc_Instruction))
                    i = i + Fin_Bloc_Instruction
                End If

            End If

        End If
    Next

    'Ca y est c'est termin� !
    'Ou presque...car il ne faut pas oublier qu'il reste le dernier calcul � effectuer (on effectue tous les calculs en retard...)
    'D'abord, calculer le prochain nombre.
    If AjouterApresVirgule Then
        AjouterApresVirgule = False
        Nombre_Actuel = Nombre_Actuel / (10 ^ NbDecimales)
    End If
    'Ca y est, c'est termin� ! On effectue la derni�re op�ration avec les derniers nombres, et on renvoie.
    Somme = Calculer(Derniere_Operation, Somme, Nombre_Actuel)
    If Not (Dont_Use_Debugger) Then Debug.Print Expression & " a renvoy� " & Somme
    Math_It = Somme
End Function

Private Function LancerSomme(Expression As String) As Double
    Dim i As Long, Start As Long, Fin As Long, Taille As Long, Dernier_i As Long, Calcul As String, Calcul_Temporaire As String, Somme As Double
    Dim Variable As String
    'On arr�te l'affichage du debugger temporairement pour ne pas surcharger la fenetre
    Dont_Use_Debugger = True


    Taille = Len(Expression)
    'D'abord, trouver les param�tres

    'Le nom de la variable
    For i = 1 To Taille
        If Mid$(Expression, i, 1) = "=" Then Exit For
    Next
    If i = Taille Then GoTo Somme_incorrecte
    Dernier_i = i + 1
    Variable = Left$(Expression, i - 1)

    'Sa valeur de d�part
    For i = Dernier_i To Taille
        If Mid$(Expression, i, 1) = "," Then Exit For
    Next
    If i = Taille Then GoTo Somme_incorrecte
    Start = Int(Math_It(Mid$(Expression, Dernier_i, i - Dernier_i)))
    Dernier_i = i + 1

    'Et sa valeur d'arriv�e
    For i = Dernier_i To Taille
        If Mid$(Expression, i, 1) = "," Then Exit For
    Next
    If i = Taille Then GoTo Somme_incorrecte
    Fin = Int(Math_It(Mid$(Expression, Dernier_i, i - Dernier_i)))
    Dernier_i = i + 1

    'Et enfin, le calcul qui devra �tre effectu� !
    Calcul = Mid$(Expression, Dernier_i)

    Debug.Print "La somme " & Calcul; " va �tre effectu� de " & Start & " � " & Fin & " (variable : " & Variable & ")"

    'Lancer le calcul
    Somme = 0
    For i = Start To Fin
        'D'abord, remplacer la variable par sa valeur
        Calcul_Temporaire = Replace(Calcul, Variable, i)
        'Debug.Print Calcul_Temporaire, Math_It(Calcul_Temporaire)
        Somme = Somme + Math_It(Calcul_Temporaire)
    Next

    LancerSomme = Somme

    'On arr�te l'affichage du debugger temporairement pour ne pas surcharger la fenetre
    Dont_Use_Debugger = False
    Exit Function


Somme_incorrecte:
    Erreur = "La somme n'est pas correcte !"
    LancerSomme = 0
End Function
Private Function Concatener_Nombre(Nombre As Double, Chiffre_A_Ajouter As String) As Double
    'Cette fonction recoit en param�tre un nombre et un string, elle renvoie le nombre avec le string ajout�.
    'Par exemple, elle prend en param�tre 125,"7" et renvoie 1257
    'NbChiffres = Int(Log(Nombre) / 2.30258509299405) 'Calcule le Log en base 10 du nombre, C.a.d son nombre de d�cimales
    Concatener_Nombre = 10 * Nombre + Val(Chiffre_A_Ajouter)
End Function

Public Function TrouverFinBLoc(Expression As String, i As Long)
'i est l'endroit ou commencer la recherche
'TrouverFinBLoc prend en param�tre une expression et renvoie la fin du bloc commmencant � l'emplacement i
'| => valeur de i
'Par  exemple, pour 1+ | (2+5) *2, le bloc se termine apr�s )
'Ou encore, pour 2^|25+2, le bloc prend en compte 25 et rien d'autre
Dim i2 As Long, Fin_Bloc_Instruction As Long
If Mid$(Expression, i + 1, 1) = "(" Then
    'Cas x^(2*2)
    Fin_Bloc_Instruction = TrouverParentheseFermante(Mid$(Expression, i + 2)) + 2
    'Ce calcul n'est pas compl�tement optimis�
    'Par exemple, pour (3+5), le programme effectuera d'abord 3+5 PUIS (3+5), d'ou encombrement inutile de la pile d'appel
Else
    'C'est un simple nombre..on trouve les chiffres, et on renvoie les nombres
    i2 = i + 1
    While (IsNumeric(Mid$(Expression, i2, 1)) Or Mid$(Expression, i2, 1) = "^" Or (Mid$(Expression, i2, 1) = "-" And i2 = i + 1))
        i2 = i2 + 1
    Wend
    Fin_Bloc_Instruction = i2 - i - 1
End If

'C'est tout...
TrouverFinBLoc = Fin_Bloc_Instruction
End Function

Public Function TrouverParentheseFermante(Chaine) As Long
'Trouver la parenth�se fermante associ�e � une certaine parenth�se
'InStr(i + 1, Chaine, ")") - i - 1)) ne fonctionne pas si l'on a imbrication de parenth�es, e.g (1+5(1+3)+2)
Dim i As Long, Parentheses_Rencontrees As Long, Taille As Long, Caractere_Actuel As String

Parentheses_Rencontrees = 1
Taille = Len(Chaine)
For i = 1 To Taille
    Caractere_Actuel = Mid$(Chaine, i, 1)
    If Caractere_Actuel = "(" Then Parentheses_Rencontrees = Parentheses_Rencontrees + 1    'A chaque fois qu'on rencontre une (, on dit qu'il faudra une ) de plus avant de sortir
    If Caractere_Actuel = ")" Then Parentheses_Rencontrees = Parentheses_Rencontrees - 1
    If Parentheses_Rencontrees = 0 Then Exit For
Next
'Quand on sort, c'est qu'on a la parenth�se...ou qu'elle n'existe pas !
TrouverParentheseFermante = i - 1
End Function

Private Function VerifierIntegriteReferentielle(Expression_De_Test As String) As Boolean
'Cette fonction au nom pompeux v�rifie que le nombre de parenth�ses "(" est �gale au nombre de ")". Logique, non ?
'Si il y a un pb, elle remplit la variable globale Erreur et renvoie False

Dim Curseur As Long, CompteurOuvrantes As Long, CompteurFermantes As Long
    Curseur = InStr(1, Expression_De_Test, "(")
    Do While Curseur
        CompteurOuvrantes = CompteurOuvrantes + 1
        Curseur = InStr(Curseur + 1, Expression_De_Test, "(")
    Loop

    Curseur = InStr(1, Expression_De_Test, ")")
    Do While Curseur
        CompteurFermantes = CompteurFermantes + 1
        Curseur = InStr(Curseur + 1, Expression_De_Test, ")")
    Loop

    If CompteurOuvrantes <> CompteurFermantes Then
        Erreur = "ERREUR : " & CompteurOuvrantes & " '(' trouv�s, et " & CompteurFermantes & " ')'. [sous partie : " & Expression_De_Test & "]"
        VerifierIntegriteReferentielle = False
    Else
        VerifierIntegriteReferentielle = True
    End If
End Function


