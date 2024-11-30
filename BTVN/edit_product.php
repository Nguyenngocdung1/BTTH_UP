<?php
session_start();

// Lấy thông tin sản phẩm cần sửa
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $product = null;
    
    foreach ($_SESSION['products'] as $p) {
        if ($p['id'] == $id) {
            $product = $p;
            break;
        }
    }
    
    if (!$product) {
        header("Location: index.php");
        exit();
    }
}

// Xử lý form submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    
    if (empty($name) || empty($price)) {
        $error = "Vui lòng điền đầy đủ thông tin!";
    } else {
        // Cập nhật sản phẩm trong session
        foreach ($_SESSION['products'] as $key => $p) {
            if ($p['id'] == $id) {
                $_SESSION['products'][$key]['name'] = $name;
                $_SESSION['products'][$key]['price'] = $price;
                break;
            }
        }
        
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sửa Sản Phẩm</title>
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
            <h2 class="mb-4">Sửa Sản Phẩm</h2>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                
                <div class="mb-3">
                    <label for="name" class="form-label">Tên sản phẩm:</label>
                    <input type="text" class="form-control" id="name" name="name" 
                           value="<?php echo htmlspecialchars($product['name']); ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="price" class="form-label">Giá:</label>
                    <input type="number" class="form-control" id="price" name="price" 
                           value="<?php echo htmlspecialchars($product['price']); ?>" required>
                </div>
                
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a href="index.php" class="btn btn-secondary">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>