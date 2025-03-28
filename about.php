<?php
session_start(); // Mută session_start() aici, la început
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
            <img src="img/logo.jpg" alt="Logo" style="width: 50px; height: 50;">
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.php" class="nav-item nav-link">Acasă</a>
                <a href="about.php" class="nav-item nav-link active">Despre noi</a>
                <a href="service.php" class="nav-item nav-link">Produse</a>
                <a href="contact.php" class="nav-item nav-link">Contact</a>
                <a href="cart.php" class="btn btn-primary py-4 px-lg-5  position-relative">
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
        <h1 class="display-3 text-white mb-3 animated slideInDown">Despre noi</h1>
        <nav aria-label="breadcrumb animated slideInDown">
           <ol class="breadcrumb">
             <li class="breadcrumb-item">
               <a class="text-white" href="#">Acasă</a>
             </li>
             <li class="breadcrumb-item">
               <a class="text-white" href="#">Pagini</a>
             </li>
             <li class="breadcrumb-item text-white active" aria-current="page">
               Despre noi
             </li>
           </ol>
         </nav>
      </div>
    </div>
    <!-- Page Header End -->

    

    <!-- About Start -->
    <div class="container-fluid bg-light overflow-hidden my-5 px-lg-0">
      <div class="container about px-lg-0">
        <div class="row g-0 mx-lg-0">
        <div class="col-lg-6 ps-lg-0" style="min-height: 400px">
          <div class="position-relative h-100">
            <video class="position-absolute img-fluid w-100 h-100" style="object-fit: cover" controls>
              <source src="video/video.mp4" type="video/mp4">
              Browserul tău nu suportă redarea videoclipurilor.
            </video>
          </div>
        </div>

          <div
            class="col-lg-6 about-text py-5 wow fadeIn"
            data-wow-delay="0.5s"
          >
            <div class="p-lg-5 pe-lg-0">
              <div class="section-title text-start">
                <h1 class="display-5 mb-4">Despre noi</h1>
              </div>
              <p class="mb-4 pb-2" style="text-align: justify;">
              DOI URSULEȚI FOREST SRL este o companie cu rădăcini solide în industria exploatării forestiere, dedicată valorificării lemnului într-un mod sustenabil și eficient. Prin pasiune, profesionalism și respect pentru natură, ne-am consolidat poziția pe piață, oferind servicii de înaltă calitate în domeniul exploatării și prelucrării lemnului.

Cu o viziune orientată spre viitor, am făcut pasul următor în evoluția noastră, diversificându-ne activitatea prin investiția într-o linie modernă de debitare a lemnului. Astfel, prin achiziția unui utilaj de ultimă generație, ne-am extins capacitatea de producție, oferind clienților noștri produse finite de calitate superioară, adaptate cerințelor pieței.

Fie că vorbim despre exploatarea responsabilă a resurselor forestiere sau despre transformarea lemnului brut în produse finite, DOI URSULEȚI FOREST rămâne un nume de referință în industrie, combinând tradiția cu tehnologia pentru un viitor durabil.            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- About End -->


    <!-- About Start -->
<div class="container-fluid bg-light overflow-hidden my-5 px-lg-0">
  <div class="container about px-lg-0">
    <div class="row g-0 mx-lg-0">
    <div class="col-lg-6 about-text py-5 wow fadeIn order-lg-1" data-wow-delay="0.5s">
      <div class="p-lg-5">
        <div class="section-title text-start">
          <h1 class="display-5 mb-4">Misiunea Noastră</h1>
        </div>
        <p class="mb-4 pb-2" style="text-align: justify;">
        La DOI URSULEȚI FOREST SRL ne dedicăm transformării resurselor forestiere într-o valoare durabilă și superioară, prin exploatarea responsabilă și prelucrarea modernă a lemnului. Ne angajăm să oferim produse și servicii de înaltă calitate, îmbinând tradiția cu tehnologia de ultimă generație și promovând principiile sustenabilității în toate etapele procesului de producție. Respectul pentru mediul înconjurător stă la baza activității noastre, iar inovația constantă ne permite să răspundem eficient cerințelor pieței și nevoilor clienților. În plus, investim în regenerarea și conservarea pădurilor, contribuind la un viitor echilibrat pentru comunitățile noastre și mediul natural. Această abordare integrată reflectă angajamentul nostru de a transforma "De la Pădure la Perfecțiune" într-o realitate cotidiană și durabilă.        </p>
      </div>
    </div>
      <div class="col-lg-6 pe-lg-0 order-lg-2" style="min-height: 400px">
        <div class="position-relative h-100">
          <img class="position-absolute img-fluid w-100 h-100" style="object-fit: cover" src="img/traverse.avif" alt="Descrierea imaginii">
        </div>
      </div>
    </div>
  </div>
</div>
<!-- About End -->


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
                    <p> &copy; <a class="border-bottom" href="index.php">Doi Ursuleti Forest</a>, All Right Reserved.</p>
            </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a
      href="#"
      class="btn btn-lg btn-primary btn-lg-square rounded-0 back-to-top"
      ><i class="bi bi-arrow-up"></i
    ></a>

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
