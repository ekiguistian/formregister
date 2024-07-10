<?php
session_start();

$host = 'localhost';
$dbname = 'sql_register_lln';
$username = 'sql_register_lln';
$password = 'cab8a800b3b8b';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Koneksi ke database gagal: " . $e->getMessage();
    exit;
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM login WHERE username = :username";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    if (password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        header("Location: data.php");
        exit;
    } else {
        header("Location: login.php?error=Username Dan Password Tidak Sesuai.!");
        exit;
    }
} else {
    header("Location: login.php?error=User Tidak Ditemukan.!");
    exit;
}
?>
