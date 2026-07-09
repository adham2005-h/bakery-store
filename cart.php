<?php
require 'includes/db.php';

$pageTitle = 'سلة المشتريات';

$cartItems = [];
$total = 0;

if (count($_SESSION['cart']) > 0) {
    $ids = array_keys($_SESSION['cart']);
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
    $stmt->execute($ids);
    $products = $stmt->fetchAll();

    foreach ($products as $product) {
        $qty = $_SESSION['cart'][$product['id']];
        $subtotal = $product['price'] * $qty;
        $total += $subtotal;
        $cartItems[] = [
            'product' => $product,
            'qty' => $qty,
            'subtotal' => $subtotal
        ];
    }
}

include 'includes/header.php';
?>

<section class="page-banner">
    <div class="container">
        <h1>سلة المشتريات</h1>
    </div>
</section>

<section class="section">
    <div class="container">
        <?php if (count($cartItems) === 0): ?>
        <div class="empty-cart">
            <p>سلتك فارغة حالياً.</p>
            <a href="products.php" class="btn btn-primary">تصفح المنتجات</a>
        </div>
        <?php else: ?>
        <div class="cart-table">
            <?php foreach ($cartItems as $item): ?>
            <div class="cart-row">
                <img src="<?php echo htmlspecialchars($item['product']['image_url']); ?>" alt="<?php echo htmlspecialchars($item['product']['name']); ?>" class="cart-thumb">
                <div class="cart-row-info">
                    <h3><?php echo htmlspecialchars($item['product']['name']); ?></h3>
                    <p><?php echo number_format($item['product']['price'], 2); ?> ₪</p>
                </div>
                <form action="cart_action.php" method="POST" class="cart-qty-form">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="product_id" value="<?php echo $item['product']['id']; ?>">
                    <input type="number" name="quantity" value="<?php echo $item['qty']; ?>" min="1" max="20">
                    <button type="submit" class="btn btn-outline btn-small">تحديث</button>
                </form>
                <p class="cart-subtotal"><?php echo number_format($item['subtotal'], 2); ?> ₪</p>
                <form action="cart_action.php" method="POST">
                    <input type="hidden" name="action" value="remove">
                    <input type="hidden" name="product_id" value="<?php echo $item['product']['id']; ?>">
                    <button type="submit" class="remove-btn" aria-label="حذف">✕</button>
                </form>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="cart-summary">
            <h2>الإجمالي: <?php echo number_format($total, 2); ?> ₪</h2>
            <div class="cart-actions">
                <form action="cart_action.php" method="POST">
                    <input type="hidden" name="action" value="clear">
                    <button type="submit" class="btn btn-outline">إفراغ السلة</button>
                </form>
                <button type="button" class="btn btn-primary" onclick="alert('تم تأكيد الطلب، شكراً لك!')">إتمام الطلب</button>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
