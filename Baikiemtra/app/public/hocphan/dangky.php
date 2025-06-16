<?php
require_once __DIR__ . '/../../models/DangKyModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $maSV = $_POST['MaSV'];
    $dsHP = $_POST['dsHP'] ?? [];

    if (!empty($maSV) && !empty($dsHP)) {
        $model = new DangKyModel();

        // Tạo phiếu đăng ký mới
        $maDK = $model->taoDangKy($maSV);

        // Lưu từng học phần vào chi tiết đăng ký
        foreach ($dsHP as $maHP) {
            $model->themChiTiet($maDK, $maHP);
        }

        echo "✅ Đăng ký thành công!";
    } else {
        echo "⚠️ Vui lòng nhập MSSV và chọn ít nhất 1 học phần.";
    }
}
?>
