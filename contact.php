<?php
session_start();
require 'vendor/autoload.php'; // Include PHPMailer și Dotenv autoloader

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

// Activăm raportarea erorilor pentru debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Încărcăm variabilele de mediu din fișierul .env
try {
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    $dotenv->required(['GMAIL_USERNAME', 'GMAIL_PASSWORD'])->notEmpty();
} catch (Exception $e) {
    die("Eroare la încărcarea fișierului .env: " . $e->getMessage());
}

// Inițializăm variabilele pentru datele formularului și mesaje
$name = $email = $subject = $message = '';
$success_message = $error_message = '';

// Verificăm dacă formularul a fost trimis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';
    $firma_email = 'wovencrib9@gmail.com'; // Adresa firmei (modifică cu adresa reală)

    // Validăm adresa de email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Adresa de email invalidă.";
    } else {
        // Construim conținutul emailului
        $email_subject = "Mesaj nou de pe site: " . htmlspecialchars($subject);
        $email_body = "Nume: " . htmlspecialchars($name) . "\n";
        $email_body .= "Email: " . htmlspecialchars($email) . "\n";
        $email_body .= "Subiect: " . htmlspecialchars($subject) . "\n";
        $email_body .= "Mesaj:\n" . htmlspecialchars($message) . "\n";

        // Inițializăm PHPMailer
        $mail = new PHPMailer(true);
        try {
            // Setări server SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['GMAIL_USERNAME'];
            $mail->Password = $_ENV['GMAIL_PASSWORD'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->CharSet = 'UTF-8';

            // Destinatari
            $mail->setFrom($_ENV['GMAIL_USERNAME'], 'Doi Ursuleti Forest');
            $mail->addAddress($firma_email);
            $mail->addReplyTo($email, $name);

            // Conținut email
            $mail->isHTML(false); // Email în format text simplu
            $mail->Subject = $email_subject;
            $mail->Body = $email_body;

            // Trimitem emailul
            $mail->send();
            $success_message = "Mesajul a fost trimis cu succes!";
            // Golim câmpurile formularului după trimitere
            $name = $email = $subject = $message = '';
        } catch (Exception $e) {
            $error_message = "Mesajul nu a putut fi trimis. Eroare: {$mail->ErrorInfo}";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="utf-8" />
    <title>Doi Ursuleti - Contact</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap"
        rel="stylesheet"
    />

    <!-- Icon Font Stylesheet -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
        rel="stylesheet"
    />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
        rel="stylesheet"
    />

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet" />
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet" />
</head>

<body>
    <!-- Spinner Start -->
    <div
        id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center"
    >
        <div
            class="spinner-grow text-primary"
            style="width: 3rem; height: 3rem"
            role="status"
        >
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Topbar Start -->
    <div class="container-fluid bg-light p-0">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fa fa-map-marker-alt text-primary me-2"></small>
                    <small>Vișeu de Sus, Maramureș, str.Cimitirului, nr.16A</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center py-3">
                    <small class="far fa-clock text-primary me-2"></small>
                    <small>LUNI-VINERI 08-17 SAMBATA 08-13</small>
                </div>
            </div>
            <div class="col-lg-5 px-5 text-end">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fa fa-phone-alt text-primary me-2"></small>
                    <small>Tehnician silvic: 0742900678</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fa fa-phone-alt text-primary me-2"></small>
                    <small>Manager transport: 0742649793</small>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
        <a href="index.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <img src="img/logo.jpg" alt="Logo" style="width: 50px; height: 50px;">
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.php" class="nav-item nav-link">Acasă</a>
                <a href="about.php" class="nav-item nav-link">Despre noi</a>
                <a href="service.php" class="nav-item nav-link">Produse</a>
                <a href="project.php" class="nav-item nav-link">Proiecte</a>
                <a href="contact.php" class="nav-item nav-link active">Contact</a>
                <a href="cart.php" class="btn btn-primary py-4 px-lg-5 position-relative">
                    <i class="fa fa-shopping-cart me-3"></i> Coș
                    <span class="cart-count"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : '0'; ?></span>
                </a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Contact</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a class="text-white" href="index.php">Acasă</a>
                    </li>
                    <li class="breadcrumb-item text-white active" aria-current="page">
                        Contact
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Contact Start -->
    <div class="container-fluid bg-light overflow-hidden px-lg-0" style="margin: 6rem 0">
        <div class="container contact px-lg-0">
            <div class="row g-0 mx-lg-0">
                <div class="col-lg-6 contact-text py-5 wow fadeIn" data-wow-delay="0.5s">
                    <div class="p-lg-5 ps-lg-0">
                        <div class="section-title text-start">
                            <h1 class="display-5 mb-4">Contactați-ne</h1>
                        </div>
                        <p class="mb-4">
                            Completați formularul de mai jos pentru a ne trimite un mesaj. Vă vom răspunde cât mai curând posibil.
                        </p>
                        <!-- Afișăm mesajele de succes sau eroare -->
                        <?php if (!empty($success_message)): ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $success_message; ?>
                            </div>
                        <?php elseif (!empty($error_message)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error_message; ?>
                            </div>
                        <?php endif; ?>
                        <!-- Formularul -->
                        <form method="POST" action="">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="name"
                                            name="name"
                                            placeholder="Numele tău"
                                            value="<?php echo htmlspecialchars($name); ?>"
                                            required
                                        />
                                        <label for="name">Numele tău</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input
                                            type="email"
                                            class="form-control"
                                            id="email"
                                            name="email"
                                            placeholder="Adresa ta de email"
                                            value="<?php echo htmlspecialchars($email); ?>"
                                            required
                                        />
                                        <label for="email">Adresa ta de email</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="subject"
                                            name="subject"
                                            placeholder="Subiect"
                                            value="<?php echo htmlspecialchars($subject); ?>"
                                            required
                                        />
                                        <label for="subject">Subiect</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea
                                            class="form-control"
                                            placeholder="Scrie mesajul tău aici"
                                            id="message"
                                            name="message"
                                            style="height: 100px"
                                            required
                                        ><?php echo htmlspecialchars($message); ?></textarea>
                                        <label for="message">Mesaj</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">
                                        Trimite mesajul
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 pe-lg-0" style="min-height: 400px">
                    <div class="position-relative h-100">
                        <iframe
                            class="position-absolute w-100 h-100"
                            style="object-fit: cover"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2774.6783219350914!2d22.667570075828134!3d45.93772870172035!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x474efb3148dd5f2d%3A0xc2989df6eeebc49!2sStrada%20Unirii%20103%2C%20Ilia%20337270!5e0!3m2!1sen!2sro!4v1742899824654!5m2!1sen!2sro"
                            frameborder="0"
                            allowfullscreen=""
                            aria-hidden="false"
                            tabindex="0"
                        ></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Contact</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Sediu: Vișeu de Sus, Maramureș, str.Cimitirului, nr.16A</p>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Fabrica: Ilia, Hunedoara, str.Unirii, nr.103A</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>0742900678</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>0742649793</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>doiursuletiforest@gmail.com</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Servicii</h4>
                    <a class="btn btn-link" href="service.php">Lemn prelucrat</a>
                    <a class="btn btn-link" href="service.php">Lemn de foc</a>
                    <a class="btn btn-link" href="service.php">Rumeguș</a>
                    <a class="btn btn-link" href="service.php">Rășinoase</a>
                    <a class="btn btn-link" href="service.php">Esență tare</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Link-uri</h4>
                    <a class="btn btn-link" href="about.php">Despre noi</a>
                    <a class="btn btn-link" href="contact.php">Contact</a>
                    <a class="btn btn-link" href="service.php">Servicii</a>
                    <a class="btn btn-link" href="termeni.php">Termeni & condiții</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Link-uri utile</h4>
                    <a href="https://anpc.ro" target="_blank">
                        <img src="img/anpc.avif" alt="" class="img-fluid">
                    </a>
                    <a href="https://ec.europa.eu/consumers/odr/main/index.cfm?event=main.home.chooseLanguage" target="_blank">
                        <img src="img/anpc-sol-1.avif" alt="" class="img-fluid">
                    </a>
                </div>
            </div>
        </div>
        <div class="container" id="jos">
            <div class="copyright" id="jos2">
                <p> © <a class="border-bottom" href="index.php">Doi Ursuleti Forest</a>, All Right Reserved.</p>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-0 back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html>