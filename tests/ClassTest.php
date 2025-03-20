<?php
use PHPUnit\Framework\TestCase;

require_once "config/database.php";
require_once "models/ClassModel.php";

class ClassTest extends TestCase {
    private $conn;
    private static $classIdFile = "tests/class_id.txt";

    protected function setUp(): void {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function testCreateClass() {
        $stmt = $this->conn->prepare("INSERT INTO classes (name, start_date, end_date, capacity) 
                                      VALUES (:name, :start_date, :end_date, :capacity)");
        $stmt->execute([
            ':name' => 'Yoga Class',
            ':start_date' => date('Y-m-d H:i:s', strtotime('+1 day')),
            ':end_date' => date('Y-m-d H:i:s', strtotime('+2 days')),
            ':capacity' => 10
        ]);
        $classId = $this->conn->lastInsertId();
        $this->assertNotEmpty($classId, "Class should be created successfully.");
        file_put_contents(self::$classIdFile, $classId);
    }
}
?>
