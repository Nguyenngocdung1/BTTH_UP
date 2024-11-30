<?php
require 'db.php';

$action = $_POST['action'] ?? $_GET['action'] ?? null;

if ($action === 'add') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageName = 'images/' . basename($_FILES['image']['name']);
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $imageName)) {
            $stmt = $conn->prepare("INSERT INTO flowers (name, description, image) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $description, $imageName);
            $stmt->execute();
            
            header("Location: admin.php");
        } else {
            echo "Không thể tải lên ảnh. Vui lòng thử lại.";
        }
    } else {
        echo "Vui lòng chọn một ảnh để tải lên.";
    }
} elseif ($action === 'delete') {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM flowers WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: admin.php");
} elseif ($action === 'edit') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'] ? 'images/' . basename($_FILES['image']['name']) : null;

    if ($image) {
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
        $stmt = $conn->prepare("UPDATE flowers SET name = ?, description = ?, image = ? WHERE id = ?");
        $stmt->bind_param("sssi", $name, $description, $image, $id);
    } else {
        $stmt = $conn->prepare("UPDATE flowers SET name = ?, description = ? WHERE id = ?");
        $stmt->bind_param("ssi", $name, $description, $id);
    }
    $stmt->execute();
    header("Location: admin.php");
}
?>
