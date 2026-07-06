<?php
require_once __DIR__ . "/cors.php";
header("Content-Type: application/json");

// Start session at the very beginning
session_start();



try {
    // Get POST data with proper error handling
    $json = file_get_contents('php://input');
    if ($json === false) {
        throw new Exception("Invalid request data");
    }
    
    $data = json_decode($json, true);
    if ($data === null) {
        throw new Exception("Invalid JSON format");
    }

    $otp = $data['otp'] ?? null;

    // Validate session and OTP
    if (!isset($_SESSION['otp'], $_SESSION['otp_expiry'])) {
        throw new Exception("OTP not generated or session expired");
    }

    if (time() > $_SESSION['otp_expiry']) {
        throw new Exception("OTP expired");
    }

    if ($_SESSION['otp'] !== $otp) {
        throw new Exception("Invalid OTP");
    }

    // Clear OTP after successful verification
    unset($_SESSION['otp']);
    echo json_encode(["success" => true, "message" => "OTP verified"]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}
?>