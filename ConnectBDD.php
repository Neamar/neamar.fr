<?php
  require_once __DIR__ . '/vendor/autoload.php';
  @ini_set('default_charset', 'ISO-8859-1');
  error_reporting(E_ALL ^ E_DEPRECATED);

  $url = parse_url(getenv("DATABASE_URL"));
  //Fichier assez utile :-)
  mysql_connect($url["host"] . ":" . $url["port"], $url["user"], $url["pass"]); // Connexion à MySQL légèrement sécurisée.
  mysql_select_db("neamar"); // Sélection de la base de données
  mysql_set_charset('latin1');
?>
