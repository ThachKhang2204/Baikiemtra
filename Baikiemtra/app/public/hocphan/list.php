<?php
require_once __DIR__ . '/../../models/HocPhanModel.php';

$model = new HocPhanModel();
$hocphans = $model->getAll();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký học phần</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-primary">📚 Đăng ký học phần</h2>

    <form method="post" action="dangky.php" class="card p-4 shadow">
        <div class="mb-3">
            <label for="MaSV" class="form-label">📌 Nhập mã sinh viên:</label>
            <input name="MaSV" id="MaSV" class="form-control" required>
        </div>

        <table class="table table-bordered table-hover">
            <thead class="table-primary">
                <tr>
                    <th>Mã HP</th>
                    <th>Tên học phần</th>
                    <th>Số tín chỉ</th>
                    <th>Chọn</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($hocphans as $hp): ?>
                <tr>
                    <td><?= $hp['MaHP'] ?></td>
                    <td><?= $hp['TenHP'] ?></td>
                    <td><?= $hp['SoTinChi'] ?></td>
                    <td><input type="checkbox" class="form-check-input" name="dsHP[]" value="<?= $hp['MaHP'] ?>"></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">✅ Đăng ký</button>
            <button type="button" onclick="window.history.back()" class="btn btn-secondary">⬅️ Quay lại</button>
        </div>
    </form>
</div>

</body>
</html>
