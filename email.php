<?php
require 'vendor/autoload.php';

$emails = array(
  "neamar.fr" => "contact@neamar.fr",
  "omnilogie.fr" => "contact@neamar.fr",
  "cruciverbe.fr" => "contact@neamar.fr",
  "choltraiteur.fr" => "contact@choltraiteur.fr",
  "endonymous" => "contact@endonymous.fr"
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
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}
