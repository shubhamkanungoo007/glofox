<?php
require_once __DIR__ . "/../config/database.php";

class ClassModel {
    private $conn;
    private $table_name = "classes";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create($name, $start_date, $end_date, $capacity) {
        try {
            $query = "INSERT INTO " . $this->table_name . " (name, start_date, end_date, capacity) VALUES (:name, :start_date, :end_date, :capacity)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":start_date", $start_date);
            $stmt->bindParam(":end_date", $end_date);
            $stmt->bindParam(":capacity", $capacity);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error creating class: " . $e->getMessage());
        }
    }
}
?>
