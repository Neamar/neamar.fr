<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Support for CORS
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Accept, Origin");
header("Access-Control-Allow-Origin: *");

$emails = array("contact@neamar.fr", "neamar@neamar.fr", "contact@choltraiteur.fr", "contact@endonymous.fr", "contact@1001fenetres.com");

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
$body = $_POST['message'];


$mailer = new PHPMailer(true);

try {
  //Server settings
  $mailer->isSMTP();
  $mailer->Host       = $smtpHost;
  $mailer->SMTPAuth   = true;
  $mailer->Username   = $smtpUser;
  $mailer->Password   = $smtpPass;
  $mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
  $mailer->Port       = 465;

  //Recipients
  $mailer->setFrom($from);
  $mailer->addAddress($_POST['_to']);
  $mailer->addReplyTo($to);

  //Content
  $mailer->Subject = $subject;
  $mailer->Body    = $body;

  $mailer->send();
  echo "Merci, votre message a bien été envoyé.";
} catch (Exception $e) {
    http_response_code(500);
    echo "Impossible d'envoyer votre message. Merci de contacter directement neamar@neamar.fr";
}

// Keep logs
$append = "---------------\nDate: " . date(DATE_RFC2822) . "\nTo: " . $_POST['_to'] . "\nReply-To: " . $_POST['_replyto'] . "\nSubject: " . $subject . "\n\n" . $_POST['message'] . "\n--------------\n";
file_put_contents('/app/email_archive/archive.txt', $append, FILE_APPEND);
