<?php
session_start(); // Mută session_start() aici, la început
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Woody - Detalii Produs</title>
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
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet" />
</head>
<body>
    <!-- Spinner, Topbar, Navbar -->
    <!-- Copiază codul HTML pentru Spinner, Topbar și Navbar din service.php aici -->
    <!-- Înlocuiește doar conținutul specific al paginii -->

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
        <a href="index.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <img src="img/logo.png" alt="Logo" style="width: 120px; height: auto;">
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.php" class="nav-item nav-link">Home</a>
                <a href="about.php" class="nav-item nav-link">About</a>
                <a href="service.php" class="nav-item nav-link active">Produse</a>
                <a href="project.php" class="nav-item nav-link">Project</a>
                <a href="contact.php" class="nav-item nav-link">Contact</a>
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
            <h1 class="display-3 text-white mb-3 animated slideInDown">Detalii Produs</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="service.php">Produse</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Detalii</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Product Details Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <?php
            include 'db_connect.php';
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT nume, descriere FROM produse WHERE id = $id";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo '<div class="row g-4">';
                    echo '<div class="col-md-6 wow fadeInUp" data-wow-delay="0.1s">';
                    echo '<img class="img-fluid" src="img/service-1.jpg" alt="' . htmlspecialchars($row["nume"]) . '">';
                    echo '</div>';
                    echo '<div class="col-md-6 wow fadeInUp" data-wow-delay="0.3s">';
                    echo '<h1 class="display-5 mb-3">' . htmlspecialchars($row["nume"]) . '</h1>';
                    echo '<p>' . htmlspecialchars($row["descriere"]) . '</p>';
                    echo '<form method="post" action="add_to_cart.php">';
                    echo '<input type="hidden" name="product_id" value="' . $id . '">';
                    echo '<button type="submit" class="btn btn-primary py-2 px-4">Adaugă în coș</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                } else {
                    echo '<p>Produsul nu a fost găsit.</p>';
                }
            } else {
                echo '<p>ID-ul produsului lipsește.</p>';
            }
            $conn->close();
            ?>
        </div>
    </div>
    <!-- Product Details End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Address</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Sediu: Vișeu de Sus, Maramureș, str.Cimitirului, nr.16A</p>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Fabrica: Ilia, Hunedoara, str.Unirii, nr.103A</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>0742900678</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>0742649793</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>doiursuletiforest@gmail.com</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Services</h4>
                    <a class="btn btn-link" href="">Lemn prelucrat</a>
                    <a class="btn btn-link" href="">Lemn de foc</a>
                    <a class="btn btn-link" href="">Rumeguș</a>
                    <a class="btn btn-link" href="">Rășinoase</a>
                    <a class="btn btn-link" href="">Esență tare</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Quick Links</h4>
                    <a class="btn btn-link" href="">About Us</a>
                    <a class="btn btn-link" href="">Contact Us</a>
                    <a class="btn btn-link" href="">Our Services</a>
                    <a class="btn btn-link" href="">Terms & Condition</a>
                    <a class="btn btn-link" href="">Support</a>
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
                    <p> &copy; <a class="border-bottom" href="index.php">Doi Ursuleti Forest</a>, All Right Reserved.</p>
            </div>
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
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html>