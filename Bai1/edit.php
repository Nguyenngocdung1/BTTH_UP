<?php
require 'db.php';

// Kiểm tra nếu có id trong URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Lấy thông tin loài hoa từ cơ sở dữ liệu theo id
    $stmt = $conn->prepare("SELECT * FROM flowers WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $flower = $result->fetch_assoc();

    if (!$flower) {
        echo "Loài hoa không tồn tại.";
        exit;
    }
} else {
    echo "Không tìm thấy loài hoa.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Khi form gửi, xử lý việc cập nhật thông tin
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'] ? 'images/' . basename($_FILES['image']['name']) : $flower['image'];

    // Nếu có ảnh mới, di chuyển ảnh và cập nhật
    if ($_FILES['image']['name']) {
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    }

    // Cập nhật thông tin loài hoa
    $stmt = $conn->prepare("UPDATE flowers SET name = ?, description = ?, image = ? WHERE id = ?");
    $stmt->bind_param("sssi", $name, $description, $image, $id);
    $stmt->execute();

    // Chuyển hướng về trang quản lý
    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Chỉnh sửa loài hoa</title>
</head>
<body>
    <h1>Chỉnh sửa thông tin loài hoa</h1>

    <form action="edit.php?id=<?= $flower['id'] ?>" method="POST" enctype="multipart/form-data">
        <label>Tên hoa: <input type="text" name="name" value="<?= $flower['name'] ?>" required></label><br>
        <label>Mô tả: <textarea name="description" required><?= $flower['description'] ?></textarea></label><br>
        <label>Hình ảnh: <input type="file" name="image" accept="image/*"></label><br>
        <img src="<?= $flower['image'] ?>" alt="<?= $flower['name'] ?>" width="100"><br>
        <button type="submit">Cập nhật</button>
    </form>

    <a href="admin.php">Quay lại trang quản lý</a>
</body>
</html>
