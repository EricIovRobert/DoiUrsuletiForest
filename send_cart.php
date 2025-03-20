<?php
session_start();
require 'vendor/autoload.php'; // Include PHPMailer autoloader

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Load environment variables from .env file
try {
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    $dotenv->required(['GMAIL_USERNAME', 'GMAIL_PASSWORD'])->notEmpty();
} catch (Exception $e) {
    die("Eroare la încărcarea fișierului .env: " . $e->getMessage());
}

// Check if the form was submitted and the cart is not empty
if (isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $client_name = $_POST['name'];
    $client_phone = $_POST['phone'];
    $client_email = $_POST['email'];
    $firma_email = 'wovencrib9@gmail.com'; // Emailul firmei

    // Validate email input
    if (!filter_var($client_email, FILTER_VALIDATE_EMAIL)) {
        echo "Adresa de email invalidă.";
        exit();
    }

    // Construire conținut email
    $subject = 'Comanda noua de la ' . htmlspecialchars($client_name);
    $message = "Comanda nouă\n\n";
    $message .= "Nume client: " . htmlspecialchars($client_name) . "\n";
    $message .= "Telefon client: " . htmlspecialchars($client_phone) . "\n";
    $message .= "Email client: " . htmlspecialchars($client_email) . "\n\n";
    $message .= "Produse comandate:\n";

    // Parcurgem coșul și adăugăm detaliile fiecărui produs
    foreach ($_SESSION['cart'] as $item) {
        $message .= "------------------------\n";
        $message .= "Produs: " . (isset($item['nume']) ? htmlspecialchars($item['nume']) : 'Nume indisponibil') . "\n";
        $message .= "Tip lemn: " . (isset($item['tip_lemn']) ? htmlspecialchars($item['tip_lemn']) : 'N/A') . "\n";
        $message .= "Clasă calitate: " . (isset($item['clasa_calitate']) ? htmlspecialchars($item['clasa_calitate']) : 'N/A') . "\n";
        if (!empty($item['dimensiuni'])) {
            $message .= "Dimensiuni: " . htmlspecialchars($item['dimensiuni']) . "\n";
        }
        if (!empty($item['subcategorie'])) {
            $message .= "Subcategorie: " . htmlspecialchars($item['subcategorie']) . "\n";
        }
        if (!empty($item['cantitate'])) {
            $message .= "Cantitate: " . htmlspecialchars($item['cantitate']) . " tone\n";
        }
        $message .= "Număr de unități: " . (isset($item['quantity']) ? htmlspecialchars($item['quantity']) : '1') . "\n";
    }

    // Trimitere email prin PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['GMAIL_USERNAME']; // Load from .env
        $mail->Password = $_ENV['GMAIL_PASSWORD']; // Load from .env
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom($_ENV['GMAIL_USERNAME'], 'Doi Ursuleti Forest');
        $mail->addAddress($firma_email);
        $mail->addReplyTo($client_email, $client_name);

        // Content
        $mail->isHTML(false); // Set to false for plain text
        $mail->Subject = $subject;
        $mail->Body = $message;

        // Send the email
        $mail->send();
        unset($_SESSION['cart']); // Golește coșul după trimitere
        header('Location: cart.php?status=success'); // Redirecționează cu mesaj de succes
        exit();
    } catch (Exception $e) {
        echo "Emailul nu a putut fi trimis. Eroare PHPMailer: {$mail->ErrorInfo}";
    }
} else {
    echo "Coșul este gol sau datele clientului lipsesc.";
}
?>