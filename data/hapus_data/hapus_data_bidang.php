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
// Ambil nomor (no) dari parameter URL
$no = $_GET['no'];

// SQL untuk menghapus data dari tabel jabatan berdasarkan nomor
$sql = "DELETE FROM bidang WHERE no = '$no'";

// Eksekusi query
if (mysqli_query($conn, $sql)) {
    $notificationMessage = "Data berhasil dihapus dari database.";
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
