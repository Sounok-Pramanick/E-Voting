<?php
require_once __DIR__ . "/cors.php";
header("Content-Type: application/json");

require_once __DIR__ . "/db.php";

if ($mysqli->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed."]);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["success" => false, "message" => "Invalid input."]);
    exit();
}

// Extract and sanitize all fields
$voter_uid             = $mysqli->real_escape_string($data['voter_uid'] ?? '');
$aadhar_uid            = $mysqli->real_escape_string($data['aadhar_uid'] ?? '');
$name                  = $mysqli->real_escape_string($data['name'] ?? '');
$age                   = $mysqli->real_escape_string($data['age'] ?? '');
$house_no              = $mysqli->real_escape_string($data['house_no'] ?? '');
$street_name           = $mysqli->real_escape_string($data['street_name'] ?? '');
$location              = $mysqli->real_escape_string($data['location'] ?? '');
$pincode               = $mysqli->real_escape_string($data['pincode'] ?? '');
$remarks               = $mysqli->real_escape_string($data['remarks'] ?? '');
$state                 = $mysqli->real_escape_string($data['state'] ?? '');
$city                  = $mysqli->real_escape_string($data['city'] ?? '');
$mob                   = $mysqli->real_escape_string($data['mob'] ?? '');
$constituency          = $mysqli->real_escape_string($data['constituency'] ?? '');
$assembly              = $mysqli->real_escape_string($data['assembly'] ?? '');
$ward_no               = $mysqli->real_escape_string($data['ward_no'] ?? '');
$email                 = $mysqli->real_escape_string($data['email'] ?? '');
$gender                = $mysqli->real_escape_string($data['gender'] ?? '');
$father_or_husband     = $mysqli->real_escape_string($data['father_or_husband_name'] ?? '');
$authenticated_initial = $mysqli->real_escape_string($data['authenticated_initial'] ?? '');

// Special handling for expiry (DATE field)
$expiry = $mysqli->real_escape_string($data['expiry'] ?? '');
if (empty($expiry)) {
    $expiry = "NULL"; // Save NULL if empty
} else {
    $expiry = "'$expiry'";
}

// Ensure voter_uid is present (primary key)
if (empty($voter_uid)) {
    echo json_encode(["success" => false, "message" => "Voter UID is required for update."]);
    exit();
}

// Build update query
$sql = "UPDATE voter_database SET 
            aadhar_uid='$aadhar_uid',
            name='$name',
            age='$age',
            house_no='$house_no',
            street_name='$street_name',
            location='$location',
            pincode='$pincode',
            remarks='$remarks',
            state='$state',
            city='$city',
            mob='$mob',
            constituency='$constituency',
            assembly='$assembly',
            ward_no='$ward_no',
            email='$email',
            gender='$gender',
            father_or_husband_name='$father_or_husband',
            expiry=$expiry,
            authenticated_initial='$authenticated_initial'
        WHERE voter_uid='$voter_uid'";

if ($mysqli->query($sql) === TRUE) {
    echo json_encode(["success" => true, "message" => "Voter details updated successfully."]);
} else {
    echo json_encode(["success" => false, "message" => "Update failed: " . $mysqli->error]);
}

$mysqli->close();
?>
