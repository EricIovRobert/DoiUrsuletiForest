<?php
session_start();
include 'db_connect.php'; // Asigură-te că acest fișier conține conexiunea la baza de date

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name']; // Corectat pentru a se potrivi cu formularul

    // Preia toate detaliile din formular
    $clasa_lemn = $_POST['clasa_lemn'];
    $sortiment = $_POST['sortiment'];
    $clasa_calitate = isset($_POST['clasa_calitate']) ? $_POST['clasa_calitate'] : '';
    $dimensiuni = isset($_POST['dimensiuni']) ? $_POST['dimensiuni'] : '';
    $paletat = isset($_POST['paletat']) ? $_POST['paletat'] : '';
    $unitate_masura = $_POST['unitate_masura'];
    $quantity = $_POST['quantity']; // Folosim doar 'quantity' pentru toate produsele

    // Interogare pentru a obține imagine_path și descriere din baza de date
    $sql = "SELECT imagine_path, descriere FROM produse WHERE id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $imagine_path = $row['imagine_path'];
        $descriere = $row['descriere'];
    } else {
        $imagine_path = 'img/default.jpg'; // Imagine implicită dacă nu există
        $descriere = 'Descriere indisponibilă';
    }

    // Creează array-ul cu toate detaliile produsului
    $cart_item = array(
        'product_id' => $product_id,
        'nume' => $product_name,
        'descriere' => $descriere,
        'clasa_lemn' => $clasa_lemn,
        'sortiment' => $sortiment,
        'clasa_calitate' => $clasa_calitate,
        'dimensiuni' => $dimensiuni,
        'paletat' => $paletat,
        'unitate_masura' => $unitate_masura,
        'quantity' => $quantity,
        'imagine_path' => $imagine_path
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