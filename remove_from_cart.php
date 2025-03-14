<?php
session_start();

if (isset($_POST['index'])) {
    $index = $_POST['index'];

    // Verifică dacă indexul există în coș
    if (isset($_SESSION['cart'][$index])) {
        // Șterge produsul de la acel index
        unset($_SESSION['cart'][$index]);

        // Reindexează array-ul pentru a elimina spațiile goale
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}

// Redirecționează înapoi la coș
header('Location: cart.php');
exit();
?>