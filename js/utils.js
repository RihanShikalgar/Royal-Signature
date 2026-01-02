// Check if user is logged in and update navbar
function updateNavbar() {
    let username = sessionStorage.getItem('username');
    let loginLink = document.querySelector('.loginbox a');
    
    if (username) {
        // User is logged in
        loginLink.textContent = 'Log out (' + username + ')';
        loginLink.href = '#';
        loginLink.addEventListener('click', function(e) {
            e.preventDefault();
            logout();
        });
    } else {
        // User is not logged in
        loginLink.textContent = 'Login';
        loginLink.href = 'login.html';
    }
}

function logout() {
    fetch('backend/logout.php', {
        method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
        sessionStorage.clear();
        alert('Logged out successfully');
        window.location.href = 'login.html';
    })
    .catch(error => {
        console.error('Error:', error);
        sessionStorage.clear();
        window.location.href = 'login.html';
    });
}

// Initialize navbar on page load
document.addEventListener('DOMContentLoaded', updateNavbar);

// Function to display products
function displayProducts(products) {
    const productGrid = document.querySelector('.product-grid');
    if (!productGrid) return;

    let html = '';
    products.forEach(product => {
        html += `
            <article class="product-card">
                <div class="product-image">
                    <img src="${product.image_url}" alt="${product.name}">
                </div>
                <div class="product-info">
                    <h3>${product.name}</h3>
                    <div class="product-footer">
                        <span class="price">₹${parseFloat(product.price).toFixed(2)}</span>
                        <button onclick="addToCart(${product.id}, '${product.name}', ${product.price})" class="add-btn">Add to Cart</button>
                    </div>
                </div>
            </article>
        `;
    });
    
    productGrid.innerHTML = html;
}

// Fetch and display products
function loadProducts() {
    fetch('backend/get_products.php')
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            displayProducts(data.data);
        }
    })
    .catch(error => console.error('Error loading products:', error));
}

// Load products on page load if product grid exists
window.addEventListener('load', function() {
    if (document.querySelector('.product-grid')) {
        loadProducts();
    }
});
