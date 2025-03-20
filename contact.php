<?php
session_start(); // Start the session at the beginning

require 'vendor/autoload.php'; // Include Dotenv autoloader
use Dotenv\Dotenv;

// Load environment variables from .env file
try {
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    $dotenv->required(['FORMSPREE_ENDPOINT'])->notEmpty();
} catch (Exception $e) {
    die("Eroare la încărcarea fișierului .env: " . $e->getMessage());
}

// Get the Formspree endpoint from the .env file
$formspree_endpoint = $_ENV['FORMSPREE_ENDPOINT'];

// Determine the base URL dynamically for the redirect to success.php
$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
$success_url = $base_url . dirname($_SERVER['REQUEST_URI']) . "/success.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Woody - Contact</title>
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
                    <small>tehnician silvic: 0742900678</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fa fa-phone-alt text-primary me-2"></small>
                    <small>manager transport: 0742649793</small>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
        <a
            href="index.php"
            class="navbar-brand d-flex align-items-center px-4 px-lg-5"
        >
            <img src="img/logo.png" alt="Logo" style="width: 120px; height: auto" />
        </a>
        <button
            type="button"
            class="navbar-toggler me-4"
            data-bs-toggle="collapse"
            data-bs-target="#navbarCollapse"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.php" class="nav-item nav-link">Home</a>
                <a href="about.php" class="nav-item nav-link">About</a>
                <a href="service.php" class="nav-item nav-link">Produse</a>
                <a href="project.php" class="nav-item nav-link">Project</a>
                <a href="contact.php" class="nav-item nav-link active">Contact</a>
            </div>
            <a href="cart.php" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block position-relative">
                <i class="fa fa-shopping-cart me-3"></i> Go to Cart
                <span class="cart-count"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : '0'; ?></span>
            </a>
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
                        <a class="text-white" href="index.php">Home</a>
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
    <div
        class="container-fluid bg-light overflow-hidden px-lg-0"
        style="margin: 6rem 0"
    >
        <div class="container contact px-lg-0">
            <div class="row g-0 mx-lg-0">
                <div
                    class="col-lg-6 contact-text py-5 wow fadeIn"
                    data-wow-delay="0.5s"
                >
                    <div class="p-lg-5 ps-lg-0">
                        <div class="section-title text-start">
                            <h1 class="display-5 mb-4">Contactați-ne</h1>
                        </div>
                        <p class="mb-4">
                            Completați formularul de mai jos pentru a ne trimite un mesaj. Vă vom răspunde cât mai curând posibil.
                        </p>
                        <!-- Formspree Form -->
                        <form action="<?php echo htmlspecialchars($formspree_endpoint); ?>" method="POST">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="name"
                                            name="name"
                                            placeholder="Numele tău"
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
                                        ></textarea>
                                        <label for="message">Mesaj</label>
                                    </div>
                                </div>
                                <!-- Hidden field to redirect to success.php after submission -->
                                <input type="hidden" name="_next" value="<?php echo htmlspecialchars($success_url); ?>">
                                <!-- Hidden field to set the email subject -->
                                <input type="hidden" name="_subject" value="Mesaj nou de pe site-ul Doi Ursuleti Forest">
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
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12406.178691353229!2d24.424520017720585!3d47.71353841035583!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47364733fc0c7cf1%3A0xa0a0d0858ba87a1!2sStrada%20Cimitirului%2016%2C%20Vi%C8%99eu%20de%20Sus%20435700!5e0!3m2!1sen!2sro!4v1742252191022!5m2!1sen!2sro"
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
                    <h4 class="text-light mb-4">Adresă</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Sediu: Vișeu de Sus, Maramureș, str.Cimitirului, nr.16A</p>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Fabrica: Ilia, Hunedoara, str.Unirii, nr.103A</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>0742900678</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>0742649793</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>doiursuletiforest@gmail.com</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Servicii</h4>
                    <a class="btn btn-link" href="">Lemn prelucrat</a>
                    <a class="btn btn-link" href="">Lemn de foc</a>
                    <a class="btn btn-link" href="">Rumeguș</a>
                    <a class="btn btn-link" href="">Rășinoase</a>
                    <a class="btn btn-link" href="">Esență tare</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Link-uri rapide</h4>
                    <a class="btn btn-link" href="">Despre noi</a>
                    <a class="btn btn-link" href="">Contact</a>
                    <a class="btn btn-link" href="">Serviciile noastre</a>
                    <a class="btn btn-link" href="">Termeni și condiții</a>
                    <a class="btn btn-link" href="">Suport</a>
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
                <p> © <a class="border-bottom" href="index.php">Doi Ursuleti Forest</a>, Toate drepturile rezervate.</p>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a
        href="#"
        class="btn btn-lg btn-primary btn-lg-square rounded-0 back-to-top"
    ><i class="bi bi-arrow-up"></i></a>

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