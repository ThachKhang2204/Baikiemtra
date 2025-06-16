<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/SinhVienModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $upload_dir = __DIR__ . '/uploads/';
    $file_name = basename($_FILES['Hinh']['name']);
    $target_path = $upload_dir . $file_name;
    $relative_path = 'uploads/' . $file_name; // Đường dẫn lưu vào CSDL

    // Kiểm tra upload thành công không
    if (move_uploaded_file($_FILES['Hinh']['tmp_name'], $target_path)) {
        $data = [
            'MaSV' => $_POST['MaSV'],
            'HoTen' => $_POST['HoTen'],
            'GioiTinh' => $_POST['GioiTinh'],
            'NgaySinh' => $_POST['NgaySinh'],
            'Hinh' => $relative_path,
            'MaNganh' => $_POST['MaNganh'],
        ];

        $model = new SinhVienModel();
        if ($model->create($data)) {
            header("Location: index.php");
            exit;
        } else {
            echo "❌ Thêm sinh viên thất bại!";
        }
    } else {
        echo "❌ Upload ảnh thất bại!";
    }
}
?>

<h2>Thêm sinh viên</h2>
<form method="post" enctype="multipart/form-data">
    Mã SV: <input name="MaSV"><br>
    Họ Tên: <input name="HoTen"><br>
    Giới Tính: 
    <select name="GioiTinh">
        <option>Nam</option>
        <option>Nữ</option>
    </select><br>
    Ngày Sinh: <input name="NgaySinh" type="date"><br>
    Ảnh đại diện: <input type="file" name="Hinh"><br>
    Mã Ngành: <input name="MaNganh"><br>
    <button type="submit">Lưu</button>
</form>
