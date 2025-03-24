<?php
session_start(); // Mută session_start() aici, la început
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Doi Ursuleti</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">


    <style>
    /* Setăm înălțimea fixă pentru containerul caruselului */
    .carousel-inner {
      height: 800px;
      max-height: 800px;
      overflow: hidden;
    }

    /* Ajustăm imaginile să se potrivească în container */
    .carousel-inner .carousel-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    /* Opțional: Ajustăm înălțimea pentru ecrane mici */
    @media (max-width: 767px) {
      .carousel-inner {
        height: 300px;
        max-height: 300px;
      }
    }
    .service-item {
            height: 400px; /* Înălțimea fixă a cardului */
            display: flex;
            flex-direction: column;
            overflow: hidden; /* Ascunde conținutul care depășește */
        }



        /* Stil pentru imagine */
        .overflow-hidden img.img-fluid {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Imaginea se adaptează fără distorsiuni */
        }
  </style>


    
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
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
                    <small>Ilia, Hunedoara, str.Unirii, nr.103A</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center py-3">
                    <small class="far fa-clock text-primary me-2"></small>
                    <small>LUNI-VINERI 08-17 SÂMBĂTĂ 08-13</small>
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
            <img src="img/logo.jpg" alt="Logo" style="width: 50px; height: 50;">
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.php" class="nav-item nav-link active">Acasă</a>
                <a href="about.php" class="nav-item nav-link">Despre noi</a>
                <a href="service.php" class="nav-item nav-link">Produse</a>
                <a href="project.php" class="nav-item nav-link">Proiecte</a>
                <a href="contact.php" class="nav-item nav-link">Contact</a>
                <a href="cart.php" class="btn btn-primary py-4 px-lg-5  position-relative">
                <i class="fa fa-shopping-cart me-3"></i> Coș
                <span class="cart-count"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : '0'; ?></span>
            </a>
            </div>

        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Carousel Start -->
    <div class="container-fluid p-0 pb-5">
  <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <!-- Imaginile caruselului -->
    <div class="carousel-inner">
      <!-- Prima imagine -->
            <div class="carousel-item active">
            <img class="img-fluid" src="img/carusel-1.avif" alt="">
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(53, 53, 53, .7);">
                <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-8 text-center">
                    <h1 class="display-3 text-white mb-4">DOI URSULEȚI FOREST SRL</h1>
                    <p class="fs-5 fw-medium text-white mb-4 pb-2">De la Pădure la Perfecțiune</p>
                    </div>
                </div>
                </div>
            </div>
            </div>

            <!-- A doua imagine -->
            <div class="carousel-item">
            <img class="img-fluid" src="img/carusel-2.avif" alt="">
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(53, 53, 53, .7);">
                <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-8 text-center">
                    <h1 class="display-3 text-white mb-4">Lemn de foc uscat</h1>
                    <p class="fs-5 fw-medium text-white mb-4 pb-2">Arde eficient și oferă căldură de lungă durată!</p>
                    </div>
                </div>
                </div>
            </div>
            </div>

            <!-- A treia imagine -->
            <div class="carousel-item">
            <img class="img-fluid" src="img/carusel-3.avif" alt="">
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(53, 53, 53, .7);">
                <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-8 text-center">
                    <h1 class="display-3 text-white mb-4">Esențe tari și rășinoase</h1>
                    <p class="fs-5 fw-medium text-white mb-4 pb-2">Alege lemnul potrivit pentru fiecare proiect!</p>
                    </div>
                </div>
                </div>
            </div>
            </div>

    <!-- Controalele caruselului -->
    <div class="carousel-controls">
      <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <ol class="carousel-indicators">
        <li data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#myCarousel" data-bs-slide-to="1"></li>
        <li data-bs-target="#myCarousel" data-bs-slide-to="2"></li>
      </ol>
      <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
