<?php
session_start();
include 'db_connect.php'; // Asigură-te că acest fișier conține conexiunea la baza de date

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Interogare pentru a obține imagine_path din baza de date
    $sql = "SELECT imagine_path FROM produse WHERE id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $imagine_path = $row['imagine_path'];
    } else {
        $imagine_path = 'img/default.jpg'; // Imagine implicită dacă nu există în baza de date
    }

    // Creează array-ul cu toate detaliile produsului, inclusiv imagine_path
    $cart_item = array(
        'product_id' => $product_id,
        'nume' => $_POST['product_nume'],
        'tip_lemn' => $_POST['tip_lemn'],
        'clasa_calitate' => $_POST['clasa_calitate'],
        'dimensiuni' => isset($_POST['dimensiuni']) ? $_POST['dimensiuni'] : '',
        'subcategorie' => isset($_POST['subcategorie']) ? $_POST['subcategorie'] : '',
        'cantitate' => isset($_POST['cantitate']) ? $_POST['cantitate'] : '',
        'quantity' => $_POST['quantity'],
        'imagine_path' => $imagine_path // Adaugă path-ul imaginii
    );

    // Inițializează coșul în sesiune dacă nu există
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Adaugă produsul în coș
    array_push($_SESSION['cart'], $cart_item);

    // Redirecționează către pagina coșului
    header('Location: cart.php');
    exit();
} else {
    echo "ID-ul produsului lipsește.";
}

$conn->close();
?>