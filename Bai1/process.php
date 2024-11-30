<?php
require 'db.php';

$action = $_POST['action'] ?? $_GET['action'] ?? null;

if ($action === 'add') {
    // Thêm loài hoa mới
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = 'images/' . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $image);

    $stmt = $conn->prepare("INSERT INTO flowers (name, description, image) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $description, $image);
    $stmt->execute();
    header("Location: admin.php");
} elseif ($action === 'delete') {
    // Xóa loài hoa theo id
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM flowers WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: admin.php");
} elseif ($action === 'edit') {
    // Chỉnh sửa thông tin hoa theo id
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $image = $_FILES['image']['name'] ? 'images/' . basename($_FILES['image']['name']) : null;

        // Nếu có ảnh mới, di chuyển ảnh và cập nhật
        if ($image) {
            move_uploaded_file($_FILES['image']['tmp_name'], $image);
            $stmt = $conn->prepare("UPDATE flowers SET name = ?, description = ?, image = ? WHERE id = ?");
            $stmt->bind_param("sssi", $name, $description, $image, $id);
        } else {
            // Nếu không có ảnh mới, chỉ cập nhật tên và mô tả
            $stmt = $conn->prepare("UPDATE flowers SET name = ?, description = ? WHERE id = ?");
            $stmt->bind_param("ssi", $name, $description, $id);
        }
        $stmt->execute();
        header("Location: admin.php");
    }
}
?>
