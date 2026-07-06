<?php
require_once __DIR__ . "/cors.php";
header("Content-Type: application/json");



require_once __DIR__ . "/db.php";

if ($mysqli->connect_error) {
    echo json_encode(["error" => "Connection failed: " . $mysqli->connect_error]);
    exit();
}

$sql = "SELECT voter_uid, aadhar_uid, name, dob, house_no, street_name, location, 
        pincode, remarks, state, city, mob, constituency, assembly, ward_no, 
        email, gender, father_or_husband_name, expire 
        FROM voter_database_temp";

$result = $mysqli->query($sql);

$voters = [];
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $voters[] = $row;
    }
}

echo json_encode($voters);

$mysqli->close();
?>
