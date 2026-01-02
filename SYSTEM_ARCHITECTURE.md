# Royal Signature - System Architecture

## 🏗️ Overall Architecture

```
┌─────────────────────────────────────────────────────────────────┐
│                     CLIENT SIDE (Browser)                       │
├─────────────────────────────────────────────────────────────────┤
│                                                                   │
│  HTML Pages:                                                      │
│  ├─ login.html (Authentication)                                 │
│  ├─ index.html (Alternative login)                              │
│  ├─ home.html (Product browsing)                                │
│  ├─ brands.html (Brand listing)                                 │
│  ├─ about.html (Company info)                                   │
│  ├─ cart.html (Shopping cart & checkout)                        │
│  ├─ contact.html (Contact form)                                 │
│  └─ feedback.html (Feedback & ratings)                          │
│                                                                   │
│  JavaScript Files:                                               │
│  ├─ js/script.js (Login/Signup logic)                           │
│  ├─ js/cart.js (Cart operations)                                │
│  └─ js/utils.js (Utilities & navbar)                            │
│                                                                   │
│  CSS Stylesheets:                                                │
│  ├─ css/style.css (Login styling)                               │
│  ├─ css/home.css (Home page)                                    │
│  ├─ css/cart.css (Cart page)                                    │
│  └─ css/* (Other pages)                                         │
│                                                                   │
│  Libraries:                                                       │
│  ├─ Bootstrap 5 (Framework)                                     │
│  ├─ Lucide Icons (Icons)                                        │
│  └─ Font Awesome (Additional icons)                             │
│                                                                   │
└──────────────────────────┬──────────────────────────────────────┘
                           │
                           │ HTTP/AJAX Requests (JSON)
                           │
                           ▼
┌─────────────────────────────────────────────────────────────────┐
│                    API Layer (PHP Endpoints)                     │
├─────────────────────────────────────────────────────────────────┤
│                                                                   │
│  Authentication Endpoints:                                       │
│  ├─ POST /backend/login.php                                     │
│  ├─ POST /backend/signup.php                                    │
│  └─ POST /backend/logout.php                                    │
│                                                                   │
│  Product Endpoints:                                              │
│  └─ GET /backend/get_products.php                               │
│                                                                   │
│  Cart Endpoints:                                                 │
│  └─ POST /backend/cart.php                                      │
│     ├─ action=add (Add to cart)                                 │
│     ├─ action=remove (Remove from cart)                         │
│     ├─ action=update (Update quantity)                          │
│     ├─ action=get (Get cart items)                              │
│     └─ action=clear (Clear cart)                                │
│                                                                   │
│  Order Endpoints:                                                │
│  └─ POST /backend/place_order.php                               │
│                                                                   │
│  Form Endpoints:                                                 │
│  ├─ POST /backend/submit_feedback.php                           │
│  └─ POST /backend/submit_contact.php                            │
│                                                                   │
│  Configuration:                                                  │
│  └─ backend/config.php (DB connection & helpers)                │
│                                                                   │
└──────────────────────────┬──────────────────────────────────────┘
                           │
                           │ SQL Queries
                           │
                           ▼
┌─────────────────────────────────────────────────────────────────┐
│                  Database Layer (MySQL)                          │
├─────────────────────────────────────────────────────────────────┤
│                                                                   │
│  Core Tables:                                                    │
│  ├─ users (User accounts & authentication)                      │
│  ├─ products (Product catalog)                                  │
│  ├─ cart (Shopping cart items)                                  │
│  ├─ orders (Order records)                                      │
│  ├─ order_items (Order line items)                              │
│  ├─ feedback (Customer feedback & ratings)                      │
│  └─ contact_messages (Contact form messages)                    │
│                                                                   │
│  Relationships:                                                  │
│  ├─ users ──┬──→ cart ────────────────┐                         │
│  │           ├──→ orders ──┬──→ order_items                     │
│  │           └──→ feedback │                                    │
│  └────────────────────────→ products ←──────────────┘           │
│                                                                   │
│  Indexes:                                                        │
│  ├─ PRIMARY KEY on all tables (id)                              │
│  ├─ UNIQUE on username, email                                   │
│  ├─ FOREIGN KEYS for relationships                              │
│  └─ Performance indexes on user_id, product_id                  │
│                                                                   │
└─────────────────────────────────────────────────────────────────┘
```

---

## 🔄 Data Flow Diagrams

### Login Flow
```
User Input (login.html)
    ↓
JavaScript: handleLogin() (script.js)
    ↓
AJAX POST /backend/login.php
    ↓
PHP: Validate credentials
    ↓
Database: Query users table
    ↓
PHP: Verify password (bcrypt)
    ↓
Session: Create session
    ↓
JSON Response
    ↓
JavaScript: Store session, redirect to home.html
```

