<?php
// Thông tin kết nối cơ sở dữ liệu
$host = "localhost"; // Máy chủ MySQL
$username = "root"; // Tên người dùng MySQL (mặc định là root)
$password = ""; // Mật khẩu MySQL (để trống nếu sử dụng XAMPP)
$database = "csv_database"; // Tên cơ sở dữ liệu

// Kết nối tới MySQL
$conn = new mysqli($host, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Đường dẫn tệp CSV
$file_path = "KTPM3_Danh_sach_diem_danh.csv";

// Kiểm tra nếu tệp CSV tồn tại
if (file_exists($file_path)) {
    // Mở tệp CSV
    if (($handle = fopen($file_path, "r")) !== FALSE) {
        // Bỏ qua dòng tiêu đề
        fgetcsv($handle, 1000, ",");

        // Đọc từng dòng của tệp CSV
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Gán các cột dữ liệu vào biến
            $username = $conn->real_escape_string($data[0]);
            $password = $conn->real_escape_string($data[1]);
            $lastname = $conn->real_escape_string($data[2]);
            $firstname = $conn->real_escape_string($data[3]);
            $city = $conn->real_escape_string($data[4]);
            $email = $conn->real_escape_string($data[5]);
            $course1 = $conn->real_escape_string($data[6]);

            // Chèn dữ liệu vào bảng MySQL
            $sql = "INSERT INTO accounts (username, password, lastname, firstname, city, email, course1)
                    VALUES ('$username', '$password', '$lastname', '$firstname', '$city', '$email', '$course1')";

            // Kiểm tra nếu chèn thất bại
            if (!$conn->query($sql)) {
                echo "Lỗi khi chèn dữ liệu: " . $conn->error . "<br>";
            }
        }

        fclose($handle);
        echo "Nhập dữ liệu từ tệp CSV thành công!";
    } else {
        echo "Không thể mở tệp CSV.";
    }
} else {
    echo "Tệp CSV không tồn tại.";
}

// Đóng kết nối
$conn->close();
?>
