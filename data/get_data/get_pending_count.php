<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "bpkad";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Koneksi Database Gagal : " . mysqli_connect_error());
}

// Query to get the count of pending items
$sql = "SELECT COUNT(*) AS total_pending FROM tb_disposisinya WHERE st = 0";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    echo $row['total_pending'];
} else {
    echo 'Error';
}

mysqli_close($conn);
