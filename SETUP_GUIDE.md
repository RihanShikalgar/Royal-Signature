# Royal Signature E-commerce Website Setup Guide

## Overview
Royal Signature is a luxury perfume e-commerce website built with HTML, CSS, JavaScript (frontend) and PHP, MySQL (backend).

## Prerequisites
- PHP 7.2 or higher
- MySQL 5.7 or higher
- Web Server (Apache/Nginx)
- Local development environment (XAMPP, WAMP, or similar)

## Installation Steps

### 1. Setup Database

#### Option A: Using phpMyAdmin
1. Open phpMyAdmin (usually at `http://localhost/phpmyadmin`)
2. Click on "New" to create a new database
3. Name it `royal_signature`
4. Click on the new database and go to "Import"
5. Upload the `backend/db_schema.sql` file
6. Click "Go" to import the database

#### Option B: Using Command Line
```bash
mysql -u root -p < backend/db_schema.sql
```

### 2. Configure Database Connection

Open `backend/config.php` and update the database credentials:

```php
define('DB_HOST', 'localhost');      // Your database host
define('DB_USER', 'root');           // Your database username
define('DB_PASS', '');               // Your database password
define('DB_NAME', 'royal_signature'); // Database name
```

### 3. File Structure Verification

Ensure the following directory structure exists:
```
Royal-Signature/
├── backend/
│   ├── config.php
│   ├── login.php
│   ├── signup.php
│   ├── logout.php
│   ├── get_products.php
│   ├── cart.php
│   ├── place_order.php
│   ├── submit_feedback.php
│   ├── submit_contact.php
│   └── db_schema.sql
├── css/
│   ├── style.css
│   ├── home.css
│   ├── about.css
│   ├── brands.css
│   ├── cart.css
│   ├── contact.css
│   ├── feedback.css
│   └── login.css
├── js/
│   ├── script.js
│   ├── cart.js
│   └── utils.js
├── img/
├── video/
├── brands/
├── product/
├── home.html
├── index.html
├── login.html
├── about.html
├── brands.html
├── cart.html
├── contact.html
└── feedback.html
```

### 4. Start Local Server

Place the entire `Royal-Signature` folder in your web server's root directory:
- **XAMPP**: `C:\xampp\htdocs\`
- **WAMP**: `C:\wamp\www\`
- **LAMP**: `/var/www/html/`

### 5. Access the Website

Open your browser and navigate to:
```
http://localhost/Royal-Signature/index.html
```
or
```
http://localhost/Royal-Signature/login.html
```

## Features

### 1. **User Authentication**
- Sign up with username, email, and password
- Login with credentials
- Session management
- Logout functionality

### 2. **Product Management**
- Browse products from database
- View product details
- Category-wise filtering (available for expansion)
- Product images and pricing

### 3. **Shopping Cart**
- Add products to cart
- Update quantities
- Remove items
- View cart totals with discounts
- Persistent cart storage (session-based)

### 4. **Order Management**
- Place orders with shipping address
- Order history tracking
- Transaction details storage

### 5. **Feedback & Contact**
- Submit feedback with ratings
- Contact form submissions
- Email field validation
- Message storage in database

### 6. **Responsive Design**
- Mobile-friendly layout
- Modern UI with Lucide icons
- Bootstrap integration
- Custom CSS styling

## API Endpoints

### Authentication
- **POST** `/backend/login.php` - User login
- **POST** `/backend/signup.php` - User registration
- **POST** `/backend/logout.php` - User logout

### Products
- **GET** `/backend/get_products.php` - Fetch all products

### Cart Operations
- **POST** `/backend/cart.php?action=add` - Add to cart
- **POST** `/backend/cart.php?action=remove` - Remove from cart
- **POST** `/backend/cart.php?action=update` - Update quantity
- **POST** `/backend/cart.php?action=get` - Get cart items
- **POST** `/backend/cart.php?action=clear` - Clear cart

### Orders
- **POST** `/backend/place_order.php` - Place an order

### Feedback & Contact
- **POST** `/backend/submit_feedback.php` - Submit feedback
- **POST** `/backend/submit_contact.php` - Submit contact message

## Database Tables

### users
- User account information
- Encrypted passwords using bcrypt

### products
- Product catalog
- Pricing, images, descriptions, stock

### cart
- User shopping cart items
- Product quantities

### orders
- Order history
- Total amounts, status, shipping address

### order_items
- Individual items in each order
- Quantity and pricing at time of order

### feedback
- Customer feedback and ratings
- Feedback type and messages

### contact_messages
- Contact form submissions
- Customer inquiries

## Security Features

- **Password Hashing**: Using bcrypt for secure password storage
- **Input Sanitization**: All user inputs are sanitized using `mysqli_real_escape_string()`
- **Email Validation**: Using PHP's `filter_var()` function
- **Session Management**: Server-side session handling for user authentication
- **CORS Headers**: Configured for secure cross-origin requests

## Troubleshooting

### Database Connection Error
- Check MySQL is running
- Verify database credentials in `config.php`
- Ensure database `royal_signature` exists

### Session/Login Issues
- Clear browser cookies and cache
- Ensure sessions are enabled in PHP
- Check browser console for JavaScript errors

### Cart Not Working
- Verify user is logged in
- Check browser's local storage/session storage
- Inspect network requests in browser developer tools

### Images Not Loading
- Check image file paths in database
- Verify image files exist in the respective folders
- Ensure correct relative paths in code

## File Uploads (Future Enhancement)
To add file upload capabilities for product images:
1. Create an `uploads/` directory
2. Set appropriate folder permissions (755 or 775)
3. Implement file upload validation in PHP files

## Email Configuration (Future Enhancement)
To enable email notifications:
1. Configure SMTP settings in PHP
2. Update email functions in backend files:
   - `submit_contact.php`
   - `place_order.php`

## Support & Maintenance
- Regular database backups recommended
- Monitor error logs in PHP logs
- Keep dependencies updated
- Regular security audits

## Version Info
- **Current Version**: 1.0.0
- **Last Updated**: January 2, 2026
- **Framework**: Vanilla PHP + MySQL

## License
Royal Signature © 2024 - All Rights Reserved

