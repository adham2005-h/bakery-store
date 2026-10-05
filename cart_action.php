<?php
require 'includes/db.php';

// Cart changes must come from a form on this site.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    exit('Use a cart form to change the cart.');
}

$token = $_POST['csrf_token'] ?? '';
if (!is_string($token) || !hash_equals($_SESSION['csrf_token'], $token)) {
    http_response_code(403);
    exit('Invalid form. Reload the page and try again.');
}

$action = $_POST['action'] ?? '';
if (!is_string($action) || !in_array($action, ['add', 'update', 'remove', 'clear'], true)) {
    http_response_code(400);
    exit('Invalid cart action.');
}

// Only allow known pages; never redirect to a URL supplied by a visitor.
$redirect = $_POST['redirect'] ?? 'cart.php';
if (!is_string($redirect) || !in_array($redirect, ['cart.php', 'index.php', 'products.php'], true)) {
    $redirect = 'cart.php';
}

if ($action === 'clear') {
    $_SESSION['cart'] = [];
} else {
    $productId = filter_var($_POST['product_id'] ?? null, FILTER_VALIDATE_INT);
    if ($productId === false || $productId === null || $productId < 1) {
        http_response_code(400);
        exit('Invalid product.');
    }

    if ($action === 'remove') {
        unset($_SESSION['cart'][$productId]);
    } else {
        $quantity = filter_var($_POST['quantity'] ?? 1, FILTER_VALIDATE_INT);
        if ($quantity === false || $quantity < 1 || $quantity > 20) {
            http_response_code(400);
            exit('Quantity must be a whole number from 1 to 20.');
        }

        $stmt = $pdo->prepare('SELECT id FROM products WHERE id = ?');
        $stmt->execute([$productId]);
        if (!$stmt->fetch()) {
            http_response_code(404);
            exit('Product not found.');
        }

        if ($action === 'add') {
            $currentQuantity = $_SESSION['cart'][$productId] ?? 0;
            $_SESSION['cart'][$productId] = min(20, $currentQuantity + $quantity);
        } else {
            $_SESSION['cart'][$productId] = $quantity;
        }
    }
}

header('Location: ' . $redirect, true, 303);
exit;
