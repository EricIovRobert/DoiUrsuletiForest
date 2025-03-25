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
    $firma_email = 'wovencrib9@gmail.com'; // Emailul firmei trebuie modificat la cei de la doiursuleti

    // Validate email input
    if (!filter_var($client_email, FILTER_VALIDATE_EMAIL)) {
        echo "Adresa de email invalidă.";
        exit();
    }

    // Construire conținut email pentru vânzător
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
        $message .= "Clasa lemn: " . (isset($item['clasa_lemn']) ? htmlspecialchars($item['clasa_lemn']) : 'N/A') . "\n";
        $message .= "Sortiment: " . (isset($item['sortiment']) ? htmlspecialchars($item['sortiment']) : 'N/A') . "\n";
        if (!empty($item['clasa_calitate'])) {
            $message .= "Clasă calitate: " . htmlspecialchars($item['clasa_calitate']) . "\n";
        }
        if (!empty($item['dimensiuni'])) {
            $message .= "Dimensiuni: " . htmlspecialchars($item['dimensiuni']) . "\n";
        }
        if (!empty($item['paletat'])) {
            $message .= htmlspecialchars($item['paletat']) . "\n";
        }
        $message .= "Cantitate: " . (isset($item['quantity']) ? htmlspecialchars($item['quantity']) : '1') . " " . (isset($item['unitate_masura']) ? htmlspecialchars($item['unitate_masura']) : '') . "\n";
    }

    // Adăugare observații (doar dacă sunt furnizate)
    if (isset($_POST['observations']) && !empty(trim($_POST['observations']))) {
        $observations = trim($_POST['observations']);
        $message .= "\nObservații: " . htmlspecialchars($observations) . "\n";
    }

    // Trimitere email către vânzător prin PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['GMAIL_USERNAME'];
        $mail->Password = $_ENV['GMAIL_PASSWORD'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8'; // Setăm codarea UTF-8 pentru caractere speciale

        // Recipients
        $mail->setFrom($_ENV['GMAIL_USERNAME'], 'Doi Ursuleti Forest');
        $mail->addAddress($firma_email);
        $mail->addReplyTo($client_email, $client_name);

        // Content
        $mail->isHTML(false); // Setăm la false pentru text simplu
        $mail->Subject = $subject;
        $mail->Body = $message;

        // Trimitem emailul către vânzător
        $mail->send();

        // Trimitere email de confirmare către client
        $mail2 = new PHPMailer(true);
        try {
            // Server settings
            $mail2->isSMTP();
            $mail2->Host = 'smtp.gmail.com';
            $mail2->SMTPAuth = true;
            $mail2->Username = $_ENV['GMAIL_USERNAME'];
            $mail2->Password = $_ENV['GMAIL_PASSWORD'];
            $mail2->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail2->Port = 587;
            $mail2->CharSet = 'UTF-8'; // Setăm codarea UTF-8

            // Recipients
            $mail2->setFrom($_ENV['GMAIL_USERNAME'], 'Doi Ursuleti Forest');
            $mail2->addAddress($client_email, $client_name);

            // Content
            $mail2->isHTML(false); // Text simplu
            $mail2->Subject = 'Confirmare comandă';
            $confirm_message = "Stimate " . htmlspecialchars($client_name) . ",\n\n";
            $confirm_message .= "Comanda dumneavoastră a fost plasată cu succes.\n";
            $confirm_message .= "Iată ce s-a trimis:\n\n";
            $confirm_message .= $message; // Adăugăm detaliile comenzii trimise către vânzător
            $mail2->Body = $confirm_message;

            // Trimitem emailul de confirmare
            $mail2->send();
        } catch (Exception $e) {
            // Dacă emailul de confirmare nu se trimite, înregistrăm eroarea, dar continuăm
            error_log("Emailul de confirmare către client nu a putut fi trimis. Eroare: {$mail2->ErrorInfo}");
        }

        // Golește coșul și redirecționează după trimiterea emailului către vânzător
        unset($_SESSION['cart']);
        header('Location: cart.php?status=success');
        exit();
    } catch (Exception $e) {
        echo "Emailul către vânzător nu a putut fi trimis. Eroare PHPMailer: {$mail->ErrorInfo}";
    }
} else {
    echo "Coșul este gol sau datele clientului lipsesc.";
}
?>