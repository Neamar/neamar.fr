//Exemples corrects :
var MonNombre:uint=15;  //Un nombre normal !
var MonString:String="Tuto"; //Une chaine de caract�re
var niveau:Sprite = new Sprite();  //Un type un peu plus complexe : le sprite
var MonString2:String="126"; //Le nombre est entour� de guillemets : il est donc consid�r� comme une chaine de caract�re

//Exemples incorrects :
var MonNombre:uint="Tot"; //le compilateur renverra : C:\Users\Neamar\Flex SDK 3\bin\Sources\souris.as(18): col: 25 Error: Contrainte implicite d'une valeur du type int vers un type sans rapport String.
var MonString:String=126; //Une chaine de caract�re