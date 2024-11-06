document.addEventListener("DOMContentLoaded", () => {
    // Seleccionar elementos del DOM
    const cartToggle = document.querySelector(".cart-toggle");
    const cartContent = document.querySelector(".cart-content");
    const addToCartButtons = document.querySelectorAll(".add-to-cart");
    const cartItems = document.getElementById("cart-items");
    const totalElement = document.getElementById("total");
    const confirmPurchaseButton = document.querySelector(".confirm-purchase");
    const clearCartButton = document.querySelector(".clear-cart");

    // Cargar el carrito desde localStorage
    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    // Función para actualizar el carrito en la interfaz y en localStorage
    function updateCart() {
        cartItems.innerHTML = ""; // Limpiar el contenido actual
        let total = 0;
        cart.forEach((item) => {
            const li = document.createElement("li");
            // Crear botones de aumentar y disminuir cantidad
            const quantityControls = document.createElement("span");
            quantityControls.classList.add("quantity-controls");
            quantityControls.innerHTML = `
                <button class="decrease-quantity">-</button>
                <span class="quantity">${item.quantity}</span>
                <button class="increase-quantity">+</button>
                <input type="checkbox" class="remove-checkbox" data-name="${item.name}">
            `;
            quantityControls
                .querySelector(".decrease-quantity")
                .addEventListener("click", () => decreaseQuantity(item.name));
            quantityControls
                .querySelector(".increase-quantity")
                .addEventListener("click", () => increaseQuantity(item.name));
            li.innerHTML = `${item.name} - $${item.price.toFixed(2)} `;
            li.appendChild(quantityControls);
            cartItems.appendChild(li);
            total += item.price * item.quantity;
        });
        totalElement.textContent = total.toFixed(2);
        // Guardar el carrito en localStorage
        localStorage.setItem("cart", JSON.stringify(cart));
    }

    // Función para aumentar la cantidad de un ítem
    function increaseQuantity(name) {
        const item = cart.find((item) => item.name === name);
        if (item) {
            item.quantity += 1;
            updateCart();
        }
    }

    // Función para disminuir la cantidad de un ítem
    function decreaseQuantity(name) {
        const itemIndex = cart.findIndex((item) => item.name === name);
        if (itemIndex > -1) {
            const item = cart[itemIndex];
            if (item.quantity > 1) {
                item.quantity -= 1;
            } else {
                cart.splice(itemIndex, 1); // Eliminar el ítem si la cantidad es 0
            }
            updateCart();
        }
    }

    // Función para manejar el clic en el botón de agregar al carrito
    function handleAddToCartClick(event) {
        const sandwichFrame = event.target.closest(".producto");
        if (sandwichFrame) {
            const name = sandwichFrame.querySelector("p").textContent;
            const price = parseFloat(sandwichFrame.getAttribute("data-price"));
            const existingItem = cart.find((item) => item.name === name);
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({ name, price, quantity: 1 });
            }
            updateCart();
        }
    }

    // Función para manejar el clic en el botón de abrir/cerrar el carrito
    function handleCartToggleClick() {
        cartContent.classList.toggle("show");
    }

    // Función para manejar la compra y redirigir al checkout
    function handleConfirmPurchaseClick() {
        if (cart.length === 0) {
            alert("Tu carrito está vacío. Agrega algunos sándwiches antes de confirmar.");
            return;
        }
        // Guardar el carrito en localStorage antes de redirigir
        localStorage.setItem("cart", JSON.stringify(cart));
        // Redirigir al usuario a la página de checkout
        window.location.href = "/TURBOSANGUCHES/HTML/checkout.php";
    }

    // Función para eliminar productos seleccionados o todos si ninguno está seleccionado
    function handleClearCartClick() {
        const checkboxes = cartItems.querySelectorAll(".remove-checkbox");
        const anyChecked = Array.from(checkboxes).some((checkbox) => checkbox.checked);
        if (anyChecked) {
            // Eliminar productos seleccionados
            cart = cart.filter(
                (item) => !document.querySelector(`.remove-checkbox[data-name="${item.name}"]`).checked
            );
        } else {
            // Eliminar todos los productos
            cart = [];
        }
        updateCart();
    }

    // Asignar eventos a los botones
    addToCartButtons.forEach((button) =>
        button.addEventListener("click", handleAddToCartClick)
    );
    cartToggle.addEventListener("click", handleCartToggleClick);
    confirmPurchaseButton.addEventListener("click", handleConfirmPurchaseClick);
    clearCartButton.addEventListener("click", handleClearCartClick);

    // Actualizar el carrito al cargar la página
    updateCart();
});
