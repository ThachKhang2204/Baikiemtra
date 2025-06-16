<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/SinhVienModel.php';

$model = new SinhVienModel();

// Cấu hình phân trang
$perPage = 4;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

$total = $model->countAll(); // tổng số sinh viên
$totalPages = ceil($total / $perPage);
$offset = ($page - 1) * $perPage;

$sinhviens = $model->getPaginated($perPage, $offset);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 960px;
            margin-top: 40px;
        }
        img {
            border-radius: 6px;
            object-fit: cover;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="mb-4">📋 Danh sách sinh viên (Trang <?= $page ?> / <?= $totalPages ?>)</h2>
    <a href="create.php" class="btn btn-success mb-3">➕ Thêm sinh viên</a>
    <table class="table table-bordered table-hover align-middle text-center">
        <thead class="table-primary">
            <tr>
                <th>Mã SV</th>
                <th>Họ tên</th>
                <th>Giới tính</th>
                <th>Ngày sinh</th>
                <th>Hình</th>
                <th>Mã ngành</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($sinhviens as $sv): ?>
            <tr>
                <td><?= htmlspecialchars($sv['MaSV']) ?></td>
                <td><?= htmlspecialchars($sv['HoTen']) ?></td>
                <td><?= htmlspecialchars($sv['GioiTinh']) ?></td>
                <td><?= htmlspecialchars($sv['NgaySinh']) ?></td>
                <td>
                    <?php if (!empty($sv['Hinh'])): ?>
                        <img src="<?= htmlspecialchars($sv['Hinh']) ?>" width="60" height="60">
                    <?php else: ?>
                        <span class="text-muted">Không có ảnh</span>
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($sv['MaNganh']) ?></td>
                <td>
                    <a href="detail.php?MaSV=<?= $sv['MaSV'] ?>" class="btn btn-info btn-sm">👁️ Xem</a>
                    <a href="edit.php?MaSV=<?= $sv['MaSV'] ?>" class="btn btn-warning btn-sm">✏️ Sửa</a>
                    <a href="delete.php?MaSV=<?= $sv['MaSV'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn xóa?')">❌ Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!-- PHÂN TRANG -->
    <nav>
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>
</body>
</html>
