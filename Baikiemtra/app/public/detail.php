<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/SinhVienModel.php';

if (!isset($_GET['MaSV'])) {
    die("Thiếu mã sinh viên");
}

$model = new SinhVienModel();
$sv = $model->getById($_GET['MaSV']);

if (!$sv) {
    die("Không tìm thấy sinh viên!");
}
?>

<h2>👁️ Chi tiết sinh viên</h2>
<ul>
    <li><strong>Mã SV:</strong> <?= $sv['MaSV'] ?></li>
    <li><strong>Họ tên:</strong> <?= $sv['HoTen'] ?></li>
    <li><strong>Giới tính:</strong> <?= $sv['GioiTinh'] ?></li>
    <li><strong>Ngày sinh:</strong> <?= $sv['NgaySinh'] ?></li>
    <li><strong>Hình:</strong> <img src="<?= $sv['Hinh'] ?>" width="100"></li>
    <li><strong>Mã ngành:</strong> <?= $sv['MaNganh'] ?></li>
</ul>
<a href="list.php">← Quay lại danh sách</a>
