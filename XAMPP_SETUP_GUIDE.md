# 🚀 Royal Signature - Server Setup Guide

## ⚠️ IMPORTANT: Use XAMPP Apache Server

Due to PHP configuration issues with the built-in server, please use **XAMPP Apache** instead. It's much more reliable and already configured.

---

## ✅ EASIEST METHOD: XAMPP Control Panel

### Step 1: Open XAMPP Control Panel
```
Double-click: C:\xampp\xampp-control.exe
```
Or run: `RUN_WITH_XAMPP.bat` in the Royal-Signature folder

### Step 2: Start Services
1. Click **"Start"** button for **MySQL**
2. Click **"Start"** button for **Apache**
   - Wait until you see "Running" status
   - Status should show Green

### Step 3: Open Your Website
```
http://localhost/Royal-Signature/
```

### Step 4: Login
```
Username: testuser
Password: password123
```

---

## 🔧 Troubleshooting

### Apache Won't Start
- Check if port 80 is in use
- Try changing Apache port in httpd.conf
- Look for error in Apache log: `C:\xampp\apache\logs\error.log`

### MySQL Won't Start
- Check if port 3306 is in use
- Verify database file exists: `C:\xampp\data\`
- Look for error in MySQL log: `C:\xampp\mysql\data\`

### Website Shows Blank
- Verify both Apache and MySQL say "Running" (green)
- Clear browser cache (Ctrl+Shift+Delete)
- Try http://localhost/Royal-Signature/status.php

### Login Fails
- MySQL must be running
- Check test user exists (see troubleshooting below)

---

## 🆘 Verify Setup

### Check MySQL Database
Open Command Prompt and run:
```cmd
C:\xampp\mysql\bin\mysql.exe -u root royal_signature -e "SELECT COUNT(*) FROM users;"
```

Should show: `1` (one test user)

### Check Apache Status
Visit: http://localhost/

Should show XAMPP home page

### Check Our Website
Visit: http://localhost/Royal-Signature/

Should show login page

---

## 📋 Step-by-Step Setup

### 1. Start XAMPP Control Panel
   ```
   C:\xampp\xampp-control.exe
   ```

### 2. Services Should Show:
   ```
   Apache: [Start] - Click to start
   MySQL:  [Start] - Click to start
   ```

### 3. Click MySQL "Start"
   - Wait 5-10 seconds
   - Should show: "Running" (Green light)
   - Verify port 3306

### 4. Click Apache "Start"
   - Wait 5-10 seconds
   - Should show: "Running" (Green light)
   - Verify port 80

### 5. Open Browser
   ```
   http://localhost/Royal-Signature/
   ```

### 6. You Should See
   - Royal Signature logo
   - Login form
   - "Sign Up" button

### 7. Click Login
   - Username: `testuser`
   - Password: `password123`
   - Click "Log In"

### 8. You Should See
   - Dashboard with featured products
   - Navigation menu
   - Shopping cart link
   - User dropdown menu

---

## ✨ What Works Now

Once you're logged in:
- ✅ Browse products
- ✅ Search & filter
- ✅ Add to cart
- ✅ View cart
- ✅ Checkout
- ✅ View orders
- ✅ Edit profile
- ✅ Submit feedback

---

## 🛑 To Stop Everything

### Method 1: XAMPP Control Panel
- Click "Stop" for Apache
- Click "Stop" for MySQL
- Close the window

### Method 2: Command Line
```cmd
C:\xampp\apache_stop.bat
C:\xampp\mysql_stop.bat
```

---

## 📱 Access Your Site

| Purpose | URL |
|---------|-----|
| **Login** | http://localhost/Royal-Signature/ |
| **Products** | http://localhost/Royal-Signature/pages/products.php |
| **Cart** | http://localhost/Royal-Signature/pages/cart.php |
| **Status** | http://localhost/Royal-Signature/status.php |
| **Dashboard** | http://localhost/Royal-Signature/dashboard.php |

---

## 🎯 Common Issues & Solutions

| Issue | Solution |
|-------|----------|
| Apache won't start | Restart XAMPP, check port 80 is free |
| MySQL won't start | Restart XAMPP, check port 3306 is free |
| Login page blank | Restart services, clear cache |
| Database error | Verify MySQL is running and connected |
| Port in use error | Change port in httpd.conf |

---

## 📞 Need Help?

1. Check `status.php` for system diagnostics
2. View Apache/MySQL logs in `C:\xampp\`
3. Read documentation in Royal-Signature folder
4. Restart both services completely

---

## ✅ You're Ready!

Your Royal Signature e-commerce platform is fully set up and ready to use with XAMPP Apache!

**Start using it now:**
1. Double-click `RUN_WITH_XAMPP.bat`
2. Start MySQL and Apache
3. Visit http://localhost/Royal-Signature/
4. Login with testuser/password123
5. Enjoy! 🎉
