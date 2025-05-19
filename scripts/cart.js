// Prices list
const prices = {
    "Krabby Patty": 1.25,
    "W/ sea cheese": 0.25,
    "Double Krabby Patty": 2.00,
    "Triple Krabby Patty": 3.00,
    "Small Coral Bits": 1.00,
    "Medium Coral Bits": 1.25,
    "Large Coral Bits": 1.50,
    "Kelp Rings": 1.50,
    "Salty Sauce": 0.50,
    "Krabby Meal": 3.50,
    "Double Krabby Meal": 3.75,
    "Triple Krabby Meal": 4.00,
    "Golden Loaf": 2.00,
    "W/ sauce": 1.25,
    "Kelp Shark": 1.25,
    "Small Seafoam Soda": 1.00,
    "Medium Seafoam Soda": 1.25,
    "Large Seafoam Soda": 1.50
};

let cart = [];

function loadCart() {
    const savedCart = localStorage.getItem("cart");
    if (savedCart) {
        cart = JSON.parse(savedCart);
    }
}

function saveCart() {
    localStorage.setItem("cart", JSON.stringify(cart));
}

window.addToCart = function(itemName) {
    loadCart();
    const price = prices[itemName];

    if (!price && price !== 0) {
        showToast(`Price not found for "${itemName}"`, 'error');
        return;
    }

    const existingItem = cart.find(item => item.name === itemName);

    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({ name: itemName, price: price, quantity: 1 });
    }

    saveCart();
    updateCart();

    // Use only the SpongeBob image
    const itemImage = "../images/spongebob-new-version-png-13.png";

    // Show toast notification
    showToast(`${itemName} added to cart!`, 'success', itemImage);
}

window.removeItem = function(index) {
    loadCart();
    const removedItem = cart.splice(index, 1)[0];
    saveCart();
    updateCart();
    showToast(`${removedItem.name} removed from cart.`, 'success', '../images/spongebob-new-version-png-13.png');
}

window.updateCart = function () {
    loadCart();

    const cartItemsList = document.getElementById("cartItems");
    const totalPriceSpan = document.getElementById("totalPrice");

    if (!cartItemsList || !totalPriceSpan) return;

    cartItemsList.innerHTML = "";

    let total = 0;

    cart.forEach((item, index) => {
        const li = document.createElement("li");
        li.className = "cart-item";

        const itemText = document.createElement("span");
        itemText.textContent = `${item.name} x ${item.quantity} - $${(item.price * item.quantity).toFixed(2)}`;

        const removeBtn = document.createElement("button");
        removeBtn.textContent = "✕";
        removeBtn.className = "remove-btn";
        removeBtn.onclick = function () {
            window.removeItem(index);
        };

        li.appendChild(itemText);
        li.appendChild(removeBtn);
        cartItemsList.appendChild(li);

        total += item.price * item.quantity;
    });

    totalPriceSpan.textContent = total.toFixed(2);

    // Disable checkout button if cart is empty
    const checkoutBtn = document.getElementById("checkoutBtn");
    if (checkoutBtn) {
        checkoutBtn.disabled = cart.length === 0;
        checkoutBtn.style.opacity = cart.length === 0 ? "0.5" : "1";
        checkoutBtn.style.pointerEvents = cart.length === 0 ? "none" : "auto";
    }
}

// Toast Notification Function
function showToast(message, type = 'success', imageUrl = '') {
    const defaultImage = 'https://img.icons8.com/emoji/48/fast-food-emoji.png ';
    const finalImage = imageUrl || defaultImage;

    let existingToast = document.getElementById('cart-toast');
    if (existingToast) {
        existingToast.remove();
    }

    const toast = document.createElement('div');
    toast.id = 'cart-toast';
    toast.className = `toast ${type}`;
    toast.innerHTML = `
        <img src="${finalImage}" alt="icon">
        <div class="text">${message}</div>
    `;

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.classList.add('show');
    }, 100);

    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 400);
    }, 3000);
}

// On page load
document.addEventListener('DOMContentLoaded', function () {
    loadCart();
    updateCart();
});

// Handle checkout button click
document.getElementById("checkoutBtn")?.addEventListener("click", function () {
    // Clear cart
    cart = [];
    saveCart();
    updateCart();

    // Show success message
    showToast("Thank you for your order! Your cart is now empty.", "success", "../images/spongebob-new-version-png-13.png");
});