### Add to Cart Flow
```
User Click: "Add to Cart" (product page)
    ↓
JavaScript: addToCart() (utils.js or inline)
    ↓
Check: Is user logged in?
    ├─ NO → Redirect to login.html
    └─ YES → Continue
    ↓
AJAX POST /backend/cart.php?action=add
    ↓
PHP: Validate product_id
    ↓
Database: Check if product exists
    ↓
Database: Insert/Update cart
    ↓
JSON Response
    ↓
JavaScript: Refresh cart display
    ↓
User: Sees updated cart
```

### Checkout Flow
```
User: Clicks "Place Order" (cart.html)
    ↓
JavaScript: placeOrder()
    ↓
User: Enters shipping address
    ↓
AJAX POST /backend/place_order.php
    ↓
PHP: Validate order data
    ↓
Database: BEGIN TRANSACTION
    ↓
Database: Insert into orders
    ↓
Database: Insert order_items from cart
    ↓
Database: DELETE from cart
    ↓
Database: COMMIT TRANSACTION
    ↓
JSON Response with order_id
    ↓
JavaScript: Display success message
    ↓
User: Order confirmed
```

### Feedback Submission Flow
```
User: Fills feedback form (feedback.html)
    ↓
User: Submits form
    ↓
JavaScript: Prevent default
    ↓
JavaScript: Validate fields
    ↓
AJAX POST /backend/submit_feedback.php
    ↓
PHP: Validate all inputs
    ↓
PHP: Validate rating (1-5)
    ↓
Database: Insert into feedback
    ↓
JSON Response
    ↓
JavaScript: Show success message
    ↓
JavaScript: Clear form
    ↓
User: Sees confirmation
```

---

## 📊 Database Relationships

### ER Diagram (Text)
```
                     ┌──────────────┐
                     │    users     │
                     │──────────────│
                     │ id (PK)      │
                     │ username     │
                     │ email        │
                     │ password     │
                     │ full_name    │
                     │ phone        │
                     │ address      │
                     └───┬──────┬───┘
                         │      │
        ┌────────────────┘      └────────────────┐
        │                                         │
        ▼                                         ▼
   ┌─────────┐                              ┌──────────┐
   │  cart   │                              │ feedback │
   │─────────│                              │──────────│
   │ id (PK) │                              │ id (PK)  │
   │ user_id │◄─────────────────────────────│ user_id  │
   │ prod_id │                              │ name     │
   │ qty     │                              │ email    │
   └────┬────┘                              │ rating   │
        │                                   │ message  │
        │          ┌──────────────┐         └──────────┘
        │          │  products    │
        │          │──────────────│
        └─────────►│ id (PK)      │
                   │ name         │
                   │ price        │
                   │ image_url    │
                   │ category     │
                   │ stock        │
                   └────┬─────────┘
                        │
                        │
        ┌───────────────┴───────────────┐
        │                               │
        ▼                               ▼
   ┌─────────────┐             ┌──────────────────┐
   │   orders    │             │  order_items     │
   │─────────────│             │──────────────────│
   │ id (PK)     │             │ id (PK)          │
   │ user_id     │◄────────────│ order_id         │
   │ order_date  │             │ product_id       │
   │ total_amt   │             │ quantity         │
   │ status      │             │ price            │
   │ ship_addr   │             └──────────────────┘
   └─────────────┘

┌────────────────────────┐
│ contact_messages       │
│────────────────────────│
│ id (PK)                │
│ name                   │
│ email                  │
│ message                │
│ created_at             │
└────────────────────────┘
```

---

## 🔐 Security Architecture

```
┌─────────────────────────────────────────────┐
│        Client-Side Security                 │
├─────────────────────────────────────────────┤
│ • Input validation (HTML5)                  │
│ • HTTPS requirement (in production)         │
│ • Secure cookies (httponly, secure flags)   │
│ • CORS policy enforcement                   │
└─────────────────────────────────────────────┘

┌─────────────────────────────────────────────┐
│       Server-Side Security                  │
├─────────────────────────────────────────────┤
│ • Input sanitization (real_escape_string)   │
│ • Password hashing (bcrypt)                 │
│ • Email validation (filter_var)             │
│ • Session management (server-side)          │
│ • Error handling (suppress details)         │
└─────────────────────────────────────────────┘

┌─────────────────────────────────────────────┐
│      Database Security                      │
├─────────────────────────────────────────────┤
│ • Foreign key constraints                   │
│ • Transactional integrity                   │
│ • Parameterized queries (ready)             │
│ • User authentication required              │
└─────────────────────────────────────────────┘

┌─────────────────────────────────────────────┐
│      File System Security                   │
├─────────────────────────────────────────────┤
│ • .htaccess restrictions                    │
│ • Sensitive file protection                 │
│ • Directory listing disabled                │
│ • Proper file permissions                   │
└─────────────────────────────────────────────┘
```

---

## 🔄 Request/Response Cycle

