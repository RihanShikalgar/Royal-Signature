# Royal Signature - Luxury Perfume E-Commerce Platform

A modern, fully-functional e-commerce website for luxury perfumes built with PHP, MySQL, HTML, CSS, and JavaScript.

## 🎯 Features

### User Management
✅ User Registration with email validation  
✅ Secure Login/Logout with session management  
✅ Password hashing using bcrypt  
✅ User profile information storage  

### Product Catalog
✅ Browse all products from database  
✅ Product details (name, price, brand, images)  
✅ Category-based organization  
✅ Stock management  

### Shopping Cart
✅ Add/remove products from cart  
✅ Update product quantities  
✅ Real-time total calculations  
✅ Discount application (10% off)  
✅ Session-based cart persistence  

### Order Management
✅ Place orders with shipping address  
✅ Order history tracking  
✅ Order items detail storage  
✅ Order status management  

### Customer Feedback
✅ Submit product feedback  
✅ Star rating system (1-5)  
✅ Feedback categorization  
✅ Email validation  

### Contact Form
✅ Contact message submissions  
✅ Message storage in database  
✅ Email validation  

## 📋 Tech Stack

**Frontend:**
- HTML5
- CSS3
- JavaScript (Vanilla)
- Bootstrap 5
- Lucide Icons
- Font Awesome Icons

**Backend:**
- PHP 7.2+
- MySQL 5.7+
- Apache/Nginx

## 🚀 Quick Start

### 1. Prerequisites
- PHP 7.2 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)
- XAMPP/WAMP/LAMP or similar environment

### 2. Installation

**Step 1: Clone or Download Repository**
```bash
# Download and extract to your web server root
# XAMPP: C:\xampp\htdocs\
# WAMP: C:\wamp\www\
# Linux: /var/www/html/
```

**Step 2: Create Database**
```bash
# Using phpMyAdmin: Import backend/db_schema.sql
# OR using command line:
mysql -u root -p < backend/db_schema.sql
```

**Step 3: Configure Database Connection**
Edit `backend/config.php`:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'your_password');
define('DB_NAME', 'royal_signature');
```

**Step 4: Start Server**
- Start Apache and MySQL services
- Navigate to: `http://localhost/Royal-Signature/login.html`

## 📁 Project Structure

```
Royal-Signature/
├── backend/
│   ├── config.php              # Database configuration
│   ├── login.php               # User login endpoint
│   ├── signup.php              # User registration endpoint
│   ├── logout.php              # Logout endpoint
│   ├── get_products.php        # Fetch products
│   ├── cart.php                # Cart operations
│   ├── place_order.php         # Order processing
│   ├── submit_feedback.php     # Feedback submission
│   ├── submit_contact.php      # Contact form handling
│   └── db_schema.sql           # Database structure
├── css/
│   ├── style.css               # Login page styling
│   ├── home.css                # Home page styling
│   ├── about.css               # About page styling
│   ├── brand.css               # Brands page styling
│   ├── cart.css                # Cart page styling
│   ├── contact.css             # Contact page styling
│   ├── feedback.css            # Feedback page styling
│   └── login.css               # Login form styling
├── js/
│   ├── script.js               # Login/auth logic
│   ├── cart.js                 # Cart functionality
│   └── utils.js                # Utility functions
├── img/                         # Images
├── icons/                       # Icon assets
├── video/                       # Video files
├── brands/                      # Brand-specific content
├── product/                     # Product pages
├── home.html                    # Homepage
├── login.html                   # Login page
├── index.html                   # Alternative login
├── about.html                   # About page
├── brands.html                  # Brands listing
├── cart.html                    # Shopping cart
├── contact.html                 # Contact form
├── feedback.html                # Feedback form
├── SETUP_GUIDE.md              # Installation guide
├── DATABASE_REFERENCE.md        # Database documentation
├── README.md                    # This file
└── .htaccess                   # Server configuration
```

## 🔐 Security Features

- **Password Security**: Bcrypt hashing for passwords
- **Input Validation**: All inputs sanitized and validated
- **Email Validation**: PHP filter_var() for email verification
- **Session Management**: Server-side session handling
- **SQL Injection Prevention**: Parameterized queries
- **CORS Configuration**: Proper header configuration
- **File Protection**: .htaccess prevents direct access to sensitive files

## 📡 API Endpoints

### Authentication
| Method | Endpoint | Purpose |
|--------|----------|---------|
| POST | `/backend/login.php` | User login |
| POST | `/backend/signup.php` | User registration |
| POST | `/backend/logout.php` | User logout |

### Products
| Method | Endpoint | Purpose |
|--------|----------|---------|
| GET | `/backend/get_products.php` | Fetch all products |

