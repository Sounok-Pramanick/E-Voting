<?php
require_once __DIR__ . "/cors.php";
header("Content-Type: application/json");



require_once __DIR__ . "/db.php";

if ($mysqli->connect_error) {
    die(json_encode(["exists" => false, "error" => "Database connection failed."]));
}

$data = json_decode(file_get_contents('php://input'), true);
$mobile = $data['mob'] ?? "";

if (!$mobile) {
    echo json_encode(["exists" => false, "error" => "Mobile number missing"]);
    exit();
}

$stmt = $mysqli->prepare("SELECT mob FROM voter_database WHERE mob = ?");
$stmt->bind_param("s", $mobile);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode(["exists" => true]);
} else {
    echo json_encode(["exists" => false]);
}

$stmt->close();
$mysqli->close();
?>
