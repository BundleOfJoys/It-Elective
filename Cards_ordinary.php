<?php
require 'Connections.php';

// Add product
if (isset($_POST['add_product'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $image = basename($_FILES["image"]["name"]);

        $sql = "INSERT INTO cards (name, description, price, stock, image) VALUES ('$name', '$description', '$price', '$stock', '$image')";

        if ($conn->query($sql) === TRUE) {
            header("Location: logout.php?page=Cards");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

// Update product
if (isset($_POST['update_product'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $image = $_POST['existing_image'];

    $sql = "UPDATE cards SET name='$name', description='$description', price='$price', stock='$stock' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: logout.php?page=Cards");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Delete product
if (isset($_GET['delete_product'])) {
    $id = $_GET['delete_product'];

    $sql = "DELETE FROM cards WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: logout.php?page=Cards");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Get product
if (isset($_GET['get_product'])) {
    $id = $_GET['get_product'];

    $sql = "SELECT * FROM cards WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode([]);
    }

    $conn->close();
    exit();
}

// Update stock
if (isset($_GET['update_stock'])) {
    $id = $_GET['update_stock'];
    $new_stock = $_GET['new_stock'];

    $sql = "UPDATE cards SET stock='$new_stock' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }

    $conn->close();
    exit();
}

$conn->close();
?>

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
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .product:hover {
            transform: scale(1.05);
        }
        .product img {
            width: 100%;
            height: 300px; /* Set a fixed height */
            object-fit: cover;
            border-radius: 8px;
        }
        .product h3, .product p {
            font-size: 16px;
            margin: 0; /* Remove margin */
        }
        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }
        .show-description, .delete-product, .edit-product {
            background-color: #28a745;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
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
        .remove-from-cart {
            background-color: #dc3545;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
            margin-left: auto;
        }
        .remove-from-cart:hover {
            background-color: #c82333;
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
            max-width: 800px; /* Increase the width */
            margin: 10% auto;
            text-align: left;
        }
        .edit-content label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .edit-content input, .edit-content textarea {
            width: 98%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .edit-content button {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
            display: block;
            margin: 0 auto; /* Center the button */
            padding: 10px 20px;
        }
        .edit-content button:hover {
            background-color: #218838;
            transform: scale(1.05);
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
        .view-cart {
            background-color: #17a2b8;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 20px;
            transition: background 0.3s, transform 0.2s;
        }
        .view-cart:hover {
            background-color: #138496;
            transform: scale(1.05);
        }
        .add-to-cart {
            background-color: #ffc107;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s, transform 0.2s;
        }
        .add-to-cart:hover {
            background-color: #e0a800;
            transform: scale(1.1);
        }
        .out-of-stock {
            background-color: #6c757d;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: not-allowed;
            font-size: 14px;
        }
        .clear-cart {
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
            transition: background 0.3s, transform 0.2s;
        }
        .clear-cart:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }
    </style>
</head>
<body>

    <h2>One Piece Cards </h2>
    
    <button class="view-cart" onclick="viewCart()">View Cart</button>

    <div class="product-grid">
        <?php
        // Database connection
        require 'Connections.php';

        // Fetch products from database
        $sql = "SELECT * FROM cards";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="product">';
                echo '<img src="uploads/' . $row["image"] . '" alt="' . $row["name"] . '">';
                echo '<h3>' . $row["name"] . '</h3>';
                echo '<p>Price: $' . number_format($row["price"], 2) . '</p>';
                echo '<p>Stock: ' . $row["stock"] . '</p>';
                echo '<div class="button-container">';
                if ($row["stock"] > 0) {
                    echo '<button class="show-description" onclick="showDescription(\'' . $row["name"] . '\', \'' . $row["description"] . '\', \'uploads/' . $row["image"] . '\')">Show Description</button>';
                    echo '<button class="add-to-cart" onclick="addToCart(' . $row["id"] . ')">Add to Cart</button>';
                } else {
                    echo '<button class="out-of-stock" disabled>Out of Stock</button>';
                }
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "0 results";
        }

        $conn->close();
        ?>
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

    <!-- Cart Modal -->
    <div id="cart-modal" class="cart">
        <div class="cart-content">
            <span class="close-cart" onclick="closeCart()">&times;</span>
            <h3>Your Cart</h3>
            <div id="cart-items">
                <!-- Cart items will be dynamically added here -->
            </div>
            <h4>Total Cost: $<span id="total-cost">0.00</span></h4>
            <button class="clear-cart" onclick="clearCart()">Clear Cart</button>
        </div>
    </div>

    <script>
        // Load cart from localStorage
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        function showDescription(productName, description, imageSrc) {
            document.getElementById("description-title").innerText = productName;
            document.getElementById("description-image").src = imageSrc;
            document.getElementById("description-text").innerText = description;
            document.getElementById("description-modal").style.display = "block";
        }

        function closeDescription() {
            document.getElementById("description-modal").style.display = "none";
        }

        function addToCart(productId) {
            // Fetch product details from the server
            fetch(`Cards_ordinary.php?get_product=${productId}`)
                .then(response => response.json())
                .then(product => {
                    // Check if product is already in cart
                    const existingProduct = cart.find(item => item.id === productId);
                    if (existingProduct) {
                        existingProduct.quantity += 1;
                    } else {
                        product.quantity = 1;
                        cart.push(product);
                    }
                    // Update cart modal
                    updateCartModal();
                    // Save cart to localStorage
                    localStorage.setItem('cart', JSON.stringify(cart));
                    // Update stock in the database
                    updateStock(productId, product.stock - 1);
                    // Update stock on the page
                    updateStockOnPage(productId, product.stock - 1);
                })
                .catch(error => console.error('Error:', error));
        }

        function updateStockOnPage(productId, newStock) {
            const productElements = document.querySelectorAll('.product');
            productElements.forEach(productElement => {
                const addToCartButton = productElement.querySelector('.add-to-cart');
                if (addToCartButton && addToCartButton.getAttribute('onclick').includes(`addToCart(${productId})`)) {
                    const stockElement = productElement.querySelector('p:nth-of-type(2)');
                    stockElement.innerText = `Stock: ${newStock}`;
                    if (newStock <= 0) {
                        addToCartButton.disabled = true;
                        addToCartButton.innerText = 'Out of Stock';
                        addToCartButton.classList.remove('add-to-cart');
                        addToCartButton.classList.add('out-of-stock');
                    }
                }
            });
        }

        function updateStock(productId, newStock) {
            fetch(`Cards_ordinary.php?update_stock=${productId}&new_stock=${newStock}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Stock updated successfully');
                    } else {
                        console.error('Error updating stock:', data.error);
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function updateCartModal() {
            const cartItemsContainer = document.getElementById('cart-items');
            cartItemsContainer.innerHTML = ''; // Clear existing items

            let totalCost = 0;

            cart.forEach(product => {
                fetch(`Cards_ordinary.php?get_product=${product.id}`)
                    .then(response => response.json())
                    .then(latestProduct => {
                        product.price = latestProduct.price; // Update price with the latest price
                        const cartItem = document.createElement('div');
                        cartItem.className = 'cart-item';
                        cartItem.innerHTML = `
                            <img src="uploads/${product.image}" alt="${product.name}">
                            <span style="margin-right: 10px;">${product.name}</span>
                            <span style="margin-left: auto;">$${parseFloat(product.price).toLocaleString()}</span>
                        `;
                        cartItemsContainer.appendChild(cartItem);

                        totalCost += parseFloat(product.price) * product.quantity;
                        document.getElementById('total-cost').innerText = totalCost.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                    })
                    .catch(error => console.error('Error:', error));
            });
        }

        function removeFromCart(productId) {
            const product = cart.find(item => item.id === productId);
            if (product) {
                // Update stock in the database
                updateStock(productId, product.stock + product.quantity);
                // Update stock on the page
                updateStockOnPage(productId, product.stock + product.quantity);
                // Remove the item from the cart array
                cart = cart.filter(item => item.id !== productId);
                // Save updated cart to localStorage
                localStorage.setItem('cart', JSON.stringify(cart));
                // Update the cart modal
                updateCartModal();
            }
        }

        function clearCart() {
            // Clear the cart array
            cart = [];
            // Save updated cart to localStorage
            localStorage.setItem('cart', JSON.stringify(cart));
            // Update the cart modal
            updateCartModal();
            // Reset total cost
            document.getElementById('total-cost').innerText = '0.00';
        }

        function viewCart() {
            document.getElementById("cart-modal").style.display = "block";
            updateCartModal(); // Fetch latest product details when the cart is viewed
        }

        function closeCart() {
            document.getElementById("cart-modal").style.display = "none";
        }

        // Initialize cart modal on page load
        document.addEventListener('DOMContentLoaded', updateCartModal);
    </script>

</body>
</html>