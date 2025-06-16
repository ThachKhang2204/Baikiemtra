<?php
require_once __DIR__ . '/../config/db.php';

class DangKyModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function taoDangKy($maSV) {
        $stmt = $this->conn->prepare("INSERT INTO DangKy(NgayDK, MaSV) VALUES (CURDATE(), ?)");
        $stmt->execute([$maSV]);
        return $this->conn->lastInsertId();
    }

    public function themChiTiet($maDK, $maHP) {
        $stmt = $this->conn->prepare("INSERT INTO ChiTietDangKy(MaDK, MaHP) VALUES (?, ?)");
        return $stmt->execute([$maDK, $maHP]);
    }
}
