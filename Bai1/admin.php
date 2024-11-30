<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Quản lý các loài hoa</title>
</head>
<body>
    <h1>Quản lý các loài hoa</h1>
    <table>
        <thead>
            <tr>
                <th>Tên hoa</th>
                <th>Mô tả</th>
                <th>Hình ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require 'db.php';
            $sql = "SELECT * FROM flowers";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['description'] . '</td>';
                echo '<td><img src="images/' . $row['image'] . '" alt="' . $row['name'] . '" width="100"></td>';
                echo '<td>
                        <a href="edit.php?id=' . $row['id'] . '">Sửa</a> | 
                        <a href="process.php?action=delete&id=' . $row['id'] . '">Xóa</a>
                      </td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
    <form action="process.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="add">
        <label>Tên hoa: <input type="text" name="name" required></label>
        <label>Mô tả: <textarea name="description" required></textarea></label>
        <label>Hình ảnh: <input type="file" name="image" accept="image/*" required></label>
        <button type="submit">Thêm loài hoa</button>
    </form>
</body>
</html>
