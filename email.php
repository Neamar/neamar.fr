<?php
require 'vendor/autoload.php';

// Support for CORS
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Accept, Origin");
header("Access-Control-Allow-Origin: *");

$emails = array(
  "http://localhost" => "contact@neamar.fr",
  "https://neamar.fr" => "neamar@neamar.fr",
  "https://omnilogie.fr" => "neamar@neamar.fr",
  "https://cruciverbe.fr" => "neamar@neamar.fr",
  "https://choltraiteur.fr" => "contact@choltraiteur.fr",
  "https://endonymous.fr" => "contact@endonymous.fr"
);
$allowedDomains = array_keys($emails);
$allowedTo = array_values($emails);

$domain = $_SERVER['HTTP_ORIGIN'];

if(!in_array($_SERVER['HTTP_ORIGIN'], $allowedDomains) && !in_array($_POST['_to'], $allowedTo)) {
  http_response_code(400);
  echo "Invalid domain: " . $_SERVER['HTTP_ORIGIN'];
  exit(0);
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  exit(0);
}

if($_SERVER['REQUEST_METHOD'] != 'POST') {
  http_response_code(404);
  echo "Aucun message.";
  exit(0);
}

if(!isset($_POST['protection_1']) || $_POST['protection_1'] != '2') {
  http_response_code(403);
  echo "Code robot invalide.";
  exit(0);
}

if(isset($_POST['protection_2'])) {
  http_response_code(403);
  echo "Vous ressemblez beaucoup à un robot.";
  exit(0);
}

$email = new \SendGrid\Mail\Mail();
$email->setFrom('contact@neamar.fr');
$email->setReplyTo($_POST['_replyto']);
$email->setSubject(empty($_POST['_subject']) ? $_POST['_subject'] : 'Prise de contact');
$email->addTo(isset($_POST['_to']) ? $_POST['_to'] : $emails[$domain]);
$email->addContent("text/plain", $_POST['message']);
$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
    if($response->statusCode() >= 300) {
      $errEmail = new \SendGrid\Mail\Mail();
      $errEmail->setFrom('neamar@neamar.fr');
      $errEmail->setSubject("Error sending email from neamar.fr");
      $errEmail->addTo("neamart@gmail.com", "Neamar Bot");
      $errEmail->addContent("text/plain", $response->body());
      $sendgrid->send($errEmail);
      http_response_code(500);
      echo "Impossible d'envoyer votre message. Merci de contacter directement neamar@neamar.fr";
    }
    else {
      echo "Merci, votre message a bien été envoyé.";
    }
} catch (Exception $e) {
    http_response_code(500);
    echo 'Caught exception: '. $e->getMessage() ."\n";
}
