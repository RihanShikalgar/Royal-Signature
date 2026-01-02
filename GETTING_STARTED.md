# 🌟 Royal Signature - Dynamic E-Commerce Platform

> **Your static website has been transformed into a fully dynamic, database-driven e-commerce platform!**

## 📋 What Changed

### Before (Static)
- HTML pages with hardcoded content
- No user authentication
- No shopping cart functionality
- No database backend
- Manual product management

### After (Dynamic) ✨
- PHP-powered pages with dynamic content
- Complete user authentication system
- Full shopping cart with database persistence
- MySQL database backend
- Real-time product management
- Order tracking system
- User profile management
- Feedback & contact systems

---

## 🚀 Quick Start

### **Fastest Way to Start (2 minutes)**

1. **Double-click:** `START_SERVER.bat` in the Royal-Signature folder
2. **Wait:** Until you see "Listening on http://localhost:8080"
3. **Open:** http://localhost:8080
4. **Login with:** 
   - Username: `testuser`
   - Password: `password123`

### **Or Using XAMPP**

1. Start Apache & MySQL from XAMPP Control Panel
2. Navigate to: http://localhost/Royal-Signature/
3. Click "Status" link to verify everything is working

---

## ✅ Complete Feature List

### 🔐 Authentication
- [x] User registration with validation
- [x] Secure login with password hashing (bcrypt)
- [x] Session management
- [x] Password recovery ready
- [x] Logout functionality

### 📦 Products & Catalog
- [x] Dynamic product listings from database
- [x] Product search functionality
- [x] Category filtering
- [x] Detailed product pages
- [x] Stock management
- [x] Related products suggestions
- [x] Brand filtering

### 🛒 Shopping Cart
- [x] Add products to cart
- [x] Update quantities
- [x] Remove items
- [x] Real-time cart total calculation
- [x] Database persistence per user
- [x] Cart badge in navigation

### 📦 Orders
- [x] Place orders from cart
- [x] Order confirmation
- [x] Order history tracking
- [x] Order details view
- [x] Shipping address management
- [x] Automatic inventory tracking

### 👤 User Management
- [x] User profile page
- [x] Edit personal information
- [x] Change password
- [x] View profile info
- [x] Address/contact management

### 💬 Customer Engagement
- [x] Feedback submission form
- [x] 5-star rating system
- [x] Feedback categorization
- [x] Contact form
- [x] Message storage & tracking

### 🎨 User Experience
- [x] Responsive Bootstrap 5 design
- [x] Mobile-friendly interface
- [x] Session-aware navigation
- [x] User dropdown menu
- [x] Shopping cart badge
- [x] Error/success messages
- [x] Intuitive product browsing

---

## 📁 Project Structure

```
Royal-Signature/
│
├── 📄 index.php                    # Main login/signup page
├── 📄 status.php                   # System status check
├── 🎯 START_SERVER.bat             # Quick server launcher
│
├── 📂 pages/ (All user-facing pages)
│   ├── home.php                    # Dashboard after login
│   ├── products.php                # Product listing
│   ├── product-detail.php          # Single product view
│   ├── cart.php                    # Shopping cart
│   ├── orders.php                  # Order history
│   ├── order-detail.php            # Order details
│   ├── profile.php                 # User profile
│   ├── about.php                   # About page
│   ├── brands.php                  # Brands listing
│   ├── contact.php                 # Contact form
│   └── feedback.php                # Feedback form
│
├── 📂 backend/ (Server logic)
│   ├── config.php                  # Database connection
│   ├── db_schema.sql               # Database schema
│   ├── login.php                   # Login handler
│   ├── signup.php                  # Registration handler
│   ├── logout.php                  # Logout handler
│   ├── add-to-cart.php             # Add to cart API
│   ├── update-cart.php             # Update cart API
│   ├── remove-from-cart.php        # Remove from cart API
│   ├── place-order.php             # Order processing
│   ├── submit-contact.php          # Contact form handler
│   ├── submit-feedback.php         # Feedback handler
│   ├── update-profile.php          # Profile update
│   └── change-password.php         # Password change
│
├── 📂 includes/ (Reusable templates)
│   ├── header.php                  # Navigation bar
│   └── footer.php                  # Footer template
│
├── 📂 css/                         # Stylesheets
├── 📂 js/                          # JavaScript files
├── 📂 img/                         # Images
├── 📂 brands/                      # Brand folders
├── 📂 video/                       # Videos
│
└── 📚 Documentation
    ├── README.md                   # Original project info
    ├── QUICK_START.md              # This file
    ├── DYNAMIC_CONVERSION_SUMMARY.md  # Detailed changes
    └── COMPLETION_CHECKLIST.md     # Feature checklist
```

---

## 🗄️ Database Schema

### Tables Created Automatically

1. **users** - User accounts & profiles
   - id, username, email, password, full_name, phone, address, created_at

2. **products** - Product catalog (6 samples included)
   - id, name, brand, description, price, image_url, category, stock

3. **cart** - Shopping cart items
   - id, user_id, product_id, quantity, added_at

4. **orders** - Customer orders
   - id, user_id, order_date, total_amount, status, shipping_address

5. **order_items** - Order line items
   - id, order_id, product_id, quantity, price

6. **feedback** - Customer feedback
   - id, user_id, name, email, rating, feedback_type, message

