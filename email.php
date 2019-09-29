<?php
require 'vendor/autoload.php';

$emails = array(
  "https://neamar.fr" => "contact@neamar.fr",
  "https://omnilogie.fr" => "contact@neamar.fr",
  "https://cruciverbe.fr" => "contact@neamar.fr",
  "https://choltraiteur.fr" => "contact@choltraiteur.fr",
  "https://endonymous.fr" => "contact@endonymous.fr"
);
$allowedDomains = array_keys($emails);

$domain = $_SERVER['HTTP_ORIGIN'];

if(!in_array($_SERVER['HTTP_ORIGIN'], $allowedDomains)) {
  http_response_code(400);
  echo "Invalid domain: " . $_SERVER['HTTP_ORIGIN'];
  die();
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
  header("Access-Control-Allow-Headers: Content-Type, Accept, Origin");
  exit(0);
}

$email = new \SendGrid\Mail\Mail();
$email->setFrom($emails[$domain]);
$email->setSubject($_POST['_subject']);
$email->addTo($_POST['_replyto']);
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
