<?php
require_once 'db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $sql = "DELETE FROM posts WHERE post_id = $id";
    $conn->query($sql);
}

// Chuyển hướng ngay về lại trang quản trị
header("Location: admin.php");
exit();
?>