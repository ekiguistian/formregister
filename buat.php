<?php
$host = 'localhost';
$dbname = 'sql_register_lln';
$username = 'sql_register_lln';
$password = 'cab8a800b3b8b';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Koneksi ke database gagal: " . $e->getMessage();
}

$username = "nuraini";
$password = "Allnet@2024!";

$password_hashed = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO login (username, password) VALUES (:username, :password)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password_hashed);

if ($stmt->execute()) {
    header("Location: login.php?registration_success");
    exit;
} else {
    header("Location: register.php?error=registration_failed");
    exit;
}
?>
