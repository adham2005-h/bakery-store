<?php
require 'includes/db.php';

$pageTitle = 'المنتجات';

$categories = $pdo->query("SELECT * FROM categories")->fetchAll();

$selectedSlug = isset($_GET['category']) ? $_GET['category'] : '';

if ($selectedSlug !== '') {
    $stmt = $pdo->prepare("SELECT p.* FROM products p JOIN categories c ON p.category_id = c.id WHERE c.slug = ?");
    $stmt->execute([$selectedSlug]);
    $products = $stmt->fetchAll();
} else {
    $products = $pdo->query("SELECT * FROM products")->fetchAll();
}

include 'includes/header.php';
?>

<section class="page-banner">
    <div class="container">
        <h1>منتجاتنا</h1>
        <p>تشكيلة متنوعة من الحلويات والمخبوزات الطازجة</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="filter-bar">
            <a href="products.php" class="filter-chip <?php echo $selectedSlug === '' ? 'active' : ''; ?>">الكل</a>
            <?php foreach ($categories as $cat): ?>
            <a href="products.php?category=<?php echo urlencode($cat['slug']); ?>" class="filter-chip <?php echo $selectedSlug === $cat['slug'] ? 'active' : ''; ?>">
                <?php echo htmlspecialchars($cat['name']); ?>
            </a>
            <?php endforeach; ?>
        </div>

        <?php if (count($products) === 0): ?>
        <p class="empty-state">لا توجد منتجات في هذه الفئة حالياً.</p>
        <?php else: ?>
        <div class="products-grid">
            <?php foreach ($products as $product): ?>
            <div class="product-card">
                <a href="product.php?id=<?php echo $product['id']; ?>" class="product-image">
                    <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" loading="lazy">
                    <?php if ($product['is_best_seller']): ?>
                    <span class="badge">الأكثر مبيعاً</span>
                    <?php endif; ?>
                </a>
                <div class="product-info">
                    <h3><a href="product.php?id=<?php echo $product['id']; ?>"><?php echo htmlspecialchars($product['name']); ?></a></h3>
                    <p class="product-price"><?php echo number_format($product['price'], 2); ?> ₪</p>
                    <form action="cart_action.php" method="POST">
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <input type="hidden" name="redirect" value="products.php<?php echo $selectedSlug !== '' ? '?category=' . urlencode($selectedSlug) : ''; ?>">
                        <button type="submit" class="btn btn-outline">أضف للسلة</button>
                    </form>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
