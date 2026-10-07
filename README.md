# Bakery & Sweets Store

A bakery storefront built with PHP and MySQL. I used database-backed product pages and a PHP session to manage the shopping cart.

## Features

- Browse products and view product details.
- Add products to the cart.
- Change quantities, remove items and empty the cart.
- Keep the cart available during the current session.

## What I practiced

PHP sessions, relational product data, PDO queries and cart interactions.

## Preview

This project requires PHP and MySQL. GitHub Pages cannot run its server-side code; follow the local setup below.

## Technologies

HTML, CSS, JavaScript, PHP and MySQL with PDO.

## Run locally

1. Place the project in your local server folder, such as XAMPP `htdocs` or WAMP `www`.
2. Start Apache and MySQL.
3. Import `database.sql` using phpMyAdmin to create the database, tables and sample data.
4. Review `includes/db.php`: database `bakery_store`, host `127.0.0.1`, port `3307`. Set the credentials and port to match your local environment.
5. Open the project folder through localhost, for example `http://localhost/bakery-store/index.php` if your folder is named `bakery-site`.

## Main files

`index.php`, `products.php`, `product.php`, `cart.php`, `cart_action.php`, `database.sql`, `includes/`, `css/` and `js/`.

## Project scope

The cart demonstrates storefront interactions; it does not process payments or submit real orders. Externally hosted images require an internet connection.

## Author

Adham Muayad Hashem
