<?php
require_once "../controllers/ClassController.php";
require_once "../controllers/BookingController.php";

header("Content-Type: application/json");
$method = $_SERVER['REQUEST_METHOD'];
$request_uri = $_GET['request'] ?? '';

if ($method == 'POST' && $request_uri == 'classes') {
    $controller = new ClassController();
    $controller->create();
} elseif ($method == 'POST' && $request_uri == 'bookings') {
    $controller = new BookingController();
    $controller->book();
} else {
    http_response_code(404);
    echo json_encode(["message" => "Invalid request"]);
}
?>
