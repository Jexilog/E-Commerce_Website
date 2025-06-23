<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli("localhost", "root", "", "db_system");
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    // Gather form data
    $ProductName = $_POST['ProductName'];
    $Description = $_POST['Description'];
    $Category_ID = $_POST['Category_ID'];
    $Brand = $_POST['Brand'];
    $Price = $_POST['Price'];
    $Stock_QTY = $_POST['Stock_QTY'];
    $Status = $_POST['status']; // ✅ Added
    date_default_timezone_set('Asia/Manila');
    $Added_AT = date('Y-m-d H:i:s');

    // Handle image upload
    $Image_URL = "";
    if (isset($_FILES['Image_File']) && $_FILES['Image_File']['error'] == 0) {
        $targetDir = "../../assets/uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $fileExt = pathinfo($_FILES["Image_File"]["name"], PATHINFO_EXTENSION);
        $fileName = uniqid("img_", true) . "." . $fileExt;
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($_FILES["Image_File"]["tmp_name"], $targetFile)) {
            $Image_URL = $fileName; // ✅ Save filename only (not full path)
        } else {
            echo "<script>alert('Failed to upload image.');</script>";
            exit;
        }
    } else {
        echo "<script>alert('Image is required.');</script>";
        exit;
    }

    // Prepare and execute insert statement
    $stmt = $conn->prepare("INSERT INTO product_tbl 
        (ProductName, Description, Category_ID, Brand, Price, Stock_QTY, Image_URL, Added_AT, Status)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssisdisss", $ProductName, $Description, $Category_ID, $Brand, $Price, $Stock_QTY, $Image_URL, $Added_AT, $Status);

    if ($stmt->execute()) {
        // Success
        header("Location: /System/SoundStage/src/components/admin/products.php");
        exit;
    } else {
        // Error
        echo "<script>alert('Insert failed: " . $stmt->error . "');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product | SoundStage</title>
    <link rel="icon" href="../../assets/icons/website-icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/styles/products.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        /* Optional: For image preview */
        .img-preview {
            width: 100%;
            max-width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #e5e5e5;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <?php include '../../components/admin/sidebar/sidebar.php'; ?>

    <div class="main-content flex-grow-1" style="margin-left:250px; min-height:100vh; background:#fafbfc;">
        <div class="container py-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0"><i class="bi bi-plus-circle me-2 text-primary"></i>Add Product</h4>
                <a href="products.php" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left mb"></i> Back to Products
                </a>
            </div>
            <div class="card shadow rounded-4 border-0">
                <div class="card-body p-3">
                    <form action="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        <div class="row g-4">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="productName" class="form-label fw-semibold">Product Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="productName" name="ProductName" required>
                                    <div class="invalid-feedback">Product name is required.</div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="category" class="form-label fw-semibold">Category <span class="text-danger">*</span></label>
                                        <select class="form-select" id="category" name="Category_ID" required>
                                            <option value="">Select Category</option>
                                            <option value="1">In-Ear Monitor</option>
                                            <option value="2">Accessories</option>
                                            <option value="3">Headphones</option>
                                            <option value="4">True-Wireless Stereo</option>
                                            <option value="5">Digital Audio Player</option>
                                            <option value="6">Speaker</option>
                                        </select>
                                        <div class="invalid-feedback">Category is required.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status" class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                                        <select class="form-select" id="status" name="status" required>
                                            <option value="In Stock">In Stock</option>
                                            <option value="Out of Stock">Out of Stock</option>
                                            <option value="On Sale">On Sale</option>
                                        </select>
                                        <div class="invalid-feedback">Status is required.</div>
                                    </div>
                                </div>
                                <div class="row g-3 mt-1">
                                    <div class="col-md-4">
                                        <label for="price" class="form-label fw-semibold">Price (₱) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="price" name="Price" min="0" step="0.01" required>
                                        <div class="invalid-feedback">Price is required.</div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="quantity" class="form-label fw-semibold">Stock_Qty <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="quantity" name="Stock_QTY" min="0" required>
                                        <div class="invalid-feedback">Quantity is required.</div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="brand" class="form-label fw-semibold">Brand <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="brand" name="Brand" required>
                                        <div class="invalid-feedback">Brand is required.</div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label for="description" class="form-label fw-semibold">Description</label>
                                    <textarea class="form-control" id="description" name="Description" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-4 d-flex flex-column align-items-center justify-content-start">
                                <label class="form-label fw-semibold mb-1">Image Preview</label>
                                <img id="imgPreview" src="/System/SoundStage/src/assets/uploads/no-image.png" alt="Preview" class="img-preview mb-2">
                                <input type="file" class="form-control" name="Image_File" accept="image/*" onchange="previewImage(event)" required>
                                <small class="text-muted">Recommended: 1:1 ratio, max 2MB</small>
                            </div>
                        </div>
                        <div class="mt-4 d-flex justify-content-end gap-2">
                            <a href="products.php" class="btn btn-secondary px-4">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-plus-lg"></i> Add Product
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Bootstrap validation
        (() => {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();

        // Image preview
        function previewImage(event) {
            const [file] = event.target.files;
            if (file) {
                document.getElementById('imgPreview').src = URL.createObjectURL(file);
            }
        }
    </script>
</body>
</html>