### Typical Request
```
1. Client sends HTTP request
   ├─ Method: GET/POST
   ├─ URL: /backend/endpoint.php
   ├─ Headers: Content-Type, Authorization
   └─ Body: Form data or JSON

2. Web Server (Apache)
   ├─ Validates request
   ├─ Routes to PHP
   └─ Passes parameters

3. PHP Script
   ├─ Includes config.php
   ├─ Validates input
   ├─ Executes business logic
   ├─ Queries database
   └─ Formats response

4. Database (MySQL)
   ├─ Executes SQL
   ├─ Returns results
   └─ Commits/Rollbacks

5. Server Response
   ├─ Format: JSON
   ├─ Status: 200, 404, 500, etc.
   ├─ Headers: Content-Type, Cache-Control
   └─ Body: JSON data

6. Client receives
   ├─ JavaScript parses JSON
   ├─ Updates DOM
   └─ User sees changes
```

---

## 🗂️ File Organization

```
Royal-Signature/
│
├─ backend/ (Server-side PHP)
│  ├─ config.php (Database configuration)
│  ├─ login.php (Auth endpoint)
│  ├─ signup.php (Registration endpoint)
│  ├─ logout.php (Logout endpoint)
│  ├─ get_products.php (Products endpoint)
│  ├─ cart.php (Cart operations)
│  ├─ place_order.php (Order processing)
│  ├─ submit_feedback.php (Feedback endpoint)
│  ├─ submit_contact.php (Contact endpoint)
│  └─ db_schema.sql (Database structure)
│
├─ css/ (Stylesheets)
│  ├─ style.css
│  ├─ home.css
│  ├─ about.css
│  ├─ brand.css
│  ├─ cart.css
│  ├─ contact.css
│  ├─ feedback.css
│  └─ login.css
│
├─ js/ (Client-side JavaScript)
│  ├─ script.js (Login logic)
│  ├─ cart.js (Cart operations)
│  └─ utils.js (Utilities)
│
├─ img/ (Images)
│  └─ logo.png, etc.
│
├─ icons/ (Icon assets)
│
├─ video/ (Video files)
│
├─ brands/ (Brand content)
│  └─ [brand folders with images]
│
├─ product/ (Product pages)
│  └─ [product folders]
│
├─ HTML Pages (Root level)
│  ├─ home.html
│  ├─ login.html
│  ├─ index.html
│  ├─ about.html
│  ├─ brands.html
│  ├─ cart.html
│  ├─ contact.html
│  └─ feedback.html
│
└─ Documentation
   ├─ README.md
   ├─ SETUP_GUIDE.md
   ├─ QUICKSTART.md
   ├─ DATABASE_REFERENCE.md
   ├─ IMPLEMENTATION_SUMMARY.md
   ├─ COMPLETION_CHECKLIST.md
   └─ DELIVERY_SUMMARY.txt
```

---

## 🚀 Deployment Architecture

### Development
```
Local Machine
├─ XAMPP/WAMP installed
├─ MySQL running locally
└─ PHP server running on localhost
```

### Staging
```
Staging Server
├─ PHP enabled server
├─ MySQL database
└─ HTTPS certificate
```

### Production
```
Production Server
├─ Dedicated PHP server
├─ Managed MySQL database
├─ CDN for static assets
├─ Email service configured
└─ Regular backups
```

---

## 📈 Scalability Considerations

### Current
- Single PHP server
- Single MySQL database
- File-based sessions
- No caching layer

### For Growth
1. Add database indexes ✅ (Done)
2. Implement caching (Redis)
3. Use prepared statements ✅ (Ready)
4. Load balancer for servers
5. Database replication
6. CDN for assets

---

## 🔧 Technology Stack

```
Frontend Layer          Backend Layer           Database Layer
├─ HTML5               ├─ PHP 7.2+             ├─ MySQL 5.7+
├─ CSS3                ├─ MySQLi               ├─ 7 Tables
├─ JavaScript          ├─ JSON API             ├─ Indexes
├─ Bootstrap 5         ├─ Sessions             └─ Transactions
├─ Lucide Icons        └─ Error Handling
└─ Font Awesome

Server: Apache/Nginx
Development: XAMPP/WAMP/LAMP
```

---

## ✅ Architecture Benefits

✅ **Separation of Concerns**
- Frontend separate from backend
- Modular PHP functions
- Database abstraction

✅ **Security**
- Bcrypt password hashing
- Input validation
- SQL injection prevention
- Session management

✅ **Performance**
- Database indexes
- Efficient queries
- Caching headers
- Compression enabled

✅ **Scalability**
- Modular code structure
- Stateless API endpoints
- Database optimization ready
- Ready for vertical/horizontal scaling

✅ **Maintainability**
- Well-organized code
- Clear function names
- Comprehensive documentation
- Comments throughout

---

**This architecture supports a robust, secure, and scalable e-commerce platform.**

