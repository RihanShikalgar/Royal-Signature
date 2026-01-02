# Quick Database Reference

## 🚀 Quick Commands

### Import Database
```bash
# Using Command Line
mysql -u root -p royal_signature < backend/db_schema.sql

# OR using phpMyAdmin
1. Go to http://localhost/phpmyadmin
2. Create new database: royal_signature
3. Go to Import tab
4. Select backend/db_schema.sql
5. Click Go
```

### Connection String (PHP)
```php
$conn = new mysqli("localhost", "root", "", "royal_signature");
```

---

## 📊 All Tables at a Glance

### users
| Field | Type | Key |
|-------|------|-----|
| id | INT | PK |
| username | VARCHAR(50) | UNIQUE |
| email | VARCHAR(100) | UNIQUE |
| password | VARCHAR(255) | - |
| full_name | VARCHAR(100) | - |
| phone | VARCHAR(20) | - |
| address | VARCHAR(255) | - |

### products
| Field | Type | Key |
|-------|------|-----|
| id | INT | PK |
| name | VARCHAR(100) | - |
| brand | VARCHAR(100) | - |
| price | DECIMAL(10,2) | - |
| image_url | VARCHAR(255) | - |
| category | VARCHAR(50) | - |
| stock | INT | - |

### cart
| Field | Type | Key |
|-------|------|-----|
| id | INT | PK |
| user_id | INT | FK→users |
| product_id | INT | FK→products |
| quantity | INT | - |

### orders
| Field | Type | Key |
|-------|------|-----|
| id | INT | PK |
| user_id | INT | FK→users |
| order_date | TIMESTAMP | - |
| total_amount | DECIMAL(10,2) | - |
| status | VARCHAR(50) | - |
| shipping_address | VARCHAR(255) | - |

### order_items
| Field | Type | Key |
|-------|------|-----|
| id | INT | PK |
| order_id | INT | FK→orders |
| product_id | INT | FK→products |
| quantity | INT | - |
| price | DECIMAL(10,2) | - |

### feedback
| Field | Type | Key |
|-------|------|-----|
| id | INT | PK |
| user_id | INT | FK→users |
| name | VARCHAR(100) | - |
| email | VARCHAR(100) | - |
| rating | INT | - |
| feedback_type | VARCHAR(50) | - |
| message | TEXT | - |

### contact_messages
| Field | Type | Key |
|-------|------|-----|
| id | INT | PK |
| name | VARCHAR(100) | - |
| email | VARCHAR(100) | - |
| message | TEXT | - |

---

## 🔍 Sample Queries

### Get all products
```sql
SELECT * FROM products;
```

### Get user's cart with details
```sql
SELECT p.name, p.price, c.quantity, (p.price * c.quantity) as total
FROM cart c
JOIN products p ON c.product_id = p.id
WHERE c.user_id = 1;
```

### Get recent orders
```sql
SELECT * FROM orders
ORDER BY order_date DESC
LIMIT 10;
```

### Get specific user orders
```sql
SELECT o.id, o.order_date, o.total_amount, o.status
FROM orders o
WHERE o.user_id = 1
ORDER BY o.order_date DESC;
```

### Get all feedback
```sql
SELECT name, email, rating, feedback_type, message
FROM feedback
ORDER BY created_at DESC;
```

### Count products by category
```sql
SELECT category, COUNT(*) as count
FROM products
GROUP BY category;
```

### Get most expensive products
```sql
SELECT name, price FROM products
ORDER BY price DESC
LIMIT 10;
```

---

## 🔐 Useful Admin Queries

### Backup data (export)
```bash
mysqldump -u root -p royal_signature > backup.sql
```

### View all users
```sql
SELECT id, username, email, created_at FROM users;
```

### Reset password (for emergency)
```sql
UPDATE users 
SET password = '$2y$10$...' 
WHERE id = 1;
```

### Delete user and all related data
```sql
DELETE FROM users WHERE id = 1;
-- Cascade will delete cart, orders, feedback
```

### Check total orders revenue
```sql
SELECT SUM(total_amount) as total_revenue FROM orders;
```

### Check average rating
```sql
SELECT AVG(rating) as avg_rating FROM feedback;
```

---

## 📈 Database Statistics

### Current Data
```
Users: (Created by signup)
Products: 6 sample products
Orders: (Created during checkout)
Feedback: (Submitted by users)
```

### Database Size (Approx)
```
Empty database: ~50 KB
With 100 orders: ~200 KB
With 1000 orders: ~1 MB
```

---

## 🛡️ Backup & Recovery

### Backup (Regular)
```bash
# Full backup
mysqldump -u root -p royal_signature > backup_$(date +%Y%m%d).sql

# Backup specific table
mysqldump -u root -p royal_signature users > users_backup.sql
```

### Restore
```bash
mysql -u root -p royal_signature < backup.sql
```

### Backup Using phpMyAdmin
```
1. Go to database
2. Click Export
3. Choose SQL format
4. Click Go
```

---

## 🔧 Maintenance Commands

### Check database integrity
```sql
CHECK TABLE users;
CHECK TABLE products;
CHECK TABLE orders;
```

### Optimize tables
```sql
OPTIMIZE TABLE users;
OPTIMIZE TABLE products;
OPTIMIZE TABLE orders;
```

### Remove old data
```sql
DELETE FROM contact_messages WHERE created_at < DATE_SUB(NOW(), INTERVAL 90 DAY);
DELETE FROM feedback WHERE created_at < DATE_SUB(NOW(), INTERVAL 180 DAY);
```

---

## 📱 Quick Config Values

### Database
```
Host: localhost
User: root
Password: (empty by default)
Database: royal_signature
Port: 3306
```

### File Paths
```
Database Schema: backend/db_schema.sql
Config: backend/config.php
```

---

## ❓ Common Issues & Solutions

### Issue: Database not found
```sql
-- Create it
CREATE DATABASE royal_signature;
-- Then import schema
USE royal_signature;
-- Import db_schema.sql
```

### Issue: Connection refused
```
Solutions:
1. Start MySQL service
2. Check credentials in config.php
3. Verify host is correct (usually localhost)
```

### Issue: Corrupted database
```
Solution:
1. Restore from backup
2. Or drop and recreate with db_schema.sql
```

### Issue: Too many connections
```
Solution:
1. Check config.php for connection leaks
2. Ensure connections are closed
3. Increase max_connections if needed
```

---

## 💡 Performance Tips

1. **Use Indexes** - Already configured for user_id, product_id
2. **Limit Results** - Use LIMIT clause for large tables
3. **Regular Backups** - Daily automatic backups recommended
4. **Archive Old Data** - Move old orders to archive table
5. **Monitor Size** - Check database size monthly

---

## 📊 Database Relationships

```
users ──┬──→ cart ──→ products
        ├──→ orders ──→ order_items ──→ products
        └──→ feedback

cart & orders both reference products
orders reference users
feedback references users (optional)
```

---

## ✅ Verification Query

Run this to verify all tables are created:

```sql
SELECT table_name FROM information_schema.tables 
WHERE table_schema = 'royal_signature';
```

Should show:
```
cart
contact_messages
feedback
order_items
orders
products
users
```

---

## 🚀 Ready to Use

Database is pre-configured with:
- ✅ All tables created
- ✅ All indexes created
- ✅ All relationships set up
- ✅ Sample products loaded
- ✅ Ready for user data

Just import and start using!

