<?php
// Kết nối cơ sở dữ liệu
$conn = new mysqli('localhost', 'root', '', 'quiz');

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy câu hỏi từ database
$sql = "SELECT * FROM questions";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Online</title>
</head>
<body>
    <h1>Kiểm tra trực tuyến</h1>
    <form action="result.php" method="POST">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div>
                    <p><strong>Câu <?php echo $row['id']; ?>:</strong> <?php echo $row['question']; ?></p>
                    <label><input type="radio" name="answer[<?php echo $row['id']; ?>]" value="A"> <?php echo $row['option_a']; ?></label><br>
                    <label><input type="radio" name="answer[<?php echo $row['id']; ?>]" value="B"> <?php echo $row['option_b']; ?></label><br>
                    <label><input type="radio" name="answer[<?php echo $row['id']; ?>]" value="C"> <?php echo $row['option_c']; ?></label><br>
                    <label><input type="radio" name="answer[<?php echo $row['id']; ?>]" value="D"> <?php echo $row['option_d']; ?></label><br>
                </div>
                <hr>
            <?php endwhile; ?>
            <button type="submit">Nộp bài</button>
        <?php else: ?>
            <p>Không có câu hỏi nào.</p>
        <?php endif; ?>
    </form>
</body>
</html>
