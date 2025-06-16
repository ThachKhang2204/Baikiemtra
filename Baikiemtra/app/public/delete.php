<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/SinhVienModel.php';

if (!isset($_GET['MaSV'])) {
    echo "Thiếu mã sinh viên!";
    exit;
}

$id = $_GET['MaSV'];
$model = new SinhVienModel();

if ($model->delete($id)) {
    header("Location: list.php");
    exit;
} else {
    echo "Xoá thất bại!";
}
?>
