<?php
require 'vendor/autoload.php';
require_once "Mail.php";

// Support for CORS
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Accept, Origin");
header("Access-Control-Allow-Origin: *");

$emails = array("contact@neamar.fr", "neamar@neamar.fr", "contact@choltraiteur.fr", "contact@endonymous.fr", "contact@1001fenetres.com", "contact@cycliques.fr");

if(!in_array($_POST['_to'], $emails)) {
  http_response_code(400);
  echo "Invalid recipient: " . $_POST['_to'];
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

if(!isset($_POST['protection']) || $_POST['protection'] != '2') {
  http_response_code(403);
  echo "Code robot invalide.";
  exit(0);
}

$smtpHost = getenv('SMTP_HOST');
$smtpUser = getenv('SMTP_USER');
$smtpPass = getenv('SMTP_PASS');

$from = 'contact@neamar.fr';
$to = $_POST['_replyto'];
$subject = empty($_POST['_subject']) ? $_POST['_subject'] : 'Prise de contact';


$smtp = Mail::factory('smtp', [
  'host'     => $smtpHost,
  'auth'     => true,
  'username' => $smtpUser,
  'password' => $smtpPass,
  'port'     => 465,
  'debug'    => false
]);

// Set up SMTP parameters
$headers = [
  'From'    => $from,
  'To'      => $to,
  'Subject' => $subject
];
$mail = $smtp->send($to, $headers, $body);

// Check for errors
if (PEAR::isError($mail)) {
    http_response_code(500);
    echo "Impossible d'envoyer votre message. Merci de contacter directement neamar@neamar.fr";
}
else {
  echo "Merci, votre message a bien été envoyé.";
}

// Keep logs
$append = "---------------\nDate: " . date(DATE_RFC2822) . "\nTo: " . $_POST['_to'] . "\nReply-To: " . $_POST['_replyto'] . "\nSubject: " . $subject . "\n\n" . $_POST['message'] . "\n--------------\n";
file_put_contents('/app/email_archive/archive.txt', $append, FILE_APPEND);
