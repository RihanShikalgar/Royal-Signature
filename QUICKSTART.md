# Quick Start Guide - Royal Signature

## ⚡ Get Running in 5 Minutes

### Step 1: Setup Local Server (1 min)
```
1. Download and install XAMPP/WAMP/MAMP
2. Start Apache and MySQL services
3. Download Royal-Signature project
4. Place it in htdocs folder (XAMPP) or www folder (WAMP)
```

### Step 2: Create Database (1 min)
```
Option A - Using phpMyAdmin:
1. Go to http://localhost/phpmyadmin
2. Click "New" → Create database "royal_signature"
3. Import file: backend/db_schema.sql
4. Done!

Option B - Using Command Line:
mysql -u root -p < backend/db_schema.sql
```

### Step 3: Configure Database (30 sec)
```
Edit: backend/config.php

Change these if needed:
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');          // Add your MySQL password if exists
define('DB_NAME', 'royal_signature');
```

### Step 4: Access Website (30 sec)
```
Open browser and go to:
http://localhost/Royal-Signature/login.html
```

### Step 5: Test Features (2 min)

**Test 1: Signup**
```
Click "Sign Up"
Create new account with:
- Username: testuser
- Email: test@example.com
- Password: Test@1234
```

**Test 2: Login**
```
Login with credentials you just created
Should redirect to home.html
```

**Test 3: Browse Products**
```
Homepage shows products from database
Products load automatically
```

**Test 4: Shopping Cart**
```
Click "Add to Cart" on any product
Go to cart.html
Adjust quantities
Click "Place Order" (requires address)
```

**Test 5: Contact Form**
```
Go to contact.html
Fill out form
Submit - message saves to database
```

**Test 6: Feedback**
```
Go to feedback.html
Select rating and feedback type
Submit - feedback saves to database
```

---

## 🔐 Default Sample Data

### Sample Products (Already in Database)
- Royal Oud - ₹15,999
- Crown Jasmine - ₹12,999
- Imperial Rose - ₹13,999
- Noble Legacy - ₹14,999
- Sultan Gold - ₹16,999
- Mirage Dreams - ₹11,999

### No default users - Create your own!

---

## 📁 Important Files

| File | Purpose |
|------|---------|
| `backend/config.php` | Database connection (EDIT THIS) |
| `backend/db_schema.sql` | Database structure (IMPORT THIS) |
| `login.html` | Starting page |
| `home.html` | Main page after login |
| `cart.html` | Shopping cart |

---

## 🆘 Common Issues & Fixes

### "Connection Failed" Error
```
Fix: Check config.php credentials
- Is MySQL running?
- Is database created?
- Are credentials correct?
```

### Login Not Working
```
Fix: 
- Create new account first (no default accounts)
- Check password is correct
- Clear browser cookies
```

### Products Not Showing
```
Fix:
- Check database was imported
- Check config.php connection
- Open browser console (F12) for errors
```

### Can't Add to Cart
```
Fix:
- Make sure you're logged in
- Enable JavaScript
- Check browser console for errors
```

---

## 🎯 What's Included

✅ Complete Backend (9 PHP files)
✅ MySQL Database with 7 tables
✅ User Authentication System
✅ Shopping Cart with Database
✅ Order Management
✅ Contact & Feedback Forms
✅ Product Management
✅ Session Management
✅ Security Features
✅ Complete Documentation

---

## 📊 Endpoints Overview

### User Authentication
```
POST /backend/login.php
POST /backend/signup.php
POST /backend/logout.php
```

### Products
```
GET /backend/get_products.php
```

### Cart
```
POST /backend/cart.php?action=add
POST /backend/cart.php?action=remove
POST /backend/cart.php?action=update
POST /backend/cart.php?action=get
```

### Orders
```
POST /backend/place_order.php
```

### Forms
```
POST /backend/submit_feedback.php
POST /backend/submit_contact.php
```

---

## 🚀 Next Steps (After Getting It Running)

1. **Customize Products**
   - Edit products in phpMyAdmin
   - Add product images
   - Update prices

2. **Add More Pages**
   - Create individual product pages
   - Link them properly
   - Add filtering

3. **Payment Integration**
   - Add Stripe/PayPal
   - Update place_order.php
   - Handle payment processing

4. **Email Setup**
   - Configure SMTP in config.php
   - Send order confirmations
   - Send contact acknowledgments

5. **Admin Dashboard**
   - Create admin login
   - Manage products
   - View orders
   - View feedback

---

## 📞 Need Help?

Refer to these files:
- **SETUP_GUIDE.md** - Detailed setup
- **README.md** - Full documentation
- **DATABASE_REFERENCE.md** - Database structure
- **IMPLEMENTATION_SUMMARY.md** - What was built

---

## ✅ Verification Checklist

After setup, verify:
- [ ] Database import successful
- [ ] Config.php updated with credentials
- [ ] Can access login page
- [ ] Can create account
- [ ] Can login
- [ ] Products show on homepage
- [ ] Cart works
- [ ] Contact form submits
- [ ] Feedback form submits

---

**You're all set! 🎉**

Start with: `http://localhost/Royal-Signature/login.html`

Create an account → Browse products → Add to cart → Checkout!