### Shopping Cart
| Method | Endpoint | Query | Purpose |
|--------|----------|-------|---------|
| POST | `/backend/cart.php` | action=add | Add to cart |
| POST | `/backend/cart.php` | action=remove | Remove from cart |
| POST | `/backend/cart.php` | action=update | Update quantity |
| POST | `/backend/cart.php` | action=get | Get cart items |
| POST | `/backend/cart.php` | action=clear | Clear cart |

### Orders
| Method | Endpoint | Purpose |
|--------|----------|---------|
| POST | `/backend/place_order.php` | Place order |

### Forms
| Method | Endpoint | Purpose |
|--------|----------|---------|
| POST | `/backend/submit_feedback.php` | Submit feedback |
| POST | `/backend/submit_contact.php` | Submit contact |

## 💾 Database Tables

### Users
- User account information
- Login credentials (hashed)
- Profile data

### Products
- Product catalog
- Pricing and inventory
- Images and descriptions

### Cart
- User shopping cart items
- Quantities and timestamps

### Orders
- Order history
- Order status tracking
- Shipping information

### Order Items
- Line items for each order
- Price snapshot at purchase time

### Feedback
- Customer reviews and ratings
- Feedback categorization

### Contact Messages
- Customer inquiries
- Support requests

## 🎨 Pages Overview

### Login Page (index.html / login.html)
- User registration and login
- Password visibility toggle
- Form validation

### Home Page (home.html)
- Hero section with call-to-action
- Featured products carousel
- Features showcase
- Product grid with database integration

### About Page (about.html)
- Company information
- Brand story and values
- Video introduction

### Brands Page (brands.html)
- Available brand listings
- Product cards with pricing
- Dynamic product loading

### Product Pages (product/*/**.html)
- Individual product details
- High-quality images
- Detailed descriptions
- Add to cart functionality

### Shopping Cart (cart.html)
- View cart items
- Adjust quantities
- Apply discounts
- Checkout with order placement

### Contact Page (contact.html)
- Contact form
- Business information
- Contact details

### Feedback Page (feedback.html)
- Feedback submission form
- Star rating system
- Feedback type selection
- Customer feedback carousel

## 📱 Responsive Design

- Mobile-first approach
- Bootstrap 5 integration
- Flexible grid layouts
- Responsive images
- Touch-friendly buttons

## 🔧 Configuration

### Database Configuration
Edit `backend/config.php`:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'royal_signature');
```

### PHP Settings
Ensure these are enabled in `php.ini`:
- `session.use_cookies = 1`
- `session.use_only_cookies = 1`
- `mysqli.default_socket` (if needed)

## 🐛 Troubleshooting

### Database Connection Error
```
Check:
1. MySQL service is running
2. Credentials in config.php are correct
3. Database 'royal_signature' exists
```

### Login Not Working
```
Check:
1. Passwords match (case-sensitive)
2. User account exists in database
3. Browser allows cookies
4. Check browser console for errors
```

### Cart Not Persisting
```
Check:
1. User is logged in
2. Session cookies enabled
3. JavaScript enabled in browser
4. Check network requests in DevTools
```

### Images Not Displaying
```
Check:
1. Image paths are correct
2. Image files exist
3. File permissions are readable
4. Image URLs in database are correct
```

## 📊 Sample Data

The database comes with sample products:
- Royal Oud - ₹15,999
- Crown Jasmine - ₹12,999
- Imperial Rose - ₹13,999
- Noble Legacy - ₹14,999
- Sultan Gold - ₹16,999
- Mirage Dreams - ₹11,999

## 🚀 Future Enhancements

- [ ] Product search functionality
- [ ] Advanced filtering and sorting
- [ ] Product recommendations
- [ ] Email notifications
- [ ] Payment gateway integration
- [ ] Admin dashboard
- [ ] Inventory management system
- [ ] User reviews and ratings
- [ ] Wishlist functionality
- [ ] Multiple payment methods
- [ ] Order tracking system
- [ ] Live chat support

## 📞 Support

For issues or questions, refer to:
1. `SETUP_GUIDE.md` - Installation and setup
2. `DATABASE_REFERENCE.md` - Database structure
3. Browser Developer Tools - JavaScript errors
4. PHP error logs - Backend issues

## 📄 License

Royal Signature © 2024 - All Rights Reserved

## 👥 Credits

**Development**: Royal Signature Development Team  
**Last Updated**: January 2, 2026  
**Version**: 1.0.0

---

**Note**: This is a development version. Before deploying to production:
- Update database credentials
- Enable HTTPS
- Configure email settings
- Set up proper error logging
- Run security audits
- Implement automated backups

