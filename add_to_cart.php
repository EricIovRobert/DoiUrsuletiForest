<?php
session_start();
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    if (!in_array($product_id, $_SESSION['cart'])) {
        array_push($_SESSION['cart'], $product_id);
    }
    header('Location: service.php'); // Redirecționează înapoi la lista de produse
    exit();
} else {
    echo "ID-ul produsului lipsește.";
}
?>