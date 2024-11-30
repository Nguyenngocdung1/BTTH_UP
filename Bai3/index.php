<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách tài khoản</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Danh sách tài khoản</h1>

    <?php
    // Thông tin kết nối cơ sở dữ liệu
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "csv_database";

    // Kết nối tới MySQL
    $conn = new mysqli($host, $username, $password, $database);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Số bản ghi mỗi trang
    $records_per_page = 5;

    // Xác định số trang hiện tại
    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $current_page = max(1, $current_page); // Đảm bảo số trang >= 1

    // Tính toán vị trí bắt đầu (offset) cho truy vấn SQL
    $offset = ($current_page - 1) * $records_per_page;

    // Lấy dữ liệu từ bảng với giới hạn phân trang
    $sql = "SELECT * FROM accounts LIMIT $records_per_page OFFSET $offset";
    $result = $conn->query($sql);

    // Hiển thị bảng dữ liệu
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr>
                <th>Username</th>
                <th>Password</th>
                <th>Lastname</th>
                <th>Firstname</th>
                <th>City</th>
                <th>Email</th>
                <th>Course</th>
              </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['username']) . "</td>";
            echo "<td>" . htmlspecialchars($row['password']) . "</td>";
            echo "<td>" . htmlspecialchars($row['lastname']) . "</td>";
            echo "<td>" . htmlspecialchars($row['firstname']) . "</td>";
            echo "<td>" . htmlspecialchars($row['city']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['course1']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Không có dữ liệu để hiển thị.</p>";
    }

    // Tính tổng số bản ghi để tạo phân trang
    $sql_total = "SELECT COUNT(*) AS total FROM accounts";
    $result_total = $conn->query($sql_total);
    $total_records = $result_total->fetch_assoc()['total'];

    // Tính tổng số trang
    $total_pages = ceil($total_records / $records_per_page);

    // Hiển thị điều hướng phân trang
    echo "<div class='pagination'>";
    if ($current_page > 1) {
        echo "<a href='index.php?page=" . ($current_page - 1) . "'>&laquo; Trang trước</a>";
    }
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $current_page) {
            echo "<a class='active' href='index.php?page=$i'>$i</a>";
        } else {
            echo "<a href='index.php?page=$i'>$i</a>";
        }
    }
    if ($current_page < $total_pages) {
        echo "<a href='index.php?page=" . ($current_page + 1) . "'>Trang sau &raquo;</a>";
    }
    echo "</div>";

    // Đóng kết nối
    $conn->close();
    ?>
</body>
</html>