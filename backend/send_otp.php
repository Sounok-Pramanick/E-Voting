<?php
session_start();
require_once __DIR__ . "/cors.php";
header("Content-Type: application/json");



$data = json_decode(file_get_contents('php://input'), true);
$mobile = $data['mobile'] ?? null;

if (!$mobile || !preg_match('/^\d{10}$/', $mobile)) {
    echo json_encode(["success" => false, "message" => "Invalid Mobile Number"]);
    exit;
}

require_once __DIR__ . "/db.php";
if ($mysqli->connect_errno) {
    echo json_encode(["success" => false, "message" => "Database connection failed"]);
    exit;
}

// ✅ Step 2: Verify mobile exists in voter_database
$stmt = $mysqli->prepare("SELECT * FROM voter_database WHERE mob = ?");
$stmt->bind_param("s", $mobile);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(["success" => false, "message" => "Mobile number not registered"]);
    exit;
}

// ✅ Step 4: Execute Python script to send WhatsApp OTP
require_once __DIR__ . "/twilio.php";

if (!checkWhatsappJoined($mobile)) {
    echo json_encode([
        "success" => false,
        "message" => "We haven't received your join message yet. Send 'join language-prepare' to +1 415 523 8886."
    ]);
    exit;
}

// ✅ Step 3: Generate OTP
$otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
$_SESSION['otp'] = $otp;
$_SESSION['otp_mobile'] = $mobile;
$_SESSION['otp_expiry'] = time() + 300; // 5 mins validity

try {
    sendWhatsappOTP($mobile, $otp);

    echo json_encode([
        "success" => true,
        "message" => "OTP sent"
    ]);
} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}
