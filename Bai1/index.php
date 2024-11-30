<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Danh sách các loài hoa</title>
</head>
<body>
    <h1>Danh sách các loài hoa</h1>
    <div class="flower-list">
        <?php
        require 'db.php';
        $sql = "SELECT * FROM flowers";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            echo '<div class="flower-item">';
            echo '<img src="' . $row['image'] . '" alt="' . $row['name'] . '">';
            echo '<h2>' . $row['name'] . '</h2>';
            echo '<p>' . $row['description'] . '</p>';
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>
