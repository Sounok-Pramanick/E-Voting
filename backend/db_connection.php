<?php
$host = "127.0.0.1";
$port = 3307;
$user = "root";
$pass = "";
$dbname = "e_voting";

try {
    // Create PDO connection
    $pdo = new PDO(
    "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8",
    $user,
    $pass
);

    // Throw exception on error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Database Connection Failed: " . $e->getMessage());
}
?>