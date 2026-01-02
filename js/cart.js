let cartData = [];

document.addEventListener("DOMContentLoaded", function () {
    loadCart();
});

function loadCart() {
    fetch('backend/cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'action=get'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            cartData = data.data || [];
            renderCart();
        }
    })
    .catch(error => console.error('Error loading cart:', error));
}

function renderCart() {
    const cartContainer = document.querySelector('.cart .products');
    if (!cartContainer) return;

    if (cartData.length === 0) {
        cartContainer.innerHTML = '<p style="text-align: center; padding: 20px;">Your cart is empty</p>';
        updateCartTotals();
        return;
    }

    let html = '';
    cartData.forEach(item => {
        html += `
            <div class="cart-item">
                <img src="${item.image_url}" alt="${item.name}">
                <div class="item-info">
                    <h3>${item.name}</h3>
                    <p>₹${parseFloat(item.price).toFixed(2)}</p>
                </div>
                <div class="item-controls">
                    <button class="decrease" data-product-id="${item.product_id}">-</button>
                    <input type="number" value="${item.quantity}" min="1">
                    <button class="increase" data-product-id="${item.product_id}">+</button>
                </div>
                <button class="remove-btn" data-product-id="${item.product_id}">Remove</button>
            </div>
        `;
    });
    
    cartContainer.innerHTML = html;
    attachCartEventListeners();
    updateCartTotals();
}

function attachCartEventListeners() {
    document.querySelectorAll(".decrease").forEach(btn => {
        btn.addEventListener("click", function() {
            const productId = this.dataset.productId;
            const item = cartData.find(i => i.product_id == productId);
            if (item && item.quantity > 1) {
                item.quantity--;
                updateCartQuantity(productId, item.quantity);
            }
        });
    });

    document.querySelectorAll(".increase").forEach(btn => {
        btn.addEventListener("click", function() {
            const productId = this.dataset.productId;
            const item = cartData.find(i => i.product_id == productId);
            if (item) {
                item.quantity++;
                updateCartQuantity(productId, item.quantity);
            }
        });
    });

    document.querySelectorAll(".remove-btn").forEach(btn => {
        btn.addEventListener("click", function() {
            const productId = this.dataset.productId;
            removeFromCart(productId);
        });
    });
}

function updateCartQuantity(productId, quantity) {
    let formData = new FormData();
    formData.append('action', 'update');
    formData.append('product_id', productId);
    formData.append('quantity', quantity);

    fetch('backend/cart.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            renderCart();
        }
    })
    .catch(error => console.error('Error updating cart:', error));
}

function removeFromCart(productId) {
    let formData = new FormData();
    formData.append('action', 'remove');
    formData.append('product_id', productId);

    fetch('backend/cart.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            cartData = cartData.filter(item => item.product_id != productId);
            renderCart();
        }
    })
    .catch(error => console.error('Error removing from cart:', error));
}

function updateCartTotals() {
    let subtotal = 0;
    cartData.forEach(item => {
        subtotal += parseFloat(item.price) * item.quantity;
    });

    const discount = subtotal * 0.10;
    const total = subtotal - discount;

    const subtotalElem = document.getElementById("subtotal");
    const offElem = document.getElementById("off");
    const totalElem = document.getElementById("total");

    if (subtotalElem) subtotalElem.innerText = `₹${subtotal.toFixed(2)}`;
    if (offElem) offElem.innerText = `10% Off: -₹${discount.toFixed(2)}`;
    if (totalElem) totalElem.innerText = `₹${total.toFixed(2)}`;
}

function addToCart(productId, productName, productPrice) {
    let formData = new FormData();
    formData.append('action', 'add');
    formData.append('product_id', productId);
    formData.append('quantity', 1);

    fetch('backend/cart.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(`${productName} added to cart!`);
            loadCart();
        } else {
            alert(data.message || 'Failed to add item to cart');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error adding to cart');
    });
}
