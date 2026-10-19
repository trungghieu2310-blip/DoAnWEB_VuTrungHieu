<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $summary = $conn->real_escape_string($_POST['summary']);
    $content = $conn->real_escape_string($_POST['content']);
    $image_url = $conn->real_escape_string($_POST['image_url']);
    $category_id = (int)$_POST['category_id'];

    $sql = "INSERT INTO posts (title, summary, content, image_url, category_id) 
            VALUES ('$title', '$summary', '$content', '$image_url', '$category_id')";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php");
        exit();
    } else {
        $error = "Lỗi thêm bài viết: " . $conn->error;
    }
}

$categories = $conn->query("SELECT * FROM categories");
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Bài Viết Mới</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background-color: #f4f6f9; }
        .form-container { max-width: 700px; margin: auto; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
        input[type="text"], textarea, select { width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 10px 20px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
        a { text-decoration: none; color: #555; margin-left: 10px; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>➕ THÊM BÀI VIẾT MỚI</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label>Tiêu đề bài viết (*):</label>
            <input type="text" name="title" required placeholder="Nhập tiêu đề...">
        </div>
        <div class="form-group">
            <label>Chuyên mục (*):</label>
            <select name="category_id">
                <?php while($cat = $categories->fetch_assoc()): ?>
                    <option value="<?= $cat['category_id'] ?>"><?= htmlspecialchars($cat['category_name']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Đường dẫn hình ảnh (*):</label>
            <input type="text" name="image_url" placeholder="IMG/TrangChu/example.webp" required>
        </div>
        <div class="form-group">
            <label>Tóm tắt ngắn:</label>
            <textarea name="summary" rows="3" placeholder="Tóm tắt ngắn bài viết..."></textarea>
        </div>
        <div class="form-group">
            <label>Nội dung chi tiết:</label>
            <textarea name="content" rows="6" placeholder="Nội dung đầy đủ..."></textarea>
        </div>
        <button type="submit">Lưu Bài Viết</button>
        <a href="admin.php">Quay lại Quản trị</a>
    </form>
</div>

</body>
</html>