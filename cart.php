<?php
session_start();
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Doi Ursuleti</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet" />

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet" />
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet" />

    <!-- Stilizare imagini -->
    <style>
        .service-item img {
            height: 400px;
            width: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem" role="status">
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
                <a href="contact.php" class="nav-item nav-link">Contact</a>
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
            <h1 class="display-3 text-white mb-3 animated slideInDown">Coș de cumpărături</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Acasă</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Coș</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Cart Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="section-title text-center">
                <h1 class="display-5 mb-5">Produsele din coșul tău</h1>
            </div>
            <div class="row g-4">
                <?php
                if (isset($_GET['status']) && $_GET['status'] == 'success') {
                    echo '<div class="alert alert-success text-center">Coșul a fost trimis cu succes! Veți fi contactat în curând.</div>';
                }

                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $index => $item) {
                        echo '<div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">';
                        echo '<div class="service-item">';
                        echo '<div class="overflow-hidden">';
                        echo '<img class="img-fluid" src="' . htmlspecialchars($item['imagine_path']) . '" alt="' . htmlspecialchars($item['nume']) . '">';
                        echo '</div>';
                        echo '<div class="p-4 text-center border border-5 border-light border-top-0" style="height: 400px; position: relative;">';
                        echo '<div style="height: 100%; overflow-y: auto; padding-bottom: 60px;">';
                        echo '<h4 class="mb-3">' . htmlspecialchars($item['nume']) . '</h4>';
                        echo '<p><strong>Clasa lemn:</strong> ' . htmlspecialchars($item['clasa_lemn']) . '</p>';
                        echo '<p><strong>Sortiment:</strong> ' . htmlspecialchars($item['sortiment']) . '</p>';
                        if (!empty($item['clasa_calitate'])) {
                            echo '<p><strong>Clasă calitate:</strong> ' . htmlspecialchars($item['clasa_calitate']) . '</p>';
                        }
                        if (!empty($item['dimensiuni'])) {
                            echo '<p><strong>Dimensiuni:</strong> ' . htmlspecialchars($item['dimensiuni']) . '</p>';
                        }
                        if (!empty($item['paletat'])) {
                            echo '<p><strong>Paletat:</strong> ' . htmlspecialchars($item['paletat']) . '</p>';
                        }
                        echo '<p><strong>Cantitate:</strong> ' . htmlspecialchars($item['quantity']) . ' ' . htmlspecialchars($item['unitate_masura']) . '</p>';
                        echo '</div>';
                        // Buton de ștergere
                        echo '<form method="post" action="remove_from_cart.php" style="position: absolute; bottom: 10px; left: 0; right: 0; text-align: center;">';
                        echo '<input type="hidden" name="index" value="' . $index . '">';
                        echo '<button type="submit" class="btn btn-danger btn-sm">Șterge</button>';
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    echo '</div>'; // Închide row
                    echo '<form method="post" action="send_cart.php" class="mt-5">';
                    echo '<div class="container">';
                    echo '<div class="row justify-content-center">';
                    echo '<div class="col-md-8">'; // Formular mai îngust și centrat
                    echo '<form method="post" action="send_cart.php" class="mt-5">';
                    echo '<div class="row g-3">'; // Spațiere consistentă între elemente
                    
                    // Câmpurile „Numele tău” și „Numărul tău de telefon” unul lângă altul
                    echo '<div class="col-md-6">';
                    echo '<div class="form-floating">';
                    echo '<input type="text" name="name" class="form-control" id="name" placeholder="Numele tău" required>';
                    echo '<label for="name">Numele tău</label>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="col-md-6">';
                    echo '<div class="form-floating">';
                    echo '<input type="tel" name="phone" class="form-control" id="phone" placeholder="Numărul tău de telefon" required>';
                    echo '<label for="phone">Numărul tău de telefon</label>';
                    echo '</div>';
                    echo '</div>';
                    
                    // Câmpul „Adresa ta de email”
                    echo '<div class="col-12">';
                    echo '<div class="form-floating">';
                    echo '<input type="email" name="email" class="form-control" id="email" placeholder="Adresa ta de email" required>';
                    echo '<label for="email">Adresa ta de email</label>';
                    echo '</div>';
                    echo '</div>';
                    
                    // Câmpul „Observații (opțional)”
                    echo '<div class="col-12">';
                    echo '<div class="form-floating">';
                    echo '<textarea name="observations" class="form-control" id="observations" placeholder="Observații (opțional)" style="height: 80px"></textarea>';
                    echo '<label for="observations">Observații (opțional)</label>';
                    echo '</div>';
                    echo '</div>';
                    
                    // Butonul „Trimite coșul”
                    echo '<div class="col-12">';
                    echo '<button type="submit" class="btn btn-primary w-100 py-3" style="background-color: #8B5A2B; border-color: #8B5A2B;">Trimite coșul</button>';
                    echo '</div>';
                    
                    echo '</div>'; // Sfârșit row g-3
                    echo '</form>';
                    echo '</div>'; // Sfârșit col-md-8
                    echo '</div>'; // Sfârșit row justify-content-center
                    echo '</div>'; // Sfârșit container
                } else {
                    echo '<p>Coșul tău este gol.</p>';
                }
                $conn->close();
                ?>
            </div>
        </div>
    </div>
    <!-- Cart End -->

    <!-- Contact Section Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-12 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item">
                        <div class="p-4 text-center">
                            <h4 class="mb-3">Detalii de contact</h4>
                            <p><i class="fa fa-phone-alt me-3"></i>Tehnician silvic: 0742900678</p>
                            <p><i class="fa fa-phone-alt me-3"></i>Manager transport: 0742649793</p>
                            <p><i class="fa fa-envelope me-3"></i>doiursuletiforest@gmail.com</p>
                            <p>Dacă ai întrebări sau preferi să plasezi comanda direct, nu ezita să ne contactezi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Section End -->

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
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html>