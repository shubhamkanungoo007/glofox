<?php
use PHPUnit\Framework\TestCase;

require_once "config/database.php";
require_once "models/BookingModel.php";

class BookingTest extends TestCase {
    private $conn;
    private static $classIdFile = "tests/class_id.txt";
    protected function setUp(): void {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function testBookClass() {
        $classId = file_get_contents(self::$classIdFile);
        $this->assertNotEmpty($classId, "Class ID should be available before booking.");
        $bookingModel = new BookingModel();
        $result = $bookingModel->book($classId, "John Doe", date('Y-m-d H:i:s'));
        $this->assertTrue($result, "Booking should be successful.");
    }
}
?>
