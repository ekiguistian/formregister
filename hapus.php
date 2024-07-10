<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
$host = 'localhost';
$database = 'sql_register_lln';
$username = 'sql_register_lln';
$password = 'cab8a800b3b8b';
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}
$nik = $_GET['nik'];
$sql = "DELETE FROM data WHERE nik = '$nik'";

if ($conn->query($sql) === TRUE) {
    header("Location: data.php?msg=data-berhasil-dihapus");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>