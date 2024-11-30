<?php
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Tìm sản phẩm cần xóa
    $product = null;
    foreach ($_SESSION['products'] as $p) {
        if ($p['id'] == $id) {
            $product = $p;
            break;
        }
    }
    
    // Xác nhận xóa
    if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
        foreach ($_SESSION['products'] as $key => $p) {
            if ($p['id'] == $id) {
                unset($_SESSION['products'][$key]);
                $_SESSION['products'] = array_values($_SESSION['products']); // Reindex array
                break;
            }
        }
        header("Location: index.php");
        exit();
    }
    
    if (!$product) {
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Xóa Sản Phẩm</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="bootstrap.min.css">
    <style>
        .delete-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="delete-container">
            <h2 class="mb-4">Xác nhận xóa sản phẩm</h2>
            
            <p class="mb-4">Bạn có chắc chắn muốn xóa sản phẩm "<?php echo htmlspecialchars($product['name']); ?>"?</p>
            
            <div class="mb-3">
                <a href="delete_product.php?id=<?php echo $product['id']; ?>&confirm=yes" 
                   class="btn btn-danger">Xóa</a>
                <a href="index.php" class="btn btn-secondary">Hủy</a>
            </div>
        </div>
    </div>
</body>
</html>