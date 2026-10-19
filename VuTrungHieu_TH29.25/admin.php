<?php
require_once 'db.php';

// Lấy danh sách bài viết từ CSDL
$sql = "SELECT posts.*, categories.category_name 
        FROM posts 
        LEFT JOIN categories ON posts.category_id = categories.category_id 
        ORDER BY post_id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang Quản Trị Tin Tức</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f6f9; }
        .container { max-width: 1100px; margin: auto; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { color: #333; margin-top: 0; }
        .btn { padding: 8px 15px; text-decoration: none; border-radius: 4px; color: white; display: inline-block; font-weight: bold; }
        .btn-add { background-color: #28a745; margin-bottom: 20px; }
        .btn-edit { background-color: #ffc107; color: #333; }
        .btn-delete { background-color: #dc3545; }
        .btn:hover { opacity: 0.85; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #dee2e6; padding: 12px; text-align: left; }
        th { background-color: #007bff; color: white; }
        tr:nth-child(even) { background-color: #f8f9fa; }
        img { border-radius: 4px; object-fit: cover; }
    </style>
</head>
<body>

<div class="container">
    <h2>📰 HỆ THỐNG QUẢN TRỊ TIN TỨC (CRUD)</h2>
    <a href="add_post.php" class="btn btn-add">➕ Thêm Bài Viết Mới</a>

    <table>
        <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="15%">Hình ảnh</th>
                <th width="35%">Tiêu đề</th>
                <th width="15%">Chuyên mục</th>
                <th width="15%">Ngày tạo</th>
                <th width="15%">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><b><?= $row['post_id'] ?></b></td>
                    <td><img src="<?= htmlspecialchars($row['image_url']) ?>" width="90" height="60" alt="Thumb"></td>
                    <td><b><?= htmlspecialchars($row['title']) ?></b></td>
                    <td><span style="background: #e9ecef; padding: 3px 8px; border-radius: 3px;"><?= htmlspecialchars($row['category_name'] ?? 'Chưa phân loại') ?></span></td>
                    <td><?= date('d/m/Y H:i', strtotime($row['created_at'])) ?></td>
                    <td>
                        <a href="edit_post.php?id=<?= $row['post_id'] ?>" class="btn btn-edit">✏️ Sửa</a>
                        <a href="delete_post.php?id=<?= $row['post_id'] ?>" class="btn btn-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">🗑️ Xóa</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align: center; color: #777;">Chưa có bài viết nào trong Cơ sở dữ liệu.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>