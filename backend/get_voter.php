<?php
require_once __DIR__ . "/cors.php";
header("Content-Type: application/json");

require_once __DIR__ . "/db.php";

if ($mysqli->connect_error) {
    die(json_encode(["success" => false, "message" => "Connection failed"]));
}

$data = json_decode(file_get_contents('php://input'), true);
$mobile = $data['mobile'] ?? null;

if (!$mobile) {
    echo json_encode(["success" => false, "message" => "Mobile number required"]);
    exit;
}

$stmt = $mysqli->prepare("SELECT * FROM voter_database WHERE mob = ?");
$stmt->bind_param("s", $mobile);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $voter = $result->fetch_assoc();
    echo json_encode(["success" => true, "voter" => $voter]);
} else {
    echo json_encode(["success" => false, "message" => "Voter not found"]);
}

$stmt->close();
$mysqli->close();
?>