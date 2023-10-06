<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "bpkad";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Koneksi Database Gagal : " . mysqli_connect_error());
}

// Query to get the count of historical records
$sql = "SELECT COUNT(*) AS total_history FROM tb_kepala";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    echo $row['total_history'];
} else {
    echo 'Error: ' . mysqli_error($conn); // Output the database error if any
}

mysqli_close($conn);
