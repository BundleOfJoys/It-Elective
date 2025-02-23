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
        .add-to-cart, .show-description, .delete-product, .edit-product {
            display: inline-block;
            background-color: #28a745;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            margin-top: 10px;
            transition: background 0.3s, transform 0.2s;
        }
        .show-description {
            background-color: #007bff;
        }
        .delete-product {
            background-color: #dc3545;
        }
        .edit-product {
            background-color: #ffc107;
        }
        .add-to-cart:hover {
            background-color: #218838;
            transform: scale(1.1);
        }
        .show-description:hover {
            background-color: #0056b3;
            transform: scale(1.1);
        }
        .delete-product:hover {
            background-color: #c82333;
            transform: scale(1.1);
        }
        .edit-product:hover {
            background-color: #e0a800;
            transform: scale(1.1);
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
        /* Edit Product Modal */
        .edit-modal {
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
        .edit-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 400px;
            margin: 10% auto;
            text-align: left;
        }
        .close-edit {
            cursor: pointer;
            color: #555;
            float: right;
            font-size: 18px;
        }
        .close-edit:hover {
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

    <!-- Edit Product Modal -->
    <div id="edit-modal" class="edit-modal">
        <div class="edit-content">
            <span class="close-edit" onclick="closeEdit()">&times;</span>
            <h3>Edit Product</h3>
            <form id="edit-product-form">
                <input type="text" id="edit-product-name" placeholder="Product Name" required>
                <input type="text" id="edit-product-description" placeholder="Product Description" required>
                <input type="text" id="edit-product-image" placeholder="Image URL">
                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>

    <script src="product_data.js"></script>
    <script>
        let cart = [];

        let currentEditIndex = -1;

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

            let editModal = document.getElementById("edit-modal");
            if (event.target === editModal) {
                editModal.style.display = "none";
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

        function deleteProduct(productName) {
            if (confirm(`Are you sure you want to delete ${productName}?`)) {
                products = products.filter(product => product.name !== productName);
                renderProducts();
            }
        }

        function editProduct(index) {
            currentEditIndex = index;
            const product = products[index];
            document.getElementById('edit-product-name').value = product.name;
            document.getElementById('edit-product-description').value = product.description;
            document.getElementById('edit-product-image').value = product.image;
            document.getElementById('edit-modal').style.display = 'block';
        }

        document.getElementById('edit-product-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const name = document.getElementById('edit-product-name').value;
            const description = document.getElementById('edit-product-description').value;
            const image = document.getElementById('edit-product-image').value;

            products[currentEditIndex] = { name, description, image };
            renderProducts();
            closeEdit();
        });

        function closeEdit() {
            document.getElementById('edit-modal').style.display = 'none';
        }

        function renderProducts() {
            const productGrid = document.querySelector('.product-grid');
            productGrid.innerHTML = '';
            products.forEach((product, index) => {
                const productDiv = document.createElement('div');
                productDiv.classList.add('product');
                productDiv.innerHTML = `
                    <img src="${product.image}" alt="${product.name}">
                    <h3>${product.name}</h3>
                    <button class="add-to-cart" onclick="addToCart('${product.name}', '${product.image}')">Add to Cart</button>
                    <button class="show-description" onclick="showDescription('${product.name}', '${product.description}', '${product.image}')">Show Description</button>
                    <button class="edit-product" onclick="editProduct(${index})">Edit</button>
                    <button class="delete-product" onclick="deleteProduct('${product.name}')">Delete</button>
                `;
                productGrid.appendChild(productDiv);
            });
        }

        // Initial render
        renderProducts();
    </script>

</body>
</html>