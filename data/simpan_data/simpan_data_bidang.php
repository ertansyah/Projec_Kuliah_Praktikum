<?php
// Koneksi ke database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "bpkad";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Koneksi Database Gagal : " . mysqli_connect_error());
}
$notificationMessage = "";
// Ambil data dari formulir
$nama_bidang = $_POST['nama_bidang'];

// SQL untuk menyimpan data ke dalam tabel indexs
$sql = "INSERT INTO bidang (nama_bidang) VALUES ('$nama_bidang')";

// Eksekusi query
if (mysqli_query($conn, $sql)) {
    $notificationMessage = "Data berhasil disimpan ke database.";
} else {
    $errorMessage = "Error: " . mysqli_error($conn);
}

// Tutup koneksi
mysqli_close($conn);

if (!empty($notificationMessage)) {
    header("Location: ../../menu/output/bidang.php?notification=" . urlencode($notificationMessage));
} else {
    header("Location: ../../menu/output/bidang.php");
}
exit();
?>
