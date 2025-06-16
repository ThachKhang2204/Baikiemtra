<?php
// Bật hiển thị lỗi
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang quản lý sinh viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h1 class="mb-4">🎓 Trang quản lý sinh viên</h1>
    
    <!-- Sidebar hoặc menu chức năng -->
<div class="list-group">
    <a href="/BAIKIEMTRA/app/public/list.php" class="list-group-item list-group-item-action">
        📋 Quản lý Sinh viên
    </a>
    <a href="/BAIKIEMTRA/app/public/hocphan/list.php" class="list-group-item list-group-item-action">
        📘 Đăng ký học phần
    </a>
</div>

</body>
</html>