7. **contact_messages** - Contact form submissions
   - id, name, email, message, created_at

---

## 🔒 Security Features Implemented

✅ **Input Sanitization** - All user inputs are cleaned  
✅ **Password Hashing** - Uses bcrypt encryption  
✅ **SQL Injection Protection** - Safe queries with escaping  
✅ **Email Validation** - Checks email format  
✅ **Session-based Auth** - Secure session management  
✅ **HTTPS Ready** - Can be deployed with SSL  

---

## 🧪 Test Credentials

```
Username: testuser
Password: password123
Email:    test@example.com
```

**Or create your own account:**
1. Click "Sign Up" on login page
2. Fill in all required fields
3. Click "Create Account"
4. You'll be logged in immediately

---

## 💻 Technical Stack

| Component | Technology | Version |
|-----------|-----------|---------|
| Frontend | HTML5, CSS3, JavaScript | ES6+ |
| Framework | Bootstrap | 5.3.0 |
| Backend | PHP | 7.4+ |
| Database | MySQL/MariaDB | 10.4+ |
| Icons | Font Awesome | 6.4.2 |

---

## 🎯 How to Use the Website

### As a Customer

1. **Sign Up/Login**
   - Create account or login with testuser/password123

2. **Browse Products**
   - Click "Products" to view all items
   - Search by name
   - Filter by category
   - Click product for details

3. **Shopping**
   - Click "Add to Cart"
   - Go to cart page
   - Update quantities if needed
   - Enter shipping address
   - Click "Place Order"

4. **Track Orders**
   - Go to "My Orders"
   - View order history
   - Click order for details

5. **Manage Profile**
   - Click username dropdown
   - Select "Profile"
   - Edit information
   - Change password

6. **Provide Feedback**
   - Click "Feedback" in header
   - Submit product feedback
   - Rate experience 1-5 stars

---

## 🔧 Customization Guide

### Add More Products to Database

```sql
INSERT INTO products (name, brand, description, price, image_url, category, stock)
VALUES ('Product Name', 'Brand', 'Description', 99.99, '/image.png', 'Luxury', 50);
```

### Change Database Credentials

Edit `backend/config.php`:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'your_password');
define('DB_NAME', 'royal_signature');
```

### Modify Styling

Edit files in `css/` folder to customize design

### Add New Pages

Create `.php` file in `pages/` folder following the template pattern

---

## 🚢 Deployment Guide

### Requirements
- PHP 7.4+ with MySQLi extension
- MySQL 5.7+ or MariaDB 10.4+
- Web server (Apache, Nginx, etc.)

### Steps
1. Upload all files to web server
2. Create MySQL database `royal_signature`
3. Import `backend/db_schema.sql`
4. Update database credentials in `backend/config.php`
5. Set proper file permissions (755 for folders, 644 for files)
6. Access via: `https://yourdomain.com/Royal-Signature/`

---

## 🐛 Troubleshooting

### "Database connection failed"
- Ensure MySQL is running
- Check credentials in `backend/config.php`
- Verify database `royal_signature` exists

### "Page not found"
- Make sure you're using correct URL paths
- Use `/Royal-Signature/` prefix if in subdirectory
- Check .htaccess settings

### "Login not working"
- Clear browser cookies and cache
- Ensure PHP sessions are enabled
- Check `php.ini` session settings

### "Port 8080 already in use"
- Edit `START_SERVER.bat` change `8080` to another port
- Or kill process using that port

---

## 📞 Support & Help

### Built-in Help
- View `status.php` for system diagnostics
- Check inline code comments for explanations
- Read `DYNAMIC_CONVERSION_SUMMARY.md` for technical details

### Common Issues
- All error messages are displayed with helpful hints
- Check browser console for JavaScript errors
- View server logs for PHP errors

---

## 📈 Performance Tips

1. **Optimize Images** - Compress product images
2. **Enable Caching** - Add cache headers for static files
3. **Database Indexes** - Already added for key fields
4. **Code Minification** - Minify CSS and JS for production

---

## 🎓 Learning Resources

- **PHP Documentation:** https://www.php.net/docs.php
- **MySQL Guide:** https://dev.mysql.com/doc/
- **Bootstrap 5:** https://getbootstrap.com/docs/
- **JavaScript:** https://developer.mozilla.org/en-US/docs/Web/JavaScript/

---

## ✨ Features Roadmap

- [ ] Email notifications for orders
- [ ] Product reviews and ratings
- [ ] Wishlist functionality
- [ ] Coupon/discount codes
- [ ] Admin dashboard
- [ ] Payment gateway integration
- [ ] Shipping calculator
- [ ] SMS notifications

---

## 📄 License & Credits

This is a custom-built e-commerce solution for Royal Signature.  
Built with: PHP • MySQL • Bootstrap • JavaScript

---

## 🎉 You're All Set!

Your e-commerce website is now **fully dynamic and ready to use!**

### Next Steps:
1. Test with the provided credentials
2. Create your own account
3. Browse and test the shopping flow
4. Customize styling and content
5. Deploy to production when ready

**Happy selling!** 🚀

---

*Last Updated: January 2, 2026*  
*Platform: Royal Signature Luxury Perfume E-Commerce*  
*Status: ✅ Production Ready*
