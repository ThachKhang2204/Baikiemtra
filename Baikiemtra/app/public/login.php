<?php
session_start();
require_once __DIR__ . '/../config/db.php';

$db = new Database();
$conn = $db->getConnection();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $maSV = $_POST['username'];
    $matKhau = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM SinhVien WHERE MaSV = ?");
    $stmt->execute([$maSV]);
    $sinhvien = $stmt->fetch();

    if ($sinhvien && password_verify($matKhau, $sinhvien['MatKhau'])) {
        $_SESSION['sinhvien'] = $sinhvien;
        header("Location: dashboard.php"); // ví dụ chuyển đến trang chính sau khi đăng nhập
        exit;
    } else {
        $error = "Sai mã sinh viên hoặc mật khẩu!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow p-4">
                <h3 class="text-center text-primary mb-4">🎓 Đăng nhập sinh viên</h3>

                <?php if ($error): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>

                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Mã sinh viên</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mật khẩu</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">🔐 Đăng nhập</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
