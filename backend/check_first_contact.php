<?php
require_once __DIR__ . "/cors.php";
header("Content-Type: application/json");



require_once __DIR__ . "/twilio.php";

$data = json_decode(file_get_contents("php://input"), true);
$mobile = $data["mobile"] ?? "";

if (!$mobile || !preg_match('/^\d{10}$/', $mobile)) {
    echo json_encode([
        "allowed" => false,
        "message" => "Invalid mobile number"
    ]);
    exit;
}

try {

    if (checkWhatsappJoined($mobile)) {

        echo json_encode([
            "allowed" => true,
            "message" => "WhatsApp verification successful"
        ]);

    } else {

        echo json_encode([
            "allowed" => false,
            "message" => "Join message not detected yet"
        ]);

    }

} catch (Exception $e) {

    echo json_encode([
        "allowed" => false,
        "message" => $e->getMessage()
    ]);

}