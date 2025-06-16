<?php
require_once __DIR__ . '/../config/db.php';

class HocPhanModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM HocPhan");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
