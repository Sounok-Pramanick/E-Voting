<?php
require_once __DIR__ . "/cors.php";
header("Content-Type: application/json");


require_once __DIR__ . "/db.php";

if ($mysqli->connect_error) {
    die(json_encode(["success" => false, "message" => "Database connection failed."]));
}

$data = json_decode(file_get_contents('php://input'), true);

$fields = [
    'voter_uid', 'aadhar_uid', 'name', 'dob', 'house_no', 'street_name', 'location',
    'pincode', 'remarks', 'state', 'city', 'mob', 'constituency', 'assembly', 'ward_no',
    'email', 'gender', 'father_or_husband_name',
];

// Fix gender to only M/F
if (isset($data['gender'])) {
    $gender = strtoupper(substr($data['gender'], 0, 1));
    $data['gender'] = ($gender === 'M' || $gender === 'F') ? $gender : null;
}

$types = 'sssssssissssiiisss';

$values = [];
foreach ($fields as $field) {
    $values[] = $data[$field] ?? null;
}

$stmt = $mysqli->prepare(
    "INSERT INTO voter_database_temp (" . implode(',', $fields) . ") 
     VALUES (" . rtrim(str_repeat('?,', count($fields)), ',') . ")"
);

if (!$stmt) {
    echo json_encode(["success" => false, "message" => "Prepare failed", "error" => $mysqli->error]);
    exit();
}

$stmt->bind_param($types, ...$values);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Voter registered successfully."]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to register voter.", "error" => $stmt->error]);
}

$stmt->close();
$mysqli->close();
?>
