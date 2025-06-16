<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/SinhVienModel.php';

$model = new SinhVienModel();

if (!isset($_GET['MaSV'])) {
    echo "Thiếu mã sinh viên!";
    exit;
}
$maSV = $_GET['MaSV'];

$sinhvien = $model->getById($maSV);
if (!$sinhvien) {
    echo "Không tìm thấy sinh viên";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hinh = $sinhvien['Hinh']; // Mặc định giữ ảnh cũ

    // Nếu có file mới thì xử lý upload
    if (isset($_FILES['Hinh']) && $_FILES['Hinh']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = basename($_FILES['Hinh']['name']);
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['Hinh']['tmp_name'], $targetPath)) {
            $hinh = 'uploads/' . $fileName; // Lưu tên đường dẫn tương đối
        } else {
            echo "Upload ảnh thất bại!";
        }
    }

    $data = [
        'MaSV' => $_POST['MaSV'],
        'HoTen' => $_POST['HoTen'],
        'GioiTinh' => $_POST['GioiTinh'],
        'NgaySinh' => $_POST['NgaySinh'],
        'Hinh' => $hinh,
        'MaNganh' => $_POST['MaNganh'],
    ];

    if ($model->update($maSV, $data)) {
        header("Location: list.php");
        exit;
    } else {
        echo "Cập nhật thất bại!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Cập nhật sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>✏️ Cập nhật sinh viên</h2>
    <form method="post" enctype="multipart/form-data" class="border p-4 shadow bg-light rounded">
        <input type="hidden" name="MaSV" value="<?= $sinhvien['MaSV'] ?>">

        <div class="mb-3">
            <label class="form-label">Mã SV</label>
            <input class="form-control" value="<?= $sinhvien['MaSV'] ?>" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Họ tên</label>
            <input name="HoTen" class="form-control" value="<?= $sinhvien['HoTen'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Giới tính</label>
            <select name="GioiTinh" class="form-select">
                <option value="Nam" <?= $sinhvien['GioiTinh'] === 'Nam' ? 'selected' : '' ?>>Nam</option>
                <option value="Nữ" <?= $sinhvien['GioiTinh'] === 'Nữ' ? 'selected' : '' ?>>Nữ</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày sinh</label>
            <input type="date" name="NgaySinh" class="form-control" value="<?= $sinhvien['NgaySinh'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Hình ảnh hiện tại</label><br>
            <img src="<?= $sinhvien['Hinh'] ?>" width="100"><br>
            <label class="form-label mt-2">Chọn ảnh mới (nếu muốn):</label>
            <input type="file" name="Hinh" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Mã ngành</label>
            <input name="MaNganh" class="form-control" value="<?= $sinhvien['MaNganh'] ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">💾 Lưu thay đổi</button>
        <a href="list.php" class="btn btn-secondary">⬅️ Quay lại</a>
    </form>
</div>
</body>
</html>
