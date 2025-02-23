<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2x3 Product Grid</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 20px;
            text-align: center;
        }
        .product-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            padding: 20px;
            max-width: 800px;
            margin: auto;
        }
        .product {
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .product:hover {
            transform: scale(1.05);
        }
        .product img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
        }
        .product h3 {
            font-size: 16px;
            margin: 10px 0;
        }
        .add-to-cart, .show-description {
            display: inline-block;
            background-color: #28a745;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            margin-top: 10px;
            transition: background 0.3s;
        }
        .show-description {
            background-color: #007bff;
        }
        .add-to-cart:hover {
            background-color: #218838;
        }
        .show-description:hover {
            background-color: #0056b3;
        }
        .cart-button {
            margin: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .cart {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            overflow-y: auto;
        }
        .cart-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 400px;
            margin: 10% auto;
            text-align: left;
        }
        .close-cart {
            cursor: pointer;
            color: #555;
            float: right;
            font-size: 18px;
        }
        .close-cart:hover {
            color: red;
        }
        .cart-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .cart-item img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
            border-radius: 5px;
        }
        /* Description Modal */
        .description-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            overflow-y: auto;
        }
        .description-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 400px;
            margin: 10% auto;
            text-align: left;
        }
        .close-description {
            cursor: pointer;
            color: #555;
            float: right;
            font-size: 18px;
        }
        .close-description:hover {
            color: red;
        }
    </style>
</head>
<body>

    <h2>Our Products</h2>
    
    <!-- Add Product Form -->
    <form id="add-product-form">
        <input type="text" id="product-name" placeholder="Product Name" required>
        <input type="text" id="product-description" placeholder="Product Description" required>
        <input type="text" id="product-image" placeholder="Image URL" required>
        <button type="submit">Add Product</button>
    </form>

    <div class="product-grid">
        <!-- Existing products -->
    </div>

    <button class="cart-button" onclick="viewCart()">View Cart</button>

    <!-- Cart Modal -->
    <div id="cart-modal" class="cart">
        <div class="cart-content">
            <span class="close-cart" onclick="closeCart()">&times;</span>
            <h3>Your Cart</h3>
            <ul id="cart-items"></ul>
            <p id="cart-total"></p>
        </div>
    </div>

    <!-- Description Modal -->
    <div id="description-modal" class="description-modal">
        <div class="description-content">
            <span class="close-description" onclick="closeDescription()">&times;</span>
            <h3 id="description-title"></h3>
            <img id="description-image" style="width: 100%; border-radius: 8px;">
            <p id="description-text"></p>
        </div>
    </div>

    <script>
        let cart = [];
        let products = [
            { name: 'Product 1', description: 'This is a great product 1!', image: 'img/b1.webp' },
            { name: 'Product 2', description: 'This is a great product 2!', image: 'img/b2.webp' },
            { name: 'Product 3', description: 'This is a great product 3!', image: 'img/v3.webp' },
            { name: 'Product 4', description: 'This is a great product 4!', image: 'img/v4.webp' },
            { name: 'Product 5', description: 'This is a great product 5!', image: 'img/v5.webp' },
            { name: 'Product 6', description: 'This is a great product 6!', image: 'img/v6.webp' }
        ];

        function addToCart(productName, imageSrc) {
            cart.push({ name: productName, image: imageSrc });

            // Temporary confirmation message
            let msg = document.createElement("div");
            msg.innerText = `${productName} added to cart!`;
            msg.style.position = "fixed";
            msg.style.top = "10px";
            msg.style.right = "10px";
            msg.style.background = "#28a745";
            msg.style.color = "white";
            msg.style.padding = "10px";
            msg.style.borderRadius = "5px";
            document.body.appendChild(msg);

            setTimeout(() => msg.remove(), 2000);
        }

        function showDescription(productName, description, imageSrc) {
            document.getElementById("description-title").innerText = productName;
            document.getElementById("description-image").src = imageSrc;
            document.getElementById("description-text").innerText = description;
            document.getElementById("description-modal").style.display = "block";
        }

        function closeDescription() {
            document.getElementById("description-modal").style.display = "none";
        }

        function viewCart() {
            const cartItemsList = document.getElementById("cart-items");
            cartItemsList.innerHTML = ""; // Clear previous items

            cart.forEach(item => {
                const li = document.createElement("li");
                li.classList.add("cart-item");

                const img = document.createElement("img");
                img.src = item.image;

                const span = document.createElement("span");
                span.textContent = item.name;

                li.appendChild(img);
                li.appendChild(span);
                cartItemsList.appendChild(li);
            });

            document.getElementById("cart-modal").style.display = "block";
            document.getElementById("cart-total").innerText = "Total items: " + cart.length;
        }

        function closeCart() {
            document.getElementById("cart-modal").style.display = "none";
        }

        // Close cart modal if user clicks outside content
        window.onclick = function(event) {
            let cartModal = document.getElementById("cart-modal");
            if (event.target === cartModal) {
                cartModal.style.display = "none";
            }

            let descriptionModal = document.getElementById("description-modal");
            if (event.target === descriptionModal) {
                descriptionModal.style.display = "none";
            }
        }

        // Add new product
        document.getElementById('add-product-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const name = document.getElementById('product-name').value;
            const description = document.getElementById('product-description').value;
            const image = document.getElementById('product-image').value;

            products.push({ name, description, image });
            renderProducts();
        });

        function renderProducts() {
            const productGrid = document.querySelector('.product-grid');
            productGrid.innerHTML = '';
            products.forEach(product => {
                const productDiv = document.createElement('div');
                productDiv.classList.add('product');
                productDiv.innerHTML = `
                    <img src="${product.image}" alt="${product.name}">
                    <h3>${product.name}</h3>
                    <button class="add-to-cart" onclick="addToCart('${product.name}', '${product.image}')">Add to Cart</button>
                    <button class="show-description" onclick="showDescription('${product.name}', '${product.description}', '${product.image}')">Show Description</button>
                `;
                productGrid.appendChild(productDiv);
            });
        }

        // Initial render
        renderProducts();
    </script>

</body>
</html>