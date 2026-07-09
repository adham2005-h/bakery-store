<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo isset($pageTitle) ? $pageTitle . ' | مخبز الدفء' : 'مخبز الدفء'; ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="site-header">
    <div class="container header-inner">
        <a href="index.php" class="logo">مخبز الدفء</a>
        <button class="menu-toggle" id="menuToggle" aria-label="القائمة">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <nav class="main-nav" id="mainNav">
            <a href="index.php">الرئيسية</a>
            <a href="products.php">المنتجات</a>
            <a href="cart.php" class="cart-link">
                السلة
                <span class="cart-badge"><?php echo getCartCount(); ?></span>
            </a>
        </nav>
    </div>
</header>
