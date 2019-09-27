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
echo $_SERVER['HTTP_ORIGIN'];

if(!in_array($_SERVER['HTTP_ORIGIN'], $allowedDomains)) {
  echo "Invalid domain.";
  die();
}


$email = new \SendGrid\Mail\Mail();
$email->setFrom($emails[$domain], $domain);
$email->setSubject($_POST['_subject']);
$email->addTo($_POST['_replyto']);
$email->addContent("text/plain", $_POST['message']);
$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}
