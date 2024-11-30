<?php
require 'db.php';

$id = $_GET['id'];  
$sql = "SELECT * FROM flowers WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$flower = $result->fetch_assoc();

if (!$flower) {
    echo "Không tìm thấy loài hoa!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Sửa thông tin loài hoa</title>
</head>
<body>
    <h1>Sửa thông tin loài hoa</h1>
    <form action="process.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="id" value="<?php echo $flower['id']; ?>">

        <label>Tên hoa: <input type="text" name="name" value="<?php echo $flower['name']; ?>" required></label>
        <label>Mô tả: <textarea name="description" required><?php echo $flower['description']; ?></textarea></label>
        <label>Hình ảnh: <input type="file" name="image" accept="image/*"></label>
        <img src="images/<?php echo $flower['image']; ?>" alt="<?php echo $flower['name']; ?>" width="100">
        <button type="submit">Cập nhật</button>
    </form>
</body>
</html>
