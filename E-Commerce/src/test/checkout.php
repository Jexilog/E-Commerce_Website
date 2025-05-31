<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <title>Shopping Cart</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .cart-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .product-image {
            width: 100px;
            height: 100px;
            background-color: #e9ecef; /* Placeholder color */
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="cart-container">
        <h2 class="mb-4" style="text-align: center;">Shopping Cart</h2>
        <p style="text-align: center; text-decoration: none;">0 items in your cart <a href="#"><i class="bi bi-pencil-fill">Edit</i></a></p>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="product-image mr-3"></div>
                            <div>
                                <h5>Product Name</h5>
                                <small>Category name</small>
                            </div>
                        </div>
                    </td>
                    <td>₱ 1,049.00</td>
                    <td>
                        <input type="number" class="form-control" value="1" min="1">
                    </td>
                    <td>
                        <button class="btn btn-danger btn-sm delete-row">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="product-image mr-3"></div>
                            <div>
                                <h5>Product Name</h5>
                                <small>Category name</small>
                            </div>
                        </div>
                    </td>
                    <td>₱ 1,049.00</td>
                    <td>
                        <input type="number" class="form-control" value="1" min="1">
                    </td>
                    <td>
                        <button class="btn btn-danger btn-sm delete-row">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="product-image mr-3"></div>
                            <div>
                                <h5>Product Name</h5>
                                <small>Category name</small>
                            </div>
                        </div>
                    </td>
                    <td>₱ 1,049.00</td>
                    <td>
                        <input type="number" class="form-control" value="1" min="1">
                    </td>
                    <td>
                        <button class="btn btn-danger btn-sm delete-row">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center mt-4">
        <div>
            <input type="checkbox" id="selectAll"> <label for="selectAll">All</label>
        </div>
        <div class="d-flex align-items-center ml-auto">
            <h4 class="mb-0 mr-3">Total: ₱ 0</h4>
            <button class="btn btn-primary">Check Out (0)</button>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
