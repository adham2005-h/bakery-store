<?php
require 'includes/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $pdo->prepare("SELECT p.*, c.name AS category_name FROM products p JOIN categories c ON p.category_id = c.id WHERE p.id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    header('Location: products.php');
    exit;
}

$pageTitle = $product['name'];

$relatedStmt = $pdo->prepare("SELECT * FROM products WHERE category_id = ? AND id != ? LIMIT 3");
$relatedStmt->execute([$product['category_id'], $product['id']]);
$related = $relatedStmt->fetchAll();

include 'includes/header.php';
?>

<section class="section product-details">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.php">الرئيسية</a> /
            <a href="products.php">المنتجات</a> /
            <span><?php echo htmlspecialchars($product['name']); ?></span>
        </div>

        <div class="product-detail-grid">
            <div class="product-detail-image">
                <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
            </div>
            <div class="product-detail-info">
                <span class="category-tag"><?php echo htmlspecialchars($product['category_name']); ?></span>
                <h1><?php echo htmlspecialchars($product['name']); ?></h1>
                <p class="product-detail-price"><?php echo number_format($product['price'], 2); ?> ₪</p>
                <p class="product-description"><?php echo htmlspecialchars($product['description']); ?></p>

                <div class="ingredients-box">
                    <h3>المكونات الأساسية</h3>
                    <p><?php echo htmlspecialchars($product['ingredients']); ?></p>
                </div>

                <form action="cart_action.php" method="POST" class="add-to-cart-form">
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <input type="hidden" name="redirect" value="product.php?id=<?php echo $product['id']; ?>">
                    <div class="quantity-control">
                        <button type="button" class="qty-btn" id="qtyMinus">-</button>
                        <input type="number" name="quantity" id="qtyInput" value="1" min="1" max="20">
                        <button type="button" class="qty-btn" id="qtyPlus">+</button>
                    </div>
                    <button type="submit" class="btn btn-primary">أضف إلى السلة</button>
                </form>
            </div>
        </div>

        <?php if (count($related) > 0): ?>
        <div class="related-products">
            <h2 class="section-title">قد يعجبك أيضاً</h2>
            <div class="products-grid">
                <?php foreach ($related as $item): ?>
                <div class="product-card">
                    <a href="product.php?id=<?php echo $item['id']; ?>" class="product-image">
                        <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" loading="lazy">
                    </a>
                    <div class="product-info">
                        <h3><a href="product.php?id=<?php echo $item['id']; ?>"><?php echo htmlspecialchars($item['name']); ?></a></h3>
                        <p class="product-price"><?php echo number_format($item['price'], 2); ?> ₪</p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
