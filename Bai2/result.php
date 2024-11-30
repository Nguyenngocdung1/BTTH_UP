<?php
// Kết nối cơ sở dữ liệu
$conn = new mysqli('localhost', 'root', '', 'quiz');

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy câu trả lời từ form
$answers = $_POST['answer'];
$score = 0;

// Kiểm tra đáp án
foreach ($answers as $id => $answer) {
    $sql = "SELECT correct_answer FROM questions WHERE id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['correct_answer'] === $answer) {
            $score++;
        }
    }
}

// Tổng số câu hỏi
$total_questions = count($answers);

// Hiển thị kết quả
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả</title>
</head>
<body>
    <h1>Kết quả kiểm tra</h1>
    <p>Điểm số của bạn: <?php echo $score; ?> / <?php echo $total_questions; ?></p>
    <a href="index.php">Làm lại bài kiểm tra</a>
</body>
</html>
