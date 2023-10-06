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
$nama_sifat = $_POST['sifat'];

// SQL untuk menyimpan data ke dalam tabel tb_sifat
$sql = "INSERT INTO tb_sifat (sifat) VALUES ('$nama_sifat')";

// Eksekusi query
if (mysqli_query($conn, $sql)) {
    $notificationMessage = "Data berhasil disimpan ke database.";
} else {
    $errorMessage = "Error: " . mysqli_error($conn);
}

// Tutup koneksi
mysqli_close($conn);

if (!empty($notificationMessage)) {
    header("Location: ../../menu/output/sifat.php?notification=" . urlencode($notificationMessage));
} else {
    header("Location: ../../menu/output/sifat.php");
}
exit();
?>
