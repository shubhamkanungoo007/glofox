<?php
require_once __DIR__ . "/../config/database.php";

class BookingModel {
    private $conn;
    private $table_name = "bookings";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function book($class_id, $member_name, $booking_date) {
        try {
            // Ensure class exists before booking
            $classExists = $this->checkClassExists($class_id);
            if (!$classExists) {
                throw new Exception("Class with ID $class_id does not exist.");
            }

            // Insert booking
            $query = "INSERT INTO " . $this->table_name . " (class_id, member_name, booking_date) 
                      VALUES (:class_id, :member_name, :booking_date)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":class_id", $class_id, PDO::PARAM_INT);
            $stmt->bindParam(":member_name", $member_name, PDO::PARAM_STR);
            $stmt->bindParam(":booking_date", $booking_date, PDO::PARAM_STR);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Database error while creating booking: " . $e->getMessage());
        }
    }

    private function checkClassExists($class_id) {
        $query = "SELECT id FROM classes WHERE id = :class_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":class_id", $class_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }
}
?>
