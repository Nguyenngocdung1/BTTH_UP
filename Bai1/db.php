<?php
$host = 'localhost'; // Tên host, thường là localhost
$username = 'root';  // Tên người dùng MySQL
$password = '';      // Mật khẩu MySQL
$database = 'flowers_db'; // Tên CSDL

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die('Kết nối thất bại: ' . $conn->connect_error);
}
?>
