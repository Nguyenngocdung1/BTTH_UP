<?php
session_start();

// Khởi tạo mảng products trong session nếu chưa có
if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = [
        ['id' => 1, 'name' => 'Sản phẩm 1', 'price' => '1000'],
        ['id' => 2, 'name' => 'Sản phẩm 2', 'price' => '2000'],
        ['id' => 3, 'name' => 'Sản phẩm 3', 'price' => '3000'],
        ['id' => 4, 'name' => 'Sản phẩm 4', 'price' => '4000'],
        ['id' => 5, 'name' => 'Sản phẩm 5', 'price' => '5000'],
        ['id' => 6, 'name' => 'Sản phẩm 6', 'price' => '6000']
    ];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    
    if (empty($name) || empty($price)) {
        $error = "Vui lòng điền đầy đủ thông tin!";
    } else {
        // Tạo ID mới
        $maxId = 0;
        foreach ($_SESSION['products'] as $product) {
            if ($product['id'] > $maxId) {
                $maxId = $product['id'];
            }
        }
        
        // Thêm sản phẩm mới vào session
        $_SESSION['products'][] = [
            'id' => $maxId + 1,
            'name' => $name,
            'price' => $price
        ];
        
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Thêm Sản Phẩm Mới</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="bootstrap.min.css">
    <style>
        .form-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="mb-4">Thêm Sản Phẩm Mới</h2>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="mb-3">
                    <label for="name" class="form-label">Tên sản phẩm:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                
                <div class="mb-3">
                    <label for="price" class="form-label">Giá:</label>
                    <input type="number" class="form-control" id="price" name="price" required>
                </div>
                
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                    <a href="index.php" class="btn btn-secondary">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>