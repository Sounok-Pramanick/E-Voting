<?php
require_once __DIR__ . "/cors.php";
header("Content-Type: application/json");

require_once __DIR__ . "/db.php";
if ($mysqli->connect_error) {
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

// Aggregate votes at all levels by year
$sql = "
SELECT 
    year,
    constituency,
    assembly,
    ward_no,
    poll_no,
    COUNT(*) as votes
FROM poll
GROUP BY year, constituency, assembly, ward_no, poll_no
ORDER BY year DESC, constituency, assembly, ward_no, votes DESC
";

$result = $mysqli->query($sql);

$data = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);
$mysqli->close();
?>
