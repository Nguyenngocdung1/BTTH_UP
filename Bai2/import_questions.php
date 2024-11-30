<?php
// Kết nối tới cơ sở dữ liệu
$conn = new mysqli('localhost', 'root', '', 'quiz');

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Đọc file câu hỏi
$filename = 'questions.txt'; // Đường dẫn tới file câu hỏi
$file = fopen($filename, 'r');

if (!$file) {
    die("Không thể mở file!");
}

// Đọc từng dòng trong file
while (($line = fgets($file)) !== false) {
    $line = trim($line);

    // Bỏ qua dòng trống
    if (empty($line)) {
        continue;
    }

    // Kiểm tra nếu là câu hỏi hoặc đáp án
    if (strpos($line, 'ANSWER:') !== false) {
        // Lấy đáp án
        $correct_answer = str_replace('ANSWER:', '', $line);
        $correct_answer = trim($correct_answer);

        // Chèn dữ liệu vào bảng
        $stmt = $conn->prepare("INSERT INTO questions (question, option_a, option_b, option_c, option_d, correct_answer) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssss', $question, $option_a, $option_b, $option_c, $option_d, $correct_answer);
        $stmt->execute();
    } elseif (preg_match('/^[A-D]\. /', $line)) {
        // Nếu là một tùy chọn đáp án (A, B, C, D)
        $option_key = strtolower(substr($line, 0, 1)); // Lấy ký tự đầu làm key (A, B, C, D)
        ${"option_$option_key"} = substr($line, 3);    // Lưu giá trị của đáp án
    } else {
        // Nếu là câu hỏi
        $question = $line;
        $option_a = $option_b = $option_c = $option_d = ''; // Reset các tùy chọn
    }
}

fclose($file);
$conn->close();

echo "Dữ liệu đã được nhập thành công!";
?>