</div>
<!-- Carousel End -->


    <!-- Feature Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.1s">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center justify-content-center bg-light" style="width: 60px; height: 60px;">
                            <i class="fa fa-user-check fa-2x text-primary"></i>
                        </div>
                        <h1 class="display-1 text-light mb-0">1</h1>
                    </div>
                    <h5>Echipă de Profesioniști</h5>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.3s">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center justify-content-center bg-light" style="width: 60px; height: 60px;">
                            <i class="fa fa-check fa-2x text-primary"></i>
                        </div>
                        <h1 class="display-1 text-light mb-0">2</h1>
                    </div>
                    <h5>Produse de Calitate</h5>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.5s">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center justify-content-center bg-light" style="width: 60px; height: 60px;">
                            <i class="fa fa-drafting-compass fa-2x text-primary"></i>
                        </div>
                        <h1 class="display-1 text-light mb-0">3</h1>
                    </div>
                    <h5>Consultanță Gratuită</h5>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.7s">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center justify-content-center bg-light" style="width: 60px; height: 60px;">
                            <i class="fa fa-headphones fa-2x text-primary"></i>
                        </div>
                        <h1 class="display-1 text-light mb-0">4</h1>
                    </div>
                    <h5>Asistență pentru Clienți</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature Start -->



   


    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="section-title text-center">
                <h1 class="display-5 mb-5">Servicii oferite</h1>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/cherestea1.avif" alt="">
                        </div>
                        <div class="p-4 text-center border border-5 border-light border-top-0">
                            <h4 class="mb-3">Lemn prelucrat</h4>
                            <p>Vindem lemn prelucrat, orice dimensiune, la cerere.</p>
                            <a class="fw-medium" href="service.php">Află mai multe<i class="fa fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/lemnfoc2.avif" alt="">
                        </div>
                        <div class="p-4 text-center border border-5 border-light border-top-0">
                            <h4 class="mb-3">Lemn de foc</h4>
                            <p>Oferim lemne de foc de vânzare, cu sau fără paletare.</p>
                            <a class="fw-medium" href="service.php">Află mai multe<i class="fa fa-arrow-right ms-2"></i></a>
                        </div>
                    </div> 
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/rumegus2.avif" alt="">
                        </div>
                        <div class="p-4 text-center border border-5 border-light border-top-0">
                            <h4 class="mb-3">Rumeguș</h4>
                            <p>Punem la dispoziție rumeguș, comercializat la tonă.</p>
                            <a class="fw-medium" href="service.php">Află mai multe<i class="fa fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/grinzi1.avif" alt="">
                        </div>
                        <div class="p-4 text-center border border-5 border-light border-top-0">
                            <h4 class="mb-3">Rășinoase</h4>
                            <p>Procesăm rășinoase precum brad și molid.</p>
                            <a class="fw-medium" href="service.php">Află mai multe<i class="fa fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/traverse1.avif" alt="">
                        </div>
                        <div class="p-4 text-center border border-5 border-light border-top-0">
                            <h4 class="mb-3">Esență tare</h4>
                            <p>Procesăm esențe tari precum fag, stejar (gorun și cer).</p>
                            <a class="fw-medium" href="service.php">Află mai multe<i class="fa fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/cherestea2.avif" alt="">
                        </div>
                        <div class="p-4 text-center border border-5 border-light border-top-0">
                            <h4 class="mb-3">Dimensiuni Personalizate</h4>
                            <p>Adaptăm fiecare produs cerințelor tale.</p>
                            <a class="fw-medium" href="service.php">Află mai multe<i class="fa fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Feature Start -->
    <div class="container-fluid bg-light overflow-hidden my-5 px-lg-0">
        <div class="container feature px-lg-0">
            <div class="row g-0 mx-lg-0">
                <div class="col-lg-6 feature-text py-5 wow fadeIn" data-wow-delay="0.5s">
                    <div class="p-lg-5 ps-lg-0">
                        <div class="section-title text-start">
                            <h1 class="display-5 mb-4">De ce noi?</h1>
                        </div>
                        <p class="mb-4 pb-2">Echipă calificată: tehnicieni silvici, ingineri, operatori cherestea. Activăm din 2018 în exploatare forestieră, cu creștere constantă și clienți de top. Din 2024, deținem o linie Primultini 1300 (40-60 mc lemn brut), susținută de exploatare proprie și furnizori. Produse FSC: rășinoase (molid, brad), esențe tari (stejar, fag), orice dimensiune.</p>
                        <div class="row g-4">
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-white" style="width: 60px; height: 60px;">
                                        <i class="fa fa-check fa-2x text-primary"></i>
                                    </div>
                                    <div class="ms-4">
                                        <p class="mb-2">Calitate</p>
                                        <h5 class="mb-0">Superioară</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-white" style="width: 60px; height: 60px;">
                                        <i class="fa fa-user-check fa-2x text-primary"></i>
                                    </div>
                                    <div class="ms-4">
                                        <p class="mb-2">Echipă</p>
                                        <h5 class="mb-0">Dedicată</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-white" style="width: 60px; height: 60px;">
                                        <i class="fa fa-drafting-compass fa-2x text-primary"></i>
                                    </div>
                                    <div class="ms-4">
                                        <p class="mb-2">Consultanță</p>
                                        <h5 class="mb-0">Gratuită</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-white" style="width: 60px; height: 60px;">
                                        <i class="fa fa-headphones fa-2x text-primary"></i>
                                    </div>
                                    <div class="ms-4">
                                        <p class="mb-2">Suport</p>
                                        <h5 class="mb-0">Clienți</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pe-lg-0" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute img-fluid w-100 h-100" src="img/feature.avif" style="object-fit: cover;" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->


