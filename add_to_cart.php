<?php
session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['product_id'])) {
    // Create an array with all submitted product details
    $cart_item = array(
        'product_id' => $_POST['product_id'],
        'nume' => $_POST['product_nume'], // Changed from 'product_name' to 'nume' to match the database
        'tip_lemn' => $_POST['tip_lemn'],
        'clasa_calitate' => $_POST['clasa_calitate'],
        'dimensiuni' => isset($_POST['dimensiuni']) ? $_POST['dimensiuni'] : '',
        'subcategorie' => isset($_POST['subcategorie']) ? $_POST['subcategorie'] : '',
        'cantitate' => isset($_POST['cantitate']) ? $_POST['cantitate'] : '',
        'quantity' => $_POST['quantity']
    );

    // Initialize the cart session array if it doesn’t exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Add the cart item to the session (no duplicate check since clients may want multiple configurations)
    array_push($_SESSION['cart'], $cart_item);

    // Redirect to the cart page
    header('Location: cart.php');
    exit();
} else {
    echo "ID-ul produsului lipsește.";
}
?>