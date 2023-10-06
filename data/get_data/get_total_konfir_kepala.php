<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "bpkad";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Koneksi Database Gagal : " . mysqli_connect_error());
}

// Query untuk menghitung jumlah data pada tb_disposisinya
$query = "SELECT COUNT(*) AS total FROM tb_disposisinya";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$totalData = $row['total'];

mysqli_close($conn);

echo $totalData;
?>
