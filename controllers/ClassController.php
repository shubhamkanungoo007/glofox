<?php
require_once __DIR__ . '/../models/ClassModel.php';

class ClassController {
    public function create() {
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            if (!isset($data['name'], $data['start_date'], $data['end_date'], $data['capacity'])) {
                throw new Exception("Invalid input: Missing required fields.");
            }

            $classModel = new ClassModel();
            $success = $classModel->create($data['name'], $data['start_date'], $data['end_date'], $data['capacity']);

            echo json_encode(["message" => "Class created successfully"]);
            http_response_code(201);
        } catch (Exception $e) {
            echo json_encode(["error" => $e->getMessage()]);
            http_response_code(500);
        }
    }
}
?>
