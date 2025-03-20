<?php
require_once __DIR__ . '/../models/BookingModel.php';

class BookingController {
    public function book() {
        try{
            $data = json_decode(file_get_contents("php://input"), true);

            if (!isset($data['class_id'], $data['member_name'], $data['booking_date'])) {
                echo json_encode(["message" => "Invalid input"]);
                http_response_code(400);
                return;
            }

            $bookingModel = new BookingModel();
            if ($bookingModel->book($data['class_id'], $data['member_name'], $data['booking_date'])) {
                echo json_encode(["message" => "Booking successful"]);
                http_response_code(201);
            } else {
                echo json_encode(["message" => "Failed to book"]);
                http_response_code(500);
            }
        }  catch (Exception $e) {
            echo json_encode(["error" => $e->getMessage()]);
            http_response_code(500);
        }
    }
}
?>
