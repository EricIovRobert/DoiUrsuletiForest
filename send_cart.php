<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if (isset($_POST['email']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $user_email = $_POST['email']; // Emailul introdus de utilizator
    $firma_email = 'firma@example.com'; // Emailul firmei (înlocuiește cu emailul real)

    $mail = new PHPMailer(true);
    try {
        // Configurare SMTP (exemplu cu Gmail)
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'emailul-tau@gmail.com'; // Emailul tău Gmail
        $mail->Password = 'parola-ta-app'; // Parola de aplicație
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Setare expeditor și destinatar
        $mail->setFrom('emailul-tau@gmail.com', 'Site Produse');
        $mail->addAddress($firma_email); // Emailul firmei

        // Construire conținut email
        $mail->isHTML(true);
        $mail->Subject = 'Comandă nouă de la ' . $user_email;
        $mail->Body = '<h1>Comandă nouă</h1>';
        $mail->Body .= '<p>Email client: ' . htmlspecialchars($user_email) . '</p>';
        $mail->Body .= '<h2>Produse comandate:</h2><ul>';

        // Parcurgem coșul și adăugăm detaliile fiecărui produs
        foreach ($_SESSION['cart'] as $item) {
            $mail->Body .= '<li>';
            $mail->Body .= '<strong>' . htmlspecialchars($item['product_name']) . '</strong><br>';
            $mail->Body .= 'Tip lemn: ' . htmlspecialchars($item['tip_lemn']) . '<br>';
            $mail->Body .= 'Clasă calitate: ' . htmlspecialchars($item['clasa_calitate']) . '<br>';
            if (!empty($item['dimensiuni'])) {
                $mail->Body .= 'Dimensiuni: ' . htmlspecialchars($item['dimensiuni']) . '<br>';
            }
            if (!empty($item['subcategorie'])) {
                $mail->Body .= 'Subcategorie: ' . htmlspecialchars($item['subcategorie']) . '<br>';
            }
            if (!empty($item['cantitate'])) {
                $mail->Body .= 'Cantitate: ' . htmlspecialchars($item['cantitate']) . ' tone<br>';
            }
            $mail->Body .= 'Număr de unități: ' . htmlspecialchars($item['quantity']) . '<br>';
            $mail->Body .= '</li>';
        }
        $mail->Body .= '</ul>';

        // Trimitere email
        $mail->send();
        unset($_SESSION['cart']); // Golește coșul după trimitere
        header('Location: cart.php?status=success'); // Redirecționează cu mesaj de succes
        exit();
    } catch (Exception $e) {
        echo "Emailul nu a putut fi trimis. Eroare: {$mail->ErrorInfo}";
    }
} else {
    echo "Coșul este gol sau emailul lipsește.";
}
?>