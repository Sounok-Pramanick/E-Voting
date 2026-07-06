<?php
require_once __DIR__ . "/cors.php";
header("Content-Type: application/json");

require_once __DIR__ . "/db.php";

if ($mysqli->connect_errno) {
    echo json_encode([
        "exists" => false,
        "error" => "DB connection failed"
    ]);
    exit();
}

$mobile = $_GET['mobile'] ?? '';

if (!$mobile) {
    echo json_encode([
        "exists" => false,
        "error" => "Mobile required"
    ]);
    exit();
}

$stmt = $mysqli->prepare("SELECT * FROM candidate_database WHERE mob=?");
$stmt->bind_param("s", $mobile);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode([
        "exists" => true,
        "candidate" => $row
    ]);
} else {
    echo json_encode(["exists" => false]);
}

$stmt->close();
$mysqli->close();
?>
