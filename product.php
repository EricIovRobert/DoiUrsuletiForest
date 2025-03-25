<?php
session_start();
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
</head>
<body>
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
                <a href="service.php" class="nav-item nav-link active">Produse</a>
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
            <h1 class="display-3 text-white mb-3 animated slideInDown">Detalii Produs</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Acasă</a></li>
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
                $sql = "SELECT * FROM produse WHERE id = $id";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo '<div class="row g-4">';
                    echo '<div class="col-md-6 wow fadeInUp" data-wow-delay="0.1s">';
                    echo '<img class="img-fluid" src="' . htmlspecialchars($row["imagine_path"]) . '" alt="' . htmlspecialchars($row["nume"]) . '">';
                    echo '</div>';
                    echo '<div class="col-md-6 wow fadeInUp" data-wow-delay="0.3s">';
                    echo '<h1 class="display-5 mb-3">' . htmlspecialchars($row["nume"]) . '</h1>';
                    echo '<p><strong>Descriere:</strong> ' . htmlspecialchars($row["descriere"]) . '</p>';

                    // Formular pentru personalizare
                    echo '<form method="post" action="add_to_cart.php">';
                    echo '<input type="hidden" name="product_id" value="' . $id . '">';
                    echo '<input type="hidden" name="product_name" value="' . htmlspecialchars($row["nume"]) . '">';

                    // Selectare clasa de lemn
                    echo '<div class="mb-3">';
                    echo '<label for="clasa_lemn" class="form-label"><strong>Selectați clasa de lemn:</strong></label>';
                    echo '<select class="form-select" id="clasa_lemn" name="clasa_lemn" required onchange="updateSortimente()">';
                    echo '<option value="">Alegeți clasa</option>';
                    echo '<option value="Rășinoase">Rășinoase</option>';
                    echo '<option value="Esență tare">Esență tare</option>';
                    echo '</select>';
                    echo '</div>';

                    // Selectare sortiment
                    echo '<div class="mb-3">';
                    echo '<label for="sortiment" class="form-label"><strong>Selectați sortimentul:</strong></label>';
                    echo '<select class="form-select" id="sortiment" name="sortiment" required>';
                    echo '<option value="">Alegeți sortimentul</option>';
                    echo '</select>';
                    echo '</div>';

                    // Clasa de calitate
                    if ($row["nume"] != 'Rumeguș') {
                        echo '<div class="mb-3">';
                        echo '<label for="clasa_calitate" class="form-label"><strong>Selectați clasa de calitate:</strong></label>';
                        echo '<select class="form-select" id="clasa_calitate" name="clasa_calitate" required>';
                        echo '<option value="">Alegeți o clasă</option>';
                        if ($row["nume"] == 'Lemn de foc') {
                            echo '<option value="Lăturoaie">Lăturoaie</option>';
                            echo '<option value="Bustean">Bustean</option>';
                        } else {
                            echo '<option value="A">A</option>';
                            echo '<option value="B">B</option>';
                            echo '<option value="C">C</option>';
                        }
                        echo '</select>';
                        echo '</div>';
                    }

                    // Dimensiuni
                    if ($row["nume"] != 'Rumeguș') {
                        echo '<div class="mb-3">';
                        echo '<label for="dimensiuni" class="form-label"><strong>Introduceți dimensiunile dorite (ex. 2m x 15cm x 5cm):</strong></label>';
                        echo '<input type="text" class="form-control" id="dimensiuni" name="dimensiuni" placeholder="ex. 2m x 15cm x 5cm" required>';
                        echo '</div>';
                    }

                    // Paletat/Non-paletat
                    if ($row["nume"] == 'Lemn de foc') {
                        echo '<div class="mb-3">';
                        echo '<label for="paletat" class="form-label"><strong>Paletat:</strong></label>';
                        echo '<select class="form-select" id="paletat" name="paletat" required onchange="updateUnitOfMeasure()">';
                        echo '<option value="">Alegeți o opțiune</option>';
                        echo '<option value="Paletat">Paletat</option>';
                        echo '<option value="Non-paletat">Non-paletat</option>';
                        echo '</select>';
                        echo '</div>';
                    }

                    // Unitatea de măsură
                    echo '<div class="mb-3">';
                    echo '<label for="unitate_masura" class="form-label"><strong>Unitate de măsură:</strong></label>';
                    if ($row["nume"] == 'Cherestea') {
                        echo '<input type="hidden" id="unitate_masura" name="unitate_masura" value="m3">';
                        echo '<p>m3</p>';
                    } elseif ($row["nume"] == 'Rumeguș') {
                        echo '<input type="hidden" id="unitate_masura" name="unitate_masura" value="tone">';
                        echo '<p>tone</p>';
                    } elseif ($row["nume"] == 'Lemn de foc') {
                        echo '<input type="hidden" id="unitate_masura" name="unitate_masura" value="">';
                        echo '<p id="unitate_masura_text">Selectați opțiunea Paletat/Non-paletat pentru a seta unitatea de măsură.</p>';
                    } else {
                        echo '<select class="form-select" id="unitate_masura" name="unitate_masura" required>';
                        echo '<option value="">Alegeți unitatea</option>';
                        echo '<option value="m3">m3</option>';
                        echo '<option value="bucati">bucăți</option>';
                        echo '</select>';
                    }
                    echo '</div>';

                    // Cantitate
                    echo '<div class="mb-3">';
                    echo '<label for="quantity" class="form-label"><strong>Cantitate:</strong></label>';
                    echo '<input type="number" class="form-control" id="quantity" name="quantity" min="1" value="1" required>';
                    echo '</div>';

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

    <!-- JavaScript pentru actualizarea sortimentelor și unității de măsură -->
    <script>
    function updateSortimente() {
        var clasaLemn = document.getElementById('clasa_lemn').value;
        var sortimentSelect = document.getElementById('sortiment');
        sortimentSelect.innerHTML = '<option value="">Alegeți sortimentul</option>';
        
        if (clasaLemn === 'Rășinoase') {
            sortimentSelect.innerHTML += '<option value="Brad">Brad</option>';
            sortimentSelect.innerHTML += '<option value="Molid">Molid</option>';
        } else if (clasaLemn === 'Esență tare') {
            sortimentSelect.innerHTML += '<option value="Fag">Fag</option>';
            sortimentSelect.innerHTML += '<option value="Stejar Gorun">Stejar Gorun</option>';
            sortimentSelect.innerHTML += '<option value="Stejar Cer">Stejar Cer</option>';
        }
    }

    function updateUnitOfMeasure() {
        var paletat = document.getElementById('paletat');
        var unitateMasuraInput = document.getElementById('unitate_masura');
        var unitateMasuraText = document.getElementById('unitate_masura_text');
        
        if (paletat && unitateMasuraInput && unitateMasuraText) {
            if (paletat.value === 'Paletat') {
                unitateMasuraInput.value = 'bucati';
                unitateMasuraText.innerText = 'Unitatea de măsură: bucăți';
            } else if (paletat.value === 'Non-paletat') {
                unitateMasuraInput.value = 'm3';
                unitateMasuraText.innerText = 'Unitatea de măsură: m3';
            } else {
                unitateMasuraInput.value = '';
                unitateMasuraText.innerText = 'Selectați opțiunea Paletat/Non-paletat pentru a seta unitatea de măsură.';
            }
        }
    }
    </script>

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
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html>