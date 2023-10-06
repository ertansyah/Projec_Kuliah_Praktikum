<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "bpkad";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Koneksi Database Gagal : " . mysqli_connect_error());
}

$sql = "SELECT COUNT(*) as total FROM user";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalUsers = $row['total'];
} else {
    $totalUsers = "Error";
}

mysqli_close($conn);

// Keluarkan data dalam format JSON
echo json_encode(['totalUsers' => $totalUsers]);
?>
