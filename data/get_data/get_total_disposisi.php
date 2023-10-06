<?php


$host = "localhost";
$username = "root";
$password = "";
$dbname = "bpkad";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Koneksi Database Gagal : " . mysqli_connect_error());
}

$countQuery = "SELECT COUNT(*) AS total_disposisi FROM tb_disposisinya";
$countResult = mysqli_query($conn, $countQuery);
$countRow = mysqli_fetch_assoc($countResult);
$totalDisposisi = $countRow['total_disposisi'];

mysqli_close($conn);

// Kirimkan jumlah disposisi sebagai respons teks
echo $totalDisposisi;
?>