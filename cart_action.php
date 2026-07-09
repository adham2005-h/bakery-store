<?php
require 'includes/db.php';

$action = isset($_POST['action']) ? $_POST['action'] : '';
$redirect = isset($_POST['redirect']) ? $_POST['redirect'] : 'cart.php';

if ($action === 'add') {
    $productId = (int)$_POST['product_id'];
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

    if ($quantity < 1) {
        $quantity = 1;
    }

    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] += $quantity;
    } else {
        $_SESSION['cart'][$productId] = $quantity;
    }
}

if ($action === 'update') {
    $productId = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];

    if ($quantity < 1) {
        unset($_SESSION['cart'][$productId]);
    } else {
        $_SESSION['cart'][$productId] = $quantity;
    }
}

if ($action === 'remove') {
    $productId = (int)$_POST['product_id'];
    unset($_SESSION['cart'][$productId]);
}

if ($action === 'clear') {
    $_SESSION['cart'] = [];
}

header('Location: ' . $redirect);
exit;
