<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php'; // Assurez-vous que le chemin vers autoload.php est correct
// Ajoutez ceci au début de votre script pour le débogage
file_put_contents('test.txt', 'Script exécuté', FILE_APPEND);

// Récupérez l'adresse e-mail de l'étudiant depuis la requête POST
$data = json_decode(file_get_contents("php://input"), true);
$email = $data['email'];

// Créez une instance de PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuration du serveur SMTP (exemple pour Gmail)
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Host = 'smtp.gmail.com'; // Remplacez par le serveur SMTP approprié
    $mail->Port = 587; // Port SMTP

    // Identifiants SMTP (remplacez par vos propres identifiants)
    $mail->Username = 'stagedatingmmi@gmail.com';
    $mail->Password = 'mmiIUT16#';

    // Destinataire et expéditeur de l'e-mail
    $mail->setFrom('stagedatingmmi@gmail.com', 'IUT16');
    $mail->addAddress($email); // Adresse e-mail de l'étudiant
    $mail->Subject = 'Rappel entretien stage dating';

    // Contenu de l'e-mail
    $mail->Body = 'Ceci est un rappel pour vous inscrire à des entretiens.';

    // Envoyer l'e-mail
    $mail->send();

    // Réponse JSON pour indiquer le succès
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    // En cas d'erreur, retournez une réponse JSON avec un message d'erreur
    echo json_encode(['success' => false, 'error' => $mail->ErrorInfo]);
}
