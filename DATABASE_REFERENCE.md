# Database Structure Reference

## Table: users
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100),
    phone VARCHAR(20),
    address VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

**Fields:**
- `id`: Unique user identifier
- `username`: Unique login username
- `email`: Unique email address
- `password`: Hashed password (bcrypt)
- `full_name`: User's full name (optional)
- `phone`: Contact phone number (optional)
- `address`: Shipping address (optional)

---

## Table: products
```sql
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    brand VARCHAR(100),
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    image_url VARCHAR(255),
    category VARCHAR(50),
    stock INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

**Fields:**
- `id`: Product identifier
- `name`: Product name
- `brand`: Brand name
- `description`: Detailed product description
- `price`: Product price (format: 0000.00)
- `image_url`: Path to product image
- `category`: Product category (Luxury, Premium, etc.)
- `stock`: Available quantity

---

## Table: cart
```sql
CREATE TABLE cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT DEFAULT 1,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_product (user_id, product_id)
);
```

**Fields:**
- `id`: Cart item identifier
- `user_id`: Reference to users table
- `product_id`: Reference to products table
- `quantity`: Number of items in cart
- `added_at`: When item was added

---

## Table: orders
```sql
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total_amount DECIMAL(10, 2) NOT NULL,
    status VARCHAR(50) DEFAULT 'pending',
    shipping_address VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

**Fields:**
- `id`: Order identifier
- `user_id`: Reference to users table
- `order_date`: When order was placed
- `total_amount`: Total order amount
- `status`: Order status (pending, confirmed, shipped, delivered, cancelled)
- `shipping_address`: Delivery address

---

## Table: order_items
```sql
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id)
);
```

**Fields:**
- `id`: Order item identifier
- `order_id`: Reference to orders table
- `product_id`: Reference to products table
- `quantity`: Number of items ordered
- `price`: Price at time of purchase

---

## Table: feedback
```sql
CREATE TABLE feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    name VARCHAR(100),
    email VARCHAR(100),
    rating INT,
    feedback_type VARCHAR(50),
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);
```

**Fields:**
- `id`: Feedback identifier
- `user_id`: Reference to users table (can be NULL for guest feedback)
- `name`: Feedback submitter's name
- `email`: Feedback submitter's email
- `rating`: Rating (1-5 stars)
- `feedback_type`: Type of feedback (product, website, service, other)
- `message`: Feedback message/content
- `created_at`: When feedback was submitted

---

## Table: contact_messages
```sql
CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

**Fields:**
- `id`: Message identifier
- `name`: Sender's name
- `email`: Sender's email
- `message`: Message content
- `created_at`: When message was sent

---

## Relationships

```
users
├── cart (one-to-many)
├── orders (one-to-many)
│   └── order_items (one-to-many)
│       └── products
└── feedback (one-to-many, nullable)

products
├── cart (one-to-many)
├── order_items (one-to-many)
└── feedback (referenced in messages)
```

## Sample Insert Queries

### Insert Sample Product
```sql
INSERT INTO products (name, brand, description, price, image_url, category, stock) 
VALUES ('Royal Oud', 'Royal Signature', 'Premium oud perfume', 15999.00, '/path/to/image.png', 'Luxury', 50);
```

### Insert Sample User
```sql
INSERT INTO users (username, email, password, full_name, phone, address) 
VALUES ('johndoe', 'john@example.com', '$2y$10$...hashed...', 'John Doe', '9876543210', '123 Street, City');
```

### Insert Cart Item
```sql
INSERT INTO cart (user_id, product_id, quantity) 
VALUES (1, 1, 2);
```

## Common Queries

### Get User's Cart with Product Details
```sql
SELECT c.id, p.id as product_id, p.name, p.price, p.image_url, c.quantity 
FROM cart c 
JOIN products p ON c.product_id = p.id 
WHERE c.user_id = 1;
```

### Get Order Details with Items
```sql
SELECT o.id, o.order_date, o.total_amount, o.status,
       oi.product_id, oi.quantity, oi.price, p.name
FROM orders o
JOIN order_items oi ON o.id = oi.order_id
JOIN products p ON oi.product_id = p.id
WHERE o.id = 1;
```

### Get All Feedback with Ratings
```sql
SELECT id, name, email, rating, feedback_type, message, created_at
FROM feedback
ORDER BY created_at DESC;
```

