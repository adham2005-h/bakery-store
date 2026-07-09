# مخبز الدفء - Bakery & Sweets Store

## التقنيات المستخدمة
HTML5, CSS3, JavaScript (Vanilla), PHP, MySQL (PDO)

## خطوات التشغيل

1. ضع مجلد المشروع داخل مجلد السيرفر المحلي (مثال: `htdocs` في XAMPP أو `www` في WAMP).
2. شغّل خادم Apache و MySQL من لوحة تحكم XAMPP/WAMP.
3. افتح phpMyAdmin وأنشئ قاعدة بيانات جديدة أو استورد الملف `database.sql` مباشرة (سينشئ قاعدة البيانات والجداول والبيانات تلقائياً).
4. تحقق من إعدادات الاتصال في `includes/db.php`:
   - `host`: localhost
   - `dbname`: bakery_store
   - `username`: root
   - `password`: (فارغة افتراضياً في XAMPP)
5. افتح المتصفح على: `http://localhost/bakery-site/index.php`

## هيكلية المشروع

```
bakery-site/
├── database.sql
├── index.php
├── products.php
├── product.php
├── cart.php
├── cart_action.php
├── includes/
│   ├── db.php
│   ├── header.php
│   └── footer.php
├── css/
│   └── style.css
└── js/
    └── main.js
```

## ملاحظات
- سلة المشتريات تعتمد على PHP Session، لذا تبقى محفوظة أثناء تصفح الموقع حتى إغلاق المتصفح أو إفراغها يدوياً.
- الصور مأخوذة من روابط Unsplash مباشرة، لذا يجب توفر اتصال بالإنترنت لعرضها.
