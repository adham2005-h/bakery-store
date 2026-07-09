<?php
require 'includes/db.php';

$pageTitle = 'الرئيسية';

$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
$bestSellers = $pdo->query("SELECT * FROM products WHERE is_best_seller = 1 LIMIT 6")->fetchAll();

include 'includes/header.php';
?>

<section class="hero">
    <div class="hero-image">
        <img src="https://images.unsplash.com/photo-1517686469429-8bdb88b9f907?auto=format&fit=crop&w=1600&q=80" alt="مخبوزات طازجة">
    </div>
    <div class="container hero-content">
        <h1>خبز طازج، صنع بحب كل صباح</h1>
        <p>من الفرن إلى طاولتك، اكتشف أشهى الحلويات والمخبوزات التقليدية بلمسة عصرية.</p>
        <a href="products.php" class="btn btn-primary">تصفح المنتجات</a>
    </div>
</section>

<section class="section categories-section">
    <div class="container">
        <h2 class="section-title">تصفح حسب الفئة</h2>
        <div class="categories-grid">
            <?php foreach ($categories as $cat): ?>
            <a href="products.php?category=<?php echo urlencode($cat['slug']); ?>" class="category-card">
                <div class="category-icon">🥐</div>
                <span><?php echo htmlspecialchars($cat['name']); ?></span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section bestsellers-section">
    <div class="container">
        <h2 class="section-title">الأكثر مبيعاً</h2>
        <div class="products-grid">
            <?php foreach ($bestSellers as $product): ?>
            <div class="product-card">
                <a href="product.php?id=<?php echo $product['id']; ?>" class="product-image">
                    <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" loading="lazy">
                    <span class="badge">الأكثر مبيعاً</span>
                </a>
                <div class="product-info">
                    <h3><a href="product.php?id=<?php echo $product['id']; ?>"><?php echo htmlspecialchars($product['name']); ?></a></h3>
                    <p class="product-price"><?php echo number_format($product['price'], 2); ?> ₪</p>
                    <form action="cart_action.php" method="POST">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <input type="hidden" name="redirect" value="index.php">
                        <button type="submit" class="btn btn-outline">أضف للسلة</button>
                    </form>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