<!-- Testimonial Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="section-title text-center">
            <h1 class="display-5 mb-5">Testimoniale</h1>
        </div>
        <div class="row g-4">
            <!-- Testimonial 1 - Cherestea -->
            <div class="col-md-4">
                <div class="card h-100 text-center p-4 shadow-sm">
                    <div class="card-body">
                        <p class="mb-3">Am comandat cherestea pentru construcția unui foișor și sunt extrem de mulțumit de calitatea materialului. Lemnul este bine uscat, fără crăpături sau defecte.</p>
                        <h5 class="mb-1">Ion Vasilescu</h5>
                        <span class="fst-italic text-muted">Meșter tâmplar</span>
                    </div>
                </div>
            </div>
            <!-- Testimonial 2 - Grinzi -->
            <div class="col-md-4">
                <div class="card h-100 text-center p-4 shadow-sm">
                    <div class="card-body">
                        <p class="mb-3">Grinzile de la DOI URSULEȚI FOREST SRL sunt perfecte pentru structuri de acoperiș. Rezistente, bine tratate și cu o finisare impecabilă.</p>
                        <h5 class="mb-1">Mihai Georgescu</h5>
                        <span class="fst-italic text-muted">Constructor</span>
                    </div>
                </div>
            </div>
            <!-- Testimonial 3 - Traverse -->
            <div class="col-md-4">
                <div class="card h-100 text-center p-4 shadow-sm">
                    <div class="card-body">
                        <p class="mb-3">Am folosit traversele produse de ei pentru construcția unei platforme industriale. Sunt extrem de solide și bine dimensionate. Calitatea și durabilitatea sunt la superlativ!</p>
                        <h5 class="mb-1">Alexandru Preda</h5>
                        <span class="fst-italic text-muted">Manager de proiect</span>
                    </div>
                </div>
            </div>
          
          
        
        </div>
    </div>
</div>
<!-- Testimonial End -->



    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Contact</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Sediu: Vișeu de Sus, Maramureș, str.Cimitirului, nr.16A</p>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Fabrică: Ilia, Hunedoara, str.Unirii, nr.103A</p>
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
                    <a class="btn btn-link" href="">Termeni & condiții</a>
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