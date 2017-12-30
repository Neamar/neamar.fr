//Exemples corrects :
var MonNombre:uint=15;  //Un nombre normal !
var MonString:String="Tuto"; //Une chaine de caractère
var niveau:Sprite = new Sprite();  //Un type un peu plus complexe : le sprite
var MonString2:String="126"; //Le nombre est entouré de guillemets : il est donc considéré comme une chaine de caractère

//Exemples incorrects :
var MonNombre:uint="Tot"; //le compilateur renverra : C:\Users\Neamar\Flex SDK 3\bin\Sources\souris.as(18): col: 25 Error: Contrainte implicite d'une valeur du type int vers un type sans rapport String.
var MonString:String=126; //Une chaine de caractère