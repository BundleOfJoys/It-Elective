<?php
require 'Connections.php';

if (isset($_POST['add_product'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $image = basename($_FILES["image"]["name"]);

        $sql = "INSERT INTO manga (name, description, price, stock, image) VALUES ('$name', '$description', '$price', '$stock', '$image')";

        if ($conn->query($sql) === TRUE) {
            header("Location: logout.php?page=Manga");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

if (isset($_POST['update_product'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $image = $_POST['existing_image'];

    $sql = "UPDATE manga SET name='$name', description='$description', price='$price', stock='$stock' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: logout.php?page=Manga");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['delete_product'])) {
    $id = $_GET['delete_product'];

    $sql = "DELETE FROM manga WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: logout.php?page=Manga");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['get_product'])) {
    $id = $_GET['get_product'];

    $sql = "SELECT * FROM manga WHERE id=$id";
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

    $sql = "UPDATE manga SET stock='$new_stock' WHERE id=$id";

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
            height: 300px;
            object-fit: cover;
            border-radius: 8px;
        }
        .product h3, .product p {
            font-size: 16px;
            margin: 0;
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
            max-width: 800px;
            margin: 10% auto;
            text-align: left;
        }
        .edit-content label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .edit-content input, .edit-content textarea, .edit-content button {
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
    </style>
</head>
<body>

    <h2>One Piece Manga</h2>
    
    <form id="add-product-form" enctype="multipart/form-data" method="POST" action="">
        <input type="text" id="product-name" name="name" placeholder="Product Name" required>
        <input type="text" id="product-description" name="description" placeholder="Product Description" required>
        <input type="number" id="product-price" name="price" placeholder="Product Price" required>
        <input type="number" id="product-stock" name="stock" placeholder="Product Stock" required>
        <input type="file" id="product-image" name="image" accept="image/*" required>
        <button type="submit" name="add_product">Add Product</button>
    </form>

    <form id="update-product-form" enctype="multipart/form-data" method="POST" action="" style="display:none;">
        <input type="hidden" id="update-product-id" name="id">
        <input type="hidden" id="existing-image" name="existing_image">
        <input type="text" id="update-product-name" name="name" placeholder="Product Name" required>
        <input type="text" id="update-product-description" name="description" placeholder="Product Description" required>
        <input type="number" id="update-product-price" name="price" placeholder="Product Price" required>
        <input type="number" id="update-product-stock" name="stock" placeholder="Product Stock" required>
        <button type="submit" name="update_product">Update Product</button>
    </form>

    <div class="product-grid">
        <?php
        require 'Connections.php';

        $sql = "SELECT * FROM manga";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="product">';
                echo '<img src="uploads/' . $row["image"] . '" alt="' . $row["name"] . '">';
                echo '<h3>' . $row["name"] . '</h3>';
                echo '<p>Price: $' . $row["price"] . '</p>';
                echo '<p>Stock: ' . $row["stock"] . '</p>';
                echo '<div class="button-container">';
                echo '<button class="show-description" onclick="showDescription(\'' . $row["name"] . '\', \'' . $row["description"] . '\', \'uploads/' . $row["image"] . '\')">Show Description</button>';
                echo '<button class="edit-product" onclick="editProduct(' . $row["id"] . ', \'' . $row["name"] . '\', \'' . $row["description"] . '\', ' . $row["price"] . ', ' . $row["stock"] . ')">Edit</button>';
                echo '<button class="delete-product" onclick="deleteProduct(' . $row["id"] . ')">Delete</button>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "0 results";
        }

        $conn->close();
        ?>
    </div>

    <div id="description-modal" class="description-modal">
        <div class="description-content">
            <span class="close-description" onclick="closeDescription()">&times;</span>
            <h3 id="description-title"></h3>
            <img id="description-image" style="width: 100%; border-radius: 8px;">
            <p id="description-text"></p>
        </div>
    </div>

    <div id="edit-modal" class="edit-modal">
        <div class="edit-content">
            <span class="close-edit" onclick="closeEdit()">&times;</span>
            <h3>Edit Product</h3>
            <form id="edit-product-form" enctype="multipart/form-data" method="POST" action="">
                <input type="hidden" id="edit-product-id" name="id">
                <input type="hidden" id="existing-image" name="existing_image">
                <label for="edit-product-name">Product Name</label>
                <input type="text" id="edit-product-name" name="name" placeholder="Product Name" required>
                <label for="edit-product-description">Product Description</label>
                <textarea id="edit-product-description" name="description" placeholder="Product Description" required></textarea>
                <label for="edit-product-price">Product Price</label>
                <input type="number" id="edit-product-price" name="price" placeholder="Product Price" required>
                <label for="edit-product-stock">Product Stock</label>
                <input type="number" id="edit-product-stock" name="stock" placeholder="Product Stock" required>
                <button type="submit" name="update_product">Save Changes</button>
            </form>
        </div>
    </div>

    <script>
        function showDescription(productName, description, imageSrc) {
            document.getElementById("description-title").innerText = productName;
            document.getElementById("description-image").src = imageSrc;
            document.getElementById("description-text").innerText = description;
            document.getElementById("description-modal").style.display = "block";
        }

        function closeDescription() {
            document.getElementById("description-modal").style.display = "none";
        }

        function deleteProduct(id) {
            if (confirm(`Are you sure you want to delete this product?`)) {
                window.location.href = `logout.php?page=Manga&delete_product=${id}`;
            }
        }

        function editProduct(id, name, description, price, stock) {
            document.getElementById('edit-product-id').value = id;
            document.getElementById('edit-product-name').value = name;
            document.getElementById('edit-product-description').value = description;
            document.getElementById('edit-product-price').value = price;
            document.getElementById('edit-product-stock').value = stock;
            document.getElementById('edit-modal').style.display = 'block';
        }

        function closeEdit() {
            document.getElementById('edit-modal').style.display = 'none';
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
            fetch(`Manga.php?update_stock=${productId}&new_stock=${newStock}`)
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
    </script>

</body>
</html>