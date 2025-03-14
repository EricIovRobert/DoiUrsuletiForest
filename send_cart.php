<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
include 'db_connect.php';

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
        $mail->Password = 'parola-ta-app'; // Parola de aplicație (vezi mai jos cum să o obții)
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

        foreach ($_SESSION['cart'] as $product_id) {
            $sql = "SELECT nume FROM produse WHERE id = $product_id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $mail->Body .= '<li>' . htmlspecialchars($row['nume']) . '</li>';
            }
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
$conn->close();
?>