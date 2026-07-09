CREATE DATABASE IF NOT EXISTS bakery_store CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE bakery_store;

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    name VARCHAR(150) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image_url VARCHAR(500) NOT NULL,
    description TEXT,
    ingredients TEXT,
    is_best_seller TINYINT(1) DEFAULT 0,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

INSERT INTO categories (name, slug) VALUES
('كيك', 'cakes'),
('معجنات', 'pastries'),
('حلويات شرقية', 'middle-eastern'),
('كوكيز', 'cookies'),
('مخبوزات', 'breads');

INSERT INTO products (category_id, name, price, image_url, description, ingredients, is_best_seller) VALUES
(1, 'كيك الشوكولاتة الفاخر', 85.00, 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?auto=format&fit=crop&w=800&q=80', 'كيك شوكولاتة غني بطبقات متعددة وصوص شوكولاتة ذائب من الداخل.', 'طحين، كاكاو، زبدة، بيض، سكر، شوكولاتة داكنة', 1),
(1, 'كيك التوت والفانيليا', 78.00, 'https://images.unsplash.com/photo-1587244015940-8dee79e6b0d5?auto=format&fit=crop&w=800&q=80', 'كيك إسفنجي خفيف بنكهة الفانيليا الطبيعية مزين بالتوت الطازج.', 'طحين، فانيليا، توت طازج، كريمة، سكر', 0),
(1, 'شريحة كيك الكراميل', 32.00, 'https://images.unsplash.com/photo-1509365465985-25d11c17e812?auto=format&fit=crop&w=800&q=80', 'شريحة كيك بطبقة كراميل غنية وقوام طري.', 'طحين، كراميل، زبدة، حليب مكثف', 0),
(2, 'كرواسون بالزبدة', 15.00, 'https://images.unsplash.com/photo-1490559853860-56b5dbe08986?auto=format&fit=crop&w=800&q=80', 'كرواسون فرنسي أصلي مقرمش من الخارج وطري من الداخل.', 'طحين، زبدة فرنسية، خميرة، ملح', 1),
(2, 'معجنات الجبنة', 12.00, 'https://images.unsplash.com/photo-1555507036-ab1f4038808a?auto=format&fit=crop&w=800&q=80', 'عجينة مورقة محشوة بخليط الجبنة الطازجة.', 'طحين، جبنة بيضاء، زبدة، بيض', 0),
(2, 'دونات مزجج', 10.00, 'https://images.unsplash.com/photo-1551024506-0bccd828d307?auto=format&fit=crop&w=800&q=80', 'دونات طرية مغطاة بطبقة سكر مزجج لامعة.', 'طحين، سكر، خميرة، حليب', 1),
(3, 'بقلاوة بالفستق', 20.00, 'https://images.unsplash.com/photo-1615887101840-4cdb18d8bb95?auto=format&fit=crop&w=800&q=80', 'بقلاوة تقليدية بطبقات رقيقة من العجين وحشوة الفستق الحلبي.', 'عجين فيلو، فستق حلبي، سمن، قطر', 1),
(3, 'كنافة نابلسية', 25.00, 'https://images.unsplash.com/photo-1601315379461-01ed7c98a344?auto=format&fit=crop&w=800&q=80', 'كنافة نابلسية أصيلة بجبنة طرية وقطر عربي.', 'جبنة نابلسية، سميد، قطر، سمن', 1),
(3, 'معمول بالتمر', 18.00, 'https://images.unsplash.com/photo-1606313564200-e75d5e30476c?auto=format&fit=crop&w=800&q=80', 'معمول طري محشو بعجينة التمر الفاخرة.', 'سميد، تمر، سمن، ماء ورد', 0),
(4, 'كوكيز الشوكولاتة', 14.00, 'https://images.unsplash.com/photo-1499636136210-6f4ee915583e?auto=format&fit=crop&w=800&q=80', 'كوكيز مقرمش من الخارج وطري من الداخل مليء بقطع الشوكولاتة.', 'طحين، زبدة، شوكولاتة، سكر بني', 1),
(4, 'ماكارون فرنسي', 22.00, 'https://images.unsplash.com/photo-1569864358642-9d1684040f43?auto=format&fit=crop&w=800&q=80', 'ماكارون فرنسي بألوان زاهية ونكهات متعددة.', 'بياض بيض، لوز مطحون، سكر بودرة', 0),
(5, 'خبز الحبوب الكاملة', 12.00, 'https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=800&q=80', 'خبز صحي مصنوع من الحبوب الكاملة والبذور الطبيعية.', 'دقيق قمح كامل، بذور شيا، خميرة، ماء', 0),
(5, 'باغيت فرنسي', 9.00, 'https://images.unsplash.com/photo-1608198093002-ad4e005484ec?auto=format&fit=crop&w=800&q=80', 'باغيت فرنسي تقليدي بقشرة مقرمشة وقلب طري.', 'طحين، ماء، خميرة، ملح', 0),
(5, 'خبز الزيتون والأعشاب', 14.00, 'https://images.unsplash.com/photo-1585478259715-4d3a5f3e9d9e?auto=format&fit=crop&w=800&q=80', 'خبز طري منقوع بزيت الزيتون ومنكه بالأعشاب الطازجة.', 'طحين، زيت زيتون، زعتر، زيتون', 0);
