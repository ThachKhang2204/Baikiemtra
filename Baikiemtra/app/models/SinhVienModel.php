<?php
require_once __DIR__ . '/../config/db.php';

class SinhVienModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM SinhVien");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM SinhVien WHERE MaSV = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getPaginated($limit, $offset) {
        $stmt = $this->conn->prepare("SELECT * FROM SinhVien LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll() {
        $stmt = $this->conn->query("SELECT COUNT(*) FROM SinhVien");
        return $stmt->fetchColumn();
    }

    public function create($sv) {
        $sql = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $sv['MaSV'], $sv['HoTen'], $sv['GioiTinh'], $sv['NgaySinh'], $sv['Hinh'], $sv['MaNganh']
        ]);
    }

    public function update($maSV, $data) {
        $query = "UPDATE SinhVien SET HoTen = :HoTen, GioiTinh = :GioiTinh, NgaySinh = :NgaySinh, Hinh = :Hinh, MaNganh = :MaNganh WHERE MaSV = :MaSV";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':HoTen' => $data['HoTen'],
            ':GioiTinh' => $data['GioiTinh'],
            ':NgaySinh' => $data['NgaySinh'],
            ':Hinh' => $data['Hinh'],
            ':MaNganh' => $data['MaNganh'],
            ':MaSV' => $maSV,
        ]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM SinhVien WHERE MaSV=?");
        return $stmt->execute([$id]);
    }

    // ✅ Thêm phương thức đăng ký tài khoản sinh viên
    public function register($sv) {
        $sql = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh, MatKhau)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $sv['MaSV'],
            $sv['HoTen'],
            $sv['GioiTinh'],
            $sv['NgaySinh'],
            $sv['Hinh'],
            $sv['MaNganh'],
            password_hash($sv['MatKhau'], PASSWORD_DEFAULT) // hash mật khẩu
        ]);
    }

    // ✅ Thêm phương thức đăng nhập
    public function login($maSV, $matKhauNhap) {
        $stmt = $this->conn->prepare("SELECT * FROM SinhVien WHERE MaSV = ?");
        $stmt->execute([$maSV]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($matKhauNhap, $user['MatKhau'])) {
            return $user; // Đăng nhập thành công
        }

        return false; // Sai thông tin
    }
}
