<?php
require_once __DIR__ . '/../models/SinhVienModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $model = new SinhVienModel();
    $data = [
        'MaSV' => $_POST['MaSV'],
        'HoTen' => $_POST['HoTen'],
        'GioiTinh' => $_POST['GioiTinh'],
        'NgaySinh' => $_POST['NgaySinh'],
        'Hinh' => $_POST['Hinh'],
        'MaNganh' => $_POST['MaNganh'],
        'MatKhau' => $_POST['MatKhau'],
    ];

    if ($model->register($data)) {
        header("Location: login.php");
        exit;
    } else {
        echo "Đăng ký thất bại!";
    }
}
?>

<!-- Form Đăng ký -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container mt-5">
    <h2>📌 Đăng ký tài khoản sinh viên</h2>
    <form method="post">
        <input name="MaSV" class="form-control mb-2" placeholder="Mã sinh viên" required>
        <input name="HoTen" class="form-control mb-2" placeholder="Họ tên" required>
        <select name="GioiTinh" class="form-control mb-2">
            <option>Nam</option>
            <option>Nữ</option>
        </select>
        <input type="date" name="NgaySinh" class="form-control mb-2" required>
        <input name="Hinh" class="form-control mb-2" placeholder="Link ảnh (Hình)">
        <input name="MaNganh" class="form-control mb-2" placeholder="Mã ngành">
        <input type="password" name="MatKhau" class="form-control mb-2" placeholder="Mật khẩu" required>
        <button type="submit" class="btn btn-primary">Đăng ký</button>
        <a href="login.php" class="btn btn-link">Đã có tài khoản? Đăng nhập</a>
    </form>
</div>
